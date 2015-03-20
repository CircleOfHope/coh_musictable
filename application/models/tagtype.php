<?php
class TagType extends DataMapper {

  function __construct($id = NULL)
  {
    parent::__construct($id);
  }

  var $has_many = array('tag');
  
  var $validation = array();

  function get_tags_for_tagtype($id)
  {
    $tt = new TagType();
    $tt->get_by_id($id);
    //$tt->tag->get();
    $tags = array();
    foreach($tt->tag as $tag){
      $tags[$tag->id] = $tag->Name;
    }
    return $tags;
  }

#TODO
  function get_tagtype_for_tag($options = array())
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

  function get_all()
  {
    $t = new TagType;
    $t->order_by('Name')->get();
    $alltagtypes = array();
    foreach($t as $tagtype) {
      $alltagtypes[$tagtype->id] = $tagtype->Name;
    }
    return $alltagtypes;
  }

  function get_one($id) {
    $t = new TagType;
    $t->get_by_id($id);
    return $t->Name;
  }

  function add($name = '')
  {
    $t = new TagType();
    $t->Name = $name;
    $t->save();
    return $t->id;
  }

#TODO
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
    $t = new TagType();
    $t->get_by_id($id);
    $t->delete();
  }
};
?>
