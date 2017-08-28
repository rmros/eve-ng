# eve-ng
This is an EVE-NG fork of just the html directory to add functionality.

Fucntionality is currently incomplete, use at own risk.
## Installation
Replace your /opt/unetlab/html directory with the files here
Additionally, you will need to update your /etc/network/interfaces file
```
auto pnet2
iface pnet2 inet manual
    bridge_ports eth2
    bridge_stp off


auto pnet2
allow-ovs pnet2
iface pnet2 inet manual
  ovs_type OVSBridge
  ovs_ports l2port
```

## List of changes/New features
* Linux bridge code is replaced for Open Virtual Switch
* Docker support was mostly functional, but made a few small changes to make it function
* Rewrote handler function for docker to support vnc, telnet and w/custom ports
* Rezrote capture handler to capture traffic locally to docker node

## Known Issues and todos
* Need to work on error checking for adding interfaces
* Currently interfaces aren't removed when docker images are deleted
* Unknown container error when deleting docker nodes (they are deleted though)
* Docker mgmt interface attaches as eth0. Need to change this to soemthing such as mgmt0 as to not conflict with dataplace interfaces


