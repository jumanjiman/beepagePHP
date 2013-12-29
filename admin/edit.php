<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><head>
    
    <title>beepagePHP | edit</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="Author" content="Paul Morgan">
    <link href="../beepage.css" rel="stylesheet" type="text/css">
</head>

<body>

<? require "header.inc"; ?>


<div id="content">   
	<h2>[ edit <? echo $_REQUEST['f']; ?> ]</h2>

<img src="../beepage.gif" border="0">

<form method="POST" action="save.php">
<?php
	require('../inc/vars.inc');
	$f = $_REQUEST['f'];
	//echo "<p>$base_path/$f</p><p>";
	echo "<input type=\"hidden\" name=\"f\" value=\"$f\">\n";
	//echo "<textarea name=\"body\" rows=\"15\" cols=\"80\" wrap=\"off\" style=\"white-space:nowrap;\">\n";
	echo "<textarea name=\"body\" rows=\"15\" cols=\"80\" >\n";
	exec("/bin/cat $base_path/$f", $result);
	foreach($result as $element)
		echo "$element\n";
	echo "</textarea>";
?>
</p>
<p><input type="submit" value="Save Changes"></p>
</form>

</div>

<? require "../inc/footer.inc"; ?>

</body></html>
