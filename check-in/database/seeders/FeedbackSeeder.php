<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $reservation_ids = range(1, 20);
        shuffle($reservation_ids);
        $user_ids = range(2, 6);
        shuffle($user_ids);

        foreach(range(1, 20) as $index) {
            $rating = $faker->randomFloat(1, 1, 4.5) * 2;
            $rating = round($rating) / 2; // round to nearest 0.5
            DB::table('feedback')->insert([
                'reservation_id' => array_pop($reservation_ids),
                'restaurant_id' => 1,
                'user_id' => array_pop($user_ids),
                'rating' => $rating,
                'comment' => $faker->sentence(),
                'created_at' => Carbon::now()->subMonths(5)->addDays(rand(1, 150))->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subMonths(5)->addDays(rand(1, 150))->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
