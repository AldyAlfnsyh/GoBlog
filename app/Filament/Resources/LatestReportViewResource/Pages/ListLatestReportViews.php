<?php

namespace App\Filament\Resources\LatestReportViewResource\Pages;

use App\Filament\Resources\LatestReportViewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLatestReportViews extends ListRecords
{
    protected static string $resource = LatestReportViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
