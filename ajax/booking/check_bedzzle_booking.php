<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

        $idsito        = $_REQUEST['idsito'];


        $Qcheck = "SELECT * FROM hospitality_bedzzlebooking WHERE idsito = ".$idsito." AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
        $Qquery = $dbMysqli->query($Qcheck);
        $record = $Qquery[0];

        $urlHost              = $record['UrlHost'];
        $key                  = $record['ProxyAuth']; 
        $ApiKey               = $record['VendorAccount'];
        $PropertyId           = $record['HotelAccount']; 


        $start         = $_REQUEST['start'];
        $end           = $_REQUEST['end']; 

        $adulti        = $_REQUEST['adulti'];
        $bambini       = $_REQUEST['bambini'];       
        $eta1          = $_REQUEST['eta1'];
        $eta2          = $_REQUEST['eta2'];
        $eta3          = $_REQUEST['eta3'];
        $eta4          = $_REQUEST['eta4'];
        $eta5          = $_REQUEST['eta5'];
        $eta6          = $_REQUEST['eta6'];


        $numero_camere = $_REQUEST['numero_camere'];

        $adulti2         = $_REQUEST['adulti2'];
        $bambini2        = $_REQUEST['bambini2'];
        $eta1_2          = $_REQUEST['eta1_2'];
        $eta2_2          = $_REQUEST['eta2_2'];
        $eta3_2          = $_REQUEST['eta3_2'];
        $eta4_2          = $_REQUEST['eta4_2'];
        $eta5_2          = $_REQUEST['eta5_2'];
        $eta6_2          = $_REQUEST['eta6_2'];


        $adulti3         = $_REQUEST['adulti3'];
        $bambini3        = $_REQUEST['bambini3'];        
        $eta1_3          = $_REQUEST['eta1_3'];
        $eta2_3          = $_REQUEST['eta2_3'];
        $eta3_3          = $_REQUEST['eta3_3'];
        $eta4_3          = $_REQUEST['eta4_3'];
        $eta5_3          = $_REQUEST['eta5_3'];
        $eta6_3          = $_REQUEST['eta6_3'];


        $p             = $_REQUEST['proposta'];
        $data_quoto_v2 = DATA_QUOTO_V2;

        switch($bambini){
          case 0:
          case '':
            $person = array(
              "adult"    => $adulti
              ) ;
          break;
          case 1:
            $person = array(
              "adult"    => $adulti,
              "child"    => $bambini,
              "childAge" => array($eta1)
              ) ;
          break;
          case 2:
            $person = array(
              "adult"    => $adulti,
              "child"    => $bambini,
              "childAge" => array($eta1,$eta2)
              ) ;
          break;
          case 3:
            $person = array(
              "adult"    => $adulti,
              "child"    => $bambini,
              "childAge" => array($eta1,$eta2,$eta3)
              ) ;
          break;
          case 4:
            $person = array(
              "adult"    => $adulti,
              "child"    => $bambini,
              "childAge" => array($eta1,$eta2,$eta3,$eta4)
              ) ;
          break;
          case 5:
            $person = array(
              "adult"    => $adulti,
              "child"    => $bambini,
              "childAge" => array($eta1,$eta2,$eta3,$eta4,$eta5)
              ) ;
          break;
          case 6:
            $person = array(
              "adult"    => $adulti,
              "child"    => $bambini,
              "childAge" => array($eta1,$eta2,$eta3,$eta4,$eta5,$eta6)
              ) ;
          break;
        }
        switch($numero_camere){
          case 2:
            if($bambini2 == '' || $bambini2 == 0){
              $person2 = array(
                "adult"    => $adulti2
                ) ;
            }
            if($bambini2==1){
              $person2 = array(
                "adult"    => $adulti2,
                "child"    => $bambini2,
                "childAge" => array($eta1_2)
                ) ;
            }
            if($bambini2==2){
              $person2 = array(
                "adult"    => $adulti2,
                "child"    => $bambini2,
                "childAge" => array($eta1_2, $eta2_2)
                ) ;
            }
            if($bambini2==3){
              $person2 = array(
                "adult"    => $adulti2,
                "child"    => $bambini2,
                "childAge" => array($eta1_2, $eta2_2, $eta3_2)
                ) ;
            }
            if($bambini2==4){
              $person2 = array(
                "adult"    => $adulti2,
                "child"    => $bambini2,
                "childAge" => array($eta1_2, $eta2_2, $eta3_2, $eta4_2)
                ) ;
            }
            if($bambini2==5){
              $person2 = array(
                "adult"    => $adulti2,
                "child"    => $bambini2,
                "childAge" => array($eta1_2, $eta2_2, $eta3_2, $eta4_2, $eta5_2)
                ) ;
            }
            if($bambini2==6){
              $person2 = array(
                "adult"    => $adulti2,
                "child"    => $bambini2,
                "childAge" => array($eta1_2, $eta2_2, $eta3_2, $eta4_2, $eta5_2, $eta6_2)
                ) ;
            }
          break;
          case 3:
            if($bambini3 == '' || $bambini3 == 0){
              $person3 = array(
                "adult"    => $adulti3
                ) ;
            }
            if($bambini3==1){
              $person3 = array(
                "adult"    => $adulti3,
                "child"    => $bambini3,
                "childAge" => array($eta1_3)
                ) ;
            }
            if($bambini3==2){
              $person3 = array(
                "adult"    => $adulti3,
                "child"    => $bambini3,
                "childAge" => array($eta1_3, $eta2_3)
                ) ;
            }
            if($bambini3==3){
              $person3 = array(
                "adult"    => $adulti3,
                "child"    => $bambini3,
                "childAge" => array($eta1_3, $eta2_3, $eta3_3)
                ) ;
            }
            if($bambini3==4){
              $person3 = array(
                "adult"    => $adulti3,
                "child"    => $bambini3,
                "childAge" => array($eta1_3, $eta2_3, $eta3_3, $eta4_3)
                ) ;
            }
            if($bambini3==5){
              $person3 = array(
                "adult"    => $adulti3,
                "child"    => $bambini3,
                "childAge" => array($eta1_3, $eta2_3, $eta3_3, $eta4_3, $eta5_3)
                ) ;
            }
            if($bambini3==6){
              $person3 = array(
                "adult"    => $adulti3,
                "child"    => $bambini3,
                "childAge" => array($eta1_3, $eta2_3, $eta3_3, $eta4_3, $eta5_3, $eta6_3)
                ) ;
            }

          break;
          default:
            $person2 = '';
            $person3 = '';
          break;
        }

        if($numero_camere==1){
          $array_person = array($person);
        }elseif($numero_camere==2){
          $array_person =array($person,$person2);
        }elseif($numero_camere==3){
          $array_person =array($person,$person2,$person3);
        }

        $data = array(  "propertyIds"  => array($PropertyId),    
                        "checkInDate"  => "".$start."",
                        "checkOutDate" => "".$end."",
                        "allocations"  =>  $array_person,
                          "userData" => array(
                                              "deviceType"        => "desktop",                
                                              "referrer"          => null,                     
                                              "httpCustomParam"   => null,                     
                                              "language"          => "it",                      
                                              "currency"          => "EUR",                     
                                              "couponCode"        => null                      
                                              ),                      
                        "requestedPayload" => array(                     
                                                    "roomTypeDetails"   => false,                     
                                                    "ratePlanDetails"   => false,                      
                                                    "roomRateDetails"   => false,                      
                                                    "policiesDetails"   => false,                     
                                                    "supplementDetails" => false,                      
                                                    "offerDetails"      => false,                     
                                                    "photos"            => false,                      
                                                    "text"              => false                      
                                                    )
                      );


        $data_string = json_encode($data);

                $ch = curl_init($urlHost.'pms/property/booking_engine/availabilities?key='.$key.'&propertyId='.$PropertyId.'');                                                                      
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                          
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type:      application/json',                                                                                
                'Content-Length:   ' .strlen($data_string),  
                'X-API-KEY: '.$ApiKey));
                $res = curl_exec($ch);

                $risultato = json_decode($res);

                foreach($risultato->data->properties as $key => $value){
                 
                    foreach($value->available->roomRates as $ky => $val){
  
                        foreach($val->result as $k => $vl){

                          $riga_camere[$vl->signature][] = array('CAMERA' => $vl->roomId,'SOGG' => $vl->rateId,'TOTALE' => $vl->totalPrice);  
                        
                        }

                    }

                }
     
    
             if($riga_camere != ''){
                  echo'<style>
                        @media screen and (max-width: 767px) {
                            #etichette{
                                display:none!important;
                            }
                        }
                      </style>';

                   echo' 
                        </div>
                        <div class="row">
                        <div class="col-md-1"></div>
                            <div class="col-md-10">
                              <small>
                                <i class="fa fa-exclamation-triangle text-red"></i> <b>ATTENZIONE</b>: scegli la tipologia di camera che desideri <b>INCLUSA</b> nella proposta! Clicca sul pulsante <b>Conferma la scelta</b>!! <img src="'.BASE_URL_SITO.'img/pul.png" style="width:100px;height:auto">
                              </small> 
                              <br>
                              <small>
                                  <i class="fa fa-exclamation text-red"></i> <b>ATTENZIONE</b>: il cliente può accettare le proposte(1,2,3,4,5) e non le camere di ogni proposta!
                              </small>
                              <br>
                              <small>
                                La proposta di soggiorno può essere composta: 
                                  <ul>
                                    <li>Solo da risultati di <img src="'.BASE_URL_SITO.'img/powered-bedzzleb.png" style="text-align:absmiddle;width:auto;height:20px">. </li>
                                    <li>Da righe di <img src="'.BASE_URL_SITO.'img/powered-bedzzleb.png" style="text-align:absmiddle;width:auto;height:20px"> + righe compilate con la maschera di <b>QUOTO!</b> </li>
                                    <li>Non scegliendo nessuna camera di <img src="'.BASE_URL_SITO.'img/powered-bedzzleb.png" style="text-align:absmiddle;width:auto;height:20px">, solo da righe compilate con la maschera di <b>QUOTO!</b></li>
                                    <li><i class="fa fa-life-ring text-orange"></i> Se avete filtrato i risultati <b>per più camere con più bambini</b>, ricordarsi di aggiornare i dati numerici del campo bambini e le loro rispettive età!</li>
                                  </ul>
                              </small>
                            </div>
                            <div class="col-md-1">

                                <div class="modal fade" id="AlertNrCamE'.$p.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-red"></i> <b>ATTENZIONE</b> <small><i class="fa fa-arrow-right "></i></small> verifica:</h4>
                                      </div>
                                      <div class="modal-body">
                                        <h4>I risultati ottenuti da <img src="'.BASE_URL_SITO.'img/powered-bedzzleb.png" style="text-align:absmiddle;width:auto;height:20px"> sono verificati per 
                                            <span class="fa-stack ">
                                                <i class="fa fa-circle-o fa-stack-2x"></i>
                                                <strong class="fa-stack-1x">1</strong>
                                            </span> Nr.Camera</h4>
                                            <ul>
                                              <li>Modificando il numero di camere...; <b>QUOTO!</b> ne calcola il prezzo, ma <span class="text-red">non tiene<br>in considerazione le possibili tariffe  scontate</span> sul Booking Engine!!</li>
                                              <li>Una volta modifcato il numero di camere il valore del prezzo impostato non dipende più da <img src="'.BASE_URL_SITO.'img/powered-bedzzleb.png" style="text-align:absmiddle;width:auto;height:20px">, per tornare al prezzo originale ri-cliccate <img src="'.BASE_URL_SITO.'img/pul_book_ericsoft.png"></li>
                                            </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                            </div>
                        </div><br>';

                  echo'<div class="row">';              
                  echo'   <div class="col-md-6"></div>
                          <div class="col-md-6 text-right" style="padding-right:50px!important;"><button type="button" class="btn btn-primary conferma">Conferma la scelta</button></div>
                        </div>
                        <br>';

                   echo'<div class="row" id="etichette">        
                          <div class="col-md-'.(date('Y-m-d') > $data_quoto_v2?'3':'4').'"><b>Tipo Soggiorno</b></div>
                          <div class="col-md-'.(date('Y-m-d') > $data_quoto_v2?'3':'4').'"><b>Tipo Camera</b></div>';
                           if(date('Y-m-d') > $data_quoto_v2){ 
                            echo' <div class="col-md-1 text-center"><b>A</b></div>
                                  <div class="col-md-1 text-center"><b>B</b></div>';
                           }
                  echo'  <div class="col-md-3"><b>Prezzo</b> <small>0000.00</small></div>
                          <div class="col-md-1"><b>Scegli</b></div>
                         </div>
                         <br>';

                    echo'<script>
                           $( document ).ready(function() {


                              $(".calc").keyup(function(){ 
                                var uno = $(this).val();
                                var due = $(this).parent().parent().find(".prezzo'.$p.'").val();
                                var prodotto = uno*due;
                                $(this).parent().parent().find(".prezzo'.$p.'").val(prodotto);
                                if(uno != 1){
                                  $("#AlertNrCamE'.$p.'").modal("show");
                                }                                 
                              });

                              $(\'[data-toogle="tooltip"]\').tooltip();

                            });
                          </script>';   

                
                 
                  $i = 1;
                  for($i==1; $i<=20; $i++){
                    $numero_adulti .='<option value="'.$i.'" '.($i==$adulti?'selected="selected"':'').'>'.$i.'</option>';
                  }

                  $x = 1;
                  for($x==1; $x<=6; $x++){
                     $numero_bimbi .='<option value="'.$x.'" '.($x==$bambini?'selected="selected"':'').'>'.$x.'</option>';
                  }
                  $idroom = '';
                  $idrate = '';
                  $row    = '';
                  $rows   = '';
                  $rec    = '';

                  if(!empty($riga_camere) && !is_null($riga_camere)){
                    $n_righe = 1;
                    foreach ($riga_camere as $k => $rec) {

                                                
                        $tmp = explode("_",$k);

                        $n_camere = $tmp[0];
                        $idroom   = $tmp[1];
                        $idrate   = $tmp[2];

                        if($idroom!='' && $idrate!=''){ 
      
                            // Query e ciclo per estrapolare i dati di tipologia soggiorno
                            $c   = "SELECT * FROM hospitality_tipo_soggiorno WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = ".$idsito." AND PlanCode = '".$idrate."'";
                            $s   = $dbMysqli->query($c);
                            $row = $s[0];   
                            $tot_s = sizeof($s); 
                            // Query e ciclo per estrapolare i dati di tipologia soggiorno
                            $cc   = "SELECT * FROM hospitality_tipo_camere WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = ".$idsito." AND RoomCode = ".$idroom;
                            $ss   = $dbMysqli->query($cc);
                            $rows = $ss[0]; 
                            $tot_c = sizeof($ss);
                                                      
                          if(($tot_s > 0) && ($tot_c > 0)){
      
                              $n = $n+$n;
                              foreach ($rec as $kk => $record) {

                                
                                    $n_righe = ($n_righe+$n);
                                        echo'
                                              <div class="row nascondi" id="riga_'.$p.'_'.$n_righe.'_'.$n.'">             
                                                <div class="col-md-'.(date('Y-m-d') > $data_quoto_v2?'3':'4').'" >
                                                    <input type="hidden" value="" name="idrichiesta'.$p.'[]">
                                                    <input  type="hidden" name="NumeroCamere'.$p.'[]" id="NumeroCamere_'.$p.'_'.$n_righe.'" class="f-12 form-control calc text-center" value="1" style="font-size:80%;height:calc(2.25rem + 2px);"> 
                                                    <input type="hidden" name="TipoSoggiorno'.$p.'[]" id="TipoSoggiorno_'.$p.'_'.$n_righe.'"  value="'.$row['Id'].'"><i class="fa fa-angle-right"></i> <span class="text-orange f-11">'.$row['TipoSoggiorno'].'</span>
                                                    '.($record['DISCOUNTED']==1?'<br><div style="padding-left:20px"><small><i class="fa fa-trophy"></i> <b class="text-info f-11"><em>Offerta</em></b></small></div>':'').'                                 
                                                </div> 
                                                <div class="col-md-'.(date('Y-m-d') > $data_quoto_v2?'3':'4').'">
                                                  <i class="fa fa-key"></i> <input type="hidden" name="TipoCamere'.$p.'[]" id="TipoCamere_'.$p.'_'.$n_righe.'" value="'.$rows['Id'].'"><span class="text-green f-11">'.$rows['TipoCamere'].'</span>
                                                </div> '; 
                                          if(date('Y-m-d') > $data_quoto_v2){ 
                                                echo'   <div class="col-md-1">  
                                                            <i class="fa fa-male" style="position:absolute; top:10px;left:-2px;"></i>                    
                                                            <select name="NumAdulti'.$p.'[]" id="NumeroAdulti_'.$p.'_'.$n_righe.'" class="form-control f-12" style="font-size:80%">
                                                                <option value="" selected="selected">--</option>
                                                                  '.$numero_adulti.'
                                                            </select>
                                                        </div>
                      
                                                        <div class="col-md-1">
                                                            <i class="fa fa-child" style="position:absolute; top:10px;left:-2px;"></i> 
                                                            <select name="NumBambini'.$p.'[]" id="NumeroBambini_'.$p.'_'.$n_righe.'"
                                                                class="NumeroBambini_sb_'.$p.'_'.$n_righe.' form-control f-12" style="font-size:80%" onchange="eta_bimbi_sb(\''.$p.'_'.$n_righe.'\');">
                                                                <option value="" selected="selected">--</option>
                                                                  '.$numero_bimbi.'
                                                            </select>
                                                            <div class="EtaBambini_sb'.$p.'_'.$n_righe.'" id="EtaB_'.$p.'_'.$n_righe.'" style="display:none">
                                                                <input type="text"  name="EtaB'.$p.'[]" placeholder="Età: 1,2,3" class="f-12 form-control" style="font-size:80%" value="'.($eta1==''?'':$eta1).''.($eta2==''?'':','.$eta2).''.($eta3==''?'':','.$eta3).''.($eta4==''?'':','.$eta4).''.($eta5==''?'':','.$eta5).''.($eta6==''?'':','.$eta6).'">
                                                            </div> 
                                                        </div>';

                                                echo'<script>
                                                        $( document ).ready(function() {                                      
                                                            if($("#NumeroBambini_'.$p.'_'.$n_righe.'").val() != \'\'){
                                                              $("#EtaB_'.$p.'_'.$n_righe.'").attr("style","display:block");
                                                            }else{
                                                              $("#EtaB_'.$p.'_'.$n_righe.'").attr("style","display:none");
                                                            }
                                                        });
                                                      </script>';
                                          }        
                                          echo'   <div class="col-md-3">
                                                      <div class="input-group">                                                    
                                                        <span class="input-group-addon"><i class="fa fa-euro"></i></span>                          
                                                        <input type="text" name="Prezzo'.$p.'[]" id="Prezzo_'.$p.'_'.$n_righe.'"  class="prezzo'.$p.' form-control f-12" placeholder="0000.00" value="'.$record['TOTALE'].'">
                                                      </div>
                                                  </div>
                                                  <div class="col-md-1">
                                                  <input type="checkbox" name="chec_eb_'.$p.'[]" id="chec_eb_'.$p.'_'.$n_righe.'_'.$n.'" class="check_scelta">
                                                  </div>   
                                                  <div style="clear:both;height:4px"></div>                                            
                                              </div>';

                                              $righe .= '
                                                          if($("#chec_eb_'.$p.'_'.$n_righe.'_'.$n.'").prop(\'checked\')==false) {
                                                              $("#riga_'.$p.'_'.$n_righe.'_'.$n.'").remove();                                                    
                                                          } 
                                                        '."\r\n";                                                                                                                   
                                $n++;  
                              }     // fine ciclo

                          }     // se soggiorni e camere sono stati inseriti nella tablla DB

                        }       // se idroom e idrate non sono vuoti

                        $n_righe++;  

                      }         // fine ciclo
                                          
                    }         // fse array riga_camere non è vuoto
                  echo'<script>
                          $( document ).ready(function() {            
                            $(".conferma").on("click",function(){ 
                                '.$righe.'
                                calcola_totale'.$p.'();
                                $(".conferma").text(\'Scelta effettuata!\');
                                $(".conferma").removeClass(\'btn-primary\');
                                $(".conferma").addClass(\'btn-warning\');
                             });                    
                          });
                      </script>';                  
                  echo'<div class="row">';              
                  echo'   <div class="col-md-6"></div>
                          <div class="col-md-6 text-right" style="padding-right:50px!important;"><button type="button" class="btn btn-primary conferma">Conferma la scelta</button></div>
                       </div>
                       <br>';
              }else{

                echo'<h4>
                      <div class="text-center text-red"> Nessun risultato!</div>
                      <div class="text-center">
                        <i class="fa fa-arrow-down" aria-hidden="true"></i><br>
                        Crea Proposta Soggiorno con QUOTO!
                      </div>
                    </h4>';

              }  


       


?>