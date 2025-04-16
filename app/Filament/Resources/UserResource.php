<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\ImageColumn;

use function Pest\Laravel\from;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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
                TextColumn::make("name")->searchable()->description(fn ($record): string => $record->email),
                CheckboxColumn::make('is_admin')->label('admin'),
                ImageColumn::make('image')->circular(),
            ])
            ->filters([
                SelectFilter::make('is_admin')->label('admin')->options([
                    '1' => 'admin',
                    '0' => 'not admin'
                ])
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
                Section::make([
                    Split::make([
                        Grid::make(2)
                        ->schema([
                            Group::make([
                                TextEntry::make('name'),
                                TextEntry::make('user_name'),
                                TextEntry::make('slug'),
                            ]),
                            Group::make([
                                TextEntry::make('email'),
                                IconEntry::make('is_admin')->boolean(),
                                TextEntry::make('updated_at')
                                ->label('Publised at')
                                ->badge()
                                ->date()
                                ->color('success'),
                            ])
                        ]),    
                        ImageEntry::make('image')
                        ->hiddenLabel()
                        ->grow(false),
                    ])->from('lg'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
        ];
    }
}
