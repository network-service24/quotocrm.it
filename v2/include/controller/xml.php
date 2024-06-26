<?php
#############
# PROCEDURA PER CONTROLLARE I DATI XML DOPO CHE SIA STATO FATTO GIA IL SETUP
# SI DIGITA DAL BROWSER UNA VOLTA LOGGATI il link http://quoto.suiteweb.it/xml/&lingua=it-IT&A=2017-06-01&P=2017-06-10&action=eG1sX3NpdG8=
###########################
if($_REQUEST['action']=='eG1sX3NpdG8='){
  
    $Qcheck = "SELECT * FROM hospitality_simplebooking WHERE idsito = ".IDSITO." AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
    $Qquery = $db->query($Qcheck);
    $Tcheck = $db->result($Qquery);


    $xml='<OTA_HotelRatePlanRQ  xmlns="http://www.opentravel.org/OTA/2003/05"  Target="Production" Version="1.0">
          <RatePlans>
            <RatePlan>
              <HotelRef HotelCode="'.$Tcheck[0]['IdHotel'].'" />
              <TPA_Extensions>
                   <provider Name="'.$Tcheck[0]['UserProvider'].'" Pwd="'.$Tcheck[0]['PasswordProvider'].'" />
                   <XMLHotelAgent Name="'.$Tcheck[0]['UserHotel'].'" Pwd="'.$Tcheck[0]['PasswordHotel'].'" />
              </TPA_Extensions>
            </RatePlan>
          </RatePlans>
        </OTA_HotelRatePlanRQ>';

    $dati = urlencode($xml);
    $fp = fopen(BASE_PATH_SITO.'uploads/'.IDSITO.'/rate.xml','w');
    $ch = curl_init();
    $url = 'http://xml.simplebooking.it/xmlservice.asmx/RateListRQ';
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "xml=".$dati);
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_exec($ch);
    curl_close($ch); 

    $xml2 = '<OTA_HotelRoomListRQ xmlns="http://www.opentravel.org/OTA/2003/05"  Target="Production" Version="1.0">
              <HotelRoomLists>
                <HotelRoomList HotelCode="'.$Tcheck[0]['IdHotel'].'" />
              </HotelRoomLists>
              <TPA_Extensions>
                       <provider Name="'.$Tcheck[0]['UserProvider'].'" Pwd="'.$Tcheck[0]['PasswordProvider'].'" />
                       <XMLHotelAgent Name="'.$Tcheck[0]['UserHotel'].'" Pwd="'.$Tcheck[0]['PasswordHotel'].'" />
              </TPA_Extensions>
            </OTA_HotelRoomListRQ>';

    $dati2 = urlencode($xml2);
    $fp2 = fopen(BASE_PATH_SITO.'uploads/'.IDSITO.'/camere.xml','w');
    $ch2 = curl_init();
    $url2 = "http://xml.simplebooking.it/xmlservice.asmx/RoomListRQ"; 
    curl_setopt($ch2, CURLOPT_URL, $url2);
    curl_setopt($ch2, CURLOPT_POST, true);
    curl_setopt($ch2, CURLOPT_POSTFIELDS, 'xml='.$dati2);
    curl_setopt($ch2, CURLOPT_FILE, $fp2);
    curl_exec($ch2);                    
    curl_close($ch2); 


  $xml3 = '<OTA_HotelAvailRQ PrimaryLangID="'.$_REQUEST['lingua'].'" xmlns="http://www.opentravel.org/OTA/2003/05" Target="Production" Version="1.0">
          <AvailRequestSegments>
              <AvailRequestSegment>
                  <StayDateRange Start="'.$_REQUEST['A'].'" End="'.$_REQUEST['P'].'" />
                    
                  <RoomStayCandidates>
                      <!-- Room 1 -->
                      <RoomStayCandidate>
                          <GuestCounts>
                              <!-- Adult -->
                              <GuestCount AgeQualifyingCode="10.AQC" Count="2" />
                              <GuestCount AgeQualifyingCode="8.AQC" Age="10" Count="1" />
                          </GuestCounts>
                      </RoomStayCandidate>
                      <RoomStayCandidate>
                          <GuestCounts>
                              <!-- Adult -->
                              <GuestCount AgeQualifyingCode="10.AQC" Count="2" />
                              <!-- Child -->
                              <GuestCount AgeQualifyingCode="8.AQC" Age="8" Count="1" />
                          </GuestCounts>
                      </RoomStayCandidate>                
                  </RoomStayCandidates>

                  <TPA_Extensions>
                             <provider Name="'.$Tcheck[0]['UserProvider'].'" Pwd="'.$Tcheck[0]['PasswordProvider'].'" />
                             <XMLHotelAgent Name="'.$Tcheck[0]['UserHotel'].'" Pwd="'.$Tcheck[0]['PasswordHotel'].'" />
                      <Filter HotelCode="'.$Tcheck[0]['IdHotel'].'" />
                  </TPA_Extensions>
              </AvailRequestSegment>
          </AvailRequestSegments>
      </OTA_HotelAvailRQ>';

  $dati3 = ($xml3);
  $fp3 = fopen(BASE_PATH_SITO.'uploads/'.IDSITO.'/avail.xml','w');
  $ch3 = curl_init();
  $url3 = 'http://xml.simplebooking.it/xmlservice.asmx/HotelAvailRQ';
  curl_setopt($ch3, CURLOPT_URL, $url3);
  curl_setopt($ch3, CURLOPT_POST, true);
  curl_setopt($ch3, CURLOPT_POSTFIELDS, $dati3);
  curl_setopt($ch3, CURLOPT_FILE, $fp3);
  curl_exec($ch3);
  curl_close($ch3); 
 }
?>