@extends('layouts.app')

@section('content')

<h1>Edit Role</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{url("/roles/edit/".$role->id)}}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="title">role</label>
        <input type="text" name="role-name" class="form-control" id="service" placeholder="service" value="{{$role["role-name"]}}">
    </div>
    <div class="form-group">
        <label for="title">permissions</label>
        <select name="permissions[]" class="form-control" multiple>
            @foreach($permissions as $permission)
                <option value="{{$permission->id}}" @if(in_array( $permission->id,$role->permission()->get()->pluck("id")->toArray())) selected @endif>{{$permission->permit}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Edit">
    </div>
</form>



@endsection

