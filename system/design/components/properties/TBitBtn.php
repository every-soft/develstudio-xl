<?

$result = array();
 
//////////////////////////////////////////////////////////////////////////////////////  
	
$result[] = array(
                  'CAPTION'=>t('caption'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Spacing'),
                  'TYPE'=>'number',
                  'PROP'=>'spacing',
                  );
$result[] = array(
                  'CAPTION'=>t('Focused'),
                  'TYPE'=>'check',
                  'PROP'=>'default',
                  );
$result[] = array(
                  'CAPTION'=>t('Kind'),
                  'TYPE'=>'combo',
                  'PROP'=>'kind',
                  'VALUES'=>array('bkCustom', 'bkOK', 'bkCancel', 'bkHelp',
									'bkYes', 'bkNo', 'bkClose', 'bkAbort',
									'bkRetry', 'bkIgnore', 'bkAll'),
				  'UPDATE_DSGN'=>true
                  );
$result[] = array(
                  'CAPTION'=>t('Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'style',
                  'VALUES'=>array('bsAutoDetect', 'bsWin31', 'bsNew'),
				  'UPDATE_DSGN'=>true
                  );
				  
addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Picture'),
                  'TYPE'=>'image',
                  'PROP'=>'picture',
                  'CLASS'=>'TBitmap',
                  );
$result[] = array(
                  'CAPTION'=>t('Layout picture'),
                  'TYPE'=>'combo',
                  'PROP'=>'layout',
                  'VALUES'=>array('blGlyphLeft', 'blGlyphRight', 'blGlyphTop', 'blGlyphBottom'),
                  );
$result[] = array(
                  'CAPTION'=>t('Pictures count'),
                  'TYPE'=>'number',
                  'PROP'=>'numGlyphs'
                  );
$result[] = array(
                  'CAPTION'=>t('modal_result'),
                  'TYPE'=>'combo',
                  'PROP'=>'modalResult',
                  'VALUES'=>array(
                                  mrNone=>'mrNone',
                                  mrOk=>'mrOk',
                                  mrCancel=>'mrCancel',
                                  mrAbort=>'mrAbort',
                                  mrRetry=>'mrRetry',
                                  mrIgnore=>'mrIgnore',
                                  mrYes=>'mrYes',
                                  mrNo=>'mrNo',
                                  mrAll=>'mrAll',
                                  mrNoToAll=>'mrNoToAll',
                                  mrYesToAll=>'mrYesToAll'
                                  ),
                  );
				  
addDefProp ('Hint', &$result);

$result[] = array(
                  'CAPTION'=>t('Word Wrap'),
                  'TYPE'=>'check',
                  'PROP'=>'wordWrap',
                  );
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

$result[] = array(
                  'CAPTION'=>t('Double Buffered'),
                  'PROP'=>'doubleBuffered',
                  );
				 
addDefProp('DefaultVisual', &$result);		
return $result;