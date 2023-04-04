# EECSPlus using Node.js server instead of php  right now you can login and submit an EC  
Prototype project for group 26. Software engineering project.


node_Modules is added to gitignore - Whenever you start working on the live server for this project, do npm install to update all packages

NPM is used as a package mangager to run a live development server. All changes made are live.

**1. Clone into repository using URL**

```sh
git clone -b BackendUsingNodeServer  https://github.com/PaulDavidTucker/EECSPlus.git
```

**2. Install the dependencies :**

```sh
npm install
```

## Development Workflow


**3. Start a live-reload development server :**

```sh
npm run dev
```

> This is a full web server. Any time you make changes within the `src` directory, it will rebuild and refresh your browser.


**4. Start local production server with [server](https://github.com/tapio/live-server):**

```sh
npm start

```

**5. Launch node Server**

in your browswer paste  in   http://localhost:8000

logins:

admin_user :123456

student_user : password123


faculty_user: secret_password
 


Running on port 8000 by default, but any number lower than 1024 requires admin privs on windows, unsure about linux installs





# Insturction for the mysql server




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





**4. Launch XAAMP:**

Start Appache and MySQl


 

 
**5. Launch phpmydmin:**

To Edit the Sql Tables press Admin next to MySQL and select the sever to be  eecs-plus.cyvzc0wdkfgr.eu-north-1.rds.amazonaws.com:3306  (admin)
 
 or try http://localhost/phpmyadmin/index.php?route=/
