<?php
//Get the files in this directory
$list = array();

$hnd = opendir(dirname(__FILE__) . '/class/' );

while ($file = readdir($hnd)) 
{
  if ($file != ".." && $file != ".") 
  {
	$list[] = $file;
  }
}
closedir($hnd);

//Open all valid ones
foreach($list as $file)
{
	if(substr(trim($file),0,6)=="class." && substr(trim($file),-4,4) == ".php")
	{
		require_once(dirname(__FILE__) . '/class/' . $file);
	}
}
?>