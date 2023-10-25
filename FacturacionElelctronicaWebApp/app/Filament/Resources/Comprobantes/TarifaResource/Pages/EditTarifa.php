<?php

namespace App\Filament\Resources\Comprobantes\TarifaResource\Pages;

use App\Filament\Resources\Comprobantes\TarifaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTarifa extends EditRecord
{
    protected static string $resource = TarifaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
