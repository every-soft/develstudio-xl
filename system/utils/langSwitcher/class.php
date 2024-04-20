<?
	
function langSwitcher($lang)
{
    myOptions::set('main', 'lang', $lang['lang']);
	
	$res = MessageBox (t("To apply the changes, restart DevelStudio. \nDo you want to do this now?"), t("Lang switch"), MB_ICONWARNING + MB_YESNO);
	
	if ($res == mrYes)
	{
		$t = new TThread ('ev_it_restart::close'); 
		$t->resume();
		
		evfmMain::saveMainConfig();
		application_terminate();
	}
}

$langs = findFiles(DOC_ROOT . '/lang/', 'lng', false, true);

foreach ($langs as $lang)
{
	$i                             = parse_ini_file($lang);
	$i["lang"]                     = basenameNoExt($lang);
	$infos[basenameNoExt($lang)][] = $i;
}

BlockData::sortList($infos, 'sort');

foreach ($infos as $info)
{
	$info = $info[0];
	
	$item = menuItem($info['title'], true, false, function($self) use ($info)
	{
		langSwitcher($info);
	}, false, DOC_ROOT . '/lang/' . $info['lang'] . '/icon.png');
	
    $def = substr(strtolower(osinfo_syslang()), 0, 2);
	
    if( $info['lang'] == myOptions::get('main', 'lang', $def) )
        $item->enabled = 0;
        
    
	c('fmMain->MainMenu')->addItem($item, c('fmMain->itLanguage'));
}