<?php 
	//RSS Feed van tweakers.net
	$feed  = "http://feeds.feedburner.com/tweakers/mixed";
	$xml11 = simplexml_load_file($feed);
	$xml12 = simplexml_load_file($feed);
	foreach ($xml11->channel->item as $item2)
	{
		echo 
			"<div class='titel'>" 
				. $item2->title . 
			"</div><br>";
		echo  
			"<div class='beschrijving'>" 
				. $item2->description . 
			"</div><br>";			
		echo  
			"<div class='data'>" 
				. $item2->pubDate . 
			"</div>";
		echo 
			"<hr>";

		$posts = array();
		$posts[] = $item2;

		//JSON bestand aangemaakt met de RSS van Tweakers
		$fp = fopen('tweakers.json', 'w');
		fwrite($fp, json_encode($posts));
		fclose($fp);
	}             

	echo "<br><br>nu.nl hieronder<br><br>";

	//RSS Feed van Nu.nl
	$feed2  = "https://www.nu.nl/rss";
	$xml21 = simplexml_load_file($feed2);
	$xml22 = simplexml_load_file($feed2);
	foreach ($xml21->channel->item as $item3)
	{
		echo 
			"<div class='titel'>"
				. $item3->title . 
			"</div><br>";
		echo  
			"<div class='beschrijving'>" 
				. $item3->description . 
			"</div><br>";			
		echo  
			"<div class='data'>" 
				. $item3->pubDate . 
			"</div>";
		echo 
			"<hr>";

		$posts = array();
		$posts[] = $item3;

		//JSON bestand aangemaakt met de RSS van Nu
		$fp = fopen('nu.json', 'w');
		fwrite($fp, json_encode($posts));
		fclose($fp);
	}     
	//Automatische pagina refresh voor nieuwe berichten
	$page = $_SERVER['PHP_SELF'];
	$sec = "30";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
    <body>
    </body>
</html>