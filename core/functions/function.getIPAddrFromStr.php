<?php
/*
Name: getIPAddrFromStr
Parameters: $str Input string
Returns: Found IP address as string
Description: Returns the first IP address found in the message. Searches for IPv4 and IPv6
*/
function getIPAddrFromStr($str){
	$foundIP="";
	
	//Split string by line then whitespace
	$lineArr = explode("\n",$str);
	foreach($lineArr as $line)
	{
		//Split by whitespace and slashes
		$spaceArr = preg_split('/[\/\\\s]+/',$line);
		
		//Go through each one and see if it is an IP
		foreach($spaceArr as $word){
			if(filter_var($word, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6)){
				$foundIP=$word;
				break;
			}
		}
	}
	return $foundIP;
}