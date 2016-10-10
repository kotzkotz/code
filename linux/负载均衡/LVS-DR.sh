#!/bin/bash
# description: start LVS of DirectorServer
# 不知道作用
VIP=172.16.0.250
RIP1=172.16.0.204
RIP2=172.16.0.205
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