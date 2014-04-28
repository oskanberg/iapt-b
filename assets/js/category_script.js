
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


function request_and_build() {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: '/assessments/IAPT/002/01/index.php/json/index',
        //url: 'example_category_json.html'
    })
    .done(populate_category)
    .fail(function(jqXHR, status, error_thrown) {
        alert(status);
        alert(error_thrown);
        // TODO: implement good usability error thing
    });
}


function get_category_by_id(category_id, categories_object) {
    for (var i = 0, category; category = categories_object[i++];) {
        if (category.id == category_id) return category;
    }
    alert('whoopsie-shit');
    // TODO: friendlier warnings
}

function populate_category(json_object) {
    var category_id = window.location.hash;
    category_id = category_id.replace('#', '');
    var category = get_category_by_id(category_id, json_object.categories);

    var $carousels = $('div#carousels');
    $carousels.append(
        $.el('div', {'class':'row inner-shadow'})
    );

    // Add all of the recipes
    // Future development may like to limit this in some way
    var $row = $('div.row');row_id
    for (var j = 0, recipe; recipe = category.category_recipes[j++];) {
        $row.append(
            $.el('div', {'class':'col-xs-3'}).append(
                $.el('a', {'href':'index.php/recipe/view#' + recipe.id,'class':'thumbnail'}).append(
                    $.el('img', {'src':'http://placehold.it/300x200'})
                ),
                $.el('div', {'class':'carousel-caption'}).append(
                    $.el('a',{'href':'index.php/recipe/view#' + recipe.id}, recipe.title)
                )
            )
        );
    }

    // change breadcrumb
    $('ol.breadcrumb li.active').text(category.name);
}

request_and_build();