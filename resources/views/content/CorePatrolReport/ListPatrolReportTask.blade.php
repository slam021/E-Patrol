

@extends('adminlte::page')

@section('title', 'E-Patrol Security')

@section('content_header')

<div style="padding-bottom: 35px;">
    <!-- <h3 class="page-title float-left">
        <b>Jadwal Patroli</b>
    </h3> -->
    <div class="float-left">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('patrol-report') }}">Laporan Patroli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Tugas Patroli</li>
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
            Mengelola Laporan Tugas Patroli
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('patrol-report') }}'" name="Find" class="btn btn-sm btn-secondary" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <!-- <th width="5%" style='text-align:center'>User ID</th> -->
                        <th width="3%" style='text-align:center'>No</th>
                        <th width="15%" style='text-align:center'>Tugas Patroli</th>
                        <th width="3%" style='text-align:center'>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reporttasks as $index => $task)
                    <tr>
                        <td style='text-align:center'>{{ $index + 1 }}.</td>
                        <td>{{$task['task_id']}}</td>
                        <td class="form-check-input" type="checkbox" value="" id="defaultCheck1">{{$task['task_state']}}</td>
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