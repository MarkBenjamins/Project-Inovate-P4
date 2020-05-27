<div class="rss-box">
	<?php 
        $feed  = "http://feeds.feedburner.com/tweakers/mixed";
		$xml11 = simplexml_load_file($feed);
		$xml12 = simplexml_load_file($feed);
		foreach ($xml11->channel->item as $item2)
		{
			echo "<div class='kleur-fontSize'>" .$item2->title . "</div><br>";
			echo  "<div class='color'>" . $item2->description . "</div><br>";			
			echo  "<div class='color2'>" . $item2->pubDate . "</div>";
		}             
		
		echo "<br><br>Tweakers hieronder<br><br>";
        
        $feed2  = "https://www.nu.nl/rss";
        $xml21 = simplexml_load_file($feed);
		$xml22 = simplexml_load_file($feed);
		foreach ($xml21->channel->item as $item2)
		{
			echo "<div class='kleur-fontSize'>" .$item2->title . "</div><br>";
			echo  "<div class='color'>" . $item2->description . "</div><br>";			
			echo  "<div class='color2'>" . $item2->pubDate . "</div>";
        }     
	?>
</div>