@extends('layouts.app')

@section('content')

    <h1>link service with categories</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/services/categories/".$service->id)}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="type">categories</label>
            <select name="categories[]" id="type_id" class="form-control" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}"
                            @if(in_array($category->id,$oldCats)) selected @endif >{{$category->category}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Submit">
        </div>
    </form>

@endsection
