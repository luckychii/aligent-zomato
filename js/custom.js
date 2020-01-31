

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
    updateResults();
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
    updateResults();
});



$( "#filters input[type='checkbox']" ).on( "click", function(){
    if ($(this).prop('checked')){
        $(this).attr('value', 1);
    } else {
        $(this).attr('value', 0);
    }
});

//ajax call for filter update
$("#filters :input").change(function(){
    updateResults();
});

function updateResults() {
    $.ajax({
        type: "POST",
        data: $("#filters").serialize(),
        url: "/results.php", success: function(result){
            $("#results").html(result);
        }
    });
}

function updateSelected(restaurant_id) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        data: "restaurant_id="+restaurant_id,
        url: "/selected.php", success: function(result){
            $("#selected").html(result);
        }
    });
}