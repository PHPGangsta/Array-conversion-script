<?php

function convertToShort($data) {
	$ret = array();
	$start = $end = array();
	$arrayCount = 0;
	$start[$arrayCount] = $lastNumber = $data[0];


	for($i=1;$i<count($data);$i++) {
		if(abs($data[$i]-$lastNumber) != 1) {
			$end[$arrayCount] = $lastNumber;
			$arrayCount++;
			$start[$arrayCount] = $data[$i];
		} else {
			$end[$arrayCount] = $data[$i];
		}

		$lastNumber = $data[$i];
	}


	for($i = 0; $i < count($start); $i++) {
		$ret[] = (!isset($end[$i]) || $start[$i] == $end[$i])?$start[$i]:sprintf("%d-%d", $start[$i], $end[$i]);
	}

	return $ret;
}

function convertToLong($data) {
	$ret = array();

	for($i=0; $i<count($data); $i++) {
		if(strstr($data[$i], "-")) {
			$tmp = explode("-", $data[$i]);
			$z = ($tmp[0] > $tmp[1])?-1:1;
			for($t=$tmp[0]; $t!=$tmp[1]+$z; $t = $t + $z) {
				$ret[] = (int)$t;
			}
		} else {
			$ret[] = $data[$i];
		}
	}

	return $ret;
}
