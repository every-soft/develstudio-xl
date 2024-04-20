<?

class ev_fmProjectOptions_list {
    
    function onClick($self){
        
        $list = c($self);
        $name = $list->inText;
		
		$glang = file_exists(dirname(EXE_NAME).'/ext/help/'.LANG_ID)? strtolower(LANG_ID).'/': 'en/';
		
		if( file_exists(dirname(EXE_NAME).'/ext/help/'.$glang.basenameNoExt($name).'.rtf') )
		{
			c('fmProjectOptions->mod_desc')->loadFromFile(dirname(EXE_NAME).'/ext/help/'.$glang.basenameNoExt($name).'.rtf');
		} elseif (file_exists(dirname(EXE_NAME).'/ext/help/'.$glang.basenameNoExt($name).'.txt') ) {
			
			c('fmProjectOptions->mod_desc')->loadFromFile(dirname(EXE_NAME).'/ext/help/'.$glang.basenameNoExt($name).'.txt');
			
		} else {
			c('fmProjectOptions->mod_desc')->Text = '(' . t('No description') . ')';	
		}
        
    }
	
}

class ev_fmProjectOptions{
	
	function onShow($self)
	{
		c('fmProjectOptions->mod_desc')->text = t('To read description of module, click on it in this list') . '.';
	}
	
}