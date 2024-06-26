<?php
#RECUPERO VARIBILI
$checkbox = explode(',',$_REQUEST['checkbox']);
$idsito   = $_REQUEST['idsito'];
$idlista  = $_REQUEST['id_lista'];


if($_REQUEST['action']=='add_all_inlist'){

    if($_REQUEST['new_list']=='1'){

            $select = "SELECT * FROM mailing_newsletter_nome_liste WHERE idsito = ".$idsito." AND nome_lista = '".addslashes($_REQUEST['nome_lista'])."' ";
            $res = $db->query($select);
            $arrec = $db->result($res);
            if(sizeof($arrec)>0){
                $prt->alertback('Il nome lista è già presente!',BASE_URL_SITO.'newsletter/index/');
                exit;
            }else{
                $inserimento = "INSERT INTO mailing_newsletter_nome_liste (idsito,nome_lista,visibile) VALUE('".$idsito."','".addslashes($_REQUEST['nome_lista'])."','1')";
                $db->query($inserimento);
                $new_idlista = $db->insert_id(); 

            }
    }

    if($idlista == '')$idlista = $new_idlista;
    
    if(is_array($checkbox) && !empty($checkbox)){	

        $check_nome                = '';
        $id_lista                  = '';
        $insert                    = '';
        $nome                      = '';
        $cognome                   = '';
        $email                     = '';
        $lingua                    = '';
        $ip                        = '';
        $data                      = '';
        $agent                     = '';
        $CheckConsensoPrivacy      = '';
        $CheckConsensoMarketing    = '';
        $CheckConsensoProfilazione = '';
        $attivo                    = '';

		foreach ($checkbox as $key => $value) {

			$select = "SELECT * FROM hospitality_guest WHERE Id = ".$value." AND idsito = ".$idsito;
            $ris_query = $db->query($select);
            $array_query = $db->result($ris_query);

            $check_nome = '';
            $insert     = '';
            $nome       = '';
            $cognome    = '';
            $email      = '';
            $lingua     = '';
            $id_lista   = '';
            $attivo     = '';
            
            foreach($array_query as $k => $row){
               
                $nome    = addslashes($row['Nome']);
                $cognome = addslashes($row['Cognome']);
                $email   = $row['Email'];
                $lingua  = $row['Lingua'];

                $ip                        = ($row['Ip']!= ''?$row['Ip']:$_SERVER['REMOTE_ADDR']);
                $data                      = $row['DataRichiesta'];
                $agent                     = ($row['Agent']!= ''?$row['Agent']:$_SERVER['HTTP_USER_AGENT']);
                $CheckConsensoPrivacy      = ($row['CheckConsensoPrivacy']!=''?$row['CheckConsensoPrivacy']:0);
                $CheckConsensoMarketing    = ($row['CheckConsensoMarketing']!=''?$row['CheckConsensoMarketing']:0);
                $CheckConsensoProfilazione = ($row['CheckConsensoProfilazione']!=''?$row['CheckConsensoProfilazione']:0);
                $attivo                    = ($CheckConsensoMarketing == 0 ? 0 : 1 );

                $sel = "SELECT id as id_lista FROM mailing_newsletter_nome_liste WHERE id = ".$idlista." AND idsito = ".$idsito;
                $ris_q = $db->query($sel);
                $array_q = $db->result($ris_query);
                $id_lista = '';
                foreach($array_q as $ky => $rw){
                    $id_lista = $rw['id_lista'];

                    $s = "SELECT * FROM mailing_newsletter WHERE idsito = ".$idsito." AND id_lista = ".$id_lista." AND nome = '".$nome."' AND cognome = '".$cognome."' ";
                    $r = $db->query($s);
                    $check_nome = sizeof($db->result($r));
                    
                    if($check_nome==0){
                        $insert = "INSERT INTO mailing_newsletter (idsito,id_lista,nome,cognome,email,lingua,ip,data,agent,CheckConsensoPrivacy,CheckConsensoMarketing,CheckConsensoProfilazione,attivo) VALUE('".$idsito."','".$id_lista."','".$nome."','".$cognome."','".$email."','".$lingua."','".$ip."','".$data."','".$agent."','".$CheckConsensoPrivacy."','".$CheckConsensoMarketing."','".$CheckConsensoProfilazione."','".$attivo ."')";
                        $db->query($insert);
                    }
                }
            }
            $check_nome           = '';
            $id_lista             = '';
            $insert               = '';
            $nome                 = '';
            $cognome              = '';
            $email                = '';
            $lingua               = '';
            $ip                   = '';
            $data                 = '';
            $agent                = '';
            $CheckConsensoPrivacy = '';
            $CheckConsensoMarketing = '';
            $CheckConsensoProfilazione = '';
		}
        $prt->_goto(BASE_URL_SITO.'newsletter/'.URL_CLIENT_EMAIL.'-index/'); 
    }
}


?>