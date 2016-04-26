rpm -qa httpd
yum -y install httpd
yum remove httpd

httpd:
cp httpd.conf httpd.conf.bak
vim /etc/httpd/conf/httpd.conf


DocumentRoot '/home/wwwroot/default'
<directory "/home/wwwroot/default">
ServerName localhost:80
DirectoryIndex index.html index.php

LoadModule php5_module modules/libphp5.so

AddType application/x-httpd-php .php .phtml .php3 .inc
AddType application/x-httpd-php-source .phps

service httpd start 启动
service httpd restart 重新启动
service httpd stop 停止服务

nginx:
root  /home/wwwroot/default;
vim /usr/local/nginx/conf/nginx.conf

停止nginx：nginx -s quit
开启nginx：/usr/local/nginx/sbin/nginx -c /usr/local/nginx/conf/nginx.conf



netstat -lnp|grep 80



scp Administrator@192.168.0.68:D:\WWW\thinkcmf /home/wwwroot/default/think2