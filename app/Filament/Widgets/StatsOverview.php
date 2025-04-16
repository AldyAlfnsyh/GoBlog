<?php

namespace App\Filament\Widgets;

use App\Models\likes;
use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {

        $post_count = Post::all()->count();
        // $like_count = likes::all()->where('type','like')->count();
        $report_count = Report::all()->count();
        // $dislike_count = likes::all()->where('type','dislike')->count();
        $user_count = User::all()->where('is_admin',0)->count();
        return [
            Stat::make('Total Post', $post_count)
            ->icon('heroicon-o-clipboard-document-list'),
            Stat::make('Total Report', $report_count)->icon('heroicon-o-flag'),
            Stat::make('Total User', $user_count)->icon('heroicon-o-user-group'),
        ];
    }
}
