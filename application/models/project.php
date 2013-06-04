<?php

class Project extends CI_Model {

  public $id;
  public $name;
  public $active;

  public function get_all()
  {
    $query = $this->db->get('projects');
    return $query->result();
  }

  public function add($name, $active)
  {
    $this->name = $name;
    $this->active = $active;

    return $this->db->insert('projects', $this);
  }

  public function update($id, $name, $active)
  {
    $this->name = $name;
    $this->active = $active;

    return $this->db->update('projects', $this, array('id' => $id));
  }

}
