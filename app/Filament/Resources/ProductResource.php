<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                    ->image()
                    ->directory('products')
                    ->label('Imagen del Producto'),

                Tabs::make('ProductTabs')->tabs([
                    Tab::make('Información General')->schema([
                        TextInput::make('name')->required()->maxLength(255),
                        TextInput::make('sku')->maxLength(255),
                        TextInput::make('barcode')->maxLength(255),
                        Textarea::make('description')->rows(3),
                    ]),

                    Tab::make('Precios y Costos')->schema([
                        TextInput::make('price')->numeric()->prefix('$')->required(),
                        TextInput::make('cost_price')->numeric()->prefix('$')->required(),
                    ]),

                    Tab::make('Inventario y Ubicación')->schema([
                        TextInput::make('stock')->numeric()->required(),
                        TextInput::make('min_stock')->numeric()->required(),
                        Select::make('category_id')
                            ->label('Categoría')
                            ->options(fn () => Category::getTreeOptions())
                            ->searchable()
                            ->placeholder('Escribe la categoría que te interesa')
                            ->nullable(),
                        Select::make('supplier_id')->label('Proveedor')->relationship('supplier','name')->searchable(),
                        Select::make('warehouse_id')->label('Almacén')->relationship('warehouse','name')->searchable(),
                        TextInput::make('weight')->label('Peso [kg]')->numeric()->minValue(0)->step(0.01),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Img'),
                TextColumn::make('sku')->label('SKU')->sortable()->searchable(),
                TextColumn::make('name')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('cost_price')->label('Costo')->money('usd')->sortable(),
                TextColumn::make('price')->label('Precio')->money('usd')->sortable(),
                TextColumn::make('stock')->label('Stock')->sortable(),
                TextColumn::make('category.name')->label('Categoría')->sortable()->searchable(),
                TextColumn::make('supplier.name')->label('Proveedor')->sortable()->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')->options(fn () => Category::getTreeOptions()),
                Tables\Filters\SelectFilter::make('supplier')->relationship('supplier','name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}