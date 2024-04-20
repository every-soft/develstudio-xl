<?

// диалог для опций...
class TListDialog extends TPanel 
{
    public $class_name_ex = __CLASS__;
    
    function execute ($xy_mouse = true)
	{
        c('fmListEditor')->onKeyDown = 'TListDialog::keyDown';
        c('fmListEditor->BitBtn2')->onClick = 'TListDialog::close';
		 
        if ($xy_mouse)
		{
            c('fmListEditor')->x = cursor_real_x(c('fmListEditor'), 10);
			if (($y = cursor_real_y(c('fmListEditor'), 10)) < 0)
				c('fmListEditor')->y = 0;
			else
				c('fmListEditor')->y = $y;
        }
        
        return (c('fmListEditor')->showModal() == mrOk);
    }
	
	function close()
	{
		return c('fmListEditor')->close();
	}
    
    function get_value()
	{
        return join(',', (array) c('fmListEditor->checkList1')->checkedItems);
    }
    
    function set_value($value, $text)
	{
		c('fmListEditor->checkList1')->text = $text;
		
		c('fmListEditor->checkList1')->checkedItems = (array) explode(',', str_replace(' ', '', $value));
    }
    
    
    function keyDown($self, $key, $shift)
	{
        if ($key == VK_ESCAPE)
            self::close();
    }
}

// модуль нестандартных диалогов...

function __inputTextKeyDownEvent($self, $key, $shift)
{
    if ($key == VK_ESCAPE)
	{
        c('edt_inputText')->close();
    } elseif ($key == VK_RETURN)
	{
        c('edt_inputText')->close();
        c('edt_inputText')->modalResult = mrOk;
        //$GLOBALS['__inputtext_modalresult'] = mrOk;
    }
}


function inputText($caption, $text, $value = '', $xy = true)
{
    $form = c('edt_inputText');
    $form->onKeyDown = '__inputTextKeyDownEvent';
    c('edt_inputText->text')->onKeyDown = '__inputTextKeyDownEvent';
    c('edt_inputText->btn_ok')->onKeyDown = '__inputTextKeyDownEvent';
    c('edt_inputText->btn_cancel')->onKeyDown = '__inputTextKeyDownEvent';
    
    if ($xy)
	{
        $form->x = cursor_real_x($form, 10);
        $form->y = cursor_real_y($form, 10);
    }
    
    $form->caption = $caption;
    c('edt_inputText->e_label')->text = $text;
    c('edt_inputText->text')->text = $value;
    c('edt_inputText->text')->setFocus();
    
    $res = $form->showModal() == mrOk/* || $GLOBALS['__inputtext_modalresult']==mrOk*/;
    

	return $res ? c('edt_inputText->text')->text : false;
}

// диалог для текста...
class TTextDialog extends TPanel 
{
    public $class_name_ex = __CLASS__;
    
    function execute($xy_mouse = true, $text = false)
	{
       
        c('edt_Text')->onKeyDown = 'TTextDialog::keyDown';
        c('edt_Text->memo')->onKeyDown = 'TTextDialog::keyDown';
        
        if ($text)
            $this->value = $text;
                               
        if ($xy_mouse)
		{
            c('edt_Text')->x = cursor_real_x (c('edt_Text'), 10);
            c('edt_Text')->y = cursor_real_y (c('edt_Text'), 10);
        }
        
        return c('edt_Text')->showModal() == mrOk;
    }
    
    function get_value()
	{
        $val = c('edt_Text->memo')->text;

        if ($val[strlen($val)-1] == chr(13) || $val[strlen($val)-1] == chr(10))
            $val[strlen($val)-1] = ' ';
            
        if ($val[strlen($val)-2] == chr(13) || $val[strlen($val)-2] == chr(10))
            $val[strlen($val)-2] = ' ';
		
        return $val;
    }
    
    function set_value($v)
	{
        //$this->set_prop('text',$v);
        c('edt_Text->memo')->text = $v;
    }
    
    
    function keyDown($self, $key, $shift)
	{
        if ($key == VK_ESCAPE)
            c('edt_Text')->close();
    }
}

// диалог для картинки...
class TSizesDialog extends TPanel 
{
    public $class_name_ex = __CLASS__;
    
    function execute($xy_cursor = true)
	{
        $obj = $this->getObject();
        $anchors = explode(',', $obj->anchors);
        
        if ($xy_cursor)
		{
            c('fmSizesPosition')->x = cursor_real_x(c('fmSizesPosition'), 10);
            c('fmSizesPosition')->y = cursor_real_y(c('fmSizesPosition'), 10);
        }
        
        c('fmSizesPosition->e_x')->onKeyUp = 'TSizesDialog::setSizes';
        c('fmSizesPosition->e_x')->onKeyPress= 'TSizesDialog::setSizes';
        
        c('fmSizesPosition->e_y')->onKeyUp = 'TSizesDialog::setSizes';
        c('fmSizesPosition->e_y')->onKeyPress= 'TSizesDialog::setSizes';
        
        c('fmSizesPosition->e_w')->onKeyUp = 'TSizesDialog::setSizes';
        c('fmSizesPosition->e_w')->onKeyPress= 'TSizesDialog::setSizes';
        
        c('fmSizesPosition->e_h')->onKeyUp = 'TSizesDialog::setSizes';
        c('fmSizesPosition->e_h')->onKeyPress= 'TSizesDialog::setSizes';
        
        c('fmSizesPosition->c_left')->checked = in_array('akLeft', $anchors);
        c('fmSizesPosition->c_top')->checked  = in_array('akTop', $anchors);
        c('fmSizesPosition->c_right')->checked= in_array('akRight', $anchors);
        c('fmSizesPosition->c_bottom')->checked = in_array('akBottom', $anchors);
        
        c('fmSizesPosition->e_x')->text = $obj->x;
        c('fmSizesPosition->e_y')->text = $obj->y;
        c('fmSizesPosition->e_h')->text = $obj->h;
        c('fmSizesPosition->e_w')->text = $obj->w;
        
        if (c('fmSizesPosition')->showModal() == mrOk)
		{
            $anchors = array();
			
            if (c('fmSizesPosition->c_left')->checked)
                $anchors[] = 'akLeft';
                
            if (c('fmSizesPosition->c_top')->checked)
                $anchors[] = 'akTop';
            
            if (c('fmSizesPosition->c_right')->checked)
                $anchors[] = 'akRight';
            
            if (c('fmSizesPosition->c_bottom')->checked)
                $anchors[] = 'akBottom';
            
            $targets = $this->getSizeControl()->targets_ex;
            
            foreach ($targets as $el)
                $el->anchors = implode(',', $anchors);
        }
    }
    
    function setSizes()
	{
        global $_sc;
        $targets = $_sc->targets_ex;
		
        foreach ($targets as $el)
		{
            $el->x = c('fmSizesPosition->e_x')->text;
            $el->y = c('fmSizesPosition->e_y')->text;
            $el->w = c('fmSizesPosition->e_w')->text;
            $el->h = c('fmSizesPosition->e_h')->text;
        }
    }
    
    function setSizeControl($name)
	{
        $this->sc = $name;
    }
    
    function getSizeControl()
	{
        return $GLOBALS[$this->sc];
    }
    
    function setObject($obj)
	{
        $this->component = $obj->self;
    }
    
    function getObject()
	{
        return _c($this->component);
    }

}

// диалог для картинки...
class TImageDialog extends TPanel 
{
    public $class_name_ex = __CLASS__;
    
    function execute($imagelist = false)
	{
        global $_sc;
        c('edt_ImageView->btn_load')->onClick = 'TImageDialog::load';
        c('edt_ImageView->btn_save')->onClick = 'TImageDialog::save';
        c('edt_ImageView->btn_clear')->onClick= 'TImageDialog::clear';
        c('edt_ImageView->btn_copy')->onClick = 'TImageDialog::copy';
        c('edt_ImageView->btn_paste')->onClick= 'TImageDialog::paste';
        
        //    $this->value = $text;
        
        if ($this->imagelist)
		{
            $this->setImages();
            //c('edt_ImageView->groupBox')->show();
            c('edt_ImageView')->h = 498;
        } else {
            c('edt_ImageView')->h = 357;
        }
        
        return c('edt_ImageView')->showModal() == mrOk;
    }
    
    static function clear()
	{
        c('edt_ImageView->image')->picture->clear();
    }
    
    static function load()
	{
        $dlg = new TOpenDialog;
        $dlg->filter = DLG_FILTER_PICTURES;
        
        $result = false;
		
        if ($dlg->execute())
		{
            c('edt_ImageView->image')->picture->loadAnyFile($dlg->fileName);
            $result = true;
        }
        
        $dlg->free();
        return $result;
    }
    
    static function save()
	{
        $dlg = new TSaveDialog;
        $dlg->filter = 'Bitmap Images (*.bmp)|*.bmp';
        
        if ($dlg->execute())
		{
            if (file_exists($dlg->fileName) && !confirm(t('File "%s" already exists! You want to replace this file?', basename($dlg->fileName)))) 
				return false;
            
            $dlg->fileName = fileExt($dlg->fileName) == 'bmp' ? $dlg->fileName : $dlg->fileName . '.bmp';
            c('edt_ImageView->image')->picture->getBitmap()->saveToFile($dlg->fileName);
        }
        
        $dlg->free();
    }
    
    static function copy()
	{
        $bitmap = c('edt_ImageView->imgBuffer')->picture;
        $bitmap->assign(c('edt_ImageView->image')->picture);
    }
    
    static function paste()
	{
        $bitmap = c('edt_ImageView->image')->picture;
        $bitmap->assign(c('edt_ImageView->imgBuffer')->picture);
    }
    
    function get_value()
	{
        return c('edt_ImageView->image')->picture;
    }
    
    function set_value($v)
	{
        c('edt_ImageView->image')->picture->assign($v);
    }
    
}


class TMenuDialog extends TPanel 
{
    public $class_name_ex = __CLASS__;
    
    function execute()
	{
        $r = c('edt_menuEditor')->showModal();
		
        return ($r == mrOk);
    }
    
    function get_value()
	{
        
        return c('edt_menuEditor')->result;
    }
    
    function set_value($v)
	{
        
        c('edt_menuEditor')->result = $v;
    }
}

class TObjectsDialog extends TPanel 
{
    public $class_name_ex = __CLASS__;
    
    function execute($classes = false, $status = '', $fullpath = false)
	{
        c('fmEasySelectDialog->tsVars')->tabVisible = false;
        c('fmEasySelectDialog->tsProps')->tabVisible = false;
        c('fmEasySelectDialog->tsFuncs')->tabVisible = false;
        c('fmEasySelectDialog->tsFiles')->tabVisible = false;
        c('fmEasySelectDialog->tsConsts')->tabVisible = false;
        c('fmEasySelectDialog->c_kav')->hide();
        c('fmEasySelectDialog->pages')->pageIndex    = 1;
        c('fmEasySelectDialog->l_status')->text = $status;
        
        $GLOBALS['OBJ_ISFUNC']  = true;
        $GLOBALS['OBJ_FULLPATH'] = $fullpath;
        $GLOBALS['OBJ_CLASSES'] = $classes;
        
        $r = c('fmEasySelectDialog')->showModal();
        
        c('fmEasySelectDialog->l_status')->text = '';
        
        $GLOBALS['OBJ_ISFUNC'] = false;
        $GLOBALS['OBJ_FULLPATH'] = false;
        
        c('fmEasySelectDialog->tsVars')->tabVisible = true;
        c('fmEasySelectDialog->tsConsts')->tabVisible = true;
        c('fmEasySelectDialog->tsProps')->tabVisible = true;
        c('fmEasySelectDialog->tsFuncs')->tabVisible = true;
        c('fmEasySelectDialog->tsFiles')->tabVisible = true;
        c('fmEasySelectDialog->c_kav')->show();
        
        return $r == mrOk;
    }
    
    function get_value()
	{
        return c('fmEasySelectDialog->line')->text;
    }
    
    function set_value($v)
	{
        c('fmEasySelectDialog->line')->text = $v;
    }
}

?>