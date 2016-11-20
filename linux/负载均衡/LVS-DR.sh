#!/bin/bash
# description: start LVS of DirectorServer
# DR模式在lvs机器运行
VIP=192.168.0.65
RIP1=192.168.0.67
RIP2=192.168.0.68
. /etc/rc.d/init.d/functions
logger $0 called with $1
 
case "$1" in
 
start)
    # set squid vip
    /sbin/ifconfig eth0:0 $VIP broadcast $VIP netmask 255.255.255.255 up
    /sbin/route add -host $VIP dev eth0:0
    ;;
stop)
    ifconfig eth0:0 down
    route del $VIP
    echo "lvs_dr stoped"
    ;;
 
*)
    echo "Usage: $0 {start|stop}"
    exit 1
esac