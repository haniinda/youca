
@extends('layouts.app')

@section('content')

    <h1>Delete ADV</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{url("/ADS/delete/".$adv->id)}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <label> Are you sure ?</label>
        <div class="form-group pt-2">
            <input class="btn btn-danger" type="submit" value="Delete">
        </div>

    </form>




@endsection

