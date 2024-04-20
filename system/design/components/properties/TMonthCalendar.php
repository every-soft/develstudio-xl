<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  );
$result[] = array(
                  'CAPTION'=>t('Date'),
                  'TYPE'=>'date',
                  'PROP'=>'date',
                  );
$result[] = array(
                  'CAPTION'=>t('End Date'),
                  'TYPE'=>'date',
                  'PROP'=>'endDate',
                  );
$result[] = array(
                  'CAPTION'=>t('Max Date'),
                  'TYPE'=>'date',
                  'PROP'=>'maxDate',
                  );
$result[] = array(
                  'CAPTION'=>t('Min Date'),
                  'TYPE'=>'date',
                  'PROP'=>'minDate',
                  );
$result[] = array(
                  'CAPTION'=>t('Max Select Range'),
                  'TYPE'=>'number',
                  'PROP'=>'maxSelectRange',
                  );
$result[] = array(
                  'CAPTION'=>t('Multi Select'),
                  'TYPE'=>'check',
                  'PROP'=>'multiSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Today'),
                  'TYPE'=>'check',
                  'PROP'=>'showToday',
                  );
		  
$result[] = array(
                  'CAPTION'=>t('Show Today Circle'),
                  'TYPE'=>'check',
                  'PROP'=>'showTodayCircle',
                  );
$result[] = array(
                  'CAPTION'=>t('Week Numbers'),
                  'TYPE'=>'check',
                  'PROP'=>'weekNumbers',
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
                  'CAPTION'=>t('First Day of Weak'),
                  'TYPE'=>'',
                  'PROP'=>'firstDayOfWeek',
                  );		
				  
addDefProp('DefaultVisual', &$result);

return $result;