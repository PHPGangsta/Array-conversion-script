<?php

function getShortArray($numArr) {
	$step = 0;
	$return = array();
	$max = count($numArr);
	$tempStr = '';
	$numArr[] = NULL;
	for($key = 0; $key < $max; $key++) {
		$value = $numArr[$key];
		$tempStr .= $value.'|';
		$nextValue = $numArr[++$key];
		$key--;
		if($step == 0) {
			if(++$value == $nextValue) {
				$step = 1;
			} elseif(($value - 2) == $nextValue) {
				$step = -1;
			} else {
				$return[] = --$value;
				$tempStr = '';
			}
		} else {
			if(($value + $step) != $nextValue) {
				$step = 0;
				$tempStr = explode('|', trim($tempStr, '|'));
				$return[] = reset($tempStr).'-'.end($tempStr);
				$tempStr = '';
			}
		}
	}
	return $return;
}

// ================
// Funktion fürs Auseinandernehmen
function getLongArray($numarr) {
	$return = array();
	foreach($numarr AS $single) {
		$step = 0;
		$tmp = '';
		if(!is_int($single)) {
			$tmp = explode('-', $single);
			if($tmp[0] > $tmp[1]) {
				$step = -1;
			} else {
				$step = 1;
			}
			$tmp[1] += $step;
			for($i = (int) $tmp[0]; $i != $tmp[1]; $i += $step) {
				$return[] = $i;
			}
		} else {
			$return[] = $single;
		}
	}
	return $return;
}