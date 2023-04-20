<?php

namespace Database\Seeders;
use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['available', 'pending', 'unavailable'];
        $locations = ['front', 'inside'];

        for ($i = 0; $i <= 10; $i++) {
            Table::create([
                'restaurant_id' => 1, // replace with the desired restaurant ID
                'name' => 'Table ' . $i,
                'guest_number' => rand(2, 10),
                'status' => $statuses[array_rand($statuses)],
                'location' => $locations[array_rand($locations)]
            ]);
        }
    }
}
