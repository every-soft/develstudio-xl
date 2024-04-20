<?

$result = array();
				  
$result[] = array('CAPTION'=>t('Color'), 'PROP'=>'selColor');

addDefProp ('Hint', &$result);

addDefProp('DefaultVisual', &$result);


return $result;