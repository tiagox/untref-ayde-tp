<?php

class Week extends CI_Model {

  const BEGIN_OFFSET_DAYS = 3;
  const HUMAN_FORMAT = 'd/m/Y';
  const SQL_FORMAT = 'Y-m-d';

  public $id;
  public $begin;
  public $end;
  public $month;

  public function __construct(stdClass $attributes = null)
  {
    parent::__construct();

    if (! is_null($attributes)) {
      $this->id = $attributes->id;
      $this->begin = new DateTime($attributes->begin);
      $this->end = new DateTime($attributes->end);
      $this->month = $attributes->month;
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

  public function parse_to_select(array $weeks)
  {
    $weeksToSelect = array();

    foreach ($weeks as $week) {
      $weeksToSelect[$week->id] = strval($week);
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
    $week->month = $month;

    return new Week($week);
  }

  public function __toString()
  {
    return $this->begin->format(self::HUMAN_FORMAT) . ' - ' .
        $this->end->format(self::HUMAN_FORMAT);
  }

}
