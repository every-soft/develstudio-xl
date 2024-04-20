<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('doTimer'),
                  'PROP'=>'doTimer',
                  'INLINE'=>'doTimer ( int self )',
                  );

$result[] = array(
                  'CAPTION'=>t('start'),
                  'PROP'=>'start()',
                  'INLINE'=>'start ( void )',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('start'),
                  'PROP'=>'go()',
                  'INLINE'=>'go ( void )',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('stop'),
                  'PROP'=>'stop()',
                  'INLINE'=>'stop ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('pause'),
                  'PROP'=>'pause()',
                  'INLINE'=>'pause ( void )',
                  );
return $result;