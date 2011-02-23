#!/bin/bash
#
# Simply copy the contents of this folder to the wordpress plugins folder
#


PLUGINS_DIR='/var/www/wordpress/wp-content/plugins/'
PWD=`pwd`

cp -Rvf $PWD $PLUGINS_DIR
