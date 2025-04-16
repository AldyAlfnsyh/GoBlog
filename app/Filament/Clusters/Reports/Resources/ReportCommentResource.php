<?php

namespace App\Filament\Clusters\Reports\Resources;

use App\Filament\Clusters\Reports;
use App\Filament\Clusters\Reports\Resources\ReportCommentResource\Pages;
use App\Filament\Clusters\Reports\Resources\ReportCommentResource\RelationManagers;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;


class ReportCommentResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static ?string $cluster = Reports::class;

    protected static ?string $label = 'Comment';

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
            ->query(
                static::getEloquentQuery()->whereHas('comment', function ($query) {
                    $query->whereNotNull('content');
                })
            )
            ->columns([
                TextColumn::make('comment.content')->label('Content')->limit(50),
                TextColumn::make('type.name'),
                TextColumn::make('message'),
                TextColumn::make('user.name')
                ->description(fn ($record) : string => $record->user['email'])
                ->searchable()->label('Sender'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make()
                // Tables\Actions\DeleteAction::make()
                
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
                
                Grid::make(2)
                ->schema([
                    Group::make([
                        TextEntry::make('user.name')->label('Sender'),                                    
                        TextEntry::make('message'),                                                                
                    ]),
                    Group::make([
                        TextEntry::make('type.name'),                                    
                        TextEntry::make('created_at')
                        ->label('Created at')
                        ->badge()
                        ->date()
                        ->color('success'),
                    ])
                ]),
                
                Section::make('Comment Reported')
                ->schema([
                    
                    TextEntry::make('comment.user.name')->label('Created by'),                                    
                    TextEntry::make('updated_at')
                    ->badge()
                    ->date()
                    ->color('success')
                    ->label('Updated at'),
                    TextEntry::make('comment.content')->label('Content')
                        ->prose()
                        ->markdown()
                ])
                ->collapsible(),
            ]);
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
            'index' => Pages\ListReportComments::route('/'),
            'create' => Pages\CreateReportComment::route('/create'),
            'edit' => Pages\EditReportComment::route('/{record}/edit'),
            'view' => Pages\ViewReportComment::route('/{record}'),
        ];
    }
}
