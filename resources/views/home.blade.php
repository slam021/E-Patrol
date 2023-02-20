@extends('adminlte::page')

@section('title', 'E-Patrol Security')
<link rel="shortcut icon" href="{{ asset('resources/assets/logo_epatrol.ico') }}" />

{{-- @section('content_header')
    
Dashboard

@stop --}}

@section('content')
    
<br>
<div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Menu Utama
        </h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class='col-md-3'>
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1">
                        <a><i class="fas fa-users" href=""></i></a>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text"><b><u>Personil</u></b></span>
                        <span class="info-box-number">{{$corepersonnel->count()}}</span>
                    </div>
                </div>
            </div>
            <div class='col-md-3'>
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1">
                        <a><i class="fas fa-map-marked-alt" href=""></i></a>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text"><b><u>Lokasi Patroli</u></b></span>
                        <span class="info-box-number">{{$corelocation->count()}}</span>
                    </div>
                </div>
            </div>
            <div class='col-md-3'>
                <div class="info-box">
                    <span class="info-box-icon bg-danger elevation-1">
                        <a><i class="fas fa-sync-alt" href=""></i></a>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text"><b><u>Shift</u></b></span>
                        <span class="info-box-number">{{$coreshift->count()}}</span>
                    </div>
                </div>
            </div>
            <div class='col-md-3'>
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1">
                        <a><i class="fas fa-clock" href="{{url('/schedule')}}"></i></a>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text"><b><u>Jadwal Patroli</u></b></span>
                        <span class="info-box-number">{{$coreschedule->count()}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class='col-md-6'>
                <div class="card" style="height: 300px;">
                    <div class="card-header bg-secondary">
                    List
                    </div>
                    <div class="card-body">
                    <ul class="list-group">
                    <?php foreach($menus as $menu){
                        if($menu['id_menu']==4){
                    ?>
                        <li class="list-group-item main-menu-item" onClick="location.href='/personnel'"> <i class="fa fa-angle-right"></i> List Personil</li>         
                    <?php   }
                        if($menu['id_menu']==5){
                    ?> 
                        <li class="list-group-item main-menu-item" onClick="location.href='/schedule'"> <i class="fa fa-angle-right"></i> List Jadwal Patroli</li>  
                    <?php   }
                        if($menu['id_menu']==71){
                    ?>     
                        <li class="list-group-item main-menu-item" onClick="location.href='/location'"> <i class="fa fa-angle-right"></i> List Lokasi</li> 
                    <?php   }
                        if($menu['id_menu']==72){
                    ?>     
                        <li class="list-group-item main-menu-item" onClick="location.href='/shift'"> <i class="fa fa-angle-right"></i> List Shift</li> 
                    <?php
                        }
                    }  
                    ?>             
                    </ul>
                </div>
                </div>
            </div>
            <div class='col-md-6'>
                <div class="card" style="height: 300px;">
                    <div class="card-header bg-secondary">
                    Laporan
                    </div>
                    <div class="card-body">
                    <ul class="list-group">
                    <?php foreach($menus as $menu){
                            if($menu['id_menu']==81){
                    ?>
                        <li class="list-group-item main-menu-item" onClick="location.href=''"> <i class="fa fa-angle-right"></i> Laporan Data Personil</li>
                    <?php   }
                            if($menu['id_menu']==82){
                    ?> 
                        <li class="list-group-item main-menu-item" onClick="location.href=''"> <i class="fa fa-angle-right"></i> Laporan Presensi Personil</li>      
                    <?php   }
                            if($menu['id_menu']==83){
                    ?> 
                            <li class="list-group-item main-menu-item" onClick="location.href=''"> <i class="fa fa-angle-right"></i> Laporan Jadwal Patroli</li>  
                    <?php 
                            }
                        } 
                    ?>                        
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<br>
<br>
<br>

@stop

@section('css')
    
@stop

@section('js')
    
@stop