@extends('layouts.app')

@section('content')

    <h2>Edit company</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/Clients/edit/".$company->id)}}" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Company Name</label>
            <input type="text" name="name" class="form-control" id="f-name" placeholder="Name..."
                   value="{{ $company["name"] }}" required>
        </div>
        <div class="form-group">
            <label for="name">Location</label>
            <input type="text" name="location" class="form-control" id="location" placeholder="location..."
                   value="{{ $company["location"] }}" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type_id" id="type_id" class="form-control">
                @foreach($types as $type)
                    <option value="{{$type->id}}" @if($company->type_id==$type->id)selected @endif>{{$type->type}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">image</label>
            <input type="file" name="picture" class="form-control" id="" placeholder="picture..."  >
        </div>
        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Edit">
        </div>

@endsection
