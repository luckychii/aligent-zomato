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




//$get_result_list = callAPI('GET','',false);
//$result_list_object = json_decode($get_result_list); // decode the JSON feed



?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/nouislider.min.css">

    <link rel="stylesheet" href="css/custom.css">

</head>
<body>

    <div class="container">

        <div class="row filters">
            <div class="col-12 col-md-3">

                <div class="filter_block">
                    <p class="filter_heading">Category</p>
                    <?php
                    foreach($categories_object->categories as $category) {
                        if (in_array($category->categories->name, $valid_categories)) { ?>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="category<?= $category->categories->id; ?>">
                                <label class="custom-control-label" for="category<?= $category->categories->id; ?>"><?= $category->categories->name; ?></label>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

            </div>
            <div class="col-12 col-md-6">

                <div class="filter_block">
                    <p class="filter_heading">Cuisine</p>
                    <div class="three_columns">
                        <?php
                        foreach($cuisines_object->cuisines as $cuisine) {
                            if (in_array($cuisine->cuisine->cuisine_name, $valid_cuisines)) { ?>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="cuisine<?= $cuisine->cuisine->cuisine_id; ?>">
                                    <label class="custom-control-label" for="cuisine<?= $cuisine->cuisine->cuisine_id; ?>"><?= $cuisine->cuisine->cuisine_name; ?></label>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="cuisine110">
                            <label class="custom-control-label" for="cuisine110">Other</label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-3">


                <div class="filter_block">
                    <p class="filter_heading">Rating</p>
                    <div id="rating_slider" class="slider"></div>
                    <input type="hidden" id="rating_range" name="rating_range" value="0,5">

                    <p class="filter_heading">Cost</p>
                    <div id="cost_slider" class="slider"></div>
                    <input type="hidden" id="cost_range" name="cost_range" value="0,3">
                </div>


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
    <script src="js/custom.js"></script>

</body>
</html>
