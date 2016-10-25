#打开80端口
vi /etc/sysconfig/iptables
-A INPUT -m state --state NEW -m tcp -p tcp --dport 80 -j ACCEPT
/etc/init.d/iptables restart

yum -y install gcc zlib zlib-devel cmake openssl openssl-devel ncurses ncurses-devel gcc-c++ freetype freetype-devel gd gd-devel libxml2 libxml2-devel libjpeg libjpeg-devel libpng libpng-devel

rpm -qa | grep mysql
rpm -e --nodeps mysql-libs-5.1.73-3.el6_5.i686

tar -xzvf apr-1.5.2.tar.gz && tar -xzvf apr-util-1.5.4.tar.gz

cd apr-1.5.2
./configure -prefix=/usr/local/apr
make && make install

cd apr-util-1.5.4
./configure -prefix=/usr/local/apr-util/ -with-apr=/usr/local/apr
make && make install


#apache 2.2
wget http://mirrors.tuna.tsinghua.edu.cn/apache/httpd/httpd-2.2.31.tar.bz2
tar -jxvf httpd-2.2.31.tar.bz2
cd httpd-2.2.31
./configure --prefix=/usr/local/http2  \
--enable-modules=all \
--enable-rewrite \
--enable-mods-shared=all \
--enable-so \
--with-apr=/usr/local/apr \
--with-apr-util=/usr/local/apr-util
make && make install


















