@inject('CorePatrolReport', 'App\Http\Controllers\CorePatrolReportController')

@extends('adminlte::page')

@section('title', 'E-Patrol Security')
<link rel="shortcut icon" href="{{ asset('resources/assets/logo_epatrol.ico') }}" />

@section('content_header')

<div style="padding-bottom: 35px;">
    <!-- <h3 class="page-title float-left">
        <b>Jadwal Patroli</b>
    </h3> -->
    <div class="float-left">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Patroli</li>
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
            Mengelola Laporan Patroli
        </h5>
        <div class="form-actions float-right">
            {{-- <button onclick="location.href=''" name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Deskripsi Patroli Baru</button> --}}
        </div>
    </div>
    <form action="{{ url('/patrol-report/upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image"> 
        <input type="submit" value="Upload"/>
    </form>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <!-- <th width="5%" style='text-align:center'>User ID</th> -->
                        <th width="3%" style='text-align:center'>No</th>
                        <th width="3%" style='text-align:center'>ID Patroli</th>
                        <th width="3%" style='text-align:center'>ID Item</th>
                        <th width="12%" style='text-align:center'>Nama Personil</th>
                        <th width="10%" style='text-align:center'>No Telp</th>
                        <th width="10%" style='text-align:center'>Foto</th>
                        <th width="7%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patrolreports as $index => $patrol)
                    <tr>
                        <td style='text-align:center'>{{ $index + 1 }}.</td>
                        <td>{{$patrol['patrol_id']}}</td>
                        <td>{{$patrol['patrol_item_id']}}</td>
                        <td>{{$patrol['full_name']}}</td>
                        <td>{{$patrol['phone_number']}}</td>
                        {{-- <td>{{$patrol['photos']}}</td> --}}
                        <td><img width="150px" src="{{ url('/images/'.$patrol['photos']) }}"></td>
                        <td>
                            <div class="text-center">
                                <a type="button" class="btn btn-outline-dark btn-sm" href="{{ url('/patrol-report/patrol-report-task/'.$patrol['patrol_report_id']) }}" title="Report Task"><i class="fas fa-tasks"></i> Laporan Tugas</a>
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