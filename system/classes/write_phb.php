<?php

function write_phb ($file, $ofile = false)
{
	if (!$ofile)
		$ofile = dirname ($file) . '/' . basenameNoExt($file) . '.phb';

	$fh = fopen ($ofile, 'w');
	bcompiler_write_header ($fh);
	bcompiler_write_file ($fh, $file);
	bcompiler_write_footer ($fh);
	fclose($fh);
}

?>