<?php

function makeArrayShort($numbers) {
	$lastNumber = false;
	$currentNumber = false;
	$currentContigiousNumbersEnd = false;
	$currentContigiousNumbersStart = false;

	foreach ($numbers as $currentNumber) {
		//ist dies nicht der erste Durchlauf?
		if ($lastNumber) {
			//ist dies eine Reihe?
			if ($lastNumber - $currentNumber == 1 || $currentNumber - $lastNumber == 1) {
				//gibt es schon eine Folge?
				if(!$currentContigiousNumbersStart) {
					//wenn nein, starte eine neue...
					$currentContigiousNumbersStart = $lastNumber;
					//und lösche letzten Eintrag im Result
					$key= array_search($lastNumber, $result);
					unset($result[$key]);
				}
				$currentContigiousNumbersEnd = $currentNumber;
			} else {
				//keine weitere Zahl zur aktuellen Folge --> alte Folge speichern, wenn sie denn existiert
				if($currentContigiousNumbersEnd) $result[] = $currentContigiousNumbersStart . ' - ' . $currentContigiousNumbersEnd;
				$result[] = $currentNumber;
				//alte Folge resetten
				$currentContigiousNumbersEnd = false;
				$currentContigiousNumbersStart = false;
			}
		} else {
			//das erste Mal muss die Zahl natürlich auch hinzu
			$result[] = $currentNumber;
		}
		$lastNumber = $currentNumber;
	}
	return $result;
}
function makeArrayLong($numbers) {
	foreach ($numbers as $currentNumber) {
		if(is_int($currentNumber)) {
			$result[] = $currentNumber;
		} elseif (is_string($currentNumber)) {
			$split = strpos($currentNumber,'-');
			$start = substr($currentNumber, 0, $split-1);
			$end = substr($currentNumber, $split+2);
			if($end < $start) {
				for($start; $start > $end; $start--) {
					$result[] = $start;
				}
			} else {
				for($start; $start < $end; $start++) {
					$result[] = $start;
				}
			}
			$result[] = $end;
		}
	}
	return $result;
}
