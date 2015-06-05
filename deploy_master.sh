#!/bin/bash

if [ $# -lt 1 ]; then
echo Usage: $0 db_password
exit
fi

cd

timestamp=`date +%Y%m%d%H%M%S`

pushd coh_musictable
git checkout .
git checkout master
git pull --ff-only

#make some server-only tweaks
perl -pi -e "s#(\[\'hostname\'\] = )\'\S+\'#\1\'mysql.musiccircleofhope.dreamhosters.com\'#" public_html/application/config/database.php
perl -pi -e "s#(\[\'username\'\] = )\'\S+\'#\1\'circlemusic\'#" public_html/application/config/database.php
perl -pi -e "s#(\[\'password\'\] = )\'\S+\'#\1\'$1\'#" public_html/application/config/database.php
perl -pi -e "s#(\[\'database\'\] = )\'\S+\'#\1\'circlemusic\'#" public_html/application/config/database.php
perl -pi -e "s#'ENVIRONMENT', 'development'#'ENVIRONMENT', 'production'#" public_html/index.php

#backup database and files
mysqldump -u circlemusic -p$1 circlemusic --routines > musictable.sql
tar cfz ../backup/$timestamp.tar.gz music.circleofhope.net musictable.sql
rm musictable.sql

echo "New website is staged, press Return to move it into production, otherwise Ctrl-C to abort."
read

#install new directories
mv ../music.circleofhope.net ../music.circleofhope.net.old
mv public_html ../music.circleofhope.net
rm -rf ../music.circleofhope.net.old

git checkout .
popd

