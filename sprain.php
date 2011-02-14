<?php

function compStuff($numbers){

	$start = $end = NULL;
	$numOld = NULL;
	$newNumbers = array();

	foreach($numbers as $num){	
	
		if(abs($num-$numOld) == 1){
			$end = $num;
			$numOld = $num;
			continue;
		}//if
		
		if($end != NULL){
			$newNumbers[count($newNumbers)-1] = $start."-".$end;
		}//if		
		
		$newNumbers[] = $num;
		$start  = $numOld = $num;
		$end = NULL;

	}//foreach
	
	return $newNumbers;
	
}//function



function decompStuff($compressedNumbers){

	$newNumbers = array();

	foreach($compressedNumbers as $compressedNumber){
		if(is_int($compressedNumber)){
			$newNumbers[] = $compressedNumber;
		}else{
			$parts = explode("-", $compressedNumber);
			if($parts[0] < $parts[1]){
				for($i=$parts[0]; $i<=$parts[1]; $i++){
					$newNumbers[] = $i;
				}
			}else{
				for($i=$parts[0]; $i>=$parts[1]; $i--){
					$newNumbers[] = $i;
				}
			}
		}//if
	}//foreach

	return $newNumbers;		

}//function

