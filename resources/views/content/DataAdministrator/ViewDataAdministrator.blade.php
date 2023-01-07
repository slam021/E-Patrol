@inject('DataPersonnel', 'App\Http\Controllers\DataPersonnelController')

@extends('adminlte::page')

@section('title', 'KAROTA KING')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('data-personnel') }}">Data Personil</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Data Personil</li>
    </ol>
</nav>

@stop

@section('content')

<h3 class="page-title">
    <b>View Data Personil</b> <small>Data Lengkap Personil </small>
</h3>
<br />

@if(session('msg'))
<div class="alert alert-success" role="alert">
    {{session('msg')}}
</div>
@endif
<div class="card border border-dark">
    <div class="card-header bg-dark clearfix">
        <h5 class="mb-0 float-left">
            Daftar Personil
        </h5>
        <div class="form-actions float-right">
            <button onclick="location.href='{{ url('data-admin') }}'" name="Find" class="btn btn-sm btn-info" title=""><i class="fas fa-arrow-left"></i> Kembali</button>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <!-- <th width="5%" style='text-align:center'>User ID</th> -->
                        <th width="5%" style='text-align:center'>No</th>
                        <th width="13%" style='text-align:center'>Nama Lengkap</th>
                        <th width="13%" style='text-align:center'>Nama Panggilan</th>
                        <th width="13%" style='text-align:center'>NIK</th>
                        <th width="13%" style='text-align:center'>Kelamin</th>
                        <th width="15%" style='text-align:center'>Alamat</th>
                        <th width="15%" style='text-align:center'>Tempat Lahir</th>
                        <th width="15%" style='text-align:center'>Tanggal Lahir</th>
                        <th width="5%" style='text-align:center'>No Telp</th>
                        <th width="5%" style='text-align:center'>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataadmins as $index => $dataadmin)
                    <tr>
                        <!-- <td style='text-align:center'>{{$dataadmin['user_id']}}</td> -->
                        <td style='text-align:center'>{{ $index + 1 }}.</td>
                        <td>{{$dataadmin['full_name']}}</td>
                        <td>{{$dataadmin['nick_name']}}</td>
                        <td>{{$dataadmin['nik']}}</td>
                        <td>{{$dataadmin['gender']}}</td>
                        <td>{{$dataadmin['address']}}</td>
                        <td>{{$dataadmin['birth_place']}}</td>
                        <td>{{$dataadmin['birth_date']}}</td>
                        <td>{{$dataadmin['phone_number']}}</td>
                        <td>{{$dataadmin['email']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop