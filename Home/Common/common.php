<?php

function getSquarePoint($lng, $lat, $distance = 0.5){
    $earth_radius = 6371;//地球半径，平均半径为6371km

    $dlng =  2 * asin(sin($distance / (2 * $earth_radius)) / cos(deg2rad($lat)));
    $dlng = rad2deg($dlng);

    $dlat = $distance/$earth_radius;
    $dlat = rad2deg($dlat);

    return array(
                            'left-top'=>array('lat'=>$lat + $dlat,'lng'=>$lng - $dlng),
                            'right-top'=>array('lat'=>$lat + $dlat, 'lng'=>$lng + $dlng),
                            'left-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng - $dlng),
                            'right-bottom'=>array('lat'=>$lat - $dlat, 'lng'=>$lng + $dlng)
                            );
}