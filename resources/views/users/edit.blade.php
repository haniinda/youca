@extends('layouts.app')

@section('content')

    <h2>Edit User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/users/edit/".$user->id)}}" enctype="multipart/form-data">

        @csrf()

        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" name="f-name" class="form-control" id="name" placeholder="Name..."
                   value="{{ $user["f-name"] }}" required>
        </div>
        <div class="form-group">
            <label for="name">Last Name</label>
            <input type="text" name="l-name" class="form-control" id="name" placeholder="Name..."
                   value="{{ $user["l-name"] }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email..."
                   value="{{ $user->email }}">
        </div>
        {{--            <div class="form-group">--}}
        {{--            <label for="password">Password</label>--}}
        {{--            <input type="password" name="password" class="form-control" id="password" placeholder="Password..."--}}
        {{--                   minlength="8"  required>--}}
        {{--        </div>--}}
        {{--        <div class="form-group">--}}
        {{--            <label for="password_confirmation">Password Confirm</label>--}}
        {{--            <input type="password" name="password_confirmation" class="form-control" placeholder="Password..."--}}
        {{--                   id="password_confirmation"  required>--}}
        {{--        </div>--}}

        <div class="form-group">
            <label for="role_id">Role</label>
            <select name="role_id" id="role_id" class="form-control">
                @foreach($roles as $role)
                    <option value="{{$role->id}}"
                            @if($user["role_id"] == $role->id) selected @endif>{{$role["role-name"]}}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <label for="type">TypeAccount</label>
            <select name="account_type" id="TypeAccount" class="form-control">
                <option value="admin"
                        @if($user["account_type"] =="admin") selected @endif>
                    admin
                </option>
                <option value="normal"
                        @if($user["account_type"] =="normal") selected @endif>
                    normal
                </option>
                <option value="manager"
                        @if($user["account_type"] =="manager") selected @endif>
                    manager
                </option>
            </select>
        </div>
        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="edit">
        </div>

@endsection
