<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // $randomString = '';
        // $max = strlen($characters) - 1;

        // for($i = 0; $i < 4; $i++) {
        //     $randomString .= $characters[rand(0, $max)];
        // }

        return [
            'catname' => fake()->word(),
            'code' => strtoupper(Str::random(4)),
        ];
    }
}
