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


# TODO

## Add Youtube Comments 

## Add croppning for Gallery images

## Försättsbild på Mp4 videos

## In Text add support for new lines

## Check that titles really are save direct after add

## Title does not save after new Article

## Sometimes its possible to add without any article selected
Which ends up in att 'Article missing'

## Tools visas inte direkt efter inloggning

