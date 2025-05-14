<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->firstName(),
            'prenom' => $this->faker->lastName(),
            'fonction' => $this->faker->word(),
            'nom_entreprise' => $this->faker->company(),
            'ice' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password123'),  // Default password for all clients
            'adresse' => $this->faker->address(),
        ];
    }
}