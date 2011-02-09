<?php

function compress_array(array $array_of_numbers)
{
	$new_array_of_numbers = array();
	
	for($i = 0; $i < count($array_of_numbers); $i++)
	{
		$current_number = $array_of_numbers[$i];
		
		$next_number = isset($array_of_numbers[$i + 1]) ? $array_of_numbers[$i + 1] : null;
		$previous_number = isset($array_of_numbers[$i - 1]) ? $array_of_numbers[$i - 1] : null;
		$next_number_has_distance_of_1 = abs($current_number - $next_number) === 1;
		$previous_number_has_distance_of_1 = abs($current_number - $previous_number) === 1;
		
		if ($previous_number === null || !$next_number_has_distance_of_1 && !$previous_number_has_distance_of_1 || $next_number_has_distance_of_1 && !$previous_number_has_distance_of_1)
		{
			$new_array_of_numbers[] = $current_number;
		}
		else if (!$next_number_has_distance_of_1 && $previous_number_has_distance_of_1)
		{
			$index = count($new_array_of_numbers) - 1; 
			$from = isset($new_array_of_numbers[$index]) ? $new_array_of_numbers[$index] : $current_number;
			$to = $current_number;
			$new_array_of_numbers[$index] = $from . '-' . $to;
		}
	}
	
	return $new_array_of_numbers;
}

function uncompress_array(array $compressed_array)
{
	$array_of_numbers = array();
	
	foreach($compressed_array as $item)
	{
		if (strpos($item, '-') !== false){
			list($from, $to) = explode('-', $item);
			$array_of_numbers = array_merge($array_of_numbers, range($from, $to));
		}
		else
		{
			$array_of_numbers[] = $item;
		}
	}
	
	return $array_of_numbers;	
}