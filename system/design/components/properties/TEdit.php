<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
$result[] = array(
                  'CAPTION'=>t('Text Hint'),
                  'TYPE'=>'text',
                  'PROP'=>'textHint',
                  );
$result[] = array(
                  'CAPTION'=>t('Align'),
                  'TYPE'=>'combo',
                  'PROP'=>'alignment',
                  'VALUES'=>array('taLeftJustify', 'taRightJustify', 'taCenter'),
                  );
$result[] = array(
                  'CAPTION'=>t('Margin Left'),
                  'TYPE'=>'number',
                  'PROP'=>'marginLeft'
                  );
$result[] = array(
                  'CAPTION'=>t('Margin Right'),
                  'TYPE'=>'number',
                  'PROP'=>'marginRight'
                  );
				  
addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'color',
                  'PROP'=>'parentColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Color On Enter'),
                  'TYPE'=>'color',
                  'PROP'=>'colorOnEnter',
                  );

$result[] = array(
                  'CAPTION'=>t('Font Color On Enter'),
                  'TYPE'=>'color',
                  'PROP'=>'fontColorOnEnter',
                  );

addDefProp('Bevel', &$result);

$result[] = array(
                  'CAPTION'=>t('Char Case'),
                  'TYPE'=>'combo',
                  'PROP'=>'charCase',
                  'VALUES'=>array('ecNormal', 'ecUpperCase', 'ecLowerCase'),
                  );
$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle'),
                  );
$result[] = array(
                  'CAPTION'=>t('Tab Enter'),
                  'TYPE'=>'check',
                  'PROP'=>'tabOnEnter',
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
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Select'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Read Only'),
                  'TYPE'=>'check',
                  'PROP'=>'readOnly',
                  );
$result[] = array(
                  'CAPTION'=>t('OEM Convert'),
                  'TYPE'=>'check',
                  'PROP'=>'OEMConvert',
                  );
$result[] = array(
                  'CAPTION'=>t('Max Length'),
                  'TYPE'=>'number',
                  'PROP'=>'maxLength',
                  );
$result[] = array(
                  'CAPTION'=>t('Password Char'),
                  'TYPE'=>'text',
                  'PROP'=>'passwordChar',
                  );

addDefProp('Hint', &$result);
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
$result[] = array('CAPTION'=>t('selStart'), 'PROP'=>'selStart');
$result[] = array('CAPTION'=>t('selLength'), 'PROP'=>'selLength');
$result[] = array('CAPTION'=>t('selText'), 'PROP'=>'selText');

addDefProp('DefaultVisual', &$result);
return $result;