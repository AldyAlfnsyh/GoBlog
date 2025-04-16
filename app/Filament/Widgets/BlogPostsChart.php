<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
// use Filament\Pages\Concerns\HasFiltersForm;
class BlogPostsChart extends ChartWidget
{
    // use HasFiltersForm;
    protected static ?string $heading = 'Total Report per Month';
    public ?array $filters = [];
    public function getData(): array
    {

        // $data = Trend::model(User::class)
        //     ->between(
        //         start: now()->startOfYear(),
        //         end: now()->endOfYear(),
        //     )
        //     ->perMonth()
        //     ->count();
     
        // return [
        //     'datasets' => [
        //         [
        //             'label' => 'Blog posts',
        //             'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
        //         ],
        //     ],
        //     'labels' => $data->map(fn (TrendValue $value) => $value->date),
        // ];
        // $periode = ! is_null($this->filters['periode'] ?? null) ?
        // Carbon::parse($this->filters['periode']) :
        // null;
        // dd($periode);
        // dd(now()->year);
        $year = $this->filters['year'] ?? now()->year;
        $month = $this->filters['month'] ?? now()->month;
        
        $datesInMonth = [];
        $startDate = Carbon::create($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();

        while ($startDate <= $endDate) {
            $datesInMonth[$startDate->toDateString()] = 0; // Set default 0 like
            $startDate->addDay();
        }
        
        
        // SELECT day(updated_at), count(id) FROM `likes` GROUP BY day(updated_at); 
        $selected_data = DB::table('reports')
        ->selectRaw('Date(created_at) as date, count(id) as total_report')
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->groupBy(DB::raw('Date(created_at)'))->get()->pluck('total_report','date')->toArray(); 

        $final_data = array_merge($datesInMonth, $selected_data);

        // dd($final_data);
        return [
            'datasets' => [
                [
                    'label' => 'Total Report',
                    'data' => array_values($final_data),
                    'fill' => 'start',
                ],
            ],
            'labels' => array_keys($final_data),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
