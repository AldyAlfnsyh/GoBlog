<?php

namespace App\Filament\Resources\ReportTypeResource\Pages;

use App\Filament\Resources\ReportTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReportTypes extends ListRecords
{
    protected static string $resource = ReportTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
