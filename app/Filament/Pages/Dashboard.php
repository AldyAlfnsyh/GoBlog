<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\BlogPostsChart;
use App\Filament\Widgets\BlogPostsChart2;
use App\Filament\Widgets\LatestReport;
use App\Filament\Widgets\StatsOverview;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\StatsOverviewWidget;

class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        // Select::make('businessCustomersOnly')
                        //     ->boolean(),
                        // DatePicker::make('startDate')
                        //     ->maxDate(fn (Get $get) => $get('endDate') ?: now()),
                        // DatePicker::make('endDate')
                        //     ->minDate(fn (Get $get) => $get('startDate') ?: now())
                        //     ->maxDate(now()),
                        // DatePicker::make('periode')
                        // ->label('Select Month Year')
                        // ->displayFormat('F Y')
                        // ->format('Y-m-01') 
                        //
                        TextInput::make('year')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(now()->year)
                        ->required(),
                        TextInput::make('month')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(12)
                        ->required()
                    ])
                    ->columns(3),
            ]);
    }

    public function getWidgets(): array
    {
        return [
            BlogPostsChart::class,
            BlogPostsChart2::class,
            StatsOverview::class,
            LatestReport::class,
        ];
    }
}