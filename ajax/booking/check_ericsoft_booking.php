<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

        $idsito        = $_REQUEST['idsito'];


        $Qcheck = "SELECT * FROM hospitality_ericsoftbooking WHERE idsito = ".$idsito." AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
        $Qquery = $dbMysqli->query($Qcheck);
        $record = $Qquery[0];

        $urlHost          = $record['UrlHost'];
        $LicenzaId        = $record['LicenzaId']; 
        $ProviderCode     = $record['ProviderCode'];
        $ApiKey           = $record['ProviderApiKey']; 



        $start         = $_REQUEST['start'].'T00:00:00.000Z'; 
        $end           = $_REQUEST['end'].'T00:00:00.000Z'; 

        $adulti        = $_REQUEST['adulti'];
        $bambini       = $_REQUEST['bambini'];       
        $eta1_         = explode("#",$_REQUEST['eta1']);
        $etaId1        = $eta1_[0];
        $eta1          = $eta1_[1];
        $eta2_         = explode("#",$_REQUEST['eta2']);
        $etaId2        = $eta2_[0];
        $eta2          = $eta2_[1];
        $eta3_         = explode("#",$_REQUEST['eta3']);
        $etaId3        = $eta3_[0];
        $eta3          = $eta3_[1];
        $eta4_         = explode("#",$_REQUEST['eta4']);
        $etaId4        = $eta4_[0];
        $eta4          = $eta4_[1];
        $eta5_         = explode("#",$_REQUEST['eta5']);
        $etaId5        = $eta5_[0];
        $eta5          = $eta5_[1];
        $eta6_         = explode("#",$_REQUEST['eta6']);
        $etaId6        = $eta6_[0];
        $eta6          = $eta6_[1];

        $numero_camere = $_REQUEST['numero_camere'];

        $adulti2         = $_REQUEST['adulti2'];
        $bambini2        = $_REQUEST['bambini2'];
        $eta1_2_         = explode("#",$_REQUEST['eta1_2']);
        $etaId1_2        = $eta1_2_[0];
        $eta1_2          = $eta1_2_[1];
        $eta2_2_         = explode("#",$_REQUEST['eta2_2']);
        $etaId2_2        = $eta2_2_[0];
        $eta2_2          = $eta2_2_[1];
        $eta3_2_         = explode("#",$_REQUEST['eta3_2']);
        $etaId3_2        = $eta3_2_[0];
        $eta3_2          = $eta3_2_[1];
        $eta4_2_         = explode("#",$_REQUEST['eta4_2']);
        $etaId4_2        = $eta4_2_[0];
        $eta4_2          = $eta4_2_[1];
        $eta5_2_         = explode("#",$_REQUEST['eta5_2']);
        $etaId5_2        = $eta5_2_[0];
        $eta5_2          = $eta5_2_[1];
        $eta6_2_         = explode("#",$_REQUEST['eta6_2']);
        $etaId6_2        = $eta6_2_[0];
        $eta6_2          = $eta6_2_[1];

        $adulti3         = $_REQUEST['adulti3'];
        $bambini3        = $_REQUEST['bambini3'];        
        $eta1_3_         = explode("#",$_REQUEST['eta1_3']);
        $etaId1_3        = $eta1_3_[0];
        $eta1_3          = $eta1_3_[1];
        $eta2_3_         = explode("#",$_REQUEST['eta2_3']);
        $etaId2_3        = $eta2_3_[0];
        $eta2_3          = $eta2_3_[1];
        $eta3_3_         = explode("#",$_REQUEST['eta3_3']);
        $etaId3_3        = $eta3_3_[0];
        $eta3_3          = $eta3_3_[1];
        $eta4_3_         = explode("#",$_REQUEST['eta4_3']);
        $etaId4_3        = $eta4_3_[0];
        $eta4_3          = $eta4_3_[1];
        $eta5_3_         = explode("#",$_REQUEST['eta5_3']);
        $etaId5_3        = $eta5_3_[0];
        $eta5_3          = $eta5_3_[1];
        $eta6_3_         = explode("#",$_REQUEST['eta6_3']);
        $etaId6_3        = $eta6_3_[0];
        $eta6_3          = $eta6_3_[1];

        $p             = $_REQUEST['proposta'];
        $data_quoto_v2 = DATA_QUOTO_V2;


        if($adulti != ''){
          $sel = "SELECT * FROM hospitality_pms_person WHERE idsito = ".$idsito." AND TypePms = 'E' AND (PersonName = 'Adulti' OR PersonName = 'Adulto' OR PersonName = 'Ospiti' OR PersonName = 'Persone' OR PersonName = 'Persona')  ORDER BY Id DESC LIMIT 1";
          $res = $dbMysqli->query($sel);
          $rec = $res[0];
          $AdultiId = $rec['PersonTypeId'];
        }



      if($numero_camere==1){
        if($bambini!=''){


              if($bambini == 1){
                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                "PortalIdh" => "",     
                                "LanguageType" => 1,  
                                "ConventionCode" => "",   
                                "ShowNonBookingEngineRates" => false,   
                                "StartDate" => "".$start."",
                                "EndDate" => "".$end."",
                                "UserCurrencyCode" => "EUR",
                                "Resources" => array(
                                    array(
                                      "Guests" => array(
                                        array("PersonTypeId" => $AdultiId, "Quantity"=> $adulti),
                                        array("PersonTypeId" => $etaId1,"Quantity"=> 1)
                                      )
                                        )
                                                  )
                              );
              }

              if($bambini == 2){
                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                "PortalIdh" => "",     
                                "LanguageType" => 1,  
                                "ConventionCode" => "",   
                                "ShowNonBookingEngineRates" => false,   
                                "StartDate" => "".$start."",
                                "EndDate" => "".$end."",
                                "UserCurrencyCode" => "EUR",
                                "Resources" => array(
                                    array(
                                      "Guests" => array(
                                        array(
                                          "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                              ),
                                              array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                              array("PersonTypeId" => $etaId2,"Quantity"=>1)
                                                      )
                                        )
                                                  )
                          );

              }
              if($bambini == 3){
                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                  "PortalIdh" => "",     
                                  "LanguageType" => 1,  
                                  "ConventionCode" => "",   
                                  "ShowNonBookingEngineRates" => false,   
                                  "StartDate" => "".$start."",
                                  "EndDate" => "".$end."",
                                  "UserCurrencyCode" => "EUR",
                                  "Resources" => array(
                                      array(
                                        "Guests" => array(
                                          array(
                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                                ),
                                                array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId2,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId3,"Quantity"=>1)
                                                )
                                          )
                                                    )
                                    );
              }
              if($bambini == 4){

                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                  "PortalIdh" => "",     
                                  "LanguageType" => 1,  
                                  "ConventionCode" => "",   
                                  "ShowNonBookingEngineRates" => false,   
                                  "StartDate" => "".$start."",
                                  "EndDate" => "".$end."",
                                  "UserCurrencyCode" => "EUR",
                                  "Resources" => array(
                                      array(
                                        "Guests" => array(
                                          array(
                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                                ),
                                                array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId2,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId3,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId4,"Quantity"=>1)
                                                )
                                          )
                                                    )
                                    );
              }
              if($bambini == 5){

                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                  "PortalIdh" => "",     
                                  "LanguageType" => 1,  
                                  "ConventionCode" => "",   
                                  "ShowNonBookingEngineRates" => false,   
                                  "StartDate" => "".$start."",
                                  "EndDate" => "".$end."",
                                  "UserCurrencyCode" => "EUR",
                                  "Resources" => array(
                                      array(
                                        "Guests" => array(
                                          array(
                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                                ),
                                                array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId2,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId3,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId4,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId5,"Quantity"=>1)
                                                )
                                          )
                                                    )
                                    );
              }
              if($bambini == 6){

                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                  "PortalIdh" => "",     
                                  "LanguageType" => 1,  
                                  "ConventionCode" => "",   
                                  "ShowNonBookingEngineRates" => false,   
                                  "StartDate" => "".$start."",
                                  "EndDate" => "".$end."",
                                  "UserCurrencyCode" => "EUR",
                                  "Resources" => array(
                                      array(
                                        "Guests" => array(
                                          array(
                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                                ),
                                                array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId2,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId3,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId4,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId5,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId6,"Quantity"=>1)
                                                )
                                          )
                                                    )
                                    );                
              }
          
        }else{
              $data = array(  "LicenseIdh" => $LicenzaId ,    
                              "PortalIdh" => "",     
                              "LanguageType" => 1,  
                              "ConventionCode" => "",   
                              "ShowNonBookingEngineRates" => false,   
                              "StartDate" => "".$start."",
                              "EndDate" => "".$end."",
                              "UserCurrencyCode" => "EUR",
                              "Resources" => array(
                                  array(
                                    "Guests" => array(
                                      array( "PersonTypeId" => $AdultiId, "Quantity"=> $adulti))))
                            );
        }
            
      }elseif($numero_camere==2){

        if($bambini2!=''){


              if($bambini2 == 1){
                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                "PortalIdh" => "",     
                                "LanguageType" => 1,  
                                "ConventionCode" => "",   
                                "ShowNonBookingEngineRates" => false,   
                                "StartDate" => "".$start."",
                                "EndDate" => "".$end."",
                                "UserCurrencyCode" => "EUR",
                                "Resources" => array(
                                    array(
                                      "Guests" => array(
                                        array("PersonTypeId" => $AdultiId, "Quantity"=> $adulti),
                                        array("PersonTypeId" => $etaId1,"Quantity"=> 1)
                                                      )
                                        ),
                                    array(
                                        "Guests" => array(
                                          array("PersonTypeId" => $AdultiId, "Quantity"=> $adulti2),
                                          array("PersonTypeId" => $etaId1_2,"Quantity"=> 1)
                                        )
                                          )
                                                  )
                              );
              }

              if($bambini2 == 2){
                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                "PortalIdh" => "",     
                                "LanguageType" => 1,  
                                "ConventionCode" => "",   
                                "ShowNonBookingEngineRates" => false,   
                                "StartDate" => "".$start."",
                                "EndDate" => "".$end."",
                                "UserCurrencyCode" => "EUR",
                                "Resources" => array(
                                    array(
                                      "Guests" => array(
                                        array(
                                          "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                              ),
                                              array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                              array("PersonTypeId" => $etaId2,"Quantity"=>1)
                                                      )
                                            ),
                                            array(
                                              "Guests" => array(
                                                array(
                                                  "PersonTypeId" => $AdultiId, "Quantity"=> $adulti2
                                                      ),
                                                      array("PersonTypeId" => $etaId1_2,"Quantity"=>1),
                                                      array("PersonTypeId" => $etaId2_2,"Quantity"=>1)
                                                              )
                                                )
                                                  )
                          );

              }
              if($bambini2 == 3){
                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                  "PortalIdh" => "",     
                                  "LanguageType" => 1,  
                                  "ConventionCode" => "",   
                                  "ShowNonBookingEngineRates" => false,   
                                  "StartDate" => "".$start."",
                                  "EndDate" => "".$end."",
                                  "UserCurrencyCode" => "EUR",
                                  "Resources" => array(
                                      array(
                                        "Guests" => array(
                                          array(
                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                                ),
                                                array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId2,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId3,"Quantity"=>1)
                                                )
                                              ),
                                              array(
                                                "Guests" => array(
                                                  array(
                                                    "PersonTypeId" => $AdultiId, "Quantity"=> $adulti2
                                                        ),
                                                        array("PersonTypeId" => $etaId1_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId2_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId3_2,"Quantity"=>1)
                                                        )
                                                  )
                                                    )
                                    );
              }
              if($bambini2 == 4){

                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                  "PortalIdh" => "",     
                                  "LanguageType" => 1,  
                                  "ConventionCode" => "",   
                                  "ShowNonBookingEngineRates" => false,   
                                  "StartDate" => "".$start."",
                                  "EndDate" => "".$end."",
                                  "UserCurrencyCode" => "EUR",
                                  "Resources" => array(
                                      array(
                                        "Guests" => array(
                                          array(
                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                                ),
                                                array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId2,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId3,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId4,"Quantity"=>1)
                                                )
                                              ),
                                              array(
                                                "Guests" => array(
                                                  array(
                                                    "PersonTypeId" => $AdultiId, "Quantity"=> $adulti2
                                                        ),
                                                        array("PersonTypeId" => $etaId1_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId2_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId3_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId4_2,"Quantity"=>1)
                                                        )
                                                  )
                                                    )
                                    );
              }
              if($bambini2 == 5){

                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                  "PortalIdh" => "",     
                                  "LanguageType" => 1,  
                                  "ConventionCode" => "",   
                                  "ShowNonBookingEngineRates" => false,   
                                  "StartDate" => "".$start."",
                                  "EndDate" => "".$end."",
                                  "UserCurrencyCode" => "EUR",
                                  "Resources" => array(
                                      array(
                                        "Guests" => array(
                                          array(
                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                                ),
                                                array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId2,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId3,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId4,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId5,"Quantity"=>1)
                                                )
                                              ),
                                              array(
                                                "Guests" => array(
                                                  array(
                                                    "PersonTypeId" => $AdultiId, "Quantity"=> $adulti2
                                                        ),
                                                        array("PersonTypeId" => $etaId1_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId2_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId3_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId4_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId5_2,"Quantity"=>1)
                                                        )
                                                  )
                                                    )
                                    );
              }
              if($bambini2 == 6){

                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                  "PortalIdh" => "",     
                                  "LanguageType" => 1,  
                                  "ConventionCode" => "",   
                                  "ShowNonBookingEngineRates" => false,   
                                  "StartDate" => "".$start."",
                                  "EndDate" => "".$end."",
                                  "UserCurrencyCode" => "EUR",
                                  "Resources" => array(
                                      array(
                                        "Guests" => array(
                                          array(
                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                                ),
                                                array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId2,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId3,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId4,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId5,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId6,"Quantity"=>1)
                                                )
                                              ),
                                              array(
                                                "Guests" => array(
                                                  array(
                                                    "PersonTypeId" => $AdultiId, "Quantity"=> $adulti2
                                                        ),
                                                        array("PersonTypeId" => $etaId1_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId2_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId3_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId4_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId5_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId6_2,"Quantity"=>1)
                                                        )
                                                  )
                                                    )
                                    );                
              }
          
        }else{
              $data = array(  "LicenseIdh" => $LicenzaId ,    
                              "PortalIdh" => "",     
                              "LanguageType" => 1,  
                              "ConventionCode" => "",   
                              "ShowNonBookingEngineRates" => false,   
                              "StartDate" => "".$start."",
                              "EndDate" => "".$end."",
                              "UserCurrencyCode" => "EUR",
                              "Resources" => array(
                                  array(
                                    "Guests" => array(
                                      array( "PersonTypeId" => $AdultiId, "Quantity"=> $adulti)
                                                    )
                                    ),
                                    array(
                                      "Guests" => array(
                                        array( "PersonTypeId" => $AdultiId, "Quantity"=> $adulti2)
                                                      )
                                          )
                                                  )
                            );
        }

      }elseif($numero_camere==3){

        if($bambini3!=''){


              if($bambini3 == 1){
                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                "PortalIdh" => "",     
                                "LanguageType" => 1,  
                                "ConventionCode" => "",   
                                "ShowNonBookingEngineRates" => false,   
                                "StartDate" => "".$start."",
                                "EndDate" => "".$end."",
                                "UserCurrencyCode" => "EUR",
                                "Resources" => array(
                                    array(
                                      "Guests" => array(
                                        array("PersonTypeId" => $AdultiId, "Quantity"=> $adulti),
                                        array("PersonTypeId" => $etaId1,"Quantity"=> 1)
                                                      )
                                        ),
                                    array(
                                        "Guests" => array(
                                          array("PersonTypeId" => $AdultiId, "Quantity"=> $adulti2),
                                          array("PersonTypeId" => $etaId1_2,"Quantity"=> 1)
                                        )
                                        ),
                                        array(
                                          "Guests" => array(
                                            array("PersonTypeId" => $AdultiId, "Quantity"=> $adulti3),
                                            array("PersonTypeId" => $etaId1_3,"Quantity"=> 1)
                                          )
                                            )
                                                  )
                              );
              }

              if($bambini3 == 2){
                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                "PortalIdh" => "",     
                                "LanguageType" => 1,  
                                "ConventionCode" => "",   
                                "ShowNonBookingEngineRates" => false,   
                                "StartDate" => "".$start."",
                                "EndDate" => "".$end."",
                                "UserCurrencyCode" => "EUR",
                                "Resources" => array(
                                    array(
                                      "Guests" => array(
                                        array(
                                          "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                              ),
                                              array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                              array("PersonTypeId" => $etaId2,"Quantity"=>1)
                                                      )
                                            ),
                                            array(
                                              "Guests" => array(
                                                array(
                                                  "PersonTypeId" => $AdultiId, "Quantity"=> $adulti2
                                                      ),
                                                      array("PersonTypeId" => $etaId1_2,"Quantity"=>1),
                                                      array("PersonTypeId" => $etaId2_2,"Quantity"=>1)
                                                              )
                                                    ),
                                                    array(
                                                      "Guests" => array(
                                                        array(
                                                          "PersonTypeId" => $AdultiId, "Quantity"=> $adulti3
                                                              ),
                                                              array("PersonTypeId" => $etaId1_3,"Quantity"=>1),
                                                              array("PersonTypeId" => $etaId2_3,"Quantity"=>1)
                                                                      )
                                                        )
                                                  )
                          );

              }
              if($bambini3 == 3){
                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                  "PortalIdh" => "",     
                                  "LanguageType" => 1,  
                                  "ConventionCode" => "",   
                                  "ShowNonBookingEngineRates" => false,   
                                  "StartDate" => "".$start."",
                                  "EndDate" => "".$end."",
                                  "UserCurrencyCode" => "EUR",
                                  "Resources" => array(
                                      array(
                                        "Guests" => array(
                                          array(
                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                                ),
                                                array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId2,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId3,"Quantity"=>1)
                                                )
                                              ),
                                              array(
                                                "Guests" => array(
                                                  array(
                                                    "PersonTypeId" => $AdultiId, "Quantity"=> $adulti2
                                                        ),
                                                        array("PersonTypeId" => $etaId1_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId2_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId3_2,"Quantity"=>1)
                                                        )
                                                      ),
                                                      array(
                                                        "Guests" => array(
                                                          array(
                                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti3
                                                                ),
                                                                array("PersonTypeId" => $etaId1_3,"Quantity"=>1),
                                                                array("PersonTypeId" => $etaId2_3,"Quantity"=>1),
                                                                array("PersonTypeId" => $etaId3_3,"Quantity"=>1)
                                                                )
                                                          )
                                                    )
                                    );
              }
              if($bambini3 == 4){

                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                  "PortalIdh" => "",     
                                  "LanguageType" => 1,  
                                  "ConventionCode" => "",   
                                  "ShowNonBookingEngineRates" => false,   
                                  "StartDate" => "".$start."",
                                  "EndDate" => "".$end."",
                                  "UserCurrencyCode" => "EUR",
                                  "Resources" => array(
                                      array(
                                        "Guests" => array(
                                          array(
                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                                ),
                                                array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId2,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId3,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId4,"Quantity"=>1)
                                                )
                                              ),
                                              array(
                                                "Guests" => array(
                                                  array(
                                                    "PersonTypeId" => $AdultiId, "Quantity"=> $adulti2
                                                        ),
                                                        array("PersonTypeId" => $etaId1_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId2_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId3_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId4_2,"Quantity"=>1)
                                                        )
                                                      ),
                                                      array(
                                                        "Guests" => array(
                                                          array(
                                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti3
                                                                ),
                                                                array("PersonTypeId" => $etaId1_3,"Quantity"=>1),
                                                                array("PersonTypeId" => $etaId2_3,"Quantity"=>1),
                                                                array("PersonTypeId" => $etaId3_3,"Quantity"=>1),
                                                                array("PersonTypeId" => $etaId4_3,"Quantity"=>1)
                                                                )
                                                          )
                                                    )
                                    );
              }
              if($bambini3 == 5){

                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                  "PortalIdh" => "",     
                                  "LanguageType" => 1,  
                                  "ConventionCode" => "",   
                                  "ShowNonBookingEngineRates" => false,   
                                  "StartDate" => "".$start."",
                                  "EndDate" => "".$end."",
                                  "UserCurrencyCode" => "EUR",
                                  "Resources" => array(
                                      array(
                                        "Guests" => array(
                                          array(
                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                                ),
                                                array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId2,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId3,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId4,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId5,"Quantity"=>1)
                                                )
                                              ),
                                              array(
                                                "Guests" => array(
                                                  array(
                                                    "PersonTypeId" => $AdultiId, "Quantity"=> $adulti2
                                                        ),
                                                        array("PersonTypeId" => $etaId1_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId2_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId3_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId4_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId5_2,"Quantity"=>1)
                                                        )
                                                      ),
                                                      array(
                                                        "Guests" => array(
                                                          array(
                                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti3
                                                                ),
                                                                array("PersonTypeId" => $etaId1_3,"Quantity"=>1),
                                                                array("PersonTypeId" => $etaId2_3,"Quantity"=>1),
                                                                array("PersonTypeId" => $etaId3_3,"Quantity"=>1),
                                                                array("PersonTypeId" => $etaId4_3,"Quantity"=>1),
                                                                array("PersonTypeId" => $etaId5_3,"Quantity"=>1)
                                                                )
                                                          )
                                                    )
                                    );
              }
              if($bambini3 == 6){

                $data = array(  "LicenseIdh" => $LicenzaId ,    
                                  "PortalIdh" => "",     
                                  "LanguageType" => 1,  
                                  "ConventionCode" => "",   
                                  "ShowNonBookingEngineRates" => false,   
                                  "StartDate" => "".$start."",
                                  "EndDate" => "".$end."",
                                  "UserCurrencyCode" => "EUR",
                                  "Resources" => array(
                                      array(
                                        "Guests" => array(
                                          array(
                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti
                                                ),
                                                array("PersonTypeId" => $etaId1,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId2,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId3,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId4,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId5,"Quantity"=>1),
                                                array("PersonTypeId" => $etaId6,"Quantity"=>1)
                                                )
                                              ),
                                              array(
                                                "Guests" => array(
                                                  array(
                                                    "PersonTypeId" => $AdultiId, "Quantity"=> $adulti2
                                                        ),
                                                        array("PersonTypeId" => $etaId1_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId2_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId3_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId4_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId5_2,"Quantity"=>1),
                                                        array("PersonTypeId" => $etaId6_2,"Quantity"=>1)
                                                        )
                                                      ),
                                                      array(
                                                        "Guests" => array(
                                                          array(
                                                            "PersonTypeId" => $AdultiId, "Quantity"=> $adulti3
                                                                ),
                                                                array("PersonTypeId" => $etaId1_3,"Quantity"=>1),
                                                                array("PersonTypeId" => $etaId2_3,"Quantity"=>1),
                                                                array("PersonTypeId" => $etaId3_3,"Quantity"=>1),
                                                                array("PersonTypeId" => $etaId4_3,"Quantity"=>1),
                                                                array("PersonTypeId" => $etaId5_3,"Quantity"=>1),
                                                                array("PersonTypeId" => $etaId6_3,"Quantity"=>1)
                                                                )
                                                          )
                                                    )
                                    );                
              }
          
        }else{
              $data = array(  "LicenseIdh" => $LicenzaId ,    
                              "PortalIdh" => "",     
                              "LanguageType" => 1,  
                              "ConventionCode" => "",   
                              "ShowNonBookingEngineRates" => false,   
                              "StartDate" => "".$start."",
                              "EndDate" => "".$end."",
                              "UserCurrencyCode" => "EUR",
                              "Resources" => array(
                                  array(
                                    "Guests" => array(
                                      array( "PersonTypeId" => $AdultiId, "Quantity"=> $adulti)
                                                    )
                                    ),
                                    array(
                                      "Guests" => array(
                                        array( "PersonTypeId" => $AdultiId, "Quantity"=> $adulti2)
                                                      )
                                      ),
                                      array(
                                        "Guests" => array(
                                          array( "PersonTypeId" => $AdultiId, "Quantity"=> $adulti3)
                                                        )
                                            )
                                                  )
                            );
        }

      }


        $data_string = json_encode($data);

                $ch = curl_init($urlHost.'GetSolutionsV1');                                                                      
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                          
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type:      application/json',                                                                                
                'Content-Length:   ' .strlen($data_string),  
                'X-ProviderCode:   '.$ProviderCode,
                'X-ProviderApiKey: '.$ApiKey));
                $res = curl_exec($ch);

                $risultato = json_decode($res);
                $Availability = '';
                  foreach($risultato->Solutions as $key => $value){

                    foreach($value->Resources as $ky => $val){

                        $IsDiscounted   = $val->IsDiscounted;
                        $RoomCode       = $val->ResourceTypeId;

                      foreach($val->Rates as $k => $vl){

                          $TipoSogg     = $vl->RateId;
                          $TotaleCamera = $vl->TotalSourceCurrency;
                          $Availability = $risultato->ResourceDetails[$ky]->Availability;
                          
                        // filtro per disponibilità
                        if($Availability != 0){
                          $riga_camere[$RoomCode.'_'.$TipoSogg][] = array('DISCOUNTED' => $IsDiscounted,'CAMERA' => $RoomCode,'SOGG' => $TipoSogg ,'TOTALE' => $TotaleCamera ,'DISPO' => $Availability);  
                        }
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
                                    <li>Solo da risultati di <img src="'.BASE_URL_SITO.'img/powered-ericsoftb.png" style="text-align:absmiddle;width:auto;height:10px">. </li>
                                    <li>Da righe di <img src="'.BASE_URL_SITO.'img/powered-ericsoftb.png" style="text-align:absmiddle;width:auto;height:10px"> + righe compilate con la maschera di <b>QUOTO!</b> </li>
                                    <li>Non scegliendo nessuna camera di <img src="'.BASE_URL_SITO.'img/powered-ericsoftb.png" style="text-align:absmiddle;width:auto;height:10px">, solo da righe compilate con la maschera di <b>QUOTO!</b></li>
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
                                        <h4>I risultati ottenuti da <img src="'.BASE_URL_SITO.'img/powered-ericsoftb.png" style="text-align:absmiddle;width:auto;height:10px"> sono verificati per 
                                            <span class="fa-stack ">
                                                <i class="fa fa-circle-o fa-stack-2x"></i>
                                                <strong class="fa-stack-1x">1</strong>
                                            </span> Nr.Camera</h4>
                                            <ul>
                                              <li>Modificando il numero di camere...; <b>QUOTO!</b> ne calcola il prezzo, ma <span class="text-red">non tiene<br>in considerazione le possibili tariffe  scontate</span> sul Booking Engine!!</li>
                                              <li>Una volta modifcato il numero di camere il valore del prezzo impostato non dipende più da <img src="'.BASE_URL_SITO.'img/powered-ericsoftb.png" style="text-align:absmiddle;width:auto;height:10px">, per tornare al prezzo originale ri-cliccate <img src="'.BASE_URL_SITO.'img/pul_book_ericsoft.png"></li>
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

                  $n_righe = 1;

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
                  foreach ($riga_camere as $k => $rec) {


                      $tmp = explode("_",$k);
                      $idroom = $tmp[0];
                      $idrate = $tmp[1];
 

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

                        $n = 1;
                        foreach ($rec as $kk => $record) {
                          if($kk == 0){
                       
                              echo'
                                    <div class="row nascondi" id="riga_'.$p.'_'.$n_righe.'_'.$n.'">  
                                      <div class="col-md-'.(date('Y-m-d') > $data_quoto_v2?'3':'4').'" >
                                          <input type="hidden" value="" name="idrichiesta'.$p.'[]">
                                            <input readonly type="hidden" name="NumeroCamere'.$p.'[]" id="NumeroCamere_'.$p.'_'.$n_righe.'" class="f-12 form-control calc text-center" value="1" style="font-size:80%;height:calc(2.25rem + 2px);"> 
                                          <input type="hidden" name="TipoSoggiorno'.$p.'[]" id="TipoSoggiorno_'.$p.'_'.$n_righe.'"  value="'.$row['Id'].'"><i class="fa fa-angle-right"></i> <span class="text-orange f-11">'.$row['TipoSoggiorno'].'</span>
                                          '.($record['DISCOUNTED']==1?'<br><div style="padding-left:20px"><small><i class="fa fa-trophy"></i> <b class="text-info f-11"><em>Offerta</em></b></small></div>':'').'                                 
                                      </div>
                                      <div class="col-md-'.(date('Y-m-d') > $data_quoto_v2?'3':'4').'">
                                        <i class="fa fa-key"></i> <input type="hidden" name="TipoCamere'.$p.'[]" id="TipoCamere_'.$p.'_'.$n_righe.'" value="'.$rows['Id'].'"><span class="text-green f-11">'.$rows['TipoCamere'].'</span> <span class="text-gray f-10 cursore" data-toggle="tooltip" title="Camere disponibili">('.$record['DISPO'].')</span>
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
                                            <select name="NumBambini'.$p.'[]" id="NumeroBambini_'.$p.'_'.$n_righe.'" style="font-size:80%"
                                                class="NumeroBambini_sb_'.$p.'_'.$n_righe.' form-control f-12"  onchange="eta_bimbi_sb(\''.$p.'_'.$n_righe.'\');">
                                                <option value="" selected="selected">--</option>
                                                  '.$numero_bimbi.'
                                            </select>
                                            <div class="EtaBambini_sb'.$p.'_'.$n_righe.'" id="EtaB_'.$p.'_'.$n_righe.'" style="display:none">
                                                <input type="text"  name="EtaB'.$p.'[]" placeholder="Età: 1,2,3" class="form-control f-12" style="font-size:80%" value="'.($eta1==''?'':$eta1).''.($eta2==''?'':','.$eta2).''.($eta3==''?'':','.$eta3).''.($eta4==''?'':','.$eta4).''.($eta5==''?'':','.$eta5).''.($eta6==''?'':','.$eta6).'">
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
                          }
                        }
                        $n_righe++;
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