<?

function addDefProp ($prop, &$result, $ignoreList = array())
{
	switch ($prop)
	{
		case 'Items':
			$result[] = array(
				'CAPTION' => t('items'),
				'PROP' => 'items',
				'CLASS' => 'TStrings',
			);
	
			$result[] = array(
				'CAPTION' => t('items'),
				'PROP' => 'lines',
			);
			
			$result[] = array('CAPTION' => t('Items count'), 'PROP' => 'items->count');
			$result[] = array('CAPTION' => t('Items lines'), 'PROP' => 'items->lines');
			$result[] = array('CAPTION' => t('Items selected'), 'PROP' => 'items->selected');
			$result[] = array('CAPTION' => t('List'), 'PROP' => 'items->text');
			$result[] = array('CAPTION' => t('Item Index'), 'PROP' => 'items->itemIndex');
			$result[] = array('CAPTION' => t('Items strings'), 'PROP' => 'items->strings');
			
		break;

		case 'Font':
			$result[] = array(
				  'CAPTION' => t('font'),
				  'TYPE' => 'font',
				  'PROP' => 'font',
				  'CLASS' => 'TFont',
				);
				
			if (!in_array('ParentFont', $ignoreList))
				$result[] = array(
					  'CAPTION' => t('Parent Font'),
					  'TYPE' => 'check',
					  'PROP' => 'parentFont',
					);
					
			if (!in_array('FontColor', $ignoreList))
				$result[] = array('CAPTION' => t('Font color'), 'TYPE'=>'color', 'PROP' => 'font->color');
			
			$result[] = array('CAPTION' => t('Font size'), 'TYPE' => 'number', 'PROP' => 'font->size');
			$result[] = array('CAPTION' => t('Font height'), 'TYPE' => 'number', 'PROP' => 'font->height');
			$result[] = array('CAPTION' => t('Font pitch'), 'TYPE' => 'combo', 'PROP' => 'font->pitch', 'VALUES'=>array('fpDefault','fpVariable', 'fpFixed'));
			$result[] = array('CAPTION' => t('Font orientation'), 'TYPE' => 'number', 'PROP' => 'font->orientation');

			$result[] = array('CAPTION' => t('Font style'), 'PROP' => 'font->style');
			$result[] = array('CAPTION' => t('Font name'), 'PROP' => 'font->name');
			$result[] = array('CAPTION' => t('Font charset'), 'PROP' => 'font->charset');
			
		break;
			
		case 'Default':
			$result[] = array('CAPTION' => t('Handle'), 'PROP' => 'handle');
			$result[] = array('CAPTION' => t('Self'), 'PROP' => 'self');
			$result[] = array('CAPTION' => t('Owner'), 'PROP' => 'owner');
			$result[] = array('CAPTION' => t('Parent'), 'PROP' => 'parent');
			$result[] = array('CAPTION' => t('Class Name'), 'PROP' => 'className');
			$result[] = array('CAPTION' => t('Class Name Ex'), 'PROP' => 'class_name_ex');
			// $result[] = array('CAPTION' => t('Tag'), 'PROP' => 'tag');
		break;
		case 'DefaultVisual':
			$result[] = array(
					  'CAPTION' => t('Align'),
					  'TYPE' => 'combo',
					  'PROP' => 'align',
					  'VALUES' => array('alNone', 'alTop', 'alBottom', 'alLeft', 'alRight', 'alClient', 'alCustom'),
					   'ADD_GROUP' => true
					);
			$result[] = array(
								  'CAPTION'=>t('Align With Margins'),
								  'TYPE'=>'check',
								  'PROP'=>'alignWithMargins',
								  'ADD_GROUP'=>true,
								  );
			$result[] = array(
							  'CAPTION' => t('Cursor'),
							  'TYPE' => 'combo',
							  'PROP' => 'cursor',
							  'VALUES' => $GLOBALS['cursors_meta'],
							  'ADD_GROUP' => true,
							  );

			$result[] = array(
							  'CAPTION' => t('Sizes and position'),
							  'TYPE' => 'sizes',
							  'PROP' => 'anchors',
							  'ADD_GROUP' => true,
							  );
							  
			if (!in_array('Enabled', $ignoreList))
				$result[] = array(
								  'CAPTION'=>t('Enabled'),
								  'TYPE'=>'check',
								  'PROP'=>'aenabled',
								  'REAL_PROP'=>'enabled',
								  'ADD_GROUP'=>true,
								  );
								  
			if (!in_array('Visible', $ignoreList))
				$result[] = array(
							  'CAPTION'=>t('visible'),
							  'TYPE'=>'check',
							  'PROP'=>'avisible',
							  'REAL_PROP'=>'visible',
							  'ADD_GROUP'=>true,
							);
							
			$result[] = array('CAPTION' => t('p_Left'), 'PROP' => 'x','TYPE' => 'number', 'ADD_GROUP' => true, 'UPDATE_DSGN' => true);
			$result[] = array('CAPTION' => t('p_Top'), 'PROP' => 'y','TYPE' => 'number', 'ADD_GROUP' => true, 'UPDATE_DSGN' => true);
			$result[] = array('CAPTION' => t('Width'), 'PROP' => 'w','TYPE' => 'number', 'ADD_GROUP' => true, 'UPDATE_DSGN' => true);
			$result[] = array('CAPTION' => t('Height'), 'PROP' => 'h','TYPE' => 'number', 'ADD_GROUP' => true, 'UPDATE_DSGN' => true);
			
		break;

		case 'Control':
			$result[] = array('CAPTION'=>t('Active Control'), 'PROP'=>'activeControl');
			$result[] = array('CAPTION'=>t('Control Index'),'PROP'=>'controlIndex');
			$result[] = array('CAPTION'=>t('Control List'), 'PROP'=>'controlList');
			$result[] = array('CAPTION'=>t('Component Links'), 'PROP'=>'componentLinks');
			$result[] = array('CAPTION'=>t('Component List'),'PROP'=>'componentList');
		break;
		
		case 'Bevel':
			$result[] = array(
					  'CAPTION'=>t('Bevel Inner'),
					  'TYPE'=>'combo',
					  'PROP'=>'bevelInner',
					  'VALUES'=>array('bvNone', 'bvLowered', 'bvRaised', 'bvSpace'),
					  );
					  
			$result[] = array(
					  'CAPTION'=>t('Bevel Kind'),
					  'TYPE'=>'combo',
					  'PROP'=>'bevelKind',
					  'VALUES'=>array('bkNone', 'bkTile', 'bkSoft', 'bkFlat'),
					  );

			$result[] = array(
					  'CAPTION'=>t('Bevel Outer'),
					  'TYPE'=>'combo',
					  'PROP'=>'bevelOuter',
					  'VALUES'=>array('bvNone', 'bvLowered', 'bvRaised', 'bvSpace'),
					  );
			$result[] = array(
					  'CAPTION'=>t('Bevel Width'),
					  'TYPE'=>'number',
					  'PROP'=>'bevelWidth',
					  );
			$result[] = array(
					  'CAPTION'=>t('Bevel Edges'),
					  'TYPE'=>'list',
					  'VALUES'=>array ('beLeft', 'beRight', 'beBottom', 'beTop'),
					  'PROP'=>'bevelEdges',
					  );				  
		break;
		
		case 'Hint':
			$result[] = array(
							  'CAPTION'=>t('Hint'),
							  'TYPE'=>'text',
							  'PROP'=>'hint',
							  );
		break;
		
		case 'Constraints':
			$result[] = array('CAPTION'=>t('Constraints'),'PROP'=>'constraints', 'CLASS'=>'TSizeConstraints');
			
			$result[] = array('CAPTION'=>t('Min Width'),'PROP'=>'constraints->minWidth');    
			$result[] = array('CAPTION'=>t('Max Width'),'PROP'=>'constraints->minWidth');
			
			$result[] = array('CAPTION'=>t('Min Height'),'PROP'=>'constraints->minHeight');
			$result[] = array('CAPTION'=>t('Max Height'),'PROP'=>'constraints->maxHeight');
		break;	
	}
}