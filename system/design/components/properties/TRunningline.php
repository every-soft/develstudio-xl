<?

$result = array();

$result[] = array('CAPTION'=>t('Text'),'TYPE'=>'text','PROP'=>'caption','UPDATE_DSGN'=>true);

addDefProp('Font', &$result);

$result[] = array('CAPTION'=>t('Color'),'TYPE'=>'color','PROP'=>'color');
$result[] = array('CAPTION'=>t('Auto Size'),'TYPE'=>'check','PROP'=>'autoSize','UPDATE_DSGN'=>1);
$result[] = array('CAPTION'=>t('Align'),'TYPE'=>'combo','PROP'=>'alignment','VALUES'=>array('taLeftJustify', 'taRightJustify', 'taCenter'));
$result[] = array('CAPTION'=>t('Valign'),'TYPE'=>'combo','PROP'=>'layout','VALUES'=>array('tlTop', 'tlCenter', 'tlBottom'));
$result[] = array('CAPTION'=>t('Transparent'),'TYPE'=>'check','PROP'=>'transparent');
$result[] = array('CAPTION'=>t('Word Wrap'),'TYPE'=>'check','PROP'=>'wordWrap');
addDefProp ('Hint', &$result);

$result[] = array('CAPTION'=>t('Running line'),'TYPE'=>'check','PROP'=>'running_line','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('To the left?'),'TYPE'=>'check','PROP'=>'Left_running_line','ADD_GROUP'=>true);
$result[] = array('CAPTION'=>t('Interval (ms)'), 'PROP'=>'IntervalTimer', 'TYPE'=>'number','ADD_GROUP'=>true,'UPDATE_DSGN'=>true);
addDefProp('DefaultVisual', &$result);

return $result;