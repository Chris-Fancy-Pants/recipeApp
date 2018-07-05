
var ingredient = 1
var step = 1

$( document ).ready(function() {
    $('#newIngredient').click(function() {
        console.log("CLICK")
        createNewIngredientField()
    })


    $('#newStep').click(function() {

        createNewStepField()
    
    })

});


function createNewStepField() {
    var stepCount = Number(document.getElementById('step_count_holder').innerText);
       
        
        
        
    if(stepCount > 0) {
        step = stepCount;
    }
    
    var holder = document.getElementById('newStepHolder')


    var newDiv = document.createElement('div')

    newDiv.className = "step"

    newDiv.innerHTML = '<div style="padding:10px" id="step-container-'+ step +'" class="row">\
                        <div class="col-md-1">' +
                        (step + 1) + '\
                        </div>\
                        <div class="col-md-10">\
                        <textarea style="width: 100%;" type="text" name="step[' + step + '][description]"></textarea>\
                        </div>\
                        <div class="col-md-1 btn btn-danger removeStep" onclick="removeStep(' + step + ')">\
                        X\
                        </div>\
                        </div>\
                        <br>'

    holder.appendChild(newDiv)

    step += 1
}




function createNewIngredientField() {


    var ingredientCount = Number(document.getElementById('count_holder').innerText);
   
    
    
    
    if(ingredientCount > 0) {
        ingredient = ingredientCount;
    }
    
    var holder = document.getElementById('newIngredientHolder')


    var newDiv = document.createElement('div')

    newDiv.className = "ingredient"
    newDiv.id = "ingredient-container-" + ingredient;

    newDiv.innerHTML = '<div class="row">\
                        <div class="col-md-2">\
                        <input style="width: 90%; text-align: center;" type="number" step="any" name="ingredient[' + ingredient + '][qty]" maxlength="4" size="4">\
                        </div>\
                        <div class="col-md-2">\
                        <select style="width: 100%" name="ingredient[' + ingredient + '][unit]">\
                        <option value="g">g</option>\
                        <option value="kg">kg</option>\
                        <option value="cup">cup</option>\
                        <option value="tsp">tsp</option>\
                        <option value="tbsp">tbsp</option>\
                        <option value="ml">ml</option>\
                        <option value="l">l</option>\
                        <option value="clove">clove</option>\
                        </select>\
                        </div>\
                        <div class="col-md-7">\
                        <input style="width: 100%" type="text" name="ingredient[' + ingredient + '][name]">\
                        </div>\
                        <div class="col-md-1 btn btn-danger removeIngredient" onclick="removeIngredient(' + ingredient + ')">\
                            X\
                        </div>\
                        </div>\
                        <br>'










    holder.appendChild(newDiv)

    ingredient += 1
    ingredientCount += 1
    document.getElementById('count_holder').innerText = ingredientCount


}





function removeIngredient(id) {
    
    var csrf_token = $("#csrf_token").val();
    
    var newID = Number(id) + 90;

    $.ajax({
        type: 'POST',
        url: "/recipe/remove-ingredient",

        data: {id: id, _token: csrf_token},

    
      }).done(function(e) {
        if(e) {
            $("#ingredient-container-" + id).remove();
            var ingredientCount = Number(document.getElementById('count_holder').innerText);
            
            
            ingredientCount -= 1;
            document.getElementById('count_holder').innerText = ingredientCount
            if(ingredientCount === 0) {
                createNewIngredientField()
            }
            console.log("Count: " + ingredientCount)
        }
        
      });
}


function removeStep(id) {
    var csrf_token = $("#csrf_token").val();

    $.ajax({
        type: 'POST',
        url: "/recipe/remove-step",

        data: {id: id, _token: csrf_token},

    
      }).done(function(e) {
        if(e) {
            $("#step-container-" + id).remove();
            var stepCount = Number(document.getElementById('step_count_holder').innerText);
            
            
            stepCount -= 1;
            document.getElementById('step_count_holder').innerText = stepCount
            if(stepCount === 0) {
                createNewIngredientField()
            }
            console.log("Step Count: " + stepCount)
        }
        
      });

}

function deleteRecipe(id) {
    var csrf_token = $("#csrf_token").val();

    $.ajax({
        type: 'POST',
        url: "/recipe/delete-recipe",

        data: {id: id, _token: csrf_token},

    
      }).done(function(e) {
        if(e) {
            $("#recipe-holder-" + id).remove();
        }
        
      });
}

