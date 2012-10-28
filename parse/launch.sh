#!/bin/sh
#$ -N sqltest
#$ -l sql-user-a=1
#$ -m abes
#$ -l h_rt=2:00:00
#$ -l virtual_free=100M
#$ -wd /home/bjelleklang/nolinks/parse

./parsedump.py
