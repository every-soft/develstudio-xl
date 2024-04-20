<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Enabled color'),
                  'TYPE'=>'color',
                  'PROP'=>'enabledColor',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Disabled color'),
                  'TYPE'=>'color',
                  'PROP'=>'disabledColor',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Switched'),
                  'TYPE'=>'check',
                  'PROP'=>'switched',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Smoothness'),
                  'TYPE'=>'check',
                  'PROP'=>'smoothness',
                  );
addDefProp ('Hint', &$result);

addDefProp('DefaultVisual', &$result);

return $result;