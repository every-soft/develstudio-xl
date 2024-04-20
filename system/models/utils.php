<?

function str_replace_once($search, $replace, $subject) {
    $firstChar = strpos($subject, $search);
	
    if($firstChar !== false) {
        $beforeStr = substr($subject, 0, $firstChar);
        $afterStr = substr($subject, ($firstChar + strlen($search)));
        return $beforeStr . $replace . $afterStr;
    } else {
        return $subject;
    }
}

class myUtils {
 
    static $forms; // [$name]
    
    static function formProp($file, $prop, $def = false)
	{
        if (!is_file($file))
			return;
		
        $arr = file($file);
        foreach ($arr as $i => $line) {
            
            if (substr(trim($line), 0, 6) == 'object' && $i > 0)
                return $def;
            
            $info = explode(' = ',$line);
			
            if (trim($info[0]) == $prop)
			{
                return trim($info[1]);
            }
        }
        
        return $def;
    }
    
    static function delProp($str, $prop)
	{
        $arr   = explode(_BR_, $str);
        $index = false;
        
        foreach ($arr as $i => $line) {
            
            $info = explode(' = ',$line);
            if (trim($info[0]) == $prop)
			{
                $index = $i;
                break;
            }
            
            if (substr(trim($line), 0, 6) == 'object' && $i > 0)
                break;
        }
        
        if ($index)
            unset($arr[$index]);
        
        return implode(_BR_, $arr);        
    }
    
    static function replaceProp($str, $prop, $value)
	{
        $arr   = explode(_BR_, $str);
        $index = false;
        
        foreach ($arr as $i => $line)
		{
            
            $info = explode(' = ',$line);
            if (trim($info[0]) == $prop){
                $index = $i;
                break;
            }
            
            if (substr(trim($line), 0, 6) == 'object' && $i > 0)
                break;
        }
        
        if ($index)
            $arr[$index] = $value;
        
        return implode(_BR_, $arr);        
    }

    static function loadFormDFM($file, $form = false){
        
        global $fmEdit, $_sc, $myProperties, $APPLICATION, $projectFile;
        
        if (!$form)
            $form = $fmEdit;
		
        $form->hide();
		
		if ($objs = $form->componentList) {
			
			foreach ($objs as $obj) {
				if (!method_exists ($obj, 'free') || ($obj instanceof TSizeCtrl)) 
					continue;
				
				$obj->free();
			}
		}
        
        $str = file_get_contents($file);
        
		
        $str = str_replace_once('Visible = True','Visible = False',$str);
        $str = str_ireplace('fsMDIChild','fsNormal',$str);
        $str = str_ireplace('fsStayOnTop','fsNormal',$str);
        $str = str_ireplace('fsMDIForm','fsNormal',$str);
        
        $str = str_ireplace('bsDialog','bsNone', $str);
        $str = str_ireplace('bsSizeable','bsNone',$str);
        $str = str_ireplace('bsSingle','bsNone', $str);
        $str = str_ireplace('bsToolWindow','bsNone',$str);
        $str = str_ireplace('bsSizeToolWin','bsNone',$str);
        
		
        dfm_read('',$form, $str);
       
        $form->formStyle   = fsNormal;
        $form->borderStyle = bsNone;
        $form->left = 10;
        $form->top  = 10;
        
        
        $form->borderIcons = '';
        $form->align = alNone;
        
        $cap        = $form->caption;
        $form->name = 'fmEdit';
        $form->caption = $cap;
        $components = $form->componentList;
        
        foreach ($components as $i => $el)
		{
            
            $class = rtii_class($el->self);
            $real_class = __rtii_class($el->self);
                    
            if (!in_array($class, array('TEvents', 'TSizeCtrl', 'TTabSheet')))
			{
                //$_sc->registerTarget($el);
               
                if ($el instanceof __TNoVisual){
                    $el->label = '';
                    $el->obj   = '';
                    
                }
                
                if (method_exists($el,'__loadDesign'))
                    $el->__loadDesign();                
                
                if (method_exists($el,'__updateDesign'))
                    $el->__updateDesign();
                
                
            } elseif ($class == 'TEvents') {        
               
                // ��� ��� ������� ������ ��������...
                if ($real_class != 'TEvents')
                    $el = convertOldEvents($el);
				
           }
        }
       
	   self::saveForm();
	   
        c('fmMain')->caption = 'DevelStudio XL - '.basenameNoExt($projectFile);
        c('fmMain->statusBar')->simpleText = replaceSr($projectFile);
       
        form_parent($form->self, c('fmMain->pDockMain')->self);
        $form->show();
    }
	
    static function loadForCache($form = false, $no_clear_sc = false)
	{
        global $_sc;
        
        if (!$form)
            $form = $GLOBALS['fmEdit'];
        
        if (is_a ($_sc, 'TSizeCtrl') && !$no_clear_sc)
		{
            $_sc->free();
			$_sc = false;
        }
        
        $form->onMouseDown = 'myDesign::mouseDown';
        $form->onMouseMove = 'myDesign::mouseMove';
        $form->onMouseUp   = 'myDesign::mouseUp';
        $form->onCanResize = 'myDesign::lockEditForm';
        $form->onResize    = 'myDesign::resizeEditForm';

		$_sc = self::createSizeCtrl ($form);
        $targets = $form->componentList;
		
        foreach ($targets as $el){
            if (!$el->isClass(array('TEvents', 'TTabSheet', 'TSizeCtrl'))) {
                
                $_sc->registerTarget($el);
            }
        }
        
        c('fmMain->shapeSize')->w = $form->w + 17;
        c('fmMain->shapeSize')->h = $form->h + 17;

    }
	
	static function createSizeCtrl ($form)
	{
		global $_sc;
		
        $_sc = new TSizeCtrl ($form);
		
        $_sc->showGrid = (bool) myOptions::get('sc', 'showGrid', false);
        $_sc->gridSize = myOptions::get('sc', 'gridSize', 8);
        $_sc->btnColor = myOptions::get('sc', 'btnColor', clBlack);
        
        $_sc->onSizeMouseDown = 'myDesign::selectComponent';
        $_sc->onEndSizeMove   = 'myDesign::endSizeMove';
        $_sc->onStartSizeMove = 'myDesign::startSizeMove';
		$_sc->OnDuringSizeMove = 'myDesign::duringSizeMove2';
		$_sc->onDblClick = 'myDesign::dblClick';
        
        $_sc->popupMenu = c('fmMain->editorPopup');
            
        $_sc->enable   = true;
		
		return $_sc;
	}
    
    static function saveFormDFM($file)
	{
        global $fmEdit, $_sc;
        
        $targets_ex = $_sc->targets_ex;
        
        if (is_a ($_sc, 'TSizeCtrl')) {
			$_sc->clearTargets();
			
            $_sc->free();
            $_sc = false;
        }

        dfm_write($file, $fmEdit);

        self::loadForCache($fmEdit);
		
		if(!empty($targets_ex)) // fix bug
			foreach ($targets_ex as $el) {
				$_sc->addTarget($el);
			}
        
        $str = file_get_contents($file);
        $str = str_replace_once('Visible = True', 'Visible = False', $str);
        $str = str_replace_once('BorderStyle = bsNone',
                                'BorderStyle = '.myProject::getPropForm('borderStyle', 'bsSizeable'),
                                $str);
        
        if (self::formProp ($file, 'Width', null) !== null)
		{
            $str = self::replaceProp($str, 'Width', ' ClientWidth = '. $fmEdit->Width);
            $str = self::replaceProp($str, 'Height', ' ClientHeight = '. $fmEdit->clientHeight);
        }
        
		if (is_writable($file))
			file_put_contents($file, $str);
    }
    
   static function loadForm($name)
   {
        global $fmMain, $_sc, $projectFile, $myInspect, $fmEdit, $formSelected, $_FORMS, $myProperties, $myEvents;
		
        $file = dirname($projectFile) . '/' . $name . '.dfm';
        
		/****** event *****/
		if (!CApi::doEvent('onLoadForm', array('name' => $name))) 
			return;
		/****** ---- *****/
        
        myProperties::unFocusPanel(); // fix
        
        foreach ((array)$_FORMS as $i => $el)
            if (strtolower($el) == strtolower($name)){
                $formSelected = $i;
                c('fmMain->tabForms')->tabIndex = $i;
            }
        
        $myEvents->last_self = ''; // fix bug 
        $l_name = strtolower($name); // fix bug ... 
		
		$fmEdit->hide();
		$fmEdit->name = '';
			
        if (self::$forms[$l_name])
		{
            self::$forms[$l_name]->show();
            $fmEdit = self::$forms[$l_name];
            $cap = $fmEdit->caption;
            $fmEdit->name = 'fmEdit';
            $fmEdit->caption = $cap;
            
            self::loadForCache($fmEdit);
            
            $fmEdit->repaint();
        }
		else {
            $fmEdit = new TForm;
            $fmEdit->position = poDesigned;
            self::loadFormDFM($file, $fmEdit);
            $fmEdit->x = 10;
            $fmEdit->y = 10;

			$fmEdit->clientHeight = 400;
            $fmEdit->clientWidth = 504;
			
            self::$forms[$l_name] = $fmEdit;
            self::loadForCache($fmEdit);

            $fmEdit->repaint();
            $fmEdit->show();
        }
      
        myProject::loadFormInfo();

        $myInspect->generate($fmEdit);

        eventEngine::setForm();    
		
        myDesign::formProps(true); // #1 set
        
		$myProperties->setProps();
		
        
        $fmMain->repaint();
        $fmMain->invalidate();
		
            /****** event *****/
            if (!CApi::doEvent('onLoadFormAfter',array('name'=>$name))) return;
            /****** ---- *****/
    }
    
    static function saveForm($name = false){
        
        global $myProject, $projectFile, $formSelected, $_FORMS;
        
        if (!$name || is_numeric($name))
            $name = $_FORMS[$formSelected];   

		/****** event *****/
		if (!CApi::doEvent('onSaveForm', array('name' => $name)))
			return;
		/****** ---- *****/
        
        $file = dirname($projectFile) . '/' . $name . '.dfm';
        
        myProject::saveFormInfo();
        self::saveFormDFM($file);
        //eventEngine::updateIndexes();
        
		/****** event *****/
		if (!CApi::doEvent('onSaveFormAfter',array('name'=>$name))) return;
		/****** ---- *****/
    }
    
    static function deleteForm($name = false){
        global $projectFile, $formSelected, $_FORMS, $_sc;
        
        if (count($_FORMS) == 1) 
			return messageBox (t('Could not delete single form').'!', t('Error'), MB_OK + MB_ICONERROR);
        
        if (!$name || is_numeric($name))
            $name = $_FORMS[$formSelected];
            
        if (!confirm(t('Are you sure you want to delete the form') . ' "'.$name.'"?')) 
			return;    
        
        /****** event *****/
        if (!CApi::doEvent('onDelForm', array('name' => $name))) 
			return;
        /****** ---- *****/
        
        c('fmMain->tabForms')->tabs->delete ($formSelected);
        if ($formSelected == 0)
            $last_form = $_FORMS[1];
        else
            $last_form = $_FORMS[$formSelected-1];
        
        if (!$last_form)
            $last_form = $_FORMS[0];
        
        if (file_exists(dirname($projectFile) .'/'. $name . '.dfm'))
            unlink(dirname($projectFile) .'/'. $name . '.dfm');
        
        foreach ($_FORMS as $i => $el)
            if (strtolower($el) == strtolower($name)) 
				unset($_FORMS[$i]);
        
        unset(eventEngine::$DATA[strtolower($name)]);
        
        $l_name = strtolower($name); // fix bug forms
        if (self::$forms[$l_name]){
            
            self::$forms[$l_name]->free();
            $_sc = false;
            unset(self::$forms[$l_name]);
        }
        
        $_FORMS = array_values($_FORMS);
        self::loadForm($last_form);
        
        /****** event *****/
        if (!CApi::doEvent('onDelFormAfter', array('name' => $name))) 
			return;
        /****** ---- *****/
    }
    
    static function cloneForm($name = false)
	{
        global $projectFile, $formSelected, $_FORMS, $myProject;
        
        if (!$name || is_numeric($name))
            $name = $_FORMS[$formSelected];
            
        self::saveForm($name);
        myProject::save();
            
        $new_name = $name;
        $i = 1; 
        while (in_array($new_name.$i, $_FORMS)) $i++;
        $new_name = $new_name.$i;    
            
        /****** event *****/
        if (!CApi::doEvent('onCloneForm',array('name'=>$name,'new_name'=>$new_name))) return;
        /****** ---- *****/
            
        $index = c('fmMain->tabForms')->tabIndex;
        c('fmMain->tabForms')->addPage($new_name);
        c('fmMain->tabForms')->tabIndex = $index;
        
        $dfm_file = dirname($projectFile) .'/'. $name . '.dfm';
        $dfm_file2= dirname($projectFile) .'/'. $new_name . '.dfm';
        copy($dfm_file, $dfm_file2);
        
        eventEngine::$DATA[strtolower($new_name)] = eventEngine::$DATA[strtolower($name)];
        
        $_FORMS[] = $new_name;
        
        $myProject->formsInfo[$new_name] = $myProject->formsInfo[$name];
        
        /****** event *****/
        if (!CApi::doEvent('onCloneFormAfter',array('name'=>$name,'new_name'=>$new_name))) return;
        /****** ---- *****/
    }
    
    static function formExists($name)
	{
        
        $name = strtolower($name);
        global $_FORMS, $formSelected;
            foreach ($_FORMS as $el)
                if (strtolower($el) == $name)
                    return true;
        
        return false;
    }
    
    static function renameForm ($name = false)
	{
        global $projectFile, $formSelected, $_FORMS, $myProject, $_sc;
        
        if (!$name || is_numeric($name))
            $name = $_FORMS[$formSelected];
          
        $new_name = inputText(t('Rename this form'), t('New form name'), $name);
		
        if ($new_name)
			if (eregi('^([a-z]{1})([a-z0-9\_]+)$', $new_name)) {

				foreach ($_FORMS as $el) {
					if ($el == $new_name) {
						MessageBox (t('Form %s already exists in project', $el), t('Rename this form'), MB_ICONERROR + MB_OK);
						return false;
					}
				}
    
				/****** event *****/
				if (!CApi::doEvent('onRenameForm', array('name' => $name,'new_name' => $new_name))) 
					return;
				/****** ---- *****/
			
				$dfm_file = dirname($projectFile) .'/'. $name . '.dfm';
				$dfm_file2 = dirname($projectFile) .'/'. $new_name . '.dfm';
				if (file_exists($dfm_file2))
					unlink($dfm_file2);
				 
				if (file_exists($dfm_file)) // fix bug
					rename($dfm_file, $dfm_file2);
				
				myDesign::groupChangeFormName($name, $new_name);
				myDesign::eventChangeFormName($name, $new_name);
				
				$k = array_search($name, $_FORMS);
				$_FORMS[$k] = $new_name;
				
				$id = c('fmMain->tabForms')->tabIndex;
				c('fmMain->tabForms')->tabs->setLine($k, $new_name);
				c('fmMain->tabForms')->tabIndex = $id;
				$myProject->formsInfo[$new_name] = $myProject->formsInfo[$name];
				unset($myProject->formsInfo[$name]);
				
				$_sc->clearTargets(); // f. b.
				myDesign::formProps(true); // fix bug
			
				/****** event *****/
				if (!CApi::doEvent('onRenameFormAfter', array('name' => $name,'new_name' => $new_name))) 
					return;
				/****** ---- *****/
        }
    }
    
    static function openProject($file) {
        
        myProject::open($file);
    }
    
    static function saveProject() {
        
        myProject::save();
    }
    
    
    static function run() {
        
        /****** event *****/
        if (!CApi::doEvent('onRun')) return;
        /****** ---- *****/
        
        self::stop();
        myCompile::start();
        
        /****** event *****/
        if (!CApi::doEvent('onRunAfter')) return;
        /****** ---- *****/
    }
	
    static function runDebug(){
        
        /****** event *****/
        if (!CApi::doEvent('onRunDebug')) return;
        /****** ---- *****/
        
        self::stop();
        myCompile::start(true, true);
        c('fmRunDebug')->show();
        
        /****** event *****/
        if (!CApi::doEvent('onRunDebugAfter')) return;
        /****** ---- *****/
    }
	
    static function stop(){
        
        /****** event *****/
        if (!CApi::doEvent('onStop')) return;
        /****** ---- *****/
        
        global $projectFile;
        Kill_Task(basenameNoExt($projectFile).'.exe');

        /****** event *****/
        if (!CApi::doEvent('onStopAfter')) return;
        /****** ---- *****/
    }
    
    static function createForm ($name)
	{
        global $projectFile, $_FORMS, $myProject;
        
        if (!file_exists(SYSTEM_DIR . '/blanks/form.dfm'))
            msg(t('Blank form is not found: /blanks/form.dfm'));
            
        if (!file_exists(dirname($projectFile)))
            mkdir(dirname($projectFile), 0777, true);
        
        copy(SYSTEM_DIR . '/blanks/form.dfm', dirname($projectFile) .'/'. $name . '.dfm');
        $_FORMS[] = $name;
        
        $info ['position'] = 'poScreenCenter';
        $info ['windowState'] = 'wsNormal';
        $info ['formStyle'] = 'fsNormal';
		$info ['borderStyle'] = 'bsSizeable'; // - fix
        $info ['i_close'] = true;
        $info ['i_min']   = true;
        $info ['i_max']   = true;
        
        $myProject->formsInfo[$name] = $info;

        c('fmMain->tabForms',1)->addPage($name);
        self::saveProject();
    }
    
    static function newForm()
	{
       global $_FORMS, $formSelected;
		
		$x = 1;
		$newName = 'Form' . $x;
		
		while (in_array ('Form' . $x, $_FORMS))
		{
			$x++;
			$newName = 'Form'.$x;
		}
	 
		$name = inputText(t('Create new form'), t('Form name'), $newName);

        if ($name)
			if (eregi('([a-z0-9\_]+)', $name))
			{
				foreach ($_FORMS as $el)
				{
					if (strtolower($el) == strtolower($name))
					{
						MessageBox (t('Form %s already exists in project', $el), t('Create new form'), MB_OK + MB_ICONWARNING);
						return false;
					}
				}
				
				/****** event *****/
				if (!CApi::doEvent('onNewForm',array('name'=>$name))) return;
				/****** ---- *****/
				
				self::saveForm();
				self::createForm($name); // ������� ����� �� ������...
				self::loadForm($name); // ��������� ����� � ������...
				
				/****** event *****/
				if (!CApi::doEvent('onNewFormAfter',array('name'=>$name))) return;
				/****** ---- *****/
			}
    }
    
    static function leftForm(){
        
        global $_FORMS, $formSelected;
        
        if ($formSelected == 0) 
			return;
        
		/****** event *****/
		if (!CApi::doEvent('onLeftForm')) return;
		/****** ---- *****/
        
        self::saveForm($_FORMS[$formSelected]);
        
        $tmp = $_FORMS[$formSelected];
        $_FORMS[$formSelected]   = $_FORMS[$formSelected-1];
        $_FORMS[$formSelected-1] = $tmp;
        c('fmMain->tabForms',1)->tabs->exchange($formSelected, $formSelected-1);
        
        self::loadForm($tmp);
        
            /****** event *****/
            if (!CApi::doEvent('onLeftFormAfter')) return;
            /****** ---- *****/
    }
    
    static function rightForm()
	{
        
        global $_FORMS, $formSelected;
        
        if ($formSelected == count($_FORMS)-1) return;
        
            /****** event *****/
            if (!CApi::doEvent('onRightForm')) return;
            /****** ---- *****/
        
        self::saveForm($_FORMS[$formSelected]);
        
        $tmp = $_FORMS[$formSelected];
        $_FORMS[$formSelected]   = $_FORMS[$formSelected+1];
        $_FORMS[$formSelected+1] = $tmp;
        c('fmMain->tabForms')->tabs->exchange($formSelected, $formSelected+1);
        
        self::loadForm($tmp);
        
		/****** event *****/
		if (!CApi::doEvent('onRightFormAfter')) return;
		/****** ---- *****/
    }
    
    static function formList(){
        
        global $_FORMS, $formSelected;
        $fmFormList = c('fmFormList');
        
        $fmFormList->x = cursor_pos_x();
        $fmFormList->y = cursor_pos_y();
        
        c('fmFormList->list')->text = implode(_BR_, $_FORMS);
        c('fmFormList->list')->itemIndex = $formSelected;
        c('fmFormList->list')->onDblClick = 'myUtils::clickLoadForm';
        c('fmFormList->list')->onClick    = 'myUtils::listClick';
        c('fmFormList->btn_ok')->onClick  = 'myUtils::clickLoadForm';
        c('fmFormList->btn_add')->onClick = 'myUtils::newForm';
        c('fmFormList->btn_del')->onClick = 'myUtils::clickDeleteForm';
        
        $fmFormList->showModal();
    }
    
    
    // �������� ����� ����������� �� �����...
    static function componentCount(){
        
        global $fmEdit;
        $i = 0;
        $components = $fmEdit->componentList;
        
        foreach ($components as $el){
            
            if (!$el->name) continue;
            $i++;
        }
        
        return $i;
    }
    
    
    //////////////// events
    static function clickLoadForm($self){
        
        if (c('fmFormList->list')->itemIndex == -1) return;
        
        $form = c('fmFormList->list')->items->selected;
        
        self::saveForm();
        self::loadForm($form);
        c('fmFormList')->close();
    }
    
    static function listClick($self){
        
        c('fmFormList->form_name')->text = c('fmFormList->list')->items->selected;
    }
    
    static function clickDeleteForm(){
        
        global $_FORMS;
        
        $form = c('fmFormList->list')->items->selected;
        self::deleteForm($form);
    }
}