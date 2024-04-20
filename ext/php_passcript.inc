<?

// создать движок
function psc_newpsc(){}

// зарегистрировать VCL-библиотеку в Delphi. 
// Forms, Classes, Controls, DB, DateUtils, ComObj, StdCtrls
function psc_newpsccomponent(string $vclname){}

// установить скрипт
function psc_setscript(string $script){}

// компилировать скрипт
function psc_compilescript(){}

// запустить скрипт
function psc_runscript(){}

// получить последнюю ошибку выполнения скрипта.
function psc_getscripterror(){}

// дизассемблировать скрипт (РАБОТАЕТ ТОЛЬКО ПОСЛЕ КОМПИЛЯЦИИ СКРИПТА)
function psc_disasm(){}

// записать байт-код в файл (РАБОТАЕТ ТОЛЬКО ПОСЛЕ КОМПИЛЯЦИИ СКРИПТА)
function psc_getcompiled(string $filename){}

// установить байт-код (НЕ ЗАПУСТИТЬ! КОМПИЛИРОВАТЬ НЕ НАДО! БАЙТ-КОД УЖЕ БУДЕТ СКОМПИЛИРОВАННЫМ)
function psc_setcompiled(string $filename){}

// включить php-мост (Функция выполнения пхп в паскале: PhpEval(string code) : string);)
function psc_phpbridgeon(){}

// выключить пхп-мост с паскалём
function psc_phpbridgeoff(){}

// вернуть в паскаль какое-либо значение (Только в виде строки). Работает только во время выполнения через PhpEval в паскале.
function psc_phpbridgeretval(mixed $value){}

// инфо о создателе
function psc_about(){}