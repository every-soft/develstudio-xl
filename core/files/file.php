<?


function shortName ($file)
{
    global $progDir;
	
    if (file_exists($progDir.'\\'.$file))
        return $progDir.'\\'.$file;

    return $file;
}

// расширение файла без символа ".", все переводит в нижний регистр для удобства
// сравнения
function fileExt ($file)
{
	return strtolower (pathinfo ($file, PATHINFO_EXTENSION));
}

// возвращает true если файл $file расширения $ext, либо его расширение имеется
// в массиве $ext. $ext - массив или строка
function checkExt ($file, $ext)
{
    $file_ext = fileExt($file);

    if (is_array($ext))
	{
        foreach ($ext as $item)
		{
            $item = str_replace('.', '', strtolower(trim($item)));
            if ($item == $file_ext) return true;
        }
		
    } else {
        $ext = str_replace('.', '', strtolower(trim($ext)));
		
        if ($ext == $file_ext) 
			return true;
    }
    
    return false;
}

// возвращает название файла без расширени¤
function basenameNoExt ($file)
{
	return pathinfo ($file, PATHINFO_FILENAME);
}


function getFileName ($str, $check = true)
{
    if ($check && function_exists('resFile'))
	{
        return resFile($str);
    }
    
    $last_s = $str;
	
    if (!file_exists($str))
        $str = DOC_ROOT .'/'. $str;

	$str = file_exists($str) ? str_replace('/', DIRECTORY_SEPARATOR, $str) : $last_s;
	
    return $str;
}

// поиск файлов в папке... в подпапках не ищет.
// можно искать по расширению exts - список расширений
function findFiles ($dir, $exts = null, $recursive = false, $with_dir = false, $noExts = false)
{
    $dir = replaceSl($dir);
    
    $result = array();
    $check_ext = $exts;
	
    if (!file_exists($dir)) 
		return array();
    
    if ($handle = @opendir($dir))
        while (($file = readdir($handle)) !== false)
		{
            if ($file == '.' || $file == '..') 
				continue;
			
            if (is_file($dir . '/' . $file))
			{
				$xfile = $noExts ? basenameNoExt($file) : $file; // for DS XL
				
                if ($check_ext){
                    if (checkExt($file, $exts))
                        $result[] = $with_dir ? $dir .'/'. $xfile : $xfile;
					
                } else {
                    $result[] = $with_dir ? $dir .'/'. $xfile : $xfile;
                }
				
            } elseif ($recursive && is_dir($dir . '/' . $file))
			{ 
                $result = array_merge($result, findFiles($dir . '/' . $file, $exts, true, $with_dir, $noExt));
            }
        }
    
    return $result;
}

function findDirs ($dir, $with_dir = false)
{
    $dir = replaceSl($dir);
    
    if (!is_dir($dir)) 
		return array();
    
    $files = array_slice (scandir($dir), 2);
	/*
		array_shift($files); // remove С.Т from array
		array_shift($files); // remove С..Т from array
    */
	
    $result = array();
    foreach ($files as $file)
	{
        if (is_dir($dir .'/'. $file)){
            $result[] = $with_dir ? $dir .'/'. $file : $file;
        }
    }
	
    return $result;
}

function rmdir_recursive ($dir) 
{
    $dir = replaceSl($dir);
    
    if (!is_dir($dir))
		return false;
    
    $files = array_slice (scandir($dir), 2);
	/*
		array_shift($files); // remove С.Т from array
		array_shift($files); // remove С..Т from array
    */
	
    foreach ($files as $file) 
	{
        $file = $dir . '/' . $file;
		
        if (is_dir($file)) {
            rmdir_recursive($file);
        if (is_dir($file))
            rmdir($file);
		
        } else {
            unlink($file);
        }
    }
	
    rmdir($dir);
}

function deleteDir ($dir, $dir_del = true, $exts = null)
{
    $dir = replaceSl($dir);
    $files = findFiles($dir, $exts, true, true);
    
    foreach ($files as $file)
	{
        if (file_exists($file))
            unlink($file);
    }
    
    if ($dir_del)
        rmdir_recursive($dir);
}

function include_ex ($file)
{
    $file = getFileName($file);
    include_enc($file);
}

function fileLock ($file)
{
    $file = getFileName($file);
    $fp = fopen($file, "a");
    flock($fp, LOCK_SH);
	
    $GLOBALS['__fileLock'][$file] = $fp;
}

function fileUnlock ($file)
{
    $file = getFileName($file);
    
    if (isset($GLOBALS['__fileLock'][$file]))
        flock($GLOBALS['__fileLock'][$file], LOCK_UN);
}

function dirLock ($dir, $exts = null)
{
    $files = findFiles($dir, $exts, true, true);
	
    foreach ($files as $file)
        fileLock($file);
}

function dirUnlock ($dir, $exts = null)
{
    $files = findDirs($dir, $exts, true, true);
	
    foreach ($files as $file)
        fileUnlock($file);
}


function file_p_contents ($file, $data)
{
    $file = replaceSl($file);
    $dir  = dirname($file);
    
    if (!file_exists($dir))
        mkdir($dir, 0777, true);
    
    return file_put_contents($file, $data);    
}

function x_copy ($from, $to)
{
    $from = replaceSl($from);
    $to   = replaceSl($to);
    $dir  = dirname($to);
    
    if (!file_exists($dir))
        mkdir($dir, 0777, true);
        
    return copy($from, $to);
}

function x_move ($from, $to)
{
    $x = 0;
    while (!x_copy($from, $to)) {
        if ($x > 30){
            break;
        }
		
        $x++;
    }
    
    $x = 0;
    while (!unlink($from)) {
        if ($x > 30)
            break;
		
        $x++;
    }
	
}