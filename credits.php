<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><head>
    
    <title>beepagePHP | credits</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="Author" content="Paul Morgan">
    <link href="beepage.css" rel="stylesheet" type="text/css">
</head>

<body>

<? require "inc/header.inc"; ?>


<div id="content">   
	<h2>[ credits ]</h2>

<img src="beepage.gif" border="0">

<p>Beepage is a Unix-based, Internet-aware text paging system that implements the Telocator
Alphanumeric Protocol (TAP) and is housed at <a href="http://beepage.org">http://beepage.org</a>.
</p>

<p>
BeepagePHP is a set of PHP scripts plus C code that enhance the original beepage and extend 
its functionality to web-based clients. BeepagePHP is housed at 
<a href="http://beepagephp.sourceforge.net" title="beepagephp homepage">http://beepagephp.sourceforge.net</a>.
</p>

<p>
The enhanced version of beepage that is included with beepagePHP adds
an optional <i>-s&nbsp;sender</i> command line parameter to the beep program. 
This enables beepagePHP to pass the contents of the REMOTE_USER server 
variable to the beep client running on localhost. 
Consequently, the cell phone or pager that receives the page displays the name
of the originating sender and not the name of the httpd user account from the 
web server.
</p>

<p>The following web pages list TAP phone numbers for common paging service providers:</p>
<ul>
  <li><a href="http://www.notepage.net/tap-phone-numbers.htm">http://www.notepage.net/tap-phone-numbers.htm</a></li>
  <li><a href="http://sendpage.org/pc/">http://sendpage.org/pc/</a></li>
</ul>

<p>The cascading style sheet and page layout is based on <a href="http://www.phpmyfaq.de/">phpMyFAQ</a>.</p>

</div>

<? require "inc/footer.inc"; ?>

</body></html>
