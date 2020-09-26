<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        if($request->has('cari')) {
            $data_siswa = Siswa::where('nama_depan', 'LIKE', '%'. $request->cari .'%')
            ->orWhere('nama_belakang', 'LIKE', '%'. $request->cari .'%')
            ->orWhere('agama', 'LIKE', '%'. $request->cari .'%')
            ->orWhere('alamat', 'LIKE', '%'. $request->cari .'%')
            ->get();
        } else {
            $data_siswa = Siswa::all();
        }
        
        return view('siswa.index',['data_siswa' => $data_siswa]);
    }

    public function create(Request $request, Siswa $siswa)
    {
        // return $request->all();
        $siswa->create([
            'nama_depan'    => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'alamat'        => $request->alamat,
        ]);
        return redirect('siswa')->with('sukses', 'Data Berhasil Di Input!');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', ['siswa' => $siswa]);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $siswa->update([
            'nama_depan'    => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'alamat'        => $request->alamat,
        ]);
        return redirect('siswa')->with('sukses', 'Data Berhasil Di Update!');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect('/siswa')->with('sukses', 'Data Berhasil Di Delete');
    }
}
