<?

class ev_fmEditorSettings 
{
    public static $bColor;
    public static $fColor;
    public static $bgColor;
	public static $font;
    
    public static function getAttri()
	{
        $list    = c('fmEditorSettings->list');
        $prefixs = array('Comment', 'Identifier', 'Key', 'Number', 'Space', 'String', 'Symbol', 'Variable');
        $index   = $list->itemIndex;
        
        if ($index != -1)
            return c('fmPHPEditor->SynPHPSyn')->getAttri($prefixs[$index]);
        else
            return false;
    }
    
    public static function bColorSelect($self, $color)
	{
        $attr = self::getAttri();
        $attr->background = $color;
    }
    
    public static function bgColorSelect($self, $color)
	{
        c('fmPHPEditor->memo')->color = $color;
    }
	
    public static function fontSelect($self)
	{
        $self = _c($self);
		
		static $dlg;
		
		if (!isset($dlg))
		{
			$dlg = new TFontDialog;
			$dlg->options = 'fdAnsiOnly';
		}
		
		$dlg->font->assign (c('fmPHPEditor->memo')->font);
		
        if ($dlg->execute())
        {
			c('fmPHPEditor->memo')->font->size = $dlg->font->size;
			c('fmPHPEditor->memo')->font->name = $dlg->font->name;
			c('fmPHPEditor->memo')->gutter->font->size = $dlg->font->size;
			c('fmPHPEditor->memo')->gutter->font->name = $dlg->font->name;
			
            self::$font->caption = $dlg->font->name . ', ' . $dlg->font->size . ' px';
        }
    }
	
    public static function fColorSelect($self, $color)
	{
        $attr = self::getAttri();
        $attr->foreground = $color;
    }
    
    public static function onActive()
	{
        ev_fmEditorSettings::$bgColor->value = c('fmPHPEditor->memo')->color;
		self::$font->caption = c("fmPHPEditor->memo")->font->name . ', ' . c("fmPHPEditor->memo")->font->size . ' px';
        ev_fmEditorSettings_list::onClick(0);
        ev_fmEditorSettings::updateHighLightCfg();
    }
    
    public static function getHighlight()
	{
        $files = findFiles(SYSTEM_DIR.'/myprofile/highlight/', 'ini');
        $files = array_merge($files, findFiles(DS_USERDIR.'/highlight/', 'ini'));
        
         foreach ($files as $file){
            $lines[] = basenameNoExt($file); 
        } 
        
        $lines = array_unique($lines);
        return (array) $lines;
    }
    
    public static function updateHighLightCfg()
	{
        $highlight = self::getHighlight();
        c('fmEditorSettings->c_config')->text = $highlight;
		c('fmPHPEditor->SynPHPSyn')->saveToArray($arr);

		foreach($highlight as $name)
		{
			$file = DS_USERDIR.'/highlight/'.$name.'.ini';
			if (!file_exists($file))
				$file = SYSTEM_DIR.'/myprofile/highlight/'.$name.'.ini';
		
			$ini = new TIniFileEx($file);
			$check = $ini->arr;
			unset ($check ['main']); // fix
			
			if($arr == $check) 
			{
				c('fmEditorSettings->c_config')->items->selected = $name;
				break;
			}
		}
    }
    
    public static function saveHightLight($name)
	{
        c('fmPHPEditor->SynPHPSyn')->saveToArray($arr);
        $arr['main']['color'] = c('fmPHPEditor->memo')->color;
        
        $ini = new TIniFileEx;
        $ini->arr = $arr;
        $ini->filename = DS_USERDIR.'/highlight/'.$name.'.ini';
        $ini->updateFile();
    }
    
    public static function loadHightLight($name)
	{
        $file = DS_USERDIR.'/highlight/'.$name.'.ini';
        if (!file_exists($file))
            $file = SYSTEM_DIR.'/myprofile/highlight/'.$name.'.ini';
            
        if (!is_file($file)) 
			continue;
        
        $ini = new TIniFileEx($file);
		self::loadArray($ini->arr);
		
    }
	
	public static function loadArray ($arr)
	{
		global $evalMemo;
		
		$synColor = $arr ['main']['color'];
		$ex = explode('*', $arr ['main']['font']);
		
		c('fmPHPEditor->SynPHPSyn')->loadFromArray($arr);
		c('fmPHPEditor->memo')->color = $synColor;
		
		c('fmPHPEditor->memo')->gutter->font->name = $ex[0];
		c('fmPHPEditor->memo')->gutter->font->size = $ex[1];
		c('fmPHPEditor->memo')->font->name = $ex[0];
		c('fmPHPEditor->memo')->font->size = $ex[1];

		// Определение темы подсветки
		if ($synColor == clWhite || abs($synColor) == 16382457 || abs($synColor) == 16121086)
		{
			c('fmPHPEditor->memo')->activeLineColor = 15790320;
			c('fmPHPEditor->memo')->gutter->color = 15000804;

			$evalMemo->activeLineColor = 15790320;
			$evalMemo->gutter->color = 15000804;
		}
		else
		{
			c('fmPHPEditor->memo')->activeLineColor = 4144959;
			c('fmPHPEditor->memo')->gutter->color = $synColor;
			
			$evalMemo->activeLineColor = 4144959;
			$evalMemo->gutter->color = $synColor;
		}

		$evalMemo->color = $synColor;
	}
    
    public static function deleteHighlight($name)
	{
        $file = DS_USERDIR.'/highlight/'.$name.'.ini';
		
        if (file_exists($file))
            unlink($file);
    }
    
    public static function onShow()
	{
		if (!self::$bColor)
		{
			$form = c('fmEditorSettings');
			$group= c('fmEditorSettings->groupBox');
			self::$bColor = new TEditColorDialog($form);
			self::$bColor->parent = $group;
			self::$bColor->x = 90;
			self::$bColor->y = 28;
			self::$bColor->w = 215;
			self::$bColor->onSelect = 'ev_fmEditorSettings::bColorSelect';
			
			self::$fColor = new TEditColorDialog($form);
			self::$fColor->parent = $group;
			self::$fColor->x = 90;
			self::$fColor->y = 55;
			self::$fColor->w = 215;
			self::$fColor->onSelect = 'ev_fmEditorSettings::fColorSelect';
			
			self::$bgColor = new TEditColorDialog($form);
			self::$bgColor->parent = $form;
			self::$bgColor->y = 196;
			self::$bgColor->x = 90;
			self::$bgColor->w = 160;
			self::$bgColor->onSelect = 'ev_fmEditorSettings::bgColorSelect';
			
			self::$font = new TLabel($form);
			self::$font->parent = $form;
			self::$font->hint = t('Change font');
			self::$font->autoSize = false;
			self::$font->y = 220;
			self::$font->x = 90;
			self::$font->w = 120;
			self::$font->h = 22;
			self::$font->font->color = clGray;
			self::$font->alignment = taLeftJustify;
			self::$font->layout = tlCenter;
			self::$font->onClick = 'ev_fmEditorSettings::fontSelect';
			self::$font->cursor = crHandPoint;
        }
		
		self::$font->caption = c("fmPHPEditor->memo")->font->name . ', ' . c("fmPHPEditor->memo")->font->size . ' px';

        self::onActive();
    }
    
    public static function getStyle($style, $checked, $val)
	{
        $style = str_ireplace($val, '', $style);
        $style = str_replace(' ', '', $style);
        $style = str_replace(',,', ',', $style);
		
        if (substr($style,-1) == ',') 
			$style = substr($style,0,-1);
        
        if ($checked)
            $style .= $style ? ','.$val : $val;
        
        return $style;
    }
}


class ev_fmEditorSettings_c_bold
{
    public static function onMouseUp($self)
	{     
        $attr = ev_fmEditorSettings::getAttri();
        if ($attr)
            $attr->style = ev_fmEditorSettings::getStyle($attr->style, c($self)->checked, 'fsBold');
    }
}


class ev_fmEditorSettings_c_italic 
{
    public static function onMouseUp($self)
	{
        $attr = ev_fmEditorSettings::getAttri();
        if ($attr)
            $attr->style = ev_fmEditorSettings::getStyle($attr->style, c($self)->checked, 'fsItalic');    
    }
}

class ev_fmEditorSettings_c_underline 
{
    public static function onMouseUp($self)
	{
        $attr = ev_fmEditorSettings::getAttri();
        if ($attr)
            $attr->style = ev_fmEditorSettings::getStyle($attr->style, c($self)->checked, 'fsUnderline');
    }
}

class ev_fmEditorSettings_list 
{
    public static function onClick($self)
	{
        $attr = ev_fmEditorSettings::getAttri();
		
        if ($attr)
		{
            ev_fmEditorSettings::$bColor->value = $attr->background;
            ev_fmEditorSettings::$fColor->value = $attr->foreground;
            c('fmEditorSettings->c_bold')->checked = strpos($attr->style, 'fsBold') !== false;
            c('fmEditorSettings->c_italic')->checked = strpos($attr->style, 'fsItalic') !== false;
            c('fmEditorSettings->c_underline')->checked = strpos($attr->style, 'fsUnderline') !== false;
        }
    }
}

class ev_fmEditorSettings_c_config 
{
    public static function onChange($self)
	{
        $files = _c($self)->items->lines;
        $index = _c($self)->itemIndex;
        ev_fmEditorSettings::loadHightLight($files[$index]);
    }
}

class ev_fmEditorSettings_btn_addcfg 
{
    public static function onClick($self)
	{
        $self  = c('fmEditorSettings->c_config')->self;
        $files = _c($self)->items->lines;
        $index = _c($self)->itemIndex;
		
        $name  = inputText(t('Add highlight'), t('Name'), $files[$index]);
        $name  = str_ireplace(array('?','\\','/','>','<','|','"',':'), '', $name);
        
        if ($name)
		{
            ev_fmEditorSettings::saveHightLight($name);
            ev_fmEditorSettings::updateHighLightCfg();
        } else {
			MessageBox(t('Invalid syntax highlight name'), '', MB_ICONERROR);
		}
    }
}

class ev_fmEditorSettings_btn_delcfg 
{
    public static function onClick($self)
	{
        $self  = c('fmEditorSettings->c_config')->self;
        $files = _c($self)->items->lines;
        $index = _c($self)->itemIndex;
        
        if (!$files[$index]) 
			return;
        
        if (confirm(t('To delete "%s" highlight?', $files[$index])))
		{
            $name = $files[$index];
			
            if ($name){
                ev_fmEditorSettings::deleteHighlight($name);
                ev_fmEditorSettings::updateHighLightCfg();
            }
        }
    }
}