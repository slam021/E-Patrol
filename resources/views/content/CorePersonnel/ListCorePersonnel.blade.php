@inject('CorePersonnel', 'App\Http\Controllers\CorePersonnelController')

@extends('adminlte::page')

@section('title', 'E-Patrol Security')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('personnel') }}">Data Personil</a></li>
    </ol>
</nav>

@stop

@section('content')

@if(session('msg'))
<div class="alert alert-success" role="alert">
    {{session('msg')}}
</div>
@endif

@php
    $gender = [
        '' => '',
        '1' => 'Laki-laki',
        '2' => 'Perempuan',
    ];
@endphp

<div class="card border border-dark">
    <div class="card-header bg-dark clearfix">
        <h5 class="float-left">
            Mengelola Data Personil
        </h5>
        <div class="form-actions float-right">
            <button onclick="location.href='{{ route('add-personnel') }}'" name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Data Personil</button>
        </div>
    </div>

    <div class="card-body table-responsive">
        <div class="table-responsive">
            <table id="example" class="table table-sm table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <!-- <th width="5%" style='text-align:center'>User ID</th> -->
                        <th width="3%" style='text-align:center'>No</th>
                        <th width="15%" style='text-align:center'>Nama Lengkap</th>
                        <th width="10%" style='text-align:center'>NIK</th>
                        <th width="15%" style='text-align:center'>Alamat</th>
                        <th width="8%" style='text-align:center'>Kelamin</th>
                        <th width="5%" style='text-align:center'>No Telp</th>
                        <th width="10%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($corepersonnel as $key => $val)
                    <tr>
                        <td style='text-align:center'>{{ $key + 1 }}.</td>
                        <td>{{$val['personnel_full_name']}}</td>
                        <td>{{$val['personnel_nik']}}</td>
                        <td>{{$val['personnel_address']}}</td>
                        <td>{{$gender[$val['personnel_gender']]}}</td>
                        <td>{{$val['personnel_phone']}}</td>
                        <td>
                            <div class="text-center">
                                <a type="button" class="badge bg-warning" href="{{ url('/personnel/edit-personnel/'.$val['personnel_id']) }}" title="Edit"><i class="far fa-edit"></i> Edit</a>
                                <a type="button" class="badge bg-lime" href="{{ url('personnel/detail/'.$val->personnel_id)}}" title="Detail"><i class="fas fa-list-ul"></i> Detail</a>
                                <a type="button" class="badge bg-danger" href="{{ url('/personnel/delete-personnel/'.$val->personnel_id)}}" title="Delete"><i class="fas fa-trash-alt"></i> Hapus</a>
                            </div>
                        </td>
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