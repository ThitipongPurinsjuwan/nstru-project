<?php

namespace common\util;

class DateTimeCustom
{
  public static function getDateThai($date)
  {
    $date = date_create($date);
    return date_format($date, "Y F,W");
  }
}
