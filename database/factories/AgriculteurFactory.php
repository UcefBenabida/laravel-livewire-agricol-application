<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Agriculteur;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agriculteur>
 */
class AgriculteurFactory extends Factory
{
    protected $model = Agriculteur::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Agr_Nom' => $this->faker->name(),
            'Agr_prn' => $this->faker->name(),
            'Agr_Resid' => $this->faker->address(), 
            'created_at' => $this->faker->dateTimeBetween(),
            'updated_at' => $this->faker->dateTimeBetween(),
        ];
    }
}
