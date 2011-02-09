<?php

function convert_numbers($array, $type = "compress") {
    if (is_array($array)) {
        reset($array);
        if ($type == "compress") {
            $old_key = false;
            $mode = false;
            $new_array = array();
            $i = -1;
            while (list($key, $value) = each($array)) {
                if ($old_key == false) {
                    $old_key = $value;
                    $i++;
                    $new_array[$i] = $value;
                } elseif ($old_key != false) {
                    if (($old_key + 1) == $value) {
                        if ($mode == false) {
                            $mode = "+";
                            $old_key = $value;
                        } elseif ($mode == "-") {
                            $mode = false;
                            $old_key = false;
                            $new_array[$i] .= "-" . $value;
                        } else {
                            $old_key = $value;
                        }
                    } elseif (($old_key - 1) == $value) {
                        if ($mode == false) {
                            $mode = "-";
                            $old_key = $value;
                        } elseif ($mode == "+") {
                            $mode = false;
                            $old_key = false;
                            $new_array[$i] .= "-" . $value;
                        } else {
                            $old_key = $value;
                        }
                    } else {
                        if ($mode != false) {
                            $new_array[$i] .= "-" . $old_key;
                            $i++;
                            $new_array[$i] = $value;
                            $old_key = $value;
                            $mode = false;
                        } else {
                            $i++;
                            $new_array[$i] = $value;
                            $old_key = $value;
                            $mode = false;
                        }
                    }
                }
            }
            return $new_array;
        } elseif ($type == "decompress") {
            while (list($key, $value) = each($array)) {
                $value_array = explode("-", $value);
                if (count($value_array) == 2) {
                    if ($value_array[0] > $value_array[1]) {
                        $written_value = $value_array[0];
                        do {
                            $new_array[] = (int) $written_value;
                            $written_value--;
                        } while ($value_array[1] <= $written_value);
                    } elseif ($value_array[0] < $value_array[1]) {
                        $written_value = $value_array[0];
                        do {
                            $new_array[] = (int) $written_value;
                            $written_value++;
                        } while ($value_array[1] >= $written_value);
                    }
                } else {
                    $new_array[] = $value;
                }
            }
            return $new_array;
        }
    }
}