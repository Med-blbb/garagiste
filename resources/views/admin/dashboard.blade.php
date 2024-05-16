
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
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
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
                    </div>
                    <div class="row">
                        <div class="col-lg-3 mt-3"></div>
                        <div class="col-lg-6">
                            
                                <div class="card card-danger">
                                    <div class="card-header">
                                      <h3 class="card-title">Pie Chart</h3>
                      
                                      <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                          <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                          <i class="fas fa-times"></i>
                                        </button>
                                      </div>
                                    </div>
                                    <div class="card-body">
                                      <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                   
                                </div>
                                <!-- /.card-body -->
                            
                            <!-- /.card -->
                        </div>
                    </div>
                    
                </div><!-- /.container-fluid -->
            </section>
            
        {{-- <aside class="control-sidebar control-sidebar-dark">
           
        </aside> --}}
        
    </div>
    <!-- ./wrapper -->
    <script>
        // Get counts of clients and mechanics from PHP variables
        var clientCount = {{ $clients->count() }};
        var mechanicCount = {{ $mechanics->count() }};
        var adminCount = {{ $admins->count() }};
    
        // Access the canvas element
        var ctx = document.getElementById('pieChart').getContext('2d');
    
        // Create pie chart
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Clients', 'Mechanics', 'Admins'],
                datasets: [{
                    label: 'User Types',
                    data: [clientCount, mechanicCount, adminCount],
                    borderWidth: 1
                }]
            },
            options: {
                // Add any chart options here
            }
        });
    </script>
    

@endsection 

