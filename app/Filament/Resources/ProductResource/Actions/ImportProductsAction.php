<?php

namespace App\Filament\Resources\ProductResource\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class ImportProductsAction extends Action
{
    public static function make(?string $name = null): static
    {
        $name = $name ?? 'importProducts';
        return parent::make($name)
            ->label('Importar productos')
            ->modalHeading('Importar productos desde Excel/CSV')
            ->form([
                FileUpload::make('file')
                    ->label('Archivo Excel o CSV')
                    ->required(),
            ])
            ->action(function (array $data) {
                $file = $data['file'];
                $path = Storage::disk('public')->path($file);
                Excel::import(new ProductsImport, $path);
                Notification::make()
                    ->success()
                    ->title('Importación completada')
                    ->body('Los productos han sido importados correctamente.')
                    ->send();
            });
    }
}
