<?

$result = array();

// TFont Methods
$result[] = array(
                  'CAPTION'=>t('Font Assign'),
                  'PROP'=>'font->assign',
                  'INLINE'=>'font->assign ( TFont font )',
                  );
				 
				  
# TControl Methods: /core/main/objects.php
$result[] = array(
                  'CAPTION'=>t('Control Count'),
                  'PROP'=>'controlCount()',
                  'INLINE'=>'int controlCount ( void )',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Components'),
                  'PROP'=>'parentComponents()',
                  'INLINE'=>'parentComponents ( void )',
                  );		
$result[] = array(
                  'CAPTION'=>t('Child Components'),
                  'PROP'=>'childComponents()',
                  'INLINE'=>'childComponents ( void )',
                  );		
$result[] = array(
                  'CAPTION'=>t('Component By ID'),
                  'PROP'=>'componentById',
                  'INLINE'=>'componentById ( int id [, string type = TControl] )',
                  );		
$result[] = array(
                  'CAPTION'=>t('Control By ID'),
                  'PROP'=>'controlById',
                  'INLINE'=>'controlById ( int id )',
                  );	
$result[] = array(
                  'CAPTION'=>t('Find Component'),
                  'PROP'=>'findComponent',
                  'INLINE'=>'findComponent ( int id, string type )',
                  );
				  
# TForm methods: /core/main/forms.php
$result[] = array(
                  'CAPTION'=>t('Scroll By'),
                  'PROP'=>'scrollBy',
                  'INLINE'=>'scrollBy ( int x, int y )',
                  );
$result[] = array(
                  'CAPTION'=>t('LoadFromFile'),
                  'PROP'=>'loadFromFile',
                  'INLINE'=>'loadFromFile ( string fileName [, bool init = false] )',
                  );

$result[] = array(
                  'CAPTION'=>t('Save icon to file'),
                  'INLINE'=>'icon->saveToFile ( string fileName )',
                  'PROP'=>'icon->saveToFile',
                  );		
$result[] = array(
                  'CAPTION'=>t('Load file icon'),
                  'INLINE'=>'icon->loadAnyFile ( string fileName )',
                  'PROP'=>'icon->loadAnyFile',
                  );	
$result[] = array(
                  'CAPTION'=>t('Load icon from stream'),
                  'INLINE'=>'icon->loadFromStream ( stream )',
                  'PROP'=>'icon->loadFromStream',
                  );	
$result[] = array(
                  'CAPTION'=>t('Save icon to stream'),
                  'INLINE'=>'icon->saveToStream ( stream )',
                  'PROP'=>'icon->saveToStream',
                  );	
$result[] = array(
                  'CAPTION'=>t('Assign icon'),
                  'INLINE'=>'icon->assign ( TBitmap bitmap )',
                  'PROP'=>'icon->assign',
                  );	
$result[] = array(
                  'CAPTION'=>t('isEmpty icon'),
                  'INLINE'=>'icon->isEmpty ( void )',
                  'PROP'=>'icon->isEmpty()',
                  );	
$result[] = array(
                  'CAPTION'=>t('Copy icon to clipboard'),
                  'INLINE'=>'icon->copyToClipboard ( void )',
                  'PROP'=>'icon->copyToClipboard()',
                  );	
				  
$result[] = array(
                  'CAPTION'=>t('close'),
                  'PROP'=>'close()',
                  'INLINE'=>'close ( void )',
                  );

$result[] = array(
                  'CAPTION'=>t('setFocus'),
                  'PROP'=>'setFocus()',
                  'INLINE'=>'setFocus ( void )',
                  );


$result[] = array(
                  'CAPTION'=>t('Load icon file'),
                  'INLINE'=>'icon->loadFromFile ( string fileName )',
                  'PROP'=>'icon->loadFromFile',
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
                  'CAPTION'=>t('showModal'),
                  'PROP'=>'showModal()',
                  'INLINE'=>'showModal ( void )',
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