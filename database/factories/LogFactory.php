<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Log;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{

    protected $model = Log::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' =>  User::factory(),
            'request' => fake()->text(),
            'status' => fake()->randomElement([200,201,404,500]),
            'response'=> fake()->text(),
            'ip' => fake()->ipv4()
        ];
    }
}
