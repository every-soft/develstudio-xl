<?


class complete_Props {
    
    /*
    function check($lineText){
        
        
    }*/
    static $forms;
    
    static function getClass ($obj_name)
	{
        
        $arr = explode('->', $obj_name);
        
        if (!self::$forms)
            self::$forms = myProject::getFormsObjects();
        
        $class = false;
        
        if (count($arr) == 1) {
            
            global $_FORMS, $formSelected;
            foreach (self::$forms as $form => $objs){
                
                if (strtolower($form)==strtolower($arr[0])){
                    $class = 'TForm';
                    break;
                }
            }
			
            if (!empty(self::$forms))
            foreach (self::$forms as $form => $objs){
                if (!empty($objs))
                foreach ($objs as $obj){
                    if (strtolower($obj['NAME'])==strtolower($arr[0])){
                        $class = $obj['CLASS'];
                        break;
                    }
                }
            }
        } else {
            
            foreach ((array)self::$forms[$arr[0]] as $obj)
                if (strtolower($obj['NAME'])==strtolower($arr[1])){
                    $class = $obj['CLASS'];
                    break;
                }
        }
        
        return $class;
    }
    
    
    function _getList ($class, $add = '->')
	{
        $arr['insert'] = array();
        $arr['item']   = array();

        $events = myEvents::getEventsInfo($class);
        $props  = myProperties::getPropertiesInfo($class);
        $methods= myProperties::getMethodsInfo($class);
        
        $methods= array_merge(self::getDynMethodsInfo($class), $methods);
        $props  = array_merge(self::getDynPropsInfo($class), $props);
        
        foreach ((array)$props as $prop)
		{
            $arr['insert'][] = $add . $prop['PROP']; 
            $arr['item'][]   = myComplete::fromBB('->[$g][b]'.$prop['PROP'].'[/b] - [$s]'.$prop['CAPTION']);
        }
        
        foreach ((array)$events as $event){
            $arr['insert'][] = $add.$event['EVENT'];
            $arr['item'][]   = myComplete::fromBB('->[$bl][b]'.$event['EVENT'].'[/b] - [$s]'.$event['CAPTION']);
        }

        foreach ((array)$methods as $method){
            
            $func = str_replace('()', '', $method['PROP']);
            $text = $method['INLINE'];
            
            $text = str_replace($func.' ', '[b]'.$func.'[/b] ', $text);
            $text = str_replace('nubmer ', '[$r]number[$b] ',$text);
            $text = str_replace('float ', '[$r]float[$b] ', $text);
            $text = str_replace('mixed ', '[$r]mixed[$b] ', $text);
            $text = str_replace('string ', '[$r]string[$b] ', $text);
            $text = str_replace('array ', '[$r]array [$b]', $text);
            $text = str_replace('bool ', '[$r]bool[$b] ', $text);
            $text = str_replace('void ', '[$r]void[$b] ', $text);
            $text = str_replace('int ', '[$r]int[$b] ', $text);
            $text = str_replace('resource ', '[$r]resource[$b] ', $text);
            $text = str_replace('object ', '[$r]object[$b] ', $text);
            
            $arr['insert'][] = $add.$method['PROP'];
            $arr['item'][]   = myComplete::fromBB('->'.$text);
        }
        
        return $arr;
    }

    function getDynMethodsInfo ($x_class)
	{
        $result = array();
        $x_class  = strtolower ($x_class);
        $info   = complete_Funcs::getFormFunctions();
		
		// $st = is_subclass_of ($x_class, '_Object');

        foreach ($info as $class)
		{
            if (empty($class['info'])) continue;
			
            if (strtolower($class['NAME']) == $x_class)
			{
                $methods = (array) $class['info']['methods'];

				foreach ($methods as $method) {
					if ($isSet = (strtolower($method['name']) == '__set'))
						break;
				}
				
				foreach ($methods as $method) {
					if ($isGet = (strtolower($method['name']) == '__get'))
						break;
				}

				foreach ($methods as $method) 
				{
					$name = $method['name'];

					$prefix = strtolower (substr ($name, 0, 4)); // get the prefix (set_ || get_)
					$prop = substr ($name, 4); // delete prefix in the property
					
					$isSetMethod = !($prefix == 'set_' && $isSet);
					$isGetMethod = !($prefix == 'get_' && $isGet);
					
					if (($isSetMethod && $isGetMethod) && in_array ($method ['type'], array('', 'public')))
					{
						$inline = $method['name'].' ( '. complete_Funcs::getInline($method['params'], $method['defaults']) .' )';
						if (count($method['params']) == 0)  {
							$method['name'] .= '()';
						}
						
						$result[] = array('PROP' => $name, 'INLINE' => $inline);
					}
				}
                
                break;
            }
        }
        
        return $result;
    }
    
    
    function getDynPropsInfo ($x_class)
	{
        $result = array();
        $x_class  = strtolower($x_class);
        $info   = complete_Funcs::getFormFunctions();

        $tmp_exists = array();
        
        foreach ($info as $class){
            
            if (!$class['info']) 
				continue;
			
            if (strtolower($class['NAME']) == $x_class) 
			{
                $methods = (array) $class['info']['methods'];

				foreach ($methods as $method) {
					if ($isSet = (strtolower($method['name']) == '__set'))
						break;
				}
				
				foreach ($methods as $method) {
					if ($isGet = (strtolower($method['name']) == '__get'))
						break;
				}


				foreach($methods as $method) 
				{
					$name = $method['name'];
					$prefix = strtolower (substr ($name, 0, 4));
					$prop = substr($name, 4);
					
					$isSetMethod = ($prefix == 'set_' && $isSet);
					$isGetMethod = ($prefix == 'get_' && $isGet);
					
					if (($isSetMethod || $isGetMethod) && in_array ($method['type'], array('', 'public')) && !in_array($prop, $tmp_exists) )
					{
						$tmp_exists[] = $prop;
						
						$inline = $name.' ( '. complete_Funcs::getInline ($method ['params'], $method['defaults']) .' )';
						$result[] = array('PROP' => $prop, 'CAPTION' => $inline);
					}
				}
				
				$props = (array) $class['info']['properties'];
				
				foreach ($props as $prop)
				{
					if ($prop['type'] == 'public' && !in_array($prop['name'], $tmp_exists)) {
						$inline = $prop['name'];
						$result[] = array('PROP' => $prop['name'], 'CAPTION' => ' public property');
					} 
					
				}
				
                break;
            }
        }

        return $result;
    }
    
    
    // возвращаем список для инлайна
    function getList($lineText){
        
        
        preg_match_all('%c\(\"([a-z0-9\_\-\>]+)\"\)%i', $lineText, $arr);
        $class = self::getClass($arr[1][0]);
           
        return self::_getList($class);
    }
}