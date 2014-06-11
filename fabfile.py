from fabric.api import *

PROD_SERVER = ['bahoo@bahoo.webfactional.com:22']

def production():
    env.hosts = PROD_SERVER
    env.forward_agent = True
    env.target_directory = '/home/bahoo/webapps/seattlefreeschool'

def deploy():
    with cd(env.target_directory):
        run("git pull origin")
