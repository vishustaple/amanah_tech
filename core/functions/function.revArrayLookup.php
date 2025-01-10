<?php
function revArrayLookup($array,$pVal){
	foreach($array as $key=>$val){
		if($val==$pVal){
			return $key;
		}
	}
} 
