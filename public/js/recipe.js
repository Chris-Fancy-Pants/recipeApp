
var ingredient = 1
var step = 1

document.getElementById('newIngredient').onclick = function() {


    createNewIngredientField()
   

}


function createNewIngredientField() {


    var ingredientCount = Number(document.getElementById('count_holder').innerText);
   
    
    
    
    if(ingredientCount > 0) {
        ingredient = ingredientCount;
    }
    
    var holder = document.getElementById('newIngredientHolder')


    var newDiv = document.createElement('div')

    newDiv.className = "ingredient"

    newDiv.innerHTML = '<div class="row">\
                        <div class="col-md-3">\
                        <input type="number" name="ingredient[' + ingredient + '][qty]">\
                        </div>\
                        <div class="col-md-3">\
                        <input type="text" name="ingredient[' + ingredient + '][unit]">\
                        </div>\
                        <div class="col-md-6">\
                        <input type="text" name="ingredient[' + ingredient + '][name]">\
                        </div>\
                        </div>\
                        <br>'

    holder.appendChild(newDiv)

    ingredient += 1
    ingredientCount += 1
    document.getElementById('count_holder').innerText = ingredientCount


}



document.getElementById('newStep').onclick = function() {

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
                        <input style="width: 100%;" type="text" name="step[' + step + '][description]">\
                        </div>\
                        <div class="col-md-1 btn btn-danger removeStep" onclick="removeStep' + step + ')">\
                        X\
                        </div>\
                        </div>\
                        <br>'

    holder.appendChild(newDiv)

    step += 1

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

