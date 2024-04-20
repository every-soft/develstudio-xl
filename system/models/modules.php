<?


class myModules {
    
    static $skinClasses;
    
    static function getAll(){
        
        $modules = findFiles(SYSTEM_DIR . '/../ext/','dll');
        return $modules;
    }
    
    static function getInc(){
        
        return (array)$GLOBALS['myProject']->config['modules'];
    }
    
    static function getPHPModules()
	{
        global $projectFile;
		global $componentClasses;
        
        $forms = myProject::getFormsObjects();
        
        $result  = array();
        $classes = array();
        foreach ($forms as $objs)
			foreach ($objs as $el)
			{
				/* if (!in_array($el['CLASS'],$classes) && file_exists(SYSTEM_DIR.'/design/components/modules/'.$el['CLASS'].'.phpe2')){
					$result[] = SYSTEM_DIR.'/design/components/modules/'.$el['CLASS'].'.phpe2';
					$classes[] = $el['CLASS'];
				} else */if (!in_array($el['CLASS'], $classes) && file_exists(SYSTEM_DIR.'/design/components/modules/' . $el['CLASS'] . '.php')){
				   
					$result[] = SYSTEM_DIR.'/design/components/modules/'.$el['CLASS'].'.php';
					$classes[] = $el['CLASS'];
				}  
			}

        $files = findFiles(dirname($projectFile).'/scripts/', 'php');
        foreach ($files as $file)
            $result[] = dirname($projectFile).'/scripts/'.$file;
        
        return $result;
    }
    
	/*
		А что ты тут делаешь?
		Пасхалку нашёл, да? 
	*/
    static function skinExists()
	{
        $forms = myProject::getFormsObjects();
        
        $result  = array();
        foreach ($forms as $objs)
			foreach ($objs as $el)
			{
				if (in_array($el['CLASS'], (array)self::$skinClasses)) {
					return true;
				}  
			}
        
        return false;
    }
    
    // возвращает список необходимых для подключения модулей...
    static function getNeed(){
        
        global $myProject, $fmEdit, $_components;
        
        $forms = myProject::getFormsObjects();
        
        foreach ($forms as $objs)
			foreach ($objs as $el){
				
				$class = BlockData::getItem($_components, $el['CLASS'], 'CLASS');
				$modules = $class['MODULES'];
				self::add($modules);
				
			}
    }
    
    static function add($module)
	{
        if (!$module)
			return false;
        
        if (is_array($module))
		{
            foreach ($module as $el)
                self::add($el);
				
            return 0;
        }
        
        global $myProject;
        if (!in_array($module, (array)$myProject->config['modules']))
            $myProject->config['modules'][] = $module;
    }
    
    // attach_dll прикреплять к ехе расширения
    static function inc($file = false, $attach_dll = false)
	{
        global $myProject, $projectFile;
        
        if (!$file)
            $file = $projectFile;
            
        $dir = replaceSl(dirname(EXE_NAME)) . '/';
        self::getNeed();
        
       // $myProject->config['modules'][] = 'php_bcompiler.dll';
        $myProject->config['modules'] = array_unique($myProject->config['modules']);
        $real = array();
        foreach ((array)$myProject->config['modules'] as $mod)
		{
            // копируем сам модуль, если не скопирован
            //if (!file_exists(dirname($file).'/ext/'.$mod)){
			if (!$attach_dll){
				$md5_1 = $md5_2 = false;
				
				if (is_file($dir.'ext/'.$mod)) {
					$md5_1 = md5_file($dir.'ext/'.$mod);
					$real[] = $mod;
				}
				
				if (is_file(dirname($file).'/ext/'.$mod))
					$md5_2 = md5_file(dirname($file).'/ext/'.$mod);

				if (!$md5_2 || ($md5_1 != $md5_2)) {
					x_copy($dir.'ext/'.$mod, dirname($file).'/ext/'.$mod);
				}
			}
            //}
            
            // копируем зависимые dll-ки модуля...
            foreach ((array)$GLOBALS['MODULES_INFO'][$mod] as $dll){
                    if (is_file($dir . $dll))
						if (!file_exists(dirname($file).'/'.$dll))
							copy($dir . $dll, dirname($file).'/'.$dll);
            }
        }
       
		if(!empty($real))
			$myProject->config['modules'] = $real;
		
		global $componentClasses, $componentClassesEx;
		
		if (!$componentClassesEx) {
			foreach($componentClasses as $item)
				$componentClassesEx[$item['CLASS']] = $item;
		}
		
        $forms = myProject::getFormsObjects();
		
		foreach ($forms as $objs)
			foreach ($objs as $el)
			{
				$class = $el['CLASS'];
				$info  = $componentClassesEx[$class];
				
				if (isset($info['DLLS']))
					if (is_array($info['DLLS']))
					{
						foreach($info['DLLS'] as $dll)
						{
							if (file_exists(dirname($file).'/'.$dll))
								continue;
							
							$xfile = $dir . $dll;
							
							if (is_file($xfile)) {
								copy($xfile, dirname($file).'/'.$dll);
							} elseif (is_dir($xfile)) {
								dir_copy($xfile, dirname($file).'/'.basename($xfile));
							}
						}
					}
			}
    }
    
    
    // очищаем от лишних модулей и dll
    static function clear()
	{
        global $myProject, $projectFile;
        
        $modules = (array) $myProject->config['modules'];
        $info    = (array) $GLOBALS['MODULES_INFO'];
        $files   = findFiles(dirname($projectFile).'/ext/', 'dll');
        
        foreach ($files as $file){
            // если файл отсутствует в модулях, удаляем
            if (!in_array($file, $modules)){
				myUtils::stop(); // fix bug with Permission denied
				delay(200);
                unlink(dirname($projectFile).'/ext/'.$file);
                
                // удаляем зависимые dll-ки
                foreach ((array) $info[$file] as $dll)
                    if (file_exists(dirname($projectFile).'/'.$dll))
                        unlink(dirname($projectFile).'/'.$dll);
            }
        }
    }
}