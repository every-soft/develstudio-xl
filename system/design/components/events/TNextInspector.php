<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('On Edit'),
                  'EVENT'=>'onEdit',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'onedit',
                  );
$result[] = array(
                  'CAPTION'=>t('On Toolbar Click'),
                  'EVENT'=>'onToolbarClick',
                  'INFO'=>'%func%($self)',
                  'ICON'=>'ontoolbarclick',
                  );
				  
return $result;