
// handy string utility
String.prototype.startsWith = function (str) {
    return this.slice(0, str.length) == str;
};

// localStorage only allows string storage
// makes handling of booleans annoying
Storage.prototype.invertBoolValue = function (key) {
    if (this.getItem(key) === 'true') {
        this.setItem(key, 'false');
    } else {
        this.setItem(key, 'true');
    }
};

var default_preferences = {
    'style-high-contrast-colours' : false,
    'style-regular-colours' : true,
};

$(document).ready(function () {
    if (localStorage['style-high-contrast-colours'] === undefined) {
        for (var key in default_preferences) {
            localStorage[key] = default_preferences[key];
        }
    }

    // restore some font size preference
    if (localStorage['font_size_offset'] === undefined) {
        localStorage['font_size_offset'] = '0';
    } else {
        var offset = parseInt(localStorage['font_size_offset']);
        change_text_size(offset);
    }

    // add link to header
    $('div.jumbotron .container h1').on('click', function() {
        window.location = 'http://www-student.cs.york.ac.uk/assessments/IAPT/002/01/';
    });
    $('div.jumbotron .container h1').css('cursor', 'pointer');
    load_style_preferences();
    $('#high-contrast').on('click', function (event) {
        event.preventDefault();
        localStorage.invertBoolValue('style-high-contrast-colours');
        localStorage.invertBoolValue('style-regular-colours');
        load_style_preferences();
    });
    $('#larger-font').on('click', function (event) {
        event.preventDefault();
        change_text_size(3);
        // update preference
        var offset = parseInt(localStorage['font_size_offset']);
        offset += 3;
        localStorage['font_size_offset'] = offset;
    });
    $('#smaller-font').on('click', function (event) {
        event.preventDefault();
        change_text_size(-3);
        // update preference
        var offset = parseInt(localStorage['font_size_offset']);
        offset -= 3;
        localStorage['font_size_offset'] = offset;
    });
});

function load_style_preferences() {
    // reset
    $('link[rel="stylesheet"]').prop('disabled', false);
    for (var key in localStorage) {
        if (key.startsWith('style') && localStorage[key] === 'false') {
            // disable that style
            console.log('disabling ' + key);
            $('#' + key).prop('disabled', true);
        }
    }
    if (localStorage['style-high-contrast-colours'] === 'true') {
        $('#high-contrast').text('Regular Colours');
    } else {
        $('#high-contrast').text('High Contrast');
    }

}

function change_text_size(amount) {
    $('body, p, a, li').each(function () {
        var size = $(this).css('font-size');
        size = parseInt(size.replace('px', ''));
        size += amount;
        $(this).css('font-size', size + 'px');
    });
}