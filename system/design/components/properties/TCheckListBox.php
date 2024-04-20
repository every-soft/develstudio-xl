<?

$result = array();
				  
$result[] = array('CAPTION'=>t('Checked Items'), 'PROP'=>'checkedItems');
				  
addDefProp('Items', &$result);

$result[] = array(
                  'CAPTION'=>t('List'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
				  
addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Auto Complete'),
                  'TYPE'=>'check',
                  'PROP'=>'autoComplete',
                  );
$result[] = array(
                  'CAPTION'=>t('Sorted'),
                  'TYPE'=>'check',
                  'PROP'=>'sorted',
                  );
$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );
$result[] = array(
                  'CAPTION'=>t('Flat'),
                  'TYPE'=>'check',
                  'PROP'=>'flat',
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
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );

$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'parentColor',
                  );
addDefProp ('Hint', &$result);
				  // parentBackground doesn't exist
addDefProp ('Bevel', &$result);
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