<?

$result = array();

// TFont Methods
$result[] = array(
                  'CAPTION'=>t('Font Assign'),
                  'PROP'=>'font->assign',
                  'INLINE'=>'font->assign ( TFont font )',
                  );
				  
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
                  'PROP'=>'items->appEnd',
                  'INLINE'=>'items->appEnd ( string value )',
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
                  'CAPTION'=>t('Assign'),
                  'PROP'=>'items->assign',
                  'INLINE'=>'items->assign ( TStrings value )',
                  );
$result[] = array(
                  'CAPTION'=>t('Add Strings'),
                  'PROP'=>'items->addStrings',
                  'INLINE'=>'items->addStrings ( TStrings value )',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('loadFromFile'),
                  'PROP'=>'loadFromFile',
                  'INLINE'=>'loadFromFile ( string fileName )',
                  );

$result[] = array(
                  'CAPTION'=>t('saveToFile'),
                  'PROP'=>'saveToFile',
                  'INLINE'=>'saveToFile ( string fileName )',
                  );
$result[] = array(
                  'CAPTION'=>t('undo'),
                  'PROP'=>'undo()',
                  'INLINE'=>'undo ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('redo'),
                  'PROP'=>'redo()',
                  'INLINE'=>'redo ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('selectAll'),
                  'PROP'=>'selectAll()',
                  'INLINE'=>'selectAll ( void )',
                  );
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
				  
/* only SynEdit */

$result[] = array(
                  'CAPTION'=>t('replaceLine'),
                  'PROP'=>'replaceLine',
                  'INLINE'=>'replaceLine ( string text )',
                  );	
$result[] = array(
                  'CAPTION'=>t('insertLine'),
                  'PROP'=>'insertLine',
                  'INLINE'=>'insertLine ( string text )',
                  );					  
$result[] = array(
                  'CAPTION'=>t('insertLineAfter'),
                  'PROP'=>'insertLineAfter',
                  'INLINE'=>'insertLineAfter ( string text )',
                  );	

return $result;