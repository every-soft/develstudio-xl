<?

$result = array();

addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );

$result[] = array(
                  'CAPTION'=>t('Date'),
                  'TYPE'=>'text',
                  'PROP'=>'date',
                  );


$result[] = array(
                  'CAPTION'=>t('Date Format'),
                  'TYPE'=>'combo',
                  'PROP'=>'dateFormat',
                  'VALUES'=>array('dfShort','dfLong'),
                  );
$result[] = array(
                  'CAPTION'=>t('Date Mode'),
                  'TYPE'=>'combo',
                  'PROP'=>'dateMode',
                  'VALUES'=>array('dmComboBox','dmUpDown'),
                  );

$result[] = array(
                  'CAPTION'=>t('Format'),
                  'TYPE'=>'text',
                  'PROP'=>'format',
                  );
$result[] = array(
                  'CAPTION'=>t('Kind'),
                  'TYPE'=>'combo',
                  'PROP'=>'kind',
                  'VALUES'=>array('dtkDate','dtkTime'),
                  );
$result[] = array(
                  'CAPTION'=>t('Max Date'),
                  'TYPE'=>'text',
                  'PROP'=>'maxDate',
                  );
$result[] = array(
                  'CAPTION'=>t('Min Date'),
                  'TYPE'=>'text',
                  'PROP'=>'minDate',
                  );
$result[] = array(
                  'CAPTION'=>t('Show Checkbox'),
                  'TYPE'=>'check',
                  'PROP'=>'showCheckbox',
                  );
$result[] = array(
                  'CAPTION'=>t('Time'),
                  'TYPE'=>'text',
                  'PROP'=>'time',
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

addDefProp ('DefaultVisual', &$result);
return $result;