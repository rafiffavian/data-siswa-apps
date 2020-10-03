<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = "siswa";

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'jenis_kelamin',
        'agama',
        'alamat',
        'avatar',
        'user_id',
    ];

    public function getAvatar()
    {
        if(!$this->avatar) {
            return asset('images/anon.jpg');
        }
            return asset('images/'. $this->avatar);
    }

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class)->withPivot(['nilai']);
    }

    public function rataRataNilai()
    {
        //ambil nilai
        $total = 0;
        $hitung = 0;
        foreach ($this->mapel as $mapel) {
            $total += $mapel->pivot->nilai;
            $hitung++;

        }
        return round($total/$hitung); 
    }

    public function nama_lengkap()
    {
        return $this->nama_depan .' '. $this->nama_belakang;
    }

}
