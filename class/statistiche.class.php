<?php
/**
 * CRM 
 * @author Marcello Visigalli < marcello.visigalli@gmail.com >
 * @version 3.0
 * @name QUOTO!
 */
class statistiche
{
    function NomeSito($idsito){
        global $dbMysqli;
    
        $sel = "SELECT web as sitoweb
                    FROM siti
                    WHERE siti.idsito = ".$idsito;
        $rw = $dbMysqli->query($sel);
        $rwc = $rw[0];

        return $rwc['sitoweb'];
    
    }

    function fatturatoTotale($n_format=null){
        global $dbMysqli,$filter_query,$idsito;
    
    
        $sel = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                    FROM hospitality_guest
                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                    WHERE 1=1
                    AND hospitality_guest.idsito = ".$idsito."
                    AND hospitality_guest.NoDisponibilita = 0
                    AND hospitality_guest.Hidden = 0
                    AND hospitality_guest.Disdetta = 0
                    AND hospitality_guest.TipoRichiesta = 'Conferma'
                    ".$filter_query." ";
        $rw = $dbMysqli->query($sel);
        $rwc = $rw[0];
        if($n_format){
            return $rwc['fatturato'];
        }else{
            return number_format($rwc['fatturato'],2,',','.');
        }
    
    }
    function fatturatoTotaleSitoWeb($n_format=null){
        global $dbMysqli,$filter_query,$idsito;
    
    
        $sel = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                    FROM hospitality_guest
                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                    WHERE hospitality_guest.FontePrenotazione = 'Sito Web'
                    AND hospitality_guest.idsito = ".$idsito."
                    AND hospitality_guest.NoDisponibilita = 0
                    AND hospitality_guest.Hidden = 0
                    AND hospitality_guest.Disdetta = 0
                    AND hospitality_guest.TipoRichiesta = 'Conferma'
                    ".$filter_query." ";
        $rw = $dbMysqli->query($sel);
        $rwc = $rw[0];
        if($n_format){
            return $rwc['fatturato'];
        }else{
            return number_format($rwc['fatturato'],2,',','.');
        }
    
    }
    function CountConfermateAds($idsito,$source,$medium){
        global $dbMysqli,$filter_query,$idsito;
    
        $sql      = "   SELECT 
                            hospitality_guest.* 
                        FROM 
                            hospitality_guest 
                        INNER JOIN 
                            hospitality_utm_ads 
                        ON 
                            (hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                        AND
                            hospitality_utm_ads.idsito = hospitality_guest.idsito)
                        WHERE 
                            1 = 1
                            ".$filter_query."
                        AND 
                            hospitality_guest.idsito = ".$idsito." 
                        AND 
                        hospitality_utm_ads.idsito = ".$idsito." 
                        AND 
                            hospitality_guest.TipoRichiesta = 'Conferma' 
                        AND 
                            hospitality_guest.FontePrenotazione = 'Sito Web' 
                        AND 
                            hospitality_guest.NoDisponibilita = 0
                        AND 
                            hospitality_guest.Disdetta = 0
                        AND 
                            hospitality_guest.Hidden = 0
                        AND
                            hospitality_utm_ads.utm_source = '".$source."'
                        AND
                            hospitality_utm_ads.utm_medium = '".$medium."'";
    
        $rw = $dbMysqli->query($sql);
        $rwc = sizeof($rw);
    
            return $rwc;
    
    }
    function CountInviateAds($idsito,$source,$medium){
        global $dbMysqli,$filter_query,$idsito;
    
    
        $sql      = "   SELECT 
                            hospitality_guest.* 
                        FROM 
                            hospitality_guest 
                        INNER JOIN 
                            hospitality_utm_ads 
                        ON 
                            (hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                        AND
                            hospitality_utm_ads.idsito = hospitality_guest.idsito)
                        WHERE 
                            1 = 1
                            ".$filter_query."
                        AND 
                            hospitality_guest.idsito = ".$idsito." 
                        AND 
                        hospitality_utm_ads.idsito = ".$idsito." 
                        AND 
                            hospitality_guest.TipoRichiesta = 'Preventivo' 
                        AND 
                            hospitality_guest.FontePrenotazione = 'Sito Web' 
                        AND 
                            hospitality_guest.NoDisponibilita = 0
                        AND 
                            hospitality_guest.Disdetta = 0
                        AND 
                            hospitality_guest.Hidden = 0
                        AND 
                            hospitality_guest.Inviata = 1
                        AND
                            hospitality_utm_ads.utm_source = '".$source."'
                        AND
                            hospitality_utm_ads.utm_medium = '".$medium."'";
    
        $rw = $dbMysqli->query($sql);
        $rwc = sizeof($rw);
    
            return $rwc;
    
    }
    function CountRicevuteAds($idsito,$source,$medium){
        global $dbMysqli,$filter_query,$idsito;
    
        $sql      = "   SELECT 
                            hospitality_guest.* 
                        FROM 
                            hospitality_guest 
                        INNER JOIN 
                            hospitality_utm_ads 
                        ON 
                            (hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                        AND
                            hospitality_utm_ads.idsito = hospitality_guest.idsito)
                        WHERE 
                            1 = 1
                            ".$filter_query."
                        AND 
                            hospitality_guest.idsito = ".$idsito." 
                        AND 
                            hospitality_utm_ads.idsito = ".$idsito." 
                        AND 
                            hospitality_guest.TipoRichiesta = 'Preventivo' 
                        AND 
                            hospitality_guest.FontePrenotazione = 'Sito Web' 
                        AND 
                            hospitality_guest.NoDisponibilita = 0
                        AND 
                            hospitality_guest.Disdetta = 0
                        AND 
                            hospitality_guest.Hidden = 0
                        AND
                            hospitality_utm_ads.utm_source = '".$source."'
                        AND
                            hospitality_utm_ads.utm_medium = '".$medium."'";
    
        $rw = $dbMysqli->query($sql);
        $rwc = sizeof($rw);
    
            return $rwc;
    
    }
       
       
    function CountRicevute($idsito){
        global $dbMysqli,$filter_query,$idsito;
    
     echo   $sql      = "   SELECT 
                            hospitality_guest.* 
                        FROM 
                            hospitality_guest 
                        OUTER JOIN 
                            hospitality_utm_ads 
                        ON 
                            (hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                        AND
                            hospitality_utm_ads.idsito = hospitality_guest.idsito)
                        WHERE 
                            1 = 1
                            ".$filter_query."
                        AND 
                            hospitality_guest.idsito = ".$idsito." 
                        AND 
                            hospitality_utm_ads.idsito = ".$idsito." 
                        AND 
                            hospitality_guest.TipoRichiesta = 'Preventivo' 
                        AND 
                            hospitality_guest.FontePrenotazione = 'Sito Web' 
                        AND 
                            hospitality_guest.NoDisponibilita = 0
                        AND 
                            hospitality_guest.Disdetta = 0
                        AND 
                            hospitality_guest.Hidden = 0";
    
        $rw = $dbMysqli->query($sql);
        $rwc = sizeof($rw);
    
            return $rwc;
    
    }
    function CountRichiesteRicevuteNotAds($idsito,$referrer,$dal, $al)
    {
        global $dbMysqli;
    
        $sitoweb   = $this->NomeSito($idsito);
        $sitoC     = explode("/",$sitoweb);
        $sito      = $sitoC[0];
        $sitoClean = str_replace("www.","",$sito);
        $sitoClean = str_replace(".it","",$sitoClean);
        $sitoClean = str_replace(".com","",$sitoClean);
        $sitoClean = str_replace(".net","",$sitoClean);
        $sitoClean = str_replace(".org","",$sitoClean);
        $sitoClean = str_replace(".eu","",$sitoClean);

        if(strstr($referrer,$sitoClean)){
            $AND = "AND u.referrer LIKE '%".$sitoClean."%'";
        }else{
            $AND = "AND u.referrer = '".$referrer."'";
        } 

        $select = " 	SELECT (g.Id) as n
                FROM hospitality_guest as g
                INNER JOIN hospitality_utm_ads as u ON (u.NumeroPrenotazione= g.NumeroPrenotazione AND u.idsito = g.idsito)
                WHERE 1 = 1
                ".$AND."
                AND u.utm_source = ''
                AND u.utm_medium = ''
                AND u.utm_campaign = ''
                AND u.idsito = " . $idsito . "
                AND g.idsito = " . $idsito . "
                AND g.DataRichiesta >= '" . $dal . "'
                AND g.DataRichiesta <= '" . $al . "'
                AND g.TipoRichiesta = 'Preventivo'
                AND g.FontePrenotazione = 'Sito Web'
                AND g.Hidden = 0
                AND g.NoDisponibilita = 0
                AND g.Disdetta = 0
                group by u.referrer,u.NumeroPrenotazione";
    
        $res = $dbMysqli->query($select);
        $record = sizeof($res);
    
        return  $record;
    }
    function CountRichiesteInviateNotAds($idsito,$referrer,$dal, $al)
    {
        global $dbMysqli;

        $sitoweb   = $this->NomeSito($idsito);
        $sitoC     = explode("/",$sitoweb);
        $sito      = $sitoC[0];
        $sitoClean = str_replace("www.","",$sito);
        $sitoClean = str_replace(".it","",$sitoClean);
        $sitoClean = str_replace(".com","",$sitoClean);
        $sitoClean = str_replace(".net","",$sitoClean);
        $sitoClean = str_replace(".org","",$sitoClean);
        $sitoClean = str_replace(".eu","",$sitoClean);

        if(strstr($referrer,$sitoClean)){
            $AND = "AND u.referrer LIKE '%".$sitoClean."%'";
        }else{
            $AND = "AND u.referrer = '".$referrer."'";
        }      
    
       $select = " 	SELECT (g.Id) as n
                FROM hospitality_guest as g
                INNER JOIN hospitality_utm_ads as u ON (u.NumeroPrenotazione= g.NumeroPrenotazione AND u.idsito = g.idsito)
                WHERE 1 = 1
                ".$AND."
                AND u.utm_source = ''
                AND u.utm_medium = ''
                AND u.utm_campaign = ''
                AND u.idsito = " . $idsito . "
                AND g.idsito = " . $idsito . "
                AND g.DataRichiesta >= '" . $dal . "'
                AND g.DataRichiesta <= '" . $al . "'
                AND g.TipoRichiesta = 'Preventivo'
                AND g.FontePrenotazione = 'Sito Web'
                AND g.Hidden = 0
                AND g.Inviata = 1
                AND g.NoDisponibilita = 0
                AND g.Disdetta = 0
                group by u.referrer,u.NumeroPrenotazione";
    
        $res = $dbMysqli->query($select);
        $record = sizeof($res);
    
        return  $record;
    }
    function CountRichiesteConfermateNotAds($idsito,$referrer,$dal, $al)
    {
        global $dbMysqli;

        $sitoweb   = $this->NomeSito($idsito);
        $sitoC     = explode("/",$sitoweb);
        $sito      = $sitoC[0];
        $sitoClean = str_replace("www.","",$sito);
        $sitoClean = str_replace(".it","",$sitoClean);
        $sitoClean = str_replace(".com","",$sitoClean);
        $sitoClean = str_replace(".net","",$sitoClean);
        $sitoClean = str_replace(".org","",$sitoClean);
        $sitoClean = str_replace(".eu","",$sitoClean);

        if(strstr($referrer,$sitoClean)){
            $AND = "AND u.referrer LIKE '%".$sitoClean."%'";
        }else{
            $AND = "AND u.referrer = '".$referrer."'";
        }  
    
        $select = "SELECT (g.Id) as n
                FROM hospitality_guest as g
                INNER JOIN hospitality_utm_ads as u ON  (u.NumeroPrenotazione= g.NumeroPrenotazione AND u.idsito = g.idsito)  
                WHERE 1 = 1
                ".$AND."
                AND u.utm_source = ''
                AND u.utm_medium = ''
                AND u.utm_campaign = ''
                AND u.idsito = " . $idsito . "
                AND g.idsito = " . $idsito . "
                 AND((g.DataRichiesta >= '" . $dal . "'
                AND g.DataRichiesta <= '" . $al . "') OR(g.DataChiuso IS NOT NULL
                AND DATE(g.DataChiuso) >= '" . $dal . "'
                AND DATE(g.DataChiuso) <= '" . $al . "'))
                AND g.TipoRichiesta = 'Conferma'
                AND g.FontePrenotazione = 'Sito Web'
                AND g.Hidden = 0
                AND g.NoDisponibilita = 0
                AND g.Disdetta = 0 
                group by u.referrer,u.NumeroPrenotazione";
    
        $res = $dbMysqli->query($select);
        $record = sizeof($res);
    
    
        return $record;
    }
    function fatturatoReferrer($n_format=null,$referrer){
        global $dbMysqli,$filter_query,$idsito;

        $sitoweb   = $this->NomeSito($idsito);
        $sitoC     = explode("/",$sitoweb);
        $sito      = $sitoC[0];
        $sitoClean = str_replace("www.","",$sito);
        $sitoClean = str_replace(".it","",$sitoClean);
        $sitoClean = str_replace(".com","",$sitoClean);
        $sitoClean = str_replace(".net","",$sitoClean);
        $sitoClean = str_replace(".org","",$sitoClean);
        $sitoClean = str_replace(".eu","",$sitoClean);

        if(strstr($referrer,$sitoClean)){
            $AND = "AND hospitality_utm_ads.referrer LIKE '%".$sitoClean."%'";
        }else{
            $AND = "AND hospitality_utm_ads.referrer = '".$referrer."'";
        }
    
        $sel = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                    FROM hospitality_guest
                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                    INNER JOIN hospitality_utm_ads ON  (hospitality_utm_ads.NumeroPrenotazione= hospitality_guest.NumeroPrenotazione AND hospitality_utm_ads.idsito = hospitality_guest.idsito)  
                    WHERE hospitality_guest.FontePrenotazione = 'Sito Web'
                    AND hospitality_guest.idsito = ".$idsito."
                    AND hospitality_utm_ads.idsito = ".$idsito."
                    ".$AND."
                    AND hospitality_utm_ads.utm_source = ''
                    AND hospitality_guest.NoDisponibilita = 0
                    AND hospitality_guest.Hidden = 0
                    AND hospitality_guest.Disdetta = 0
                    AND hospitality_guest.TipoRichiesta = 'Conferma'
                    ".$filter_query." ";
        $rw = $dbMysqli->query($sel);
        $rwc = $rw[0];
        if($n_format){
            return $rwc['fatturato'];
        }else{
            return number_format($rwc['fatturato'],2,',','.');
        }
    
    }
    function CountRichiesteRicevute($idsito,$fonte,$dal,$al){
        global $dbMysqli;
    
        if($dal == '' && $al == ''){
            $dal = date('Y').'-01-01';
            $al = date('Y').'-12-31';
        }
    $select = " 	SELECT COUNT(Id) as n
                    FROM hospitality_guest as g
                    WHERE g.idsito = ".$idsito."
                    AND g.FontePrenotazione = '" . $fonte . "' 
                    AND g.DataRichiesta >= '" . $dal . "'
                    AND g.DataRichiesta <= '" . $al . "'
                    AND g.TipoRichiesta = 'Preventivo'
                    AND g.Hidden = 0
                    AND g.NoDisponibilita = 0
                    AND g.Disdetta = 0 ";
    
    
        $res = $dbMysqli->query($select);
        $record = $res[0]['n'];
        
        return $record;
    }
    function CountRichiesteInviate($idsito,$fonte,$dal,$al){
        global $dbMysqli;
    
        if($dal == '' && $al == ''){
            $dal = date('Y').'-01-01';
            $al = date('Y').'-12-31';
        }
    $select = " 	SELECT COUNT(Id) as n
                    FROM hospitality_guest as g
                    WHERE g.idsito = ".$idsito."
                    AND g.FontePrenotazione = '".$fonte."' AND((g.DataRichiesta >= '".$dal."'
                                                                    AND g.DataRichiesta <= '".$al."'))
                    AND g.TipoRichiesta = 'Preventivo'
                    AND g.Hidden = 0
                    AND g.Inviata = 1
                    AND g.NoDisponibilita = 0
                    AND g.Disdetta = 0 ";
    
    
        $res = $dbMysqli->query($select);
        $record = $res[0]['n'];
        
        return $record;
    }
    function CountRichiesteConfermate($idsito,$fonte,$dal,$al){
        global $dbMysqli;
    
        if($dal == '' && $al == ''){
            $dal = date('Y').'-01-01';
            $al = date('Y').'-12-31';
        }
    $select = " 	SELECT COUNT(Id) as n
                    FROM hospitality_guest as g
                    WHERE g.idsito = ".$idsito."
                    AND g.FontePrenotazione = '".$fonte."' AND((g.DataRichiesta >= '".$dal."'
                                                                    AND g.DataRichiesta <= '".$al."') OR(g.DataChiuso IS NOT NULL
                                                                                                                AND g.DataChiuso >= '".$dal."'
                                                                                                                AND g.DataChiuso <= '".$al."'))
                    AND g.TipoRichiesta = 'Conferma'
                    AND g.Hidden = 0
                    AND g.NoDisponibilita = 0
                    AND g.Disdetta = 0 ";
    
    
        $res = $dbMysqli->query($select);
        $record = $res[0]['n'];
        
        return $record;
    }
    
    
    function CountRichiesteAnnullate($idsito,$fonte,$dal,$al){
        global $dbMysqli;
    
        if($dal == '' && $al == ''){
            $dal = date('Y').'-01-01';
            $al = date('Y').'-12-31';
        }
    $select = " 	SELECT COUNT(Id) as n
                    FROM hospitality_guest as g
                    WHERE g.idsito = ".$idsito."
                    AND g.FontePrenotazione = '".$fonte."' AND((g.DataRichiesta >= '".$dal."'
                                                                    AND g.DataRichiesta <= '".$al."') OR(
                                                                    g.DataChiuso >= '".$dal."'
                                                                    AND g.DataChiuso <= '".$al."'))
                    AND g.TipoRichiesta = 'Conferma'
                    AND g.Hidden = 0
                    AND g.NoDisponibilita = 1
                    AND g.Disdetta = 0 ";
    
    
        $res = $dbMysqli->query($select);
        $record = $res[0]['n'];
        
        return $record;
    }

    function fatturato_per_campagna($idsito, $campagna, $source, $medium,$filter_query)
    {
        global $dbMysqli;
    
        $sl = "SELECT 
        
                    ( SELECT hospitality_proposte.PrezzoP FROM hospitality_proposte  WHERE hospitality_proposte.id_richiesta = hospitality_guest.Id LIMIT 1) as 'fatturato'
                        FROM 
                            hospitality_guest
                        INNER JOIN 
                            hospitality_utm_ads ON (
                                    hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione 
                                AND 
                                    hospitality_utm_ads.idsito = hospitality_guest.idsito 
                                )  
                        WHERE 
                            1=1
                            " . $filter_query . "
                        AND 
                            hospitality_guest.idsito = " . $idsito . "
                        AND 
                            hospitality_guest.FontePrenotazione = 'Sito Web'
                        AND 
                            hospitality_guest.Disdetta = 0
                        AND 
                            hospitality_guest.Hidden = 0
                        AND 
                            hospitality_guest.NoDisponibilita = 0
                        AND 
                            hospitality_guest.TipoRichiesta = 'Conferma' 
                        AND 
                            hospitality_utm_ads.idsito = " . $idsito . "
                        AND 
                            hospitality_utm_ads.utm_source = '".$source."'
                        AND 
                            hospitality_utm_ads.utm_medium = '".$medium."'
                        AND 
                            hospitality_utm_ads.utm_campaign = '" . addslashes($campagna) . "' 
    
                        GROUP BY 
                            hospitality_guest.Id";
    
        $rec = $dbMysqli->query($sl);
    
        if (sizeof($rec) > 0) {
            foreach ($rec as $key => $value) {
                $arraytotalePerCampagna[] = $value['fatturato'];
            }
            $output = array_sum($arraytotalePerCampagna);
        } else {
            $output = 0;
        }
    
        return $output;
    
    }
    function CountConfermateCampagnaAds($idsito,$campagna, $source, $medium,$filter_query){
        global $dbMysqli;
    
         $sql      = "   SELECT 
                            hospitality_guest.* 
                        FROM 
                            hospitality_guest 
                        INNER JOIN 
                            hospitality_utm_ads ON (
                                    hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione 
                                AND 
                                    hospitality_utm_ads.idsito = hospitality_guest.idsito 
                                )  
                        WHERE 
                            1 = 1
                            ".$filter_query."
                        AND 
                            hospitality_guest.idsito = ".$idsito." 
                        AND 
                            hospitality_guest.TipoRichiesta = 'Conferma' 
                        AND 
                            hospitality_guest.FontePrenotazione = 'Sito Web' 
                        AND 
                            hospitality_guest.NoDisponibilita = 0
                        AND 
                            hospitality_guest.Disdetta = 0
                        AND 
                            hospitality_guest.Hidden = 0
                        AND 
                            hospitality_utm_ads.utm_source = '".$source."'
                        AND 
                            hospitality_utm_ads.utm_medium = '".$medium."'
                        AND 
                            hospitality_utm_ads.utm_campaign = '" . addslashes($campagna) . "'
                        AND 
                            hospitality_utm_ads.idsito = ".$idsito." 
                        GROUP BY
                            hospitality_utm_ads.NumeroPrenotazione";
    
        $rw = $dbMysqli->query($sql);
        $rwc = sizeof($rw);
    
            return $rwc;
    
    }
    function CountInviateCampagnaAds($idsito,$campagna, $source, $medium,$filter_query){
        global $dbMysqli;
    
        $sql      = "   SELECT 
                            hospitality_guest.* 
                        FROM 
                            hospitality_guest 
                        INNER JOIN 
                            hospitality_utm_ads ON (
                                    hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione 
                                AND 
                                    hospitality_utm_ads.idsito = hospitality_guest.idsito 
                                ) 
                        WHERE 
                            1 = 1
                            ".$filter_query."
                        AND 
                            hospitality_guest.idsito = ".$idsito." 
                        AND 
                            hospitality_guest.TipoRichiesta = 'Preventivo' 
                        AND 
                            hospitality_guest.FontePrenotazione = 'Sito Web' 
                        AND 
                            hospitality_guest.NoDisponibilita = 0
                        AND 
                            hospitality_guest.Disdetta = 0
                        AND 
                            hospitality_guest.Hidden = 0
                        AND 
                            hospitality_guest.Inviata = 1
                        AND 
                            hospitality_utm_ads.utm_source = '".$source."'
                        AND 
                            hospitality_utm_ads.utm_medium = '".$medium."'
                        AND 
                            hospitality_utm_ads.utm_campaign = '" . addslashes($campagna) . "'
                        AND 
                            hospitality_utm_ads.idsito = ".$idsito." 
                        GROUP BY
                            hospitality_utm_ads.NumeroPrenotazione";
    
        $rw = $dbMysqli->query($sql);
        $rwc = sizeof($rw);
    
            return $rwc;
    
    }
    function CountRicevuteCampagnaAds($idsito,$campagna, $source, $medium,$filter_query){
        global $dbMysqli;
    
        $sql      = "   SELECT 
                            hospitality_guest.* 
                        FROM 
                            hospitality_guest 
                        INNER JOIN 
                            hospitality_utm_ads ON (
                                    hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione 
                                AND 
                                    hospitality_utm_ads.idsito = hospitality_guest.idsito 
                                ) 
                        WHERE 
                            1 = 1
                            ".$filter_query."
                        AND 
                            hospitality_guest.idsito = ".$idsito." 
                        AND 
                            hospitality_guest.TipoRichiesta = 'Preventivo' 
                        AND 
                            hospitality_guest.FontePrenotazione = 'Sito Web' 
                        AND 
                            hospitality_guest.NoDisponibilita = 0
                        AND 
                            hospitality_guest.Disdetta = 0
                        AND 
                            hospitality_guest.Hidden = 0
                        AND 
                            hospitality_utm_ads.utm_source = '".$source."'
                        AND 
                            hospitality_utm_ads.utm_medium = '".$medium."'
                        AND 
                            hospitality_utm_ads.utm_campaign = '" . addslashes($campagna) . "' 
                        AND 
                            hospitality_utm_ads.idsito = ".$idsito." ";
    
        $rw = $dbMysqli->query($sql);
        $rwc = sizeof($rw);
    
            return $rwc;
    
    }

    function fatt_sorgente_web($idsito,$filter_query){

        global $dbMysqli;

        $sl = "SELECT SUM(fatturato) as fatt,
                        sorgente,
                        media
                FROM (
                    SELECT 
                        CASE 
                            WHEN TipoRichiesta = 'Conferma' THEN
                                hospitality_proposte.PrezzoP
                            ELSE
                                0
                        END as fatturato,
                            hospitality_utm_ads.utm_source as sorgente,
                            hospitality_utm_ads.utm_medium as media
                    FROM hospitality_guest
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                INNER JOIN 
                                hospitality_utm_ads 
                            ON 
                                (hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                            AND
                                hospitality_utm_ads.idsito = hospitality_guest.idsito)                   
                    WHERE 1 = 1
                        $filter_query
                        AND hospitality_guest.idsito = " . $idsito . "
                        AND hospitality_guest.FontePrenotazione = 'Sito Web'
                        AND hospitality_guest.Disdetta = 0
                        AND hospitality_guest.NoDisponibilita = 0
                        AND hospitality_guest.Hidden = 0
                        AND hospitality_utm_ads.idsito = " . $idsito . "
                ) as sub
        GROUP BY sorgente, media";
        
        $rws_ = $dbMysqli->query($sl);
        foreach ($rws_ as $y => $va) {
            if($va['sorgente']!=''){
                $array_fatturatoS[] = array('fatturato' => $va['fatt'],'source' => $va['sorgente'], 'medium' => $va['media']);
            }
        }
        
        return $array_fatturatoS;
    }

    function fatt_sorgente_web_referrer($idsito,$filter_query){

        global $dbMysqli;

        $sitoweb   = $this->NomeSito($idsito);
        $sitoC     = explode("/",$sitoweb);
        $sito      = $sitoC[0];
        $sitoClean = str_replace("www.","",$sito);
        $sitoClean = str_replace(".it","",$sitoClean);
        $sitoClean = str_replace(".com","",$sitoClean);
        $sitoClean = str_replace(".net","",$sitoClean);
        $sitoClean = str_replace(".org","",$sitoClean);
        $sitoClean = str_replace(".eu","",$sitoClean);

        if(strstr($referrer,$sitoClean)){
            $GROUP = "GROUP BY CASE
                        referrer
                            WHEN referrer LIKE '%".$sitoClean."%' THEN referrer
                                                            ELSE 0
                        END";
        }else{
            $GROUP = "GROUP BY CASE
                    referrer
                        WHEN referrer LIKE '%".$referrer."%' THEN referrer
                                                        ELSE 0
                    END";
        }

        $sel = "SELECT DISTINCT(hospitality_utm_ads.referrer)
                , CASE
                    referrer 
                    WHEN referrer NOT LIKE 'https://%' THEN '' 
                    WHEN referrer  NOT LIKE 'http://%' THEN ''
                    ELSE '(direct)' 
                END AS new_referrer
            FROM hospitality_guest INNER JOIN
                hospitality_utm_ads ON (hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                                    AND hospitality_utm_ads.idsito = hospitality_guest.idsito)
            WHERE hospitality_guest.FontePrenotazione = 'Sito Web'
            AND hospitality_guest.idsito = ".$idsito."
            AND hospitality_utm_ads.idsito = ".$idsito." ".$filter_query."
            AND hospitality_guest.NoDisponibilita = 0
            AND hospitality_guest.Hidden = 0
            AND hospitality_guest.Disdetta = 0
            AND hospitality_utm_ads.referrer != ''
            AND (	hospitality_utm_ads.referrer NOT LIKE '%gclid%' 
                AND 
                    hospitality_utm_ads.referrer NOT LIKE '%campagna%'
                AND 
                    hospitality_utm_ads.referrer NOT LIKE '%fbclid%'
                AND 
                    hospitality_utm_ads.referrer NOT LIKE '%wbraid%'
                AND 
                    hospitality_utm_ads.referrer NOT LIKE '%_ga%'
                )
            AND hospitality_utm_ads.utm_source = ''
            AND hospitality_utm_ads.utm_medium = ''
            AND hospitality_utm_ads.utm_campaign = ''
            GROUP BY CASE
            referrer
                WHEN referrer LIKE '%".$sitoClean."%' THEN referrer
                                                ELSE 0
            END";

        $rws = $dbMysqli->query($sel);

        return $rws;
    } 

    function fonti_prenotazione($idsito){

        global $dbMysqli;

        $select = "SELECT 
                        FontePrenotazione, 
                        Abilitato 
                    FROM 
                        hospitality_fonti_prenotazione 
                    WHERE 
                        idsito = " . $idsito . "";
        $rws = $dbMysqli->query($select);
        $tot = sizeof($rws);

        return $tot;
    }

    function fatt_fonti_prenotazione($idsito,$filter_query){

        global $dbMysqli;

        $select = "SELECT 
                        FontePrenotazione, 
                        Abilitato 
                    FROM 
                        hospitality_fonti_prenotazione 
                    WHERE 
                        idsito = " . $idsito . "";
        $rws = $dbMysqli->query($select);
        $tot = sizeof($rws);
        if ($tot > 0) {
            foreach ($rws as $key => $value) {
                $select2 = "SELECT 
                                SUM(hospitality_proposte.PrezzoP) as fatturato 
                            FROM 
                                hospitality_guest 
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id 
                            WHERE 
                                hospitality_guest.FontePrenotazione = '" . addslashes($value['FontePrenotazione']) . "' " . $filter_query . " 
                                AND hospitality_guest.idsito = " . $idsito . " 
                                AND hospitality_guest.NoDisponibilita = 0 
                                AND hospitality_guest.Disdetta = 0 
                                AND hospitality_guest.Hidden = 0 
                                AND hospitality_guest.TipoRichiesta = 'Conferma'";

                $res2 = $dbMysqli->query($select2);
                $rws2 = $res2[0];
                $fatturato = $rws2['fatturato'];
                if ($fatturato == '') {
                    $fatturato = 0;
                }

                $array_fatturato[$value['FontePrenotazione'] . '_' . $value['Abilitato']] = $fatturato;
            }

        }

    return $array_fatturato;
}

function fatt_fonti_prenotazione_annullate($idsito,$filter_query){

        global $dbMysqli;

        $select = "SELECT 
                        FontePrenotazione, 
                        Abilitato 
                    FROM 
                        hospitality_fonti_prenotazione 
                    WHERE 
                        idsito = " . $idsito . "";
        $rws = $dbMysqli->query($select);
        $tot = sizeof($rws);
        if ($tot > 0) {
            foreach ($rws as $key => $value) {
    
                $select3 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                    , COUNT(hospitality_guest.Id) as n
                            FROM hospitality_guest 
                            INNER JOIN
                                hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                            WHERE hospitality_guest.FontePrenotazione = '" . addslashes($value['FontePrenotazione']) . "' " . $filter_query . "
                            AND hospitality_guest.idsito = " . $idsito . "
                            AND hospitality_guest.NoDisponibilita = 1
                            AND hospitality_guest.Disdetta = 0
                            AND hospitality_guest.Hidden = 0
                            AND hospitality_guest.TipoRichiesta = 'Conferma'";
                $res3 = $dbMysqli->query($select3);
                $rws3 = $res3[0];

                if (sizeof($res3) > 0) {
                    $fatturatoD = $rws3['fatturato'];
                    if ($fatturatoD == '') {
                        $fatturatoD = 0;
                    }

                    $array_fatturatoD[$value['FontePrenotazione'] . '_' . $value['Abilitato'] . '_' . $rws3['n']] = $fatturatoD;

                }

            }
    
        }
    return $array_fatturatoD;
}

function fatt_target($idsito,$filter_query){

    global $dbMysqli;

    $select18 = "SELECT Target
                    FROM hospitality_target
                    WHERE idsito = " . $idsito . "
                    ORDER BY Id ASC";
    $rws18 = $dbMysqli->query($select18);
    $totTARGET = sizeof($rws18);
    if ($totTARGET > 0) {
        foreach ($rws18 as $key18 => $value18) {

            
            $select19 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                            FROM hospitality_guest 
                            INNER JOIN
                                hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                            WHERE hospitality_guest.TipoVacanza = '" . $value18['Target'] . "' " . $filter_query . "
                            AND hospitality_guest.idsito = " . $idsito . "
                            AND hospitality_guest.NoDisponibilita = 0
                            AND hospitality_guest.Disdetta = 0
                            AND hospitality_guest.Hidden = 0
                            AND hospitality_guest.TipoRichiesta = 'Conferma'";
            $res19 = $dbMysqli->query($select19);
            $rws19 = $res19[0];
            $fatturatoTARGET = $rws19['fatturato'];
            if ($fatturatoTARGET == '') {
                $fatturatoTARGET = 0;
            }

            if ($fatturatoTARGET != '' || $fatturatoTARGET != 0) {

                $array_fatturatoTARGET[$value18['Target']] = $fatturatoTARGET;
            }

        }
    }

    return $array_fatturatoTARGET;
}

function fatt_operatore($idsito,$filter_query){

    global $dbMysqli;

    $select15 = "SELECT *
                    FROM hospitality_operatori
                    WHERE idsito = " . $idsito . "";
        $rws15 = $dbMysqli->query($select15);
        $totOperatore = sizeof($rws15);
    if ($totOperatore > 0) {

        $operatore = '';
        $abilitatoOP = '';

        foreach ($rws15 as $key15 => $value15) {

            $operatore = trim(addslashes($value15['NomeOperatore']));
            $abilitatoOP = $value15['Abilitato'];

            
            $select16 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                            FROM hospitality_guest 
                            INNER JOIN
                                hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                            WHERE hospitality_guest.ChiPrenota = '" . $operatore . "' " . $filter_query . "
                            AND hospitality_guest.idsito = " . $idsito . "
                            AND hospitality_guest.NoDisponibilita = 0
                            AND hospitality_guest.Disdetta = 0
                            AND hospitality_guest.Hidden = 0
                            AND hospitality_guest.TipoRichiesta = 'Conferma'";
            $res16 = $dbMysqli->query($select16);
            $rws16 = $res16[0];
            $fatturatoOperatore = $rws16['fatturato'];
            if ($fatturatoOperatore == '') {
                $fatturatoOperatore = 0;
            }

            $array_fatturatoOperatore[$operatore . '_' . $abilitatoOP] = $fatturatoOperatore;
        }
    }

    return $array_fatturatoOperatore;
}


function fatt_template($idsito,$filter_query){

    global $dbMysqli;

    $select20 = "SELECT *
                    FROM hospitality_template_background
                    WHERE idsito = " . $idsito . "";
        $rws20 = $dbMysqli->query($select20);
        $totTemplate = sizeof($rws20);

        if ($totTemplate > 0) {

            $template = '';
            $NomeTemplate = '';

            foreach ($rws20 as $key20 => $value20) {

                $template = $value20['Id'];
                $NomeTemplate = $value20['TemplateName'];

                
                $select21 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                FROM hospitality_guest 
                                INNER JOIN
                                    hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                WHERE 1=1
                                AND hospitality_guest.id_template = '" . $template . "' " . $filter_query . "
                                AND hospitality_guest.idsito = " . $idsito . "
                                AND hospitality_guest.NoDisponibilita = 0
                                AND hospitality_guest.Disdetta = 0
                                AND hospitality_guest.Hidden = 0
                                AND hospitality_guest.TipoRichiesta = 'Conferma'";
                $res21 = $dbMysqli->query($select21);
                $rws21 = $res21[0];
                $fatturatoTemplate = $rws21['fatturato'];
                if ($fatturatoTemplate == '') {
                    $fatturatoTemplate = 0;
                }

                $array_fatturatoTemplate[$NomeTemplate] = $fatturatoTemplate;
            }
        }

        return $array_fatturatoTemplate;
}

function fatt_utm($idsito,$filter_query,$source,$medium){

    global $dbMysqli;
    
    $selectn = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                FROM hospitality_guest INNER JOIN
                    hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id INNER JOIN
                    hospitality_utm_ads ON (hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                                        AND hospitality_utm_ads.idsito = hospitality_guest.idsito)
                WHERE 1=1 " . $filter_query . "
                AND hospitality_guest.idsito = " . $idsito . "
                AND hospitality_guest.FontePrenotazione = 'Sito Web'
                AND hospitality_guest.Disdetta = 0
                AND hospitality_guest.Hidden = 0
                AND hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.TipoRichiesta = 'Conferma'
                AND hospitality_utm_ads.utm_source = '".$source."'
                AND hospitality_utm_ads.utm_medium = '".$medium."'
                AND hospitality_utm_ads.idsito = " . $idsito . "";
    $resn = $dbMysqli->query($selectn);
    $rwn = $resn[0];
    $totalePPCn = $rwn['fatturato'];

    return $totalePPCn;
}

function campagne_utm($idsito,$source,$medium){

    global $dbMysqli;

    $select9n = "SELECT distinct(hospitality_utm_ads.utm_campaign) as Campagna
                    FROM hospitality_utm_ads
                    WHERE hospitality_utm_ads.idsito = " . $idsito . "
                    AND hospitality_utm_ads.utm_source = '".$source."'
                    AND hospitality_utm_ads.utm_medium = '".$medium."'
                    AND hospitality_utm_ads.utm_campaign != ''";
    $rws9n = $dbMysqli->query($select9n);

    return $rws9n;
}

function dett_preno_sitoweb_utm($idsito,$filtroQuery,$source,$medium){

    global $dbMysqli;

    $sql      = "   SELECT 
                        hospitality_guest.* 
                    FROM 
                        hospitality_guest 
                    INNER JOIN 
                        hospitality_utm_ads 
                    ON 
                        (hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                    AND
                        hospitality_utm_ads.idsito = hospitality_guest.idsito)

                    WHERE 
                        1 = 1
                        ".$filtroQuery."
                    AND 
                        hospitality_guest.idsito = ".$idsito." 
                    AND 
                        hospitality_guest.TipoRichiesta = 'Conferma' 
                    AND 
                        hospitality_guest.FontePrenotazione = 'Sito Web' 
                    AND 
                        hospitality_guest.NoDisponibilita = 0
                    AND 
                        hospitality_guest.Disdetta = 0
                    AND 
                        hospitality_guest.Hidden = 0
                    AND
                        hospitality_utm_ads.utm_source = '".$source."'
                    AND
                        hospitality_utm_ads.utm_medium = '".$medium."' 
                    AND 
                        hospitality_utm_ads.idsito = ".$idsito." ";

    $rws9n = $dbMysqli->query($sql);

    return $rws9n;
}

function fatt_dett_preno_sitoweb_utm($id){

    global $dbMysqli;

    $sel = "SELECT 
                SUM(hospitality_proposte.PrezzoP) as fatturato
            FROM 
                hospitality_guest
            INNER JOIN 
                hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
            WHERE 
                hospitality_guest.Id = ".$id;
    $rws9n = $dbMysqli->query($sel);
    $rec   = $rws9n[0];

    return $rec;
}

function dett_preno_sitoweb_referrer($idsito,$filtroQuery){

    global $dbMysqli;

    $sql      = "   SELECT 
                        hospitality_guest.*,hospitality_utm_ads.utm_source 
                    FROM 
                        hospitality_guest 

                    INNER JOIN 
                            hospitality_utm_ads ON (
                                    hospitality_utm_ads.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione 
                                AND 
                                    hospitality_utm_ads.idsito = hospitality_guest.idsito 
                                ) 
                    WHERE 
                        1 = 1
                        ".$filtroQuery."
                    AND 
                        hospitality_guest.idsito = ".$idsito." 
                    AND 
                        hospitality_guest.TipoRichiesta = 'Conferma' 
                    AND 
                        hospitality_guest.FontePrenotazione = 'Sito Web'          
                    AND 
                        hospitality_guest.Disdetta = 0
                    AND 
                        hospitality_guest.Hidden = 0
                    AND 
                        hospitality_guest.NoDisponibilita = 0
                    AND
                        hospitality_utm_ads.utm_medium = '' 
                    AND 
                        hospitality_utm_ads.idsito = ".$idsito."";

    $rws9n = $dbMysqli->query($sql);

    return $rws9n;
}




}