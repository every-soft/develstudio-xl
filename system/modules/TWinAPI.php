<?

class TWinAPI
{
	public static function SetWindowPos ($handle, $insertAfter, $x, $y, $w, $h, $uFlags)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll'] 
			int SetWindowPos ( int hWnd, int hWndInsertAfter, int X, int Y, int W, int H, int uFlags );");
		}
		
		return $FFI->SetWindowPos ($handle, $insertAfter, $x, $y, $w, $h, $uFlags);
	}
	
	public static function DestroyWindow ($handle)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll'] 
			int DestroyWindow ( int hWnd );");
		}
		
		return $FFI->DestroyWindow ($handle);
	}
	
	public static function GetTopWindow ($handle)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll'] 
			int GetTopWindow ( int hWnd );");
		}
		
		return $FFI->GetTopWindow ($handle);
	}
	
	public static function IsWindowEnabled ($handle)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll'] 
			int IsWindowEnabled ( int hWnd );");
		}
		
		return $FFI->IsWindowEnabled ($handle);
	}
	
	public static function IsWindow ($handle)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll'] 
			int IsWindow ( int hWnd );");
		}
		
		return $FFI->IsWindow ($handle);
	}
	
	public static function IsWindowVisible ($handle)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll'] 
			int IsWindowVisible ( int hWnd );");
		}
		
		return $FFI->IsWindowVisible ($handle);
	}
	
	public static function OpenIcon ($handle)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll'] 
			int OpenIcon ( int hWnd );");
		}
		
		return $FFI->OpenIcon ($handle);
	}
	
	public static function GetActiveWindow ()
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll'] 
			int GetActiveWindow ();");
		}
		
		return $FFI->GetActiveWindow();
	}
	
	public static function FindWindowExA ($parentHandle, $afterChild, $class, $caption)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("struct LPCTSTR { char string; }; 
			[lib='user32.dll'] 
			int FindWindowExA ( int hwndParent, int hwndChildAfter, struct LPCTSTR *lpszClass, struct LPCTSTR *lpszWindow );");
		}
		
		return $FFI->FindWindowExA($parentHandle, $afterChild, $class, $caption);
	}
	
	public static function EndTask ($handle, $shutDown = false, $force = true)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll']
			int EndTask ( int hWnd, int fShutDown, int fForce );");
		}
		
		return $FFI->EndTask($handle, $shutDown, $force);
	}
	
	public static function GetAsyncKeyState ($key)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll']
			int GetAsyncKeyState ( int vKey );");
		}
		
		return $FFI->GetAsyncKeyState($key);
	}
	
	public static function FindWindowEx ($parentHandle, $afterChild, $class, $caption)
	{
		return self::FindWindowExA($parentHandle, $afterChild, $class, $caption);
	}
	
	public static function GetForegroundWindow ()
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll']
			int GetForegroundWindow ();");
		}
		
		return $FFI->GetForegroundWindow();
	}
	
	public static function GetDesktopWindow ()
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll']
			int GetDesktopWindow ();");
		}
		
		return $FFI->GetDesktopWindow();
	}
	
	public static function GetShellWindow ()
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll']
			int GetShellWindow ();");
		}
		
		return $FFI->GetShellWindow();
	}
	
	public static function GetWindowLong ($handle, $index)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll']
			int GetWindowLongA ( int hWnd , int nIndex );");
		}
		
		return $FFI->GetWindowLongA ($handle, $index);
	}
	
	public static function GetWindowLongA ($handle, $index)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll']
			int GetWindowLongA ( int hWnd , int nIndex );");
		}
		
		return $FFI->GetWindowLongA ($handle, $index);
	}
	
	public static function SetWindowLong ($handle, $long, $index = GWL_EXSTYLE)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll']
			int SetWindowLong ( int hWnd, int dwNewLong , int nIndex );");
		}
		
		return $FFI->SetWindowLong ($handle, $long, $index);
	}
	
	public static function GetFocus ()
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll']
			int GetFocus ();");
		}
		
		return $FFI->GetFocus();
	}
	
	public static function CloseWindow ($handle)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll']
			int CloseWindow ( int hWnd );");
		}
		
		return $FFI->CloseWindow ($handle);
	}
	
	public static function GetLastActivePopup ($handle)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll']
			int GetLastActivePopup ( int hWnd );");
		}
		
		return $FFI->GetLastActivePopup ($handle);
	}
	
	public static function EnableWindow ($handle, $enable = true)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll']
			int EnableWindow ( int hWnd, bool bEnable );");
		}
		
		return $FFI->EnableWindow ($handle, $enable);
	}
	
	public static function SetWindowStayOnTop ($handle, $isChild = false)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll']
			int SetWindowPos ( int hWnd, int hWndInsertAfter, int X, int Y, int W, int H, int uFlags );");
		}

		return $FFI->SetWindowPos  ($handle, ($isChild ? -2 : -1), 0, 0, 0, 0, 0x0002 | 0x0001); 
	}
	
	public static function GetWindowCaption ($handle)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI("[lib='user32.dll']
			int SendMessageA( int hWnd, int Msg, int wParam, int lParam );
			int SendMessageA( int hWnd, int Msg, int wParam, char *lParam );
			int IsWindow(int hWnd);");
		}
		
		if ($FFI->IsWindow ($handle)) 
		{
			$length = ($FFI->SendMessageA($handle, 14, 0, 0) + 1);
			$caption = str_pad('', $length);
			$FFI->SendMessageA($handle, 13, $length, &$caption);

			return $caption;
		}
	}
	
	
	public static function SendMessageA ($handle, $message, $wParam, $lParam)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI ("[lib='user32.dll']
			int SendMessageA (int hWnd, int Msg, int wParam, char *lParam);");
		}
		
		return $FFI->SendMessageA ($handle, $message, $wParam, $lParam);
	}
	
	public static function SendMessageW ($handle, $message, $wParam, $lParam)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI ("[lib='user32.dll']
			int SendMessageW (int hWnd, int Msg, int wParam, char *lParam);");
		}
		
		return $FFI->SendMessageW ($handle, $message, $wParam, $lParam);
	}
	
	public static function FindWindowA ($caption, $class = NULL)
	{
		return $this->FindWindow ($caption, $class);
	}
	
	public static function FindWindow ($caption, $class = NULL)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI ("[lib='user32.dll']
			int FindWindowA (char *lpClassName, char *lpWindowName);");
		}
		
		return $FFI->FindWindowA ($class, $caption);
	}
	
	public static function SetKeyboardLayout ($layout)
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI ("[lib='user32.dll']
			int ActivateKeyboardLayout (int hkl, int Flags);");
		}
		
		switch ($layout)
		{
			case 'RUS':
				$id = 68748313;
			break;
			
			case 'ENG':
				$id = 67699721;
			break;
		}
		
		$FFI->ActivateKeyboardLayout ($id, 0);
	}
	
	public static function GetKeyboardLayout()
	{
		static $FFI;
		
		if (!isset ($FFI))
		{
			$FFI = new FFI ("[lib='user32.dll']
			int GetWindowThreadProcessId (int hWnd, int lpdwProcessId);
			int GetForegroundWindow ();
			int GetKeyboardLayout (int idThread);");
		}
		
		$id = $FFI->GetKeyboardLayout ($FFI->GetWindowThreadProcessId ($FFI->GetForegroundWindow (), 0));

		switch ($id)
		{
			case 68748313:
				return 'RUS';
			break;

			case 67699721:
				return 'ENG';
			break;
		}
	}
	
	/*
		SoulEngine ф-ии
	*/
	
	public static function GetSystemMetrics ($type)
	{
		return getSystemMetrics($type);
	}
	
	// handle or self
	public static function SendMessage ($handle, $message, $wParam, $lParam)
	{
		return sendMessage($handle, $message, $wParam, $lParam);
	}

	public static function SetCursorPos ($x, $y)
	{
		return setCursorPos($x, $y);
	}
}