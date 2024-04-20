<?php

class scriptsMaster
{
	
	// initialization
	public static function init ()
	{
		c('scriptList->checkList1')->onClick = __CLASS__ . '::' . 'onCheckClick';
	}
	
	// on checkbox click
	public static function onCheckClick ($self)
	{
		global $projectFile;
		$self = _c($self);
		
		if ($self->itemIndex == -1)
			return;

		$file = $self->items->selected;
		
		$class = dirname($projectFile) . '/scripts/' . $file;
		$script = DOC_ROOT . 'classes/' . $file;
		
		if (!is_file($script))
			return;

		if ($self->isChecked ($self->itemIndex)) 
		{
			x_copy ($script, $class);
			
		} else if (is_file($class)) 
		{
			if (md5_file($class) != md5_file($script))
				return;
				
			$script = realpath($class);
			unlink($class);
		}

		self::sl_updateList();
	}
	
	// listBox update
	public static function sl_updateList ()
	{
		global $projectFile;
		dir_search (dirname($projectFile) . '/scripts', $files, 'php', false, false);

		c("scriptList->listBox1")->text = $files;
	}
	
	// checkList update
	public static function cb_updateList ()
	{
		dir_search (DOC_ROOT . 'classes', $files, 'php', false, false);

		c("scriptList->checkList1")->text = $files;
		c("scriptList->checkList1")->checkedItems = c("scriptList->listBox1")->items->lines;
	}
	
	// editing script
	public static function do_edit ($self)
	{
		shell_execute(false, 'open', self::file() , '', '', SW_SHOW);
	}
	
	public static function file ()
	{
		global $projectFile;
		$file = (c("scriptList->checkList1")->itemIndex != -1) ? DOC_ROOT . 'classes/' . c("scriptList->checkList1")->items->selected : dirname($projectFile) . '/scripts/' . c("scriptList->listBox1")->items->selected;
		
		return realpath($file);
	}
	
	// deleting script
	public static function do_delete ($self)
	{
		if (!confirm(t('Do you really want to delete the selected file?')))
			return;
		
		$file = self::file();
		if (file_exists($file))
			unlink ($file); // fix bug
		
		// Update all
		self::sl_updateList();
		self::cb_updateList();	
	}
	
	// add script
	public static function do_add ($self, $file = false)
	{
		global $projectFile;
		$toCopy = (c("scriptList->checkList1")->itemIndex != -1) ? DOC_ROOT . 'classes' : dirname($projectFile).'/scripts';

		if ($file !== false) 
		{
			if (is_file($file) && checkExt($file, 'php'))
				x_copy ($file, $toCopy .'/'. basename($file));
			
		} else { 
			if (($files = returnFiles('php')) !== false)
			{
				foreach ($files as $file)
					x_copy ($file, $toCopy .'/'. basename($file));
			}
			
		}

		// Update all
		self::sl_updateList();
		self::cb_updateList();
	}
	
	// onDropFiles handler
	public static function dropFile ($self, $files, $x, $y)
	{
		if (empty ($files))
			return;
		
		$files = explode ("\n", $files); // make array from string
		array_pop(&$files); // delete ''
		
		foreach ($files as $file)
			self::do_add ($self, $file);
	}
}

class master_scriptsMaster 
{ 
    public static function open()
	{
        $project = evalProject::open(dirname(__FILE__).'/scriptsMaster.dvs');
        $project->showModal();
    }
}

// добавляем пункт меню
c('fmMain->itProject')->insertAfter (c('fmMain->it_buildproject'),
            menuItem(t('Scripts of project'), true, 'itScriptsMaster', 'master_scriptsMaster::open',
                     false, dirname(__FILE__).'/icon.bmp')
            );
?>