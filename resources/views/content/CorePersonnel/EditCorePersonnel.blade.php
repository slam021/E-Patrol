@extends('adminlte::page')

@section('title', 'E-Patrol')

@section('content_header')

    <nav class="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('data-personnel') }}">Data Personil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data Personil</li>
        </ol>
    </nav>

@stop

@section('content')
@if(session('msg'))
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    {{session('msg')}}
</div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif
@if(session('msgerror'))
<div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    {{session('msgerror')}}
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
            Form Edit Personil
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('personnel') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>

    <form method="POST" action="{{ route('process-edit-personnel')}}">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Nama Lengkap<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="personnel_full_name" id="personnel_full_name" value="{{$corepersonnel->personnel_full_name}}" />
                        <input class="form-control input-bb" type="hidden" name="personnel_id" id="personnel_id" value="{{$corepersonnel->personnel_id}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Nama Panggilan<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="personnel_nick_name" id="personnel_nick_name" value="{{$corepersonnel->personnel_nick_name}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">NIK<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="personnel_nik" id="personnel_nik" value="{{$corepersonnel->personnel_nik}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Alamat<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="personnel_address" id="personnel_address" value="{{$corepersonnel->personnel_address}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Tempat Lahir<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="personnel_birth_place" id="personnel_birth_place" value="{{$corepersonnel->personnel_birth_place}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Tanggal Lahir<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="date" data-date-format="dd/mm/yyyy" name="personnel_birth_date" id="personnel_birth_date" value="{{$corepersonnel->personnel_birth_date}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Kelamin<a class='red'> *</a></a>
                        {!! Form::select('personnel_gender', $gender, $corepersonnel->personnel_gender, ['class' => 'selection-search-clear select-form', 'name' => 'personnel_gender', 'id' => 'personnel_gender']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">No Telp<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="personnel_phone" id="personnel_phone" value="{{$corepersonnel->personnel_phone}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">No Telp Keluarga<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="personnel_phone_family" id="personnel_phone_family" value="{{$corepersonnel->personnel_phone_family}}" autocomplete="off"/>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="float-right">
                    <button type="reset" name="Reset" class="btn btn-danger btn-sm" onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Save" class="btn btn-success btn-sm" title="Save"><i class="fa fa-check"></i> Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop