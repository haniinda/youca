@extends('layouts.app')

@section('content')

    <h1>Edit Type</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/category/edit/".$category->id)}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">Type</label>
            <input type="text" name="category" class="form-control" id="category" placeholder="category"
                   value="{{$category->category}}">
        </div>

        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Edit">
        </div>
    </form>



@endsection

