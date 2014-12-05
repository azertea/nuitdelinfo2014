NUIT DE L'INFO 2014
ÉQUIPE AZERTEA
===============

# Compilation et déploiement de l'application web sur BlueMix (MacOSX only)

0. Pré-requis
    - Outils en ligne de commande Git
    - Installation de l'outil en ligne de commande CloudFoundry (https://github.com/cloudfoundry/cli)
    - Configuration de l'outil
        * API: https://api.ng.bluemix.net
        * Login: benoit.sauvere@gmail.com
        * Password: ********* (cf base de données KeePass commune)
        * Default application: nuitdelinfo2014


1. Checkout des sources 
    - git clone "https://github.com/azertea/nuitdelinfo2014.git"

2. Déploiement des nouvelles sources
    - cd "nuitdelinfo2014/site"
    - cf push "nuitdelinfo2014" -m 1024M -b "https://github.com/zendtech/zend-server-php-buildpack-bluemix.git"

L'application est déployée et accessible ici : http://nuitdelinfo2014.mybluemix.net/ 




