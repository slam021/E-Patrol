@inject('CorePatrolItem', 'App\Http\Controllers\CorePatrolItemController')

@extends('adminlte::page')

@section('title', 'KAROTA KING')

@section('content_header')

<div style="padding-bottom: 35px;">
    {{-- <h3 class="page-title float-left">
        <b>Titik Koordinat & Waktu Patroli</b>
    </h3> --}}
    <div class="float-left">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Waktu & Titik Koordinat Patroli</li>
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
            Mengelola Titik Koordinat & Waktu Patroli
        </h5>
        <div class="form-actions float-right">
            <button onclick="location.href='{{ url('patrol-item/create-patrol-item') }}'" name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Detail Patroli</button>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <!-- <th width="5%" style='text-align:center'>User ID</th> -->
                        <th width="3%" style='text-align:center'>No</th>
                        <th width="3%" style='text-align:center'>Jenis Patroli</th>
                        <th width="8%" style='text-align:center'>Jam</th>
                        <th width="10%" style='text-align:center'>Longtitude</th>
                        <th width="10%" style='text-align:center'>Latitude</th>
                        <th width="10%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patrolitems as $index => $patrolitem)
                    <tr>
                        <td style='text-align:center'>{{ $index + 1 }}</td>
                        <td>{{$patrolitem['patrol_id']}}</td>
                        <td>{{$patrolitem['hour']}}</td>
                        <td>{{$patrolitem['longtitude']}}</td>
                        <td>{{$patrolitem['latitude']}}</td>
                        <td>
                            <div class="text-center">
                                <a type="button" class="btn btn-warning btn-sm" href="{{ url('/patrol-item/edit-patrol-item/'.$patrolitem['patrol_item_id']) }}" title="Edit"><i class="far fa-edit"></i> Edit</a>
                                <a type="button" class="btn btn-danger btn-sm" href="{{ url('/patrol-item/delete-patrol-item/'.$patrolitem['patrol_item_id']) }}" title="Delete"><i class="fas fa-trash-alt"></i> Hapus</a>
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