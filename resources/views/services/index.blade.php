@extends('layouts.app')
@section('content')
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->

            <!--/.direct-chat -->
            <!-- TO DO List -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        Services
                    </h3>

                    <div class="card-tools">
                        {{$data->links()}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>service</th>
                                <th>created at</th>
                                <th>Tools</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($data as $service)
                                <tr>
                                    <td>{{ $service['id'] }}</td>
                                    <td>{{ $service['service'] }}</td>
                                    <td>{{ $service['created_at'] }}</td>
                                    <td>
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("manage service's category"))
                                            <a href="{{url("services/categories/".$service->id)}}" title="categories"
                                               class="fa fa-address-card"></a>
                                        @endif
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("edit service"))
                                            <a href="{{url("services/edit/".$service->id)}}" class="fa fa-edit"></a>
                                        @endif
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("delete service"))
                                            <a href="{{url("services/delete/".$service->id)}}"
                                               class="fa fa-trash-alt"></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">

                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("create service"))
                        <a href="{{url("services/create")}}" class="btn btn-primary float-right"><i
                                class="fas fa-plus"></i>
                            create service</a>
                    @endif

                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->

        <!-- right col -->
    </div>

@endsection
