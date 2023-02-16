@extends('adminlte::page')

@section('title', 'KAROTA KING')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">

    </ol>
</nav>

    <div class="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('desc-patrol') }}">Deskripsi Tugas Patroli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Deskripsi Tugas Patroli</li>
        </ol>
    </div>
@stop
@section('content')

@if(session('msg'))
<div class="alert alert-success" role="alert">
    {{session('msg')}}
</div>
@endif

@php
    $days = [
        '' => '',
        '1' => 'Senin',
        '2' => 'Selasa',
        '3' => 'Rabu',
        '4' => 'Kamis',
        '5' => "Jum'at",
        '6' => 'Sabtu',
        '7' => 'Minggu',
        
    ];
@endphp

<div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Tambah Deskripsi Tugas Patroli
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('desc-patrol') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>
    <form method="post" action="/desc-patrol/store-desc-patrol" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Lokasi Patroli<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="patrol_name" id="patrol_name" value="{{old('patrol_name')}}" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Hari<a class='red'> *</a></a>
                        {!! Form::select('day', $days, '', ['class' => 'selection-search-clear select-form', 'name' => 'day', 'id' => 'day']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Deskripsi<a class='red'> *</a></a>
                        <input class="form-control input-bb  @error('description') is-invalid @enderror" type="text" name="description" id="description" value="{{old('description')}}" />
                        @error('description')
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