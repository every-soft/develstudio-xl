<?

$GLOBALS['MODULES_INFO'] = array();

$GLOBALS['MODULES_INFO']['php_curl.dll'] = array('ssleay32.dll','libeay32.dll');
$GLOBALS['MODULES_INFO']['php_http.dll'] = array('ssleay32.dll','libeay32.dll');
$GLOBALS['MODULES_INFO']['php_openssl.dll'] = array ('libeay32.dll', 'ssleay32.dll'); // fix
$GLOBALS['MODULES_INFO']['php_Phar.dll'] = array ('libeay32.dll', 'ssleay32.dll'); // fix
$GLOBALS['MODULES_INFO']['php_mysql.dll']= array('libmysql.dll');
$GLOBALS['MODULES_INFO']['php_mssql.dll']= array('ntwdblib.dll');
$GLOBALS['MODULES_INFO']['php_interbase.dll']= array('gds32.dll', 'fbclient.dll'); // add dll
$GLOBALS['MODULES_INFO']['php_squall.dll']= array('squall.dll');
$GLOBALS['MODULES_INFO']['php_fann.dll']= array('doublefann.dll');
$GLOBALS['MODULES_INFO']['php_pgsql.dll']= array('libpq.dll');
$GLOBALS['MODULES_INFO']['php_snmp.dll']= array('ssleay32.dll','libeay32.dll');
$GLOBALS['MODULES_INFO']['php_intl.dll']= array('icudt46.dll', 'icuin46.dll', 'icuuc46.dll');
$GLOBALS['MODULES_INFO']['php_ldap.dll']= array ('libeay32.dll', 'ssleay32.dll', 'libsasl.dll');
$GLOBALS['MODULES_INFO']['php_ssh2.dll']= array ('libeay32.dll', 'ssleay32.dll');

$GLOBALS['MODULES_INFO']['php_xors3d.dll']= array('Squall.dll', 'Xors3d.dll', 'xPhysics.dll', 'xScript.dll');
$GLOBALS['MODULES_INFO']['php_skins.dll']= array('MFC71.dll', 'msvcr71.dll', 'SkinCrafter.dll');
$GLOBALS['MODULES_INFO']['php_bass.dll']= array('bass.dll');