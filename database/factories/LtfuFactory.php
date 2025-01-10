<?php

namespace Database\Factories;

use App\Models\Ltfu; // Import model Ltfu
use Illuminate\Database\Eloquent\Factories\Factory;

class LtfuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ltfu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->name(), // Menghasilkan nama acak
            'age' => fake()->numberBetween(17, 60), // Menghasilkan angka acak antara 17 dan 60
            'address' => fake()->address(), // Menghasilkan alamat acak
            // Tambahkan field lain jika ada
        ];
    }
}