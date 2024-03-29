// extend JQuery to allow easier HTML element creation
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


// get info from the API
function request_and_build() {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: '/assessments/IAPT/002/01/index.php/json/index',
        //url: 'example_category_json.html'
    })
    .done(populate_category)
    .fail(function(jqXHR, status, error_thrown) {
        $.notify('The page has failed to load. Please try again or get in contact.', {globalPosition: 'top center'});
    });
}

// categories not indexed by id, so use this to find one
function get_category_by_id(category_id, categories_object) {
    for (var i = 0, category; category = categories_object[i++];) {
        if (category.id == category_id) return category;
    }
    $.notify('Category could not be found. Please go back and try again.', {globalPosition: 'top center'});
}

// add data from the API to the container
function populate_category(json_object) {
    var category_id = window.location.hash;
    category_id = category_id.replace('#', '');
    var category = get_category_by_id(category_id, json_object.categories);

    var $carousels = $('div#carousels');
    $carousels.append(
        $.el('div', {'class':'row inner-shadow'})
    );

    // Add all of the recipes
    // Future development may like to limit the number displayed
    var $row = $('div.row');
    for (var j = 0, recipe; recipe = category.category_recipes[j++];) {
        $row.append(
            $.el('div', {'class':'col-xs-3'}).append(
                $.el('a', {
                    'href':'../../recipe/view#' + recipe.id,
                    'class':'thumbnail',
                    'title' : 'click to view ' + recipe.title,
                    'style' : 'background-image:url(' + recipe.image + ')'
                }, 'click to view ' + recipe.title),
                $.el('div', {'class':'carousel-caption'}).append(
                    $.el('a',{
                        'tabindex' : '-1',
                        'href':'../../recipe/view#' + recipe.id,
                        'title' : 'click to view ' + recipe.title
                    }, recipe.title)
                )
            )
        );
    }

    // change breadcrumb
    $('ol.breadcrumb li.active').text(category.name);
}


// go!
request_and_build();