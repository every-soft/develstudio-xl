<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
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
                  'CAPTION'=>t('Small Change'),
                  'TYPE'=>'number',
                  'PROP'=>'smallChange',
                  );
$result[] = array(
                  'CAPTION'=>t('Page Size'),
                  'TYPE'=>'number',
                  'PROP'=>'pageSize',
                  );

$result[] = array(
                  'CAPTION'=>t('Kind'),
                  'TYPE'=>'combo',
                  'PROP'=>'kind',
                  'VALUES'=>array('sbHorizontal', 'sbVertical'),
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