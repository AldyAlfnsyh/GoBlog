<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Pages\ManageRelatedRecords;

class ManageComment extends ManageRelatedRecords
{
    protected static string $resource = PostResource::class;

    protected static string $relationship = 'comment';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public function table(Table $table): Table
    {
        return $table
            // ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('content')
                    ->label('Content')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('User')
                    ->description(fn ($record) : string => $record->user['email'])
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Publised at')
                    ->badge()
                    ->date()
                    ->color('success')
                    ->searchable()
                    ->sortable(),

                // IconColumn::make('is_visible')
                //     ->label('Visibility')
                //     ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
                
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->groupedBulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('user.name'),
                TextEntry::make('created_at')
                ->label('Publised at')
                ->badge()
                ->date()
                ->color('success'),
                TextEntry::make('content')
            ])->columns(1);
    }

}
