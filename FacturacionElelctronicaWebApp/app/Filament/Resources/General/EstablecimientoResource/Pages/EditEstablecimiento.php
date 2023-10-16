<?php

namespace App\Filament\Resources\General\EstablecimientoResource\Pages;

use App\Filament\Resources\General\EstablecimientoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstablecimiento extends EditRecord
{
    protected static string $resource = EstablecimientoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
