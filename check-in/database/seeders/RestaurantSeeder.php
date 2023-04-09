<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Restaurant::create(
            [
                'user_id' => 1,
                'name' => 'testing ababa',
                'description' => 'test test test test test test test test test test ...',
                'phone_number' => '+6281320745685',
                'opening_time' => '12:00:00',
                'closing_time' => '21:00:00',
                'address' => 'test test test test test test test test test test',
                'image' => 'public/restaurant_image/20230406_100819_restaurantA.jpeg',
                'rating' => 5,
                'view' => 100,
                'restaurant_status'=>1,
                'restaurant_opening_status'=>1,
            ]
            );
    }
}
