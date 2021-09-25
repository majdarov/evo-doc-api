<?php

namespace App\Lib;

trait TraitBarcode
{
  public static function createBarcode(string $code, string $prefix = '0000'): ?string
  {
    if (strlen($code) < 6) {
      $code = str_repeat('0', 6 - strlen($code)).$code;
    }
    $A1 = '20'.$prefix.$code;
    $A2 = 0;
    foreach (str_split($A1) as $i => $item)
      if ($i % 2 !== 0) {
        $A2 += (int) $item * 3;
      } else {
        $A2 += (int) $item;
      }

    $A2 = (10 - ($A2 % 10)) % 10;
    $bc = $A1.$A2;
    return $bc;
  }
}
