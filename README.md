# EECSPlus
Prototype project for group 26. Software engineering project.



**1. Install XAAMP:**
```sh
https://www.apachefriends.org/
```

Place into any folder but access restricted ones (e.g. program files on windows)

**2. Install PHPMYADMIN:**

```sh
https://www.phpmyadmin.net/
```

Extract zip into  Directory/xampp

Add the  following to the bottom of the file config.inc.php in   Direcotry/xampp/phpMyAdmin/config.inc.php

```sh
$i++;
$cfg['Servers'][$i]['host'] = 'eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306'; 
$cfg['Servers'][$i]['user'] = 'admin';   
$cfg['Servers'][$i]['password'] = 'password123';  
$cfg['Servers'][$i]['auth_type'] = 'config';      
```

'''sh
/* Authentication type and info */
$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['user'] = 'root';
$cfg['Servers'][$i]['password'] = '';
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['AllowNoPassword'] = true;
$cfg['Lang'] = '';
'''

This will allow you to switch between the hosted DB in PHPMyAdmin.

**3. Clone into repository using URL**


clone into the folder  into  Directory/xampp/htdocs
```sh
https://github.com/PaulDavidTucker/EECSPlus.git
```

**4. Launch XAAMP:**

Start Appache and MySQl:

![image](https://user-images.githubusercontent.com/94861347/229575661-09177288-2162-4afd-accb-44c5c5ac31a6.png)


**5. Launch website:**

In your web browser type in http://localhost/EECSPlus/src/index.php  Which will take you to the login page.

Here are the logins: 

* admin_user :123456

* student_user : password123

* faculty_user: secret_password
 

**6. Viewing database tables:**

To Edit the Sql Tables press Admin next to MySQL and select the sever to be  eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306  (admin)
 
 or try http://localhost/phpmyadmin/index.php?route=/

