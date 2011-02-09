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
	$r = array();
	$t = $l = false;
	foreach($a AS $o)
	{
		if(($l+1==$o || $l-1==$o) && $l!==false) $t = $o;
		else if($t!==false)
		{
			$r[count($r)-1] .= '-'.$l;
			$t = false;
			$r[] = $o;
		}
		else $r[] = $o;
		$l = $o;
	}
	if($t!==false) $r[count($r)-1] .= '-'.$o;
	return $r;
}