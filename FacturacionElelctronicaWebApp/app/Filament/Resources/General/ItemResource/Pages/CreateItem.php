<?php

namespace App\Filament\Resources\General\ItemResource\Pages;

use App\Filament\Resources\General\ItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateItem extends CreateRecord
{
    protected static string $resource = ItemResource::class;
}
