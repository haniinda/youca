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
                        Company Types
                    </h3>

                    <div class="card-tools">
                        {{$types->links()}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Type</th>
                                <th>created at</th>
                                <th>Tools</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($types as $type)
                                <tr>
                                    <td>{{ $type['id'] }}</td>
                                    <td>{{ $type['type'] }}</td>
                                    <td>{{ $type['created_at'] }}</td>
                                    <td>
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("manage company"))
                                            <a href="{{url("companyTypes/delete/".$type->id)}}"
                                               class="fa fa-trash-alt"></a>
                                            <a href="{{url("companyTypes/edit/".$type->id)}}" class="fa fa-edit"></a>
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

                    <a href="{{url("companyTypes/create")}}" class="btn btn-primary float-right"><i
                            class="fas fa-plus"></i>
                        Add
                        item</a>


                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->

        <!-- right col -->
    </div>

@endsection
