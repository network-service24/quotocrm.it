<?php
/**
 ** esecuzione funzione archivia_anno() 
 ** per arcihiare preventivi, conferme e prenotazioni
 ** in un unico evento!!
 **/
if($_GET['action'] == 'archiviaAnno'){
    archivia_anno($_GET['idsito'],$_GET['anno']);
    header('Location:'.BASE_URL_SITO.'archivio/');
}
?>