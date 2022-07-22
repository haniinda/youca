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
                        Companies
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
                                <th>Name</th>
                                <th>Location</th>
                                <th>picture</th>
                                <th>Type</th>
                                <th>Tools</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($data as $company)
                                <tr>
                                    <td>{{ $company['id'] }}</td>
                                    <td>{{ $company['name'] }}</td>
                                    <td>{{ $company['location'] }}</td>
                                    <td style="width: 25%">
                                        @if(isset($company->picture))
                                            <img src="{{url("storage/".$company->picture)}}" style="width: 50%;">
                                        @endif
                                    </td>
                                    <td>{{$company->type != null ? $company->type["type"] : "" }}</td>
                                    <td>
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("manage company"))
                                        <a href="{{url("Clients/delete/".$company->id)}}" class="fa fa-trash-alt"></a>
                                        <a href="{{url("Clients/edit/".$company->id)}}" class="fa fa-edit"></a>
                                        <a href="{{url("Clients/users/".$company->id)}}" class="fa fa-user"></a>
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
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("manage company"))
                    <a href="{{url("Clients/create")}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>
                       create company</a>
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
