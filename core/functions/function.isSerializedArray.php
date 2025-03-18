<?php
function isSerializedArray($data)
{
	if(is_array(@unserialize($data)) == true)
	{
		return true;
	}
	return false;
}