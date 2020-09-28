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
}
