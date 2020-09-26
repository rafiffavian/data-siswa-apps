<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="container">
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
    </div>
     <!-- Modal -->
   
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>