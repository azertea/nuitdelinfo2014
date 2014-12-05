#!/bin/bash

#
#  WARNING: you need an authenticate CloudFoundry CLI to use this script
#

cd site && cf push nuitdelinfo2014 -m 512M -b https://github.com/zendtech/zend-server-php-buildpack-bluemix.git || cd ..

