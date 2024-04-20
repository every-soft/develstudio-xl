<?php

function inputBox ($message, $caption, $text = '')
{
	static $VBScript;
	
	if(empty ($VBScript)) 
	{
		$VBScript = new COM ('MSScriptControl.ScriptControl');
		$VBScript->Language = 'VBScript';
	}
	
	return $VBScript->eval(" InputBox(\"$message\",\"$caption\",\"$text\") ");
}

?>