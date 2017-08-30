#!/bin/sh

# Backup current network cofnig
cp /etc/network/interfaces ./interfaces.bak


sudo apt-get install docker.io

# fix docker config conflict
cat > /etc/systemd/system/docker.service.d/service.conf << EOF
[Service]
ExecStart=
ExecStart=/usr/bin/dockerd
EOF

# Json config for docker
cat > /etc/docker/daemon.json << EOF
{
 "hosts": ["tcp://127.0.0.1:4243", "unix:///var/run/docker.sock"],
 "storage-driver": "overlay2",
 "log-driver": "json-file",
 "log-opts": {
 "max-size": "10m",
 "max-file": "2"
 }
}
EOF

# Fix autoboot for vswitch
cat > /lib/systemd/system/openvswitch-nonetwork.service << EOF
[Unit]
Description=Open vSwitch Internal Unit
PartOf=openvswitch-switch.service

#https://bugs.launchpad.net/ubuntu/+source/openvswitch/+bug/1448254

# Without this all sorts of looping dependencies occur doh!
DefaultDependencies=no

#precedants pulled from isup@ service requirements
After=apparmor.service local-fs.target systemd-tmpfiles-setup.service

#subsequent to this service we need the network to start
Wants=network-pre.target openvswitch-switch.service
Before=network-pre.target openvswitch-switch.service

[Service]
Type=oneshot
RemainAfterExit=yes
EnvironmentFile=-/etc/default/openvswitch-switch
ExecStart=/usr/share/openvswitch/scripts/ovs-ctl start \
          --system-id=random $OVS_CTL_OPTS
ExecStop=/usr/share/openvswitch/scripts/ovs-ctl stop
EOF
 
sudo systemctl daemon-reload && systemctl restart openvswitch-switch;


# Add a new systemd file to ensure apache2 starts
cat > /lib/systemd/system/apache2.service.d/apache2-systemd.conf << EOF
[Unit]
Description=Apache HTTP Server
After=syslog.target network.target

[Service]
Type=forking
RemainAfterExit=no
Restart=always
PIDFile=/var/run/apache2/apache2.pid

[Install]
WantedBy=multi-user.target
EOF

## Modify interfaces to support ovs
sed -i '/Cloud/q' /etc/network/interfaces

cat >> /etc/network/interfaces << EOF
auto pnet1
allow-ovs pnet1
iface pnet1 inet manual
  ovs_type OVSBridge
  ovs_ports l2port
  
auto pnet2
allow-ovs pnet2
iface pnet2 inet manual
  ovs_type OVSBridge
  ovs_ports l2port
  
auto pnet3
allow-ovs pnet3
iface pnet3 inet manual
  ovs_type OVSBridge
  ovs_ports l2port
  
auto pnet4
allow-ovs pnet4
iface pnet4 inet manual
  ovs_type OVSBridge
  ovs_ports l2port
  
 auto pnet5
allow-ovs pnet5
iface pnet5 inet manual
  ovs_type OVSBridge
  ovs_ports l2port
  
  auto pnet6
allow-ovs pnet6
iface pnet6 inet manual
  ovs_type OVSBridge
  ovs_ports l2port
  
  auto pnet7
allow-ovs pnet7
iface pnet7 inet manual
  ovs_type OVSBridge
  ovs_ports l2port
  
  auto pnet8
allow-ovs pnet8
iface pnet8 inet manual
  ovs_type OVSBridge
  ovs_ports l2port
  
  auto pnet9
allow-ovs pnet9
iface pnet9 inet manual
  ovs_type OVSBridge
  ovs_ports l2port
EOF
