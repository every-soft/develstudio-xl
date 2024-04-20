<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Selected Index'),
                  // 'TYPE'=>'number',
                  'PROP'=>'selectedIndex',
                  );

$result[] = array(
                  'CAPTION'=>t('Enable Visual Styles'),
                  'TYPE'=>'check',
                  'PROP'=>'enableVisualStyles',
                  );


$result[] = array(
                  'CAPTION'=>t('Highlight Text Color'),
                  'TYPE'=>'color',
                  'PROP'=>'highlightTextColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Row Height'),
                  'TYPE'=>'number',
                  'PROP'=>'rowHeight',
                  );
				  
addDefProp('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle'),
                  );
$result[] = array(
                  'CAPTION'=>t('Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'style',
                  'VALUES'=>array('psDefault', 'psOffice2003', 'psOffice2007', 'psWhidbey'),
                  );
$result[] = array(
                  'CAPTION'=>t('Margin Color'),
                  'TYPE'=>'color',
                  'PROP'=>'marginColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Grid Color'),
                  'TYPE'=>'color',
                  'PROP'=>'gridColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Selection Color'),
                  'TYPE'=>'color',
                  'PROP'=>'selectionColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Items'),
                  'TYPE'=>'',
                  'PROP'=>'items',
                  );
$result[] = array(
                  'CAPTION'=>t('Options'),
                  'TYPE'=>'text',
                  'PROP'=>'options',
                  );
$result[] = array(
                  'CAPTION'=>t('Images'),
                  'TYPE'=>'',
                  'PROP'=>'images',
				  'CLASS'=>'TImageList'
                  );
$result[] = array(
                  'CAPTION'=>t('Image Index'),
                  'TYPE'=>'',
                  'PROP'=>'imageIndex',
                  );
$result[] = array(
                  'CAPTION'=>t('Splitter Position'),
                  'TYPE'=>'number',
                  'PROP'=>'splitterPosition',
                  );
$result[] = array(
                  'CAPTION'=>t('Collapse Glyph'),
                  'TYPE'=>'check',
                  'PROP'=>'collapseGlyph',
                  );
addDefProp ('Hint', &$result);
				  
addDefProp('DefaultVisual', &$result);

return $result;