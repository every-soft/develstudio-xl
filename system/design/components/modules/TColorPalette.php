<?php

class TColorPalette extends TScrollBox
{
	public $class_name_ex = __CLASS__;
	
	# public $selColor;
	
	public function __construct($owner = nil, $init = true, $self = nil)
	{
		parent::__construct($owner, $init, $self);
		
		if ($init)
		{
			$this->__initComponentInfo();
			
			$this->bevelInner = bsNone;
			$this->autoSize   = true;
			
			$this->selColor = 0x3674FF;
		}
	}
	
	public function __initComponentInfo()
	{
		// fix bug
		if (!$GLOBALS['APP_DESIGN_MODE'])
		{
			$this->visible = $this->avisible;
			$this->enabled = $this->aenabled;
		}
		
		$thi =& $this;
		$this->w              = 270;
		$this->h              = 123;
		$this->borderStyle    = bsNone;
		$this->autoScroll     = false;
		$this->autoSize       = false;
		$this->doubleBuffered = true;

		$BG           = new TShape();
		$BG->parent   = $this;
		$BG->w        = 270;
		$BG->h        = 123;
		$BG->penColor = clWhite;
		
		$M            = new TTImer();
		$M->enabled   = false;
		$M->repeat    = true;
		$M->interval  = 30;
		
		$S            = new TTImer();
		$S->enabled   = false;
		$S->repeat    = true;
		$S->interval  = 1;
		
		$P            = new TShape();
		$I            = new TImage();

		$color['Main'] = array (
			0x00000094,
			0x000000B5,
			0x000000D5,
			0x000034F7,
			0x001A55FF,
			0x003674FF,
			0x0000007E,
			0x0000219D,
			0x00173EBB,
			0x002F5ADA,
			0x004774F9,
			0x006090FF
		);
		
		$color['bar'] = Array(
			0x00303030,
			0x00777777,
			0x00DD003F,
			0x00FF2590,
			0x00C23EFF,
			0x006B0BFE,
			0x004435C0,
			0x00031CFE,
			0x000036F7,
			0x00056CFD,
			0x0007ABFE,
			0x001EC9FF,
			0x0000A25D,
			0x0000A730,
			0x0062AB00,
			0x00A9A800,
			0x00F09B00,
			0x00FE6A00
		);
		
		$color['M'][1]  = Array(
			0x00353325,
			0x004B493B,
			0x00636152,
			0x007D7B6B,
			0x00969484,
			0x00B1AF9F,
			0x00303030,
			0x00464646,
			0x005E5E5E,
			0x00777777,
			0x00919191,
			0x00ACACAC
		);
		$color['M'][2]  = Array(
			0x00303030,
			0x00464646,
			0x005E5E5E,
			0x00777777,
			0x00919191,
			0x00ACACAC,
			0x00303030,
			0x00464646,
			0x005E5E5E,
			0x00777777,
			0x00919191,
			0x00ACACAC
		);
		$color['M'][3]  = Array(
			0x00A3002E,
			0x00B41746,
			0x00CE2F60,
			0x00E44277,
			0x00FB568E,
			0x00FF6AA4,
			0x00791B39,
			0x00892A4B,
			0x00A13F61,
			0x00B65176,
			0x00CC648B,
			0x00E177A0
		);
		$color['M'][4]  = Array(
			0x009D0058,
			0x00B30068,
			0x00D50094,
			0x00ED28A5,
			0x00FF46C0,
			0x00FF64DF,
			0x0077004D,
			0x00920069,
			0x00AD1B84,
			0x00C93BA1,
			0x00E556BD,
			0x00FF72DB
		);
		$color['M'][5]  = Array(
			0x004200AD,
			0x005900CD,
			0x007200EE,
			0x008B27FF,
			0x00A552FF,
			0x00C072FF,
			0x00430091,
			0x005A20AF,
			0x007342CE,
			0x008C5EEB,
			0x00A77AFF,
			0x00C196FF
		);
		$color['M'][6]  = Array(
			0x007100BB,
			0x008B00DA,
			0x00A500F9,
			0x00C13AFF,
			0x00DC5FFF,
			0x00F981FF,
			0x00510086,
			0x006900A2,
			0x008328C0,
			0x009C48DD,
			0x00B866FC,
			0x00D382FF
		);
		$color['M'][7]  = Array(
			0x0016007D,
			0x0019009E,
			0x002100BE,
			0x002400E0,
			0x002A00FF,
			0x004341FF,
			0x00210065,
			0x002A0083,
			0x00380DA1,
			0x004234C1,
			0x004F4FDE,
			0x00696DFF
		);
		$color['M'][8]  = Array(
			0x0003007C,
			0x0000009C,
			0x000000BC,
			0x000000DE,
			0x000017FF,
			0x002046FF,
			0x00000062,
			clMaroon,
			0x00081D9E,
			0x00203CBD,
			0x003757DB,
			0x004F73FB
		);
		$color['M'][9]  = Array(
			0x00000094,
			0x000000B5,
			0x000000D5,
			0x000034F7,
			0x001A55FF,
			0x003674FF,
			0x0000007E,
			0x0000219D,
			0x00173EBB,
			0x002F5ADA,
			0x004774F9,
			0x006090FF
		);
		$color['M'][10] = Array(
			0x000012A2,
			0x000036C2,
			0x000052E2,
			0x00006BFF,
			0x002B89FF,
			0x0048A6FF,
			0x00001973,
			0x0000338F,
			0x00104CAD,
			0x002A65CB,
			0x00407DE6,
			0x005B9AFF
		);
		$color['M'][11] = Array(
			0x00004080,
			0x0000599E,
			0x000071BC,
			0x00008BDB,
			0x0000AAFF,
			0x002CC1FF,
			0x00002F5D,
			0x00004578,
			0x00005E95,
			0x000A76B1,
			0x002C90CF,
			0x0047AAED
		);
		$color['M'][12] = Array(
			0x00004873,
			0x00006091,
			0x000079AE,
			0x000093CC,
			0x0000ADEA,
			0x001AC9FF,
			0x00003554,
			0x00004B6F,
			0x0000638B,
			0x00007BA7,
			0x002496C4,
			0x0040B0E1
		);
		$color['M'][13] = Array(
			0x00004900,
			0x00006105,
			0x00007B31,
			0x0000944F,
			0x0000B06D,
			0x0000CB8A,
			0x0000451B,
			0x00005C36,
			0x00007650,
			0x00008F6A,
			0x0029AA85,
			0x0045C5A0
		);
		$color['M'][14] = Array(
			0x00004C00,
			0x00006400,
			0x00007F00,
			0x00009916,
			0x0000B543,
			0x0000D163,
			0x00004800,
			0x00005F1C,
			0x0000793A,
			0x00079355,
			0x002DAE70,
			0x0049C98B
		);
		$color['M'][15] = Array(
			0x00224D00,
			0x00376700,
			0x004F8200,
			0x00549D00,
			0x0057BA00,
			0x005BD500,
			0x002B4900,
			0x00416200,
			0x00597C00,
			0x00659610,
			0x0071B23E,
			0x007DCC58
		);
		$color['M'][16] = Array(
			0x00514C00,
			0x00696500,
			0x00827F00,
			0x009C9A00,
			0x00B7B600,
			0x00D2D100,
			0x00494800,
			0x00616000,
			0x007A7A00,
			0x0093930A,
			0x00AEAF3B,
			0x00C9CA5A
		);
		$color['M'][17] = Array(
			0x008F4500,
			0x00A95C00,
			0x00C67500,
			0x00E18E00,
			0x00FFAB00,
			0x00FFC341,
			0x00754200,
			0x008E5900,
			0x00AA7219,
			0x00C48B3F,
			0x00E3A761,
			0x00FDC07B
		);
		$color['M'][18] = Array(
			0x00A12300,
			0x00BE3700,
			0x00DA4D00,
			0x00F86400,
			0x00FF7C3B,
			0x00FF9664,
			0x007A2200,
			0x00953800,
			0x00B04E26,
			0x00CC6649,
			0x00E87E66,
			0x00FF9884
		);

		for ($i = 1; $i < 7; $i++) // y = 0
		{
			$c[$i]           = new TShape();
			$c[$i]->parent   = $this;
			$c[$i]->x        = $x[1];
			$c[$i]->w        = 45;
			$c[$i]->y        = 0;
			$c[$i]->h        = 45;
			$c[$i]->penColor = $c[$i]->brushColor = $color['Main'][$i - 1];
			
			$c[$i]->onMouseEnter = function($self)
			{
				$self = _c($self);
				
				$self->penColor = clBlack;
				$self->penWidth = 2;
			};
			
			$c[$i]->onMouseLeave = function($self)
			{
				$self = _c($self);
				
				$self->penColor = $self->BrushColor;
				$self->penWidth = 2;
			};
			
			$c[$i]->onMouseDown = function($self) use ($thi, $I)
			{
				$self = _c($self);
				
				$thi->selColor = $self->brushColor;
				$I->x       = $self->x;
				$I->y       = $self->y;
			};
			
			$x[1] += 45;
		}
		
		for ($i = 7; $i < 13; $i++) // y = 45
		{
			$c[$i]           = new TShape;
			$c[$i]->parent   = $this;
			$c[$i]->x        = $x[2];
			$c[$i]->w        = 45;
			$c[$i]->y        = 45;
			$c[$i]->h        = 45;
			$c[$i]->penColor = $c[$i]->brushColor = $color['Main'][$i - 1];
			
			$c[$i]->onMouseEnter = function($self)
			{
				$self = c($self);
				
				$self->penColor = clBlack;
				$self->penWidth = 2;
			};
			
			$c[$i]->onMouseLeave = function($self)
			{
				$self = c($self);
				
				$self->penColor = $self->brushColor;
				$self->penWidth = 2;
			};
			
			$c[$i]->onMouseDown = function($self) use ($thi, $I)
			{
				$self = c($self);
				
				$thi->selColor = $self->brushColor;
				$I->x       = $self->x;
				$I->y       = $self->y;
			};
			
			$x[2] += 45;
		}
		
		$I->parent = $this;
		$I->x      = 225;
		$I->y      = 0;
		$I->w      = 45;
		$I->h      = 45;
		
		$Image     = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAC0AAAAtCAYAAAA6GuKaAAAACXBIWXMAAAsTAAALEwEAmpwYAAABNmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarY6xSsNQFEDPi6LiUCsEcXB4kygotupgxqQtRRCs1SHJ1qShSmkSXl7VfoSjWwcXd7/AyVFwUPwC/0Bx6uAQIYODCJ7p3MPlcsGo2HWnYZRhEGvVbjrS9Xw5+8QMUwDQCbPUbrUOAOIkjvjB5ysC4HnTrjsN/sZ8mCoNTIDtbpSFICpA/0KnGsQYMIN+qkHcAaY6addAPAClXu4vQCnI/Q0oKdfzQXwAZs/1fDDmADPIfQUwdXSpAWpJOlJnvVMtq5ZlSbubBJE8HmU6GmRyPw4TlSaqo6MukP8HwGK+2G46cq1qWXvr/DOu58vc3o8QgFh6LFpBOFTn3yqMnd/n4sZ4GQ5vYXpStN0ruNmAheuirVahvAX34y/Axk/96FpPYgAAACBjSFJNAAB6JQAAgIMAAPn/AACA6AAAUggAARVYAAA6lwAAF2/XWh+QAAACsklEQVR42uzXPWsUQRgH8P/MOtldb7I3l+Qih6kECwVNwCIBY2fhS2FhF18wpPEL+AnsBJsoQjBg6wcIiIoYQfBEEQQrRSwk2bvzLs7txvN2dmfHwjNEQdQml+A89cD+Ztjn+c8QYwx2WlHswNqR6F1b+bFqtQrXdZGmKTzPg+/7AIA0TSGlBCFkYy0hBL7vjxeLxYt5ntfr9fo1SikmJye3Fv0vZYzxPc+bFkKczPO8mSTJmyiKHgDItiU6z3MEQXB8dHT0ghDigNZapWk6G0XR8rZAG2PAGEOlUvneZJRCKXU0CII5zvlE71ehAIjpjbp+oTkAA+ArgPyXTewTQswEQXCMMeYaY3Ip5ZNarXYTQNoXtDFmeHBw8LTrur4x5nGWZW97DUgAlBljc5zzM67rDgGAlPJZGIY3kiRZ7sv0AEA55zOVSuUyIcRdW1srJkmyAKANoEQpnS2VSuc9z9sLAFEUvW42m/NKqaXNk2VL0YQQTwhxgnN+kBCCLMvOpmn6USlVJYRMCSHmfN8fI4Sg0+l8CMNwYX19fYkxprMs6xuadDqdV0qpI67r7gmC4JDWeq7dbk8UCoXxYrG4HwCUUlGtVrsdx/Fdx3E6fQ0XAF0p5TxjbHe5XL40MDAwJISYLhQKhx3H4b2gSVZWVq63Wq07WZZ93nzC/UJrSumnOI5vMcb48PDwOcdxCo7jlHvg7urq6qJSaoFSWt8WMb7RjZS+b7fbi5TSsZGRkVM98Hqr1XrUaDSuZlnWIIT8FOt9RSuloJSC1vpFmqbzjLGAcz4lpXwahuEVrXXzd9i+nvSP5Ot2u88bjcZCHMcvpZT3ALwjhOBPd/wtRTuO89MtzhjzJYqi+1LKh1rr+l9PIftysWiLtmiLtmiLtmiLtmiLtmiLtmiLtmiLtuj/D/1tAGQFL9gFgYwLAAAAAElFTkSuQmCC');
		$I->picture->loadFromStr ($Image, 'png');
		$I->enabled = false;

		for ($i = 1; $i < 19; $i++)
		{
			$p[$i]           = new TShape();
			$p[$i]->parent   = $this;
			$p[$i]->x        = $x[3];
			$p[$i]->w        = 15;
			$p[$i]->y        = 92;
			$p[$i]->h        = 20;
			$p[$i]->penColor = $p[$i]->brushColor = $color['bar'][$i - 1];
			
			$p[$i]->onMouseDown = function($self) use ($P, $S, $i)
			{
				global $Index;
				$self = c($self);
				$S->enabled = true;
				
				$Index         = $i;
				$P->x          = $self->x - 2;
				$P->brushColor = $self->brushColor;
			};
			
			$p[$i]->onMouseUp = function($self) use ($S)
			{
				$S->enabled = false;
			};
			
			$x[3] += 15;
		}

		$P->parent     = $this;
		$P->x          = 118;
		$P->w          = 17;
		$P->y          = 90;
		$P->h          = 32;
		$P->penColor   = clWhite;
		$P->penWidth   = 2;
		$P->brushColor = 0x000036F7;
		$P->toFront();
		
		$P->onMouseDown = function($self) use ($M)
		{
			global $sx, $fx;
			$self = c($self);
			
			$sx         = cursor_pos_x();
			$fx         = $self->x;
			$M->enabled = true;
		};

		$P->onMouseUp = function($self) use ($M, $S)
		{
			global $px;
			$self = c($self);
			
			$self->x = $px;
			$M->enabled = false;
			$S->enabled = false;
		};
		
		
		$M->onTimer = function($self) use ($P, $c, $p, $S)
		{
			global $sx, $fx, $px, $Index;
			$S->enabled = true;
			$P->x = $fx - ($sx - cursor_pos_x());
			
			$x = $P->x + $P->w / 2;
			
			for ($i = 1; $i < 19; $i++)
			{
				if ($x > $p[$i]->x && $x < $p[$i]->x + 15)
				{
					$px            = $p[$i]->x - 2;
					$P->brushColor = $p[$i]->brushColor;
					$Index         = $i;
				}
			}
		};
		
		$S->onTimer = function($self) use ($c, $color)
		{
			global $Index;
			
			for ($i = 1; $i < 13; $i++)
			{
				$c[$i]->brushColor = $c[$i]->penColor = $color['M'][$Index][$i - 1];
			}
		};
	}
}

?>