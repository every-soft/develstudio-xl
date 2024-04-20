<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('File name'),
                  'TYPE'=>'files',
				  'EXT'=>array('skf'),
                  'RECURSIVE'=>true,
                  'PROP'=>'skinPath',
                  );

$result[] = array(
                  'CAPTION'=>t('Enable skin'),
                  'TYPE'=>'check',
                  'PROP'=>'skinEnable',
                  );

return $result;