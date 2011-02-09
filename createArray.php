<?php
$array = array();
for ($i=1; $i<10000; $i++) {
    $random = rand(1,1000000);
    if ($i % 10 == rand(1, 10)) {
        $anzahl = rand(3, 40);
        if ($random % 2 == 0) {
            if ($random-$anzahl > 0) {
                $new = range($random, $random-$anzahl);
                $array = array_merge($array, $new);
            }
        } else {
            $new = range($random, $random+$anzahl);
            $array = array_merge($array, $new);
        }
    } else {
        $array[] = $random;
    }
}
$array = array_unique($array);

echo '$numbers = array(';
echo join(', ', $array);
echo ');';