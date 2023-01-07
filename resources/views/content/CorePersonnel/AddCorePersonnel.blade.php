@extends('adminlte::page')

@section('title', 'E-Patrol')

@section('content_header')

<div style="padding-bottom: 28px;">
    {{-- <h3 class="page-title float-left">
        <b> Tambah Data Personil </b>
    </h3> --}}
    <div class="float-left">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('personnel') }}">Data Personill</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data Personil</li>
        </ol>
    </div>
</div>
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
            Form Tambah Personil
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ route('personnel') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>

    <form method="post" action="{{ route('process-add-personnel')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Nama Lengkap<a class='red'> *</a></a>
                        <input class="form-control input-bb type="text" name="personnel_full_name" id="personnel_full_name" value="{{old('personnel_full_name')}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Nama Panggilan<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="personnel_nick_name" id="personnel_nick_name" value="{{old('personnel_nick_name')}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">NIK<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="personnel_nik" id="personnel_nik" value="{{old('personnel_nik')}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Alamat<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="personnel_address" id="personnel_address" value="{{old('personnel_address')}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Tempat Lahir<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="personnel_birth_place" id="personnel_birth_place" value="{{old('personnel_birth_place')}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Tanggal Lahir<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="date" data-date-format="dd/mm/yyyy" name="personnel_birth_date" id="personnel_birth_date" value="{{old('personnel_birth_date')}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Kelamin<a class='red'> *</a></a>
                        {!! Form::select('personnel_gender', $gender, '', ['class' => 'selection-search-clear select-form', 'name' => 'personnel_gender', 'id' => 'personnel_gender']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">No Telp<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="personnel_phone" id="personnel_phone" value="{{old('personnel_phone')}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">No Telp Keluarga<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="personnel_phone_family" id="personnel_phone_family" value="{{old('personnel_phone_family')}}" autocomplete="off"/>
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