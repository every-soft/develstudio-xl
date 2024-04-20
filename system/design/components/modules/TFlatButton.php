<?php

class TFlatButton extends TLabel 
{
	public $class_name_ex = __CLASS__;
	#fMouseUp; fMouseDown; fMouseUp; fMouseLeave - для кастомных событий.
	
	/*
		__CLASS__ используем для совместимости.
		Если переименовать класс, то компонент всё равно будет работать.
		
		(__CLASS__ хранит в себе имя текущего класса).
	*/
	
	public function set_onMouseDown ($v)
	{
		event_set ($this->self, 'onMouseDown', __CLASS__ . '::onMouseDown');
		$this->fMouseDown = $v;
	}

	public function set_onMouseUp ($v)
	{
		event_set($this->self, 'onMouseUp', __CLASS__ . '::onMouseUp');
		$this->fMouseUp = $v;
	}
	
	public function set_onMouseEnter ($v)
	{
		event_set ($this->self, 'onMouseEnter', __CLASS__ . '::onMouseEnter');
		$this->fMouseEnter = $v;
	}

	public function set_onMouseLeave ($v)
	{
		event_set($this->self, 'onMouseLeave', __CLASS__ . '::onMouseLeave');
		$this->fMouseLeave = $v;
	}

	public function __initComponentInfo()
	{
		parent::__initComponentInfo();
		
		// при запуске проекта сохраняем события заданные пользователем в свойства.
		$this->fMouseDown = event_get($this->self, 'onMouseDown');
		$this->fMouseUp = event_get($this->self, 'onMouseUp');
		$this->fMouseLeave = event_get($this->self, 'onMouseLeave');
		$this->fMouseEnter = event_get($this->self, 'onMouseEnter');
		
		// задаём новые события для изменения цвета кнопки при нажатии и отжатии.
		event_set($this->self, 'onMouseDown', __CLASS__ . '::onMouseDown');
		event_set($this->self, 'onMouseUp', __CLASS__ . '::onMouseUp');
		event_set($this->self, 'onMouseLeave', __CLASS__ . '::onMouseLeave');
		event_set($this->self, 'onMouseEnter', __CLASS__ . '::onMouseEnter');

		$this->unpressedColor = $this->enteredColor;
		$this->unenteredColor = $this->color;
	}
	
	public function __construct($owner = nil, $init = true, $self = nil)
	{
		parent::__construct($owner, $init, $self);
		
		if ($init)
		{
			$this->caption = 'FlatButton';
			$this->font->color = clWhite;
			$this->font->name = 'Segoe UI';
			$this->font->size = 10;
			$this->color = 0x7A5F43;
			$this->pressedColor = 0x644E37;
			$this->enteredColor = 0xAB8865;
			$this->transparent = false;
			$this->alignment = taCenter;
			$this->layout = tlCenter;
			$this->cursor = crHandPoint; // doesn't work... why?

			// fix bug
			if (!$GLOBALS['APP_DESIGN_MODE'])
			{
				$this->__initComponentInfo();
			}
		}
	}
	
	public static function onMouseDown($self, $button, $shift, $x, $y)
	{
		$self = _c($self);

		if ($button === 0)
		{
			$self->color = $self->pressedColor;
		}

		if ($self->fMouseDown)
			call_user_func_array($self->fMouseDown, func_get_args());
	}
	
	public static function onMouseUp($self, $button, $shift, $x, $y)
	{
		$self = _c($self);
		if ($button === 0)
		{
			$self->color = $self->unpressedColor;
		}

		if ($self->fMouseUp)
			call_user_func_array($self->fMouseUp, func_get_args());
	}
	
	public static function onMouseLeave($self)
	{
		$self = _c($self);

		$self->color = $self->unenteredColor;

		if ($self->fMouseLeave)
			call_user_func_array($self->fMouseLeave, func_get_args());
	}
	
	public static function onMouseEnter($self)
	{
		$self = _c($self);
		
		if ($self->enabled)
			$self->color = $self->enteredColor;

		if ($self->fMouseEnter)
			call_user_func_array($self->fMouseEnter, func_get_args());
	}
}

?>