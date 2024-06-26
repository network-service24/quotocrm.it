<?php
	/*
	Uploadify v2.1.4
	Release Date: November 8, 2010

	Copyright (c) 2010 Ronnie Garcia, Travis Nickels

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
	*/

	include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
	
	function transform($source, $dest, $w=0, $h=0) {
		$qualita = UPLOADED_PHOTO_QUALITY;
		
		$source_ = explode('/',$source);
		$img = $source_[(count($source_))-1];

		if(!file_exists($dest)){
			mkdir($dest);
		}
		
		$tb = new Thumbnail();
		$tb->openImg($source);
		
		if($w == 0 && $h == 0) {
			//non fare nulla
		}
		else if($w != 0 && $h == 0 && $tb->getWidth() > $w) {
			//ridimensiono solo in larghezza, mantenendo le proporzioni
			$W = $w;
			$H = $tb->getRightHeight($w);
			$tb->creaThumb($W, $H);
			$tb->saveThumb($dest.$img,$qualita);
			$tb->closeImg();
		}
		else if($w == 0 && $h != 0 && $tb->getHeight() > $h) {
			//ridimensiono solo in altezza, mantenendo le proporzioni
			$W = $tb->getRightWidth($h);
			$H = $h;
			$tb->creaThumb($W, $H);
			$tb->saveThumb($dest.$img,$qualita);
			$tb->closeImg();
		}
		else if($w != 0 && $h != 0 && ($tb->getHeight() > $h || $tb->getWidth() > $w)) {
			$W = $w;
			$H = $tb->getRightHeight($W);
			if($H < $h)
			{
				$H = $h;
				$W = $tb->getRightWidth($H);
			}
			$tb->creaThumb($W, $H);
			$tb->setThumbAsOriginal();
			$x = ($tb->getWidth() - $w)/2;
			$y = ($tb->getHeight() - $h)/2;
			$tb->cropThumb($w, $h, $x, $y);
			$tb->saveThumb($dest.$img,$qualita);
			$tb->closeImg();
		}
		else if(($w != 0 && $h != 0 && ($tb->getHeight() <= $h || $tb->getWidth() <= $w)) || ($w != 0 && $h == 0 && ($tb->getWidth() <= $w)) || ($w == 0 && $h != 0 && ($tb->getHeight() <= $h))) {
			copy($source, $dest.$img);
		}
	}
	
		
	/*
	
	Il salvataggio delle immagini viene svolto seconod la seguente logica
		
		/immagine.jpg					<- immagine con dimensioni $maxWimg x $maxHimg
		/sorgente/immagine.jpg			<- immagine sorgente, non ridimensionata
		/formato1/immagine.jpg			<- immagine con formato personalizzato
		/formato2/immagine.jpg			<- immagine con formato personalizzato
		/formato3/immagine.jpg			<- immagine con formato personalizzato
		/formato.../immagine.jpg		<- immagine con formato personalizzato
		
	i formati personalizzati sono espressi con i due valori width e height concatenati un un "_" per esempio, il formato 250px x 150px corrisponderà a 250_150
	per cui il percorso sarà
	
		/250_150/immagine.jpg
	
	il nome delle immagini resta invariato, cambia solo il percorso in base al formato.
	
	*/
	function saveThumbsImage($img, $source, $dest, $formati) {
		if($img != "") {
			include($_SERVER['DOCUMENT_ROOT'].'/uploader/thumbnail.class.php');
			$tb = new Thumbnail();
			
			$qualita = UPLOADED_PHOTO_ORIG_QUALITY; //100
			$maxWimg = UPLOADED_PHOTO_ORIG_W; // 2560
			$maxHimg = UPLOADED_PHOTO_ORIG_H; // 1600;
			
			//CREO LA CARTELLA ROOT
			if(!file_exists($dest))
				mkdir($dest);
				
			//PREARO IL PERCORSO DELL'IMMAGINE IN ROOT
			$dest_img = $dest.$img;
			
			// NB. $source DI NORMA è UGUALE A $dest_img, PER CUI NON CANCELLARE SOURCE CON unlink()
			
			//SALVO L'IMMAGINE IN ROOT CON FORMATO MASSIMO 1920x1080
			$tb->openImg($source);
			if($tb->getWidth() > $maxWimg || $tb->getHeight() > $maxHimg) {
				//ridimensiono in larghezza
				$Himg = $tb->getRightHeight($maxWimg);
				$Wimg = $maxWimg;
				//se ridimensionando in larghezza, l'altezza dell'immagine è comunque maggiore del limite
				if($Himg > $maxHimg) {
					//ridimensiono in altezza
					$Wimg = $tb->getRightWidth($maxHimg);
					$Himg = $maxHimg;
				}
				$tb->creaThumb($Wimg, $Himg);
				$tb->saveThumb($dest_img,$qualita);
				$tb->closeImg();
			}
			
			//SALVO L'IMMAGINE IN TUTTI I FORMATI INDICATI NELLE RELATIVE SOTTOCARTELLE
			foreach($formati as $formato){
				$w = $formato['w'];
				$h = $formato['h'];
				if($w != '' && $h != '' && $w >= 0 && $h >= 0){
					$sub_dir = $w.'_'.$h.'/';			//SOTTOCARTELLA ES. /300_200/
					transform($source, $dest.$sub_dir, $w, $h);
				}
			}
		}
		return($dest_img);
	}

	if (!empty($_FILES)){
		$folder = '';
		
		if(isset($_POST['folder'])){
			$folder = $_POST['folder'];
		}
		
		$fileExt = '';
		if(isset($_POST['fileExt'])){
			$fileExt = $_POST['fileExt'];
		}
		
		$fileExt .= ','.strtoupper($fileExt);
		
		$str_formati = '';
		if(isset($_POST['formati'])){
			$str_formati = $_POST['formati'];
		}
		
		$formati_ = explode('_',$str_formati);
		$formati = array();
		foreach($formati_ as $dati) {
			$dati_ = explode('-',$dati);
			$formato = $dati_[1];
			
			$dimensioni = explode('x',$formato);
			$w = $dimensioni['0'];
			$h = $dimensioni['1'];
			
			$formati[] = array('w'=>$w, 'h'=>$h);
		}

		$typesArray = split(',',$fileExt);
		$fileParts  = pathinfo($_FILES['Filedata']['name']);

		$tempFile = $_FILES['Filedata']['tmp_name'];
		$file = mktime().md5($_FILES['Filedata']['name']).'.'.strtolower($fileParts['extension']);	//	$_FILES['Filedata']['name'];
		
		$targetDir = str_replace('//','/',$_SERVER['DOCUMENT_ROOT'] . $folder . '/');
		$targetFile =  $targetDir . $file;
		
		//if (in_array(strtolower($fileParts['extension']),$typesArray)) {
			if(!file_exists($targetDir)) {
				mkdir($targetDir, 0777, true);
			}
			
			// sposto il file caricato nella apposita cartella
			move_uploaded_file($tempFile,$targetFile);
			
			// richiamo la funzione che genera tutti i sotto-formati dell'immagine
			$ret = saveThumbsImage($file, $targetFile, $targetDir, $formati);
			
			if($ret) {
				if(!$not_echo) echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$ret);
			}
			else {
				if(!$not_echo) echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
			}
		//}
		//else {
			//if(!$not_echo) echo '/img/button_warning.png';
		//}
	}

?>