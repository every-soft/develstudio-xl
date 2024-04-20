<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Caption'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  );
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
				  
addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Background'),
                  'TYPE'=>'check',
                  'PROP'=>'parentBackground',
                  );

addDefProp ('Hint', &$result);
$result[] = array(
                  'CAPTION'=>t('Transparent'),
                  'TYPE'=>'check',
                  'PROP'=>'transparent',
                  );
$result[] = array(
                  'CAPTION'=>t('Double Buffered'),
                  'PROP'=>'doubleBuffered',
                  );

addDefProp('DefaultVisual', &$result);

return $result;