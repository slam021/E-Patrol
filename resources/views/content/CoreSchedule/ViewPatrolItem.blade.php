@extends('adminlte::page')

@section('title', 'E-PATROL | View Jadwal Patroli')
@section('js')
<script>
    function editPatrolScheduleAjax() {
        var hour             = document.getElementById("hour").value;
        var longtitude       = document.getElementById("longtitude").value;
        var latitude         = document.getElementById("latitude").value;
        var patrol_id        = document.getElementById("patrol_id").value;

        $.ajax({
            type: "POST",
            url: "{{route('edit-patrol-schedule-ajax')}}",
            data: {
                'hour': hour,
                'longtitude'        : longtitude,
                'latitude'          : latitude,
                'patrol_id'         : patrol_id,
                '_token'            : '{{csrf_token()}}'
            },
            success: function(msg) {
                location.reload();
            }
        });
    }

    function storePersonnelScheduling() {
        var full_name            = document.getElementById("full_name").value;
        var phone_number         = document.getElementById("phone_number").value;
        var patrol_item_id       = document.getElementById("patrol_item_id").value;

        $.ajax({
            type: "POST",
            url: "{{route('store-personnel-scheduling')}}",
            data: {
                
                'full_name'         : full_name,
                'phone_number'      : phone_number,
                'patrol_item_id'    : patrol_item_id,
                '_token'            : '{{csrf_token()}}'
            },
            success: function(msg) {
                location.reload();
            }
        });
    }

    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })

    function click_patrol_item_id(patrol_item_id){
        $('#patrol_item_id').val(patrol_item_id);
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
        <b> Tambah Deskripsi Tugas Patroli </b>
    </h3> -->
    <div class="float-left">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('patrol-schedule') }}">Jadwal Patroli</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Jadwal Patroli</li>
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
            View Jadwal Patroli
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('patrol-schedule') }}'" name="Find" class="btn btn-sm btn-secondary" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>

    <form method="post" action="/patrol-schedule/update-patrol-schedule" enctype="multipart/form-data">
        @csrf
        {{-- @method('put') --}}
        <div class="card-body">
            <h5 class="page-title float-left">
                <b> Jadwal Patroli </b>
            </h5> <br> <br>
            <div class="row form-group" style="margin-top: -15px">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Patroli<a class='red'> *</a></a>
                        <input readonly class="form-control input-bb" type="text" name="patrol_name" id="patrol_name" value="{{$corepatrol->patrol_name}}" autocomplete="off"/>
                        <input class="form-control input-bb" type="hidden" name="patrol_id" id="patrol_id" value="{{$corepatrol['patrol_id']}}"/>
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
                        {{-- {!! Form::select('day', $day, $core_patrol["day"], ['class' => 'selection-search-clear select-form', 'name'=>'day', 'id' => 'day']) !!} --}}
                        <input readonly class="form-control input-bb" type="text" name="patrol_name" id="patrol_name" value="{{$day[$corepatrol->day]}}" autocomplete="off"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Deskripsi<a class='red'> *</a></a>
                        <input readonly class="form-control input-bb" type="text" name="description" id="description" value="{{$corepatrol->description}}" autocomplete="off"/>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card-footer text-muted">
            <div class="float-right">
                <a type="submit" name="Save" class="btn btn-info" title="Save" onclick='editPatrolScheduleAjax()'><i class="fas fa-plus"></i> Tambah</a>
            </div>
        </div> --}}
        <div class="card-body" style="margin-top: -45px">
            <div class="form-body form">
                <div class="row">
                    <h5 class="ml-2 form-section"><b>Daftar Jam & Titik Koordinat </b></h5>
                </div>
                <div class="table-responsive" style="margin-top: 10px">
                    <table class="table table-bordered table-advance table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="2%" style='text-align:center'>No</th>
                                <th width="2%" style='text-align:center'>ID</th>
                                <th width="8%" style='text-align:center'>Jam</th>
                                <th width="8%" style='text-align:center'>Longtitude</th>
                                <th width="8%" style='text-align:center'>Latitude</th>
                                <th width="5%" style='text-align:center'>Aksi</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php
                            $receipt_amount_total = 0;
                            if (!is_array($corepatrolitem)) {
                                echo "<tr><th colspan='5' style='text-align  : center !important;'>Belum Ada Data</th></tr>";
                            } else {
                                $i=1;
                                foreach ($corepatrolitem as $key => $val) {
                                    if ($val['item_status'] <> 2){
                                    echo "
                                        <tr>
                                            <td style='text-align  : center !important;'>" . $i. "</td>
                                            <td style='text-align  : center !important;' type='hidden'>".$val['patrol_item_id']."</td>
                                            <td style='text-align  : left !important;'>" . $val['hour'] . "</td>
                                            <td style='text-align  : left !important;'>" . $val['longtitude'] . "</td>
                                            <td style='text-align  : left !important;'>" . $val['latitude'] . "</td>

                                            <td style='text-align  : center'>
                                                <a type='button'  href='/patrol-schedule/print-qr/".$val['patrol_item_id']."' onclick='click_patrol_item_id(".$val['patrol_item_id'].")' name='Print' class='btn btn-outline-primary btn-sm' title='Print'><i class='fas fa-qrcode'></i> Print QR Code</a>
                                            </td>
                                        </tr> ";
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
                    <a type="button" href="{{ url('/patrol-schedule/print-all-qr/'.$corepatrol['patrol_id'])}}" name="Print All" class="btn btn-primary" title="Print All"><i class="fa fa-qrcode"></i> Print Semua QR Code</a>
                    

            </div>
        </div>
</div>
</form>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop