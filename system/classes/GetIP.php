<?php

function getIP ()
{ 
	return file_get_contents('http://api.ipify.org/'); 
}

?>