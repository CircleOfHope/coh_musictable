<?php
class Tag extends DataMapper {

  function __construct($id = NULL)
  {
    parent::__construct($id);
  }

  var $has_many = array('song');
  var $has_one = array('tagtype');
  
  var $validation = array();

  function get_tags_for_song($options = array())
  {
    $s = new Song();
    $s->get_by_id($options['id']);
    $s->tag->get();
    $tags = array();
    foreach($s->tag as $tag){
      $tags[$tag->id] = $tag->Name;
    }
    return $tags;
  }

  function get_tags_for_tagtype($id)
  {
    $tt = new TagType();
    $tt->get_by_id($id);
    $tt->tag->get();
    $tags = array();
    foreach($tt->tag as $tag){
      $tags[$tag->id] = $tag->Name;
    }
    natcasesort($tags);
    return $tags;
  }

  function get_all()
  {
    $t = new Tag;
    $t->order_by('Name')->get();
    $alltags = array();
    foreach($t as $tag) {
      $alltags[$tag->id] = $tag->Name;
    }
    return $alltags;
  }

  function get_one($id) {
    $t = new Tag;
    $t->get_by_id($id);
    return $t->Name;
  }

  function get_by_name($name) {
    $t = new Tag;
    $t->where("Name", $name)->get();
    return $t->id;
  }

  function add($name = '', $tagtypeid = -1)
  {
    echo "add:" + $name + " " + $tagtypeid;
    $t = new Tag();
    $t->Name = $name;
    $t->save();
    $tt = new TagType();
    $tt->get_by_id($tagtypeid);
    $t->save($tt);
    return $t->id;
  }

 function update($id, $set_tags)
 {
   $s = new Song;
   $s->get_by_id($id);
   foreach($s->tag as $tag) {
     if($tag->id == in_array($tag, $set_tags)) echo "TAG: $tag";
   }
 }

  function remove($id)
  {
    $t = new Tag();
    $t->get_by_id($id);
    $t->delete();
  }
};
?>
