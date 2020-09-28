<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Str;

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

    public function create(Request $request, Siswa $siswa, User $user)
    {
        // return $request->all();
        //input ke table user
       $user = $user->create([
            'role'  => 'siswa',
            'email'  => $request->email,
            'name'  => $request->nama_depan,
            'password'  => bcrypt('rahasia'),
            'remember_token'  => Str::random(60),
        ]);
        //input ke table siswa    
        $siswa->create([
            'nama_depan'    => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'alamat'        => $request->alamat,
            'user_id'       => $user->id,
        ]);
        return redirect('siswa')->with('sukses', 'Data Berhasil Di Input!');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', ['siswa' => $siswa]);
    }

    public function update(Request $request, Siswa $siswa)
    {
        // dd($request->all());
        $siswa->update([
            'nama_depan'    => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'alamat'        => $request->alamat,
        ]);
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('siswa')->with('sukses', 'Data Berhasil Di Update!');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect('/siswa')->with('sukses', 'Data Berhasil Di Delete');
    }

    public function profile(Siswa $siswa)
    {
        return view('siswa.profile', ['siswa' => $siswa]);
    }

}
