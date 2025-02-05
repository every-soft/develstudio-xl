<?

class myInspect {
    
    public $objects;
    
    public function  __construct()
	{

    }


    static function genList($obj)
	{
        global $_FORMS, $formSelected;
		
        $forms = myProject::getFormsObjects();
        $index = -1;
        $result  = array($_FORMS[$formSelected].': TForm');
		
        foreach ($forms[$_FORMS[$formSelected]] as $i => $el)
		{
            if ($obj->name == $el['NAME']) 
				$index = $i+1;
			
            $result[] = $el['NAME'].': '.$el['CLASS'];
			
        }
        
        c('fmPropsAndEvents->c_formComponents')->text = $result;
        
        if (!$obj)
		{
            c('fmPropsAndEvents->c_formComponents')->itemIndex = 0;
            return;
        }
        
        if ($index == -1)
			$index = 0;
        
        c('fmPropsAndEvents->c_formComponents')->itemIndex = $index;
    }
    
    static function getObj($item)
	{
        $objects = $GLOBALS['myInspect']->objects;
        
        foreach ($objects as $self => $it) 
		{
            if ($it->self == $item->self)
                return _c($self);
        }
        
        return false;
    }
    
    static function addItem($obj)
	{
        global $inspectList, $myInspect;
        
        $item = $inspectList->items->add();
        $item->imageIndex = myImages::getImgID($obj->className);
		
        if ($item->imageIndex == -1)
            $item->imageIndex = myImages::getImgID('component');
        
        $item->caption    = $obj->name;
        
        $myInspect->objects[$obj->self] = $item;
    }
    
    static function addItemEx($arr)
	{
        global $inspectList;
        
        if (!$arr['NAME']) 
			return;
        
        $item = $inspectList->items->add();
        $item->imageIndex = myImages::getImgID($arr['CLASS']);
		
        if ($item->imageIndex == -1)
            $item->imageIndex = myImages::getImgID('component');
        
        $item->caption    = $arr['NAME'];   
    }
    
    static function delItem($obj)
	{
        global $myInspect, $inspectList;
        
        $item = $myInspect->objects[$obj->self];
        //pre($myInspect);
		
        if ($item)
		{
            $id = $inspectList->items->indexOf($item);
            if ($id > -1)
				$inspectList->items->delete($id);
        }
    }
    
    static function refreshItem($obj)
	{ 
        global $myInspect;
		
        if (method_exists($obj,'__updateDesign'))
		{ 
            $obj->__updateDesign();
        }

        $item = $myInspect->objects[$obj->self];
        $item->caption = $obj->name;
    }
    
    static function clearAll()
	{ 
        global $inspectList, $myInspect;
		
        $inspectList->items->clear();
    }
    
    static function generate($form)
	{
        global $inspectList;
        //lockWindowUpdate($inspectList->handle);
        
        $hor = gui_getScrollPos($inspectList->self, 0);
        $ver = gui_getScrollPos($inspectList->self, 1);
        
        self::clearAll();
        $components = $form->componentList;
        
        foreach ($components as $el) 
		{
            if ($el->name)
                self::addItem($el);
        }
        
        if ($hor > 0)
            gui_setScrollPos($inspectList->self, 0, $hor, true);
		
        if ($ver > 0)
            gui_setScrollPos($inspectList->self, 1, $ver, true);
    }
    
    static function generateEx($arr, $iList)
	{
        global $inspectList;
		
        $last        = $inspectList;
        $inspectList = $iList;
        
        self::clearAll();
        
        foreach ((array) $arr as $el) {
            
            self::addItemEx($el);
        }
        
        $inspectList = $last;
    }
    
    static function updateSelected() 
	{
        
        /*global $_sc;
        $tg  = $_sc->targets_ex;
        $arr = array(); 
        foreach ($tg as $x)
            $arr[] = $x->name;*/
        
        
        c('fmObjectInspector->list')->onClick = 'myInspect::click';
       // c('fmObjectInspector->list',1)->items->selectByCaption($arr);
    }
    
    static function click($self)
	{
        global $_sc, $fmEdit;
		
        $objs = _c($self)->items->selectedCaption;
        
        $_sc->clearTargets();
		
        foreach ($objs as $i => $name)
		{
            if ($i == 0)
                myDesign::inspectElement($fmEdit->findComponent($name));
                
            $_sc->addTarget($fmEdit->findComponent($name));
        }
        
        if (count($objs) == 0)
            myDesign::formProps();

        _c($self)->items->selectedCaption = $objs;
    }
    
    static function changeNameClick()
	{
        global $myProperties, $fmEdit;
        
        $obj = $myProperties->selObj;
		
        if (!$obj) 
			return;
		
        if ($obj->self == $fmEdit->self) 
			return;
        
		$name = inputText(t('To change name of object'), t('New Name'), $obj->name);
		
		if ($name) 
		{
			if (!eregi('^[a-z]{1}[a-z0-9\_]*$',$name)) return;
			
			myDesign::changeName($obj, $name);
		}
    }
}

$GLOBALS['myInspect'] = new myInspect;
