<?


class myEvents {
    
    const BUTTON_HEIGHT = 30;
    const BUTTON_WIDTH  = 200;
    
    public $buttons;
    public $classes;
    public $events;
    public $last_class;
    public $last_self;
    
    public $selObj;
    
    static function getEventsInfo($class)
	{
        
        global $componentEvents;
        if (isset($componentEvents[$class]))
            return $componentEvents[$class];
        else
            return array();
    }
    
    static function phpEditorShow($self)
	{
        
        self::editorShow();
    }
    
    static function findText()
	{
        $text = c('fmPHPEditor->memo')->text;

        $find = c('fmFindDialog->findText')->text;
		$reg = val('fmFindDialog->reg');

		$index = -1;
					
		if (!$text or !$find) 
			return;
			
		$GLOBALS['__find'] = array();
	
		$len = strlen($find);
		
		while (true)
		{
			if (($index = $reg ? strpos($text, $find, $index + 1) : stripos($text, $find, $index + 1)) === false)
				break;

			$GLOBALS['__find'][] = array($index, $len);
		}
    }
    
    static function findTextItem($index)
	{
        if (!$GLOBALS['__find']) 
			self::findText();

        return $GLOBALS['__find'][$index];
    }
    
    static function editorShow ($selLine = false, $caretY = false, $err = false, $only_show = false)
	{
        $eventList = c('fmPropsAndEvents->eventList');
        $PHPEditor = c('fmPHPEditor');
        
        if ($eventList->itemIndex > -1)
		{
            global $fmEdit, $myEvents;
            global $dynamicFuncs, $_FORMS, $formSelected;
			
            $dynamicFuncs = false;
            complete_Props::$forms = false;
            
            $event  = $eventList->events[$eventList->itemIndex];
            
            $php_memo = c('fmPHPEditor->memo');
			
            if (!$only_show)
			{
                eventEngine::setForm();
                $name = $myEvents->getSelectedObject();

                $php_memo->text = eventEngine::getEvent($name, $event);
                $x_name = ($myEvents->selObj->name == 'fmEdit' or ($_FORMS[$formSelected] && !$myEvents->selObj->name)) ? $_FORMS[$formSelected] : $myEvents->selObj->name;

				if(!$x_name) // fix bug
					return;
				
                c('fmPHPEditor')->text = '[ '.$x_name.' :: '.t($event).' ] '. t('php_script_editor');
                
                if ($caretY)
                    $php_memo->caretY   = $caretY;
                
                if ($selLine)
				{       
                    $lines = $php_memo->items->lines;
                    $len = 0;
					
                    foreach ((array) $lines as $i => $line)
					{
                        
                        if ($selLine == ($i+1))
						{
                            $selStart = $len;
                            $selEnd   = $len + strlen($line);
							
                            break;
                        }
                        
                        $len += strlen($line) + strlen(_BR_);
                    }
                    
                    $php_memo->selStart = $selStart;
                    $php_memo->selEnd   = $selEnd;
                }
                
                if ($err)
				{
                    c('fmFindErrors->l_obj')->text = $err['name'];
                    c('fmFindErrors->l_event')->text = t('Event - "%s"', t(strtolower($err['event'])));
                    c('fmFindErrors->memo')->text = $php_memo->items->getLine($err['line']-1);
                    c('fmFindErrors->err_msg')->text = t($err['msg']);
                    c('fmFindErrors->l_line')->text = t('Line %s', $err['line']);

					c('fmFindErrors.info')->caption = '';
					c('fmFindErrors.desc')->caption = '';
					c('fmFindErrors.action_image')->picture->clear();
					
                    $GLOBALS['APPLICATION']->toFront();
                    $res = c('fmFindErrors')->showModal();
					
					if ($res == mrAbort)
					{
                        global $projectFile;
						
                        Kill_Task(basenameNoExt($projectFile) . '.exe');
                    }
                    
                    return;
                }
            }
            
            c('fmPHPEditor->l_eventinfo')->text = CApi::getStringEventInfo($event, $myEvents->selObj->className);
            //$PHPEditor->formStyle = fsNormal;
            $PHPEditor->toFront();
            
            c('fmPHPEditor->btn_cancel')->enabled = false;
            c('fmPHPEditor')->event = $event;
			c('fmPHPEditor')->lastText = $php_memo->text;

            //myComplete::updateComponentList();
            if ($PHPEditor->showModal() == mrOk)
			{
                myComplete::saveCode();
                eventEngine::setEvent($myEvents->getSelectedObject(), $event, c('fmPHPEditor->memo')->text); 
				
                //myHistory::go();
				
				c('fmFindDialog')->visible = false;
            }
            
            //c('fmPHPEditor')->text = $last_text;
            
            global $showComplete, $showHint;
            $showHint = $showComplete = false;
            //lockWindowUpdate(0);
			
			
        }
    }
    
    function deleteEvent()
	{
        global $myEvents;
        $eventList = c('fmPropsAndEvents->eventList');
        
        if ($eventList->itemIndex <> -1)
		{
            global $fmEdit;
            $event = $eventList->events[$eventList->itemIndex];
            
            $name = $myEvents->getSelectedObject();
            eventEngine::delEvent($name, $event);
            
            //$events->clearEvent($event);
            $myEvents->genList();
        }
    }
	
	function getSelectedObject ()
	{
		global $_FORMS, $formSelected, $myEvents;
		
		return $name = (($myEvents->selObj instanceof TForm) or ($_FORMS[$formSelected] && !$myEvents->selObj->name)) ? '--fmedit' : $myEvents->selObj->name;
	}
    
    function changeEvent()
	{
        global $doChangeEvent, $myEvents;
        $doChangeEvent = true;
        
        $edt_Events = c('edt_EventTypes->popupMenu');
        
        $x = cursor_pos_x();
        $y = cursor_pos_y();
        
        $class = rtii_class($myEvents->selObj->self);
        $buttons = $myEvents->classes[$class];
        
        $eventList = c('fmPropsAndEvents->eventList');
        $event  = $eventList->events[$eventList->itemIndex];
        
        if ($eventList->events[0])
		{
            foreach ((array) $buttons as $btn)
			{
				$event = $myEvents->getEvent($btn);
				
				if (in_array(strtolower($event['EVENT']), $eventList->events))
					$btn->visible = false;
            }
        }
        
        $edt_Events->popup($x, $y);        
        foreach ((array) $buttons as $btn)
            $btn->visible = true;
    }
    
    function formKeyDown($self, $key, $shift)
	{
        if ($key == VK_ESCAPE){
            c('edt_EventTypes')->close();
        }
    }
    
    function buttonClick($self)
	{
        global $_sc, $fmEdit, $myProperties, $doChangeEvent, $myEvents;
		// pre(__LINE__);
		
        $obj = _c($self);
        eventEngine::setForm();
		// pre($myEvents->selObj);
        $name = $myEvents->getSelectedObject();
        $eventL = $myEvents->getEvent($obj);
		
        if ($doChangeEvent)
		{
            $eventList = c('fmPropsAndEvents->eventList');
            $event  = $eventList->events[$eventList->itemIndex];
            
            eventEngine::changeEvent($name, $event, $eventL['EVENT']);
        } else {
            eventEngine::setEvent($name, $eventL['EVENT'], '');
		}
		
        $myEvents->genList();
		
        if ($GLOBALS['show_editor'])
		{
            c('fmMain->eventList')->items->selected = t(strtolower($eventL['EVENT']));
            self::editorShow();
        }
		
        $GLOBALS['show_editor'] = false;
    }
    
    function createButton ($eventType, $form)
	{
        $btn = new TMenuItem ($form);
        $btn->caption = $eventType['CAPTION'];
		
		// 0_0
		// $pic = myImages::get24 ($eventType['ICON']);

		$pic = myImages::get24 ($eventType['EVENT']);
		if ($pic)
			$btn->loadPicture ($pic);
		
        //$btn->event   = $eventType;

		$btn->onClick = 'myEvents::buttonClick';
		
        $form->addItem($btn);

        $this->buttons[] = $btn;
        $this->events[$btn->self] = $eventType;
        
        return $btn;
    }
    
    function getEvent(TMenuItem $btn)
	{
        
        return $this->events[$btn->self];
    }
    
    function clearForm()
	{
        if ($this->buttons)
			foreach ((array) $this->buttons as $btn){
				$btn->visible = false;
			}
            
        unset($this->buttons);
        $this->buttons = array();
    }
    
    function genList()
	{
        global $componentEvents, $fmEdit, $myEvents;
        $eventList = c('fmMain->eventList');
        $eventList->clear();
        
        $name = $myEvents->getSelectedObject();
        $eventList->text = eventEngine::listEventsEx($name);
        
        eventEngine::setForm();
        $events = eventEngine::listEvents($name);
        
        $this->last_self = $myEvents->selObj->self;
        $eventList->events = $events;
        
        global $doChangeEvent;
        if ($doChangeEvent)
            $eventList->itemIndex = ($eventList->items->count-1);
    }
    
    function _generate($object)
	{
        global $myEvents;
        
        if ($myEvents->last_self == $object->self) 
			return;
       
        $myEvents->clearForm();
        $this->selObj = $object;
        $class = rtii_class($object->self);
	
        global $componentEvents, $fmEdit;
        $edt_Events = c('edt_EventTypes->popupMenu');

        if (!isset($myEvents->classes[$class]))
		{
            if (isset($componentEvents[$class]))
				foreach ((array) $componentEvents[$class] as $event)
					$myEvents->classes[$class][] = $this->createButton($event, $edt_Events);

        } else {
            
            $myEvents->buttons =& $myEvents->classes[$class];
            
            foreach ((array) $myEvents->buttons as $el)
                $el->show();
				
        }
		
		styleMenu::add($edt_Events);
		
        c('fmMain->tabEvents')->enabled = sizeof($myEvents->classes[$class]) > 0;
        c('fmMain->btn_addEvent')->enabled = sizeof($myEvents->classes[$class]) > 0;
        
        $myEvents->genList();
        
    }
    
    function generate($obj)
	{
        setTimeout(25, 'global $myEvents; $myEvents->_generate(_c('.$obj->self.'))');
    }
    
    function addEvent()
	{
        global $doChangeEvent, $myEvents;
        $doChangeEvent = false;
        
        $edt_Events = c('edt_EventTypes->popupMenu');
        
        $x = cursor_pos_x();
        $y = cursor_pos_y();
        
        $class = rtii_class($myEvents->selObj->self);
        $buttons = $myEvents->classes[$class];
        
        $eventList = c('fmPropsAndEvents->eventList');
        $event  = $eventList->events[$eventList->itemIndex];
        
        if ($eventList->events[0])
		{
			foreach ((array) $buttons as $btn){
				
				$event = $myEvents->getEvent($btn);
				
				if (in_array(strtolower($event['EVENT']), $eventList->events)) {
					$btn->visible = false;
				}
			}
        }
        
        $edt_Events->popup($x, $y);

		foreach ((array) $buttons as $btn)
			$btn->visible = true;
    }
    
    function clickAddEvent($self, $show_editor = false)
	{
        $GLOBALS['show_editor'] = $show_editor;
        
        global $myEvents;
        $myEvents->addEvent();
    }
    
}

//c('edt_EventTypes')->onKeyDown = 'myEvents::formKeyDown';