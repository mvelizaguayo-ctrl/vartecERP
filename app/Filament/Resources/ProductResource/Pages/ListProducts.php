<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ProductResource\Actions\ImportProductsAction;
use App\Filament\Resources\ProductResource\Actions\ExportProductsTemplateAction;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ImportProductsAction::make(),
            ExportProductsTemplateAction::make(),
        ];
    }
}
