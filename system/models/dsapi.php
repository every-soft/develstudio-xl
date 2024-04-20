<?
/*
   класс, который объединяет все возможности использования DS Api 
*/

define('API_EVENT_EXIT', 1);
define('API_EVENT_ABORT', 2);


class CApi extends DSApi 
{
	// возвращает TRUE, если в папке нет файлов и подпапок
	static function is_empty ($dir)
	{
		return !(bool) count (glob ($dir.'/*.*'));
	}
	
    static function readDSPak($file) 
	{
		if (!is_file($file)) 
			return;
		
        $info = parse_ini_file($file, true);

        $params = array();
		
        $params['name'] = $info['main']['name'];
        $params['ver'] = $info['main']['ver'];
        $params['author'] = $info['main']['author'];
		$params['site'] = $info['main']['site'];
        $params['desc'] = $info['main']['desc'];
        
        if (isset($info[LANG_ID]))
            $params['desc'] = isset($info[LANG_ID]['desc']) ? $info[LANG_ID]['desc'] : $params['desc'];
        
        $params['file'] = $file;
        
        return $params;
    }
    
    // установить компонент из файла .dscomponent
    static function installPak($info) 
	{
        if (!is_array($info))
			$info = self::readDSPak($info);
        
        if (!$info['name']) 
			return;
        
        $err = err_status(false);
		
        $result = array();
        $dir = dirname($info['file']);
        
        if (is_dir($dir.'/components/'))
            $result['components'] = dir_copy($dir.'/components/', DOC_ROOT.'/design/components/');
        
        if (is_dir($dir.'/utils/'))
            $result['utils'] = dir_copy($dir.'/utils/', DOC_ROOT.'/utils/');
        
        if (is_dir($dir.'/modules/'))
            $result['modules'] = dir_copy($dir.'/modules/', DOC_ROOT.'/modules/');
        
        if (is_dir($dir.'/images/'))
            $result['images'] = dir_copy($dir.'/images/', DOC_ROOT.'/images/');
		
        if (is_dir($dir.'/root/')) // alias of "prog"
            $result['root'] = dir_copy($dir.'/root/', DOC_ROOT.'/../');
       
        if (is_dir($dir.'/ext/')) // alias of "php_modules"
            $result['ext'] = dir_copy($dir.'/ext/', DOC_ROOT.'/../ext/');

        if (is_dir($dir.'/demos/')) // demonstration projects (new)
            $result['demos'] = dir_copy($dir.'/demos/', DOC_ROOT.'/../demos/');
		

        if (is_dir($dir.'/editor_types/'))
            $result['editor_types'] = dir_copy($dir.'/editor_types/', DOC_ROOT.'/design/editor_types/');
        
        if (is_dir($dir.'/complete/'))
            $result['complete'] = dir_copy($dir.'/complete/', DOC_ROOT.'/design/complete/');
		
        if (is_dir($dir.'/prog/'))
            $result['prog'] = dir_copy($dir.'/prog/', DOC_ROOT.'/../');

		if (is_dir($dir.'/php_modules/'))
            $result['php_modules'] = dir_copy($dir.'/php_modules/', DOC_ROOT.'/../ext/');
		
        $ds_name = basenameNoExt($info['file']);
        
        file_p_contents(DOC_ROOT . '/ext/' . $ds_name . '.info', serialize($result));
        x_copy($info['file'], DOC_ROOT.'/ext/'.$ds_name.'.dspak');
        
        err_status($err);
    }
    
    static function unInstallPak($name)
	{
        $file = DOC_ROOT.'/ext/'.$name.'.dspak';
        $params = CApi::readDSPak($file);
        
        $files = file_get_contents(DOC_ROOT.'/ext/'.$name.'.info');
        $files = unserialize($files);
        
        file_delete(DOC_ROOT.'/ext/'.$name.'.info');
        file_delete(DOC_ROOT.'/ext/'.$name.'.dspak');

        foreach ((array) $files['components'] as $file)
            file_delete(DOC_ROOT.'/design/components/'.$file);

        foreach ((array) $files['images'] as $file)
            file_delete(DOC_ROOT.'/images/'.$file);

        foreach ((array) $files['utils'] as $file)
            file_delete(DOC_ROOT.'/utils/'.$file);

        foreach ((array)$files['modules'] as $file)
            file_delete(DOC_ROOT.'/modules/'.$file);

        foreach ((array) $files['editor_types'] as $file)
            file_delete(DOC_ROOT.'/design/editor_types/'.$file);    

        foreach ((array) $files['prog'] as $file)
            file_delete(DOC_ROOT.'/../'.$file);
			
        foreach ((array) $files['root'] as $file)
            file_delete(DOC_ROOT.'/../'.$file);
			
        foreach ((array) $files['php_modules'] as $file)
            file_delete(DOC_ROOT.'/../ext/'.$file);
			
        foreach ((array) $files['ext'] as $file)
            file_delete(DOC_ROOT.'/../ext/'.$file);
			
        foreach ((array) $files['complete'] as $file)
            file_delete(DOC_ROOT.'/design/complete/'.$file);

        foreach ((array) $files['demos'] as $file)
		{
			$x_file = DOC_ROOT.'/../demos/'.$file;
			file_delete($x_file);

			$dir = dirname($x_file);
			
			if (self::is_empty($dir))
				while (self::is_empty ($dir)) 
				{
					dir_delete($dir);
					$dir = dirname($dir);
				}
		}
    }
    
    static function packagesList()
	{
        return array_map ('basenameNoExt', findFiles(DOC_ROOT.'/ext/', 'dspak', false));
    }
    
    static function packageExists($name)
	{
        return in_array($name, self::packagesList());
    }
    
    static function packageVer($name)
	{
        $file = DOC_ROOT.'/ext/'.$name.'.dspak';
        $params = CApi::readDSPak($file);
		
        return $params['ver'];
    }
    
    static function addEvent($event, $code)
	{
        $GLOBALS[__CLASS__]['events'][$event][] = $code;
    }
    
    static function delEvent($event, $code)
	{
        $codes = (array)$GLOBALS[__CLASS__]['events'][$event];
        $k = array_search($code, $codes);
		
        if (is_int($k)){
            unset($codes[$k]);
            $GLOBALS[__CLASS__]['events'][$event] = array_values($codes);
        }
    }
    
    static function doEvent($event, $params = array())
	{
        $is_def = false;
        $codes = (array)$GLOBALS[__CLASS__]['events'][$event];
		
        foreach ($codes as $code)
		{
            if ($is_def)
                $x_result = $code($event, $params);
            else
                $result   = $code($event, $params);
            
            if ($result == API_EVENT_ABORT || $x_result == API_EVENT_ABORT)
			{
                return false;
				
            } elseif ($result == API_EVENT_EXIT)
			{
                $is_def = true;
            }
        }
        
        return ($result !== API_EVENT_EXIT);
    }
    
    static function getStringEventInfo($event, $class = false)
	{
        global $myEvents;
        
        $event    = strtolower($event);
        $event[2] = strtoupper($event[2]);
        
        $base = self::getEventParams($event, $class);
        $add  = '';
		
        if ($myEvents->selObj instanceof TFunction)
		{
            $prms = $myEvents->selObj->parameters;
            $prms = str_replace(' ', '', $prms);
			
            if (strpos($prms, ',') === false){
                $prms = explode(_BR_, $prms);
            } else {
                $prms = explode(',', $prms);
            }
            
            array_map('trim', $prms);
			
            if (count($prms) > 0)
                $add = ', ' . implode(', ', $prms);
        }
        
        return t('Event') . ' ['.$event . ']: ' . str_ireplace('&','&&',$base.$add);
    }
    
}