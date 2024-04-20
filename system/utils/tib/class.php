<?

/* xsnakes */
/* TIB v1.4 */
// for DevelStudio XL

    createForm(dirname(__FILE__).'/fmTIB.dfm');
	
	$item = new TMenuItem(c('fmMain'));
	$item->caption = 'TIB';

    $file = SYSTEM_DIR . '/images/24/TIB.png';
    if (file_exists($file))
		$item->loadPicture($file);
	c('fmMain->it_Utils')->addItem($item);
	c('fmTIB')->doubleBuffered = 1;
	
	$item->onClick = function($self)
	{
		global $_sc;
		$sel = $_sc->getSelected();
		if(!$sel)
			return MessageBox (t('Not TIB!'), '', MB_ICONERROR);
		
		$obj = c($sel[0]);
		
		if ($obj->class_name_ex == 'TIB')
		{
			c('fmTIB')->tib = $obj;
			c('fmTIB->listBox1')->items->clear();
			c('fmTIB->image1')->picture->clear();
			master_TIB::tib_update_list();
			c('fmTIB')->showModal();
		} else {
			MessageBox (t('Not TIB!'), '', MB_ICONERROR);
		}
	};

	$dlg = new TOpenDialog (c('fmTIB'));
	$dlg->filter = 'All images|*.bmp;*.gif;*.jpeg;*.jpg;*.wmf;*.emf;*.ico;*.png';
	$dlg->name = 'openDlg1';

/////////////////////////////////////////////////////////////////////////////////

	c('fmTIB->listBox1')->onClick = function($self)
	{
		if( c('fmTIB->listBox1')->itemIndex > -1 )
		{
		        $tib = c('fmTIB')->tib;
				
		        //if(is_object($tib))
				//{
					if(/*$tib->class_name_ex == 'TIB'*/ $tib instanceof TIB)
					{
						$arr = $tib->images;
						$i = c('fmTIB->listBox1')->itemIndex;
						
						if(is_array($arr[$i]))
						c('fmTIB->image1')->picture->loadFromStr($arr[$i][0], $arr[$i][1]);
					}
		        //}
		} else {
			
		 c('fmTIB->image1')->picture->clear();
		}
	};

	c('fmTIB->spButton1')->onClick = function(){
		$tib = c('fmTIB')->tib;
		if( is_object($tib) ){
		 if( $tib->class_name_ex == 'TIB'){
		  c('fmTIB->openDlg1')->multiSelect = false;
		  if( c('fmTIB->openDlg1')->execute() ){
		   $tib->add( c('fmTIB->openDlg1')->fileName );
		   master_TIB::tib_update_list();
		  }
		 }
		}
	};

	c('fmTIB->spButton2')->onClick = function(){
		$tib = c('fmTIB')->tib;
		if( is_object($tib) ){
		 if( $tib->class_name_ex == 'TIB'){
		  c('fmTIB->openDlg1')->multiSelect = true;
		  if( c('fmTIB->openDlg1')->execute() ){
		   $files = c('fmTIB->openDlg1')->files;
		   foreach($files as $f){
		    $tib->add($f);
		    master_TIB::tib_update_list();
		   }
		  }
		 }
		}
	};
	c('fmTIB->spButton3')->onClick = function(){
		$tib = c('fmTIB')->tib;
		if( is_object($tib) ){
		 if( $tib->class_name_ex == 'TIB'){
		  $i = c('fmTIB->listBox1')->itemIndex;
		  if( $i > -1 ){
		   $tib->delete($i);
		   master_TIB::tib_update_list();
		   master_TIB::tib_update_img();
		  }
		 }
		}
	};
	c('fmTIB->spButton4')->onClick = function(){
		if( c('fmTIB->listBox1')->itemIndex > 0 and c('fmTIB->listBox1')->items->count > 1){
		        $tib = c('fmTIB')->tib;
		        if( is_object($tib) ){
		         if( $tib->class_name_ex == 'TIB'){
		          $arr = $tib->images;
		          $i = c('fmTIB->listBox1')->itemIndex;
		          $t1 = $arr[$i];
		          $t2 = $arr[$i-1];
		          $arr[$i-1] = $t1;
		          $arr[$i] = $t2;
		          $tib->images = $arr;
		          c('fmTIB->listBox1')->itemIndex = $i-1;
		         }
		        }
		}
	};
	c('fmTIB->spButton5')->onClick = function(){
		$i = c('fmTIB->listBox1')->itemIndex;
		if( $i > -1 and $i < c('fmTIB->listBox1')->items->count-1  and c('fmTIB->listBox1')->items->count > 1){
		        $tib = c('fmTIB')->tib;
		        if( is_object($tib) ){
		         if( $tib->class_name_ex == 'TIB'){
		          $arr = $tib->images;
		          $t1 = $arr[$i];
		          $t2 = $arr[$i+1];
		          $arr[$i+1] = $t1;
		          $arr[$i] = $t2;
		          $tib->images = $arr;
		          c('fmTIB->listBox1')->itemIndex = $i+1;
		         }
		        }
		}
	};
	c('fmTIB->spButton6')->onClick = function(){
		$tib = c('fmTIB')->tib;
		if( is_object($tib) ){
		 $i = c('fmTIB->listBox1')->itemIndex;
		 if( $tib->class_name_ex == 'TIB' and $i > -1 ){
		  c('fmTIB->openDlg1')->multiSelect = false;
		  if( c('fmTIB->openDlg1')->execute() ){
		   $tib->replace($i, c('fmTIB->openDlg1')->fileName );
		   master_TIB::tib_update_list();
		   c('fmTIB->listBox1')->itemIndex = $i;
		   $arr = $tib->images;
		   if( is_array($arr[$i]) ){
		    c('fmTIB->image1')->picture->loadFromStr($arr[$i][0],$arr[$i][1]);
		   }
		  }
		 }
		}
	};
	c('fmTIB->spButton7')->onClick = function(){
		$tib = c('fmTIB')->tib;
		if( is_object($tib) ){
		 if( $tib->class_name_ex == 'TIB' and c('fmTIB->listBox1')->itemIndex > -1 ){
		  $arr = $tib->images;
		  $i = c('fmTIB->listBox1')->itemIndex;
		  if( is_array($arr[$i]) ){
		   $tib->state = $i;
		  }
		 }
		}
	};
	c('fmTIB->spButton8')->onClick = function(){
		$tib = c('fmTIB')->tib;
		if( is_object($tib) ){
		 if( $tib->class_name_ex == 'TIB'){
		  $tib->picture->clear();
		   $tib->index = false;
		 }
		}
	};
	c('fmTIB->spButton9')->onClick = function(){
		c('fmTIB')->close();
	};
	c('fmTIB->spButton10')->onClick = function(){
		$tib = c('fmTIB')->tib;
		if( is_object($tib) ){
		 if( $tib->class_name_ex == 'TIB' and count($tib->images) > 0 ){
		  $tib->clear();
		  c('fmTIB->listBox1')->items->clear();
		  c('fmTIB->image1')->picture->clear();
		 }
		}
	};

/////////////////////////////////////////////////////////////////////////////////

	class master_TIB{

		function tib_update_list(){
			$tib = c('fmTIB')->tib;
			if( is_object($tib) ){
			 if( $tib->class_name_ex == 'TIB'){
			  $arr = $tib->images;
			  if( is_array($arr) ){
			   c('fmTIB->listBox1')->items->clear();
			   foreach($arr as $k=>$v){
			    c('fmTIB->listBox1')->items->add('Img'.$k.'.'.$v[1]);
			   }
			  }
			 }
			}
		}

		function tib_update_img(){
			$tib = c('fmTIB->fmTIB')->tib;
			if( c('fmTIB->listBox1')->itemIndex > -1 ){
			        if( is_object($tib) ){
			         if( $tib->class_name_ex == 'TIB'){
			          $arr = $tib->images;
			          $i = c('fmTIB->listBox1')->itemIndex;
			          if( is_array($arr[$i]) ){
			           c('fmTIB->image1')->picture->loadFromStr($arr[$i][0],$arr[$i][1]);
			          }
			         }
			        }
			}else{
			 c('fmTIB->image1')->picture->clear();
			}
		}
		
	}