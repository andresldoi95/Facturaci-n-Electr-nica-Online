<?php

namespace App\Filament\Resources\Comprobantes\ComprobanteResource\Pages;

use App\Filament\Resources\Comprobantes\ComprobanteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComprobantes extends ListRecords
{
    protected static string $resource = ComprobanteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
