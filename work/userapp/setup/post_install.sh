#!/bin/bash


if [ ! -f /apps/dhcp-server/etc/udhcpd.conf ] ; then
    echo "Copying default confs."
    mkdir -p /apps/dhcp-server/etc/
    cp -a /apps/dhcp-server/conf/* /apps/dhcp-server/etc/
    sync
fi

