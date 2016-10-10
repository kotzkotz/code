#!/bin/bash
#description Config LVS to realserver lo and apply noarp
#使用：把VIP改成主IP
#作用：此操作是在回环设备上绑定了一个虚拟IP地址，并设定其子网掩码为255.255.255.255，与Director Server上的虚拟IP保持互通，然后禁止了本机的ARP请求。由于虚拟ip，也就是上面的VIP地址，是Director Server和所有的Real server共享的，如果有ARP请求VIP地址时，Director Server与所有Real server都做应答的话，就出现问题了，因此，需要禁止Real server响应ARP请求。而lvsrs脚本的作用就是使Real Server不响应arp请求。


VIP=172.16.0.250
. /etc/init.d/functions

case "$1" in
        start)
               ifconfig lo:0 $VIP netmask 255.255.255.255 broadcast $VIP
               /sbin/route add -host $SNS_VIP dev lo:0
               echo "1" >/proc/sys/net/ipv4/conf/lo/arp_ignore
               echo "2" >/proc/sys/net/ipv4/conf/lo/arp_announce
               echo "1" >/proc/sys/net/ipv4/conf/all/arp_ignore
               echo "2" >/proc/sys/net/ipv4/conf/all/arp_announce
               sysctl -p >/dev/null 2>&1
               echo "RealServer Start OK"
               ;;
        stop)
               ifconfig lo:0 down
               route del $VIP >/dev/null 2>&1
               echo "0" >/proc/sys/net/ipv4/conf/lo/arp_ignore
               echo "0" >/proc/sys/net/ipv4/conf/lo/arp_announce
               echo "0" >/proc/sys/net/ipv4/conf/all/arp_ignore
               echo "0" >/proc/sys/net/ipv4/conf/all/arp_announce
               echo "RealServer Stoped"
               ;;
        *)
               echo "Usage: $0 {start|stop}"
               exit 1
        esac

        exit 0