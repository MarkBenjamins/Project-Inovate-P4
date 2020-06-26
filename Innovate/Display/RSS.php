<?php 
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

		$fp = fopen('tweakers.json', 'w');
		fwrite($fp, json_encode($posts));
		fclose($fp);
	}             

	echo "<br><br>nu.nl hieronder<br><br>";

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

		$fp = fopen('nu.json', 'w');
		fwrite($fp, json_encode($posts));
		fclose($fp);
	}     
?>