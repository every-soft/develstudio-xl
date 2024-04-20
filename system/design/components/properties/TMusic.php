<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Link to file'),
                  'TYPE'=>'text',
                  'PROP'=>'url',
                  );
$result[] = array(
                  'CAPTION'=>t('Volume').'(0-500)',
                  'TYPE'=>'text',
                  'PROP'=>'volume',
                  );
$result[] = array(
                  'CAPTION'=>t('Loop'),
                  'TYPE'=>'check',
                  'PROP'=>'loop',
                  );				  

$result[] = array(
                  'CAPTION'=>t('Play on start'),
                  'TYPE'=>'check',
                  'PROP'=>'playOnStart',
                  );


$result[] = array(
                  'CAPTION'=>t('Priority'),
                  'TYPE'=>'combo',
                  'PROP'=>'priority',
                  'VALUES'=> array('tpIdle', 'tpLowest', 'tpLower', 'tpNormal', 'tpHigher', 'tpHighest',
                                    'tpTimeCritical'),
                  );

return $result;

?>