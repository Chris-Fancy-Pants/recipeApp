<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use Auth;

class RecipeController extends Controller
{
   
    public function index()
    {
        return view('createRecipe');
    } 


    public function create(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|min:10',
            'serves' => 'numeric',
            'prep_time' => 'numeric',
            'cook_time' => 'numeric'

        ]);

        $validatedData['created_by'] = Auth::user()->id;


        

        $recipe = Recipe::create($validatedData);
        
        return redirect('recipe/edit/' . $recipe->id);
        //return redirect()->route('edit_recipe', ['id' => $recipe->id]);

        //dd($recipe);
    }

    public function edit($id) {


        $recipe = Recipe::find($id);


        return $recipe->name;


    }


}