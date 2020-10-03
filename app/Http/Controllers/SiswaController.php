<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Mapel;

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
        //validasi
        // dd($request->all());
        $this->validate( $request, [
            'nama_depan'       => 'required|min:5',
            'nama_belakang'    => 'required',
            'email'            => 'required|email|unique:users',
            'jenis_kelamin'    => 'required',
            'agama'            => 'required',
            'alamat'           => 'required',
            'avatar'           => 'mimes:jpg,png,jpeg',
        ]);

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
            
            if($request->hasFile('avatar')){
                $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
                $siswa->avatar = $request->file('avatar')->getClientOriginalName();
                $siswa->avatar = $request->file('avatar')->getClientOriginalName();
                $avatar = $siswa->avatar;
                $siswa->create([
                    'nama_depan'    => $request->nama_depan,
                    'nama_belakang' => $request->nama_belakang,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'agama'         => $request->agama,
                    'alamat'        => $request->alamat,
                    'user_id'       => $user->id,
                    'avatar'        => $avatar,
                    ]);
            }

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
        $mapels = Mapel::all();
        $nilai = $siswa->mapel;

        //menyiapkan data untuk chart
        $categories = [];
        $data_nilai = [];

        foreach ( $mapels as $mp ) {
          if($siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()) {
            $categories[] = $mp->nama;
            $data_nilai[] = $siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;
        }  
     }


        // dd($data_nilai);

        // dd(json_encode($categories));

        return view('siswa.profile', ['siswa' => $siswa, 'mapels' => $mapels, 'categories' => $categories, 'data_nilai' => $data_nilai]);
    }

    public function nilai(Request $request, $id)
    {
        // dd($request->all());
        $siswa = Siswa::find($id);
        if($siswa->mapel()->where('mapel_id', $request->mapel_id)->exists()) {
            return redirect('siswa/profile/'. $id)->with('error', 'Data Mata Pelajaran Sudah Ada!');
        }
        $siswa->mapel()->attach($request->mapel_id, ['nilai' => $request->nilai]);
        return redirect('siswa/profile/'. $id)->with('sukses', 'Data Nilai Berhasil Di Tambahkan');

    }

    public function deletenilai($idsiswa, $idmapel)
    {
        $siswa = Siswa::find($idsiswa);
        $siswa->mapel()->detach($idmapel);
        return redirect()->back()->with('sukses', 'Data Nilai Berhasil Di Hapus');
    }

}
