<?

class TDropFiles extends __TNoVisual 
{ 
    public $class_name_ex = __CLASS__;

    public function __initComponentInfo(){
        
        parent::__initComponentInfo();
		
        $md = new TDropFilesTarget($this->parent);
        $md->OnDropFiles = $this->OnDropFiles;
        $md->enabled = $this->enabled;
        
        $tmp = $this->name;
        $this->name = '';
        $md->name = $tmp;
		
        eventEngine::updateIndex($md);
    }
}
?>