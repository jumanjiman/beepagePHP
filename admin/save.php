<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><head>
    
    <title>beepagePHP | features</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="Author" content="Paul Morgan">
    <link href="../beepage.css" rel="stylesheet" type="text/css">
</head>

<body>

<? require "header.inc"; ?>


<div id="content">   
	<h2>[ save ]</h2>


<?php
	# note that we don't validate or check the sanity of
	# posted data in any way yet!
	require('../inc/vars.inc');
	$f = $_POST['f'];
	$body = $_POST['body'];
	if ( $f == "users")
		$body = ereg_replace ("[[:blank:]]+", "\t", $body);
	@$fp = fopen("$base_path/$f", "w");
	if (!$fp) {
		echo "<p>Error opening $base_path/$f.</p>\n";
		} 
	else {
		$fstatus=fwrite($fp, $body);
		if ($fstatus == 0)
			echo "<p>Failed to write $base_path/$f.</p>";
		else
			echo "<p>Success.</p>";
		fclose($fp);
		exec("/bin/kill -HUP `/sbin/pidof beepaged`", $result, $cmdstatus);
		}
?>
</div>

<? require "../inc/footer.inc"; ?>

</body></html>
