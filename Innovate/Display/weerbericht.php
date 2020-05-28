<?php
$cache_file = 'weatherdata.json';
if(file_exists($cache_file)){
  $weatherdata = json_decode(file_get_contents($cache_file));
}else{
  $api_url = 'http://weerlive.nl/api/json-data-10min.php?key=00ac1da8ca&locatie=Emmen';
  $weatherdata = file_get_contents($api_url);
  file_put_contents($cache_file, $weatherdata);
  $weatherdata = json_decode($weatherdata);
}

$current = $weatherdata->liveweer[0];
$temperatuur= $current->temp;
$samenvatting =$current->samenv;
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

<?php
// PHP program to delete a file named gfg.txt  
// using unlike() function  
   
$file_pointer = "weatherdata.json";  
   
// Use unlink() function to delete a file  
if (!unlink($file_pointer)) {  
      
}  
else {  
    
}  
  

?>