<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('loadPicture'),
                  'PROP'=>'loadPicture',
                  'INLINE'=>'loadPicture ( string fileName )',
                  );
$result[] = array(
                  'CAPTION'=>t('addItem'),
                  'PROP'=>'addItem',
                  'INLINE'=>'addItem ( TMenuItem $item )',
                  );
$result[] = array(
                  'CAPTION'=>t('clear'),
                  'PROP'=>'clear()',
                  'INLINE'=>'clear ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('delete'),
                  'PROP'=>'delete',
                  'INLINE'=>'delete ( int index )',
                  );
$result[] = array(
                  'CAPTION'=>t('insert'),
                  'PROP'=>'insert',
                  'INLINE'=>'insert ( int index, TMenuItem $item )',
                  );
$result[] = array(
                  'CAPTION'=>t('insertAfter'),
                  'PROP'=>'insertAfter',
                  'INLINE'=>'insertAfter ( TMenuItem $after, TMenuItem $item )',
                  );
	
return $result;