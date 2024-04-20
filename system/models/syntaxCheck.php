<?

class mySyntaxCheck {
    
    static $errors;
    static $noerrors;
    
    function saveFiles($dir, $form, $obj_name)
	{
        $form     = strtolower($form);
        $obj_name = strtolower($obj_name);
        $result = array();
		
        if ($form == $obj_name)
            $eventList = eventEngine::$DATA[$form]['--fmedit'];
        else
            $eventList = eventEngine::$DATA[$form][$obj_name];
            
		if(is_array($eventList))
		{
			foreach ($eventList as $event => $code)
			{
				$code = 'if (!function_exists("my_func")){ function my_func() { '.$code."\n".'} }';
				
				if(!empty(self::$noerrors)) // fix err
					if (in_array(md5($code),self::$noerrors) || !trim($code)) 
						continue;
				
				if ($form == $obj_name)
					$file = $dir.'/'.$form.'.'.$event.'.php';                
				else 
					$file = $dir.'/'.$form.'.'.$obj_name.'.'.$event.'.php';

				file_p_contents($file, $code);
				$result[] = replaceSr($file);
			}
		}
        
        return $result;
    }
    
    function parseErrors($file)
	{ 
		if(!file_exists($file))
			return;
		
        $result = file($file);
        $dir    = dirname($file);

        foreach ($result as $line)
		{
            $info = explode('|', $line);
			
            if (trim($info[1]))
			{ // если есть ошибка
                $tmp = explode('.', basenameNoExt($info[0]));
				
				// fix bug
                $event = $tmp[count($tmp)-1];
                $form  = $tmp[0];
                $obj   = sizeof($tmp) == 2 ? '' : $tmp[1];
				
				unset ($tmp[0]); // strip ___scripts
				$scriptn = join ('.', $tmp);
				$script = $dir . '/___scripts.'.$scriptn.'.php';

				if(is_file ($script))
					$event = $scriptn;

                self::$errors[] = array('msg'=>trim($info[1]), 'type'=>(int)$info[2],
                                        'line'=>(int)$info[3], 'event'=>$event,
                                        'form'=>$form, 'obj'=>$obj);
										
            } else {		
				if(file_exists($dir.'/'.$info[0]))
					self::$noerrors[] = md5_file($dir.'/'.$info[0]);
            }
        }
    }
    
    function showErrors ()
	{
        $list = c('fmMain->debugList');
        $list->onClick = 'mySyntaxCheck::clickError';
        $list->onDblClick = 'mySyntaxCheck::dblClickError';
        $list->text = '';
		
        foreach ((array) self::$errors as $err)
		{
            $obj_name = trim(strtolower($err['form']));

            if ($err['obj'] && $obj_name != '___scripts')
                $obj_name .= '->'.$err['obj'];
                
            if ($obj_name == '___scripts'){
                $obj_name = t('Project script');

				$err['event'] = '/scripts/'.$err['event'].'.php';
            }
                
            $line = '('.$obj_name.', '.t($err['event']).')  '.$err['msg'].' '.t('on line').' '.$err['line'];
            //$list->text .= $line . _BR_;
			myCompile::setStatus ('Error', $line);
        }
        
        $list->itemIndex = 0;
		
        if (count(self::$errors) > 0)
			message_beep(MB_ICONERROR);
    }
    
    function checkProject($prefix = '')
	{
        global $projectFile;
        self::$errors = array();
        
        if (!$prefix)
            $prefix = md5($projectFile);
        
        $dir   = TEMP_DIR.'/devels3/syntaxcheck/'.$prefix.'/';
		
		if(!is_dir($dir))
			dir_create($dir);
		
        $list  = myProject::getFormsObjects();
        $files = array();
        
        if (file_exists($dir.'/noerror.log'))
            self::$noerrors = explode("\n", file_get_contents($dir.'/noerror.log'));

        foreach ($list as $form => $objs)
		{
            $files = array_merge($files, self::saveFiles($dir, $form, $form));
			
			if ($objs)
			foreach ($objs as $obj)
				$files = array_merge($files, self::saveFiles($dir, $form, $obj['NAME']));    
        }
        
        
        $scripts = findFiles(dirname($projectFile).'/scripts/', 'php');

        foreach ($scripts as $file)
		{
			copy(dirname($projectFile).'/scripts/'.$file, $dir.'/___scripts.'.$file);
			
            $files[] = $dir.'/___scripts.'.$file;
        }

        if (count($files) == 0) 
			return true;
		
        file_p_contents($dir.'/files.chk', implode("\n", $files));

        Kill_Task('phpUtils.exe');
		$err = err_status(false);
        shell_execute_wait2(SYSTEM_DIR . '/../phpUtils.exe','"'.$dir.'/files.chk" "'.$dir.'/error.log"', 'open', SW_HIDE);
		err_status($err);
        
        self::parseErrors($dir.'/error.log');

		if(is_array (self::$noerrors))
			$arr = implode("\n", self::$noerrors);
		
        file_put_contents ($dir.'/noerror.log', $arr);
        
        foreach ($files as $file)
			if(is_file($file))
				unlink($file);
        
        
        if (count (self::$errors) > 0)
            return false;
        else
            return true;
    }
    
    static function clickError($self)
	{
        $index = _c($self)->itemIndex;
		
        if ($index == -1) 
			return;
        
        global $_FORMS, $formSelected, $fmEdit, $_sc, $myEvents;
        
        $error = self::$errors[$index];
		
        if (!$error) 
			return;
		
        if ($error['form'] == '___scripts') 
            return; 
        
        if (strtolower($_FORMS[$formSelected]) != strtolower($error['form']))
		{
			eventEngine::setForm($error['form']);
			myUtils::saveForm();
			myUtils::loadForm($error['form']);
        }
        
        if (!$error['obj'])
		{
            $_sc->clearTargets();
            myDesign::formProps();
			
        } else {
            myDesign::inspectElement($fmEdit->findComponent($error['obj']));    
        }
        
        if (!$error['event']) 
			$error['event'] = 'OnExecute';
		
        c('fmMain->eventList')->items->selected = t(strtolower($error['event']));
    }
    
    static function dblClickError($self)
	{
        $index = _c($self)->itemIndex;
		
        if ($index == -1) 
			return;
		
        $error = self::$errors[$index];
        
        self::clickError($self);
        
        if ($error['form'] == '___scripts')
		{
            global $projectFile;

            // run(dirname($projectFile).'/scripts/'.$error['event'].'.php');
			// exec('"C:\Program Files\Notepad++\notepad++.exe" -n' . $error['line'] . ' '.realpath(dirname($projectFile).'/scripts/'.$error['event'].'.php'));
			// shell_execute(0,'open',"C:/Program Files (x86)/Notepad++/notepad++.exe","-n5 ".DOC_ROOT."f.php",'',4);
			// shell_execute(0,'open',"C:/Program Files/Notepad++/notepad++.exe",'-n5 "'.DOC_ROOT.'scripts\tDecompiler 2.0.php"','',4);
			
			if (file_exists('C:\Program Files\Notepad++\notepad++.exe'))
				shell_execute(0, 'open', "C:/Program Files/Notepad++/notepad++.exe", '-n'.$error['line'].' "'.realpath(dirname($projectFile).'/scripts/'.$error['event'].'.php').'"', '', 4);
			elseif (file_exists('C:\Program Files (x86)\Notepad++\notepad++.exe'))
				shell_execute(0, 'open', "C:/Program Files (x86)/Notepad++/notepad++.exe", '-n'.$error['line'].' "'.realpath(dirname($projectFile).'/scripts/'.$error['event'].'.php').'"', '', 4);
			else
				run(dirname($projectFile).'/scripts/'.$error['event'].'.php');
			
            return;
        }
        
        myEvents::editorShow($error['line']);
    }
}