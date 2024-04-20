<?

/*
 
    PHP Soul Engine Error Hooker

	2018.09 ver 0.3
    
    Main function:
        __error_hook(type, filename, line, msg)
        
    // перехватчик ошибок...
    
*/


function errors_init ()
{
    $GLOBALS['__show_errors'] = true;
    $old_error_handler = set_error_handler("userErrorHandler");
    set_fatal_handler("userFatalHandler");
}

// определяемая пользователем функция обработки ошибок
function userErrorHandler ($errno = false, $errmsg = '', $filename = '', $linenum = 0, $vars = false, $eventInfo = false)
{

	// фикс глушителя.
	if (0 === error_reporting()) { 
		return false;
	}
	
    if ($errno == E_NOTICE || $errno == E_DEPRECATED) return;
    if ($errno == 2048) return; 

    if ( $eventInfo ){    
        $GLOBALS['__eventInfo'] = $eventInfo;
    }

    if (defined('ERROR_NO_WARNING') && ERROR_NO_WARNING)
	{
        if ($errno == E_WARNING || $errno == E_CORE_WARNING || $errno == E_USER_WARNING) return;
    }
    
    if (defined('ERROR_NO_ERROR') && ERROR_NO_ERROR)
	{
        if ($errno == E_ERROR || $errno == E_CORE_ERROR || $errno == E_USER_ERROR) return;    
    }
    
    if ($errno == E_USER_ERROR && !$eventInfo)
	{
        
        $info = debug_backtrace();
        next($info);
        $info = next($info);
        $linenum = $info['line'];
    }
     
    // for threading...
	if (isset($GLOBALS['THREAD_SELF']))
    if ($GLOBALS['__show_errors'] && $GLOBALS['THREAD_SELF'])
	{
        
        if (sync('userErrorHandler', array($errno, $errmsg, $filename, $linenum, false, $GLOBALS['__eventInfo'])))
            return;
    }

    $GLOBALS['__error_last'] = array(
                                     'msg'=>$errmsg,
                                     'file'=>$filename,
                                     'line'=>$linenum,
                                     'type'=>$errno,
                                     );

    if (!$GLOBALS['__show_errors']) return;

    global $__eventInfo;
	
	static $errortype;

	if (!isset($errortype))
	{
		$errortype = array
		(
                0                 => "Fatal Error",
                E_ERROR           => "Error",
                E_WARNING         => "Warning",
                E_PARSE           => "Parsing Error",
                E_NOTICE          => "Notice",
                E_CORE_ERROR      => "Core Error",
                E_CORE_WARNING    => "Core Warning",
                E_COMPILE_ERROR   => "Compile Error",
                E_COMPILE_WARNING => "Compile Warning",
                E_USER_ERROR      => "User Error",
                E_USER_WARNING    => "User Warning",
                E_USER_NOTICE     => "User Notice",
                E_STRICT          => "Runtime Notice",
				E_DEPRECATED      => "Deprecated"
		);
	}

    $type = $errortype[$errno];

    if (defined('DEBUG_OWNER_WINDOW')){
                
        $result['type'] = 'error';
        $result['script'] = $filename;
        $result['event']  = $__eventInfo['name'];
        $result['name'] =  __exEvents::getEventInfo($__eventInfo['self']);
        $result['msg']  = $errmsg;
        $result['errno']= $errno;
        $result['errtype'] = $type;
        $result['line'] = $linenum;
        
        if ( is_array($vars) )
            $result['vars'] = array_keys($vars);
        
        application_minimize();
        
        Receiver::send(DEBUG_OWNER_WINDOW, $result);
        
        application_restore();
        $GLOBALS['APPLICATION']->toFront();
        return;
    }

    $arr[]= '['.$type.']';
    $arr[]= t('Message').': "' . $errmsg . '"';
    
    if (file_exists($filename)){
        $arr[]= ' ';
        
        if (defined('EXE_NAME'))
            $filename = str_replace(replaceSr(dirname(replaceSl(EXE_NAME))),'',$filename);
        
        $arr[] = $filename;
        $arr[] = t('On Line').': ' . $linenum;
    }

    if ($__eventInfo){
        
        $arr[] = ' ';
        $arr[] = '['.t('EVENT').']';
        if ($__eventInfo['name'])
            $arr[] = t('Type').': '.$__eventInfo['name'];
            
        if ($__eventInfo['obj_name'])
            $arr[] = t('Object').': "' .$__eventInfo['obj_name'].'"';
    }
    
    $arr[] = ' ';
    $arr[] = '.:: '.t('To abort application?').' ::.';

    $dfm = "object TForm
  Left = 10
  Top = 10
  HelpType = htKeyword
  HelpKeyword =
    'AAAAAhQCEQVDTEFTUxEFVEZvcm0RBlBBUkFNUxQFEQhhdmlzaWJsZQURAXgGChEB' +
    'eQYKEQF3CAHIEQFoCAFA'
  BorderIcons = []
  BorderStyle = bsDialog
  ClientHeight = 320
  ClientWidth = 456
  Color = clWhite
  Font.Charset = RUSSIAN_CHARSET
  Font.Color = clWindowText
  Font.Height = -13
  Font.Name = 'Segoe UI'
  Font.Style = []
  OldCreateOrder = False
  Position = poScreenCenter
  Visible = False
  DesignSize = (
    456
    320)
  PixelsPerInch = 96
  TextHeight = 17
  object TMImage
    Left = 16
    Top = 24
    Width = 48
    Height = 48
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEHVE1JbWFnZREGUEFSQU1TFAgRCGF2aXNpYmxlBREIYWVu' +
      'YWJsZWQFEQF3DEBiAAAAAAAAEQFoDEBaAAAAAAAAEQZwYXJlbnQXBVRGb3JtFAYR' +
      'CmNsYXNzX25hbWUOCBEPACoAX2NvbnN0cmFpbnRzFxBUU2l6ZUNvbnN0cmFpbnRz' +
      'FAMOCQ4LEQRzZWxmCgZTLVgRCAAqAHByb3BzFAARBwAqAGljb24AEQgAKgBfZm9u' +
      'dAAODAoCQXfADg0UAg4DBREKcG9zaXRpb25leBEKcG9EZXNpZ25lZBEEdGV4dBEM' +
      'yOfu4fDg5uXt6OUxEQF4BhARAXkGGA=='
    Center = True
    Picture.Data = {
      0A54504E474F626A65637489504E470D0A1A0A0000000D494844520000003000
      00003008060000005702F987000001C94944415478DAEDD9314EC330180560BB
      022A28390308CE90AE2D8D18D8E004650326907A008A18112026D8E0063003AD
      D2353081442724EE401822684C1CD42885106C27F6DF08BFA5529546EF4B5DDB
      49312A783074010D802EA001D005A403DEACEA2A41643B38B4AEB61AB131C227
      958E73250C701BE639C2785D6DF16F0C82F68CAED3E6067C5D797409593E4260
      7FC9B8BDB7B900AF0DD3C618D7A0CB8700427A46F7AECE0570AD2A812E1ECF6C
      C749ECAA011A000D286FB5C2B9CE3B3BE22A34515B0E5F3F7A3770005A3E2A62
      5F3323E867427810EFF49009913B60AAB9812657D646DE6341C4CB0FC382C81D
      509A5B40D3BB0708CD54981149E5C100BC882CE5A501581159CB4B05FC8518F4
      1F3397970E48432485B7BC12002B42A4BC324084D83F0EE6D9726EE59502C21F
      EC662BF1CC3C8B1D086064B6212857847440E25449CFF0EEFD184E2208A980B4
      79DE7F79E65EB19502581629916D871200CF0A9B15913B40647B9005913B207E
      2FC0523E0D01B61B8D237816A938027C374A1183A707EE1596224AF38BE3B11B
      55110D80CEFF0314FEE16EE11FAFD3B89679111CD2042D2FFA07C730F49BF009
      D9513D9CE8B04125D2FEEDCA3303C63D1A001D0D804EE1019F32787D402712D3
      450000000049454E44AE426082}
  end
  object TLabel
    Left = 72
    Top = 24
    Width = 109
    Height = 29
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEGVExhYmVsEQZQQVJBTVMUCREIYXZpc2libGUFEQhhZW5h' +
      'YmxlZAURAXcMQFQAAAAAAAARAWgMQDgAAAAAAAARBnBhcmVudBcFVEZvcm0UBhEK' +
      'Y2xhc3NfbmFtZQ4IEQ8AKgBfY29uc3RyYWludHMXEFRTaXplQ29uc3RyYWludHMU' +
      'Aw4JDgsRBHNlbGYKBlMtWBEIACoAcHJvcHMUABEHACoAaWNvbgARCAAqAF9mb250' +
      'AA4MCgJBd8AODRQCDgMFEQpwb3NpdGlvbmV4EQpwb0Rlc2lnbmVkEQR0ZXh0EQbS' +
      '5erx8jERCWZvbnRjb2xvcgoANjY2EQF4BkgRAXkGGA=='
    AutoSize = False
    Caption = #1054#1096#1080#1073#1082#1072
    Font.Charset = RUSSIAN_CHARSET
    Font.Color = 3552822
    Font.Height = -24
    Font.Name = 'Segoe UI'
    Font.Style = []
    ParentFont = False
    Layout = tlCenter
  end
  object TLabel
    Left = 72
    Top = 48
    Width = 341
    Height = 21
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEGVExhYmVsEQZQQVJBTVMUCREIYXZpc2libGUFEQhhZW5h' +
      'YmxlZAURAXcMQFQAAAAAAAARAWgMQDgAAAAAAAARBnBhcmVudBcFVEZvcm0UBhEK' +
      'Y2xhc3NfbmFtZQ4IEQ8AKgBfY29uc3RyYWludHMXEFRTaXplQ29uc3RyYWludHMU' +
      'Aw4JDgsRBHNlbGYKBlMtWBEIACoAcHJvcHMUABEHACoAaWNvbgARCAAqAF9mb250' +
      'AA4MCgJBd8AODRQCDgMFEQpwb3NpdGlvbmV4EQpwb0Rlc2lnbmVkEQR0ZXh0EQbS' +
      '5erx8jERCWZvbnRjb2xvcgoAqqqqEQF4BkgRAXkGMA=='
    AutoSize = False
    Caption = #1042' '#1087#1088#1086#1075#1088#1072#1084#1084#1077' '#1087#1088#1086#1080#1079#1086#1096#1083#1072' '#1082#1088#1080#1090#1080#1095#1077#1089#1082#1072#1103' '#1086#1096#1080#1073#1082#1072
    Font.Charset = RUSSIAN_CHARSET
    Font.Color = 11184810
    Font.Height = -13
    Font.Name = 'Segoe UI'
    Font.Style = []
    ParentFont = False
    Layout = tlCenter
  end
  object TButton
    Left = 320
    Top = 256
    Width = 112
    Height = 40
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEHVEJ1dHRvbhEGUEFSQU1TFAgRCGF2aXNpYmxlBREIYWVu' +
      'YWJsZWQFEQF3DEBiAAAAAAAAEQFoDEBAAAAAAAAAEQZwYXJlbnQXBVRGb3JtFAYR' +
      'CmNsYXNzX25hbWUOCBEPACoAX2NvbnN0cmFpbnRzFxBUU2l6ZUNvbnN0cmFpbnRz' +
      'FAMOCQ4LEQRzZWxmCgZTLVgRCAAqAHByb3BzFAARBwAqAGljb24AEQgAKgBfZm9u' +
      'dBcFVEZvbnQUAw4MCgJBd8AODRQAEQ0AKgBjbGFzc19uYW1lEQdfT2JqZWN0DgwK' +
      'AkF3wA4NFAIOAwURCnBvc2l0aW9uZXgRCnBvRGVzaWduZWQRBHRleHQRB8rt7u/q' +
      '4DERAXgIATARAXkG0A=='
    Anchors = [akRight, akBottom]
    Caption = #1042#1099#1093#1086#1076
    Font.Charset = RUSSIAN_CHARSET
    Font.Color = clWindowText
    Font.Height = -13
    Font.Name = 'Segoe UI Semibold'
    Font.Style = [fsBold]
    ModalResult = 1
    ParentFont = False
    TabOrder = 0
    ExplicitLeft = 304
    ExplicitTop = 208
  end
  object TButton
    Left = 228
    Top = 256
    Width = 88
    Height = 40
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEHVEJ1dHRvbhEGUEFSQU1TFAgRCGF2aXNpYmxlBREIYWVu' +
      'YWJsZWQFEQF3DEBiAAAAAAAAEQFoDEBAAAAAAAAAEQZwYXJlbnQXBVRGb3JtFAYR' +
      'CmNsYXNzX25hbWUOCBEPACoAX2NvbnN0cmFpbnRzFxBUU2l6ZUNvbnN0cmFpbnRz' +
      'FAMOCQ4LEQRzZWxmCgZTLVgRCAAqAHByb3BzFAARBwAqAGljb24AEQgAKgBfZm9u' +
      'dBcFVEZvbnQUAw4MCgJBd8AODRQAEQ0AKgBjbGFzc19uYW1lEQdfT2JqZWN0DgwK' +
      'AkF3wA4NFAIOAwURCnBvc2l0aW9uZXgRCnBvRGVzaWduZWQRBHRleHQRB8rt7u/q' +
      '4DERAXgG2BEBeQbQ'
    Anchors = [akRight, akBottom]
    Caption = #1054#1090#1084#1077#1085#1072
    Font.Charset = RUSSIAN_CHARSET
    Font.Color = clWindowText
    Font.Height = -13
    Font.Name = 'Segoe UI'
    Font.Style = []
    ModalResult = 2
    ParentFont = False
    TabOrder = 1
    ExplicitLeft = 216
    ExplicitTop = 208
  end
  object TMemo
    Left = 24
    Top = 80
    Width = 408
    Height = 168
    HelpType = htKeyword
    HelpKeyword =
      'AAAAAhQCEQVDTEFTUxEFVE1lbW8RBlBBUkFNUxQJEQhhdmlzaWJsZQURCGFlbmFi' +
      'bGVkBREBdwxAYgAAAAAAABEBaAxAWgAAAAAAABEGcGFyZW50FwVURm9ybRQGEQpj' +
      'bGFzc19uYW1lDggRDwAqAF9jb25zdHJhaW50cxcQVFNpemVDb25zdHJhaW50cxQD' +
      'DgkOCxEEc2VsZgoGUy1YEQgAKgBwcm9wcxQAEQcAKgBpY29uABEIACoAX2ZvbnQX' +
      'BVRGb250FAMODAoCQXfADg0UABENACoAY2xhc3NfbmFtZREHX09iamVjdA4MCgJB' +
      'd8AODRQCDgMFEQpwb3NpdGlvbmV4EQpwb0Rlc2lnbmVkEQR0ZXh0ER/I7fTu8Ozg' +
      '9uj/IO7hIO746OHq5SDt5ejn4uXx8u3gEQlmb250Y29sb3IKAHp6ehEBeAYYEQF5' +
      'BlA='
    Alignment = taLeftJustify
    Anchors = [akLeft, akTop, akRight, akBottom]
    BorderStyle = bsNone
    Font.Charset = RUSSIAN_CHARSET
    Font.Color = 8026746
    Font.Height = -13
    Font.Name = 'Segoe UI'
    Font.Style = []
    Lines.Strings = (
      #1048#1085#1092#1086#1088#1084#1072#1094#1080#1103' '#1086#1073' '#1086#1096#1080#1073#1082#1077' '#1085#1077#1080#1079#1074#1077#1089#1090#1085#1072)
    ParentFont = False
    ReadOnly = True
    ScrollBars = ssVertical
    TabOrder = 2
    TabOnEnter = False
    ExplicitWidth = 392
    ExplicitHeight = 120
  end
end
";

	$form = gui_create ('TForm', null);
	gui_readStr ($form, $dfm);
	
	$form = _c($form);

	$components = $form->componentList;
	
	$memo = $components[count($components) - 1];
	$memo->items->setArray ($arr);
	
    message_beep(MB_ICONERROR);

    $old_error_handler = set_error_handler('userErrorHandler');
    switch ($form->showModal())
	{
        case mrCancel: return true;
        case mrOk: application_terminate(); return false; break;
	}
	
    return;
}

function userFatalHandler ($errno = false, $errmsg = '', $filename = '', $linenum = 0)
{
    
    userErrorHandler($errno, $errmsg, $filename, $linenum);
}

function error_message ($msg)
{
    MessageBox($msg, appTitle() . ': Error', MB_ICONERROR);
    die();
}

function error_msg ($msg)
{
    MessageBox($msg, appTitle() . ': Error', MB_ICONERROR);
}

function __error_hook ($type, $filename, $line, $msg)
{
    error_message("'$msg' in '$filename' on line $line");
}

function checkFile ($filename)
{
    $filename = str_replace('//', '/', replaceSl($filename));
    
    if (!file_exists(DOC_ROOT . $filename) && !file_exists($filename)){
        error_message($filename . 'is not exists!');
        die();
    }
}

function err_no()
{
    $GLOBALS['__show_errors'] = false;
    $GLOBALS['__error_last']  = false;
}

function err_status($value = null){
    
	if (isset($GLOBALS['ERROR_STATUS']) && defined('IS_APPLICATION_START'))
		$value = $GLOBALS['ERROR_STATUS'];
	
    $GLOBALS['__error_last']  = false;
    if ($value===null)
        return $GLOBALS['__show_errors'];
    else{
        $res = $GLOBALS['__show_errors'];
        $GLOBALS['__show_errors'] = $value;
        return $res;
    }
}

function err_yes()
{
    $GLOBALS['__show_errors'] = true;
    $GLOBALS['__error_last']  = false;
}

function err_msg()
{
    return $GLOBALS['__error_last']['msg'];
}

function err_last()
{
    return $GLOBALS['__error_last'];
}

errors_init();

/* fix errors */
err_no();
    date_default_timezone_set('Europe/Moscow');
    ini_set('date.timezone', 'Europe/Moscow');
err_yes();