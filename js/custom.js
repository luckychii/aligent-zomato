

//Initialise NoUISliders
var ratingSlider = document.getElementById('rating_slider');
noUiSlider.create(ratingSlider, {
    start: [0, 5],
    connect: true,
    range: {
        'min': 0,
        'max': 5
    },
    step: 1,
    format: {
        from: function(value) {
            return parseInt(value);
        },
        to: function(value) {
            return parseInt(value);
        }
    },
    pips: {
        mode: 'range',
        stepped: true,
        density: -1,
    }
});
ratingSlider.noUiSlider.on('set.one', function () {
    document.getElementById('rating_range').value = ratingSlider.noUiSlider.get();
});


var costSlider = document.getElementById('cost_slider');
var pipFormat = {'0':'$', '1':'', '2':'', '3':'$$$$'};
noUiSlider.create(costSlider, {
    start: [0, 3],
    connect: true,
    range: {
        'min': 0,
        'max': 3
    },
    step: 1,
    format: {
        from: function(value) {
            return parseInt(value);
        },
        to: function(value) {
            return parseInt(value);
        }
    },
    pips: {
        mode: 'range',
        stepped: true,
        density: -1,
        format: {
            to: function(pip){
                return pipFormat[pip];
            }
        }
    }
});
costSlider.noUiSlider.on('set.one', function () {
    document.getElementById('cost_range').value = costSlider.noUiSlider.get();
});