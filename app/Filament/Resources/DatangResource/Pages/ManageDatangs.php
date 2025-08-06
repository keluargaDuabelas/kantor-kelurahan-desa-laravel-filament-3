<?php

namespace App\Filament\Resources\DatangResource\Pages;

use App\Filament\Resources\DatangResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDatangs extends ManageRecords
{
    protected static string $resource = DatangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
