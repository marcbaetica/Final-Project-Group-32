# Marc-Alexandru Baetica
# this file contains basic commands that are called to limit the ingress bandwidth over an OVS interface in a mininet topology
# a basic 50Mb/s implementation of this would be for interface s1-eth1 (attached to switch s1 and making the way to host h1), where the rate is measured in bits would be by calling $./bandwidth_setup.sh 1 5000 500
# also for simply calling the command in mininet it would be
# mininet> s1 ovs-vsctl set interface s1-eth1 ingress_policing_rate=50000
# mininet> s1 ovs-vsctl set interface s1-eth1 ingress_policing_burst=5000
# for testing use the iperf command in mininet or install and use nperf

s1 ovs-vsctl set interface s1-eth$1 ingress_policing_rate=$2
s1 ovs-vsctl set interface s1-eth$1 ingress_policing_burst=$3

#for egress via OVS (this is a layer 3 request)

#ovs-vsctl -- set Port vnet2 qos=@newqos -- \
#--id=@newqos create QoS type=linux-htb other-config:max-rate=4000000 queues=0=@q0 -- \
#--id=@q0   create   Queue   other-config:min-rate=4000000 other-config:max-rate=4000000
