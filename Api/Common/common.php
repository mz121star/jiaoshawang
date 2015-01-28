<?php

 /**
 *计算某个经纬度的周围某段距离的正方形的四个点
 *
 *@param lng float 经度
 *@param lat float 纬度
 *@param distance float 该点所在圆的半径，该圆与此正方形内切，默认值为0.5千米
 *@return array 正方形的四个点的经纬度坐标
 */
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

function filterAllParam($type = 'get') {
        $param = array();
        if ($type == 'get') {
            foreach ($_GET as $key => $value) {
                $param[$key] = $this->_get($key);
            }
        } elseif ($type == 'post') {
            foreach ($_POST as $key => $value) {
                $param[$key] = $this->_post($key);
            }
        } else {
            foreach ($_REQUEST as $key => $value) {
                $param[$key] = $this->_param($key);
            }
        }
        return $param;
    }