<?php
	session_start();

	function get_data($url)
	{
		$ch = curl_init();
		$timeout = 5; // 0 wenn kein Timeout
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_content = curl_exec($ch);
		curl_close($ch);
		return $file_content;
	}

	function getNewestPost()
	{
		$url = "http://pr0gramm.com/api/items/get";
		if($_SESSION['newTop']=="top") $url = $url."?promoted=1";

		$json = json_decode(get_data($url));

		return $json->items[0];

	}

	function getNewestId()
	{
		$post = getNewestPost();
		return $post->id;
	}

	function getNewestPic()
	{
		$post = getNewestPost();
		$rawURL = "http://img.pr0gramm.com/";
		$img = $post->image;
		$full = $post->fullsize;
		if ($full !== "") return $rawURL.$full;
		else return $rawURL.$img;
	}

	function isNewPic()
	{
		$curID = getNewestId();
		if ($curID == $_SESSION['prevID']) return false;
		else
		{
			$_SESSION['prevID'] = $curID;
			return true;
		}
	}

	function showNewestPic()
	{
		$id = getNewestId();
		$path = getNewestPic();
		$webm = strpos($path,"webm");
		$out = "<a href=\"http://pr0gramm.com/new/".$id."\" target=\"_blank\">";
		if ($webm !== false) 
			{
				$out = $out."<video autoplay loop preload=\"auto\"  style=\"max-height: 90vh; max-width: 90vh;\"> \n <source src=\"".$path."\" type=\"video/webm\">\nDu hast 'nen scheiß Brauser, besorg dir Chrome!\n</video>";
				//return "WEBMs werden zur Zeit noch nich unterstützt, sry <br> <a target=\"_blank\" href=\"".$path."\">".$path."</a>";
			}
		else $out = $out."<img src=".$path." style=\"max-height: 90vh; max-width: 90vh;\">";
		return $out."</a>";
	}

	function getNav()
	{
		if ($_SESSION['newTop'] == "new") echo "<a href='index.php?new' style=\"color:EE4D2E; text-decoration:none;\">neu</a> &nbsp <a href='index.php?top' style=\"color:AAAAAA; text-decoration:none;\">beliebt</a>";
		else                              echo "<a href='index.php?new' style=\"color:AAAAAA; text-decoration:none;\">neu</a> &nbsp <a href='index.php?top' style=\"color:EE4D2E; text-decoration:none;\">beliebt</a>";
	}