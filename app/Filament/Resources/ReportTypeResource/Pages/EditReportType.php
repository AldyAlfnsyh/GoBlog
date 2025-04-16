<?php

namespace App\Filament\Resources\ReportTypeResource\Pages;

use App\Filament\Resources\ReportTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReportType extends EditRecord
{
    protected static string $resource = ReportTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
