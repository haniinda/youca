@extends('layouts.app')

@section('content')

    <h1>Create New Service</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/services")}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">Service</label>
            <input type="text" name="service" class="form-control" id="service" placeholder="service"
                   value="{{ old('service') }}">
        </div>

        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Submit">
        </div>
    </form>



@endsection

