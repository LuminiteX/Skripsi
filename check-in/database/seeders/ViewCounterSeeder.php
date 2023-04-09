<?php

namespace Database\Seeders;

use App\Models\ViewCounter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ViewCounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurantId = 1;
        $startDate = now()->addMonth(-5)->startOfDay(); // 5 months ago
        $endDate = now()->endOfDay(); // today

        $viewCounters = [];
        $dateRange = Carbon::parse($startDate)->diffInDays($endDate);

        for ($i = 1; $i <= 50; $i++) {
            $timestamp = Carbon::parse($startDate)->subDays(rand(0, $dateRange))->format('Y-m-d H:i:s');
            $viewCounters[] = [
                'restaurant_id' => $restaurantId,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }
        ViewCounter::insert($viewCounters);
    }
}
