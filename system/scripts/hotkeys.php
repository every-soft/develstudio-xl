<?



function clearEditorHotKeys()
{
    c('fmMain->itemDel')->shortCut = '';
    c('fmMain->itemCopy')->shortCut = '';
    c('fmMain->itemCut')->shortCut = '';
    c('fmMain->itemPaste')->shortCut = '';
    c('fmMain->itemSelectAll')->shortCut = '';
	
    global $_sc;
    $_sc->popupMenu    = null;
}

function setEditorHotKeys()
{
    c('fmMain->itemDel')->shortCut = 'Del';
    c('fmMain->itemCopy')->shortCut = 'Ctrl+C';
    c('fmMain->itemCut')->shortCut = 'Ctrl+X';
    c('fmMain->itemPaste')->shortCut = 'Ctrl+V';
    c('fmMain->itemSelectAll')->shortCut = 'Ctrl+A';
	
    global $fmEdit, $fmMain, $editorPopup, $_sc;
    
    if (myVars::get('__sizeAndMove'))
	{
        $fmEdit->popupMenu = null;
        $fmMain->popupMenu = null;
        $_sc->popupMenu    = null;
    } else {
        $fmEdit->popupMenu = $editorPopup;
        $fmMain->popupMenu = $editorPopup;
        $_sc->popupMenu    = $editorPopup;
    }
	
}

function initEditorHotKeys()
{
    global $fmEdit, $fmMain, $popupShow;
	
    if (!$fmEdit) 
		return;
   
    $x = cursor_pos_x();
    $y = cursor_pos_y();
    $arr['x'] = clientToScreenX($fmEdit->handle);
    $arr['y'] = clientToScreenY($fmEdit->handle);
    $arr = clientToScreen($fmEdit->handle);
	
    $inform = Geometry::pointInRegion($x, $y, array('x' => $arr['x'], 'y' => $arr['y'],
                                          'w' => $fmEdit->w, 'h' => $fmEdit->h));
    

    if (!$inform && $popupShow)
        $inform = true;
	
    if ($inform)
        setEditorHotKeys();
    else
        clearEditorHotKeys();
}

// запускаем таймер для проверки позиции курсора...
Timer::setInterval('initEditorHotKeys', 250);