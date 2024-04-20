<?

class myOptions 
{
    static function get($section, $name, $def = null)
	{
        if (!isset($GLOBALS['ALL_CONFIG'][$section][$name]))
            return $def;
        else
            return $GLOBALS['ALL_CONFIG'][$section][$name];
    }
    
    static function set($section, $name, $value)
	{
        if (is_array($value) || is_object($value))
		{
            $value = base64_encode(serialize($value));
        } elseif (is_bool($value))
            $value = $value ? '1' : '0';
            
        $GLOBALS['ALL_CONFIG'][$section][$name] = $value;
    }
    
    static function setXYWH($section, $obj)
	{
        self::set($section, 'x', $obj->x);
        self::set($section, 'y', $obj->y);
        self::set($section, 'w', $obj->w);
        self::set($section, 'h', $obj->h);
    }
    
    static function getXYWH($section, $obj, $def = false)
	{
        if ($def && self::get($section, 'x', null) === null)
		{
            if (!$def){
                $obj->x = $def[0];
                $obj->y = $def[1];
                $obj->w = $def[2];
                $obj->h = $def[3];
            }
        } else {
            
            $obj->x = self::get($section,'x', $obj->x);
            $obj->y = self::get($section,'y', $obj->y);
            $obj->w = self::get($section,'w', $obj->w);
            $obj->h = self::get($section,'h', $obj->h);
        }
    }
    
    static function setFloat($section, $obj)
	{
        myOptions::set($section,'x', control_dockleft($obj->self));
        myOptions::set($section,'y', control_docktop($obj->self));
        myOptions::set($section,'w', control_dockwidth($obj->self));
        myOptions::set($section,'h', control_dockheight($obj->self));
    }
    
    static function getFloat($section, $obj)
	{
        $x = myOptions::get($section, 'x', 100);
        $y = myOptions::get($section, 'y', 100);
        $w = myOptions::get($section, 'w', $obj->w);
        $h = myOptions::get($section, 'h', $obj->h);
        
        $x = $x - GetSystemMetrics(32);
        $y = $y - GetSystemMetrics(SM_CYSMCAPTION) - GetSystemMetrics(32);
        
        $obj->manualFloat($x,$y, $x + $w, $y + $h);
    }
    
    static function ProjectOptions()
	{
        global $myProject, $projectFile;
        
        $list = c('fmProjectOptions->list');
        $list->clear();
        
        $modules = findFiles(SYSTEM_DIR . '/../ext/','dll');

        $list->items->setArray($modules);
        $list->checkedItems = (array)$myProject->config['modules'];   
        
        c('fmProjectOptions->c_debugmode')->checked = $myProject->config['debug']['enabled'];
        c('fmProjectOptions->c_ignorewarnings')->checked = $myProject->config['debug']['no_warnings'];
        c('fmProjectOptions->c_ignoreerrors')->checked = $myProject->config['debug']['no_errors'];
        
        c('fmProjectOptions->c_programtype')->itemIndex = (int)$myProject->config['prog_type'];
        
        c('fmProjectOptions->e_apptitle')->text    = $myProject->config['apptitle'];
        c('fmProjectOptions->e_programname')->text = basenameNoExt($projectFile);
        
		/****** event *****/
		if (!CApi::doEvent('onProjectOptionsDialog',array())) return;
		/****** ---- *****/ 
        
        if (c('fmProjectOptions')->showModal() == mrOk)
		{
            /****** event *****/
            if (!CApi::doEvent('onProjectOptions',array())) return;
            /****** ---- *****/
            
            $myProject->config['debug']['enabled'] = c('fmProjectOptions->c_debugmode')->checked;
            $myProject->config['debug']['no_warnings'] = c('fmProjectOptions->c_ignorewarnings')->checked;
            $myProject->config['debug']['no_errors'] = c('fmProjectOptions->c_ignoreerrors')->checked;
            $myProject->config['prog_type'] = c('fmProjectOptions->c_programtype')->itemIndex;
            
            $myProject->config['apptitle'] = c('fmProjectOptions->e_apptitle')->text;
            $projectFile = dirname($projectFile) . '/' . c('fmProjectOptions->e_programname')->text . '.msppr';
            
            $myProject->config['modules'] = $list->checkedItems;
            
            myModules::clear();
            myModules::inc();
            
            myProject::save();
            
            /****** event *****/
            if (!CApi::doEvent('onProjectOptionsAfter', array())) return;
            /****** ---- *****/
        }
    }
    
    
    static function saveExeDialog()
	{
        $dlg = new TSaveDialog ();
        $dlg->filter = 'EXE File (*.exe)|*.exe';
        
        if ($dlg->execute())
		{
            $dlg->fileName = fileExt($dlg->fileName) == 'exe' ? $dlg->fileName : $dlg->fileName . '.exe';
            
            if (file_exists ($dlg->fileName))
			{
                $res = messageBox (t('Warning') . t(': File %s exists!', $dlg->fileName), t('Warning'), MB_OKCANCEL + MB_ICONWARNING);
				
				if ($res == idCancel)
					return;
				
			}
			
			if (!is_dir (dirname($dlg->fileName)))
				mkdir(dirname($dlg->fileName), 0777, true);
            
            c('fmBuildProgram->path')->text = $dlg->fileName;
        }
        
        $dlg->free();
    }
    
    static function openIconDialog()
	{
        $dlg = new TOpenDialog;
        $dlg->filter = 'Icon files (*.ico)|*.ico';
        
        if ($dlg->execute())
		{
            $ico = $dlg->fileName;
			
			if ((!is_readable($ico)) or (fileExt($ico) <> 'ico'))
				return false;
			
            c('fmBuildProgram->im_icon')->picture->loadFromFile ($ico);
            myVars::set ($ico, '__iconFile');
        }
    }
    
    static function saveSettings()
	{
        global $projectFile;
        
        $file = dirname($projectFile).'/build.cfg';
        $ini  = new TIniFileEx ($file);
		
        $ini->write('main','path', c('fmBuildProgram->path')->text);
        $ini->write('main','attachsoulengine',c('fmBuildProgram->c_attachsoulengine')->checked);
        $ini->write('main','attachdata', c('fmBuildProgram->c_attachdata')->checked);
        $ini->write('main','upx_level', c('fmBuildProgram->c_upx')->itemIndex);
        $ini->write('main','company', c('fmBuildProgram->e_companyname')->text);
        $ini->write('main','version', c('fmBuildProgram->e_version')->text);
        $ini->write('main','use_bcompiler', c('fmBuildProgram->use_bcompiler')->checked);
        $ini->write('main','use_obfuscate', c('fmBuildProgram->use_obfuscate')->checked);
		$ini->write('main','use_protector', c('fmBuildProgram->use_protector')->checked);
		$ini->write('main','use_joiner', c('fmBuildProgram->use_joiner')->checked);

        $fileIco = SYSTEM_DIR . '/blanks/project.ico';
        if (file_exists($GLOBALS['__iconFile']))
		{
            x_copy($GLOBALS['__iconFile'], dirname($projectFile).'/build.ico');
            $ini->write('main', 'icon', dirname($projectFile).'/build.ico');
        }
        
        $ini->updateFile();
    }
    
    static function loadSettings()
	{
        global $projectFile;
        
        $file = dirname($projectFile).'/build.cfg';
        $ini  = new TIniFileEx($file);
        $path = dirname($projectFile).'/build/'.basenameNoExt($projectFile).'.exe';
        
        c('fmBuildProgram->path')->text = $ini->read('main','path', $path);
        c('fmBuildProgram->c_attachsoulengine')->checked = $ini->read('main', 'attachsoulengine', true);
        c('fmBuildProgram->c_attachdata')->checked = $ini->read('main', 'attachdata', true);
        c('fmBuildProgram->c_upx')->itemIndex = $ini->read('main', 'upx_level', 0);
        c('fmBuildProgram->e_companyname')->text = $ini->read('main', 'company', '');
        c('fmBuildProgram->e_version')->text = $ini->read('main', 'version', '1.0.0.0');
        c('fmBuildProgram->use_bcompiler')->checked = $ini->read('main', 'use_bcompiler', false); // fix
        c('fmBuildProgram->use_obfuscate')->checked = $ini->read('main', 'use_obfuscate', false);
		c('fmBuildProgram->use_protector')->checked = $ini->read('main', 'use_protector', false);
		c('fmBuildProgram->use_joiner')->checked = $ini->read('main', 'use_joiner', false);

        $iconFile = $ini->read('main', 'icon', '');
        if ($iconFile){
            c('fmBuildProgram->im_icon')->picture->loadFromFile($iconFile);
            myVars::set($iconFile, '__iconFile');    
        }
		
    }
    
    static function BuildProgram()
	{
        c('fmBuildProgram->btn_path')->onClick = 'myOptions::saveExeDialog';
        c('fmBuildProgram->btn_icon')->onClick = 'myOptions::openIconDialog';
		
        c('fmBuildProgram->btn_savesettings')->onClick = function($self)
		{
            myOptions::saveSettings();
            message_beep(66);
        };
		
        c('fmBuildProgram->use_joiner')->onClick = function($self)
		{
            MessageBox(t('ATTENTION! The compiled file will be glued together with ALL the files and folders that are in the compilation directory! Put in the compilation directory only those files with which you want to glue your exe.'), '', MB_ICONWARNING);
        };
        
        /****** event *****/
        if (!CApi::doEvent('onBuildDialog',array())) return;
        /****** ---- *****/
        
        self::loadSettings();
        
        if (c('fmBuildProgram')->showModal() == mrOk)
		{
            self::saveSettings();
            
            /****** event *****/
            if (!CApi::doEvent('onBuild',array())) return;
            /****** ---- *****/

            myCompile::adv_start (
                                 c('fmBuildProgram->path')->text,
                                 c('fmBuildProgram->c_attachsoulengine')->checked,
                                 c('fmBuildProgram->c_attachdata')->checked,
                                 c('fmBuildProgram->c_upx')->itemIndex,
                                 c('fmBuildProgram->e_companyname')->text,
                                 c('fmBuildProgram->e_version')->text,
                                 myVars::get('__iconFile'),
								 c('fmBuildProgram->use_bcompiler')->checked,
								 c('fmBuildProgram->use_obfuscate')->checked,
								 c('fmBuildProgram->use_protector')->checked,
								 c('fmBuildProgram->use_joiner')->checked
                                );
            
            if (err_msg())
			{
                MessageBox (t('Please, select correct path for your program!'), '', MB_ICONERROR);
                self::BuildProgram();
				
                return;
            }
            
            /****** event *****/
            if (!CApi::doEvent('onBuildAfter',array())) return;
            /****** ---- *****/

            message_beep(66);
        }
    }

    static function Options()
	{
        global $_sc;
		
        c('fmOptions->c_showgrid')->checked = (bool) myOptions::get('sc', 'showGrid', false);
        c('fmOptions->e_gridsize')->text = myOptions::get('sc', 'gridSize', 8);
		
        c('fmOptions->backup_active')->checked = (bool) myOptions::get('backup', 'active', true);
		c('fmOptions->backup_dir')->text = myBackup::$dir;
		c('fmOptions->backup_interval')->text = (int) myOptions::get('backup', 'interval', 2);
		
		/****** event *****/
		if (!CApi::doEvent('onOptionsDialog',array())) return;
		/****** ---- *****/
        
        if (c('fmOptions')->showModal() == mrOk)
		{
            /****** event *****/
            if (!CApi::doEvent('onOptions',array())) return;
            /****** ---- *****/
            
            myOptions::set('sc', 'showGrid', c('fmOptions->c_showgrid')->checked);
			
			myOptions::set('backup','active', c('fmOptions->backup_active')->checked);
			myOptions::set('backup', 'interval', (int) c('fmOptions->backup_interval')->text);
			
			myBackup::updateSettings();
			
            $_sc->showGrid = (bool) myOptions::get('sc', 'showGrid', false);
            
            if ((int) c('fmOptions->e_gridsize')->text > 0)
			{
                myOptions::set('sc', 'gridSize', (int)c('fmOptions->e_gridsize')->text);
                $_sc->gridSize = myOptions::get('sc', 'gridSize', 8);
            }
            
            c('fmEdit')->repaint();
            
            /****** event *****/
            if (!CApi::doEvent('onOptionsAfter',array())) return;
            /****** ---- *****/
        }
    }
}

class myBackup 
{
	static $dir = 'backup';
	static $timer;

	static function doInterval ($forced = false)
	{
		global $projectFile;
		
		if  (myOptions::get('backup', 'active', true) || $forced === true)
		{
			$dir = dirname($projectFile) . '/' . self::$dir . '/';
			
			if (!is_dir($dir))
				mkdir($dir, 0777, true);
				
			$file = basenameNoExt($projectFile) . ' ' . date('(h.i d.m.Y)');

			myProject::saveAsDVS($dir . $file . '.dvs');
			myCompile::setStatus (t('Backup'), t('Creating a Backup') . ' - ' . '"' . self::$dir . '/'. $file . '.dvs"');
		}
	}
	
	static function setInterval($min)
	{
		if ($min < 1)
			$min = 1;
		
		if (is_object(self::$timer))
			self::$timer->interval = $min * 60000;
	}
	
	static function setActive($active)
	{
		if (is_object(self::$timer))
			self::$timer->enable = (bool) $active;
	}
	
	static function updateSettings()
	{
		self::setActive(myOptions::get('backup', 'active', true));
		self::setInterval((int) myOptions::get('backup', 'interval', c('fmOptions->backup_interval')->text));

		if (myOptions::get('backup', 'active', true))
			self::doInterval();
	}
	
	static function init()
	{
		self::$timer = Timer::setInterval('myBackup::doInterval', 60000 * myOptions::get('backup', 'interval', 2));    
	}
}

myBackup::init();