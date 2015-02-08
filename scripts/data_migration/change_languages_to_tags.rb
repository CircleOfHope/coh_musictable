#!/usr/bin/env ruby

# This script is meant to take the data in the "languages" table and put it
# into the 'tags' table. This is part of a refinement in the database to beef
# up the capability of tags. The 'languages' table will cease to exist and will
# be replaced with a tag for each language, each with a TagType of "Language".

if ARGV.length < 4
  puts "usage: #{__FILE__} host db user password"
  exit
end

host = ARGV[0]
db = ARGV[1]
user = ARGV[2]
password = ARGV[3]

require 'sequel'

DB = Sequel.mysql2(host: host,
                   database: db,
                   user: user,
                   password: password
                  )

LANGUAGE_TAG_TYPE_ID = 1

languages = DB[:languages].all
languages_songs = DB[:languages_songs].all

DB.transaction do
  languages.each do |lang|

    # make new tag
    new_lang_tag_id = DB[:tags].insert(name: lang[:name])

    # give the new tag a Language type
    DB[:tags_tagtypes].insert(tag_id: new_lang_tag_id, tagtype_id: LANGUAGE_TAG_TYPE_ID)

    # map the new language tag to its relevant songs
    languages_songs.select {|ls| ls[:language_id] == lang[:id]}.each do |lang_song|
      DB[:songs_tags].insert(song_id: lang_song[:song_id], tag_id: new_lang_tag_id)
    end
  end
end

