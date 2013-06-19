<?php

class Reported_Hour extends CI_Model {

  public $project_id;
  public $user_id;
  public $week_id;
  public $hours;

  /* 13 sueldos anuales contando el aguinaldo. */
  const SALARIES_BY_YEAR = 13;
  /* Cantidad de meses del año */
  const MONTHS_BY_YEAR = 12;
  /* Factor estimativo para calcular el sueldo bruto */
  const RAW_SALARY_FACTOR = 1.3;

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
    $weeks_in_month = $this->db->get_where('weeks', array('month' => $month))->num_rows();

    $this->db->select('p.id AS project_id');
    $this->db->select('p.name AS project');
    $this->db->select('w.month AS month');
    $this->db->select('w.begin AS week_begin');
    $this->db->select('w.end AS week_end');
    $this->db->select('u.id AS user_id');
    $this->db->select('u.name AS name');
    $this->db->select('rh.hours');
    $this->db->select('u.salary');
    $this->db->select('u.weekly_hours');

    $this->db->from('reported_hours rh');

    $this->db->join('users u', 'rh.user_id = u.id');
    $this->db->join('projects p', 'rh.project_id = p.id');
    $this->db->join('weeks w', 'rh.week_id = w.id');

    $this->db->where('month', $month);

    $projects = $this->sumarize_costs($this->db->get()->result(), $weeks_in_month);

    return $this->parse_to_result_set($projects);
  }

  private function sumarize_costs($result, $weeks_in_month)
  {
    $projects = array();

    foreach ($result as $row) {
      if (!isset($projects[$row->project_id])) {
        $projects[$row->project_id] = array();
      }

      if (!isset($projects[$row->project_id]['project'])) {
        $projects[$row->project_id]['project'] = $row->project;
      }

      if (!isset($projects[$row->project_id]['monthly_cost'])) {
        $projects[$row->project_id]['monthly_cost'] =
            $row->hours * $this->get_hourly_salary($row->salary, $row->weekly_hours, $weeks_in_month);
      } else {
        $projects[$row->project_id]['monthly_cost'] +=
            $row->hours * $this->get_hourly_salary($row->salary, $row->weekly_hours, $weeks_in_month);
      }

      if (!isset($projects[$row->project_id]['resources'])) {
        $projects[$row->project_id]['resources'] = array();
      }

      if (!isset($projects[$row->project_id]['resources'][$row->user_id]) && $row->hours > 0) {
        $projects[$row->project_id]['resources'][$row->user_id] = $row->name;
      }
    }

    return $projects;
  }

  private function get_hourly_salary($salary, $weekly_hours, $weeks_in_month)
  {
    return ($salary * (self::SALARIES_BY_YEAR / self::MONTHS_BY_YEAR) *
        self::RAW_SALARY_FACTOR) / ($weekly_hours * $weeks_in_month);
  }

  private function parse_to_result_set(array $projects)
  {
    $results = array();

    foreach ($projects as $project) {
      $result = new stdClass();
      $result->project = $project['project'];
      $result->monthly_cost = $project['monthly_cost'];
      $result->resources_count = count($project['resources']);

      $results[] = $result;
    }

    return $results;
  }

  public function get_all_by_user_id($user_id)
  {
    $result = $this->db->get_where('reported_hours', array('user_id' => $user_id))->result();

    $user_data = array();

    foreach ($result as $row) {
      $user_data['weeks'][$row->week_id]['projects'][$row->project_id] = $row->hours;
    }

    return $user_data;
  }

}
