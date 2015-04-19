#this is an automated script used to generate our initial setup
#pre-run assumptions:
# 1 - machine ip stack makes internet requests on interface eth0 
# 2 - 

#ovs setup
ovs-vsctl add-br mybridge
ifconfig mybridge up #connect to ip stack
ovs-vsctl add-port mybridge eth0

#ping request is still done through eth0
ifconfig eth0 0
dhclient mybridge


#to show kernel IP routing table
#route -n

#remove
#ovs-vsctl del-br mybridge
#dhclient eth0


#adding interfaces for VMs
ip tuntap add mode tap vport1
ip tuntap add mode tap vport2
ip tuntap add mode tap vport3
ifconfig vport1 up
ifconfig vport2 up
ifconfig vport3 upd

#add them to ovs. NOTE: make sure VM network interface is set up for 'bridge adapter'
ovs-vsctl add-port mybridge vport1
ovs-vsctl add-port mybridge vport2 
ovs-vsctl add-port mybridge vport3

#to map the ports we need to use ovs-appctl to configure query daemons associated with ovs
#look this up in the tutorial