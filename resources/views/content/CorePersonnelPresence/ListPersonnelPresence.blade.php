@inject('CorePersonnelPresence', 'App\Http\Controllers\CorePersonnelPresenceController')

@extends('adminlte::page')

@section('title', 'E-Patrol Security')
<link rel="shortcut icon" href="{{ asset('resources/assets/logo_epatrol.ico') }}" />
<link rel="shortcut icon" href="{{ asset('resources/assets/logo_epatrol.ico') }}" />

@section('content_header')

<div style="padding-bottom: 35px;">
    <!-- <h3 class="page-title float-left">
        <b>Jadwal Patroli</b>
    </h3> -->
    <div class="float-left">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Presensi</li>
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

@if(session('msg_err'))
<div class="alert alert-danger" role="alert">
    {{session('msg_err')}}
</div>
@endif

<div class="card border border-dark">
    <div class="card-header bg-dark clearfix">
        <h5 class="mb-0 float-left">
            Mengelola Presensi Personil
        </h5>
        <div class="form-actions float-right">
            {{-- <button onclick="location.href=''" name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Deskripsi Patroli Baru</button> --}}
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <!-- <th width="5%" style='text-align:center'>User ID</th> -->
                        <th width="3%" style='text-align:center'>No</th>
                        <th width="15%" style='text-align:center'>Nama Personil</th>
                        <th width="7%" style='text-align:center'>Jam Datang</th>
                        <th width="7%" style='text-align:center'>Jam Pulang</th>
                        <th width="5%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personnelpresences as $index => $presence)
                    <tr>
                        <td style='text-align:center'>{{ $index + 1 }}.</td>
                        <td>{{ $presence['full_name']}}</td>
                        <td>{{ $presence['come_time']}}</td>
                        <td>{{ $presence['home_time']}}</td>
                        <td>
                            <div class="text-center">
                                <a type="button" class="btn btn-outline-dark btn-sm" href="{{ url('/patrol-report/patrol-report-task/'.$patrol['patrol_report_id']) }}" title="Report Task"><i class="fas fa-tasks"></i> </a>
                                <a type="button" class="btn btn-outline-danger btn-sm" href="" title="Delete"><i class="fas fa-trash-alt" style="font-size:17.5px"></i> </a>
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