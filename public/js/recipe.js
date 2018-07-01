
var ingredient = 1
var step = 1

document.getElementById('newIngredient').onclick = function() {

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

}


document.getElementById('newStep').onclick = function() {

    var stepCount = Number(document.getElementById('step_count_holder').innerText);
   
    
    
    
    if(stepCount > 0) {
        ingredient = stepCount;
    }
    
    var holder = document.getElementById('newStepHolder')


    var newDiv = document.createElement('div')

    newDiv.className = "step"

    newDiv.innerHTML = '<div class="row">\
                        <div class="col-md-3">' +
                        (step + 1) + '\
                        </div>\
                        <div class="col-md-3">\
                        <input type="text" name="step[' + step + '][description]">\
                        </div>\
                        </div>\
                        <br>'

    holder.appendChild(newDiv)

    step += 1

}


function removeIngredient(id) {
    alert("Removing: " + id)
}

