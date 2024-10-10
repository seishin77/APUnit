<?php

namespace afpa;

class APUnit{

  static protected function successWrite($text, $result){
    printf("%-30s[%d/%2\$d] \e[0;32mOk\e[0m" . PHP_EOL, $text, $result[0]);
  }

  static protected function errorWrite($text, $result){
    printf(
      "%-30s[%d/%d] \e[0;31mFAIL\e[0m" . PHP_EOL,
      $text, $result[0] - count($result[1]), $result[0]
    );

    foreach($result[1] as $k => $v)
      echo $v, PHP_EOL;
  }

  static public function captureOutput($cb) : string{
    ob_start();
    $cb();
    return ob_get_clean();
  }

  /*
   * cb is a callback which returns array of 2 elements : number of testcases
   * and an array of error messages
   */
  static public function test(string $name, $cb) : void{
    $result = $cb();

    if(empty($result[1])){
      // test is successful
      static::successWrite($name, $result);
    }
    else{
      // one or more failed
      static::errorWrite($name, $result);
    }
  }
}
