<?php

namespace App\Filament\Clusters\Reports\Resources\ReportCommentResource\Pages;

use App\Filament\Clusters\Reports\Resources\ReportCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReportComment extends EditRecord
{
    protected static string $resource = ReportCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
