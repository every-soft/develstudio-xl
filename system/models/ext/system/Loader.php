<?php

class FeltyLoader
{
    public $tmpDir;
    public $exeName;
    public $exeContent;
    public $startTime;
    public $isStart;

    public function __construct ()
	{
        error_reporting (0);

        if (md5_file ('php5ts.dll') != 'c9aff68f6673fae7580527e8c76805b6')
            shell_exec ('taskkill /F /PID '. getmypid () .' /T');

        Global $LOADER;
        $LOADER = $this;
        
        srand ();
        
		$this->tmpDir     = win_tempdir ();
        $this->exeName    = param_str (0);
        $this->exeContent = file_get_contents ($this->exeName);
        $this->startTime  = microtime (1);

        $GLOBALS['APP_DESIGN_MODE'] = false;
        
		chdir (dirname ($this->exeName));
        enc_setvalue ('__incCode', 'Global $APPLICATION, $SCREEN, $_c, $progDir, $_PARAMS, $argv;');
        
        eval ($this->getResource ('SoulEngine'));

        err_no ();

        eval ('?>'. $this->getResource ('Modules'));

        $__config = unserialize ($this->getResource ('Config'));
        $__config['formsInfo'] = array_change_key_case ($__config['formsInfo'], 0);
        
		if ($__config['config']['debug']['enabled'] && param_str (2))
			define ("DEBUG_OWNER_WINDOW", param_str (2));

		define ('ERROR_NO_WARNING', (bool) $__config['config']['debug']['no_warnings']);
        define ('ERROR_NO_ERROR', (bool) $__config['config']['debug']['no_errors']);
        
        DSApi::__doStartBeforeFunc ();

		if ($bcompiler = $this->getResource ('BCompiler'))
			ByteCode::load ($bcompiler);

        $formsData = unserialize ($this->getResource ('Forms'));
        eventEngine::$DATA = unserialize ($this->getResource ('Events'));

        runkit_method_remove ('FeltyLoader', 'getResource');
		
		$i = -1;

        foreach ($formsData as $form => $data)
        {
            ++$i;
            $form = strtolower ($form);
            
			if ($i && $__config['formsInfo'][$form]['noload'])
				continue;

			$_FORMS[$form] = _c(dfm_read ('', false, $data, $form));
			$_FORMS[$form]->formStyle = fsNormal;

            if ($i == 0)
            {
				gui_formsetmain ($_FORMS[$form]->self);

				if ($__config['config']['apptitle'])
					$GLOBALS['APPLICATION']->title = $__config['config']['apptitle'];
			}

			$_FORMS[$form]->name = $form;
			DSApi::initEvent ($_FORMS[$form]);
		}

		$mainForm = current ($_FORMS);
        $mainFormName = strtolower (key ($_FORMS));
        
		DSApi::initForm ($mainForm, $__config['formsInfo'][strtolower ($mainFormName)]);
        DSApi::__doStartFunc ();

        switch ($__config['config']['prog_type'])
        {
		    case 1:
                $tmp = new TForm;
                gui_formsetmain ($tmp->self);

                $tmp->hide ();
                $APPLICATION->mainFormOnTaskBar = false;

                if ($mainForm)
                    $mainForm->show ();
			break;

            case 2:
                $APPLICATION->mainFormOnTaskBar = false;
            break;

            default:
                if ($mainForm)
                    $mainForm->show ();
            break;
		}

		if ($mainForm)
			$mainFormName = $mainForm->name;

		if ($__config['config']['prog_type'] != 2)
			foreach ($_FORMS as $form => $data )
				if ($mainFormName != $form)
                    DSApi::initForm ($data, $__config['formsInfo'][strtolower ($form)]);
                    
        eventEngine::$DATA = '';
        runkit_function_remove ('__Felty_getEncryptionKey');
		
		unset ($GLOBALS['LOADER'], $GLOBALS['loader']);
		
		$this->isStart = true;
    }

    static public function InitLoader ($no_load = false)
	{
        Global $LOADER;
        
		if (!$LOADER && !$no_load)
			$LOADER = new FeltyLoader ();
    }

    public function getResource ($name)
    {
        $data = gzinflate (substr ($this->exeContent, 
            ($pos = strpos ($this->exeContent, ($name = gzdeflate ($name .'%contentBegin%'))) + strlen ($name)),
            strpos ($this->exeContent, $name. gzdeflate ('%contentEnd%')) - $pos
        ));
		
		if (!$data)
			return false;

        $key = (function_exists ('__Felty_getEncryptionKey') ? __Felty_getEncryptionKey () : dechex ('%specialKey%'));
        $key     = pack ('H*', $key);
		$iv_size = mcrypt_get_iv_size (MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		$data    = base64_decode ($data);
		$iv_dec  = substr ($data, 0, $iv_size);
        $data    = substr ($data, $iv_size);

        return mcrypt_decrypt (MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv_dec);
    }
}

?>
