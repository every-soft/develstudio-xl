<?

/*

	ThemeAPI class by Devel Snake for Devel Studio 3.1 (Devel Snake edition)

*/

abstract class ThemeAPI
{

	public static function API()
	{
		static $API;
	
		if(isset($API)) {
			return $API;
			
		} else {
			
			$ffi = "
			
			[lib='uxtheme.dll']
				long SetWindowTheme(
					uint32   hwnd,
					char    *pszSubAppName,
					char    *pszSubIdList
				);";
		
			return $API = new FFI($ffi);
		}
		
	}
	
	// Меняет цвет полосы прогресс бара
	public static function ProgressBar_setColor($progress, $color = clBlue)
	{
		
		if(is_object($progress) and $progress instanceof TProgressBar)
		{
			self::API()->SetWindowTheme($progress->handle, '', '');
			$progress->perform(0x0409, 0, $color);
		}
	
	}
	
	// Меняет цвет фона прогресс бара
	public static function ProgressBar_setColorBackground($progress, $color = clBlue)
	{
		if(is_object($progress) and $progress instanceof TProgressBar){
			
			self::API()->SetWindowTheme($progress->handle, '', '');
			$progress->perform(0x2001, 0, $color);
		}
	
	}

}