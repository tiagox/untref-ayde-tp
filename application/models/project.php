<?php

class Project extends CI_Model {

  public $id;
  public $name;
  public $active;

  public function get($id)
  {
    $query = $this->db->get_where('projects', array('id' => $id));

    return $query->first_row();
  }

  public function get_all()
  {
    $query = $this->db->get('projects');

    return $query->result();
  }

  public function get_all_active()
  {
    $query = $this->db->get_where('projects', array('active' => 1));

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
    $this->id = $id;
    $this->name = $name;
    $this->active = $active;

    return $this->db->update('projects', $this, array('id' => $id));
  }

  public function delete($id)
  {
    return $this->db->delete('projects', array('id' => $id));
  }

}
