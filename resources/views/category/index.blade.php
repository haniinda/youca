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
                        Categories
                    </h3>

                    <div class="card-tools">
                        {{$categories->links()}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category</th>
                                <th>created at</th>
                                <th>Tools</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($categories as $cat)
                                <tr>
                                    <td>{{ $cat['id'] }}</td>
                                    <td>{{ $cat['category'] }}</td>
                                    <td>{{ $cat['created_at'] }}</td>
                                    <td>
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("edit category"))
                                            <a href="{{url("category/edit/".$cat->id)}}" class="fa fa-edit"></a>
                                        @endif
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("delete category"))
                                            <a href="{{url("category/delete/".$cat->id)}}" class="fa fa-trash-alt"></a>
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
                    @if(\Illuminate\Support\Facades\Auth::user()->hasPermission("create category"))
                    <a href="{{url("category/create")}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>
                        create category</a>
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
