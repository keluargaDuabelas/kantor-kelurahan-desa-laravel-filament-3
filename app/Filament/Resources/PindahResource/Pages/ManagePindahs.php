<?php

namespace App\Filament\Resources\PindahResource\Pages;

use App\Filament\Resources\PindahResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePindahs extends ManageRecords
{
    protected static string $resource = PindahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
