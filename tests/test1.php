<?php

require_once('../lib/afpa/APUnit.php');

use afpa\APUnit;

APUnit::test(
  'Verify Success Output',
  function(){
    $display = APUnit::captureOutput(
      function(){
        APUnit::test(
          'Green is Ok ?',
          function(){
            return [1, []];
          }
        );
      }
    );

    if($display === "Green is Ok ?                 [1/1] \e[0;32mOk\e[0m".PHP_EOL)
      return [1, []];
    else
      return [1, ["successOutput deficient"]];
    }
);

APUnit::test(
  'Verify Error Output',
  function(){
    $display = APUnit::captureOutput(
      function(){
        APUnit::test(
          'Error is Ok ?',
          function(){
            return [1, ['Automatic Failure']];
          }
        );
      }
    );

    $expected = "Error is Ok ?                 [0/1] \e[0;31mFAIL\e[0m" . PHP_EOL .
                  'Automatic Failure' . PHP_EOL;

    if($display === $expected)
      return [1, []];
    else
      return [1, ["successOutput deficient"]];
  }
);
