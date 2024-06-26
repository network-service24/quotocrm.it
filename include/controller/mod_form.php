<?php
  if($_REQUEST['act'] == 'upd'){
    $lingue = getLingueSito($_REQUEST['idsito']);
    $idSito = $_REQUEST['idsito'];
    $idlang = $_REQUEST['id_lang'];
    $idForm = $_REQUEST['idform'];
    $raw = explode('_',$_REQUEST['nomeForm']);
    $form_ref = $raw[1];

  
    foreach($lingue as $k => $v){
      $idLingua = $idlang;
    
      foreach($_REQUEST['header'][$k] as $kl => $vl){

        $sel = "SELECT * FROM hospitality_form_testata_lang WHERE tipo_label= '".$kl."' AND id_form = '".$idForm."' AND id_lang = '".$idLingua."' limit 1";
        $res = $dbMysqli->query($sel);
        if(sizeof($res) > 0){
          $update = "UPDATE hospitality_form_testata_lang SET descrizione = '".urldecode($vl)."' WHERE tipo_label= '".$kl."' AND id_form = '".$idForm."' AND id_lang = '".$idLingua."' ";
          $dbMysqli->query($update);
        }else{
          $insert = "INSERT INTO hospitality_form_testata_lang (id_form,tipo_label,descrizione,id_lang) VALUES('".$idForm."','".$kl."','".urldecode($vl)."','".$idLingua."')";
          $dbMysqli->query($insert);
        }
      }
      
      if(isset($_REQUEST['content'][$k])){
        foreach($_REQUEST['content'][1] as $kl => $vl){
          
          $update2 = "UPDATE hospitality_form_contenuti SET id_tipo_input = '".$vl['tipo']."' ,name = '".$vl['name']."',attivo = '".$vl['attivo']."',obbligatorio = '".$vl['obbligatorio']."' WHERE id= '".$vl['id_campo']."' ";
          $dbMysqli->query($update2);
        }

        foreach($_REQUEST['content'][$k] as $kl => $vl){

          $update3 = "UPDATE hospitality_form_contenuti_lang SET label = '".urlencode($vl['label'])."' ,parametri = '".urlencode(addslashes($vl['parametri']))."',campo = '".$vl['campo']."' WHERE id= '".$kl."' ";
          $dbMysqli->query($update3);
        }
      }
    }
      

    header('Location:'.BASE_URL_SITO.'setting-form/');
  }
?>