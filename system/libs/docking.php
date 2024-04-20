<?

class TDockTabSet extends TControl { 
    public $class_name = __CLASS__;
}

# class TTabSet extends TControl {

class Docking {
    
    static function saveFile($panel, $file){
        $panel->dockSaveToFile($file);
    }
    
    static function loadFile($panel, $file){
        $panel->dockLoadFromFile($file);
    }
}