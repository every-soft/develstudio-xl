<?php

/*
	Joiner class
	by @KRypt0n_
	
	Special for DevelStudio XL/X
*/

class File
{
    public $path;

    public function __construct ($path)
    {
        if (!is_file ($path))
            return error_msg ('Wrong $path paeam');
        
        $this->path = $path;
    }

    public function toXML ()
    {
        return '<File><Type>2</Type><Name>'. basename ($this->path) .'</Name><File>'. $this->path .'</File><ActiveX>False</ActiveX><ActiveXInstall>False</ActiveXInstall><Action>0</Action><OverwriteDateTime>False</OverwriteDateTime><OverwriteAttributes>False</OverwriteAttributes><PassCommandLine>False</PassCommandLine><HideFromDialogs>0</HideFromDialogs></File>';
    }
}

class Folder
{
    public $path;
    public $files = array ();

    public function __construct ($path)
    {
        if (!is_dir ($path))
            return error_msg ('Wrong $path param');
        
        $this->path = $path;

        foreach (array_slice (scandir ($path), 2) as $file)
            $this->files[] = is_dir ($file = $path .'/'. $file) ?
                new Folder ($file) : new File ($file);
    }

    public function toXML ()
    {
        return '<File><Type>3</Type><Name>'. basename ($this->path) .'</Name><Action>0</Action><OverwriteDateTime>False</OverwriteDateTime><OverwriteAttributes>False</OverwriteAttributes><HideFromDialogs>0</HideFromDialogs><Files>'. implode ('', array_map (function ($item)
        {
            return $item->toXML ();
        }, $this->files)) .'</Files></File>';
    }
}

class Joiner
{
    public $input;
    public $output;
    public $files = array ();

    public function __construct ($input, $output)
    {
        if (!is_file ($input))
            return error_msg ('Wrong $input param');

        $this->input  = $input;
        $this->output = $output;
    }

    public function add ($path)
    {
        $this->files [] = is_dir ($path) ?
            new Folder ($path) : new File ($path);

        return $this;
    }

    public function getEVB ()
    {
        return str_replace (array(
            '%INPUT_FILE%',
            '%OUTPUT_FILE%',
            '%FILES%'
        ), array(
            $this->input,
            $this->output,
            implode ('', array_map (function ($item)
            {
                return $item->toXML ();
            }, $this->files))
        ), file_get_contents (__DIR__ .'/system/stub.evb'));
    }

    public function join ()
    {
        file_put_contents (__DIR__ .'/system/temp.evb', $this->getEVB ());
        $return = shell_exec ('"'. __DIR__ .'/system/enigmavbconsole.exe" "'.__DIR__ .'/system/temp.evb"');
        unlink (__DIR__ .'/system/temp.evb');

        return $return;
    }
}
