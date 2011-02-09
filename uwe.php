<?

function array_convert($array) {
    if (!is_array($array)) {
        return false;
    }
    $c_array = implode(",", $array);
    $new_array = array();
    if (strpos($c_array, '-') !== false) {
        foreach ($array as $row) {
            if (strpos($row, '-') !== false) {
                $value = explode("-", $row);
                $tmp_array = range($value[0], $value[1]);
                $new_array = array_merge($new_array, $tmp_array);
            } else {
                $new_array[] = (int) $row;
            }
        }
    } else {
        $start_row = $last_row = NULL;
        $mode = $last_mode = NULL;
        for ($x = 0, $n = count($array); $x < $n; $x++) {
            $row = $array[$x];
            if ($last_row !== NULL && ($last_row - $row) == 1) {
                $mode = 'down';
                if ($start_row === NULL) {
                    $start_row = $last_row;
                }
            } elseif ($last_row !== NULL && ($row - $last_row) == 1) {
                $mode = 'up';
                if ($start_row === NULL) {
                    $start_row = $last_row;
                }
            } else {
                $mode = NULL;
            }
            if ($start_row !== NULL && $last_mode !== NULL && $mode !== $last_mode) {
                $new_array[] = $start_row . '-' . $last_row;
                $start_row = NULL;
            } elseif ($mode === NULL && $last_row !== NULL && $last_row !== $row) {
                $new_array[] = $last_row;
            }
            if ($x === $n - 1) {
                if (!is_null($start_row)) {
                    $new_array[] = $start_row . '-' . $row;
                } else {
                    $new_array[] = $row;
                }
            }
            $last_mode = $mode;
            $last_row = $row;
        }
    }
    return $new_array;
}