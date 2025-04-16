<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class BlogPostsChart2 extends ChartWidget
{
    public ?Post $record = null;
    protected static ?string $heading = 'Likes Chart';

    protected function getData(): array
    {
        $totalLikes = DB::table('likes')->where('type', '=', 'like')->get()->count();
        $totalDislike= DB::table('likes')->where('type', '=', 'dislike')->get()->count();
        return [
            'datasets' => [
                [
                    'label' => 'Freq',
                    'data' => [$totalLikes, $totalDislike],
                    // 'fill' => false

                ],
            ],
            'labels' => ['like', 'dislike'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
