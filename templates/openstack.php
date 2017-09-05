<?php 
# vim: syntax=php tabstop=4 softtabstop=0 noexpandtab laststatus=1 ruler 
  
/** 
 * html/templates/openstack.php 
 * 
 * Openstack template for UNetLab. 
 * 
 * LICENSE: 
 * 
 * This file is part of UNetLab (Unified Networking Lab). 
 * 
 * UNetLab is free software: you can redistribute it and/or modify 
 * it under the terms of the GNU General Public License as published by 
 * the Free Software Foundation, either version 3 of the License, or 
 * (at your option) any later version. 
 * 
 * UNetLab is distributed in the hope that it will be useful, 
 * but WITHOUT ANY WARRANTY; without even the implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
 * GNU General Public License for more details. 
 * 
 * You should have received a copy of the GNU General Public License 
 * along with UNetLab. If not, see <http: 
 * 
 * @author Maosen Sun <sunnymaosen@gmail.com,sun285529808@qq.com>
 * @copyright Maosen Sun
 * @organization EmulatedLab(QQ Group:593920308)
 * @link http://www.eve-ng.com
 * @version 20170618
 */ 

$p['type'] = 'qemu'; 
$p['name'] = 'Openstack'; 
$p['icon'] = 'Openstack.png'; 
$p['cpulimit'] = 0;
$p['cpu'] = 3; 
$p['ram'] = 6144; 
$p['ethernet'] = 1; 
$p['console'] = 'vnc'; 
$p['qemu_arch'] = 'x86_64'; 
$p['qemu_nic'] = 'virtio-net-pci';
$p['qemu_options'] = '-machine type=pc-1.0,accel=kvm -vga std -usbdevice tablet -boot order=dc'; 
?> 
