<?
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
//error_reporting(0);
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
mysqli_set_charset($conn,'utf8');

$HotelId = '';
$Type    = '';
$UrlApi  = '';
$idsito  = $_REQUEST['idsito'];

$qry     = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'info-alberghi.com' AND idsito = ".$idsito."  AND Abilitato = 1 ORDER BY Id DESC";
$sq      = mysqli_query($conn,$qry);
$row     = mysqli_fetch_assoc($sq);
$tot     = mysqli_num_rows($sq);

    $uniqueID = '979796cc20060a5a7eedf1af35922eb111e825a6';
    $HotelID  = $row['HotelID'];
    $Type     = $row['Type'];
    $UrlApi   = $row['UrlApi'];
    $idsito   = $row['idsito'];

    if($tot > 0){

             $tipo_modulo           = '';
             $FontePrenotazione     = '';
             $maildata              = '';
             $array_contenuti_email = '';
             $arr_field             = '';
             $body                  = '';
             $righe                 = '';
             $NumeroPrenotazione    = '';
             $FontePrenotazione     = '';
             $MessageId             = '';
             $DataRichiesta         = '';
             $TipoRichiesta         = '';
             $Nome                  = '';
             $Cognome               = '';
             $Email                 = '';
             $Cellulare             = '';
             $Lingua                = '';
             $DataArrivo            = '';
             $DataPartenza          = '';
             $NumeroAdulti          = '';
             $NumeroBambini         = '';
             $Note                  = '';
             $AbilitaInvio          = '';
             $valore                = '';
             $risultato             = '';
             $Trattamento           = '';
             $headerInfo            = '';
             $maildata              = '';
             $flex                  = '';
             $checkin               = '';
             $checkout              = '';
             $adult                 = '';
             $meal_plan             = '';
             $d_flessibili          = '';
             $bambini_eta_tmp       = '';
             $plus                  = '';
             $Lingua                = '';
             $array_contenuti_email = array();
             $arr_field             = array();
             $contenuto_mail        = array();
             $mail_                 = array();
             $num_bambini           = array();

            $q = "SELECT * FROM hospitality_data_import WHERE idsito = ".$idsito." ORDER BY Id DESC";
            $sel = mysqli_query($conn,$q);
            $rws = mysqli_fetch_assoc($sel);
            $last_data_import = $rws['data'];


            $variabili = 'uniqueID='.$uniqueID.'&hotel_id='.$HotelID.'&type='.$Type;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $UrlApi);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $variabili);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
            if ($output){

                  $contenuto_mail = json_decode($output);

                    foreach ($contenuto_mail as $content_mail) {

                      $mail_ = $content_mail->data;

                      foreach ($mail_ as $mail) {

                        // se la data di arrivo email è maggiore della data dell'ultima importazione
                        if($mail->data_invio > $last_data_import){

                          $tipo_modulo = 'IA_P';

                          $arr_field['IA_P']     = array('Codice' => 'Codice email');

                          $array_contenuti_email[$tipo_modulo][] = array('BODY' => $mail);



                        }// fine controlla data dell'ultima importazione


                      }//primo foreach

                    }// secondo foreach

                }// if se $output è pieno

            // azzero variabili
            $NumeroPrenotazione = '';
            $FontePrenotazione  = '';
            $MessageId          = '';
            $DataRichiesta      = '';
            $TipoRichiesta      = '';
            $Nome               = '';
            $Cognome            = '';
            $Email              = '';
            $Cellulare          = '';
            $Lingua             = '';
            $DataArrivo         = '';
            $DataPartenza       = '';
            $NumeroAdulti       = '';
            $NumeroBambini      = '';
            $Note               = '';
            $AbilitaInvio       = '';
            $valore             = '';
            $risultato          = '';
            $Trattamento        = '';
            $email_body         = '';
            $chiave             = '';
            $valore             = '';
            $risultato          = '';
            $value              = '';
            $key                = '';
            $val                = '';
            $flex               = '';
            $checkin            = '';
            $checkout           = '';
            $adult              = '';
            $meal_plan          = '';
            $d_flessibili       = '';
            $bambini_eta_tmp    = '';
            $plus               = '';
            $Lingua             = '';
            $num_bambini        = array();


            if(!empty($array_contenuti_email)){

                        foreach($array_contenuti_email as $key => $value){


                                foreach($value as $k => $val){

                                            $risultato = $val['BODY'];

                                            $conn2 = mysqli_connect($host, $username, $password,$dbname) or die ("Error connecting to database");
                                            mysqli_set_charset($conn2,'utf8');

                                            $sel2               = "SELECT NumeroPrenotazione as nr FROM hospitality_guest WHERE idsito = ".$idsito." ORDER BY NumeroPrenotazione DESC LIMIT 1";
                                            $res2               = mysqli_query($conn2,$sel2);
                                            $rws2               = mysqli_fetch_assoc($res2);

                                            $NumeroPrenotazione = (intval($rws2['nr'])+1);
                                            //
                                            $FontePrenotazione = 'Info Alberghi';

                                            $DataRichiesta_=   explode(" ",$risultato->data_invio);
                                            $DataRichiesta =   $DataRichiesta_[0];
                                            $TipoRichiesta =   'Preventivo';
                                            $nome_tmp      =   explode(" ", $risultato->customer);
                                            $Nome          =   $nome_tmp[0];
                                            $Cognome       =   $nome_tmp[1].($nome_tmp[2]!=''?' '.$nome_tmp[2]:'').($nome_tmp[3]!=''?' '.$nome_tmp[3]:'');
                                            $Email         =   $risultato->email;
                                            $Cellulare     =   $risultato->phone;
                                            $Lingua        =   $risultato->lang_id;


                                            $flex          = $risultato->rooms[0]->flex_date;
                                            $DataArrivo    = $risultato->rooms[0]->checkin;
                                            $DataPartenza  = $risultato->rooms[0]->checkout;
                                            $adult         = $risultato->rooms[0]->adult;
                                            $meal_plan     = $risultato->rooms[0]->meal_plan;
                                            //$meal_plan     = implode(',',$risultato->rooms[0]->meal_plan);
                                            $bambini_eta_tmp = implode(',',$risultato->rooms[0]->children);
                                            $num_bambini   = $risultato->rooms[0]->children;

                                            if($flex ==1){
                                                $d_flessibili = 'Richiesta date flessibili';
                                            }else{
                                                $d_flessibili = '';
                                            }

                                            $NumeroAdulti      = $adult;

                                            if(is_array($num_bambini) && !is_null($num_bambini) && !empty($num_bambini) && count($num_bambini)>0){
                                              $NumeroBambini = count($num_bambini);   
                                            }else{
                                              $NumeroBambini = 0; 
                                            }
                                            
                                            $bambini_eta       = 'Bambini età: '.$bambini_eta_tmp;
                                            $Trattamento       = 'Trattamento: '.$meal_plan."\r\n";
                                            $plus = '';
                                            foreach ($risultato->rooms as $y => $v) {
                                                if($y != 0){
                                                    $plus .= 'Altra camera'."\r\n";
                                                    $plus .= ($v->flex_date==1?'Richiesta date flessibili'."\r\n":'');
                                                    $plus .= 'Arrivo :'.str_replace("/","-",$v->checkin)."\r\n";
                                                    $plus .= 'Partenza: '.str_replace("/","-",$v->checkout)."\r\n";
                                                    $plus .= 'Adulti: '.$v->adult."\r\n";
                                                    $plus .= 'Bambini: '.count($v->children)."\r\n";
                                                    $plus .= 'Età: '.implode(',',$v->children)."\r\n";
                                                    $plus .= 'Trattamento: '.$v->meal_plan."\r\n";
                                                    //$plus .= 'Trattamento: '.implode(',',$v->meal_plan)."\r\n";

                                                }
                                            }
                                            $Note              = ($d_flessibili!=''?$d_flessibili."\r\n":'').($NumeroBambini >0?$bambini_eta."\r\n":'').($meal_plan != ''?$Trattamento:'').$risultato->information ."\r\n".$plus;
                                            $AbilitaInvio      = '0';



                                            $insert =  "INSERT INTO hospitality_guest(idsito,
                                                                                        id_politiche,
                                                                                        FontePrenotazione,
                                                                                        DataRichiesta,
                                                                                        TipoRichiesta,
                                                                                        Nome,
                                                                                        Cognome,
                                                                                        Email,
                                                                                        NumeroPrenotazione,
                                                                                        Cellulare,
                                                                                        Lingua,
                                                                                        DataArrivo,
                                                                                        DataPartenza,
                                                                                        NumeroAdulti,
                                                                                        NumeroBambini,
                                                                                        Note,
                                                                                        AbilitaInvio)
                                                            VALUES ('" . $idsito . "',
                                                                    '0',
                                                                    '" . $FontePrenotazione . "',
                                                                    '" . $DataRichiesta . "',
                                                                    '" . $TipoRichiesta . "',
                                                                    '" . addslashes($Nome). "',
                                                                    '" . addslashes($Cognome) . "',
                                                                    '" . $Email . "',
                                                                    '" . $NumeroPrenotazione . "',
                                                                    '" . $Cellulare . "',
                                                                    '" . $Lingua . "',
                                                                    '" . $DataArrivo . "',
                                                                    '" . $DataPartenza . "',
                                                                    '" . $NumeroAdulti . "',
                                                                    '" . ($NumeroBambini>0?$NumeroBambini:'') . "',
                                                                    '" . addslashes($Note) . "',
                                                                    '" . $AbilitaInvio . "')";
                                      mysqli_query($conn2,$insert);

                             } // fine foreach value


                    }// fine foeach array contenuti email

                    $syncro = "INSERT INTO hospitality_data_import(idsito,data) VALUES('".$idsito."','".date('Y-m-d H:i:s')."')";
                   mysqli_query($conn2,$syncro);

                   // azzero variabili
                   $NumeroPrenotazione = '';
                   $FontePrenotazione  = '';
                   $MessageId          = '';
                   $DataRichiesta      = '';
                   $TipoRichiesta      = '';
                   $Nome               = '';
                   $Cognome            = '';
                   $Email              = '';
                   $Cellulare          = '';
                   $Lingua             = '';
                   $DataArrivo         = '';
                   $DataPartenza       = '';
                   $NumeroAdulti       = '';
                   $NumeroBambini      = '';
                   $Note               = '';
                   $AbilitaInvio       = '';
                   $valore             = '';
                   $risultato          = '';
                   $Trattamento        = '';
                   $email_body         = '';
                   $chiave             = '';
                   $valore             = '';
                   $risultato          = '';
                   $value              = '';
                   $key                = '';
                   $val                = '';
                   $flex               = '';
                   $checkin            = '';
                   $checkout           = '';
                   $adult              = '';
                   $meal_plan          = '';
                   $d_flessibili       = '';
                   $bambini_eta_tmp    = '';
                   $plus               = '';
                   $Lingua             = '';
            }


    }// fine if tabella dei valori imap è vuota
mysqli_close($conn);
mysqli_close($conn2);
?>
