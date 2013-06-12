<?php

class Reported_Hour extends CI_Model {

  public $project_id;
  public $user_id;
  public $week_id;
  public $hours;

  public function get_cost_report($month)
  {
    $this->db->select('project');
    $this->db->select_sum('weekly_cost', 'monthly_cost');
    $this->db->from('weekly_cost');
    $this->db->where('month', $month);
    $this->db->group_by('project_id');

    return $this->db->get()->result();
  }

}
