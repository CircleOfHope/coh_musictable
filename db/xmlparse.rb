#!/usr/bin/env ruby19

require 'rexml/document'
require 'mysql'

db = Mysql.real_connect('localhost', 'musictable', 'musictable', 'musictable')
db.query('truncate table attachments;')
db.query('truncate table attachments_songs;')
db.query('truncate table languages;')
db.query('truncate table languages_songs;')
db.query('truncate table songs;')
db.query('truncate table songs_tags;')
db.query('truncate table tags;')

attachment_id = 0
attachment_song_id = 0
language_id = 0
language_song_id = 0
song_id = 0
song_tag_id = 0
tag_id = 0

ARGV.each do |mtxml|
  xml = File.read(mtxml)
  doc, posts = REXML::Document.new(xml), []
  doc.elements.each('MusicTableRowSet/Song') do |p|
    title = p.elements['Title'].text ? p.elements['Title'].text : ''
    artist = p.elements['Artist'].text ? p.elements['Artist'].text : ''
    scripture = p.elements['Scripture'].text ? p.elements['Scripture'].text : ''
    if p.elements['Type'].nil?
      type = 'Foreign'
    else
      type = p.elements['Type'].text ? p.elements['Type'].text : ''
    end
    if p.elements['Language'].nil?
      lang = 'English'
    else
      lang = p.elements['Language'].text ? p.elements['Language'].text : ''
    end
    lyricsexcerpt = p.elements['FirstLine'].text ? p.elements['FirstLine'].text : ''
    notes = p.elements['Notes'].text ? p.elements['Notes'].text : ''
    lyricslink = p.elements['FirstLineLink'].text ? p.elements['FirstLineLink'].text : ''
    mp3link = p.elements['Mp3Link'].text ? p.elements['Mp3Link'].text : ''
    videolink = p.elements['VideoLink'].text ? p.elements['VideoLink'].text : ''
    quarantined = (p.elements['Quarantined'].text == 'true') ? "b'1'" : "b'0'"

    song_id += 1
    db.query('INSERT INTO songs (Title, Artist, Scripture, LyricsExcerpt, Notes, Quarantined) VALUES ("' + [title, artist, scripture, lyricsexcerpt, notes.gsub('"','\"')].join('","') + '", ' + quarantined + ');')
    res = db.query('SELECT LAST_INSERT_ID();')
    songid = res.fetch_row()[0].to_i()
    res.free()

    if lyricslink != ''
      attachment_id += 1
      db.query('INSERT INTO attachments (Name,Url) VALUES ("' + ['Lyrics',lyricslink].join('","') + '");')
      res = db.query('SELECT LAST_INSERT_ID();')
      attachid = res.fetch_row()[0].to_i()
      res.free()
      attachment_song_id += 1
      db.query('INSERT INTO attachments_songs (song_id,attachment_id) VALUES ("' + [songid,attachid].join('","') + '");')
    end

    if mp3link != ''
      attachment_id += 1
      db.query('INSERT INTO attachments (Name,Url) VALUES ("' + ['MP3',mp3link].join('","') + '");')
      res = db.query('SELECT LAST_INSERT_ID();')
      attachid = res.fetch_row()[0].to_i()
      res.free()
      attachment_song_id += 1
      db.query('INSERT INTO attachments_songs (song_id,attachment_id) VALUES ("' + [songid,attachid].join('","') + '");')
    end

    if videolink != ''
      attachment_id += 1
      db.query('INSERT INTO attachments (Name,Url) VALUES ("' + ['Video',videolink].join('","') + '");')
      res = db.query('SELECT LAST_INSERT_ID();')
      attachid = res.fetch_row()[0].to_i()
      res.free()
      attachment_song_id += 1
      db.query('INSERT INTO attachments_songs (song_id,attachment_id) VALUES ("' + [songid,attachid].join('","') + '");')
    end

    if lang != ''
      lang.split(',').each { |t|
        res = db.query('SELECT ID FROM languages WHERE Name = "' + t + '";')
        if res.num_rows() > 0
          langid = res.fetch_row()[0].to_i()
        else
          language_id += 1
          db.query('INSERT INTO languages (name) VALUES ("' + [t].join('","') + '");')
          res.free
          res = db.query('SELECT LAST_INSERT_ID();')
          langid = res.fetch_row()[0].to_i()
          res.free()
        end
        language_song_id += 1
        db.query('INSERT INTO languages_songs (song_id,language_id) VALUES ("' + [songid,langid].join('","') + '");')
      }
    end

    if type != ''
      type.split(',').each { |t|
        res = db.query('SELECT ID FROM tags WHERE Name = "' + t + '";')
        if res.num_rows() > 0
          tagid = res.fetch_row()[0].to_i()
        else
          tag_id += 1
          db.query('INSERT INTO tags (Name) VALUES ("' + [t].join('","') + '");')
          res.free
          res = db.query('SELECT LAST_INSERT_ID();')
          tagid = res.fetch_row()[0].to_i()
          res.free()
        end
        song_tag_id += 1
        db.query('INSERT INTO songs_tags (song_id,tag_id) VALUES ("' + [song_id,tagid].join('","') + '");')
      }
    end
  end
end
db.close()
