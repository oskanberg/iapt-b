
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
var default_view = 'Step By Step';
var notify = true;

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
        // but don't notify
        notify = false;
        click_format_button(localStorage['format_preference']);
    })
    .fail(function(jqXHR, status, error_thrown) {
        $.notify('The page has failed to load. Please try again or get in contact.', {globalPosition: 'top center'});
    });
}

function get_ordering_by_name(ordering_name, orderings_object) {
    for (var i = 0, ordering; ordering = orderings_object[i++];) {
        if (ordering.type == ordering_name) return ordering;
    }
    $.notify('Recipe not loaded correctly. Please try again or get in contact.', {globalPosition: 'top center'});
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
            $.el('li', {'class' : 'list-group-item'}, ingredient.name  + ' ').append(
                $.el('a', {
                    'href':ingredient.link,
                    'target' : '_blank',
                    'title' : 'click to view information about ' + ingredient.name
                }).append(
                    $.el('span', {'class':'glyphicon glyphicon-new-window'})
                )
            )
        );
    }

    // add steps
    var steps = ordering.steps;
    for (var i = 0, step; step = steps[i++];) {
        add_step(step, format);
    }

    // add image
    $('div.recipe-img-crop').css('background-image', 'url(' + recipe.image + ')');

    // change breadcrumb
    $('ol.breadcrumb li.active').text(recipe.title);
    $('ol.breadcrumb li#category').empty();
    $('ol.breadcrumb li#category').append(
        $.el('a', {
            'href':'../categories/category/view#' + recipe.category_id,
            'title' : 'click to go back to ' + recipe.category
        })
    );
    $('ol.breadcrumb li#category a').text(recipe.category);

}

function add_step(step, format) {
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

    var title = format == 'Narrative' ? 'Method' : 'Step ' + step.step_order;
    var $step_row = $('div#' + step.id + '-row');

    // add step operation
    $step_row.append(
        $.el('div', {'class':'col-md-7'}).append(
            $.el('h1',{},title),
            $.el('p',{},step.operation)
        )
    );

    // if it's step-by-step add step ingredients
    if (format == 'Step By Step') {
        var step_ingredients_id = 'step' + step.id + '-ingredients';
        $step_row.append(
            $.el('div', {'class':'col-md-5'}).append(
                $.el('h2', {}, 'You will need'),
                $.el('ul', {'id': step_ingredients_id, 'class':'list-group'})
            )
        );
        for (var i = 0, ingredient; ingredient = step.ingredients[i++];) {
            $('ul#' + step_ingredients_id).append(
                $.el('li', {'class' : 'list-group-item'}, ingredient.name  + ' ').append(
                    $.el('a', {
                        'href':ingredient.link,
                        'target' : '_blank',
                        'title' : 'click to view information about ' + ingredient.name
                    }).append(
                        $.el('span', {'class':'glyphicon glyphicon-new-window'})
                    )
                )
            );
        }
    }
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
        // notify success
        if (notify) {
            $('*[data-notify-text]').click();
            $(this).notify('Recipe format changed', 'success', {'position' : 't'});
        } else {
            // notify next time unless something says not to
            notify = true;
        }
    });
    request_and_build();
});