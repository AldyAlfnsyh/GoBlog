<?php

namespace App\Filament\Resources\LatestReportViewResource\Pages;

use App\Filament\Resources\LatestReportViewResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLatestReportView extends ViewRecord
{
    protected static string $resource = LatestReportViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
