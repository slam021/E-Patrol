@inject('CorePatrolSchedule', 'App\Http\Controllers\CorePatrolScheduleController')

@extends('adminlte::page')

@section('title', 'E-PATROL | View Jadwal Patroli')
@section('js')
<script>
    function personnelSchedulingAjax() {
        var hour = document.getElementById("hour").value;
        var longtitude = document.getElementById("longtitude").value;
        var latitude = document.getElementById("latitude").value;
        var patrol_id = document.getElementById("patrol_id").value;

        $.ajax({
            type: "POST",
            url: "{{route('personnel-scheduling-ajax')}}",
            data: {
                'hour': hour,
                'longtitude': longtitude,
                'latitude': latitude,
                'patrol_id': patrol_id,
                '_token': '{{csrf_token()}}'
            },
            success: function(msg) {
                location.reload();
            }
        });
    }


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
            Form Penjadwal Patroli
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('patrol-schedule/personnel-scheduling/'.$corepatrol['patrol_id']) }}'" name="Find" class="btn btn-sm btn-secondary" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>

    <form method="post" action="/patrol-schedule/store-personnel-scheduling" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <h5 class="page-title float-left">
                <b> Jadwal Patroli </b>
            </h5> <br> <br>
            @foreach ($corepatrol as $index => $corepatrol)
            <div class="row form-group" style="margin-top: -16px">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Patroli<a class='red'> *</a></a>
                        <input readonly class="form-control input-bb" type=" text" name="patrol_name" id="patrol_name" value="{{$corepatrol['patrol_name']}}" autocomplete="off" />
                        <input class="form-control input-bb" type="hidden" name="patrol_id" id="patrol_id" value="{{$corepatrol['patrol_id']}}" autocomplete="off" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Hari<a class='red'> *</a></a>
                        <?php
                        $day = array(
                            '0' => 'Pilih Hari',
                            '1' => 'Senin',
                            '2' => 'Selasa',
                            '3' => 'Rabu',
                            '4' => 'Kamis',
                            '5' => 'Jumat',
                            '6' => 'Sabtu',
                            '7' => 'Minggu',
                        );
                        ?>
                        {{-- {!! Form::select('day',$day, $corepatrol["day"], ['class' => 'selection-search-clear select-form', 'name' => 'day', 'id' => 'day'] )!!} --}}

                        <input readonly class="form-control input-bb"  type="text" name="day" id="day" value="{{$day[$corepatrol['day']]}}" autocomplete="" />
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Deskripsi<a class='red'> *</a></a>
                        <input readonly class="form-control input-bb"   type=" text" name="description" id="description" value="{{$corepatrol['description']}}" autocomplete="off" />
                    </div>
                </div>
            </div>
            <h5 class="page-title float-left" style="margin-top: -10px">
                <b> Jam & Titik Koordinat Patroli </b>
            </h5> <br> <br>
            <div class="row form-group" style="margin-top: -16px">
                <?php
                $receipt_amount_total = 0;
                if (!is_array($corepatrolitem)) {
                    echo "<tr><th colspan='5' style='text-align  : center !important;'></th></tr>";
                } else {
                    $i = 1;
                    foreach ($corepatrolitem as $key => $val) {
                        if ($val['item_status'] <> 2){

                            echo "
                                <div class='col-md-4'>
                                    <div class='form-group'>
                                        <a class='text-dark'>Jam<a class='red'> *</a></a>
                                        <input readonly class='form-control input-bb' type='text' name='hour' id='patrol_name' value=".$val['hour']." />
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class='form-group'>
                                        <a class='text-dark'>Longtitude<a class='red'> *</a></a>
                                        <input readonly class='form-control input-bb' type='text' name='hour' id='patrol_name' value=".$val['longtitude']." />
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class='form-group'>
                                        <a class='text-dark'>Latitude<a class='red'> *</a></a>
                                        <input readonly class='form-control input-bb' type='text' name='hour' id='patrol_name' value=".$val['latitude']." />
                                    </div>
                                </div>";
                    }
                }
            }
                ?>
        
                {{-- <div class='form-group'>
                            <a class='text-dark'>Jam<a class='red'> *</a></a>
                            <input readonly class='form-control input-bb type='text' name='hour' id='patrol_name' value="{{$corepatrolitem['hour']}}" />
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <a class='text-dark'>Longtitude<a class='red'> *</a></a>
                            <input readonly class='form-control input-bb type='text' name='longtitude' id='longtitude' value="{{$corepatrolitem['longtitude']}}" />
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class='form-group'>
                            <a class='text-dark'>Latitude<a class='red'> *</a></a>
                            <input readonly class='form-control input-bb type='text' name='latitude' id='latitude' value="{{$corepatrolitem['latitude']}}" />
                        </div>
                    </div>
                </div> --}}

        </div>
    </div>
</div>
<div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Daftar Jadwal Personil
        </h5>
        <div class="float-right">
            <button type="button" name="Add" class="btn btn-sm btn-info" title="Add" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Penjadwalan Personil</button>
        </div>
        <div class="col-md-3 float-right"> 
        </div>
    </div>
    <div class="card-body">
        <div class="form-body form">
            <div class="table-responsive">
                <table class="table table-bordered table-advance table-hover" id="table-child">
                    <thead class="thead-light">
                        <tr>
                            <th width="3%" style='text-align:center'>No</th>
                            <th width="20%" style='text-align:center'>Nama Lengkap</th>
                            <th width="5%" style='text-align:center'>Nomor telp</th>
                            <th width="3%" style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            // $receipt_amount_total = 0;
                            // if (!is_array($corepatrolitem)) {
                                echo "<tr><th colspan='5' style='text-align  : center !important;'>Belum Ada Data</th></tr>";
                            // } else {
                            //     $i = 1;
                            //     foreach ($corepatrolitem as $key => $val) {
                            //         if ($val['item_status'] <> 2){
                            //         echo "
                            //                     <tr>
                            //                         <td style='text-align  : center !important;'>" . $i . "</td>
                            //                         <td style='text-align  : left !important;'>" . $val['hour'] . "</td>
                            //                         <td style='text-align  : left !important;'>" . $val['longtitude'] . "</td>
                            //                         <td style='text-align  : left !important;'>" . $val['latitude'] . "</td>
    
                            //                         <td style='text-align  : center'>
                            //                             <a href='/patrol-schedule/create-personnel-scheduling/".$corepatrol['patrol_id']."' name='Reset' class='btn btn-outline-info btn-sm' title='Add'><i class='fas fa-user-plus'></i> Tambah Penjadwal Personil</a>
                            //                         </td>
                            //                 </tr>";
                            //                 $i++;
                            //             }    
                            //     }
                            // }
                            ?>
                    </tbody>
                </table>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Penjadwalan Personnel</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::select('datapersonnel',$datapersonnel, '0', ['class' => 'form-control', 'id' => 'user_id', 'multiple'] )!!}
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info"><i class="fas fa-user-plus"></i> Tambah</button>
                        </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-muted">
        <div class="form-actions float-right">
            <button type="reset" name="Reset" class="btn btn-danger" title="Reset" onclick="editReset();"><i class="fa fa-times"></i> Batal</button>
            <button type="submit" name="save" class="btn btn-primary" title="save"><i class="fa fa-check"></i> Simpan</button>
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