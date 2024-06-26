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
	
	if (!empty($_FILES))
	{
		$folder = '';
		if(isset($_POST['folder']))
			$folder = $_POST['folder'];

		$fileext = '';
		if(isset($_POST['fileExt']))
			$fileext = $_POST['fileExt'];
		
		$fileext .= ','.strtoupper($fileext);

		$tempFile = $_FILES['Filedata']['tmp_name'];
		$file = $_FILES['Filedata']['name'];
		
		$typesArray = split(',',$fileext);
		$fileParts  = pathinfo($file);

		//if (in_array($fileParts['extension'],$typesArray))
		//{
			$targetDir = str_replace('//','/',$_SERVER['DOCUMENT_ROOT'] . $folder.'/');
			$new_file_name = sha1(mktime());
			$targetFile =  $targetDir . $new_file_name . '.' . $fileParts['extension'];
		
			if(!file_exists($targetDir)){
				mkdir($targetDir, 0777, true);
			}
			
			move_uploaded_file($tempFile,$targetFile);
			
			echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
		//}
		//else
		//{
			//echo '/img/button_warning.png';
		//}
	}

?>