
$.extend({
    el: function(el, props, innerHTML) {
        var $el = $(document.createElement(el));
        $el.attr(props);
        if (typeof innerHTML !== 'undefined') {
            console.log(innerHTML);
            $el.text(innerHTML);
        }
        return $el;
    }
});


function request_and_build() {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: '/index.php/json/index',
    })
    .done(create_carousels)
    .fail(function(jqXHR, status, error_thrown) {
        alert(status);
        alert(error_thrown);
        // TODO: implement good usability error thing
    });
}


var RECIPES_PER_SECTION = 4;

function create_carousels(json_object) {
    var categories = json_object.categories;
    var $carousels = $('div#carousels');
    for (var i = 0, category; category = categories[i++];) {

        // add title
        $carousels.append(
            $.el('div', {'id':category.id +'-title', 'class':'container cat-title'})
        );
        $('div#' + category.id + '-title').append(
            '<h2>' + category.name + '</h2>'
        );

        // add one carousel with one active row
        var rows = 0;
        var carousel_id = category.id + '-carousel';
        var row_id = category.id + '-row-' + rows;
        var inner_id = category.id + '-inner';

        $carousels.append(
            $.el('div', {'id':carousel_id, 'class':'carousel slide'}).append(
                $.el('div', {'id': inner_id, 'class':'carousel-inner'}).append(
                    $.el('div', {'class':'item active'}).append(
                        $.el('div', {'id':row_id,'class':'row inner-shadow'})
                    )
                )
            )
        );

        // add recipes to this carousel
        var section_recipes_remaining = RECIPES_PER_SECTION;
        var recipes = category.category_recipes;
        var $row = $('div#' + row_id);
        for (var j = 0, recipe; recipe = recipes[j++];) {
            if (section_recipes_remaining === 0) {
                rows++;
                row_id = category.id + '-row-' + rows;
                $('div#' + inner_id).append(
                    $.el('div', {'class':'item'}).append(
                        $.el('div', {'id':row_id,'class':'row inner-shadow'})
                    )
                );
                $row = $('div#' + row_id);
                section_recipes_remaining = RECIPES_PER_SECTION;
            }
            $row.append(
                $.el('div', {'class':'col-xs-3'}).append(
                    $.el('a', {'href':'#','class':'thumbnail'}).append(
                        $.el('img', {'src':'http://placehold.it/300x200'})
                    ),
                    $.el('div', {'class':'carousel-caption'}).append(
                        $.el('a',{'href':'#'}, recipe.title)
                    )
                )
            );
            section_recipes_remaining--;
        }

        // add controls
        var $carousel = $('div#' + carousel_id);
        $carousel.append(
            $.el('a', {
                'class':'left carousel-control',
                'href':'#'+carousel_id,
                'data-slide':'prev'
            }, '<')
        );
        $carousel.append(
            $.el('a', {
                'class':'right carousel-control',
                'href':'#'+carousel_id,
                'data-slide':'next'
            }, '>')
        );
    }
}

request_and_build();