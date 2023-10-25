<?php

namespace App\Filament\Resources\Comprobantes\ComprobanteResource\Pages;

use App\Filament\Resources\Comprobantes\ComprobanteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComprobante extends EditRecord
{
    protected static string $resource = ComprobanteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
