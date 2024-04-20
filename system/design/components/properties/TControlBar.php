<?

$result = array();
 
$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
                  'PROP'=>'autoSize',
                  );
				  
$result[] = array(
		  'CAPTION'=>t('Color'),
		  'TYPE'=>'color',
		  'PROP'=>'color',
		  );

$result[] = array(
		  'CAPTION'=>t('Parent Color'),
		  'TYPE'=>'check',
		  'PROP'=>'parentColor',
		  );
			

$result[] = array(
                  'CAPTION'=>t('Dock Site'),
                  'TYPE'=>'check',
                  'PROP'=>'dockSite',
                  );
$result[] = array(
                  'CAPTION'=>t('Auto Dock'),
                  'TYPE'=>'check',
                  'PROP'=>'autoDock',
                  );

addDefProp('Bevel', &$result);

$result[] = array(
  'CAPTION'=>t('Ctl3D'),
  'TYPE'=>'check',
  'PROP'=>'ctl3D',
);

$result[] = array(
	  'CAPTION'=>t('Parent Ctl3D'),
	  'TYPE'=>'check',
	  'PROP'=>'parentCtl3D',
);
				  
addDefProp('Hint', &$result);

addDefProp('Control', &$result);
  
$result[] = array(
                  'CAPTION'=>t('Border Width'),
                  'TYPE'=>'number',
                  'PROP'=>'borderWidth',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Parent Background'),
                  'TYPE'=>'check',
                  'PROP'=>'parentBackground',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Row Size'),
                  'TYPE'=>'number',
                  'PROP'=>'rowSize',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Row Snap'),
                  'TYPE'=>'check',
                  'PROP'=>'rowSnap',
                  );

addDefProp('DefaultVisual', &$result);
				 
return $result;