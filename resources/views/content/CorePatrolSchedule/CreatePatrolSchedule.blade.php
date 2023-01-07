@inject('CorePatrolSchedule', 'App\Http\Controllers\CorePatrolScheduleController')

@extends('adminlte::page')

@section('title', 'E-PATROL | Tambah Jadwal Patroli')
@section('js')
<script>

    function createPatrolScheduleAjax() {
        var hour                       = document.getElementById("hour").value;
        var patrol_location_id              = document.getElementById("patrol_location_id").value;

        $.ajax({
            type: "POST",
            url: "{{route('create-patrol-schedule-ajax')}}",
            data: {
                'hour'                  : hour,
                'patrol_location_id'         : patrol_location_id,
                '_token'                : '{{csrf_token()}}'
            },
            success: function(msg) {
                location.reload();
            }
        });
    }

    function createPatrolElementAjax(name, value) {
        console.log("name " + name);
        console.log("value " + value);

        $.ajax({
            type: "POST",
            url: "{{route('create-patrol-element-ajax')}}",
            data: {
                'name': name,
                'value': value,
                '_token': '{{csrf_token()}}'
            },
            success: function(msg) {}
        });
    }

    function createReset() {
        $.ajax({
            type: "GET",
            url: "{{route('create-reset')}}",
            success: function(msg) {
                location.reload();
            }

        });
    }

    $(document).ready(function(){
        var patrol_location_id        = {!! json_encode($patrol_location_id) !!};
        
        if(patrol_location_id == null){
            $("#patrol_location_id").select2("val", "0");
        }
    });
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
            <li class="breadcrumb-item"><a href="{{ url('patrol-schedule') }}">Jadwal Patroli</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Jadwal Patroli</li>
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
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Tambah Jadwal Patroli
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('patrol-schedule') }}'" name="Find" class="btn btn-sm btn-secondary" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>

    <?php
        if (empty($core_patrol)) {
            $core_patrol['patrol_name'] = '';
            $core_patrol['description'] = '';
            $core_patrol["day"] = '';

        }
    ?>

    <form method="post" action="/patrol-schedule/store-patrol-schedule" enctype="multipart/form-data">
        @csrf

        <div class="card-body">
            <h5 class="page-title float-left">
                <b> Tambah Deskripsi Jadwal Patroli </b>
            </h5> <br> <br>
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Patroli<a class='red'> *</a></a>
                        <input class="form-control input-bb @error('patrol_name') is-invalid @enderror" type="text" name="patrol_name" id="patrol_name" value="{{$core_patrol['patrol_name']}}" onChange="createPatrolElementAjax(this.name, this.value);" autocomplete="" required/>
                        @error('patrol_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Hari<a class='red'> *</a></a>
                        <?php
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
                        ?>
                        {!! Form::select('day',$day, $core_patrol["day"], ['class' => 'selection-search-clear select-form', 'name' => 'day', 'id' => 'day', 'onChange'=>'createPatrolElementAjax(this.name, this.value);', 'required' ] )!!}

                        {{-- <input class="form-control input-bb  @error('day') is-invalid @enderror" type="text" name="day" id="day" value="{{$core_patrol['day']}}" onChange="createPatrolElementAjax(this.name, this.value);" autocomplete="" />
                        @error('day')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Deskripsi<a class='red'> *</a></a>
                        <input class="form-control input-bb  @error('description') is-invalid @enderror" type="text" name="description" id="description" value="{{$core_patrol['description']}}" onChange="createPatrolElementAjax(this.name, this.value);" autocomplete="" required/>
                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <h5 class="page-title float-left">
                <b> Tambah Detail Jadwal Patroli </b>
            </h5> <br> <br>
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Jam<a class='red'> *</a></a>
                        <input class="form-control input-bb @error('hour') is-invalid @enderror" type="time" name="hour" id="hour" value="{{old('hour')}}"  />
                        @error('hour')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Lokasi<a class='red'> *</a></a>
                        {{-- {!! Form::select('location_name',$data_location, $location_name, ['class' => 'selection-search-clear select-form', 'name' => 'location_name', 'id' => 'location_name' ] )!!} --}}
                        <select class="selection-search-clear select-form" id="patrol_location_id">
                        <option value=""></option>
                        @foreach ($data_location as $patrol_location_id => $location_name)
                            <option value="{{$patrol_location_id}}">{{$location_name}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="float-right">
                <a type="submit" name="add" class="btn btn-info" title="Add" onclick="createPatrolScheduleAjax()"><i class="fas fa-plus"></i> Tambah</a>
            </div>
        </div>
</div>
<div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Detail Jadwal Patroli
        </h5>
    </div>
    <div class="card-body">
        <div class="form-body form">
            <div class="row">
                <h5 class="ml-2 form-section"><b>Daftar Jam & Titik Koordinat </b></h5>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-advance table-hover" id="table-child">
                    <thead class="thead-light">
                        <tr>
                            <th width="3%" style='text-align:center'>No</th>
                            <th width="7%" style='text-align:center'>Jam</th>
                            <th width="7%" style='text-align:center'>Lokasi</th>
                            <th width="3%" style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $receipt_amount_total = 0;
                        if (!is_array($core_patrol_item)) {
                            echo "<tr><th colspan='5' style='text-align  : center !important;'>Belum Ada Data</th></tr>";
                        } else {
                            $i=1;
                            foreach ($core_patrol_item as $key => $val) {
                                echo "
                                            <tr>
                                                <td style='text-align  : center !important;'>" . $i . "</td>
                                                <td style='text-align  : left !important;'>" . $val['hour'] . "</td>
                                                <td style='text-align  : left !important;'>" .$CorePatrolSchedule->getLocationName($val['patrol_location_id'])  . "</td>

                                                <td style='text-align  : center'>
                                                    <a href='/patrol-schedule/delete-patrol-schedule-ajax/" . $key . "' name='Reset' class='btn btn-outline-danger btn-sm' title='Delete' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")'><i class='fas fa-trash-alt'></i> Hapus</a>
                                                </td>
                        
                                                <input type='hidden' name='hour[]' value=".$val['hour']." >
                                                <input type='hidden' name='patrol_location_id[]' value=".$val['patrol_location_id']." >
                                        </tr>";
                                    $i++;
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer text-muted">
        <div class="form-actions float-right">
            <button type="reset" name="Reset" class="btn btn-danger" title="Reset" onclick="createReset();"><i class="fa fa-times"></i> Batal</button>
            <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
        </div>
    </div>
</div>
</form>

<br>
<br>
@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop