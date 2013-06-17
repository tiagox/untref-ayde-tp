<?php

class Reported_Hour extends CI_Model {

  public $project_id;
  public $user_id;
  public $week_id;
  public $hours;

  public function save($project_id, $user_id, $week_id, $hours)
  {
    $this->db->delete('reported_hours', array(
        'project_id' => $project_id,
        'user_id' => $user_id,
        'week_id' => $week_id
      )
    );

    $this->project_id = $project_id;
    $this->user_id = $user_id;
    $this->week_id = $week_id;
    $this->hours = $hours;

    return $this->db->insert('reported_hours', $this);
  }

  public function get_cost_report($month)
  {
    $this->db->select('project');
    $this->db->select_sum('weekly_cost', 'monthly_cost');
    $this->db->from('weekly_cost');
    $this->db->where('month', $month);
    $this->db->group_by('project_id');

    return $this->db->get()->result();
  }

  public function get_all()
  {
    $query = $this->db->get('reported_hours');

    return $query->result();
  }

  public function parse_to_select(array $reported_hours)
  {
    $reportsToSelect = array();

    foreach ($reported_hours as $report) {
      $reportsToSelect[$report->project_id][$report->user_id][$report->week_id] = $report->hours;
    }

    return $reportsToSelect;
  }

  public function report_exists($project_id)
  {
    $this->db->select('project_id');
    $this->db->from('reported_hours');
    $this->db->where('project_id', $project_id);

    return $this->db->get()->result();
  }

}
