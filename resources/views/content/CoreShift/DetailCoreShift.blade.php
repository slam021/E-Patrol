
@extends('adminlte::page')

@section('title', 'E-Patrol Security')
<link rel="shortcut icon" href="{{ asset('resources/assets/logo_epatrol.ico') }}" />

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('personnel') }}">Data Personil</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Data Personil</li>
    </ol>
</nav>

@stop

@section('content')

{{-- <h3 class="page-title">
    <b>View Data Personil</b> <small>Data Lengkap Personil </small>
</h3>
<br /> --}}

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
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Detail Data Personil
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ route('personnel') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>

    <div class="card-body">
        <div class="row form-group">
            <div class="col-md-3">
                <div class="form-group">
                    <a class="text-dark">Nama Lengkap<a class='red'> *</a></a>
                    <input class="form-control input-bb type="text" name="personnel_full_name" id="personnel_full_name" value="{{$corepersonnel->personnel_full_name}}" readonly/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <a class="text-dark">Nama Panggilan<a class='red'> *</a></a>
                    <input class="form-control input-bb" type="text" name="personnel_nick_name" id="personnel_nick_name" value="{{$corepersonnel->personnel_nick_name}}" readonly/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <a class="text-dark">NIK<a class='red'> *</a></a>
                    <input class="form-control input-bb" type="text" name="personnel_nik" id="personnel_nik" value="{{$corepersonnel->personnel_nik}}" readonly/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <a class="text-dark">Alamat<a class='red'> *</a></a>
                    <input class="form-control input-bb" type="text" name="personnel_address" id="personnel_address" value="{{$corepersonnel->personnel_address}}" readonly/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <a class="text-dark">Tempat Lahir<a class='red'> *</a></a>
                    <input class="form-control input-bb" type="text" name="personnel_birth_place" id="personnel_birth_place" value="{{$corepersonnel->personnel_birth_place}}" readonly/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <a class="text-dark">Tanggal Lahir<a class='red'> *</a></a>
                    <input class="form-control input-bb" type="date" data-date-format="dd/mm/yyyy" name="personnel_birth_date" id="personnel_birth_date" value="{{$corepersonnel->personnel_birth_date}}" readonly/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <a class="text-dark">Kelamin<a class='red'> *</a></a>
                    <input class="form-control input-bb" type="text" name="personnel_gender" id="personnel_gender" value="{{$gender[$corepersonnel->personnel_gender]}}" readonly/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <a class="text-dark">No Telp<a class='red'> *</a></a>
                    <input class="form-control input-bb" type="text" name="personnel_phone" id="personnel_phone" value="{{$corepersonnel->personnel_phone}}" readonly/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <a class="text-dark">No Telp Keluarga<a class='red'> *</a></a>
                    <input class="form-control input-bb" type="text" name="personnel_phone_family" id="personnel_phone_family" value="{{$corepersonnel->personnel_phone_family}}" readonly/>
                </div>
            </div>
        </div>
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