<?

$result   = array();

$result[] = array(
	'CAPTION' => t('Text'),
	'TYPE' => 'text',
	'PROP' => 'caption',
	'UPDATE_DSGN' => true
);

addDefProp ('Font', &$result);

$result[] = array(
	'CAPTION' => t('Color'),
	'TYPE' => 'color',
	'PROP' => 'color'
);

$result[] = array(
	'CAPTION' => t('One Color_'),
	'TYPE' => 'color',
	'PROP' => 'OneColor'
);

$result[] = array(
	'CAPTION' => t('Two Color_'),
	'TYPE' => 'color',
	'PROP' => 'TwoColor'
);

$result[] = array(
	'CAPTION' => t('Three Color_'),
	'TYPE' => 'color',
	'PROP' => 'ThreeColor'
);

$result[] = array(
	'CAPTION' => t('Four Color_'),
	'TYPE' => 'color',
	'PROP' => 'FourColor'
);

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

addDefProp ('Hint', &$result);
addDefProp('DefaultVisual', &$result);

return $result;