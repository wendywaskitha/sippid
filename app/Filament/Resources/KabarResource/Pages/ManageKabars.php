<?php

namespace App\Filament\Resources\KabarResource\Pages;

use App\Filament\Resources\KabarResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKabars extends ManageRecords
{
    protected static string $resource = KabarResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
