# eve-ng
This is an EVE-NG fork of just the html directory to add functionality.

Fucntionality is currently incomplete, use at own risk.
## Installation
Installation can be done ontop of an existing 2.0.79 EVE-NG install with the following

```
cd  /opt/unetlab
git clone https://github.com/breakintheweb/eve-ng.git
mv html htmlbak
mv eve-ng html
mv html/install.sh ./
./install.sh
```


The install script does the following;
backup /etc/network/interfaces to interfaces.bak
installs docker.io
modifies docker startup script and configuration
modifies openvswitch to fix issue
modifies apache2 startup to fix issue
add new /etc/network/interfaces for ovs

## Uninstallation
Uninstallation should be as easy as restoring the html directory and interfaces file


# Capture to docker node feature

Firstly, you need to pull a docker image with vnc. The below image should work
```
docker pull danielguerra/wireshark-vnc
```

Next, you will need to create a docker node with this image inside your lab.

Once the image is running you will need to add the container id to includes/.config 
The format is labid_tenantid_nodeid

You can also find it by using docker ps from the cli.

Note: The script which adds the capture inteface dosent have rights to modify the ovs db. I need to fix this but for the time being you can
chmod 777 /var/run/openvswitch/db.sock
or 
chown www-data:www-data /var/run/openvswitch/db.sock


## List of changes/New features
* Linux bridge code is replaced for Open Virtual Switch
* Docker support was mostly functional, but made a few small changes to make it function
* Rewrote handler function for docker to support vnc, telnet and w/custom ports
* Rewrote capture handler to capture traffic locally to docker node
* Ability to add links to already running devices (hotadd)

## Known Issues and todos
* Need to link the ovs pnet interfaces to physical interfaces
* Need to work on error checking for adding interfaces
* Docker mgmt interface attaches as eth0. Need to change this to something such as mgmt0
* Docker data interfaces attach with vunlx_x_x nomenclature
