<?

$memo = c('fmPHPEditor->memo');

$memo->selectedColor->foreground = 0;
$memo->selectedColor->background = 16766637;
$memo->font->size = 12;
$memo->activeLineColor = 15790320;
$memo->gutter->color = 15000804;


class evfmPHPEditorMEMO 
{
	/*
	public static function onDblClick($self)
	{
        $w = c('fmPHPEditor->panelActions')->w;
        if ($w < 35) 
			return;
        
        $action = myActions::getAction(action_Simple::getLine());
		
        if ($action)
            action_Simple::openDialog($action['DIALOG'], $action);
    }
	*/
	
    public static function onMouseDown($self)
	{
        $action = myActions::getAction(action_Simple::getLine());
        
        if ($action)
		{
            c('fmPHPEditor.info')->caption = $action['TEXT'];
            c('fmPHPEditor.action_image')->loadPicture($action['ICON']);
            c('fmPHPEditor.desc')->caption = myActions::getInline($action);
        } else {
            c('fmPHPEditor.info')->caption = '';
            c('fmPHPEditor.desc')->caption = '';
            c('fmPHPEditor.action_image')->picture->clear();
        }
    }
    
    
    public static function onKeyPress($self)
	{
        self::onMouseDown($self);
    }
    
    public static function onKeyUp($self)
	{
        self::onMouseDown($self);
    }
    
    public static function onClick($self)
	{
        self::onMouseDown($self);
    }
}


class ev_fmPHPEditor_btn_new 
{
    public static function onClick($self)
	{ 
		c('fmPHPEditor->memo')->text = ''; 
	}
}


class ev_fmPHPEditor_btn_open 
{
    public static function onClick($self)
	{
		if (($file = returnFile()) !== false)
			c('fmPHPEditor.memo')->loadFromFile($file);
    }
}


class ev_fmPHPEditor_btn_save 
{
    public static function onClick($self)
	{
        $dlg = new TSaveDialog;
        //$dlg->filter = 'PHP Script (.php)|*.php';
        $dlg->filter = DLG_FILTER_ALL;
		
        if ($dlg->execute()){
            
            $fileName = $dlg->fileName;
            if (!fileExt($fileName)) 
				$fileName .= '.php';
            
            file_p_contents($fileName, c('fmPHPEditor->memo')->text);   
        }
        
        $dlg->free();
    }
}


class ev_fmPHPEditor_btn_find {
	
    public static function onClick() {

		c('fmFindDialog')->show();
		c('fmFindDialog->findText')->setFocus();
    }
}

class ev_fmPHPEditor_it_find {
    
    public static function onClick($self) {
		
         ev_fmPHPEditor_btn_find::onClick();
    }
}


class ev_fmPHPEditor_btn_undo {
   public static function onClick($self){
        c('fmPHPEditor->memo')->undo();
    }
}

class ev_fmPHPEditor_btn_redo {
    public static function onClick($self){
        c('fmPHPEditor->memo')->redo();
    }
}

class ev_fmPHPEditor_it_selectall {
    public static function onClick($self){
         c('fmPHPEditor->memo')->selectAll();
    }
}

class ev_fmPHPEditor_it_cut {
    public static function onClick($self){
         c('fmPHPEditor->memo')->cutToClipboard();
    }
}

class ev_fmPHPEditor_it_copy {
    public static function onClick($self){
		if (($layout = TWinAPI::GetKeyboardLayout()) != 'RUS')
			TWinAPI::SetKeyboardLayout('RUS');
		
         c('fmPHPEditor->memo')->copyToClipboard();
		 if ($layout != 'RUS')
			TWinAPI::SetKeyboardLayout($layout);
    }
}

class ev_fmPHPEditor_it_paste {
    public static function onClick($self){
		c('fmPHPEditor->memo')->pasteFromClipboard();
    }
}

class ev_fmPHPEditor_saveEvent 
{
    public static function onClick($self)
	{
		if ( !c('fmPHPEditor')->visible )
			return;
		
		global $myEvents;

		myComplete::saveCode();
		eventEngine::setEvent($myEvents->getSelectedObject(), c('fmPHPEditor')->event, c('fmPHPEditor->memo')->text);
		c('fmPHPEditor')->lastText = c('fmPHPEditor->memo')->text;
		
		// myHistory::go();
		
		c('fmPHPEditor->btn_cancel')->enabled = false;
	}
}


class ev_fmPHPEditor_exit 
{
    public static function onClick($self)
	{
		if (!c('fmPHPEditor')->visible)
			return;
		
		if (trim(c('fmPHPEditor')->lastText) != trim(c('fmPHPEditor->memo')->text))
		{
			if (($res = MessageBox(t('All data will be lost. Do you want to save the event?'), '', MB_YESNOCANCEL + MB_ICONQUESTION)) == mrCancel)
				return;
			
			c('fmPHPEditor')->modalResult = ($res == mrYes) ? mrOk : mrCancel;
			
		} else {
			c('fmPHPEditor')->modalResult = mrCancel;
		}
		
		c('fmPHPEditor')->hide();
	}
}

class ev_fmPHPEditor_btn_options
{
    public static function onClick($self)
	{
        c('fmPHPEditor->SynPHPSyn')->saveToArray($arr);
        $arr['main']['color'] = c('fmPHPEditor->memo')->color;
		
        if (c('fmEditorSettings')->showModal() != mrOk)
		{
			ev_fmEditorSettings::loadArray($arr);
        }
    }
}

/* Форматирование кода */
class ev_fmPHPEditor_btn_format 
{
	static function checkInternet() 
	{
		$host = 'google.com';
		$obj = new COM('winmgmts://localhost/root/CIMV2');

		foreach ($obj->ExecQuery('SELECT * FROM Win32_PingStatus WHERE Address = "' . $host . '"') as $ping)
			return $ping->statusCode === 0;
	}
	
	static function format($code)
	{
        if (!self::checkInternet())
		{
			MessageBox (t('No internet connection.'), t('Formating code'), MB_ICONERROR);
			return;
		}
		
		$paramsArray = array(
			'spaces_around_map_operator' => 'on',
			'spaces_around_assignment_operators' => 'on',
			'spaces_around_bitwise_operators' => 'on',
			'spaces_around_relational_operators' => 'on',
			'spaces_around_equality_operators' => 'on',
			'spaces_around_logical_operators' => 'on',
			'spaces_around_math_operators' => 'on',
			'rewrite_short_tag' => 'on',
			'space_after_structures' => 'on',
			'align_assignments' => 'on',
			'indent_case_default' => 'on',
			'indent_number' => '4',
			'first_indent_number' => '0',
			'indent_char' => ' ',
			'indent_char' => '\t',
			//'remove_empty_lines' => 'off',
			'charset' => 'utf-8',
			//'remove_comments' => 'off',
			'indent_number' => '1',
			'indent_style' => 'Allman',
			'code' => iconv("CP1251", "UTF-8", $code)
		);
		
		$vars        = http_build_query($paramsArray);
		$options     = array(
			'http' => array(
				'method' => 'POST',
				'header' => 'Content-type: application/x-www-form-urlencoded',
				'content' => $vars
			)
		);
		
		$context     = stream_context_create($options);
		$result      = file_get_contents('http://phpformatter.com/Output/', false, $context);
		$array       = (array) json_decode($result);
		$toRet       = $array['plainoutput'];
		
		$code = iconv('UTF-8', 'CP1251', $toRet);
		
		return $code;
	}

	static function onClick($self)
	{
        $code = trim(c('fmPHPEditor->memo')->text);
        
		if (MessageBox(t('Are you sure you want to format code?'), t('Formating code'), MB_YESNO + MB_ICONQUESTION) == mrNo) 
			return;
		
		if ($flag = (strpos($code, '<?') !== 0))
			$code = '<? ' . $code;
		
		$x = c('fmPHPEditor->memo')->caretX;
        $y = c('fmPHPEditor->memo')->caretY;

		$formatedCode = self::format($code);
		
        if (!$formatedCode && $code)
        {
            MessageBox(t('Failed to formatting. Check the code for syntax errors.'), '', MB_ICONERROR);
			return;
        }

		c('fmPHPEditor->memo')->text = $flag ? substr($formatedCode, 6) : $formatedCode;

        c('fmPHPEditor->memo')->caretX = $x;
        c('fmPHPEditor->memo')->caretY = $y;
    
        if ($code != $formatedCode)
            c('fmPHPEditor->btn_cancel')->enabled = true;
	}
}