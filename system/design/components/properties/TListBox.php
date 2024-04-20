<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('List'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'alignment',
                  'VALUES'=>array('taLeftJustify', 'taRightJustify', 'taCenter'),
                  );
				  
addDefProp ('Font', &$result);
addDefProp('Bevel', &$result);

$result[] = array(
                  'CAPTION'=>t('Read Only'),
                  'TYPE'=>'check',
                  'PROP'=>'readOnly',
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
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );
$result[] = array(
                  'CAPTION'=>t('Item Index'),
                  'TYPE'=>'number',
                  'PROP'=>'itemIndex',
                  );
$result[] = array(
                  'CAPTION'=>t('Item Height'),
                  'TYPE'=>'number',
                  'PROP'=>'itemHeight',
                  );
$result[] = array(
                  'CAPTION'=>t('Margin Left'),
                  'TYPE'=>'number',
                  'PROP'=> 'marginLeft',
                  );
$result[] = array(
                  'CAPTION'=>t('Multi Select'),
                  'TYPE'=>'check',
                  'PROP'=>'multiSelect',
                  );

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Two Color'),
                  'TYPE'=>'color',
                  'PROP'=>'twoColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Two Font Color'),
                  'TYPE'=>'color',
                  'PROP'=>'twoFontColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Border Selected'),
                  'TYPE'=>'check',
                  'PROP'=>'borderSelected',
                  );
$result[] = array(
                  'CAPTION'=>t('Columns'),
                  'TYPE'=>'number',
                  'PROP'=>'columns',
                  );
$result[] = array(
                  'CAPTION'=>t('Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'style',
                  'VALUES'=>array('lbStandard', 'lbOwnerDrawFixed', 'lbOwnerDrawVariable', 'lbVirtual', 'lbVirtualOwnerDraw'),
                  );
$result[] = array(
                  'CAPTION'=>t('Scroll Width'),
                  'TYPE'=>'number',
                  'PROP'=>'scrollWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle'),
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

addDefProp('Items', &$result);

addDefProp('DefaultVisual', &$result);

return $result;