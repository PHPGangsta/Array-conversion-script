<?php

function max_compress($a) {
  $cnt = count($a);
  $nxt = $a[0];
  for($i=1; $i < $cnt; $i++) {
    $pre = $nxt;
    $nxt = $a[$i];
    if (($pre+1 == $nxt || $pre-1 == $nxt)) { //found a range
      //current range: $pre-$nxt - try to expand
      if (++$i < $cnt) { //not at the end of the array
        $start = $pre;
        $pre = $nxt;
        $nxt = $a[$i];
        //reach end of array or reach range limit
        while (($pre+1 == $nxt || $pre-1 == $nxt)) { // search end of range/array
          if (++$i < $cnt) { //range is good
            $pre = $nxt;
            $nxt = $a[$i];
          } else { //reached end of array
            $ret[] = $start.'-'.$nxt;
            return $ret;
          }
        }
        $ret[] = $start.'-'.$pre;
      } else { //reached end of array.
        $ret[] = $pre.'-'.$nxt;
        return $ret;
      }
    } else { //just a single element
      $ret[] = $pre;
    }
  }
  //handle last element - just add it
  $ret[] = $nxt;
  return $ret;
}


function max_decompress($a) {
    $b = array();

    foreach ($a as $i) {
        if (!is_string($i)) {
            $b[] = $i;
        } else {
            $x = explode('-', $i);
            for (; $x[0] <= $x[1]; $x[0]++) {
                $b[] = $x[0];
            }
        }
    }

    return $b;
}

