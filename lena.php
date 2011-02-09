<?

function group($numbers){
	$range = 0;
	$group = array();
	foreach($numbers as $i => $nr){
		if(!empty($numbers[$i+1]) && $nr+1==$numbers[$i+1]){
			$range++;
		} else if(!empty($numbers[$i+1]) && $nr-1==$numbers[$i+1]){
			$range--;
		} else {
			if($range==0){
				$group[] = $nr;
			}else {
				$group[] = $nr-$range."-".$nr;
			}
			$range=0;
		}
	}
	return $group;
}

function ungroup($merged_numbers) {
	$ungrouped = array();
	foreach($merged_numbers as $nr){
		$range = explode('-',$nr);
		$ungrouped = array_merge($ungrouped, range($range["0"], end($range)));
	}
	return $ungrouped;
}