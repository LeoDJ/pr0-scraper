<html>

	<head>
		<title> Test </title>
	</head>
	
	<body>

	<?php
		session_start();

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

		function getPr0Id($newPopular, $count)
		{
			if ($count > 60) $count = 60;
			elseif ($count < 1) $count = 1;

			//es muss eine neue Zahl dahinter gestellt werden, da es sonst nur alte Bilder lädt...
			$html = getHTML('http://pr0gramm.com/static/'.$newPopular.'/'.time());
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
			return getPr0Pic(getPr0Id("new", 1));
			//return getPr0Pic("334432");
			//return getPr0Pic("314418");
		}
		
		function newPic($newPopular)
		{
			$curID = getPr0Id($newPopular ,1);
			if ($curID == $_SESSION['prevID']) return "";
			else
			{
				$_SESSION['prevID'] = $curID;
				return $curID;
			}
		}

		function showPic($path)
		{
			$webm = strpos($path,"webm");
			if ($webm !== false) 
				{
					return "<video autoplay loop name=\"media\"> \n <source src=\"".$path."\" type=\"video/webm\">\n</video>";
					//return "WEBMs werden zur Zeit noch nich unterstützt, sry <br> <a target=\"_blank\" href=\"".$path."\">".$path."</a>";
				}
			else return "<img src=".$path.">";
		}

	?>


	</body>
</html>