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
                        <div class="small-box bg-gray-200">
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
                        <div class="small-box bg-gray-200">
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
                        <div class="small-box bg-gray-200">
                            <div class="inner">
                                <h3>{{ $
                                s->count() }}</h3>

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
                        <div class="small-box bg-gray-200">
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
                <!-- /.row -->
                <!-- row -->
                <div class="row">
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-gray-200">
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
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-gray-200">
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
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-gray-200">
                            <div class="inner">
                                <h3>{{ $invoices->count() }}</h3>

                                <p>{{__('Invoices')}}</p>
                            </div>
                            <div class="icon">
                                <i class="bi bi-receipt"></i>
                            </div>
                            <a href="{{ route('admin.show-invoices') }}" class="small-box-footer">{{__('More info')}} <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-gray-200">
                            <div class="inner">
                                <h3>{{ $appointments->count() }}</h3>

                                <p>{{__('Appointments')}}</p>
                            </div>
                            <div class="icon">
                                <i class="bi bi-calendar"></i>
                            </div>
                            <a href="{{ route('admin.show-appointments') }}" class="small-box-footer">{{__('More info')}} <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                @if($repairInProg->count() > 0 || $repairPend->count() > 0 || $repairComp->count() > 0)
                <div class="row">
                    <div class="col-lg-3 mt-3"></div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                    

            </div><!-- /.container-fluid -->
        </section>

        {{-- <aside class="control-sidebar control-sidebar-dark">
           
        </aside> --}}

    </div>
    <!-- ./wrapper -->
    <script>
        // Get counts of clients and mechanics from PHP variables
        var repairInProg = {{ $repairInProg->count() }};
        var repairPend = {{ $repairPend->count() }};
        var repairComp = {{ $repairComp->count() }};

        // Access the canvas element
        var ctx = document.getElementById('pieChart').getContext('2d');

        // Create pie chart
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Pending', 'In Progress', 'Completed'],
                datasets: [{
                    label: 'User Types',
                    data: [repairPend, repairInProg, repairComp],
                    borderWidth: 1
                }]
            },
            options: {
                // Add any chart options here
            }
        });
    </script>


@endsection
