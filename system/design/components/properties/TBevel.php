<?

$result = array();

///////////////////////////////////////////////////////////////////////////////////////////////////////

$result[] = array(
                  'CAPTION'=>t('Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'style',
                  'VALUES'=>array('bsLowered', 'bsRaised'),
                  );

$result[] = array(
                  'CAPTION'=>t('Shape'),
                  'TYPE'=>'combo',
                  'PROP'=>'shape',
                  'VALUES'=>array('bsBox', 'bsFrame', 'bsTopLine', 'bsBottomLine', 'bsLeftLine',
                                'bsRightLine', 'bsSpacer'),
                  );
addDefProp ('Hint', &$result);
addDefProp('DefaultVisual', &$result, array('Enabled')); 

return $result;