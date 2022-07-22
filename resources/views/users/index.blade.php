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
                        Users
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
                                <th>FName</th>
                                <th>LName</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>picture</th>
                                <th>Education</th>
                                <th>BirthDay</th>
                                <th>Company</th>
                                <th>Role</th>
                                <th>TypeAccount</th>
                                <th>address</th>
                                <th>email_verified_at</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                                <th>Tools</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $users)
                                <tr>
                                    <td>{{ $users['id'] }}</td>
                                    <td>{{ $users['f-name'] }}</td>
                                    <td>{{ $users['l-name'] }}</td>
                                    <td>{{ $users['email'] }}</td>
                                    <td>{{ $users['Phone'] }}</td>
                                    <td>{{ $users['picture'] }}</td>
                                    <td>{{ $users['education'] }}</td>
                                    <td>{{ $users['birth-date'] }}</td>
                                    <td>{{ $users->company != null ? $users->company["name"] : "" }}</td>
                                    <td>{{ $users->role != null ? $users->role["role-name"] : "" }}</td>
                                    <td>{{ $users['account_type'] }}</td>
                                    <td>{{ $users['address'] }}</td>
                                    <td>{{ $users['email_verified_at'] }}</td>
                                    <td>{{ $users['created_at'] }}</td>
                                    <td>{{ $users['updated_at'] }}</td>
                                    <td>
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("edit user"))
                                            <a href="{{url("users/edit/".$users->id)}}" class="fa fa-edit"></a>
                                        @endif
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("change password user"))
                                            <a href="{{url("/users/changepassword/".$users->id)}}"
                                               title="change password" class="fa fa-passport"></a>
                                        @endif
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("delete user"))
                                            <a href="{{url("users/delete/".$users->id)}}" class="fa fa-trash-alt"></a>
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
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("create user"))
                        <a href="{{url("users/create")}}" class="btn btn-primary float-right"><i
                                class="fas fa-plus"></i>
                            create user</a>
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
