@extends('layouts.app')

@section('content')

<h1>Delete Role</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{url("/roles/delete/".$role->id)}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    @if(\Illuminate\Support\Facades\Auth::user()->role_id !=$role->id)
    <label> Are you sure ?</label>
    <div class="form-group pt-2">
        <input class="btn btn-danger" type="submit" value="Delete">
    </div>
    @else
        <label> can not delete this role</label>
    @endif
</form>



@endsection

