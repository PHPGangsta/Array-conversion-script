<?
function en(array $a)
{
    $b = array($a[0]);

    for ($i = 1, $l = count($a); $i < $l; $i++) {
        $j = count($b) - 1;
        $x = explode('-', $b[$j]);

        if ((reset($x) >= end($x) && $a[$i] == end($x) - 1) || (reset($x) <= end($x) && $a[$i] == end($x) + 1)) {
            $b[$j] = reset($x) . '-' . $a[$i];
        } else {
            $b[] = $a[$i];
        }
    }

    return $b;
}

function de(array $a)
{
    $b = array();

    foreach ($a as $i) {
        $x = explode('-', $i);
        $b = array_merge($b, range(reset($x), end($x)));
    }

    return $b;
}
