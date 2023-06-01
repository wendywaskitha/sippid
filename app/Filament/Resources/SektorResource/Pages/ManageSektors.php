<?php

namespace App\Filament\Resources\SektorResource\Pages;

use App\Filament\Resources\SektorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSektors extends ManageRecords
{
    protected static string $resource = SektorResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
