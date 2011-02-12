<?php

function oliver2_convert_long($a)
{
	$r = array();
	foreach($a AS $o)
	{
		if(is_int($o)) $r[] = $o;
		else
		{
			$ra = explode('-', $o);
			$t = range($ra['0'], $ra['1']);
			foreach ($t AS $s) $r[] = $s;
		}
	}
	return $r;
}

function oliver2_convert_short($a)
{
	$i=$j=$k=1;
	$r[]=$a[0];
	do {
		while(isset($a[$i])&&$a[$i-1]+1==$a[$i]) ++$i;
		while(isset($a[$i])&&$a[$i-1]-1==$a[$i]) ++$i;
		if($k!=$i) $r[$j-1].='-'.$a[$i-1];
		if(isset($a[$i])) $r[$j++]=$a[$i++]; else return $r;
	} while($k=$i);
}