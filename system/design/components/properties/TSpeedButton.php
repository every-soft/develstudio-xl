<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('caption'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  );
				  
addDefProp('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Picture'),
                  'TYPE'=>'image',
                  'PROP'=>'picture',
                  );
$result[] = array(
                  'CAPTION'=>t('Layout picture'),
                  'TYPE'=>'combo',
                  'PROP'=>'layout',
                  'VALUES'=>array('blGlyphLeft', 'blGlyphRight', 'blGlyphTop', 'blGlyphBottom'),
                  );
$result[] = array(
                  'CAPTION'=>t('Pictures count'),
                  'TYPE'=>'number',
                  'PROP'=>'numGlyphs'
                  );
$result[] = array(
                  'CAPTION'=>t('Spacing'),
                  'TYPE'=>'number',
                  'PROP'=>'spacing',
                  );
$result[] = array(
                  'CAPTION'=>t('Margin'),
                  'TYPE'=>'number',
                  'PROP'=>'margin',
                  );
$result[] = array(
                  'CAPTION'=>t('Group Index'),
                  'TYPE'=>'number',
                  'PROP'=>'groupIndex',
                  );
$result[] = array(
                  'CAPTION'=>t('Down Status'),
                  'TYPE'=>'check',
                  'PROP'=>'down',
                  );
$result[] = array(
                  'CAPTION'=>t('Allow All Up'),
                  'TYPE'=>'check',
                  'PROP'=>'allowAllUp',
                  );
$result[] = array(
                  'CAPTION'=>t('flat'),
                  'TYPE'=>'check',
                  'PROP'=>'flat',
                  );
$result[] = array(
                  'CAPTION'=>t('transparent'),
                  'TYPE'=>'check',
                  'PROP'=>'transparent',
                  );
addDefProp ('Hint', &$result);

addDefProp('DefaultVisual', &$result);

return $result;