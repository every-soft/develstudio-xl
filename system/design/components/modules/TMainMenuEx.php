<?php

class TMainMenuEx extends __TNoVisual
{
    
    public $class_name_ex = __CLASS__;
    # public data

    
    public function __initComponentInfo()
	{
		parent::__initComponentInfo();
		
		$obj = new TMainMenu (_c($this->owner));
			
		$list = array();
		$data = explode(_BR_, $this->data);
		$list[0] = $obj;
		
		$name_form = _c($this->owner)->name;
		$styled    = $this->styled;

		foreach ($data as $item)
		{
			$item = str_replace(chr(9), ' ', $item);
				
			$params = array();
			$k      = strpos($item,'[');
			
			if ($k !== false)
			{
				$text   = trim(substr($item, 0, $k));
				$params = trim(substr($item, $k+1, -1));
				$params = explode(',', $params);
			} else {
				$text   = trim($item);
			}
			
			$func = $params[0]; // function 
			$img  = resFile(trim($params[1])); // image 
			$scut = trim($params[2]); // shortcut
			$name = trim($params[3]); // name
			$level = strlen($item) - strlen(ltrim($item)); // level
			
			$autoCheck = (bool) trim ($params[4]);
			$default = (bool) trim ($params[5]);
			$enabled = (bool) trim ($params[6]);
			$checked = (bool) trim ($params[7]);

			$break = (trim ($params[8])) ? trim ($params[8]) : 'mbNone';
			$break = constant ($break);
	
			$org = $list[$level];
			
			$x    = new TMenuItem (_c($this->owner));
			
			$x->caption = t($text);
			$x->shortCut = $scut;
			$x->loadPicture ($img);
			
			$x->enabled = !$enabled;
			$x->checked = $checked;
			$x->autoCheck = $autoCheck;
			$x->break = $break;
			$x->default = $default;
			
			$org->addItem($x);
				
			if ($func)
			{
				$x->onClick = $func; 
			}
				
			if ($name)
				$x->name = $name;

			if ($styled)
				styleMenu::addItem($x);
					
			$list[$level+1] = $x;
		}
			
			
		if ($styled){
			styleMenu::add($obj);
		}
				
		$tmp = $this->name;
		$this->name = '';
		$obj->name = $tmp;
		
		eventEngine::updateIndex($obj);
    }
}

?>