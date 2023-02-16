@inject('CS', 'App\Http\Controllers\CoreScheduleController')

@extends('adminlte::page')

@section('title', 'E-Patrol')

@section('content_header')
    {{-- <h3 class="page-title float-left">
        <b>Deskripsi Tugas Patroli</b>
    </h3> --}}
    <div class="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jadwal Patroli</li>
        </ol>
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

<div class="card border border-dark">
    <div class="card-header bg-dark clearfix">
        <h5 class="mb-0 float-left">
            Mengelola Jadwal Patroli
        </h5>
        <div class="form-actions float-right">
            <button onclick="location.href='{{ url('schedule/add-schedule') }}'" name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Jadwal Patroli</button>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive table-full-width">
            <table id="example" class="table-sm table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <!-- <th width="5%" style='text-align:center'>User ID</th> -->
                        <th width="3%" style='text-align:center'>No</th>
                        <th width="15%" style='text-align:center'>Lokasi</th>
                        <th width="10%" style='text-align:center'>Hari</th>
                        <th width="20%" style='text-align:center'>Deskripsi</th>
                        <th width="7%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $day = array(
                        1 => 'Senin',
                        2 => 'Selasa',
                        3 => 'Rabu',
                        4 => 'Kamis',
                        5 => 'Jumat',
                        6 => 'Sabtu',
                        7 => 'Minggu',
                    );
                    @endphp
                    @foreach($core_schedule as $key => $val)
                    <td style='text-align:center'>{{ $key + 1 }}.</td>
                    <td>{{$CS->getLocationName($val['location_id'])}}</td>
                    <td>{{$day[$val['schedule_day']]}}</td>
                    <td>{{$val['schedule_description']}}</td>
                    <td>
                        <div class="text-center">
                            <a type="button" class="badge bg-warning" href="{{ url('/schedule/edit-schedule/'.$val['schedule_id']) }}" title="Edit"><i class="far fa-edit"></i> Edit</a>
                            <a type="button" class="badge bg-indigo" href="{{ url('/schedule/add-shift/'.$val['schedule_id']) }}" title="Add Shift"><i class="far fa-clock"></i> Shift</a> 
                            <a type="button" class="badge bg-lime" href="{{ url('/schedule/detail-schedule/'.$val['schedule_id']) }}" title="Detail"><i class="fas fa-list"></i> Detail</a>
                            <a type="button" class="badge bg-danger" href="{{ url('/schedule/delete-schedule/'.$val['schedule_id']) }}" title="Delete"><i class="fas fa-trash-alt"></i> Hapus</a>
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