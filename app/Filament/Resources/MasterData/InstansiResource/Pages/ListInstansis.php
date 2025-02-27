<?php

namespace App\Filament\Resources\MasterData\InstansiResource\Pages;

use App\Filament\Resources\MasterData\InstansiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInstansis extends ListRecords
{
    protected static string $resource = InstansiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
