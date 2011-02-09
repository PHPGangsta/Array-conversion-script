<?php

function mergeNumbers($numbers) {
    $newNumbers = array();

    reset($numbers);

    while (($currentNumber = current($numbers)) !== false) {
        $tmpCurrent = $currentNumber;
        while (($nextNumber = next($numbers)) !== false && abs($nextNumber - $tmpCurrent) == 1) {
            $tmpCurrent = $nextNumber;
        }

        if ($tmpCurrent == $currentNumber) {
            $newNumbers[] = $currentNumber;
        }
        else {
            $newNumbers[] = $currentNumber . '-' . $tmpCurrent;
        }
    }

    return $newNumbers;
}

function splitNumbers($numbers) {
    $newNumbers = array();

    foreach ($numbers as $number) {
        if (strpos($number, '-')) {
            $range = explode('-', $number, 2);
            array_splice($newNumbers, count($newNumbers), 0, range($range[0], $range[1]));
        }
        else {
            $newNumbers[] = $number;
        }
    }

    return $newNumbers;
}
