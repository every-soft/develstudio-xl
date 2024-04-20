<?

class ev_fmAbout_logo
{
	static function onClick ($self)
	{
		Run(dirname(EXE_NAME) . '/README.txt', false);
	}
}

class ev_fmAbout_author
{
    static function onClick ($self)
	{
        run(_c($self)->hint);
    }

	static function onMouseEnter ($self)
	{
		$self = _c($self);
		
		$self->font->color = clRed;
		$self->font->style = fsUnderline;
	}
	
	static function onMouseLeave ($self)
	{
		$self = _c($self);
		
		$self->font->color = 0x795A00;
		$self->font->style = '';
	}
}

class ev_fmAbout_link1
{
    static function onClick ($self)
	{
        run(_c($self)->hint);
    }

	static function onMouseEnter ($self)
	{
		$self = _c($self);
		
		$self->font->color = clRed;
		$self->font->style = fsUnderline;
	}
	
	static function onMouseLeave ($self)
	{
		$self = _c($self);
		
		$self->font->color = 0x886809;
		$self->font->style = '';
	}
}