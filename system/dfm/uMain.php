<?

class ev_fmMain_e_search
{
	// %DSPath%/system/models/design.php
	
	public static function onClick ($self)
	{
		if (trim(_c($self)->text) == t('Component search'))
			_c($self)->text = '';
	}
	
	public static function onMouseLeave ($self)
	{
		_c($self)->text = t('Component search');
	}
	
    public static function onChange($self)
	{
		if (trim(_c($self)->text) == t('Component search'))
			return;
		
		if(!$GLOBALS['isSearch'])
		{ 
			myOptions::set('components', 'groups', join (',', c('fmMain->list')->selectedList));
			resetList(); 
		}
		
		if (trim (_c($self)->text))
		{
			$GLOBALS['isSearch'] = true;
			searchList(_c($self)->text);
		}
		else {
			$GLOBALS['isSearch'] = false;
			resetList();
		}
		
    }
}

class evfmMain {
	
	static function onShow ()
	{
        global $fmMain;
		
		$dropFiles = new TDropFilesTarget($fmMain);
		$dropFiles->onDropFiles = "evfmMain::dropFile";
		$dropFiles->enabled = true;
		
	}
	
	function dropFile($self, $files, $x, $y)
	{
		$files = explode(_BR_, $files);
		$file = trim ($files[0]);
		
		$ext = fileExt($file);
		switch ($ext)
		{
			case 'dvs':
			case 'dvsxl':
				myProject::openFromDVS($file);
				break;
			case 'dfm':
				myProject::openAsDFM($file);
				break;
			case 'msppr':
				myProject::open($file);
				break;
			case 'zipdspak':
			case 'dspak':
				if (class_exists('master_Pañkages'))
                    master_Pañkages::installPak($fileName);
				
				break;
			case 'exe':
				myProject::decompile($file);
				break;
				
			default:
				MessageBox (t('Format "%s" is not supported!', $ext), '', MB_OK + MB_ICONERROR);
				break;
		}

    }
	
    // ñîõðàíåíèå íàñòðîåê ïðîãðàììû...
    static function saveMainConfig() 
	{
        global $_sc;
		
		if ($_sc instanceof TSizeCtrl) // fix bug
			$_sc->clearTargets();
		
        myProperties::unFocusPanel(); // fix AV !!!
        global $dsg_cfg, $_sc;
        global $fmEdit, $fmComponents, $fmMain;
        
        $dsg_cfg->main->gridSize = $_sc->gridSize;
        $dsg_cfg->main->btnColor = $_sc->btnColor;
        $dsg_cfg->main->showGrid = (int)$_sc->showGrid;
        // $dsg_cfg->main->lastVer  = $fmMain->lastVer;
        
        myProject::clearProject(); // for fix AV
        
        $dsg_cfg->fmMain->x  = $fmMain->left;
        $dsg_cfg->fmMain->y  = $fmMain->top;
        $dsg_cfg->fmMain->w  = $fmMain->width;
        $dsg_cfg->fmMain->h  = $fmMain->height;
        $dsg_cfg->fmMain->wS = $fmMain->windowState;
        
        $dsg_cfg->lastVer    = DV_VERSION;
        //$dsg_cfg->fmEdit->x = $fmEdit->left; 
        //$dsg_cfg->fmEdit->y = $fmEdit->top;
        
        $dsg_cfg->fmPHPEditor->w = c('fmPHPEditor')->w;
        $dsg_cfg->fmPHPEditor->h = c('fmPHPEditor')->h;
        $dsg_cfg->fmPHPEditor->x = c('fmPHPEditor')->x;
        $dsg_cfg->fmPHPEditor->y = c('fmPHPEditor')->y;
        $dsg_cfg->fmPHPEditor->wS= c('fmPHPEditor')->windowState;

        $dsg_cfg->newProjectDialog->startup = (int) c('fmNewProject->startup')->checked;
        $dsg_cfg->saveToFile(DS_USERDIR.'config.ini');
        
        Docking::saveFile(c('fmMain->pDockBottom'), DS_USERDIR.'bottom.dock');
        Docking::saveFile(c('fmMain->pDockRight'), DS_USERDIR.'right.dock');
        Docking::saveFile(c('fmMain->pDockLeft'), DS_USERDIR.'left.dock');
        
        myOptions::set('pDockRight', 'width', c('fmMain->pDockRight')->w);
        myOptions::set('pDockLeft', 'width', c('fmMain->pDockLeft')->w);
        myOptions::set('pDockBottom', 'height', c('fmMain->pDockBottom')->h);

        myOptions::setFloat('pComponents', c('fmMain->pComponents'));
        myOptions::setFloat('pInspector', c('fmMain->pInspector'));
        myOptions::setFloat('pProps', c('fmMain->pProps'));
        myOptions::setFloat('pDebugWindow', c('fmMain->pDebugWindow'));

        myOptions::set('components', 'groups', implode(',', c('fmMain->list')->selectedList));
        myOptions::set('components', 'smallIcons', c('fmMain->list')->smallIcons);        

		myOptions::set('actions', 'groups', join(',', c('fmPHPEditor->list')->selectedList));
		myOptions::set('actions', 'smallIcons', c('fmPHPEditor->list')->smallIcons);        
		myOptions::set('actions', 'width', c('fmPHPEditor->panelActions')->w);
		
		myOptions::setXYWH('rundebug', c('fmRunDebug'));
        
        c('fmPHPEditor->SynPHPSyn')->saveToArray($arr);
        $arr['main']['color'] = c('fmPHPEditor->memo')->color;
		$arr['main']['font'] = c('fmPHPEditor->memo')->font->name . '*' . c('fmPHPEditor->memo')->font->size;
		
        $ini = new TIniFileEx;
        $ini->arr = $arr;
        $ini->filename = DS_USERDIR . 'phpsyn.ini';
        $ini->updateFile();
        
        $ini = new TIniFileEx;
        $ini->arr = (array)$GLOBALS['ALL_CONFIG'];
        $ini->filename = DS_USERDIR . 'allconfig.ini';
        $ini->updateFile();
    }
    
    static function isDocked($obj)
	{
        $panels = array('pDockLeft', 'pDockRight', 'pDockBottom');
		
        foreach ($panels as $panel) {
            $list = c('fmMain->'.$panel)->dockList;
			
            foreach ($list as $el)
                if ($el->self == $obj->self) 
					return true;
        }
        
        return false;
    }
    
    static function panelStartDock($self, &$drag)
	{
        $drag = control_dragobject($self);
		
    }
    
    static function loadMainConfig()
	{
        $ini = new TIniFileEx(DS_USERDIR.'phpsyn.ini');
		if ($ini->arr)
			ev_fmEditorSettings::loadArray($ini->arr);
		
        c('fmPHPEditor->panelActions')->width = myOptions::get('actions', 'width', 111);
		
        if (c('fmPHPEditor->panelActions')->width < 5)
            c('fmPHPEditor->panelActions')->width = 5; 
		
		myOptions::getXYWH('rundebug', c('fmRunDebug'));
		
        c('fmMain->pDockRight')->w = myOptions::get('pDockRight', 'width', 200);
        c('fmMain->pDockLeft')->w = myOptions::get('pDockLeft', 'width', 220);
        c('fmMain->pDockBottom')->h = myOptions::get('pDockBottom', 'height', 220);
        
        c('fmMain->list')->selectedList = explode(',', myOptions::get('components', 'groups', 'main'));
        c('fmMain->list')->smallIcons   = myOptions::get('components', 'smallIcons', false);
        c('fmMain->c_type')->itemIndex  = c('fmMain->list')->smallIcons ? 1 : 0;

		c('fmPHPEditor->list')->selectedList = explode(',', myOptions::get('actions', 'groups', 'main'));
        c('fmPHPEditor->list')->smallIcons = myOptions::get('actions', 'smallIcons', true);
		
        control_floatstyle( c('fmMain->pDockRight')->self );
        control_floatstyle( c('fmMain->pDockLeft')->self );
        control_floatstyle( c('fmMain->pDockBottom')->self );
        control_floatstyle( c('fmMain->pInspector')->self );
        control_floatstyle( c('fmMain->pComponents')->self );
        control_floatstyle( c('fmMain->pProps')->self );
        control_floatstyle( c('fmMain->pDebugWindow')->self );
        
        c('fmMain->pDebugWindow')->onStartDock = 'evfmMain::panelStartDock';
        c('fmMain->pInspector')->onStartDock = 'evfmMain::panelStartDock';
        c('fmMain->pProps')->onStartDock = 'evfmMain::panelStartDock';
        c('fmMain->pComponents')->onStartDock = 'evfmMain::panelStartDock';
           
        if (!file_exists(DS_USERDIR.'bottom.dock')){
            
            c('fmMain->pComponents')->manualDock(c('fmMain->pDockRight'), alTop);
            c('fmMain->pInspector')->manualDock(c('fmMain->pDockBottom'),alTop);
            c('fmMain->pProps')->manualDock(c('fmMain->pDockLeft'),alTop);
            c('fmMain->pDebugWindow')->manualDock(c('fmMain->pDockBottom'),alBottom);
            
        } 
		else {
			
            Docking::loadFile(c('fmMain->pDockBottom'), DS_USERDIR.'bottom.dock');
            Docking::loadFile(c('fmMain->pDockRight'), DS_USERDIR.'right.dock');
            Docking::loadFile(c('fmMain->pDockLeft'), DS_USERDIR.'left.dock');
            
            if (!self::isDocked(c('fmMain->pComponents')))
                myOptions::getFloat('pComponents', c('fmMain->pComponents'));
            
            if (!self::isDocked(c('fmMain->pInspector')))    
                myOptions::getFloat('pInspector', c('fmMain->pInspector'));
                
            if (!self::isDocked(c('fmMain->pProps')))
                myOptions::getFloat('pProps', c('fmMain->pProps'));
                
            if (!self::isDocked(c('fmMain->pDebugWindow')))
                myOptions::getFloat('pDebugWindow', c('fmMain->pDebugWindow'));

            c('fmMain->it_components')->checked = c('fmMain->pComponents')->visible;
            c('fmMain->it_objectinspector')->checked = c('fmMain->pInspector')->visible;
            c('fmMain->it_props')->checked = c('fmMain->pProps')->visible;
            c('fmMain->it_debuginfo')->checked = c('fmMain->pDebugWindow')->visible;
        }
        
		$obj  = new TComboBox(c('fmMain'));
		$list = c('fmObjectInspector->list');
		
		$obj->parent = $list->parent;
		$obj->align  = alTop;
		$obj->style  = csDropDownList;
		$obj->text   = array(t('Big icons'), t('Small icons'));

		$smallIcons = myOptions::get('inspector', 'smallIcons', 0);
		
		$list->viewStyle = (int) $smallIcons;
		$obj->itemIndex = $smallIcons;

		$obj->onChange = function($self) use ($obj, $list)
		{
			$list->viewStyle = $obj->itemIndex;
			myOptions::set('inspector', 'smallIcons', $obj->itemIndex);
		};
		
		c('fmPropsAndEvents->eventList')->onDblClick = 'myEvents::phpEditorShow';
		c('fmPropsAndEvents->btn_editEvent')->onClick = 'myEvents::phpEditorShow';
		c('fmPropsAndEvents->btn_delEvent')->onClick  = 'myEvents::deleteEvent';
		c('fmPropsAndEvents->btn_changeEvent')->onClick = 'myEvents::changeEvent';
		
		gui_propSet(c("fmObjectInspector->list")->IconOptions, 'AutoArrange', 1);
    }
    
    static function onCloseQuery($self, &$canClose)
	{
		// fix bug
		application_restore();
		
		// fix bug
		_c($self)->formStyle = fsStayOnTop;
		_c($self)->formStyle = fsNormal;

       if (!defined('IS_APPLICATION_START')) 
			return false;
		
		$res = messageBox(t("All unsaved data will be lost. \nDo you want to save the project before exit?"), t('Closing Devel Studio XL'), MB_ICONQUESTION + MB_YESNOCANCEL);
        
        if ($res == mrYes)
		{
            if (!myProject::saveAsDVSDialog()){
                $canClose = false;
                return false;
            }
            
            self::saveMainConfig();
			myProject::initLastFiles($GLOBALS['projectFile']); // fix bug
        } elseif ($res == mrNo){
            
            self::saveMainConfig();
			myProject::initLastFiles($GLOBALS['projectFile']); // fix bug
        } elseif ($res == mrCancel) {
            
            $canClose = false;
        }
        
    }

}

class ev_it_objectinspector {
    
    static function onClick($self){
        
        $GLOBALS['_sc']->updateBtns();
        c('fmMain->pInspector')->visible = !c('fmMain->pInspector')->visible;
        ev_it_props::setWidth(c('fmMain->pDockLeft'));
        ev_it_props::setWidth(c('fmMain->pDockRight'));
        ev_it_props::setHeight(c('fmMain->pDockBottom'));
    }
}

class ev_it_components {
    
    static function onClick($self){
        
        $GLOBALS['_sc']->updateBtns();
        c('fmMain->pComponents')->visible = !c('fmMain->pComponents')->visible;
        ev_it_props::setWidth(c('fmMain->pDockLeft'));
        ev_it_props::setWidth(c('fmMain->pDockRight'));
        ev_it_props::setHeight(c('fmMain->pDockBottom'));
    }
}


class ev_it_props {
    
    static function setWidth($panel){
        
        $list = $panel->dockList;
        $c = 0;
        foreach ($list as $el)
            if ($el->visible)
                $c++;
        
        if ($c > 0)
            $panel->w = 220;
        else
            $panel->w = 5;
    }
    
    static function setHeight($panel){
        
        $list = $panel->dockList;
        $c = 0;
        foreach ($list as $el)
            if ($el->visible)
                $c++;
        
        if ($c > 0)
            $panel->h = 170;
        else
            $panel->h = 5;
    }
    
    static function onClick($self){
        
        $GLOBALS['_sc']->updateBtns();
        c('fmMain->pProps')->visible = !c('fmMain->pProps')->visible;
        ev_it_props::setWidth(c('fmMain->pDockLeft'));
        ev_it_props::setWidth(c('fmMain->pDockRight'));
        ev_it_props::setHeight(c('fmMain->pDockBottom'));
    }
}


class ev_it_debuginfo {
    
    static function onClick($self){
        
        $GLOBALS['_sc']->updateBtns();
        c('fmMain->pDebugWindow')->visible = !c('fmMain->pDebugWindow')->visible;
		
        ev_it_props::setWidth(c('fmMain->pDockLeft'));
        ev_it_props::setWidth(c('fmMain->pDockRight'));
        ev_it_props::setHeight(c('fmMain->pDockBottom'));
    }
}

class ev_it_vkgroup {
    
    static function onClick(){
        
        shell_execute(0, 'open', 'http://vk.com/evsoft', '', '', SW_SHOW);
    }
}

class ev_it_restart 
{
	
	static function close()
	{
		/* ... DS LE ... */
		
		$command = '"' . param_str(0) . '" "' . param_str(1) . '"';
        exec($command);
	}
	
    static function onClick()
	{
	   $res = MessageBox(t("Changes to the project will not be saved! \nDo you really want to restart DevelStudio?"), 'DevelStudio XL', MB_ICONWARNING + MB_YESNO);

		if ($res == mrYes)
		{
			$t = new TThread ('ev_it_restart::close');
			$t->resume();
			
			evfmMain::saveMainConfig();
			myProject::initLastFiles($GLOBALS['projectFile']); // fix bug
			application_terminate();
		}
	
    }
}

class ev_it_aboutprogram 
{
    
    static function onClick()
	{
        c('fmAbout')->showModal();
    }
}

class ev_it_exit 
{
    static function onClick()
	{
        c('fmMain')->close();
    }
}

class ev_statusBar 
{
    
    static function onClick()
	{
        global $projectFile;
		
        shell_execute(0, 'open', replaceSr(dirname($projectFile)).'\\', '', '', SW_SHOW);
    }
}

class ev_fmMain_pDockLeft 
{
    static function onDockDrop($self, $source)
	{
		$GLOBALS['_sc']->updateBtns();
        $obj = c($self);
        $source = c($source);
        
        if ($obj->dockClientCount < 2)
          if ($obj->w < 30){
            $obj->w = 220;
            $source->w = 220;
          }
          else
            ;
    }
    
    static function onUndock($self, $count = 1)
	{
        $GLOBALS['_sc']->updateBtns();
        $obj = c($self);
		
        if ($obj->dockClientCount <= 1)
            $obj->w = 5;
    }
}

class ev_fmMain_pDockRight 
{
    function onDockDrop($self, $source){
        ev_fmMain_pDockLeft::onDockDrop($self, $source);
    }
    
    function onUndock($self, $count = 1){
        ev_fmMain_pDockLeft::onUndock($self, $count);
    }
}


class ev_fmMain_pDockBottom 
{
    static function onDockDrop($self, $source)
	{
		$GLOBALS['_sc']->updateBtns();
        
        $obj = _c($self);
        $source = _c($source);
		
        if ($obj->dockClientCount < 2)
			if ($obj->h < 30)
			{
				$obj->h = 170;
				$source->h = 170;
			}
    }
    
    static function onUndock($self, $count = 1)
	{
        $GLOBALS['_sc']->updateBtns();
        $obj = _c($self);
		
        if ($obj->dockClientCount <= 1)
            $obj->h = 5;
    }
}


class ev_fmMain_c_formComponents 
{
    
    static function onChange($self)
	{
        global $fmEdit;
        
        $index = _c($self)->itemIndex;
        
        if ($index === 0) 
			$obj = $fmEdit;
        else {
            
            global $_FORMS, $formSelected;
            $forms = myProject::getFormsObjects();
            $obj = $fmEdit->findComponent($forms[$_FORMS[$formSelected]][$index-1]['NAME']);
        }
        
        myDesign::inspectElement($obj);
    }
}

class ev_fmMain_pDockMain 
{
    function doit()
	{
        global $_sc, $fmEdit;
        
        myDesign::formProps();
        form_parent($fmEdit->self, c('fmMain->pDockMain')->self);
		
		if ($_sc instanceof TSizeCtrl)
			$_sc->clearTargets();
    }
        
    function onClick()
	{
        setTimeout(50, 'ev_fmMain_pDockMain::doit()');
    }
	
    function onMouseEnter()
	{
        gui_propSet(c('fmMain->pDockMain')->VertScrollBar, 'Tracking', True); 
        gui_propSet(c('fmMain->pDockMain')->HorzScrollBar, 'Tracking', True);
    }
}

class ev_fmMain_c_type {
    
    function onChange($self)
	{
        c('fmMain->list')->smallIcons = (c($self)->itemIndex === 1);
    }
}


class ev_fmMain_shapeSize
{
    function typeCursor($self, $x, $y)
	{
        $obj = toObject($self);
        $w   = $obj->w;
        $h   = $obj->h;
        $curType = crDefault;
        
        if ( $y>$h-20 ){
            $curType = crSizeNS;
        }
        
        if ( $x>$w-20 ){
            $curType = crSizeWE;
        }
        
        if ( $y>$h-20 && $x>$w-20){
            $curType = crSizeNWSE;
        }
        
        return $curType;    
    }
     
    
    function onMouseDown($self, $button, $shift, $x, $y)
	{
        global $shapeSize, $_preX, $_preY, $curType;
	
        c('fmMain->pDockMain',1)->doubleBuffer = true;

        $obj = c($self);
        $_preX = $obj->w - $x;
        $_preY = $obj->h - $y;
		$obj->brushColor = 8026746;
        $shapeSize = true;
        
        $curType = self::typeCursor($self, $x, $y);
        $obj->cursor = $curType;
    }

    function onMouseMove($self, $shift, $x, $y)
	{
        global $curType, $shapeSize, $_preY, $_preX, $fmEdit;
        
        $obj = _c($self);
        $w   = $obj->w;
        $h   = $obj->h;
        
        $fW   = $fmEdit->w;
        $fH   = $fmEdit->h;
        $minW = $fmEdit->constraints->minWidth;
        $minH = $fmEdit->constraints->minHeight;
        $maxW = $fmEdit->constraints->maxWidth;
        $maxH = $fmEdit->constraints->maxHeight;
        $aSize= $fmEdit->autoSize;
        $gridSize = myOptions::get('sc', 'gridSize', 8);

        if ($shapeSize)
		{
        
            if ($fW < 0 || $fH < 0) 
				return;
                
            if ($aSize) 
				return;
            
            $obj->cursor = $curType;
            global $fmEdit;
            
            $fmEdit->y = 10;
            $fmEdit->x = 10;
            
            $new_w = $x+1 + $_preX;
            $new_w = $new_w - $new_w% $gridSize;
            
            if ($curType == crSizeWE || $curType == crSizeNWSE)
			{
                if ((($new_w-($gridSize * 2)-1 < $maxW) || $maxW==0) && (($new_w-($gridSize * 2)-1 > $minW) || $minW==0))
				{
                    c('fmMain->shapeSize')->w = $new_w < 1 ? $gridSize * 2 : ($new_w - $gridSize * 2) + 17;
                    $fmEdit->w = $new_w-$gridSize * 2;
                }
            }
            
            $new_h = $y+1 + $_preY;
            $new_h = $new_h - ($new_h % $gridSize );
            
            if ($curType == crSizeNS || $curType == crSizeNWSE)
			{
                
                if ((($new_h-($gridSize * 2)-1 < $maxH) || $maxH==0) && (($new_h-($gridSize * 2)-1 > $minH) || $minH==0)){
                    c('fmMain->shapeSize',1)->h = $new_h < 1 ? $gridSize * 2 : ($new_h - $gridSize * 2) + 17;
                    $fmEdit->h = $new_h - $gridSize * 2;
                }
               
            }
            
            global $propFormW, $propFormH;
            $propFormW->value = $fmEdit->w;
            $propFormH->value = $fmEdit->h;
			
        } else {
            
            $obj->cursor = self::typeCursor($obj, $x, $y);
        }
    }
    
    function onMouseUp($self, $shift, $x, $y){
        
        global $shapeSize;
        $shapeSize = false;
		
		_c($self)->brushColor = 9408399;
    }
}

class ev_it_makebackup 
{
	static function onClick ($self)
	{
		myBackup::doInterval(true);
	}
}

class ev_it_rundebug {

	static function onClick ($self)
	{
		myUtils::runDebug();
	}
}

class ev_itemSelectAll {
    
    static function onClick ($self) {
        global $fmEdit, $_sc;
		
        foreach ($fmEdit->componentList as $target)
            $_sc->addTarget($target);
			
    }
}

myCompile::setStatus('Info', t('Welcome to DevelStudio XL').'!', 0x00FF8000);