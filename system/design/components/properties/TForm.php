<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('caption'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  );
addDefProp ('Hint', &$result);
addDefProp ('Font', &$result, array('ParentFont'));

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
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );

$result[] = array(
                  'CAPTION'=>t('Alpha Blend'),
                  'TYPE'=>'check',
                  'PROP'=>'alphaBlend',
                  );
$result[] = array(
                  'CAPTION'=>t('Alpha Blend Value'),
                  'TYPE'=>'number',
                  'PROP'=>'alphaBlendValue',
                  );

$result[] = array(
                  'CAPTION'=>t('Border Width'),
                  'TYPE'=>'number',
                  'PROP'=>'borderWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Screen Snap'),
                  'TYPE'=>'check',
                  'PROP'=>'screenSnap',
                  );
$result[] = array(
                  'CAPTION'=>t('Snap Buffer'),
                  'TYPE'=>'number',
                  'PROP'=>'snapBuffer',
                  );

$result[] = array(
                  'CAPTION'=>t('Cursor'),
                  'TYPE'=>'combo',
                  'PROP'=>'cursor',
                  'VALUES'=>$GLOBALS['cursors_meta'],
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Enabled'),
                  'PROP'=>'aenabled',
                  'REAL_PROP'=>'enabled',
                  'ADD_GROUP'=>true,
                  );

$result[] = array(
                  'CAPTION'=>t('Transparent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'transparentColor',
                  'ADD_GROUP'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Transparent Color Value'),
                  'TYPE'=>'color',
                  'PROP'=>'transparentColorValue',
                  'ADD_GROUP'=>true,
                  );
				  
# TControl properties: /core/main/objects.php
$result[] = array('CAPTION'=>t('Handle'),'PROP'=>'handle');
$result[] = array('CAPTION'=>t('Component List'),'PROP'=>'componentList');
$result[] = array('CAPTION'=>t('Control List'),'PROP'=>'controlList');
$result[] = array('CAPTION'=>t('Component Links'),'PROP'=>'componentLinks');
$result[] = array('CAPTION'=>t('Popup Menu'),'PROP'=>'popupMenu');

$result[] = array(
                  'CAPTION'=>t('Double Buffered'),
                  'PROP'=>'doubleBuffered',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Icon'),
                  'TYPE'=>'',
                  'PROP'=>'icon',
                  );
$result[] = array(
                  'CAPTION'=>t('Scale for pixels'),
                  'PROP'=>'scaled',
                  );
$result[] = array(
                  'CAPTION'=>t('Pixels Per Inch'),
                  'PROP'=>'pixelsPerInch',
                  );

$result[] = array(
                  'CAPTION'=>t('Modal result'),
                  'PROP'=>'modalResult',
                  );	  	  

$result[] = array('CAPTION'=>t('Width'), 'PROP'=>'clientWidth','TYPE'=>'number','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Height'), 'PROP'=>'clientHeight','TYPE'=>'number','ADD_GROUP'=>true);

$result[] = array('CAPTION'=>t('Real Width'), 'PROP'=>'w','TYPE'=>'','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Real Height'), 'PROP'=>'h','TYPE'=>'','ADD_GROUP'=>true);

				
$result[] = array('CAPTION'=>t('p_Left'), 'PROP'=>'x');
$result[] = array('CAPTION'=>t('p_Top'), 'PROP'=>'y');

				  
$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle', 'bsSizeable', 'bsDialog', 'bsToolWindow', 'bsSizeToolWin'),
                  'UPDATE'=>true,
                  );

$result[] = array(
                  'CAPTION'=>t('Form Style'),
                  'PROP'=>'formStyle',
                  );
$result[] = array(
                  'CAPTION'=>t('Position'),
                  'PROP'=>'position',
                  );
$result[] = array(
                  'CAPTION'=>t('Window State'),
                  'TYPE'=>'',
                  'PROP'=>'windowState',
                  );
$result[] = array(
                  'CAPTION'=>t('Min Width'),
                  'PROP'=>'constraints->minWidth',
                  );                  
$result[] = array(
                  'CAPTION'=>t('Max Width'),
                  'PROP'=>'constraints->minWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Min Height'),
                  'PROP'=>'constraints->minHeight',
                  );                  
$result[] = array(
                  'CAPTION'=>t('Max Height'),
                  'PROP'=>'constraints->maxHeight',
                  );

$result[] = array(
                  'CAPTION'=>t('Properties'),
                  'TYPE'=>'form',
                  'PROP'=>'fmFormProperties',
                  'ADD_GROUP'=>true,
                  );

return $result;