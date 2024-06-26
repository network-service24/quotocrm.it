<?php
    $query_stile = "SELECT hospitality_stile_landing.*,hospitality_template_landing.BackgroundCellLink FROM hospitality_stile_landing
                    INNER JOIN hospitality_template_landing ON hospitality_template_landing.idsito = hospitality_stile_landing.idsito
                    WHERE hospitality_stile_landing.idsito = ".IDSITO;
    $res_stile   = $db->query($query_stile);
    $rec_stile   = $db->row($res_stile);
    if(is_array($rec_stile)) {
        if($rec_stile > count($rec_stile)) // se la pagina richiesta non esiste
            $tot_stile = count($rec_stile); // restituire la pagina con il numero più alto che esista
    }else{
        $tot_stile = 0;
    }
    if($tot_stile>0){
        $BackgroundEmail    = $rec_stile['BackgroundEmail'];
        $BackgroundCellData = $rec_stile['BackgroundCellData'];
        $BackgroundCellLink = $rec_stile['BackgroundCellLink'];
    }else{
        $BackgroundEmail    = '#EBEBEB';
        $BackgroundCellData = '#dbd7d8';
        $BackgroundCellLink = '#EF4047';
    }

    $db->query("SELECT * FROM hospitality_contenuti_email WHERE Lingua = 'it' AND TipoRichiesta = 'Preventivo' AND Abilitato = 1 AND idsito = ".IDSITO." ORDER BY Id DESC");
    $rw = $db->row();

    $MessaggioPreventivo = $rw['Messaggio'];



    $db->query("SELECT * FROM hospitality_contenuti_email WHERE Lingua = 'it' AND TipoRichiesta = 'Conferma' AND Abilitato = 1 AND idsito = ".IDSITO." ORDER BY Id DESC");
    $row = $db->row();

    $MessaggioConferma = $row['Messaggio'];


                        //$url  = ''.URL_LANDING.'count.php?v=45_1661_p';
                       // $link = file_get_contents("http://tinyurl.com/api-create.php?url=$url");


                // query per le tre foto
        $qry = $db->query("SELECT * FROM hospitality_minigallery WHERE idsito = ".IDSITO." ORDER BY Id DESC LIMIT 3");
        $res_img = $db->result($qry);
        if(sizeof($res_img)>0){
            $foto .='<br>
                            <table class="testo" border="0" width="50%" align="center">
                                <tr>
                                 <td align="left">
                                    <div class="row">';
                                    foreach ($res_img as $key => $value) {
                                                     $foto .='<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$value['Immagine'].'" class="img-responsive right-float mini" /></div>';
                                    }
            $foto .= '         </div>
                                    </td>
                                </tr>
                            </table>';
        }
