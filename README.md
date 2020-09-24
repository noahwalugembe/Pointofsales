# README #

1) Insatall Xampp

make changes to phpmyadmin/config.inc.php
in order to allouw upload of big csv files
And Change php.ini and my.ini

post_max_size = 75000M
upload_max_filesize = 75000M
max_execution_time = 500000
max_input_time = 500000
memory_limit = 100000M
max_allowed_packet = 20000M (in my.ini)

2)In xammp htdocs{C:\xampp\htdocs} folder place the entire application folder {Pointofsales}

3)In php addmin creat database with name {posdb}  and then import file {posdb.sql}

4)Start aptche and mysql sever in xamp contral panel 

5)Check the configerations on the link blow.
C:\xampp\htdocs\Pointofsales\PosApi\includes\Constants.php

6)Run the application with the link blow
C:\xampp\htdocs\Pointofsales\PosApp\index.html

The application is in two parts Backend  and frontend

Backend :C:\xampp\htdocs\Pointofsales\PosApi\
Frontend :C:\xampp\htdocs\Pointofsales\PosApp\
