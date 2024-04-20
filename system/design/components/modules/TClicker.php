<?php

class TClicker extends __TNoVisual
{
	public $class_name_ex = __CLASS__;
	
	public function Click($x, $y)
	{
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
	}
	
	public function LClick($x, $y)
	{
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
	}
	
	public function RClick($x, $y)
	{
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_RIGHTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_RIGHTUP, $x, $y, 0, 0);
	}
	
	public function MClick($x, $y)
	{
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_MIDDLEDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_MIDDLEUP, $x, $y, 0, 0);
	}
	
	public function DClick($x, $y)
	{
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
	}
	
	public function LDClick($x, $y)
	{
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
	}
	
	public function RDClick($x, $y)
	{
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_RIGHTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_RIGHTUP, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_RIGHTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_RIGHTUP, $x, $y, 0, 0);
	}
	
	public function MDClick($x, $y)
	{
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_MIDDLEDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_MIDDLEUP, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_MIDDLEDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_MIDDLEUP, $x, $y, 0, 0);
	}
	
	public function VClick($x, $y)
	{
		$xc = cursor_pos_x();
		$yc = cursor_pos_y();
		
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
		SetCursorPos($xc, $yc);
		
	}
	
	public function VLClick($x, $y)
	{
		$xc = cursor_pos_x();
		$yc = cursor_pos_y();
		
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
		SetCursorPos($xc, $yc);
		
	}
	
	public function VRClick($x, $y)
	{
		$xc = cursor_pos_x();
		$yc = cursor_pos_y();
		
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_RIGHTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_RIGHTUP, $x, $y, 0, 0);
		SetCursorPos($xc, $yc);
		
	}
	
	public function VMClick($x, $y)
	{
		$xc = cursor_pos_x();
		$yc = cursor_pos_y();
		
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_MIDDLEDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_MIDDLEUP, $x, $y, 0, 0);
		SetCursorPos($xc, $yc);
		
	}
	
	public function VDClick($x, $y)
	{
		$xc = cursor_pos_x();
		$yc = cursor_pos_y();
		
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
		SetCursorPos($xc, $yc);
		
	}
	
	public function VDLClick($x, $y)
	{
		$xc = cursor_pos_x();
		$yc = cursor_pos_y();
		
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
		SetCursorPos($xc, $yc);
		
	}
	
	public function VDRClick($x, $y)
	{
		$xc = cursor_pos_x();
		$yc = cursor_pos_y();
		
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_RIGHTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_RIGHTUP, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_RIGHTDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_RIGHTUP, $x, $y, 0, 0);
		SetCursorPos($xc, $yc);
	}
	
	public function VDMClick($x, $y)
	{
		$xc = cursor_pos_x();
		$yc = cursor_pos_y();
		
		SetCursorPos($x, $y);
		Mouse_Event(MOUSEEVENTF_MIDDLEDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_MIDDLEUP, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_MIDDLEDOWN, $x, $y, 0, 0);
		Mouse_Event(MOUSEEVENTF_MIDDLEUP, $x, $y, 0, 0);
		SetCursorPos($xc, $yc);
	}
	
	
	
	public function Set($x, $y)
	{
		SetCursorPos($x, $y);
	}
	
	public function Get($i)
	{
		$arr = array(
			"x" => cursor_pos_x(),
			"y" => cursor_pos_y()
		);
		
		if ($i == "xy")
		{
			return $arr;
		}
		elseif ($i == "x")
		{
			return $arr['x'];
		}
		elseif ($i == "y")
		{
			return $arr['y'];
		}
	}
	
	public function Loop($x, $y, $l)
	{
		$l = $l + 1;
		
		for ($i = 1; $i < $l; $i++)
		{
			SetCursorPos($x, $y);
			Mouse_Event(MOUSEEVENTF_LEFTDOWN, $x, $y, 0, 0);
			Mouse_Event(MOUSEEVENTF_LEFTUP, $x, $y, 0, 0);
		}
	}
	
	public function Caret()
	{
		
		$Form                        = new TForm;
		$Form->name                  = "Caret";
		$Form->caption               = "Caret :: TClicker 1.5   ";
		$Form->windowState           = wsMaximized;
		$Form->Color                 = 0x00804000;
		$Form->transparentColor      = true;
		$Form->transparentColorValue = 0x00804000;
		$Form->show();
		$Form->borderStyle = bsSizeable;
		
		$Add          = new TSpeedButton;
		$Add->parent  = $Form;
		$Add->caption = "Add Point";
		$Add->x       = 0;
		$Add->y       = 0;
		$Add->w       = 72;
		$Add->h       = 30;
		
		$Point          = new TSpeedButton;
		$Point->parent  = $Form;
		$Point->caption = "Points";
		$Point->x       = 72;
		$Point->y       = 0;
		$Point->w       = 72;
		$Point->h       = 30;
		
		$Ch1          = new TCheckBox;
		$Ch1->parent  = $Form;
		$Ch1->x       = 152;
		$Ch1->y       = 4;
		$Ch1->w       = 80;
		$Ch1->h       = 24;
		$Ch1->text    = "Show Points";
		$Ch1->checked = True;
		
		$Ch2          = new TCheckBox;
		$Ch2->Parent  = $Form;
		$Ch2->x       = 240;
		$Ch2->y       = 4;
		$Ch2->w       = 94;
		$Ch2->h       = 24;
		$Ch2->text    = "Show Numbers";
		$Ch2->checked = True;
		
		$Info              = new TLabel;
		$Info->parent      = $Form;
		$Info->x           = 344;
		$Info->y           = 7;
		$Info->w           = 116;
		$Info->h           = 16;
		$Info->caption     = "Point : | X : | Y : ";
		$Info->Font->Name  = "Segoe UI";
		$Info->Font->Style = "fsBold";
		$Info->Font->Size  = 10;
		
		$Shape         = new TShape;
		$Shape->parent = $Form;
		$Shape->align  = alTop;
		$Shape->h      = 30;
		$Shape->toBack();
		
		$Del           = new TShape;
		$Del->parent   = $Form;
		$Del->w        = 56;
		$Del->h        = 30;
		$Del->x        = $Form->w - 72;
		$Del->y        = 0;
		$Del->anchors  = 'akTop,akLeft';
		$Del->penStyle = psDot;
		$Del->visible  = false;
		
		$Lab          = new TLabel;
		$Lab->parent  = $Form;
		$Lab->x       = $Del->x + 14;
		$Lab->y       = 3;
		$Lab->w       = 40;
		$Lab->h       = 28;
		$Lab->caption = "Delete\r\n Point";
		
		
		$Pos              = new TLabel;
		$Pos->parent      = $Form;
		$Pos->w           = 163;
		$Pos->h           = 25;
		$Pos->Font->Name  = "Segoe UI";
		$Pos->Font->Style = "fsLight";
		$Pos->Font->Size  = 14;
		$Pos->caption     = "X - 0 | Y - 0";
		$Pos->alignment   = taCenter;
		
		$Ret          = new TSpeedButton;
		$Ret->parent  = $Form;
		$Ret->x       = $Form->w - 100;
		$Ret->y       = 30;
		$Ret->w       = 100;
		$Ret->h       = 30;
		$Ret->Caption = "Exit";
		
		$Ret->onClick = function ($self) use ($Form)
		{
			global $__nv, $Caret;
			$Caret = $__nv;
			
			$Form->free();
		};
		
		// * Main FX Core * //
		
		if (!function_exists('Del'))
		{
			function Del($obj)
			{
				$obj->free();
			}
		}
		
		$T = new TTimer;
		$T->interval = 1;
		$T->enabled  = true;
		$T->repeat   = true;
		
		$T->OnTimer = function ($self) use ($Pos, $Ch1, $Ch2, $Del, $Lab)
		{
			$Lab->visible = $Del->visible;
			$x            = cursor_pos_x();
			$y            = cursor_pos_y();
			
			$Pos->caption = "X - $x | Y - $y";
			$Pos->x       = $x - 80;
			$Pos->y       = $y;
			
			global $__cv;
			$c = $__cv + 1;
			
			for ($i = 1; $i < $c; $i++)
			{
				if (!c("point$i") instanceof DebugClass)
					c("point$i")->visible = $Ch1->checked;
				
				if (!c("number$i") instanceof DebugClass)
					c("number$i")->visible = $Ch2->checked;
				
			}
		};

		$Add->onClick = function ($self) use ($Form, $Info, $Del, $Pos)
		{
			global $__cv, $__nv;
			$__cv++;
			
			$move = new TTimer;
			$shap = new TShape;
			$time = new TTimer;
			$prog = new TProgressBar;
			$labe = new TLabel;
			$numb = new TLabel;
			
			$time->enabled  = true;
			$time->interval = 200;
			$time->repeat   = true;
			
			$move->enabled  = false;
			$move->interval = 1;
			$move->repeat   = true;
			
			$shap->PenColor = clRed;
			$shap->PenWidth = 2;
			$shap->name     = "point" . $__cv;
			$shap->x        = $Form->w / 2 + 5;
			$shap->y        = $Form->h / 2 + 5;
			$shap->w        = 10;
			$shap->h        = 10;
			$shap->parent   = $Form;
			$shap->point    = $__cv;
			
			
			$sx                 = $shap->x + 5;
			$sy                 = $shap->y + 27;
			$__nv["point$__cv"] = "X : $sx | Y : $sy";
			
			$labe->caption  = "X - $sx | Y - $sy";
			$labe->parent   = $Form;
			$labe->autoSize = false;
			$labe->visible  = false;
			$labe->x        = $shap->x - 34;
			$labe->y        = $shap->y - 20;
			$labe->w        = 260;
			
			$numb->caption  = $__cv;
			$numb->parent   = $Form;
			$numb->autoSize = true;
			$numb->name     = "number" . $__cv;
			//$numb->visible = false;
			$numb->x        = $shap->x - 18;
			$numb->y        = $shap->y - 2;
			
			$time->onTimer = function ($self) use ($shap, $prog)
			{
				$prog->position++;
				
				if ($prog->position == 1)
				{
					$shap->PenColor = clRed;
				}
				
				elseif ($prog->position == 2)
				{
					$shap->PenColor = clBlue;
					$prog->position = 0;
				}
			};
			
			
			$move->onTimer = function ($self) use ($shap, $labe, $numb, $Info, $time, $Del)
			{
				global $__nv, $__cv;
				
				$p                 = $shap->point;
				$sx                = $shap->x + 5;
				$sy                = $shap->y + 27;
				$Info->caption     = "Point : $p | X : $sx | Y : $sy";
				$__nv[$shap->name] = "X : $sx | Y : $sy";
				$labe->caption     = "X - $sx | Y - $sy";
				$labe->x           = $shap->x - 34;
				$labe->y           = $shap->y - 20;
				
				$numb->x = $shap->x - 18;
				$numb->y = $shap->y - 2;
				
				global $sx, $sy, $fx, $fy;
				$shap->x = $fx - ($sx - cursor_pos_x());
				$shap->y = $fy - ($sy - cursor_pos_y());
				
				if ($shap->point == $__cv)
				{
					
					if ($shap->x + 5 > $Del->x && $shap->x + 5 < $Del->x + $Del->w && $shap->y + 5 > $Del->y && $shap->y + 5 < $Del->y + $Del->h)
					{
						$shap->penColor   = clRed;
						$shap->brushColor = clRed;
						$time->enabled    = false;
					}
					else
					{
						$time->enabled    = true;
						$shap->brushColor = clWhite;
					}
				}
				else
				{
					$Del->visible = false;
				}
			};
			
			$shap->onMouseDown = function ($self) use ($move, $labe, $Del, $Pos)
			{
				global $sx, $sy, $fx, $fy, $__cv;
				
				$self = _c($self);
				$sx            = cursor_pos_x();
				$sy            = cursor_pos_y();
				$fx            = $self->x;
				$fy            = $self->y;
				$move->enabled = true;
				$Pos->visible  = false;
				$labe->visible = true;
				
				if ($self->point == $__cv)
				{
					$Del->visible = true;
				}
				else
				{
					$Del->visible = false;
				}
				
			};
			
			$shap->OnMouseUp =  function ($self) use ($move, $labe, $numb, $time, $prog, $shap, $Info, $Form, $Del, $Pos)
			{
				global $__cv;
				
				$move->enabled = false;
				$Pos->visible  = true;
				$labe->visible = false;
				$Info->caption = "Point : | X : | Y : ";
				$self = _c($self);
				
				$numb->x = $self->x - 18;
				$numb->y = $self->y - 2;
				
				if ($self->x > $Form->w)
				{
					$self->x = $Form->w - 27;
				}
				
				if ($self->y > $Form->h)
				{
					$self->y = $Form->h - 48;
				}
				if ($self->x < 0)
				{
					$self->x = 0;
				}
				if ($self->y < 0)
				{
					$self->y = 0;
				}

				if ($self->point == $__cv)
				{
					$Del->visible = true;
					
					if ($self->x + 5 > $Del->x && $self->x + 5 < $Del->x + $Del->w && $self->y + 5 > $Del->y && $self->y + 5 < $Del->y + $Del->h)
					{
						$move->free();
						$time->free();
						$prog->free();
						$labe->free();
						$numb->free();
						
						global $__cv, $__nv;
						$__cv--;
						unset($__nv[$self->name]);
						
						Del($self);
					}
				}
				else
				{
					$Del->visible = false;
				}
				
				$Del->visible = false;
			};
			
		};

		$Point->onClick = function ($self)
		{
			global $__nv;
			$points = array();
			foreach ($__nv as $p)
				$points[] = $p;
			
			pre($points);
		};
	}	
}

?>