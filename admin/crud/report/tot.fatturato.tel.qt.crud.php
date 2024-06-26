<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


$idsito = $_REQUEST['idsito'];

    $qy     = "SELECT 
                    REPLACE(hospitality_guest.Cellulare,'-','') as Cellulare,
                    hospitality_guest.Id
                FROM 
                    hospitality_guest  
                WHERE
                    hospitality_guest.idsito = ".$idsito." 
                AND
                    hospitality_guest.FontePrenotazione != 'Sito Web'

                AND 
                    hospitality_guest.TipoRichiesta = 'Conferma'  
                AND
                    hospitality_guest.Cellulare != ''
                AND
                    hospitality_guest.Nome != ''
                AND
                    hospitality_guest.Cognome != ''
                AND
                    hospitality_guest.DataRichiesta != ''
                AND
                    LENGTH(hospitality_guest.Cellulare) > 5
                AND
                    hospitality_guest.Cellulare NOT LIKE '%000000%'";
    $q      = $dbMysqli_sviluppo_quoto->query($qy);

    foreach($q as $k => $rw){
        $lista_tel[$rw['Id']] = trim($rw['Cellulare']);
    }
    
    foreach ($lista_tel as $key => $value) {  
        $qry     = "SELECT 
                        hospitality_guest.Id 
                    FROM 
                        hospitality_guest  
                    INNER JOIN 
                        hospitality_guest_track_phone ON hospitality_guest_track_phone.idsito = hospitality_guest.idsito
                    WHERE
                        hospitality_guest.idsito = ".$idsito."  
                    AND
                        hospitality_guest_track_phone.idsito = ".$idsito."   
                    AND 
                        hospitality_guest.Id = ".$key."
                    AND 
                        hospitality_guest_track_phone.telefono = '".$value."'";
        $sq      = $dbMysqli_sviluppo_quoto->query($qry);
        
        foreach ($sq as $key => $val) {  
            $lista[] = $val['Id'];
        }
    }

    $sql = "SELECT SUM(DISTINCT(p.PrezzoP)) as num
                FROM hospitality_guest g
                INNER JOIN hospitality_proposte p ON p.id_richiesta = g.Id
                WHERE g.Id IN (".implode(",",$lista).")
                AND g.idsito = $idsito";

    $result = $dbMysqli_sviluppo_quoto->query($sql);
    $record = $result[0];
    $cdPrice = count($result) > 0 ? $record['num'] : 0;
    
    echo number_format($cdPrice, 2, ',', '.');


?>
