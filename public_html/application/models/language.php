<?php
class Language extends DataMapper {

  function __construct($id = NULL)
  {
    parent::__construct($id);
  }

  var $has_many = array('song');
  
  var $validation = array();

  function get_languages_for_song($id)
  {
    $s = new Song();
    $s->get_by_id($id);
    $s->language->get();
    $languages = array();
    foreach($s->language as $language){
       $languages[$language->id] = $language->name;
    }
    return $languages;
  }

  function get_all()
  {
    $t = new Language;
    $t->order_by('name')->get();
    $alllanguages = array();
    foreach($t as $language) {
      $alllanguages[$language->id] = $language->name;
    }
    return $alllanguages;
  }

  function get_one($id) {
    $l = new Language;
    $l->get_by_id($id);
    return $l->name;
  }

  function add($name = '')
  {
    $t = new Language;
    $t->name = $name;
    $t->save();
    return $t->id;
  }

  function update($id, $set_languages)
  {
  	$s = new Song;
  	$s->where('id',$id)->get();
  	foreach($s->language as $language) {
  		if($language->id == in_array($language, $set_languages)) echo "LANG: $language";
 	}
  }

  function remove($id)
  {
    $l = new Language();
    $l->get_by_id($id);
    $l->delete();
  }
};
?>