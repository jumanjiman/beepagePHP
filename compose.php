<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><head>
    
    <title>beepagePHP | compose</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="Author" content="Paul Morgan">
    <link href="beepage.css" rel="stylesheet" type="text/css">
<?php
	require('inc/vars.inc');
?>
</head>

<body>

<? require "inc/header.inc"; ?>


<div id="content">   
	<h2>[ compose ]</h2>

<img src="beepage.gif" border="0">

<form method="GET" action="send.php">
<table border="0">
<tr>
  <td>From:</td>
  <td><? echo $HTTP_SERVER_VARS["REMOTE_USER"]; ?></td>
</tr>
<tr>
  <td>To Group or User:</td>
  <td>
<?php
echo '<select size="1" name="subscriber">';
exec("/bin/grep -v ^# $groups | /bin/grep [:alnum:] | awk '{ print $1; }'  | sort", $result);
exec("/bin/grep -v ^# $users | /bin/grep [:alnum:] | awk '{ print $1; }' | sort", $result);
foreach($result as $element)
	echo "<option value=\"$element\">$element</option>";
echo '</select>';
?>
  </td>
</tr>
<tr>
  <td valign="top">Message:</td>
  <td><textarea name="msg" maxlength="<?php echo "$max_length" ?>" rows="10" cols="40"
	>Type your message here (max <?php echo "$max_length"; ?> characters).</textarea></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td><input type="submit" value="Send Page"></td>
</tr>
</table>
</form>

</div>

<? require "inc/footer.inc"; ?>

</body></html>
