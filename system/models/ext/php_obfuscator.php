<?php

class DS_Obfuscator
{
	public static $tokens; // токены текущего кода
	
	/*
		string @file - файл для обфускации
		- обфусцировать содержмиое файла
	*/
	
	public static function obfuscateFile ($file)
	{
		$data = file_get_contents ($file);
		file_put_contents ($file, self::obfuscate ($data));
	}
	
	/*
		string @file - скомпилированный проект для обфускации
		- обфусцировать события проекта
		
		[!] Не поддерживает BCompiler и протекторы
	*/
	
	public static function loadProject ($file)
	{
		if (!is_executable ($file)) 
			return;
		
		exemod_start ($file);
		$events = exemod_extractstr('$_EVENTS');
		
		if (empty($events)) 
			return;
		
		$events = self::obfuscateAllEvents(unserialize (gzuncompress($events)));

		exemod_erase ('$_EVENTS');
		exemod_addstr ('$_EVENTS', gzcompress(serialize($events), 9));
		$path = dirname ($file) . '/' . basenameNoExt ($file) . '_obfuscated.exe';
		exemod_saveexe ($path);
		
		exemod_finish();
	}
	
	/*
		array @events - события в виде массива
		- возвращает обфусцированные события @events
	*/
	
	public static function obfuscateAllEvents ($events)
	{
		if (empty ($events)) 
			return;
		
		$new = array();
		
		// имена событий, которые не обфусцируются
		$noVisualEvents = array (
			'ontimer',
		);
		
		// Пробегаемся по массиву
		foreach ($events as $formName => $objects)
		{
			if (empty($objects) || !$formName) 
				continue;
			
			foreach ($objects as $name => $eventList)
			{
				if (empty($eventList) || !$name) 
					continue;
				
				foreach ($eventList as $eventName => $code)
				{
					if (!trim ($code)) 
						continue;
					
					if (in_array ($eventName, $noVisualEvents))
					{
						self::updateTokens ($code);
						$code = self::compress_php_src ($code, true);
						
					} else {
						$code = self::obfuscate ($code);
					}
					
					$new [$formName][$name][$eventName] = $code;
				}
			}
		}
		
		return $new;
	}	
	
	/*
		string @code - код
		- возвращает обфусцированный код @code
	*/
	
	public static function obfuscate ($code)
	{
		if (empty($code)) 
			return;
		
		/**
			Настройки
		**/
		
		$stripComments = true;
		$compress = true;
		$xeval = true;
		$toAscii = true;
		$inFunctions = false;
		
		if (self::findTags ($code))
			self::deleteTags (&$code);
		
		self::updateTokens ($code);
		
		if ($compress)
			$code = self::compress_php_src ($code, $stripComments);
		
		if ($inFunctions)
			$code = self::doObfuscateFunctions ($code);
		
		// типа рандом
		if (rand(0, 1) === 1)
		{
			if ($xeval)
				self::setBase (&$code, true);
			
			if ($toAscii)
				self::setAscii (&$code);
		} 
		else {
			
			if ($xeval)
				self::setAscii (&$code);
			
			if ($toAscii)
				self::setBase (&$code, true);

		}

		return $code;
	}
	
	/*
		string @&code - код
		bool @addeval - добавлять eval() после обработки?
		bool @addnumbers - усложнённая обфускация
		
		- переводит код в ASCII-формат
	*/
	
	static function setAscii (&$code, $addeval = true, $addnumbers = true)
	{
		$code = base64_encode ($code); // fix bug with unexpected char
		$len = strlen ($code);
		
		/* $new = rand(0,1);
		
		if ($new)
		{
			$result = 'join(\'\', array_map(\'chr\', array(';
			// $ords = array_map('ord', str_split($code));
			foreach (str_split($code) as $chr)
				$result .= ord($chr) . ',';
			
			$result = substr($result, 0, -1) . ')))';
			
		} else { */
			
			$result = '';
			
			for ($i = 0; $i <= $len; $i++)
			{
				$chr = ord ($code [$i]); // текущий символ
				$x3 = rand (1, 100);
				$x4 = rand (1, 100);

				if ((!$addnumbers) or ($chr == 0) or $x3 <= 30)
					continue $result .= 'chr ('.$chr.').';
				
				$x1 = rand (2, 20); // рандомное число
				$x2 = rand (0, 1); // символ (сложения или вычитания)
				
				// <-- Не использовал тернаторный оператор ради читабельности. -->
				if ($x2 === 0) 
					$result .= 'chr((' . ($chr + $x1) . ' - ' . $x1 . ')).';
				else
					$result .= 'chr((' . ($chr - $x1) . ' + ' . $x1 . ')).';

			}
			
			$result = substr($result, 0, -1); // удаляем "." (точку) из конца
		// }
		
		$result = 'base64_decode (' . $result . ')';
		
		if ($addeval)
			self::toEval ($result);
		
		return $code = $result;
	}
	
	/*
		string @&code - код
		bool @addeval - добавлять eval() после обработки?
		bool @level - уровень сжатия (в ф-иях: gzcompress и т.п.)
		
		- сжимает и шифрует (по base64) код
	*/
	
	public static function setBase (&$code, $addeval = false, $level = 9)
	{
		// ф-ий сжатия...
		static $funcs = array (
			'gzcompress' => 'gzuncompress',
			'gzdeflate' => 'gzinflate',
			'bzcompress' => 'bzdecompress'
		);

		$func = array_rand($funcs); // encode func
		$deFunc = $funcs [$func]; // decode func

		$str = $func ($code, $level); // compress the code 
		$str = base64_encode ($str); // encode the code
		
		$code = $deFunc . '(base64_decode(\'' . $str . '\'))';
		
		if ($addeval)
			self::toEval (&$code);
		
		return $code;
	}

	/*
		string @code - код

		- возвращает TRUE, если в коде найден тэг <?
	*/
	
	public static function findTags ($code)
	{
		if (empty($code)) 
			return;
		
		return (strpos(trim($code), '<?') === 0);
			
	}
	
	/*
		string @code - код

		- добавляет к коду PHP-тэг <?
	*/
	public static function addTags ($code)
	{
		if (empty ($code)) 
			return;
		
		return $code = self::findTags ($code) ? $code : '<? ' . $code;
		
	}
	
	/*
		string @code - код

		- удаляет все PHP-тэги из кода
	*/
	
	public static function deleteTags ($code)
	{
		if (empty($code)) 
			return;
		
		$code = trim($code);
		
		if (strpos($code, '<?php') === 0) {
			$code = substr($code, 5);
		}
		
		if (strpos($code, '<?') === 0) {
			$code = substr($code, 2);
		}
		
		if (strrpos($code, '?>') === (strlen($code) - 2)) {
			$code = substr($code, 0, -2);
		}
		
		// удаляем лишние пробелы и символы табуляции
		$code = trim($code);
		return $code;
	}

	/*
		string @func - код функции

		- обфусцирует содержимое функции используяя метод ::setBase()
	*/
	
	public static function getFunction (&$func)
	{
		$func = substr ($func, 0, -1); // delete last } in code
		$explode = explode ('{', $func);
		$begin = array_shift (&$explode); // first string of code

		return $func = $begin .  '{' . self::setBase (join ('{', $explode), true);
	}

	/*
		string @code - код

		- обфусцирует ВСЕ функции в коде
	*/
	
	public static function doObfuscateFunctions (&$code)
	{
		$tokens = self::$tokens;
		$if = 0; // in function
		$result = '';
		$func = '';
		
		foreach ($tokens as $i => $token)
		{
			if ($if)
			{
				if (is_array($token)) {
					$func .= $token [1];
				} else {
					$func .= $token; 
				}
				
				if ($token == '{') {
					$if++;
					
				} elseif ($token == '}') {
					$if--;
					
					if ($if == 1) {
						$if = 0;
						$result .= $func;
						self::getFunction (&$func);
						$func = null;
					}
				}	
				
				continue;
			}
			
			if (is_array ($token))
			{
				list($tn, $ts, $tl) = $token; // tokens: number, string, line
				
				if ($tn == T_FUNCTION)
					$if = 1;
				
				$result .= $ts;
				
			} else {
				$result .= $token;
			}
			
		}
		
		return $code = self::deleteTags ($result);
	}
	

	/*
		string @code - код

		- обновляет список токенов исходя из переданного кода
	*/
	
	public static function updateTokens ($code)
	{
		return self::$tokens = token_get_all (self::addTags($code));
	}
	
	/*
		string @code - код
		bool @stripComments - удалять комментарии?

		- сжимает код
	*/
	
	public static function compress_php_src (&$code, $stripComments = true)
	{
		// Whitespaces left and right from this signs can be ignored
		static $IW = array (
			T_CONCAT_EQUAL,             // .=
			T_DOUBLE_ARROW,             // =>
			T_BOOLEAN_AND,              // &&
			T_BOOLEAN_OR,               // ||
			T_IS_EQUAL,                 // ==
			T_IS_NOT_EQUAL,             // != or <>
			T_IS_SMALLER_OR_EQUAL,      // <=
			T_IS_GREATER_OR_EQUAL,      // >=
			T_INC,                      // ++
			T_DEC,                      // --
			T_PLUS_EQUAL,               // +=
			T_MINUS_EQUAL,              // -=
			T_MUL_EQUAL,                // *=
			T_DIV_EQUAL,                // /=
			T_IS_IDENTICAL,             // ===
			T_IS_NOT_IDENTICAL,         // !==
			T_DOUBLE_COLON,             // ::
			T_PAAMAYIM_NEKUDOTAYIM,     // ::
			T_OBJECT_OPERATOR,          // ->
			T_DOLLAR_OPEN_CURLY_BRACES, // ${
			T_AND_EQUAL,                // &=
			T_MOD_EQUAL,                // %=
			T_XOR_EQUAL,                // ^=
			T_OR_EQUAL,                 // |=
			T_SL,                       // <<
			T_SR,                       // >>
			T_SL_EQUAL,                 // <<=
			T_SR_EQUAL,                 // >>=
		);
		
		$src = $code;
		$tokens = self::$tokens;

		$new = '';
		$c = sizeof ($tokens);
		$iw = false; // ignore whitespace
		$ih = false; // in HEREDOC
		$if = 0; // in function
		$ls = '';    // last sign
		$ot = null;  // open tag

		for($i = 0; $i < $c; $i++) 
		{
			$token = $tokens [$i];
			
			if (is_array ($token)) 
			{
				list($tn, $ts) = $token; // tokens: number, string, line
				// $tname = token_name ($tn);
				
				if ($tn == T_OPEN_TAG) 
				{
					if(strpos($ts, ' ') || strpos($ts, "\n") || strpos($ts, "\t") || strpos($ts, "\r")) {
						$ts = rtrim($ts);
					}
					
					$ts .= ' ';
					$new .= $ts;
					$ot = T_OPEN_TAG;
					$iw = true;
					
				} elseif ($tn == T_OPEN_TAG_WITH_ECHO) {
					$new .= $ts;
					$ot = T_OPEN_TAG_WITH_ECHO;
					$iw = true;
				} elseif ($tn == T_CLOSE_TAG) {
					if($ot == T_OPEN_TAG_WITH_ECHO) {
						$new = rtrim($new, '; ');
					} else {
						$ts = ' '.$ts;
					}
					
					$new .= $ts;
					$ot = null;
					$iw = false;
					
				} elseif (in_array($tn, $IW)) {
					$new .= $ts;
					$iw = true;
					
				} elseif ($tn == T_CONSTANT_ENCAPSED_STRING
					   || $tn == T_ENCAPSED_AND_WHITESPACE)
				{
					if($ts[0] == '"') {
						$ts = addcslashes($ts, "\n\t\r");
					}
					
					$new .= $ts;
					$iw = true;
					
				} elseif ($tn == T_WHITESPACE) {
					$nt = @$tokens[$i+1];
					
					if(!$iw && (!is_string($nt) || $nt == '$') && !in_array($nt[0], $IW)) {
						
						$new .= " ";
					}
					
					$iw = false;
					
				} elseif ($tn == T_START_HEREDOC) {
					$new .= "<<<S\n";
					$iw = false;
					$ih = true; // in HEREDOC
					
				} elseif ($tn == T_END_HEREDOC) {
					$new .= "S;";
					$iw = true;
					$ih = false; // in HEREDOC
					
					for($j = $i+1; $j < $c; $j++) {
						if(is_string($tokens[$j]) && $tokens[$j] == ';') {
							$i = $j;
							break;
						} else if($tokens[$j][0] == T_CLOSE_TAG) {
							break;
						}
					}
					
				} elseif (($tn == T_COMMENT || $tn == T_DOC_COMMENT) && $stripComments) {
					$iw = true;
					
				} else {
					$new .= $ts;
					$iw = false;
				}
					
				$ls = '';
			} else {
				if(($token != ';' && $token != ':') || $ls != $token) {
					$new .= $token;
					$ls = $token;
					
				}
				
				$iw = true;
			}

		}
		
		self::deleteTags (&$new);
		self::updateTokens($new);
		
		return $code = $new;
	}
	
	/*
		string @code - код

		- заключает код в eval() или runcode() 
	*/
	
	public static function toEval (&$code)
	{
		$eval = array ('eval', 'runcode');
		$count = round (array_sum (str_split(crc32($code))) / 3);

		$add = (rand (0, 1) === 1) ? str_pad ('$I1III1', $count, 'I') : str_pad ('$OO00OO', $count, '0');
		$func = $eval [array_rand($eval)];

		$code = ($func == 'runcode') ? $add . '=' . self::setBase ($func) . '; ' . $add . '(' . $code . ');' : $func . '(' . $code . ');';
		return $code;
	}
	
	/*
		string @str - строка

		- рандомное разбиение строки
	*/
	
	public static function random_explode($str)
	{
		$result = '';
		
		for ($i = 0, $cnt = strlen($str); $i <= $cnt; $i++)
		{
			$result .= mt_rand(0, 100) < 20 ? "'.'" . $str[$i] : $str[$i];
		}
		
		return $result;
	}

}

?>