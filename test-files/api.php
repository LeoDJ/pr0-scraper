<?php 
	$result = json_decode(file_get_contents('http://pr0gramm.com/api/items/get')); 
	//var_dump($result);
	/*foreach($result->items as $item)
	{
		echo $item->id."<br>";
	}*/
	$url = "http://pr0gramm.com/api/items/get";
		//if($_SESSION['newTop']=="popular") $url = $url."?promoted=0";

		$json = json_decode(file_get_contents($url));

		echo $json->items[0]->id;

