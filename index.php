<html>
	<head>
		<title> pr0 Leanback </title>
		<link rel="icon" href="http://pr0gramm.com/media/pr0gramm-favicon.png"/>

		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script>

			$(function(){ getPic(); });
			function getPic() 
			{
    			$('div#output').load('pr0.php');
    			setTimeout("getPic()",1000);
			}

		</script>
		<meta name="viewport" content="width=device-width">
	</head>
	
	<!--meta http-equiv="refresh" content="2"-->

	<body>
	<div id="output"></div>
	<div id="webm"></div>
		<?php
		?>
	</body>
</html>