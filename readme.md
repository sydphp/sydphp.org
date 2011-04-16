# The Sydney PHP Group Website #

This repository contains the website for [Sydney PHP Group (sydphp)](http://sydphp.org).

The sydphp website is based on [SilverStripe CMS](http://silverstripe.org) and contains extensions and additions written by various authors.

## Known issues
+ Ticketing doesn't work. When a ticket is associated with an event in the admin, the register page displays "No tickets available"
+ Design & layout - need some obvious work
+ Do we need to provide a sample database schema? - unsure if /dev/build will create a full schema.

These are the major items. Anything else can be found in the [Issues list](https://github.com/sydphp/sydphp.org/issues)

## Installing
+ Clone this repo using the clone URL in github
+ jump into the working tree created (cd sydphp.org) and grab the submodules by entering the commands 'git submodule init' and 'git submodule update'
+ The site comes with a database skeleton file, you need to copy this and complete the database setup: 'cp mysite/db.install.php mysite/db.php'. Note that the database type is important as it extends and provides added database functionality such as Nullable fields to the core MySQLDatabase class in SilverStripe
+ Once that is done, and ensuring you have set up your database correctly with the correct permissions and your sources are located in a document root accessible to your webserver, point your browser to http://<my domain>/dev/build to create the database tables.
+ Once that is done, you should be able to browse to http://<my domain> and view the website.


## Themese
+ The sydphp theme is currently incomplete. Feel free to copy this as a theme basis to create your own theme.


[md syntax for people who forget](http://daringfireball.net/projects/markdown/syntax)