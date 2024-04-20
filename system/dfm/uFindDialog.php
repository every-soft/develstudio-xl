<?php

// Искать
class ev_fmFindDialog_findText 
{
	static function onChange($self)
	{
		unset($GLOBALS['__find']);
		unset($GLOBALS['__findIndex']);
	}
	
	static function onKeyDown($self, $key)
	{
        if ($key == 13 || $key == 114)
		{
            if (!c('fmFindDialog->findText')->text) 
				return;
            
            if (!isset($GLOBALS['__findIndex']))
                $GLOBALS['__findIndex'] = 0;

            c('fmPHPEditor->memo')->selStart = 0;
            c('fmPHPEditor->memo')->selEnd = 0;

            $item = myEvents::findTextItem($GLOBALS['__findIndex']);

            if (!isset($item))
			{
				$GLOBALS['__findIndex'] = 0;

                if (sizeof($GLOBALS['__find']) == 0)
				{
                    MessageBox (t('Nothing found.'), '', MB_ICONERROR);
                } 
				else
				{
                    MessageBox(t("Search is over. Found %s matches.", sizeof($GLOBALS['__find'])), '', MB_ICONINFORMATION);
					
					c('fmFindDialog->findText')->enabled = false;
					c('fmFindDialog->findText')->enabled = true;	
				}
				
				return;
            }
			
			list($start, $length) = $item;
            
            ++$GLOBALS['__findIndex'];
            
            c('fmPHPEditor->memo')->selStart = $start;
            c('fmPHPEditor->memo')->selEnd = $start + $length;
        }
	}
}

// Заменить
class ev_fmFindDialog_replaceText
{
	function onKeyDown($self, $key) 
	{
		if ($key == 13 || $key == 114)
		{
			if (!c('fmPHPEditor->memo')->selText)
			{
				unset($GLOBALS['__find']);
				unset($GLOBALS['__findIndex']);
				
				ev_fmFindDialog_findText::onKeyDown(0, 13);
				return;
			}

			c('fmPHPEditor->memo')->selText = c('fmFindDialog->replaceText')->text;
			
			unset($GLOBALS['__find']);
			unset($GLOBALS['__findIndex']);
		}
	}
}

// Заменить всё
class ev_fmFindDialog_replaceAll
{
	public static function onClick($self)
	{
		$findText = c('fmFindDialog->findText')->text;
		$replaceText = c('fmFindDialog->replaceText')->text;
		$text = c('fmPHPEditor->memo')->text;
		
		if (!$findText or !$text)
		{
			MessageBox (t('Nothing found.'), '', MB_ICONERROR);
			return;
		}
	
		$c = val('fmFindDialog->reg') ? substr_count($text, $findText) : substr_count(strtolower($text), strtolower($findText));
		
		if (!$c)
		{
			MessageBox (t('Nothing found.'), '', MB_ICONERROR);
			return;
		}

		c('fmPHPEditor->memo')->text = val('fmFindDialog->reg') ? str_replace ($findText, $replaceText, $text) : str_ireplace ($findText, $replaceText, $text);
		
		unset($GLOBALS['__find']);
        unset($GLOBALS['__findIndex']);
		
		MessageBox (t("Replacement is over. Replaced %s matches.", $c), '', MB_ICONINFORMATION);
	}
}

class ev_fmFindDialog_next
{
	static function onClick ($self)
	{
		ev_fmFindDialog_findText::onKeyDown(0, 13);
	}
}

class ev_fmFindDialog_replace
{
	public static function onClick($self) 
	{
		ev_fmFindDialog_replaceText::onKeyDown(0, 13);
	}
}

?>