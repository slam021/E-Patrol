@inject('CoreShift', 'App\Http\Controllers\CoreShiftController')

@extends('adminlte::page')

@section('title', 'E-Patrol Security')
<link rel="shortcut icon" href="{{ asset('resources/assets/logo_epatrol.ico') }}" />

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ route('personnel') }}">Data Shift</a></li>
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
    <div class="card-header bg-dark clearfix">
        <h5 class="float-left">
            Mengelola Data Shift
        </h5>
        <div class="form-actions float-right">
            <button onclick="location.href='{{ route('add-shift') }}'" name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Data Shift</button>
        </div>
    </div>

    <div class="card-body table-responsive">
        <div class="table-responsive">
            <table id="example" class="table table-sm table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <!-- <th width="5%" style='text-align:center'>User ID</th> -->
                        <th width="3%" style='text-align:center'>No</th>
                        <th width="20%" style='text-align:center'>Nama Shift</th>
                        <th width="10%" style='text-align:center'>Jam Mulai</th>
                        <th width="10%" style='text-align:center'>Jam Selesai</th>
                        <th width="5%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($core_shift as $key => $val)
                    <tr>
                        <td style='text-align:center'>{{ $key + 1 }}.</td>
                        <td>{{$val['shift_name']}}</td>
                        <td>{{$val['shift_start_hours']}}</td>
                        <td>{{$val['shift_end_hours']}}</td>
                        <td>
                            <div class="text-center">
                                <a type="button" class="badge bg-warning" href="{{ url('/shift/edit-shift/'.$val['shift_id']) }}" title="Edit"><i class="far fa-edit"></i> Edit</a>
                                {{-- <a type="button" class="badge bg-lime" href="{{ url('shift/detail/'.$val->shift_id)}}" title="Detail"><i class="fas fa-list-ul"></i> Detail</a> --}}
                                <a type="button" class="badge bg-danger" href="{{ url('/shift/delete-shift/'.$val->shift_id)}}" title="Delete"><i class="fas fa-trash-alt"></i> Hapus</a>
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