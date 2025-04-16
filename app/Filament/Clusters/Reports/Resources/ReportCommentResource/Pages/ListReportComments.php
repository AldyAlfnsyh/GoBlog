<?php

namespace App\Filament\Clusters\Reports\Resources\ReportCommentResource\Pages;

use App\Filament\Clusters\Reports\Resources\ReportCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReportComments extends ListRecords
{
    protected static string $resource = ReportCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
