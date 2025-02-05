<?

class TDirDialogEx extends __TNoVisual 
{
    public $class_name_ex = __CLASS__;
	
	function execute()
	{
		
		$result = '';
		$title  = $this->title ? $this->title : '';
		
		$root   = $this->root ? $this->root : '';
                
		if (selectDirectory($title, $root, $result))
		{
            $result = replaceSr($result);
			$this->filename = $result;
			$this->result   = $result;
			
			return true;
		}
		
		return false;
     }

	public function __construct($owner=nil,$init=true,$self=nil)
	{
		parent::__construct($owner, $init, $self);
		
		if ($init) {
			$this->title = '';
			$this->root  = '';
		}
	}
}

?>