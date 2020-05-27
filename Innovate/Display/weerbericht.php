<?php
$cache_file = 'weatherdata.json';
if(file_exists($cache_file)){
  $weatherdata = json_decode(file_get_contents($cache_file));
}else{
  $api_url = 'https://content.api.nytimes.com/svc/weather/v2/current-and-seven-day-forecast.json';
  $weatherdata = file_get_contents($api_url);
  file_put_contents($cache_file, $weatherdata);
  $weatherdata = json_decode($weatherdata);
}

$current = $weatherdata->results->current[0];
$forecast = $weatherdata->results->seven_day_forecast;

?>


<?php
  function convert2cen($value,$unit){
    if($unit=='C'){
      return $value;
    }else if($unit=='F'){
      $cen = ($value - 32) / 1.8;
      	return round($cen,0);
      }
  }
?>

