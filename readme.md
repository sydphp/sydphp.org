# SydPHP's public website #

The [SydPHP](http://sydphp.org) public website is built on CakePHP and uses the [Meetup](http://meetup.com) API in order to retrieve all information.

## Requirements ##

* An API Key from [Meetup](http://meetup.com)
* CakePHP 2.3
* Webserver (Nginx, Apache, etc..)
* PHP (5.3+)

## Setup ##

Clone the application from Github. The following clone URI will change based on your access rights. Double check the [SydPHP Github page](http://github.com/sydphp/sydphp.org) for the correct URI:

	git clone git@github.com:sydphp/sydphp.org.git

Initialise the submodules:

	cd sydphp.org
	git submodule update --init --recursive

Setup configuration files:

	cp Config/core.php.default Config/core.php

Setup database information (Meetup.com API Access). You will need your Meetup API Key for this step:

Into `Config/database.php`, place the following content:

	<?php
	class DATABASE_CONFIG {
		public $meetup = array(
			'database' => null,
			'datasource' => 'Meetup.MeetupSource',
			'key' => 'YOUR-API-KEY-HERE',
		);
	}

Remember to replace `YOUR-API-KEY-HERE` with your actual API key from Meetup.

Edit the `webroot/index.php` file to indicate the location of CakePHP 2.0. The following is an example:

	define('CAKE_CORE_INCLUDE_PATH', '/home/sydphp/cakephp-2.0/lib');

Make sure that you don't commit the `webroot/index.php` file to git (otherwise it will cause problems in production):

	git update-index --assume-unchanged webroot/index.php

Once this is complete, you can setup your webserver. The document root for the application should be set as the `sydphp.org/webroot/` directory.

We recommend that you setup a virtualhost to host the application, and run a development domain. Change your hosts file to include a new domain for use with this website:

	127.0.0.1   sydphp.dev

Note, the above will change if you are using a virtual machine, a remote server or similar for development. You can also change the domain name to whatever you like, as long as your webserver configuration has the same domain name for the virtual host configuration.

Finally, make sure that the `tmp/` directory is writable by your webserver/PHP. The simplest way to do this in development is to ensure everyone has access to write that directory:

	chmod -R 777 tmp

You're ready to go! Loading up your website (for example: http://sydphp.dev) should now show the SydPHP website.

## Deployment ##

We've included a "fabric" file for easing deployment to our production server. Fabric is an automation system built with python, and we utilise a ["deploy" module](http://github.com/predominant/deploy) to ease the deployment further. The deploy submodule will be downloaded when you did the git submodule initialisation earier.

### Requirements ###

In order to deploy the site with Fabric, you need the following:

* Python (Install differs based on your operating system)
* Fabric
  - `easy_install fabric` or `pip install fabric`
* SSH Agent Forwarding

If you are deploying to the SydPHP production server, you will need to have previously been granted access to SSH with your private/public SSH key pair.

If you are deploying this on to your own server, ensure that your SSH public key is listed in the destination users `.ssh/authorized_keys` file so you can SSH into the machine without providing a password.

**SSH Agent Forwarding** is a mechanism by which your SSH public key on your local machine is used for SSH authentication no matter what server you are logged in to. This is a means by which the server is left clean and tidy without the need to setup deploy keys or store personal SSH keys.

To enable SSH forwarding, your SSH client needs to have loaded your SSH private key to be able to handle incoming SSH AUTH requests. On windows, you can use a tool like [Pageant](http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html). On Linux and OSX you can use the existing SSH commands:

	ssh-add

This will add your default `~/.ssh/id_rsa` file to the SSH agent. If you want to use a different private key, provide the path to the file after the command.

### Performing the deploy ###

Doing the actual deploy, once the above has been setup, is very easy. Deploy to production with the following command:

	fab

**Note:** Before you execute this command, you will need to ensure that your changes in the repository have been pushed up to the github master branch, as this is where the server clones code from.

# Blah Stuff #

Copyright (c) 2012 - The SydPHP Group
License: MIT? Apache2? You choose.

# Changelog #

* **2012-11-28** Original Readme version ([Graham Weldon](http://grahamweldon.com))

