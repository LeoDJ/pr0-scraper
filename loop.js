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
 	setTimeout(function(){ pollIfNewPicture(callback); }, 5000);
 	});
}

function getPic()
{
	$('div#img').load('pr0_getNewestPic.php');
	setTimeout(function() { pollIfNewPicture(getPic); }, 5000);
}

$(function() {
	pollIfNewPicture(getPic);
});