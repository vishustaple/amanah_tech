<?php 
function strStartsWith($subject, $test)
{
	$subject = strtolower($subject);
	$test = strtolower($test);
	
	return (substr($subject,0,strlen($test))==$test ? "true" : "false");
}