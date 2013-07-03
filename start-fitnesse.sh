#!/bin/sh

BASE_DIR=`pwd`

java -jar fitnesse-standalone.jar -e 0 -p 8080 -d $BASE_DIR

