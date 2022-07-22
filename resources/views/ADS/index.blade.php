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
                        ADS
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
                                <th>Location</th>
                                <th>WorkingHours</th>
                                <th>SDate</th>
                                <th>EDate</th>
                                <th>Cost</th>
                                <th>picture</th>
                                <th>Explaining</th>
                                <th>Service</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                                <th>Tools</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $ads)
                                <tr>
                                    <td>{{ $ads['id'] }}</td>
                                    <td>{{ $ads['location'] }}</td>
                                    <td>{{ $ads['working_hour'] }}</td>
                                    <td>{{ $ads['s-date'] }}</td>
                                    <td>{{ $ads['e-date'] }}</td>
                                    <td>{{ $ads['cost'] }}</td>
                                    <td style="width: 50%">
                                        <a href="{{url("/storage/". $ads['picture'] )}}" target="_blank">
                                            <img src="{{url("/storage/". $ads['picture'] )}}" style="width: 100%;">
                                        </a>
                                    </td>
                                    <td>{{ $ads['explaining'] }}</td>
                                    <td>{{ $ads->Adverservice != null ? $ads->Adverservice["service"] : "" }}</td>
                                    <td>{{ $ads->CurrentCategory != null ? $ads->CurrentCategory["category"] : "" }}</td>
                                    <td>{{ $ads->user != null ? $ads->user["f-name"] . " ".$ads->user["l-name"] : "" }}</td>
                                    <td>{{ $ads['created_at'] }}</td>
                                    <td>{{ $ads['updated_at'] }}</td>
                                    <td>
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("edit advs"))
                                            <a href="{{url("ADS/edit/".$ads->id)}}" class="fa fa-edit"></a>
                                        @endif
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("delete advs"))
                                            <a href="{{url("ADS/delete/".$ads->id)}}" class="fa fa-trash-alt"></a>
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
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("create advs"))
                        <a href="{{url("ADS/create")}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>
                            create adv</a>
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
