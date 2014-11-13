<?php
class User extends DataMapper {

  function __construct($id = NULL)
  {
    parent::__construct($id);
  }

  var $has_many = array();
  
  var $validation = array();

  function validate($username, $password)
  {
    $u = new User();
    $u->where('username', $username);
    $u->where('password', $password);
    $u->get();
    if(!$u->exists()) {
       return FALSE;
    } else {
      return TRUE;
    }
  }

  function add($username = '', $password = '')
  {
    $u = new User();
    $u->username = $username;
    $u->password = MD5($password);
    $u->save();
    return $u->id;
  }

  function remove($id)
  {
    $u = new User();
    $u->get_by_id($id);
    $u->delete();
  }
};
?>
