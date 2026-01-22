<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('name')->required()->maxLength(255),
            Forms\Components\Select::make('parent_id')
                ->label('Parent')
                ->options(fn (callable $get) => Category::getTreeOptions($get('id') ?? null))
                ->searchable()
                ->nullable(),
            Forms\Components\Textarea::make('description')->rows(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\BadgeColumn::make('orphan')
                ->label('')
                ->getStateUsing(fn ($record) => is_null($record->parent_id) ? 'Sin parent' : null)
                ->colors([
                    'warning' => 'Sin parent',
                ])
                ->tooltip(fn ($record) => is_null($record->parent_id) ? 'Esta categoría no tiene parent asignado' : null),

            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable()
                ->tooltip(fn ($record) => $record->description ?? null),

            Tables\Columns\TextColumn::make('parent_id')
                ->label('Parent')
                ->sortable()
                ->formatStateUsing(function ($state, $record) {
                    if (! $state) {
                        return null;
                    }
                    $options = Category::getTreeOptions(null);
                    return $options[$state] ?? ($record->parent?->name ?? $state);
                }),
        ])->filters([
            Tables\Filters\Filter::make('orphans')
                ->label('Only orphans')
                ->query(fn ($query) => $query->whereNull('parent_id')),
        ])->actions([
            Tables\Actions\EditAction::make(),
        ])->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
