<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Caption'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
addDefProp ('Font', &$result);
$result[] = array(
                  'CAPTION'=>t('Alignment'),
                  'TYPE'=>'combo',
                  'PROP'=>'alignment',
                  'VALUES'=>array('taLeftJustify', 'taRightJustify'),
                  );
$result[] = array(
                  'CAPTION'=>t('Checked'),
                  'TYPE'=>'check',
                  'PROP'=>'checked',
                  );
$result[] = array(
                  'CAPTION'=>t('Word Wrap'),
                  'TYPE'=>'check',
                  'PROP'=>'wordWrap',
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