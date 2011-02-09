<?php

function max_compress($a) {
    $cnt = count($a);
    for ($i = 2; $i < $cnt; $i++) {
        $pre = $a[$i - 2];
        if (
            ($pre + 2 == $a[$i] || $pre - 2 == $a[$i])
            && ($pre + 1 == $a[$i - 1] || $pre - 1 == $a[$i - 1])
        ) { // found a range
            while ($i + 1 < $cnt && ($a[$i - 1] + 2 == $a[$i + 1] || $a[$i - 1] - 2 == $a[$i + 1])) {
                $i++;
            }
            $ret[] = $pre . '-' . $a[$i];
            $i += 2;
        } else {
            $ret[] = $pre;
        }
    }
    // handle last two elements..
    for ($cnt += 2; $i < $cnt; $i++) {
        $ret[] = $a[$i - 2];
    }
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

