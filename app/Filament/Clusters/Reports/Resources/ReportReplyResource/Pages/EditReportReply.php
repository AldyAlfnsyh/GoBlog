<?php

namespace App\Filament\Clusters\Reports\Resources\ReportReplyResource\Pages;

use App\Filament\Clusters\Reports\Resources\ReportReplyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReportReply extends EditRecord
{
    protected static string $resource = ReportReplyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
