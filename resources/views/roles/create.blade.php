@extends('layouts.app')

@section('content')

    <h1>Create New Role</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/roles")}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">role</label>
            <input type="text" name="role-name" class="form-control" id="role" placeholder="role"
                   value="{{ old('role-name') }}">
        </div>

        <div class="form-group">
            <label for="title">permissions</label>
            <select name="permissions[]" class="form-control" multiple>
                @foreach($permissions as $permission)
                    <option value="{{$permission->id}}">{{$permission->permit}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group pt-2">
            <input class="btn btn-primary" type="submit" value="Create">
        </div>
    </form>



@endsection

