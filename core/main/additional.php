<?

/*

	Edited by Every Software (c) 2021
	For DevelStudio XL
	
*/

/*
  
  SoulEngine Additional Library
  
  2009 ver 0.1
  
  Dim-S Software (c) 2009
  
				TTrayIcon, TBalloonHint, TMaskEdit,
                TStringGrid, TStringGridStrings,
                TDrawGrid, TImage, TShape, TBevel,
                TScrollBox, TCheckListBox, TSplitter,
                TStaticText, TLinkLabel, TControlBar,
                TValueListEditor, TValueListStrings,
                TLabeledEdit, TColorBox, TColorListBox,
                TDockTabSet, TTabSet, THotKey
  
*/

global $_c;

$_c->setConstList (array ('poNone', 'poPrintToFit', 'poProportional'), 0);
$_c->setConstList (array ('dkDock', 'dkDrag'), 0);
$_c->setConstList (array ('dmActiveForm', 'dmDesktop', 'dmMainForm', 'dmPrimary'), 0);
$_c->setConstList (array ('dmManual', 'dmAutomatic'), 0);
$_c->setConstList (array ('bsLowered', 'bsRaised'), 0);
$_c->setConstList (array ('bkNone', 'bkTile', 'bkSoft', 'bkFlat'), 0);
$_c->setConstList (array ('tpTop', 'tpBottom', 'tpLeft', 'tpRight'), 0);
$_c->setConstList (array ('rsLine', 'rsNone', 'rsPattern', 'rsUpdate'), 0);
$_c->setConstList (array ('ptBottom', 'ptLeft', 'ptNone', 'ptRight', 'ptTop'), 0);
$_c->setConstList (array ('stBoth', 'stData', 'stNone', 'stText'), 0);
$_c->setConstList (array ('fpDefault', 'fpVariable', 'fpFixed'), 0);
$_c->setConstList (array ('psDefault', 'psOffice2003', 'psOffice2007', 'psWhidbey'), 0);
$_c->setConstList (array ('udRight', 'udLeft'), 0);
$_c->setConstList (array ('udHorizontal', 'udVertical'), 0);

$_c->setConstList (array ('cbStandardColors',
							'cbExtendedColors',
							'cbSystemColors',
							'cbIncludeNone',
							'cbIncludeDefault',
							'cbCustomColor',
							'cbPrettyNames'), 0);
							
$_c->setConstList (array ('pmDefault','pmInches','pmMillimeters'), 0);
$_c->setConstList (array ('mbNone, mbBreak, mbBarBreak'), 0);
$_c->setConstList (array('bkCustom', 'bkOK', 'bkCancel', 'bkHelp',
									'bkYes', 'bkNo', 'bkClose', 'bkAbort',
									'bkRetry', 'bkIgnore', 'bkAll'), 0);


////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//TAlign = (alNone, alTop, alBottom, alLeft, alRight, alClient, alCustom);
$_c->setConstList (array ('alNone', 'alTop', 'alBottom', 'alLeft', 'alRight', 'alClient', 'alCustom'), 0);
$_c->setConstList (array ('tsTabs', 'tsButtons', 'tsFlatButtons'), 0);
$_c->setConstList (array ('lbStandard', 'lbOwnerDrawFixed', 'lbOwnerDrawVariable',
    'lbVirtual', 'lbVirtualOwnerDraw'), 0);
$_c->setConstList (array ('cbUnchecked', 'cbChecked', 'cbGrayed'), 0);

$_c->setConstList (array ('trHorizontal', 'trVertical'), 0);
$_c->setConstList (array ('tmBottomRight', 'tmTopLeft', 'tmBoth'), 0);
$_c->setConstList (array ('tsNone', 'tsAuto', 'tsManual'), 0);

$_c->setConstList (array ('sbHorizontal', 'sbVertical'), 0);
$_c->setConstList (array ('scLineUp', 'scLineDown', 'scPageUp', 'scPageDown', 'scPosition',
    'scTrack', 'scTop', 'scBottom', 'scEndScroll'), 0);

$_c->setConstList (array ('dfShort','dfLong'), 0);
$_c->setConstList (array ('dmComboBox','dmUpDown'), 0);
$_c->setConstList (array ('dtkDate','dtkTime'), 0);

$_c->setConstList (array ('bsBox', 'bsFrame', 'bsTopLine', 'bsBottomLine', 'bsLeftLine',
                                'bsRightLine', 'bsSpacer'), 0);
								
$_c->setConstList (array ('sbsNone', 'sbsSingle', 'sbsSunken'), 0);		
$_c->setConstList (array ('beLeft', 'beRight', 'beBottom', 'beTop'), 0);

/* ****************************************************** */
class TUpDown extends TControl
{
	public $class_name = __CLASS__;

	public function get_type()
	{
		return $this->orientation;
	}

	public function set_type($v)
	{
		$type = constant($this->orientation);
		
		if($v !== $type)
		{
			$w = $this->w;
			$h = $this->h;
			
			$this->orientation = (int) $v;
			
			$this->w = $h;
			$this->h = $w;
		}
		
		
	}
}

class TMonthCalendar extends TControl{
	public $class_name = __CLASS__;
    
    public function get_date(){
		
		return datetime_str($this->get_prop('date'));
	}
	
	function set_date($v){ $this->set_prop('date', str_datetime($v)); }
    

	
	function get_maxDate(){ return datetime_str($this->get_prop('maxDate'));}
	function get_minDate(){ return datetime_str($this->get_prop('minDate'));}
	function set_maxDate($v){ $this->set_prop('maxDate', str_datetime($v)); }
	function set_minDate($v){ $this->set_prop('minDate', str_datetime($v)); }
}

// from: /system/modules/anovisual.php
class __TNoVisual extends TControl {
    
    public $class_name = __CLASS__;
    
    function __initComponentInfo($init = true){
		$this->hide();
    }
    
    
    public function __construct($onwer=nil,$init=true,$self=nil){
        
		parent::__construct($onwer, $init, $self);

	    if ($init){
			$this->realWidth  = 26;
			$this->realHeight = 26;

			$this->showHint = true;
			$this->hint = $this->name;

	        if ($GLOBALS['APP_DESIGN_MODE']){
	            $this->__loadDesign();
	        }

	    }
    }
    
    public function __updateDesign(){
	
		$this->toFront();
		$this->initLabel();
    }
    
    static function __doMouseEnter($self){
	
		_c($self)->initLabel();
    }
    
    static function __doMouseLeave($self){
	
		$obj = _c($self);
		$obj->panel->free();
		$obj->panel = '';
		$obj->label = '';
    }
    
    public function __loadDesign(){	
	
		$this->setImage(myImages::get24($this->class_name_ex));
		$this->onDblClick = '__TNoVisual::panelDblClick';
    }
    
    public function __pasteDesign(){	
	
		$this->setImage(myImages::get24($this->class_name_ex));
		$this->onDblClick = '__TNoVisual::panelDblClick';
    }
        
    function set_visible($v){
		$this->set_prop('visible', (bool)$v);
    }
	
    function get_visible(){
		return $this->get_prop('visible');
    }
    
    static function panelDblClick($self){
	
		$name = inputText(t('To change name of object'),t('New Name'),_c($self)->caption);
	
		if ($name){
	    
			if (!eregi('^[a-z]{1}[a-z0-9\_]*$',$name)) return;
			
			myDesign::changeName(_c(_c($self)->obj), $name);
			global $myProperties;
			$myProperties->updateProps();
		}
    }
    
    
    static function panelClick($self){
	
		global $_sc;
		$_sc->clearTargets();
			
		myDesign::selectComponent($_sc->self, _c($self)->obj, 0, 0);
		_c(_c($self)->obj)->toFront();
		_c(_c(_c($self)->obj)->panel)->toFront();
		$_sc->addTarget(_c(_c($self)->obj));
    }
    
    function initLabel($self = false){
	    
		return;
    }
    
    public function setImage($file){	

		if (!file_exists($file))
			$file = myImages::get24('component');
		
		$this->__iconName = replaceSr($file);
    }
}

/* ****************************************************** */

class TCoolTrayIcon extends TControl {
	public $class_name = __CLASS__;
	protected $_picture;
	protected $_icon;
	
	public function get_picture(){
		
		if (!isset($this->_picture)){
			$this->_picture = new TIcon(false);
			$this->_picture->self = __rtii_link($this->self,'Icon');
			$this->_picture->parent_object = $this->self;
		}
		
		return $this->_picture;
	}
	
	public function get_icon(){
		return $this->picture;
	}
	
	public function loadPicture($file){
		
		$this->picture->loadAnyFile($file);
	}
	
	public function loadFromBitmap($bt){
		
		$this->picture->assign($bt);
	}
	
	public function set_iconFile($v){
		
		$this->aiconFile = $v;
		$v = getFileName($v);
		if (!file_exists($v)) return;
		
		$this->loadPicture($v);
	}
	
	public function get_iconFile(){
		return $this->aiconFile;
	}
	
	public function get_hint(){
		return $this->get_prop('hint');
	}
	
	public function set_hint($v){
		$this->set_prop('hint',$v);
	}
	
	public function assign($icon){
		trayicon_assign($this->self, $icon->self);
	}
	
	public function showBalloonTip(){
		
		return trayicon_balloontip($this->self, $this->title, $this->text, $this->flag, $this->timeout);
	}
	
	public function hideBalloonTip(){
		return trayicon_hideballoontip($this->self);
	}
}

class TTrackBar extends TControl {
	public $class_name = __CLASS__;
}


class THotKey extends TControl {
	public $class_name = __CLASS__;
	
	public function set_hotKey($sc){
		
		if (!is_numeric($sc))
			$sc = text_to_shortcut(strtoupper($sc));
		$this->set_prop('hotKey',$sc);
	}
	
	public function get_hotKey(){
		
		$result = $this->get_prop('hotKey');
		return shortCut_to_text($result);
	}
}



class TMaskEdit extends TControl {
	public $class_name = __CLASS__;
}


class TImage extends TControl {
	public $class_name = __CLASS__;
	protected $_picture;
	
	public function get_picture(){
		
		if (!isset($this->_picture)){
			$this->_picture = new TPicture(false);
			$this->_picture->self = __rtii_link($this->self,'Picture');
			$this->_picture->parent_object = $this->self;
		}
		
		return $this->_picture;
	}
	
	public function getCanvas(){
		
		$tmp = new TCanvas(false);
		$tmp->self = component_canvas($this->self);
		
		return $tmp;
	}
	
	public function loadPicture($file){
		
		$this->picture->loadAnyFile($file);
	}
	
	public function loadFromFile($file){
		$this->loadPicture($file);
	}
	
	public function loadFromBitmap($bt){
		
		$this->picture->assign($bt);
	}
	
	public function loadFromUrl($url, $ext = false){
		$this->picture->loadFromUrl($url, $ext);
	}
	
	public function saveToFile($file){
		$file = replaceSl($file);
		$this->picture->saveToFile($file);
	}
}

class TMImage extends TImage {
    
    public $class_name = __CLASS__;

    public function loadFromFileIcon ($file, $index = 0)
	{
		if (function_exists('GetIconFile'))
		{
			$this->picture->loadFromStr(GetIconFile($file, $index), 'ico');
		} else {
			MessageBox('Could not find "php_memory" module!', '', MB_ICONERROR);
		}
	}
}

class TDrawGrid extends TControl {
	public $class_name = __CLASS__;
}

class TShape extends TControl {
	public $class_name = __CLASS__;
	
	protected $_brush;
	protected $_pen;

	
	public function get_brush(){
		
		if (!$this->_brush){
			$this->_brush = new TBrush(false);
			$this->_brush->self = __rtii_link($this->self,'Brush');
		}
		return $this->_brush;
	}
	
	public function get_pen(){
		
		if (!$this->_pen){
			
			$this->_pen   = new TPen(false);
			$this->_pen->self   = __rtii_link($this->self,'Pen');
		}
		
		return $this->_pen;
	}
	
	function get_brushColor(){ return $this->brush->color; }
	function set_brushColor($v){ $this->brush->color = $v; }
	function get_brushStyle(){ return $this->brush->style; }
	function set_brushStyle($v){ $this->brush->style = $v; }
	
	function get_penColor(){ return $this->pen->color; }
	function set_penColor($v){ $this->pen->color = $v; }
	function get_penMode(){ return $this->pen->mode; }
	function set_penMode($v){ $this->pen->mode = $v; }
	function get_penStyle(){ return $this->pen->style; }
	function set_penStyle($v){ $this->pen->style = $v; }
	function get_penWidth(){ return $this->pen->width; }
	function set_penWidth($v){ $this->pen->width = $v; }
}

class TBevel extends TControl {
	public $class_name = __CLASS__;
}

class TScrollBox extends TControl 
{
	public $class_name = __CLASS__;
	protected $_constraints;

	function get_constraints()
	{
		if (!isset($this->_constraints)){
			$this->_constraints = new TSizeConstraints(nil, false);
			$this->_constraints->self = __rtii_link($this->self, 'constraints');
		}
		
		return $this->_constraints;
	}
	
	public function isVScrollShowing()
	{
		
		return scrollbox_vsshowing($this->self);
	}
	
	public function isHScrollShowing()
	{
		
		return scrollbox_hsshowing($this->self);
	}
	
	public function get_scrollBarSize()
	{
		return scrollbox_sbsize($this->self);
	}

}

class TCheckListBox extends TControl {
	public $class_name = __CLASS__;
	protected $_items;
	
	function get_items(){
		if (!isset($this->_items)){
			$this->_items = new TStrings(false);
			$this->_items->self = __rtii_link($this->self,'Items');
			$this->_items->parent_object = $this->self;
		}
		return $this->_items;
	}
	
	function isChecked($index){
		
		return checklist_checked($this->self, $index);
	}
	
	function setChecked($index, $value = true){
		checklist_setchecked($this->self, $index, $value);
	}
	
	function get_checkedItems(){
		$result = array();
		$list = $this->items->lines;
		if (count($list))
		foreach ($list as $index=>$v){
			if ($this->isChecked($index))
				$result[$index] = $v;
		}
		
		return $result;
	}
	
	function set_checkedItems($v){
		
		$list = $this->items->lines;
		
		if (count($list))
		foreach ($list as $index=>$x){
			
			$this->setChecked($index, in_array($x, $v));
		}
	}
	
	function unCheckedAll(){
		$this->checkedItems = array();
	}
	
	function checkedAll(){
		$list = $this->items->lines;
		$this->checkedItems = $list;
	}
	
	function get_itemIndex(){
		return $this->items->itemIndex;
	}
	
	function set_itemIndex($v){
		$this->items->itemIndex = $v;
	}
	
	function set_inText($v){
		$this->items->setLine($this->itemIndex, $v);
	}
	
	function get_inText(){
		return $this->items->getLine($this->itemIndex);
	}
	
	function set_text($v){
		$this->items->text = $v;
	}
	
	function clear(){
		
		$this->text = '';
	}
	
	function get_text(){
		return $this->items->text;
	}
}

class TSplitter extends TControl {
	public $class_name = __CLASS__;
}

class TStaticText extends TControl {
	public $class_name = __CLASS__;
}

class TControlBar extends TControl {
	public $class_name = __CLASS__;
}

class TValueListEditor extends TControl 
{
	public $class_name = __CLASS__;

	function get_titleCaptions()
	{
		if (!isset($this->_titleCaptions)){
			$this->_titleCaptions = new TStrings(false);
			$this->_titleCaptions->self = __rtii_link($this->self, 'TitleCaptions');
		}
		return $this->_titleCaptions;
	}
	
	function get_strings()
	{
		if (!isset($this->_strings)){
			$this->_strings = new TStrings(false);
			$this->_strings->self = __rtii_link($this->self, 'Strings');
		}
		return $this->_strings;
	}
	
	function get_text()
	{
		return $this->strings->text;
	}
	
	function set_text($v)
	{
		$this->strings->text = $v;
	}
}

class TLabeledEdit extends TControl {
	public $class_name = __CLASS__;
}

class TColorBox extends TControl {
	public $class_name = __CLASS__;
}

class TColorListBox extends TControl {
	public $class_name = __CLASS__;
}

class TStatusBar extends TControl {
	public $class_name = __CLASS__;
	
	function __construct($owner=nil,$init=true,$self=nil){
		parent::__construct($owner,$init,$self);
		
		if ($init){
			$this->useSystemFont = false;
			$this->simplePanel   = true;
		}
	}
}

class TTabSet extends TControl {
	public $class_name = __CLASS__;
}


class TTabControl extends TControl {
	public $class_name = __CLASS__;
	protected $_tabs;
	
	function get_tabs(){
		if (!isset($this->_tabs)){
			$this->_tabs = new TStrings(false);
			$this->_tabs->self = gui_propGet($this->self,'tabs');
			$this->_tabs->parent_object = $this->self;
		}
		return $this->_tabs;
	}
	
	function addPage($caption){
		
		$tabs = $this->tabs;
		$tabs->add($caption);
	}
	
	
	function indexOfTabXY($x, $y){
		
		return tabcontrol_indexofxy($this->self, $x, $y);
	}
	
	function set_text($v){
		$this->tabs->text = $v;
	}
	
	function get_text(){
		return $this->tabs->text;
	}
}

class TPageControl extends TControl 
{
	public $class_name = __CLASS__;
	public $pages;
	
	function __loadDesign()
	{
		$this->__initComponentInfo();
	}
	
	function __initComponentInfo()
	{
		$index = (int) $this->apageIndex;
		
		if ($index == 0)
		{
			if ($this->pageCount == 1)
			{
				$this->addPage('-');
				$this->pageIndex = 1;
				$this->pageIndex = $index;
				$this->delete(1);
				
			} else {
				$this->pageIndex = 1;
				$this->pageIndex = $index;
			}
			
		} else {
			$this->pageIndex = $index;
		}
		
	}
	
	function set_ActivePage($page)
	{
		pagecontrol_activepage($this->self, $page->self);
		$this->apageIndex = $this->pageIndex;
	}
	
	function get_ActivePage()
	{
		return _c(pagecontrol_activepage($this->self, null));
	}
	
	function addPage($caption)
	{
		$p = new TTabSheet(_c($this->owner));
		$p->parent = $this;
		$p->parentControl = $this;
		$p->caption = $caption;
		$p->doubleBuffered = true;
		$p->aenabled = true;
		$p->avisible = true;
		
		return $p;
	}
	
	function get_pageCount()
	{
		return pagecontrol_pagecount($this->self);
	}
	
	function pages()
	{
		$c = $this->pageCount;
		
		for ($i = 0; $i < $c; $i++)
			$result[] = _c(pagecontrol_pages($this->self, $i));
		
		return $result;
	}
	
	function set_pageIndex($v)
	{
		$pages = $this->pages();
		
		if ($pages[$v])
		{
			$this->ActivePage = $pages[$v];
			$pages[$v]->visible = true;
		}
	}
	
	function get_pageIndex()
	{
		$a_page = $this->ActivePage;
		$pages  = $this->pages();
		
		for ($i = 0, $c = sizeof($pages); $i < $c; ++$i)
		{
			if ($pages[$i]->self == $a_page->self)
				return $i;
		}
		
		return -1;
	}
	
	function set_pagesList($arr)
	{
		if (!is_array($arr))
			$arr = explode(_BR_, $arr);
		
		foreach ($arr as $i => $el)
		{
			if ($el)
				$tmp[] = trim($el);
		}
		
		unset($arr);
		$arr =& $tmp;
		
		$pages = $this->pages();
		
		for ($i = 0, $c = sizeof($pages); $i < $c; ++$i)
		{
			if (sizeof($arr)-1 < $i)
			{
				$pages[$i]->free();
			}
			else {
				$pages[$i]->caption = $arr[$i];
			}
		}
		
		for ($i = sizeof($pages)-1; $i < sizeof($arr)-1; ++$i)
			$this->addPage($arr [$i+1]);
		
	}
	
	function get_pagesList()
	{
		$pages = $this->pages();
		$result = array();

		for ($i = 0, $c = sizeof($pages); $i < $c; ++$i)
		{
			$result[] = $pages[$i]->caption;
		}
		
		return join (_BR_, $result);
	}
	
	function clear()
	{
		$pages = $this->pages();
		
		for ($i = 0, $c = sizeof($pages); $i < $c; ++$i)
			$pages[$i]->free();
	}
	
	function delete($index)
	{
		$pages = $this->pages();
		
		if ($pages[$index])
			$pages[$index]->free();
	}
	
}

class TTabSheet extends TControl {
	public $class_name = __CLASS__;
	
	function set_parentControl($obj){
		tabsheet_parent($this->self, $obj->self);
	}
	
	function get_parentControl(){
		return _c(tabsheet_parent($this->self,0));
	}
	
	function free(){
		
		foreach ($this->componentList as $el)
			$el->free();
			
		parent::free();
	}
}


class TSizeConstraints extends TComponent {
	
	public $class_name = __CLASS__;
	
	#maxWidth
	#maxHeight
	#minWidth
	#minHeight

}

class TPadding extends TControl {
	
	public $class_name = __CLASS__;
}

class TListItems extends TControl 
{
	public $class_name = __CLASS__;
	
	function delete($index){ listitems_command($this->self, __FUNCTION__, $index,0); }
	function add(){ return _c(listitems_command($this->self, __FUNCTION__,0,0)); }
	function clear(){ listitems_command($this->self, __FUNCTION__,0,0); }
	function addItem($item, $index) { return _c(listitems_command($this->self, __FUNCTION__, $item->self, $index)); }
	function indexOf($item) { return listitems_command($this->self, __FUNCTION__, $item->self, 0); }
	function insert($index) { return _c(listitems_command($this->self, __FUNCTION__, $index, 0)); }
	
	function count(){ return listitems_command($this->self, __FUNCTION__, 0, 0); }
	function get($index){ return _c(listitems_command($this->self, __FUNCTION__, $index, 0)); }
	
	function get_selected()
	{
		$result = array();
		$arr = explode(',', listitems_command($this->self, 'selected', 0,0));
		
		foreach ($arr as $el) if ($el!='')
			$result[] = $el;
		
		return $result;
	}
	
	function set_selected($var)
	{
			
		foreach ($var as $k=>$v)
			listitems_selected($this->self, $k, $v);
	}
	
	function select($index)
	{
		listitems_selected($this->self, $index, true);
	}
	
	function unSelect($index)
	{
		listitems_selected($this->self, $index, false);
	}
	
	function unSelectAll()
	{
		$c = $this->count();
		for($i=0; $i<$c-1; $i++)
			$this->unSelect($i);
	}
	
	function selectAll()
	{
		$c = $this->count();
		for($i=0; $i<$c-1; $i++)
			$this->select($i);
	}
	
	function indexByCaption($caption)
	{
		
		$c       = $this->count();
		$caption = strtolower($caption);
		
		for ($i=0; $i<$c; $i++){
			
			$item = $this->get($i);
			if (strtolower($item->caption)==$caption)
				return $i;
		}
		
		return -1;
	}
	
	function selectByCaption($caption)
	{
		
		if (is_array($caption)){
			$this->unSelectAll();
			if (count($caption)){
			foreach ($caption as $el){
				$index = $this->indexByCaption($el);
				if ($index > -1)
					$this->select($index);
			}
			}
		} else {
			$index = $this->indexByCaption($caption);
			$this->unSelectAll();
			if ($index > -1)
				$this->select($index);
		}
	}
	
	function get_selectedCaption()
	{
		
		$arr    = $this->selected;
		$result = array();
		foreach ($arr as $id){
			
			$result[] = $this->get($id)->caption;
		}
		return $result;
	}
	
	function set_selectedCaption($caption)
	{
		$this->selectByCaption($caption);
	}
}

class TListItem extends TControl 
{
	public $class_name = __CLASS__;
	
	function delete(){ listitem_command($this->self, __FUNCTION__); }
	function update(){ listitem_command($this->self, __FUNCTION__); }
	function canceledit(){ listitem_command($this->self, __FUNCTION__); }
	function editcaption(){ return listitem_command($this->self, __FUNCTION__); }
	
	function get_index(){ return listitem_prop($this->self, __FUNCTION__, null);}
	function get_selected() { return listitem_prop($this->self, __FUNCTION__, null);}
	
	function get_imageindex() {return listitem_prop($this->self, __FUNCTION__, null);}
	function get_stateindex() {return listitem_prop($this->self, __FUNCTION__, null);}
	function get_indent() {return listitem_prop($this->self, __FUNCTION__, null);}
	function get_caption() {return listitem_prop($this->self, __FUNCTION__, null);}
	function get_checked() {return listitem_prop($this->self, __FUNCTION__, null);}
	
	function set_imageindex($v) {listitem_prop($this->self, __FUNCTION__, $v);}
	function set_stateindex($v) {listitem_prop($this->self, __FUNCTION__, $v);}
	function set_indent($v) {listitem_prop($this->self, __FUNCTION__, $v);}
	function set_caption($v) {listitem_prop($this->self, __FUNCTION__, $v);}
	function set_checked($v) {listitem_prop($this->self, __FUNCTION__, $v);}
	
	function set_subItems($arr)
	{
		
		if (is_array($arr))
			$arr = implode(_BR_, $arr);
		
		listitem_prop($this->self, __FUNCTION__, $arr);
	}
	
	function get_subItems()
	{
		$str = listitem_prop($this->self, __FUNCTION__, null);
		return explode(_BR_, $str);
	}
	
}

/* ... from Nyashik ... */

function MakeLong($A, $B)
{
    return $A | ($B << 16);
}
	
class TListView extends TControl 
{
	public $class_name = __CLASS__;
	protected $_items;

	function get_items()
	{
		if (!$this->_items)
		{
			$this->_items = new TListItems($this,false);
			$this->_items->self = __rtii_link($this->self,'items');
		}
		
		return $this->_items;
	}
	
	function set_images($c)
	{
		imagelist_set_images($this->self, $c->self);
	}
	
	function get_selected()
	{
		return $this->items->get_selected();
	}
	
	public function GetColumnWidth($Idx) 
	{
		return SendMessage($this->self, 0x1000 + 29, $Idx, 0);
	}
	
	public function GetTextColor($Idx) 
	{
		return SendMessage($this->self, 0x1000 + 35, $Idx, 0);
	}
	
	public function SetTextColor($color) 
	{
		return SendMessage($this->self, 0x1000 + 36, 0, $color);
	}
	
	public function DeleteAllItems() 
	{
		return SendMessage($this->self, 0x1000 + 9, 0, 0);
	}
	
	public function DeleteItem($idx) 
	{
		return SendMessage($this->self, 0x1000 + 8, $idx, 0);
	}

	public function GetItemCount() 
	{
		return SendMessage($this->self, 0x1000 + 4, 0, 0);
	}
	
	
	public function GetBkColor() 
	{
		return SendMessage($this->self, 0x1000 + 0, 0, 0);
	}
	
	public function SetBkColor($color) 
	{
		return SendMessage($this->self, 0x1000 + 1, 0, $color);
	}
	
	public function GetCallbackMask() 
	{
		return SendMessage($this->self, 0x1000 + 10, 0, 0);
	}
	
	public function SetCallbackMask($mask) 
	{
		return SendMessage($this->self, 0x1000 + 11, $mask, 0);
	}

	
	public function GetNextItem($idx, $flags) 
	{
		return SendMessage($this->self, 0x1000 + 12, $idx, MakeLong($flags, 0));
	}
	
	public function SetItemPosition($idx, $x, $y) 
	{
		return SendMessage($this->self, 0x1000 + 15 , $idx, MakeLong($x, $y));
	}
	
	public function Scroll($dx, $dy) 
	{
		return SendMessage($this->self, 0x1000 + 20  , $dx, $dy);
	}	
  
	public function EditLabel($idx, $is = true) 
	{
		return SendMessage($this->self, $is ? 0x1000 + 23 :   0x1000 + 118  , $idx, 0);
	}	
	
	public function GetEditControl() 
	{
		return SendMessage($this->self,  0x1000 + 24   , 0, 0);
	}	
	public function GetHeader() 
	{
		return SendMessage($this->self,  0x1000 + 31    , 0, 0);
	}	
	
	public function SortItems($pfnCompare, $lParamSort) 
	{
		return SendMessage($this->self, 0x1000 + 48, $lParamSort, $pfnCompare);
	}	

	public function GetSelectedCount() 
	{
		return SendMessage($this->self, 0x1000 + 50, 0, 0);
	}	
	
	public function GetItemSpacing($fSmall) 
	{
		return SendMessage($this->self, 0x1000 + 51, $fSmall, 0);
	}	

	public function SetIconSpacing($cx, $cy) 
	{
		return SendMessage($this->self, 0x1000 + 53, 0, MakeLong($cx, $cy));
	}	
	
	public function SetExtendedListViewStyle($dw) 
	{
		return SendMessage($this->self, 0x1000 + 54, 0, $dw);
	}	
	
	public function GetExtendedListViewStyle() 
	{
		return SendMessage($this->self, 0x1000 + 55, 0, 0);
	}	
	
	
	public function SetColumnOrderArray($iCount, $lpiArray) 
	{
		return SendMessage($this->self, 0x1000 + 58 , $iCount, $lpiArray);
	}	
	
	public function GetColumnOrderArray($iCount, $lpiArray) 
	{
		return SendMessage($this->self, 0x1000 + 59  , $iCount, $lpiArray);
	}		

	
	public function SetHotItem($idx) 
	{
		return SendMessage($this->self, 0x1000 + 60, $idx, 0);
	}	
	
	public function GetHotItem() 
	{
		return SendMessage($this->self, 0x1000 + 61, 0, 0);
	}

	
	public function SetHotCursor($idx) 
	{
		return SendMessage($this->self, 0x1000 + 62, 0, $idx);
	}	
	
	public function GetHotCursor() 
	{
		return SendMessage($this->self, 0x1000 + 63, 0, 0);
	}
}

class TDateTimePicker extends TControl {
	
	public $class_name = __CLASS__;
	
	public function get_date(){
		
		return datetime_str($this->get_prop('date'));
	}
	
	function set_date($v){ $this->set_prop('date', str_datetime($v)); }
	
	function get_maxDate(){ return datetime_str($this->get_prop('maxDate'));}
	function get_minDate(){ return datetime_str($this->get_prop('minDate'));}
	function get_time(){return wtime_str($this->get_prop('time'));}
	
	function set_maxDate($v){ $this->set_prop('maxDate', str_datetime($v)); }
	function set_minDate($v){ $this->set_prop('minDate', str_datetime($v)); }
	function set_time($v){ $this->set_prop('time', str_wtime($v)); }
	
}

class TTreeView extends TControl {
	
	public $class_name = __CLASS__;
	
	public function loadFromStr($str){
		
		tree_loadstr($this->self,$str);
	}
	
	public function get_text(){
		
		return tree_gettext($this->self);
	}
	
	public function set_text($v){
		$this->loadFromStr($v);
	}
	
	public function get_itemSelected(){
		
		$arr = explode(_BR_,$this->text);
		return trim($arr[ $this->absIndex ]);
	}
	
	public function set_itemSelected($v){
		
		$this->absIndex = -1;
		$v   = strtolower($v);
		$arr = explode(_BR_,$this->text);
		foreach ($arr as $i=>$text){
			$text = strtolower(trim($text));
			if ($v==$text){
				$this->absIndex = $i;
			}
		}
	}
	
	public function get_selected(){
		
		$res = tree_selected($this->self);
		if ($res === null){
			return null;
		} else
			return _c( $res );
	}
	
	public function set_selected($v){
		
		tree_select($this->self, $v->self);
	}
	
	public function get_absIndex(){
		$sel = $this->selected;
		if ($sel)
			return $sel->absIndex;
		else
			return -1;
	}
	
	public function set_absIndex($v){
		return tree_setAbsIndex($this->self, (int)$v);
	}
	
	public function fullExpand(){
		tree_fullExpand($this->self);
	}
	
	public function fullCollapse(){
		tree_fullCollapse($this->self);
	}
}

class TTreeNode extends TControl {
	
	public $class_name = __CLASS__;
	
	public function get_absIndex(){
		return tree_absIndex($this->self);
	}
}

?>