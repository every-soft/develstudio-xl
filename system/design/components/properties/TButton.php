<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('caption'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  );
				  
addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Focused'),
                  'TYPE'=>'check',
                  'PROP'=>'default',
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

addDefProp('DefaultVisual', &$result);
return $result;