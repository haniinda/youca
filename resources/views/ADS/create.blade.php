@extends('layouts.app')

@section('content')

    <h1>Create New  ADS</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/ADS/create")}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Location</label>
            <input type="text" name="location" class="form-control" id="Location" placeholder="Location..."  required>
        </div>
        <div class="form-group">
            <label for="name">working_hour</label>
            <input type="number" name="working_hour" class="form-control" id="working_hour" placeholder="working_hour..."  required>
        </div>
        <div class="form-group">
            <label for="email">SDate</label>
            <input type="date" name="s-date" class="form-control" id="SDate" placeholder="SDate..." >
        </div>
        <div class="form-group">
            <label for="email">EDate</label>
            <input type="date" name="e-date" class="form-control" id="EDate" placeholder="EDate..." >
        </div>
        <div class="form-group">
            <label for="name">cost</label>
            <input type="number" name="cost" class="form-control" id="cost" placeholder="cost..."  required>
        </div>
        <div class="form-group">
            <label for="name">picture</label>
            <input type="file" name="picture" class="form-control" id="picture" placeholder="picture..."  required>
        </div>
        <div class="form-group">
            <label for="name">Explaining</label>
            <input type="text" name="explaining" class="form-control" id="Explaining" placeholder="Explaining..."  required>
        </div>
        <div class="form-group">
            <label for="name">service</label>
            <select name="advservice_id" class="form-control" required>
                @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->service}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->category}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Create">
        </div>
    </form>

@endsection
