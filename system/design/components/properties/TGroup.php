<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('caption'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
$result[] = array(
                  'CAPTION'=>t('font'),
                  'TYPE'=>'font',
                  'PROP'=>'font',
                  'CLASS'=>'TFont',
                  );

addDefProp ('Hint', &$result);

addDefProp('DefaultVisual', &$result);
return $result;