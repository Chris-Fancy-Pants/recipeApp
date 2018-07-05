@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <form action="{{url('recipe/update')}}" method="POST">
            <div class="card">

                <input type="hidden" name="id" value="{{$recipe->id}}">
                <input id="csrf_token" type="hidden" name="_token" value="{{ csrf_token() }}">
                

                <label for="name_field">Name</label>
                <input style="border:none; border-bottom: 1px solid #ccc" type="text" name="name" value="{{$recipe->name}}" id="name_field"><br>
                Description:<br>
                <textarea name="description" id="" cols="30" rows="10">{{$recipe->description}}</textarea><br>
                Serves:<br>
                <input type="number" name="serves" value="{{$recipe->serves}}" maxlength="4" size="4"><br>
                Prep Time:<br>
                <input type="number" name="prep_time" value="{{$recipe->prep_time}}" maxlength="4" size="4"><br>
                Cooking Time:<br>
                <input type="number" name="cook_time" value="{{$recipe->cook_time}}" maxlength="4" size="4"><br>
          </div>

          <br>
          @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div class="card">   
                <div>Indredient List</div>
           
                @if( count($ingredients) > 0 )

                
                    <div id="newIngredientHolder">
                    

                        <?php $count = 0; ?>

                        @foreach ($ingredients as $ingredient)

                        
                            <div id="ingredient-container-{{$ingredient->id}}" class="row ingredient-{{$ingredient->id}}" style="padding: 10px;">
                                <div class="col-md-1">
                                    <input type="number" name="ingredient[{{$count}}][qty]" value="{{$ingredient->qty}}" maxlength="4" size="4">
                                </div>
                                
                                <div class="col-md-2">
                                    <input type="text" name="ingredient[{{$count}}][unit]" value="{{$ingredient->unit}}">
                                </div>
                                
                                <div class="col-md-8">
                                    <input style="width: 100%" type="text" name="ingredient[{{$count}}][name]" value="{{$ingredient->name}}">
                                </div>
                                <div class="col-md-1 btn btn-danger removeIngredient" onclick="removeIngredient({{$ingredient->id}})">
                                    X
                                </div>
                                <input type="hidden" name="ingredient[{{$count}}][id]" value="{{$ingredient->id}}">
                                
                            </div>
                            
                        
                            <?php $count += 1; ?>

                        @endforeach
                        <div id="count_holder" style="display: none">
                            {{$count}}
                        </div>
                
                     </div>   
            


                @else
                    <div id="newIngredientHolder">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="number" name="ingredient[0][qty]">
                            </div>
                            
                            <div class="col-md-3">
                                <input type="text" name="ingredient[0][unit]">
                            </div>
                            
                            <div class="col-md-6">
                                <input type="text" name="ingredient[0][name]">
                            </div>
                        </div>
                        <br>
                    </div>
                    <div id="count_holder" style="display: none">0</div>
                @endif
            
                <div id="newIngredient" class="btn btn-primary" >
                    Add Another Ingredient
                </div>
            </div>
             <br>
            <div class="card">   
                <div>Steps</div>
           
                @if( count($steps) > 0 )

                
                    <div id="newStepHolder">
                    

                        <?php $step_count = 0; ?>

                        @foreach ($steps as $step)

                        
                            <div style="padding:10px" id="step-container-{{$step->id}}" class="row">
                                <div class="col-md-1">
                                    {{$step->step_no}}
                                </div>
                                
                                <div class="col-md-10">
                                    <input style="width: 100%;" type="text" name="step[{{$step_count}}][description]" value="{{$step->description}}">
                                </div>
                                <div class="col-md-1 btn btn-danger removeIngredient" onclick="removeStep({{$step->id}})">
                                    X
                                </div>
                                <input type="hidden" name="step[{{$step_count}}][id]" value="{{$step->id}}">
                            </div>
                           
                        
                            <?php $step_count += 1; ?>

                        @endforeach
                        <div id="step_count_holder" style="display: none">
                            {{$step_count}}
                        </div>
                
                     </div>   
            


                @else
                    <div id="newStepHolder">
                        <div class="row">
                            <div class="col-md-3">
                                1.
                            </div>
                            
                            <div class="col-md-3">
                                <input type="text" name="step[0][description]">
                            </div>
                            
                           
                        </div>
                        <br>
                    </div>
                    <div id="step_count_holder" style="display: none">0</div>
                @endif
            
                <div id="newStep" class="btn btn-primary" >
                    Add Another Step
                </div>
            </div>
   
        <input type="Submit">  
     </form>


           
        </div>
    </div>
</div>

@endsection
