<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  'UPDATE_DSGN'=>1,
                  );
				  
addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Pressed color'),
                  'TYPE'=>'color',
                  'PROP'=>'pressedColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Entered color'),
                  'TYPE'=>'color',
                  'PROP'=>'enteredColor',
                  );
addDefProp ('Hint', &$result);
$result[] = array(
	'CAPTION' => t('Auto Size'),
	'TYPE' => 'check',
	'PROP' => 'autoSize',
	'UPDATE_DSGN' => true
);

$result[] = array(
	'CAPTION' => t('Word Wrap'),
	'TYPE' => 'check',
	'PROP' => 'wordWrap'
);
addDefProp('DefaultVisual', &$result);

return $result;