<?

$result = array();

			  
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