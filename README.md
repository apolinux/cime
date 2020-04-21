# CIME #

### Medical Appointments Manager ###

Create medical appointments using a intuitive interface. It can be used as part of project to manage a medical center.

### Name Origin ###

Cime comes from **Ci**tas **Me**dicas or Medical Appointments in spanish.

### History ###

This code was made with PHP, PEAR libraries and Mysql. Originally was developed with PHP4 but through years PHP has changed and so the PEAR and Mysql libraries, hosted in sourceforce. Therefore it was necessary to make some changes in code. Finally I could to make the adjust to work with PHP7 and here it is.

### Installation ###

Follow this steps:

    git clone git@github.com:apolinux/cime.git 

In mysql execute commands:

    create database cime;
    create user 'cime_user' identified with 'mysql_native_password' by password '12345';

In system console:

    cd cime 

edit file: config.php 

and make proper adjustment like mail, hours,etc.

move cime directory to webdir base, and check in web:

http://localhost/cime

### Author ###

Comments, thanks, complains or cheers, contact to apolinux@gmail.com .

Twitter: [@apolinux](https://twitter.com/apolinux)

Facebook: [Apolinux](https://www.facebook.com/Apolinux-101998798154863)



