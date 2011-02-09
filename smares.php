<?php

function uncompress($numbers) {
    $uncompressed = array();

    foreach ($numbers as $number) {
        if (!is_string($number)) {
            $uncompressed[] = $number;
            continue;
        }
        $range = explode('-', $number);
        $uncompressed = array_merge($uncompressed, range($range[0], $range[1]));
    }

    return $uncompressed;
}