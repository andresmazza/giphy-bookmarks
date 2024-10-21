<?php

namespace Database\Factories;

use App\Models\Gif;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gif>
 */
class GifFactory extends Factory
{
    protected $model = Gif::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'id'   => fake()->uuid(),
            'user_id' =>  User::factory(),
            'alias' => fake()->name()
        ];
    }
}
