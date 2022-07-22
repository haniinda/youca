@extends('layouts.app')

@section('content')

    <h1>Create New Type</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/companyTypes")}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">Type</label>
            <input type="text" name="type" class="form-control" id="type" placeholder="type"
                   value="{{ old('type') }}">
        </div>

        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Create">
        </div>
    </form>



@endsection

