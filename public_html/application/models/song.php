<?php
class Song extends DataMapper {

    const page_size = 50;

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

    var $has_many = array('tag','attachment');
    
    var $validation = array();
    
    function get_count()
    {
        $s = new Song();
        $s->where("Title IS NOT NULL AND Title <> ''");
        return $s->count();
    }

    function get_all($page_index = 0)
    {
        $s = new Song();
        $s->where("Title IS NOT NULL AND Title <> ''")->order_by('Title','asc')->get_paged($page_index+1, self::page_size);
        return $s;
    }
    
    function get_one($id)
    {
        $s = new Song();
        $s->get_by_id($id);
        return $s;
    }

    function get_multi($options = array())
    {
        $page_index = isset($options['page_index']) ? $options['page_index'] : 0;
        $search_string = $options['search_string'];
        $language = $options['language'];
	$qstring = "
SELECT distinct s.*,
MATCH(s.Title, s.Artist, s.Scripture, s.LyricsExcerpt, s.Notes) AGAINST ('$search_string' in boolean mode) as score
FROM songs s
    LEFT JOIN songs_tags st ON st.song_id = s.id
    LEFT JOIN tags t ON t.id = st.tag_id
    LEFT JOIN tags_tagtypes tt ON tt.id = st.tag_id
WHERE
    (
        '$language' = ''
        OR $language = 1 AND t.name = 'English'
        OR $language = 2 AND t.name = 'Foreign'
        OR $language = 3
    )
    AND
    (
    (
        '$search_string' = '' OR MATCH(s.Title, s.Artist, s.Scripture, s.LyricsExcerpt, s.Notes) AGAINST ('$search_string' in boolean mode)
    )
    OR t.Name LIKE '%{$search_string}%'
    )
ORDER BY score DESC, s.Title ASC;";
        return $this->db->query($qstring);
    }

    function add($data)
    {
        $s = new Song();
        foreach ($data as $key => $val)
            $s->$key = $val;  
        
        $s->save();
        return $s->id;
    }

    function update($id,$data)
    {
        $qstring = $this->db->update_string('songs',$data,"id=$id");
        $this->db->query($qstring);
    }

    function remove($id)
    {
        $s = new Song();
        $s->get_by_id($id);
        $s->delete();
    }

    function add_attachment($songids, $attachids) {
        foreach(explode(',', $songids) as $songid) {
            $s = new Song();
            $s->get_by_id($songid);
            foreach(explode(',', $attachids) as $attachid) {
                $a = new Attachment();
                $a->get_by_id($attachid);
                $s->save($a);
            }
        }
    }

    function remove_attachment($songids, $attachids) {
        foreach(explode(',', $songids) as $songid) {
            $s = new Song();
            $s->get_by_id($songid);
            foreach(explode(',', $attachids) as $attachid) {
                $a = new Attachment();
                $a->get_by_id($attachid);
                $s->delete($a);
            }
        }
    }

    function add_tag($songids, $tagids) {
        foreach(explode(',', $songids) as $songid) {
            $s = new Song();
            $s->get_by_id($songid);
            foreach(explode(',', $tagids) as $tagid) {
                $t = new Tag();
                $t->get_by_id($tagid);
                $s->save($t);
            }
        }
    }

    function remove_tag($songids, $tagids) {
        foreach(explode(',', $songids) as $songid) {
            $s = new Song();
            $s->get_by_id($songid);
            foreach(explode(',', $tagids) as $tagid) {
                $t = new Tag();
                $t->get_by_id($tagid);
                $s->delete($t);
            }
        }
    }


};
?>