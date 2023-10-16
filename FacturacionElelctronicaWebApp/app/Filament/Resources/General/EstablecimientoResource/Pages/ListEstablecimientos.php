<?php

namespace App\Filament\Resources\General\EstablecimientoResource\Pages;

use App\Filament\Resources\General\EstablecimientoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstablecimientos extends ListRecords
{
    protected static string $resource = EstablecimientoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
