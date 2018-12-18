<?php
include '../src/class/Country2Ip.php';
echo "IPs from CN";
$ips = (new \gclinux\Country2Ip)->getIps('CN',10);
print_r($ips);
echo 'IPs From US';
$ips = (new \gclinux\Country2Ip)->getIps('US',3);
print_r($ips);