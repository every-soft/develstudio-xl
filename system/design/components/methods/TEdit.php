<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('copyToClipboard'),
                  'PROP'=>'copyToClipboard()',
                  'INLINE'=>'copyToClipboard ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('cutToClipboard'),
                  'PROP'=>'cutToClipboard()',
                  'INLINE'=>'cutToClipboard ( void )',
                  );				  
$result[] = array(
                  'CAPTION'=>t('pasteFromClipboard'),
                  'PROP'=>'pasteFromClipboard()',
                  'INLINE'=>'pasteFromClipboard ( void )',
                  );	
$result[] = array(
                  'CAPTION'=>t('clearSelected'),
                  'PROP'=>'clearSelected()',
                  'INLINE'=>'clearSelected ( void )',
                  );	
$result[] = array(
                  'CAPTION'=>t('clearSelection'),
                  'PROP'=>'clearSelection()',
                  'INLINE'=>'clearSelection ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('selectAll'),
                  'PROP'=>'selectAll()',
                  'INLINE'=>'selectAll ( void )',
                  );
				  
# font method
$result[] = array(
                  'CAPTION'=>t('Font Assign'),
                  'PROP'=>'font->assign',
                  'INLINE'=>'font->assign ( TFont font )',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('setFocus'),
                  'PROP'=>'setFocus()',
                  'INLINE'=>'setFocus ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Set date'),
                  'PROP'=>'setDate()',
                  'INLINE'=>'setDate ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Set time'),
                  'PROP'=>'setTime()',
                  'INLINE'=>'setTime ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Show'),
                  'PROP'=>'show()',
                  'INLINE'=>'show ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Hide'),
                  'PROP'=>'hide()',
                  'INLINE'=>'hide ( void )',
                  );


$result[] = array(
                  'CAPTION'=>t('To back'),
                  'PROP'=>'toBack()',
                  'INLINE'=>'toBack ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('To front'),
                  'PROP'=>'toFront()',
                  'INLINE'=>'toFront ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Invalidate'),
                  'PROP'=>'invalidate()',
                  'INLINE'=>'invalidate ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Repaint'),
                  'PROP'=>'repaint()',
                  'INLINE'=>'repaint ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('Perform'),
                  'PROP'=>'perform',
                  'INLINE'=>'perform ( string msg, int hparam, int lparam )',
                  );

$result[] = array(
                  'CAPTION'=>t('Create'),
                  'PROP'=>'create',
                  'INLINE'=>'create ( [object parent = activeForm] )',
                  );

$result[] = array(
                  'CAPTION'=>t('Free'),
                  'PROP'=>'free()',
                  'INLINE'=>'free ( void )',
                  );
return $result;