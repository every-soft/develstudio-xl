<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Auto Drop Down'),
                  'TYPE'=>'check',
                  'PROP'=>'autoDropDown',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('selected'),
                  'TYPE'=>'combo',
                  'PROP'=>'selected',
                  'VALUES'=>array(
    							  'clBlack', 'clMaroon', 'clGreen', 'clOlive',
    							  'clNavy', 'clPurple', 'clTeal', 'clGray',
    							  'clSilver', 'clRed', 'clLime', 'clYellow',
    						      'clBlue', 'clFuchsia', 'clAqua', 'clWhite',
    						      'clMoneyGreen', 'clSkyBlue', 'clCream', 'clMedGray',
    						      'clActiveBorder', 'clActiveCaption', 'clAppWorkSpace', 'clBackground',
    						      'clBtnFace', 'clBtnHighlight', 'clBtnShadow', 'clBtnText',
    							  'clCaptionText', 'clDefault', 'clGradientActiveCaption', 'clGradientInactiveCaption',
    							  'clGrayText', 'clHighlight', 'clHighlightText', 'clHotLight',
    							  'clInactiveBorder', 'clInactiveCaption', 'clInactiveCaptionText', 'clInfoBk',
    							  'clInfoText', 'clMenu', 'clMenuBar', 'clMenuHighlight',
    							  'clMenuText', 'clNone', 'clScrollBar', 'cl3DDkShadow',
    							  'cl3DLight', 'clWindow', 'clWindowFrame', 'clWindowText',
    							  ),
                  );

$result[] = array(
                  'CAPTION'=>t('Style'),
                  'TYPE'=>'list',
                  'PROP'=>'style',
				   'VALUES'=>array ('cbStandardColors',
								'cbExtendedColors',
								'cbSystemColors',
								'cbIncludeNone',
								'cbIncludeDefault',
								'cbCustomColor',
								'cbPrettyNames'),
				);
				
addDefProp('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Drop Down Count'),
                  'TYPE'=>'number',
                  'PROP'=>'dropDownCount',
                  );

$result[] = array(
                  'CAPTION'=>t('Item Height'),
                  'TYPE'=>'number',
                  'PROP'=>'itemHeight',
                  );
				  
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
                  'CAPTION'=>t('Default Color'),
                  'TYPE'=>'color',
                  'PROP'=>'defaultColorColor',
                  );
$result[] = array(
                  'CAPTION'=>t('None Color'),
                  'TYPE'=>'color',
                  'PROP'=>'noneColorColor',
                  );
				  
addDefProp('Bevel', &$result);

$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );
addDefProp('Hint', &$result);

addDefProp('DefaultVisual', &$result);

return $result;