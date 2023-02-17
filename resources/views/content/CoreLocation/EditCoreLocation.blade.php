@extends('adminlte::page')

@section('title', 'E-Patrol Security')
<link rel="shortcut icon" href="{{ asset('resources/assets/logo_epatrol.ico') }}" />

@section('content_header')

    <div class="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('patrol-item') }}">Lokasi Patroli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Lokasi Patroli</li>
        </ol>
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
            Form Edit Lokasi Patroli
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('location') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>

    <form method="post" action="{{ url('location/process-edit-location')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Lokasi <a class='red'> *</a></a>
                        <input class="form-control input-bb " type="text" name="location_name" id="location_name" value="{{$corelocation->location_name}}" />
                        <input class="form-control input-bb " type="hidden" name="location_id" id="location_id" value="{{$corelocation->location_id}}" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Longtitude<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="location_longtitude" id="l_ongtitude" value="{{$corelocation->location_longtitude}}" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Latitude<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="location_latitude" id="location_latitude" value="{{$corelocation->location_latitude}}" />
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="float-right">
                    <button type="reset" name="Reset" class="btn btn-sm bg-danger" onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Save" class="btn btn-sm bg-success" title="Save"><i class="fa fa-check"></i> Simpan</button>
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