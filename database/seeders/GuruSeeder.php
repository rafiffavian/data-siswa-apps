<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('guru')->insert([
            [
                'nama'  => 'sarjono',
                'telpon'  => '088776345',
                'alamat'  => 'Depok',
            ],
            [
                'nama'  => 'dwikorita',
                'telpon'  => '0892667443',
                'alamat'  => 'Bekasi',
            ],
        ]);
    }
}
