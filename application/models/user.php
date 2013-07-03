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

  public function get($id)
  {
    $query = $this->db->get_where('users', array('id' => $id));

    return $query->first_row();
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

  public function add($username, $password, $name, $salary, $rol, $weekly_hours, $entry_date)
  {
    $this->username = $username;
    $this->password = md5($password);
    $this->name = $name;
    $this->salary = $salary;
    $this->rol = $rol;
    $this->weekly_hours = $weekly_hours;
    $this->entry_date = $entry_date;

    return $this->db->insert('usersToSelect', $this);
  }

  public function update($id, $username, $password, $name, $salary, $rol, $weekly_hours, $entry_date)
  {
    $this->db->set('username', $username);
    if (!is_null($password)) {
      $this->db->set('password', md5($password));
    }
    $this->db->set('name', $name);
    $this->db->set('salary', $salary);
    $this->db->set('rol', $rol);
    $this->db->set('weekly_hours', $weekly_hours);
    $this->db->set('entry_date', $entry_date);

    $this->db->where('id', $id);

    return $this->db->update('users');
  }

  public function delete($id)
  {
    return $this->db->delete('users', array('id' => $id));
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
