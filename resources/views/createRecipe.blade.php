@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <form action="{{url('recipe/create')}}" method="POST">
                @csrf
                Name:<br>
                <input type="text" name="name"><br>
                Description:<br>
                <textarea name="description" id="" cols="30" rows="10"></textarea><br>
                Serves:<br>
                <input type="number" name="serves"><br>
                Prep Time:<br>
                <input type="number" name="prep_time"><br>
                Cooking Time:<br>
                <input type="number" name="cook_time"><br>
                <input type="Submit">
            </form>


            </div>
        </div>
    </div>
</div>
@endsection
