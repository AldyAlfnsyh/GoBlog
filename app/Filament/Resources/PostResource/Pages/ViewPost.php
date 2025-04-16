<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Filament\Resources\PostResource\Widgets\StatsOverviewPost;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    
    
    protected function getHeaderWidgets(): array
    {
        return PostResource::getWidgets();
    }
    
}
