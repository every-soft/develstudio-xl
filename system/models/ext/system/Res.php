<?php

function res ($resName, $to_del = false)
{
	$resName = replaceSl ($resName);
	
	if (!exemod_extractstr ('$RES$'. $resName))
		return DOC_ROOT ."/data/$resName";
	
	if ($resName[0] == '/')
	{
		$resName[0] = ' ';
		$resName    = ltrim ($resName);
	}
	
	$to_file = SOUL_TMP_DIR ."/data/$resName";
	
	if (is_file ($to_file))
		return $to_file;
	
	if (!is_dir (dirname ($to_file)))
		mkdir (dirname ($to_file), 0777, true);
	
	exemod_extractfile ('$RES$'. $resName, $to_file);
	
	if ($to_del)
		setInterval ($to_del, 'if (is_writable ("'. replaceSl ($to_file) .'")) unlink ("'. replaceSl ($to_file) .'");');
	
	return $to_file;
}

function resFile ($resName)
{
	if (file_exists ($resName))
		return $resName;
	
	$resName = str_ireplace ('{temp}', TEMP_DIR, $resName);
	$resName = str_ireplace ('{drive}', DRIVE_CHAR, $resName);
	$resName = str_ireplace ('{desktop}', DESKTOP_DIR, $resName);
	
	if (strtolower (substr ($resName, 0, 5)) == '{res}')
		return res (str_ireplace ('{res}', '', $resName));
	
	return getFileName ($resName, false);
}

function getRes ($resName)
{
	if ($data = exemod_extractstr ('$RES$'. $resName))
		return $data;
	
	else return file_get_contents (DOC_ROOT ."/data/$resName");
}

function resList ()
{
	$str = exemod_extractstr ('$RESLIST$');
	
	foreach (unserialize ($str) as $i => $s)
		$result[$i] = str_replace ('$RES$', '', $s);
		
	return $result;
}

$m['To abort application?'] = '��������� ����������?';
$m['EVENT']                 = '�������';
$m['Object']                = '������';
$m['Type']                  = '���';
$m['On Line']               = '� ������';

Localization::setMsgArr ($m);

?>
