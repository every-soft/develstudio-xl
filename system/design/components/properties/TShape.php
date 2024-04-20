<?

$result = array();

$result[] = array(
                  'CAPTION'=>t('Color'),
                  'TYPE'=>'color',
                  'PROP'=>'brushColor',
                  );

$result[] = array(
                  'CAPTION'=>t('Brush Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'brushStyle',
                  'VALUES'=>array('bsSolid', 'bsClear', 'bsHorizontal', 'bsVertical','bsFDiagonal', 'bsBDiagonal', 'bsCross', 'bsDiagCross')
                  );
$result[] = array(
                  'CAPTION'=>t('Pen Color'),
                  'TYPE'=>'color',
                  'PROP'=>'penColor',
                  );
$result[] = array(
                  'CAPTION'=>t('Pen Mode'),
                  'TYPE'=>'combo',
                  'PROP'=>'penMode',
                  'VALUES'=>array('pmBlack', 'pmWhite', 'pmNop', 'pmNot', 'pmCopy', 'pmNotCopy',
                                    'pmMergePenNot', 'pmMaskPenNot', 'pmMergeNotPen', 'pmMaskNotPen', 'pmMerge',
                                    'pmNotMerge', 'pmMask', 'pmNotMask', 'pmXor', 'pmNotXor')
                  );
$result[] = array(
                  'CAPTION'=>t('Pen Style'),
                  'TYPE'=>'combo',
                  'PROP'=>'penStyle',
                  'VALUES'=>array('psSolid', 'psDash', 'psDot', 'psDashDot', 'psDashDotDot', 'psClear', 'psInsideFrame'),
                  );
$result[] = array(
                  'CAPTION'=>t('Pen Width'),
                  'TYPE'=>'number',
                  'PROP'=>'penWidth',
                  );
$result[] = array(
                  'CAPTION'=>t('Shape'),
                  'TYPE'=>'combo',
                  'PROP'=>'shape',
                  'VALUES'=>array('stRectangle', 'stSquare', 'stRoundRect', 'stRoundSquare', 'stEllipse', 'stCircle'),
                  );
addDefProp ('Hint', &$result);

addDefProp('DefaultVisual', &$result);

return $result;