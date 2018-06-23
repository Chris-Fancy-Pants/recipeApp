@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Recipes</div>
                <a href="new-recipe">Add Recipe</a>
                <hr>
                @foreach($recipes as $recipe)
                
                <br>

                <a href="{{ url('recipe/edit/' . $recipe->id) }}">{{$recipe->name}}</a>

                <br>
 
                @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
