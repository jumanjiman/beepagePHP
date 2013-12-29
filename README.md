beepagePHP
==========

<img src="beepage.gif" border="0">

* [Features](#features)
* [Installation](#installation)
* [History](#history)
* [License](#license)


## Features

BeepagePHP can dial any standard paging dispatcher,
such as Sprint PCS, Metrocall, Nextel, Cingular, or
other common paging companies.

<img src="how-it-works.png" border="0">

The web interface allows a user to...

* Send text messages to any pager and almost any cell phone
* Add subscriber info
* Edit groups of subscribers
* Add service info (e.g., Metrocall dispatcher)

When a user composes a page in the web interface, the page
is queued on the server for immediate sending. The server uses a single
modem to dial up each queued service provider (such as Metrocall), then
transmits all pages that have been queued for that provider.


## Installation 

BeepagePHP requires the `-s sender` functionality 
provided by the version of beep in the *sender* branch at
[enhanced version of beepage](https://github.com/jumanjiman/beepage/tree/sender).
This enables beepagePHP to pass the contents of the `REMOTE_USER`
server variable to the beep client running on localhost. 
Consequently, the cell phone or pager that receives the page displays the name
of the originating sender and not the name of the httpd user account from the 
web server.

1. Build and install [beepage](https://github.com/jumanjiman/beepage/tree/sender).

2. Clone [beepagePHP](https://github.com/jumanjiman/beepagePHP) into an
   appropriate content directory, such as `/var/www/html/beepage`.

3. Update your apache config to implement basic authentication 
   on the `beepage/` directory. Consult the
   [Apache how-to](http://httpd.apache.org/docs-2.0/howto/auth.html)
   if you are unsure how to accomplish this.

   Here is an example `/etc/httpd/conf.d/beepage.conf` file:

   ```
   ##################################################
   #
   #  httpd configuration settings for use with beepagephp
   #
   # establish a .htaccess file for general usage
   <Directory /var/www/html/beepage/>
   	AllowOverride AuthConfig
	<FilesMatch "\.inc$">
	    Order Allow,Deny
	    Deny from all
	</FilesMatch>
   </Directory>
   
   # establish a different .htaccess file for the admin
   # directory
   <Directory /var/www/html/beepage/admin/>
   	AllowOverride AuthConfig
	<FilesMatch "\.inc$">
	    Order Allow,Deny
	    Deny from all
	</FilesMatch>
   </Directory>
   ##################################################
   ```

4. Update the permissions on your `beepage/etc`
   files as follows (assuming httpd runs as group apache):

   ```
   chgrp apache etc/{users,aliases,services}
   chmod 770 etc/{users,aliases,services}
   ```

### Notes

A. beepagePHP assumes that `beepaged` is running on localhost.
   You may need to edit `beepagePHP/inc/vars.inc` if 
   you modified the location of files in the beepage Makefile.

B. Sample user, group (aliases), and services files are 
   included with the beepage tarball in the downloads section.

C. Check your host-based firewall rules to ensure that localhost
   (on which httpd is running) can connect to itself on port 6661.

D. Please configure web server to authenticate your users.
   Otherwise:

   * Anybody visiting your web server will be able to send messages
     (this may be what you want).

   * Outgoing messages will show "From: apache" assuming that
     httpd is running as apache.

### TAP phone numbers

The following pages list TAP phone numbers for common 
cell phone and paging service providers:

* http://www.notepage.net/tap-phone-numbers.htm
* http://sendpage.org/pc/


## History

BeepagePHP originally lived at
[~~http://beepagephp.sourceforge.net~~](http://beepagephp.sourceforge.net).
I threw it together to solve an immediate business need at a time when
PagerDuty and other cloud services did not exist.
Perhaps there is still some value in BeepagePHP or Beepage,
so the source code now lives on GitHub at:

* https://github.com/jumanjiman/beepagePHP
* https://github.com/jumanjiman/beepage/tree/sender

Beepage is a Unix-based, Internet-aware text paging system that implements
the Telocator Alphanumeric Protocol (TAP), and upstream lives at
[http://beepage.org](http://beepage.org).

Upstream beepage is in CVS, so I used the instructions from
http://blog.gorwits.me.uk/2011/06/22/migrate-sourceforge-cvs-repository-to-git/
to export the history to git.

```bash
mkdir ~/cvs && cd ~/cvs
rsync -av rsync://beepage.cvs.sourceforge.net/cvsroot/beepage/* .
cd ~/cvs
svn export --username=guest http://cvs2svn.tigris.org/svn/cvs2svn/trunk cvs2svn-trunk
cp cvs2svn-trunk/cvs2git-example.options cvs2git.options
```

Edit `cvs2git.options`, where
`diff -u cvs2svn-trunk/cvs2git-example.options cvs2git.options`
shows my changes:

```diff
--- cvs2svn-trunk/cvs2git-example.options       2013-12-29 01:27:07.452000000 +0000
+++ cvs2git.options     2013-12-29 01:49:30.747000000 +0000
@@ -522,6 +522,10 @@
     # This one will be used for commits for which CVS doesn't record
     # the original author, as explained above.
     'cvs2git' : 'cvs2git <admin@example.com>',
+    'admorten' : 'admorten <beepage@umich.edu>',
+    'cmessina' : 'messina <beepage@umich.edu>',
+    'wes'      : 'wes <beepage@umich.edu>',
+    'wescraig' : 'wescraig <beepage@umich.edu>',
     }

 # This is the main option that causes cvs2git to output to a
@@ -561,7 +565,7 @@
     # The filesystem path to the part of the CVS repository (*not* a
     # CVS working copy) that should be converted.  This may be a
     # subdirectory (i.e., a module) within a larger CVS repository.
-    r'test-data/main-cvsrepos',
+    r'cvs/beepage',

     # A list of symbol transformations that can be used to rename
     # symbols in this project.
```

Finish the cvs2git conversion and push to GitHub:

```bash
cd ~/cvs
cvs2svn-trunk/cvs2git --options=cvs2git.options --fallback-encoding utf-8
cd ~/cvs/beepage
git init
cat ../cvs2git-tmp/git-{blob,dump}.dat | git fast-import
git tag -l | while read ver; do
  git checkout $ver;
  git tag -d $ver;
  GIT_COMMITTER_DATE="$(git show --format=%aD | head -1)" git tag -a $ver -m "prep for $ver release";
done
git checkout master
git remote add git@github.com:jumanjiman/beepage.git
git push origin master && git push origin --tags
```

For reasons I cannot remember from 2004, I never mirrored my
CVS (or was it subversion?) repo to SourceForge, so
I now had to reconstruct my trivial patch to `beep.c` and kin.
The patch is now in the *sender* branch at
https://github.com/jumanjiman/beepage/tree/sender.


## License

I originally licensed BeepagePHP as GPLv2,
but it's now [MIT](http://git.io/htwGXw).
