<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Small mode'),
                  'TYPE'=>'check',
                  'PROP'=>'smallMode',
                  );
$result[] = array(
                  'CAPTION'=>t('Options'),
                  'TYPE'=>'list',
				  'VALUES'=>array('cdFullOpen', 'cdPreventFullOpen', 'cdShowHelp', 'cdSolidColor', 'cdAnyColor'),
                  'PROP'=>'options',
                  );
return $result;