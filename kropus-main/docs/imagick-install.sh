#!/bin/bash

if [ "$EUID" -ne 0 ]
  then echo "Please run as root"
  exit
fi

sudo apt-get -y install imagemagick

echo "Check if extension Imagick is installed"
convert -version  | grep -i version

yes '' | sudo pecl install imagick

sudo echo "extension=imagick.so" > /etc/php/8.4/mods-available/imagick.ini
sudo ln -sf /etc/php/8.4/mods-available/imagick.ini /etc/php/8.4/fpm/conf.d/20-imagick.ini
sudo ln -sf /etc/php/8.4/mods-available/imagick.ini /etc/php/8.4/cli/conf.d/20-imagick.ini

echo "Restarting PHP8.4"
sudo -S service php8.4-fpm reload

echo "Check if extension imagick.so is enabled"
echo "PHP INI:"
php8.4 -i | grep imagick
echo "PHP modules:"
php8.4 -m | grep imagick
