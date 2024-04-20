<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Minimal size'),
                  'TYPE'=>'number',
                  'PROP'=>'minSize',
                  );

$result[] = array(
                  'CAPTION'=>t('Bevel Show'),
                  'TYPE'=>'check',
                  'PROP'=>'beveled',
                  );

$result[] = array(
                  'CAPTION'=>t('Auto Snap'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSnap',
                  );

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );

$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'parentColor',
                  );

$result[] = array(
                  'CAPTION'=>t('Resize Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'resizeStyle',
                  'VALUES'=>array('rsLine', 'rsNone', 'rsPattern', 'rsUpdate'),
                  'ADD_GROUP'=>true,
                  );
addDefProp ('Hint', &$result);
addDefProp('DefaultVisual', &$result);

return $result;