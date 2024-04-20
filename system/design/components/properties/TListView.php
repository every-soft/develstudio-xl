<?

global $_c;

$_c->setConstList(array('vsIcon', 'vsSmallIcon', 'vsList', 'vsReport'), 0);
$_c->setConstList(array('bkNone', 'bkTile', 'bkSoft', 'bkFlat'), 0);
    
$result = array();

addDefProp ('Font', &$result);
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );

$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );
addDefProp ('Bevel', &$result);
$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle'),
                  );

$result[] = array(
                  'CAPTION'=>t('Check Boxes'),
                  'TYPE'=>'check',
                  'PROP'=>'checkBoxes',
                  );

$result[] = array(
                  'CAPTION'=>t('Flat Scroll Bars'),
                  'TYPE'=>'check',
                  'PROP'=>'flatScrollBars',
                  );
$result[] = array(
                  'CAPTION'=>t('FullDrag'),
                  'TYPE'=>'check',
                  'PROP'=>'fullDrag',
                  );
$result[] = array(
                  'CAPTION'=>t('Grid Lines'),
                  'TYPE'=>'check',
                  'PROP'=>'gridLines',
                  );
$result[] = array(
                  'CAPTION'=>t('Hide Selection'),
                  'TYPE'=>'check',
                  'PROP'=>'hideSelection',
                  );
$result[] = array(
                  'CAPTION'=>t('Hot Track'),
                  'TYPE'=>'check',
                  'PROP'=>'hotTrack',
                  );
$result[] = array(
                  'CAPTION'=>t('Multi Select'),
                  'TYPE'=>'check',
                  'PROP'=>'multiSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'parentColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Font'),
                  'TYPE'=>'check',
                  'PROP'=>'parentFont',
                  );
$result[] = array(
                  'CAPTION'=>t('Read Only'),
                  'TYPE'=>'check',
                  'PROP'=>'readOnly',
                  );
$result[] = array(
                  'CAPTION'=>t('Row Select'),
                  'TYPE'=>'check',
                  'PROP'=>'rowSelect',
                  );

$result[] = array(
                  'CAPTION'=>t('View Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'viewStyle',
                  'VALUES'=>array('vsIcon', 'vsSmallIcon', 'vsList', 'vsReport'),
                  );
addDefProp ('Hint', &$result);

addDefProp('DefaultVisual', &$result);

return $result;