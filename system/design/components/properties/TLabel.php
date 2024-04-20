<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  'UPDATE_DSGN'=>1,
                  );
addDefProp('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );

$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  'UPDATE_DSGN'=>1,
                  );

$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'alignment',
                  'VALUES'=>array('taLeftJustify', 'taRightJustify', 'taCenter'),
                  );
$result[] = array(
                  'CAPTION'=>t('Valign'),
                  'TYPE'=>'combo',
                  'PROP'=>'layout',
                  'VALUES'=>array('tlTop', 'tlCenter', 'tlBottom'),
                  );
$result[] = array(
                  'CAPTION'=>t('Transparent'),
                  'TYPE'=>'check',
                  'PROP'=>'transparent',
                  );
$result[] = array(
                  'CAPTION'=>t('Word Wrap'),
                  'TYPE'=>'check',
                  'PROP'=>'wordWrap',
                  );
addDefProp ('Hint', &$result);
$result[] = array(
                  'CAPTION'=>t('Show Accel Char'),
                  'TYPE'=>'check',
                  'PROP'=>'showAccelChar',
                  'ADD_GROUP'=>true,
                  );

addDefProp('DefaultVisual', &$result);

return $result;