@inject('CorePatrolSchedule', 'App\Http\Controllers\CorePatrolScheduleController')

@extends('adminlte::page')

@section('title', 'E-PATROL | View Jadwal Patroli')
@section('js')
<script>

    function personnelSchedulingAjax() {
        var hour                  = document.getElementById("hour").value;
        var location_name         = document.getElementById("location_name").value;
        var patrol_id             = document.getElementById("patrol_id").value;
        var patrol_item_id        = document.getElementById("patrol_item_id").value;

        $.ajax({
            type: "POST",
            url: "{{route('personnel-scheduling-ajax')}}",
            data: {
                'hour': hour,
                'location_name'     : location_name,
                'patrol_id'         : patrol_id,
                'patrol_item_id'    : patrol_item_id,
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

    //---Modal Dropdown Insert Personil---//
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
    })

    $(document).ready(function(){
        var personnel_id        = {!! json_encode($personnel_id) !!};
        
        if(personnel_id == null){
            $("#personnel_id").select2("val", "0");
        }
    });

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

@if(session('msg_err'))
<div class="alert alert-danger" role="alert">
    {{session('msg_err')}}
</div>
@endif
<div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Penjadwal Patroli
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('patrol-schedule') }}'" name="Find" class="btn btn-sm btn-secondary" title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>

    <form method="post" action="/patrol-schedule/store-personnel-scheduling" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <h5 class="page-title float-left">
                <b> Jadwal Patroli </b>
            </h5> <br> <br>
            <div class="row form-group" style="margin-top: -16px">
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Nama Patroli<a class='red'> *</a></a>
                        <input readonly class="form-control input-bb" type="text" name="patrol_name" id="patrol_name" value="{{$corepatrol['patrol_name']}}"  autocomplete="off" />
                        <input class="form-control input-bb" type="hidden" name="patrol_id" id="patrol_id" value="{{$corepatrol['patrol_id']}}" autocomplete="off"/>
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
                        <input readonly class="form-control input-bb"   type="text" name="description" id="description" value="{{$corepatrol['description']}}" autocomplete="off" />
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card-footer text-muted">
            <div class="float-right">
                <a type="submit" name="add" class="btn btn-info" title="Add" onclick="editPatrolScheduleAjax()"><i class="fas fa-plus"></i> Tambah</a>
            </div>
        </div> --}}
        <div class="card-body" style="margin-top: -50px">
            <div class="form-body form">
                <div class="row">
                    <h5 class="ml-2 form-section"><b>Penjadwalan Personil</b></h5>
                </div>
                <div class="table-responsive" style="margin-top: 10px">
                    <table class="table table-bordered table-advance table-hover" id="table-child">
                        <thead class="thead-light">
                            <tr>
                                <th width="2%" style='text-align:center'><i class="fas fa-hashtag"></i></th>
                                <th width="1%" style='text-align:center'>Jam</th>
                                <th width="13%" style='text-align:center' colspan="2">Lokasi</th>
                                <th width="3%" style='text-align:center'>Aksi</th>
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
                                            <tr >
                                                <td style='text-align  : center !important;' class='clickeble' data-toggle='collapse' data-target='#raw".$val['patrol_item_id']."'><i class='fas fa-sort'></i></td>
                                                <td style='text-align  : left !important;'>".$val['hour']."</td>
                                                <td style='text-align  : left !important;' colspan='2'>" .$CorePatrolSchedule->getLocationName($val['patrol_location_id'])   . "</td>

                                                <td style='text-align  : center'>
                                                    <button type='button' name='Add' class='btn btn-outline-info btn-sm' title='Add' data-toggle='modal' data-target='#exampleModal' onclick='click_patrol_item_id(".$val['patrol_item_id'].")'><i class='fas fa-user-plus'></i> Penjadwalan Personil</button>
                                                </td>
                                            </tr>
                                            <tr class='collapse table-info' id='raw".$val['patrol_item_id']."'>
                                                <th width='2%' style='text-align:center'><i class='fas fa-caret-right'></i></th>
                                                <th width='2%' style='text-align:center'>No</th>
                                                <th width='10%' style='text-align:center'>Nama Lengkap</th>
                                                <th width='10%' style='text-align:center'>Nomor Telp</th>
                                                <th width='5%' style='text-align:center'>Aksi</th>
                                            </tr>
                                            ";
                                                $j = 1;
                                                foreach ($scheduling as $key2 => $val2) {
                                                    if( $val['patrol_item_id'] ==  $val2['patrol_item_id']){
                                                        $j==1;
                                                    
                                                    echo "
                                                    <tr class='collapse table-info' id='raw".$val2['patrol_item_id']."'>
                                                        <td style='text-align  : center !important;'></td>
                                                        <td style='text-align  : left !important;'>" . $j . "</td>
                                                        <td style='text-align  : left !important;'>" . $val2['full_name'] . "</td>
                                                        <td style='text-align  : left !important;'>" . $val2['phone_number'] . "</td>
                                                        <td style='text-align  : center'>
                                                            <a href='/patrol-schedule/delete-personnel-scheduling/" . $val2['scheduling_id']. "' name='Delete' class='btn btn-outline-danger btn-sm' title='Delete' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")'><i class='fas fa-trash-alt'></i> Hapus</a>
                                                        </td>
                                                    </tr>";
                                                $j++; 
                                        }
                                        }      
                                    } 
                                }                                         
                            }
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
                                {!! Form::select('personnel_id',$datapersonnel, $personnel_id, ['class' => 'selection-search-clear select-form', 'id' => 'personnel_id', 'required'] )!!}
                                <input type="hidden"  id="patrol_item_id" name="patrol_item_id" >
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info" onclick="storePersonnelScheduling();"><i class="fas fa-user-plus" ></i> Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card-footer text-muted">
            <div class="form-actions float-right">
                <button type="reset" name="Reset" class="btn btn-danger" title="Reset" onclick="editReset();"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" name="Update" class="btn btn-warning" title="Update"><i class="fa fa-check"></i> Ubah</button>
            </div>
        </div> --}}
</div>
{{-- <div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Detail Jadwal Patroli
        </h5>
    </div> --}}
    
{{-- </div> --}}
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