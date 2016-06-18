# Install WordPress on a Debian/Ubuntu VPS
#

###### VARIABLES FROM XML CONFIG ######
rootpass=$(sed  -n 's/.*<mySqlRootPassword>\(.*\)<\/mySqlRootPassword>/\1/p' config.xml)
dbname=$(sed  -n 's/.*<dataBaseName>\(.*\)<\/dataBaseName>/\1/p' config.xml)
dbuser=$(sed  -n 's/.*<dataBaseUserName>\(.*\)<\/dataBaseUserName>/\1/p' config.xml)
userpass=$(sed  -n 's/.*<dataBasePassword>\(.*\)<\/dataBasePassword>/\1/p' config.xml)
wpURL=$(sed  -n 's/.*<wordpressUrl>\(.*\)<\/wordpressUrl>/\1/p' config.xml)

phpmyadmin_version=$(sed  -n 's/.*<phpMyAdminVersion>\(.*\)<\/phpMyAdminVersion>/\1/p' config.xml)
########################################

# Create MySQL database
echo "CREATE DATABASE $dbname;" | mysql -u root -p$rootpass
echo "CREATE USER '$dbuser'@'localhost' IDENTIFIED BY '$userpass';" | mysql -u root -p$rootpass
echo "GRANT ALL PRIVILEGES ON $dbname.* TO '$dbuser'@'localhost';" | mysql -u root -p$rootpass
echo "FLUSH PRIVILEGES;" | mysql -u root -p$rootpass
echo "New MySQL database is successfully created"

# Download, unpack and configure WordPress
wget -q -O - "http://wordpress.org/latest.tar.gz" | tar -xzf - -C /var/www --transform s/wordpress/$wpURL/
chown www-data: -R /var/www/$wpURL && cd /var/www/$wpURL
cp wp-config-sample.php wp-config.php
chmod 640 wp-config.php
mkdir uploads
sed -i "s/database_name_here/$dbname/;s/username_here/$dbuser/;s/password_here/$userpass/" wp-config.php

# Create Apache virtual host
echo "
ServerName $wpURL
ServerAlias www.$wpURL
DocumentRoot /var/www/$wpURL
DirectoryIndex index.php

Options FollowSymLinks
AllowOverride All

ErrorLog ${APACHE_LOG_DIR}/error.log
CustomLog ${APACHE_LOG_DIR}/access.log combined
" > /etc/apache2/sites-available/$wpURL

# Enable the site
a2ensite $wpURL
service apache2 restart

# Output
WPVER=$(grep "wp_version = " /var/www/$wpURL/wp-includes/version.php |awk -F\' '{print $2}')
echo -e "\nWordPress version $WPVER is successfully installed!"
echo -en "\aPlease go to http://$wpURL and finish the installation\n"