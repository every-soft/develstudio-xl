<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Files (array)'),
                  'TYPE'=>'',
                  'PROP'=>'files',
                  );

$result[] = array(
                  'CAPTION'=>t('File name'),
                  'TYPE'=>'text',
                  'PROP'=>'fileName',
                  );
$result[] = array(
                  'CAPTION'=>t('Filter'),
                  'TYPE'=>'text',
                  'PROP'=>'filter',
                  );
$result[] = array(
                  'CAPTION'=>t('Filter Index'),
                  'TYPE'=>'number',
                  'PROP'=>'filterIndex',
                  );
$result[] = array(
                  'CAPTION'=>t('Initial Dir'),
                  'TYPE'=>'text',
                  'PROP'=>'initialDir',
                  );
$result[] = array(
                  'CAPTION'=>t('Title'),
                  'TYPE'=>'text',
                  'PROP'=>'title',
                  );
$result[] = array(
                  'CAPTION'=>t('Small mode'),
                  'TYPE'=>'check',
                  'PROP'=>'smallMode',
                  );
$result[] = array(
                  'CAPTION'=>t('Multi Select'),
                  'TYPE'=>'check',
                  'PROP'=>'multiSelect',
                  );
$result[] = array(
                  'CAPTION'=>t('Options'),
                  'TYPE'=>'list',
                  'PROP'=>'options',
				  'VALUES'=>array('ofReadOnly', 'ofOverwritePrompt', 'ofHideReadOnly', 'ofNoChangeDir', 'ofShowHelp', 'ofNoValidate', 'ofAllowMultiSelect', 'ofExtensionDifferent', 'ofFileMustExist', 'ofPathMustExist', 'ofCreatePrompt', 'ofShareAware', 'ofNoReadOnlyReturn', 'ofNoTestFileCreate', 'ofNoNetworkButton', 'ofNoLongNames', 'ofOldStyleDialog', 'ofNoDereferenceLinks', 'ofEnableIncludeNotify', 'ofEnableSizing', 'ofDontAddToRecent', 'ofForceShowHidden'),
                  );
return $result;