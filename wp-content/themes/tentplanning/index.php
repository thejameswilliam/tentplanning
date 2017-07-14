<?php

get_header();
require_once 'unirest-php/src/Unirest.php';
?>

<body <?php body_class(); ?>>
<?php





//// These code snippets use an open-source library. http://unirest.io/php
//$response = Unirest\Request::get("https://developer.nps.gov/api/v0/parks?limit=0&fields=images&parkCode=yell",
//    array(
//        "Authorization" => "2F34B000-4B15-4EF5-A097-97819D565B3F",
//        //"Accept" => "text/plain"
//    )
//);
//
//echo '<pre>';
//echo '<ul>';
//
//
////var_dump($response->body->data);
//foreach($response->body->data as $park) :
//    echo '<div class="col-md-12">';
//    $images = $park->images;
//    foreach($images as $image) :
//        $src = $image->url;
//        echo '<img src="' . $src . '" />' . '</br>';
//    endforeach;
//    echo '</div>';
//endforeach;
//echo '</ul>';
//echo '</pre>';


// These code snippets use an open-source library. http://unirest.io/php
$hiking_response = Unirest\Request::get("https://trailapi-trailapi.p.mashape.com/?lat=35.645021&lon=-105.367126&limit=12&radius=100&q[activities_activity_type_name_eq]=hiking",
    array(
        "X-Mashape-Key" => "xDVKljpz16mshktrjDpCiB8N2gXJp1KnwKOjsnmeVbZSi0900R",
        "Accept" => "text/plain"
    )
);

echo '<div class="container-fluid">';
    $places = $hiking_response->body->places;
    $place_names = array();
    echo '<div class="row">';
        $i = 1;
        foreach($places as $place) :
            $activities = $place->activities;
            if($activities) :
                foreach($activities as $activity) :
                    $name = $activity->name;
                    echo '<div class="col-md-2">';
                    echo '<div class="col-md-12 hiking-names">' . $name . '</div>';
                    echo '</div>';
                endforeach;
            endif;
        if($i == 6){$i=0; echo '</div><div class="row">';}
        $i++;
        endforeach;

    echo '</div>';

//    $camping_response = Unirest\Request::get("https://trailapi-trailapi.p.mashape.com/?lat=35.645021&lon=-105.367126&limit=12&radius=100&q[activities_activity_type_name_eq]=camping",
//        array(
//            "X-Mashape-Key" => "xDVKljpz16mshktrjDpCiB8N2gXJp1KnwKOjsnmeVbZSi0900R",
//            "Accept" => "text/plain"
//        )
//    );
//    $places = $camping_response->body->places;
//    $place_names = array();
//    echo '<div class="row">';
//    foreach($places as $place) :
//        $activities = $place->activities;
//        if($activities) :
//            foreach($activities as $activity) :
//                $name = $activity->name;
//
//                echo '<div class="col-md-2 camping-names">' . $name . '</div>';
//
//            endforeach;
//        endif;
//    endforeach;
//    echo '</div>';


echo '</div>';
get_footer();
echo '</body>';