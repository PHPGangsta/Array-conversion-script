<?php
function convert($a)
{
	$a = ','.join(',',$a).',';
	if(strpos($a, '-') !== false)
	{
		$a = preg_replace_callback('|(\d+)-(\d+)|', create_function('$r', 'return join(",", range($r[1], $r[2]));'), $a);
	}
	else
	{
		for($i=0;$i<2;$i++) $a = preg_replace_callback('|(\d+),(\d+)|', create_function('$r', 'return ($r[1]==$r[2]+1||$r[1]==$r[2]-1) ? $r[1]."_".$r[2]:$r[1].",".$r[2];'), ','.($a{1}==1?9:0).$a);
		$a = substr(str_replace("_","-",preg_replace("/,(\d+)_(\w+)_(\d+),/", ",\\1-\\3,", preg_replace("/,(\d+)_(\w+)_(\d+),/", ",\\1-\\3,", $a))), 4);
	}
	return array_map(create_function('$v', 'return strpos($v, "-") !== false ? $v : intval($v);'), explode(",", substr($a, 1, -1)));
}