<?

$result = array();
addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Caption'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  );
$result[] = array(
                  'CAPTION'=>t('Short Cut'),
                  'TYPE'=>'hotkey',
                  'PROP'=>'shortCut',
                  );
$result[] = array(
                  'CAPTION'=>t('Default'),
                  'TYPE'=>'check',
                  'PROP'=>'default',
                  );
$result[] = array(
                  'CAPTION'=>t('Break'),
                  'TYPE'=>'combo',
                  'PROP'=>'break',
				  'VALUES' => array('mbNone', 'mbBarBreak', 'mbBreak'),
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Check'),
                  'TYPE'=>'check',
                  'PROP'=>'autoCheck',
                  );
$result[] = array(
                  'CAPTION'=>t('Checked'),
                  'TYPE'=>'check',
                  'PROP'=>'checked',
                  );
$result[] = array(
                  'CAPTION'=>t('RadioItem'),
                  'TYPE'=>'check',
                  'PROP'=>'radioItem',
                  );
$result[] = array(
                  'CAPTION'=>t('GroupIndex'),
                  'TYPE'=>'number',
                  'PROP'=>'groupIndex',
                  );
$result[] = array(
                  'CAPTION'=>t('AutoMerge'),
                  'TYPE'=>'check',
                  'PROP'=>'autoMerge',
                  );

$result[] = array(
                  'CAPTION'=>t('Image Index'),
                  'TYPE'=>'number',
                  'PROP'=>'imageIndex',
                  );
$result[] = array(
                  'CAPTION'=>t('GroupIndex'),
                  'TYPE'=>'number',
                  'PROP'=>'groupIndex',
                  );

$result[] = array('CAPTION'=>t('Parent'),'PROP'=>'parent');
$result[] = array('CAPTION'=>t('Index'),'PROP'=>'index');
$result[] = array('CAPTION'=>t('Name'),'PROP'=>'name');

$result[] = array(
                  'CAPTION'=>t('Images'),
                  'TYPE'=>'', // TImageList
                  'PROP'=>'images',
                  );
				  
return $result;