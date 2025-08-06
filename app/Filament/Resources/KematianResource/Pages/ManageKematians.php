<?php

namespace App\Filament\Resources\KematianResource\Pages;

use App\Filament\Resources\KematianResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKematians extends ManageRecords
{
    protected static string $resource = KematianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
