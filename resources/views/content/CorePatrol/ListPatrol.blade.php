@inject('CoreDescPatrol', 'App\Http\Controllers\CorePatrolController')

@extends('adminlte::page')

@section('title', 'KAROTA KING')

@section('content_header')

    {{-- <h3 class="page-title float-left">
        <b>Deskripsi Tugas Patroli</b>
    </h3> --}}
    <div class="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Deskripsi Tugas Patroli</li>
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
    <div class="card-header bg-dark clearfix">
        <h5 class="mb-0 float-left">
            Mengelola Jadwal Patroli
        </h5>
        <div class="form-actions float-right">
            <button onclick="location.href='{{ url('desc-patrol/create-desc-patrol') }}'" name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Jadwal Patroli</button>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-sm table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <!-- <th width="5%" style='text-align:center'>User ID</th> -->
                        <th width="3%" style='text-align:center'>No</th>
                        <th width="10%" style='text-align:center'>Jenis Patroli</th>
                        <th width="5%" style='text-align:center'>Hari</th>
                        <th width="25%" style='text-align:center'>Deskripsi</th>
                        <th width="10%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $list_hari = array(
                        1 => 'Senin',
                        2 => 'Selasa',
                        3 => 'Rabu',
                        4 => 'Kamis',
                        5 => 'Jumat',
                        6 => 'Sabtu',
                        7 => 'Minggu',
                    );
                    ?>
                    @foreach($patrols as $index => $patrol)
                    <tr>
                        <td style='text-align:center'>{{ $index + 1 }}.</td>
                        <td>{{$patrol['patrol_name']}}</td>
                        <td>{{ $list_hari[$patrol['day']] }}</td>
                        <td>{{$patrol['description']}}</td>
                        <td>
                            <div class="text-center">
                                <a type="button" class="badge bg-warning" href="{{ url('/desc-patrol/edit-desc-patrol/'.$patrol['patrol_id']) }}" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                                <a type="button" class="badge bg-danger" href="{{ url('/desc-patrol/delete-desc-patrol/'.$patrol['patrol_id']) }}" title="Delete"><i class="fas fa-trash-alt"></i> Hapus</a>
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