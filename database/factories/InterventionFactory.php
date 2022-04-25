<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Intervention;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intervention>
 */
class InterventionFactory extends Factory
{
    protected $model = Intervention::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $emp_nss = DB::table('employes')->select('Emp_Nss')->get();
        $par_id = DB::table('parcelles')->select('Par_Idf')->get();

        $emp_nss_tab = [];
        $par_id_tab = [];

        foreach($emp_nss as $nss)
        {
            $emp_nss_tab[] = $nss->Emp_Nss;
        }

        foreach($par_id as $id)
        {
            $par_id_tab[] = $id->Par_Idf;
        }

        return [
            'Int_Emp_Nss' => $this->faker->randomElement($emp_nss_tab),
            'Int_Par_Id' => $this->faker->randomElement($par_id_tab),
            'Int_Debut' => $this->faker->dateTimeBetween(),
            'Int_Nb_Jours' => $this->faker->randomNumber(3, false), 
            'created_at' => $this->faker->dateTimeBetween(),
            'updated_at' => $this->faker->dateTimeBetween(),
        ];
    }
}
