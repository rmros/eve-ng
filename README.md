# eve-ng
This is an EVE-NG fork of just the html directory to add functionality.

Fucntionality is currently incomplete, use at own risk.
## Installation
Installation can be done ontop of an existing 2.0.77 EVE-NG install zith the following

```
cd  /opt/unetlab
git clone https://github.com/breakintheweb/eve-ng.git
mv html htmlbak
mv eve-ng html
mv html/install.sh ./
./install.sh

```

# Capture to docker node feature

Firstly, you need to pull a docker image with vnc. The below image should work
```
docker pull danielguerra/wireshark-vnc
```

Next, you will need to create a docker node with this image inside your lab.

Once the image is running you will need to add the container id to includes/.config 
The format is labid_tenantid_nodeid

You can also find it by using docker ps from the cli.

## List of changes/New features
* Linux bridge code is replaced for Open Virtual Switch
* Docker support was mostly functional, but made a few small changes to make it function
* Rewrote handler function for docker to support vnc, telnet and w/custom ports
* Rewrote capture handler to capture traffic locally to docker node

## Known Issues and todos
* Need to link the ovs pnet interfaces to physical interfaces
* Need to work on error checking for adding interfaces
* Currently interfaces aren't removed when docker images are deleted
* Docker mgmt interface attaches as eth0. Need to change this to something such as mgmt0
* Docker data interfaces attach with vunlx_x_x nomenclature
