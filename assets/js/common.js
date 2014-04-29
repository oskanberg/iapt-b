
// handy string utility
String.prototype.startsWith = function (str) {
    return this.slice(0, str.length) == str;
};

// localstorage only allows string storage
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
    $('#larger-font').on('click', function () {
        make_text_larger(3);
    });
    $('#smaller-font').on('click', function () {
        make_text_larger(3);
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

function make_text_larger(amount) {
    $('p, a, li').each(function () {
        var size = $(this).css('font-size');
        size = parseInt(size.replace('px', ''));
        size += amount;
        console.log('setting as ' + size);
        $(this).css('font-size', size + 'px');
    });
}

function make_text_smaller(amount) {
    $('p, a, li').each(function () {
        var size = $(this).css('font-size');
        size = parseInt(size.replace('px', ''));
        size -= amount;
        $(this).css('font-size', size + 'px');
    });
}