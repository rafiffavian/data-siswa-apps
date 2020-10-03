@extends('layouts.master')

@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Data Siswa</h3>
                                <div class="right">
                                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                                        <i class="lnr lnr-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Depan</th>
                                            <th>Nama Belakang</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Agama</th>
                                            <th>Alamat</th>
                                            <th>Rata Rata Nilai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $data_siswa as $siswa )
                                        <tr>
                                            <td><a href="/siswa/profile/{{$siswa->id}}">{{$siswa->nama_depan}}</a></td>
                                            <td><a href="/siswa/profile/{{$siswa->id}}">{{$siswa->nama_belakang}}</a></td>
                                            <td>{{$siswa->jenis_kelamin}}</td>
                                            <td>{{$siswa->agama}}</td>
                                            <td>{{$siswa->alamat}}</td>
                                            <td>{{$siswa->rataRataNilai()}}</td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" href="siswa/edit/{{$siswa->id}}">Edit</a>
                                                <a class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" href="siswa/delete/{{$siswa->id}}">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="/siswa/create" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}}">
                      <label for="nama_depan">Nama Depan</label>
                       <input type="text" class="form-control" value="{{old('nama_depan')}}" name="nama_depan" id="nama_depan" aria-describedby="emailHelp">
                      @if($errors->has('nama_depan'))
                          <span class="help-block">{{$errors->first('nama_depan')}}</span>
                      @endif
                    </div>
                    <div class="form-group {{$errors->has('nama_belakang') ? 'has-error' : ''}}">
                      <label for="nama_belakang">Nama Belakang</label>
                      <input type="text" value="{{old('nama_belakang')}}" class="form-control" id="nama_belakang" name="nama_belakang" aria-describedby="emailHelp">
                      @if($errors->has('nama_belakang'))
                        <span class="help-block">{{$errors->first('nama_belakang')}}</span>
                      @endif  
                    </div>
                    <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" value="{{old('email')}}" name="email" aria-describedby="emailHelp">   
                      @if($errors->has('email'))
                          <span class="help-block">{{$errors->first('email')}}</span>
                      @endif    
                    </div>
                    <div class="form-group {{$errors->has('jenis_kelamin') ? 'has-error' : ''}}">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                          <option value="L"{{(old('jenis_kelamin') == 'L') ? ' selected' : ''}}>Laki-Laki</option>
                          <option value="P"{{(old('jenis_kelamin') == 'P') ? ' selected' : ''}}>Perempuan</option>
                        </select>
                        @if($errors->has('jenis_kelamin'))
                             <span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
                        @endif     
                      </div>
                      <div class="form-group {{$errors->has('agama') ? 'has-error' : ''}}">
                        <label for="agama">Agama</label>
                        <input type="text" name="agama" class="form-control" id="agama" value="{{old('agama')}}" aria-describedby="emailHelp">
                        @if($errors->has('agama'))
                         <span class="help-block">{{$errors->first('agama')}}</span>
                        @endif 
                      </div> 
                      <div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3">{{old('alamat')}}</textarea>
                        @if($errors->has('alamat'))
                            <span class="help-block">{{$errors->first('alamat')}}</span>
                        @endif    
                      </div>
                      <div class="form-group {{$errors->has('avatar') ? 'has-error' : ''}}">
                        <label for="alamat">Avatar</label>
                        <input type="file" name="avatar" class="form-control" >
                        @if($errors->has('avatar'))
                             <span class="help-block">{{$errors->first('avatar')}}</span>
                        @endif
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
               </div>
        </div>
        </div>
    </div>
@stop


   
    