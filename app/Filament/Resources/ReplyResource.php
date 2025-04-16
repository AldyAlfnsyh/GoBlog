<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReplyResource\Pages;
use App\Filament\Resources\ReplyResource\RelationManagers;
use App\Models\Reply;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class ReplyResource extends Resource
{
    protected static ?string $model = Reply::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-uturn-left';
    protected static ?string $navigationGroup = 'Manange';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('content') ->searchable(),
                TextColumn::make('user.name')->description(fn ($record) : string => $record->user['email'])->searchable(),
                TextColumn::make('post.title')
                ->description(fn ($record) : string => $record->post->author['name'])
                ->searchable()
                ->label('On Post'),
                TextColumn::make('comment.content')
                ->description(fn ($record) : string => $record->comment->user['name'])
                ->label('On Comment')->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('user.name'),
                TextEntry::make('comment.content')->label('at comment'),
                TextEntry::make('created_at')
                ->label('Report Date')
                ->badge()
                ->date()
                ->color('success'),
                TextEntry::make('content')
            ])->columns(1);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReplies::route('/'),
            // 'create' => Pages\CreateReply::route('/create'),
            // 'edit' => Pages\EditReply::route('/{record}/edit'),
        ];
    }
}
