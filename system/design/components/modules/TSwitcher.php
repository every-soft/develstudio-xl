<?php

/**
 * TSwitcher 3.0
 * 
 * @package TSwitcher
 * @version 3.0
 * @authors Стасевич Иван <https://vk.com/magic.breeze> и Подвирный Никита <https://vk.com/technomindlp>
 * 
 * Специально для Every Software и Enfesto Studio Group
 * 
 * @link https://vk.com/evsoft
 * @link https://vk.com/hphp_convertation
 */

class TSwitcher extends TShape
{
	public $class_name_ex = __CLASS__;
	public $switcher;

	public static $switchers = array ();

	public function __construct ($owner = nil, $init = true, $self = nil)
	{
		parent::__construct ($owner, $init, $self);

		if ($init)
		{
			$this->brushColor 	 = 16777215;
			$this->penColor 	 = 15329769;
			$this->enabledColor  = 7457838;
			$this->disabledColor = 3951847;
		}
	}

	public function set_onMouseUp ($v)
	{
		event_set($this->self, 'onMouseUp', __CLASS__ . '::onMouseUp');

		$this->fMouseUp = $v;
	}
	
	public function set_onMouseDown ($v)
	{
		event_set($this->self, 'onMouseDown', __CLASS__ . '::onMouseDown');

		$this->fMouseDown = $v;
	}
	
	public function set_onMouseMove ($v)
	{
		event_set($this->self, 'onMouseMove', __CLASS__ . '::onMouseMove');

		$this->fMouseMove = $v;
	}
	
	public function set_onMouseEnter ($v)
	{
		event_set($this->self, 'onMouseEnter', __CLASS__ . '::onMouseEnter');

		$this->fMouseEnter = $v;
	}
	
	public function set_onMouseLeave ($v)
	{
		event_set($this->self, 'onMouseLeave', __CLASS__ . '::onMouseLeave');

		$this->fMouseLeave = $v;
	}
	
	public function __initComponentInfo ()
	{
		parent::__initComponentInfo();
		
		$this->fMouseUp = event_get($this->self, 'onMouseUp');
		$this->fMouseDown = event_get($this->self, 'onMouseDown');
		$this->fMouseMove = event_get($this->self, 'onMouseMove');
		$this->fMouseLeave = event_get($this->self, 'onMouseLeave');
		$this->fMouseEnter = event_get($this->self, 'onMouseEnter');
		
		event_set($this->self, 'onMouseUp', __CLASS__ . '::onMouseUp');
		event_set($this->self, 'onMouseDown', __CLASS__ . '::onMouseDown');
		event_set($this->self, 'onMouseMove', __CLASS__ . '::onMouseMove');
		event_set($this->self, 'onMouseLeave', __CLASS__ . '::onMouseLeave');
		event_set($this->self, 'onMouseEnter', __CLASS__ . '::onMouseEnter');
		
		$shape = new TShape ($this->parent);
		$shape->parent = $this->parent;

		$shape->x = $this->x;
		$shape->y = $this->y;
		$shape->w = (int)($this->w / 2);
		$shape->h = $this->h;

		$shape->brushColor = $this->disabledColor;
		$shape->penColor   = 15329769;

		event_set ($shape->self, 'onMouseUp', __CLASS__  . '::onMouseUp');
		event_set ($shape->self, 'onMouseDown', __CLASS__  . '::onMouseDown');
		event_set ($shape->self, 'onMouseMove', __CLASS__  . '::onMouseMove');
		event_set ($shape->self, 'onMouseEnter', __CLASS__  . '::onMouseEnter');
		event_set ($shape->self, 'onMouseLeave', __CLASS__  . '::onMouseLeave');

		if ($this->switched)
		{
			$shape->x = $this->x + $this->w - $shape->w;
			$shape->brushColor = $this->enabledColor;
		}

		$this->switcher = $shape;
		
		self::$switchers[$shape->self] = &$this;
		self::$switchers[$this->self]  = &$this;

		setTimer (20, '

			$switcher = TSwitcher::$switchers['. $this->self .'];

			$switcher->switcher->y = $switcher->y;
			$switcher->switcher->w = (int)($switcher->w / 2);
			$switcher->switcher->h = $switcher->h;

			if ($switcher->smoothness)
				$switcher->switcher->x += ceil (($switcher->switched ?
						$switcher->x + $switcher->w - $switcher->switcher->w - $switcher->switcher->x :
						$switcher->x - $switcher->switcher->x) / 2);

			else $switcher->switcher->x = $switcher->switched ?
					$switcher->x + $switcher->w - $switcher->switcher->w :
					$switcher->x;

		');

		$shape->visible = $this->visible;
		$shape->enabled = $this->enabled;
		$shape->hint = $this->hint;
		$shape->showHint = $this->showHint;
		
		$shape->cursor = $this->cursor;
	}

	public static function onMouseUp ($self, $button, $shift, $x, $y)
	{
		$switcher = self::$switchers[$self];
		
		if ($button === 0)
		{
			$switcher->switcher->brushColor = $switcher->switched ?
				$switcher->disabledColor : $switcher->enabledColor;

			$switcher->switched = !$switcher->switched;
		}
		
		if ($switcher->fMouseUp)
			call_user_func_array($switcher->fMouseUp, array($switcher->self, $button, $shift, $x, $y));
	}
	
	public static function onMouseDown ($self, $button, $shift, $x, $y)
	{
		$switcher = self::$switchers[$self];
		
		if ($switcher->fMouseDown)
			call_user_func_array($switcher->fMouseDown, array($switcher->self, $button, $shift, $x, $y));
	}
	
	public static function onMouseMove ($self, $shift, $x, $y)
	{
		$switcher = self::$switchers[$self];

		if ($switcher->fMouseMove)
			call_user_func_array($switcher->fMouseMove, array($switcher->self, $shift, $x, $y));
	}
	
	public static function onMouseEnter ($self)
	{
		$switcher = self::$switchers[$self];

		if ($switcher->fMouseEnter)
			call_user_func_array($switcher->fMouseEnter, array($switcher->self));
	}
	
	public static function onMouseLeave ($self)
	{
		$switcher = self::$switchers[$self];

		if ($switcher->fMouseLeave)
			call_user_func_array($switcher->fMouseLeave, array($switcher->self));
	}
}

class_alias ('TSwitcher', 'ozSwitch');
