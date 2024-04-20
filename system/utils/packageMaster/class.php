<?

include_once dirname(__FILE__).'/pclzip.lib.php';

function showInstallPak($file)
{
	$params = CApi::readDSPak ($file);
	
	if (!$params)
		return MessageBox(t('Could not parse DSPAK file').'.', '', MB_ICONERROR);
	
	if (CApi::packageExists($params['name']))
	{
	   $new_ver  = $params['ver'];
	   $last_ver = CApi::packageVer($params['name']);

	   if ($new_ver == $last_ver)
	   {
			MessageBox(t("The package %s is already installed!", $params['name']), '', MB_ICONERROR);
			return;
		
	   } elseif (compareVer($new_ver, $last_ver) !== 1)
	   {
			MessageBox(t("The %s package is already installed with latest version!", $params['name']), '', MB_ICONERROR);
			return;
		
   } else {
		if (MessageBox(t("Package %s is already installed, do you want to update it?", $params['name']), t("Question"), MB_OKCANCEL) == mrOk)
		{
			 CApi::unInstallPak($params['name']);
			 
		} else
		  return;
	   }

	}

	c("dlgConfirmInstallPak->l_name")->caption = /*$params['caption'] . ' ['.*/$params['name']/*.']'*/;
	c("dlgConfirmInstallPak->l_version")->caption  = $params['ver'];
	c("dlgConfirmInstallPak->l_desc")->caption = $params['desc'];
	
	if ($params['site']) 
	{
		c("dlgConfirmInstallPak->l_author")->caption = $params['site'];
		c("dlgConfirmInstallPak->l_site")->caption = t('Site:');
		c("dlgConfirmInstallPak->l_site")->link = $params['site'];

	} elseif($params['author']) 
	{
		c("dlgConfirmInstallPak->l_author")->caption = $params['author'];
		c("dlgConfirmInstallPak->l_site")->caption = t('Author:');
	}
	
	c("dlgConfirmInstallPak")->file = $file;
	c("dlgConfirmInstallPak")->showModal();

}

class master_Packages 
{
    static function init()
	{  
        evalProject::open(dirname(__FILE__).'/packageMaster.dvs');
    }
    
    static function installPak($file)
	{
        self::init();
        
        $ext = fileExt($file);
            
		if ($ext == 'zipdspak')
		{
			$rand = rand();
			$zip = new PclZip($file);
			$zip->extract(PCLZIP_OPT_PATH, TEMP_DIR . '/devels/dspaks/' . $rand . '/');
			
			$file = TEMP_DIR . '/devels/dspaks/' . $rand . '/' . basenameNoExt($file) . '.dspak';
		}
        
        showInstallPak($file);
    }
    
    static function install($self)
	{
        self::init();
		
		static $dlg;
		if (!isset ($dlg))
		{
			$dlg = new TOpenDialog;
			$dlg->filter = 'All DS Packages|*.zipdspak';
			$dlg->options = 'ofNoLongNames,ofNoNetworkButton,ofFileMustExist,ofNoValidate';
        }
		
        if ($dlg->execute())
		{
            self::installPak($dlg->fileName);
        }
    }
    
    static function alist($self)
	{
        self::init();
        showPackagesList();
    }
	
	// onDropFiles handler
	public static function dropFile ($self, $files, $x, $y)
	{
		if (empty ($files))
			return;
		
		$files = explode ("\n", $files);
		self::installPak ($files[0]);
	}
}

$item = menuItem(t('Packages'), true, 'itPackages');

// добавляем пункт меню
c('fmMain->MainMenu')->items->insertAfter( c('fmMain->itProject'),
            $item
            );

$itInstall = menuItem(t('Install Package'), true, 'itInstallPackage',
                        'master_Packages::install', false, dirname(__FILE__).'/img/install.bmp');

$item->addItem($itInstall);
$item->addItem(menuItem('-', true));

$itPackages = menuItem(t('Packages List'), true, 'itPackagesList', 'master_Packages::alist');
$item->addItem($itPackages);