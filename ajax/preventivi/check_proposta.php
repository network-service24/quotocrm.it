<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


$NumeroPrenotazione = $_REQUEST['NumeroPrenotazione'];
$idsito             = $_REQUEST['idsito'];


$select = "SELECT hospitality_proposte.Id as IdProposta,hospitality_proposte.NomeProposta, hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,hospitality_guest.TipoRichiesta,hospitality_guest.idsito,
                hospitality_guest.AccontoRichiesta,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.AccontoLibero,
                hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,hospitality_proposte.AccontoTesto,
                hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza,hospitality_guest.Chiuso
            FROM hospitality_proposte
            INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
            WHERE hospitality_guest.NumeroPrenotazione = " . $NumeroPrenotazione . " AND hospitality_guest.idsito = " . $idsito . " ORDER BY hospitality_proposte.Id ASC";
$res = $dbMysqli->query($select);
$tot = sizeof($res);
if ($tot > 0) {
    echo  '';
} else {
    echo '<label class="badge badge-inverse-danger f-10">Da completare</label>';
}
       
?>