just-a-little-glue
==================

Just a little glue is a very simple page management package. It was created to allow those with basic html knowledge and ftp access on a shared server to make changes to a site's content, but not change the site design. It is designed to be low maintenance and not require database access or fancy setup. 

* Demo: http://glue.fiddlyio.com  (very, very simple)
* Live examples:
 * http://hiv.umn.edu
 * http://oliverands.com
 * http://sewlisette.com

# Requirements
* Apache web server
* mod_rewrite
* .htaccess enabled
* php installed and processing files with the extension .php

# Usage
* Clone the package and upload it to your server if you're not cloning it there. 
* Start editing the stuff in lib/\*, pages/, and navigation/. The files in lib/\* are for you, the developer. The stuff in pages/ and navigation/ is for your client, friend, or family member with limited development skills to edit. 

# FAQ
### Why is this written in PHP? Don't you know php is terrible?
Yes, I know php is a terrible slob of a language. But, it is on every $8.95/mo shared web host, which is perfectly adequate for many sites. Not everything is a webapp that needs persistent memory.

### This isn't innovative at all!
You're right again. This is just some stuff I cobbled together after years of making small sites and one-off projects. I thought it might be useful for someone else. 
