from __future__ import with_statement
from datetime import datetime
from fabric.api import env, run, local, task, settings, sudo

env.hosts = ['vps@110.232.114.168']

repository_uri = 'git@github.com:sydphp/sydphp.org.git'
branch = 'master'
current_dir = 'current'
config_dir = 'config'
site_dir = '/home/vps/sites/sydphp.org/'

configs = [
	'Config/database.php',
	'Config/core.php',
	'Config/email.php'
]

delete_files = [
	'webroot/test.php'
]

timestr = datetime.now().strftime('%Y%m%d.%H%M')

@task(default=True)
def deploy():
	clone()
	config()
	secure()
	link()
	services()

@task
def clone():
	arun('git clone {0} {1}{2}'.format(repository_uri, site_dir, timestr))
	arun('(cd {0}{1} && git submodule update --init --recursive)'.format(site_dir, timestr))
	# run('git checkout -b {0} origin/{0}'.format(branch))

@task
def config():
	for f in configs:
		run('ln -s {0}{1}/{2} {0}{3}/{2}'.format(site_dir, config_dir, f, timestr))

@task
def secure():
	for f in delete_files:
		run('rm -f {0}{1}/{2}'.format(site_dir, timestr, f))

@task
def link():
	run('rm {0}{1}'.format(site_dir, current_dir))
	run('ln -s {0}{1} {0}{2}'.format(site_dir, timestr, current_dir))

@task
def services():
	sudo('service php5-fpm reload');

"""Alias run command to do SSH Agent forwarding

This just passes through the ssh client, with the -A option to allow ssh agent forwarding.

"""
def arun(cmd):
	for h in env.hosts:
		try:
			host, port = h.split(':')
			local('ssh -p %s -A %s "%s"' % (port, host, cmd))
		except ValueError:
			local('ssh -A %s "%s"' % (h, cmd))
