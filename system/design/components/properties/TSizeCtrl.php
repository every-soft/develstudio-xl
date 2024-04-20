<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('Move Only'),
                  'TYPE'=>'check',
                  'PROP'=>'moveOnly',
                  );
$result[] = array(
                  'CAPTION'=>t('Btn Color'),
                  'TYPE'=>'color',
                  'PROP'=>'btnColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Btn Color Disabled'),
                  'TYPE'=>'color',
                  'PROP'=>'btnColorDisabled',
                  );

$result[] = array(
                  'CAPTION'=>t('Grid Size'),
                  'TYPE'=>'number',
                  'PROP'=>'gridSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Multi Target Resize'),
                  'TYPE'=>'check',
                  'PROP'=>'multiTargetResize',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Grid'),
                  'TYPE'=>'check',
                  'PROP'=>'showGrid',
                 );

/*$result[] = array(
                  'CAPTION'=>t('Enabled'),
                  'TYPE'=>'check',
                  'PROP'=>'enable',
                  ); 
$result[] = array(
                  'CAPTION'=>t('Targets'),
                  'TYPE'=>'',
                  'PROP'=>'targets',
                  );
 $result[] = array(
                  'CAPTION'=>t('Targets Ex'),
                  'TYPE'=>'',
                  'PROP'=>'targets_ex',
                  );
$result[] = array(
                  'CAPTION'=>t('Popup Menu'),
                  'TYPE'=>'',
                  'PROP'=>'popupMenu',
                  );*/
/* $result[] = array( // comment for DevelStudio XL
                  'CAPTION'=>t('PopupMenu'),
                  'TYPE'=>'',
                  'PROP'=>'popupMenu',
                  ); */

return $result;