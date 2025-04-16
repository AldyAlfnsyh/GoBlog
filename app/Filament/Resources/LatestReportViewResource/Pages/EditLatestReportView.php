<?php

namespace App\Filament\Resources\LatestReportViewResource\Pages;

use App\Filament\Resources\LatestReportViewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLatestReportView extends EditRecord
{
    protected static string $resource = LatestReportViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
