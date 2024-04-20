<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'simpleText',
                  );

addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Auto Hint'),
                  'TYPE'=>'check',
                  'PROP'=>'autoHint',
                  );


$result[] = array(
                  'CAPTION'=>t('Use System Font'),
                  'TYPE'=>'check',
                  'PROP'=>'useSystemFont',
                  );

addDefProp ('DefaultVisual', &$result);

return $result;