@inject('CorePatrolSchedule', 'App\Http\Controllers\CorePatrolScheduleController')

@extends('adminlte::page')

@section('title', 'E-PATROL | Edit Jadwal Patroli')
@section('js')
<script>

    function editPatrolScheduleAjax() {
        var hour             = document.getElementById("hour").value;
        var patrol_location_id    = document.getElementById("patrol_location_id").value;
        var patrol_id        = document.getElementById("patrol_id").value;

        $.ajax({
            type: "POST",
            url: "{{route('edit-patrol-schedule-ajax')}}",
            data: {
                'hour': hour,
                'patrol_location_id'     : patrol_location_id,
                'patrol_id'         : patrol_id,
                '_token'            : '{{csrf_token()}}'
            },
            success: function(msg) {
                location.reload();
            }
        });
    }

    function editReset() {
        $.ajax({
            type: "GET",
            url: "{{route('edit-reset', ['patrol_id' => $corepatrol['patrol_id']])}}",
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
            <li class="breadcrumb-item active" aria-current="page">Edit Jadwal Patroli</li>
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
            Form Edit Jadwal Patroli
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('patrol-schedule') }}'" name="Find" class="btn btn-sm btn-secondary" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>

    <form method="post" action="/patrol-schedule/update-patrol-schedule" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <h5 class="page-title float-left">
                <b> Edit Deskripsi Jadwal Patroli </b>
            </h5> <br> <br>
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Patroli<a class='red'> *</a></a>
                        <input class="form-control input-bb @error('patrol_name') is-invalid @enderror" type="text" name="patrol_name" id="patrol_name" value="{{$corepatrol['patrol_name']}}"  autocomplete="off" />
                        <input class="form-control input-bb" type="hidden" name="patrol_id" id="patrol_id" value="{{$corepatrol['patrol_id']}}" autocomplete="off"/>
                        @error('patrol_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <input class="form-control input-bb" type="hidden" name="patrol_id" id="patrol_id" value="{{$corepatrol['patrol_id']}}"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Hari<a class='red'> *</a></a>
                        <?php
                        $day = array(
                            '' => 'Pilih Hari',
                            '1' => 'Senin',
                            '2' => 'Selasa',
                            '3' => 'Rabu',
                            '4' => 'Kamis',
                            '5' => 'Jumat',
                            '6' => 'Sabtu',
                            '7' => 'Minggu',
                        );
                        ?>
                        {!! Form::select('day',$day, $corepatrol["day"], ['class' => 'selection-search-clear select-form', 'name' => 'day', 'id' => 'day'])!!}

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
                        <input class="form-control input-bb  @error('description') is-invalid @enderror" type="text" name="description" id="description" value="{{$corepatrol['description']}}" autocomplete="off" />
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
                {{-- <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">No<a class='red'> *</a></a>
                        <input class="form-control input-bb @error('hour') is-invalid @enderror" type="text" name="no" id="no" value="{{old('no')}}" />
                        @error('no')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div> --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Jam<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="time" name="hour" id="hour" value="{{old('hour')}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Lokasi<a class='red'> *</a></a>
                        {{-- {!! Form::select('patrol_location_id',$data_location, $patrol_location_id, ['class' => 'selection-search-clear select-form', 'name' => 'patrol_location_id', 'id' => 'patrol_location_id' ] )!!} --}}
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
                <a type="submit" name="add" class="btn btn-info" title="Add" onclick="editPatrolScheduleAjax()"><i class="fas fa-plus"></i> Tambah</a>
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
                        // $receipt_amount_total = 0;
                        if (!is_array($corepatrolitem)) {
                            echo "<tr><th colspan='5' style='text-align  : center !important;'>Belum Ada Data</th></tr>";
                        } else {
                            $i = 1;
                            foreach ($corepatrolitem as $key => $val) {
                                if ($val['item_status'] <> 2){
                                echo "
                                            <tr>
                                                <td style='text-align  : center !important;'>" . $i . "</td>
                                                <td style='text-align  : left !important;'>" . $val['hour'] . "</td>
                                                <td style='text-align  : left !important;'>" .$CorePatrolSchedule->getLocationName($val['patrol_location_id'])  . "</td>
                                                <td style='text-align  : center'>
                                                    <a href='/patrol-schedule/delete-edit-patrol-ajax/" . $key . "/".$corepatrol['patrol_id']."' name='Reset' class='btn btn-outline-danger btn-sm' title='Delete' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")'><i class='fas fa-trash-alt'></i> Hapus</a>
                                                </td>
                                        </tr>";
                                        $i++;
                                    }    
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
            <button type="reset" name="Reset" class="btn btn-danger" title="Reset" onclick="editReset();"><i class="fa fa-times"></i> Batal</button>
            <button type="submit" name="Update" class="btn btn-warning" title="Update"><i class="fa fa-check"></i> Ubah</button>
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