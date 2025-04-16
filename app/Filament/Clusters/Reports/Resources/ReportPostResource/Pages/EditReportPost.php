<?php

namespace App\Filament\Clusters\Reports\Resources\ReportPostResource\Pages;

use App\Filament\Clusters\Reports\Resources\ReportPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReportPost extends EditRecord
{
    protected static string $resource = ReportPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
