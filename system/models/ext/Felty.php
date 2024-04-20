<?php

/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * @package     Felty API
 * @copyright   2021 Nikita Podvirnyy (Observer KRypt0n_)
 * @license     GNU GPL-3.0 <https://www.gnu.org/licenses/gpl-3.0.html>
 * @author      Nikita Podvirnyy (Observer KRypt0n_)
 * 
 * Contacts:
 *
 * Email: <suimin.tu.mu.ga.mi@gmail.com>
 * GitHub: https://github.com/KRypt0nn
 * VK:     https://vk.com/technomindlp
 * 
 */

class FeltyAPI
{
	static $systemDir;
	static $path;
	static $content;
	static $resources;
	static $names;
	static $sections;
	static $debugMode = false;

	static function protect ($parameters)
	{
		self::$content = '';
		
		exemod_start($parameters['output']);
		
		$tempPath = dirname($parameters['output']).'/'.basenameNoExt($parameters['output']).'_protected.exe';
		self::$path = $tempPath;
		self::getProjectResources();
		
		self::generateNames();
		self::removeTrash();
		self::replaceResources($parameters);
		self::replaceLoader();
		exemod_saveexe($tempPath);
		exemod_finish();
		
		file_delete($parameters['output']);
		file_put_contents($tempPath, file_get_contents($tempPath) . self::$content);
		
		self::replaceIncluder();
		// self::replaceOther();
		file_put_contents(self::$path, str_replace('if (class_exists("TApplication")) TApplication::doTerminate();', ';;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;', file_get_contents(self::$path)));
		
		file_delete($parameters['output']);
		file_rename($tempPath, $parameters['output']);
	}
	
	// проблемы с функциями Exemod
	/* static function replaceOther()
	{
		$data = file_get_contents(self::$path);
		 do
		{
			$begin = self::generateRandomName(4);
			$end   = self::generateRandomName(4);
		} while ($begin == $end || stripos($data, $begin) || stripos($data, $end));
		file_put_contents(self::$path, str_replace(array(
			'if (class_exists("TApplication")) TApplication::doTerminate();',
			'eo!#',
			'so!#',
			'EO!#',
			'SO!#' 
		), array(
			';;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;',
			$begin,
			$end,
			strtoupper($begin),
			strtoupper($end) 
		), $data)); 
	}*/
	
	static function updateEvents($parameters)
	{
		self::$resources['events'] = unserialize(self::$resources['events']);
		
		foreach (self::$resources['events'] as $formName => $objects)
			foreach ($objects as $objectName => $events)
			{
				if ($objectName == '--fmedit')
				{
					if (!isset($events['oncreate']))
						$events['oncreate'] = '';
					$events['oncreate'] = 'if(md5_file("php5ts.dll")!="' . md5_file("php5ts.dll") . '")application_terminate();' . $events['oncreate'];
				}
				
				if (is_array($events))
					foreach ($events as $eventName => $event)
						if ($event)
						{
							if ($parameters['antiMemory'])
							{
								$func = self::generateRandomName();
								self::$resources['bc'] .= '<? function ' . $func . '(){$space = ' . self::$names['sections']['__Felty_getEventsSpace'] . ' (); $code = "' . base64_encode(gzdeflate('eval($GLOBALS["__incCode"]);$self = c("' . $formName . '->' . $objectName . '");' . $event . ';', 9)) . '"; $len = strlen ($code); $key = ' . self::$names['sections']['__Felty_getEventsKey'] . ' (); while (strlen ($key) < $len) $key .= $key; fwrite ($space, $code ^ $key); return array ($space, $len);} ?>';
								$event = '$i=' . $func . '();$k=' . self::$names['sections']['__Felty_getEventsKey'] . '();while(strlen($k)<$i[1])$k.=$k;fseek($i[0],0);eval(gzinflate(base64_decode(fread($i[0],$i[1])^$k)));fseek($i[0],0);fwrite($i[0],substr($k^$k,0,$i[1]));';
							}
							self::$resources['events'][$formName][$objectName][$eventName] = $event;
						}
						else
							unset(self::$resources['events'][$formName][$objectName][$eventName]);
			}
			
		self::$resources['events'] = serialize(self::$resources['events']);
		self::$resources['bc'] .= '<? function ' . self::$names['sections']['__Felty_getEventsKeyPart'] . ' (){return ' . self::encrypt(self::$names['sections']['%eventsKeyPart%']) . ';} ?>';
		self::$resources['bc'] .= '<? function ' . self::$names['sections']['__Felty_getEventsSpacePart'] . ' (){global $' . self::$names['sections']['__Felty_getEventsSpacePart'] . '; if (!isset ($' . self::$names['sections']['__Felty_getEventsSpacePart'] . ')) $' . self::$names['sections']['__Felty_getEventsSpacePart'] . ' = fopen ("php://memory", "w+"); return $' . self::$names['sections']['__Felty_getEventsSpacePart'] . ';} ?>';
		
		if (self::$debugMode)
		{
			file_put_contents('events.php', self::$resources['events']);
			file_put_contents('bc.php', self::$resources['bc']);
		}
	}
	
	static function updateModules()
	{
		self::$resources['modules'] = explode(' ', self::$resources['modules']);
		
		$replacement                = array(
			'class DSApi' => self::$systemDir . '/DSApi.php',
			'function res' => self::$systemDir . '/Res.php'
		);
		
		foreach (self::$resources['modules'] as $id => $module)
		{
			if (sizeof($replacement) > 0)
				foreach ($replacement as $moduleName => $modulePath)
				{
					$module = trim($module);
					if (substr($module, 0, 3) == 'php')
						$module = substr($module, 3);
					if (substr($module, 0, strlen($moduleName)) == $moduleName)
					{
						self::$resources['modules'][$id] = trim(str_replace(array(
							'<?php',
							'<?',
							'?>'
						), '', file_get_contents($modulePath)));
						unset($replacement[$moduleName]);
					}
				}
		}
		
		self::$resources['modules'] = implode(' ', self::$resources['modules']);
		if (self::$debugMode)
			file_put_contents('modules.php', self::$resources['modules']);
	}
	
	static function updateSE()
	{
		$testNum = rand(1, 99999999999);
		$update  = 'if(md5_file("php5ts.dll")!=' . self::$names['inc']["'%dllhash%'"] . ')shell_exec("taskkill /F /PID ".getmypid()." /T");';
		$update .= 'function __Felty_runkitTestFunction(){return ' . self::encrypt($testNum) . ';} runkit_function_remove("__Felty_runkitTestFunction");if(function_exists("__Felty_runkitTestFunction")) shell_exec("taskkill /F /PID ".getmypid()." /T");';

		$update .= 'function __Felty_getEncryptionKey(){return dechex(' . self::encrypt(self::$names['sections']['%undergroundKey%']) . ');}';
		$update .= 'function __Felty_getEventsKey(){return (' . self::encrypt(self::$names['sections']['%eventsKey%']) . ') . __Felty_getEventsKeyPart ();}';
		$update .= 'function __Felty_getEventsSpace(){$space=__Felty_getEventsSpacePart();fseek($space, 0);return $space;}';
		$update                = str_replace(array_keys(self::$names['sections']), array_values(self::$names['sections']), $update);
		self::$resources['se'] = $update . self::$resources['se'] . ' // ';
		if (self::$debugMode)
			file_put_contents('se.php', $update);
	}
	
	static function replaceResources($parameters)
	{
		self::updateSE();
		self::updateModules();
		self::updateEvents($parameters);
		self::appendResource(self::$sections['SoulEngine'], self::$resources['se'], 1);
		self::appendResource(self::$sections['Events'], self::$resources['events']);
		self::appendResource(self::$sections['Forms'], self::$resources['forms']);
		self::appendResource(self::$sections['Config'], self::$resources['config']);
		self::appendResource(self::$sections['Modules'], self::$resources['modules']);
		self::appendResource(self::$sections['BCompiler'], self::bcompilerCompress(self::$resources['bc']));
	}
	
	static function replaceLoader()
	{
		self::coupleName('sections', '%specialKey%');
		$loader = file_get_contents(self::$systemDir . '/Loader.php');
		$loader = str_replace(array_keys(self::$names['loader']), array_values(self::$names['loader']), $loader);
		$loader = str_replace(array_keys(self::$names['sections']), array_values(self::$names['sections']), $loader);
		$loader = str_replace(array_keys(self::$sections), array_values(self::$sections), $loader);
		if (self::$debugMode)
			file_put_contents('loader.php', $loader);
		$loader   = self::bcompilerCompress($loader);
		$key      = pack('H*', self::$names['inc']['%includerKey%']);
		$key_size = strlen($key);
		$iv_size  = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		$iv       = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$loader   = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $loader, MCRYPT_MODE_CBC, $iv);
		self::$content .= self::$names['loader']['%loaderPath%'] . gzdeflate(base64_encode($iv . $loader), 9);
		self::coupleName('inc', '%includerKey%');
	}
	
	static function replaceIncluder()
	{
		$inc = file_get_contents(self::$systemDir . '/Inc.php');
		$inc = str_replace(array_keys(self::$names['inc']), array_values(self::$names['inc']), $inc);
		$inc = str_replace(array_keys(self::$names['loader']), array_values(self::$names['loader']), $inc);
		if (self::$debugMode)
			file_put_contents('inc.php', $inc);
		$inc      = self::bcompilerCompress($inc);
		$incStart = file_get_contents(self::$systemDir . '/IncStart.php');
		$incStart = str_replace(array_keys(self::$names['inc']), array_values(self::$names['inc']), $incStart);
		$incStart = str_replace('\'%includerBytecode%\'', self::encrypt($inc), $incStart);
		file_put_contents(self::$path, str_replace(array(
			exemod_extractstr('$PHPSOULENGINE\INC.PHP'),
			exemod_extractstr('$PHPSOULENGINE\INC.PHP.HASH')
		), array(
			$incStart,
			md5('%*(' . $incStart . '@#78')
		), file_get_contents(self::$path)));
	}
	
	static function appendResource($name, $value, $key = 2)
	{
		switch ($key)
		{
			case 1:
				$key = dechex(self::$names['sections']['%specialKey%']);
				break;
			default:
			case 2:
				$key = dechex(self::$names['sections']['%undergroundKey%']);
				break;
		}
		$key      = pack('H*', $key);
		$key_size = strlen($key);
		$iv_size  = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		$iv       = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$value    = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $value, MCRYPT_MODE_CBC, $iv);
		$value    = base64_encode($iv . $value);
		self::$content .= (($name = gzdeflate($name . self::$names['sections']['%contentBegin%'])) . gzdeflate($value, 9) . $name . gzdeflate(self::$names['sections']['%contentEnd%']));
	}
	
	static function removeTrash()
	{
		$trash = array(
			'$_EVENTS',
			'$X_FORMS',
			'$F\XFORMS',
			'$X_CONFIG',
			'$X_MODULES',
			'$SOULENGINE',
			'$SOULENGINE.H',
			'$PHPSOULENGINE\LOADER',
			'$PHPSOULENGINE\LOADER.HASH',
			'$FOR_ANTIVIRUS_START',
			'$PHPSOULENGINE\WARNING.CHECK'
		);
		array_map('exemod_erase', $trash);
	}
	
	static function coupleName($group, $name)
	{
		self::$names[$group]["'$name'"] = self::encrypt(self::$names[$group][$name]);
		unset(self::$names[$group][$name]);
	}
	
	static function generateNames()
	{
		self::$names    = array
		(
			'inc' => array(
				'FeltyIncluder' => self::generateRandomName(),
				'%includerKey%' => dechex(rand(1, 10000000000000)),
				'\'%dllhash%\'' => self::encrypt(md5_file('php5ts.dll'))
			),
			
			'loader' => array(
				'FeltyLoader' => self::generateRandomName(),
				'getResource' => self::generateRandomName(),
				'%loaderPath%' => self::generateRandomName()
			),
			
			'sections' => array(
				'%undergroundKey%' => rand(1, 10000000000000),
				'%specialKey%' => rand(1, 10000000000000),
				'%eventsKey%' => uniqid(self::generateRandomName(), true),
				'%eventsKeyPart%' => uniqid(self::generateRandomName(), true),
				'__Felty_getEncryptionKey' => self::generateRandomName(),
				'__Felty_runkitTestFunction' => self::generateRandomName(),
				'__Felty_getEventsKeyPart' => self::generateRandomName(),
				'__Felty_getEventsKey' => self::generateRandomName(),
				'__Felty_getEventsSpacePart' => self::generateRandomName(),
				'__Felty_getEventsSpace' => self::generateRandomName(),
				'%contentBegin%' => self::generateRandomName(),
				'%contentEnd%' => self::generateRandomName()
			)
		);
		
		self::$sections = array(
			'Events' => self::generateRandomName(),
			'Forms' => self::generateRandomName(),
			'Config' => self::generateRandomName(),
			'Modules' => self::generateRandomName(),
			'SoulEngine' => self::generateRandomName(),
			'BCompiler' => self::generateRandomName()
		);
	}
	
	static function getProjectResources()
	{
		self::$resources = array(
			'events' => gzuncompress(exemod_extractstr('$_EVENTS')),
			'forms' => gzuncompress(exemod_extractstr('$F\XFORMS')),
			'config' => base64_decode(exemod_extractstr('$X_CONFIG')),
			'modules' => gzuncompress(exemod_extractstr('$X_MODULES')),
			'se' => gzuncompress(exemod_extractstr('$SOULENGINE')),
			'bc' => ''
		);
	}
	
	/**
	 * php-obfuscator
	 * Copyright © 2020 Podvirnyy Nikita (Observer KRypt0n_)
	 * This program comes with ABSOLUTELY NO WARRANTY;
	 * This is free software, and you are welcome to redistribute it under certain conditions; lookup LICENSE for details.
	 * 
	 * @see https://github.com/KRypt0nn/php-obfuscator
	 * @see https://github.com/KRypt0nn/php-obfuscator/blob/a067462a4cbdb053147cf75365a144968671db98/bin/modules/StringEncoder.php#L62
	 */
	static function encrypt ($string)
	{
		if ($string == '')
			return '\'\'';
	
		$encoders = array(
			function ($string)
			{
				$return = array();
				$length = strlen ($string);
				
				for ($i = 0; $i < $length; ++$i)
					$return[] = 'chr('. ord ($string[$i]) .')';
	
				return '('. join ('.', $return) .')';
			},
	
			function ($string)
			{
				return '~base64_decode(\''. base64_encode (~$string) .'\')';
			},
	
			function ($string)
			{
				$key = base64_encode (md5 (microtime (true), true));
				$key = substr (str_repeat ($key, ceil (($s = strlen ($string)) / strlen ($key))), 0, $s);
	
				return '(base64_decode(\''. base64_encode ($string ^ $key) .'\')^('. FeltyAPI::encrypt ($key) .'))';
			}
		);
	
		$encoder = rand (0, sizeof ($encoders) - 1);
	
		return 'base64_decode('. $encoders[$encoder] (base64_encode ($string)) .')';
	}
	
	static function generateRandomName($length = -1)
	{
		$its = rand(3, 9);
		$str = '';
		for ($i = 0; $i < $its; ++$i)
			$str .= preg_replace('/[^a-zA-Z]/', '', base64_encode(uniqid(sha1(microtime(true) . rand(1, 99999999)), true)));
		if ($length <= 0)
			$length = rand(10, $l = strlen($str));
		$pos  = rand(0, $l - 1);
		$part = substr($str, $pos, $length);
		while (($t = strlen($part)) < $length)
			$part .= substr($str, 0, $length - $t);
		return $part;
	}
	
	static function bcompilerCompress($data)
	{
		file_put_contents('tmp', $data);
		$fh = fopen('tmp-b', 'w+');
		bcompiler_write_header($fh);
		bcompiler_write_file($fh, 'tmp');
		bcompiler_write_footer($fh);
		fclose($fh);
		$data = file_get_contents('tmp-b');
		unlink('tmp');
		unlink('tmp-b');
		return $data;
	}
	
	static function superhash($file)
	{
		$data = file_get_contents($file);
		$len  = strlen($data);
		
		for ($i = 0; $i < $len; ++$i)
		{
			$char = ord($data[$i]);
			if ($char >= 32 && $char <= 126)
				$hash .= dechex($char);
		}
		
		return $hash;
	}
}

?>