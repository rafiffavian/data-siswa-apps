@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="/siswa/update/{{$siswa->id}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @method('patch')
                            <div class="form-group">
                              <label for="nama_depan">Nama Depan</label>
                              <input type="text" value="{{$siswa->nama_depan}}" class="form-control" name="nama_depan" id="nama_depan" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                              <label for="nama_belakang">Nama Belakang</label>
                              <input type="text" value="{{$siswa->nama_belakang}}" class="form-control" id="nama_belakang" name="nama_belakang" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                  <option value="L" @if($siswa->jenis_kelamin == 'L') selected @endif>Laki-Laki</option>
                                  <option value="P" @if($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="agama">Agama</label>
                                <input type="text" value="{{$siswa->agama}}" name="agama" class="form-control" id="agama" aria-describedby="emailHelp">
                              </div> 
                              <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" rows="3">{{$siswa->alamat}}</textarea>
                              </div>
                              <div class="form-group">
                                <label for="alamat">Avatar</label>
                                <input type="file" name="avatar" class="form-control" >
                              </div>
                              <button type="submit" class="btn btn-warning">Update</button>
                        </form>
                    </div>    
                </div>
            </div>        
        </div>    
    </div>    
@stop
@section('content1')
    
       @if(session('sukses')) 
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
       @endif 
        <div class="row">
            <div class="col-lg-12">
                <h1>DATA SISWA</h1>
                 {{-- {{dd($data_siswa)}} --}}
                <form action="/siswa/update/{{$siswa->id}}" method="post">
                    {{ csrf_field() }}
                    @method('patch')
                    <div class="form-group">
                      <label for="nama_depan">Nama Depan</label>
                      <input type="text" value="{{$siswa->nama_depan}}" class="form-control" name="nama_depan" id="nama_depan" aria-describedby="emailHelp">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                      <label for="nama_belakang">Nama Belakang</label>
                      <input type="text" value="{{$siswa->nama_belakang}}" class="form-control" id="nama_belakang" name="nama_belakang" aria-describedby="emailHelp">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                          <option value="L" @if($siswa->jenis_kelamin == 'L') selected @endif>Laki-Laki</option>
                          <option value="P" @if($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="agama">Agama</label>
                        <input type="text" value="{{$siswa->agama}}" name="agama" class="form-control" id="agama" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                      </div> 
                      <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3">{{$siswa->alamat}}</textarea>
                      </div>
                      <button type="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
                    
        </div>
    
     <!-- Modal -->
@endsection     
