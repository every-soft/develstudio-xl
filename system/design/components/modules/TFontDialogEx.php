<?

class TFontDialogEx extends __TNoVisual 
{
    public $class_name_ex = __CLASS__;

    public function __construct($owner=nil,$init=true,$self=nil){
        parent::__construct($owner, $init, $self);
          
        if ($init)
		{
            $this->maxFontSize = 0;
            $this->minFontSize = 0;
            $this->device = fdScreen;
			$this->options = 'fdEffects';
        }
    }
    
    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
		
        $md = new TFontDialog($this->parent);
        $md->minFontSize = $this->minFontSize;
        $md->maxFontSize = $this->maxFontSize;
        $md->device      = $this->device;
		$md->options = $this->options;
        
        $tmp = $this->name;
        $this->name = '';
        $md->name = $tmp;
		
        eventEngine::updateIndex($md);
    }
}

?>