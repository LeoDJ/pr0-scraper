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