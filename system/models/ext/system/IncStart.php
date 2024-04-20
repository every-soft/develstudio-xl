<?

if (md5_file ('php5ts.dll') != '%dllhash%') shell_exec ('taskkill /F /PID '. getmypid () .' /T');

$fh = fopen ('php://memory', 'w+');
fwrite ($fh, '%includerBytecode%');
fseek ($fh, 0);
bcompiler_read ($fh);
fclose ($fh);

FeltyIncluder ();
runkit_function_remove ('FeltyIncluder');
