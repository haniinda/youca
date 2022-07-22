
@extends('layouts.app')

@section('content')

    <h2>Edit Adv</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/ADS/edit/".$adv->id)}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Location</label>
            <input type="text" name="location" class="form-control" id="location" placeholder="Location..."  value="{{ $adv["location"] }}" required>
        </div>
        <div class="form-group">
            <label for="name">working_hour</label>
            <input type="number" name="working_hour" class="form-control" id="working_hour" placeholder="working_hour..." value="{{ $adv["working_hour"] }}" required>
        </div>
        <div class="form-group">
            <label for="email">SDate</label>
            <input type="date" name="s-date" class="form-control" id="SDate" placeholder="SDate..." value="{{ $adv["s-date"]}}">
        </div>
        <div class="form-group">
            <label for="email">EDate</label>
            <input type="date" name="e-date" class="form-control" id="EDate" placeholder="EDate..." value="{{ $adv["e-date"] }}">
        </div>
        <div class="form-group">
            <label for="name">cost</label>
            <input type="number" name="cost" class="form-control" id="cost" placeholder="cost..."  required value="{{ $adv["cost"] }}">
        </div>
        <div class="form-group">
            <label for="name">picture</label>
            <input type="file" name="picture" class="form-control" id="picture" placeholder="picture..."   value="{{ $adv["picture"] }}">
        </div>
        <div class="form-group">
            <label for="name">Explaining</label>
            <input type="text" name="explaining" class="form-control" id="Explaining" placeholder="Explaining..."  required value="{{ $adv["explaining"] }}">
        </div>
        <div class="form-group">
            <label for="name">service</label>
            <select name="advservice_id" class="form-control" required>
                @foreach($services as $service)
                    <option value="{{$service->id}}"@if($adv->advservice_id == $service->id)selected @endif>{{$service->service}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" @if($adv->category_id ==$category->id)selected @endif>{{$category->category}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Edit">
        </div>

@endsection
