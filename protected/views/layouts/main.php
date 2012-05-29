<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
function clicker(id)
{
	$("#text").val(id);
	$("form").submit();
}

$(document).ready(function(){

	$(".scorecard,.overcard,.score,.alertcard").hide();
	$(".alertcard").slideDown(120);
	$(".scorecard").slideDown(200);
	$(".overcard").slideDown(400);
	$(".score").slideDown(50);
	
	/*if(window.innerWidth>650)
	{
		window.open('test.php','cct','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=600,height=200');
		window.close();
	}*/
});
</script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
</head>

<body>

<div>
<?php echo $content; ?>
</div>

</body>
</html>