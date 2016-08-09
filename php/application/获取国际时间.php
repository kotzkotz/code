<?php

function get_timee($country,$city='')
{
	$country = str_replace(' ', '', $country);
	$city = str_replace(' ', '', $city);
	$geocode_stats = furl("http://maps.googleapis.com/maps/api/geocode/json?address=$city+$country,&sensor=false");
	$output_deals = json_decode($geocode_stats);
	$latLng = $output_deals->results[0]->geometry->location;
	$lat = $latLng->lat;
	$lng = $latLng->lng;
	$google_time = furl("https://maps.googleapis.com/maps/api/timezone/json?location=$lat,$lng&timestamp=1331161200&key=AIzaSyAtpji5Vk271Qu6_QFSBXwK7wpoCQLY-zQ");
	$timez = json_decode($google_time);
	$d = new DateTime("now", new DateTimeZone($timez->timeZoneId));
	return  $d->format('Y-m-d H:i:s');
}

function furl($url){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $str = curl_exec($curl);
    curl_close($curl);
    return $str;
}

echo  get_timee("中国");

?>