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
                        Roles
                    </h3>

                    <div class="card-tools">
                        {{$roles->links()}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>role-name</th>
                                <th>created at</th>
                                <th>Tools</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role['id'] }}</td>
                                    <td>{{ $role['role-name'] }}</td>
                                    <td>{{ $role['created_at'] }}</td>
                                    <td>
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("edit role"))
                                            <a href="{{url("roles/edit/".$role->id)}}" class="fa fa-edit"></a>
                                        @endif
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("delete role"))
                                            <a href="{{url("roles/delete/".$role->id)}}" class="fa fa-trash-alt"></a>
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
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("create role"))
                        <a href="{{url("roles/create")}}" class="btn btn-primary float-right"><i
                                class="fas fa-plus"></i>create role</a>
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
