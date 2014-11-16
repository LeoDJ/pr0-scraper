<html>
	<head>
		<title> pr0 Leanback </title>
		<link rel="icon" href="http://pr0gramm.com/media/pr0gramm-favicon.png"/>

		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="loop.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body bgcolor="#161618" text="white">
		<div id="navbar">
			<div id="logo"> <img id="pr0gramm-logo" src="pr0gramm_leanback.png"> </div>		
			<div id="navigation">
				<?php
					include 'pr0.php';
					if(isset($_GET['popular'])) $_SESSION['newPop'] = "popular";
					else $_SESSION['newPop'] = "new";
					getNav();
				?>
			</div>
			<!--div id="uploader" style="float:right">uploaded by: coming soon</div-->
		</div>
		
		<div id="img" align='center'></div>
	</body>
</html>