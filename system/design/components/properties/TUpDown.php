<?

$result = array();

$result[] = array('CAPTION'=>t('Associate'), 'PROP'=>'associate');

$result[] = array(
                  'CAPTION'=>t('Arrow Keys'),
                  'TYPE'=>'check',
                  'PROP'=>'arrowKeys',
                  );
                  
$result[] = array(
                  'CAPTION'=>t('Increment'),
                  'TYPE'=>'number',
                  'PROP'=>'increment',
                  );
                  
$result[] = array(
                  'CAPTION'=>t('Minimum'),
                  'TYPE'=>'number',
                  'PROP'=>'min',
                  );

$result[] = array(
                  'CAPTION'=>t('Maximum'),
                  'TYPE'=>'number',
                  'PROP'=>'max',
                  );

$result[] = array(
                  'CAPTION'=>t('Position'),
                  'TYPE'=>'number',
                  'PROP'=>'position',
                  );

$result[] = array(
                  'CAPTION'=>t('Orientation'),
                  'TYPE'=>'combo',
                  'PROP'=>'type',
                  'VALUES'=>array('udHorizontal', 'udVertical'),
                  );
$result[] = array(
                  'CAPTION'=>t('Align Button'),
                  'TYPE'=>'combo',
                  'PROP'=>'alignButton',
                  'VALUES'=>array('udRight', 'udLeft'),
                  );

$result[] = array(
                  'CAPTION'=>t('Thousands'),
                  'TYPE'=>'check',
                  'PROP'=>'thousands',
                  );
$result[] = array(
                  'CAPTION'=>t('Wrap'),
                  'TYPE'=>'check',
                  'PROP'=>'wrap',
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
	  
$result[] = array(
				  'CAPTION' => t('Cursor'),
				  'TYPE' => 'combo',
				  'PROP' => 'cursor',
				  'VALUES' => $GLOBALS['cursors_meta'],
				  'ADD_GROUP' => true,
				  );

$result[] = array(
				  'CAPTION' => t('Sizes and position'),
				  'TYPE' => 'sizes',
				  'PROP' => 'anchors',
				  'ADD_GROUP' => true,
				  );

$result[] = array(
				  'CAPTION'=>t('Enabled'),
				  'TYPE'=>'check',
				  'PROP'=>'aenabled',
				  'REAL_PROP'=>'enabled',
				  'ADD_GROUP'=>true,
				  );

$result[] = array(
			  'CAPTION'=>t('visible'),
			  'TYPE'=>'check',
			  'PROP'=>'avisible',
			  'REAL_PROP'=>'visible',
			  'ADD_GROUP'=>true,
			);
				
$result[] = array('CAPTION' => t('p_Left'), 'PROP' => 'x','TYPE' => 'number', 'ADD_GROUP' => true, 'UPDATE_DSGN' => true);
$result[] = array('CAPTION' => t('p_Top'), 'PROP' => 'y','TYPE' => 'number', 'ADD_GROUP' => true, 'UPDATE_DSGN' => true);
$result[] = array('CAPTION' => t('Width'), 'PROP' => 'w','TYPE' => 'number', 'ADD_GROUP' => true, 'UPDATE_DSGN' => true);
$result[] = array('CAPTION' => t('Height'), 'PROP' => 'h','TYPE' => 'number', 'ADD_GROUP' => true, 'UPDATE_DSGN' => true);

return $result;