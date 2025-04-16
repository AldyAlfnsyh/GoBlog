<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Filament\Resources\PostResource\Widgets\StatsOverviewPost;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Manange';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

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
                TextColumn::make('title')->searchable(),
                TextColumn::make('body')->html()->limit(50),
                TextColumn::make('category.name')->searchable(),
                TextColumn::make('author.name')->description(fn ($record): string => $record->author['email'])->searchable(),
                ImageColumn::make('image'),
            ])
            ->filters([
                
            ])
            ->actions([
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
                Section::make()
                ->schema([
                    Split::make([
                        Grid::make(2)
                        ->schema([
                            Group::make([
                                TextEntry::make('title'),
                                TextEntry::make('slug'),                                        
                                TextEntry::make('created_at')
                                    ->label('Published at')
                                    ->badge()
                                    ->date()
                                    ->color('success'),
                            ]),
                            Group::make([
                                TextEntry::make('author.name'),
                                TextEntry::make('category.name'),
                                TextEntry::make('Total Like')->getStateUsing(fn ($record) => $record->likes()->where('type','like')->count()),
                            ]),                                    
                        ]),
                        ImageEntry::make('image')
                        ->hiddenLabel()
                        ->grow(false),
                    ])->from('lg'),
                ]),
                Section::make('Content')
                ->schema([
                        TextEntry::make('body')->html()
                            // ->prose()
                            // ->markdown()
                            ->hiddenLabel(),
                ])
                ->collapsible(),
                
            ]);
            
    }

    public static function getWidgets(): array
    {
        return [
            StatsOverviewPost::class
        ];
    }
    
    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewPost::class,
            Pages\ManageComment::class,
            Pages\ManageReply::class,
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
            'view' => Pages\ViewPost::route('/{record}'),
            'comment' => Pages\ManageComment::route('/{record}/comment'),
            'reply' => Pages\ManageReply::route('/{record}/reply'),
        ];
    }
}
