<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        \App\Models\Client::factory(40)->create(); // Remplacer 10 par le nombre de clients que vous voulez générer
        $this->call(DocumentSeeder::class);

    }
}
