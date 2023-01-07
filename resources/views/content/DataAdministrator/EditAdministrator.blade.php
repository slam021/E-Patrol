@extends('adminlte::page')

@section('title', 'KAROTA KING')

@section('content_header')

<div style="padding-bottom: 35px;">
    <div class="float-left">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('data-personnel') }}">Data Administrator</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data Administrator</li>
        </ol>
    </div>
</div>

@stop

@section('content')

@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@endif
<div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Edit Administrator
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('data-admin') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>

    <form method="post" action="{{ url('data-admin/'.$editadmins['user_id'])}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Lengkap<a class='red'> *</a></a>
                        <input class="form-control input-bb  @error('full_name') is-invalid @enderror" type="text" name="full_name" id="full_name" value="{{$editadmins->full_name}}" />
                        @error('full_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Panggilan<a class='red'> *</a></a>
                        <input class="form-control input-bb  @error('nick_name') is-invalid @enderror" type="text" name="nick_name" id="nick_name" value="{{$editadmins->nick_name}}" />
                        @error('nick_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">NIK<a class='red'> *</a></a>
                        <input class="form-control input-bb  @error('nik') is-invalid @enderror" type="text" name="nik" id="nik" value="{{$editadmins->nik}}" />
                        @error('nik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Alamat<a class='red'> *</a></a>
                        <input class="form-control input-bb  @error('address') is-invalid @enderror" type="text" name="address" id="address" value="{{$editadmins->address}}" />
                        @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Tempat Lahir<a class='red'> *</a></a>
                        <input class="form-control input-bb  @error('birth_place') is-invalid @enderror" type="text" name="birth_place" id="birth_place" value="{{$editadmins->birth_place}}" />
                        @error('birth_place')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Tanggal Lahir<a class='red'> *</a></a>
                        <input class="form-control input-bb  @error('birth_date') is-invalid @enderror" type="date" name="birth_date" id="birth_date" value="{{$editadmins->birth_date}}" />
                        @error('birth_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Kelamin<a class='red'> *</a></a>
                        <?php
                        $gender = array(
                            'Laki-Laki' => 'Laki-Laki',
                            'Perempuan' => 'Perempuan'
                        );
                        ?>
                        {!! Form::select(0, $gender, $editadmins->gender, ['class' => 'selection-search-clear select-form', 'name' => 'gender', 'id' => 'gender']) !!}
                        <!-- <select class="form-control" type="text" name="gender" id="gender" value="{{ $editadmins->gender }}">
                            <option value="{{$editadmins->gender}}" selected>{{$editadmins->gender}}</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select> -->
                        @error('gender')
                        <p class="text-danger" style="font-size:13px">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">No Telp<a class='red'> *</a></a>
                        <input class="form-control input-bb  @error('phone_number') is-invalid @enderror" type="text" name="phone_number" id="phone_number" value="{{$editadmins->phone_number}}" />
                        @error('phone_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Email<a class='red'> *</a></a>
                        <input class="form-control input-bb  @error('email') is-invalid @enderror" type="text" name="email" id="email" value="{{$editadmins->email}}" />
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class=" card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop