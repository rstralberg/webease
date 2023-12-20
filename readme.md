# WebEase

This is a personal project of mine made just for my own pleasure. 

# Setting up  on server

# MariaDb
sudo mysql -u root

create database km;
create user 'km'@localhost identified by 'winterfall';

create database gg;
grant all privileges on gg.* to 'webease'@localhost;

flush privileges;
exit

# File and Folder permissions
chown -hR roland:www-data public

