<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Height'),
                  'TYPE'=>'number',
                  'PROP'=>'height',
                  );
$result[] = array(
                  'CAPTION'=>t('Width'),
                  'TYPE'=>'number',
                  'PROP'=>'width',
                  );

$result[] = array(
                  'CAPTION'=>t('Masked'),
                  'TYPE'=>'check',
                  'PROP'=>'masked',
                  );
$result[] = array(
                  'CAPTION'=>t('Image Type'),
                  'TYPE'=>'combo',
				  'VALUES'=>array('itImage', 'itMask'),
                  'PROP'=>'imageType',
                  );
$result[] = array(
                  'CAPTION'=>t('Drawing Style'),
                  'TYPE'=>'combo',
				  'VALUES'=>array('dsFocused', 'dsSelected', 'dsNormal', 'dsTransparent'),
                  'PROP'=>'drawingStyle',
                  );
$result[] = array(
                  'CAPTION'=>t('Share Images'),
                  'TYPE'=>'check',
                  'PROP'=>'shareImages',
                  );
$result[] = array(
                  'CAPTION'=>t('Background Color'),
                  'TYPE'=>'color',
                  'PROP'=>'bkColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Blend Color'),
                  'TYPE'=>'color',
                  'PROP'=>'blendColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Images'),
                  'TYPE'=>'',
                  'PROP'=>'images',
                  );

return $result;