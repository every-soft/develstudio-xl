<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  'UPDATE_DSGN'=>1,
                  );
addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Hover Color'),
                  'TYPE'=>'color',
                  'PROP'=>'hoverColor',
                  );

$result[] = array(
                  'CAPTION'=>t('Hover Size'),
                  'TYPE'=>'number',
                  'PROP'=>'hoverSize',
                  );

$result[] = array(
                  'CAPTION'=>t('Hover Style'),
                  'TYPE'=>'text',
                  'PROP'=>'hoverStyle',
                  );

$result[] = array(
                  'CAPTION'=>t('Link'),
                  'TYPE'=>'text',
                  'PROP'=>'link',
                  );

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

addDefProp('DefaultVisual', &$result);

return $result;