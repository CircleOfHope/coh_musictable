#!/bin/bash

if [ $# -lt 1 ]; then
echo Usage: $0 db_password
exit
fi

cd

timestamp=`date +%Y%m%d%H%M%S`

#set up new directories
mkdir -p coh_musictable/website
rm -rf coh_musictable/website/*
rm -rf coh_musictable/website/.*

pushd coh_musictable
git checkout .
git checkout master
git pull --ff-only
popd
mv coh_musictable/css coh_musictable/img coh_musictable/scripts coh_musictable/favicon.ico coh_musictable/index.php coh_musictable/.htaccess coh_musictable/website/

#make some server-only tweaks
perl -pi -e "s#(system_path = )\'\S+\'#\1\'/home/music/system\'#" coh_musictable/website/index.php
perl -pi -e "s#(application_folder = )\'\S+\'#\1\'/home/music/application\'#" coh_musictable/website/index.php
perl -pi -e "s#(\[\'username\'\] = )\'\S+\'#\1\'music\'#" coh_musictable/application/config/database.php
perl -pi -e "s#(\[\'password\'\] = )\'\S+\'#\1\'$1\'#" coh_musictable/application/config/database.php
perl -pi -e "s#(\[\'database\'\] = )\'\S+\'#\1\'music\'#" coh_musictable/application/config/database.php

#backup database and files
mysqldump -u music -p$1 music > musictable.sql
tar cfz backup/$timestamp.tar.gz application sparks system tools website musictable.sql
rm musictable.sql

echo "New website is staged, press Return to move it into production, otherwise Ctrl-C to abort."
read

#install new directories
mv application application.old
mv coh_musictable/application application
mv system system.old
mv coh_musictable/system system
mv website website.old
mv coh_musictable/website website
rm -rf application.old
rm -rf system.old
rm -rf website.old

pushd coh_musictable
git checkout .
popd

