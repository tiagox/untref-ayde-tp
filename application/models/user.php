<?php

class User extends CI_Model {

  public $id;
  public $username;
  public $password;
  public $name;
  public $salary;
  public $rol;
  public $weekly_hours;
  public $entry_date;

  public function __construct(stdClass $attributes = null)
  {
    parent::__construct();

    if (! is_null($attributes)) {
      $this->id = $attributes->id;
      $this->username = $attributes->username;
      $this->password = $attributes->password;
      $this->name = $attributes->name;
      $this->salary = $attributes->salary;
      $this->rol = $attributes->rol;
      $this->weekly_hours = $attributes->weekly_hours;
      $this->entry_date = $attributes->entry_date;
    }
  }

  public function validate($username, $password)
  {
    $query = $this->db->get_where(
      'users',
      array(
        'username' => $username,
        'password' => md5($password)
      ),
      1
    );

    if($query->num_rows() === 1) {
      return reset($query->result());
    } else {
      return false;
    }
  }

  public function get_all()
  {
    $query = $this->db->get('users');

    $result = array();

    foreach ($query->result() as $user) {
      $result[] = new User($user);
    }

    return $result;
  }

  public function get_by_id($user_id)
  {
    $query = $this->db->get_where('users', array('id' => $user_id));

    $result = array();

    foreach ($query->result() as $user) {
      $result[] = new User($user);
    }

    return reset($result);
  }

  public function parse_to_select(array $users)
  {
    $usersToSelect = array();

    foreach ($users as $user) {
      $usersToSelect[$user->id] = strval($user->name);
    }

    return $usersToSelect;
  }

  public function __toString()
  {
    return $this->name;
  }

}
