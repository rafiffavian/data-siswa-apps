@extends('layouts.master')
@section('header')
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@endsection
@section('content')
<div class="main">

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            @if(session('sukses')) 
                <div class="alert alert-success" role="alert">
                    {{session('sukses')}}
                </div>
            @endif 
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{session('error')}}
                </div>
            @endif    
<div class="panel panel-profile">
<div class="clearfix">
<!-- LEFT COLUMN -->
<div class="profile-left">

    <!-- PROFILE HEADER -->
    <div class="profile-header">
        <div class="overlay"></div>
        <div class="profile-main">
            <img src="{{$siswa->getAvatar()}}" width="200px" class="img-circle" alt="Avatar">
            <h3 class="name">{{$siswa->nama_depan}}</h3>
            <span class="online-status status-available">Available</span>
        </div>
        <div class="profile-stat">
            <div class="row">
                <div class="col-md-4 stat-item">
                    {{count($siswa->mapel)}} <span>Mata Pelajaran</span>
                </div>
                <div class="col-md-4 stat-item">
                    15 <span>Awards</span>
                </div>
                <div class="col-md-4 stat-item">
                    2174 <span>Points</span>
                </div>
            </div>
        </div>
    </div>
    <!-- END PROFILE HEADER -->

    <!-- PROFILE DETAIL -->
    <div class="profile-detail">
        <div class="profile-info">
            <h4 class="heading">Data Diri</h4>
            <ul class="list-unstyled list-justify">
                <li>Jenis Kelamin <span>{{$siswa->jenis_kelamin}}</span></li>
                <li>Agama <span>{{$siswa->agama}}</span></li>
                <li>Alamat <span>{{$siswa->alamat}}</span></li>
            </ul>
        </div>
     
        <div class="text-center"><a href="/siswa/edit/{{$siswa->id}}" class="btn btn-warning">Edit Profile</a></div>
    </div>
    <!-- END PROFILE DETAIL -->
</div>
<!-- END LEFT COLUMN -->

<!-- RIGHT COLUMN -->
<div class="profile-right">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Tambah Nilai
    </button>

    <!-- AWARDS -->
   
    <!-- END AWARDS -->

    <!-- TABBED CONTENT -->
    <div class="custom-tabs-line tabs-line-bottom left-aligned">
        <ul class="nav" role="tablist">
            <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Aktivitas Terakhir</a></li>
        </ul>
    </div>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Mata Pelajaran</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Semester</th>
                        <th>Nilai</th>
                        <th>Guru</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswa->mapel as $mapel)    
                    <tr>
                        <td>{{$mapel->kode}}</td>
                        <td>{{$mapel->nama}}</td>
                        <td>{{$mapel->semester}}</td>
                        <td>
                          <a href="#" class="username" data-type="text" data-pk="{{$mapel->id}}" data-url="/api/siswa/editnilai/{{$siswa->id}}" data-title="Masukkan Nilai!">{{$mapel->pivot->nilai}}</a>
                        </td>
                        <td><a href="/guru/profile/{{$mapel->guru->id}}">{{$mapel->guru->nama}}</a></td>
                        <td>
                            <a href="/siswa/deletenilai/{{$siswa->id}}/{{$mapel->id}}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END TABBED CONTENT -->
    <div class="panel">
        <div id="chartNilai">

        </div>
    </div>
</div>
<!-- END RIGHT COLUMN -->
</div>
</div>

        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/siswa/addnilai/{{$siswa->id}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="mapel">Mata Pelajaran</label>
                    <select class="form-control" name="mapel_id" id="mapel">
                      @foreach ( $mapels as $mp )
                        <option value="{{$mp->id}}">{{$mp->nama}}</option>
                      @endforeach  
                    </select>
                </div>
                <div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}}">
                  <label for="nilai">Nilai</label>
                   <input type="text" class="form-control" value="{{old('nilai')}}" name="nilai" id="nilai" aria-describedby="emailHelp">
                  @if($errors->has('nilai'))
                      <span class="help-block">{{$errors->first('nilai')}}</span>
                  @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>    
        </div>
      </div>
    </div>
  </div>
@endsection
@section('footer')
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        Highcharts.chart('chartNilai', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Laporan Nilai Siswa'
    },
    
    xAxis: {
        categories: {!!json_encode($categories)!!},
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Nilai'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        
        name: 'Nilai',
        data: {!!json_encode($data_nilai)!!}

    }]
});

$(document).ready(function() {
    $('.username').editable();
});   
    </script>
@endsection