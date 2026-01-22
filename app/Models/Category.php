<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'parent_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Return hierarchical options array for Select inputs.
     *
     * @param  int|null  $excludeId  optional id to exclude (and its descendants)
     * @return array<int,string>
     */
    public static function getTreeOptions(?int $excludeId = null): array
    {
        $items = self::query()->get(['id', 'name', 'parent_id']);
        $items = self::query()->get(['id', 'name', 'parent_id'])->keyBy('id');

        // Build children map: parent_id => [items]
        $children = [];
        foreach ($items as $item) {
            $parent = $item->parent_id ?? 0;
            $children[$parent][] = $item;
        }

        // Determine excluded ids (node + descendants) if needed
        $excludedIds = [];
        if ($excludeId !== null) {
            $stack = [$excludeId];
            while (! empty($stack)) {
                $cur = array_pop($stack);
                $excludedIds[] = $cur;
                if (isset($children[$cur])) {
                    foreach ($children[$cur] as $c) {
                        $stack[] = $c->id;
                    }
                }
            }
        }

        $options = [];

        $traverse = function ($parentId, $path = []) use (&$traverse, &$children, &$options, $excludedIds) {
            if (! isset($children[$parentId])) {
                return;
            }

            // sort children by name
            $list = collect($children[$parentId])->sortBy('name');

            foreach ($list as $child) {
                if (in_array($child->id, $excludedIds, true)) {
                    continue;
                }

                $currentPath = array_merge($path, [$child->name]);
                $options[$child->id] = implode(' > ', $currentPath);

                $traverse($child->id, $currentPath);
            }
        };

        // start from root (parent_id null => 0)
        $traverse(0, []);

        return $options;
    }

    /**
     * Check if this model (by id) is a descendant of the given id.
     * Useful to prevent cycles when setting parent_id.
     */
    public function isDescendantOf(int $parentId): bool
    {
        $current = $this->parent_id;
        $count = 0;
        while ($current && $count < 100) {
            if ($current == $parentId) {
                return true;
            }
            $parent = self::find($current);
            if (! $parent) {
                break;
            }
            $current = $parent->parent_id;
            $count++;
        }

        return false;
    }

    protected static function booted()
    {
        static::saving(function ($model) {
            // prevent parent = self
            if ($model->parent_id && $model->getKey() && $model->parent_id == $model->getKey()) {
                throw new \Exception('A category cannot be its own parent.');
            }

            // prevent parent being a descendant (would create cycle)
            if ($model->parent_id && $model->getKey()) {
                $parent = self::find($model->parent_id);
                $count = 0;
                while ($parent && $count < 200) {
                    if ($parent->getKey() == $model->getKey()) {
                        throw new \Exception('Cannot set parent: it is a descendant (would create a cycle).');
                    }
                    $parent = $parent->parent_id ? self::find($parent->parent_id) : null;
                    $count++;
                }
            }
        });
    }
}