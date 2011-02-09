<?php

function a2a($arr) {
    if (!is_array($arr)) return $arr;
    $l = count($arr);
    $neu = array();
    $i = 0;
    if (strstr(implode('', $arr), '-')) {
        while ($i < $l) {
            $d = explode('-', $arr[$i]);
            switch (count($d)) {
                case 1:
                    array_push($neu, $arr[$i]);
                    break;
                case 2:
                    if ($d[0] > $d[1]) for ($c = $d[0]; !($c < $d[1]); $c--) array_push($neu, $c);
                    else for ($c = $d[0]; !($c > $d[1]); $c++) array_push($neu, $c);
                    break;
            }
            $i++;
        }
    } else {
        while ($i < $l) {
            if ($arr[$i] == $arr[$i + 1] + 1) {
                $d = $arr[$i];
                while ($arr[$i] == $arr[$i + 1] + 1) $i++;
                array_push($neu, sprintf('"%d-%d"', $d, $arr[$i++]));
            } elseif ($arr[$i] == $arr[$i + 1] - 1) {
                $d = $arr[$i];
                while ($arr[$i] == $arr[$i + 1] - 1) $i++;
                array_push($neu, sprintf('"%d-%d"', $d, $arr[$i++]));
            } else array_push($neu, $arr[$i++]);
        }
    }
    return $neu;
}