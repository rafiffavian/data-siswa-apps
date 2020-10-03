<?php
use App\Models\Siswa;
use App\Models\Guru;

    function ranking5Besar()
    {
        $siswa = Siswa::all();
        $siswa->map(function($s){
            $s->rataNilai = $s->rataRataNilai();
            return $s;
        });
       $siswa = $siswa->sortByDesc('rataNilai')->take(5);

       return $siswa;
    }

    function totalSiswa()
    {
        $siswa = Siswa::count();

        return $siswa;
    }

    function totalGuru()
    {
        $guru = Guru::count();

        return $guru;
    }

?>