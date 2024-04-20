<?

$result = array();

$result[] = array('CAPTION'=>t('Images'), 'PROP'=>'images', 'CLASS'=>'TImageList');
$result[] = array('CAPTION'=>t('Item Selected'), 'PROP'=>'itemSelected');
$result[] = array('CAPTION'=>t('Absolute Index'), 'PROP'=>'absIndex');

				  
$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Change Delay'),
                  'TYPE'=>'number',
                  'PROP'=>'changeDelay',
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
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Expand'),
                  'TYPE'=>'check',
                  'PROP'=>'autoExpand',
                  );
$result[] = array(
                  'CAPTION'=>t('Hide Selection'),
                  'TYPE'=>'check',
                  'PROP'=>'hideSelection',
                  );

$result[] = array(
                  'CAPTION'=>t('Indent'),
                  'TYPE'=>'number',
                  'PROP'=>'Indent',
                  );
$result[] = array(
                  'CAPTION'=>t('Items'),
                  'TYPE'=>'tree_nodes',
                  'PROP'=>'Items',
                  );
$result[] = array(
                  'CAPTION'=>t('Multi Select'),
                  'TYPE'=>'check',
                  'PROP'=>'multiSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Multi Select Style'),
                  'TYPE'=>'text',
                  'PROP'=>'multiSelectStyle',
                  );
$result[] = array(
                  'CAPTION'=>t('Hot Track'),
                  'TYPE'=>'check',
                  'PROP'=>'hotTrack',
                  );
$result[] = array(
                  'CAPTION'=>t('Right Click Select'),
                  'TYPE'=>'check',
                  'PROP'=>'rightClickSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Row Select'),
                  'TYPE'=>'check',
                  'PROP'=>'rowSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Read Only'),
                  'TYPE'=>'check',
                  'PROP'=>'readOnly',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Buttons'),
                  'TYPE'=>'check',
                  'PROP'=>'showButtons',
                  );
addDefProp ('Hint', &$result);
$result[] = array(
                  'CAPTION'=>t('Show Lines'),
                  'TYPE'=>'check',
                  'PROP'=>'showLines',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Root'),
                  'TYPE'=>'check',
                  'PROP'=>'showRoot',
                  );
$result[] = array(
                  'CAPTION'=>t('Sort Type'),
                  'TYPE'=>'combo',
                  'PROP'=>'sortType',
				  'VALUES'=>array('stBoth', 'stData', 'stNone', 'stText'),
                  );
$result[] = array('CAPTION'=>t('StateImages'), 'TYPE'=>'', 'PROP'=>'stateImages');

$result[] = array(
                  'CAPTION'=>t('Tooltips'),
                  'TYPE'=>'check',
                  'PROP'=>'toolTips',
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