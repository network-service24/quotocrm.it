<?php
require_once __DIR__.'/functions.class.php';
/**
 *
 */
class PerformizeFunctions extends functions
{

    /**
     * @var MysqliDb
     */
    private $dbMysqli;


    /**
     * @var string data in formato Y-m-d
     */
    private $data_inizio_periodo;
    /**
     * @var string data in formato Y-m-d
     */
    private $data_fine_periodo;
    /**
     * @var int numero di giorni che intercorre tra le due date
     */
    private $numeroGiorni;
    /**
     * @var
     */
    private $numeroGiorniADR;

    /**
     * @var int
     */
    private $id_sito;

    /**
     * @param $dbMysqli
     */
    public function __construct($dbMysqli, $id_sito)
    {
        $this->dbMysqli = $dbMysqli;
        $this->setIdSito($id_sito);
    }


    /**
     * Inizializza data inizio e fine (gli estremi) del'intervallo temporale da analizzare
     * @param string|null $dateRequest
     * @return void
     */
    public function setDatesFromRequest(?string $dateRequest = null)
    {
        if ($dateRequest != '') {
            $date_tmp = explode("-", $dateRequest);
            $data_1_tmp = trim($date_tmp[0]);
            $data_2_tmp = trim($date_tmp[1]);
            $prima_data_tmp = explode("/", $data_1_tmp);
            $seconda_data_tmp = explode("/", $data_2_tmp);
            $this->data_inizio_periodo = $prima_data_tmp[2] . '-' . $prima_data_tmp[1] . '-' . $prima_data_tmp[0];
            $this->data_fine_periodo = $seconda_data_tmp[2] . '-' . $seconda_data_tmp[1] . '-' . $seconda_data_tmp[0];
            $this->numeroGiorni = $this->dateDifference($this->data_inizio_periodo, $this->data_fine_periodo);
            $this->numeroGiorniADR = $this->numeroGiorni + 1;
        } else {
            $this->data_inizio_periodo = date('Y') . '-01-01';
            $this->data_fine_periodo = date('Y-m-d');
            $this->numeroGiorni = $this->dateDifference($this->data_inizio_periodo, date('Y-m-d'));
            $this->numeroGiorniADR = $this->numeroGiorni + 1;
        }
    }


    /**
     * Ottiene la data di inizio periodo modificata in base al parametro diff_year.
     *
     * @param int|null $diff_year Il numero di anni da aggiungere o sottrarre. Default a null.
     * @return string Data di inizio periodo modificata.
     */
    public function getDataInizioperiodo(?int $diff_year = null): string
    {
        if ($diff_year !== null) {
            // Calcola la data modificata aggiungendo o sottraendo anni
            return date('Y-m-d', strtotime($diff_year . ' year', strtotime($this->data_inizio_periodo)));
        }

        // Se diff_year è null, restituisce la data originale
        return $this->data_inizio_periodo;
    }


    /**
     * Ottiene la data di fine periodo modificata in base al parametro diff_year.
     *
     * @param int|null $diff_year Il numero di anni da aggiungere o sottrarre. Default a null.
     * @return string Data di fine periodo modificata.
     */
    public function getDataFineperiodo(?int $diff_year = null): string
    {
        if ($diff_year !== null) {
            // Calcola la data modificata aggiungendo o sottraendo anni
            return date('Y-m-d', strtotime($diff_year . ' year', strtotime($this->data_fine_periodo)));
        }

        // Se diff_year è null, restituisce la data originale
        return $this->data_fine_periodo;
    }

    // Setter for id_sito
    public function setIdSito($id_sito)
    {
        $this->id_sito = $id_sito;
    }

    // Getter for id_sito
    public function getIdSito()
    {
        return $this->id_sito;
    }

    /**
     * @param $date1
     * @param $date2
     * @return false|int
     * @throws Exception
     */
    private function dateDifference($date1, $date2)
    {
        $datetime1 = new DateTime($date1);
        $datetime2 = new DateTime($date2);
        $interval = $datetime1->diff($datetime2);
        return $interval->days;
    }

    private static $queryCache = [];
    /**
     * Esegue una query SQL
     * @param $sql
     * @return array
     */
    protected function query($sql)
    {
        $profile=true;

        $anotherLogFile = $_SERVER['DOCUMENT_ROOT'].'/log/query_'.($this->getIdSito()??'').'.log';
        // Calcola l'MD5 dell'sql
        $hash = md5($sql);
        $time = microtime();
        $method = array_reverse(debug_backtrace());
        // Verifica se il risultato è già nella cache
        if (isset(self::$queryCache[$hash]))
        {

            // Restituisce il risultato dalla cache se disponibile
            if(true===$profile) {
                $elapsed = microtime() - $time;
                $msg=sprintf('%s - %s -%s', $elapsed, json_encode($method[1]['function']), str_replace(["\n","\r"],'',$sql));
               error_log($msg, 3, $anotherLogFile);
           }

            return self::$queryCache[$hash];
        }



        $ret = $this->dbMysqli->query($sql);

        // Salva il risultato nella cache
        self::$queryCache[$hash] = $ret;

        if(true===$profile) {
            $elapsed = microtime() - $time;
            $msg=sprintf('%s - %s -%s', $elapsed, json_encode($method[1]['function']), str_replace(["\n","\r"],'',$sql));
               error_log($msg, 3, $anotherLogFile);
           }


         return $ret;
    }

    /**
     * tot_preventivi
     *
     * @return int
     */
    public function tot_preventivi()
    {
//        global $prima_data, $seconda_data;
//        $sel = 'SELECT
//						COUNT(Id) as tot_preventivi
//					FROM
//						hospitality_guest
//					WHERE
//						TipoRichiesta = "Preventivo"
//					AND
//						hospitality_guest.Hidden = 0
//
//					AND
//						hospitality_guest.idsito = ' . IDSITO . '
//					' . ($_REQUEST['date'] == '' ? '
//					AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . date('Y') . '" )
//					' : '
//					AND
//						(hospitality_guest.DataRichiesta >= "' . $prima_data . '" AND hospitality_guest.DataRichiesta <= "' . $seconda_data . '")'
//            ) . '';
//
//        $res = $this->query($sel);
//        $rw = $res[0];
//
//        return $rw['tot_preventivi'];

        $sel = "SELECT COUNT(Id) as tot_preventivi
                FROM hospitality_guest
                WHERE TipoRichiesta = 'Preventivo'
				AND
					hospitality_guest.Hidden = 0
				AND
					hospitality_guest.Chiuso = 0
				AND
					hospitality_guest.Accettato = 0
				AND
					hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.idsito = " . $this->getIdSito() . "
                AND (hospitality_guest.DataRichiesta >= '" . $this->getDataInizioperiodo() . "' 
                AND hospitality_guest.DataRichiesta <= '" . $this->getDataFineperiodo() . "')";

        $res = $this->query($sel);
        $rw = $res[0];
        return $rw['tot_preventivi'];
    }

    /**
     * tot_preventivi_periodo
     *
     * @return void
     */
    public function tot_preventivi_periodo():int
    {
//        global $prima_data_tmp, $seconda_data_tmp;
//
//        $prima   = ($prima_data_tmp[2]-1).'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
//        $seconda = ($seconda_data_tmp[2]-1).'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];
//
//        $sel = 'SELECT
//						COUNT(Id) as tot_preventivi
//					FROM
//						hospitality_guest
//					WHERE
//						TipoRichiesta = "Preventivo"
//					AND
//						hospitality_guest.Hidden = 0
//					AND
//						hospitality_guest.idsito = ' . IDSITO . '
//					' . ($_REQUEST['date'] == '' ? '
//					AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . (date('Y')-1) . '" )
//					' : '
//					AND
//						(hospitality_guest.DataRichiesta >= "' . $prima . '" AND hospitality_guest.DataRichiesta <= "' . $seconda . '")'
//            ) . '';
//        $res = $this->query($sel);
//        $rw = $res[0];
//
//        return $rw['tot_preventivi'];


        $sel = "SELECT COUNT(Id) as tot_preventivi
                FROM hospitality_guest
                WHERE TipoRichiesta = 'Preventivo'
				AND
					hospitality_guest.Hidden = 0
				AND
					hospitality_guest.Chiuso = 0
				AND
					hospitality_guest.Accettato = 0
				AND
					hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.idsito = " . $this->getIdSito() . "
                AND (hospitality_guest.DataRichiesta >= '" . $this->getDataInizioperiodo(-1) . "' 
                AND hospitality_guest.DataRichiesta <= '" . $this->getDataFineperiodo(-1) . "')";

        $res = $this->query($sel);
        $rw = $res[0];
        return intval($rw['tot_preventivi']);
    }

    /**
     * tot_invii
     *
     * @return int
     */
    public function tot_invii()
    {
//        global $prima_data, $seconda_data;
//
//        $res = $this->query('SELECT COUNT(Id) as tot_invii FROM hospitality_guest  WHERE TipoRichiesta = "Preventivo" AND idsito = ' . IDSITO . ' AND Chiuso = 0  AND Hidden = 0 AND DataInvio IS NOT NULL  ' . ($_REQUEST['date'] == '' ? 'AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . date('Y') . '" OR YEAR ( hospitality_guest.DataChiuso ) = "' . date('Y') . '" )' : 'AND (DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '")') . '');
//
//        $rws = $res[0];
//        return $rws['tot_invii'];

        $res = $this->query('SELECT COUNT(Id) as tot_invii FROM hospitality_guest  
                            WHERE TipoRichiesta = "Preventivo" AND idsito = ' . $this->getIdSito() . ' 
                            AND
                                hospitality_guest.Hidden = 0
                            AND
                                hospitality_guest.Chiuso = 0
                            AND
                                hospitality_guest.Accettato = 0
                            AND
					hospitality_guest.NoDisponibilita = 0 
                            AND DataInvio IS NOT NULL  
                            AND (DataRichiesta >= "' . $this->getDataInizioperiodo() . '" AND DataRichiesta <= "' . $this->getDataFineperiodo() . '")');

        $rws = $res[0];
        return $rws['tot_invii'];

    }

    /**
     * tot_invii_periodo
     *
     * @return int
     */
    public function tot_invii_periodo()
    {
//        global $prima_data_tmp, $seconda_data_tmp;
//
//        $prima = ($prima_data_tmp[2] - 1) . '-' . $prima_data_tmp[1] . '-' . $prima_data_tmp[0];
//        $seconda = ($seconda_data_tmp[2] - 1) . '-' . $seconda_data_tmp[1] . '-' . $seconda_data_tmp[0];
//
//        $res = $this->query('SELECT COUNT(Id) as tot_invii FROM hospitality_guest  WHERE TipoRichiesta = "Preventivo" AND idsito = ' . IDSITO . ' AND Chiuso = 0  AND Hidden = 0 AND DataInvio IS NOT NULL  ' . ($_REQUEST['date'] == '' ? 'AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . (date('Y') - 1) . '" OR YEAR ( hospitality_guest.DataChiuso ) = "' . (date('Y') - 1) . '" )' : 'AND (DataRichiesta >= "' . $prima . '" AND DataRichiesta <= "' . $seconda . '")') . '');
//
//        $rws = $res[0];
//        return $rws['tot_invii'];

        $res = $this->query('SELECT COUNT(Id) as tot_invii FROM hospitality_guest  
                            WHERE TipoRichiesta = "Preventivo" AND idsito = ' . $this->getIdSito() . ' 
                            AND
                                hospitality_guest.Hidden = 0
                            AND
                                hospitality_guest.Chiuso = 0
                            AND
                                hospitality_guest.Accettato = 0
                            AND
					            hospitality_guest.NoDisponibilita = 0 
                            AND DataInvio IS NOT NULL  
                            AND (DataRichiesta >= "' . $this->getDataInizioperiodo(-1) . '" AND DataRichiesta <= "' . $this->getDataFineperiodo(-1) . '")');

        $rws = $res[0];
        return $rws['tot_invii'];
    }

    /**
     * tot_conferme
     *
     * @return int
     */
    public function tot_conferme()
    {
//        global $prima_data, $seconda_data;
//
//        $res = $this->query('SELECT COUNT(Id) as tot_conferme FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = ' . IDSITO . '
//				AND
//					hospitality_guest.Hidden = 0
//				AND
//					hospitality_guest.Archivia = 0
//				AND
//					hospitality_guest.Chiuso = 0
//                AND
//                    hospitality_guest.Disdetta = 0
//
//				' . ($_REQUEST['date'] == '' ?
//                'AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . date('Y') . '")'
//                :
//                'AND (DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '")') . '
//				');
//
//        $rwr = $res[0];
//        return $rwr['tot_conferme'];


        $res = $this->query('SELECT COUNT(Id) as tot_conferme FROM hospitality_guest  
                            WHERE TipoRichiesta = "Conferma" 
                            AND idsito = ' . $this->getIdSito() . '
                            AND Hidden = 0 
                            AND Chiuso = 0 
                            AND Disdetta = 0 
                            AND Accettato = 0 
				            AND NoDisponibilita = 0
                            AND (DataRichiesta >= "' . $this->getDataInizioperiodo() . '" 
                            AND DataRichiesta <= "' . $this->getDataFineperiodo() . '")');

        $rwr = $res[0];
        return $rwr['tot_conferme'];
    }

    /**
     * tot_conferme_periodo
     *
     * @return int
     */
    public function tot_conferme_periodo():int
    {
//        global $prima_data_tmp, $seconda_data_tmp;
//
//        $prima = ($prima_data_tmp[2] - 1) . '-' . $prima_data_tmp[1] . '-' . $prima_data_tmp[0];
//        $seconda = ($seconda_data_tmp[2] - 1) . '-' . $seconda_data_tmp[1] . '-' . $seconda_data_tmp[0];
//
//        $res = $this->query('SELECT COUNT(Id) as tot_conferme FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = ' . IDSITO . '
//				AND
//					hospitality_guest.Hidden = 0
//				AND
//					hospitality_guest.Archivia = 0
//				AND
//					hospitality_guest.Chiuso = 0
//                AND
//                    hospitality_guest.Disdetta = 0
//
//				' . ($_REQUEST['date'] == '' ?
//                'AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . (date('Y') - 1) . '")'
//                :
//                'AND (DataRichiesta >= "' . $prima . '" AND DataRichiesta <= "' . $seconda . '")') . '
//				');
//
//        $rwr = $res[0];
//        return $rwr['tot_conferme'];


        $res = $this->query('SELECT COUNT(Id) as tot_conferme FROM hospitality_guest  
                            WHERE TipoRichiesta = "Conferma" 
                              AND idsito = ' . $this->getIdSito() . '
                            AND Hidden = 0 
                            AND Chiuso = 0 
                            AND Disdetta = 0 
                            AND Accettato = 0 
				            AND NoDisponibilita = 0
                            AND (DataRichiesta >= "' . $this->getDataInizioperiodo(-1) . '" 
                            AND DataRichiesta <= "' . $this->getDataFineperiodo(-1) . '")');

        $rwr = $res[0];
        return intval($rwr['tot_conferme']);
    }

    /**
     * tot_prenotazioni
     *
     * @return int
     */
    public function tot_prenotazioni()
    {
//        global $prima_data, $seconda_data;
//
//        $res = $this->query('SELECT COUNT(Id) as tot_prenotazioni FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = ' . IDSITO . '
//				AND
//					hospitality_guest.Hidden = 0
//				AND
//					hospitality_guest.Disdetta = 0
//
//
//				' . ($_REQUEST['date'] == '' ?
//                'AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . date('Y') . '" OR YEAR ( hospitality_guest.DataChiuso ) = "' . date('Y') . '" )'
//                :
//                'AND (DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '"  OR (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '"))') . '
//				');
//
//        $rwc = $res[0];
//        return $rwc['tot_prenotazioni'];
        $sel = "SELECT COUNT(Id) as tot_prenotazioni
                FROM hospitality_guest
                WHERE TipoRichiesta = 'Conferma'
                AND
					hospitality_guest.Hidden = 0
				AND
					hospitality_guest.Disdetta = 0			
				AND 
					hospitality_guest.Chiuso = 1 
                AND 
                    (hospitality_guest.IdMotivazione IS NULL OR hospitality_guest.DataRiconferma IS NOT NULL)
                AND 
                    hospitality_guest.CheckinOnlineClient = 0
				AND 
					hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.idsito = " . $this->getIdSito() . "
                AND (hospitality_guest.DataRichiesta >= '" . $this->getDataInizioperiodo() . "' 
                AND hospitality_guest.DataRichiesta <= '" . $this->getDataFineperiodo() . "')";

        $res = $this->query($sel);
        $rw = $res[0];
        return $rw['tot_prenotazioni'];
    }

    /**
     * tot_prenotazioni_periodo
     *
     * @return int
     */
    public function tot_prenotazioni_periodo()
    {
//        global $prima_data_tmp, $seconda_data_tmp;
//
//        $prima   = ($prima_data_tmp[2]-1).'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
//        $seconda = ($seconda_data_tmp[2]-1).'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];
//
//        $res = $this->query('SELECT COUNT(Id) as tot_prenotazioni FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = ' . IDSITO . '
//				AND
//					hospitality_guest.Hidden = 0
//				AND
//					hospitality_guest.Archivia = 0
//				AND
//					hospitality_guest.Disdetta = 0
//
//				' . ($_REQUEST['date'] == '' ?
//                'AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . (date('Y')-1)  . '" OR YEAR ( hospitality_guest.DataChiuso ) = "' . (date('Y')-1)  . '" )'
//                :
//                'AND (DataRichiesta >= "' . $prima . '" AND DataRichiesta <= "' . $seconda . '"  OR (DATE(DataChiuso) >= "' . $prima . '" AND DATE(DataChiuso) <= "' . $seconda . '"))') . '
//				');
//
//        $rwc = $res[0];
//        return $rwc['tot_prenotazioni'];

        $sel = "SELECT COUNT(Id) as tot_prenotazioni
            FROM hospitality_guest
            WHERE TipoRichiesta = 'Conferma'
            AND
                hospitality_guest.Hidden = 0
            AND
                hospitality_guest.Disdetta = 0
            AND 
                hospitality_guest.Chiuso = 1 
            AND 
                (hospitality_guest.IdMotivazione IS NULL OR hospitality_guest.DataRiconferma IS NOT NULL)
            AND 
                hospitality_guest.CheckinOnlineClient = 0
            AND 
                hospitality_guest.NoDisponibilita = 0
            AND hospitality_guest.idsito = " . $this->getIdSito() . "
            AND (hospitality_guest.DataRichiesta >= '" . $this->getDataInizioperiodo(-1) . "' 
            AND hospitality_guest.DataRichiesta <= '" . $this->getDataFineperiodo(-1) . "')";

        $res = $this->query($sel);
        $rw = $res[0];
        return $rw['tot_prenotazioni'];
    }

    /**
     * tot_preno_archiviate
     *
     * @return int
     */
    public function tot_preno_archiviate()
    {
//        global $prima_data, $seconda_data;

//        $res = $this->query('SELECT COUNT(Id) as tot_prenotazioni FROM hospitality_guest
//                                     WHERE TipoRichiesta = "Conferma" AND idsito = ' . IDSITO . '
//                                     AND Hidden = 0 AND Chiuso = 1 AND Archivia = 1
//                                     AND ' . ($_REQUEST['date'] == '' ? ' (DATE(DataChiuso) >= "' . date('Y') . '-01-01"
//                                     AND DATE(DataChiuso) <= "' . date('Y') . '-12-31")' : ' (DATE(DataChiuso) >= "' . $prima_data . '"
//                                     AND DATE(DataChiuso) <= "' . $seconda_data . '")') . '');
//        $rwc = $res[0];
//
//        return $rwc['tot_prenotazioni'];


        $sel = "SELECT COUNT(Id) as tot_prenotazioni
            FROM hospitality_guest
            WHERE TipoRichiesta = 'Conferma'
            AND idsito = " . $this->getIdSito() . "
            AND Hidden = 0 
            AND Chiuso = 1 
            AND Archivia = 1
            AND DataChiuso >= '" . $this->getDataInizioperiodo() . "'
            AND DataChiuso <= '" . $this->getDataFineperiodo() . "'";

        $res = $this->query($sel);
        $rwc = $res[0];
        return $rwc['tot_prenotazioni'];
    }

    /**
     * tot_preno_archiviate_periodo
     *
     * @return int
     */
    public function tot_preno_archiviate_periodo()
    {
//        global $prima_data_tmp, $seconda_data_tmp;
//
//        $prima   = ($prima_data_tmp[2]-1).'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
//        $seconda = ($seconda_data_tmp[2]-1).'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];
//
//        $res = $this->query('SELECT COUNT(Id) as tot_prenotazioni FROM hospitality_guest  WHERE
//                                                                 TipoRichiesta = "Conferma" AND
//                                                                 idsito = ' . IDSITO . ' AND
//                                                                  Hidden = 0 AND
//                                                                   Chiuso = 1 AND
//                                                                    Archivia = 1 AND
//                                                                     ' . ($_REQUEST['date'] == '' ? ' (DATE(DataChiuso) >= "' . (date('Y')-1) . '-01-01" AND DATE(DataChiuso) <= "' . (date('Y')-1) . '-12-31")' : ' (DATE(DataChiuso) >= "' . $prima . '" AND DATE(DataChiuso) <= "' . $seconda . '")') . '');
//
//
//        $rwc = $res[0];
//        return $rwc['tot_prenotazioni'];


        $sel = "SELECT COUNT(Id) as tot_prenotazioni
            FROM hospitality_guest
            WHERE TipoRichiesta = 'Conferma'
            AND idsito = " . $this->getIdSito() . "
            AND Hidden = 0 AND Chiuso = 1 AND Archivia = 1
            AND DataChiuso >= '" . $this->getDataInizioperiodo(-1) . "'
            AND DataChiuso <= '" . $this->getDataFineperiodo(-1) . "'";

        $res = $this->query($sel);
        $rwc = $res[0];
        return $rwc['tot_prenotazioni'];
    }

    /**
     * tot_archiviate
     *
     * @return int
     */
    public function tot_archiviate()
    {
//        global $prima_data, $seconda_data;
//
//        $res = $this->query('SELECT COUNT(Id) as tot_archiviate FROM hospitality_guest
//                                   WHERE idsito = ' . IDSITO . '
//                                   AND Archivia = 1 ' . ($_REQUEST['date'] == '' ? ' AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . date('Y') . '" OR YEAR ( hospitality_guest.DataChiuso ) = "' . date('Y') . '" )' : 'AND ((DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '") OR (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '"))') . '');
//        $rwc = $res[0];
//
//        return $rwc['tot_archiviate'];


        // Utilizza le date memorizzate negli attributi della classe
        $sel = "SELECT COUNT(Id) as tot_archiviate 
            FROM hospitality_guest 
            WHERE idsito = " . $this->getIdSito() . " AND Archivia = 1 
            AND ((DataRichiesta >= '" . $this->getDataInizioperiodo() . "' AND DataRichiesta <= '" . $this->getDataFineperiodo() . "') 
            OR (DataChiuso >= '" . $this->getDataInizioperiodo() . "' AND DataChiuso <= '" . $this->getDataFineperiodo() . "'))";

        $res = $this->query($sel);
        $rwc = $res[0];
        return $rwc['tot_archiviate'];

    }

    /**
     * tot_cestinate
     *
     * @return int
     */
    public function tot_cestinate()
    {
        global $prima_data, $seconda_data;

        $res = $this->query('SELECT COUNT(Id) as tot_cestinate FROM hospitality_guest  WHERE idsito = ' . IDSITO . ' AND Hidden = 1 ' . ($_REQUEST['date'] == '' ? '' : 'AND ((DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '") OR (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '"))') . '');
        $rwc = $res[0];

        return $rwc['tot_cestinate'];

        $sel = 'SELECT COUNT(Id) as tot_cestinate FROM hospitality_guest  
            WHERE idsito = ' . $this->getIdSito() .
            ' AND Hidden = 1 ';
        if ($this->dateRequest !== '') {
            $sel .= ' AND ((DataRichiesta >= "' . $this->getDataInizioperiodo() .
                '" AND DataRichiesta <= "' . $this->getDataFineperiodo() .
                '") OR (DataChiuso >= "' . $this->getDataInizioperiodo() .
                '" AND DataChiuso <= "' . $this->getDataFineperiodo() . '"))';
        }
        $res = $this->query($sel);
        $rwc = $res[0];
        return $rwc['tot_cestinate'];

    }

    /**
     * tot_annullate
     *
     * @return int
     */
    public function tot_annullate()
    {
        global $prima_data, $seconda_data;

        $res = $this->query('SELECT COUNT(Id) as tot_annullate FROM hospitality_guest  WHERE  idsito = ' . $this->getIdSito() . ' AND Hidden = 0  AND NoDisponibilita = 1  ' . ($_REQUEST['date'] == '' ? '' : ' AND (DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '")') . '');
        $rwc = $res[0];

        return $rwc['tot_annullate'];
    }

    /**
     * tot_disdetta
     *
     * @return int
     */
    public function tot_disdetta()
    {
//        global $prima_data, $seconda_data;
//
//        $res = $this->query('SELECT COUNT(Id) as tot_disdette FROM hospitality_guest  WHERE  idsito = ' . IDSITO . '
//								AND
//									hospitality_guest.TipoRichiesta = "Conferma"
//								AND
//									hospitality_guest.Hidden = 0
//								AND
//									hospitality_guest.Archivia = 0
//								AND
//									hospitality_guest.Disdetta = 1
//								AND
//									hospitality_guest.Chiuso = 1
//								 ' . ($_REQUEST['date'] == '' ? '' : 'AND (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '")') . '');
//        $rwc = $res[0];
//
//        return $rwc['tot_disdette'];


        $res = $this->query('SELECT COUNT(Id) as tot_disdette FROM hospitality_guest  
                            WHERE idsito = ' . $this->getIdSito() . '
                            AND TipoRichiesta = "Conferma" 
                            AND Hidden = 0 
                            AND Disdetta = 1 
                            AND Chiuso = 1
                            AND (DataChiuso >= "' . $this->getDataInizioperiodo() . '" 
                            AND DataChiuso <= "' . $this->getDataFineperiodo() . '")');

        $rwc = $res[0];
        return $rwc['tot_disdette'];
    }

    /**
     * tot_fatturato
     *
     * @param mixed $n_format
     * @return int
     */
    public function tot_fatturato($n_format = null)
    {
//        global $prima_data, $seconda_data;

//        $sel = 'SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
//                                FROM hospitality_guest
//                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
//                                WHERE 1 = 1
//                                AND hospitality_guest.idsito =  ' . IDSITO . '
//                                AND hospitality_guest.NoDisponibilita = 0
//                                AND hospitality_guest.Disdetta = 0
//                                AND hospitality_guest.Hidden = 0
//                                AND hospitality_guest.TipoRichiesta = "Conferma"
//					' . ($_REQUEST['date'] == '' ? 'AND ((DataRichiesta>= "' . date('Y') . '-01-01" AND DataRichiesta <= "' . date('Y') . '-12-31") OR (DATE(DataChiuso) >= "' . date('Y') . '-01-01" AND DATE(DataChiuso) <= "' . date('Y') . '-12-31"))' : 'AND ((DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '") OR (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '"))') . '';
//        $res = $this->query($sel);
//
//        $rwc = $res[0];
//
//        if ($n_format) {
//            return $rwc['fatturato'];
//        } else {
//            return number_format($rwc['fatturato'], 2, ',', '.');
//        }


        $sel = 'SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                FROM hospitality_guest
                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                WHERE 1 = 1
                AND hospitality_guest.idsito = ' . $this->getIdSito() . '
                AND hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.Disdetta = 0
                AND hospitality_guest.Hidden = 0
                AND hospitality_guest.TipoRichiesta = "Conferma"
                AND ((DataRichiesta >= "' . $this->getDataInizioperiodo() . '" AND DataRichiesta <= "' . $this->getDataFineperiodo() . '") 
                OR (DataChiuso >= "' . $this->getDataInizioperiodo() . '" AND DataChiuso <= "' . $this->getDataFineperiodo() . '"))';
        $res = $this->query($sel);

        $rwc = $res[0];

        if ($n_format) {
            return $rwc['fatturato'];
        } else {
            return number_format($rwc['fatturato'], 2, ',', '.');
        }

    }

    /**
     * tot_fatturato_periodo
     *
     * @param mixed $n_format
     * @return int
     */
    public function tot_fatturato_periodo($n_format = null)
    {
//        global $prima_data_tmp, $seconda_data_tmp;
//
//        $prima = ($prima_data_tmp[2] - 1) . '-' . $prima_data_tmp[1] . '-' . $prima_data_tmp[0];
//        $seconda = ($seconda_data_tmp[2] - 1) . '-' . $seconda_data_tmp[1] . '-' . $seconda_data_tmp[0];
//
//        $sel = 'SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
//                                FROM hospitality_guest
//                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
//                                WHERE 1 = 1
//                                AND hospitality_guest.idsito =  ' . IDSITO . '
//                                AND hospitality_guest.NoDisponibilita = 0
//                                AND hospitality_guest.Disdetta = 0
//                                AND hospitality_guest.Hidden = 0
//                                AND hospitality_guest.TipoRichiesta = "Conferma"
//					' . ($_REQUEST['date'] == '' ? 'AND ((DataRichiesta>= "' . (date('Y') - 1) . '-01-01" AND DataRichiesta <= "' . (date('Y') - 1) . '-12-31") OR (DATE(DataChiuso) >= "' . (date('Y') - 1) . '-01-01" AND DATE(DataChiuso) <= "' . (date('Y') - 1) . '-12-31"))' : 'AND ((DataRichiesta >= "' . $prima . '" AND DataRichiesta <= "' . $seconda . '") OR (DATE(DataChiuso) >= "' . $prima . '" AND DATE(DataChiuso) <= "' . $seconda . '"))') . '';
//        $res = $this->query($sel);
//
//        $rwc = $res[0];
//
//        if ($n_format) {
//            return $rwc['fatturato'];
//        } else {
//            return number_format($rwc['fatturato'], 2, ',', '.');
//        }
        $sel = 'SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                FROM hospitality_guest
                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                WHERE 1 = 1
                AND hospitality_guest.idsito = ' . $this->getIdSito() . '
                AND hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.Disdetta = 0
                AND hospitality_guest.Hidden = 0
                AND hospitality_guest.TipoRichiesta = "Conferma"
                AND ((DataRichiesta >= "' . $this->getDataInizioperiodo(-1) . '" AND DataRichiesta <= "' . $this->getDataFineperiodo(-1) . '") 
                OR (DataChiuso >= "' . $this->getDataInizioperiodo(-1) . '" AND DataChiuso <= "' . $this->getDataFineperiodo(-1) . '"))';
        $res = $this->query($sel);

        $rwc = $res[0];

        if ($n_format) {
            return $rwc['fatturato'];
        } else {
            return number_format($rwc['fatturato'], 2, ',', '.');
        }
    }

    /**
     * tot_fatturato_prev
     *
     * @param mixed $n_format
     * @return int
     */
    public function tot_fatturato_prev($n_format = null)
    {
        global $prima_data, $seconda_data;

        $numeroPreventivi = '';
        $fatturato_medio = '';
        $media = '';

        $select = 'SELECT COUNT(hospitality_guest.Id) as numeroPreventivi
					FROM hospitality_guest
					WHERE 1=1
					AND hospitality_guest.idsito = ' . $this->getIdSito() . '
					AND hospitality_guest.Chiuso = 0
					AND hospitality_guest.Hidden = 0
					AND hospitality_guest.Disdetta = 0
					AND hospitality_guest.TipoRichiesta = "Preventivo"
					AND ' . ($_REQUEST['date'] == '' ? ' (DataRichiesta >= "' . date('Y') . '-01-01" AND DataRichiesta <= "' . date('Y') . '-12-31")' : ' (DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '")') . '';
        $result = $this->query($select);

        $rws = $result[0];

        $numeroPreventivi = $rws['numeroPreventivi'];

        $select2 = 'SELECT SUM(hospitality_proposte.PrezzoP) as fatturato,
							COUNT(hospitality_proposte.Id) as numeroProposte
					FROM hospitality_guest
					INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
					WHERE 1=1
					AND hospitality_guest.idsito = ' . $this->getIdSito() . '
					AND hospitality_guest.Chiuso = 0
					AND hospitality_guest.Hidden = 0
					AND hospitality_guest.Disdetta = 0
					AND hospitality_guest.TipoRichiesta = "Preventivo"
					AND ' . ($_REQUEST['date'] == '' ? ' (DataRichiesta >= "' . date('Y') . '-01-01" AND DataRichiesta <= "' . date('Y') . '-12-31")' : ' (DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '")') . '';

        $result2 = $this->query($select2);

        $rwc = $result2[0];

        if ($rwc['numeroProposte'] > 0) {

            if ($numeroPreventivi >= $rwc['numeroProposte']) {
                $media = ($numeroPreventivi / $rwc['numeroProposte']);
            } else {
                $media = ($rwc['numeroProposte'] / $numeroPreventivi);
            }
            $fatturato_medio = ($rwc['fatturato'] / $media);

            if ($n_format) {
                return $fatturato_medio;
            } else {
                return number_format($fatturato_medio, 2, ',', '.');
            }
        }
    }

    /**
     * tot_fatturato_conf
     *
     * @param mixed $n_format
     * @return int|string
     */
    public function tot_fatturato_conf($n_format = null)
    {
        global $prima_data, $seconda_data;

        $res = $this->query('SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
					FROM hospitality_guest
					INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
					WHERE 1=1
					AND hospitality_guest.idsito = ' . $this->getIdSito() . '
					AND hospitality_guest.Chiuso = 0
					AND hospitality_guest.Hidden = 0
					AND hospitality_guest.Disdetta = 0
					AND hospitality_guest.NoDisponibilita = 0
					AND hospitality_guest.TipoRichiesta = "Conferma"
					' . ($_REQUEST['date'] == '' ? 'AND ((DataRichiesta>= "' . date('Y') . '-01-01" AND DataRichiesta <= "' . date('Y') . '-12-31") OR (DATE(DataChiuso) >= "' . date('Y') . '-01-01" AND DATE(DataChiuso) <= "' . date('Y') . '-12-31"))' : 'AND ((DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '") OR (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '"))') . '');
        $rwc = $res[0];

        if ($n_format) {
            return $rwc['fatturato'];
        } else {
            return number_format($rwc['fatturato'], 2, ',', '.');
        }

    }

    /**
     * tot_fatturato_annullate
     *
     * @param mixed $n_format
     * @return int|string
     */
    public function tot_fatturato_annullate($n_format = null)
    {
//        global $prima_data, $seconda_data;
//
//        $res = $this->query('SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
//					FROM hospitality_guest
//					INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
//					WHERE 1=1
//					AND hospitality_guest.idsito = ' . IDSITO . '
//					AND hospitality_guest.NoDisponibilita = 1
//					AND hospitality_guest.Hidden = 0
//					AND hospitality_guest.Disdetta = 0
//					AND hospitality_guest.TipoRichiesta = "Conferma"
//					' . ($_REQUEST['date'] == '' ? 'AND ((DataRichiesta>= "' . date('Y') . '-01-01" AND DataRichiesta <= "' . date('Y') . '-12-31") OR (DATE(DataChiuso) >= "' . date('Y') . '-01-01" AND DATE(DataChiuso) <= "' . date('Y') . '-12-31"))' : 'AND ((DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '") OR (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '"))') . '');
//        $rwc = $res[0];
//
//        if ($n_format) {
//            return $rwc['fatturato'];
//        } else {
//            return number_format($rwc['fatturato'], 2, ',', '.');
//        }

        $sel = 'SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                FROM hospitality_guest
                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                WHERE hospitality_guest.idsito = ' . $this->getIdSito() . '
                AND hospitality_guest.NoDisponibilita = 1
                AND hospitality_guest.Hidden = 0
                AND hospitality_guest.Disdetta = 0
                AND hospitality_guest.TipoRichiesta = "Conferma"
                AND (
                (DataRichiesta >= "' . $this->getDataInizioperiodo() . '" AND DataRichiesta <= "' . $this->getDataFineperiodo() . '") 
                OR (DataChiuso >= "' . $this->getDataInizioperiodo() . '" AND DataChiuso <= "' . $this->getDataFineperiodo() . '")
                )';
        $res = $this->query($sel);

        $rwc = $res[0];

        if ($n_format) {
            return $rwc['fatturato'];
        } else {
            return number_format($rwc['fatturato'], 2, ',', '.');
        }
    }

    /**
     * tot_fatturato_disdette
     *
     * @param mixed $n_format
     * @return int|string
     */
    public function tot_fatturato_disdette($n_format = null)
    {
//        global $prima_data, $seconda_data;
//
//        $res = $this->query('SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
//					FROM hospitality_guest
//					INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
//					WHERE 1=1
//					AND hospitality_guest.idsito = ' . IDSITO . '
//					AND hospitality_guest.NoDisponibilita = 0
//					AND hospitality_guest.Hidden = 0
//					AND hospitality_guest.Disdetta = 1
//					AND hospitality_guest.Chiuso = 1
//					AND hospitality_guest.TipoRichiesta = "Conferma"
//					' . ($_REQUEST['date'] == '' ? 'AND ((DataRichiesta>= "' . date('Y') . '-01-01" AND DataRichiesta <= "' . date('Y') . '-12-31") OR (DATE(DataChiuso) >= "' . date('Y') . '-01-01" AND DATE(DataChiuso) <= "' . date('Y') . '-12-31"))' : 'AND ((DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '") OR (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '"))') . '');
//        $rwc = $res[0];
//
//        if ($n_format) {
//            return $rwc['fatturato'];
//        } else {
//            return number_format($rwc['fatturato'], 2, ',', '.');
//        }
        $sel = 'SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                FROM hospitality_guest
                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                WHERE 1=1
                AND hospitality_guest.idsito = ' . $this->getIdSito() . '
                AND hospitality_guest.NoDisponibilita = 0
                AND hospitality_guest.Hidden = 0
                AND hospitality_guest.Disdetta = 1
                AND hospitality_guest.Chiuso = 1
                AND hospitality_guest.TipoRichiesta = "Conferma"
                AND (
                (DataRichiesta >= "' . $this->getDataInizioperiodo() . '" AND DataRichiesta <= "' . $this->getDataFineperiodo() . '") 
                OR (DataChiuso >= "' . $this->getDataInizioperiodo() . '" AND DataChiuso <= "' . $this->getDataFineperiodo() . '")
                )';
        $res = $this->query($sel);

        $rwc = $res[0];

        if ($n_format) {
            return $rwc['fatturato'];
        } else {
            return number_format($rwc['fatturato'], 2, ',', '.');
        }
    }

    /**
     * tot_conversioni
     *
     * @param int $tot_invii
     * @param int $tot_prenotazioni
     * @return string
     */
    public function tot_conversioni($tot_invii, $tot_prenotazioni)
    {
        $conversioni = @((100 * $tot_prenotazioni) / $tot_invii);
        if (is_int($conversioni)) {
            $conversioni = $conversioni;
        } else {
            $conversioni = number_format($conversioni, 2, ',', '.');
        }
        if ($conversioni == '') {
            $conversioni = 0;
        }
        return str_replace(",00", "", $conversioni) . ' %';
    }

    public  function n_archivio($output = null, $anno = null)
    {

        $permessi_user = check_permessi();
        $q = 'SELECT 
                COUNT(Id) as n_archiviate 
            FROM 
                hospitality_guest  
            WHERE 
                idsito = '.$this->getIdSito().' 
                '.($permessi_user['UNIQUE'] == 1 ? '  AND ChiPrenota = "'.NOMEUTENTEACCESSI.'"' : '').' 
                AND Archivia = 1 
                AND Hidden = 0 ';

        // Condizioni per l'anno, se specificato
        if ($anno != '') {
            // Ottieni la data di inizio e fine dell'anno
            $inizio_anno = date("$anno-01-01");
            $fine_anno = date("$anno-12-31");

            // Aggiungi la condizione per il periodo dell'anno
            $q .= " AND ((hospitality_guest.DataRichiesta >= '$inizio_anno' AND hospitality_guest.DataRichiesta <= '$fine_anno') ";
            $q .= " OR (hospitality_guest.DataChiuso >= '$inizio_anno' AND hospitality_guest.DataChiuso <= '$fine_anno') )";
        }

        $res = $this->query($q);
        $rw = $res[0];
        if ($rw['n_archiviate'] > 0) {
            if (!$output) {
                return '<label class="badge badge-primary text-black pull-right">'.$rw['n_archiviate'].'</label>';
            } else {
                return $rw['n_archiviate'];
            }
        }

    }
    public function num_profila_anno($anno)
    {

        // Ottieni la data di inizio e fine dell'anno
        $inizio_anno = date("$anno-01-01");
        $fine_anno = date("$anno-12-31");

        // Costruisci la query SQL
        $query = "SELECT COUNT(Id) as num FROM hospitality_guest  
              WHERE idsito = ".$this->getIdSito()." 
              AND ((hospitality_guest.DataRichiesta BETWEEN '$inizio_anno' AND '$fine_anno' 
              OR hospitality_guest.DataChiuso BETWEEN '$inizio_anno' AND '$fine_anno'))";

        $res = $this->query($query);
        $rwc = $res[0];
        if ($rwc['num'] > 0) {
            return '<label class="badge badge-primary text-black pull-right">'.$rwc['num'].'</label>';
        } else {
            return '';
        }
    }
    function n_checkin($output=null){


        $q = $this->query('SELECT * FROM hospitality_checkin  
         WHERE  idsito = '.$this->getIdSito().' 
         AND data_compilazione >= "'.date('Y-m-d  00:00:00').'" 
         AND data_compilazione < "'.date('Y-m-d  23:59:59').'" GROUP BY Prenotazione');
        $rw = sizeof($q);
        if($rw > 0){
            if(!$output){
                return '<label class="badge bg-orange pull-righ m-l-5" id="notify_schedine">'.$rw.'</label>';
            }else{
                return $rw;
            }
        }

    }
    function n_conferme_send($output=null){



        $permessi_user = check_permessi();
        $q  = $this->query('SELECT COUNT(Id) as n_conferme 
FROM hospitality_guest  
WHERE TipoRichiesta = "Conferma" 
  AND idsito = '.IDSITO.' '.($permessi_user['UNIQUE']==1?' AND ChiPrenota = "'.NOMEUTENTEACCESSI.'"':'').' 
  AND Archivia = 0 
  AND Chiuso = 0 AND DataInvio is Null 
  AND Hidden = 0 
  AND NoDisponibilita = 0');
        $rw = $q[0];
        if($rw['n_conferme'] > 0){
            if(!$output){
                return '<label class="badge badge-success pull-right" id="notify_conferme" data-toggle="tooltip" title="Conferme da inviare">'.$rw['n_conferme'].'</label>';
            }else{
                return $rw['n_conferme'];
            }
        }

    }
    function n_preventivi_send($output=null){

        $permessi_user = check_permessi();
        $q = $this->query('SELECT COUNT(Id) as n_preventivi FROM hospitality_guest  WHERE TipoRichiesta = "Preventivo" AND idsito = '.IDSITO.' '.($permessi_user['UNIQUE']==1?' AND ChiPrenota = "'.NOMEUTENTEACCESSI.'"':'').' AND Archivia = 0 AND DataInvio is Null AND Hidden = 0 AND NoDisponibilita = 0');
        $rw = $q[0];
        if($rw['n_preventivi'] > 0){
            if(!$output){
                return '<label class="badge badge-info pull-right" id="notify_preventivi" data-toggle="tooltip" title="Preventivi da inviare">'.$rw['n_preventivi'].'</label>';
            }else{
                return $rw['n_preventivi'];
            }
        }

    }
    function n_cestino($output=null){

        $permessi_user = check_permessi();
        $q = $this->query('SELECT COUNT(Id) as n_richieste FROM hospitality_guest  WHERE idsito = '.IDSITO.' '.($permessi_user['UNIQUE']==1?' AND ChiPrenota = "'.NOMEUTENTEACCESSI.'"':'').' AND Hidden = 1');
        $rw = $q[0];
        if($rw['n_richieste'] > 0){
            if(!$output){
                return '<label class="badge badge-danger pull-right" id="notify_cestino">'.$rw['n_richieste'].'</label>';
            }else{
                return $rw['n_preventivi'];
            }
        }

    }
    function n_annullate($output=null){

        $permessi_user = check_permessi();
        $q = $this->query('SELECT COUNT(Id) as n_richieste FROM hospitality_guest  WHERE idsito = '.IDSITO.' '.($permessi_user['UNIQUE']==1?' AND ChiPrenota = "'.NOMEUTENTEACCESSI.'"':'').'  AND NoDisponibilita = 1 AND Hidden = 0 AND Disdetta = 0 AND Archivia = 0');
        $rw = $q[0];
        if($rw['n_richieste'] > 0){
            return '<label class="badge badge-warning pull-right">'.$rw['n_richieste'].'</label>';
        }
    }
    function n_disdette($output=null){

        $permessi_user = check_permessi();
        $q = $this->query('SELECT COUNT(Id) as n_disdette FROM hospitality_guest  WHERE idsito = '.IDSITO.' '.($permessi_user['UNIQUE']==1?' AND ChiPrenota = "'.NOMEUTENTEACCESSI.'"':'').' AND Disdetta = 1 AND Hidden = 0 AND Archivia = 0 AND NoDisponibilita = 0 AND Chiuso = 1');
        $rw = $q[0];
        if($rw['n_disdette'] > 0){
            if(!$output){
                return '<label class="badge bg-white text-black pull-right">'.$rw['n_disdette'].'</label>';
            }else{
                return $rw['n_disdette'];
            }
        }

    }
    function n_buoni_voucher($output=null){
        global $dbMysqli;
        $permessi_user = check_permessi();
        $q = $dbMysqli->query('SELECT COUNT(Id) as n_buoniVoucher 
                            FROM hospitality_guest  
                            WHERE idsito = '.IDSITO.' '.($permessi_user['UNIQUE']==1?' AND ChiPrenota = "'.NOMEUTENTEACCESSI.'"':'').'  
                            AND 
					            hospitality_guest.TipoRichiesta = "Conferma"  				
                            AND 
                                hospitality_guest.Hidden = 0 
                            AND 
                                hospitality_guest.Archivia = 0 
                            AND 
                                hospitality_guest.Disdetta = 0 					
                            AND 
                                hospitality_guest.Chiuso = 1 
                            AND
                                hospitality_guest.DataValiditaVoucher IS NOT NULL 
                            AND 
                                hospitality_guest.IdMotivazione IS NOT NULL 
                            AND 
                                hospitality_guest.DataRiconferma IS NULL
                            AND 
                                hospitality_guest.NoDisponibilita = 0');
        $rw = $q[0];
        if($rw['n_buoniVoucher'] > 0){
            return '<label class="badge bg-blue pull-right">'.$rw['n_buoniVoucher'].'</label>';
        }
    }





}