<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><head>
    
    <title>beepagePHP | features</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="Author" content="Paul Morgan">
    <link href="beepage.css" rel="stylesheet" type="text/css">
</head>

<?php
require('inc/vars.inc');
$subscriber = $HTTP_GET_VARS["subscriber"];
$msg = $HTTP_GET_VARS["msg"];
$sender = $HTTP_SERVER_VARS["REMOTE_USER"];

# to-do: validate form input

# send the page
$cmd = "/usr/local/beepage/bin/beep -v -h localhost -p 6661 -s $sender $subscriber \"$msg\"";
exec($cmd, $result, $cmdstatus);
if ($cmdstatus == 0)
  $cmdstatus = "Page Queued";
else
  $cmdstatus = "Page Failed";
?>
<body>

<? require "inc/header.inc"; ?>


<div id="content">   
	<h2>[ send ]</h2>

<pre>
<?php
  foreach($result as $element)
  echo "$element\n";
?>
</pre>

</div>

<? require "inc/footer.inc"; ?>

</body></html>
