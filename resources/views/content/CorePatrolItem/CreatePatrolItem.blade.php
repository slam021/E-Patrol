@extends('adminlte::page')

@section('title', 'E-Patrol Security')
<link rel="shortcut icon" href="{{ asset('resources/assets/logo_epatrol.ico') }}" />

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">

    </ol>
</nav>


<div style="padding-bottom: 35px;">
    {{-- <h3 class="page-title float-left">
        <b> Titik Koordinat & Waktu Patroli </b>
    </h3> --}}
    <div class="float-left">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('patrol-item') }}">Titik Koordinat & Waktu Patroli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Titik Koordinat & Waktu Patroli</li>
        </ol>
    </div>
</div>
@stop
@section('content')

@if(session('msg'))
<div class="alert alert-success" role="alert">
    {{session('msg')}}
</div>
@endif
<div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Tambah Titik Koordinat & Waktu Patroli
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('patrol-item') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>

    <form method="post" action="/patrol-item/store-patrol-item" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Jam<a class='red'> *</a></a>
                        <input class="form-control input-bb @error('hour') is-invalid @enderror" type="time" name="hour" id="hour" value="{{old('hour')}}" />
                        @error('hour')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Longtitude<a class='red'> *</a></a>
                        <input class="form-control input-bb @error('longtitude') is-invalid @enderror" type="text" name="longtitude" id="longtitude" value="{{old('longtitude')}}" />
                        @error('longtitude')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Latitude<a class='red'> *</a></a>
                        <input class="form-control input-bb  @error('latitude') is-invalid @enderror" type="text" name="latitude" id="latitude" value="{{old('latitude')}}" />
                        @error('latitude')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="float-right">
                    <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
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