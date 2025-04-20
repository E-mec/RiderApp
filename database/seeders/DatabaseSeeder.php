<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        User::factory(10)->rider()->create();

        User::factory()->create([
            'name' => 'Exxon Mecnix',
            'email' => 'exxon@example.com',
            'phone' => '08104133974',
            'address'=> 'choba',
            'rider'=>true,
            'password' => 'password'
        ]);

        $this->call(BookingSeeder::class);
    }
}
