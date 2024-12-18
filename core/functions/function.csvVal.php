<?php
function csvVal($subject, $count, $del=',', $row=0)
{
	$exp = explode("\n",$subject);
	
	if(isset($exp[$row]))
	{
		$ret = explode($del,$exp[$row]);
		
		$ret[$count]=stripslashes($ret[$count]);
		$ret[$count]=str_replace('"','',$ret[$count]);
		
		return (isset($ret[$count]) ? $ret[$count] : false);
	}
	else
	{
		return false;
	}
} 
