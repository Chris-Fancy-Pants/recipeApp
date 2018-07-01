<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Ingredient;
use App\Step;
use Auth;

class RecipeController extends Controller
{
   
    public function index()
    {
        return view('createRecipe');
    } 


    public function create(Request $request){

        $recipeData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|min:10',
            'serves' => 'numeric',
            'prep_time' => 'numeric',
            'cook_time' => 'numeric'

        ]);



        $recipeData['created_by'] = Auth::user()->id;


        

        $recipe = Recipe::create($recipeData);
        
        return redirect('recipe/edit/' . $recipe->id);
        //return redirect()->route('edit_recipe', ['id' => $recipe->id]);

        //dd($recipe);
    }


    public function update(Request $request) {

      
        $recipeData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|min:10',
            'serves' => 'numeric',
            'prep_time' => 'numeric',
            'cook_time' => 'numeric'

        ]);
        $recipe = Recipe::find($request->id);

        if($recipe->created_by != Auth::user()->id) {
            return "You do not have permission to edit this entry";
        }


        $ingredientArray = $request->ingredient;
        

        foreach($ingredientArray as $ing) {


            if(isset($ing['id'])) {                
                
                $ingredient = Ingredient::find($ing['id']);
                $ingredient->recipe_id = $recipe->id;
                $ingredient->name = $ing['name'];
                $ingredient->qty = $ing['qty'];
                $ingredient->unit = $ing['unit'];
                $ingredient->save();
                

            } else {


                $ingredient = new Ingredient();
                $ingredient->recipe_id = $recipe->id;
                $ingredient->name = $ing['name'];
                $ingredient->qty = $ing['qty'];
                $ingredient->unit = $ing['unit'];
                $ingredient->save();
            }

         }

         $stepsArray = $request->step;
        
         $step_count = 1;

         foreach($stepsArray as $st) {
 
 
             if(isset($st['id'])) {                
                 
                 $step = Step::find($st['id']);
                 $step->recipe_id = $recipe->id;
                 $step->step_no = $step_count;
                 $step->description = $st['description'];
                 
                 $step->save();
                 
 
             } else {
 
 
                 $step = new Step();
                 $step->recipe_id = $recipe->id;
                 $step->step_no = $step_count;
                 $step->description = $st['description'];                 
                 $step->save();

             }
             $step_count += 1;
          }


        $ingredients = Ingredient::where('recipe_id', '=', $recipe->id)->get();
        $steps = Step::where('recipe_id', '=', $recipe->id)->get();
        return view('editRecipe', ['recipe' => $recipe, 'ingredients' => $ingredients, 'steps' => $steps]);

    }


    public function edit($id) {


        $recipe = Recipe::find($id);
        $ingredients = Ingredient::where('recipe_id', '=', $recipe->id)->get();
        $steps = Step::where('recipe_id', '=', $recipe->id)->get();

        return view('editRecipe', ['recipe' => $recipe, 'ingredients' => $ingredients, 'steps' => $steps]);


    }




}
