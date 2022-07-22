@extends('layouts.app')

@section('content')

    <h1>Create New  Company</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/Clients/create")}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Company Name</label>
            <input type="text" name="name" class="form-control" id="f-name" placeholder="Name..." required>
        </div>
        <div class="form-group">
            <label for="name">Location</label>
            <input type="text" name="location" class="form-control" id="location" placeholder="location..."  required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type_id" id="type_id" class="form-control">
            @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->type}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">image</label>
            <input type="file" name="picture" class="form-control" id="" placeholder="picture..."  >
        </div>
        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Create">
        </div>
    </form>

@endsection
