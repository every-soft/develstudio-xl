<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
$result[] = array(
                  'CAPTION'=>'RTF '.t('Text'),
                  'TYPE'=>'',
                  'PROP'=>'RTFText',
                  );

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

$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle'),
                  );
addDefProp ('Bevel', &$result);
$result[] = array(
                  'CAPTION'=>t('Max Length'),
                  'TYPE'=>'number',
                  'PROP'=>'maxLength',
                  );
$result[] = array(
                  'CAPTION'=>t('Hide Selection'),
                  'TYPE'=>'check',
                  'PROP'=>'hideSelection',
                  );

$result[] = array(
                  'CAPTION'=>t('Hide Scrollbars'),
                  'TYPE'=>'check',
                  'PROP'=>'hideScrollBars',
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

$result[] = array('CAPTION'=>t('selStart'), 'PROP'=>'selStart');
$result[] = array('CAPTION'=>t('selLength'), 'PROP'=>'selLength');
$result[] = array('CAPTION'=>t('selText'), 'PROP'=>'selText');

$result[] = array('CAPTION'=>t('fontColor'), 'PROP'=>'fontColor');
$result[] = array('CAPTION'=>t('fontName'), 'PROP'=>'fontName');
$result[] = array('CAPTION'=>t('fontSize'), 'PROP'=>'fontSize');
$result[] = array('CAPTION'=>t('fontCharset'), 'PROP'=>'fontCharset');
$result[] = array('CAPTION'=>t('bold'), 'PROP'=>'bold');
$result[] = array('CAPTION'=>t('italic'), 'PROP'=>'italic');
$result[] = array('CAPTION'=>t('strikeOut'), 'PROP'=>'strikeOut');
$result[] = array('CAPTION'=>t('underline'), 'PROP'=>'underline');

addDefProp('DefaultVisual', &$result);

return $result;