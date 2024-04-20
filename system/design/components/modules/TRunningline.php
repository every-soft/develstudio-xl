<?php

class TRunningline extends TLabel 
{
    public $class_name_ex = __CLASS__;

	public function setIntervalTime($self, $interval)
	{
		gui_propSet($self, 'interval', (int) $interval);
	}

	public function setEnabledTime($self, $value)
	{
		gui_propSet($self, 'enabled', $value);
	}
		
	public function getEnabledTime($self)
	{
		return gui_propGet($self, 'enabled');
	}

	public function clearTimer($self)
	{
		if (gui_is($self, 'TTimer'))
		{
			gui_propSet($self, 'enabled', false);
			event_set($self, 'OnTimer', null);
			gui_threadFree($self);
		}
	}
	
	public function CreateTTimer($func, $interval, $Enabled = true, $p = false, $param = array()) 
	{
		$TTimerNew = gui_create('TTimer', null);
		gui_propSet($TTimerNew, 'interval', (int)$interval);
		
		if(!$p)
			event_set($TTimerNew, 'OnTimer', $func);
		else 
			event_set($TTimerNew, 'OnTimer', function($self) use ($func, $param)
			{
				call_user_func_array($func, array_merge(array($self), $param));
				unset($func, $param);
			});
		
		gui_propSet($TTimerNew, 'enabled', $Enabled);
		unset($func, $interval, $Enabled, $p, $param);
		return $TTimerNew;
	}

  
    public function __construct($owner = nil, $init = true, $self = nil)
	{
        parent::__construct($owner, $init, $self);
        
        if ($init)
		{
			$this->running_line = true;
			$this->Left_running_line = true;
			$this->IntervalTimer  = 100;
			
			if (!$GLOBALS['APP_DESIGN_MODE'])
			{
				$this->__initComponentInfo();
			}
        }
    }

    public function __initComponentInfo()
	{
        parent::__initComponentInfo();
		
		$this->CreateTTimer(__CLASS__ . '::running_line', $this->IntervalTimer, true, true, array($this));
    }

	public static function running_line($self, $obj) 
	{
		if($obj->running_line) 
		{
			if($obj->Left_running_line) 
			{
				if($Text = $obj->caption) 
				{
					$Text .= $Text[0];
					$obj->caption = substr($Text, 1);
				}
			} else {
				if($Text = $obj->caption) 
				{
					$Text = $Text[strlen($Text)-1].$Text;
					$obj->caption = substr($Text, 0, -1);
				}
			}
			
			unset($Text);
		}
	}
}

?>