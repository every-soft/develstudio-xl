<?php

function checkInternet () 
{
	$host = 'api.ipify.org';
	$obj = new COM ('winmgmts://localhost/root/CIMV2');

	foreach ($obj->ExecQuery ('SELECT * FROM Win32_PingStatus WHERE Address = "' . $host . '"') as $ping)
		return $ping->statusCode === 0;
}

?>