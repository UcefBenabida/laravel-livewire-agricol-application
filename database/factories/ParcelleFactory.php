<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Parcelle;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parcelle>
 */
class ParcelleFactory extends Factory
{

    protected $model = Parcelle::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $agr_id = DB::table('agriculteurs')->select('Agr_Id')->get();
        $agr_id_tab = [];
        foreach($agr_id as $id)
        {
            $agr_id_tab[] = $id->Agr_Id;
        }

        return [
            'Par_Nom' => $this->faker->name(),
            'Par_Lieu' => $this->faker->address(10),
            'Par_Prop' => $this->faker->randomElement($agr_id_tab),
            'Par_Superficie' => mt_rand(100, 1000), 
            'created_at' => $this->faker->dateTimeBetween(),
            'updated_at' => $this->faker->dateTimeBetween(),
        ];
    }
}
