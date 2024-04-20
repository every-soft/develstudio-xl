<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Images'),
                  'TYPE'=>'',
                  'PROP'=>'images',
				  'CLASS'=>'TImageList'
                  );

$result[] = array(
                  'CAPTION'=>t('Tabs'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
				  
addDefProp('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Tab Index'),
                  'TYPE'=>'number',
                  'PROP'=>'tabIndex',
                  );
$result[] = array(
                  'CAPTION'=>t('Tab width'),
                  'TYPE'=>'number',
                  'PROP'=>'tabWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Tab height'),
                  'TYPE'=>'number',
                  'PROP'=>'tabHeight',
                  );
$result[] = array(
                  'CAPTION'=>t('Tab Position'),
                  'TYPE'=>'combo',
                  'PROP'=>'tabPosition',
                  'VALUES'=>array('tpTop', 'tpBottom', 'tpLeft', 'tpRight'),
                  );
$result[] = array(
                  'CAPTION'=>t('Hot Track'),
                  'TYPE'=>'check',
                  'PROP'=>'hotTrack',
                  );

$result[] = array(
                  'CAPTION'=>t('Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'style',
                  'VALUES'=>array('tsTabs', 'tsButtons', 'tsFlatButtons'),
                  );
$result[] = array(
                  'CAPTION'=>t('MultiLine'),
                  'TYPE'=>'check',
                  'PROP'=>'multiLine',
                  );
$result[] = array(
                  'CAPTION'=>t('Owner Draw'),
                  'TYPE'=>'check',
                  'PROP'=>'ownerDraw',
                  );
$result[] = array(
                  'CAPTION'=>t('Ragged Right'),
                  'TYPE'=>'check',
                  'PROP'=>'raggedRight',
                  );
$result[] = array(
                  'CAPTION'=>t('Scroll Opposite'),
                  'TYPE'=>'check',
                  'PROP'=>'scrollOpposite',
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