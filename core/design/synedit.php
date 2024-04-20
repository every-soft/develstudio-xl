<?

/*
	Option List:
	
   TSynEditorOption = (
    eoAltSetsColumnMode,       //Holding down the Alt Key will put the selection mode into columnar format
    eoAutoIndent,              //Will indent the caret on new lines with the same amount of leading white space as the preceding line
    eoAutoSizeMaxScrollWidth,  //Automatically resizes the MaxScrollWidth property when inserting text
    eoDisableScrollArrows,     //Disables the scroll bar arrow buttons when you can't scroll in that direction any more
    eoDragDropEditing,         //Allows you to select a block of text and drag it within the document to another location
    eoDropFiles,               //Allows the editor accept OLE file drops
    eoEnhanceHomeKey,          //enhances home key positioning, similar to visual studio
    eoEnhanceEndKey,           //enhances End key positioning, similar to JDeveloper
    eoGroupUndo,               //When undoing/redoing actions, handle all continous changes of the same kind in one call instead undoing/redoing each command separately
    eoHalfPageScroll,          //When scrolling with page-up and page-down commands, only scroll a half page at a time
    eoHideShowScrollbars,      //if enabled, then the scrollbars will only show when necessary.  If you have ScrollPastEOL, then it the horizontal bar will always be there (it uses MaxLength instead)
    eoKeepCaretX,              //When moving through lines w/o Cursor Past EOL, keeps the X position of the cursor
    eoNoCaret,                 //Makes it so the caret is never visible
    eoNoSelection,             //Disables selecting text
    eoRightMouseMovesCursor,   //When clicking with the right mouse for a popup menu, move the cursor to that location
    eoScrollByOneLess,         //Forces scrolling to be one less
    eoScrollHintFollows,       //The scroll hint follows the mouse when scrolling vertically
    eoScrollPastEof,           //Allows the cursor to go past the end of file marker
    eoScrollPastEol,           //Allows the cursor to go past the last character into the white space at the end of a line
    eoShowScrollHint,          //Shows a hint of the visible line numbers when scrolling vertically
    eoShowSpecialChars,        //Shows the special Characters
    eoSmartTabDelete,          //similar to Smart Tabs, but when you delete characters
    eoSmartTabs,               //When tabbing, the cursor will go to the next non-white space character of the previous line
    eoSpecialLineDefaultFg,    //disables the foreground text color override when using the OnSpecialLineColor event
    eoTabIndent,               //When active <Tab> and <Shift><Tab> act as block indent, unindent when text is selected
    eoTabsToSpaces,            //Converts a tab character to a specified number of space characters
    eoTrimTrailingSpaces       //Spaces at the end of lines will be trimmed and not saved
    );
*/

global $_c;

$_c->setConstList(array('ctVerticalLine', 'ctHorizontalLine', 'ctHalfBlock', 'ctBlock'), 0);
$_c->setConstList(array('ctCode', 'ctHint', 'ctParams'), 0);
$_c->setConstList(array('shfTopToBottom','shfTopLineOnly'), 0);
$_c->setConstList(array('shmDefault', 'shmToken'), 0);

// TSynGutterBorderStyle = (gbsNone, gbsMiddle, gbsRight);
$_c->setConstList(array('gbsMiddle', 'gbsNone', 'gbsRight'), 0);
$_c->setConstList(array('smNormal', 'smColumn'), 0);

class TSynEdit extends TMemo 
{
	public $class_name = __CLASS__;
	public $gutter; // TSynGutter
	public $selectedColor; // TSynSelectedColor

    public function __construct($owner = nil, $init = true, $self = nil)
	{
		parent::__construct($owner, $init, $self);
		
		$this->tabWidth = 4; // fix bug
		//$this->options = 'eoAutoIndent, eoDragDropEditing, eoEnhanceEndKey, eoGroupUndo, eoHalfPageScroll, eoHideShowScrollbars, eoScrollPastEof, eoShowScrollHint, eoSmartTabDelete, eoTabIndent, eoTrimTrailingSpaces';
		
		$this->gutter = new TSynGutter;
		$this->gutter->self = __rtii_link($this->self, 'Gutter');
		
		$this->selectedColor = new TSynSelectedColor;
		$this->selectedColor->self = __rtii_link($this->self, 'SelectedColor');
		
		$this->__setAllPropEx();
    }
	
	public function set_caretX($v){ synedit_caret_x($this->self,$v); }
	public function get_caretX(){ return synedit_caret_x($this->self, null); }
	
	public function set_caretY($v){ synedit_caret_y($this->self,$v); }
	public function get_caretY(){ return synedit_caret_y($this->self, null); }
	
	public function set_selStart($v){ synedit_selstart($this->self,$v); }
	public function get_selStart(){ synedit_selstart($this->self, null); }
	
	public function set_selEnd($v){ synedit_selend($this->self,$v); }
	public function get_selEnd(){ synedit_selend($this->self, null); }
	
	public function set_selLength($v)
	{
		$this->selEnd = $this->selStart + $v;
	}
	
	public function get_selLength()
	{
		return $this->selEnd - $this->selStart;
	}
	
	public function selectAll(){
		
		$this->setFocus();
		$this->selStart = 0;
		$this->selEnd   = strlen($this->text);
	}
	
	public function undo(){ edit_undo($this->self); }
	public function redo(){ edit_redo($this->self); }
    
	public function copyToClipboard(){ edit_copytoclipboard($this->self); }
	public function cutToClipboard(){ edit_cuttoclipboard($this->self); }
	public function pasteFromClipboard(){ edit_pastefromclipboard($this->self); }
	public function clearSelected(){ edit_clearselection($this->self); }
	public function clearSelection(){ $this->clearSelected(); }
	
	public function set_lineText($v)
	{
		$y = $this->caretY;
		$this->items->setLine($y-1, $v);
	}
	
	public function get_lineText()
	{
		$y = $this->caretY;
		return $this->items->getLine($y-1);
	}
	
	public function replaceLine($text)
	{
		$lineT = $this->lineText;
		$lastX = $this->caretX;
		
		
		$s = substr($lineT, 0, strlen($lineT)-strlen(ltrim($lineT)));
		$this->lineText = $s . $text;
		
		
		$this->caretX   = $lastX;
	}
	
	public function insertLine($text)
	{
		$lineT = $this->lineText;
		$lastX = $this->caretX;
		$lastY = $this->caretY;
		
		$s = substr($lineT, 0, strlen($lineT)-strlen(ltrim($lineT)));
		$this->lineText = $this->lineText . _BR_ . $s . $text;
		
		$this->caretX   = $lastX;
		$this->caretY   = $lastY;
	}
	
	public function insertLineAfter($text)
	{
		$lineT = $this->lineText;
		$lastX = $this->caretX;
		$lastY = $this->caretY;
		
		$s = substr($lineT, 0, strlen($lineT)-strlen(ltrim($lineT)));
		$this->lineText =  $s . $text ._BR_. $this->lineText;
		
		$this->caretX   = $lastX;
		$this->caretY   = $lastY;
	}
	
	function setHighlighter (TSynCustomHighlighter $highlighter)
	{
		synedit_highlight($this->self, $highlighter->self);
	}
	
	// Костыль для установки подсветки
	public function set_highlighter (TSynCustomHighlighter $highlighter)
	{
		gui_readStr ($this->self, 'object ' . ($this->name ? $this->name.': ' : '') . 'TSynEdit
									Highlighter = ' . _c($highlighter->owner)->name . '.' . $highlighter->name .'
								   end');
	}
	
	public function set_showLineNumbers($v){ $this->Gutter->ShowLineNumbers = $v; }
	public function get_showLineNumbers(){ return $this->Gutter->ShowLineNumbers; }
}

// Gutter
class TSynGutter extends TComponent
{	
	public $class_name = __CLASS__;
	
	protected $_font;

    public function __construct ()
	{
		
    }
	
	public function get_font()
	{
	    if (!isset($this->_font)){
			$this->_font = new TFont;
			$this->_font->self = $this->self;
	    }
		
	    return $this->_font;
	}
}

// Gutter
class TSynSelectedColor extends TControl
{	
	public $class_name = __CLASS__;
	
    public function __construct ()
	{
		
    }

}

class TSynCompletionProposal extends TControl 
{
    public $class_name = __CLASS__;
    public $itemList; // TStrings
    public $insertList; // TStrings
	public $titleFont; // TFont
    
    #clBackground = clWindow
    #clSelect = clHighlight
    #clSelectText = clHighlightText
    #clTitleBackground = clBtnFace
    
    #margin = 2
    #itemHeight = 0
    #nbLinesInWindow = 8
    #resizeable = true
    #defaultType = ctCode
    #shortCut = CTRL+SPACE
    #title = ''
    #width = 260
    
    function __construct($owner = nil, $init = true, $self = nil)
	{
		parent::__construct($owner, $init, $self);
		
		$this->itemList = new TStrings(false);
		$this->itemList->self = __rtii_link($this->self, 'itemList');
			
		$this->insertList = new TStrings(false);
		$this->insertList->self = __rtii_link($this->self, 'insertList');
		
		$this->titleFont = new TFont;
		$this->titleFont->self = __rtii_link($this->self, 'titleFont');
		
		$this->__setAllPropEx();
    }
    
    public function setEditor(TSynEdit $editor)
	{
		syncomplete_editor($this->self, $editor->self);
    }
    
    public function get_visible()
	{
		return (syncomplete_visible($this->self));
    }
    
    public function get_insert()
	{
        return $this->insertList->get_text();
    }
	
    public function set_insert($text)
	{
        $this->insertList->text = $text;
    }
    
    public function get_item()
	{
        return $this->itemList->get_text();   
    }
	
    public function set_item($text)
	{
		$this->itemList->text = $text;
    }
    
    public function set_editor(TSynEdit $editor)
	{
        syncomplete_editor($this->self, $editor->self);
    }
    
    public function get_editor()
	{
        return _c(syncomplete_editor($this->self, null));
    }
    
    public function set_shortCut($sc)
	{
		if (!is_numeric($sc))
			$sc = text_to_shortcut(strtoupper($sc));
		
		$this->set_prop('shortCut', $sc);
    }
	
    public function get_shortCut()
	{
		$result = $this->get_prop('shortCut');
		return shortCut_to_text($result);
    }
    
    public function active($value = true)
	{
        syncomplete_activate($this->self, (bool) $value);
    }
    
    public function get_hint()
	{
        return $this->insertList->text;
    }
    
    public function set_hint($hint)
	{
        $this->defaultType      = ctParams;
        $this->insertList->text = $hint;
        $this->itemList->text   = $hint;
    }
    
    public function get_currentString()
	{
		return syncomplete_currentString($this->self);
    }
    
    public function get_empty()
	{
		return syncomplete_empty($this->self);
    }
	
	/* ---------------------------- */
	
	public function get_width()
	{
		return $this->get_prop('width');
	}
	
	public function set_width($v)
	{
		$this->set_prop('width', $v);
	}
}

class TSynHighlighterAttributes extends TControl 
{
	public $class_name = __CLASS__;
	#TColor background
	#TColor foreground
	#string style = 'fsBold, fsItalic, fsStrikeOut, fsUnderline'
}

class TSynCustomHighlighter extends TControl 
{
	public $class_name = __CLASS__;
	#enabled
	#DefaultFilter 
	
	// ->getAttri('Comment')->background = clGray;
	function getAttri($prefix = 'Comment')
	{
		$prop = $prefix . 'Attri';
		
		$result = new TSynHighlighterAttributes(nil, false);
		$result->self = gui_propGet($this->self, $prop);
		
		return $result;
	}
}

#attr: Comment, Identifier, Key, Number, Space, String, Symbol, Variable
class TSynPHPSyn extends TSynCustomHighlighter 
{
	public $class_name = __CLASS__;
	static $prefixs = array('Comment', 'Identifier', 'Key', 'Number', 'Space', 'String', 'Symbol', 'Variable');
	
	function saveAttr($prefix, &$arr)
	{
		$attr = $this->getAttri($prefix);
		$arr[$prefix]['background'] = $attr->background;
		$arr[$prefix]['foreground'] = $attr->foreground;
		$arr[$prefix]['style']      = $attr->style;
	}
	
	function saveToArray(&$arr)
	{
		
		foreach (self::$prefixs as $prefix)
			$this->saveAttr($prefix, $arr);
	}
	
	function loadFromArray($arr)
	{
		foreach (self::$prefixs as $prefix)
		{
			$attr = $this->getAttri($prefix);
			
			if (isset($arr[$prefix])){
				$attr->background = $arr[$prefix]['background'];
				$attr->foreground = $arr[$prefix]['foreground'];
				$attr->style      = $arr[$prefix]['style'];
			}
		}
	}
}
class TSynGeneralSyn extends TSynCustomHighlighter { public $class_name = __CLASS__; }
class TSynCppSyn extends TSynCustomHighlighter { public $class_name = __CLASS__; }
class TSynCssSyn extends TSynCustomHighlighter { public $class_name = __CLASS__; }
class TSynHTMLSyn extends TSynCustomHighlighter { public $class_name = __CLASS__; }
class TSynSQLSyn extends TSynCustomHighlighter { public $class_name = __CLASS__; }
class TSynJScriptSyn extends TSynCustomHighlighter { public $class_name = __CLASS__; }
class TSynXMLSyn extends TSynCustomHighlighter { public $class_name = __CLASS__; }