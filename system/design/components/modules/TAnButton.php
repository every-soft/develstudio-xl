<?php

class TAnButton extends TLabel
{
	public $class_name_ex = __CLASS__;
	
	function __initComponentInfo()
	{
		parent::__initComponentInfo();
		
		$this->fMouseEnter = event_get($this->self, 'onMouseEnter');
		event_set($this->self, 'onMouseEnter', 'TAnButton::doMouseEnter');
		
		$this->fMouseLeave = event_get($this->self, 'onMouseLeave');
		event_set($this->self, 'onMouseLeave', 'TAnButton::doMouseLeave');
		
		$this->fMouseUp = event_get($this->self, 'onMouseUp');
		event_set($this->self, 'onMouseUp', 'TAnButton::doMouseUp');
		
		$this->fMouseDown = event_get($this->self, 'onMouseDown');
		event_set($this->self, 'onMouseDown', 'TAnButton::doMouseDown');

	}
	
	public function __construct($owner = nil, $init = true, $self = nil)
	{
		parent::__construct($owner, $init, $self);
		
		if ($init)
		{
			$obj              = $this;
			$obj->i           = 0;
			$obj->FourColor   = 11184810;
			$obj->ThreeColor  = 8026746;
			$obj->TwoColor    = 3552822;
			$obj->OneColor    = 8026746;
			$obj->Color       = $obj->FourColor;
			$obj->transparent = false;
			
			if (!$GLOBALS['APP_DESIGN_MODE'])
			{
				$this->__initComponentInfo();
			}
		}
	}
	
	function set_onMouseEnter($v)
	{
		event_set($this->self, 'onMouseEnter', 'TAnButton::doMouseEnter');
		$this->fMouseEnter = $v;
	}
	
	function set_onMouseLeave($v)
	{
		event_set($this->self, 'onMouseLeave', 'TAnButton::doMouseLeave');
		$this->fMouseLeave = $v;
	}
	
	function set_onMouseUp($v)
	{
		event_set($this->self, 'onMouseUp', 'TAnButton::doMouseUp');
		$this->fMouseUp = $v;
	}
	
	function set_onMouseDown($v)
	{
		event_set($this->self, 'onMouseDown', 'TAnButton::doMouseDown');
		$this->fMouseDown = $v;
	}
	
	static function doMouseEnter($self)
	{
		$obj        = c($self);
		$obj->i     = 0;
		$obj->Color = $obj->ThreeColor;
		if ($obj->fMouseEnter)
		{
			call_user_func($obj->fMouseEnter, func_get_args());
		}
	}
	static function doMouseLeave($self)
	{
		$obj        = c($self);
		$obj->i     = 1;
		$obj->Color = $obj->FourColor;
		if ($obj->fMouseLeave)
		{
			call_user_func($obj->fMouseLeave, func_get_args());
		}
	}
	static function doMouseDown($self, $button, $shift, $x, $y)
	{
		$obj        = c($self);
		$obj->Color = $obj->TwoColor;
		if ($obj->fMouseDown)
		{
			call_user_func_array($obj->fMouseDown, func_get_args());
		}
	}
	static function doMouseUp($self, $button, $shift, $x, $y)
	{
		$obj        = c($self);
		$obj->Color = $obj->OneColor;
		if ($obj->fMouseUp)
		{
			call_user_func_array($obj->fMouseUp, func_get_args());
		}
	}
}

?>