#!/bin/bash
# GNU bash, version 4.3.46
echo "clef  ${key}";
sshpass -p ${key} ssh -o StrictHostKeyChecking=no root@vps554131.ovh.net bash afterWork2/script.sh;