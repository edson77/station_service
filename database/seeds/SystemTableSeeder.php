<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privileges')->insert([
            'privilege' => "admin",
        ]);
        DB::table('privileges')->insert([
            'privilege' => "agent pompiste",
        ]);
        DB::table('privileges')->insert([
            'privilege' => "responssable station",
        ]);
        DB::table('privileges')->insert([
            'privilege' => "chef sed",
        ]);

            DB::table('users')->insert([
                'nom' => "Bitjoka",
                'prenom' => "Edson",
                'mail' => 'edsonelmar@gmail.com',
                'identifiant' => "edson77",
                'phone' => "6978452034",
                'password' => bcrypt('11111111'),
                'id_privileges' => 1,
                'datenaissance' => "10 Avril 1993",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'slug' =>"Bitjoka-Edson-77",
            'avatar' => 'img.PNG'
        ]);

        DB::table('users')->insert([
            'nom' => "Pirson",
            'prenom' => "Jessica",
            'mail' => 'jessica@gmail.com',
            'identifiant' => "jessica77",
            'phone' => "6978452078",
            'password' => bcrypt('11111111'),
            'id_privileges' => 3,
            'datenaissance' => "10 Avril 2000",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'slug' =>"Pirson-Jessica-77",
            'avatar' => 'img.PNG'
        ]);

        DB::table('users')->insert([
            'nom' => "Karmis",
            'prenom' => "lenon",
            'mail' => 'lenon@gmail.com',
            'identifiant' => "lenon77",
            'phone' => "6848452038",
            'password' => bcrypt('11111111'),
            'id_privileges' => 2,
            'datenaissance' => "10 Avril 1980",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'slug' =>"Karmis-lenon-77",
            'avatar' => 'img.PNG'
        ]);

        DB::table('users')->insert([
            'nom' => "Amaori",
            'prenom' => "Learning 2",
            'mail' => 'amaori@gmail.com',
            'identifiant' => "amaori77",
            'phone' => "62256452038",
            'password' => bcrypt('11111111'),
            'id_privileges' => 2,
            'datenaissance' => "10 Avril 1999",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'slug' =>"Amaori-Learning2-77",
            'avatar' => 'img.PNG'
        ]);

        DB::table('users')->insert([
            'nom' => "Aragon",
            'prenom' => "Michel KURL",
            'mail' => 'aragon@gmail.com',
            'identifiant' => "aragon77",
            'phone' => "6678452078",
            'password' => bcrypt('11111111'),
            'id_privileges' => 4,
            'datenaissance' => "10 Avril 1975",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'slug' =>"Aragon-MichelKurl-77",
            'avatar' => 'img.PNG'
        ]);

        DB::table('station_service')->insert([
            'adresse' => "Tradex Efoulan",
            'telephone' => "687546985",
            'nombre_employers' => 7,
            'date_dernier_control' => Carbon::now(),
        ]);
        DB::table('transactions')->insert([
            'numero' => "transac-".time(),
            'recettes' => 300000,
            'date_jour' => Carbon::now(),
        ]);

    }
}
