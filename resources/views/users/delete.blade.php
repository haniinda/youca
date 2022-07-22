@extends('layouts.app')

@section('content')

    <h1>Delete User</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/users/delete/".$user->id)}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if(\Illuminate\Support\Facades\Auth::user()->id !=$user->id)
        <label> Are you sure ?</label>
        <div class="form-group pt-2">
            <input class="btn btn-danger" type="submit" value="Delete">
        </div>
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->id ==$user->id)
            <label> can not delete yourself</label>
        @endif
    </form>




@endsection

