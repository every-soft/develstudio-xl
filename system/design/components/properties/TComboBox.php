<?

$result = array();

addDefProp('Items', &$result);

$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'inText',
                  );

$result[] = array(
                  'CAPTION'=>t('List'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
				  
addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Item Index'),
                  'TYPE'=>'number',
                  'PROP'=>'itemIndex',
                  );
$result[] = array(
                  'CAPTION'=>t('Drop Down Count'),
                  'TYPE'=>'number',
                  'PROP'=>'dropDownCount',
                  );
$result[] = array(
                  'CAPTION'=>t('Item Height'),
                  'TYPE'=>'number',
                  'PROP'=>'itemHeight',
                  );
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'style',
                  'VALUES'=>array('csDropDown', 'csSimple', 'csDropDownList', 'csOwnerDrawFixed','csOwnerDrawVariable'),
                  );

addDefProp('Bevel', &$result);				  
$result[] = array(
                  'CAPTION'=>t('Max Length'),
                  'TYPE'=>'number',
                  'PROP'=>'maxLength',
                  );
$result[] = array(
                  'CAPTION'=>t('Char Case'),
                  'TYPE'=>'combo',
                  'PROP'=>'charCase',
                  'VALUES'=>array('ecLowerCase', 'ecNormal', 'ecUpperCase'),
                  );
$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Close Up'),
                  'TYPE'=>'check',
                  'PROP'=>'autoCloseUp',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Complete'),
                  'TYPE'=>'check',
                  'PROP'=>'autoComplete',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Complete Delay'),
                  'TYPE'=>'number',
                  'PROP'=>'autoCompleteDelay',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Drop Down'),
                  'TYPE'=>'check',
                  'PROP'=>'autoDropDown',
                  );
$result[] = array(
                  'CAPTION'=>t('Sorted'),
                  'TYPE'=>'check',
                  'PROP'=>'sorted',
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