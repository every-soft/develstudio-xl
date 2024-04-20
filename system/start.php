<?

/*
	DevelStudio XL
	Every Software project
	
	vk.com/evsoft
*/

err_status (false); // отключаем вывод ошибок

define('DS_USERDIR', winLocalPath (CSIDL_PERSONAL) . '/DevelStudio XL/');
$ini = new TIniFileEx (DS_USERDIR . 'allconfig.ini');
$GLOBALS['ALL_CONFIG'] = $ini->arr;

require 'libs/mvc.php';

define_ex('DV_YEAR', 2021);
define_ex('DV_VERSION', '3.4.0.0');
define_ex('DV_PREFIX', '21 Release');

if (!EMULATE_DVS_EXE)
{
	loader::lib ('data');
	loader::model ('options');

	$def = substr (strtolower (osinfo_syslang ()), 0, 2);

	$lang = myOptions::get ('main', 'lang', $def);
	$lang_charset = myOptions::get ('main', 'lang_charset', 'DEFAULT_CHARSET');

	define_ex ('LANG_CHARSET', constant ($lang_charset));
	define_ex ('LANG_ID', $lang);
	Localization::setLocale ($lang);
	
	loader::model ('compile');
}

loader::modules ('modules');
loader::lib ('syntax');
loader::lib ('zip');
loader::lib ('docking');
loader::lib ('bcompiler');

if (!EMULATE_DVS_EXE)
{
	loader::model ('props');
	loader::model ('codegen');
	loader::model ('syntaxCheck');
	loader::model ('design');
	loader::model ('copyer');
	loader::model ('properties');
	loader::model ('images');
	loader::model ('events');

	loader::model ('inspector');
	loader::model ('project');
	loader::model ('modules');
	loader::model ('winres');
	loader::model ('upx');
	loader::model ('history');
	loader::model ('debug');
	loader::model ('masters');
	loader::model ('complete');
	loader::model ('build');
	
	loader::model ('utils');
}

loader::model ('evalproject');

if (!EMULATE_DVS_EXE)
{
	loader::model ('dialogs_ex');
	loader::model ('propcomponents_ex');
	loader::model ('dsapi');
}