<?

class TColorDialogEx extends __TNoVisual {
    
    public $class_name_ex = __CLASS__;

    public function __construct($owner = nil, $init = true, $self = nil)
	{
        parent::__construct($owner, $init, $self);
          
        if ($init)
		{
            $this->color = 0x0;
        }
    }
    
    public function __initComponentInfo()
	{
        parent::__initComponentInfo();
		
        $md = new TColorDialog($this->parent);
        $md->color = $this->color;
        $md->smallMode = $this->smallMode;
		$md->options = $this->options;
        
        $tmp = $this->name;
        $this->name = '';
        $md->name = $tmp;
		
        eventEngine::updateIndex($md);
    }
}
?>