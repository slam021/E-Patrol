@extends('adminlte::page')

@section('title', 'KAROTA KING')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">

    </ol>
</nav>


<div style="padding-bottom: 35px;">
    {{-- <h3 class="page-title float-left">
        <b> Tambah Deskripsi Tugas Patroli </b>
    </h3> --}}
    <div class="float-left">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('desc-patrol') }}">Deskripsi Tugas Patroli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Deskripsi Tugas Patroli</li>
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
                        <a class="text-dark">Jenis Patroli<a class='red'> *</a></a>
                        <input class="form-control input-bb" @error('patrol_name') is-invalid @enderror" type="text" name="patrol_name" id="patrol_name" value="{{old('patrol_name')}}" />
                        @error('patrol_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Hari<a class='red'> *</a></a>
                        <select class="form-control" type="text" name="day" id="day" value="{{old('day')}}">
                            <option value="">--Pilih Hari--</option>
                            <option value="1">Senin</option>
                            <option value="2">Selasa</option>
                            <option value="3">Rabu</option>
                            <option value="4">Kamis</option>
                            <option value="5">Jumat</option>
                            <option value="6">Sabtu</option>
                            <option value="7">Minggu</option>
                        </select>
                        @error('day')
                        <p class="text-danger" style="font-size:13px">{{$message}}</p>
                        @enderror
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