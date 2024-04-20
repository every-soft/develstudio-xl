<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Images'),
                  'TYPE'=>'',
                  'PROP'=>'images',
				  'CLASS'=>'TImageList'
                  );
				  
$result[] = array('CAPTION'=>t('Selected Item'),'PROP'=>'selectedItem');

addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Gradient Direction'),
                  'TYPE'=>'combo',
                  'PROP'=>'gradientDirection',
                  'VALUES'=>array('gdHorizontal', 'gdVertical'),
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Background Gradient Direction'),
                  'TYPE'=>'combo',
                  'PROP'=>'backgroundGradientDirection',
                  'VALUES'=>array('gdHorizontal', 'gdVertical'),
                  );
$result[] = array(
                  'CAPTION'=>t('Background Gradient Color'),
                  'TYPE'=>'color',
                  'PROP'=>'backgroundGradientColor',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Button Flow'),
                  'TYPE'=>'combo',
                  'PROP'=>'buttonFlow',
                  'VALUES'=>array('cbfVertical', 'cbfHorizontal'),
                  );
$result[] = array(
                  'CAPTION'=>t('Button Height'),
                  'TYPE'=>'number',
                  'PROP'=>'buttonHeight',
                  );

$result[] = array(
                  'CAPTION'=>t('Button Width'),
                  'TYPE'=>'number',
                  'PROP'=>'buttonWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Hot Button Color'),
                  'TYPE'=>'color',
                  'PROP'=>'hotButtonColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Regular Button Color'),
                  'TYPE'=>'color',
                  'PROP'=>'regularButtonColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Selected Button Color'),
                  'TYPE'=>'color',
                  'PROP'=>'selectedButtonColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Button Options'),
                  'TYPE'=>'list',
				  'VALUES'=>array('boAllowReorder', 'boAllowCopyingButtons', 'boFullSize', 'boGradientFill', 'boShowCaptions', 'boVerticalCategoryCaptions', 'boBoldCaptions', 'boUsePlusMinus', 'boCaptionOnlyBorder'),
                  'PROP'=>'buttonOptions',
                  );
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Scroll'),
                  'TYPE'=>'check',
                  'PROP'=>'autoScroll',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'parentColor',
                  );
addDefProp ('Bevel', &$result);
addDefProp ('Hint', &$result);
addDefProp ('DefaultVisual', &$result);

return $result;