
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
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <!-- ./col -->
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $users->count() }}</h3>

                                    <p>{{__('User Registrations')}}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="{{ route('admin.users') }}" class="small-box-footer">{{__('More info')}} <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3> {{ $vehicles->count() }} </h3>

                                    <p>{{__('Vehicles')}}</p>
                                </div>
                                <div class="icon">
                                <i class="bi bi-car-front-fill"></i>
                                </div>
                                <a href="{{ route('admin.vehicles') }}" class="small-box-footer">{{__('More info')}} <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>{{ $clients->count() }}</h3>

                                    <p>{{__('Clients')}}</p>
                                </div>
                                <div class="icon">
                                <i class="bi bi-person-square"></i>
                                </div>
                                <a href="{{ route('admin.show-clients') }}" class="small-box-footer">{{__('More info')}} <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $mechanics->count() }}</h3>

                                    <p>{{__('Mechanics')}}</p>
                                </div>
                                <div class="icon">
                                <i class="bi bi-tools"></i>
                                </div>
                                <a href="{{ route('admin.show-mechanics') }}" class="small-box-footer">{{__('More info')}} <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        </div>
                    </div>
                    <!-- /.row -->
                    <!-- row -->
                    <div class="row">
                        <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ $repairs->count() }}</h3>

                                        <p>{{__('Repairs')}}</p>
                                    </div>
                                    <div class="icon">
                                    <i class="bi bi-tools"></i>
                                    </div>
                                    <a href="{{ route('admin.show-repair') }}" class="small-box-footer">{{__('More info')}} <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        <!-- ./col -->
                        <!-- ./col -->
                            
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3>{{ $parts->count() }}</h3>

                                    <p>{{__('Parts')}}</p>
                                </div>
                                <div class="icon">
                                <i class="bi bi-tools"></i>
                                </div>
                                <a href="{{ route('admin.show-parts') }}" class="small-box-footer">{{__('More info')}} <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    

@endsection 

