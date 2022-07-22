@extends('layouts.app')

@section('content')

    <h1>Create New  User</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/users")}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">first name</label>
            <input type="text" name="f-name" class="form-control" id="f-name" placeholder="FName..." value="{{ old('f-name') }}" required>
        </div>
        <div class="form-group">
            <label for="name">last name</label>
            <input type="text" name="l-name" class="form-control" id="l-name" placeholder="LName..." value="{{ old('l-name') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password..." required minlength="8">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Password Confirm</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Password..." id="password_confirmation">
        </div>
        <div class="form-group">
            <label for="role_id">Role</label>
            <select name="role_id" id="role_id" class="form-control">
                <option></option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role["role-name"]}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="type">TypeAccount</label>
            <select name="account_type" id="TypeAccount" class="form-control">
                <option value="admin">
                    admin
                </option>
                <option value="normal">
                    normal
                </option>
                <option value="manager">
                    manager
                </option>
            </select>
        </div>
        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Submit">
        </div>
    </form>

@endsection
