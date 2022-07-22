@extends('layouts.app')

@section('content')

    <h2>changePassword</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/users/changepassword/".$user->id)}}" enctype="multipart/form-data">

        @csrf()

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password..."
                   minlength="8" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Password Confirm</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Password..."
                   id="password_confirmation" required>
        </div>


        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="edit">
        </div>

@endsection
