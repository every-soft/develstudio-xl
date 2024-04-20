<?

$result = array();


$result[] = array(
                  'CAPTION'=>t('Device'),
                  'TYPE'=>'combo',
                  'PROP'=>'device',
                  'VALUES'=>array('fdScreen', 'fdPrinter', 'fdBoth'),
                  );
				  
addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Min Font size'),
                  'TYPE'=>'number',
                  'PROP'=>'minFontSize',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Max Font size'),
                  'TYPE'=>'number',
                  'PROP'=>'maxFontSize',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Options'),
                  'TYPE'=>'list',
                  'PROP'=>'options',
				  'VALUES'=>array('fdAnsiOnly', 'fdTrueTypeOnly', 'fdEffects', 'fdFixedPitchOnly', 'fdForceFontExist', 'fdNoFaceSel', 'fdNoOEMFonts', 'fdNoSimulations', 'fdNoSizeSel', 'fdNoStyleSel', 'fdNoVectorFonts', 'fdShowHelp', 'fdWysiwyg', 'fdLimitSize', 'fdScalableOnly', 'fdApplyButton'),
                  );
return $result;