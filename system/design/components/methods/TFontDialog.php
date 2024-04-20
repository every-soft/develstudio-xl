<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('execute'),
                  'PROP'=>'execute()',
                  'INLINE'=>'boolean execute( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('Font Assign'),
                  'PROP'=>'font->assign',
                  'INLINE'=>'font->assign ( TFont font )',
                  );
return $result;