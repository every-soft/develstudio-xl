<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('On During SizeMove'),
                  'EVENT'=>'onDuringSizeMove',
                  'INFO'=>'%func%($self, $dx, $dy, $state)',
                  'ICON'=>'onDuringSizeMove',
                  );
$result[] = array(
                  'CAPTION'=>t('On Start Size Move'),
                  'EVENT'=>'onStartSizeMove',
                  'INFO'=>'%func%($self, $state)',
                  'ICON'=>'onstartsizeMove',
                  );
$result[] = array(
                  'CAPTION'=>t('On End Size Move'),
                  'EVENT'=>'onEndSizeMove',
                  'INFO'=>'%func%($self, $state)',
                  'ICON'=>'OnEndSizeMove',
                  );
$result[] = array(
                  'CAPTION'=>t('On Mouse Down'),
                  'EVENT'=>'onMouseDown',
                  'INFO'=>'%func%($self,$button,$shift,$x,$y)',
                  'ICON'=>'mousedown',
                  );
$result[] = array(
                  'CAPTION'=>t('On DblClick'),
                  'EVENT'=>'onDblClick',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'ondblclick',
                  );
return $result;