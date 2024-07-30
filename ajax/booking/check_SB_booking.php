<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


        $idsito        = $_REQUEST['idsito'];
        $promotionCode = $_REQUEST['promotionCode']; 
        $start         = $_REQUEST['start']; 
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

        $p             = $_REQUEST['proposta'];
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


        $data_quoto_v2 = DATA_QUOTO_V2;

        $Qcheck = "SELECT * FROM hospitality_simplebooking WHERE idsito = ".$idsito." AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
        $Qquery = $dbMysqli->query($Qcheck);
        $record = $Qquery[0];


              // terza chiamata QUERY
          $xml3 ='<OTA_HotelAvailRQ PrimaryLangID="it-IT" xmlns="http://www.opentravel.org/OTA/2003/05"  Target="Production" Version="1.0">
                  <AvailRequestSegments>
                      <AvailRequestSegment>
                          <StayDateRange Start="'.$start.'" End="'.$end.'" />';
        if($promotionCode != ''){
          $xml3 .='       <RatePlanCandidates>
                            <RatePlanCandidate PromotionCode="'.$promotionCode.'" />
                          </RatePlanCandidates>'; 
        }
          $xml3 .='       <RoomStayCandidates>';
   
          $xml3 .='         <RoomStayCandidate>
                                  <GuestCounts>
                                      <GuestCount AgeQualifyingCode="10.AQC" Count="'.$adulti.'" />';

                                      if($bambini != '' && $bambini == 1){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1=='' || $eta1=='< 1'?0:$eta1).'" Count="1"/>';
                                      }
                                      if($bambini != '' && $bambini == 2){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1=='' || $eta1=='< 1'?0:$eta1).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2=='' || $eta2=='< 1'?0:$eta2).'" Count="1"/>';
                                      }
                                      if($bambini != '' && $bambini == 3){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1=='' || $eta1=='< 1'?0:$eta1).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2=='' || $eta2=='< 1'?0:$eta2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3=='' || $eta3=='< 1'?0:$eta3).'" Count="1"/>';
                                      }
                                      if($bambini != '' && $bambini == 4){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1=='' || $eta1=='< 1'?0:$eta1).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2=='' || $eta2=='< 1'?0:$eta2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3=='' || $eta3=='< 1'?0:$eta3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta4=='' || $eta4=='< 1'?0:$eta4).'" Count="1"/>';
                                      }   
                                      if($bambini != '' && $bambini == 5){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1=='' || $eta1=='< 1'?0:$eta1).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2=='' || $eta2=='< 1'?0:$eta2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3=='' || $eta3=='< 1'?0:$eta3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta4=='' || $eta4=='< 1'?0:$eta4).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta5=='' || $eta5=='< 1'?0:$eta5).'" Count="1"/>';
                                      }                                        
                                      if($bambini != '' && $bambini == 6){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1=='' || $eta1=='< 1'?0:$eta1).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2=='' || $eta2=='< 1'?0:$eta2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3=='' || $eta3=='< 1'?0:$eta3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta4=='' || $eta4=='< 1'?0:$eta4).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta5=='' || $eta5=='< 1'?0:$eta5).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta6=='' || $eta6=='< 1'?0:$eta6).'" Count="1"/>';
                                      }                                        
          $xml3 .='           </GuestCounts>
                            </RoomStayCandidate>';

    if($numero_camere==2){                        
          $xml3 .='         <RoomStayCandidate>
                                  <GuestCounts>
                                      <GuestCount AgeQualifyingCode="10.AQC" Count="'.$adulti2.'" />';

                                      if($bambini2 != '' && $bambini2 == 1){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_2=='' || $eta1_2=='< 1'?0:$eta1_2).'" Count="1"/>';
                                      }
                                      if($bambini2 != '' && $bambini2 == 2){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_2=='' || $eta1_2=='< 1'?0:$eta1_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_2=='' || $eta2_2=='< 1'?0:$eta2_2).'" Count="1"/>';
                                      }
                                      if($bambini2 != '' && $bambini2 == 3){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_2=='' || $eta1_2=='< 1'?0:$eta1_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_2=='' || $eta2_2=='< 1'?0:$eta2_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3_2=='' || $eta3_2=='< 1'?0:$eta3_2).'" Count="1"/>';
                                      }
                                      if($bambini2 != '' && $bambini2 == 4){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_2=='' || $eta1_2=='< 1'?0:$eta1_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_2=='' || $eta2_2=='< 1'?0:$eta2_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3_2=='' || $eta3_2=='< 1'?0:$eta3_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta4_2=='' || $eta4_2=='< 1'?0:$eta4_2).'" Count="1"/>';
                                      }   
                                      if($bambini2 != '' && $bambini2 == 5){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_2=='' || $eta1_2=='< 1'?0:$eta1_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_2=='' || $eta2_2=='< 1'?0:$eta2_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3_2=='' || $eta3_2=='< 1'?0:$eta3_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta4_2=='' || $eta4_2=='< 1'?0:$eta4_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta5_2=='' || $eta5_2=='< 1'?0:$eta5_2).'" Count="1"/>';
                                      }                                        
                                      if($bambini2 != '' && $bambini2 == 6){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_2=='' || $eta1_2=='< 1'?0:$eta1_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_2=='' || $eta2_2=='< 1'?0:$eta2_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3_2=='' || $eta3_2=='< 1'?0:$eta3_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta4_2=='' || $eta4_2=='< 1'?0:$eta4_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta5_2=='' || $eta5_2=='< 1'?0:$eta5_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta6_2=='' || $eta6_2=='< 1'?0:$eta6_2).'" Count="1"/>';
                                      }                                        
          $xml3 .='           </GuestCounts>
                            </RoomStayCandidate>';   
     } 

    if($numero_camere==3){ 
          $xml3 .='         <RoomStayCandidate>
                                  <GuestCounts>
                                      <GuestCount AgeQualifyingCode="10.AQC" Count="'.$adulti2.'" />';

                                      if($bambini2 != '' && $bambini2 == 1){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_2=='' || $eta1_2=='< 1'?0:$eta1_2).'" Count="1"/>';
                                      }
                                      if($bambini2 != '' && $bambini2 == 2){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_2=='' || $eta1_2=='< 1'?0:$eta1_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_2=='' || $eta2_2=='< 1'?0:$eta2_2).'" Count="1"/>';
                                      }
                                      if($bambini2 != '' && $bambini2 == 3){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_2=='' || $eta1_2=='< 1'?0:$eta1_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_2=='' || $eta2_2=='< 1'?0:$eta2_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3_2=='' || $eta3_2=='< 1'?0:$eta3_2).'" Count="1"/>';
                                      }
                                      if($bambini2 != '' && $bambini2 == 4){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_2=='' || $eta1_2=='< 1'?0:$eta1_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_2=='' || $eta2_2=='< 1'?0:$eta2_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3_2=='' || $eta3_2=='< 1'?0:$eta3_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta4_2=='' || $eta4_2=='< 1'?0:$eta4_2).'" Count="1"/>';
                                      }   
                                      if($bambini2 != '' && $bambini2 == 5){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_2=='' || $eta1_2=='< 1'?0:$eta1_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_2=='' || $eta2_2=='< 1'?0:$eta2_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3_2=='' || $eta3_2=='< 1'?0:$eta3_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta4_2=='' || $eta4_2=='< 1'?0:$eta4_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta5_2=='' || $eta5_2=='< 1'?0:$eta5_2).'" Count="1"/>';
                                      }                                        
                                      if($bambini2 != '' && $bambini2 == 6){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_2=='' || $eta1_2=='< 1'?0:$eta1_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_2=='' || $eta2_2=='< 1'?0:$eta2_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3_2=='' || $eta3_2=='< 1'?0:$eta3_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta4_2=='' || $eta4_2=='< 1'?0:$eta4_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta5_2=='' || $eta5_2=='< 1'?0:$eta5_2).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta6_2=='' || $eta6_2=='< 1'?0:$eta6_2).'" Count="1"/>';
                                      }                                        
          $xml3 .='           </GuestCounts>
                            </RoomStayCandidate>';                       
          $xml3 .='         <RoomStayCandidate>
                                  <GuestCounts>
                                      <GuestCount AgeQualifyingCode="10.AQC" Count="'.$adulti3.'" />';


                                      if($bambini3 != '' && $bambini3 == 1){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_3=='' || $eta1_3=='< 1'?0:$eta1_3).'" Count="1"/>';
                                      }
                                      if($bambini3 != '' && $bambini3 == 3){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_3=='' || $eta1_3=='< 1'?0:$eta1_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_3=='' || $eta2_3=='< 1'?0:$eta2_3).'" Count="1"/>';
                                      }
                                      if($bambini3 != '' && $bambini3 == 3){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_3=='' || $eta1_3=='< 1'?0:$eta1_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_3=='' || $eta2_3=='< 1'?0:$eta2_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3_3=='' || $eta3_3=='< 1'?0:$eta3_3).'" Count="1"/>';
                                      }
                                      if($bambini3 != '' && $bambini3 == 4){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_3=='' || $eta1_3=='< 1'?0:$eta1_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_3=='' || $eta2_3=='< 1'?0:$eta2_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3_3=='' || $eta3_3=='< 1'?0:$eta3_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta4_3=='' || $eta4_3=='< 1'?0:$eta4_3).'" Count="1"/>';
                                      }   
                                      if($bambini3 != '' && $bambini3 == 5){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_3=='' || $eta1_3=='< 1'?0:$eta1_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_3=='' || $eta2_3=='< 1'?0:$eta2_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3_3=='' || $eta3_3=='< 1'?0:$eta3_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta4_3=='' || $eta4_3=='< 1'?0:$eta4_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta5_3=='' || $eta5_3=='< 1'?0:$eta5_3).'" Count="1"/>';
                                      }                                        
                                      if($bambini3 != '' && $bambini3 == 6){
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta1_3=='' || $eta1_3=='< 1'?0:$eta1_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta2_3=='' || $eta2_3=='< 1'?0:$eta2_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta3_3=='' || $eta3_3=='< 1'?0:$eta3_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta4_3=='' || $eta4_3=='< 1'?0:$eta4_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta5_3=='' || $eta5_3=='< 1'?0:$eta5_3).'" Count="1"/>';
                                        $xml3 .='<GuestCount AgeQualifyingCode="8.AQC" Age="'.($eta6_3=='' || $eta6_3=='< 1'?0:$eta6_3).'" Count="1"/>';
                                      }                                        
          $xml3 .='           </GuestCounts>
                            </RoomStayCandidate>';   
     }                 
          $xml3 .='     </RoomStayCandidates>
                          <TPA_Extensions>
                                   <provider Name="'.$record['UserProvider'].'" Pwd="'.$record['PasswordProvider'].'" />
                                   <XMLHotelAgent Name="'.$record['UserHotel'].'" Pwd="'.$record['PasswordHotel'].'" />
                                 <Filter HotelCode="'.$record['IdHotel'].'" />
                          </TPA_Extensions>
                      </AvailRequestSegment>
                  </AvailRequestSegments>
              </OTA_HotelAvailRQ>';               
              
              $dati3 = ($xml3);
              $fp3 = fopen(BASE_PATH_SITO.'uploads/'.$idsito.'/query.xml','w');
              $ch3 = curl_init();
              $url3 = 'http://xml.simplebooking.it/xmlservice.asmx/HotelAvailRQ';
              curl_setopt($ch3, CURLOPT_URL, $url3);
              curl_setopt($ch3, CURLOPT_POST, true);
              curl_setopt($ch3, CURLOPT_POSTFIELDS, $dati3);
              curl_setopt($ch3, CURLOPT_FILE, $fp3);
              curl_exec($ch3);
              
              $risultati = simplexml_load_file(BASE_PATH_SITO.'uploads/'.$idsito.'/query.xml', 'SimpleXMLElement', LIBXML_NOCDATA) or die("Error: Cannot create object");
              $value = '';
              $val = '';
              $TotaleCamera = '';


/*               echo'<pre>';
              var_dump($risultati);
              echo'</pre>'; */

              foreach($risultati as $key => $value){

                foreach($value as $ky => $val){
                
                      $Trattamento = $val->RatePlans->RatePlan->RatePlanDescription['Name'];

                      $RoomCode = $val->RoomTypes->RoomType['RoomTypeCode'];

                      $RoomName = $val->RoomTypes->RoomType->RoomDescription['Name'];        
      
                      $TipoSogg = $val->RatePlans->RatePlan->MealsIncluded['MealPlanCodes'];       
      
                      $TotaleCamera = $val->Total['AmountAfterTax'];
      
                      $unita = $val->RoomRates->RoomRate->Rates->Rate['NumberOfUnits'];
                      
                      $DescriptionDiscount = $val->RoomRates->RoomRate->Rates->Rate->Discount->DiscountReason->Text;

                      $riga_camere[$RoomCode.'_'.$TipoSogg][] = array('TRATTAMENTO' => $Trattamento,'DISCOUNTDESCR' => $DescriptionDiscount, 'CAMERA' => $RoomName,'SOGG' => $TipoSogg,'TOTALE' => $TotaleCamera,'UNITA'=>$unita);  
                   
                }
              
              } 
/*               echo'<pre>';
              var_dump($riga_camere);
              echo'</pre>';   */

              if($riga_camere != ''){
                  echo'<style>
                        @media screen and (max-width: 767px) {
                            #etichette{
                                display:none!important;
                            }
                        }
                        .nascondi select.form-control{
                          padding:0px 0px 0px 0px !important;
                        }
                      </style>';


                   echo'  
                        </div>
                        <div class="row">
                        <div class="col-md-1"></div>
                            <div class="col-md-10">
                             <small>
                              <i class="fa fa-exclamation-triangle text-red"></i> <b>ATTENZIONE</b>: scegli la tipologia di camera che desideri <b>INCLUSA</b> nella proposta! Clicca sul pulsante <b>Conferma la scelta</b>!!
                            </small>
                            <br> 
                            <small>
                                <i class="fa fa-exclamation-triangle text-red"></i> <b>ATTENZIONE</b>: il cliente può accettare le proposte(1,2,3,4,5) e non le camere di ogni proposta!
                            </small>
                            <br> 
                              <small>
                                La proposta di soggiorno può essere composta: 
                                  <ul>
                                    <li>Solo da risultati di <img src="'.BASE_URL_SITO.'img/powered-sb.png">. </li>
                                    <li>Da righe di <img src="'.BASE_URL_SITO.'img/powered-sb.png"> + righe compilate con la maschera di <b>QUOTO!</b> </li>
                                    <li>Non scegliendo nessuna camera di <img src="'.BASE_URL_SITO.'img/powered-sb.png">, solo da righe compilate con la maschera di <b>QUOTO!</b></li>
                                  </ul>
                              </small>
                            </div>
                            <div class="col-md-1">

                                <div class="modal fade" id="AlertNrCam'.$p.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle text-red"></i> <b>ATTENZIONE</b> <small><i class="fa fa-arrow-right "></i></small> verifica:</h5>
                                      </div>
                                      <div class="modal-body">
                                        <h5 class="f-14">I risultati ottenuti da <img src="'.BASE_URL_SITO.'img/powered-sb.png"> sono verificati per 
                                            <span class="fa-stack ">
                                                <i class="fa fa-circle-o fa-stack-2x"></i>
                                                <strong class="fa-stack-1x">1</strong>
                                            </span> Nr.Camera</h5>
                                            <ul>
                                              <li>Modificando il numero di camere...; <b>QUOTO!</b> ne calcola il prezzo, ma <span class="text-red">non tiene<br>in considerazione le possibili tariffe  scontate</span> sul Booking Engine!!</li>
                                              <li>Una volta modifcato il numero di camere il valore del prezzo impostato non dipende più da <img src="'.BASE_URL_SITO.'img/powered-sb.png">, per tornare al prezzo originale ri-cliccate <img src="'.BASE_URL_SITO.'img/pul_book.png"></li>
                                            </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                            </div>
                        </div><br>';

                  echo'<div class="row">';              
                  echo'   <div class="col-md-6"></div>
                          <div class="col-md-6 text-right" style="padding-right:50px!important;"><button type="button" class="btn btn-primary btn-sm conferma">Conferma la scelta</button></div>
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
                                  $("#AlertNrCam'.$p.'").modal("show");
                                }                                 
                              });

                              $(\'[data-toogle="tooltip"]\').tooltip();

                            });
                          </script>';   

                  $n_righe = 1;

                  $i = 1;
                  for($i==1; $i<=20; $i++){
                    $numero_adulti .='<option value="'.$i.'" '.($i==$adulti?'selected="selected"':'').'>'.$i.'</option>';
                  }

                  $x = 1;
                  for($x==1; $x<=6; $x++){
                     $numero_bimbi .='<option value="'.$x.'" '.($x==$bambini?'selected="selected"':'').'>'.$x.'</option>';
                  }
        
                  ksort($riga_camere,SORT_STRING);
                  foreach ($riga_camere as $k => $rec) {


                      $tmp = explode("_",$k);
                      $idroom = $tmp[0];
                      $plancode = explode(".",$tmp[1]);
                      $soggiorno = $plancode[1].'.'.$plancode[0];

                      // Query e ciclo per estrapolare i dati di tipologia soggiorno
                      $c   = "SELECT * FROM hospitality_tipo_soggiorno WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = ".$idsito." AND PlanCode = '".$soggiorno."'";
                      $s   = $dbMysqli->query($c);
                      $row = $s[0];   
                      $tot_s = sizeof($s); 

                       // Query e ciclo per estrapolare i dati di tipologia soggiorno
                      $cc   = "SELECT * FROM hospitality_tipo_camere WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = ".$idsito." AND RoomCode = ".$idroom;
                      $ss   = $dbMysqli->query($cc);
                      $rows = $ss[0]; 
                      $tot_c = sizeof($ss);
                                                 
                      if(($tot_s > 0) && ($tot_c > 0)){

                        $n = 1;

                       if($numero_camere==1){

                          foreach ($rec as $kk => $record) {

                              echo'
                                    <div class="row nascondi" id="riga_'.$p.'_'.$n_righe.'_'.$n.'">  
                                      <div class="col-md-'.(date('Y-m-d') > $data_quoto_v2?'3':'4').'" >
                                          <input type="hidden" value="" name="idrichiesta'.$p.'[]">
                                          <input type="hidden" name="TipoSoggiorno'.$p.'[]" id="TipoSoggiorno_'.$p.'_'.$n_righe.'"  value="'.$row['Id'].'"><i class="fa fa-angle-right"></i> <span class="text-orange f-12">'.$row['TipoSoggiorno'].'</span><br><div style="padding-left:20px"><small><i class="fa fa-trophy"></i> <b class="text-info"><em>TariffaSB:</em> '.$record['TRATTAMENTO'].'</b> <i class="fa fa-angle-right"></i> <span class="text-maroon">'.$record['DISCOUNTDESCR'].'</span></small></div>                                 
                                      </div>
                                      <div class="col-md-'.(date('Y-m-d') > $data_quoto_v2?'3':'4').'">
                                        <input  type="hidden" name="NumeroCamere'.$p.'[]" id="NumeroCamere_'.$p.'_'.$n_righe.'" class="f-12 form-control calc text-center" value="'.$record['UNITA'].'" style="font-size:80%;height:calc(2.25rem + 2px);"> 
                                        <i class="fa fa-key"></i> <input type="hidden" name="TipoCamere'.$p.'[]" id="TipoCamere_'.$p.'_'.$n_righe.'" value="'.$rows['Id'].'"><span class="text-green f-12">'.$rows['TipoCamere'].'</span>
                                      </div>'; 
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
                                            <select name="NumBambini'.$p.'[]" id="NumeroBambini_'.$p.'_'.$n_righe.'_'.$n.'"
                                                class="NumeroBambini_sb_'.$p.'_'.$n_righe.' form-control f-12" style="font-size:80%" onchange="eta_bimbi_sb(\''.$p.'_'.$n_righe.'\');">
                                                <option value="" selected="selected">--</option>
                                                  '.$numero_bimbi.'
                                            </select>
                                            <div class="EtaBambini_sb'.$p.'_'.$n_righe.'" id="EtaB_'.$p.'_'.$n_righe.'_'.$n.'" style="display:none">
                                                <input type="text"  name="EtaB'.$p.'[]" placeholder="Età: 1,2,3" class="form-control f-12" style="font-size:80%" value="'.($eta1==''?'':$eta1).''.($eta2==''?'':','.$eta2).''.($eta3==''?'':','.$eta3).''.($eta4==''?'':','.$eta4).''.($eta5==''?'':','.$eta5).''.($eta6==''?'':','.$eta6).'">
                                            </div> 
                                        </div>';

                                echo'<script>
                                        $( document ).ready(function() {                                      
                                            if($("#NumeroBambini_'.$p.'_'.$n_righe.'_'.$n.'").val() != \'\'){
                                              $("#EtaB_'.$p.'_'.$n_righe.'_'.$n.'").attr("style","display:block");
                                            }else{
                                              $("#EtaB_'.$p.'_'.$n_righe.'_'.$n.'").attr("style","display:none");
                                            }
                                        });
                                      </script>';
                          }        
                                echo'   <div class="col-md-3">                    
                                              <input type="text" name="Prezzo'.$p.'[]" id="Prezzo_'.$p.'_'.$n_righe.'"  class="prezzo'.$p.' form-control f-12" placeholder="0000.00" value="'.$record['TOTALE'].'">
                                        </div>
                                        <div class="col-md-1">
                                         <input type="checkbox" name="chec_sb_'.$p.'[]" id="chec_sb_'.$p.'_'.$n_righe.'_'.$n.'" class="check_scelta">
                                        </div>   
                                        <div style="clear:both;height:4px"></div>                                            
                                    </div>';
                              
                                   $righe .= '
                                                if($("#chec_sb_'.$p.'_'.$n_righe.'_'.$n.'").prop(\'checked\')==false) {
                                                    $("#riga_'.$p.'_'.$n_righe.'_'.$n.'").remove();                                                    
                                                } 
                                              '."\r\n";                                
                            $n++;

                          }
                          $n_righe++;
                        }



                        if($numero_camere > 1){

                          foreach ($rec as $kk => $record) {
                            $n_c == 1;
                            for ($n_c=1; $n_c <= $numero_camere; $n_c++) {
                              echo'
                                    <div class="row nascondi" id="riga_'.$p.'_'.$n_righe.'_'.$n.'">  
                                      <div class="col-md-'.(date('Y-m-d') > $data_quoto_v2?'3':'4').'" >
                                          <input type="hidden" value="" name="idrichiesta'.$p.'[]">
                                          <input type="hidden" name="TipoSoggiorno'.$p.'[]" id="TipoSoggiorno_'.$p.'_'.$n_righe.'"  value="'.$row['Id'].'"><i class="fa fa-angle-right"></i> <span class="text-orange f-12">'.$row['TipoSoggiorno'].'</span><br><div style="padding-left:20px"><small><i class="fa fa-trophy"></i> <b class="text-info"><em>TariffaSB:</em> '.$record['TRATTAMENTO'].'</b> <i class="fa fa-angle-right"></i> <span class="text-maroon">'.$record['DISCOUNTDESCR'].'</span></small></div>                                 
                                      </div>
                                      <div class="col-md-'.(date('Y-m-d') > $data_quoto_v2?'3':'4').'">
                                        <input  type="hidden" name="NumeroCamere'.$p.'[]" id="NumeroCamere_'.$p.'_'.$n_righe.'" class="f-12 form-control calc text-center" value="'.$record['UNITA'].'" style="font-size:80%;height:calc(2.25rem + 2px);"> 
                                        <i class="fa fa-key"></i> <input type="hidden" name="TipoCamere'.$p.'[]" id="TipoCamere_'.$p.'_'.$n_righe.'" value="'.$rows['Id'].'"><span class="text-green f-12">'.$rows['TipoCamere'].'</span>
                                      </div>'; 
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
                                                <select name="NumBambini'.$p.'[]" id="NumeroBambini_'.$p.'_'.$n_righe.'_'.$n.'"
                                                    class="NumeroBambini_sb_'.$p.'_'.$n_righe.' form-control f-12" style="font-size:80%" onchange="eta_bimbi_sb(\''.$p.'_'.$n_righe.'\');">
                                                    <option value="" selected="selected">--</option>
                                                      '.$numero_bimbi.'
                                                </select>
                                                <div class="EtaBambini_sb'.$p.'_'.$n_righe.'" id="EtaB_'.$p.'_'.$n_righe.'_'.$n.'" style="display:none">
                                                    <input type="text"  name="EtaB'.$p.'[]" placeholder="Età: 1,2,3" class="form-control f-12" style="font-size:80%" value="'.($eta1==''?'':$eta1).''.($eta2==''?'':','.$eta2).''.($eta3==''?'':','.$eta3).''.($eta4==''?'':','.$eta4).''.($eta5==''?'':','.$eta5).''.($eta6==''?'':','.$eta6).'">
                                                </div> 
                                            </div>';

                                    echo'<script>
                                            $( document ).ready(function() {                                      
                                                if($("#NumeroBambini_'.$p.'_'.$n_righe.'_'.$n.'").val() != \'\'){
                                                  $("#EtaB_'.$p.'_'.$n_righe.'_'.$n.'").attr("style","display:block");
                                                }else{
                                                  $("#EtaB_'.$p.'_'.$n_righe.'_'.$n.'").attr("style","display:none");
                                                }
                                            });
                                          </script>';
                              }        
                                echo'   <div class="col-md-3">                    
                                              <input type="text" name="Prezzo'.$p.'[]" id="Prezzo_'.$p.'_'.$n_righe.'"  class="prezzo'.$p.' form-control f-12" placeholder="0000.00" value="'.(($record['TOTALE']/$numero_camere)).'">
                                        </div>
                                        <div class="col-md-1">
                                         <input type="checkbox" name="chec_sb_'.$p.'[]" id="chec_sb_'.$p.'_'.$n_righe.'_'.$n.'" class="check_scelta">
                                        
                                        </div>   
                                        <div style="clear:both;height:4px"></div>                                            
                                    </div>
                                    ';
                                    $righe .= '
                                                if($("#chec_sb_'.$p.'_'.$n_righe.'_'.$n.'").prop(\'checked\')==false) {
                                                    $("#riga_'.$p.'_'.$n_righe.'_'.$n.'").remove(); 
                                                    $("#hr_'.$p.'_'.$n_righe.'_'.$n.'").remove();                                                    
                                                } 
                                              '."\r\n"; 
                              echo (($n_c % $numero_camere == 0)?'<hr id="hr_'.$p.'_'.$n_righe.'_'.$n.'">':'');
                              $n++;
                            }  
                            $n_righe++;



                          }
                         
             
                        }



                      }

                  }

                  
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
                          <div class="col-md-6 text-right" style="padding-right:50px!important;"><button type="button" class="btn btn-primary btn-sm conferma">Conferma la scelta</button></div>
                       </div>
                       <br>';
              }else{

                echo'<h5 class="f-14">
                      <div class="text-center text-red"> Nessun risultato!</div>
                      <div class="text-center">
                        <i class="fa fa-arrow-down" aria-hidden="true"></i><br>
                        Crea Proposta Soggiorno con QUOTO!
                      </div>
                    </h5>';

              } 


              curl_close($ch3); 


?>