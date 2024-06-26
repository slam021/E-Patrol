@extends('adminlte::page')

@section('title', 'E-Patrol Security')
<link rel="shortcut icon" href="{{ asset('resources/assets/logo_epatrol.ico') }}" />

@section('content_header')

    <nav class="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('shift') }}">Data Shift</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Data Shift</li>
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

<div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Tambah Data Shift
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('/shift') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>

    <form method="post" action="{{ route('process-add-shift')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Shift<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="shift_name" id="shift_name" value="{{old('shift_name')}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Jam Mulai<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="time" name="shift_start_hours" id="shift_start_hours" value="{{old('shift_start_hours')}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Jam Selesai<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="time" name="shift_end_hours" id="shift_end_hours" value="{{old('shift_end_hours')}}" autocomplete="off"/>
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