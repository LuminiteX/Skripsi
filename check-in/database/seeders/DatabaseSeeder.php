<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(Owner::class);
        $this->call(Admin::class);
        $this->call(RestaurantSeeder::class);
        $this->call(TableSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(ViewCounterSeeder::class);
        $this->call(FeedbackSeeder::class);
    }
}
