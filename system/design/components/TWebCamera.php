<?

$result = array();

$result['GROUP']   = 'system';
$result['CLASS']   = basenameNoExt(__FILE__);
$result['CAPTION'] = t('TWebCamera_Caption');
$result['SORT']    = 251;
$result['NAME']    = 'webCam';
$result['MODULES'] = array('php_MWeb_Cam.dll'/*, 'php_Scren.dll'*/);

$result['W'] = 50;
$result['H'] = 50;

return $result;