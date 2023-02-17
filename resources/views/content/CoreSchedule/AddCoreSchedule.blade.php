@inject('CS', 'App\Http\Controllers\CoreScheduleController')

@extends('adminlte::page')

@section('title', 'E-Patrol Security')
<link rel="shortcut icon" href="{{ asset('resources/assets/logo_epatrol.ico') }}" />
@section('js')
<script>

</script>
@endsection
@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">

    </ol>
</nav>


<div style="padding-bottom: 35px;">
    <!-- <h3 class="page-title float-left">
        <b> Tambah Jadwal Patroli </b>
    </h3> -->
    <div class="float-left">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('schedule') }}">Jadwal Patroli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Jadwal Patroli</li>
        </ol>
    </div>
</div>
@stop
@section('content')

@if(session('msg'))
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    {{session('msg')}}
</div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

<div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Tambah Jadwal Patroli
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('schedule') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>

    <form method="post" action="{{route('process-add-schedule')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Lokasi<a class='red'> *</a></a>
                        <select class="selection-search-clear select-form" name="location_id" id="location_id">
                            <option value="">Select</option>
                            @foreach ($core_location as $location_id => $location_name)
                                <option value="{{$location_id}}">{{$location_name}}</option>
                            @endforeach
                            </select>
                            {{-- {!! Form::select('location_id',$core_location, 'null', ['class' => 'selection-search-clear select-form', 'name' => 'location_id', 'id' => 'location_id' ] )!!} --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Hari<a class='red'> *</a></a>
                        @php
                        $day = array(
                            ''  => 'Pilih Hari',
                            '1' => 'Senin',
                            '2' => 'Selasa',
                            '3' => 'Rabu',
                            '4' => 'Kamis',
                            '5' => 'Jumat',
                            '6' => 'Sabtu',
                            '7' => 'Minggu',
                        );
                        @endphp
                        {{-- {!! Form::select('schedule_day',$day, 'Select' , ['class' => 'selection-search-clear select-form', 'name' => 'schedule_day', 'id' => 'schedule_day', 'onChange'=>'createPatrolElementAjax(this.name, this.value);', '' ] )!!} --}}
                        <select class="selection-search-clear select-form" name="schedule_day" id="schedule_day">
                            <option value="">Select</option>
                            @foreach ($day as $key => $val)
                                <option value="{{$key}}">{{$val}}</option>
                            @endforeach
                            </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Deskripsi<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="schedule_description" id="schedule_description" value="{{old('schedule_descripton')}}" autocomplete="off" />
                
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" name="Reset" class="btn btn btn-sm  btn-danger" title="Reset" onclick="createReset();"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Save" class="btn btn-sm btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
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