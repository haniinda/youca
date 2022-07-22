@extends('layouts.app')

@section('content')

    <h1>link user with company</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/Clients/users/".$company->id)}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="type">users</label>
            <select name="users[]" id="type_id" class="form-control" multiple>
                @foreach($users as $user)
                    <option value="{{$user->id}}"
                            @if(in_array($user->id,$oldUsers )) selected @endif >{{$user->email}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Done">
        </div>
    </form>

@endsection
