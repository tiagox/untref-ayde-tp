<?php

class User extends CI_Model {

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
      return $query->result();
    } else {
      return false;
    }
  }

}
