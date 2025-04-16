<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Filament\Resources\PostResource\Pages\ListPosts;
use App\Filament\Resources\PostResource\Pages\ViewPost;
use App\Models\Comment;
use App\Models\likes;
use App\Models\Post;
use App\Models\Reply;
use App\Models\Report;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverviewPost extends BaseWidget
{
    public ?Post $record = null;
    protected function getTablePage():string{
        return ViewPost::class;
    }

    protected function getStats(): array
    {
        // $totalLikes= likes::where('post_id', $this->record->id)->where('type','like')->get()->count();
        // $totalDislike= likes::where('post_id', $this->record->id)->where('type','dislike')->get()->count();

        $totalLikes = DB::table('likes')->where('type', '=', 'like')->where('post_id', '=', $this->record->id)
        ->get()->count();
        $totalDislike= DB::table('likes')->where('type', '=', 'dislike')->where('post_id', '=', $this->record->id)
        ->get()->count();
        $likePercentage = $totalLikes*100 / ($totalLikes+$totalDislike);


        // $totalComment = Comment::where('post_id', $this->record->id)->get()->count();
        // $totalReply = Reply::where('post_id', $this->record->id)->get()->count();
        $totalComment = DB::table('comments')->where('post_id', '=', $this->record->id)
        ->get()->count();
        $totalReply = DB::table('replies')->where('post_id', '=', $this->record->id)
        ->get()->count();
        $totalDiscussion = $totalComment + $totalReply;

        // $totalReport= Report::where('post_id', $this->record->id)->get()->count();
        $totalReport= DB::table('reports')->where('post_id', '=', $this->record->id)
        ->get()->count();

        // dd($totalLikes);
        return [
            Stat::make('Like Percentage', $likePercentage.'%'),
            Stat::make('Discussion', $totalDiscussion),
            Stat::make('Reports', $totalReport),
        ];
    }
}
