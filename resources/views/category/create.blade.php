@extends('layouts.app')

@section('content')

    <h1>Create New Category</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/category")}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">category</label>
            <input type="text" name="category" class="form-control" id="category" placeholder="category"
                   value="{{ old('category') }}">
        </div>

        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Create">
        </div>
    </form>



@endsection

