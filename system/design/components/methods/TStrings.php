<?php

$result = array();

# items methods #
$result[] = array(
                  'CAPTION'=>t('Delete Item'),
                  'PROP'=>'delete',
                  'INLINE'=>'delete ( int index )',
                  );
$result[] = array(
                  'CAPTION'=>t('Add Item'),
                  'PROP'=>'add',
                  'INLINE'=>'add ( string value )',
                  );
$result[] = array(
                  'CAPTION'=>t('Add Item'),
                  'PROP'=>'appEnd',
                  'INLINE'=>'appEnd ( string value )',
                  );
$result[] = array(
                  'CAPTION'=>t('Get Index'),
                  'PROP'=>'indexOf',
                  'INLINE'=>'indexOf ( string value )',
                  );
$result[] = array(
                  'CAPTION'=>t('Exchange Items'),
                  'PROP'=>'exchange',
                  'INLINE'=>'exchange ( int index1, int index2 )',
                  );
$result[] = array(
                  'CAPTION'=>t('Clear'),
                  'PROP'=>'clear()',
                  'INLINE'=>'clear ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('Set Line'),
                  'PROP'=>'setLine',
                  'INLINE'=>'setLine ( int index, string value )',
                  );
$result[] = array(
                  'CAPTION'=>t('Get Line'),
                  'PROP'=>'getLine',
                  'INLINE'=>'getLine ( int index )',
                  );
$result[] = array(
                  'CAPTION'=>t('Set Array'),
                  'PROP'=>'setArray',
                  'INLINE'=>'setArray ( array arr )',
                  );
$result[] = array(
                  'CAPTION'=>t('Assign'),
                  'PROP'=>'assign',
                  'INLINE'=>'assign ( TStrings value )',
                  );
$result[] = array(
                  'CAPTION'=>t('Add Strings'),
                  'PROP'=>'addStrings',
                  'INLINE'=>'addStrings ( TStrings value )',
                  );
				  
return $result;