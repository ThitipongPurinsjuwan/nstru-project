<?php

namespace common\util;

class StringCustom
{
  public static function showLess($content)
  {
    $text = strip_tags($content);

    if (strlen($text) > 200) {
      $text = mb_substr($text, 0, 200, 'UTF-8') . "...";
    }

    return $text;
  }
}
