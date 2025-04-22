<?php

namespace App\Filament\App\Resources\PersonAliaResource\Pages;

use App\Filament\App\Resources\PersonAliaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonAlias extends ListRecords
{
    protected static string $resource = PersonAliaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
