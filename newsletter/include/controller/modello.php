 <?php

 	# query  per cancellazione dati  
	if($_REQUEST['action']=='delete_template'){
	
		$delete = "DELETE FROM mailing_newsletter_template WHERE id = '".$value."'";
		$dbMysqli->query($delete);
		
	}

	# query  per inserimento dati  
 	if($_REQUEST['action']=='insert_template'){
		$select = "SELECT * FROM mailing_newsletter_template WHERE idsito = ".IDSITO." AND nome_template = '".addslashes($_REQUEST['nome_template'])."' ";
		$arrec = $dbMysqli->query($select);
		if(sizeof($arrec)>0){
			$prt->alertgo('Il nome del template è già presente!',BASE_URL_SITO.'newsletter/modello/');
		}else{
			$inserimento = "INSERT INTO mailing_newsletter_template (idsito,lingua, nome_template,template) VALUE('".IDSITO."','".$_REQUEST['lingua']."','".addslashes($_REQUEST['nome_template'])."','".addslashes($_REQUEST['template'])."')";
			$dbMysqli->query($inserimento);
			$prt->_goto(BASE_URL_SITO.'newsletter/'.URL_CLIENT_EMAIL.'-visualizza_modelli/');
		}
			
	}

$js_script_editor ='
 <script>
    $(function(){ 
		$("#preview").on("click",function(){
			$("#screenshots").modal("show");  
		});  
    CKEDITOR.replace("template");
        $(".textarea").wysihtml5();                                               
    });        
</script>';
$js_script_editor .='<script type="text/javascript" src="'.BASE_URL_SITO.'js/ckeditor/ckeditor.js"></script>'."\r\n";  
$js_script_editor .='<script type="text/javascript">
                        CKEDITOR.config.toolbar = [
                                        [\'Source\',\'-\',\'Maximize\'],[\'Format\',\'Font\',\'FontSize\'],
                                        [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Outdent\',\'Indent\'],
                                        [\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\'],
                                        [\'Image\',\'Table\',\'Link\',\'TextColor\',\'BGColor\']
                                    ] ;
                        CKEDITOR.config.autoGrow_onStartup = true;
                        CKEDITOR.config.extraPlugins = \'autogrow\';
                        CKEDITOR.config.autoGrow_minHeight = 400;
                        CKEDITOR.config.autoGrow_maxHeight = 600;
                        CKEDITOR.config.autoGrow_bottomSpace = 50;           
                </script>'."\r\n";

?> 