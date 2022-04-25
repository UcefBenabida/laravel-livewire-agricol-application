<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            /*UserSeeder::class,
            AgriculteurSeeder::class,
            ParcelleSeeder::class,
            EmployeSeeder::class,
            InterventionSeeder::class,*/

        ]);

        /*$users_email = DB::table('users') ->select('email')->get();

        foreach($users_email as $email)
        {
            if($email->email != "admin@usms.ma")
            {
                DB::table('user_roles')->insert([
                    'user_email' => $email->email,
                ]);
            }
           
        }*/


    }
}
