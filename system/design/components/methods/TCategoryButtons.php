<?

$result = array();

/* 
$result[] = array(
                  'CAPTION'=>t('addSection'),
                  'PROP'=>'addSection',
                  'INLINE'=>'addSection ( string group, string caption )',
                  );
$result[] = array(
                  'CAPTION'=>t('set_smallIcons'),
                  'PROP'=>'set_smallIcons()',
                  'INLINE'=>'set_smallIcons($enabled)',
                  );
$result[] = array(
                  'CAPTION'=>t('addButton'),
                  'PROP'=>'addButton',
                  'INLINE'=>'addButton ( string group )',
                  ); 
$result[] = array(
                  'CAPTION'=>t('unSelect'),
                  'PROP'=>'unSelect()',
                  'INLINE'=>'unSelect ( void )',
);
*/

$result[] = array(
                  'CAPTION'=>t('Assign Font'),
                  'PROP'=>'font->assign',
                  'INLINE'=>'font->assign ( TFont font )',
                  );

return $result;