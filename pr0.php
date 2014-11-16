<?php
	session_start();
	$_SESSION['prevID'] = "";
	$_SESSION['newPopular'] = "new";
	function getHTML($url)
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

	function getPr0Id($count)
	{
		if ($count > 60) $count = 60;
		elseif ($count < 1) $count = 1;

		//es muss eine neue Zahl dahinter gestellt werden, da es sonst nur alte Bilder lädt...
		$html = getHTML('http://pr0gramm.com/static/'.$_SESSION['newPopular'].'/'.time());
		preg_match_all('/\/.*"></', $html, $output, PREG_SET_ORDER);
		
		$imgs = call_user_func_array('array_merge', $output);
		$ids = str_replace(array("/static/","\"><"),"",$imgs);
		
		$out = array();
		for ($i = 0; $i < $count; $i++) 
			array_push($out, $ids[$i]);
		//echo "\n<br>".time();
		if ($count == 1) return $out[0];
		else return $out;
	}

	function getPr0Pic($picID)
	{
		$picHTML = getHTML('http://pr0gramm.com/static/'.$picID);
		preg_match_all('/="\/data.*" /', $picHTML, $output2);

		$src = "http://pr0gramm.com".str_replace(array("=","\""), "", $output2[0][0]);
		return $src;
	}

	function getNewestPic()
	{
		return getPr0Pic(getPr0Id(1)); 
		//return getPr0Pic("334432"); //test webm
		//return getPr0Pic("314418"); //test gif
		//return getPr0Pic("389161"); //test bigPic
	}
	
	function newPic()
	{
		$curID = getPr0Id(1);
		if ($curID == $_SESSION['prevID']) return "";
		else
		{
			$_SESSION['prevID'] = $curID;
			return $curID;
		}
	}

	function showPic($path,$id)
	{
		$webm = strpos($path,"webm");
		$out = "<a href=\"http://pr0gramm.com/new/".$id."\" target=\"_blank\">";
		if ($webm !== false) 
			{
				$out = $out."<video autoplay loop preload=\"auto\"  style=\"max-height: 95vh; max-width: 95vh;\"> \n <source src=\"".$path."\" type=\"video/webm\">\nDu hast 'nen scheiß Brauser, besorg dir Chrome!\n</video>";
				//return "WEBMs werden zur Zeit noch nich unterstützt, sry <br> <a target=\"_blank\" href=\"".$path."\">".$path."</a>";
			}
		else $out = $out."<img src=".$path." style=\"max-height: 95vh; max-width: 95vh;\">";
		return $out."</a>";
	}
