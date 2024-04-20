<?

class ThreadObjectReceiver
{
	private static $block = array();
	private $name;
	
	public function __construct($name)
	{
		$this->name = $name;
	}

	public static function c($name, $block = false)
	{
		if ($key = $GLOBALS['THREAD_SELF']) 
		{
			if ($block) 
			{
				$block = ($block < 10 ? 10 : $block) * 1000;
				while (SyncEx('ThreadObjectReceiver::block', array($name, $key)) !== 'true') 
				{
					usleep($block);
				}
			}
			
			if (isset($GLOBALS['___t_self'][$name])) 
			{
				if (empty($GLOBALS['___t_self'][$name])) 
				{
					$GLOBALS['___t_self'][$name] = new ThreadObjectReceiver($name);
				}
			}
			else {
				$GLOBALS['___t_self'][$name] = new ThreadObjectReceiver($name);
			}
			
			return $GLOBALS['___t_self'][$name];
		} 
		else {
			if (!isset($GLOBALS['___t_objects'][$name])) 
			{
				$GLOBALS['___t_objects'][$name] = c($name, 0);
			}
			
			return $GLOBALS['___t_objects'][$name];
		}
	}


	public static function unBlock($name)
	{
#		if($GLOBALS['THREAD_SELF']) {
#			Sync('ThreadObjectReceiver::unBlock', [$name]);
#		} else {
			self::$block[$name] = null;
#		}
	}


	public static function block($name, $id)
	{
		if (!empty (self::$block[$name]) && self::$block[$name] !== $id) 
		{
			return 'false';
		}
		
		self::$block[$name] = $id;
		return 'true';
	}


	public function __get($name)
	{
		return SyncEx('ThreadObjectReceiver::get', array($this->name, $name));
	}


	public static function get($name, $property)
	{
		if (!isset($GLOBALS['___t_objects'][$name])) 
		{
			$GLOBALS['___t_objects'][$name] = c($name, 0);
		}
		
		$GLOBALS['APPLICATION']->processMessages();
		return $GLOBALS['___t_objects'][$name]->$property;
	}


	public function __set($name, $value)
	{
		Sync('ThreadObjectReceiver::set', array($this->name, $name, $value));
	}


	public static function set($name, $property, $value)
	{
		if (!isset($GLOBALS['___t_objects'][$name])) 
		{
			$GLOBALS['___t_objects'][$name] = c($name, 0);
		}
		
		if (is_object($value)) 
		{
			$GLOBALS['___t_objects'][$name]->$property = ($value instanceof ThreadObjectReceiver) ? $value->__get_self() : $value;
		} 
		else {
			$GLOBALS['___t_objects'][$name]->$property = $value;
		}
		
		$GLOBALS['APPLICATION']->processMessages();
	}


	public function __call($name, $args)
	{
		return SyncEx('ThreadObjectReceiver::call', array($this->name, $name, $args));
	}


	public static function call($name, $method, $args)
	{
		if (!isset($GLOBALS['___t_objects'][$name])) 
		{
			$GLOBALS['___t_objects'][$name] = c($name, 0);
		}
		
		$res = call_user_func_array(array($GLOBALS['___t_objects'][$name], $method), $args);
		$GLOBALS['APPLICATION']->processMessages();
		
		return $res;
	}
	
	public function __toString()
	{
		return SyncEx(__CLASS__ . '::toString', array($this->name));
	}
	
	public static function toString($name)
	{
		if (!isset($GLOBALS['___t_objects'][$name])) 
		{
			$GLOBALS['___t_objects'][$name] = c($name, 0);
		}
		
		return method_exists($GLOBALS['___t_objects'][$name], '__toString()') ? call_user_func_array(array($GLOBALS['___t_objects'][$name], $method), array()) : print_r($GLOBALS['___t_objects'][$name], true);
	}
	
	public function __get_self()
	{
		return c($this->name, 0);
	}
	
	public function valid()
	{
		return true;
	}
}

class DebugClassException extends Exception {

}


class DebugClass {
	
	public $self = 0;
	public $nameParam = '';
	
	public function __construct($name){
		if (is_numeric($name))
			$this->nameParam = syncEx('gui_propGet', array($name, 'name'));
		else
			$this->nameParam = $name;
	}
	
	public function __set($name, $value){
		trigger_error(t('Component "%s" not found for set "%s" property', $this->nameParam, $name), E_USER_ERROR);
	}
	
	public function __get($name){
		
		trigger_error(t('Component "%s" not found for get "%s" property', $this->nameParam, $name), E_USER_ERROR);
	}
	
	public function __call($name, $args){
		
		trigger_error(t('Component "%s" not found for call "%s" method', $this->nameParam, $name), E_USER_ERROR);
	}
	
	public function valid(){
		return false;
	}
}

class ThreadDebugClass extends DebugClass {
	
	public function __set($name, $value){
		trigger_error(t('Change the GUI in the thread forbidden - SET "%s"->"%s" = ...', $this->nameParam, $name), E_USER_ERROR);
	}
	
	public function __get($name){
		trigger_error(t('Change the GUI in the thread forbidden - GET "%s"->"%s"', $this->nameParam, $name), E_USER_ERROR);
	}
	
	public function __call($name, $args){
		trigger_error(t('Change the GUI in the thread forbidden - CALL "%s"->"%s()"', $this->nameParam, $name), E_USER_ERROR);
	}
}