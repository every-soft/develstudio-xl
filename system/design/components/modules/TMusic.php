<?php

global $_c;

$_c->MCI_STATUS_PLAY = 273;
$_c->MCI_STATUS_STOP = 263;


// для совместимости.
class TMCIPlayer extends TMusic {
	
	public $class_name_ex = __CLASS__;
	
}

class TMusic extends __TNoVisual
{
	public $class_name_ex = __CLASS__;

	public function __construct($owner = nil,$init = true,$self = nil)
	{
		parent::__construct($owner, $init, $self);

		if ($init)
		{
			$this->priority = tpIdle;
			$this->url = '';
			$this->volume = 500;
			$this->playOnStart = false;
			$this->loop = false;
		}
	}
 
   public function __initComponentInfo()
   {
        parent::__initComponentInfo();
               
        if ($this->playOnStart)
            $this->play();
			
			global $MediaPlayer;
			
			$MediaPlayer    = new FFI("
        [lib='winmm.dll']
                sint32 mciSendStringA
                (
                        char    *lpszCommand,
                        char    *lpszReturnString,
                        uint32  cchReturn,
                        sint32  hwndCallback
                );
");	
   }

	public static function play()
	{
		$MediaPlayer    = NEW FFI("
			[lib='winmm.dll']
					sint32 mciSendStringA
					(
							char    *lpszCommand,
							char    *lpszReturnString,
							uint32  cchReturn,
							sint32  hwndCallback
					);
	");	

		$MediaPlayer->mciSendStringA('close myFile', '', 0, 0);
		$MediaPlayer->mciSendStringA('open "'.$this->url.'" alias myFile', '', 0, 0);
		$MediaPlayer->mciSendStringA("setaudio myfile volume to ".$this->volume, '', 0, 0);
		$MediaPlayer->mciSendStringA("play myFile ".(!$this->loop) ? '' : 'repeat', '', 0, 0);	 
	}
	
	public static function stop()
	{
		global $MediaPlayer;
		
		$MediaPlayer->mciSendStringA('close myFile', '', 0, 0);
	}

	public static function pause()
	{
		global $MediaPlayer;
		
		$MediaPlayer->mciSendStringA('pause myFile', '', 0, 0);
	}	
			
	public static function resume()
	{
		global $MediaPlayer;
		
		$MediaPlayer->mciSendStringA('resume myFile', '', 0, 0);
	}		

	public static function volume ($volume)
	{
		global $MediaPlayer;
		$MediaPlayer->mciSendStringA("setaudio myfile volume to ".$volume, '', 0, 0);
		
		$this->volume = $volume;
		return $volume;
				
	}	
			
	public static function status() 
	{
		global $MediaPlayer;
		$status = $MediaPlayer->mciSendStringA('status myFile', '', 0, 0);
		
		switch ($status)
		{
			case MCI_STATUS_PLAY: $result = 'Stop'; break;
			case MCI_STATUS_STOP: $result = 'Play'; break;
		}

		return $result;
	}

}

?>