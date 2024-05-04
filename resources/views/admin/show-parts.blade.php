@extends('layouts.app')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{__('Parts')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Description')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{-- @foreach($parts as $part)
                                    <tr>
                                        <td>{{$part->name}}</td>
                                        <td>{{$part->description}}</td>
                                        <td>
                                            <a href="{{route('admin.edit-part', $part->id)}}" class="btn btn-primary btn-sm">{{__('Edit')}}</a>
                                            <form action="{{route('admin.delete-part', $part->id)}}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Remove Part" onclick="return confirm('Are you sure you want to delete this part?')">
                                                    <i class="bi bi-trash h5"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@endSection