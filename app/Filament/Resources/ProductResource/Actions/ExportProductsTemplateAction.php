<?php

namespace App\Filament\Resources\ProductResource\Actions;

use Filament\Actions\Action;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Writers\CsvWriter;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportProductsTemplateAction extends Action
{
    public static function make(?string $name = null): static
    {
        $name = $name ?? 'exportProductsTemplate';
        return parent::make($name)
            ->label('Descargar plantilla')
            ->action(function () {
                $headers = [
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="plantilla_productos.csv"',
                ];
                $columns = [
                    'name', 'sku', 'barcode', 'description', 'price', 'cost_price', 'stock', 'min_stock', 'weight', 'category', 'supplier', 'warehouse'
                ];
                $callback = function() use ($columns) {
                    $file = fopen('php://output', 'w');
                    fputcsv($file, $columns);
                    fclose($file);
                };
                return response()->stream($callback, 200, $headers);
            });
    }
}
