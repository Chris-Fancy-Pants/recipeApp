#!/bin/sh

wget http://dev.mysql.com/get/Downloads/MySQL-5.7/mysql-5.7.15-osx10.11-x86_64.tar.gz
tar xfvz mysql-5.7*

echo "stopping mamp"
sudo /Applications/MAMP/bin/stop.sh
sudo killall httpd mysqld

echo "creating backup"
sudo rsync -arv --progress /Applications/MAMP ~/Desktop/MAMP-Backup

echo "copy bin"
sudo rsync -arv --progress mysql-5.7.*/bin/* /Applications/MAMP/Library/bin/ --exclude=mysqld_multi --exclude=mysqld_safe 

echo "copy share"
sudo rsync -arv --progress mysql-5.7.*/share/* /Applications/MAMP/Library/share/

echo "fixing access (workaround)"
sudo chmod -R o+rw  /Applications/MAMP/db/mysql/
sudo chmod -R o+rw  /Applications/MAMP/tmp/mysql/
sudo chmod -R o+rw  "/Library/Application Support/appsolute/MAMP PRO/db/mysql/"

echo "starting mamp"
sudo /Applications/MAMP/bin/start.sh

echo "making symlink, enter sudo password"
sudo ln -s /Applications/MAMP/tmp/mysql/mysql.sock /tmp/mysql.sock

echo "migrate to new version"
/Applications/MAMP/Library/bin/mysql_upgrade -u root --password=root -h 127.0.0.1
