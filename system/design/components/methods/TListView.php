<?

$result = array();

// TStrings Methods
$result[] = array(
                  'CAPTION'=>t('Delete Item'),
                  'PROP'=>'items->delete',
                  'INLINE'=>'items->delete ( int index )',
                  );
$result[] = array(
                  'CAPTION'=>t('Add Item'),
                  'PROP'=>'items->add',
                  'INLINE'=>'items->add ( string value )',
                  );
$result[] = array(
                  'CAPTION'=>t('Add Item'),
                  'PROP'=>'items->append',
                  'INLINE'=>'items->append ( string value )',
                  );
$result[] = array(
                  'CAPTION'=>t('Get Index'),
                  'PROP'=>'items->indexOf',
                  'INLINE'=>'items->indexOf ( string value )',
                  );
$result[] = array(
                  'CAPTION'=>t('Exchange Items'),
                  'PROP'=>'items->exchange',
                  'INLINE'=>'items->exchange ( int index1, int index2 )',
                  );
$result[] = array(
                  'CAPTION'=>t('Clear'),
                  'PROP'=>'items->clear()',
                  'INLINE'=>'items->clear ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('Set Line'),
                  'PROP'=>'items->setLine',
                  'INLINE'=>'items->setLine ( int index, string value )',
                  );
$result[] = array(
                  'CAPTION'=>t('Get Line'),
                  'PROP'=>'items->getLine',
                  'INLINE'=>'items->getLine ( int index )',
                  );
$result[] = array(
                  'CAPTION'=>t('Set Array'),
                  'PROP'=>'items->setArray',
                  'INLINE'=>'items->setArray ( array arr )',
                  );
$result[] = array(
                  'CAPTION'=>t('Assign Items'),
                  'PROP'=>'items->assign',
                  'INLINE'=>'items->assign ( TStrings value )',
                  );
$result[] = array(
                  'CAPTION'=>t('Add Strings'),
                  'PROP'=>'items->addStrings',
                  'INLINE'=>'items->addStrings ( TStrings value )',
                  );

$result[] = array(
                  'CAPTION'=>t('setFocus'),
                  'PROP'=>'setFocus()',
                  'INLINE'=>'setFocus ( void )',
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