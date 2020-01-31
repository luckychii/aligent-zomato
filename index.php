<?php

// api key: f13cb70db0f35158d3f963a643484b5e
// Adelaide = city_id 297
// Adelaide lat lon = 34.9285° S, 138.6007° E

function callAPI($method, $url, $data)
{
    $user_key = "f13cb70db0f35158d3f963a643484b5e";

    $curl = curl_init();

    // Curl options
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ['Accept: application/json', 'user-key: '.$user_key],
        CURLOPT_URL => $url,
    ));
    // ignore SSL certificate issues
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

    // Send the request
    $response = curl_exec($curl);

    // Check for errors if curl_exec fails
    if (!curl_exec($curl)) {
        die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
    }

    curl_close($curl);

    return $response;
}


$get_categories = callAPI('GET', 'https://developers.zomato.com/api/v2.1/categories', false);
$categories_object = json_decode($get_categories); // decode the JSON feed
$valid_categories = array('Dine-out', 'Takeaway', 'Delivery', 'Pubs & Bars');


$get_cuisines = callAPI('GET', 'https://developers.zomato.com/api/v2.1/cuisines?city_id=297', false);
$cuisines_object = json_decode($get_cuisines); // decode the JSON feed
$valid_cuisines = array('Cafe Food', 'Coffee and Tea', 'Pizza', 'Fast Food', 'Asian', 'Bakery', 'Italian', 'Sandwich', 'Chinese', 'Pub Food');


?>


<html>
    <head>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="stylesheet" href="css/nouislider.min.css"> <?php /* nouislider base*/ ?>

        <link rel="stylesheet" href="css/custom.css">


    </head>
    <body>

        <div class="container">

            <div class="row filters">
                <div class="col-12 col-md-3">

                    <p>Categories</p>
                    <?php
                    foreach($categories_object->categories as $category) {
                        if (in_array($category->categories->name, $valid_categories)) {
                            echo "<input type='checkbox' value='". $category->categories->id ."'>". $category->categories->name ."</input><br />";
                        }
                    }
                    ?>

                </div>
                <div class="col-12 col-md-6">

                    <p>Cuisine</p>
                    <?php
                    foreach($cuisines_object->cuisines as $cuisine) {
                        if (in_array($cuisine->cuisine->cuisine_name, $valid_cuisines)) {
                            echo "<input type='checkbox' value='". $cuisine->cuisine->cuisine_id ."'>". $cuisine->cuisine->cuisine_name ."</input><br />";
                        }
                    }
                    echo "<input type='checkbox' value='Other'>Other</input>";
                    ?>

                </div>
                <div class="col-12 col-md-3">

                    <?php //TODO: Rating slider and  Cost slider  ?>

                    <p>Rating</p>
                    <div id="rating_slider" class="slider"></div>

                    <p>Cost</p>
                    <div id="cost_slider" class="slider"></div>

                </div>
            </div>

            <div class="row bg-light">
                <div class="col-12 col-md-4">

                    <?php //TODO: Results list of restaurants ?>
                    <p>Results</p>

                </div>
                <div class="col-12 col-md-8">

                    <?php //TODO: Details of selected restaurant ?>
                    <p>Selected</p>

                </div>
            </div>

        </div>




        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


        <script src="js/nouislider.min.js"></script>

        <script>
            var slider = document.getElementById('rating_slider');

            noUiSlider.create(slider, {
                start: [0, 5],
                connect: true,
                range: {
                    'min': 0,
                    'max': 5
                },
                step: 1,
                pips: {
                    mode: 'range',
                    stepped: true,
                    density: -1,
                }
            });

            var slider = document.getElementById('cost_slider');

            var pipFormat = {'1':'$', '2':'', '3':'', '4':'$$$$'};
            noUiSlider.create(slider, {
                start: [1, 4],
                connect: true,
                range: {
                    'min': 1,
                    'max': 4
                },
                step: 1,
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

        </script>
    </body>
</html>
