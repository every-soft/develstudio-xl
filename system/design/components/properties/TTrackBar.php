<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Frequency'),
                  'TYPE'=>'number',
                  'PROP'=>'frequency',
                  );

$result[] = array(
                  'CAPTION'=>t('Line Size'),
                  'TYPE'=>'number',
                  'PROP'=>'lineSize',
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
                  'PROP'=>'Orientation',
                  'VALUES'=>array('trHorizontal', 'trVertical'),
                  );

$result[] = array(
                  'CAPTION'=>t('Slider Visible'),
                  'TYPE'=>'check',
                  'PROP'=>'sliderVisible',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Show Select Range'),
                  'TYPE'=>'check',
                  'PROP'=>'showSelRange',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('ToolTip Position'),
                  'TYPE'=>'combo',
                  'PROP'=>'positionToolTip',
				  'VALUES'=>array('ptBottom', 'ptLeft', 'ptNone', 'ptRight', 'ptTop'),
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Thumb Length'),
                  'TYPE'=>'number',
                  'PROP'=>'thumbLength',
                  );
$result[] = array(
                  'CAPTION'=>t('Tick Marks'),
                  'TYPE'=>'combo',
                  'PROP'=>'tickMarks',
                  'VALUES'=>array('tmBottomRight', 'tmTopLeft', 'tmBoth'),
                  );
$result[] = array(
                  'CAPTION'=>t('Tick Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'tickStyle',
                  'VALUES'=>array('tsNone', 'tsAuto', 'tsManual'),
                  );
addDefProp ('Hint', &$result);
$result[] = array(
                  'CAPTION'=>t('Tab Order'),
                  'TYPE'=>'number',
                  'PROP'=>'tabOrder',
                  );
$result[] = array(
                  'CAPTION'=>t('Tab Stop'),
                  'TYPE'=>'check',
                  'PROP'=>'tabStop',
                  );

addDefProp('DefaultVisual', &$result);


return $result;