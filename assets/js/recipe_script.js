
$.extend({
    el: function(el, props, innerHTML) {
        var $el = $(document.createElement(el));
        $el.attr(props);
        if (typeof innerHTML !== 'undefined') {
            $el.text(innerHTML);
        }
        return $el;
    }
});

var json_object;
var default_view = 'Narrative';

function request_and_build() {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: 'example_json_recipe.html',
    })
    .done(function (json_obj) {
        json_object = json_obj;
        populate_recipe_data(default_view);
    })
    .fail(function(jqXHR, status, error_thrown) {
        alert(status);
        alert(error_thrown);
        // TODO: implement good usability error thing
    });
}

function populate_recipe_data(format) {
    var recipe = json_object.recipe;
    // set title
    $('h1#recipe-name').text(recipe.title);
    var ordering = recipe.orderings[format];
    // add ingredients
    var ingredients = build_ingredients_array(ordering);
    for (var i = 0, ingredient; ingredient = ingredients[i++];) {
            $('ul#ingredients-list').append(
                $.el('li', {'class' : 'list-group-item'}, ingredient.name)
            );
    }

    // add steps
    var steps = ordering.steps;
    for (var i = 0, step; step = steps[i++];) {
        add_step(step);
    }

}

function add_step(step) {
    var $method_section = $('div#method');
    // add a divider
    $method_section.append(
        $.el('div', {'class':'container'}).append(
            $.el('hr', {'class':'row featurette-divider'})
        )
    );

    // add step
    $method_section.append(
        $.el('div',{'class':'container light-bg rounded-corners outer-shadow padded'}).append(
            $.el('div',{'class':'row featurette', 'id':step.id + '-row'})
        )
    );

    // add title
    var $step_row = $('div#' + step.id + '-row');
    $step_row.append(
        $.el('h1',{},'Step ' + step.id)
    );

    // add step
    $step_row.append(
        $.el('p',{},step.operation)
    );
}

function build_ingredients_array(ordering) {
    var ingredients = [];
    for (var j = 0, step; step = ordering.steps[j++];) {
        ingredients = ingredients.concat(step.ingredients);
    }
    return ingredients;
}

$(document).ready(function () {
    $('a.fmt').on('click', function (event) {
        event.preventDefault();
        var format = $(this).text();
        // remove current ingredients
        $('ul#ingredients-list').empty();
        // remove current method
        $('div#method').empty();
        // populate with the new format
        populate_recipe_data(format);
        // update buttons
        $('ul.nav-pills li').each( function () {
            $(this).removeClass('active');
        });
        $(this).parent().addClass('active');
    });
    request_and_build();
});