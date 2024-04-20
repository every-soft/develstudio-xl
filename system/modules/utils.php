<?php

function gui_form ($obj)
{
	while (is_object ($obj))
		$obj = $obj->parent;
	
	return $obj;
}

function cst ($val)
{
	if (func_num_args() > 1)
	{
		$val = print_r (func_get_args (), true);
	}
	else
	{
		if (is_array ($val)) 
			$val = print_r ($val, true);
	}
	
	clipboard_setText ($val);
}

function returnFile ()
{
	static $dlg;
	
	if (!isset ($dlg))
	{
		$dlg = new TOpenDialog;
		$dlg->options = 'ofFileMustExist,ofNoValidate,ofPathMustExist';
	}

	return $dlg->execute () ? $dlg->fileName : false;
}

function returnFiles ()
{
	static $dlg;
	
	if (!isset ($dlg))
	{
		$dlg = new TOpenDialog;
		$dlg->options = 'ofFileMustExist,ofNoValidate,ofPathMustExist,ofAllowMultiSelect';
	}

	return $dlg->execute () ? $dlg->files : false;
}

?>