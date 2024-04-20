<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Skinization'),
                  'TYPE'=>'check',
                  'PROP'=>'skinization',
                  );
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Background Color'),
                  'TYPE'=>'color',
                  'PROP'=>'backgroundColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Minimum'),
                  'TYPE'=>'number',
                  'PROP'=>'min',
                  );

$result[] = array(
                  'CAPTION'=>t('Maximum'),
                  'TYPE'=>'number',
                  'PROP'=>'max',
                  );

$result[] = array(
                  'CAPTION'=>t('Position'),
                  'TYPE'=>'number',
                  'PROP'=>'position',
                  );

$result[] = array(
                  'CAPTION'=>t('Orientation'),
                  'TYPE'=>'combo',
				  'PROP'=>'type',
                  'VALUES'=>array('pbHorizontal', 'pbVertical'),
                  );

$result[] = array(
                  'CAPTION'=>t('Step'),
                  'TYPE'=>'number',
                  'PROP'=>'step',
                  );

$result[] = array(
                  'CAPTION'=>t('Smooth'),
                  'TYPE'=>'check',
                  'PROP'=>'smooth',
                  );
addDefProp ('Hint', &$result);

addDefProp('DefaultVisual', &$result);

return $result;