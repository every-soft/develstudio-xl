<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Highlighter'),
                  'TYPE'=>'',
                  'PROP'=>'highlighter',
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Text'),
                  'TYPE'=>'text',
                  'PROP'=>'text',
                  );	
				  
$result[] = array(
				'CAPTION'=>t('Gutter'),
				'PROP'=>'gutter',
				'CLASS'=>'TSynGutter',
				);			
				
$result[] = array(
                  'CAPTION'=>t('Show Line Numbers'),
                  'TYPE'=>'check',
                  'PROP'=>'showLineNumbers',
				  'REAL_PROP'=>'gutter->showLineNumbers'
                  );
				  
$result[] = array(
                  'CAPTION'=>t('Use Font Style'),
                  'TYPE'=>'check',
				  'PROP'=>'gutter->useFontStyle',
				  'IS_GUTTER'=>true,
                  );	
				  
$result[] = array(
	  'CAPTION' => t('font'),
	  'TYPE' => 'font',
	  'PROP' => 'gutter->font',
	  'CLASS' => 'TFont',
	  'IS_GUTTER'=>true,
	);

$result[] = array('CAPTION' => t('Font color'), 'TYPE'=>'color', 'PROP' => 'gutter->font->color', 'IS_GUTTER'=>true);
$result[] = array('CAPTION' => t('Font size'), 'TYPE' => 'number', 'PROP' => 'gutter->font->size', 'IS_GUTTER'=>true);
$result[] = array('CAPTION' => t('Font height'), 'TYPE' => 'number', 'PROP' => 'gutter->font->height', 'IS_GUTTER'=>true);
$result[] = array('CAPTION' => t('Font pitch'), 'TYPE' => 'combo', 'PROP' => 'gutter->font->pitch', 'VALUES'=>array('fpDefault','fpVariable', 'fpFixed'), 'IS_GUTTER'=>true);
$result[] = array('CAPTION' => t('Font orientation'), 'TYPE' => 'number', 'PROP' => 'gutter->font->orientation', 'IS_GUTTER'=>true);


$result[] = array('CAPTION' => t('Font style'), 'PROP' => 'gutter->font->style');
$result[] = array('CAPTION' => t('Font name'), 'PROP' => 'gutter->font->name');
$result[] = array('CAPTION' => t('Font charset'), 'PROP' => 'gutter->font->charset');

$result[] = array(
                  'CAPTION'=>t('Auto Size'),
                  'TYPE'=>'check',
				  'PROP'=>'gutter->autoSize',
				  'IS_GUTTER'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Border Color'),
                  'TYPE'=>'color',
				  'PROP'=>'gutter->borderColor',
				  'IS_GUTTER'=>true,
                  );	
$result[] = array(
                  'CAPTION'=>t('Zero Start'),
                  'TYPE'=>'check',
				  'PROP'=>'gutter->zeroStart',
				  'IS_GUTTER'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Gradient'),
                  'TYPE'=>'check',
				  'PROP'=>'gutter->gradient',
				  'IS_GUTTER'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Gradient Start Color'),
                  'TYPE'=>'color',
				  'PROP'=>'gutter->gradientStartColor',
				  'IS_GUTTER'=>true,
                  );	
$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
				  'PROP'=>'gutter->color',
				  'IS_GUTTER'=>true,
                  );	
$result[] = array(
                  'CAPTION'=>t('Gradient End Color'),
                  'TYPE'=>'color',
				  'PROP'=>'gutter->gradientEndColor',
				  'IS_GUTTER'=>true,
                  );	
$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
				  'PROP'=>'gutter->borderStyle',
				  'VALUES'=>array('gbsMiddle', 'gbsNone', 'gbsRight'),
				  'IS_GUTTER'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Right Offset'),
                  'TYPE'=>'number',
				  'PROP'=>'gutter->rightOffset',
				  'IS_GUTTER'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Left Offset'),
                  'TYPE'=>'number',
				  'PROP'=>'gutter->leftOffset',
				  'IS_GUTTER'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Digit Count'),
                  'TYPE'=>'number',
				  'PROP'=>'gutter->digitCount',
				  'IS_GUTTER'=>true,
                  );
$result[] = array(
                  'CAPTION'=>t('Width'),
                  'TYPE'=>'number',
				  'PROP'=>'gutter->width',
				  'IS_GUTTER'=>true,
                  );
$result[] = array(
				  'CAPTION' => t('Cursor'),
				  'TYPE' => 'combo',
				  'PROP' => 'gutter->cursor',
				  'VALUES' => $GLOBALS['cursors_meta'],
				  'IS_GUTTER'=>true,
				  );
				  
addDefProp('Default', &$result);

addDefProp('Items', &$result);

$result[] = array('CAPTION'=>t('CaretY'), 'PROP'=>'CaretY');
$result[] = array('CAPTION'=>t('CaretX'), 'PROP'=>'CaretX');
$result[] = array('CAPTION'=>t('LastCaretX'), 'PROP'=>'lastCaretX');

$result[] = array('CAPTION'=>t('Line Text'), 'PROP'=>'lineText');


$result[] = array('CAPTION'=>t('IsScrolling').'?', 'PROP'=>'isScrolling');
	
$result[] = array('CAPTION'=>t('Chars In Window'),'TYPE'=>'','PROP'=>'charsInWindow');	
$result[] = array('CAPTION'=>t('Popup Menu'), 'PROP'=>'popupMenu');


$result[] = array(
                  'CAPTION'=>t('Insert Caret'),
                  'TYPE'=>'combo',
                  'PROP'=>'insertCaret',
                  'VALUES'=>array('ctVerticalLine', 'ctHorizontalLine', 'ctHalfBlock', 'ctBlock'),
                  );	
$result[] = array(
                  'CAPTION'=>t('Selection Mode'),
                  'TYPE'=>'combo',
                  'PROP'=>'selectionMode',
                  'VALUES'=>array('smNormal', 'smColumn'),
                  );					  
$result[] = array(
                  'CAPTION'=>t('Active Line Color'),
                  'TYPE'=>'color',
                  'PROP'=>'activeLineColor',
		);
		  
$result[] = array(
                  'CAPTION'=>t('Always Show Caret'),
                  'TYPE'=>'check',
                  'PROP'=>'alwaysShowCaret',
                  );				  

addDefProp ('Font', &$result);

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'color',
                  );
$result[] = array(
                  'CAPTION'=>t('Right Edge Color'),
                  'TYPE'=>'color',
                  'PROP'=>'rightEdgeColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Right Edge'),
                  'TYPE'=>'number',
                  'PROP'=>'rightEdge',
                  );
$result[] = array(
                  'CAPTION'=>t('Top Line'),
                  'TYPE'=>'number',
                  'PROP'=>'topLine',
                  );

$result[] = array(
                  'CAPTION'=>t('Scroll Hint Format'),
                  'TYPE'=>'combo',
				  'VALUES'=>array('shfTopToBottom','shfTopLineOnly'),
                  'PROP'=>'scrollHintFormat',
                  );					  
$result[] = array(
                  'CAPTION'=>t('Scroll Hint Color'),
                  'TYPE'=>'color',
                  'PROP'=>'scrollHintColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Max Scroll Width'),
                  'TYPE'=>'number',
                  'PROP'=>'maxScrollWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Selected Color Background'),
                  'TYPE'=>'color',
                  'PROP'=>'selectedColor->background',
                  );
$result[] = array(
                  'CAPTION'=>t('Selected Color Foreground'),
                  'TYPE'=>'color',
                  'PROP'=>'selectedColor->foreground',
                  );

$result[] = array(
                  'CAPTION'=>t('Ctl3D'),
                  'TYPE'=>'check',
                  'PROP'=>'ctl3D',
                  );
$result[] = array(
                  'CAPTION'=>t('Want Returns'),
                  'TYPE'=>'check',
                  'PROP'=>'wantReturns',
                  );
$result[] = array(
                  'CAPTION'=>t('Want Tabs'),
                  'TYPE'=>'check',
                  'PROP'=>'wantTabs',
                  );

$result[] = array(
                  'CAPTION'=>t('Word Wrap'),
                  'TYPE'=>'check',
                  'PROP'=>'wordWrap',
                  );
$result[] = array(
                  'CAPTION'=>t('Read Only'),
                  'TYPE'=>'check',
                  'PROP'=>'readOnly',
                  );

$result[] = array(
                  'CAPTION'=>t('Scroll Bars'),
                  'TYPE'=>'combo',
                  'PROP'=>'scrollBars',
                  'VALUES'=>array('ssNone', 'ssHorizontal', 'ssVertical', 'ssBoth'),
                  );
$result[] = array(
                  'CAPTION'=>t('Border Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'borderStyle',
                  'VALUES'=>array('bsNone', 'bsSingle'),
                  );
$result[] = array(
                  'CAPTION'=>t('Max Length'),
                  'TYPE'=>'number',
                  'PROP'=>'maxLength',
                  );
$result[] = array(
	  'CAPTION'=>t('Tab Width'),
	  'TYPE'=>'number',
	  'PROP'=>'tabWidth',
	  );
$result[] = array(
                  'CAPTION'=>t('Max Undo'),
                  'TYPE'=>'number',
                  'PROP'=>'maxUndo',
                  );
$result[] = array(
                  'CAPTION'=>t('ExtraLineSpacing'),
                  'TYPE'=>'number',
                  'PROP'=>'extraLineSpacing',
                  );
addDefProp ('Hint', &$result);
$result[] = array(
                  'CAPTION'=>t('Tab Order'),
                  'TYPE'=>'number',
                  'PROP'=>'tabOrder',
                  );
$result[] = array(
                  'CAPTION'=>t('Tab Stop'),
                  'TYPE'=>'check',
                  'PROP'=>'tabStop',
                  );			  
//////////////////////////////////////////////////////////////////////
				  
$result[] = array(
                  'CAPTION'=>t('Options'),
                  'TYPE'=>'list',
                  'PROP'=>'options',
				  'VALUES'=>array(
					'eoAltSetsColumnMode',
					'eoAutoIndent',
					'eoAutoSizeMaxScrollWidth',
					'eoDisableScrollArrows',
					'eoDragDropEditing',
					'eoDropFiles',
					'eoEnhanceHomeKey',
					'eoEnhanceEndKey',
					'eoGroupUndo',
					'eoHalfPageScroll',
					'eoHideShowScrollbars',
					'eoKeepCaretX',
					'eoNoCaret',
					'eoNoSelection',
					'eoRightMouseMovesCursor',
					'eoScrollByOneLess',
					'eoScrollHintFollows',
					'eoScrollPastEof',
					'eoScrollPastEol',
					'eoShowScrollHint',
					'eoShowSpecialChars',
					'eoSmartTabDelete',
					'eoSmartTabs',
					'eoSpecialLineDefaultFg',
					'eoTabIndent',
					'eoTabsToSpaces',
					'eoTrimTrailingSpaces'
					),
                  );

$result[] = array('CAPTION'=>t('selStart'), 'PROP'=>'selStart');
$result[] = array('CAPTION'=>t('selEnd'), 'PROP'=>'selEnd');
$result[] = array('CAPTION'=>t('selLength'), 'PROP'=>'selLength');
$result[] = array('CAPTION'=>t('selText'), 'PROP'=>'selText');
addDefProp('DefaultVisual', &$result);

return $result;