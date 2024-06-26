<?php 
include($_SERVER['DOCUMENT_ROOT'].'/include/settings.inc.php');
include($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');


$query = "SELECT siti.idsito,siti.data_start_hospitality,siti.data_end_hospitality
                FROM siti
                WHERE siti.hospitality = 1
                ".($_REQUEST['idsito']!=""?"AND siti.idsito = ".$_REQUEST['idsito']:"")."
                AND siti.data_end_hospitality > '".date('Y-m-d')."'
                GROUP BY siti.idsito
                ORDER BY siti.data_start_hospitality DESC";
$rec = $dbMysqli->query($query);
$tot = sizeof($rec);
if($tot > 0){

    $arraySiti = array();
    $dataEnd = '';
    foreach ($rec as $key => $dati) {

        $dataEnd = $dati['data_end_hospitality'];

        $arraySiti[] = array('IDSITO' => $dati['idsito'],'DAL' => date('Y-m-d'),'AL' => $dati['data_end_hospitality']);
    }
}
if(isset($arraySiti) && !empty($arraySiti)) {

    $PARITYcheck  = '';

    foreach($arraySiti as $ky => $vl){
        
        $Squery      = "SELECT * FROM hospitality_parityrate WHERE idsito = ".$vl['IDSITO']." AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
        $Rquery      = $dbMysqli->query($Squery);
        $records     = $Rquery[0];
        if(sizeof($Rquery)>0){
            $PARITYcheck = count($records);
        }else{
            $PARITYcheck = 0;
        } 
        
        if($PARITYcheck > 0){

               

            $Apikey     = $records['ApiKey'];
            $Url        = $records['UrlApi'];
            $HotelId    = $records['HotelId'];
            $UserParity = $records['UserParity'];
            $PasswordParity = $records['PasswordParity'];

            $xml_post_stringView = '<?xml version="1.0" encoding="utf-8"?>
                                        <Request  userName="'.$UserParity.'" password="'.$PasswordParity.'" apikey="'.$Apikey.'">
                                        <view hotelId="'.$HotelId.'" startDate="'.$vl['DAL'].'" endDate="'.$vl['AL'].'"/>
                                        </Request>';

            $headers = array(
            "Content-Type: text/xml; charset=utf-8",
            "Content-Length: ".strlen($xml_post_stringView)
            );


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $Url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_stringView);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $responseView = curl_exec($ch);
            curl_close($ch);


            $parserView = simplexml_load_string($responseView);

            $array_listino = array();

            $n    = 1;
            $AL   = '';
            $data = '';
            foreach($parserView->availability as $ky => $val){

                foreach($val->rate as $k => $v){

                    $data = explode('-',$val['day']);
                    $AL_  = mktime(0,0,0,$data[1],($data[2]+1),$data[0]);
                    $AL   = date('Y-m-d',$AL_);

                    $array_listino[] = array('IDSITO' => $vl['IDSITO'],'IDCAMERA' => $val['roomId'],'IDTRATTAMENTO' => $v['rateId'],'DAL' => $val['day'],'AL' => $AL, 'PREZZO' => $v['price']);

                }
                $n++;
            }
        }
    }
}
if(isset($array_listino) && !empty($array_listino)) {

    $n = 1;
    $msg_insert = array();
    $msg_update = array();
    $myfile = fopen($path_cron.'log/log_listino_parity_test.txt', 'w'); 

    foreach($array_listino as $key => $value){

            $Lquery        = "SELECT * FROM hospitality_numero_listini WHERE idsito = ".$value['IDSITO']."  AND Listino LIKE '%Listino ParityRate%' AND Abilitato = 1";
            $REquery       = $dbMysqli->query($Lquery);             
            $record        = $REquery[0];

            if(sizeof($record)>0) {
                $LISTINOcheck = count($record);
            }else{
                $LISTINOcheck = 0;
            } 

            if($LISTINOcheck > 0){
                $IdListino = $record['Id'];
            }else{
                $idquery   = $dbMysqli->query("INSERT INTO hospitality_numero_listini(idsito,Listino,Parity,Abilitato) VALUES('".$value['IDSITO']."','Listino ParityRate','1','1')");
                $IdListino = $dbMysqli->getInsertId($idquery);
            }

            $select = "SELECT *
                        FROM hospitality_listino_camere
                        WHERE hospitality_listino_camere.idsito        = ".$value['IDSITO']."
                        AND hospitality_listino_camere.IdNumeroListino = ".$IdListino."
                        AND hospitality_listino_camere.RateId          = ".$value['IDTRATTAMENTO']."
                        AND hospitality_listino_camere.RoomId          = ".$value['IDCAMERA']."
                        AND hospitality_listino_camere.PeriodoDal      = '".$value['DAL']."'
                        AND hospitality_listino_camere.PeriodoAl       = '".$value['AL']."'
                        AND hospitality_listino_camere.PrezzoCamera    = '".$value['PREZZO']."'";
            $res    = $dbMysqli->query($select);
            $type   = $res[0];
            if(sizeof($res)>0){
                $check = count($type);
            }else{
                $check = 0;
            }
    
            $select2 = "SELECT Id as IdCamera
                        FROM hospitality_tipo_camere
                        WHERE hospitality_tipo_camere.idsito  = ".$value['IDSITO']."
                        AND hospitality_tipo_camere.RoomParityId = ".$value['IDCAMERA']."";
            $res2    = $dbMysqli->query($select2);
            $type2   = $res2[0];
            if(sizeof($res2)>0){
                $check2 = count($type2);
            }else{
                $check2 = 0;
            }

            $select3 = "SELECT Id as IdSoggiorno
                        FROM hospitality_tipo_soggiorno
                        WHERE hospitality_tipo_soggiorno.idsito  = ".$value['IDSITO']."
                        AND hospitality_tipo_soggiorno.RateParityId = ".$value['IDTRATTAMENTO']."";
            $res3    = $dbMysqli->query($select3);
            $type3   = $res3[0];
            if(sizeof($res3)>0){
                $check3 = count($type3);
            }else{
                $check3 = 0;
            }

        if($check2 > 0 && $check3 > 0 ){
            if($check == 0){
                
                $insert = "INSERT INTO hospitality_listino_camere(idsito,IdNumeroListino,IdSoggiorno,RateId,IdCamera,RoomId,PeriodoDal,PeriodoAl,PrezzoCamera,Abilitato)
                            VALUES ('".$value['IDSITO']."','".$IdListino."','".$type3['IdSoggiorno']."','".$value['IDTRATTAMENTO']."','".$type2['IdCamera']."','".$value['IDCAMERA']."','".$value['DAL']."','".$value['AL']."','".$value['PREZZO']."','1')";
                $dbMysqli->query($insert);
                $msg_insert[] = 'insert';
            }else{
                $update = "UPDATE hospitality_listino_camere SET PrezzoCamera = '".$value['PREZZO']."' WHERE Id = ".$type['Id']." AND idsito = ".$value['IDSITO'];
                $dbMysqli->query($update);
                $msg_update[] = 'modify';
            }

        }      

        if($check2 > 0 && $check3 > 0) {

            $insert_data = "INSERT INTO hospitality_data_syncro_listino_parity(idsito,data) VALUES('".$value['IDSITO']."','".date('Y-m-d H:i:s')."')";
            $dbMysqli->query($insert_data);
            $echomessage[] = 'Syncro '.$n.' righe OK ('.$value['IDSITO'].') per le date dal '.Date('Y-m-d').' al '.$value['AL'].'<br>Inserimenti '.count($msg_insert).'<br>Modifiche '.count($msg_update).'<br>';
            $n++;
        }else{
            die('Non sono stati abbinati le tipologie di soggirono o le camere, controllare!');
        }
        
    } // fine ciclo IDSITO con parity
    echo end($echomessage);
    fwrite($myfile, end($echomessage));
}else{
    echo 'Nessun Cliente QUOTO ha configurato ParityRate!';
} // se array parity è popolato
fclose($myfile);
?>