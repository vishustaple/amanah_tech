<?php
function isSerialized($data)
{
	if(@unserialize($data) !== false && $data != '')
	{
		return true;
	}
	return false;
}