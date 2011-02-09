<?php

function shrink(&$numbers) {
    $len = count($numbers) - 1;
    for ($i = 0; $i < $len; $i++)
    {
        if (abs($numbers[$i] - $numbers[$i + 1]) == 1) {
            $j = $i + 1;
            while (abs($numbers[$j] - $numbers[$j + 1]) == 1)
                $j++;
            $count = abs($numbers[$i] - $numbers[$j]);
            array_splice($numbers, $i, $j - $i + 1, $numbers[$i] . "-" . $numbers[$j]);
            $len -= $count;
        }
    }
}

function enhance(&$numbers) {
    $len = count($numbers);
    for ($i = 0; $i < $len; $i++)
    {
        $range = explode("-", $numbers[$i]);
        if (count($range) > 1) {
            array_splice($numbers, $i, 1, range($range[0], $range[1]));
            $count = abs($range[0] - $range[1]);
            $len += $count;
            $i += $count;
        }
    }
}
