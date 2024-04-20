<?

$result = array();

$result[] = array('CAPTION'=>t('Control List'),'PROP'=>'controlList');
$result[] = array('CAPTION'=>t('Component Links'),'PROP'=>'componentLinks');
$result[] = array('CAPTION'=>t('Component List'),'PROP'=>'componentList');

$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
addDefProp ('Font', &$result);

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
                  'CAPTION'=>t('Alignment').' 2',
                  'TYPE'=>'combo',
                  'PROP'=>'alignment',
                  'VALUES'=>array('taLeftJustify', 'taRightJustify', 'taCenter'),
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'parentColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Bevel Kind'),
                  'TYPE'=>'combo',
                  'PROP'=>'bevelKind',
				  'VALUES'=>array('bkNone', 'bkFlat', 'bkSoft', 'bkTile'),
                  );
$result[] = array(
                  'CAPTION'=>t('Bevel Inner'),
                  'TYPE'=>'combo',
                  'PROP'=>'bevelInner',
                  'VALUES'=>array('bvNone', 'bvLowered', 'bvRaised', 'bvSpace'),
                  );
$result[] = array(
                  'CAPTION'=>t('Bevel Outer'),
                  'TYPE'=>'combo',
                  'PROP'=>'bevelOuter',
                  'VALUES'=>array('bvNone', 'bvLowered', 'bvRaised', 'bvSpace'),
                  );
$result[] = array(
                  'CAPTION'=>t('Bevel Width'),
                  'TYPE'=>'number',
                  'PROP'=>'bevelWidth',
                  );

$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle'),
                  );
$result[] = array(
                  'CAPTION'=>t('Border Width'),
                  'TYPE'=>'number',
                  'PROP'=>'borderWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'Ctl3D',
                  );
$result[] = array(
                  'CAPTION'=>t('Double Buffered'),
                  'PROP'=>'doubleBuffered',
                  );	
$result[] = array(
                  'CAPTION'=>t('Locked'),
                  'TYPE'=>'check',
                  'PROP'=>'locked',
                  );	
$result[] = array(
                  'CAPTION'=>t('Dock Site'),
                  'TYPE'=>'check',
                  'PROP'=>'dockSite',
                  );
$result[] = array(
                  'CAPTION'=>t('Full Repaint'),
                  'TYPE'=>'check',
                  'PROP'=>'fullRepaint',
                  );
	addDefProp ('Hint', &$result);
$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'parentColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Background'),
                  'TYPE'=>'check',
                  'PROP'=>'parentBackground',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'parentCtl3D',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Font'),
                  'TYPE'=>'check',
                  'PROP'=>'parentFont',
                  );
				  
$result[] = array('CAPTION'=>t('Dock  List'), 'PROP'=>'dockList');
$result[] = array('CAPTION'=>t('Dock  Client Count'), 'PROP'=>'dockClientCount');
$result[] = array('CAPTION'=>t('Dock  Orientation'), 'PROP'=>'dockOrientation');

addDefProp('DefaultVisual', &$result);

return $result;