<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Expense;
use Carbon\Carbon;

class MonthlyExpensesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $year = date('Y');
        $currentMonth = date('m');

        $months = [];
        $totals = [];

        for ($i = 1; $i <= $currentMonth; $i++) {
            $total = Expense::whereYear('created_at', $year)
                ->whereMonth('created_at', $i)
                ->sum('price');

            $months[] = Carbon::create()->month($i)->format('F');
            $totals[] = $total;
        }

        return $this->chart->lineChart()
            ->setTitle('Monthly Expenses ' . $year)
            ->setSubtitle('Total expenses per month')
            ->addData('Total Expenses', $totals)
            ->setXAxis($months)
            ->setColors(['#3949AB'])
            ->setFontColor('#fff')
            ->setGrid()
            ->setMarkers(['#E91E63'], 7, 10);
    }
}
