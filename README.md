
# Arise Tournament
Plateforme pour participer a des tournois  fait en symfony et php


# Install
php >8.3
composer >2.8.1
symfony >7.0
faker

# Cloner le projet

git clone https://github.com/Lyon-Ynov-Campus/ymmersions-symfony-lamynoah.git

modifier le .env :
mysql://utilisateur:MDP@127.0.0.1:3306/NOMDELADB


start your msql / phpMyadmin 

sudo systemctl start mysqld
/
sudo systemctl enable --now httpd

php bin/console doctrine:database:create

php bin/console doctrine:schema:update --force

puis pour rmplire la db lancer faker : 

php bin/console doctrine:fixtures:load

Compte utile 

admin : mail : henry.dominique@loiseau.com 
mdp : password123