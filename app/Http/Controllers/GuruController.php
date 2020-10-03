<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Mapel;

class GuruController extends Controller
{
    public function profile(Guru $guru)
    {
        return view('guru.profile',['guru' => $guru]);
    }
}
