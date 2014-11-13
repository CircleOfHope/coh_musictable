<?php
class Attachment extends DataMapper {
	var $extensions = array('array');
  function __construct($id = NULL)
  {
    parent::__construct($id);
    $this->load_extension('array');
  }

  var $has_one = array('song');
  
  var $validation = array();

  function get_attachments_for_song($id)
  {
     $s = new Song;
    $s->get_by_id($id);
    $s->attachment->get();
    return $s->attachment;
  }

  function get_one($id = 0)
  {
    $a = new Attachment;
    $a->get_by_id($id);
    return $a;
  }
  
  function add($name = '', $url = '')
  {
    $a = new Attachment;
    $a->Name = $name;
    $a->Url = $url;
    $a->save();
    return $a->id;
  }

  function update($id, $type, $url)
  {
    $s = new Attachment;
    $s->get_by_id($id);
    if($s->Name != $type) $s->Name = $type;
    if($s->Url != $url) $s->Url = $url;
    $s->save();
    return $s;
  }

  function remove($id)
  {
    $a = new Attachment();
    $a->get_by_id($id);
    $a->delete();
  }
};
?>