<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        // create 50 reservations
        for ($i = 1; $i <= 20; $i++) {

            // randomly assign a restaurant id, with half of them being 1
            $restaurant_id = 1;

            // randomly assign a user id
            $user_id = $faker->numberBetween(1, 4);

            // randomly assign a table id
            $table_id = $faker->numberBetween(2, 5);

            // randomly assign a guest number
            $guest_number = $faker->numberBetween(1, 6);

            // randomly assign a reservation date and time
            $reservation_date = Carbon::now()->subWeeks($faker->numberBetween(1, 30))->addHours($faker->numberBetween(2, 10));

            $reservation_date2 = Carbon::now()->addWeeks($faker->numberBetween(1, 12))->addHours($faker->numberBetween(2, 10));

            // randomly assign a reservation status, with 5 out of 10 being "confirmed"
            $reservation_status = $faker->numberBetween(5, 6);
            $reservation_status2 = $faker->numberBetween(0, 3);

            // create the reservation record
            DB::table('reservations')->insert([
                'restaurant_id' => $restaurant_id,
                'user_id' => $user_id,
                'table_id' => $table_id,
                'guest_number' => $guest_number,
                'reservation_date' => $reservation_date2,
                'reservation_status' => $reservation_status2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
