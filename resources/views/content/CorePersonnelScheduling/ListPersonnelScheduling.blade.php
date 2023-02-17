@inject('CorePersonnelScheduling', 'App\Http\Controllers\CorePersonnelSchedulingController')

@extends('adminlte::page')

@section('title', 'E-Patrol Security')
<link rel="shortcut icon" href="{{ asset('resources/assets/logo_epatrol.ico') }}" />

@section('content_header')

<div style="padding-bottom: 35px;">
    {{-- <h3 class="page-title float-left">
        <b>Data Personil</b>
    </h3> --}}
    <div class="float-left">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Penjadwalan Personil</li>
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
    <div class="card-header bg-dark clearfix">
        <h5 class="mb-0 float-left">
            Mengelola Jadwal Patroli
        </h5>
        {{-- <div class="form-actions float-right">
            <button onclick="location.href='{{ url('patrol-schedule/create-patrol-schedule') }}'" name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Jadwal Patroli</button>
        </div> --}}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <!-- <th width="5%" style='text-align:center'>User ID</th> -->
                        <th width="2%" style='text-align:center'>No</th>
                        <th width="12%" style='text-align:center'>Nama Patroli</th>
                        <th width="5%" style='text-align:center'>Hari</th>
                        <th width="30%" style='text-align:center'>Deskripsi Tugas</th>
                        <th width="12%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $list_hari = array(
                        0 => '',
                        1 => 'Senin',
                        2 => 'Selasa',
                        3 => 'Rabu',
                        4 => 'Kamis',
                        5 => 'Jumat',
                        6 => 'Sabtu',
                        7 => 'Minggu',
                    );
                    ?>

                    <tr>
                        @foreach($personnel_schedulings as $index => $val)
                        <td style='text-align:center'>{{ $index + 1 }}</td>
                        <td>{{$val['patrol_name']}}</td>
                        <td>{{ $list_hari[$val['day']] }}</td>
                        <td>{{$val['description']}}</td>
                        <td>
                            <div class="text-center">
                                <a type="button" class="btn btn-outline-info btn-sm" href="{{ url('/personnel-scheduling/view-personnel-scheduling/'.$val['patrol_id']) }}" title="Edit"><i class="far fa-edit"></i> Tambah ke Personil</a>
                                {{-- <a type="button" class="btn btn-outline-danger btn-sm" href="{{ url('/patrol-schedule/delete-patrol-schedule/'.$patrol['patrol_id']) }}" title="Delete"><i class="fas fa-trash-alt"></i> Hapus</a> --}}
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