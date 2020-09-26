<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Siswa;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $gender = $faker->randomElement(['L', 'P']);
        $agama = $faker->randomElement(['Islam', 'Kristen', 'Budha', 'Hindu']);
        
        for($i=0;$i<3;$i++){
            DB::table('siswa')->insert([
                'nama_depan' => $faker->firstName,
                'nama_belakang' => $faker->lastName,
                'jenis_kelamin' => $gender,
                'agama' => $agama,
                'alamat' => $faker->city,
            ]);
        }  
          
    }
}
