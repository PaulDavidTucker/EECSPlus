# EECSPlus
Prototype project for group 26. Software engineering project.



**1. Install XAAMP:**
https://www.apachefriends.org/


**2. Install PHPMYADMIN:**

https://www.phpmyadmin.net/

extract zip into  Directory/xampp

add the  folloing into the file config.inc.php in   Direcotry/xampp/phpMyAdmin/config.inc.php

$i++;
$cfg['Servers'][$i]['host'] = 'eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306'; 
$cfg['Servers'][$i]['user'] = 'admin';   
$cfg['Servers'][$i]['password'] = 'password123';  
$cfg['Servers'][$i]['auth_type'] = 'config';      

**3. Clone into repository using URL**


clone into the folder  into  Directory/xampp/htdocs
```sh
https://github.com/PaulDavidTucker/EECSPlus.git
```



**4. Launch XAAMP:**

Start Appache and MySQl


**5. Launch website:**

in your web browser type in http://localhost/EECSPlus/src/index.php  Which will take you to the login page here are the logins 

admin_user :123456

student_user : password123


faculty_user: secret_password
 

 
**6. Launch website:**

To Edit the Sql Tables press Admin next to MySQL and select the sever to be  eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306  (admin)
 
 or try http://localhost/phpmyadmin/index.php?route=/

