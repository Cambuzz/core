# Cambuzz Source Code

Cambuzz Dev Team welcomes you. Start contributing!

## Contribution policy
All contributions should be done in bug-fixes branch.


## Step 1: Install Apache
* `$ sudo apt-get update`
* `$ sudo apt-get install apache2`

## Step 2: Install MySQL

* `$ sudo apt-get install mysql-server php5-mysql`

Note : During the installation, your server will ask you to select and confirm a password for the MySQL "root" user. This is an administrative account in MySQL that has increased privileges. Think of it as being similar to the root account for the server itself (the one you are configuring now is a MySQL-specific account however).

* `$ sudo mysql_install_db`

* `$ sudo mysql_secure_installation`


Note : You will be asked to enter the password you set for the MySQL root account. Next, it will ask you if you want to change that password. If you are happy with your current password, type "n" for "no" at the prompt.

# Step 3: Install PHP

1) sudo apt-get install php5 libapache2-mod-php5 php5-mcrypt

2) sudo nano /etc/apache2/mods-enabled/dir.conf
```
         The above mentioned command will open the dir.conf file in a text editor . The file looks as shown below : 
                      
<IfModule mod_dir.c>
    DirectoryIndex index.html index.cgi index.pl index.php index.xhtml index.htm
</IfModule>

Move the PHP index file highlighted above to the first position after the DirectoryIndex specification, like this:

<IfModule mod_dir.c>
    DirectoryIndex index.php index.html index.cgi index.pl index.xhtml index.htm
</IfModule>
```

The change has been highlighted. When you are finished, save and close the file.

* `$ sudo service apache2 restart`


## Step 4: Test PHP Processing on your Web Server
1) sudo nano /var/www/html/info.php

2) This will open a blank file named “info.php”. Put the following text, which is valid PHP code, inside the file:

```
<?php
phpinfo();
?>
```
When you are finished, save and close the file.

* Visit the following link on the browser: `http://localhost/info.php`.  
* If this is successful, then PHP is working as expected.

## Step 5: Install phpMyAdmin
* `$ sudo apt-get update`
* `$ sudo apt-get install phpmyadmin`
					
Warning
When the first prompt appears, apache2 is highlighted, but not selected. If you do not hit "SPACE" to select Apache, the installer will not move the necessary files during installation. Hit "SPACE", "TAB", and then "ENTER" to select Apache.

* `$ sudo php5enmod mcrypt`
* `$ sudo service apache2 restart`
* Visit the following link on the browser : `http://localhost/phpmyadmin`.  

If this is successful, then PHP is working as expected. You can now log into the interface using the root username and the administrative password you set up during the MySQL installation.


## License

The MIT License (MIT)
Copyright (c) 2016 Cambuzz (Prashant Kumar Bhardwaj, Prastut Kumar, Fenil Patel, Prasang Sharma, Shantanu Tripathi, Divyang Duhan)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

