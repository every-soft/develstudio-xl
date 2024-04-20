<?php

class TWebCamera extends TPanel 
{
	public $class_name_ex = __CLASS__;
    
    public function __construct ($owner = nil, $init = true, $self = nil)
	{
        parent::__construct($owner, $init, $self);  
		
		if($init) 
		{
			$this->bevelOuter = bsNone;
		}
    }
	
	public function getDevices()
	{
		return function_exists('GetDeviceName') ? explode("\n", GetDeviceName()) : MessageBox('Ошибка! Подкючите модуль php_MWeb_Cam.dll', '', MB_ICONERROR + MB_OK);
	}
	
	public function start ($device) 
	{
		if (function_exists('InitializeCam')) 
		{
			InitializeCam($this->handle, (array_search($device, $this->getDevices()) + 1));
		} else
		{
			MessageBox('Ошибка! Подкючите модуль php_MWeb_Cam.dll', '', MB_ICONERROR + MB_OK);
		}
	}
	
	public function capture ($savePath, $x = 0, $y = 0, $w = 0, $h = 0, $taskBar = false, $bitSize = 32, $handle = 0) 
	{
		if (!function_exists('ScrWindows'))
			return MessageBox('Ошибка! Подключите модуль "php_Scren.dll" в настройке проекта!', '', MB_ICONERROR);
		
		if (!$handle)
			$handle = $this->handle;
		
		return ScrWindows($savePath, $x, $y, $w, $h, $taskBar, $bitSize, $handle);
	}
	
}

?>