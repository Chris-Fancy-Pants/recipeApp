@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Recipes</div>
                <a class="btn btn-primary" href="new-recipe">Add Recipe</a>
                 <input id="csrf_token" type="hidden" name="_token" value="{{ csrf_token() }}">
                @foreach($recipes as $recipe)
                
                <div id="recipe-holder-{{$recipe->id}}" class="recipe-holder-show row">
                    <div class="col-md-8 col-sm-12">
                        <a href="{{ url('recipe/' . $recipe->id) }}">{{$recipe->name}}</a>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <a class="btn btn-primary" href="{{ url('recipe/edit/' . $recipe->id) }}">Edit</a>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <div class="btn btn-danger" onclick="deleteRecipe({{$recipe->id}})">Delete</div>
                    </div>
                </div>

                @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
