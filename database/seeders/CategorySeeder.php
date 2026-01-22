<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Build hierarchy as requested
        $root = Category::updateOrCreate(['name' => 'Sensores de proximidad'], []);

        $photo = Category::updateOrCreate(['name' => 'Sensores fotoeléctricos'], []);
        $photo->parent_id = $root->id;
        $photo->save();

        $purpose = Category::updateOrCreate(['name' => 'Sensores Propósito general'], []);
        $purpose->parent_id = $photo->id;
        $purpose->save();

        $diffuse = Category::updateOrCreate(['name' => 'Difuso Reflectivo'], []);
        $diffuse->parent_id = $purpose->id;
        $diffuse->save();
    }
}
