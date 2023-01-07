@inject('DataAdministrator', 'App\Http\Controllers\DataAdministratorController')

@extends('adminlte::page')

@section('title', 'E-Patrol Security')

@section('content_header')

<div style="padding-bottom: 35px;">
    <div class="float-left">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Administrator</li>
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
            Mengelola Data Administrator
        </h5>
        <div class="form-actions float-right">
            <button onclick="location.href='{{ url('data-admin/create-admin') }}'" name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Administrator Baru</button>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <!-- <th width="5%" style='text-align:center'>User ID</th> -->
                        <th width="3%" style='text-align:center'>No</th>
                        <th width="15%" style='text-align:center'>Nama Lengkap</th>
                        <th width="10%" style='text-align:center'>NIK</th>
                        <th width="15%" style='text-align:center'>Alamat</th>
                        <th width="8%" style='text-align:center'>Kelamin</th>
                        <th width="5%" style='text-align:center'>No Telp</th>
                        <th width="10%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataadmins as $index => $dataadmin)
                    <tr>
                        <!-- <td style='text-align:center'>{{$dataadmin['user_id']}}</td> -->
                        <td style='text-align:center'>{{ $index + 1 }}.</td>
                        <td>{{$dataadmin['full_name']}}</td>
                        <td>{{$dataadmin['nik']}}</td>
                        <td>{{$dataadmin['address']}}</td>
                        <td>{{$dataadmin['gender']}}</td>
                        <td>{{$dataadmin['phone_number']}}</td>
                        <td>
                            <div class="text-center">
                                <a type="button" class="btn btn-outline-primary btn-sm" href="/data-admin/view-admin" title="View Detail"><i class="far fa-eye"></i> </a>
                                <a type="button" class="btn btn-outline-warning btn-sm" href="{{ url('/data-admin/edit-admin/'.$dataadmin['user_id']) }}" title="Edit"><i class="far fa-edit"></i> </a>
                                <a type="button" class="btn btn-outline-danger btn-sm" href="{{ url('/data-admin/delete-admin/'.$dataadmin['user_id']) }}" title="Delete"><i class="fas fa-trash-alt" style="font-size:17.5px"></i> </a>
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