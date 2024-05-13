@extends('layouts.app')

@section('content')

<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ __('Dashboard') }}</h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <!-- ./col -->
                    <!-- ./col -->
                    {{-- <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $vehicle->count() }}</h3>

                                <p>{{__('Vehicles')}}</p>
                            </div>
                            <div class="icon">
                                <i class="bi bi-car-front-fill"></i>
                            </div>
                            <a href="{{ route('client.vehicles') }}" class="small-box-footer">{{__('More info')}} <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> --}}
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3> {{ $repairs->count() }} </h3>

                                <p>{{__('Repairs')}}</p>
                            </div>
                            <div class="icon">
                                <i class="bi bi-tools"></i>
                            </div>
                            <a href="{{ route('mechanics.repairs') }}" class="small-box-footer">{{__('More info')}} <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

    </div>


</div>

@endSection