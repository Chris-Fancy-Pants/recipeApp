@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          
            <div class="card">

             
               <h1 style="text-align: center;">
               {{$recipe->name}}
               @if(Auth::user() && Auth::user()->id == $recipe->created_by) 
               <a href="/recipe/edit/{{$recipe->id}}" class="btn btn-primary">edit</a>
               @endif
               </h1>
                <input id="csrf_token" type="hidden" name="_token" value="{{ csrf_token() }}">
               <div class="recipe-description">
                {{$recipe->description}}  
               </div>
               
                <div class="row info-container">

                    <div style="padding: 5px; " class="col-md-4">
                        <div style="padding: 5px; width: 90%; background-color: #ccc; border-radius: 10px;">
                            Serves<br>{{$recipe->serves}}
                        </div>
                    </div>
                    <div style="padding: 5px; " class="col-md-4">
                        <div style="padding: 5px; width: 90%; background-color: #ccc; border-radius: 10px;">
                            Prep time<br>{{$recipe->prep_time}}
                        </div>
                    </div>
                    <div style="padding: 5px; " class="col-md-4">
                        <div style="padding: 5px; width: 90%; background-color: #ccc; border-radius: 10px;">
                            Cook time<br>{{$recipe->cook_time}}
                        </div>
                    </div>
                </div>

           

                <div class="row">
                    <div class="col-md-5">
                        @foreach ($ingredients as $ingredient)

                            <div class="row" style="border: 1px solid #ccc; padding: 5px 0 5px 0">
                                <div class="col-md-2" style="padding: 0; text-align: center">
                                {{$ingredient->qty}}
                                </div>
                                
                                <div class="col-md-3" style="padding: 0; text-align: center">
                                    {{$ingredient->unit}}                                
                                    
                                </div>
                                
                                <div class="col-md-6" style="padding: 0;">
                                    {{$ingredient->name}}
                                </div>
                                
                                
                            </div>

                        @endforeach
                    
                    </div>

                    <div class="col-md-7">
                    
                        @foreach ($steps as $step)

                            <div class="row">
                                <div class="col-md-2">
                                    {{$step->step_no}}
                                </div>
                                <div class="col-md-10">
                                    {{$step->description}}
                                </div>
                            
                            </div>


                                    
                        @endforeach
                    </div>
                </div>
                
            </div>


                
            
                


           
        </div>
    </div>
</div>

@endsection
