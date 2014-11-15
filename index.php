<html>
	<head>
		<title> pr0 Leanback </title>
		<link rel="icon" href="http://pr0gramm.com/media/pr0gramm-favicon.png"/>

		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script>

			function pollIfNewPicture(callback)
			{
				$.ajax({
					url: "pr0_isNewPic.php",
					//dataType: "json"
				}).done(function(result){
			 	if(result == "true")
			 	{
			 		callback();
			 		return;
			 	}
			 	setTimeout(function(){ pollIfNewPicture(callback); }, 1000);
			 	});
			}

			function getPic()
			{
				$('div#output').load('pr0_getNewestPic.php');
				setTimeout(function() { pollIfNewPicture(getPic); }, 1000);
			}

			$(function() {
				pollIfNewPicture(getPic);
			});

			/*$(function(){ getPic(); });
			function getPic() 
			{
    			$('div#output').load('pr0.php');
    			setTimeout("getPic()",1000);
			}*/

		</scrip>




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