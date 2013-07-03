<?php

class WeekFixture
{

  private $value;

  public function setMyValue($value)
  {
    $this->value = $value;
  }

  public function valueSuccessor()
  {
    return $this->value + 1;
  }

}
