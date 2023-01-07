@inject('CorePatrolLocation', 'App\Http\Controllers\CorePatrolLocationController')

@extends('adminlte::page')

@section('title', 'E-Patrol')

@section('content_header')

<div style="padding-bottom: 28px;">
    {{-- <h3 class="page-title float-left">
        <b>Titik Koordinat & Waktu Patroli</b>
    </h3> --}}
    <div class="float-left">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lokasi Patroli</li>
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
            Mengelola Lokasi Patroli
        </h5>
        <div class="form-actions float-right">
            <button onclick="location.href='{{ url('patrol-location/create-patrol-location') }}'" name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Lokasi Patroli</button>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-sm table-striped table-bordered table-hover table-full-width">
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
                    @foreach($patrol_locations as $key => $val)
                    <tr>
                        <td style='text-align:center'>{{ $key + 1 }}</td>
                        <td>{{$val['location_name']}}</td>
                        <td>{{$val['longtitude']}}</td>
                        <td>{{$val['latitude']}}</td>
                        <td>
                            <div class="text-center">
                                <a type="button" class="badge bg-warning" href="{{ url('/patrol-location/edit-patrol-location/'.$val['patrol_location_id']) }}" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                                <a type="button" class="badge bg-primary" href="{{ url('/patrol-location/print-qr/'.$val['patrol_location_id']) }}" title="QR Code"><i class="fa fa-qrcode"></i> QR Code</a>
                                <a type="button" class="badge bg-danger" href="{{ url('/patrol-location/delete-patrol-location/'.$val['patrol_location_id']) }}" title="Delete"><i class="fas fa-trash-alt"></i> Hapus</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>  
            <div class="pt-1 float-right">
                @if (empty($val['patrol_location_id']))
                @else
                <a href="{{ url('/patrol-location/print-all-qr/'.$val['patrol_location_id']) }}" type="button" name="Print All" class="btn btn-primary btn-sm" title="Print All"><i class="fa fa-qrcode"></i> Print Semua QR Code</a>
                @endif
            </div>
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