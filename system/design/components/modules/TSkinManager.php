<?

class TSkinManager extends __TNoVisual 
{
	public $class_name_ex = __CLASS__;
	
	# public skinPath

	public function __initComponentInfo ()
	{
		$this->visible = false;
		
		if (LoadSkinsPHP())
		{
			InitLicenKeys("SkinCrafter", "DMSoft", "support@skincrafter.com", "RCXKV7Q47VYJTB18D1ET4UEJ8NOBP");
			DefineLanguage(3);
			InitDecoration(1);
			
			if ($this->skinEnable)
			{
				if (is_file($this->skinPath)){
					LoadSkinFromFile ($this->skinPath);
					ApplySkin();
				} else {
					MessageBox("Файл " . basename ($this->skinPath) . " не найден.\nСкин не был загружен.", 'Предупреждение', MB_OK + MB_ICONWARNING);
				}
			}
		}		
	}
	
	public function __construct ($owner = nil, $init = true, $self = nil)
	{
		parent::__construct($owner, $init, $self);
		
		if ($init)
		{
			$this->skinEnable = true;
		}
	}

	function openSkin ($filename)
	{
		LoadSkinFromFile ($filename);
		ApplySkin();
		
		$this->skinEnable = true;
	}
	
	function enableSkin ()
	{
		ApplySkin ();	
	}
	
	function disableSkin ()
	{
		RemoveSkin ();
	}
	
}