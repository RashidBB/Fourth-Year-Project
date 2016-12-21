#!/bin/bash
#run a python script

cd ~
cd /var/www/html

echo "Executing a python script!"
sudo python get_current_temp.py
echo "finished execution"

