<?php

define('THB_BITMAP', 0x0001);
define('THB_ICON', 0x0002);
define('THB_TOOLTIP', 0x0004);
define('THB_FLAGS', 0x0008);
define('THBF_ENABLED', 0x0000);
define('THBF_DISABLED', 0x0001);
define('THBF_DISMISSONCLICK', 0x0002);
define('THBF_NOBACKGROUND', 0x0004);
define('THBF_HIDDEN', 0x0008);
define('THBF_NONINTERACTIVE', 0x10);
define('THBN_CLICKED', 0x1800);
define('TBPF_NOPROGRESS', 0); 
define('TBPF_INDETERMINATE', 0x1); 
define('TBPF_NORMAL', 0x2); 
define('TBPF_ERROR', 0x4); 
define('TBPF_PAUSED', 0x8); 
define('TBATF_USEMDITHUMBNAIL', 0x1); 
define('TBATF_USEMDILIVEPREVIEW', 0x2); 

class TWinTaskBarException extends Exception {

}


Class TThumbButton {
    public $dwMask  = null;	# DWORD
    public $iId     = null;	# UINT
    public $iBitmap = null;	# UINT
    public $Icon	= null;	# WCHAR
	public $szTip   = null;	# WCHAR = 260
    public $dwFlags = null;	# DWORD
}

class TThumbButtonArray {
	public $Value = array();
	
	public function add(TThumbButton $elm1,
						TThumbButton $elm2 = null, TThumbButton $elm3 = null,
						TThumbButton $elm4 = null, TThumbButton $elm5 = null,
						TThumbButton $elm6 = null, TThumbButton $elm7 = null) {
		if( count($this->Value) >= 7 ) {
			return false;
		}

		foreach (func_get_args() as $v) {
			if(count($this->Value) >= 7) break;
			
			$this->Value[] = $v;
		}
		return true;
	}
	
	public function Rem($idx) {
		if(array_key_exists($idx, $this->Value)) {
			unset($this->Value[$idx]);
			return false;
		}
		return false;
	}
	
	public function GetElm($idx) {
		if(array_key_exists($idx, $this->Value)) {
			return $this->Value[$idx];
		} else 
			return false;
	}
	
	public function ToArray() { 
		$ListBtn = array();
		$i = 0;
		foreach($this->Value as $v) {
			if($v->dwMask !== null)	 $ListBtn[$i]['dwmask']	 = $v->dwMask;
			if($v->iId !== null)	 $ListBtn[$i]['iid']	 = $v->iId;
			if($v->iBitmap !== null) $ListBtn[$i]['ibitmap'] = $v->iBitmap;
			if(is_file($v->Icon))	 $ListBtn[$i]['icon']	 = $v->Icon;
			if($v->szTip !== null)	 $ListBtn[$i]['sztip']	 = $v->szTip;
			if($v->dwFlags !== null) $ListBtn[$i]['dwflags'] = $v->dwFlags;
			$i++;
		}
		return $ListBtn;
	}
}



Class TWinTaskBar {
    public $Self = 0;
	public $ApplicationHandle;
	public $RPosition = 0;
	public $RMaxPosition = 100;
	public $RProgressState = TBPF_NORMAL;

    function __construct($ArrOpt = null, $ApplicationHandle = 0){
		$this->Self = TWinTaskbarCreate();
		
		if(!$this->TBInitialize()) {
			throw new TWinTaskBarException($this->LastError());
			return;
		}
		
		$this->ApplicationHandle = ($ApplicationHandle == 0) ? application_prop('handle', null) : $ApplicationHandle;
		$this->ProgressState = $this->RProgressState;
        $this->SetProgressValue($this->RPosition, $this->RMaxPosition);
		
		foreach((array)$ArrOpt as $i => $v) {
			$this->{$i} = $v;
		}
    }
	
	public function TBInitialize() {
		return ($this->Self <> 0) ? TBInitialize($this->Self) : false;
	}

	public function __set($name, $value) {
		switch(strtolower($name)) {
			case 'position':
				$this->SetProgressValue((int)trim($value), $this->RMaxPosition);
			break;
			case 'maxposition':
				$this->RMaxPosition = trim($value);
			break;
			case 'progressstate':
				$this->SetProgressState($value);
			break;
			case 'applicationhandle':
				$this->SetApplicationHandle = trim($value);
			break;
			case 'onwmcommand':
				$this->OnWMCommand($value);
			break;
			case 'progressstatetext':
				switch(strtolower(trim($value))) {
					case strtolower('TBPF_NOPROGRESS'):
						$this->progressstate = TBPF_NOPROGRESS;
					break;
					case strtolower('TBPF_INDETERMINATE'):
						$this->progressstate = TBPF_INDETERMINATE;
					break;
					case strtolower('TBPF_NORMAL'):
						$this->progressstate = TBPF_NORMAL;
					break;
					case strtolower('TBPF_ERROR'):
						$this->progressstate = TBPF_ERROR;
					break;
					case strtolower('TBPF_PAUSED'):
						$this->progressstate = TBPF_PAUSED;
					break;
				}
			break;
		}
	}
	
    public function __get($name) {
		switch(strtolower($name)) {
			case 'position':
				return $this->RPosition;
			break;
			case 'maxposition':
				return $this->RMaxPosition;
			break;
			case 'progressstate':
				return $this->RProgressState;
			break;
			case 'progressstatetext':
				switch($this->ProgressState) {
					case TBPF_NOPROGRESS:
						return 'TBPF_NOPROGRESS';
					break;
					case TBPF_INDETERMINATE:
						return 'TBPF_INDETERMINATE';
					break;
					case TBPF_NORMAL:
						return 'TBPF_NORMAL';
					break;
					case TBPF_ERROR:
						return 'TBPF_ERROR';
					break;
					case TBPF_PAUSED:
						return 'TBPF_PAUSED';
					break;
				}
			break;			
			case 'lasterror':
				return $this->LastError();
			break;
			case 'applicationhandle':
				return $this->MainWindow();
			break;
		}
	}
	
	function SetApplicationHandle($ApplicationHandle) {
		$this->ApplicationHandle = is_numeric($ApplicationHandle) ? $ApplicationHandle : 0;
		$Result = $this->TBInitialize() ? $this->MainWindow($this->ApplicationHandle) : false;
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
	}
	
	public function OnWMCommand($CallBackName) {
		$CallBackName = trim((string)$CallBackName);
		
		if(($CallBackName === null) or ($CallBackName == ''))
			return $this->OnWMCommandUnregister();
		elseif((!is_callable($CallBackName, true)) or (!function_exists($CallBackName))) {
			if(preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $CallBackName) !== 1)
				throw new TWinTaskBarException('Имя функции "'. $CallBackName .'" для "OnWMCommand" задано неверно');
			else 
				throw new TWinTaskBarException('Колбэк "'. $CallBackName .'" для "OnWMCommand" задано неверно');
			
			return false;
		}

		$Result = $this->TBInitialize() ? TBWMCommandApplication($this->Self, $CallBackName, $this) : false;
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
	}
	
	public function OnWMCommandUnregister() {
		return $this->TBInitialize() ? TBUnregisterWMCommandApplication($this->Self) : false;
	}
	
	
    public function ActivateTab($AHwnd) {
		$Result = $this->TBInitialize() ? TBActivateTab($this->Self, $AHwnd) : false;
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }
	
    public function AddTab($AHwnd) {
		$Result = $this->TBInitialize() ? TBAddTab($this->Self, $AHwnd) : false;
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }
    public function DeleteTab($AHwnd) {
		$Result = $this->TBInitialize() ? TBDeleteTab($this->Self, $AHwnd) : false;
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }
	
    public function SetActiveAlt($AHwnd) {
		$Result = $this->TBInitialize() ? TBSetActiveAlt($this->Self, $AHwnd) : false;
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }

    //ITaskBarList2
    public function MarkFullscreenWindow($AHwnd, $AFullscreen) {
		$Result = $this->TBInitialize() ? TBMarkFullscreenWindow($this->Self, $AFullscreen) : false;
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }

    //ITaskBarList3
    public function RegisterTab($ATabHandle) {
		$Result = $this->TBInitialize() ? TBRegisterTab($this->Self, $ATabHandle) : false; 
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }
	
    public function SetOverlayIcon($AIcon, $ADescription) {
		$Result =  $this->TBInitialize() ? TBSetOverlayIcon($this->Self, $AIcon, $this->MainWindow()) : false;
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }

    public function SetProgressState($AState) {
		if ($this->TBInitialize()) {
			if(!TBSetProgressState($this->Self, $this->MainWindow(), TBPF_NOPROGRESS)) {
				throw new TWinTaskBarException($this->LastError());
				return false;
			} else {
				if($AState == TBPF_NOPROGRESS) {
					$this->RProgressState = TBPF_NOPROGRESS;
					$this->RPosition = 0;
					return true;
				} else {
					if(!TBSetProgressState($this->Self, $this->MainWindow(), $AState)) {
						throw new TWinTaskBarException($this->LastError());
						return false;
					}
					$this->RProgressState = $AState;
					if($AState <> TBPF_INDETERMINATE) {
						if(!$this->SetProgressValue($this->RPosition, $this->RMaxPosition)) {
							throw new TWinTaskBarException($this->LastError());
						}
					} else
						$this->RPosition = 0;
					return true;
				}	
			}
		} else 
			return false;
    }
	
    public function SetProgressValue($ACompleted, $ATotal) {
		if ($this->TBInitialize()) {
			if($this->RMaxPosition < $ACompleted) {
				while(!($this->RMaxPosition == $ACompleted)) {
					--$ACompleted;
				}
			}
			
			if(($ACompleted < 0) and (($this->RPosition - $ACompleted) > 0)) {
				$ACompleted = 0;
			}
			
			$this->RPosition = $ACompleted;
			
			$Result =  TBSetProgressValue((int)$this->Self, (int)$this->MainWindow(), (int)$ACompleted, (int)$ATotal);	
			if(!$Result) {
				throw new TWinTaskBarException($this->LastError());
			} else {
				if(($this->RProgressState == TBPF_NOPROGRESS) or ($this->RProgressState == TBPF_INDETERMINATE))
					$this->RProgressState = TBPF_NORMAL;
			}
			return $Result;	
		} else 
			return false;

    }
	
    public function SetTabActive($AHwndTab) {
		$Result = $this->TBInitialize() ? TBSetTabActive($this->Self, $AHwndTab) : false; 
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }
	
    public function SetTabOrder($AHwndTab, $AHwndInsertBefore = 0) {
		$Result =  $this->TBInitialize() ? TBSetTabOrder($this->Self, $AHwndInsertBefore) : false;
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }

    public function SetThumbnailClip(TRect $AClipRect) {
		if ($this->TBInitialize()) {
			$arrAClipRect = array();
			if($AClipRect->Left !== null)	 $arrAClipRect['left']	 = $AClipRect->Left;
			if($AClipRect->Top !== null)	 $arrAClipRect['top']	 = $AClipRect->Top;
			if($AClipRect->Right !== null)	 $arrAClipRect['right']	 = $AClipRect->Right;
			if($AClipRect->Bottom !== null)	 $arrAClipRect['bottom'] = $AClipRect->Bottom;
			
			$Result = TBSetThumbnailClip($this->Self, $this->MainWindow(), $arrAClipRect);		
			if(!$Result) {
				throw new TWinTaskBarException($this->LastError());
			}
			return $Result;
		} else 
			return false;

    }
	
    public function ClearThumbnailClip() {
		$Result = $this->TBInitialize() ? TBClearThumbnailClip($this->Self, $this->MainWindow()) : false; 
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }
	
    public function SetThumbnailTooltip($ATip) {
		$Result =  $this->TBInitialize() ? TBSetThumbnailTooltip($this->Self, $this->MainWindow(), $ATip) : false;
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }
	
    public function ClearThumbnailTooltip() {
		$Result =  $this->TBInitialize() ? TBClearThumbnailTooltip($this->Self) : false;
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }
	
    public function ThumbBarAddButtons(TThumbButtonArray $AButtonList) {
		if ($this->TBInitialize() and (!empty($AButtonList->Value))) {
			$Result = TBThumbBarAddButtons($this->Self, $AButtonList->ToArray(), $this->MainWindow());	
			if(!$Result) {
				throw new TWinTaskBarException($this->LastError());
			}
			return $Result;
		} else 
			return false;
    }
	
    public function ThumbBarSetImageList($AImageList) {
		$Result = $this->TBInitialize() ? TBThumbBarSetImageList($this->Self, $this->MainWindow(), $AImageList) : false; 
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }
	
    public function ThumbBarUpdateButtons(TThumbButtonArray $AButtonList) {
		if ($this->TBInitialize() and (!empty($AButtonList->Value))) {
			$Result =  TBThumbBarUpdateButtons($this->Self, $AButtonList->ToArray(), $this->MainWindow());
			if(!$Result) {
				throw new TWinTaskBarException($this->LastError());
			}
			return $Result;
		} else 
			return false;
    }
	
    public function UnregisterTab($AHwndTab) {
		$Result =  $this->TBInitialize() ? TBUnregisterTab($this->Self, $AHwndTab) : false;
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }
 
    //ITaskBarList4
    public function SetTabProperties($AHwndTab, $AStpFlags) {
		$Result =  $this->TBInitialize() ? TBSetTabProperties($this->Self, $AHwndTab, $AStpFlags) : false;
		if(!$Result) {
			throw new TWinTaskBarException($this->LastError());
		}
		return $Result;
    }

    public function LastError() {
		return $this->TBInitialize() ? trim(TBLastError($this->Self)) : false;
    }
    
    public function MainWindow($handle = null) {
		if ($this->TBInitialize()) {
			if($handle === null)
				return TBMainWindow($this->Self);
			else 
				return TBMainWindow($this->Self, $handle);			
		} else 
			return false;
    }
}