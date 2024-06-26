<?php
 // SERVIZI AGGIUNTIVI
 $seT = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('1914','it','culla_baby.png','Culla','','Al giorno','1')");
 $id_seT = $db->insert_id($seT);

 // COPIA ICONA DEMO
 $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/culla_baby.png';
 $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/culla_baby.png';
 if (!file_exists($destPathIcona)){
     copy($srcPathIcona, $destPathIcona);
 }
 // FINE COPIA ICONA

 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','1914','it','Culla','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','1914','en','Baby cot','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','1914','fr','Lit d\'enfant','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','1914','de','Krippe','')");
 #
 $seT1 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('1914','it','parking.png','Parcheggio','','Al giorno','1')");
 $id_seT1 = $db->insert_id($seT1);

 // COPIA ICONA DEMO
 $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/parking.png';
 $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/parking.png';
 if (!file_exists($destPathIcona)){
     copy($srcPathIcona, $destPathIcona);
 }
 // FINE COPIA ICONA

 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','1914','it','Parcheggio','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','1914','en','Parking','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','1914','fr','Parking','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','1914','de','Parkplatz','')");
 #
 $seT2 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('1914','it','beach.png','Spiaggia','','Al giorno','0')");
 $id_seT2 = $db->insert_id($seT2);

 // COPIA ICONA DEMO
 $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/beach.png';
 $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/beach.png';
 if (!file_exists($destPathIcona)){
     copy($srcPathIcona, $destPathIcona);
 }
 // FINE COPIA ICONA

 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','1914','it','Spiaggia','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','1914','en','Beach','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','1914','fr','Plage','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','1914','de','Strand','')");
 #
 $seT3 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('1914','it','bus_navetta.png','Bus Navetta','','Una tantum','1')");
 $id_seT3 = $db->insert_id($seT3);

 // COPIA ICONA DEMO
 $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/bus_navetta.png';
 $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/bus_navetta.png';
 if (!file_exists($destPathIcona)){
     copy($srcPathIcona, $destPathIcona);
 }
 // FINE COPIA ICONA

 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','1914','it','Bus Navetta','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','1914','en','Bus','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','1914','fr','Navette','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','1914','de','Shuttle-Bus','')");
 #
 $seT4 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('1914','it','wellness.png','Centro Wellness','','Una tantum','1')");
 $id_seT4 = $db->insert_id($seT4);

 // COPIA ICONA DEMO
 $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/wellness.png';
 $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/wellness.png';
 if (!file_exists($destPathIcona)){
     copy($srcPathIcona, $destPathIcona);
 }
 // FINE COPIA ICONA

 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','1914','it','Centro Wellness','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','1914','en','Wellness Center','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','1914','fr','Centre de bien-être','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','1914','de','Wellness Zentrum','')");
 #
 $seT5 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('1914','it','computer.png','Internet Point','','Una tantum','1')");
 $id_seT5 = $db->insert_id($seT5);

 // COPIA ICONA DEMO
 $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/computer.png';
 $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/computer.png';
 if (!file_exists($destPathIcona)){
     copy($srcPathIcona, $destPathIcona);
 }
 // FINE COPIA ICONA

 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','1914','it','Internet Point','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','1914','en','Internet Point','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','1914','fr','Internet Point','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','1914','de','Internet Point','')");
 #
 $seT51 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('1914','it','nursery.png','Nursery','','Una tantum','1')");
 $id_seT51 = $db->insert_id($seT51);

 // COPIA ICONA DEMO
 $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/nursery.png';
 $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/nursery.png';
 if (!file_exists($destPathIcona)){
     copy($srcPathIcona, $destPathIcona);
 }
 // FINE COPIA ICONA

 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT51."','1914','it','Nursery','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT51."','1914','en','Nursery','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT51."','1914','fr','Pépinière','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT51."','1914','de','Kindergarten','')");
 #
 $seT6 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('1914','it','giornali.png','Giornali','','Al giorno','1')");
 $id_seT6 = $db->insert_id($seT6);

 // COPIA ICONA DEMO
 $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/giornali.png';
 $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/giornali.png';
 if (!file_exists($destPathIcona)){
     copy($srcPathIcona, $destPathIcona);
 }
 // FINE COPIA ICONA

 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','1914','it','Giornali','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','1914','en','Newspapers','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','1914','fr','Journaux','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','1914','de','Zeitungen','')");
 #
 $seT7 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('1914','it','joystick_cover.png','Sala Giochi','','Una tantum','1')");
 $id_seT7 = $db->insert_id($seT7);

 // COPIA ICONA DEMO
 $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/joystick_cover.png';
 $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/joystick_cover.png';
 if (!file_exists($destPathIcona)){
     copy($srcPathIcona, $destPathIcona);
 }
 // FINE COPIA ICONA

 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','1914','it','Sala Giochi','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','1914','en','Game room','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','1914','fr','Salle de jeux','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','1914','de','Spielzimmer','')");

 #
 $seT8 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('1914','it','skipass.png','Skipass','','A persona','0')");
 $id_seT8 = $db->insert_id($seT8);

 // COPIA ICONA DEMO
 $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/skipass.png';
 $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/skipass.png';
 if (!file_exists($destPathIcona)){
     copy($srcPathIcona, $destPathIcona);
 }
 // FINE COPIA ICONA

 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','1914','it','Skipass','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','1914','en','Skipass','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','1914','fr','Skipass','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','1914','de','Skipass','')");

 #
 $seT9 = $db->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato) VALUES('1914','it','massaggio.png','Massaggio','','A persona','1')");
 $id_seT9 = $db->insert_id($seT9);

 // COPIA ICONA DEMO
 $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/massaggio.png';
 $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/massaggio.png';
 if (!file_exists($destPathIcona)){
     copy($srcPathIcona, $destPathIcona);
 }
 // FINE COPIA ICONA

 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','1914','it','Massaggio','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','1914','en','Massage','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','1914','fr','Massage','')");
 $db->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','1914','de','Massage','')");
 //FINE

?>