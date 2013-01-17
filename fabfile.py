from fabric.api import env, run, local, task, settings, sudo
import json
from deploy.common import *

env.hosts = ['vps@110.232.114.168']

environmentfile = openenvfile(__file__)
environments = json.loads(environmentfile.read())

timestr = ''
deployconf = {}

@task(default=True)
def deploy(environment='stage'):
        global deployconf, timestr
        timestr = run('date +%Y%m%d.%H%M').strip()
        envs = init_environments(environments)
        deployconf = envs[get_environment(environment, envs)]

        clone(deployconf, timestr)
        delete(deployconf, timestr)
        config(deployconf, timestr)
        # links(deployconf, timestr)
        current_link(deployconf, timestr)
        services(deployconf, timestr)
