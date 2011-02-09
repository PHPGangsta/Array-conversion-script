<?php
function compress_numbers(array $numbers) {
    $new = array();
    $type = $cur = null;
    foreach ($numbers as $number) {
        if (!$cur) {
            array_push($new, $number);
        } elseif (!$type) {
            if ($cur + 1 == $number || $cur - 1 == $number) {
                $type = (($cur + 1 == $number) ? '+' : '-');
                array_pop($new);
                array_push($new, $cur . '-' . $number);
            } else {
                array_push($new, $number);
            }
        } elseif (('+' == $type && $cur + 1 == $number) || ('-' == $type && $cur - 1 == $number)) {
            $tmp = array_pop($new);
            array_push($new, substr($tmp, 0, strpos($tmp, '-')) . '-' . $number);
        } else {
            $type = null;
            array_push($new, $number);
        }
        $cur = $number;
    }
    return $new;
}

function decompress_numbers(array $numbers) {
    $new = array();
    foreach ($numbers as $number) {
        if (is_numeric($number)) {
            array_push($new, $number);
        } else {
            $tmp = explode('-', $number);
            if ($tmp[0] < $tmp[1]) $tmp = array_keys(array_fill($tmp[0], $tmp[1] - $tmp[0] + 1, null));
            else $tmp = array_reverse(array_keys(array_fill($tmp[1], $tmp[0] - $tmp[1] + 1, null)));
            foreach ($tmp as $n) array_push($new, $n);
        }
    }
    return $new;
}