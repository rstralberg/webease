# WebEase

This is a personal project of mine made just for my own pleasure. 

# Setting up  on server

# MariaDb
sudo mysql -u root

create user 'webease'@localhost identified by 'winterfall';

create database km;
grant all privileges on gg.* to 'webease'@localhost;

create database gg;
grant all privileges on gg.* to 'webease'@localhost;

flush privileges;
exit

# File and Folder permissions
chown -hR roland:www-data public

