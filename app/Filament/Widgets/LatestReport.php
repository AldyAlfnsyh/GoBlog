<?php

namespace App\Filament\Widgets;


use App\Models\Report;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class LatestReport extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Report::query()
                ->select(
                    'reports.id', 
                    'reports.user_id', 
                    'reports.type_id', 
                    'reports.message',
                    'reports.created_at',
                    DB::raw(
                        "CASE
                        WHEN reports.comment_id IS NOT NULL THEN 'Comment'
                        WHEN reports.reply_id IS NOT NULL THEN 'Reply'
                        WHEN reports.post_id IS NOT NULL THEN 'Post'
                        ELSE 'Unknown'
                        END AS type"
                    ),
                    DB::raw(
                        "COALESCE(comments.content, replies.content, posts.title) as content"
                    )
                )
                ->leftJoin('comments', 'reports.comment_id', '=', 'comments.id')
                ->leftJoin('replies', 'reports.reply_id', '=', 'replies.id')
                ->leftJoin('posts', 'reports.post_id', '=', 'posts.id')
            )
            ->defaultPaginationPageOption(5)
            ->defaultSort('reports.created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')
                ->label('Report Date')
                ->badge()
                ->date()
                ->color('success'),
                TextColumn::make('user.name')->label('Sender'),
                TextColumn::make('user.email')->label('Email Sender')->icon('heroicon-m-envelope')
                ->iconColor('primary'),
                TextColumn::make('content')->limit(10),
                TextColumn::make('message')->limit(10),
                TextColumn::make('type.name')->label('Categories'),
                TextColumn::make('type')
                ->icon(fn (string $state): string => match ($state){
                    'Comment' => 'heroicon-o-chat-bubble-left-ellipsis',
                    'Reply' => 'heroicon-o-arrow-uturn-left',
                    'Post' => 'heroicon-o-clipboard-document-list',
                })
                ->iconColor('primary'),
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('created_at')
                ->label('Report Date')
                ->badge()
                ->date()
                ->color('success'),
                TextEntry::make('user.name')->label('Sender'),
                TextEntry::make('user.email')->label('Email Sender')->icon('heroicon-m-envelope')
                ->iconColor('primary'),
                TextEntry::make('content')->limit(10),
                TextEntry::make('message')->limit(10),
                TextEntry::make('type.name')->label('Categories'),
                TextEntry::make('type')
                ->icon(fn (string $state): string => match ($state){
                    'Comment' => 'heroicon-o-chat-bubble-left-ellipsis',
                    'Reply' => 'heroicon-o-arrow-uturn-left',
                    'Post' => 'heroicon-o-clipboard-document-list',
                })
                ->iconColor('primary'),
            ]);
    }
}
