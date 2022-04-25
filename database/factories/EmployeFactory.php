<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employe;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployeFactory extends Factory
{

    protected $model = Employe::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Emp_Nss' => $this->faker->randomNumber(9, true),
            'Emp_Nom' => $this->faker->name(),
            'Emp_Prenom' => $this->faker->name(),
            'Emp_Tarif' => $this->faker->randomElement(["normal", "mi-temps", "special", "super special"]), 
            'created_at' => $this->faker->dateTimeBetween(),
            'updated_at' => $this->faker->dateTimeBetween(),
        ];
    }
}
