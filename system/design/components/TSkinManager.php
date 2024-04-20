<?

$result = array();

$result['GROUP']   = 'DSXL';
$result['CLASS']   = basenameNoExt(__FILE__);
$result['CAPTION'] = t('TSkinManager_Caption');
$result['SORT']    = 1;
$result['NAME']    = 'skinManager';

$result['MODULES'] = array('php_skins.dll');

return $result;