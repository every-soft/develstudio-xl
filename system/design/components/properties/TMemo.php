<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'alignment',
                  'VALUES'=>array('taLeftJustify', 'taRightJustify', 'taCenter'),
                  );
				  
addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'parentColor',
                  );
$result[] = array(
	  'CAPTION'=>t('Ctl3D'),
	  'TYPE'=>'check',
	  'PROP'=>'ctl3D',
);
$result[] = array(
	  'CAPTION'=>t('Parent Ctl3D'),
	  'TYPE'=>'check',
	  'PROP'=>'parentCtl3D',
);
$result[] = array(
                  'CAPTION'=>t('Hide Selection'),
                  'TYPE'=>'check',
                  'PROP'=>'hideSelection',
                  );
$result[] = array(
                  'CAPTION'=>t('OEM Convert'),
                  'TYPE'=>'check',
                  'PROP'=>'OEMConvert',
                  );
$result[] = array(
                  'CAPTION'=>t('Want Returns'),
                  'TYPE'=>'check',
                  'PROP'=>'wantReturns',
                  );
$result[] = array(
                  'CAPTION'=>t('Want Tabs'),
                  'TYPE'=>'check',
                  'PROP'=>'wantTabs',
                  );

$result[] = array(
                  'CAPTION'=>t('Word Wrap'),
                  'TYPE'=>'check',
                  'PROP'=>'wordWrap',
                  );
$result[] = array(
                  'CAPTION'=>t('Read Only'),
                  'TYPE'=>'check',
                  'PROP'=>'readOnly',
                  );

$result[] = array(
                  'CAPTION'=>t('Scroll Bars'),
                  'TYPE'=>'combo',
                  'PROP'=>'scrollBars',
                  'VALUES'=>array('ssNone', 'ssHorizontal', 'ssVertical', 'ssBoth'),
                  );
addDefProp ('Bevel', &$result);
$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle'),
                  );
$result[] = array(
                  'CAPTION'=>t('Max Length'),
                  'TYPE'=>'number',
                  'PROP'=>'maxLength',
                  );

addDefProp ('Hint', &$result);

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


$result[] = array('CAPTION'=>t('Cursor Pos X'),'PROP'=>'CursorX');
$result[] = array('CAPTION'=>t('Cursor Pos Y'),'PROP'=>'CursorY');

addDefProp('Items', &$result);

$result[] = array('CAPTION'=>t('selStart'), 'PROP'=>'selStart');
$result[] = array('CAPTION'=>t('selLength'), 'PROP'=>'selLength');
$result[] = array('CAPTION'=>t('selText'), 'PROP'=>'selText');

addDefProp('DefaultVisual', &$result);

return $result;