<?

// GUI Functions
function gui_propSet($self, $prop, $value){}
function gui_propGet($self, $prop){}
function gui_propExists($self, $prop){}
function gui_propList($param1, $param2){}
function gui_propType($self, $prop){}


function gui_message($msg){}
function gui_safeMessage($msg){}
function gui_class($self){}
function gui_owner($self){}
function gui_parent($self){}
function gui_is($self, $class){}
function gui_create($class){}
function gui_destroy($self){}
function gui_safeDestroy($self){}

function gui_getHandle($self){}
function gui_toBack($self){}
function gui_toFront($self){}

function gui_doubleBuffer($self, $value = false){}

function gui_readStr($self, $str){}
function gui_writeStr($self){}
function gui_componentToString($self){}
function gui_stringToComponent($str){}

function gui_setFocus($self){}
function gui_isFocused($self){}

function gui_listGetFont($self, $index){}
function gui_listClearFont($self, $index){}
function gui_listGetColor($self, $index){}
function gui_listSetColor($self, $index, $color){}

function gui_formShowModal($self){}
function gui_formCreate(){}
function gui_formClose($self){}
function gui_formSetMain($self){}

function gui_theardCreate(){}

function gui_getScrollPos($self, $type){}
function gui_setScrollPos($self, $type, $value, $bool){}

// Exemod Functions
function exemod_start($file){}
function exemod_extractstr($name){}
function exemod_addstr($name, $value){}
function exemod_extractfile($name){}
function exemod_addfile($name, $file){}
function exemod_exists($name){}
function exemod_erase($name){}
function exemod_saveexe($file){}
function exemod_finish(){}
function exemod_extractstream(TMemoryStream $stream){}
function exemod_addstream($name, TMemoryStream $stream){}

// Application Functions
function application_terminate(){}
function application_minimize(){}
function application_restore(){}
function application_processMessages(){}
function application_messagebox($msg, $caption, $flags){}
function application_find_component($name){}
function application_prop($name, $value){}
function application_set_title($title){}
function application_toFront(){}
function halt(){}

// Screen Functions
function screen_form_active(){}
function screen_form_count(){}
function screen_form_by_id($id){}

// Other functions
function param_str($num){}

function enc_getValue($str){}
function enc_setValue($str, $value){}

function shortCut_to_text ($shortCut){}
function text_to_shortcut ($text){}

function _c ($self){}
function form_scrollBy(TForm $self, $x, $y){}
function form_modalResult(TForm $self, $value){}
function __rtii_link ($self, $prop){}
function __rtii_class ($self){}
function __rtii_get ($self, $prop){}
function __rtii_set ($self, $prop, $value){}
function __rtii_is_class ($self, $class){}
function __rtii_exists ($self, $prop){}
function __rtii_set_object ($self, $obj){}

// Добавляет новую функцию аналогично create_function
function runkit_function_add ($funcname ,$arglist, $code){}

// Копирует функцию с новым именем
function runkit_function_copy ($funcname, $targetname){}

// Заменяет определение функции новой реализацией.
function runkit_function_redefine ($funcname, $arglist, $code){}

// Удаляет определенную функцию
function runkit_function_remove ($funcname){}

// Переименовывает функцию
function runkit_function_rename ($funcname, $newname){}

// Конвертирует базовый класс в наследованный ("усыновляет"). Дополняет методы наследованными при необходимости.
function runkit_class_adopt ($classname, $parentname){}

// Конвертирует наследующий класс в базовый, удаляет из него наследуемые методы.
function runkit_class_emancipate ($classname){}

// Объявляет константу. Схожа с функцией define(), но позволяет создавать локальные константы внутри классов.
function runkit_constant_add ($constname, $value){}

// Переназначить уже определенную константу.
function runkit_constant_redefine ($constname , $newvalue){}

// Удаляет уже определенную константу.
function runkit_constant_remove ($constname){}


// Popup & Main functions
function popup_popup ($self, $x, $y){}
function popup_additem ($self, $item){}
function popup_item_count ($self){}
function popup_item_by_id ($self, $id){}
function popup_isShow ($self){}

function menu_parent ($self){}
function menu_indexOf ($self, $item){}
function menu_index ($self){}
function menu_find ($self, $caption){}
function menu_insert ($self, $index, $item){}
function menuitem_delete ($self, $index){}
function menuitem_clear ($self){}

function stylemenu_command ($self, $command, $args){}

// ImageList functions
function imagelist_set_images ($self, $imageList){}


// Chromium functions
function chromium_exec($self, $action, $args){}
function chromium_free($self){}
function chromium_prop($name, $value){}
function chromium_allowedcall($func){}

// Event Functions
function event_set($self, $event, $func){}
function event_add($self, $event, $func){}
function event_get($self, $event){}


function replaceSr($str){}
function replaceSl($str){}

function cursor_pos_x(){}
function cursor_pos_y(){}

// задержка (в милисекундах)
function delay($ms){}

// Отправить сообщение через Reciever.
function receiver_send($handle, $msg){}

// Получить Handle Reciever'a
function receiver_handle(){}

// Установить позицию курсора
function setcursorpos($x, $y){}

// Установить позицию Caret
function setcaretpos($x, $y){}

// Декодировать JSON
function json_decode($json, $assoc = false, $depth = 512, $options = 0){}

// Закодировать JSON
function json_encode($value, $options = 0, $depth = 512){}

// Последняя ошибка JSON
function json_last_error(){}

// играет системный звук
function message_beep($flag){}

// возвращает псевдо-случайно целое число от 0 до X
function random($x){}

// копирует текст в буфер обмена
function clipboard_setText($text){}

// возвращает текст из буфера обмена
function clipboard_getText(){}

// копирует массив файлов в буфер
function clipboard_setFiles($files){}

// возвращает массив файлов из буфера
function clipboard_getFiles(){}

// копирует картинку из текста или компонента в буфер обмена
function clipboard_assign($picture, $format = null){}

// закрывает всю программу
function halt(){}