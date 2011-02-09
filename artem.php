<?
function reduce($numbers) {
	$return = array();
	while(false !== ($start = $startCopy = current($numbers))) {		
		while(1 === abs($start-next($numbers))){
			$start = current($numbers);
		}
		$return[] = implode(array_unique(array($startCopy, $start)),'-');
	}
	return $return;
}

function enlarge($numbers) {
	$return = array();
	foreach($numbers as $number) {
		$number.='-'.$number;
		list($start, $end) = explode('-',$number);
		array_walk(range($start,$end), function($value) use(&$return){
			$return[] = $value;
		});
	}
	return $return;
}