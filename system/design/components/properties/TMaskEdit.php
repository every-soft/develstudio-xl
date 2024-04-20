<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
$result[] = array(
                  'CAPTION'=>t('Mask Text'),
                  'TYPE'=>'text',
                  'PROP'=>'editMask',
                  );
				  
addDefProp('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Char Case'),
                  'TYPE'=>'combo',
                  'PROP'=>'charCase',
                  'VALUES'=>array('ecNormal', 'ecUpperCase', 'ecLowerCase'),
                  );
$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Select'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Read Only'),
                  'TYPE'=>'check',
                  'PROP'=>'readOnly',
                  );

$result[] = array(
                  'CAPTION'=>t('Max Length'),
                  'TYPE'=>'number',
                  'PROP'=>'maxLength',
                  );
addDefProp ('Bevel', &$result);
$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle'),
                  );
$result[] = array(
                  'CAPTION'=>t('Border Width'),
                  'TYPE'=>'number',
                  'PROP'=>'borderWidth',
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