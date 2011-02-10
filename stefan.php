<?php

function a2a($arr) {
    if(!is_array($arr)) return $arr;
    $l = count($arr);
    $neu = array();
    $g = $l - 1;
    $i = 0;
    if(strstr(implode('', $arr), '-')) {
      while($i < $l) {
        $d = explode('-', $arr[$i]);
        switch(count($d)) {
          case 1: $neu[] = $arr[$i]; break;
          case 2: if($d[0] > $d[1]) for($c = $d[0]; !($c < $d[1]); $c--) $neu[] = $c;
                  else for($c = $d[0]; !($c > $d[1]); $c++) $neu[] = $c; break;
        }
        $i++;
      }
    } else {
        while($i < $l) {
          if($i < $g && $arr[$i] == $arr[$i + 1] + 1) {
            $d = $arr[$i];
            while($i < $g && $arr[$i] == $arr[$i + 1] + 1) $i++;
            $neu[] = sprintf('%d-%d', $d, $arr[$i++]);
          } elseif($i < $g && $arr[$i] == $arr[$i + 1] - 1) {
            $d = $arr[$i];
            while($i < $g && $arr[$i] == $arr[$i + 1] - 1) $i++;
            $neu[] = sprintf('%d-%d', $d, $arr[$i++]);
          } else $neu[] = $arr[$i++];
        }
      }
    return $neu;
  }