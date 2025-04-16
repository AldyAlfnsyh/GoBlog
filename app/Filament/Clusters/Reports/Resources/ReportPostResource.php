<?php

namespace App\Filament\Clusters\Reports\Resources;

use App\Filament\Clusters\Reports;
use App\Filament\Clusters\Reports\Resources\ReportPostResource\Pages;
use App\Filament\Clusters\Reports\Resources\ReportPostResource\RelationManagers;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportPostResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $cluster = Reports::class;

    protected static ?string $label = 'Post';

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
                static::getEloquentQuery()->whereHas('post', function ($query) {
                    $query->whereNotNull('title');
                })
            )
            ->columns([
                TextColumn::make('post.title')->label('Post Title'),
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
                // Tables\Actions\DeleteAction::make(),
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
                TextEntry::make('user.name')->label('Sender'),
                TextEntry::make('type.name'),
                TextEntry::make('message'),
                Section::make([
                    Split::make([
                        Grid::make(2)
                        ->schema([
                            Group::make([
                                TextEntry::make('post.title')->label('Title'),
                                TextEntry::make('post.category.name')->label('Category'),
                                TextEntry::make('created_at')
                                    ->label('Published at')
                                    ->badge()
                                    ->date()
                                    ->color('success'),
                            ]),
                            Group::make([
                                TextEntry::make('post.author.name')->label('Author'),
                                TextEntry::make('post.author.email')->label('Author Email'),

                            ])
                        ]),
                        ImageEntry::make('post.image')->hiddenLabel()->grow(false)

                    ])->from('lg'),
                ]),
                Section::make('Content')
                ->schema([
                    TextEntry::make('post.body')
                    ->html()
                    ->hiddenLabel(),
                ])
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
            'index' => Pages\ListReportPosts::route('/'),
            'create' => Pages\CreateReportPost::route('/create'),
            'edit' => Pages\EditReportPost::route('/{record}/edit'),
            'view' => Pages\ViewReportPost::route('/{record}'),
        ];
    }
}
