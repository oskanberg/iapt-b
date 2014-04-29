
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
            $.el('h2', {}).append(
                $.el('a', {'href':'index.php/categories/category/view#' + category.id}, category.name)
            )
        );

        // add one carousel with one active row
        var rows = 0;
        var carousel_id = category.id + '-carousel';
        var row_id = category.id + '-row-' + rows;
        var inner_id = category.id + '-inner';


        //$carousels.append(
        //    $.el('div', {'id':carousel_id, 'class':'carousel slide'}).append(
        //        $.el('div', {'id': inner_id, 'class':'carousel-inner'}).append(
        //            $.el('div', {'class':'item active'}).append(
        //                $.el('div', {'id':row_id,'class':'row inner-shadow'})
        //            )
        //        )
        //    )
        //);

        $carousels.append(
            $.el('div', {'id':row_id,'class':'row inner-shadow'})
        );

        // add recipes to this carousel
        var section_recipes_remaining = RECIPES_PER_SECTION;
        var recipes = category.category_recipes;
        var $row = $('div#' + row_id);
        for (var j = 0, recipe; recipe = recipes[j++];) {
            if (section_recipes_remaining === 0) {
                //rows++;
                //row_id = category.id + '-row-' + rows;
                //$('div#' + inner_id).append(
                //    $.el('div', {'class':'item'}).append(
                //        $.el('div', {'id':row_id,'class':'row inner-shadow'})
                //    )
                //);
                //$row = $('div#' + row_id);
                //section_recipes_remaining = RECIPES_PER_SECTION;

                // don't build hidden elements (for accessibility)
                // just forget about the rest (let the user click more...)
                break;
            }
            $row.append(
                $.el('div', {'class':'col-xs-3'}).append(
                    $.el('a', {
                        'href':'index.php/recipe/view#' + recipe.id,
                        'class':'thumbnail',
                        'title' : 'click to view ' + recipe.title,
                        'style' : 'background-image:url(' + recipe.image + ')'
                    }, 'click to view ' + recipe.title),
                    $.el('div', {'class':'carousel-caption'}).append(
                        $.el('a',{
                            'tabindex' : '-1',
                            'href':'index.php/recipe/view#' + recipe.id,
                            'title' : 'click to view ' + recipe.title
                        }, recipe.title)
                    )
                )
            );
            section_recipes_remaining--;
        }

        // add 'more' button
        // <a class="btn btn-default navbar-right" href="#" role="button">See more Main Meals »</a>
        $row.after(
            $.el('a', {
                'href':'index.php/categories/category/view#' + category.id,
                'class':'btn btn-default navbar-right',
                'title' : 'click to view ' + category.name
            }, 'See more ' + category.name + ' \u00bb')
        );

        // add controls
        //var $carousel = $('div#' + carousel_id);
        //$carousel.append(
        //    $.el('a', {
        //        'class':'left carousel-control',
        //        'href':'#'+carousel_id,
        //        'data-slide':'prev'
        //    }, '<')
        //);
        //$carousel.append(
        //    $.el('a', {
        //        'class':'right carousel-control',
        //        'href':'#'+carousel_id,
        //        'data-slide':'next'
        //    }, '>')
        //);
    }
}

request_and_build();