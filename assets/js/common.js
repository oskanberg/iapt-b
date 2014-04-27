
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
}

var default_preferences = {
    'style-high-contrast-colours' : false,
    'style-regular-colours' : true,
    'style-larger-fonts' : false
};

$(document).ready(function () {
    if (localStorage['style-larger-fonts'] === undefined) {
        for (var key in default_preferences) {
            localStorage[key] = default_preferences[key];
        }
    }

    load_style_preferences();
    $('#high-contrast').on('click', function (event) {
        event.preventDefault();
        localStorage.invertBoolValue('style-high-contrast-colours');
        localStorage.invertBoolValue('style-regular-colours');
        load_style_preferences();
    });
    $('#large-font').on('click', function (event) {
        event.preventDefault();
        localStorage.invertBoolValue('style-larger-fonts');
        load_style_preferences();
    });
});

function load_style_preferences() {
    // reset
    $('link[rel="stylesheet"]').removeAttr('disabled');
    for (var key in localStorage) {
        if (key.startsWith('style') && localStorage[key] === 'false') {
            // disable that style
            console.log('disabling ' + key);
            $('#' + key).attr('disabled', 'disabled');
        }
    }
    if (localStorage['style-high-contrast-colours'] === 'true') {
        $('#high-contrast').text('Regular Colours');
    } else {
        $('#high-contrast').text('High Contrast');
    }
    if (localStorage['style-larger-fonts'] === 'true') {
        $('#large-font').text('Regular Font');
    } else {
        $('#large-font').text('Larger Font');
    }

}