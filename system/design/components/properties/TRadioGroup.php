<?

$result = array();

addDefProp('Items', &$result);

$result[] = array(
                  'CAPTION'=>t('Items'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );
$result[] = array(
                  'CAPTION'=>t('Caption'),
                  'TYPE'=>'text',
                  'PROP'=>'caption',
                  );
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'check',
                  'PROP'=>'color',
                  );				  
addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'Ctl3D',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Font'),
                  'TYPE'=>'check',
                  'PROP'=>'parentFont',
                  );
$result[] = array(
                  'CAPTION'=>t('Parent Color'),
                  'TYPE'=>'check',
                  'PROP'=>'parentColor',
                  );
addDefProp ('Hint', &$result);
$result[] = array(
                  'CAPTION'=>t('Item Index'),
                  'TYPE'=>'number',
                  'PROP'=>'itemIndex',
                  );
$result[] = array(
                  'CAPTION'=>t('Columns'),
                  'TYPE'=>'number',
                  'PROP'=>'columns',
                  );
$result[] = array(
                  'CAPTION'=>t('Tab Order'),
                  'TYPE'=>'number',
                  'PROP'=>'tabOrder',
                  );
$result[] = array(
                  'CAPTION'=>t('Tab Stop'),
                  'TYPE'=>'check',
                  'PROP'=>'tabStop',
                  );

addDefProp('DefaultVisual', &$result);
return $result;