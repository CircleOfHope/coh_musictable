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
perl -pi -e "s#(\[\'password\'\] = )\'\S+\'#\1\'$1\'#" public_html/application/config/database.php
perl -pi -e "s#'ENVIRONMENT', 'development'#'ENVIRONMENT', 'production'#" public_html/index.php

#backup database and files
mysqldump -u music -p$1 music --routines > musictable.sql
tar cfz ../backup/$timestamp.tar.gz public_html musictable.sql
rm musictable.sql

echo "New website is staged, press Return to move it into production, otherwise Ctrl-C to abort."
read

#install new directories
mv ../public_html ../public_html.old
mv public_html ../public_html
rm -rf ../public_html.old

git checkout .
popd

