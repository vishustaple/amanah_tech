<?php

function randString($length=15,$charset='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
{
	$result='';
	$pool=str_split($charset);
	for($i=0;$i<$length;$i++)
	{
		$result .= $pool[(rand()%sizeof($pool))];
	}
	return $result;
}