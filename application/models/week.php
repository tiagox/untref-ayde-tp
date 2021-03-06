<?php

class Week extends CI_Model {

  const BEGIN_OFFSET_DAYS = 3;
  const HUMAN_FORMAT = 'd/m/Y';
  const SQL_FORMAT = 'Y-m-d';

  public $id;
  public $begin;
  public $end;
  public $week_in_month;
  public $month;
  public $year;

  private $months_names = array(
    1 => 'Enero',
    2 => 'Febrero',
    3 => 'Marzo',
    4 => 'Abril',
    5 => 'Mayo',
    6 => 'Junio',
    7 => 'Julio',
    8 => 'Agosto',
    9 => 'Septiembre',
    10 => 'Octubre',
    11 => 'Noviembre',
    12 => 'Diciembre'
  );

  public function __construct(stdClass $attributes = null)
  {
    parent::__construct();

    if (! is_null($attributes)) {
      $this->id = $attributes->id;
      $this->begin = new DateTime($attributes->begin);
      $this->end = new DateTime($attributes->end);
      $this->week_in_month = $attributes->week_in_month;
      $this->month = $attributes->month;
      $this->year = $attributes->year;
    }
  }

  public function fetch_this_week(DateTime $date = null)
  {
    $date = is_null($date) ? new DateTime() : $date;

    $oneDayInterval = new DateInterval('P1D');
    $fourDaysInterval = new DateInterval('P4D');

    while ($date->format('w') != '1') {
      $date->sub($oneDayInterval);
    }

    $this->end = clone $date;
    $this->begin = clone $date->add(new DateInterval('P4D'));

    return $this;
  }

  public function fetch_prev_week(DateTime $date = null)
  {
    $date = is_null($date) ?
        (is_null($this->begin) ? new DateTime() : clone $this->begin) :
        $date;

    $oneDayInterval = new DateInterval('P1D');
    $fourDaysInterval = new DateInterval('P4D');

    while ($date->format('w') != '5') {
      $date->sub($oneDayInterval);
    }

    $this->end = clone $date;
    $this->begin = clone $date->sub(new DateInterval('P4D'));

    return $this;
  }

  public function get_month()
  {
    if (!is_null($this->end) && intval($this->end->format('d')) >= 3) {
      return intval($this->end->format('m'));
    } else {
      return intval($this->begin->format('m'));
    }
  }

  public function get_all()
  {
    $this->db->order_by('begin', 'desc');

    $query = $this->db->get('weeks');

    $result = array();

    foreach ($query->result() as $week) {
      $result[] = new Week($week);
    }

    return $result;
  }

  public function get_weeks_to_report()
  {
    $this->db->order_by('begin', 'desc');

    $query = $this->db->get_where('weeks', array('month >=' => $this->get_last_closed_month()));

    $result = array();

    foreach ($query->result() as $week) {
      $result[] = new Week($week);
    }

    return $result;
  }

  public function get_reports_months_for_select()
  {
    $this->db->select('month');
    $this->db->select('year');
    $this->db->from('weeks');
    $this->db->where('month <=', $this->get_last_closed_month());
    $this->db->group_by(array('year', 'month'));
    $this->db->order_by('year', 'desc');
    $this->db->order_by('month', 'desc');

    $months = array();

    foreach ($this->db->get()->result() as $month) {
      $value = '/' . $month->year . '/' . $month->month;
      $option = $this->months_names[$month->month] . ' de ' . $month->year;
      $months[$value] = $option;
    }

    return $months;
  }

  public function parse_to_select(array $weeks)
  {
    $weeksToSelect = array();

    foreach ($weeks as $week) {
      $weeksToSelect[$this->months_names[$week->month] . ' ' . $week->year][$week->id] = $week->week_in_month . '° semana de ' .
          $this->months_names[$week->month] . ' (' . strval($week) . ')';
    }

    return $weeksToSelect;
  }

  public function get_weeks_of_the_month($month)
  {
    $this->db->order_by('begin', 'asc');

    $query = $this->db->get_where('weeks', array('month' => $month));

    $result = array();

    foreach ($query->result() as $week) {
      $result[] = new Week($week);
    }

    return $result;
  }

  public function get_last_closed_month()
  {
    return $this->fetch_this_week()->get_month() - 1;
  }

  public function get_month_period_dates($month)
  {
    $weeks_of_the_month = $this->get_weeks_of_the_month($month);

    $week = new stdClass();
    $week->id = 0;
    $tmp = reset($weeks_of_the_month);
    $week->begin = $tmp->begin->format(self::SQL_FORMAT);
    $tmp = end($weeks_of_the_month);
    $week->end = $tmp->end->format(self::SQL_FORMAT);
    $week->week_in_month = NULL;
    $week->month = $month;
    $week->year = NULL;

    return new Week($week);
  }

  public function __toString()
  {
    return $this->begin->format(self::HUMAN_FORMAT) . ' - ' .
        $this->end->format(self::HUMAN_FORMAT);
  }

}
