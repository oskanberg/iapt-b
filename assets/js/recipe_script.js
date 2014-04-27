
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

function click_format_button(format) {
    $('a.fmt').each(function () {
        if ($(this).text() == format) {
            $(this).click();
        }
    });
}

function request_and_build() {
    var recipe_id = window.location.hash;
    recipe_id = recipe_id.replace('#', '');
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: '/assessments/IAPT/002/01/index.php/json/recipe/' + recipe_id,
        //url: 'example_json.html'
    })
    .done(function (json_obj) {
        json_object = json_obj;
        // simulate a click on the relevant button
        click_format_button(localStorage['format_preference']);
    })
    .fail(function(jqXHR, status, error_thrown) {
        alert(status);
        alert(error_thrown);
        // TODO: implement good usability error thing
    });
}

function get_ordering_by_name(ordering_name, orderings_object) {
    for (var i = 0, ordering; ordering = orderings_object[i++];) {
        if (ordering.type == ordering_name) return ordering;
    }
    alert('whoopsie-shit');
    // TODO: friendlier warnings
}

function populate_recipe_data(format) {
    var recipe = json_object.recipe;
    // set title
    $('h1#recipe-name').text(recipe.title);
    var ordering = get_ordering_by_name(format, recipe.orderings);
    // add ingredients
    var ingredients = build_ingredients_array(ordering);
    for (var i = 0, ingredient; ingredient = ingredients[i++];) {
            $('ul#ingredients-list').append(
                $.el('li', {'class' : 'list-group-item'}, ingredient.name)
            );
    }

    // add steps
    var steps = ordering.steps;
    var is_narrative = format == 'Narrative' ? true : false;
    for (var i = 0, step; step = steps[i++];) {
        add_step(step, is_narrative);
    }

    // change breadcrumb
    $('ol.breadcrumb li.active').text(recipe.title);
}

function add_step(step, is_narrative) {
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
    var title = is_narrative ? 'Method' : 'Step ' + step.step_order;
    var $step_row = $('div#' + step.id + '-row');
    $step_row.append(
        $.el('h1',{},title)
    );

    // add step
    $step_row.append(
        $.el('p',{},step.operation)
    );
}

function build_ingredients_array(ordering) {
    var ingredients = [];
    var included_ids = [];
    for (var j = 0, step; step = ordering.steps[j++];) {
        for (var k = 0, ingredient; ingredient = step.ingredients[k++];) {
            // Some ingredients are used in multiple steps
            // make sure we don't double count
            if (included_ids.indexOf(ingredient.id) === -1) {
                included_ids.push(ingredient.id);
                ingredients.push(ingredient);
            }
        }
    }
    return ingredients;
}

$(document).ready(function () {
    if (localStorage['format_preference'] === undefined) {
        localStorage['format_preference'] = default_view;
    }
    $('a.fmt').on('click', function (event) {
        event.preventDefault();
        var format = $(this).text();
        // update persistent storage
        localStorage['format_preference'] = format;
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