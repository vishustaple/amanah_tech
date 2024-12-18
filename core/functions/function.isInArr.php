<?php 
function isInArr($val,$search,$strict=false)
{
	if(is_array($search))
	{
		foreach($search as $compare)
		{
			if(((is_string($compare) ? trim(strtolower($compare)) : $compare)==(is_string($val) ? trim(strtolower($val)) : $val) && $strict==false) || ($compare===$val && $strict==true))
			{
				return true;
			}
		}
	}
	else
	{
		if(((is_string($search) ? trim(strtolower($search)) : $search)==(is_string($val) ? trim(strtolower($val)) : $val) && $strict==false) || ($search===$val && $strict==true))
		{
			return true;
		}
	}
	return false;
}