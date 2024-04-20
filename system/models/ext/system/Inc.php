<?php

function FeltyIncluder ()
{
    if (md5_file ('php5ts.dll') != '%dllhash%')
        shell_exec ('taskkill /F /PID '. getmypid () .' /T');

    $loader = explode ('%loaderPath%', file_get_contents (param_str (0)));

    if ($loader = end ($loader))
    {
        $key     = pack ('H*', '%includerKey%');
        $iv_size = mcrypt_get_iv_size (MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $loader  = base64_decode (gzinflate ($loader));
        $iv_dec  = substr ($loader, 0, $iv_size);
        $loader  = substr ($loader, $iv_size);
        $loader  = mcrypt_decrypt (MCRYPT_RIJNDAEL_128, $key, $loader, MCRYPT_MODE_CBC, $iv_dec);

        if ($loader)
        {
            Global $LOADER;
            
            $fh = fopen ('php://memory', 'w+');

            fwrite ($fh, $loader);
            fseek ($fh, 0); 
            bcompiler_read ($fh);
            fclose ($fh);
            
            //'%evsEncKeyFuncAdr%'  = fopen ("php://memory", "w+");
            //fwrite ('%evsEncKeyFuncAdr%', '%eventsEncryptKey%');
            
            $LOADER = new FeltyLoader ();
        }

        else die ();
    }
}

?>
