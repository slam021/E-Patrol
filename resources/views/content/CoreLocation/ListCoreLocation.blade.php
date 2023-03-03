@inject('CoreLocation', 'App\Http\Controllers\CoreLocationController')

@extends('adminlte::page')

@section('title', 'E-Patrol Security')
<link rel="shortcut icon" href="{{ asset('resources/assets/logo_epatrol.ico') }}" />

@section('content_header')

    {{-- <h3 class="page-title float-left">
        <b>Titik Koordinat & Waktu Patroli</b>
    </h3> --}}
    <div class="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lokasi Patroli</li>
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
            Mengelola Lokasi Patroli
        </h5>
        <div class="form-actions float-right">
            <button onclick="location.href='{{ url('location/add-location') }}'" name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Lokasi Patroli</button>
        </div>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-sm table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <!-- <th width="5%" style='text-align:center'>User ID</th> -->
                        <th width="3%" style='text-align:center'>No</th>
                        <th width="10%" style='text-align:center'>Lokasi</th>
                        <th width="10%" style='text-align:center'>Longtitude</th>
                        <th width="10%" style='text-align:center'>Latitude</th>
                        <th width="7%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($corelocation as $key => $val)
                    <tr>
                        <td style='text-align:center'>{{ $key + 1 }}.</td>
                        <td>{{$val['location_name']}}</td>
                        <td>{{$val['location_longtitude']}}</td>
                        <td>{{$val['location_latitude']}}</td>
                        <td>
                            <div class="text-center">
                                <a type="button" class="badge bg-warning" href="{{ url('/location/edit-location/'.$val['location_id']) }}" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                                <a type="button" class="badge bg-primary" href="{{ url('/location/print-qr/'.$val['location_id']) }}" title="QR Code"><i class="fa fa-qrcode"></i> QR Code</a>
                                <a type="button" class="badge bg-danger" href="{{ url('/location/delete-location/'.$val['location_id']) }}" title="Delete"><i class="fas fa-trash-alt"></i> Hapus</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
                @if (empty($val['location_id']))
                @else
                <a href="{{ url('/location/print-all-qr/'.$val['location_id']) }}" type="button" name="Print All" class="mb-4 btn btn-primary btn-sm" title="Print All"><i class="fa fa-qrcode"></i> Print Semua QR Code</a>
                @endif
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