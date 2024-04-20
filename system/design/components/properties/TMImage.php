<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Picture'),
                  'TYPE'=>'image',
                  'PROP'=>'picture',
                  'CLASS'=>'TPicture',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Center'),
                  'TYPE'=>'check',
                  'PROP'=>'center',
                  );
$result[] = array(
                  'CAPTION'=>t('Mosaic'),
                  'TYPE'=>'check',
                  'PROP'=>'mosaic',
                  );
$result[] = array(
                  'CAPTION'=>t('Proportional'),
                  'TYPE'=>'check',
                  'PROP'=>'proportional',
                  );
$result[] = array(
                  'CAPTION'=>t('Stretch'),
                  'TYPE'=>'check',
                  'PROP'=>'stretch',
                  );
$result[] = array(
                  'CAPTION'=>t('transparent'),
                  'TYPE'=>'check',
                  'PROP'=>'transparent',
                  );
addDefProp ('Hint', &$result);

addDefProp('DefaultVisual', &$result);

return $result;