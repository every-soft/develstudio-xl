<?

/*
    SoulEngine ConfigIni library
    
    2009.04 v0.1

    Dim-S Software (c) 2009
*/

class __ini 
{
    var
        
		/* public settings */
        $parse_constants = true,
        $use_defaults = true,

		/* 'private' settings */
        $_ini_loaded = false,
        $_default_loaded = false,
        
        $_error_pattern = '[ini] %s',

        $_settings = array (
            'ini' => array (),
            'default' => array ()
        )
    ;

	/**
	 * constructor ini ( [ string ini_file = NULL [, string default_file = NULL] ] )
	 */
    function ini ($ini_file = null, $default_file = null) 
	{
    
        if (!is_null ($ini_file)) 
		{
            $this->read_ini ($ini_file, false);
            
            if (!is_null ($default_file)) 
                $this->read_defaults ( $default_file );
        }
    }
	
    
	/**
	 * mixed get ( string key [, string section = NULL] )
	 */
    function get ($key, $section = null) 
	{
    
		/**
		 * if a value for given key (and section) exists -> return it
		 * else if $use_defaults is TRUE return the default setting ( if any )
		 */
        $ini_value = $this->_get_value ($key, 'ini', $section);
        $def_value = $this->_get_value ($key, 'default', $section);
     
        if (is_null ($ini_value) && $this->use_defaults) 
		{
            return $def_value;
        
        } else {
            return $ini_value;
        }
    
    }

	/**
	 * private mixed _get_value ( string key, string type [, string section = NULL] )
	 * (needs to be improved!)
	 */
    function _get_value ($key, $type, $section = null) 
	{
    
    /**
     * return the value; if it does not exist return NULL
     */
        if (is_null ($section)) 
		{
        
            /* if (isset ($this->_settings[$type][$key])) 
			{
                return $this->_settings[$type][$key];
                
            } else {
            
                return NULL;
            } */
			
			return isset ($this->_settings[$type][$key]) ? $this->_settings[$type][$key] : null;
        
        }
        else {

            /* if (isset ($this->_settings[$type][$section][$key]))
			{
                return $this->_settings[ $type ][ $section ][ $key ];
                
            }
            else {
            
                return NULL;
                
            } */
				
			return isset ($this->_settings[$type][$section][$key]) ? $this->_settings[$type][$section][$key] : null;
        
        }
    
    }
 
	/**
	 * mixed read_ini ( string filename [, boolean return_ini = FALSE ] )
	 */
    function read_ini ( $filename, $return_ini = false ) 
	{
        if ($content = $this->_read_file ($filename)) 
		{
            $this->_settings['ini'] = $this->_parse ($content);
            $this->_ini_loaded = true;
            
            /* if ( $return_ini ) {
            
                return $this->_settings[ 'ini' ];
                
            }
            else {
            
                return TRUE;
                
            } */
				
			return $return_ini ? $this->_settings['ini'] : true;
        
        }
        else {
        
            return FALSE;
            
        }
    
    }
	
    
	/**
	 * boolean read_defaults ( string filename )
	 */
    function read_defaults ( $filename ) 
	{
	   if ($content = $this->_read_file ($filename)) 
	   {
			$this->_settings[ 'default' ] = $this->_parse ( $content );
			$this->default_loaded = TRUE;
		
			return true;
            
        }
        else {
        
            return false;
            
        }
    }
    
	/**
	 * private string _read_file ( string filename )
	 */
    function _read_file ($filename) 
	{
        if (!file_exists ($filename)) 
		{
            trigger_error ($this->_errstr ('File does not exist: "' . $filename . '"'), E_USER_ERROR);
            return false;
        
        }
    
        $content = @file ($filename);
        
        if (!is_array ($content)) 
		{
            trigger_error ( $this->_errstr ( 'an error occured while reading "' . $filename . '"' ), E_USER_ERROR );
            return false;
            
        }
        
        return join ('', $content);
    
    }
    
	/**
	 * private mixed _parse ( & string content )
	 */
    function _parse (&$str_content) 
	{
		/**
		 * required vars
		 */
        $comments = array ( '/#[^\n]*/', '/\/\/[^\n]*/');
        $ini = array ();
        $arr_content = array ();

        $current_section    = false;

        $line = '';
        $key = '';
        $value = '';
        
		// replace microsoft-style-newlines
        $str_content = str_replace ("\r\n", "\n", $str_content);
        
		// remove comments... 
        $str_content = preg_replace ($comments, '', $str_content);
        
		// create array from $content separate by newline
        $str_content = split ("\n", $str_content);

		// no we do the real parsing... 
        foreach ($str_content as $key => $line) 
		{
            $line = trim ($line);        

            if (!empty ($line)) 
			{
                // if the line contains a section we set it as the current one            
                if (preg_match ('/(?:\[)(.*)(?=])/', $line, $matches)) 
				{
                    $current_section = $matches[ 1 ];
                }
                
                // if it has a definition like foo = bar we set this
                elseif ( preg_match ( '/(.+)(?:=)(.+)/', $line, $matches ) ) {
                
                    $key = trim ($matches[1]);
                    $value = trim ($matches[2]);

                    // if value is enclosed in quotes we just remove them;                    
                    if (preg_match ( '/(^".*"$)|(^\'.*\'$)/', $value)) 
					{
                        $value = substr ( $value, 1, -1 );
                        
                    }
                    
                    // otherwise if parse_constants is TRUE we look if
                    // there is a matching constant for value
                    elseif ($this->parse_constants) 
					{
                        if (defined ($value)) 
						{
                            $value = constant ( $value );  
                        }
                    
                    }
                    
                    // adding key = value to the ini array; if cuurent section
                    // is set we put it into that branch
                    if ($current_section === false) 
					{
                        $ini[$key] = $value;
                        
                    }
                    else {
                        $ini[$current_section][$key] = $value;
                        
                    }
                                    
                }
				
            }
        }
        
        return $ini;
        
    }
    
	/**
	 * private string _errstr ( string message ) 
	 */
    function _errstr ($message) 
	{
    
        return sprintf ( 
            $this->_error_pattern, $message
        );
    
    }
    
}


class TIniFile 
{
    
    public $values;
    protected $ini;
        
    function __construct($file = '', $with_kavs = false)
	{
        $this->ini = new __Ini;
       
        if (file_exists($file))
           $this->loadFromFile($file, $with_kavs);
    }
    
    function loadFromFile($file, $with_kavs = false, $return = true)
	{
        $file = replaceSl($file);
		
        if (!file_exists($file)) 
			return;
		
        $this->values = $this->ini->read_ini($file, true);
        
        if ($with_kavs){
            
            foreach ($this->values as $i => $val)
			{
                foreach ($val as $k => $v){
                    $v[0]            = ' ';
                    $v[strlen($v)-1] = ' ';
                    $this->values[$i][$k] = trim($v);
                }
            }
        }
        
        if ($return)
            return $this->values;
    }
    
    function loadFile($file)
	{
        
       return $this->loadFromFile($file);
    }
    
    function sections()
	{
        return array_keys($this->values);
    }
    
    function getSection($section)
	{
        return (array)$this->values[$section];    
    }
    
    function saveToFile($file)
	{
        
        $file = replaceSl($file);
        $result = '';
        
        foreach ($this->values as $section => $val)
		{
            
            if (!is_array($val)) 
				continue;
            
            $result .= '[' . $section . ']' . _BR_;
            foreach ($val as $k => $v)
                $result .= $k .'='.$v . _BR_;
            
            $result .= _BR_;
        }
        
		//if (is_writable ($file))
			return file_put_contents($file, $result);
    }
}

class TConfigIni extends TConfig 
{
    public $class_name = __CLASS__;
    public $ini;
    
    protected $_result;
    
    
    public function __construct(array $data = array())
	{
        parent::__construct($data);
		
        $this->ini = new TIniFile;
        //$this->ini->values =& $this->_data;
    }
    
    function saveToFile($filename)
	{
        $this->ini->values = $this->toArray();
        $this->ini->saveToFile($filename);
    }
    
    function loadFromFile($filename)
	{
        $arr2 = $this->toArray();
        $arr = (array) $this->ini->loadFromFile($filename);
        
        foreach ($arr as $k => $v)
		{
           if (is_array($v))
           foreach ($v as $key => $value)
                $arr2[$k][$key] = $value;
        }
        
        $this->setArray($arr2);
    }
}

function iniConfiger(TConfig $cfg = null)
{
    $result = new TConfigIni;
    if ($cfg != null)
	{
        $result->setArray($cfg->toArray());
    }
    
    return $result;
}