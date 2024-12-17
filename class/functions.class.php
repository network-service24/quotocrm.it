<?php
/**
 * CRM
 * @author Marcello Visigalli < marcello.visigalli@gmail.com >
 * @version 3.0
 * @name QUOTO!
 */
class functions
{
    /**
     * prepare_query
     *
     * @param  mixed $tabella
     * @param  mixed $dati
     * @param  mixed $type
     * @param  mixed $db
     * @param  mixed $param_update
     * @param  mixed $id
     * @return void
     */
    public function prepare_query($tabella, $dati, $type, $db, $param_update = null, $id = null)
    {
        global $dbMysqli;

        $select = "SHOW COLUMNS FROM $tabella";
        $table_result = $dbMysqli->query($select);
        foreach ($table_result as $table_struct) {
            $campi_tabella[] = $table_struct["Field"];
        }

        switch ($type) {

            case "insert":
                foreach ($campi_tabella as $key => $valore) {
                    if ($dati[$valore] != '') {
                        $elenco_campi .= $valore . ",";
                        $elenco_valori .= "'" . $dati[$valore] . "',";
                    }
                }
                $elenco_campi = substr($elenco_campi, 0, -1);
                $elenco_valori = substr($elenco_valori, 0, -1);

                $querysql = "INSERT INTO $tabella ($elenco_campi) VALUES ($elenco_valori)";
                break;

            case "update":
                foreach ($campi_tabella as $key => $valore) {
                    if ($valore != 'id') {
                        $elenco_campi .= $valore . "= '" . $dati[$valore] . "',";

                    }
                }
                $elenco_campi = substr($elenco_campi, 0, -1);

                if (($id) && (!$param_update)) {
                    $param_update = "id";
                }

                $querysql = "UPDATE " . $tabella . " SET " . $elenco_campi . " WHERE " . $param_update . " = '" . $id . "'";
                break;

        }

        return ($querysql);

    }

    /**
     * ListaCampiTabella
     *
     * @param  mixed $tabella
     * @param  mixed $listaLabel
     * @param  mixed $listaCampi
     * @param  mixed $changeType
     * @param  mixed $paramSelect
     * @return void
     */
    public function ListaCampiTabella($tabella, $listaLabel = null, $listaCampi = null, $changeType = null, $paramSelect = null)
    {
        global $dbMysqli;

        $q = "SHOW COLUMNS FROM " . $tabella;
        $campi_tabella = $dbMysqli->query($q);

        $vl = '';
        $campo = '';
        $label_campo = '';

        foreach ($campi_tabella as $ky => $vl) {

            $label_campo = str_replace("_", " ", $vl['Field']);
            $label_campo = ucwords($label_campo);
            $chiave = ($ky - 1);

            if ($vl['Extra'] != 'auto_increment') {
                switch ($vl['Type']) {
                    case "int(1)":
                    case "int(11)":
                    case "int(30)":
                        $campo .= ($listaCampi[$vl['Field']] == 1 ? '
									<div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>' . (in_array($listaLabel[$vl['Field']], $listaLabel) ? $listaLabel[$vl['Field']] : $label_campo) . '</label>
											</div>
											<div class="col-md-9">'
                            . (in_array($changeType[$vl['Field']], $changeType) ?
                                ($changeType[$vl['Field']] == 'select' ? '
												<select class="form-control"  id="' . $vl['Field'] . '"  name="' . $vl['Field'] . '" >
													' . (in_array($paramSelect[$vl['Field']], $paramSelect) ? str_replace(",", "", $paramSelect[$vl['Field']]) : '') . '
												</select>'
                                    :
                                    '<input type="' . $changeType[$vl['Field']] . '" class="form-control" id="' . $vl['Field'] . '"  name="' . $vl['Field'] . '" />'
                                )
                                :
                                '<input type="checkbox" id="' . $vl['Field'] . '"  name="' . $vl['Field'] . '" />'
                            ) . '
											</div>
										</div>
									</div>' : '') . "\r\n";
                        break;
                    case "enum" :
                        $campo .= ($listaCampi[$vl['Field']] == 1 ? '
									<div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>' . (in_array($listaLabel[$vl['Field']], $listaLabel) ? $listaLabel[$vl['Field']] : $label_campo) . '</label>
											</div>
											<div class="col-md-9">
												<select class="form-control" id="' . $vl['Field'] . '"  name="' . $vl['Field'] . '" >
													' . (in_array($paramSelect[$vl['Field']], $paramSelect) ? str_replace(",", "", $paramSelect[$vl['Field']]) : '') . '
												</select>
											</div>
										</div>
									</div>' : '') . "\r\n";
                        break;
                    case "varchar(255)" :
                        $campo .= ($listaCampi[$vl['Field']] == 1 ? '  <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>' . (in_array($listaLabel[$vl['Field']], $listaLabel) ? $listaLabel[$vl['Field']] : $label_campo) . '</label>
											</div>
											<div class="col-md-9">'
                            . (in_array($changeType[$vl['Field']], $changeType) ?
                                ($changeType[$vl['Field']] == 'select' ? '
												<select class="form-control"  id="' . $vl['Field'] . '"  name="' . $vl['Field'] . '" >
													' . (in_array($paramSelect[$vl['Field']], $paramSelect) ? str_replace(",", "", $paramSelect[$vl['Field']]) : '') . '
												</select>'
                                    :
                                    '<input type="' . $changeType[$vl['Field']] . '" class="form-control" id="' . $vl['Field'] . '"  name="' . $vl['Field'] . '" />'
                                )
                                :
                                '<textarea row="4" class="form-control" id="' . $vl['Field'] . '"  name="' . $vl['Field'] . '" /></textarea>'
                            ) . '</div>
										</div>
									</div>' : '') . "\r\n";
                        break;
                    case "tinyint(1)" :
                        $campo .= ($listaCampi[$vl['Field']] == 1 ? '  <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>' . (in_array($listaLabel[$vl['Field']], $listaLabel) ? $listaLabel[$vl['Field']] : $label_campo) . '</label>
											</div>
											<div class="col-md-9">
												<input type="checkbox" id="' . $vl['Field'] . '"  name="' . $vl['Field'] . '" />
											</div>
										</div>
									</div>' : '') . "\r\n";
                        break;
                    case "datetime" :
                    case "date":
                        $campo .= ($listaCampi[$vl['Field']] == 1 ? '  <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>' . (in_array($listaLabel[$vl['Field']], $listaLabel) ? $listaLabel[$vl['Field']] : $label_campo) . '</label>
											</div>
											<div class="col-md-9">
												<input type="date" class="form-control" id="' . $vl['Field'] . '"  name="' . $vl['Field'] . '" />
											</div>
										</div>
									</div>' : '') . "\r\n";
                        break;
                    case "point":
                        $campo .= ($listaCampi[$vl['Field']] == 1 ? '  <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>' . (in_array($listaLabel[$vl['Field']], $listaLabel) ? $listaLabel[$vl['Field']] : $label_campo) . '</label>
											</div>
											<div class="col-md-9">
												<input data-type="point" type="text" class="form-control" id="' . $vl['Field'] . '"  name="' . $vl['Field'] . '" />
											</div>
										</div>
									</div>' : '') . "\r\n";
                        break;
                    case "text":
                        $campo .= ($listaCampi[$vl['Field']] == 1 ? '  <div class="form-group">
										<div class="row">
											<div class="col-md-3 text-right">
												<label>' . (in_array($listaLabel[$vl['Field']], $listaLabel) ? $listaLabel[$vl['Field']] : $label_campo) . '</label>
											</div>
											<div class="col-md-9">'
                            . (in_array($changeType[$vl['Field']], $changeType) ?
                                ($changeType[$vl['Field']] == 'select' ? '
												<select class="form-control"  id="' . $vl['Field'] . '"  name="' . $vl['Field'] . '" >
													' . (in_array($paramSelect[$vl['Field']], $paramSelect) ? str_replace(",", "", $paramSelect[$vl['Field']]) : '') . '
												</select>'
                                    :
                                    '<input type="' . $changeType[$vl['Field']] . '" class="form-control" id="' . $vl['Field'] . '"  name="' . $vl['Field'] . '" />'
                                )
                                :
                                '<textarea row="4" class="form-control" id="' . $vl['Field'] . '"  name="' . $vl['Field'] . '" /></textarea>'
                            ) . '
											</div>
										</div>
									</div>' : '') . "\r\n";
                        break;
                    case "float" :
                        $campo .= ($listaCampi[$vl['Field']] == 1 ? '  <div class="form-group">
									<div class="row">
										<div class="col-md-3 text-right">
											<label>' . (in_array($listaLabel[$vl['Field']], $listaLabel) ? $listaLabel[$vl['Field']] : $label_campo) . '</label>
										</div>
										<div class="col-md-9">
											<input data-type="point" type="text" class="form-control" id="' . $vl['Field'] . '"  name="' . $vl['Field'] . '" />
										</div>
									</div>
								</div>' : '') . "\r\n";
                        break;
                }

            }
        }
        return $campo;
    }

    /**
     * field_clean
     *
     * @param  mixed $stringa
     * @return void
     */
    public function field_clean($stringa)
    {

        $clean_title = str_replace("!", "", $stringa);
        $clean_title = str_replace("?", "", $clean_title);
        $clean_title = str_replace(":", "", $clean_title);
        $clean_title = str_replace("+", "", $clean_title);
        $clean_title = str_replace("à", "a", $clean_title);
        $clean_title = str_replace("è", "e", $clean_title);
        $clean_title = str_replace("é", "e", $clean_title);
        $clean_title = str_replace("ì", "i", $clean_title);
        $clean_title = str_replace("ò", "o", $clean_title);
        $clean_title = str_replace("ù", "u", $clean_title);
        $clean_title = str_replace("n.", "", $clean_title);
        $clean_title = str_replace(".", "", $clean_title);
        $clean_title = str_replace(",", "", $clean_title);
        $clean_title = str_replace(";", "", $clean_title);
        $clean_title = str_replace("'", "", $clean_title);
        $clean_title = str_replace("*", "", $clean_title);
        $clean_title = str_replace("/", "", $clean_title);
        $clean_title = str_replace("\"", "", $clean_title);
        $clean_title = str_replace(" ", "", $clean_title);
        $clean_title = strtolower($clean_title);
        $clean_title = trim($clean_title);

        return ($clean_title);
    }
    /**
     * mini_clean
     *
     * @param  mixed $stringa
     * @return void
     */
    public function mini_clean($stringa)
    {

        $clean_title = str_replace("*", "", $stringa);
        $clean_title = str_replace("'", "", $clean_title);
        $clean_title = str_replace("/", "", $clean_title);
        $clean_title = str_replace("\"", "", $clean_title);
        $clean_title = trim($clean_title);

        return ($clean_title);
    }

    /**
     * gira_data
     *
     * @param  mixed $data
     * @return void
     */
    public function gira_data($data)
    {
        $data = explode(" ", $data);
        $data_tmp = explode("-", $data[0]);
        $new_data = $data_tmp[2] . '-' . $data_tmp[1] . '-' . $data_tmp[0] . ' ' . $data[1];
        return $new_data;
    }

    /**
     * gira_data_noHour
     *
     * @param  mixed $data
     * @return void
     */
    public function gira_data_noHour($data)
    {
        $data = explode(" ", $data);
        $data_tmp = explode("-", $data[0]);
        $new_data = $data_tmp[2] . '-' . $data_tmp[1] . '-' . $data_tmp[0];
        return $new_data;
    }

    /**
     * getListaComuni
     *
     * @return void
     */
    public function getListaComuni()
    {
        global $dbMysqli;
        $sql = 'SELECT * FROM comuni ORDER BY nome_comune ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getListaRegioni
     *
     * @return void
     */
    public function getListaRegioni()
    {
        global $dbMysqli;
        $sql = 'SELECT * FROM regioni ORDER BY nome_regione ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getListaProvince
     *
     * @return void
     */
    public function getListaProvince()
    {
        global $dbMysqli;
        $sql = 'SELECT * FROM province ORDER BY nome_provincia ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getListaStati
     *
     * @return void
     */
    public function getListaStati()
    {
        global $dbMysqli;
        $sql = 'SELECT * FROM stati ORDER BY nome_stato ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getTipoSito
     *
     * @return void
     */
    public function getTipoSito()
    {
        global $dbMysqli;
        $sql = 'SELECT * FROM tipo_sito ORDER BY nome ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getClassificazioniStutture
     *
     * @return void
     */
    public function getClassificazioniStutture()
    {
        global $dbMysqli;
        $sql = 'SELECT * FROM classificazioni_strutture ORDER BY classe ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getIdStatus
     *
     * @return void
     */
    public function getIdStatus()
    {
        global $dbMysqli;
        $sql = 'SELECT * FROM status ORDER BY id_status ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getServiziAttivi
     *
     * @return void
     */
    public function getServiziAttivi()
    {
        global $dbMysqli;
        $sql = 'SELECT * FROM tipo_servizi WHERE attivo = 1 ORDER BY nome_servizio ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getTipoContratto
     *
     * @return void
     */
    public function getTipoContratto()
    {
        global $dbMysqli;
        $sql = 'SELECT * FROM tipo_contratto ORDER BY nome_contratto ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getComune
     *
     * @param  mixed $codice_comune
     * @return void
     */
    public function getComune($codice_comune = null)
    {
        global $dbMysqli;
        if ($codice_comune != null) {
            $sql = 'SELECT * FROM comuni where codice_comune = "' . $codice_comune . '"';
            $ret = $dbMysqli->query($sql);
            $row = $ret[0];
            if (sizeof($ret)) {
                return ($row);
            } else {
                return false;
            }

        }

    }

    /**
     * getRegione
     *
     * @param  mixed $codice_regione
     * @return void
     */
    public function getRegione($codice_regione = null)
    {
        global $dbMysqli;
        if ($codice_regione != null) {
            $sql = 'SELECT * FROM regioni where codice_regione = "' . $codice_regione . '"';
            $ret = $dbMysqli->query($sql);
            $row = $ret[0];
            if (sizeof($ret)) {
                return ($row);
            } else {
                return false;
            }

        }
    }

    /**
     * getProvincia
     *
     * @param  mixed $codice_provincia
     * @return void
     */
    public function getProvincia($codice_provincia = null)
    {
        global $dbMysqli;
        if ($codice_provincia != null) {
            $sql = 'SELECT * FROM province where codice_provincia = "' . $codice_provincia . '"';
            $ret = $dbMysqli->query($sql);
            $row = $ret[0];
            if (sizeof($ret)) {
                return ($row);
            } else {
                return false;
            }

        }

    }

    /**
     * getStato
     *
     * @param  mixed $id_stato
     * @return void
     */
    public function getStato($id_stato = null)
    {
        global $dbMysqli;
        if ($id_stato != null) {
            $sql = 'SELECT * FROM stati where id_stato = "' . $id_stato . '"';
            $ret = $dbMysqli->query($sql);
            $row = $ret[0];
            if (sizeof($ret)) {
                return ($row);
            } else {
                return false;
            }

        }
    }

    /**
     * getNomeStatus
     *
     * @param  mixed $id_status
     * @return void
     */
    public function getNomeStatus($id_status = null)
    {
        global $dbMysqli;
        if ($id_status != null) {
            $sql = 'SELECT * FROM status where id_status = "' . $id_status . '"';
            $ret = $dbMysqli->query($sql);
            $row = $ret[0];

            switch ($row['descrizione_status']) {
                case "Attivo" :
                    $output = '<span class="pcoded-badge badge badge-success">' . $row['descrizione_status'] . '</span>';
                    break;
                case "Chiuso":
                    $output = '<span class="pcoded-badge badge badge-inverse-danger">' . $row['descrizione_status'] . '</span>';
                    break;
                case "Sospeso":
                    $output = '<span class="pcoded-badge badge badge-default">' . $row['descrizione_status'] . '</span>';
                    break;
                case "Moroso":
                    $output = '<span class="pcoded-badge badge badge-danger">' . $row['descrizione_status'] . '</span>';
                    break;
                case "Disdetto":
                    $output = '<span class="pcoded-badge badge badge-warning">' . $row['descrizione_status'] . '</span>';
                    break;
                case "Non classificato":
                    $output = '<span class="pcoded-badge badge badge-inverse-primary">' . $row['descrizione_status'] . '</span>';
                    break;
                case "Disdetta in Lavorazione":
                    $output = '<span class="pcoded-badge badge badge-inverse-warning">' . $row['descrizione_status'] . '</span>';
                    break;
                case "Network Service":
                    $output = '<span class="pcoded-badge badge badge-inverse-info">' . $row['descrizione_status'] . '</span>';
                    break;
            }

            if (sizeof($ret)) {
                return $output;
            } else {
                return false;
            }

        }
    }

    /**
     * hidden_password
     *
     * @param  mixed $value
     * @return void
     */
    public function hidden_password($value)
    {

        if ($value) {
            $pass_cript = '';
            $pass = '';
            $i = 1;
            $rnd = md5(rand(1000, 9999) . $value);

            $n_caratteri = strlen($value);
            for ($i == 1; $i <= $n_caratteri; $i++) {
                $pass_cript .= '*';
            }
            $marginleft = ($n_caratteri + 100);

            $pass .= '<div id="Cpass' . $rnd . '" style="display:block;cursor:pointer">' . $pass_cript . '</div>' . "\r\n";
            $pass .= '<div id="pul' . $rnd . '" onclick="copyToClipboard(\'#' . $rnd . '\')" title="Copia" style="display:none;cursor:pointer;font-size:10px;float:right;margin-left:' . $marginleft . 'px"><i class="fa fa-clone" id="' . $rnd . 'fa"></i><br><br></div>';
            $pass .= '<div id="' . $rnd . '" style="display:none;cursor:pointer">' . $value . '</div>' . "\r\n";
            $pass .= '<script>
						$(document).ready(function() {
							$(\'#Cpass' . $rnd . '\').click(function() {
									$(\'#Cpass' . $rnd . '\').hide();
									$(\'#' . $rnd . '\').show();
									$(\'#pul' . $rnd . '\').show();
							});
							$(\'#' . $rnd . '\').click(function() {
									$(\'#pul' . $rnd . '\').hide();
									$(\'#' . $rnd . '\').hide();
									$(\'#Cpass' . $rnd . '\').show();
							});
						});
					</script>' . "\r\n";

            return $pass;
        }
    }

    /**
     * getUtentiNws
     *
     * @return void
     */
    public function getUtentiNws()
    {
        global $dbMysqli;
        $sql = 'SELECT * FROM utenti WHERE is_admin = 1 AND blocco_accesso = 0 AND ut_nome != "" ORDER BY ut_nome ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getTipoUtenti
     *
     * @return void
     */
    public function getTipoUtenti()
    {
        global $dbMysqli;
        $sql = 'SELECT * FROM tipo_utente ORDER BY id_tipo_utente ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getClienti
     *
     * @return void
     */
    public function getClienti()
    {
        global $dbMysqli;
        $sql = 'SELECT * FROM anagrafica WHERE rag_soc != "" ORDER BY rag_soc ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getSiti
     *
     * @return void
     */
    public function getSiti()
    {
        global $dbMysqli;
        $sql = 'SELECT * FROM siti WHERE web != "" ORDER BY web ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getSiti
     *
     * @return void
     */
    public function getSitoById($idsito)
    {
        global $dbMysqli;
        $sql = 'SELECT web FROM siti WHERE idsito = '.$idsito;
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            $nomeSito = $ret[0]['web'];
            return $nomeSito;
        } else {
            return false;
        }

    }

    /**
     * getArrayTipoUtenti
     *
     * @param  mixed $idutente
     * @return void
     */
    public function getArrayTipoUtenti($idutente = null)
    {
        global $dbMysqli;
        $sql = 'SELECT
						utente_tipo_utente.id_tipo_utente
					FROM
						utente_tipo_utente
					WHERE
						utente_tipo_utente.idutente = ' . $idutente;
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            foreach ($ret as $key => $value) {
                $array[] = $value['id_tipo_utente'];
            }
            return ($array);
        } else {
            return false;
        }

    }

    /**
     * getSitiByidAnagra
     *
     * @param  mixed $idanagra
     * @return void
     */
    public function getSitiByidAnagra($idanagra)
    {
        global $dbMysqli;
        $sql = 'SELECT
						siti.* ,
						utenti.username,
						utenti.password
					FROM
						siti
					LEFT JOIN
                    	utenti ON utenti.idsito = siti.idsito
                	LEFT JOIN
                    	anagrafica ON anagrafica.idanagra = utenti.idanagra
					WHERE
						anagrafica.idanagra = ' . $idanagra . '
					ORDER BY
						siti.id_status ASC, RIGHT(web, 3) ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getReferentiByIdAnagra
     *
     * @param  mixed $id_adhoc
     * @return void
     */
    public function getReferentiByIdAnagra($id_adhoc)
    {
        global $dbMysqli;
        $sql = 'SELECT
						anagrafica_riferimenti.*
					FROM
						anagrafica_riferimenti
					WHERE
						anagrafica_riferimenti.id_adhoc = ' . $id_adhoc . '';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getSocialByIdAnagra
     *
     * @param  mixed $idanagra
     * @return void
     */
    public function getSocialByIdAnagra($idanagra)
    {
        global $dbMysqli;
        $sql = 'SELECT
						siti.facebook,
						siti.twitter,
						siti.instagram,
						siti.tripadvisor,
						siti.whatsapp
					FROM
						siti
					INNER JOIN
						utenti ON utenti.idsito = siti.idsito
					INNER JOIN
						anagrafica ON anagrafica.idanagra = utenti.idanagra
					WHERE
						anagrafica.idanagra = ' . $idanagra . '';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * checkServiziByIdSito
     *
     * @param  mixed $idsito
     * @return void
     */
    public function checkServiziByIdSito($idsito)
    {
        global $dbMysqli;
        $sql = 'SELECT
						siti.hospitality,
						siti.data_start_hospitality,
						siti.data_end_hospitality,
						siti.website,
						siti.italiaabc
					FROM
						siti
					WHERE
						siti.idsito = ' . $idsito . '
					ORDER BY
						siti.id_status ASC';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * fatturato
     *
     * @param  mixed $id_adhoc
     * @param  mixed $anno
     * @return void
     */
    public function fatturato($id_adhoc, $anno)
    {
        global $dbMysqli;
        $select_fatt = '  SELECT
							SUM((righe_fatture_clienti.prz_unit * righe_fatture_clienti.qta) - REPLACE(righe_fatture_clienti.sconto_riga,"-","")) as totale
						FROM
							testate_fatture_clienti
						INNER JOIN
							righe_fatture_clienti ON righe_fatture_clienti.fattura = testate_fatture_clienti.fattura
						WHERE
							testate_fatture_clienti.id_adhoc =' . $id_adhoc . '
						AND
							YEAR(testate_fatture_clienti.data_fattura) = "' . $anno . '"
						AND
							YEAR(righe_fatture_clienti.data_fattura) = "' . $anno . '"';

        $righe = $dbMysqli->query($select_fatt);

        foreach ($righe as $ke => $fatt) {
            $totale_fatturato = $fatt['totale'];
            $totalone_fatturato = $totalone_fatturato + $totale_fatturato;
        }
        return $totalone_fatturato;
    }

    /**
     * countSitiByidAnagra
     *
     * @param  mixed $idanagra
     * @return void
     */
    public function countSitiByidAnagra($idanagra)
    {
        global $dbMysqli;
        $sql = 'SELECT
						COUNT(siti.idsito) as numero_siti
					FROM
						siti
					LEFT JOIN
                    	utenti ON utenti.idsito = siti.idsito
                	LEFT JOIN
                    	anagrafica ON anagrafica.idanagra = utenti.idanagra
					WHERE
						anagrafica.idanagra = ' . $idanagra . '
					AND
						siti.id_status = 1';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret[0]['numero_siti']);
        } else {
            return false;
        }

    }

    /**
     * checkQuotoByIdAnagra
     *
     * @param  mixed $idanagra
     * @return void
     */
    public function checkQuotoByIdAnagra($idanagra)
    {
        global $dbMysqli;
        $sql = 'SELECT
						siti.idsito
					FROM
						anagrafica
					INNER JOIN
						utenti ON utenti.idanagra = anagrafica.idanagra
					INNER JOIN
						siti ON siti.idsito = utenti.idsito
					WHERE
						anagrafica.idanagra = ' . $idanagra . '
					AND
						siti.hospitality = 1';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return $ret[0]['idsito'];
        } else {
            return false;
        }

    }

    /**
     * tot_fatturato_anno
     *
     * @param  mixed $idsito
     * @param  mixed $inizio
     * @param  mixed $fine
     * @return void
     */
    public function tot_fatturato_anno($idsito, $inizio, $fine)
    {
        global $dbMysqli;

        $select = "SELECT
					SUM(hospitality_proposte.PrezzoP) as fatturato
				  FROM
					hospitality_guest
				  INNER JOIN
					hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
				  WHERE
					1 = 1
				  AND
					hospitality_guest.DataChiuso >= '" . $inizio . "'
				  AND
					hospitality_guest.DataChiuso <= '" . $fine . "'
				  AND
					hospitality_guest.idsito = " . $idsito . "
				  AND
					hospitality_guest.Chiuso = 1
				  AND
					hospitality_guest.Disdetta = 0
				  AND
					  hospitality_guest.Hidden = 0
				  AND
					hospitality_guest.TipoRichiesta = 'Conferma'";

        $res = $dbMysqli->query($select);
        if (sizeof($res)) {
            return ($res[0]['fatturato']);
        } else {
            return false;
        }

    }

    /**
     * listaSitiByidAnagra
     *
     * @param  mixed $idanagra
     * @return void
     */
    public function listaSitiByidAnagra($idanagra)
    {
        global $dbMysqli;
        $sql = 'SELECT
						siti.idsito,
						siti.web
					FROM
						siti
					LEFT JOIN
                    	utenti ON utenti.idsito = siti.idsito
                	LEFT JOIN
                    	anagrafica ON anagrafica.idanagra = utenti.idanagra
					WHERE
						anagrafica.idanagra = ' . $idanagra . '
					AND
						siti.id_status = 1';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * getUtentiByIdSito
     *
     * @param  mixed $idsito
     * @return void
     */
    public function getUtentiByIdSito($idsito)
    {
        global $dbMysqli;
        $sql = 'SELECT * FROM utenti WHERE idsito = ' . $idsito . '';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * checkDataQuotoByIdAnagra
     *
     * @param  mixed $idanagra
     * @return void
     */
    public function checkDataQuotoByIdAnagra($idanagra)
    {
        global $dbMysqli;
        $sql = 'SELECT
						siti.data_end_hospitality
					FROM
						anagrafica
					INNER JOIN
						utenti ON utenti.idanagra = anagrafica.idanagra
					INNER JOIN
						siti ON siti.idsito = utenti.idsito
					WHERE
						anagrafica.idanagra = ' . $idanagra . '
					AND
						siti.hospitality = 1';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return $ret[0]['data_end_hospitality'];
        } else {
            return false;
        }

    }

    /**
     * datiHotel
     *
     * @param  mixed $idsito
     * @return void
     */
    public function datiHotel($idsito)
    {
        global $dbMysqli;
        $sel = "SELECT * FROM siti WHERE idsito = " . $idsito;
        $res = $dbMysqli->query($sel);
        $rec = $res[0];

        return $rec;
    }
    /**
     * nomeSito
     *
     * @param  mixed $idsito
     * @return void
     */
    public function nomeSito($idsito)
    {
        global $dbMysqli;
        $sel = "SELECT * FROM siti WHERE idsito = " . $idsito;
        $res = $dbMysqli->query($sel);
        $rec = $res[0];

        return $rec['web'];
    }
    /**
     * logoSito
     *
     * @param  mixed $idsito
     * @return void
     */
    public function logoSito($idsito)
    {
        global $dbMysqli;
        $sel = "SELECT utenti.logo FROM utenti INNER JOIN siti ON siti.idsito = utenti.idsito WHERE siti.idsito = " . $idsito;
        $res = $dbMysqli->query($sel);
        $rec = $res[0];

        return $rec['logo'];
    }
    /**
     * checkAPIQuotoHotel
     *
     * @param  mixed $idsito
     * @return void
     */
    public function checkAPIQuotoHotel($idsito)
    {
        global $dbMysqli;
        $sel = "SELECT API_hospitality FROM siti WHERE idsito = " . $idsito;
        $res = $dbMysqli->query($sel);
        $check = $res[0]['API_hospitality'];

        return $check;
    }
    /**
     * lastInsertId
     *
     * @param  mixed $idsito
     * @param  mixed $tabella
     * @param  mixed $campo
     * @return void
     */
    public function lastInsertId($idsito, $tabella, $campo)
    {
        global $dbMysqli;
        $sel = "SELECT " . $campo . " FROM " . $tabella . " WHERE idsito = " . $idsito . " ORDER BY " . $campo . " DESC LIMIT 1";
        $res = $dbMysqli->query($sel);
        $rec = $res[0];

        return $rec[$campo];
    }

    /**
     * getContentComunicazioni
     *
     * @param  mixed $id
     * @return void
     */
    public function getContentComunicazioni($id)
    {
        global $dbMysqli;
        $sql = 'SELECT
						*
					FROM
						comunicazioni
					WHERE
						Id = ' . $id . '';
        $ret = $dbMysqli->query($sql);
        if (sizeof($ret)) {
            return ($ret);
        } else {
            return false;
        }

    }

    /**
     * dateDiffNotti
     *
     * @param  mixed $data1
     * @param  mixed $data2
     * @param  mixed $formato
     * @return void
     */
    public function dateDiffNotti($data1, $data2, $formato)
    {
        $datetime1 = new DateTime($data1);
        $datetime2 = new DateTime($data2);
        $interval = $datetime1->diff($datetime2);
        return $interval->format($formato);
    }

    /**
     * dateDiff
     *
     * @param  mixed $data1
     * @param  mixed $data2
     * @param  mixed $formato
     * @return void
     */
    public function dateDiff($data1, $data2, $formato)
    {
        $datetime1 = new DateTime($data1);
        $datetime2 = new DateTime($data2);
        $interval = $datetime1->diff($datetime2);
        return $interval->format($formato);
    }

    /**
     * bg_fonte
     *
     * @param  mixed $id
     * @return void
     */
    public function bg_fonte($id)
    {
        global $dbMysqli;

        $multi = '';
        $ico = '';

        $q = $dbMysqli->query('SELECT NumeroPrenotazione,MultiStruttura,FontePrenotazione FROM hospitality_guest WHERE Id = ' . $id . '');
        $rec = $q[0];

        if (strstr($rec['MultiStruttura'], '?')) {

            $multi_ = explode('?', $rec['MultiStruttura']);
            $multi = $multi_[1];

            if (strstr($multi, '&')) {
                $multi_ = explode('&', $rec['MultiStruttura']);
                $multi = $multi_[1];
            } else {
                $multi = $rec['MultiStruttura'];
            }

            if (strstr($multi, '=')) {
                $multi_ = explode('=', $rec['MultiStruttura']);
                $multi = $multi_[1];
            } else {
                $multi = $rec['MultiStruttura'];
            }

        } elseif (strstr($rec['MultiStruttura'], '&')) {

            $multi_ = explode('&', $rec['MultiStruttura']);
            $multi = $multi_[1];

            if (strstr($multi, '?')) {
                $multi_ = explode('&', $rec['MultiStruttura']);
                $multi = $multi_[1];
            } else {
                $multi = $rec['MultiStruttura'];
            }

            if (strstr($multi, '=')) {
                $multi_ = explode('=', $rec['MultiStruttura']);
                $multi = $multi_[1];
            } else {
                $multi = $rec['MultiStruttura'];
            }

        } else {

            $multi = $rec['MultiStruttura'];

        }

        if (strstr($rec['MultiStruttura'], 'captcha=error')) {
            $multi_ = explode('?', $rec['MultiStruttura']);
            $multi = $multi_[0];
        }

        switch ($rec['FontePrenotazione']) {

            case 'Sito Web':

                $ico = '<label class="badge badge-default bg-warning f-12">
							<a href="javascript:;" class="f-12 text-white" data-toggle="modal" data-target="#referer' . $id . '" id="openIframe' . $id . '" title="Percorso referer">
							' . $rec['FontePrenotazione'] . ' /Landing
							</a>
						</label>' . ($rec['MultiStruttura'] != '' ? '<div class="clearfix"></div><span class="f-10">' . (strlen($multi) <= 30 ? $multi : substr($multi, 0, 30) . '...') . '</span>' : '') . '
				        <div class="modal fade" id="referer' . $id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title text-black" id="exampleModalLabel">Percorso di provenienza dettagliato!</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<iframe id="iframe' . $id . '" height="30px" width="100%" frameborder="0" scrolling="no" allowtransparency="true" src=""></iframe>
									</div>
								</div>
							</div>
						</div>
                        <script>
                        $( document ).ready(function() {
                            $("#openIframe' . $id . '").on("click",function(){
                                $("#iframe' . $id . '").attr("src","https://' . $_SERVER['HTTP_HOST'] . '/referer_utm/' . $rec['NumeroPrenotazione'] . '/");
                            });
                        });
                        </script>';
                break;
            case '':
                $ico = '<label class="badge badge-inverse-danger f-10">Da impostare</label>';
                break;
            default:
                $ico = '<label class="badge badge-default bg-success f-11">' . $rec['FontePrenotazione'] . '</label>';
                break;

        }
        return $ico;
    }

    /**
     * bg_tipo
     *
     * @param  mixed $value
     * @return void
     */
    public function bg_tipo($value)
    {
        $ico = '';
        if ($value) {
            $array_value = explode(",", $value);
            if (is_array($array_value)) {
                foreach ($array_value as $key => $val) {
                    $ico .= '<label class="badge badge-default bg-info f-11 text-left">' . $val . '</label><div class="clearfix"></div>';
                }
            } else {
                $ico = '<label class="badge badge-default bg-info f-11 text-left">' . $value . '</label>';
            }

        } else {
            $ico = '<label class="badge badge-inverse-danger f-10">Da impostare</label>';
        }
        return $ico;
    }

    /**
     * get_scadenza
     *
     * @param  mixed $value
     * @param  mixed $id
     * @return void
     */
    public function get_scadenza($value, $id)
    {
        global $dbMysqli;

        if ($value) {
            if ($value < date('Y-m-d')) {
                return '
					<a href="javascript:;" class="editable editable-click" id="data_scadenza' . $id . '" data-toggle="modal" data-target="#myModal' . $id . '" title="Re-imposta la data di scadenza"><span class="text-gray nowrap f-12">' . $this->gira_data($value) . '</span></a>
						<div class="modal fade" id="myModal' . $id . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
								<form id="form_data' . $id . '" name="form_data" method="post" action="https://' . $_SERVER['HTTP_HOST'] . '/preventivi/">
								<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel">Re-imposta la data di scadenza</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">

										<div class="control-group">
											<label for="DataScadenza" class="control-label">Data Scadenza</label>
											<div class="controls">
												<div class="input-group">
												    <div class="input-group">
														<span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                                        <input type="date" class="form-control" id="DataScadenza' . $id . '"  name="DataScadenza" value="' . $value . '" />
                                                    </div>
												</div>
											</div>
										</div>
										<input type="hidden" name="idrichiesta" value="' . $id . '">
										<input type="hidden" name="action" value="send_data">
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
										<button type="submit"  class="btn btn-primary"><span id="txt_save' . $id . '">Salva</span></button>
									</div>
								</form>
								<script>
									$( document ).ready(function() {
										$("#form_data' . $id . '").on("submit",function(){
											$("#txt_save' . $id . '").html(\'<i class="fa fa-spinner fa-pulse"></i>\');
										});
									});
								</script>
								</div>
							</div>
						</div> ';

            } else {

                return '<span class="nowrap f-12">' . $this->gira_data($value) . '</span>';
            }
        } else {
            return '<label class="badge badge-default bg-danger f-11">Da impostare</label>';

        }
    }

    /**
     * get_invio
     *
     * @param  mixed $value
     * @param  mixed $id
     * @return void
     */
    public function get_invio($value, $id)
    {
        global $dbMysqli;

        if ($value) {
            $value = date('d-m-Y', strtotime($value));
            $query = 'SELECT MetodoInvio FROM hospitality_guest  WHERE Id = ' . $id;
            $result = $dbMysqli->query($query);
            $record = $result[0];

            return '<span class="nowrap f-12">' . $value . ($record['MetodoInvio'] != '' ? '<br /><small>Tramite: ' . $record['MetodoInvio'] . '</small>' : '') . '</span>';
        } else {
            return '<label class="badge badge-inverse-danger f-10">Da Inviare</label>';
        }
    }

    /**
     * get_operatore
     *
     * @param  mixed $value
     * @param  mixed $idsito
     * @return void
     */
    public function get_operatore($value, $idsito)
    {
        global $dbMysqli;
        $val = '';

        if ($value) {

            $q = $dbMysqli->query('SELECT img,idsito,Abilitato from hospitality_operatori WHERE NomeOperatore = "' . $value . '" AND idsito = ' . $idsito);
            $rec = $q[0];
            $Img = $rec['img'];
            $idsito = $rec['idsito'];
            $Abilitato = $rec['Abilitato'];
            if ($Img) {
                $val = '<img src="https://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $idsito . '/' . $Img . '" class="img-circle" data-toogle="tooltip" title="Operatore ' . ($Abilitato == 0 ? 'DISABILITATO' : '') . ': ' . $value . '" style="width:18px;height:18px;' . ($Abilitato == 0 ? 'opacity:0.5' : '') . '">';
            } else {
                $val = '<i class="fa fa-user" data-toogle="tooltip" ' . ($Abilitato == 0 ? 'style="opacity:0.5"' : '') . ' title="Operatore ' . ($Abilitato == 0 ? 'DISABILITATO' : '') . ': ' . $value . '"></i>';
            }
        } else {
            $val = '<div style="width:100%!important">
						<i class="fa fa-user text-red" data-toogle="tooltip" title="Operatore: ancora da assegnare"></i>
						' . ($_SERVER['REQUEST_URI'] == '/preventivi/' ? '<label data-toogle="tooltip" title="Assegna un Operatore al Preventivo" class="cont_check_op" style="float:right;margin-top:15px"><input type="checkbox" name="IdPrev" value="' . $row['hospitality_guest.Id'] . '" /><span class="checkmark_op"></span></label>' : '') . '
					</div>';
        }

        return $val;
    }

    /**
     * func_chat
     *
     * @param  mixed $NumeroPrenotazione
     * @param  mixed $DataInvio
     * @param  mixed $DataScadenza
     * @param  mixed $DataChiuso
     * @param  mixed $DataArrivo
     * @param  mixed $idsito
     * @param  mixed $id
     * @param  mixed $provenienza
     * @return void
     */
    public function func_chat($NumeroPrenotazione, $DataInvio, $DataScadenza, $DataChiuso, $DataArrivo, $idsito, $id, $provenienza)
    {
        global $dbMysqli;

        $new_chat = '';
        $chat = '';
        $command = '';
        switch ($provenienza) {
            case 'preventivi':
                $etichetta = 'Preventivo';
                break;
            case 'conferme':
                $etichetta = 'Conferma';
                break;
            case 'prenotazioni':
                $etichetta = 'Prenotazione';
                break;
        }
        $q = $dbMysqli->query('SELECT * FROM hospitality_chat WHERE NumeroPrenotazione = ' . $NumeroPrenotazione . ' AND idsito = ' . $idsito . ' ORDER by data DESC');
        $rec = $q[0];

        if (sizeof($rec) > 0) {
            if ($rec['operator'] == 0) {
                $new_chat = '<i class="fa fa-spinner fa-pulse"></i>';
                $title = 'Rispondi alla Chat';
            } else {
                $new_chat = '';
                $title = 'Discussione Chat';
            }

            $chat = '<a class="btn btn-primary btn-sm" href="#!" data-toggle="modal" title="' . $title . '" data-target="#idChat' . $id . '">
										' . $new_chat . ' Chat
									</a>';
        } else {
            if ($DataInvio != '') {
                if ($DataScadenza >= date("Y-m-d")) {

                    $chat = '<a class="btn btn-primary btn-sm" href="#!" data-toggle="modal" title="Apri una Chat" data-target="#idChat' . $id . '">
									<i class="fa fa-comments-o"></i> Apri Chat
								</a>';
                } else {
                    $chat = '<label class="badge badge-inverse-danger f-11">Data Scadenza passata</label>';
                }
            } else {
                $chat = '<label class="badge badge-inverse-danger f-11">' . $etichetta . ' da inviare</label>';
            }
            if (($DataChiuso != '') && ($DataArrivo > date('Y-m-d'))) {

                $chat = '<a class="btn btn-primary btn-sm" href="#!" data-toggle="modal" title="Apri una Chat" data-target="#idChat' . $id . '">
								<i class="fa fa-comments-o"></i> Apri Chat
							</a>';

            }
        }

        return $chat;
    }
    /**
     * func_chat_column2
     *
     * @param  mixed $NumeroPrenotazione
     * @param  mixed $DataInvio
     * @param  mixed $DataScadenza
     * @param  mixed $DataChiuso
     * @param  mixed $DataArrivo
     * @param  mixed $idsito
     * @param  mixed $id
     * @param  mixed $provenienza
     * @return void
     */
    public function func_chat_column2($NumeroPrenotazione, $DataInvio, $DataScadenza, $DataChiuso, $DataArrivo, $idsito, $id, $provenienza)
    {
        global $dbMysqli;

        $new_chat = '';
        $chat = '';
        $command = '';
        switch ($provenienza) {
            case 'preventivi':
                $etichetta = 'Preventivo';
                break;
            case 'conferme':
                $etichetta = 'Conferma';
                break;
            case 'prenotazioni':
                $etichetta = 'Prenotazione';
                break;
        }
        $q = $dbMysqli->query('SELECT * FROM hospitality_chat WHERE NumeroPrenotazione = ' . $NumeroPrenotazione . ' AND idsito = ' . $idsito . ' ORDER by data DESC');
        $rec = $q[0];

        if (sizeof($rec) > 0) {
            if ($rec['operator'] == 0) {
                $new_chat = '<i class="fa fa-spinner fa-pulse"></i>';
                $title = 'Rispondi alla Chat';
            } else {
                $new_chat = '';
                $title = 'Discussione Chat';
            }

            $chat = ' <form class="f-11" id="form_c' . $rec['id'] . '" name="form_c" method="post" action="https://' . $_SERVER['HTTP_HOST'] . '/chat/" >
									<input type="hidden" name="id_guest" value="' . $id . '">
									<input type="hidden" name="provenienza" value="' . $provenienza . '">
									<input type="hidden" name="NumeroPrenotazione" value="' . $NumeroPrenotazione . '">
									<button type="submit" class="btn btn-primary btn-mini" data-toggle="tooltip" title="' . $title . '">' . $new_chat . ' Chat</button>
							</form>';
        } else {
            if ($DataInvio != '') {
                if ($DataScadenza >= date("Y-m-d")) {
                    $chat = '<form class="f-11" id="form_c' . $rec['id'] . '" name="form_c" method="post" action="https://' . $_SERVER['HTTP_HOST'] . '/chat/" >
										<input type="hidden" name="id_guest" value="' . $id . '">
										<input type="hidden" name="provenienza" value="' . $provenienza . '">
										<input type="hidden" name="NumeroPrenotazione" value="' . $NumeroPrenotazione . '">
										<button type="submit" class="btn btn-primary btn-mini" data-toggle="tooltip" title="Apri una Chat"><i class="fa fa-comments-o"></i> Apri Chat</button>
								</form>';

                }
            }
            if (($DataChiuso != '') && ($DataArrivo > date('Y-m-d'))) {

                $chat = '<form class="f-11" id="form_c' . $rec['id'] . '" name="form_c" method="post" action="https://' . $_SERVER['HTTP_HOST'] . '/chat/" >
									<input type="hidden" name="id_guest" value="' . $id . '">
									<input type="hidden" name="provenienza" value="' . $provenienza . '">
									<input type="hidden" name="NumeroPrenotazione" value="' . $NumeroPrenotazione . '">
									<button type="submit" class="btn btn-primary btn-mini" data-toggle="tooltip" title="Apri una Chat"><i class="fa fa-comments-o"></i> Apri Chat</button>
							</form>';

            }
        }

        return $chat;
    }
    /**
     * func_chat_column
     *
     * @param  mixed $NumeroPrenotazione
     * @param  mixed $DataInvio
     * @param  mixed $DataScadenza
     * @param  mixed $DataChiuso
     * @param  mixed $DataArrivo
     * @param  mixed $idsito
     * @param  mixed $id
     * @param  mixed $provenienza
     * @return void
     */
    public function func_chat_column($NumeroPrenotazione, $DataInvio, $DataScadenza, $DataChiuso, $DataArrivo, $idsito, $id, $provenienza)
    {
        global $dbMysqli;

        $new_chat = '';
        $chat = '';
        $command = '';
        switch ($provenienza) {
            case 'preventivi':
                $articolo = 'del';
                $etichetta = 'Preventivo';
                $inputHidden = 'id_preventivo';
                break;
            case 'conferme':
                $articolo = 'della';
                $etichetta = 'Conferma';
                $inputHidden = 'id_conferma';
                break;
            case 'prenotazioni':
                $articolo = 'della';
                $etichetta = 'Prenotazione';
                $inputHidden = 'id_prenotazione';
                break;
        }
        $q = $dbMysqli->query('SELECT * FROM hospitality_chat WHERE NumeroPrenotazione = ' . $NumeroPrenotazione . ' AND idsito = ' . $idsito . ' ORDER by data DESC');
        $rec = $q[0];

        if (sizeof($rec) > 0) {
            if ($rec['operator'] == 0) {
                $new_chat = '<i class="fa fa-spinner fa-pulse"></i>';
                $title = 'Rispondi alla Chat';
            } else {
                $new_chat = '';
                $title = 'Discussione Chat';
            }

            $chat = '<a class="btn btn-primary btn-mini-mini" href="#!"  title="' . $title . '" id="OpenColumnChat' . $id . '">
										' . $new_chat . ' Chat
									</a>';
        } else {
            if ($DataInvio != '') {
                if ($DataScadenza >= date("Y-m-d")) {
                    $chat = '<a class="btn btn-primary btn-mini-mini" href="#!"  title="Apri una Chat" id="OpenColumnChat' . $id . '">
									<i class="fa fa-comments-o"></i> Apri Chat
								</a>';

                }
            }
            if (($DataChiuso != '') && ($DataArrivo > date('Y-m-d'))) {

                $chat = '<a class="btn btn-primary btn-mini-mini" href="#!"  title="Apri una Chat" id="OpenColumnChat' . $id . '">
								<i class="fa fa-comments-o"></i> Apri Chat
							</a>';

            }
        }

        $redirectForm = ' 	<form name="redirect" id="redirect' . $id . '" method="POST" action="' . BASE_URL_SITO . $provenienza . '/">
									<input type="hidden" name="' . $inputHidden . '" value="' . $id . '">
								</form>' . "\r\n";

        $modale = '<!-- MODALE CHAT -->
				<div class="modal fade" id="idColumnChat' . $id . '"  role="dialog" aria-labelledby="idColumnChat' . $id . '">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title text-left" id="myModalLabel">Chat! <div class="clearfix f-11">Chiudi la finestra e ri-apri i dettagli ' . $articolo . ' ' . strtolower($etichetta) . ' cliccando sulla <b>X</b></div></h5>
								<i class="fa fa-times fa-2x" id="pul_close_chat' . $id . '" class="btn btn-out-dotted btn-inverse btn-square btn-sm" data-dismiss="modal" aria-label="Close" style="float:right;cursor:pointer;"></i>
							</div>
							<div class="modal-body">
									<iframe id="srcAttbributo' . $id . '" src="" frameborder="no" scrolling="yes" onload="resizeIframe(this)" style="min-height:800px;width:100%"></iframe>
							</div>
						</div>
					</div>
				</div>
				<script>
					$(document).ready(function(){
						$("#OpenColumnChat' . $id . '").on("click",function(){
							$("#idColumnChat' . $id . '").modal("show");
							$("#srcAttbributo' . $id . '").attr("src","' . BASE_URL_SITO . 'ajax/chat/dashboard_chat.php?NumeroPrenotazione=' . $NumeroPrenotazione . '&idsito=' . $idsito . '")
						});
						$("#pul_close_chat' . $id . '").on("click",function () {
							$("#redirect' . $id . '").submit();
						});
					});
				</script>';

        return $chat . $redirectForm . $modale;
    }
    /**
     * func_spinner_chat
     *
     * @param  mixed $NumeroPrenotazione
     * @param  mixed $idsito
     * @return void
     */
    public function func_spinner_chat($NumeroPrenotazione, $idsito)
    {
        global $dbMysqli;

        $new_chat = '';

        $q = $dbMysqli->query('SELECT * FROM hospitality_chat WHERE NumeroPrenotazione = ' . $NumeroPrenotazione . ' AND idsito = ' . $idsito . ' ORDER by data DESC');
        $rec = $q[0];

        if (sizeof($rec) > 0) {
            if ($rec['operator'] == 0) {
                $new_chat = '<span class="p-l-10"><i class="fa fa-spinner fa-pulse text-success" data-toggle="tooltip" title="Chat in attesa di risposta"></i></span>';
            } else {
                $new_chat = '';
            }
        } else {
            $new_chat = '';
        }

        return $new_chat;
    }
    /**
     * func_chat_riepilogo
     *
     * @param  mixed $NumeroPrenotazione
     * @param  mixed $idsito
     * @return void
     */
    public function func_chat_riepilogo($NumeroPrenotazione, $idsito)
    {
        global $dbMysqli;

        $new_chat = '';
        $chat = '';

        $q = $dbMysqli->query('SELECT * FROM hospitality_chat WHERE NumeroPrenotazione = ' . $NumeroPrenotazione . ' AND idsito = ' . $idsito . '  ORDER by data DESC');
        $rec = $q[0];
        if (is_array($rec)) {
            if ($rec > count($rec)) {
                $tot = count($rec);
            }

        } else {
            $tot = 0;
        }
        if ($tot > 0) {
            $chat = ' <form id="form_cr' . $rec['id'] . '" name="form_cr" method="post" action="https://' . $_SERVER['HTTP_HOST'] . '/riepilogo_chat/" >
								<input type="hidden" name="NumeroPrenotazione" value="' . $NumeroPrenotazione . '">
								<input type="hidden" name="id_guest" value="' . $rec['id_guest'] . '">
								<button type="submit" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Riepilogo discussione in Chat" ><i class="fa fa-comments-o" aria-hidden="true"></i> Talk</button>
						</form>';

            return $chat;
        }

    }

    /**
     * check_configurazioni
     *
     * @param  mixed $idsito
     * @param  mixed $parametro
     * @return void
     */
    public function check_configurazioni($idsito, $parametro)
    {
        global $dbMysqli;

        $check = '';

        $config = "SELECT valore FROM hospitality_configurazioni WHERE idsito = " . $idsito . " AND parametro = '" . $parametro . "'";
        $res_config = $dbMysqli->query($config);
        $rec_config = $res_config[0];

        if ($parametro == 'select_tipo_camere') {

            if ($rec_config['valore'] == '1') {
                $check = 'chosen-select ';
            } else {
                $check = '';
            }

        } else {

            if ($rec_config['valore'] == '1') {
                $check = 1;
            } else {
                $check = 0;
            }

        }

        return $check;
    }

    /**
     * notifica_mancata_click
     *
     * @param  mixed $idsito
     * @param  mixed $TipoRichiesta
     * @return void
     */
    public function notifica_mancata_click($idsito, $TipoRichiesta)
    {
        global $dbMysqli;

        $script = '';

        $query = "SELECT
								Id,
								DataRichiesta,
								DataInvio,
								DataScadenza,
								NumeroPrenotazione,
								Nome,
								Cognome
							FROM
								hospitality_guest
							WHERE
								TipoRichiesta = '" . $TipoRichiesta . "'
							AND
								idsito = " . $idsito . "
							AND
								DataInvio IS NOT NULL
							AND
								DataInvio < '" . date('Y-m-d') . "'
							AND
								DataScadenza > '" . date('Y-m-d') . "'";

        $array_fetch = $dbMysqli->query($query);

        if (sizeof($array_fetch) > 0) {

            $loadercolor = '';
            $aperture = '';
            $testo = '';
            $aperture_exists = array();

            if ($TipoRichiesta == 'Preventivo') {
                (sizeof($array_fetch) == 1 ? $tipo = 'per il preventivo' : $tipo = 'per i preventivi');
                $loadercolor = "#000000";
            } else {
                (sizeof($array_fetch) == 1 ? $tipo = 'per la conferma' : $tipo = 'per le conferme');
                $loadercolor = "#000000";
            }
            foreach ($array_fetch as $key => $row) {

                $qry = "SELECT COUNT(Id) as Click FROM hospitality_traccia_email WHERE IdRichiesta = " . $row['Id'] . " AND Idsito = " . $idsito;
                $ris = $dbMysqli->query($qry);
                $rw = $ris[0];
                if ($row['DataRichiesta'] >= $_SESSION['DATA_DOWGRADE_SHORTURL']) {
                    $aperture = $rw['Click'];
                } else {
                    $aperture = ($rw['Click'] > 0 ? $rw['Click'] - 1 : $rw['Click']);
                }

                $aperture_exists[] = $aperture;

                if ($aperture == 0 && $row['DataInvio'] != '' && $row['DataInvio'] < date('Y-m-d') && $row['DataScadenza'] > date('Y-m-d')) {
                    $testo .= 'N. <b>' . $row['NumeroPrenotazione'] . '</b> per <em>' . $row['Nome'] . ' ' . $row['Cognome'] . '</em><br>';
                }
            }
            if (in_array(0, $aperture_exists)) {
                $script = ' <script>
									$( document ).ready(function() {
										setTimeout(function(){
											open_notifica("Sono passate più di <b>24 ore</b><br>dall\'invio dell\'email<br>' . $tipo . ':","' . $testo . '","plain","bottom-right","error",10000,"' . $loadercolor . '");
										}, 4950);
									});
								</script>' . "\r\n";
            }
        } else {
            $script = '';
        }

        return $script;
    }

    /**
     * dettaglio_richiesta
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function dettaglio_richiesta($id, $idsito)
    {

        global $dbMysqli;

        $select = "SELECT hospitality_proposte.Id as IdProposta,hospitality_proposte.NomeProposta, hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,hospitality_guest.TipoRichiesta,hospitality_guest.idsito,
							hospitality_guest.AccontoRichiesta,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.AccontoLibero,
							hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,hospitality_proposte.AccontoTesto,
							hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza,hospitality_guest.Chiuso,hospitality_guest.Id as id_richiesta
					FROM hospitality_proposte
					INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
					WHERE hospitality_guest.NumeroPrenotazione = " . $id . " AND hospitality_guest.idsito = " . $idsito . " ORDER BY hospitality_proposte.Id ASC";
        $res = $dbMysqli->query($select);
        $tot = sizeof($res);
        if ($tot > 0) {
            $Camere = '';
            $sistemazioneP = '';
            $sistemazioneC = '';
            $n = 1;
            $data_alernativa = '';
            $saldo = '';
            $etichetta_saldo = '';
            $DPartenza = '';
            $DArrivo = '';
            $DNotti = '';
            foreach ($res as $key => $value) {

                $PrezzoL = number_format($value['PrezzoL'], 2, ',', '.');
                $PrezzoP = number_format($value['PrezzoP'], 2, ',', '.');
                $IdProposta = $value['IdProposta'];
                $IdRichiesta = $value['id_richiesta'];
                $PrezzoPC = $value['PrezzoP'];
                $idsito = $value['idsito'];
                $AccontoRichiesta = $value['AccontoRichiesta'];
                $AccontoLibero = $value['AccontoLibero'];
                $NomeProposta = $value['NomeProposta'];
                $Nome = stripslashes($value['Nome']);
                $Cognome = stripslashes($value['Cognome']);
                $Email = $value['Email'];
                $Arrivo_tmp = explode("-", $value['DataArrivo']);
                $Arrivo = $Arrivo_tmp[2] . '-' . $Arrivo_tmp[1] . '-' . $Arrivo_tmp[0];
                $Partenza_tmp = explode("-", $value['DataPartenza']);
                $Partenza = $Partenza_tmp[2] . '-' . $Partenza_tmp[1] . '-' . $Partenza_tmp[0];
                $start = mktime(24, 0, 0, $Arrivo_tmp[1], $Arrivo_tmp[2], $Arrivo_tmp[0]);
                $end = mktime(01, 0, 0, $Partenza_tmp[1], $Partenza_tmp[2], $Partenza_tmp[0]);
                $formato = "%a";
                $Notti = dateDiff($value['DataArrivo'], $value['DataPartenza'], $formato);
                $AccontoPercentuale = $value['AccontoPercentuale'];
                $AccontoImporto = $value['AccontoImporto'];
                $AccontoTesto = stripslashes($value['AccontoTesto']);
                // date alternative
                $se = "SELECT hospitality_proposte.Arrivo,hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.Id = " . $IdProposta . " ";
                $re = $dbMysqli->query($se);
                $rc = $re[0];
                if (is_array($rc)) {
                    if ($rc > count($rc)) {
                        $tt = count($rc);
                    }

                } else {
                    $tt = 0;
                }
                if ($tt > 0) {
                    $DArrivo_tmp = explode("-", $rc['Arrivo']);
                    $DArrivo = $DArrivo_tmp[2] . '-' . $DArrivo_tmp[1] . '-' . $DArrivo_tmp[0];
                    $DPartenza_tmp = explode("-", $rc['Partenza']);
                    $DPartenza = $DPartenza_tmp[2] . '-' . $DPartenza_tmp[1] . '-' . $DPartenza_tmp[0];
                    $Dstart = mktime(24, 0, 0, $DArrivo_tmp[1], $DArrivo_tmp[2], intval($DArrivo_tmp[0]));
                    $Dend = mktime(01, 0, 0, $DPartenza_tmp[1], $DPartenza_tmp[2], intval($DPartenza_tmp[0]));
                    $formato = "%a";
                    $DNotti = $this->dateDiff($rc['Arrivo'], $rc['Partenza'], $formato);
                }

                if ($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                    $saldo = ($PrezzoPC - ($PrezzoPC * $AccontoRichiesta / 100));
                    $acconto = number_format(($PrezzoPC * $AccontoRichiesta / 100), 2, ',', '.');
                }
                if ($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                    $saldo = ($PrezzoPC - $AccontoLibero);
                    $acconto = number_format($AccontoLibero, 2, ',', '.');
                }

                if ($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                    $saldo = ($PrezzoPC - ($PrezzoPC * $AccontoPercentuale / 100));
                    $acconto = number_format(($PrezzoPC * $AccontoPercentuale / 100), 2, ',', '.');
                }
                if ($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                    if ($AccontoImporto >= 1) {
                        $etichetta_caparra = '';
                    } else {
                        $etichetta_caparra = '<br /><i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Carta di Credito a garanzia';
                    }
                    $saldo = ($PrezzoPC - $AccontoImporto);
                    $acconto = number_format($AccontoImporto, 2, ',', '.');
                    //$acconto = 'Carta di Credito a garanzia';
                }
                if ($PrezzoPC == $saldo) {
                    $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.0,00';
                } else {
                    if($AccontoPercentuale == 0 && $AccontoImporto <= 1) {
                        $saldo   = $PrezzoPC;
                    }
                    $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.' . number_format(floatval($saldo), 2, ',', '.');
                }

                $select2 = "SELECT hospitality_richiesta.*,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
							FROM hospitality_richiesta
							INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
							INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
							WHERE hospitality_richiesta.id_proposta = " . $IdProposta . " AND hospitality_richiesta.id_richiesta = " . $IdRichiesta;
                $res2 = $dbMysqli->query($select2);
                $Camere = '';
                if ($rc['Arrivo'] != '' && $rc['Partenza'] != '') {
                    if ($value['TipoRichiesta'] == 'Preventivo') {
                        if ($Arrivo != $DArrivo || $Partenza != $DPartenza) {
                            $data_alernativa = '<b>Date alternative</b><br>Arrivo <i class=\'fa fa-angle-right\'></i> ' . $DArrivo . ' - Partenza <i class=\'fa fa-angle-right\'></i> ' . $DPartenza . ' - per notti: ' . $DNotti . '<br>';
                        }
                    } elseif ($value['TipoRichiesta'] == 'Conferma') {
                        if ($rc['Arrivo'] != $value['DataArrivo']) {
                            $Arrivo = $DArrivo;
                        }
                        if ($rc['Partenza'] != $value['DataPartenza']) {
                            $Partenza = $DPartenza;
                        }
                    }
                }
                foreach ($res2 as $ky => $val) {
                    $Camere .= $val['TipoSoggiorno'] . ' <i class=\'fa fa-angle-right\'></i> Nr. ' . $val['NumeroCamere'] . ' ' . $val['TipoCamere'] . ($val['NumAdulti'] != 0 ? ' <i class=\'fa fa-angle-right\'></i> A: ' . $val['NumAdulti'] : '') . ($val['NumBambini'] != 0 ? ' B: ' . $val['NumBambini'] : '') . ($val['EtaB'] != '' || $val['EtaB'] != 0 ? ' età: ' . $val['EtaB'] : '') . ' - €. ' . number_format($val['Prezzo'], 2, ',', '.') . '<br>';
                }

                if ($value['TipoRichiesta'] == 'Preventivo') {

                    $sistemazioneP .= '<b>' . $n . ') PROPOSTA</b><br>' . ($NomeProposta != '' ? '<b>' . $NomeProposta . '</b><br>' : '') . '<b>' . $Nome . ' ' . $Cognome . '</b> - <em>' . $Email . '</em><br>Arrivo <i class=\'fa fa-angle-right\'></i> ' . $Arrivo . ' - Partenza <i class=\'fa fa-angle-right\'></i> ' . $Partenza . '<br>' . $data_alernativa . $Camere . '  <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>  ' . ($PrezzoL != '0,00' ? 'Prezzo List. €.<strike>' . $PrezzoL . '</strike> <i class=\'fa fa-angle-right\'></i>' : '') . '  Prezzo Proposto €.' . $PrezzoP . '<div class="clearfix p-b-20"></div>';

                } else {

                    $sistemazioneC .= '<b>SOLUZIONE CONFERMATA</b><br>' . ($NomeProposta != '' ? '<b>' . $NomeProposta . '</b><br>' : '') . '<b>' . $Nome . ' ' . $Cognome . '</b> - <em>' . $Email . '</em><br>Arrivo <i class=\'fa fa-angle-right\'></i> ' . $Arrivo . ' - Partenza <i class=\'fa fa-angle-right\'></i> ' . $Partenza . '<br> ' . $data_alernativa . $Camere . ' <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp;  ' . ($PrezzoL != '0,00' ? ' Prezzo List. €.<strike>' . $PrezzoL . '</strike> <i class=\'fa fa-angle-right\'></i>' : '') . '  Prezzo Proposto €.' . $PrezzoP . '<br /> ' . ($acconto != '' ? '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Caparra versata o da prelevare €.' . $acconto . '' : '') . '<br>' . $etichetta_saldo . '<div class="clearfix"></div>';

                }

                $n++;
                $data_alernativa = '';
                $DPartenza = '';
                $DArrivo = '';
                $DNotti = '';
            }

            if ($sistemazioneP != '') {
                $sistemazione = '<div class="col-md-12"><h4>Preventivo:</h4>' . $sistemazioneP . '</div>';
            }
            if ($sistemazioneC != '') {
                $sistemazione = '<div class="col-md-12"><h4>' . ($value['Chiuso'] == 1 ? 'Prenotazione' : 'Conferma') . ':</h4>' . $sistemazioneC . '</div>';
            }

            return '<div class="row lineH25">' . $sistemazione . '</div>';

        } else {
            return '<label class="badge badge-inverse-danger f-11">Preventivo da completare</label>';
        }

    }

    /**
     * dettaglio_profila
     *
     * @param  mixed $id
     * @param  mixed $NumeroPrenotazione
     * @param  mixed $TipoRichiesta
     * @param  mixed $idsito
     * @return void
     */
    public function dettaglio_profila($id, $NumeroPrenotazione, $TipoRichiesta, $idsito)
    {

        global $dbMysqli;

        $select = "SELECT
						hospitality_proposte.Id as IdProposta,
						hospitality_proposte.NomeProposta,
						hospitality_proposte.PrezzoL,
						hospitality_proposte.PrezzoP,
						hospitality_proposte.AccontoPercentuale,
						hospitality_proposte.AccontoImporto,
						hospitality_proposte.AccontoTesto,
						hospitality_guest.TipoRichiesta,
						hospitality_guest.idsito,
						hospitality_guest.AccontoRichiesta,
						hospitality_guest.Nome,
						hospitality_guest.Cognome,
						hospitality_guest.AccontoLibero,
						hospitality_guest.Email,
						hospitality_guest.DataArrivo,
						hospitality_guest.DataPartenza,
						hospitality_guest.Chiuso
					FROM
						hospitality_proposte
					INNER JOIN
						hospitality_guest
					ON
						hospitality_guest.Id = hospitality_proposte.id_richiesta
					WHERE
						hospitality_guest.id = " . $id . "
					AND
						hospitality_guest.idsito = " . $idsito . "
					ORDER BY
						hospitality_proposte.Id ASC";
        $res = $dbMysqli->query($select);
        $tot = sizeof($res);
        if ($tot > 0) {
            $Camere = '';
            $sistemazioneP = '';
            $sistemazioneC = '';
            $n = 1;
            $data_alernativa = '';
            $saldo = '';
            $etichetta_saldo = '';
            $DPartenza = '';
            $DArrivo = '';
            $DNotti = '';
            foreach ($res as $key => $value) {

                $PrezzoL = number_format($value['PrezzoL'], 2, ',', '.');
                $PrezzoP = number_format($value['PrezzoP'], 2, ',', '.');
                $IdProposta = $value['IdProposta'];
                $PrezzoPC = $value['PrezzoP'];
                $idsito = $value['idsito'];
                $AccontoRichiesta = $value['AccontoRichiesta'];
                $AccontoLibero = $value['AccontoLibero'];
                $NomeProposta = $value['NomeProposta'];
                $Nome = stripslashes($value['Nome']);
                $Cognome = stripslashes($value['Cognome']);
                $Email = $value['Email'];
                $Arrivo_tmp = explode("-", $value['DataArrivo']);
                $Arrivo = $Arrivo_tmp[2] . '-' . $Arrivo_tmp[1] . '-' . $Arrivo_tmp[0];
                $Partenza_tmp = explode("-", $value['DataPartenza']);
                $Partenza = $Partenza_tmp[2] . '-' . $Partenza_tmp[1] . '-' . $Partenza_tmp[0];
                $start = mktime(24, 0, 0, $Arrivo_tmp[1], $Arrivo_tmp[2], $Arrivo_tmp[0]);
                $end = mktime(01, 0, 0, $Partenza_tmp[1], $Partenza_tmp[2], $Partenza_tmp[0]);
                $formato = "%a";
                $Notti = dateDiff($value['DataArrivo'], $value['DataPartenza'], $formato);
                $AccontoPercentuale = $value['AccontoPercentuale'];
                $AccontoImporto = $value['AccontoImporto'];
                $AccontoTesto = stripslashes($value['AccontoTesto']);
                // date alternative
                $se = "SELECT hospitality_proposte.Arrivo,hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.Id = " . $IdProposta . "";
                $re = $dbMysqli->query($se);
                $rc = $re[0];
                if (is_array($rc)) {
                    if ($rc > count($rc)) {
                        $tt = count($rc);
                    }

                } else {
                    $tt = 0;
                }
                if ($tt > 0) {
                    $DArrivo_tmp = explode("-", $rc['Arrivo']);
                    $DArrivo = $DArrivo_tmp[2] . '-' . $DArrivo_tmp[1] . '-' . $DArrivo_tmp[0];
                    $DPartenza_tmp = explode("-", $rc['Partenza']);
                    $DPartenza = $DPartenza_tmp[2] . '-' . $DPartenza_tmp[1] . '-' . $DPartenza_tmp[0];
                    $Dstart = mktime(24, 0, 0, $DArrivo_tmp[1], $DArrivo_tmp[2], intval($DArrivo_tmp[0]));
                    $Dend = mktime(01, 0, 0, $DPartenza_tmp[1], $DPartenza_tmp[2], intval($DPartenza_tmp[0]));
                    $formato = "%a";
                    $DNotti = $this->dateDiff($rc['Arrivo'], $rc['Partenza'], $formato);
                }

                if ($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                    $saldo = ($PrezzoPC - ($PrezzoPC * $AccontoRichiesta / 100));
                    $acconto = number_format(($PrezzoPC * $AccontoRichiesta / 100), 2, ',', '.');
                }
                if ($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                    $saldo = ($PrezzoPC - $AccontoLibero);
                    $acconto = number_format($AccontoLibero, 2, ',', '.');
                }

                if ($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                    $saldo = ($PrezzoPC - ($PrezzoPC * $AccontoPercentuale / 100));
                    $acconto = number_format(($PrezzoPC * $AccontoPercentuale / 100), 2, ',', '.');
                }
                if ($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                    if ($AccontoImporto >= 1) {
                        $etichetta_caparra = '';
                    } else {
                        $etichetta_caparra = '<br /><i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Carta di Credito a garanzia';
                    }
                    $saldo = ($PrezzoPC - $AccontoImporto);
                    $acconto = number_format($AccontoImporto, 2, ',', '.');
                    //$acconto = 'Carta di Credito a garanzia';
                }
                if ($PrezzoPC == $saldo) {
                    $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.0,00';
                } else {
                    if($AccontoPercentuale == 0 && $AccontoImporto <= 1) {
                        $saldo   = $PrezzoPC;
                    }
                    $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.' . number_format(floatval($saldo), 2, ',', '.');
                }

                $select2 = "SELECT hospitality_richiesta.*,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
							FROM hospitality_richiesta
							INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
							INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
							WHERE hospitality_richiesta.id_proposta = " . $IdProposta . " AND hospitality_richiesta.id_richiesta = " . $id;
                $res2 = $dbMysqli->query($select2);
                $Camere = '';
                if ($rc['Arrivo'] != '' && $rc['Partenza'] != '') {
                    if ($value['TipoRichiesta'] == 'Preventivo') {
                        if ($Arrivo != $DArrivo || $Partenza != $DPartenza) {
                            $data_alernativa = '<b>Date alternative</b><br>Arrivo <i class=\'fa fa-angle-right\'></i> ' . $DArrivo . ' - Partenza <i class=\'fa fa-angle-right\'></i> ' . $DPartenza . ' - per notti: ' . $DNotti . '<br>';
                        }
                    } elseif ($value['TipoRichiesta'] == 'Conferma') {
                        if ($rc['Arrivo'] != $value['DataArrivo']) {
                            $Arrivo = $DArrivo;
                        }
                        if ($rc['Partenza'] != $value['DataPartenza']) {
                            $Partenza = $DPartenza;
                        }
                    }
                }
                foreach ($res2 as $ky => $val) {
                    $Camere .= $val['TipoSoggiorno'] . ' <i class=\'fa fa-angle-right\'></i> Nr. ' . $val['NumeroCamere'] . ' ' . $val['TipoCamere'] . ($val['NumAdulti'] != 0 ? ' <i class=\'fa fa-angle-right\'></i> A: ' . $val['NumAdulti'] : '') . ($val['NumBambini'] != 0 ? ' B: ' . $val['NumBambini'] : '') . ($val['EtaB'] != '' || $val['EtaB'] != 0 ? ' età: ' . $val['EtaB'] : '') . ' - €. ' . number_format($val['Prezzo'], 2, ',', '.') . '<br>';
                }

                if ($value['TipoRichiesta'] == 'Preventivo') {

                    $sistemazioneP .= '<b>' . $n . ') PROPOSTA</b><br>' . ($NomeProposta != '' ? '<b>' . $NomeProposta . '</b><br>' : '') . '<b>' . $Nome . ' ' . $Cognome . '</b> - <em>' . $Email . '</em><br>Arrivo <i class=\'fa fa-angle-right\'></i> ' . $Arrivo . ' - Partenza <i class=\'fa fa-angle-right\'></i> ' . $Partenza . '<br>' . $data_alernativa . $Camere . '  <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>  ' . ($PrezzoL != '0,00' ? 'Prezzo List. €.<strike>' . $PrezzoL . '</strike> <i class=\'fa fa-angle-right\'></i>' : '') . '  Prezzo Proposto €.' . $PrezzoP . '<div class="clearfix p-b-20"></div>';

                } else {

                    $sistemazioneC .= '<b>SOLUZIONE CONFERMATA</b><br>' . ($NomeProposta != '' ? '<b>' . $NomeProposta . '</b><br>' : '') . '<b>' . $Nome . ' ' . $Cognome . '</b> - <em>' . $Email . '</em><br>Arrivo <i class=\'fa fa-angle-right\'></i> ' . $Arrivo . ' - Partenza <i class=\'fa fa-angle-right\'></i> ' . $Partenza . '<br> ' . $data_alernativa . $Camere . ' <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp;  ' . ($PrezzoL != '0,00' ? ' Prezzo List. €.<strike>' . $PrezzoL . '</strike> <i class=\'fa fa-angle-right\'></i>' : '') . '  Prezzo Proposto €.' . $PrezzoP . '<br /> ' . ($acconto != '' ? '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Caparra versata o da prelevare €.' . $acconto . '' : '') . '<br>' . $etichetta_saldo . '<div class="clearfix"></div>';

                }

                $n++;
                $data_alernativa = '';
                $DPartenza = '';
                $DArrivo = '';
                $DNotti = '';
            }

            if ($sistemazioneP != '') {
                $sistemazione = '<div class="col-md-12"><h4>Preventivo:</h4>' . $sistemazioneP . '</div>';
            }
            if ($sistemazioneC != '') {
                $sistemazione = '<div class="col-md-12"><h4>' . ($value['Chiuso'] == 1 ? 'Prenotazione' : 'Conferma') . ':</h4>' . $sistemazioneC . '</div>';
            }

            return '<div class="row lineH20 f-12">
						' . $sistemazione . '
					</div>
					<div class="clearfix p-b-20"></div>
					<div class="row">
						<div class="col-md-12 text-center"><a href="https://' . $_SERVER['HTTP_HOST'] . '/print_pdf/' . base64_encode($id) . '" target="\'"_blank" class="btn btn-success btn-mini">Stampa PDF</a> ' . ($TipoRichiesta == 'Preventivo' ? '<a href="https://' . $_SERVER['HTTP_HOST'] . '/duplica_preventivo/' . $id . '/now/" class="btn btn-primary btn-mini">Ri-crea Preventivo con questi dati</a>' : '') . '</d></div>
					</div>';

        } else {
            return '<span class="nowrap">Da Completare</span>';
        }

    }

    /**
     * DirectorySito
     *
     * @param  mixed $idsito
     * @return void
     */
    public function DirectorySito($idsito)
    {
        global $dbMysqli;

        $select = 'SELECT web FROM siti WHERE idsito = "' . $idsito . '"';
        $result = $dbMysqli->query($select);
        $rows = $result[0];
        $sito_tmp = str_replace("http://", "", $rows['web']);
        $sito_tmp = str_replace("https://", "", $sito_tmp);
        $sito_tmp = str_replace("www.", "", $sito_tmp);
        $directory_sito = str_replace(".it", "", $sito_tmp);
        $directory_sito = str_replace(".com", "", $directory_sito);
        $directory_sito = str_replace(".net", "", $directory_sito);
        $directory_sito = str_replace(".biz", "", $directory_sito);
        $directory_sito = str_replace(".eu", "", $directory_sito);
        $directory_sito = str_replace(".de", "", $directory_sito);
        $directory_sito = str_replace(".es", "", $directory_sito);
        $directory_sito = str_replace(".fr", "", $directory_sito);

        return $directory_sito;
    }

    /**
     * check_template
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_template($idsito)
    {
        global $dbMysqli;

        $sel = "SELECT * FROM hospitality_template_landing WHERE idsito = " . $idsito . "";
        $res = $dbMysqli->query($sel);
        $record = $res[0];
        $template = $record['Template'];

        return $template;
    }

    /**
     * check_landing_template
     *
     * @param  mixed $idsito
     * @param  mixed $idrichiesta
     * @return void
     */
    public function check_landing_template($idsito, $idrichiesta = null)
    {
        global $dbMysqli;

        $sel = "SELECT hospitality_template_background.TemplateName FROM hospitality_guest
					INNER JOIN hospitality_template_background ON hospitality_template_background.Id = hospitality_guest.id_template
					WHERE hospitality_guest.idsito = " . $idsito . " ";
        if ($idrichiesta != '') {
            $sel .= " AND hospitality_guest.Id = " . $idrichiesta;
        } else {
            $sel .= " AND hospitality_guest.TipoRichiesta = 'Preventivo' AND hospitality_guest.Accettato = 0";
        }
        $sel .= " ORDER BY hospitality_guest.DataRichiesta DESC,hospitality_guest.NumeroPrenotazione DESC";

        $res = $dbMysqli->query($sel);
        $record = $res[0];
        $TemplateName = $record['TemplateName'];

        return $TemplateName;
    }

    /**
     * check_landing_type_template
     *
     * @param  mixed $idsito
     * @param  mixed $idrichiesta
     * @return void
     */
    public function check_landing_type_template($idsito, $idrichiesta = null)
    {
        global $dbMysqli;

        $sel = "SELECT hospitality_template_background.TemplateType FROM hospitality_guest
					INNER JOIN hospitality_template_background ON hospitality_template_background.Id = hospitality_guest.id_template
					WHERE hospitality_guest.idsito = " . $idsito . " ";
        if ($idrichiesta != '') {
            $sel .= " AND hospitality_guest.Id = " . $idrichiesta;
        } else {
            $sel .= " AND hospitality_guest.TipoRichiesta = 'Preventivo' AND hospitality_guest.Accettato = 0";
        }
        $sel .= " ORDER BY hospitality_guest.DataRichiesta DESC,hospitality_guest.NumeroPrenotazione DESC";

        $res = $dbMysqli->query($sel);
        $record = $res[0];
        $TemplateType = $record['TemplateType'];

        return $TemplateType;
    }

    /**
     * check_permessi
     *
     * @return void
     */
    public function check_permessi()
    {
        global $dbMysqli;

        $select = "SELECT * FROM utenti WHERE username = '" . $_SESSION['user_accesso'] . "' AND password = '" . ($_SESSION['pass_accesso']) . "'";
        $esec = $dbMysqli->query($select);
        $record = sizeof($esec);

        $select2 = "SELECT * FROM utenti_quoto WHERE idsito = " . IDSITO . " AND username = '" . $_SESSION['user_accesso'] . "' AND password = '" . ($_SESSION['pass_accesso']) . "'";
        $esec2 = $dbMysqli->query($select2);
        $record2 = sizeof($esec2);

        if ($record2 > 0 && $record == 0) {
            $config1 = $_SESSION['utente']['config1'];
            $config2 = $_SESSION['utente']['config2'];
            $config3 = $_SESSION['utente']['config3'];
            $config4 = $_SESSION['utente']['config4'];
            $config5 = $_SESSION['utente']['config5'];
            $config6 = $_SESSION['utente']['config6'];
            $dashborad_box = $_SESSION['utente']['dashboard_box'];
            $statistiche = $_SESSION['utente']['statistiche'];
            $crea_proposta = $_SESSION['utente']['crea_proposta'];
            $preventivi = $_SESSION['utente']['preventivi'];
            $conferme = $_SESSION['utente']['conferme'];
            $prenotazioni = $_SESSION['utente']['prenotazioni'];
            $profila = $_SESSION['utente']['profila'];
            $giudizi = $_SESSION['utente']['giudizi'];
            $archivio = $_SESSION['utente']['archivio'];
            $schedine = $_SESSION['utente']['schedine'];
            $content_email = $_SESSION['utente']['content_email'];
            $content_landing = $_SESSION['utente']['content_landing'];
            $anteprima_email = $_SESSION['utente']['anteprima_email'];
            $anteprima_landing = $_SESSION['utente']['anteprima_landing'];
            $screenshots = $_SESSION['utente']['screenshots'];
            $comunicazioni = $_SESSION['utente']['comunicazioni'];
            $utenti = $_SESSION['utente']['utenti'];
            $unique_display = $_SESSION['utente']['unique_display'];
        }
        if ($record > 0 && $record2 == 0) {
            $config1 = 1;
            $config2 = 1;
            $config3 = 1;
            $config4 = 1;
            $config5 = 1;
            $config6 = 1;
            $dashborad_box = 1;
            $statistiche = 1;
            $crea_proposta = 1;
            $preventivi = 1;
            $conferme = 1;
            $prenotazioni = 1;
            $profila = 1;
            $giudizi = 1;
            $archivio = 1;
            $schedine = 1;
            $content_email = 1;
            $content_landing = 1;
            $anteprima_email = 1;
            $anteprima_landing = 1;
            $screenshots = 1;
            $comunicazioni = 1;
            $utenti = 1;
            $unique_display = 0;
        }
        $array_permessi = array('CONFIG1' => $config1,
            'CONFIG2' => $config2,
            'CONFIG3' => $config3,
            'CONFIG4' => $config4,
            'CONFIG5' => $config5,
            'CONFIG6' => $config6,
            'DASH' => $dashborad_box,
            'STAT' => $statistiche,
            'PROP' => $crea_proposta,
            'PREV' => $preventivi,
            'CONF' => $conferme,
            'PRENO' => $prenotazioni,
            'PROF' => $profila,
            'GIUD' => $giudizi,
            'ARCH' => $archivio,
            'SCHED' => $schedine,
            'CONT_MAIL' => $content_email,
            'CONT_LAND' => $content_landing,
            'ANT_MAIL' => $anteprima_email,
            'ANT_LAND' => $anteprima_landing,
            'SCREEN' => $screenshots,
            'COMUNIC' => $comunicazioni,
            'UTENTI' => $utenti,
            'UNIQUE' => $unique_display,
        );
        return $array_permessi;
    }

    /**
     * conta_click
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @param  mixed $data_invio
     * @param  mixed $data_scadenza
     * @return void
     */
    public function conta_click($id, $idsito, $data_invio, $data_scadenza)
    {
        global $dbMysqli;
        $aperture = '';
        $GiornoPassato = '';

        $query = "SELECT COUNT(Id) as Click FROM hospitality_traccia_email WHERE IdRichiesta = " . $id . " AND idsito = " . $idsito;
        $res = $dbMysqli->query($query);
        $rw = $res[0];

        $aperture = $rw['Click'];

        if ($aperture == 0 && $data_invio != '' && $data_invio < date('Y-m-d') && $data_scadenza > date('Y-m-d')) {
            $GiornoPassato = '<div style="clear:both!important;text-align:right!important" id="notify' . $id . '">
									<i class="fa fa-question-circle  text-info" data-toogle="tooltip" title="Sono passate più di 24 ore dall\'invio dell\'email!!"></i>
								</div>';
        } else {
            $GiornoPassato = '';
        }
        return $aperture . $GiornoPassato;
    }

    /**
     * contoallarovescia
     *
     * @param  mixed $min
     * @param  mixed $page
     * @return void
     */
    public function contoallarovescia($min, $page)
    {

        $calcoloMilliSec = 60 * $min;

        $contatore = '  <script>
                            function countdown() {
                                $("#' . $page . '").DataTable().ajax.reload();
                                $("#infobox").hide();
                                $("#closeButtonBoxInfo").hide();
                                $("#closeButtonInfoBox").hide();
                                $("html, body").animate({
                                    scrollTop: 0
                                }, 200);
                            }
                            function contorovescia() {
                                var timeleft = ' . $calcoloMilliSec . ';
                                var downloadTimer = setInterval(function(){
                                timeleft--;
                                document.getElementById("countdowntimer").textContent = timeleft;
                                if(timeleft <= 0)
                                    clearInterval(downloadTimer);
                                },1000);
                            }
							$(document).one("ready",function() {
								contorovescia()
							});
							$(document).ready(function() {
								contorovescia()
								setInterval(countdown, ' . $calcoloMilliSec . '000);
								setInterval(contorovescia, ' . $calcoloMilliSec . '000);
							});
						</script>
						<div class="f-right f-11">Prossimo refresh del contenuto tra <b clas="f-11" id="countdowntimer"></b> secondi (pari a ' . $min . ' min.)</div>
						<div class="clearfix"></div>' . "\r\n";

        return $contatore;
    }

    /**
     * check_proposta
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function check_proposta($id, $idsito)
    {

        global $dbMysqli;

        $select = "SELECT hospitality_proposte.Id as IdProposta,hospitality_proposte.NomeProposta, hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,hospitality_guest.TipoRichiesta,hospitality_guest.idsito,
							hospitality_guest.AccontoRichiesta,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.AccontoLibero,
							hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,hospitality_proposte.AccontoTesto,
							hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza,hospitality_guest.Chiuso
					FROM hospitality_proposte
					INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
					WHERE hospitality_guest.NumeroPrenotazione = " . $id . " AND hospitality_guest.idsito = " . $idsito . " ORDER BY hospitality_proposte.Id ASC";
        $res = $dbMysqli->query($select);
        $tot = sizeof($res);
        if ($tot > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * check_recall_preventivi
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_recall_preventivi($idsito)
    {

        global $dbMysqli;

        $sel = "SELECT * FROM hospitality_giorni_recall_preventivi WHERE idsito = " . $idsito . " AND abilita = 1";
        $res = $dbMysqli->query($sel);
        $row = $res[0];
        if (sizeof($res) > 0) {
            $giorni = $row['numero_giorni'];
        } else {
            $giorni = '';
        }
        return $giorni;
    }

    /**
     * check_recall_conferme
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_recall_conferme($idsito)
    {

        global $dbMysqli;

        $sel = "SELECT * FROM hospitality_giorni_recall_conferme WHERE idsito = " . $idsito . " AND abilita = 1";
        $res = $dbMysqli->query($sel);
        $row = $res[0];
        if (sizeof($res) > 0) {
            $giorni = $row['numero_giorni'];
        } else {
            $giorni = '';
        }
        return $giorni;
    }

    /**
     * check_recall_reselling
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_recall_reselling($idsito)
    {

        global $dbMysqli;
        $sel = "SELECT * FROM hospitality_giorni_reselling WHERE idsito = " . $idsito . " AND abilita = 1";
        $res = $dbMysqli->query($sel);
        $row = $res[0];
        if (sizeof($res) > 0) {
            $giorni = $row['numero_giorni'];
        } else {
            $giorni = '';
        }
        return $giorni;
    }

    /**
     * check_recall_precheckin
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_recall_precheckin($idsito)
    {

        global $dbMysqli;
        $q = "SELECT * FROM hospitality_giorni_precheckin WHERE idsito = " . $idsito . " AND abilita = 1";
        $res = $dbMysqli->query($q);
        $row = $res[0];
        if (sizeof($res) > 0) {
            $giorni = $row['numero_giorni'];
        } else {
            $giorni = '';
        }
        return $giorni;
    }

    /**
     * check_recall_checkinonline
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_recall_checkinonline($idsito)
    {

        global $dbMysqli;
        $qy = "SELECT * FROM hospitality_giorni_checkinonline WHERE idsito = " . $idsito . " AND abilita = 1";
        $res = $dbMysqli->query($qy);
        $row = $res[0];
        if (sizeof($res) > 0) {
            $giorni = $row['numero_giorni'];
        } else {
            $giorni = '';
        }
        return $giorni;
    }

    /**
     * check_recall_recensioni
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_recall_recensioni($idsito)
    {

        global $dbMysqli;
        $sel = "SELECT * FROM hospitality_giorni_recensioni WHERE idsito = " . $idsito . " AND abilita = 1";
        $res = $dbMysqli->query($sel);
        $row = $res[0];
        if (sizeof($res) > 0) {
            $giorni = $row['numero_giorni'];
        } else {
            $giorni = '';
        }
        return $giorni;
    }

    /**
     * check_recall_cs
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_recall_cs($idsito)
    {

        global $dbMysqli;
        $qry = "SELECT * FROM hospitality_giorni_cs WHERE idsito = " . $idsito . " AND abilita = 1";
        $res = $dbMysqli->query($qry);
        $row = $res[0];
        if (sizeof($res) > 0) {
            $giorni = $row['numero_giorni'];
        } else {
            $giorni = '';
        }
        return $giorni;
    }

    /**
     * syncro_info_alberghi
     *
     * @param  mixed $idsito
     * @return void
     */
    public function syncro_info_alberghi($idsito)
    {
        global $dbMysqli;
        // inclusione per import email di info algberghi
        $qry = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'info-alberghi.com' AND idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Id DESC";
        $sq = $dbMysqli->query($qry);

        if (sizeof($sq) > 0) {

            $imap = $sq[0];

            $InfoAlberghiButton = '<a href="#" class="btn btn-primary btn-mini" id="CheckBtn">Syncro Info Alberghi</a>
										<div id="pul_hide"></div>
										<script>
										$(document).ready(function() {
											if(leggiCookie(\'syncro_imap' . IDSITO . '\')) {
											$("#CheckBtn").css(\'display\',\'none\');
											$("#pul_hide").html(\'<span class="f-12"><b>Una volta cliccato il pulsante, scompare e torna visibile dopo un ora!</b></span>\');
											}else{
												$("#pul_hide").hide();
											}
											$(\'#CheckBtn\').click(function(){
													scriviCookie(\'syncro_imap' . IDSITO . '\',\'infoalberghi\',\'60\');
													$("#CheckBtn").css(\'display\',\'none\');
													$("#ctrl").html(\'<img src="' . BASE_URL_SITO . 'img/loader.gif" style="max-width:100%;"/>\');
													var idsito   = ' . IDSITO . ';
													$.ajax({
														type: "POST",
														url: "' . BASE_URL_SITO . 'ajax/imap/import_imap.php",
														data: "idsito=" + idsito,
														dataType: "html",
														success: function(data){
															$("#ctrl").html(\'<span class="f-12"><b>Sincronizzazione effettuata!!</b></span>\');
																setTimeout(function(){
																		location.reload();
																},2000);
														},
														// error: function(){
														//     alert("Chiamata fallita, si prega di riprovare...");
														// }
													});
											});
										});
										</script>
										<div id="ctrl"></div>
										<div class="clearfix p-b-20"></div>';
        }
        return $InfoAlberghiButton;
    }
    /**
     * check_syncro_info_alberghi
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_syncro_info_alberghi($idsito)
    {
        global $dbMysqli;
        $se = "SELECT data FROM hospitality_data_import WHERE idsito = " . $idsito . " ORDER BY id DESC";
        $ri = $dbMysqli->query($se);
        $rr = $ri[0];
        if ($rr > 0) {

            $datS = explode(" ", $rr['data']);
            $dataS = explode("-", $datS[0]);
            $dataH = explode(":", $datS[1]);
            $data_import = 'Ultima sincronizzazione con nuove richieste da <b>Info Alberghi</b>: ' . $dataS[2] . '-' . $dataS[1] . '-' . $dataS[0] . ' alle ' . $dataH[0] . ':' . $dataH[1] . ':' . $dataH[2] . '';

        }
        return $data_import;
    }
    /**
     * syncro_gabiccemare
     *
     * @param  mixed $idsito
     * @return void
     */
    public function syncro_gabiccemare($idsito)
    {
        global $dbMysqli;
        // inclusione per import email di gabiccemare.com
        $qry2 = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'gabiccemare.com' AND idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Id DESC";
        $sq2 = $dbMysqli->query($qry2);
        $imap2 = $sq2[0];
        if ($imap2['ServerEmail'] != '' && $imap2['UserEmail'] != '' && $imap2['PasswordEmail'] != '') {
            $GabicceMareButton = '<a href="#" class="btn btn-primary btn-mini" id="CheckBtn2">Syncro GabicceMare.com</a>
											<div id="pul_hide2"></div>
											<script>
											$(document).ready(function() {
												if(leggiCookie(\'syncro_imap_gabiccemare\')) {
												$("#CheckBtn2").css(\'display\',\'none\');
												$("#pul_hide2").html(\'<span class="f-12"><b>Una volta cliccato il pulsante, scompare e torna visibile dopo un ora!</b></span>\');
												}else{
													$("#pul_hide2").hide();
												}
												$(\'#CheckBtn2\').click(function(){
														scriviCookie(\'syncro_imap_gabiccemare\',\'gabiccemare\',\'60\');
														$("#CheckBtn2").css(\'display\',\'none\');
														$("#ctrl2").html(\'<img src="' . BASE_URL_SITO . 'img/loader.gif" style="max-width:100%;"/>\');
														var idsito   = ' . IDSITO . ';
														$.ajax({
															type: "POST",
															url: "' . BASE_URL_SITO . 'ajax/imap/import_imap_gabiccemare.php",
															data: "idsito=" + idsito,
															dataType: "html",
															success: function(data){
																$("#ctrl2").html(\'<span class="f-12"><b>Sincronizzazione effettuata!!</b></span>\');
																	setTimeout(function(){
																			location.reload();
																	},2000);
															},
															// error: function(){
															//     alert("Chiamata fallita, si prega di riprovare...");
															// }
														});
												});
											});
											</script>
											<div id="ctrl2"></div>
											<div class="clearfix p-b-20"></div>';
        }
        return $GabicceMareButton;
    }

    /**
     * check_syncro_gabiccemare
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_syncro_gabiccemare($idsito)
    {
        global $dbMysqli;
        $se2 = "SELECT data FROM hospitality_data_import_secondo_portale WHERE idsito = " . $idsito . " ORDER BY id DESC";
        $ri2 = $dbMysqli->query($se2);
        $rr2 = $ri2[0];
        if (sizeof($ri2) > 0) {

            $datS = explode(" ", $rr2['data']);
            $dataS = explode("-", $datS[0]);
            $dataH = explode(":", $datS[1]);
            $data_import_gabicce = 'Ultima sincronizzazione con nuove richieste da <b>GabicceMare.com</b>: ' . $dataS[2] . '-' . $dataS[1] . '-' . $dataS[0] . ' alle ' . $dataH[0] . ':' . $dataH[1] . ':' . $dataH[2] . '';
        }
        return $data_import_gabicce;
    }
    /**
     * syncro_italyfamilyhotels
     *
     * @param  mixed $idsito
     * @return void
     */
    public function syncro_italyfamilyhotels($idsito)
    {
        global $dbMysqli;
        // inclusione per import email di gabiccemare.com
        $qry2 = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'italyfamilyhotels.it' AND idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Id DESC";
        $sq2 = $dbMysqli->query($qry2);
        $imap2 = $sq2[0];
        if ($imap2['ServerEmail'] != '' && $imap2['UserEmail'] != '' && $imap2['PasswordEmail'] != '') {
            $GabicceMareButton = '<a href="#" class="btn btn-primary btn-mini" id="CheckBtn3">Syncro ItalyFamilyHotels.it</a>
											<div id="pul_hide3"></div>
											<script>
											$(document).ready(function() {
												if(leggiCookie(\'syncro_imap_italyfamilyhotels\')) {
												$("#CheckBtn3").css(\'display\',\'none\');
												$("#pul_hide3").html(\'<span class="f-12"><b>Una volta cliccato il pulsante, scompare e torna visibile dopo un ora!</b></span>\');
												}else{
													$("#pul_hide3").hide();
												}
												$(\'#CheckBtn3\').click(function(){
														scriviCookie(\'syncro_imap_italyfamilyhotels\',\'italyfamilyhotels\',\'60\');
														$("#CheckBtn3").css(\'display\',\'none\');
														$("#ctrl3").html(\'<img src="' . BASE_URL_SITO . 'img/loader.gif" style="max-width:100%;"/>\');
														var idsito   = ' . IDSITO . ';
														$.ajax({
															type: "POST",
															url: "' . BASE_URL_SITO . 'ajax/imap/import_imap_italyfamilyhotels.php",
															data: "idsito=" + idsito,
															dataType: "html",
															success: function(data){
																$("#ctrl3").html(\'<span class="f-12"><b>Sincronizzazione effettuata!!</b></span>\');
																	setTimeout(function(){
																			location.reload();
																	},2000);
															},
															// error: function(){
															//     alert("Chiamata fallita, si prega di riprovare...");
															// }
														});
												});
											});
											</script>
											<div id="ctrl3"></div>
											<div class="clearfix p-b-20"></div>';
        }
        return $GabicceMareButton;
    }

    /**
     * check_syncro_italyfamilyhotels
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_syncro_italyfamilyhotels($idsito)
    {
        global $dbMysqli;
        $se2 = "SELECT data FROM hospitality_data_import_terzo_portale WHERE idsito = " . $idsito . " ORDER BY id DESC";
        $ri2 = $dbMysqli->query($se2);
        $rr2 = $ri2[0];
        if (sizeof($ri2) > 0) {

            $datS = explode(" ", $rr2['data']);
            $dataS = explode("-", $datS[0]);
            $dataH = explode(":", $datS[1]);
            $data_import_italyfamilyhotels = 'Ultima sincronizzazione con nuove richieste da <b>ItalyFamilyHotels.it</b>: ' . $dataS[2] . '-' . $dataS[1] . '-' . $dataS[0] . ' alle ' . $dataH[0] . ':' . $dataH[1] . ':' . $dataH[2] . '';
        }
        return $data_import_italyfamilyhotels;
    }
    /**
     * syncro_riccioneinhotel
     *
     * @param  mixed $idsito
     * @return void
     */
    public function syncro_riccioneinhotel($idsito)
    {
        global $dbMysqli;
        // inclusione per import email di gabiccemare.com
        $qry2 = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'riccioneinhotel.com' AND idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Id DESC";
        $sq2 = $dbMysqli->query($qry2);
        $imap2 = $sq2[0];
        if ($imap2['ServerEmail'] != '' && $imap2['UserEmail'] != '' && $imap2['PasswordEmail'] != '') {
            $RiccioneinHotelButton = '<a href="#" class="btn btn-primary btn-mini" id="CheckBtn4">Syncro RiccioneInHotel.com</a>
											<div id="pul_hide4"></div>
											<script>
											$(document).ready(function() {
												if(leggiCookie(\'syncro_imap_riccioneinhotel\')) {
												$("#CheckBtn4").css(\'display\',\'none\');
												$("#pul_hide4").html(\'<span class="f-12"><b>Una volta cliccato il pulsante, scompare e torna visibile dopo un ora!</b></span>\');
												}else{
													$("#pul_hide4").hide();
												}
												$(\'#CheckBtn4\').click(function(){
														scriviCookie(\'syncro_imap_riccioneinhotel\',\'riccioneinhotel\',\'60\');
														$("#CheckBtn4").css(\'display\',\'none\');
														$("#ctrl4").html(\'<img src="' . BASE_URL_SITO . 'img/loader.gif" style="max-width:100%;"/>\');
														var idsito   = ' . IDSITO . ';
														$.ajax({
															type: "POST",
															url: "' . BASE_URL_SITO . 'ajax/imap/import_imap_riccioneinhotel.php",
															data: "idsito=" + idsito,
															dataType: "html",
															success: function(data){
																$("#ctrl4").html(\'<span class="f-12"><b>Sincronizzazione effettuata!!</b></span>\');
																	setTimeout(function(){
																			location.reload();
																	},2000);
															},
															// error: function(){
															//     alert("Chiamata fallita, si prega di riprovare...");
															// }
														});
												});
											});
											</script>
											<div id="ctrl4"></div>
											<div class="clearfix p-b-20"></div>';
        }
        return $RiccioneinHotelButton;
    }

    /**
     * check_syncro_riccioneinhotel
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_syncro_riccioneinhotel($idsito)
    {
        global $dbMysqli;
        $se2 = "SELECT data FROM hospitality_data_import_quarto_portale WHERE idsito = " . $idsito . " ORDER BY id DESC";
        $ri2 = $dbMysqli->query($se2);
        $rr2 = $ri2[0];
        if (sizeof($ri2) > 0) {

            $datS = explode(" ", $rr2['data']);
            $dataS = explode("-", $datS[0]);
            $dataH = explode(":", $datS[1]);
            $data_import_riccioneinhotel = 'Ultima sincronizzazione con nuove richieste da <b>RiccioneInHotel.com</b>: ' . $dataS[2] . '-' . $dataS[1] . '-' . $dataS[0] . ' alle ' . $dataH[0] . ':' . $dataH[1] . ':' . $dataH[2] . '';
        }
        return $data_import_riccioneinhotel;
    }
    /**
     * syncro_cesenaticobellavita
     *
     * @param  mixed $idsito
     * @return void
     */
    public function syncro_cesenaticobellavita($idsito)
    {
        global $dbMysqli;
        // inclusione per import email di gabiccemare.com
        $qry2 = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'cesenaticobellavita.it' AND idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Id DESC";
        $sq2 = $dbMysqli->query($qry2);
        $imap2 = $sq2[0];
        if ($imap2['ServerEmail'] != '' && $imap2['UserEmail'] != '' && $imap2['PasswordEmail'] != '') {
            $CesenaticoBellaVitaButton = '<a href="#" class="btn btn-primary btn-mini" id="CheckBtn5">Syncro cesenaticobellavita.it</a>
												<div id="pul_hide5"></div>
												<script>
												$(document).ready(function() {
													if(leggiCookie(\'syncro_imap_cesenaticobellavita\')) {
													$("#CheckBtn5").css(\'display\',\'none\');
													$("#pul_hide5").html(\'<span class="f-12"><b>Una volta cliccato il pulsante, scompare e torna visibile dopo un ora!</b></span>\');
													}else{
														$("#pul_hide5").hide();
													}
													$(\'#CheckBtn5\').click(function(){
															scriviCookie(\'syncro_imap_cesenaticobellavita\',\'cesenaticobellavita\',\'60\');
															$("#CheckBtn5").css(\'display\',\'none\');
															$("#ctrl5").html(\'<img src="' . BASE_URL_SITO . 'img/loader.gif" style="max-width:100%;"/>\');
															var idsito   = ' . IDSITO . ';
															$.ajax({
																type: "POST",
																url: "' . BASE_URL_SITO . 'ajax/imap/import_imap_cesenaticobellavita.php",
																data: "idsito=" + idsito,
																dataType: "html",
																success: function(data){
																	$("#ctrl5").html(\'<span class="f-12"><b>Sincronizzazione effettuata!!</b></span>\');
																		setTimeout(function(){
																				location.reload();
																		},2000);
																},
																// error: function(){
																//     alert("Chiamata fallita, si prega di riprovare...");
																// }
															});
													});
												});
												</script>
												<div id="ctrl5"></div>
												<div class="clearfix p-b-20"></div>';
        }
        return $CesenaticoBellaVitaButton;
    }

    /**
     * check_syncro_cesenaticobellavita
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_syncro_cesenaticobellavita($idsito)
    {
        global $dbMysqli;
        $se2 = "SELECT data FROM hospitality_data_import_quinto_portale WHERE idsito = " . $idsito . " ORDER BY id DESC";
        $ri2 = $dbMysqli->query($se2);
        $rr2 = $ri2[0];
        if ($ri2 > 0) {

            $datS = explode(" ", $rr2['data']);
            $dataS = explode("-", $datS[0]);
            $dataH = explode(":", $datS[1]);
            $data_import_cesenaticobellavita = 'Ultima sincronizzazione con nuove richieste da <b>cesenaticobellavita.it</b>: ' . $dataS[2] . '-' . $dataS[1] . '-' . $dataS[0] . ' alle ' . $dataH[0] . ':' . $dataH[1] . ':' . $dataH[2] . '';
        }
        return $data_import_cesenaticobellavita;
    }
    /**
     * syncro_italybikehotels
     *
     * @param  mixed $idsito
     * @return void
     */
    public function syncro_italybikehotels($idsito)
    {
        global $dbMysqli;
        // inclusione per import email di familygo.eu
        $qry2 = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'italybikehotels.it' AND idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Id DESC";
        $sq2 = $dbMysqli->query($qry2);
        $imap2 = $sq2[0];
        if ($imap2['ServerEmail'] != '' && $imap2['UserEmail'] != '' && $imap2['PasswordEmail'] != '') {
            $Button = '<a href="#" class="btn btn-primary btn-mini" id="CheckBtn7">Syncro italybikehotels.it</a>
												<div id="pul_hide7"></div>
												<script>
												$(document).ready(function() {
													if(leggiCookie(\'syncro_imap_italybikehotels\')) {
													$("#CheckBtn7").css(\'display\',\'none\');
													$("#pul_hide7").html(\'<span class="f-12"><b>Una volta cliccato il pulsante, scompare e torna visibile dopo un ora!</b></span>\');
													}else{
														$("#pul_hide7").hide();
													}
													$(\'#CheckBtn7\').click(function(){
															scriviCookie(\'syncro_imap_italybikehotels\',\'italybikehotels\',\'60\');
															$("#CheckBtn7").css(\'display\',\'none\');
															$("#ctrl7").html(\'<img src="' . BASE_URL_SITO . 'img/loader.gif" style="max-width:100%;"/>\');
															var idsito   = ' . IDSITO . ';
															$.ajax({
																type: "POST",
																url: "' . BASE_URL_SITO . 'ajax/imap/import_imap_italybikehotels.php",
																data: "idsito=" + idsito,
																dataType: "html",
																success: function(data){
																	$("#ctrl7").html(\'<span class="f-12"><b>Sincronizzazione effettuata!!</b></span>\');
																		setTimeout(function(){
																				location.reload();
																		},2000);
																},
																// error: function(){
																//     alert("Chiamata fallita, si prega di riprovare...");
																// }
															});
													});
												});
												</script>
												<div id="ctrl7"></div>
												<div class="clearfix p-b-20"></div>';
        }
        return $Button;
    }

    /**
     * check_syncro_italybikehotels
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_syncro_italybikehotels($idsito)
    {
        global $dbMysqli;
        $se2 = "SELECT data FROM hospitality_data_import_settimo_portale WHERE idsito = " . $idsito . " ORDER BY id DESC";
        $ri2 = $dbMysqli->query($se2);
        $rr2 = $ri2[0];
        if (sizeof($ri2) > 0) {

            $datS = explode(" ", $rr2['data']);
            $dataS = explode("-", $datS[0]);
            $dataH = explode(":", $datS[1]);
            $data_import_ = 'Ultima sincronizzazione con nuove richieste da <b>italybikehotels.it</b>: ' . $dataS[2] . '-' . $dataS[1] . '-' . $dataS[0] . ' alle ' . $dataH[0] . ':' . $dataH[1] . ':' . $dataH[2] . '';
        }
        return $data_import_;
    }
    /**
     * syncro_familygo
     *
     * @param  mixed $idsito
     * @return void
     */
    public function syncro_familygo($idsito)
    {
        global $dbMysqli;
        // inclusione per import email di familygo.eu
        $qry2 = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'familygo.eu' AND idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Id DESC";
        $sq2 = $dbMysqli->query($qry2);
        $imap2 = $sq2[0];
        if ($imap2['ServerEmail'] != '' && $imap2['UserEmail'] != '' && $imap2['PasswordEmail'] != '') {
            $CesenaticoBellaVitaButton = '<a href="#" class="btn btn-primary btn-mini" id="CheckBtn6">Syncro familygo.eu</a>
												<div id="pul_hide6"></div>
												<script>
												$(document).ready(function() {
													if(leggiCookie(\'syncro_imap_familygo\')) {
													$("#CheckBtn6").css(\'display\',\'none\');
													$("#pul_hide6").html(\'<span class="f-12"><b>Una volta cliccato il pulsante, scompare e torna visibile dopo un ora!</b></span>\');
													}else{
														$("#pul_hide6").hide();
													}
													$(\'#CheckBtn6\').click(function(){
															scriviCookie(\'syncro_imap_familygo\',\'familygo\',\'60\');
															$("#CheckBtn6").css(\'display\',\'none\');
															$("#ctrl6").html(\'<img src="' . BASE_URL_SITO . 'img/loader.gif" style="max-width:100%;"/>\');
															var idsito   = ' . IDSITO . ';
															$.ajax({
																type: "POST",
																url: "' . BASE_URL_SITO . 'ajax/imap/import_imap_familygo.php",
																data: "idsito=" + idsito,
																dataType: "html",
																success: function(data){
																	$("#ctrl6").html(\'<span class="f-12"><b>Sincronizzazione effettuata!!</b></span>\');
																		setTimeout(function(){
																				location.reload();
																		},2000);
																},
																// error: function(){
																//     alert("Chiamata fallita, si prega di riprovare...");
																// }
															});
													});
												});
												</script>
												<div id="ctrl6"></div>
												<div class="clearfix p-b-20"></div>';
        }
        return $CesenaticoBellaVitaButton;
    }

    /**
     * check_syncro_familygo
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_syncro_familygo($idsito)
    {
        global $dbMysqli;
        $se2 = "SELECT data FROM hospitality_data_import_sesto_portale WHERE idsito = " . $idsito . " ORDER BY id DESC";
        $ri2 = $dbMysqli->query($se2);
        $rr2 = $ri2[0];
        if ($ri2 > 0) {

            $datS = explode(" ", $rr2['data']);
            $dataS = explode("-", $datS[0]);
            $dataH = explode(":", $datS[1]);
            $data_import_familygo = 'Ultima sincronizzazione con nuove richieste da <b>familygo.eu</b>: ' . $dataS[2] . '-' . $dataS[1] . '-' . $dataS[0] . ' alle ' . $dataH[0] . ':' . $dataH[1] . ':' . $dataH[2] . '';
        }
        return $data_import_familygo;
    }
    /**
     * syncro_spahotel
     *
     * @param  mixed $idsito
     * @return void
     */
    public function syncro_spahotel($idsito)
    {
        global $dbMysqli;
        $qry2 = "SELECT * FROM hospitality_imap_email  WHERE Portale = 'spahotelscollection.it' AND idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Id DESC";
        $sq2 = $dbMysqli->query($qry2);
        $imap2 = $sq2[0];
        if ($imap2['ServerEmail'] != '' && $imap2['UserEmail'] != '' && $imap2['PasswordEmail'] != '') {
            $SpaHotelButton = '<a href="#" class="btn btn-primary btn-mini" id="CheckBtn8">Syncro spahotelscollection.it</a>
												<div id="pul_hide8"></div>
												<script>
												$(document).ready(function() {
													if(leggiCookie(\'syncro_imap_spahotelscollection\')) {
													$("#CheckBtn8").css(\'display\',\'none\');
													$("#pul_hide8").html(\'<span class="f-12"><b>Una volta cliccato il pulsante, scompare e torna visibile dopo un ora!</b></span>\');
													}else{
														$("#pul_hide8").hide();
													}
													$(\'#CheckBtn8\').click(function(){
															scriviCookie(\'syncro_imap_spahotelscollection\',\'spahotelscollection\',\'60\');
															$("#CheckBtn8").css(\'display\',\'none\');
															$("#ctrl8").html(\'<img src="' . BASE_URL_SITO . 'img/loader.gif" style="max-width:100%;"/>\');
															var idsito   = ' . IDSITO . ';
															$.ajax({
																type: "POST",
																url: "' . BASE_URL_SITO . 'ajax/imap/import_imap_spahotelscollection.php",
																data: "idsito=" + idsito,
																dataType: "html",
																success: function(data){
																	$("#ctrl8").html(\'<span class="f-12"><b>Sincronizzazione effettuata!!</b></span>\');
																		setTimeout(function(){
																				location.reload();
																		},2000);
																},
																// error: function(){
																//     alert("Chiamata fallita, si prega di riprovare...");
																// }
															});
													});
												});
												</script>
												<div id="ctrl8"></div>
												<div class="clearfix p-b-20"></div>';
        }
        return $SpaHotelButton;
    }

    /**
     * check_syncro_spahotel
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_syncro_spahotel($idsito)
    {
        global $dbMysqli;
        $se2 = "SELECT data FROM hospitality_data_import_ottavo_portale WHERE idsito = " . $idsito . " ORDER BY id DESC";
        $ri2 = $dbMysqli->query($se2);
        $rr2 = $ri2[0];
        if ($ri2 > 0) {

            $datS = explode(" ", $rr2['data']);
            $dataS = explode("-", $datS[0]);
            $dataH = explode(":", $datS[1]);
            $data_import_spahotel = 'Ultima sincronizzazione con nuove richieste da <b>spahotelscollection.it</b>: ' . $dataS[2] . '-' . $dataS[1] . '-' . $dataS[0] . ' alle ' . $dataH[0] . ':' . $dataH[1] . ':' . $dataH[2] . '';
        }
        return $data_import_spahotel;
    }
    /**
     * si_no
     *
     * @param  mixed $value
     * @return void
     */
    public function si_no($value)
    {
        if ($value == 0) {
            $valore = '<label class="badge badge-inverse-danger f-11">No</label>';
        } else {
            $valore = '<label class="badge badge-inverse-success f-11">Si</label>';
        }
        return $valore;
    }

    /**
     * inviato_non_inviato
     *
     * @param  mixed $value
     * @return void
     */
    public function inviato_non_inviato($value)
    {
        if ($value == 0) {
            $valore = '<label class="badge badge-inverse-danger f-11">Non Inviato</label>';
        } else {
            $valore = '<label class="badge badge-inverse-success f-11">Inviato</label>';
        }
        return $valore;
    }

    /**
     * dett_consenso_dgpr
     *
     * @param  mixed $Id
     * @param  mixed $Email
     * @param  mixed $Ip
     * @param  mixed $Agent
     * @param  mixed $CheckConsensoPrivacy
     * @param  mixed $CheckConsensoMarketing
     * @param  mixed $CheckConsensoProfilazione
     * @return void
     */
    public function dett_consenso_dgpr($Id, $Email, $Ip, $Agent, $CheckConsensoPrivacy, $CheckConsensoMarketing, $CheckConsensoProfilazione)
    {
        global $dbMysqli;

        $flg_marketing = 0;
        $stringa_consensi = '';
        if ($Agent != '') {
            $find = ')';
            $replace = ')<br>';
            $Agent = str_replace($find, $replace, $Agent);
        }
        $query2 = 'SELECT * FROM log_consenso_notifiche WHERE id_richiesta = "' . $Id . '"';
        $res2 = $dbMysqli->query($query2);
        $r2 = $res2[0];
        if (is_array($r2['log'])) {
            if ($r2['log'] > count($r2['log'])) {
                $tot = count($r2['log']);
            }

        } else {
            $tot = 0;
        }
        if ($tot > 0) {
            $testo_log = $r2['log'];
            $flg_marketing = 1;
        } else {
            $flg_marketing = 0;
        }
        $Data_t = explode('-', $rec['DataRichiesta']);
        $Data = $Data_t[2] . '-' . $Data_t[1] . '-' . $Data_t[0];

        $stringa_consensi .= '<div id="view_consensi_gdpr' . $Id . '" class="pointer">Consensi GDPR <i class="fa fa-chevron-down" style="float:right;padding-top:5px"></i></div>';
        $stringa_consensi .= '<div id="consensi_gdpr' . $Id . '" style="display:none">';
        $stringa_consensi .= '<b>Identificativo</b>: ' . $Id . '';
        $stringa_consensi .= '<br><b>Data</b>: ' . $Data . '';
        $stringa_consensi .= ($Ip != '' ? '<br><b>Fonte IP</b>: ' . $Ip : '');
        $stringa_consensi .= ($Agent != '' ? '<br><b>Agent</b>: ' . $Agent : '');
        $stringa_consensi .= ($CheckConsensoPrivacy == 1 ? '<br><b>Consenso trattamento dati</b>: <i class="fa fa-check text-black"></i>' : '<i class="fa fa-times text-black"></i>');
        $stringa_consensi .= '<br><b>Consenso invio materiale marketing</b>: ' . ($CheckConsensoMarketing == 1 ? '<i class="fa fa-check-square-o text-black" id="marketing' . $Id . '" style="cursor:pointer" data-id="0"></i><span id="new_marketing_green' . $Id . '"></span>' : '<i class="fa fa-square-o text-black" id="marketing' . $Id . '" style="cursor:pointer" data-id="1"></i><span id="new_marketing_red' . $Id . '"></span>') . ($flg_marketing == 1 ? '<small class="text-red"  id="log' . $Id . '"><br>' . $testo_log . '</small>' : '');
        $stringa_consensi .= '<br><b>Consenso profilazione</b>: ' . ($CheckConsensoProfilazione == 1 ? '<i class="fa fa-check-square-o text-black" id="profilazione' . $Id . '" style="cursor:pointer" data-id="0"></i><span id="new_profilazione_green' . $Id . '"></span>' : '<i class="fa fa-square-o text-black" id="profilazione' . $Id . '" style="cursor:pointer" data-id="1"></i><span id="new_profilazione_red' . $Id . '"></span>');
        $stringa_consensi .= '<br>Invia email per modifica consensi: <i class="fa fa-send-o text-black" id="sendmailconsensi' . $Id . '" style="cursor:pointer"></i> <span id="sendmail_ok' . $Id . '" style="color:#000!important"></span>';

        $stringa_consensi .= '
										<script type="text/javascript">
											$(document).ready(function(){
												$("#marketing' . $Id . '").click(function(){
												if (window.confirm("ATTENZIONE: Sicuro di modifcare il consenso?")){
													var valore_marketing = $("#marketing' . $Id . '").data("id");
													$.ajax({
														url: "' . BASE_URL_SITO . 'ajax/consensi/change_consenso_marketing_gdpr.php",
														type: "POST",
														data: "id_richiesta=' . $Id . '&valore_marketing="+valore_marketing,
														dataType: "html",
														success: function(data) {
															$("#marketing' . $Id . '").remove();
															$("#log' . $Id . '").remove();
															if(valore_marketing==1){
																$("#new_marketing_red' . $Id . '").html("<i class=\"fa fa-check-square-o text-black\" id=\"marketing' . $Id . '\" style=\"cursor:pointer\" data-id=\"0\"></i>");
															}else{
																$("#new_marketing_green' . $Id . '").html("<i class=\"fa fa-square-o text-black\" id=\"marketing' . $Id . '\" style=\"cursor:pointer\" data-id=\"1\"></i>");
															}
														}
													});
													return false;
												}
												});
												$("#profilazione' . $Id . '").click(function(){
													if (window.confirm("ATTENZIONE: Sicuro di modifcare il consenso?")){
														var valore_profilazione = $("#profilazione' . $Id . '").data("id");
														$.ajax({
															url: "' . BASE_URL_SITO . 'ajax/consensi/change_consenso_profilazione_gdpr.php",
															type: "POST",
															data: "id_richiesta=' . $Id . '&valore_profilazione="+valore_profilazione,
															dataType: "html",
															success: function(data) {
																$("#profilazione' . $Id . '").remove();
																$("#log' . $Id . '").remove();
																if(valore_profilazione==1){
																	$("#new_profilazione_red' . $Id . '").html("<i class=\"fa fa-check-square-o text-black\" id=\"profilazione' . $Id . '\" style=\"cursor:pointer\" data-id=\"0\"></i>");
																}else{
																	$("#new_profilazione_green' . $Id . '").html("<i class=\"fa fa-square-o text-black\" id=\"profilazione' . $Id . '\" style=\"cursor:pointer\" data-id=\"1\"></i>");
																}
															}
														});
														return false;
													}
													});
												$("#sendmailconsensi' . $Id . '").click(function(){
												if (window.confirm("ATTENZIONE: Vuoi procedere con l\'invio della mail all\'utente?")){
													$.ajax({
														url: "' . BASE_URL_SITO . 'ajax/consensi/send_mail_consensi.php",
														type: "POST",
														data: "id_richiesta=' . $Id . '&email_utente=' . $Email . '&action=send",
														dataType: "html",
														success: function(data) {
															$("#sendmail_ok' . $Id . '").html("<i class=\"fa fa-check text-black\"></i> <br><span class=\"text-maroon\">Email inviata!</span>");
														}
													});
													return false;
												}
												});
												$("#view_consensi_gdpr' . $Id . '").on("click",function(){
													$("#consensi_gdpr' . $Id . '").toggle();
												});
											});
										</script>
									</div>';

        return $stringa_consensi;

    }

    /**
     * re_email_call
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function re_email_call($id, $idsito)
    {
        global $dbMysqli;

        $q = $dbMysqli->query('SELECT DataAzione FROM hospitality_traccia_email_cron WHERE IdRichiesta = ' . $id . ' AND Idsito = ' . $idsito . ' AND TipoReInvio = "ReCall" ORDER BY Id DESC');
        if (sizeof($q) > 0) {
            $rec = $q[0];
            $check = '<i class="fa fa-repeat" data-toggle="tooltip" title="Invio ReCall del preventivo avvenuto il ' . $this->gira_data($rec['DataAzione']) . '"></i>';
            return $check;
        } else {
            return '';
        }
    }
    /**
     * re_email_send
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function re_email_send($id, $idsito)
    {
        global $dbMysqli;

        $q = $dbMysqli->query('SELECT DataAzione FROM hospitality_traccia_email_cron WHERE IdRichiesta = ' . $id . ' AND Idsito = ' . $idsito . ' AND TipoReInvio = "ReSend" ORDER BY Id DESC');
        if (sizeof($q) > 0) {
            $rec = $q[0];
            $check = '<i class="fa fa-repeat" data-toggle="tooltip" title="Invio ReCall della conferma avvenuto il ' . $this->gira_data($rec['DataAzione']) . '"></i>';
            return $check;
        } else {
            return '';
        }

    }

    /**
     * check_voucher_recupero_send
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function check_voucher_recupero_send($id, $idsito)
    {
        global $dbMysqli;

        $query = 'SELECT hospitality_tipo_voucher_cancellazione.Motivazione,hospitality_guest.DataVoucherRecSend FROM hospitality_tipo_voucher_cancellazione INNER JOIN hospitality_guest ON hospitality_guest.IdMotivazione = hospitality_tipo_voucher_cancellazione.Id WHERE hospitality_guest.Id = ' . $id . ' AND hospitality_guest.idsito = ' . $idsito . ' AND hospitality_guest.DataVoucherRecSend IS NOT NULL AND hospitality_guest.DataVoucherRecSend != "0000-00-00"';
        $result = $dbMysqli->query($query);
        if (sizeof($result) > 0) {
            $record = $result[0];

            $valore = '<i class="fa fa-tag text-orange" data-toogle="tooltip" title="Conferma proveniente da Buono Voucher per modifica date soggiorno, Email inviata in data ' . $this->gira_data($record['DataVoucherRecSend']) . ' Motivazione: ' . $record['Motivazione'] . '!"></i>';
        } else {
            $valore = '';
        }
        return $valore;
    }

    /**
     * func_cc
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function func_cc($id, $idsito)
    {
        global $dbMysqli;

        $pul_cc = '';
        $check_cambio = '';

        $arr = $dbMysqli->query('SELECT * FROM hospitality_cambio_pagamenti WHERE id_richiesta = ' . $id . ' AND idsito = ' . $idsito . " ORDER BY Id DESC");
        $check_cambio = sizeof($arr);

        $q = $dbMysqli->query('SELECT * FROM hospitality_carte_credito WHERE id_richiesta = ' . $id . ' AND idsito = ' . $idsito);
        if (sizeof($q) > 0) {
            $rec = $q[0];

            $pul_cc = ' <form id="form_cc' . $id . '" name="form_cc" method="post" action="https://' . $_SERVER['HTTP_HOST'] . '/carta_credito/" >
								<input type="hidden" name="id_richiesta" value="' . $rec['id_richiesta'] . '#' . $check_cambio . '">
								<a id="send_form' . $id . '"  href="javascript:;" class="text-success" data-toogle="tooltip" title="' . ($check_cambio > 1 ? 'pagamento cambiato con ' : '') . 'Carta di Credito" >' . ($check_cambio > 1 ? '<i class="fa fa-refresh fa-spin fa-fw"></i>' : '') . '<i class="fa fa-credit-card fa-fw"></i></a>
						</form>
                        <script>
                            $(function(){
                                $("#send_form' . $id . '").on("click",function(){
                                    $("#form_cc' . $id . '").submit();
                                })
                            })
                        </script>';

        } else {
            $qy = $dbMysqli->query('SELECT * FROM hospitality_altri_pagamenti WHERE id_richiesta = ' . $id . ' AND idsito = ' . $idsito);
            if (sizeof($qy) > 0) {
                $res = $qy[0];

                if ($res['TipoPagamento'] == 'Bonifico') {

                    if ($res['ricevuta'] != '' || $res['CRO'] != '') {
                        $color = 'text-success';
                        $style = '';
                        $title = 'Ricevuto ';
                    } else {
                        $color = 'text-danger';
                        $style = '';
                        $title = 'In attesa di ';
                    }

                    $icona = '<i class="fa fa-university fa-fw"></i>';

                } elseif ($res['TipoPagamento'] == 'Vaglia Postale') {

                    if ($res['ricevuta'] != '') {
                        $color = 'text-success';
                        $style = '';
                        $title = 'Ricevuto ';
                    } else {
                        $color = 'text-danger';
                        $style = '';
                        $title = 'In attesa di ';
                    }

                    $icona = '<i class="fa fa-euro fa-fw"></i>';

                } elseif ($res['TipoPagamento'] == 'PayPal') {

                    $color = 'text-success';
                    $style = '';
                    $title = 'Pagamento ricevuto con ';
                    $icona = '<i class="fa fa-paypal fa-fw"></i>';

                } elseif ($res['TipoPagamento'] == 'Gateway Bancario') {

                    $color = '';
                    $style = '';
                    $title = 'Pagamento ricevuto con ';
                    $icona = '<i class="fa fa-credit-card fa-fw" data-toogle="tooltip" title="BCC Gateway"></i>';

                } elseif ($res['TipoPagamento'] == 'Gateway Bancario Virtual Pay') {

                    $color = '';
                    $style = '';
                    $title = 'Pagamento ricevuto con ';
                    $icona = '<i class="fa fa-credit-card fa-fw" data-toogle="tooltip" title="Virtual Pay"></i>';

                } elseif ($res['TipoPagamento'] == 'Stripe') {

                    $color = '';
                    $style = '';
                    $title = 'Pagamento ricevuto con ';

                    $icona = '<img src="https://' . $_SERVER['HTTP_HOST'] . '/img/ico-stripe.png">';

                } elseif ($res['TipoPagamento'] == 'Nexi') {

                    $color = '';
                    $style = '';
                    $title = 'Pagamento ricevuto con ';

                    $icona = '<img src="https://' . $_SERVER['HTTP_HOST'] . '/img/ico-xpay.png">';
                }

                $pul_cc = ' <form id="form_cc' . $id . '" name="form_cc" method="post" action="https://' . $_SERVER['HTTP_HOST'] . '/pagamento/" >
									<input type="hidden" name="id_richiesta" value="' . $res['id_richiesta'] . '#' . $check_cambio . '">
									<a id="send_form' . $id . '"  href="javascript:;" class="' . $color . '" ' . $style . ' data-toogle="tooltip" title="' . ($check_cambio > 1 ? 'Il tipo di pagamento è stato cambiato con ' . $res['TipoPagamento'] : $title . $res['TipoPagamento']) . '">' . ($check_cambio > 1 ? '<i class="fa fa-refresh fa-spin fa-fw"></i>' : '') . '' . $icona . '</a>
							</form>
                            <script>
                                $(function(){
                                    $("#send_form' . $id . '").on("click",function(){
                                        $("#form_cc' . $id . '").submit();
                                    })
                                })
                            </script>';

            }
        }

        return $pul_cc;
    }

    /**
     * motivazione_conferme_annullate
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function motivazione_conferme_annullate($id, $idsito)
    {
        global $dbMysqli;

        $query = 'SELECT hospitality_motivi_disdetta.* FROM hospitality_motivi_disdetta WHERE hospitality_motivi_disdetta.IdRichiesta = ' . $id . ' AND hospitality_motivi_disdetta.idsito = ' . $idsito . ' ORDER BY hospitality_motivi_disdetta.id DESC';
        $result = $dbMysqli->query($query);
        $record = $result[0];

        $valore = '<small>' . $record['Motivo'] . '<br>
							' . (strlen($record['MotivoCustom']) <= 30 ?
            $record['MotivoCustom'] :
            substr($record['MotivoCustom'], 0, 30) . '... <i class="fa fa-angle-down" id="more' . $id . '" style="position:absolute;margin-top:10px;cursor:pointer;"></i>
								<div id="textmore' . $id . '" style="display:none">' . substr($record['MotivoCustom'], 30, 500) . '</div>
							') . '
						</small>';
        $valore .= '<script>
							$(document).ready(function(){
								$("#more' . $id . '").on("click",function(){
									$("#textmore' . $id . '").slideToggle("slow");
								});
							});
						</script>';
        return $valore;
    }

    /**
     * check_no_disponibilita
     *
     * @param  mixed $id
     * @param  mixed $TipoRichiesta
     * @param  mixed $idsito
     * @return void
     */
    public function check_no_disponibilita($id, $TipoRichiesta, $idsito)
    {
        global $dbMysqli;

        $query = 'SELECT DataOperazione FROM hospitality_motivi_disdetta WHERE hospitality_motivi_disdetta.idsito = ' . $idsito . ' AND hospitality_motivi_disdetta.IdRichiesta = ' . $id . ' ORDER BY hospitality_motivi_disdetta.id DESC';
        $result = $dbMysqli->query($query);
        $record = $result[0];

        $data = explode(" ", $record['DataOperazione']);
        $data_tmp = explode("-", $data[0]);
        $new_data = $data_tmp[2] . '-' . $data_tmp[1] . '-' . $data_tmp[0] . ' ' . $data[1];

        $valore = '<i class="fa fa-send-o  fa-fw" data-toogle="tooltip" data-html="true" title="Email di ' . $TipoRichiesta . ' annullata, inviata il ' . $new_data . '"></i>';

        return $valore;
    }

    /**
     * check_email_upselling
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function check_email_upselling($id, $idsito)
    {
        global $dbMysqli;

        $q = $dbMysqli->query('SELECT DataAzione FROM hospitality_traccia_email_cron WHERE IdRichiesta = ' . $id . ' AND Idsito = ' . $idsito . ' AND TipoReInvio = "UpSelling" ORDER BY Id DESC');
        if (sizeof($q) > 0) {
            $rec = $q[0];
            $DataA_tmp = explode(' ', $rec['DataAzione']);
            $DataAzione_tmp = explode('-', $DataA_tmp[0]);
            $DataAzione = $DataAzione_tmp[2] . '-' . $DataAzione_tmp[1] . '-' . $DataAzione_tmp[0];
            $check = '<i class="fa fa-send-o text-lime" data-toggle="tooltip" title="Invio Benvenuto automatico avvenuto il ' . $DataAzione . '"></i>';
        } else {
            $check = '';
        }
        return $check;
    }

    /**
     * check_email_precheckin
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function check_email_precheckin($id, $idsito)
    {
        global $dbMysqli;

        $q = $dbMysqli->query('SELECT DataAzione FROM hospitality_traccia_email_cron WHERE IdRichiesta = ' . $id . ' AND Idsito = ' . $idsito . ' AND TipoReInvio = "PreCheckin" ORDER BY Id DESC');
        if (sizeof($q) > 0) {
            $rec = $q[0];
            $DataA_tmp = explode(' ', $rec['DataAzione']);
            $DataAzione_tmp = explode('-', $DataA_tmp[0]);
            $DataAzione = $DataAzione_tmp[2] . '-' . $DataAzione_tmp[1] . '-' . $DataAzione_tmp[0];
            $check = '<i class="fa fa-info" data-toggle="tooltip" title="Invio PreCheckin automatico avvenuto il ' . $DataAzione . '"></i>';
        } else {
            $check = '';
        }
        return $check;
    }

    /**
     * motivazione_scadenza
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @param  mixed $DataValiditaVoucher
     * @param  mixed $IdMotiviazione
     * @return void
     */
    public function motivazione_scadenza($id, $idsito, $DataValiditaVoucher, $IdMotiviazione)
    {
        global $dbMysqli;

        $contatore = '';

        $query = 'SELECT hospitality_traccia_email_buoni_voucher.count FROM hospitality_traccia_email_buoni_voucher WHERE hospitality_traccia_email_buoni_voucher.id_richiesta = ' . $id . ' AND hospitality_traccia_email_buoni_voucher.idsito = ' . $idsito;
        $result = $dbMysqli->query($query);
        if (sizeof($result) > 0) {
            $record = $result[0];

            $numero = $record['count'];

            if ($numero > 0) {
                $contatore = '<label class="badge bg-yellow pull-right" data-toogle="tooltip" title="Numero invii via e-mail del buono voucher"><span class="f-11">' . $numero . '</span></label>';
            } else {
                $contatore = '';
            }
            $sel = 'SELECT
							hospitality_tipo_voucher_cancellazione.Motivazione
						FROM
							hospitality_tipo_voucher_cancellazione
						INNER JOIN
							hospitality_guest
						ON
							hospitality_guest.IdMotivazione = hospitality_tipo_voucher_cancellazione.Id
						WHERE
							hospitality_guest.Id = ' . $id . '
						AND
							hospitality_guest.idsito = ' . $idsito . '';
            $res = $dbMysqli->query($sel);

            $valore = $contatore . '<span class="f-11"><b>' . $res[0]['Motivazione'] . '<br>Scad: ' . ($DataValiditaVoucher < date('Y-m-d') ? '<span class="text-red">' . $this->gira_data($DataValiditaVoucher) . '</span>' : '<span class="text-green">' . $this->gira_data($DataValiditaVoucher) . '</span>') . '</b></span>';
        } else {
            $valore = '';
        }
        return $valore;
    }

    /**
     * getlastNumPreno
     *
     * @param  mixed $id
     * @return void
     */
    public function getlastNumPreno($id)
    {
        global $dbMysqli;
        $res = $dbMysqli->query("SELECT NumeroPrenotazione as NumeroPrenotazione FROM hospitality_guest WHERE Id = " . $id);
        $dato = $res[0];
        $NumeroPrenotazione = $dato['NumeroPrenotazione'];
        return ($NumeroPrenotazione);
    }

    /**
     * popola_status_parity
     *
     * @param  mixed $idsito
     * @param  mixed $NumeroPrenotazione
     * @param  mixed $status
     * @return void
     */
    public function popola_status_parity($idsito, $NumeroPrenotazione, $status)
    {
        global $dbMysqli;

        $qry = "SELECT * FROM hospitality_parityrate  WHERE idsito = " . $idsito . " AND Abilitato = 1 LIMIT 1";
        $sq = $dbMysqli->query($qry);
        $tot = sizeof($sq);

        if ($tot > 0) {
            $update = "UPDATE hospitality_guest SET AzioneParity = '" . $status . "' WHERE NumeroPrenotazione = " . $NumeroPrenotazione . " AND idsito = " . $idsito;
            $dbMysqli->query($update);
        }

    }

    /**
     * getPagamento
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function getPagamento($id, $idsito)
    {
        global $dbMysqli;

        $check = '';
        $check_cambio = '';

        $arr = $dbMysqli->query('SELECT * FROM hospitality_cambio_pagamenti WHERE id_richiesta = ' . $id . ' AND idsito = ' . $idsito . " ORDER BY Id DESC");
        $check_cambio = sizeof($arr);

        $q = $dbMysqli->query('SELECT * FROM hospitality_carte_credito WHERE id_richiesta = ' . $id . ' AND idsito = ' . $idsito);
        if (sizeof($q) > 0) {
            $rec = $q[0];
            $check = ($check_cambio > 1 ? 'pagamento cambiato con ' : '') . 'Carta di Credito ' . ($check_cambio > 1 ? '<i class="fa fa-refresh fa-spin fa-fw"></i>' : '') . '<i class="fa fa-credit-card fa-fw"></i>';

        } else {
            $qy = $dbMysqli->query('SELECT * FROM hospitality_altri_pagamenti WHERE id_richiesta = ' . $id . ' AND idsito = ' . $idsito);
            if (sizeof($qy) > 0) {
                $res = $qy[0];

                if ($res['TipoPagamento'] == 'Bonifico') {

                    if ($res['ricevuta'] != '' || $res['CRO'] != '') {
                        $title = 'Ricevuto ';
                    } else {
                        $title = 'In attesa di ';
                    }

                    $icona = '<i class="fa fa-university fa-fw"></i>';

                } elseif ($res['TipoPagamento'] == 'Vaglia Postale') {

                    if ($res['ricevuta'] != '') {

                        $title = 'Ricevuto ';
                    } else {
                        $title = 'In attesa di ';
                    }

                    $icona = '<i class="fa fa-euro fa-fw"></i>';

                } elseif ($res['TipoPagamento'] == 'PayPal') {

                    $title = 'Pagamento ricevuto con ';
                    $icona = '<i class="fa fa-paypal fa-fw"></i>';

                } elseif ($res['TipoPagamento'] == 'Gateway Bancario') {

                    $title = 'Pagamento ricevuto con ';
                    $icona = '<i class="fa fa-credit-card fa-fw" data-toogle="tooltip" title="BCC Gateway"></i>';

                } elseif ($res['TipoPagamento'] == 'Gateway Bancario Virtual Pay') {
                    $title = 'Pagamento ricevuto con ';
                    $icona = '<i class="fa fa-credit-card fa-fw" data-toogle="tooltip" title="Virtual Pay"></i>';

                } elseif ($res['TipoPagamento'] == 'Stripe') {
                    $title = 'Pagamento ricevuto con ';
                    $icona = '<img src="https://' . $_SERVER['HTTP_HOST'] . '/img/ico-stripe.png">';

                } elseif ($res['TipoPagamento'] == 'Nexi') {
                    $title = 'Pagamento ricevuto con ';
                    $icona = '<img src="https://' . $_SERVER['HTTP_HOST'] . '/img/ico-xpay.png">';
                }

                $check = ($check_cambio > 1 ? 'Il tipo di pagamento è stato cambiato con ' . $res['TipoPagamento'] : $title . $res['TipoPagamento']) . ' ' . ($check_cambio > 1 ? '<i class="fa fa-refresh fa-spin fa-fw"></i>' : '') . '' . $icona;

            } else {
                $check = 'In attesa di pagamento';
            }
        }

        return $check;
    }

    /**
     * check_5stelle_pms
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_5stelle_pms($idsito)
    {
        global $dbMysqli;

        $sele = "SELECT * FROM hospitality_pms WHERE idsito = " . $idsito . " AND Abilitato = 1 ";
        $ris = $dbMysqli->query($sele);
        if (sizeof($ris) > 0) {
            $check = 1;
        } else {
            $check = 0;
        }
        return $check;

    }

    /**
     * check_ericsoftpms
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_ericsoftpms($idsito)
    {
        global $dbMysqli;
        $Qcheck = "SELECT * FROM hospitality_ericsoftbooking WHERE idsito = " . $idsito . "  AND PMS = 1 ORDER BY Id DESC LIMIT 1";
        $Tcheck = $dbMysqli->query($Qcheck);
        if (sizeof($Tcheck) > 0) {
            $check = 1;
        } else {
            $check = 0;
        }
        return $check;
    }

    /**
     * check_bedzzlePMS
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_bedzzlePMS($idsito)
    {
        global $dbMysqli;
        $Qcheck = "SELECT * FROM hospitality_bedzzlebooking WHERE idsito = " . $idsito . "  AND PMS = 1 ORDER BY Id DESC LIMIT 1";
        $Qquery = $dbMysqli->query($Qcheck);
        if (sizeof($Qquery) > 0) {
            $check = 1;
        } else {
            $check = 0;
        }
        return $check;
    }

    /**
     * buottonPms5Stelle
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function buottonPms5Stelle($id, $idsito,$provenienza)
    {
        global $dbMysqli;

        $select = "SELECT   *  FROM   hospitality_data_syncro_pms   WHERE  id_prenotazione = " . $id . "  AND  idsito = " . $idsito . " AND TypePms = 'C'";
        $res = $dbMysqli->query($select);
        if (sizeof($res) > 0) {
            $rec = $res[0];

            $data_tmp = explode("-", $rec['data_reservation']);
            $data_reservation = $data_tmp[2] . '-' . $data_tmp[1] . '-' . $data_tmp[0];

            $title = 'Ri-sincronizza se hai modificato la prenotazione dopo la prima sincro del ' . $data_reservation;
            $button_del = '<li><a href="javascript:validator(\'//' . $_SERVER["HTTP_HOST"] . '/delete_preno_pms/' . $id . '/sync/C/&prov='.$provenienza.'\');" title="Elimina Prenotazione sincronizzata il ' . $data_reservation . ' dal PMS 5 Stelle" data-toogle="tooltip" style="float: left;padding-left : 4px;"><i class="fa fa-trash text-red" aria-hidden = "true"></i></a></li>';
        } else {
            $color = '';
            $title = 'Sincronizza con PMS 5 Stelle';
            $button_del = '';
        }
        $button_ins = '<li><a href="javascript:validator_pms(\'//' . $_SERVER["HTTP_HOST"] . '/syncro_pms/' . $id . '/sync/C/&prov='.$provenienza.'\');" title="' . $title . '"  data-toogle="tooltip" style="float: left;padding-right: 4px;margin-left: 4px"><i class="fa fa-refresh" aria-hidden="true"></i></a></li>';

        $action_button = '<ul class="check">' . $button_ins . $button_del . '</ul>';

        return $action_button;
    }
    /**
     * buottonPmsEricsoft
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function buottonPmsEricsoft($id, $idsito,$provenienza)
    {
        global $dbMysqli;
        $ret = '';

        $select = "SELECT   *  FROM   hospitality_data_syncro_pms   WHERE  id_prenotazione = " . $id . "  AND  idsito = " . $idsito . " AND TypePms = 'E'";
        $res = $dbMysqli->query($select);
        if (sizeof($res) > 0) {
            $rec = $res[0];

            $data_tmp = explode("-", $rec['data_reservation']);
            $data_reservation = $data_tmp[2] . '-' . $data_tmp[1] . '-' . $data_tmp[0];

            $ret = '<li><i class="fa fa-check" data-toggle="tooltip" title="Sincronizzato Ericsoft" aria-hidden="true"></i></li>';

            if ($rec['pms_info'] != 'modified') {
                $ret .= '<li><a href="javascript: validator_pms(\'//' . $_SERVER["HTTP_HOST"] . '/modify_preno_pms/' . $id . '/sync/E/&prov='.$provenienza.'\');" title="Se modificate la prenotazione in QUOTO, per aggiornarla anche sul PMS cliccate sull\'icona! Modifica la prenotazione sincronizzata il ' . $data_reservation . ' dal PMS Ericsoft" data-toogle="tooltip"><i class="fa fa-edit" aria-hidden="true"></i></a></li>';
            }
            if ($rec['pms_info'] != 'canceled') {
                $ret .= '<li><a href="javascript: validator(\'//' . $_SERVER["HTTP_HOST"] . '/modify_preno_pms/' . $id . '/sync/E&pms_info=canceled&prov='.$provenienza.'\');" title="Elimina Prenotazione sincronizzata il ' . $data_reservation . ' dal PMS Ericsoft, dopo aver cliccato devi mettere nel cestino di QUOTO la prenotazione, cosi viene eliminata anche nel PMS" data-toogle="tooltip" ><i class="fa fa-trash text-red" aria-hidden="true"></i></a></li>';
            }
        } else {
            $ret = '<li><i class="fa fa-refresh" data-toggle="tooltip" title="In attesa di sincronizzazione da parte di Ericsoft" aria-hidden="true"></i></li>';
        }

        return '<ul class="check">' . $ret . '</ul>';
    }

    /**
     * buottonPmsBedzzle
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function buottonPmsBedzzle($id, $idsito, $provenienza)
    {
        global $dbMysqli;

        $select = "SELECT   *  FROM   hospitality_data_syncro_pms   WHERE  id_prenotazione = " . $id . "  AND  idsito = " . $idsito . " AND TypePms = 'B'";
        $res = $dbMysqli->query($select);
        if (sizeof($res) > 0) {
            $rec = $res[0];

            $data_tmp = explode("-", $rec['data_reservation']);
            $data_reservation = $data_tmp[2] . '-' . $data_tmp[1] . '-' . $data_tmp[0];

            $title = 'Ri-sincronizza se hai modificato la prenotazione dopo la prima sincro del ' . $data_reservation;
            $button_del = '<li><a href="javascript:validator(\'//' . $_SERVER["HTTP_HOST"] . '/delete_preno_pms_bedzzle/' . $id . '/sync/B/&prov='.$provenienza.'\');" title="Elimina Prenotazione sincronizzata il ' . $data_reservation . ' dal PMS Bedzzle" data-toogle="tooltip" style="float: left;padding-left : 4px;"><i class="fa fa-trash text-red" aria-hidden = "true"></i></a></li>';
        } else {
            $color = '';
            $title = 'Sincronizza con PMS Bedzzle';
            $button_del = '';
        }
        $button_ins = '<li><a href="javascript:validator_pms(\'//' . $_SERVER["HTTP_HOST"] . '/syncro_pms/' . $id . '/sync/B/&prov='.$provenienza.'\');" title="' . $title . '"  data-toogle="tooltip" style="float: left;padding-right: 4px;margin-left: 4px"><i class="fa fa-refresh" aria-hidden="true"></i></a></li>';

        $action_button = '<ul class="check">' . $button_ins . $button_del . '</ul>';

        return $action_button;
    }
    /**
     * check_tot_preventivi
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_tot_preventivi($idsito)
    {
        global $dbMysqli;

        $res = 'SELECT COUNT(Id) as tot_preventivi FROM hospitality_guest
				WHERE
					hospitality_guest.TipoRichiesta = "Preventivo"
				AND
					hospitality_guest.idsito = ' . $idsito . '
				AND
					hospitality_guest.Hidden = 0
				AND
					hospitality_guest.Archivia = 0
				AND
					hospitality_guest.Chiuso = 0
				AND
					hospitality_guest.Accettato = 0
				AND
					hospitality_guest.Disdetta = 0
				AND
					hospitality_guest.NoDisponibilita = 0 ';
        $rec = $dbMysqli->query($res);
        $rw = $rec[0];
        return $rw['tot_preventivi'];
    }

    /**
     * checkNumberRows
     *
     * @param  mixed $idsito
     * @return void
     */
    public function checkNumberRows($idsito)
    {
        global $dbMysqli;

        $res = 'SELECT checkNumberRows FROM siti WHERE idsito = ' . $idsito . '';
        $rec = $dbMysqli->query($res);
        $rw = $rec[0];
        return $rw['checkNumberRows'];
    }

    /**
     * tot_preventivi
     *
     * @return void
     */
    public function tot_preventivi()
    {
        global $dbMysqli, $prima_data, $seconda_data;
        $sel = 'SELECT
						COUNT(Id) as tot_preventivi
					FROM
						hospitality_guest
					WHERE
						TipoRichiesta = "Preventivo"
                    AND
                        hospitality_guest.Hidden = 0
                    AND
                        hospitality_guest.Chiuso = 0
                    AND
                        hospitality_guest.Accettato = 0
                    AND
                        hospitality_guest.NoDisponibilita = 0
					AND
						hospitality_guest.idsito = ' . IDSITO . '
					' . ($_REQUEST['date'] == '' ? '
					AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . date('Y') . '" )
					' : '
					AND
						(hospitality_guest.DataRichiesta >= "' . $prima_data . '" AND hospitality_guest.DataRichiesta <= "' . $seconda_data . '")'
        ) . '';

        $res = $dbMysqli->query($sel);
        $rw = $res[0];

        return $rw['tot_preventivi'];
    }
    /**
     * tot_preventivi_periodo
     *
     * @return void
     */
    public function tot_preventivi_periodo()
    {
        global $dbMysqli, $prima_data_tmp, $seconda_data_tmp;

        $prima   = ($prima_data_tmp[2]-1).'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
        $seconda = ($seconda_data_tmp[2]-1).'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];

        $sel = 'SELECT
						COUNT(Id) as tot_preventivi
					FROM
						hospitality_guest
					WHERE
						TipoRichiesta = "Preventivo"
                    AND
                        hospitality_guest.Hidden = 0
                    AND
                        hospitality_guest.Chiuso = 0
                    AND
                        hospitality_guest.Accettato = 0
                    AND
                        hospitality_guest.NoDisponibilita = 0
					AND
						hospitality_guest.idsito = ' . IDSITO . '
					' . ($_REQUEST['date'] == '' ? '
					AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . (date('Y')-1) . '" )
					' : '
					AND
						(hospitality_guest.DataRichiesta >= "' . $prima . '" AND hospitality_guest.DataRichiesta <= "' . $seconda . '")'
        ) . '';
        $res = $dbMysqli->query($sel);
        $rw = $res[0];

        return $rw['tot_preventivi'];
    }
    /**
     * tot_invii
     *
     * @return void
     */
    public function tot_invii()
    {
        global $dbMysqli, $prima_data, $seconda_data;

        $res = $dbMysqli->query($q='SELECT COUNT(Id) as tot_invii FROM hospitality_guest  WHERE TipoRichiesta = "Preventivo" AND idsito = ' . IDSITO . '                 
                AND
					hospitality_guest.Hidden = 0
				AND
					hospitality_guest.Chiuso = 0
				AND
					hospitality_guest.Accettato = 0
				AND
					hospitality_guest.NoDisponibilita = 0  
                AND DataInvio IS NOT NULL  ' . ($_REQUEST['date'] == '' ? 'AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . date('Y') . '" OR YEAR ( hospitality_guest.DataChiuso ) = "' . date('Y') . '" )' : 'AND (DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '")') . '');

        $rws = $res[0];
        return $rws['tot_invii'];
    }
    /**
     * tot_invii_periodo
     *
     * @return void
     */
    public function tot_invii_periodo()
    {
        global $dbMysqli, $prima_data_tmp, $seconda_data_tmp;

        $prima   = ($prima_data_tmp[2]-1).'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
        $seconda = ($seconda_data_tmp[2]-1).'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];

        $res = $dbMysqli->query($q='SELECT COUNT(Id) as tot_invii FROM hospitality_guest  WHERE TipoRichiesta = "Preventivo" AND idsito = ' . IDSITO . '                 
                AND
					hospitality_guest.Hidden = 0
				AND
					hospitality_guest.Chiuso = 0
				AND
					hospitality_guest.Accettato = 0
				AND
					hospitality_guest.NoDisponibilita = 0  
                AND DataInvio IS NOT NULL  ' . ($_REQUEST['date'] == '' ? 'AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . (date('Y')-1) . '" OR YEAR ( hospitality_guest.DataChiuso ) = "' . (date('Y')-1) . '" )' : 'AND (DataRichiesta >= "' . $prima . '" AND DataRichiesta <= "' . $seconda . '")') . '');

        $rws = $res[0];
        return $rws['tot_invii'];
    }
    /**
     * tot_conferme
     *
     * @return void
     */
    public function tot_conferme()
    {
        global $dbMysqli, $prima_data, $seconda_data;

        $res = $dbMysqli->query($q='SELECT COUNT(Id) as tot_conferme FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = ' . IDSITO . '
				AND
					hospitality_guest.Hidden = 0
				AND
					hospitality_guest.Chiuso = 0
                AND
                    hospitality_guest.Disdetta = 0
                AND 
                    hospitality_guest.Accettato = 0 
                AND 
                    hospitality_guest.NoDisponibilita = 0 

				' . ($_REQUEST['date'] == '' ?
            'AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . date('Y') . '")'
            :
            'AND (DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '")') . '
				');

        $rwr = $res[0];
        return $rwr['tot_conferme'];
    }
    /**
     * tot_conferme_periodo
     *
     * @return void
     */
    public function tot_conferme_periodo()
    {
        global $dbMysqli, $prima_data_tmp, $seconda_data_tmp;

        $prima   = ($prima_data_tmp[2]-1).'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
        $seconda = ($seconda_data_tmp[2]-1).'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];

        $res = $dbMysqli->query($q='SELECT COUNT(Id) as tot_conferme FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = ' . IDSITO . '
				AND
					hospitality_guest.Hidden = 0
				AND
					hospitality_guest.Chiuso = 0
                AND
                    hospitality_guest.Disdetta = 0
                AND 
                    hospitality_guest.Accettato = 0 
                AND 
                    hospitality_guest.NoDisponibilita = 0 

				' . ($_REQUEST['date'] == '' ?
            'AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . (date('Y')-1) . '")'
            :
            'AND (DataRichiesta >= "' . $prima . '" AND DataRichiesta <= "' . $seconda . '")') . '
				');

        $rwr = $res[0];
        return $rwr['tot_conferme'];
    }
    /**
     * tot_prenotazioni
     *
     * @return void
     */
    public function tot_prenotazioni()
    {
        global $dbMysqli, $prima_data, $seconda_data;

        $res = $dbMysqli->query($q='SELECT COUNT(Id) as tot_prenotazioni FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = ' . IDSITO . '
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


				' . ($_REQUEST['date'] == '' ?
            'AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . date('Y') . '" OR YEAR ( hospitality_guest.DataChiuso ) = "' . date('Y') . '" )'
            :
            'AND (DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '"  OR (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '"))') . '
				');

        $rwc = $res[0];
        return $rwc['tot_prenotazioni'];
    }
    /**
     * tot_prenotazioni_periodo
     *
     * @return void
     */
    public function tot_prenotazioni_periodo()
    {
        global $dbMysqli, $prima_data_tmp, $seconda_data_tmp;

        $prima   = ($prima_data_tmp[2]-1).'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
        $seconda = ($seconda_data_tmp[2]-1).'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];

        $res = $dbMysqli->query($q='SELECT COUNT(Id) as tot_prenotazioni FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = ' . IDSITO . '
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

				' . ($_REQUEST['date'] == '' ?
            'AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . (date('Y')-1)  . '" OR YEAR ( hospitality_guest.DataChiuso ) = "' . (date('Y')-1)  . '" )'
            :
            'AND (DataRichiesta >= "' . $prima . '" AND DataRichiesta <= "' . $seconda . '"  OR (DATE(DataChiuso) >= "' . $prima . '" AND DATE(DataChiuso) <= "' . $seconda . '"))') . '
				');

        $rwc = $res[0];
        return $rwc['tot_prenotazioni'];
    }
    /**
     * tot_preno_archiviate
     *
     * @return void
     */
    public function tot_preno_archiviate()
    {
        global $dbMysqli, $prima_data, $seconda_data;

        $res = $dbMysqli->query($q='SELECT COUNT(Id) as tot_prenotazioni FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = ' . IDSITO . ' AND Hidden = 0 AND Chiuso = 1 AND Archivia = 1 AND ' . ($_REQUEST['date'] == '' ? ' (DATE(DataChiuso) >= "' . date('Y') . '-01-01" AND DATE(DataChiuso) <= "' . date('Y') . '-12-31")' : ' (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '")') . '');
        $rwc = $res[0];

        return $rwc['tot_prenotazioni'];
    }
    /**
     * tot_preno_archiviate_periodo
     *
     * @return void
     */
    public function tot_preno_archiviate_periodo()
    {
        global $dbMysqli, $prima_data_tmp, $seconda_data_tmp;

        $prima   = ($prima_data_tmp[2]-1).'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
        $seconda = ($seconda_data_tmp[2]-1).'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];

        $res = $dbMysqli->query($q='SELECT COUNT(Id) as tot_prenotazioni FROM hospitality_guest  WHERE TipoRichiesta = "Conferma" AND idsito = ' . IDSITO . ' AND Hidden = 0 AND Chiuso = 1 AND Archivia = 1 AND ' . ($_REQUEST['date'] == '' ? ' (DATE(DataChiuso) >= "' . (date('Y')-1) . '-01-01" AND DATE(DataChiuso) <= "' . (date('Y')-1) . '-12-31")' : ' (DATE(DataChiuso) >= "' . $prima . '" AND DATE(DataChiuso) <= "' . $seconda . '")') . '');

        $rwc = $res[0];
        return $rwc['tot_prenotazioni'];
    }
    /**
     * tot_archiviate
     *
     * @return void
     */
    public function tot_archiviate()
    {
        global $dbMysqli, $prima_data, $seconda_data;

        $res = $dbMysqli->query($q='SELECT COUNT(Id) as tot_archiviate FROM hospitality_guest  WHERE idsito = ' . IDSITO . ' AND Archivia = 1 ' . ($_REQUEST['date'] == '' ? ' AND ( YEAR ( hospitality_guest.DataRichiesta ) = "' . date('Y') . '" OR YEAR ( hospitality_guest.DataChiuso ) = "' . date('Y') . '" )' : 'AND ((DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '") OR (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '"))') . '');
        $rwc = $res[0];

        return $rwc['tot_archiviate'];

    }
    /**
     * tot_cestinate
     *
     * @return void
     */
    public function tot_cestinate()
    {
        global $dbMysqli, $prima_data, $seconda_data;

        $res = $dbMysqli->query($q='SELECT COUNT(Id) as tot_cestinate FROM hospitality_guest  WHERE idsito = ' . IDSITO . ' AND Hidden = 1 ' . ($_REQUEST['date'] == '' ? '' : 'AND ((DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '") OR (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '"))') . '');
        $rwc = $res[0];

        return $rwc['tot_cestinate'];

    }
    /**
     * tot_annullate
     *
     * @return void
     */
    public function tot_annullate()
    {
        global $dbMysqli, $prima_data, $seconda_data;

        $res = $dbMysqli->query($q='SELECT COUNT(Id) as tot_annullate FROM hospitality_guest  WHERE  idsito = ' . IDSITO . ' AND Hidden = 0 AND  Archivia = 0  AND NoDisponibilita = 1  ' . ($_REQUEST['date'] == '' ? '' : ' AND (DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '")') . '');
        $rwc = $res[0];

        return $rwc['tot_annullate'];
    }
    /**
     * tot_disdetta
     *
     * @return void
     */
    public function tot_disdetta()
    {
        global $dbMysqli, $prima_data, $seconda_data;

        $res = $dbMysqli->query($q='SELECT COUNT(Id) as tot_disdette FROM hospitality_guest  WHERE  idsito = ' . IDSITO . '
								AND
									hospitality_guest.TipoRichiesta = "Conferma"
								AND
									hospitality_guest.Hidden = 0
								AND
									hospitality_guest.Disdetta = 1
								AND
									hospitality_guest.Chiuso = 1
								 ' . ($_REQUEST['date'] == '' ? '' : 'AND (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '")') . '');
        $rwc = $res[0];

        return $rwc['tot_disdette'];
    }
    /**
     * tot_fatturato
     *
     * @param  mixed $n_format
     * @return void
     */
    public function tot_fatturato($n_format = null)
    {
        global $dbMysqli, $prima_data, $seconda_data;

        $sel = 'SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                FROM hospitality_guest
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                WHERE 1 = 1
                                AND hospitality_guest.idsito =  ' . IDSITO . '
                                AND hospitality_guest.NoDisponibilita = 0
                                AND hospitality_guest.Disdetta = 0
                                AND hospitality_guest.Hidden = 0
                                AND hospitality_guest.TipoRichiesta = "Conferma"
					' . ($_REQUEST['date'] == '' ? 'AND ((DataRichiesta>= "' . date('Y') . '-01-01" AND DataRichiesta <= "' . date('Y') . '-12-31") OR (DATE(DataChiuso) >= "' . date('Y') . '-01-01" AND DATE(DataChiuso) <= "' . date('Y') . '-12-31"))' : 'AND ((DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '") OR (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '"))') . '';
        $res = $dbMysqli->query($sel);

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
     * @param  mixed $n_format
     * @return void
     */
    public function tot_fatturato_periodo($n_format = null)
    {
        global $dbMysqli, $prima_data_tmp, $seconda_data_tmp;

        $prima   = ($prima_data_tmp[2]-1).'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
        $seconda = ($seconda_data_tmp[2]-1).'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];

        $sel = 'SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                                FROM hospitality_guest
                                INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                                WHERE 1 = 1
                                AND hospitality_guest.idsito =  ' . IDSITO . '
                                AND hospitality_guest.NoDisponibilita = 0
                                AND hospitality_guest.Disdetta = 0
                                AND hospitality_guest.Hidden = 0
                                AND hospitality_guest.TipoRichiesta = "Conferma"
					' . ($_REQUEST['date'] == '' ? 'AND ((DataRichiesta>= "' . (date('Y')-1) . '-01-01" AND DataRichiesta <= "' . (date('Y')-1) . '-12-31") OR (DATE(DataChiuso) >= "' . (date('Y')-1) . '-01-01" AND DATE(DataChiuso) <= "' . (date('Y')-1) . '-12-31"))' : 'AND ((DataRichiesta >= "' . $prima . '" AND DataRichiesta <= "' . $seconda . '") OR (DATE(DataChiuso) >= "' . $prima . '" AND DATE(DataChiuso) <= "' . $seconda . '"))') . '';
        $res = $dbMysqli->query($sel);

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
     * @param  mixed $n_format
     * @return void
     */
    public function tot_fatturato_prev($n_format = null)
    {
        global $dbMysqli, $prima_data, $seconda_data;

        $numeroPreventivi = '';
        $fatturato_medio = '';
        $media = '';

        $select = 'SELECT COUNT(hospitality_guest.Id) as numeroPreventivi
					FROM hospitality_guest
					WHERE 1=1
					AND hospitality_guest.idsito = ' . IDSITO . '
					AND hospitality_guest.Chiuso = 0
					AND hospitality_guest.Hidden = 0
					AND hospitality_guest.Disdetta = 0
					AND hospitality_guest.TipoRichiesta = "Preventivo"
					AND ' . ($_REQUEST['date'] == '' ? ' (DataRichiesta >= "' . date('Y') . '-01-01" AND DataRichiesta <= "' . date('Y') . '-12-31")' : ' (DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '")') . '';
        $result = $dbMysqli->query($select);
        error_log(__FUNCTION__.' '.$select);
        $rws = $result[0];

        $numeroPreventivi = $rws['numeroPreventivi'];

        $select2 = 'SELECT SUM(hospitality_proposte.PrezzoP) as fatturato,
							COUNT(hospitality_proposte.Id) as numeroProposte
					FROM hospitality_guest
					INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
					WHERE 1=1
					AND hospitality_guest.idsito = ' . IDSITO . '
					AND hospitality_guest.Chiuso = 0
					AND hospitality_guest.Hidden = 0
					AND hospitality_guest.Disdetta = 0
					AND hospitality_guest.TipoRichiesta = "Preventivo"
					AND ' . ($_REQUEST['date'] == '' ? ' (DataRichiesta >= "' . date('Y') . '-01-01" AND DataRichiesta <= "' . date('Y') . '-12-31")' : ' (DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '")') . '';

        $result2 = $dbMysqli->query($select2);
        error_log(__FUNCTION__.' '.$select2);
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
     * @param  mixed $n_format
     * @return void
     */
    public function tot_fatturato_conf($n_format = null)
    {
        global $dbMysqli, $prima_data, $seconda_data;

        $res = $dbMysqli->query($q='SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
					FROM hospitality_guest
					INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
					WHERE 1=1
					AND hospitality_guest.idsito = ' . IDSITO . '
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
     * @param  mixed $n_format
     * @return void
     */
    public function tot_fatturato_annullate($n_format = null)
    {
        global $dbMysqli, $prima_data, $seconda_data;

        $res = $dbMysqli->query($q='SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
					FROM hospitality_guest
					INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
					WHERE 1=1
					AND hospitality_guest.idsito = ' . IDSITO . '
					AND hospitality_guest.NoDisponibilita = 1
					AND hospitality_guest.Hidden = 0
					AND hospitality_guest.Disdetta = 0
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
     * tot_fatturato_disdette
     *
     * @param  mixed $n_format
     * @return void
     */
    public function tot_fatturato_disdette($n_format = null)
    {
        global $dbMysqli, $prima_data, $seconda_data;

        $res = $dbMysqli->query($q='SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
					FROM hospitality_guest
					INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
					WHERE 1=1
					AND hospitality_guest.idsito = ' . IDSITO . '
					AND hospitality_guest.NoDisponibilita = 0
					AND hospitality_guest.Hidden = 0
					AND hospitality_guest.Disdetta = 1
					AND hospitality_guest.Chiuso = 1
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
     * tot_conversioni
     *
     * @param  mixed $tot_invii
     * @param  mixed $tot_prenotazioni
     * @return void
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

    /**
     * conferma_in_arrivo
     *
     * @param  mixed $id
     * @return void
     */
    public function conferma_in_arrivo($id)
    {
        global $dbMysqli;

        $select = "SELECT hospitality_proposte.Id as IdProposta,hospitality_proposte.NomeProposta, hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,hospitality_guest.idsito,
							hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,hospitality_proposte.AccontoTesto,
							hospitality_guest.NumeroAdulti,hospitality_guest.NumeroBambini,
							hospitality_guest.EtaBambini1,hospitality_guest.EtaBambini2,hospitality_guest.EtaBambini3,hospitality_guest.EtaBambini4,
							hospitality_guest.EtaBambini5,hospitality_guest.EtaBambini6,
							hospitality_guest.AccontoRichiesta,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.AccontoLibero,
							hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza
					FROM hospitality_proposte
					INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
					WHERE hospitality_proposte.id_richiesta = " . $id;
        $res = $dbMysqli->query($select);
        error_log(__FUNCTION__.' '.$select);
        $tot = sizeof($res);
        if ($tot > 0) {
            $Camere = '';
            foreach ($res as $key => $value) {

                $PrezzoL = number_format($value['PrezzoL'], 2, ',', '.');
                $PrezzoP = number_format($value['PrezzoP'], 2, ',', '.');
                $IdProposta = $value['IdProposta'];
                $PrezzoPC = $value['PrezzoP'];
                $idsito = $value['idsito'];
                $AccontoRichiesta = $value['AccontoRichiesta'];
                $AccontoLibero = $value['AccontoLibero'];
                $NomeProposta = $value['NomeProposta'];
                $Nome = stripslashes($value['Nome']);
                $Cognome = stripslashes($value['Cognome']);
                $Email = $value['Email'];
                $NumeroAdulti = $value['NumeroAdulti'];
                $NumeroBambini = $value['NumeroBambini'];
                $EtaBambini1 = $value['EtaBambini1'];
                $EtaBambini2 = $value['EtaBambini2'];
                $EtaBambini3 = $value['EtaBambini3'];
                $EtaBambini4 = $value['EtaBambini4'];
                $EtaBambini5 = $value['EtaBambini5'];
                $EtaBambini6 = $value['EtaBambini6'];
                $Arrivo_tmp = explode("-", $value['DataArrivo']);
                $Arrivo = $Arrivo_tmp[2] . '-' . $Arrivo_tmp[1] . '-' . $Arrivo_tmp[0];
                $Partenza_tmp = explode("-", $value['DataPartenza']);
                $Partenza = $Partenza_tmp[2] . '-' . $Partenza_tmp[1] . '-' . $Partenza_tmp[0];
                $AccontoPercentuale = $value['AccontoPercentuale'];
                $AccontoImporto = $value['AccontoImporto'];
                $AccontoTesto = stripslashes($value['AccontoTesto']);
                $start = strtotime($value['DataArrivo']);
                $end = strtotime($value['DataPartenza']);
                $Notti = ceil(abs($end - $start) / 86400);
                // date alternative
                $se = "SELECT hospitality_proposte.Arrivo,hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.Id = " . $IdProposta . "";
                $re = $dbMysqli->query($se);
                $rc = $re[0];
                if (is_array($rc)) {
                    if ($rc > count($rc)) {
                        $tt = count($rc);
                    }

                } else {
                    $tt = 0;
                }
                if ($tt > 0) {
                    $DArrivo_tmp = explode("-", $rc['Arrivo']);
                    $DArrivo = $DArrivo_tmp[2] . '-' . $DArrivo_tmp[1] . '-' . $DArrivo_tmp[0];
                    $DPartenza_tmp = explode("-", $rc['Partenza']);
                    $DPartenza = $DPartenza_tmp[2] . '-' . $DPartenza_tmp[1] . '-' . $DPartenza_tmp[0];
                    $Dstart = mktime(24, 0, 0, $DArrivo_tmp[1], $DArrivo_tmp[2], intval($DArrivo_tmp[0]));
                    $Dend = mktime(01, 0, 0, $DPartenza_tmp[1], $DPartenza_tmp[2], intval($DPartenza_tmp[0]));
                    $DNotti = ceil(abs($Dend - $Dstart) / 86400);
                }
                if ($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                    $acconto = number_format(($PrezzoPC * $AccontoRichiesta / 100), 2, ',', '.');
                }
                if ($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                    $acconto = number_format($AccontoLibero, 2, ',', '.');
                }

                if ($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                    $acconto = number_format(($PrezzoPC * $AccontoPercentuale / 100), 2, ',', '.');
                }
                if ($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                    if ($AccontoImporto >= 1) {
                        $etichetta_caparra = '';
                    } else {
                        $etichetta_caparra = '<br /><i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Carta di Credito a garanzia';
                    }
                    //$acconto = number_format($AccontoImporto, 2, ',', '.');
                    $acconto = 'Carta di Credito a garanzia';
                }

                $select2 = "SELECT hospitality_richiesta.*,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
							FROM hospitality_richiesta
							INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
							INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
							WHERE hospitality_richiesta.id_proposta = " . $IdProposta;
                $res2 = $dbMysqli->query($select2);

                $Camere = '';
                if ($rc['Arrivo'] != '' && $rc['Partenza'] != '') {
                    if ($Arrivo != $DArrivo || $Partenza != $DPartenza) {
                        $data_alernativa = '<b>Date alternative</b><br>Arrivo <i class=\'fa fa-angle-right\'></i> ' . $DArrivo . ' - Partenza <i class=\'fa fa-angle-right\'></i> ' . $DPartenza . ' - per notti: ' . $DNotti . '<br>';
                    }
                }
                foreach ($res2 as $ky => $val) {
                    $Camere .= $val['TipoSoggiorno'] . ' <i class=\'fa fa-angle-right\'></i> Nr. ' . $val['NumeroCamere'] . ' ' . $val['TipoCamere'] . ($val['NumAdulti'] != 0 ? ' <i class=\'fa fa-angle-right\'></i> A: ' . $val['NumAdulti'] : '') . ($val['NumBambini'] != 0 ? ' B: ' . $val['NumBambini'] : '') . ($val['EtaB'] != '' || $val['EtaB'] != 0 ? ' età: ' . $val['EtaB'] : '') . ' - €. ' . number_format($val['Prezzo'], 2, ',', '.') . '<br>';
                }

                $sistemazione .= '<b>SOLUZIONE CONFERMATA</b><br>' . ($NomeProposta != '' ? '<b>' . $NomeProposta . '</b><br>' : '') . '<b>' . $Nome . ' ' . $Cognome . '</b> - <em>' . $Email . '</em><br>Adulti: <b>' . $NumeroAdulti . '</b> ' . ($NumeroBambini != '0' ? ' - Bambini: <b>' . $NumeroBambini . '</b> - ' . ($EtaBambini1 != '' && $EtaBambini1 != '0' ? $EtaBambini1 . ' anni ' : '') . ($EtaBambini2 != '' && $EtaBambini2 != '0' ? ' - ' . $EtaBambini2 . ' anni ' : '') . ($EtaBambini3 != '' && $EtaBambini3 != '0' ? ' - ' . $EtaBambini3 . ' anni ' : '') . ($EtaBambini4 != '' && $EtaBambini4 != '0' ? ' - ' . $EtaBambini4 . ' anni ' : '') . ($EtaBambini5 != '' && $EtaBambini5 != '0' ? ' - ' . $EtaBambini5 . ' anni ' : '') . ($EtaBambini6 != '' && $EtaBambini6 != '0' ? ' - ' . $EtaBambini6 . ' anni ' : '') . ' ' : '') . '<br>Arrivo <i class=\'fa fa-angle-right\'></i> ' . $Arrivo . ' - Partenza <i class=\'fa fa-angle-right\'></i> ' . $Partenza . ' - per notti: ' . $Notti . '<br> ' . $Camere . ' <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp;  ' . ($PrezzoL != '0,00' ? ' Prezzo List. €.<strike>' . $PrezzoL . '</strike> <i class=\'fa fa-angle-right\'></i>' : '') . '  Prezzo Proposto €.' . $PrezzoP . '<br /> ' . ($acconto != '' ? '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Caparra versata o da prelevare €.' . $acconto . '' . $etichetta_caparra : '') . '<br>';
            }

            $sistemazione = str_replace('"', ' ', $sistemazione);
            $sistemazione .= '<div style=\'float:right\'><a href=\'https://' . $_SERVER['HTTP_HOST'] . '/print_pdf/' . base64_encode($primary_key) . '\' target=\'_blank\' class=\'btn btn-success btn-xs\'>Print PDF</a></div><br>';

            return $sistemazione;

        } else {
            return '';
        }
    }

    /**
     * arriviOggi
     *
     * @param  mixed $idsito
     * @return void
     */
    public function arriviOggi($idsito)
    {
        global $dbMysqli;

        // Query per filtrare ed estrapolare gli arrivi per il checkin in hotel, filtro per OGGI, DOMANI, e filtro DATA
        $sel = "SELECT hospitality_guest.*,hospitality_checkin.Prenotazione as SiCheckin FROM hospitality_guest
				LEFT OUTER JOIN hospitality_checkin ON (hospitality_checkin.Prenotazione = hospitality_guest.NumeroPrenotazione AND hospitality_checkin.idsito = hospitality_guest.idsito)
				WHERE hospitality_guest.DataArrivo = '" . ($_REQUEST['date_fl'] == '' ? ($_REQUEST['date_arr'] == '' ? date('Y-m-d') : $_REQUEST['date_arr']) : $_REQUEST['date_fl']) . "'
				AND hospitality_guest.TipoRichiesta = 'Conferma'
				AND hospitality_guest.Chiuso = 1
				AND hospitality_guest.Disdetta = 0
				AND hospitality_guest.Archivia = 0
				AND hospitality_guest.Hidden = 0
				AND hospitality_guest.NoDisponibilita = 0
				AND hospitality_guest.idsito = " . $idsito . " GROUP BY hospitality_guest.NumeroPrenotazione";
        $rec = $dbMysqli->query($sel);
        if (sizeof($rec) > 0) {

            $arrivi .= ' <table class="table table-striped f-12">
						<tr>
						<th>Nr.</th>
						<th>Tipo</th>
						<th></th>
						<th>Cliente</th>
						<th></th>
						<th>Arrivo</th>
						<th>Partenza</th>
						<th class="text-center">Soggiorno</th>
						<th class="text-center">Email</th>
						<th class="text-center">CheckIn</th>
					</tr>';
            foreach ($rec as $k => $val) {
                $data_arrivo = $this->gira_data($val['DataArrivo']);
                $data_partenza = $this->gira_data($val['DataPartenza']);
                $arrivi .= '<tr>
								<td>' . ($val['CheckinOnlineClient'] == 1 ? $val['Prefisso'] . ' ' : '') . '' . $val['NumeroPrenotazione'] . '</td>
								<td>' . $val['TipoVacanza'] . '</td>
								<td><img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val['Lingua'] . '.png"></td>
								<td class="nowrap">' . stripslashes($val['Nome']) . ' ' . stripslashes($val['Cognome']) . '</td>
								<td class="nowrap"><b>A.</b>' . $val['NumeroAdulti'] . ' ' . ($val['NumeroBambini'] != '0' ? '<b>B.</b>' . $val['NumeroBambini'] : '') . '</td>
								<td class="nowrap">' . $data_arrivo . '</td>
								<td class="nowrap">' . $data_partenza . '</td>
								<td class="text-center">' . ($val['CheckinOnlineClient'] == 0 ? '<a href="#" data-toggle="modal" data-target="#myModal' . $val['Id'] . '" title="Visualizza il soggiorno"><i class="fa fa-comment"></i></a>' : '' . $val['FontePrenotazione'] . '') . '</td>
								<td class="text-center"><a href="mailto:' . $val['Email'] . '?subject=Rif.Prenotazione Numero ' . ($val['CheckinOnlineClient'] == 1 ? $val['Prefisso'] . ' ' . $val['NumeroPrenotazione'] : $val['NumeroPrenotazione']) . '" title="' . $val['Email'] . '"><i class="fa fa-envelope"></i></a></td>
								<td class="text-center">' . ($val['SiCheckin'] != '' ? 'Compilato' : 'Non compilato') . '</td>
							</tr>';

                $arrivi .= ' <div class="modal fade" id="myModal' . $val['Id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="myModalLabel">In Arrivo ...</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										' . $this->dettaglio_profila($val['Id'], $val['NumeroPrenotazione'], $val['TipoRichiesta'], $val['idsito']) . '
									</div>
									</div>
								</div>
							</div>';

            }
            $arrivi .= '</table>';
        } else {
            if ($_REQUEST['date_fl']) {

                $data = $this->gira_data($_REQUEST['date_fl']);
            }
            if ($_REQUEST['date_arr']) {

                $data = $this->gira_data($_REQUEST['date_arr']);
            }
            if ($_REQUEST['date_fl'] != '' || $_REQUEST['date_arr'] != '') {
                $arrivi = '<h3 class="text-center">Non ci sono arrivi in data: ' . $data . '!</h3>';
            }
        }
        return $arrivi;
    }

    /**
     * modaleNumeroPreventivi
     *
     * @param  mixed $idsito
     * @return void
     */
    public function modaleNumeroPreventivi($idsito)
    {

        $checkNumP = $this->checkNumberRows($idsito);
        $NumRecord = $this->check_tot_preventivi($idsito);

        if ($NumRecord > 1000 && $checkNumP == 0) {
            $modale_numPrev .= '	<script>
									$(document).ready(function(){
										if(!leggiCookie(\'modal_num_prev' . $idsito . '\')) {
											$("#modaleCheckNumprev").modal("show");
											scriviCookie(\'modal_num_prev' . $idsito . '\',\'numeropreventivi\',\'1140\');
										}
									});
								</script>' . "\r\n";
        }

        $modale_numPrev .= '<div class="modal fade" id="modaleCheckNumprev" tabindex="-1" role="dialog" aria-labelledby="modaleCheckNumprevLabel" aria-hidden="true" style="display: none;">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Lista preventivi notevolmente corposa!</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12 p-10 text-center f-12 text-center"><b>E\' apparsa questa modale perchè:</b><br> il numero dei preventivi da visualizzare è molto alto, supera il <b>migliaio</b>!!</div>
											</div>
											<div class="clearfix p-b-10"></div>
												<div class="row">
													<div class="col-md-8 text-right"><b>Limita il numero dei preventivi</b></div>
													<div class="col-md-4">
														<div id="recheck">
															<i class="fa fa-square-o fa-2x fa-fw text-black" id="Recheck" ' . ($checkNumP == 1 ? 'style="display:none"' : '') . '></i>
															<i class="fa fa-check-square-o fa-2x fa-fw text-black" id="noRecheck" ' . ($checkNumP == 0 ? 'style="display:none"' : '') . '></i>
														</div>
													</div>
												</div>
											<script>
												$(document).ready(function(){

														$("#Recheck").on("click",function(){
															$(this).hide(300);
															$("#noRecheck").show(300);
															var idsito = ' . $idsito . ';
															$.ajax({
																url: "' . BASE_URL_SITO . 'ajax/preventivi/update.recheck.php",
																type: "POST",
																data: "idsito="+idsito+"&value=1",
																dataType: "html",
																success: function(msg) {
																	$("#modaleCheckNumprev").modal("hide");
																}
															});
														});
														$("#noRecheck").on("click",function(){
															$(this).hide(300);
															$("#Recheck").show(300);
															var idsito = ' . $idsito . ';
															$.ajax({
																url: "' . BASE_URL_SITO . 'ajax/preventivi/update.recheck.php",
																type: "POST",
																data: "idsito="+idsito+"&value=0",
																dataType: "html",
																success: function(msg) {
																	$("#modaleCheckNumprev").modal("hide");
																}
															});
														});
												});
											</script>
											<div class="clearfix p-b-10"></div>
											<div class="row">
												<div class="col-md-12 p-10 text-center f-12">
													<i class="fa fa-exclamation-circle text-info"></i>
													<b>Limitando il numero:</b>
													<br>
													il CRM mostrerà tutti quelli dell\'anno corrente più tutti quelli della prima metà dell\'anno scorso!
													<br>
													Se vuoi tralasciare questo aspetto è possbile farlo! In futuro puoi modificare il setting di questo parametro da <br><b>Configurazioni->Impostazioni->Anagrafica e Mappa->Limita Record</b>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>' . "\r\n";

        return $modale_numPrev;
    }

    /**
     * modaleComunicazioni
     *
     * @return void
     */
    public function modaleComunicazioni()
    {
        global $dbMysqli;

        $res = $dbMysqli->query('SELECT * FROM comunicazioni WHERE DataInizio <= "' . date('Y-m-d') . '" AND DataFine > "' . date('Y-m-d') . '" AND Abilitato = 1 ORDER BY Id DESC LIMIT 1');
        $recSW = $res[0];
        if (sizeof($res) > 0) {
            $modale .= '   <script>
								$(document).ready(function(){
									if(leggiCookie("primo_ingresso")==""){
										$("#comunicazioni").modal("show");
									}
									scriviCookie("primo_ingresso","modal");
								});
							</script>' . "\r\n";
            $modale .= '     <div class="modal fade" id="comunicazioni" tabindex="-1" role="dialog" aria-labelledby="comunicazioni">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="comunicazioni"><b>' . $recSW['Titolo'] . '</b></h4>
											<a class="close" data-dismiss="modal">×</a>
										</div>
										<div class="modal-body">
											<small>La comunicazione rimarrà attiva e visibile fino al ' . $this->gira_data($recSW['DataFine']) . '</small>
											<div style="clear:both;height:8px"></div>
											' . $recSW['Testo'] . '
										</div>
									</div>
								</div>
							</div>';

            return $modale;
        }
    }

    /**
     * clean
     *
     * @param  mixed $stringa
     * @return void
     */
    public function clean($stringa)
    {

        $clean_title = str_replace("!", "", $stringa);
        $clean_title = str_replace("?", "", $clean_title);
        $clean_title = str_replace(":", "", $clean_title);
        $clean_title = str_replace("+", "", $clean_title);
        $clean_title = str_replace(".", "", $clean_title);
        $clean_title = str_replace(",", "", $clean_title);
        $clean_title = str_replace(";", "", $clean_title);
        $clean_title = str_replace("'", "", $clean_title);
        $clean_title = str_replace("*", "", $clean_title);
        $clean_title = str_replace("/", "", $clean_title);
        $clean_title = str_replace("\"", "", $clean_title);
        $clean_title = str_replace(" - ", "-", $clean_title);
        $clean_title = str_replace("     ", " ", $clean_title);
        $clean_title = str_replace("    ", " ", $clean_title);
        $clean_title = str_replace("   ", " ", $clean_title);
        $clean_title = str_replace("  ", " ", $clean_title);
        $clean_title = trim($clean_title);

        return ($clean_title);
    }

    /**
     * descr_parametro_config
     *
     * @param  mixed $value
     * @return void
     */
    public function descr_parametro_config($value)
    {

        switch ($value) {
            case "select_tipo_camere" :
                $result = 'Abilita o disabilita il <b>box di ricerca nella select delle camere</b> in Crea Proposta Soggiorno';
                break;
            case "check_verify_email" :
                $result = 'Abilita o disabilita il <b>controllo in real-time della email</b> del cliente inserita in Crea Proposta Soggiorno';
                break;
            case "check_pagination":
                $result = 'Abilita o disabilita la possibilità di <b>usare il ritorno alla pagina in base alla scelta nel menù di paginazione</b> in Preventivi, Conferme e Prenotazioni';
                break;
            case "check_paypal":
                $result = 'Abilita o disabilita il <b>modulo di pagamento PayPal</b> in Config.Impostazioni->Tipi di Pagamento. Se abilitate il modulo, ricordatevi di completare il relativo setting inserendo l\'email che avete dedicato a PayPal <small>(nome del campo: Email per account PayPal)</small>';
                break;
            case "check_gateway_bancario":
                $result = 'Abilita o disabilita il <b>modulo di pagamento tramite Gateway Bancario BCC</b> in Config.Impostazioni->Tipi di Pagamento. Se abilitate il modulo, significa che avete stipulato un contratto con la BCC quindi ricordatevi di completare il setting con i dati mancanti <small>(nomi dei campi: Server URL Gateway BCC, Id Cliente, API Key Cliente, Email Cliente)</small>';
                break;
            case "check_notifiche_push":
                $result = 'Abilita o disabilita le <b>Box Notifiche in Push</b> che appaiono in Preventivi, Conferme, Prenotazioni, Ticket, Dashboard, ecc';
                break;
            case "check_open_servizi":
                $result = 'Fai partire da <b>aperto o chiuso il box dei Servizi Aggiuntivi</b> in Crea Proposta Soggiorno';
                break;
            case "check_virtualpay":
                $result = 'Abilita o disabilita il <b>modulo di pagamento tramite Gateway Bancario Virtual Pay</b> in Config.Impostazioni->Tipi di Pagamento. Se abilitate il modulo, significa che avete stipulato un contratto con la Banca e richiesto il modulo di pagamento Virtual Pay. Quindi ricordatevi di completare il setting con i dati mancanti';
                break;
            case "check_banca_sella":
                $result = 'Abilita o disabilita il <b>modulo di pagamento tramite Gateway Bancario Banca Sella</b> in Config.Impostazioni->Tipi di Pagamento. Se abilitate il modulo, significa che avete stipulato un contratto con la Banca e richiesto il modulo di pagamento Banca Sella. Quindi ricordatevi di completare il setting con i dati mancanti';
                break;
            case "check_stripe":
                $result = 'Abilita o disabilita il <b>modulo di pagamento tramite Gateway STRIPE</b> in Config.Impostazioni->Tipi di Pagamento. Se abilitate il modulo, significa che avete stipulato un contratto e/o una registrazione con STRIPE. Quindi ricordatevi di completare il setting con i dati mancanti';
                break;
            case "check_nexi":
                $result = 'Abilita o disabilita il <b>modulo di pagamento tramite Gateway NEXI</b> in Config.Impostazioni->Tipi di Pagamento. Se abilitate il modulo, significa che avete stipulato un contratto e/o una registrazione con NEXI. Quindi ricordatevi di completare il setting con i dati mancanti';
                break;
            case "check_mailup":
                $result = 'Abilita o disabilita il <b>salvataggio dei dati FORM del tuo sito in MAIL UP</b>';
                break;
            case "check_adr":
                $result = 'Abilita o disabilita info-box <b>ADR QUOTO!</b> visibile dall\'area Dashboard.';
                break;
            case "check_interfaccia":
                $result = 'Abilita o disabilita <b>per aprire QUOTO al login</b> con la <b>nuova</b> o <b>vecchia</b> interfaccia.';
                break;
            case "check_email_voucher_hotel":
                $result = 'Abilita o disabilita <b>invio copia della mail voucher</b> verso Hotel';
                break;
        }
        return $result;

    }

    /**
     * lista_target
     *
     * @param  mixed $idsito
     * @return void
     */
    public function lista_target($idsito)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_target WHERE idsito = " . $idsito . " AND Abilitato = 1";
        $res = $dbMysqli->query($select);

        return $res;
    }

    /**
     * lista_operatori
     *
     * @param  mixed $idsito
     * @return void
     */
    public function lista_operatori($idsito)
    {
        global $dbMysqli;

        $permessi_user = $this->check_permessi();

        $select = "SELECT * FROM hospitality_operatori WHERE idsito = " . $idsito . " AND Abilitato = 1  " . ($permessi_user['UNIQUE'] == 1 ? " AND NomeOperatore = '" . NOMEUTENTEACCESSI . "'" : "") . " ORDER BY Id ASC";
        $res = $dbMysqli->query($select);

        return $res;
    }

    /**
     * lista_template
     *
     * @param  mixed $idsito
     * @return void
     */
    public function lista_template($idsito)
    {
        global $dbMysqli;

        $ListaTemplate = '';

        $select = "	SELECT
						hospitality_template_background.TemplateName,
						hospitality_template_background.Thumb,
						hospitality_template_background.Id as idTempBk
					FROM
						hospitality_template_background
					WHERE
						hospitality_template_background.idsito = " . $idsito . "
                    AND
                        hospitality_template_background.Visibile = 1
					ORDER BY
						hospitality_template_background.Ordine
					ASC";
        $rwt = $dbMysqli->query($select);

        foreach ($rwt as $kt => $vt) {
            $sel = "SELECT * FROM hospitality_template_landing WHERE idsito = " . $idsito . " LIMIT 1";
            $rt = $sel[0];

            $ListaTemplate .= '<option data-img-src="' . BASE_URL_SITO . 'img/' . $vt['Thumb'] . '" data-img-label="' . $vt['TemplateName'] . '" value="' . $vt['idTempBk'] . '" ' . (($id_template == $vt['idTempBk']) || ($rt['Template'] == $vt['TemplateName']) ? 'selected="selected"' : '') . '>' . $vt['TemplateName'] . '</option>';
        }

        return $ListaTemplate;
    }

    /**
     * get_legenda_template
     *
     * @param  mixed $idsito
     * @return void
     */
    public function get_legenda_template($idsito)
    {
        global $dbMysqli;

        $Template = '';

        $select = "	SELECT
						hospitality_template_background.TemplateName,
						hospitality_template_background.Thumb
					FROM
						hospitality_template_background
					WHERE
						hospitality_template_background.idsito = " . $idsito . "
					ORDER BY
						hospitality_template_background.Id
					ASC";
        $rwt = $dbMysqli->query($select);

        foreach ($rwt as $kt => $vt) {


            $Template .= '<img class="p-r-5" src="'.BASE_URL_SITO.'img/'.$vt['Thumb'].'" style="width:40px" data-toggle="tooltip" title="Template '.$vt['TemplateName'].'">';
        }

        return $Template;
    }

    /**
     * nextNumberPrev
     *
     * @param  mixed $idsito
     * @return void
     */
    public function nextNumberPrev($idsito)
    {
        global $dbMysqli;

        $select = "SELECT MAX(NumeroPrenotazione) AS latest FROM hospitality_guest WHERE idsito = " . $idsito;
        $result = $dbMysqli->query($select);
        $record = $result[0];
        $newId = intval($record['latest'] + 1);

        return $newId;
    }

    /**
     * lista_fonti
     *
     * @param  mixed $idsito
     * @return void
     */
    public function lista_fonti($idsito)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_fonti_prenotazione WHERE idsito = " . $idsito . " AND Abilitato = 1 ORDER BY FontePrenotazione ASC";
        $res = $dbMysqli->query($select);

        return $res;
    }

    /**
     * lista_politiche
     *
     * @param  mixed $idsito
     * @return void
     */
    public function lista_politiche($idsito)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_politiche WHERE idsito = " . $idsito . " AND tipo = 0 ORDER BY Id ASC";
        $res = $dbMysqli->query($select);

        return $res;
    }

    /**
     * lista_clienti
     *
     * @param  mixed $idsito
     * @return void
     */
    public function lista_clienti($idsito)
    {
        global $dbMysqli;

        $lista_nomi = array();

        $select_nomi = "SELECT Nome,Cognome,Email,Cellulare FROM hospitality_guest WHERE hospitality_guest.idsito = " . $idsito . " AND (hospitality_guest.Nome LIKE '%" . addslashes($_REQUEST['Nome']) . "%' OR hospitality_guest.Cognome LIKE '%" . addslashes($_REQUEST['Cognome']) . "%')";
        $record = $dbMysqli->query($select_nomi);
        if (sizeof($record) > 0) {
            $n = 1;
            foreach ($record as $key => $row) {
                if ($row['Nome'] != '' || $row['Cognome'] != '') {
                    $lista_nomi[] = "'" . addslashes(trim($row['Nome'])) . ($row['Cognome'] != "" ? " " . addslashes(trim($row['Cognome'])) : "") . ($row['Email'] != "" ? ", " . trim($row['Email']) : "") . ($row['Cellulare'] != "" ? ", " . addslashes(trim($row['Cellulare'])) : "") . "':" . $n;
                    $n++;
                }
            }

            if (is_array($lista_nomi)) {
                $lista_nomi = implode(',', $lista_nomi);
            }
        }

        return $lista_nomi;
    }

    /**
     * check_simplebooking
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_simplebooking($idsito)
    {
        global $dbMysqli;
        $Qcheck = "SELECT * FROM hospitality_simplebooking WHERE idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
        $Tcheck = $dbMysqli->query($Qcheck);
        if (sizeof($Tcheck) > 0) {
            $check = 1;
        } else {
            $check = 0;
        }
        return $check;
    }

    /**
     * check_ericsoftbooking
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_ericsoftbooking($idsito)
    {
        global $dbMysqli;
        $Qcheck = "SELECT * FROM hospitality_ericsoftbooking WHERE idsito = " . $idsito . "  AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
        $Tcheck = $dbMysqli->query($Qcheck);
        if (sizeof($Tcheck) > 0) {
            $check = 1;
        } else {
            $check = 0;
        }
        return $check;
    }

    /**
     * check_bedzzlebooking
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_bedzzlebooking($idsito)
    {
        global $dbMysqli;
        $Qcheck = "SELECT * FROM hospitality_bedzzlebooking WHERE idsito = " . $idsito . "  AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
        $Tcheck = $dbMysqli->query($Qcheck);

        if (sizeof($Tcheck) > 0) {
            $check = 1;
        } else {
            $check = 0;
        }
        return $check;
    }

    /**
     * check_UrlBookingOnline
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_UrlBookingOnline($idsito)
    {
        global $dbMysqli;

        $BookingOnline = '';

        $select = "SELECT BookingOnline FROM hospitality_social WHERE idsito = '" . $idsito . "'";
        $res = $dbMysqli->query($select);
        $rw = $res[0];
        if ($rw['BookingOnline'] != '') {
            $BookingOnline = '<div class="row m-t-10">
                            		<div class="col-md-4"></div>
                            		<div class="col-md-4"></div>
                            		<div class="col-md-4 text-center">
										<a href="javascript:;" onclick="window.open(\'' . $rw['BookingOnline'] . '\', \'pop\', \'top=500,left=500,width=1024,height=768\');" class="btn btn-primary btn-sm">
										Apri la maschera del tuo Booking Online
										</a>
									</div>
								</div>
								<div class="clearfix p-b-10"></div>';
        } else {
            $BookingOnline = '';
        }
        return $BookingOnline;
    }

    /**
     * get_pms_person
     *
     * @param  mixed $idsito
     * @param  mixed $type
     * @return void
     */
    public function get_pms_person($idsito, $type)
    {
        global $dbMysqli;

        $sel_person = "SELECT * FROM hospitality_pms_person WHERE idsito = " . $idsito . " AND TypePms = '" . $type . "' AND PersonName NOT LIKE '%Adulti%' ORDER BY Id";
        $array_person = $dbMysqli->query($sel_person);

        if (sizeof($array_person) > 0) {
            return $array_person;
        }
    }

    /**
     * lista_pacchetti
     *
     * @param  mixed $idsito
     * @param  mixed $Lingua
     * @return void
     */
    public function lista_pacchetti($idsito, $Lingua)
    {
        global $dbMysqli;

        if (!$Lingua) {
            $Lingua = 'it';
        } else {
            $Lingua = $Lingua;
        }
        $select = "SELECT hospitality_tipo_pacchetto_lingua.* FROM hospitality_tipo_pacchetto_lingua
					INNER JOIN hospitality_tipo_pacchetto ON hospitality_tipo_pacchetto.Id = hospitality_tipo_pacchetto_lingua.pacchetto_id
					WHERE hospitality_tipo_pacchetto_lingua.lingue = '" . $Lingua . "'
					AND hospitality_tipo_pacchetto.Abilitato = 1
					AND hospitality_tipo_pacchetto_lingua.idsito = " . $idsito . "
					ORDER BY hospitality_tipo_pacchetto_lingua.Pacchetto ASC";
        $result = $dbMysqli->query($select);
        if (sizeof($result) > 0) {
            $ListaPacchetti .= '<option value="">scegli</option>';
            foreach ($result as $chiave => $valore) {
                $ListaPacchetti .= '<option value="' . $valore['Pacchetto'] . '" data-id="' . $valore['Id'] . '" >' . $valore['Pacchetto'] . '</option>';
            }
        } else {
            $ListaPacchetti = '';
        }
        return $ListaPacchetti;
    }

    /**
     * lista_pacchetti
     *
     * @param  mixed $idsito
     * @param  mixed $Lingua
     * @return void
     */
    public function mod_lista_pacchetti($NomeProposta, $idsito, $Lingua)
    {
        global $dbMysqli;

        if (!$Lingua) {
            $Lingua = 'it';
        } else {
            $Lingua = $Lingua;
        }

            $select = "SELECT hospitality_tipo_pacchetto_lingua.* FROM hospitality_tipo_pacchetto_lingua
                        INNER JOIN hospitality_tipo_pacchetto ON hospitality_tipo_pacchetto.Id = hospitality_tipo_pacchetto_lingua.pacchetto_id
                        WHERE hospitality_tipo_pacchetto_lingua.lingue = '" . $Lingua . "'
                        AND hospitality_tipo_pacchetto.Abilitato = 1
                        AND hospitality_tipo_pacchetto_lingua.idsito = " . $idsito . "
                        ORDER BY hospitality_tipo_pacchetto_lingua.Pacchetto ASC";
            $result = $dbMysqli->query($select);
            if (sizeof($result) > 0) {
                $ListaPacchetti .= '<option value="">scegli</option>';
                foreach ($result as $chiave => $valore) {
                    $ListaPacchetti .= '<option value="' . $valore['Pacchetto'] . '" data-id="' . $valore['Id'] . '" '.($NomeProposta==$valore['Pacchetto']?'selected="selected"':'').'>' . $valore['Pacchetto'] . '</option>';
                }
            } else {
                $ListaPacchetti = '';
            }

        return $ListaPacchetti;
    }
    /**
     * mod_pacchetto
     *
     * @param  mixed $idsito
     * @param  mixed $idrichiesta
     * @return void
     */
    public function mod_pacchetto($idsito,$idrichiesta,$Lingua)
    {
        global $dbMysqli;

        $select = "SELECT
                        hospitality_proposte.NomeProposta,
                        hospitality_tipo_pacchetto_lingua.Id
                    FROM
                        hospitality_proposte
                        INNER JOIN hospitality_tipo_pacchetto_lingua ON hospitality_tipo_pacchetto_lingua.Pacchetto = hospitality_proposte.NomeProposta
                    WHERE
                        hospitality_proposte.id_richiesta = " . $idrichiesta."
                    AND
                        hospitality_tipo_pacchetto_lingua.idsito = " . $idsito."
                    AND
                        hospitality_tipo_pacchetto_lingua.lingue = '" . $Lingua . "'";
        $result = $dbMysqli->query($select);
        if (sizeof($result) > 0) {
            $valore = $result[0];
            $pacchetto = '<option value="' . $valore['NomeProposta'] . '" data-id="' . $valore['Id'] . '" selected="selected" >' . $valore['NomeProposta'] . '</option>';
        } else {
            $pacchetto = '';
        }
        return $pacchetto;
    }
    /**
     * lista_soggiorni
     *
     * @param  mixed $idsito
     * @return void
     */
    public function lista_soggiorni($idsito)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_tipo_soggiorno WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = " . $idsito . " ORDER BY TipoSoggiorno ASC";
        $result = $dbMysqli->query($select);
        if (sizeof($result) > 0) {
            $ListaSoggiorno .= '<option value="">scegli</option>';
            foreach ($result as $chiave => $valore) {
                $ListaSoggiorno .= '<option value="' . $valore['Id'] . '">' . mini_clean($valore['TipoSoggiorno']) . '</option>';
            }
        } else {
            $ListaSoggiorno = '';
        }

        return $ListaSoggiorno;
    }

    /**
     * lista_camere
     *
     * @param  mixed $idsito
     * @return void
     */
    public function lista_camere($idsito)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_tipo_camere WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = " . $idsito . " ORDER BY Ordine ASC";
        $result = $dbMysqli->query($select);
        if (sizeof($result) > 0) {
            $ListaCamere .= '<option value="">scegli</option>';
            foreach ($result as $key => $val) {
                $ListaCamere .= '<option value="' . $val['Id'] . '">' . mini_clean($val['TipoCamere']) . '</option>';
            }
        } else {
            $ListaCamere = '';
        }

        return $ListaCamere;
    }

    /**
     * get_servizi_aggiuntivi
     *
     * @param  mixed $n
     * @return void
     */
    public function get_servizi_aggiuntivi($n)
    {
        global $dbMysqli;

        $box_open = $this->check_configurazioni(IDSITO, 'check_open_servizi');
        // Query per servizi aggiuntivi
        $query = "SELECT hospitality_tipo_servizi.* FROM hospitality_tipo_servizi
                            WHERE hospitality_tipo_servizi.idsito = " . IDSITO . "
                            AND hospitality_tipo_servizi.Lingua = 'it'
                            AND hospitality_tipo_servizi.Abilitato = 1
                            ORDER BY hospitality_tipo_servizi.Ordine ASC";
        $record = $dbMysqli->query($query);

        if (sizeof($record) > 0) {
            $lista_servizi_aggiuntivi .= '<tr><td colspan="6" class="no-border-top no-border-bottom"></td></tr>
                                            <tr>
                                                <td colspan="6" class="nopadding no-border-top no-border-bottom">
												    <div class="pull-right box-tools">
                                                        <a id="viewServizi' . $n . '" href="javascript:;" class="text-black"><i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="<ol class=\'text-left f-12\'><li><b>Senza inserire le date principali</b> od alternative, il calcolo dei <b>servizi aggiuntivi non viene attivato</b></li><li>Selezionare tutte le caselle corrispondenti ai servizi da rendere visibili al cliente nel preventivo, anche per quelli inclusi e attivati con il cursore a destra.</li><li>Se il servizio viene eliminato, (dopo essere stato calcolato), passare con il cursore del mouse sul campo Prezzo Soggiorno proposto pre effettuare il <b>ri-calcolo</b>!</li></ol>"></i> <b>Servizi aggiuntivi</b>  <i id="iconSwitchServ' . $n . '" class="fa ' . ($box_open == 0 ? 'fa-minus' : 'fa-plus') . '"></i></a>
                                                    </div>
													<script>
                                                            $(document).ready(function(){
															' . ($box_open == 1 ? '' : '$("#openServizi' . $n . '").hide();') . '
                                                                $("#viewServizi' . $n . '").on("click",function(){
                                                                    $("#openServizi' . $n . '").slideToggle("slow", function(){
																		var display =  $("#openServizi' . $n . '").css("display");
																		if(display!="none") {
																			$("#iconSwitchServ' . $n . '").addClass("fa-minus");
																			$("#iconSwitchServ' . $n . '").removeClass("fa-plus");
																		}else{
																			$("#iconSwitchServ' . $n . '").removeClass("fa-minus");
																			$("#iconSwitchServ' . $n . '").addClass("fa-plus");
																		}
																	});

                                                                })
                                                            })
                                                    </script>
													<div class="clearfix p-b-10"></div>
                                                    <div  id="openServizi' . $n . '">
                                                    <div class="body">
                                                        <table id="tabellaServizi" class="table table-hover table-bordered table-sm f-13 bg_blocchi_proposta">
                                                        ' . (DISABLED_CHECKBOX == 1 ? '' :
                '
														<tr>
                                                                <!--<td class="td5pdl0pdr10 bg_tdWhite"></td>-->
																<td class="bg_tdWhite">
																<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-html="true" title="<b>ATTENZIONE:</b> solo i servizi selezionati saranno visibili lato utente finale!"></i>
                                                                <span  id="selectAll' . $n . '" class="p-r-10 cursore"><i class="fa fa-check-square-o"></i></span>
                                                                    <script>
                                                                        $( document ).ready(function() {
                                                                            $("#selectAll' . $n . '").on("click", function () {
                                                                                if($(".select_servizi' . $n . '").prop("checked")==true) {
                                                                                        $(".select_servizi' . $n . '").attr("checked", false);
                                                                                        $("#selectAll' . $n . '").html(\'<i class="fa fa-square-o"></i>\');
                                                                                }else{
                                                                                        $(".select_servizi' . $n . '").attr("checked", true);
                                                                                        $("#selectAll' . $n . '").html(\'<i class="fa fa-check-square-o"></i>\');
                                                                                }

                                                                            });
                                                                        });
                                                                    </script>
																<b>Servizio</b></td>
																<td class="bg_tdWhite"><b>Descrizione</b></td>
																<td class="bg_tdWhite"><b>Tipologia</b></td>
																<td class="bg_tdWhite"><b>Prezzo</b></td>
																<td class="bg_tdWhite"><b>Calcolo</b></td>
																<td class="bg_tdWhite text-center"><b>Attiva</b></td>
                                                        </tr>') . "\r\n";

            foreach ($record as $chiave => $campo) {

                $q = "SELECT hospitality_tipo_servizi_lingua.Descrizione FROM hospitality_tipo_servizi_lingua  WHERE hospitality_tipo_servizi_lingua.servizio_id = " . $campo['Id'] . " AND hospitality_tipo_servizi_lingua.idsito = " . IDSITO . " AND hospitality_tipo_servizi_lingua.lingue = 'it'";
                $r = $dbMysqli->query($q);
                $rec = $r[0];

                $lista_servizi_aggiuntivi .= '<tr class="contenitore_servizio' . $n . '">
                                                                    <!--<td class="td5pdl0pdr10 ">' . ($campo['Icona'] != '' ? '<div class="content_icona"><img src="' . BASE_URL_SITO . 'uploads/' . IDSITO . '/' . $campo['Icona'] . '" class="iconaDimension"></div>' : '<div class="content_icona_empty"></div>') . '</td>-->
																	<td class="td20">' . (DISABLED_CHECKBOX == 1 ? '' : '<input type="checkbox" class="select_servizi' . $n . '" data-toogle="tooltip" title="Rendi visibile o nascondi il servizio" id="VisibileServizio' . $n . '_' . $campo['Id'] . '" name="VisibileServizio' . $n . '[' . $campo['Id'] . ']" value="1" checked="checked" />') . ' <b class="p-l-5">' . $campo['TipoServizio'] . '</b></td>
                                                                    <td class="td20"><small class="f-w-900">' . (strlen($rec['Descrizione']) <= 80 ? stripslashes(strip_tags($rec['Descrizione'])) : substr(stripslashes(strip_tags($rec['Descrizione'])), 0, 80) . '...') . '</small></td>';

                if ($campo['CalcoloPrezzo'] == 'A percentuale' && $campo['PercentualeServizio'] != '') {
                    $lista_servizi_aggiuntivi .= '   <td class="td20">' . $campo['CalcoloPrezzo'] . '</td>
                                                                    <td class="td15"><i class="fa fa-percent"></i>&nbsp;&nbsp;' . number_format($campo['PercentualeServizio'], 2) . '</td>';
                } else {
                    $lista_servizi_aggiuntivi .= '   <td class="td20">' . ($campo['CalcoloPrezzo'] == 'A persona' ? $campo['CalcoloPrezzo'] . ' <i class="fa fa-question-circle text-black" data-toggle="tooltip" data-html="true" title="Per <b>modificare</b> un valore già inserito disabilita e riabilita il servizio, riapparirà il pulsante <b>Calcola</b>"></i>' : $campo['CalcoloPrezzo']) . '</td>
                                                                    <td class="td15">' . ($campo['PrezzoServizio'] != 0 ? '<i class="fa fa-euro"></i>&nbsp;&nbsp;' . number_format($campo['PrezzoServizio'], 2, ',', '.') : 'Gratis') . '</td>';
                }

                $lista_servizi_aggiuntivi .= '   <td class="td15"><div id="valori_serv_' . $n . '_' . $campo['Id'] . '"></div><div id="pulsante_calcola_' . $n . '_' . $campo['Id'] . '"></div><div id="spiegazione_prezzo_servizio_' . $n . '_' . $campo['Id'] . '"></div><div id="Prezzo_Servizio_' . $n . '_' . $campo['Id'] . '"></div>' . ($campo['Obbligatorio'] == 1 ? '<small>(Incluso)</small>' : '') . '</td>
                                                                    <td class="td5 text-center">';

                if ($campo['CalcoloPrezzo'] == 'A percentuale' && $campo['PercentualeServizio'] != '') {
                    $lista_servizi_aggiuntivi .= '   <input type="checkbox" class="js-switch PrezzoServizio' . $n . '" id="PrezzoServizio' . $n . '_' . $campo['Id'] . '" name="PrezzoServizio' . $n . '[' . $campo['Id'] . ']" value="' . $campo['PercentualeServizio'] . '#' . $campo['CalcoloPrezzo'] . '#' . $campo['Id'] . '" ' . ($campo['Obbligatorio'] == 1 ? 'checked="checked"' : '') . ' onChange="calcola_totale' . $n . '();">';
                } else {
                    if ($campo['CalcoloPrezzo'] == 'A persona') {
                        $lista_servizi_aggiuntivi .= '   <div style="display:inline;width:100%" class="nowrap"> <input type="checkbox" class="js-switch PrezzoServizio' . $n . '" id="PrezzoServizio' . $n . '_' . $campo['Id'] . '" name="PrezzoServizio' . $n . '[' . $campo['Id'] . ']" value="' . $campo['PrezzoServizio'] . '#' . $campo['CalcoloPrezzo'] . '#' . $campo['Id'] . '" ' . ($campo['Obbligatorio'] == 1 ? 'checked="checked"' : '') . '></div>';
                    } else {
                        $lista_servizi_aggiuntivi .= '   <input type="checkbox" class="js-switch PrezzoServizio' . $n . '" id="PrezzoServizio' . $n . '_' . $campo['Id'] . '" name="PrezzoServizio' . $n . '[' . $campo['Id'] . ']" value="' . $campo['PrezzoServizio'] . '#' . $campo['CalcoloPrezzo'] . '#' . $campo['Id'] . '" ' . ($campo['Obbligatorio'] == 1 ? 'checked="checked"' : '') . ' onChange="calcola_totale' . $n . '();"> ';
                    }
                }

                $lista_servizi_aggiuntivi .= '   <script>
                                                                            $("#PrezzoServizio' . $n . '_' . $campo['Id'] . '").change(function(){
                                                                                if(this.checked == true){
                                                                                    if($("#DataArrivo_' . $n . '").val()!="" && $("#DataPartenza_' . $n . '").val()!=""){
                                                                                        var s_tmp     = $("#DataArrivo_' . $n . '").val();
                                                                                        var e_tmp     = $("#DataPartenza_' . $n . '").val();
                                                                                        var start_tmp = s_tmp.split("-");
                                                                                        var end_tmp   = e_tmp.split("-");
                                                                                        var dal       = s_tmp;
                                                                                        var al        = e_tmp;
                                                                                        var start     = new Date(start_tmp[0],(start_tmp[1]-1),start_tmp[2],1,0,0).getTime()/1000;
                                                                                        var end       = new Date(end_tmp[0],(end_tmp[1]-1),end_tmp[2],1,0,0).getTime()/1000;
                                                                                        var notti     = Math.ceil(Math.abs(end - start) / 86400);
                                                                                    }
                                                                                    var idsito        = ' . IDSITO . ';
                                                                                    var n_proposta    = ' . $n . ';
                                                                                    var id_servizio   = ' . $campo['Id'] . ';
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "' . BASE_URL_SITO . 'ajax/calcoli/calc_prezzo_serv.php",
                                                                                        data: "notti=" + notti + "&dal=" + dal + "&al=" + al + "&n_proposta=" + n_proposta + "&id_servizio=" + id_servizio + "&idsito=" + idsito,
                                                                                        dataType: "html",
                                                                                        success: function(data){
                                                                                            $("#valori_serv_' . $n . '_' . $campo['Id'] . '").html(data);
                                                                                            $("#pulsante_calcola_' . $n . '_' . $campo['Id'] . '").show();
                                                                                        },
                                                                                        error: function(){
                                                                                            alert("Chiamata fallita, si prega di riprovare...");
                                                                                        }
                                                                                    });
                                                                                }

                                                                            });
                                                                        </script>';

                $lista_servizi_aggiuntivi .= '<div class="modal fade" id="modal_persone_' . $n . '_' . $campo['Id'] . '"  role="dialog" aria-labelledby="myModalLabel">
                                                                                <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
																					  	<h5 class="modal-title" id="myModalLabel">Inserisci i dati per calcolare il prezzo del servizio</h5>
                                                                                    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                    <label for="prezzo' . $n . '_' . $campo['Id'] . '">Prezzo Servizio</label>
                                                                                                    <input type="text" id="prezzo' . $n . '_' . $campo['Id'] . '" name="prezzo' . $n . '_' . $campo['Id'] . '" class="form-control" value="' . $campo['PrezzoServizio'] . '" readonly />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="form-group">
                                                                                                        <label for="Nnotti' . $n . '_' . $campo['Id'] . '">Numero Giorni</label>
                                                                                                            <select id="Nnotti' . $n . '_' . $campo['Id'] . '" name="Nnotti' . $n . '_' . $campo['Id'] . '"  class="form-control" >
                                                                                                                <option value="1">1</option>
                                                                                                                <option value="2">2</option>
                                                                                                                <option value="3">3</option>
                                                                                                                <option value="4">4</option>
                                                                                                                <option value="5">5</option>
                                                                                                                <option value="6">6</option>
                                                                                                                <option value="7">7</option>
                                                                                                                <option value="8">8</option>
                                                                                                                <option value="9">9</option>
                                                                                                                <option value="10">10</option>
                                                                                                                <option value="11">11</option>
                                                                                                                <option value="12">12</option>
                                                                                                                <option value="13">13</option>
                                                                                                                <option value="14">14</option>
                                                                                                                <option value="15">15</option>
                                                                                                                <option value="16">16</option>
                                                                                                                <option value="17">17</option>
                                                                                                                <option value="18">18</option>
                                                                                                                <option value="19">19</option>
                                                                                                                <option value="20">20</option>
                                                                                                                <option value="21">21</option>
                                                                                                                <option value="22">22</option>
                                                                                                                <option value="23">23</option>
                                                                                                                <option value="24">24</option>
                                                                                                                <option value="25">25</option>
                                                                                                                <option value="26">26</option>
                                                                                                                <option value="27">27</option>
                                                                                                                <option value="28">28</option>
                                                                                                                <option value="29">29</option>
                                                                                                                <option value="30">30</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="form-group">
                                                                                                        <label class="f-11 nowrap">' . $campo['TipoServizio'] . ' a persona</label>
                                                                                                        <select id="NPersone' . $n . '_' . $campo['Id'] . '" name="NPersone' . $n . '_' . $campo['Id'] . '" class="form-control" >
                                                                                                            <option value="" selected="selected">--</option>
                                                                                                            <option value="1">1</option>
                                                                                                            <option value="2">2</option>
                                                                                                            <option value="3">3</option>
                                                                                                            <option value="4">4</option>
                                                                                                            <option value="5">5</option>
                                                                                                            <option value="6">6</option>
                                                                                                            <option value="7">7</option>
                                                                                                            <option value="8">8</option>
                                                                                                            <option value="9">9</option>
                                                                                                            <option value="10">10</option>
                                                                                                            <option value="11">11</option>
                                                                                                            <option value="12">12</option>
                                                                                                            <option value="13">13</option>
                                                                                                            <option value="14">14</option>
                                                                                                            <option value="15">15</option>
                                                                                                            <option value="16">16</option>
                                                                                                            <option value="17">17</option>
                                                                                                            <option value="18">18</option>
                                                                                                            <option value="19">19</option>
                                                                                                            <option value="20">20</option>
                                                                                                            <option value="21">21</option>
                                                                                                            <option value="22">22</option>
                                                                                                            <option value="23">23</option>
                                                                                                            <option value="24">24</option>
                                                                                                            <option value="25">25</option>
                                                                                                            <option value="26">26</option>
                                                                                                            <option value="27">27</option>
                                                                                                            <option value="28">28</option>
                                                                                                            <option value="29">29</option>
                                                                                                            <option value="30">30</option>
                                                                                                            <option value="31">31</option>
                                                                                                            <option value="32">32</option>
                                                                                                            <option value="33">33</option>
                                                                                                            <option value="34">34</option>
                                                                                                            <option value="35">35</option>
                                                                                                            <option value="36">36</option>
                                                                                                            <option value="37">37</option>
                                                                                                            <option value="38">38</option>
                                                                                                            <option value="39">39</option>
                                                                                                            <option value="40">40</option>
                                                                                                            <option value="41">41</option>
                                                                                                            <option value="42">42</option>
                                                                                                            <option value="43">43</option>
                                                                                                            <option value="44">44</option>
                                                                                                            <option value="45">45</option>
                                                                                                            <option value="46">46</option>
                                                                                                            <option value="47">47</option>
                                                                                                            <option value="48">48</option>
                                                                                                            <option value="48">49</option>
                                                                                                            <option value="50">50</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 text-center">
                                                                                                <input type="hidden" id="id_servizio' . $n . '_' . $campo['Id'] . '" name="id_servizio' . $n . '_' . $campo['Id'] . '" value="' . $campo['Id'] . '">
                                                                                                <button type="button" class="btn btn-primary btn-sm" id="send_re_calc' . $n . '_' . $campo['Id'] . '" data-dismiss="modal" aria-label="Close">Calcola prezzo servizio</button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <script>
                                                                                            $(document).ready(function() {
                                                                                                    $("#modal_persone_' . $n . '_' . $campo['Id'] . '").on("show.bs.modal", function (event) {
                                                                                                        var button = $(event.relatedTarget);
                                                                                                        var xnotti = button.data("notti");
                                                                                                        var prezzo = button.data("prezzo");
                                                                                                        var id_servizio = button.data("id_servizio");
                                                                                                        var modal = $(this);
                                                                                                        modal.find(".modal-body select#Nnotti' . $n . '_' . $campo['Id'] . '").val(xnotti);
                                                                                                        modal.find(".modal-body select#NPersone' . $n . '_' . $campo['Id'] . '").val($("#NumeroAdulti").val());
                                                                                                        modal.find(".modal-body input#prezzo' . $n . '_' . $campo['Id'] . '").val(prezzo);
                                                                                                        modal.find(".modal-body input#id_servizio' . $n . '_' . $campo['Id'] . '").val(id_servizio);
                                                                                                    });
                                                                                                    $("#send_re_calc' . $n . '_' . $campo['Id'] . '").on("click",function(){
                                                                                                        var idsito        = ' . IDSITO . ';
                                                                                                        var n_proposta    = ' . $n . ';
                                                                                                        var id_servizio   = $("#id_servizio' . $n . '_' . $campo['Id'] . '").val();
                                                                                                        var notti         = $("#Nnotti' . $n . '_' . $campo['Id'] . '").val();
                                                                                                        var prezzo        = $("#prezzo' . $n . '_' . $campo['Id'] . '").val();
                                                                                                        var NPersone      = $("#NPersone' . $n . '_' . $campo['Id'] . '").val();
                                                                                                        $.ajax({
                                                                                                            type: "POST",
                                                                                                            url: "' . BASE_URL_SITO . 'ajax/calcoli/calc_prezzo_serv_a_persona.php",
                                                                                                            data: "action=re_calc&notti=" + notti + "&prezzo=" + prezzo + "&NPersone=" + NPersone + "&n_proposta=" + n_proposta + "&id_servizio=" + id_servizio + "&idsito=" + idsito,
                                                                                                            dataType: "html",
                                                                                                            success: function(data){
                                                                                                                $("#valori_serv_' . $n . '_' . $campo['Id'] . '").html(data);
                                                                                                                $("#pulsante_calcola_' . $n . '_' . $campo['Id'] . '").hide();
                                                                                                                 calcola_totale' . $n . '();
                                                                                                            },
                                                                                                            error: function(){
                                                                                                                alert("Chiamata fallita, si prega di riprovare...");
                                                                                                            }
                                                                                                        });

                                                                                                });

                                                                                            });
                                                                                        </script>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>';
                $lista_servizi_aggiuntivi .= '
                                                                    </td>
                                                                </tr>';

            }
            $lista_servizi_aggiuntivi .= '               </table>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr> ';
        }

        return $lista_servizi_aggiuntivi;
    }

    /**
     * get_modifica_servizi_aggiuntivi
     *
     * @param  mixed $n
     * @param  mixed $id_richiesta
     * @param  mixed $id_propostaget_modifica_servizi_aggiuntivi
     * @return void
     */
    public function get_modifica_servizi_aggiuntivi($n, $id_richiesta, $id_proposta)
    {
        global $dbMysqli, $Notti, $NumeroPrenotazione;

        $box_open = $this->check_configurazioni(IDSITO, 'check_open_servizi');

        $q = "SELECT * FROM hospitality_relazione_servizi_proposte WHERE id_richiesta = " . $id_richiesta . " AND id_proposta = " . $id_proposta;
        $r = $dbMysqli->query($q);
        if (sizeof($r) > 0) {
            $IdServizio = array();
            foreach ($r as $k => $v) {
                $IdServizio[$v['servizio_id']] = 1;
            }
        }

        #### CONTROLLO I SERVIZI AGGIUNTIVI SCELTI DALL'UTENTE FINALE
        $quy = "SELECT Id FROM hospitality_guest WHERE NumeroPrenotazione = " . $NumeroPrenotazione . "  AND TipoRichiesta = 'Preventivo' AND idsito = " . IDSITO . " ";
        $ese = $dbMysqli->query($quy);
        $rec = $ese[0];
        if (is_array($rec)) {
            if ($rec > count($rec)) {
                $rec = count($rec);
            }

        } else {
            $exist = 0;
        }
        if ($exist > 0) {
            $qry = "SELECT hospitality_relazione_servizi_proposte.servizio_id FROM hospitality_relazione_servizi_proposte WHERE id_richiesta = " . $rec['Id'] . " AND idsito = " . IDSITO . " ";
            $rce = $dbMysqli->query($qry);
            $IdServizioScelto = array();
            if (sizeof($rce) > 0) {
                foreach ($rce as $ki => $vl) {
                    $IdServizioScelto[$vl['servizio_id']] = 1;

                }
            }
        }
        ### FINE CONTROLLO

        // Query per servizi aggiuntivi
        $query = "SELECT hospitality_tipo_servizi.* FROM hospitality_tipo_servizi
							WHERE hospitality_tipo_servizi.idsito = " . IDSITO . "
							AND hospitality_tipo_servizi.Lingua  = 'it'
							AND hospitality_tipo_servizi.Abilitato = 1
							ORDER BY hospitality_tipo_servizi.Ordine ASC";
        $record = $dbMysqli->query($query);
        if (sizeof($record) > 0) {
            $lista_servizi_aggiuntivi .= '<tr><td colspan="7" class="no-border-top no-border-bottom"></td></tr>
                                            <tr>
                                                <td colspan="7" class="nopadding no-border-top no-border-bottom">
												    <div class="pull-right box-tools">
                                                        <a id="viewServizi' . $n . '" href="javascript:;" class="text-black"><i class="cursore m-l-5 fa fa-question-circle" data-toggle="tooltip" data-html="true" title="<ol class=\'text-left f-12\'><li><b>Senza inserire le date principali</b> od alternative, il calcolo dei <b>servizi aggiuntivi non viene attivato</b></li><li>Selezionare tutte le caselle corrispondenti ai servizi da rendere visibili al cliente nel preventivo, anche per quelli inclusi e attivati con il cursore a destra.</li><li>Se il servizio viene eliminato, (dopo essere stato calcolato), passare con il cursore del mouse sul campo Prezzo Soggiorno proposto pre effettuare il <b>ri-calcolo</b>!</li></ol>"></i> <b>Servizi aggiuntivi</b>  <i id="iconSwitchServ' . $n . '" class="fa ' . ($box_open == 0 ? 'fa-minus' : 'fa-plus') . '"></i></a>
                                                    </div>
													<script>
                                                            $(document).ready(function(){
															' . ($box_open == 1 ? '' : '$("#openServizi' . $n . '").hide();') . '
                                                                $("#viewServizi' . $n . '").on("click",function(){
                                                                    $("#openServizi' . $n . '").slideToggle("slow", function(){
																		var display =  $("#openServizi' . $n . '").css("display");
																		if(display!="none") {
																			$("#iconSwitchServ' . $n . '").addClass("fa-minus");
																			$("#iconSwitchServ' . $n . '").removeClass("fa-plus");
																		}else{
																			$("#iconSwitchServ' . $n . '").removeClass("fa-minus");
																			$("#iconSwitchServ' . $n . '").addClass("fa-plus");
																		}
																	});

                                                                })
                                                            })
                                                    </script>
													<div class="clearfix p-b-10"></div>
                                                    <div  id="openServizi' . $n . '">
													<div class="box-body">

														<table id="tabellaServizi" class="table table-hover table-bordered table-sm f-13 bg_blocchi_proposta">
														' . (DISABLED_CHECKBOX == 1 ? '' :
                                                        '<tr>
																<!--<td class="td5pdl0pdr10 bg_tdWhite"></td>-->
																<td class="bg_tdWhite">
																<i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-html="true" title="<b>ATTENZIONE:</b> solo i servizi selezionati saranno visibili lato utente finale!"></i>
                                                                <span  id="selectAll' . $n . '" class="p-r-10 cursore"><i class="fa fa-check-square-o"></i></span>
                                                                    <script>
                                                                        $( document ).ready(function() {
                                                                            $("#selectAll' . $n . '").on("click", function () {
                                                                                if($(".select_servizi' . $n . '").prop("checked")==true) {
                                                                                        $(".select_servizi' . $n . '").attr("checked", false);
                                                                                        $("#selectAll' . $n . '").html(\'<i class="fa fa-square-o"></i>\');

                                                                                }else{
                                                                                        $(".select_servizi' . $n . '").attr("checked", true);
                                                                                        $("#selectAll' . $n . '").html(\'<i class="fa fa-check-square-o"></i>\');
                                                                                }

                                                                            });
                                                                        });
                                                                    </script>
																<b>Servizio</b></td>
																<td class="bg_tdWhite"><b>Descrizione</b></td>
																<td class="bg_tdWhite"><b>Tipologia</b></td>
																<td class="bg_tdWhite"><b>Prezzo</b></td>
																<td class="bg_tdWhite"><b>Calcolo</b></td>
																<td class="bg_tdWhite text-center"><b>Attiva</b></td>
																<td class="bg_tdWhite text-center"></td>
														</tr>') . "\r\n";

            foreach ($record as $chiave => $campo) {

                $q = "SELECT hospitality_tipo_servizi_lingua.Descrizione FROM hospitality_tipo_servizi_lingua  WHERE hospitality_tipo_servizi_lingua.servizio_id = " . $campo['Id'] . " AND hospitality_tipo_servizi_lingua.idsito = " . IDSITO . " AND hospitality_tipo_servizi_lingua.lingue = 'it'";
                $r = $dbMysqli->query($q);
                $rec = $r[0];

                $qrel = "SELECT hospitality_relazione_servizi_proposte.id as id_relazionale,hospitality_relazione_servizi_proposte.num_persone,hospitality_relazione_servizi_proposte.num_notti FROM hospitality_relazione_servizi_proposte WHERE hospitality_relazione_servizi_proposte.id_richiesta = " . $id_richiesta . " AND hospitality_relazione_servizi_proposte.id_proposta = " . $id_proposta . " AND hospitality_relazione_servizi_proposte.servizio_id = " . $campo['Id'] . " ";
                $rel = $dbMysqli->query($qrel);
                $recrel = $rel[0];

                $s = "SELECT hospitality_relazione_visibili_servizi_proposte.visibile FROM hospitality_relazione_visibili_servizi_proposte  WHERE hospitality_relazione_visibili_servizi_proposte.id_richiesta = " . $id_richiesta . " AND hospitality_relazione_visibili_servizi_proposte.id_proposta = " . $id_proposta . " AND hospitality_relazione_visibili_servizi_proposte.servizio_id = " . $campo['Id'] . " AND hospitality_relazione_visibili_servizi_proposte.idsito = " . IDSITO . "";
                $ss = $dbMysqli->query($s);
                $rs = $ss[0];

                $lista_servizi_aggiuntivi .= '<tr class="contenitore_servizio' . $campo['Id'] . '">
																	<!--<td class="td5pdl0pdr10 ">' . ($campo['Icona'] != '' ? '<div class="content_icona"><img src="' . BASE_URL_SITO . 'uploads/' . IDSITO . '/' . $campo['Icona'] . '" class="iconaDimension"></div>' : '<div class="content_icona_empty"></div>') . '</td>-->
																	<td class="td20">' . (DISABLED_CHECKBOX == 1 ? '' : '<input type="checkbox" class="select_servizi' . $n . '" data-toogle="tooltip" title="Rendi visibile o nascondi il servizio" class="" id="VisibileServizio' . $n . '_' . $campo['Id'] . '" name="VisibileServizio' . $n . '[' . $campo['Id'] . ']" value="1" ' . ($rs['visibile'] == 1 ? 'checked="checked"' : '') . '>') . ' <b ' . ((!$IdServizioScelto[$campo['Id']] && $IdServizio[$campo['Id']] == 1) ? 'class="text-olive" data-toogle="tooltip" title="Servizio scelto dal cliente"' : '') . ' >' . $campo['TipoServizio'] . '</b></td>
																	<td class="td20"><small>' . (strlen($rec['Descrizione']) <= 80 ? stripslashes(strip_tags($rec['Descrizione'])) : substr(stripslashes(strip_tags($rec['Descrizione'])), 0, 80) . '...') . '</small></td>';

                if ($campo['CalcoloPrezzo'] == 'A percentuale' && $campo['PercentualeServizio'] != '') {
                    $lista_servizi_aggiuntivi .= '   <td class="td20">' . $campo['CalcoloPrezzo'] . '</td>
																	<td class="td20"><i class="fa fa-percent"></i>&nbsp;&nbsp;' . number_format($campo['PercentualeServizio'], 2) . '</td>';
                } else {
                    $lista_servizi_aggiuntivi .= '   <td class="td20">' . ($campo['CalcoloPrezzo'] == 'A persona' ? $campo['CalcoloPrezzo'] . ' <i class="fa fa-question-circle" data-toggle="tooltip" data-html="true" title="Per <b>modificare</b> un valore già inserito disabilita e riabilita il servizio, riapparirà il pulsante <b>Calcola</b>"></i>' : $campo['CalcoloPrezzo']) . '</td>
																	<td class="td15">' . ($campo['PrezzoServizio'] != 0 ? '<i class="fa fa-euro"></i>&nbsp;&nbsp;' . number_format($campo['PrezzoServizio'], 2, ',', '.') : '<small>Gratis</small>') . '</td>';
                }

                $lista_servizi_aggiuntivi .= '       <td class="td20">' . ($recrel['num_notti'] != 0 || !is_null($recrel['num_notti']) || !empty($recrel['num_notti']) ? '<input type="hidden" name="notti' . $n . '_' . $campo['Id'] . '" id="notti' . $n . '_' . $campo['Id'] . '" data-tipo="notti' . $n . '_' . $campo['Id'] . '" value="' . $recrel['num_notti'] . '">' : '') . ($recrel['num_persone'] != 0 || !is_null($recrel['num_persone']) || !empty($recrel['num_persone']) ? '<input type="hidden" name="num_persone_' . $n . '_' . $campo['Id'] . '" id="num_persone' . $n . '_' . $campo['Id'] . '" data-tipo="persone' . $n . '_' . $campo['Id'] . '" value="' . $recrel['num_persone'] . '" />' : '') . '<div id="valori_serv_' . $n . '_' . $campo['Id'] . '"></div><div id="pulsante_calcola_' . $n . '_' . $campo['Id'] . '"></div><div id="spiegazione_prezzo_servizio_' . $n . '_' . $campo['Id'] . '"></div><div id="Prezzo_Servizio_' . $n . '_' . $campo['Id'] . '"></div></div>' . ($campo['Obbligatorio'] == 1 ? '<small>(Incluso)</small>' : '') . '</td>
																	<td class="td5 text-center">';

                if ($campo['CalcoloPrezzo'] == 'A percentuale' && $campo['PercentualeServizio'] != '') {
                    $lista_servizi_aggiuntivi .= '       <div id="contenitore_switchery' . $recrel['id_relazionale'] . '">
																	<input type="checkbox" class="js-switch PrezzoServizio' . $n . '" id="PrezzoServizio' . $n . '_' . $campo['Id'] . '" name="PrezzoServizio' . $n . '[' . $campo['Id'] . ']" value="' . $campo['PercentualeServizio'] . '#' . $campo['CalcoloPrezzo'] . '#' . $campo['Id'] . '" ' . ($IdServizio[$campo['Id']] == 1 ? 'checked="checked"' : '') . ' ' . ($campo['Obbligatorio'] == 1 ? 'checked="checked"' : '') . ' onChange="calcola_totale' . $n . '();">';
                } else {
                    if ($campo['CalcoloPrezzo'] == 'A persona') {
                        $lista_servizi_aggiuntivi .= '       <div id="contenitore_switchery' . $recrel['id_relazionale'] . '">
																		<div style="display:inline;width:100%" class="nowrap"> <input type="checkbox" class="js-switch PrezzoServizio' . $n . '" id="PrezzoServizio' . $n . '_' . $campo['Id'] . '" name="PrezzoServizio' . $n . '[' . $campo['Id'] . ']" value="' . $campo['PrezzoServizio'] . '#' . $campo['CalcoloPrezzo'] . '#' . $campo['Id'] . '" ' . ($IdServizio[$campo['Id']] == 1 ? 'checked="checked"' : '') . ' ' . ($campo['Obbligatorio'] == 1 ? 'checked="checked"' : '') . '></div>';
                    } else {
                        $lista_servizi_aggiuntivi .= '       <div id="contenitore_switchery' . $recrel['id_relazionale'] . '">
																		<input type="checkbox" class="js-switch PrezzoServizio' . $n . '" id="PrezzoServizio' . $n . '_' . $campo['Id'] . '" name="PrezzoServizio' . $n . '[' . $campo['Id'] . ']" value="' . $campo['PrezzoServizio'] . '#' . $campo['CalcoloPrezzo'] . '#' . $campo['Id'] . '" ' . ($IdServizio[$campo['Id']] == 1 ? 'checked="checked"' : '') . ' ' . ($campo['Obbligatorio'] == 1 ? 'checked="checked"' : '') . ' onChange="calcola_totale' . $n . '();">';
                    }
                }
                $lista_servizi_aggiuntivi .= '       <script>
																			$(document).ready(function(){
																				$("#PrezzoServizio' . $n . '_' . $campo['Id'] . '").change(function(){
																					if(this.checked == true){
																						if($("#DataArrivo_' . $n . '").val()!="" && $("#DataPartenza_' . $n . '").val()!=""){
																							var s_tmp     = $("#DataArrivo_' . $n . '").val();
																							var e_tmp     = $("#DataPartenza_' . $n . '").val();
																							var start_tmp = s_tmp.split("-");
																							var end_tmp   = e_tmp.split("-");
																							var dal       = s_tmp;
																							var al        = e_tmp;
																							var start     = new Date(start_tmp[0],(start_tmp[1]-1),start_tmp[2],1,0,0).getTime()/1000;
																							var end       = new Date(end_tmp[0],(end_tmp[1]-1),end_tmp[2],1,0,0).getTime()/1000;
																							var notti     = Math.ceil(Math.abs(end - start) / 86400);
																						}
																						var idsito        = ' . IDSITO . ';
																						var n_proposta    = ' . $n . ';
																						var id_servizio   = ' . $campo['Id'] . ';

																						$.ajax({
																							type: "POST",
																							url: "' . BASE_URL_SITO . 'ajax/calcoli/re_calc_prezzo_serv.php",
																							data: "notti=" + notti + "&dal=" + dal + "&al=" + al + "&n_proposta=" + n_proposta + "&id_servizio=" + id_servizio + "&idsito=" + idsito,
																							dataType: "html",
																							success: function(data){
																								$("#valori_serv_' . $n . '_' . $campo['Id'] . '").html(data);
																								$("#pulsante_calcola_' . $n . '_' . $campo['Id'] . '").show();

																							},
																							error: function(){
																								alert("Chiamata fallita, si prega di riprovare...");
																							}
																						});
																					}
																				});
																			});
																	</script>
																	<div class="modal fade" id="modify_modal_persone_' . $n . '_' . $campo['Id'] . '"  role="dialog" aria-labelledby="myModalLabel">
																			<div class="modal-dialog" role="document">
																			<div class="modal-content">
																				<div class="modal-header">
																				<h5 class="modal-title" id="myModalLabel">Inserisci i dati per il calcolo il prezzo del servizio</h5>
																				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

																				</div>
																				<div class="modal-body">
																					<div class="row">
																						<div class="col-md-4">
																						<div class="form-group">
																								<label for="prezzo' . $n . '_' . $campo['Id'] . '">Prezzo Servizio</label>
																								<input type="text" id="prezzo' . $n . '_' . $campo['Id'] . '" name="prezzo' . $n . '_' . $campo['Id'] . '" class="form-control" value="' . $campo['PrezzoServizio'] . '" readonly />
																							</div>
																						</div>
																						<div class="col-md-4">
																							<div class="form-group">
																									<label for="Nnotti' . $n . '_' . $campo['Id'] . '">Numero Giorni</label>
																									<select id="Nnotti' . $n . '_' . $campo['Id'] . '" name="Nnotti' . $n . '_' . $campo['Id'] . '"  class="form-control" >
																										<option value="1">1</option>
																										<option value="2">2</option>
																										<option value="3">3</option>
																										<option value="4">4</option>
																										<option value="5">5</option>
																										<option value="6">6</option>
																										<option value="7">7</option>
																										<option value="8">8</option>
																										<option value="9">9</option>
																										<option value="10">10</option>
																										<option value="11">11</option>
																										<option value="12">12</option>
																										<option value="13">13</option>
																										<option value="14">14</option>
																										<option value="15">15</option>
																										<option value="16">16</option>
																										<option value="17">17</option>
																										<option value="18">18</option>
																										<option value="19">19</option>
																										<option value="20">20</option>
																										<option value="21">21</option>
																										<option value="22">22</option>
																										<option value="23">23</option>
																										<option value="24">24</option>
																										<option value="25">25</option>
																										<option value="26">26</option>
																										<option value="27">27</option>
																										<option value="28">28</option>
																										<option value="29">29</option>
																										<option value="30">30</option>
																									</select>
																								</div>
																						</div>
																						<div class="col-md-4">
																							<div class="form-group">
																									<label class="f-11 nowrap">' . $campo['TipoServizio'] . ' a persona</label>
																									<select id="NPersone' . $n . '_' . $campo['Id'] . '" name="NPersone' . $n . '_' . $campo['Id'] . '" class="form-control" >
																										<option value="" selected="selected">--</option>
																										<option value="1">1</option>
																										<option value="2">2</option>
																										<option value="3">3</option>
																										<option value="4">4</option>
																										<option value="5">5</option>
																										<option value="6">6</option>
																										<option value="7">7</option>
																										<option value="8">8</option>
																										<option value="9">9</option>
																										<option value="10">10</option>
																										<option value="11">11</option>
																										<option value="12">12</option>
																										<option value="13">13</option>
																										<option value="14">14</option>
																										<option value="15">15</option>
																										<option value="16">16</option>
																										<option value="17">17</option>
																										<option value="18">18</option>
																										<option value="19">19</option>
																										<option value="20">20</option>
																										<option value="21">21</option>
																										<option value="22">22</option>
																										<option value="23">23</option>
																										<option value="24">24</option>
																										<option value="25">25</option>
																										<option value="26">26</option>
																										<option value="27">27</option>
																										<option value="28">28</option>
																										<option value="29">29</option>
																										<option value="30">30</option>
																										<option value="31">31</option>
																										<option value="32">32</option>
																										<option value="33">33</option>
																										<option value="34">34</option>
																										<option value="35">35</option>
																										<option value="36">36</option>
																										<option value="37">37</option>
																										<option value="38">38</option>
																										<option value="39">39</option>
																										<option value="40">40</option>
																										<option value="41">41</option>
																										<option value="42">42</option>
																										<option value="43">43</option>
																										<option value="44">44</option>
																										<option value="45">45</option>
																										<option value="46">46</option>
																										<option value="47">47</option>
																										<option value="48">48</option>
																										<option value="48">49</option>
																										<option value="50">50</option>
																									</select>
																								</div>
																						</div>
																					</div>
																					<div class="row">
																						<div class="col-md-12 text-center">
																							<input type="hidden" id="id_servizio' . $n . '_' . $campo['Id'] . '" name="id_servizio' . $n . '_' . $campo['Id'] . '" value="' . $campo['Id'] . '">
																							<button type="button" class="btn btn-primary btn-sm" id="send_re_calc' . $n . '_' . $campo['Id'] . '" data-dismiss="modal" aria-label="Close">Calcola prezzo servizio</button>
																						</div>
																					</div>
																					<script>
																						$(document).ready(function() {
																								$("#modify_modal_persone_' . $n . '_' . $campo['Id'] . '").on("show.bs.modal", function (event) {
																									var button = $(event.relatedTarget);
																									var xnotti = button.data("notti");
																									var prezzo = button.data("prezzo");
																									var id_servizio = button.data("id_servizio");
																									var modal = $(this);
																									modal.find(".modal-body select#Nnotti' . $n . '_' . $campo['Id'] . '").val(xnotti);
                                                                                                    modal.find(".modal-body select#NPersone' . $n . '_' . $campo['Id'] . '").val($("#NumeroAdulti").val());
																									modal.find(".modal-body input#prezzo' . $n . '_' . $campo['Id'] . '").val(prezzo);
																									modal.find(".modal-body input#id_servizio' . $n . '_' . $campo['Id'] . '").val(id_servizio);
																								});
																								$("#send_re_calc' . $n . '_' . $campo['Id'] . '").on("click",function(){
																									var idsito        = ' . IDSITO . ';
																									var n_proposta    = ' . $n . ';
																									var id_servizio   = $("#id_servizio' . $n . '_' . $campo['Id'] . '").val();
																									var notti         = $("#Nnotti' . $n . '_' . $campo['Id'] . '").val();
																									var prezzo        = $("#prezzo' . $n . '_' . $campo['Id'] . '").val();
																									var NPersone      = $("#NPersone' . $n . '_' . $campo['Id'] . '").val();
																									$.ajax({
																										type: "POST",
																										url: "' . BASE_URL_SITO . 'ajax/calcoli/calc_prezzo_serv_a_persona.php",
																										data: "action=re_calc&notti=" + notti + "&prezzo=" + prezzo + "&NPersone=" + NPersone + "&n_proposta=" + n_proposta + "&id_servizio=" + id_servizio + "&idsito=" + idsito,
																										dataType: "html",
																										success: function(data){
																											$("#valori_serv_' . $n . '_' . $campo['Id'] . '").html(data);
																											$("#pulsante_calcola_' . $n . '_' . $campo['Id'] . '").hide();
																											$("input[data-tipo=persone' . $n . '_' . $campo['Id'] . ']").remove();
																											$("input[data-tipo=notti' . $n . '_' . $campo['Id'] . ']").remove();
																											calcola_totale' . $n . '();
																										},
																										error: function(){
																											alert("Chiamata fallita, si prega di riprovare...");
																										}
																									});

																							});

																						});
																					</script>

																				</div>
																			</div>
																		</div>
																	</div>
																	</td>
																	<td class="td5">
																	' . ($IdServizio[$campo['Id']] == 1 ? '
																		<i class="fa fa-remove text-orange" id="remove_service' . $recrel['id_relazionale'] . '" style="cursor:pointer" data-toogle="tooltip" data-html="true" title="Se cliccate sulla <b class=\'text-orange\'>X</b> eliminate la scelta del servizio, per <b>riattivarla</b> dovete prima salvare la modifica e riaprire il preventivo per riattivare il servizio stesso!" ></i>
																		<script>
																		$(document).ready(function() {
																			$("#contenitore_switchery' . $recrel['id_relazionale'] . ' .switchery").addClass("switchery-opacity");
																			$("#remove_service' . $recrel['id_relazionale'] . '").on("click",function(){
																				if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo servizio dal preventivo?")){
																					var idsito   = ' . IDSITO . ';
																					var n_prop   = ' . $n . ';
																					var id_serv  = ' . $recrel['id_relazionale'] . ';
																					$.ajax({
																						type: "POST",
																						url: "' . BASE_URL_SITO . 'ajax/remove_serv.php",
																						data: "action=remove_serv&n_prop=" + n_prop + "&id_serv=" + id_serv + "&idsito=" + idsito,
																						dataType: "html",
																						success: function(data){

																							$("#PrezzoServizio' . $n . '_' . $campo['Id'] . '").prop("checked",false);
																							$("#contenitore_switchery' . $recrel['id_relazionale'] . ' .switchery").removeClass("switchery-opacity");
																							$("#contenitore_switchery' . $recrel['id_relazionale'] . ' .switchery").addClass("switchery-off");
																							$("#contenitore_switchery' . $recrel['id_relazionale'] . ' .switchery small").addClass("small-switchery-off");
                                                                                            location.reload();
																						},
																						error: function(){
																							alert("Chiamata fallita, si prega di riprovare...");
																						}
																					});
																				}
																			});
																		});
																		</script>
																	' : '') . '
																	</td>
																</tr>';

            }
            $lista_servizi_aggiuntivi .= '               </table>
														</div>
													</div>
												</td>
											</tr> ';
        }

        return $lista_servizi_aggiuntivi;
    }

    public function dati_caparra($idsito)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_acconto_pagamenti WHERE idsito = " . $idsito;
        $res = $dbMysqli->query($select);
        $rw = $res[0];

        $Acc = $rw['Acconto'];

        $AccontoRichiesta .= '<option value="" ' . ($Acc == '' ? 'selected="selected"' : '') . '>--</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="importo" ' . ($Acc == 'importo' ? 'selected="selected"' : '') . '>Importo</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="garanzia" ' . ($Acc == 'garanzia' ? 'selected="selected"' : '') . '>Carta Credito a garanzia</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="5" ' . ($Acc == '5' ? 'selected="selected"' : '') . '>5%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="10" ' . ($Acc == '10' ? 'selected="selected"' : '') . '>10%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="15" ' . ($Acc == '15' ? 'selected="selected"' : '') . '>15%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="20" ' . ($Acc == '20' ? 'selected="selected"' : '') . '>20%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="25" ' . ($Acc == '25' ? 'selected="selected"' : '') . '>25%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="30" ' . ($Acc == '30' ? 'selected="selected"' : '') . '>30%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="40" ' . ($Acc == '40' ? 'selected="selected"' : '') . '>40%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="50" ' . ($Acc == '50' ? 'selected="selected"' : '') . '>50%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="60" ' . ($Acc == '60' ? 'selected="selected"' : '') . '>60%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="70" ' . ($Acc == '70' ? 'selected="selected"' : '') . '>70%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="80" ' . ($Acc == '80' ? 'selected="selected"' : '') . '>80%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="90" ' . ($Acc == '90' ? 'selected="selected"' : '') . '>90%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="100" ' . ($Acc == '100' ? 'selected="selected"' : '') . '>100%</option>' . "\r\n";

        return $AccontoRichiesta;
    }
    public function get_dati_caparra($idsito, $Acconto)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_acconto_pagamenti WHERE idsito = " . $idsito;
        $res = $dbMysqli->query($select);
        $rw = $res[0];
        $Acc = $rw['Acconto'];
        if ($Acconto == '') {
            $Acconto = $Acc;
        }
        $AccontoRichiesta .= '<option value="" ' . ($Acconto == '' ? 'selected="selected"' : '') . '>--</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="importo" ' . ($Acconto == 'importo' ? 'selected="selected"' : '') . '>importo</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="garanzia" ' . ($Acconto == 'garanzia' ? 'selected="selected"' : '') . '>Carta Credito a garanzia</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="10" ' . ($Acconto == '10' ? 'selected="selected"' : '') . '>10%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="15" ' . ($Acconto == '15' ? 'selected="selected"' : '') . '>15%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="20" ' . ($Acconto == '20' ? 'selected="selected"' : '') . '>20%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="25" ' . ($Acconto == '25' ? 'selected="selected"' : '') . '>25%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="30" ' . ($Acconto == '30' ? 'selected="selected"' : '') . '>30%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="40" ' . ($Acconto == '40' ? 'selected="selected"' : '') . '>40%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="50" ' . ($Acconto == '50' ? 'selected="selected"' : '') . '>50%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="60" ' . ($Acconto == '60' ? 'selected="selected"' : '') . '>60%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="70" ' . ($Acconto == '70' ? 'selected="selected"' : '') . '>70%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="80" ' . ($Acconto == '80' ? 'selected="selected"' : '') . '>80%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="90" ' . ($Acconto == '90' ? 'selected="selected"' : '') . '>90%</option>' . "\r\n";
        $AccontoRichiesta .= '<option value="100" ' . ($Acconto == '100' ? 'selected="selected"' : '') . '>100%</option>' . "\r\n";

        return $AccontoRichiesta;
    }
    public function lista_tariffe($idsito, $Lingua)
    {
        global $dbMysqli;

        $select = "SELECT hospitality_condizioni_tariffe_lingua.* FROM hospitality_condizioni_tariffe_lingua
								INNER JOIN hospitality_condizioni_tariffe ON hospitality_condizioni_tariffe.id = hospitality_condizioni_tariffe_lingua.id_tariffe
								WHERE hospitality_condizioni_tariffe_lingua.Lingua = '" . $Lingua . "'
								AND hospitality_condizioni_tariffe.idsito = " . $idsito . "
								ORDER BY hospitality_condizioni_tariffe_lingua.tariffa ASC";
        $row = $dbMysqli->query($select);
        if (sizeof($row) > 0) {
            $ListaTariffe .= '<option value="">scegli</option>';
            foreach ($row as $chiave => $valore) {
                $ListaTariffe .= '<option value="' . $valore['tariffa'] . '" data-id="' . $valore['id'] . '" >' . $valore['tariffa'] . '</option>';
            }
        } else {
            $ListaTariffe = '';
        }

        return $ListaTariffe;
    }

    public function lista_servizi_aggiuntivi($idsito)
    {
        global $dbMysqli;

        $query = "	SELECT
							hospitality_tipo_servizi.*
						FROM
							hospitality_tipo_servizi
						WHERE
							hospitality_tipo_servizi.idsito = " . $idsito . "
						AND
							hospitality_tipo_servizi.Lingua = 'it'
						AND
							hospitality_tipo_servizi.Abilitato = 1
						ORDER BY
							hospitality_tipo_servizi.Ordine ASC";
        $record = $dbMysqli->query($query);
        if (sizeof($record) > 0) {
            $lista .= '<option value=""></option>';
            foreach ($record as $key => $value) {
                $lista .= '<option value="' . $value['Id'] . '">' . $value['TipoServizio'] . '</option>';
            }
        } else {
            $lista = '';
        }
        return $lista;
    }

    public function getlastid($tabella)
    {
        global $dbMysqli;

        $select = "SELECT MAX(id) as Id FROM $tabella";
        $dato = $dbMysqli->query($select);
        $newid = $dato[0]['Id'];
        return ($newid);
    }
    public function new_Npreno($tabella, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT  NumeroPrenotazione FROM $tabella WHERE idsito =" . $idsito . " ORDER BY NumeroPrenotazione DESC";
        $dato = $dbMysqli->query($select);
        $newN = $dato[0]['NumeroPrenotazione'] + 1;
        return ($newN);
    }

    public function get_tipo_pagamenti($idsito)
    {
        global $dbMysqli;

        $sel = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Ordine ASC";
        $rec = $dbMysqli->query($sel);

        if (sizeof($rec) > 0) {

            $TipiPagamento .= '<ul class="menu_pagamenti">';

            foreach ($rec as $ch => $vl) {

                $TipiPagamento .= '
								' . ($vl['TipoPagamento'] == 'Carta di Credito' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'Carta di Credito' ? 'checked="checked"' : '') . ' name="CC"> <b>Carta di Credito</b></li>' : '') . '
								' . ($vl['TipoPagamento'] == 'Bonifico Bancario' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'Bonifico Bancario' ? 'checked="checked"' : '') . ' name="BB"> <b>Bonifico Bancario</b></li>' : '') . '
								' . ($vl['TipoPagamento'] == 'Vaglia Postale' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'Vaglia Postale' ? 'checked="checked"' : '') . ' name="VP"> <b>Vaglia Postale</b></li>' : '') . '
								' . ($vl['TipoPagamento'] == 'PayPal' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'PayPal' ? 'checked="checked"' : '') . ' name="PP"> <b>PayPal</b></li>' : '') . '
								';
            }
            $TipiPagamento .= '</ul>';
            $TipiPagamento .= '<div class="clearfix  m-t-10"></div>';
            $TipiPagamento .= '<ul class="menu_pagamenti">';

            foreach ($rec as $ch => $vl) {

                $TipiPagamento .= '
								' . ($vl['TipoPagamento'] == 'Gateway Bancario' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'Gateway Bancario' ? 'checked="checked"' : '') . ' name="GB"> <b>Gateway Bancario</b></li>' : '') . '
								' . ($vl['TipoPagamento'] == 'Gateway Bancario Virtual Pay' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'Gateway Bancario Virtual Pay' ? 'checked="checked"' : '') . ' name="GBVP"> <b>Virtual Pay</b></li>' : '') . '
								' . ($vl['TipoPagamento'] == 'Stripe' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'Stripe' ? 'checked="checked"' : '') . ' name="GBS" id="GBS"> <b>Stripe</b></li>' : '') . '
								' . ($vl['TipoPagamento'] == 'Nexi' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'Nexi' ? 'checked="checked"' : '') . ' name="GBNX"> <b>Nexi</b></li>' : '') . '
								';
            }

            $TipiPagamento .= '</ul>';
            $TipiPagamento .= '	<div class="row p-t-10">
										<div class="col-md-4"></div>
										<div class="col-md-4"><input style="display:none" class="form-control" placeholder="Copia ed incolla il link creato da STRIPE" type="text" name="linkStripe" id="linkStripe"></div>
										<div class="col-md-4"></div>
									</div>';
            $TipiPagamento .= '  <script>
									$(document).ready(function(){
										if($("#GBS").is(":checked")==true){
											$("#linkStripe").show();
										}else{
											$("#linkStripe").hide();
										}
										$( "#GBS" ).on( "change", function() {
											$("#linkStripe").slideToggle();
										});

									});
								</script>';

        }
        return $TipiPagamento;
    }

    public function get_prefissi()
    {
        global $dbMysqli;

        $select = "SELECT * FROM prefissi ORDER BY nazione ASC";
        $rows = $dbMysqli->query($select);
        foreach ($rows as $ch => $val) {
            switch ($Lingua) {
                case "it":
                    $lingua_estesa = 'ITALY';
                    break;
                case "en":
                    $lingua_estesa = 'UNITED KINGDOM';
                    break;
                case "fr":
                    $lingua_estesa = 'FRANCE';
                    break;
                case "de":
                    $lingua_estesa = 'GERMANY';
                    break;
                default:
                    $lingua_estesa = 'ITALY';
                    break;
            }
            $ListaPrefissi .= '<option value="' . $val['prefisso'] . '" ' . ($_REQUEST['PrefissoInternazionale'] == $val['prefisso'] ? 'selected="selected"' : '') . '' . ($lingua_estesa == trim($val['nazione']) ? 'selected="selected"' : '') . '>' . ucwords(strtolower($val['nazione'])) . ' +' . $val['prefisso'] . ' </option>';
        }
        return $ListaPrefissi;

    }
    public function get_var_prefissi($prefisso, $Lingua)
    {
        global $dbMysqli;

        $select = "SELECT * FROM prefissi ORDER BY nazione ASC";
        $rows = $dbMysqli->query($select);
        foreach ($rows as $ch => $val) {
            switch ($Lingua) {
                case "it":
                    $lingua_estesa = 'ITALY';
                    break;
                case "en":
                    $lingua_estesa = 'UNITED KINGDOM';
                    break;
                case "fr":
                    $lingua_estesa = 'FRANCE';
                    break;
                case "de":
                    $lingua_estesa = 'GERMANY';
                    break;
                default:
                    $lingua_estesa = 'ITALY';
                    break;
            }

            $ListaPrefissi .= '<option value="' . $val['prefisso'] . '" ' . ($val['prefisso'] == $prefisso ? 'selected="selected"' : ($lingua_estesa == trim($val['nazione']) ? 'selected="selected"' : '')) . '>' . ucwords(strtolower($val['nazione'])) . ' +' . $val['prefisso'] . ' </option>';
        }
        return $ListaPrefissi;

    }

    /**
     * check_parity
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_parity($idsito)
    {
        global $dbMysqli;
        $Tcheck = array();
        $check = '';
        $Qcheck = "SELECT * FROM hospitality_parityrate WHERE idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
        $Qquery = $dbMysqli->query($Qcheck);
        $Tcheck = sizeof($Qquery);
        if ($Tcheck > 0) {
            $check = 1;
        } else {
            $check = 0;
        }

        return $check;
    }

    public function check_camere_parity($idsito)
    {
        global $dbMysqli;
        $select = "SELECT * FROM hospitality_parity_camere WHERE idsito = " . $idsito;
        $res = $dbMysqli->query($select);
        $check_type = sizeof($res);
        if ($check_type > 0) {
            $check = 1;
        } else {
            $check = 0;
        }
        return $check;
    }

    public function check_soggiorni_parity($idsito)
    {
        global $dbMysqli;
        $select = "SELECT * FROM hospitality_parity_trattamenti WHERE idsito = " . $idsito;
        $res = $dbMysqli->query($select);
        $check_type = sizeof($res);
        if ($check_type > 0) {
            $check = 1;
        } else {
            $check = 0;
        }
        return $check;
    }

    public function check_listino_parity($idsito)
    {
        global $dbMysqli;
        $select = "SELECT * FROM hospitality_numero_listini WHERE idsito = " . $idsito . " AND Listino LIKE '%ParityRate%' AND Parity = 1 AND Abilitato = 1";
        $res = $dbMysqli->query($select);
        $check_type = sizeof($res);
        if ($check_type > 0) {
            $check = 1;
        } else {
            $check = 0;
        }
        return $check;
    }

    public function check_data_syncro_listino_parity($idsito)
    {
        global $dbMysqli;

        $s = "SELECT * FROM hospitality_data_syncro_listino_parity WHERE idsito = " . $idsito . "  ORDER BY id DESC LIMIT 1";
        $r = $dbMysqli->query($s);
        $tot = sizeof($r);

        if ($tot > 0) {

            $w = $r[0];

            $parity = $this->check_parity($idsito);

            if ($parity == 1) {

                $output = '	<div class="alert alert-info text-black">
								<i class="fa fa-exclamation-circle text-info fa-2x fa-fw" aria-hidden="true"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<ul>
									<li><b>SINCRO PARITY RATE:</b></li>
									<li>Ultima Data sincronizzazione listino: <b>' . $this->gira_data($w['data']) . '</b></li>
									<li>LEGENDA CRON DI SINCRONIZZAZIONE:
										<ol>
											<li>Il controllo per la sincronizzazione <b>passa ogni ORA di tutti i giorni al 15esimo minuto</b>!</li>
											<li>La richiesta di sincronizzazione prezzi ha le date impostate che vanno dalla <b>data odierna</b> (oggi) alla <b>data di scadenza</b> del vostro contratto QUOTO!</li>
											<li>Se la scansione nota che non ci sono righe presenti nel listino compie una operazione di <b>inserimento</b>, altrimenti se sono presenti ne compie la <b>modifica</b>!</li>
										</ol>
									</li>
								</ul>
							</div>';
            } else {
                $output = '';
            }
        } else {
            $output = '';
        }
        return $output;
    }

    public function syncro_preno_parity($idsito)
    {
        global $dbMysqli;

        $qry = "SELECT * FROM hospitality_parityrate  WHERE idsito = " . $idsito . " AND Abilitato = 1 LIMIT 1";
        $sq = $dbMysqli->query($qry);
        $tot = sizeof($sq);

        if ($tot > 0) {

            $imap = $sq[0];

            $ParityButton .= '
									<div id="parity"><div  class="text-right"><a href="#" class="btn bg-info btn-xs" id="CheckBtnParity"><img src="https://' . $_SERVER["HTTP_HOST"] . '/img/logoRC.png" style="width:20px;height:9px"/> Syncro con ParityRate</a></div>
										<div id="pul_parity_hide"></div>
										<script>
										$(document).ready(function() {
											if(leggiCookie(\'syncro_parity' . $idsito . '\')) {
												$("#CheckBtnParity").css(\'display\',\'none\');
												$("#pul_parity_hide").html(\'<div class="row"><div class="col-md-2"></div><div class="col-md-8"><div class="alert alert-info"><div class="text-center"><small class="text-left"> <b>Una volta cliccato su "<img src="https://' . $_SERVER["HTTP_HOST"] . '/img/logoRC.png" style="width:20px;height:9px"/> Syncro con ParityRate",  il pulsante  scompare! Ogni 15 min  il Channel Manager sincronizzerà le prenotazioni.<br> Una volta sincronizzate dopo qualche minuto il pulsante tornerà visibile, se non dovesse accadere automaticamente potete usufruire della funzione manualmente cliccando qui sotto!</b></small></div></div><div class="col-md-2"></div></div>\');
												$("#check_pul").html(\'<div class="text-center text-info"><span style="cursor:pointer">CLICCA QUI <i class="fa fa-refresh"></i> per controllare se puoi ri-sincronizzare</span></div><br><br>\');
											}else{
												$("#pul_parity_hide").hide();
												$("#check_pul").hide();
											}
											$(\'#CheckBtnParity\').click(function(){
													scriviCookie(\'syncro_parity' . $idsito . '\',\'parityrate\',\'3\');
													$("#CheckBtnParity").css(\'display\',\'none\');
													$("#ctrl_parity").html(\'<div class="text-right"><img src="' . BASE_URL_SITO . 'img/loader.gif" style="max-width:100%;"/></div>\');
													var idsito   = ' . $idsito . ';
													$.ajax({
														type: "POST",
														url: "' . BASE_URL_SITO . 'ajax/pms/syncro_preno_parity.php",
														data: "idsito=" + idsito,
														dataType: "html",
														success: function(data){
															$("#ctrl_parity").html(\'<div class="text-right"><small class="text-info"><b>Sincronizzazione effettuata!!</b></small></div>\');
																setTimeout(function(){
																		location.reload();
																},2000);
														},
														error: function(){
															alert("Chiamata fallita, si prega di riprovare...");
														}
													});
											});
										});
										</script>
										<div id="ctrl_parity"></div>
										</div>
										<div id="check_pul"></div>';

            $ParityButton .= '  <script>
											$(document).ready(function() {

												$("#check_pul").on("click",function(){

													var minute_now = new Date().getMinutes();
													console.log(minute_now);

													if(minute_now >= "0" && minute_now < "1"){
														var check_controll_click = false;
													}else if(minute_now >= "15" && minute_now < "16"){
														var check_controll_click = false;
													}else if(minute_now >= "30" && minute_now < "31"){
														var check_controll_click = false;
													}else if(minute_now >= "45" && minute_now < "46"){
														var check_controll_click = false;
													}else{
														var check_controll_click = true;
													}

													if(check_controll_click == true){
														if(leggiCookie(\'syncro_parity' . $idsito . '\')) {
															console.log("il cookie esiste ancora!");
															alert("Tempo ancora utile a ParityRate per la sincronizzazione!");
														}else{
															location.reload();
														}
													}else{
														console.log("Orario utile a RoomCloud per la chiamata, riprovare tra qualche istante!");
														alert("Orario ancora utile a ParityRate per la sincronizzazione delle prenotazione, riprovare tra qualche istante!");
													}
												});
											});
										</script>';

        }
        return $ParityButton;
    }

    public function check_nome_template_by_id($id_template, $idsito)
    {
        global $dbMysqli;

        $sel = "SELECT TemplateName,TemplateType FROM hospitality_template_background  WHERE Id = " . $id_template . " AND idsito = " . $idsito . " ";
        $res = $dbMysqli->query($sel);
        $tot = sizeof($res);

        if ($tot > 0) {
            $record = $res[0];
            $output = $record;
        } else {
            $output = '';
        }

        return $output;
    }
    public function check_nome_template_default($idsito)
    {
        global $dbMysqli;
        $sel = "   SELECT Template FROM hospitality_template_landing  WHERE idsito = " . $idsito . " ";
        $res = $dbMysqli->query($sel);
        $tot = sizeof($res);

        if ($tot > 0) {
            $record = $res[0];
            $output = $record;
        }

        return $output;
    }
    public function lista_infoBox($idsito)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_info_box WHERE idsito = " . $idsito . " AND Abilitato = 1";
        $res = $dbMysqli->query($select);

        return $res;
    }

    public function check_control_modify($idsito, $id_richiesta, $operatore)
    {
        global $dbMysqli;

        $selectCheck = "SELECT * FROM hospitality_check_modifica WHERE idsito = " . $idsito . " AND id_richiesta = " . $id_richiesta . "  ORDER BY data_ora DESC";
        $resultCheck = $dbMysqli->query($selectCheck);
        $check = sizeof($resultCheck);
        $recordCheck = $resultCheck[0];
        if ($check == 0) {
            $insertCheckOp = "INSERT INTO hospitality_check_modifica(idsito,id_richiesta,operatore,data_ora) VALUES('" . $idsito . "','" . $id_richiesta . "','" . addslashes($operatore) . "','" . date('Y-m-d H:s:i') . "')";
            $dbMysqli->query($insertCheckOp);
        } else {
            $selectCheckOp = "SELECT * FROM hospitality_check_modifica WHERE idsito = " . $idsito . " AND id_richiesta = " . $id_richiesta . " AND operatore = '" . addslashes($operatore) . "' ORDER BY data_ora DESC";
            $resultCheckOp = $dbMysqli->query($selectCheckOp);
            $checkOp = sizeof($resultCheckOp);
            $recordCheckOp = $resultCheckOp[0];

            if ($checkOp == 0) {

                return '  <script>
								$(function() {
									$.notify({
										title:    \'La proposta è in fase di modifica!\',
										body:     \'<b class="text-danger">ATTENZIONE:</b><br> impossibile modificare, in quanto è già in uso da operatore <b>' . $recordCheck['operatore'] . '</b>!\',
										icon:     \'fa fa-exclamation\',
										position: \'top-center\',
										timeout: 10000,
										showTime: 100,
										forever: true
									});
								});
							</script>' . "\r\n";

            }
        }

    }

    public function get_modify($id)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_guest WHERE Id = " . $id;
        $result = $dbMysqli->query($select);
        if (sizeof($result) > 0) {
            $dati = $result[0];
        } else {
            $dati = '';
        }

        return $dati;

    }

    public function get_template($idsito, $idTemplate)
    {
        global $dbMysqli;

        $select = "SELECT TemplateName FROM hospitality_template_background WHERE Id = " . $idTemplate . " AND idsito = " . $idsito;
        $result = $dbMysqli->query($select);
        $row = $result[0];
        $nomeTemplate = $row['TemplateName'];

        return $nomeTemplate;

    }

    public function get_lista_template($idsito, $idTemplate)
    {
        global $dbMysqli;

        $ListaTemplate = '';

        $select = "	SELECT
						hospitality_template_background.TemplateName,
						hospitality_template_background.Thumb,
						hospitality_template_background.Id as idTempBk
					FROM
						hospitality_template_background
					WHERE
						hospitality_template_background.idsito = " . $idsito . "
                    AND
                        hospitality_template_background.Visibile = 1
					ORDER BY
						hospitality_template_background.Ordine
                    ASC";
        $rwt = $dbMysqli->query($select);

        foreach ($rwt as $kt => $vt) {
            $sel = "SELECT * FROM hospitality_template_landing WHERE idsito = " . $idsito . " LIMIT 1";
            $rt = $sel[0];

            $ListaTemplate .= '<option data-img-src="' . BASE_URL_SITO . 'img/' . $vt['Thumb'] . '" data-img-label="' . $vt['TemplateName'] . '" value="' . $vt['idTempBk'] . '" ' . (($idTemplate == $vt['idTempBk']) || ($rt['Template'] == $vt['TemplateName']) ? 'selected="selected"' : '') . '>' . $vt['TemplateName'] . '</option>';
        }

        return $ListaTemplate;
    }

    public function sel_tipo_pagamenti($idsito, $Id)
    {
        global $dbMysqli;
        // Query e ciclo per estrapolare i tipi di pagamento
        $sel2 = "SELECT * FROM hospitality_rel_pagamenti_preventivi WHERE idsito = " . $idsito . " AND id_richiesta = " . $Id . "";
        $ris2 = $dbMysqli->query($sel2);
        $rec2 = $ris2[0];

        $sel = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Ordine ASC";
        $rec = $dbMysqli->query($sel);

        if (sizeof($rec) > 0) {

            if (sizeof($ris2) == 0) {

                $TipiPagamento .= '<ul class="menu_pagamenti">';

                foreach ($rec as $ch => $vl) {

                    $TipiPagamento .= '
											' . ($vl['TipoPagamento'] == 'Carta di Credito' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'Carta di Credito' ? 'checked="checked"' : '') . ' name="CC"> <b>Carta di Credito</b></li>' : '') . '
											' . ($vl['TipoPagamento'] == 'Bonifico Bancario' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'Bonifico Bancario' ? 'checked="checked"' : '') . ' name="BB"> <b>Bonifico Bancario</b></li>' : '') . '
											' . ($vl['TipoPagamento'] == 'Vaglia Postale' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'Vaglia Postale' ? 'checked="checked"' : '') . ' name="VP"> <b>Vaglia Postale</b></li>' : '') . '
											' . ($vl['TipoPagamento'] == 'PayPal' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'PayPal' ? 'checked="checked"' : '') . ' name="PP"> <b>PayPal</b></li>' : '') . '
											';
                }
                $TipiPagamento .= '</ul>';
                $TipiPagamento .= '<div class="clearfix  m-t-10"></div>';
                $TipiPagamento .= '<ul class="menu_pagamenti">';

                foreach ($rec as $ch => $vl) {

                    $TipiPagamento .= '
											' . ($vl['TipoPagamento'] == 'Gateway Bancario' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'Gateway Bancario' ? 'checked="checked"' : '') . ' name="GB"> <b>Gateway Bancario</b></li>' : '') . '
											' . ($vl['TipoPagamento'] == 'Gateway Bancario Virtual Pay' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'Gateway Bancario Virtual Pay' ? 'checked="checked"' : '') . ' name="GBVP"> <b>Virtual Pay</b></li>' : '') . '
											' . ($vl['TipoPagamento'] == 'Stripe' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'Stripe' ? 'checked="checked"' : '') . ' name="GBS" id="GBS"> <b>Stripe</b></li>' : '') . '
											' . ($vl['TipoPagamento'] == 'Nexi' ? '<li><input type="checkbox" class="" value="1" ' . ($vl['TipoPagamento'] == 'Nexi' ? 'checked="checked"' : '') . ' name="GBNX"> <b>Nexi</b></li>' : '') . '
											';
                }

                $TipiPagamento .= '</ul>';

            } else {

                $TipiPagamento .= '<ul class="menu_pagamenti">';

                foreach ($rec as $ch => $vl) {

                    $TipiPagamento .= '
											' . ($vl['TipoPagamento'] == 'Carta di Credito' ? '<li><input type="checkbox" class="" value="1" ' . ($rec2['CC'] == 1 ? 'checked="checked"' : '') . ' name="CC"> <b>Carta di Credito</b></li>' : '') . '
											' . ($vl['TipoPagamento'] == 'Bonifico Bancario' ? '<li><input type="checkbox" class="" value="1" ' . ($rec2['BB'] == 1 ? 'checked="checked"' : '') . ' name="BB"> <b>Bonifico Bancario</b></li>' : '') . '
											' . ($vl['TipoPagamento'] == 'Vaglia Postale' ? '<li><input type="checkbox" class="" value="1" ' . ($rec2['VP'] == 1 ? 'checked="checked"' : '') . ' name="VP"> <b>Vaglia Postale</b></li>' : '') . '
											' . ($vl['TipoPagamento'] == 'PayPal' ? '<li><input type="checkbox" class="" value="1" ' . ($rec2['PP'] == 1 ? 'checked="checked"' : '') . ' name="PP"> <b>PayPal</b></li>' : '') . '
											';
                }
                $TipiPagamento .= '</ul>';
                $TipiPagamento .= '<div class="clearfix  m-t-10"></div>';
                $TipiPagamento .= '<ul class="menu_pagamenti">';

                foreach ($rec as $ch => $vl) {

                    $TipiPagamento .= '
											' . ($vl['TipoPagamento'] == 'Gateway Bancario' ? '<li><input type="checkbox" class="" value="1" ' . ($rec2['GB'] == 1 ? 'checked="checked"' : '') . ' name="GB"> <b>Gateway Bancario</b></li>' : '') . '
											' . ($vl['TipoPagamento'] == 'Gateway Bancario Virtual Pay' ? '<li><input type="checkbox" class="" value="1" ' . ($rec2['GBVP'] == 1 ? 'checked="checked"' : '') . ' name="GBVP"> <b>Virtual Pay</b></li>' : '') . '
											' . ($vl['TipoPagamento'] == 'Stripe' ? '<li><input type="checkbox" class="" value="1" ' . ($rec2['GBS'] == 1 ? 'checked="checked"' : '') . ' name="GBS" id="GBS"> <b>Stripe</b></li>' : '') . '
											' . ($vl['TipoPagamento'] == 'Nexi' ? '<li><input type="checkbox" class="" value="1" ' . ($rec2['GBNX'] == 1 ? 'checked="checked"' : '') . ' name="GBNX"> <b>Nexi</b></li>' : '') . '
											';
                }

                $TipiPagamento .= '</ul>';

            }

            $TipiPagamento .= '	<div class="row p-t-10">
										<div class="col-md-4"></div>
										<div class="col-md-4"><input style="display:none" class="form-control" placeholder="Copia ed incolla il link creato da STRIPE" type="text" value="' . $rec2['linkStripe'] . '" name="linkStripe" id="linkStripe"></div>
										<div class="col-md-4"></div>
									</div>';
            $TipiPagamento .= '  <script>
										$(document).ready(function(){
											if($("#GBS").is(":checked")==true){
												$("#linkStripe").show();
											}else{
												$("#linkStripe").hide();
											}
											$( "#GBS" ).on( "change", function() {
												$("#linkStripe").slideToggle();
											});

										});
									</script>';

        }
        return $TipiPagamento;
    }

    public function get_lista_infoBox($idsito, $Id)
    {
        global $dbMysqli;

        $array_InfoB = array();

        $sel = "SELECT * FROM hospitality_rel_infobox_preventivo WHERE idsito = " . $idsito . " AND id_richiesta = " . $Id . "";
        $ris = $dbMysqli->query($sel);
        if(sizeof($ris)>0){
            foreach ($ris as $ky => $val) {
                $array_InfoB[] = $val['id_infobox'];
            }
        }


        $select = "SELECT * FROM hospitality_info_box WHERE idsito = " . $idsito . " AND Abilitato = 1";
        $res = $dbMysqli->query($select);

        if (sizeof($res) > 0) {
            $infoBox = '<option value="">--</option>';
            foreach ($res as $key => $value) {
                $infoBox .= '<option value="' . $value['Id'] . '"  ' . (in_array($value['Id'], $array_InfoB)? 'selected="selected"' : '') . ' >' . $value['Titolo'] . '</option>';
            }

        }
        return $infoBox;
    }

    public function testo_alternativo($idsito, $Id, $Lingua, $id_template, $TipoVacanza, $TipoRichiesta)
    {
        global $dbMysqli;
        // query per testo alternativo landing page
        $select = "SELECT Testo,Id FROM hospitality_contenuti_web_lingua WHERE IdRichiesta = " . $Id . " AND idsito = " . $idsito . " AND Lingua = '" . $Lingua . "' ORDER BY Id DESC";
        $res = $dbMysqli->query($select);
        $vl = $res[0];
        if (is_array($vl)) {
            if ($vl > count($vl)) {
                $tot = count($vl);
            }

        } else {
            $tot = 0;
        }
        if ($tot > 0) {
            $IdTestoAlternativo = $vl['Id'];
            $TestoAlternativo[$IdTestoAlternativo] = $vl['Testo'];
        } else {

            if ($id_template != '') {
                $record_template = $this->check_nome_template_by_id($id_template, $idsito);
                $nome_template_scelto = strtolower($record_template['TemplateName']);
                $tipo_template_scelto = strtoupper($record_template['TemplateType']);
            } else {
                $record_template = $this->check_nome_template_default($idsito);
                $nome_template_scelto = strtolower($record_template['Template']);
            }

            if (strtolower($TipoVacanza) == $nome_template_scelto && $TipoRichiesta == 'Preventivo') {
                // query per testo default landing page
                $sele = "SELECT hospitality_dizionario_lingua.testo FROM hospitality_dizionario
                                INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                                WHERE hospitality_dizionario.idsito = " . $idsito . "
                                AND hospitality_dizionario.etichetta = 'PREVENTIVO_" . $tipo_template_scelto . "'
                                AND hospitality_dizionario_lingua.idsito =  " . $idsito . "
                                AND hospitality_dizionario_lingua.Lingua = '" . $Lingua . "'";
                $re = $dbMysqli->query($sele);
                $v = $re[0];
                $TestoAlternativo[0] = stripslashes($v['testo']);

            } elseif (strtolower($TipoVacanza) == $nome_template_scelto && $TipoRichiesta == 'Conferma') {

                // query per testo default landing page
                $sele = "SELECT hospitality_dizionario_lingua.testo FROM hospitality_dizionario
                                INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                                WHERE hospitality_dizionario.idsito = " . $idsito . "
                                AND hospitality_dizionario.etichetta = 'CONFERMA_" . $tipo_template_scelto . "'
                                AND hospitality_dizionario_lingua.idsito =  " . $idsito . "
                                AND hospitality_dizionario_lingua.Lingua = '" . $Lingua . "'";
                $re = $dbMysqli->query($sele);
                $v = $re[0];
                $TestoAlternativo[0] = stripslashes($v['testo']);

            } else {

                // query per testo default landing page
                $sele = "SELECT Testo FROM hospitality_contenuti_web WHERE TipoRichiesta = '" . $TipoRichiesta . "' AND idsito = " . $idsito . " AND Lingua = '" . $Lingua . "' AND Abilitato = 1";
                $re = $dbMysqli->query($sele);
                $v = $re[0];
                $TestoAlternativo[0] = stripslashes($v['Testo']);

            }

        }

        return $TestoAlternativo;

    }

    public function get_account_analytics($idsito)
    {
        global $dbMysqli;

        $sql = "SELECT IdAccountAnalytics,measurement_id,api_secret FROM siti WHERE idsito = " . $idsito;
        $rs = $dbMysqli->query($sql);
        $rc = $rs[0];

        return $rc;
    }

    public function ckeck_modifica($idsito)
    {
        global $dbMysqli;

        $body = '';
        $etichetta = '';

        $select = "SELECT * FROM utenti_quoto WHERE idsito = ".$idsito;
        $res = $dbMysqli->query($select);
        $count_user = sizeof($res);
        if($count_user <= 1){
            $delete = "DELETE FROM hospitality_check_modifica WHERE idsito = ".$idsito;
            $dbMysqli->query($delete);

            return '  <div class="text-center text-muted f-13">
                        Se non avete creato utenti oltre a quello da <b>SuperUser</b> nella voce <b>"Gestione Permessi"</b> in <b>"Config.Accessi"</b> <br /> lo sblocco delle proposte avviene automaticamente!
                    </div>';
        }else{

            $select = " SELECT
                            hospitality_check_modifica.*
                        FROM
                            hospitality_check_modifica
                        WHERE
                            hospitality_check_modifica.idsito = " . $idsito . "
                        ORDER BY
                            hospitality_check_modifica.id DESC";

            $record = $dbMysqli->query($select);

            if (sizeof($record) > 0) {

                $body .= '<table class="xcrud-list table table-striped table-hover table-bordered f-12" id="tabellaChat">
                            <tr>
                                <th class="text-left  nowrap">Tipo</th>
                                <th class="text-center nowrap">Numero</th>
                                <th class="text-left  nowrap">Operatore</th>
                                <th class="text-center  nowrap">Sblocca</th>
                            </tr>';
                foreach ($record as $key => $value) {

                    $sel = " SELECT
                                        hospitality_guest.TipoRichiesta,
                                        hospitality_guest.NumeroPrenotazione,
                                        hospitality_guest.Chiuso
                                    FROM
                                        hospitality_guest
                                    WHERE
                                        hospitality_guest.idsito = " . $idsito . "
                                    AND
                                        hospitality_guest.id = " . $value['id_richiesta'] . "
                                    ORDER BY
                                        hospitality_guest.Id DESC
                                    LIMIT 1";

                    $rus = $dbMysqli->query($sel);
                    $rec = $rus[0];

                    if ($rec['TipoRichiesta'] == 'Preventivo') {
                        $etichetta = 'Preventivo';
                        $prepos = 'al';
                    } elseif ($rec['TipoRichiesta'] == 'Conferma' && $rec['Chiuso'] == 0) {
                        $etichetta = 'Conferma';
                        $prepos = 'alla';
                    } elseif ($rec['TipoRichiesta'] == 'Conferma' && $rec['Chiuso'] == 1) {
                        $etichetta = 'Prenotazione';
                        $prepos = 'alla';
                    }

                    $body .= '<tr id="SbloccaRiga' . $value['id'] . '">
                                <td class="text-left nowrap">' . $etichetta . '</td>
                                <td class="text-center nowrap"><a href="' . BASE_URL_SITO . 'modifica_proposta/edit/' . $value['id_richiesta'] . '" class="text-info" data-toggle="tooltip" title="Vai ' . $prepos . ' ' . $etichetta . '">N° ' . $rec['NumeroPrenotazione'] . '</a></td>
                                <td class="text-left nowrap">' . $value['operatore'] . '</td>
                                <td class="text-center nowrap">
                                    <a href="javascript:;" id="SbloccaP' . $value['id'] . '"><i class="fa fa-chain-broken"></i></a>
                                    <script>
                                        $(document).ready(function(){
                                            $("#SbloccaP' . $value['id'] . '").on("click",function(){
                                                if (window.confirm("ATTENZIONE: Sicuro di voler sbloccare N° ' . $rec['NumeroPrenotazione'] . '?")){
                                                    $.ajax({
                                                        url: "' . BASE_URL_SITO . 'ajax/generici/sblocca_p.php",
                                                        type: "POST",
                                                        data: "id=' . $value['id'] . '&idsito=' . $value['idsito'] . '&NumeroPrenotazione=' . $rec['NumeroPrenotazione'] . '",
                                                        dataType: "html",
                                                        success: function(data) {
                                                        $(\'#SbloccaRiga' . $value['id'] . '\').remove();
                                                        }
                                                    });
                                                    return false;
                                                }
                                            });
                                        });
                                    </script>
                                </td>
                            </tr>';

                }
                $body .= '</table>';

                return $body;
            } else {
                return 'Nessuna Proposta bloccata!';
            }
        }
    }

    public function utenti_online($idsito, $IdRichiesta)
    {
        global $dbMysqli;
        // utente online
        $now = mktime(date('h'), 0, 0, date('m'), date('d'), date('Y'));
        $trentaMin = mktime(date('h'), (date('i') + 30), 0, date('m'), date('d'), date('Y'));

        $select = "SELECT * FROM hospitality_user_online WHERE online_timestamp != '' AND online_timestamp >= '" . $now . "' AND online_timestamp <= '" . $trentaMin . "' AND IdRichiesta = " . $IdRichiesta . " AND idsito = " . $idsito . "  ORDER BY online_timestamp DESC";
        $execut = $dbMysqli->query($select);
        $online = sizeof($execut);
        if ($online > 0) {
            $user_online = '<i class="fa fa-user text-green Blink" data-toggle="tooltip" title="Utente Online! Controllo temporale per 30 minuti!"></i>';
        } else {
            $user_online = '';
        }
        return $user_online;
    }

    public function check_vista($idsito)
    {
        global $dbMysqli;
        $select = "SELECT ViewIdAnalytics FROM siti WHERE idsito = " . $idsito . "";
        $record_ = $dbMysqli->query($select);
        $record = $record_[0];
        $viewId = $record['ViewIdAnalytics'];
        if ($viewId == '') {
            $output = false;
        } else {
            $output = true;
        }
        return $output;
    }

    public function ControlloTestiInseritiPolitiche($id_politiche, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_politiche_lingua WHERE id_politiche = " . $id_politiche . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    public function ContoTestiPolitiche($id_politiche, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(id) as numero FROM hospitality_politiche_lingua WHERE id_politiche = " . $id_politiche . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function SelectLingue($name, $identificativo, $lingua)
    {

        $select = '<select class="form-control" style="height:auto!important" name="' . $name . '" id="' . $identificativo . '" required>
						<option value="" selected="selected">--</option>
						<option value="it" ' . ($lingua == 'it' ? 'selected="selected"' : '') . '>Italiano</option>
						<option value="en" ' . ($lingua == 'en' ? 'selected="selected"' : '') . '>Inglese</option>
						<option value="fr" ' . ($lingua == 'fr' ? 'selected="selected"' : '') . '>Francese</option>
						<option value="de" ' . ($lingua == 'de' ? 'selected="selected"' : '') . '>Tedesco</option>
					</select>' . "\r\n";

        return $select;

    }

    public function ControlloTestiInseritiMotivazioni($id_motivazione, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue,' ') SEPARATOR ' ') AS lingue FROM hospitality_tipo_voucher_cancellazione_lingua WHERE motivazione_id = " . $id_motivazione . " AND idsito = " . $idsito . " ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    public function ContoTestiMotivazioni($id_motivazione, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_tipo_voucher_cancellazione_lingua WHERE motivazione_id = " . $id_motivazione . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function ControlloTestiInseritiTariffe($id_tariffe, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_condizioni_tariffe_lingua WHERE id_tariffe = " . $id_tariffe . " AND idsito = " . $idsito . " ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    public function ContoTestiTariffe($id_tariffe, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_condizioni_tariffe_lingua WHERE id_tariffe = " . $id_tariffe . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function ControlloTestiInseritiPacchetti($pacchetto_id, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue,' ') SEPARATOR ' ') AS lingue FROM hospitality_tipo_pacchetto_lingua WHERE pacchetto_id = " . $pacchetto_id . " AND idsito = " . $idsito . " ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    public function ContoTestiPacchetti($pacchetto_id, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_tipo_pacchetto_lingua WHERE pacchetto_id = " . $pacchetto_id . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function ControlloTestiInseritiInfoBox($Id_info_box, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_info_box_lang WHERE Id_info_box = " . $Id_info_box . " AND idsito = " . $idsito . " ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    public function ContoTestiInfoBox($Id_info_box, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_info_box_lang WHERE Id_info_box = " . $Id_info_box . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function ControlloTestiInseritiInfoHotel($Id_infohotel, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_infohotel_lang WHERE Id_infohotel = " . $Id_infohotel . " AND idsito = " . $idsito . " ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    public function ContoTestiInfoHotel($Id_infohotel, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_infohotel_lang WHERE Id_infohotel = " . $Id_infohotel . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function ControlloTestiInseritiBannerInfo($IdBannerInfo, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_banner_info_lang WHERE IdBannerInfo = " . $IdBannerInfo . " AND idsito = " . $idsito . " ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    public function ContoTestiBannerInfo($IdBannerInfo, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_banner_info_lang WHERE IdBannerInfo = " . $IdBannerInfo . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function CodiceCasuale($lunghezza = 5)
    {
        $caratteri_disponibili = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $codice = "";
        for ($i = 0; $i < $lunghezza; $i++) {
            $codice = $codice . substr($caratteri_disponibili, rand(0, strlen($caratteri_disponibili) - 1), 1);
        }
        return $codice . '_' . date('Y');
    }

    public function ContoSimpleBooking($idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_simplebooking WHERE idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function ContoEricSoft($idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_ericsoftbooking WHERE idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function ContoBedzzle($idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_bedzzlebooking WHERE idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function Conto5stelle($idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_pms WHERE idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function ContoParityRate($idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_parityrate WHERE idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function ContoSmtp($idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_smtp WHERE idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function ControlloTestiInseritiDomande($domanda_id, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue,' ') SEPARATOR ' ') AS lingue FROM hospitality_domande_lingua WHERE domanda_id = " . $domanda_id . " AND idsito = " . $idsito . " ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    public function ContoTestiDomande($domanda_id, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_domande_lingua WHERE domanda_id = " . $domanda_id . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function ControlloTestiInseritiDizionario($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }



    public function ControlloTestiInseritiOggettoQuestionario($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    public function ControlloTestiInseritiMailQuestionario($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    public function ContoTestiOggettoCS($id_dizionario, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }
    public function ContoTestiMailCS($id_dizionario, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function ControlloTestiInseritiOggettoRecensioniPunteggio($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    public function ControlloTestiInseritiMailRecensioniPunteggio($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    /**
     * ContoTestiOggettoRecensioniPunteggio
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiOggettoRecensioniPunteggio($id_dizionario, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }
    /**
     * ContoTestiMailRecensioniPunteggio
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiMailRecensioniPunteggio($id_dizionario, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    /**
     * ControlloTestiInseritiOggettoRecall
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiOggettoRecall($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    /**
     * ControlloTestiInseritiMailRecall
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiMailRecall($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    /**
     * ContoTestiOggettoRecall
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiOggettoRecall($id_dizionario, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    /**
     * ContoTestiMailRecall
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiMailRecall($id_dizionario, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    /**
     * check_recensioni_data
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_recensioni_data($idsito)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_giorni_recensioni WHERE idsito = " . $idsito . " AND abilita = 1";
        $result = $dbMysqli->query($select);
        $check = sizeof($result);

        return $check;
    }

    /**
     * check_recensioni_punteggio
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_recensioni_punteggio($idsito)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_recensioni_range WHERE idsito = " . $idsito . " AND abilita = 1";
        $result = $dbMysqli->query($select);
        $check = sizeof($result);

        return $check;
    }
    /**
     * ControlloTestiInseritiOggettoResend
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiOggettoResend($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }
    /**
     * ControlloTestiInseritiMailResend
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiMailResend($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }
    /**
     * ContoTestiOggettoResend
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiOggettoResend($id_dizionario, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }
    /**
     * ContoTestiMailResend
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiMailResend($id_dizionario, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }
    /**
     * ControlloTestiInseritiOggettoCheckinonline
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiOggettoCheckinonline($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    /**
     * ControlloTestiInseritiMailCheckinonline
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiMailCheckinonline($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    /**
     * ContoTestiOggettoCheckinonline
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiOggettoCheckin($id_dizionario, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    /**
     * ContoTestiMailCheckinonline
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiMailCheckin($id_dizionario, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    /**
     * ControlloTestiInseritiOggettoRecensioni
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiOggettoRecensioni($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    /**
     * ControlloTestiInseritiMailRecensioni
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiMailRecensioni($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    /**
     * ContoTestiOggettoRecensioni
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiOggettoRecensioni($id_dizionario, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }
    /**
     * ContoTestiMailRecensioni
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiMailRecensioni($id_dizionario, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    /**
     * ControlloTestiInseritiOggettoInfoUtili
     *
     * @param  mixed $id_precheckin
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiOggettoInfoUtili($id_precheckin, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_precheckin_lingua WHERE id_precheckin = " . $id_precheckin . " AND idsito = " . $idsito . "  AND oggetto != '' ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    /**
     * ControlloTestiInseritiMailInfoUtili
     *
     * @param  mixed $id_precheckin
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiMailInfoUtili($id_precheckin, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_precheckin_lingua WHERE id_precheckin = " . $id_precheckin . " AND idsito = " . $idsito . " AND testo != '' ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    /**
     * ContoTestiPreCheckin
     *
     * @param  mixed $id_precheckin
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiPreCheckin($id_precheckin, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_precheckin_lingua WHERE id_precheckin = " . $id_precheckin . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }
    /**
     * ControlloTestiInseritiBenvenuto
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiBenvenuto($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " AND testo != '' ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }
    /**
     * ContoTestiBenvennuto
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiBenvenuto($id_dizionario, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }
    /**
     * array_remove_item
     *
     * @param  mixed $arr
     * @param  mixed $item
     * @return void
     */
    public function array_remove_item($arr, $item)
    {
        // verifico che il valore sia compreso nell'array
        if (in_array($item, $arr)) {
            // rimuovo il valore passando ad unset la chiave dell'item
            // recuperata usando array_search
            unset($arr[array_search($item, $arr)]);
            // restituisco l'array dopo averla re-indicizzata
            return array_values($arr);
        } else {
            // se non trovo corrispondenze restituisco l'array così com'è
            return $arr;
        }
    }
    /**
     * arrayPagamenti
     *
     * @param  mixed $idsito
     * @return void
     */
    public function arrayPagamenti($idsito)
    {
        global $dbMysqli;

        $pagamenti = array();

        $array_pag = array('', 'Carta di Credito', 'Bonifico Bancario', 'Vaglia Postale', 'Nexi', 'PayPal', 'Gateway Bancario', 'Gateway Bancario Virtual Pay', 'Stripe');

        foreach ($array_pag as $key => $value) {
            $sel = $dbMysqli->query('SELECT TipoPagamento FROM hospitality_tipo_pagamenti  WHERE hospitality_tipo_pagamenti.idsito = ' . $idsito . ' AND TipoPagamento = "' . $value . '"');
            $r = sizeof($sel);
            if ($r == 1) {
                $this->array_remove_item($pagamenti, $value);
            } else {
                $pagamenti[$value] = $value;
            }
        }
        return $pagamenti;
    }

    public function ControlloTestiInseritiPagamenti($pagamenti_id, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue,' ') SEPARATOR ' ') AS lingue FROM hospitality_tipo_pagamenti_lingua WHERE pagamenti_id = " . $pagamenti_id . " AND idsito = " . $idsito . " AND (Pagamento != '' OR Descrizione != '') ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }
    /**
     * ControlloTestiInseritiDizionarioForm
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiDizionarioForm($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM dizionario_form_quoto_lingue WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " ORDER BY id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }

    /**
     * arrayLingue
     *
     * @param  mixed $idsito
     * @return void
     */
    public function arrayLingue($idsito)
    {
        global $dbMysqli;

        $rows = $dbMysqli->query('SELECT * FROM hospitality_lista_lingue  ORDER BY id_lang ASC');
        $lingue = array();

        foreach ($rows as $key => $value) {

            $sel = $dbMysqli->query('SELECT codlingua FROM hospitality_lingue_form  WHERE hospitality_lingue_form.idsito = ' . $idsito . ' AND hospitality_lingue_form.codlingua ="' . $value['codice'] . '"');
            $rs = sizeof($sel);
            if ($rs == 1) {
                $this->array_remove_item($lingue, $value['codice']);
            } else {
                $lingue[$value['codice']] = $value['lingua'];
            }
        }

        return $lingue;
    }
    /**
     * ControlloTestiInseritiServizi
     *
     * @param  mixed $servizi_id
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiServizi($servizi_id, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue,' ') SEPARATOR ' ') AS lingue FROM hospitality_servizi_camere_lingua WHERE servizi_id = " . $servizi_id . " AND idsito = " . $idsito . " ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }
    /**
     * ContoTestiServizi
     *
     * @param  mixed $servizi_id
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiServizi($servizi_id, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_servizi_camere_lingua WHERE servizi_id = " . $servizi_id . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function ControlloTestiInseritiBoxInfo($Id_infohotel, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_boxinfo_checkin_lang WHERE Id_infohotel = " . $Id_infohotel . " AND idsito = " . $idsito . " ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }
    /**
     * ContoTestiBoxInfoi
     *
     * @param  mixed $Id_infohotel
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiBoxInfo($Id_infohotel, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_boxinfo_checkin_lang WHERE Id_infohotel = " . $Id_infohotel . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }
    /**
     * get_checkin
     *
     * @param  mixed $prenotazione
     * @param  mixed $idsito
     * @return void
     */
    public function get_checkin($prenotazione, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT hospitality_proposte.Id as IdProposta,hospitality_proposte.id_richiesta,hospitality_proposte.NomeProposta,hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,
							hospitality_guest.AccontoRichiesta,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.AccontoLibero,
							hospitality_guest.NumeroAdulti,hospitality_guest.NumeroBambini,
							hospitality_guest.EtaBambini1,hospitality_guest.EtaBambini2,hospitality_guest.EtaBambini3,hospitality_guest.EtaBambini4,
							hospitality_guest.EtaBambini5,hospitality_guest.EtaBambini6,
							hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,hospitality_proposte.AccontoTesto,
							hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza,hospitality_guest.ChiPrenota
					FROM hospitality_proposte
					INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
					WHERE hospitality_guest.idsito = " . $idsito . " AND hospitality_guest.NumeroPrenotazione = " . $prenotazione . " AND hospitality_guest.TipoRichiesta = 'Conferma' AND hospitality_guest.Chiuso = 1";
        $res = $dbMysqli->query($select);
        $tot = sizeof($res);
        if ($tot > 0) {
            $Camere = '';
            $acconto = '';
            foreach ($res as $key => $value) {

                $PrezzoL = number_format($value['PrezzoL'], 2, ',', '.');
                $PrezzoP = number_format($value['PrezzoP'], 2, ',', '.');
                $IdProposta = $value['IdProposta'];
                $PrezzoPC = $value['PrezzoP'];
                $AccontoRichiesta = $value['AccontoRichiesta'];
                $IdRichiesta = $value['id_richiesta'];
                $AccontoLibero = $value['AccontoLibero'];
                $NomeProposta = $value['NomeProposta'];
                $Operatore = stripslashes($value['ChiPrenota']);
                $Nome = stripslashes($value['Nome']);
                $Cognome = stripslashes($value['Cognome']);
                $Email = $value['Email'];
                $NumeroAdulti = $value['NumeroAdulti'];
                $NumeroBambini = $value['NumeroBambini'];
                $EtaBambini1 = $value['EtaBambini1'];
                $EtaBambini2 = $value['EtaBambini2'];
                $EtaBambini3 = $value['EtaBambini3'];
                $EtaBambini4 = $value['EtaBambini4'];
                $EtaBambini5 = $value['EtaBambini5'];
                $EtaBambini6 = $value['EtaBambini6'];
                $Arrivo_tmp = explode("-", $value['DataArrivo']);
                $Arrivo = $Arrivo_tmp[2] . '-' . $Arrivo_tmp[1] . '-' . $Arrivo_tmp[0];
                $Partenza_tmp = explode("-", $value['DataPartenza']);
                $Partenza = $Partenza_tmp[2] . '-' . $Partenza_tmp[1] . '-' . $Partenza_tmp[0];
                $AccontoPercentuale = $value['AccontoPercentuale'];
                $AccontoImporto = $value['AccontoImporto'];
                $AccontoTesto = stripslashes($value['AccontoTesto']);
                $start = mktime(24, 0, 0, $Arrivo_tmp[1], $Arrivo_tmp[2], $Arrivo_tmp[0]);
                $end = mktime(01, 0, 0, $Partenza_tmp[1], $Partenza_tmp[2], $Partenza_tmp[0]);
                $Notti = ceil(abs($end - $start) / 86400);

                if ($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                    $acconto = number_format(($PrezzoPC * $AccontoRichiesta / 100), 2, ',', '.');
                }
                if ($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                    $acconto = number_format($AccontoLibero, 2, ',', '.');
                }

                if ($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                    $acconto = number_format(($PrezzoPC * $AccontoPercentuale / 100), 2, ',', '.');
                }
                if ($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                    $acconto = number_format($AccontoImporto, 2, ',', '.');
                }

                $select2 = "SELECT hospitality_richiesta.Prezzo,hospitality_richiesta.NumeroCamere,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
							FROM hospitality_richiesta
							INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
							INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
							WHERE hospitality_richiesta.id_proposta = " . $IdProposta;
                $res2 = $dbMysqli->query($select2);
                $Camere = '';
                foreach ($res2 as $ky => $val) {
                    $Camere .= $val['TipoSoggiorno'] . ' <i class=\'fa fa-angle-right\'></i> Nr. ' . $val['NumeroCamere'] . ' ' . $val['TipoCamere'] . ' - €. ' . number_format($val['Prezzo'], 2, ',', '.') . '<br>';
                }

                $sistemazione .= '<b>SOLUZIONE CONFERMATA</b><br>' . ($NomeProposta != '' ? '<b>' . $NomeProposta . '</b><br>' : '') . '<b>' . $Nome . ' ' . $Cognome . '</b> - <em>' . $Email . '</em><br>Adulti: <b>' . $NumeroAdulti . '</b> ' . ($NumeroBambini != '0' ? ' - Bambini: <b>' . $NumeroBambini . '</b> - ' . ($EtaBambini1 != '' && $EtaBambini1 != '0' ? $EtaBambini1 . ' anni ' : '') . ($EtaBambini2 != '' && $EtaBambini2 != '0' ? ' - ' . $EtaBambini2 . ' anni ' : '') . ($EtaBambini3 != '' && $EtaBambini3 != '0' ? ' - ' . $EtaBambini3 . ' anni ' : '') . ($EtaBambini4 != '' && $EtaBambini4 != '0' ? ' - ' . $EtaBambini4 . ' anni ' : '') . ($EtaBambini5 != '' && $EtaBambini5 != '0' ? ' - ' . $EtaBambini5 . ' anni ' : '') . ($EtaBambini6 != '' && $EtaBambini6 != '0' ? ' - ' . $EtaBambini6 . ' anni ' : '') . ' ' : '') . '<br>Arrivo <i class=\'fa fa-angle-right\'></i> ' . $Arrivo . ' - Partenza <i class=\'fa fa-angle-right\'></i> ' . $Partenza . ' - per notti: ' . $Notti . '<br> ' . $Camere . ' <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp;  ' . ($PrezzoL != '0,00' ? ' Prezzo List. €.<strike>' . $PrezzoL . '</strike> <i class=\'fa fa-angle-right\'></i>' : '') . '  Prezzo Proposto €.' . $PrezzoP . '<br /> ' . ($acconto != '' ? '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Caparra versata o da prelevare €.' . $acconto . '' : '') . '<br>';

            }
            $sistemazione = str_replace('"', ' ', $sistemazione);

            return ' <a href="javascript:;"  data-toggle="modal" data-target="#sistemazione' . $prenotazione . '" title="Dettaglio Prenotazione">
							<i class="fa fa-comment"></i>
						</a>
						<div class="modal fade" id="sistemazione' . $prenotazione . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Dettagliato Soggiorno</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="text-left f-left">
											' . $sistemazione . '
										</div>
									</div>
								</div>
							</div>
						</div>';
        } else {
            $sel = "SELECT
						hospitality_guest.FontePrenotazione
					FROM
						hospitality_guest
					WHERE
						hospitality_guest.idsito = " . $idsito . "
					AND
						hospitality_guest.NumeroPrenotazione = " . $prenotazione . "
					AND
						hospitality_guest.TipoRichiesta = 'Conferma'
					AND
						hospitality_guest.Chiuso = 1";
            $res = $dbMysqli->query($sel);
            $rec = $res[0];

            return '<small class="text-maroon">' . $rec['FontePrenotazione'] . '</small>';
        }
    }
    /**
     * count_row_compilate
     *
     * @param  mixed $prenotazione
     * @param  mixed $idsito
     * @return void
     */
    public function count_row_compilate($prenotazione, $idsito)
    {
        global $dbMysqli;
        $message = '';

        $query = "SELECT COUNT(Id) as num, NumeroPersone FROM hospitality_checkin WHERE Prenotazione = '" . $prenotazione . "' AND idsito = " . $idsito;
        $result = $dbMysqli->query($query);
        $record = $result[0];

        $mancanti = ($record['NumeroPersone'] - $record['num']);

        if ($mancanti < 2) {
            $frase_mancanti = 'manca <b>' . $mancanti . '</b> ospite';
        } else {
            $frase_mancanti = 'mancano <b>' . $mancanti . '</b> ospiti';
        }

        if ($record['NumeroPersone'] == $record['num']) {
            $message = '<span class="f-11 text-green">Operazione di check-in completata!</span>';
        } else {
            $message = '<span class="f-11 text-red">L\'utente non ha portato a termine tutta la procedura di check-in, ' . $frase_mancanti . '</span>';
        }

        return $message;
    }
    /**
     * get_Schedina
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function get_Schedina($id, $idsito)
    {
        global $dbMysqli;

        $query = "	SELECT
						hospitality_checkin.*
					FROM
						hospitality_checkin
					WHERE
						hospitality_checkin.Id = " . $id . "
					AND
						hospitality_checkin.idsito = " . $idsito . "
					AND
						hospitality_checkin.session_id IS NOT NULL";
        $result = $dbMysqli->query($query);
        $record = $result[0];

        return $record;
    }
    /**
     * check_superuser
     *
     * @param  mixed $value
     * @return void
     */
    public function check_superuser($value)
    {
        if ($value == 1) {
            $valore = '<span class="f-11 text-red">Accesso da SuperUser abilitato dal cliente!</span>';
        } else {
            $valore = '<span class="f-11 text-info">Accesso custom creato da quest\'area!</span>';
        }
        return $valore;
    }
    /**
     * ico_sesso
     *
     * @param  mixed $value
     * @return void
     */
    public function ico_sesso($value)
    {
        $icona = '';
        if ($value) {
            if ($value == 'Male') {
                $icona = '<i class="fa fa-male" data-toogle="tooltip" title="Uomo"></i>';
            } else {
                $icona = '<i class="fa fa-female" data-toogle="tooltip" title="Donna"></i>';
            }
        }
        return $icona;
    }

    public function ControlloTestiInseritiSoggiorni($soggiorni_id, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue,' ') SEPARATOR ' ') AS lingue FROM hospitality_tipo_soggiorno_lingua WHERE soggiorni_id = " . $soggiorni_id . " AND idsito = " . $idsito . " ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-10">Compila i testi!</label>';
            }
            return $return_value;
        }
    }
    /**
     * flag_pms_soggiorno_bedzzle
     *
     * @param  mixed $Id
     * @param  mixed $value
     * @param  mixed $idsito
     * @return void
     */
    public function flag_pms_soggiorno_bedzzle($Id, $idsito)
    {
        global $dbMysqli;

        $sel = 'SELECT * FROM hospitality_tipo_soggiorno WHERE Id = ' . $Id;
        $resu = $dbMysqli->query($sel);
        $rw = $resu[0];

        $select = "SELECT * FROM hospitality_pms_trattamenti INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.PlanCode = hospitality_pms_trattamenti.RateId WHERE hospitality_tipo_soggiorno.idsito = " . $idsito . " AND hospitality_pms_trattamenti.idsito = " . $idsito;
        $rows = $dbMysqli->query($select);

        if ($rows) {
            $butt = ($rw['RateId'] == '' ? '<button type="button" class="btn btn-default btn-mini">Abbina tipo Soggiorno</button>' : '');

            foreach ($rows as $value) {
                if ($value['RateId'] == $rw['PlanCode']) {
                    $butt = '<button type="button" class="btn btn-default btn-mini">[' . $value['RateId'] . '] ' . $value['Description'] . '</button>';
                    $filtro1 = '<li><a href="//' . $_SERVER["HTTP_HOST"] . '/associa_soggiorno/' . $value['RateId'] . '/' . $rw['Id'] . '/"><small>[' . $value['RateId'] . '] ' . $value['Description'] . '</small></a></li>';
                } else {
                    $filtro1 = '<li><a href="//' . $_SERVER["HTTP_HOST"] . '/associa_soggiorno/0/' . $rw['Id'] . '/"><small>Non abbinato</small></a></li>';
                    $filtro .= '<li><a href="//' . $_SERVER["HTTP_HOST"] . '/associa_soggiorno/' . $value['RateId'] . '/' . $rw['Id'] . '/"><small>[' . $value['RateId'] . '] ' . $value['Description'] . '</small></a></li>';
                    $butt .= ($value['RateId'] == $rw['PlanCode'] ? '<button type="button" class="btn btn-default btn-mini">[' . $value['RateId'] . '] ' . $value['Description'] . '</button>' : '');
                }
            }

            $code = '
				<div class="btn-group">
					' . $butt . '
					<button type="button" class="btn btn-default btn-mini dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu scroll" role="menu" style="height:350px;overflow-y:auto;overflow-x:auto;">
					' . $filtro1 . '' . $filtro . '
					</ul>
				</div>';

        } else {
            $code = '<small style="white-space:nowrap;" class="text-red">Non abbinato!</small>';
        }

        return $code;
    }
    /**
     * check_pms
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_pms($idsito)
    {
        global $dbMysqli;

        $Qcheck = "SELECT * FROM hospitality_pms WHERE idsito = " . $idsito . " AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
        $Qquery = $dbMysqli->query($Qcheck);
        if (sizeof($Qquery) > 0) {
            $check = 1;
        } else {
            $check = 0;
        }

        return $check;
    }
    /**
     * check_pms_bedzzle
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_pms_bedzzle($idsito)
    {
        global $dbMysqli;

        $Tcheck = array();

        $Qcheck = "SELECT * FROM hospitality_bedzzlebooking WHERE idsito = " . $idsito . " AND PMS = 1 ORDER BY Id DESC LIMIT 1";
        $Qquery = $dbMysqli->query($Qcheck);
        $Tcheck = $Qquery[0];
        if (is_array($Tcheck)) {
            if ($Tcheck > count($Tcheck)) {
                $check = $Tcheck['PMS'];
            }

        } else {
            $check = 0;
        }

        return $check;
    }
        /**
     * check_pms_bedzzle
     *
     * @param  mixed $idsito
     * @return void
     */
    public function check_pms_ericsoft($idsito)
    {
        global $dbMysqli;

        $Tcheck = array();

        $Qcheck = "SELECT * FROM hospitality_ericsoftbooking WHERE idsito = " . $idsito . " AND PMS = 1 ORDER BY Id DESC LIMIT 1";
        $Qquery = $dbMysqli->query($Qcheck);
        $Tcheck = $Qquery[0];
        if (is_array($Tcheck)) {
            if ($Tcheck > count($Tcheck)) {
                $check = $Tcheck['PMS'];
            }

        } else {
            $check = 0;
        }

        return $check;
    }
    /**
     * flag_booking
     *
     * @param  mixed $value
     * @param  mixed $idsito
     * @return void
     */
    public function flag_booking($Id, $value, $idsito)
    {

        if ($value) {

            if ($this->check_simplebooking($idsito) == 1) {

                return '<small style="white-space:nowrap;">' . $value . ' &nbsp;<span class="text-red">Sync da Simple Booking</span></small>';

            }
            if ($this->check_ericsoftbooking($idsito) == 1) {

                return '<small style="white-space:nowrap;">' . $value . ' &nbsp;<span class="text-red">Sync da Ericsoft Booking</span></small>';

            }
            if ($this->check_bedzzlebooking($idsito) == 1 && $this->check_pms_bedzzle($idsito) == 0) {

                return '<small style="white-space:nowrap;">' . $value . ' &nbsp;<span class="text-red">Sync da Bedzzle Booking</span></small>';

            }
            if ($this->check_pms_bedzzle($idsito) == 1) {

                return $this->flag_pms_soggiorno_bedzzle($Id, $idsito);

            }
        } else {

            return '<small style="white-space:nowrap;" class="text-green">Impostato da QUOTO!</small>';

        }
    }

    /**
     * flag_soggiorni_parity
     *
     * @param  mixed $Id
     * @param  mixed $value
     * @param  mixed $idsito
     * @return void
     */
    public function flag_soggiorni_parity($Id, $idsito)
    {
        global $dbMysqli;

        $sele = 'SELECT * FROM hospitality_tipo_soggiorno WHERE Id = ' . $Id;
        $res = $dbMysqli->query($sele);
        $rw = $res[0];

        $select = "SELECT * FROM hospitality_parity_trattamenti WHERE idsito = " . $idsito;
        $rows = $dbMysqli->query($select);

        if ($rows) {

            $butt .= ($rw['RateParityId'] == '' ? '<button type="button" class="btn btn-default btn-mini">Abbina tipo Soggiorno</button>' : '');

            foreach ($rows as $value) {
                $filtro1 = '<li><a href="//' . $_SERVER["HTTP_HOST"] . '/associa_soggiorno_parity/0/' . $rw['Id'] . '/"><small>Non abbinato</small></a></li>';
                $filtro .= '<li><a href="//' . $_SERVER["HTTP_HOST"] . '/associa_soggiorno_parity/' . $value['RateId'] . '/' . $rw['Id'] . '/"><small>[' . $value['RateId'] . '] ' . $value['Description'] . '</small></a></li>';
                $butt .= ($rw['RateParityId'] == $value['RateId'] ? '<button type="button" class="btn btn-default btn-mini">[' . $value['RateId'] . '] ' . $value['Description'] . '</button>' : '');
            }

            $code = '
				<div class="btn-group">
					' . $butt . '
					<button type="button" class="btn btn-default btn-mini dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu scroll" role="menu" style="height:350px;overflow-y:auto;overflow-x:auto;">
					' . $filtro1 . '' . $filtro . '
					</ul>
				</div>';

        } else {
            $code = '<small style="white-space:nowrap;" class="text-red">Non abbinato!</small>';
        }
        return $code;
    }
    /**
     * flag_camere_parity
     *
     * @param  mixed $Id
     * @param  mixed $idsito
     * @return void
     */
    public function flag_camere_parity($Id, $idsito)
    {
        global $dbMysqli;

        $sele = 'SELECT * FROM hospitality_tipo_camere WHERE Id = ' . $Id;
        $res = $dbMysqli->query($sele);
        $rw = $res[0];

        $select = "SELECT * FROM hospitality_parity_camere WHERE idsito = " . $idsito;
        $rows = $dbMysqli->query($select);

        if ($rows) {

            $butt .= ($rw['RoomParityId'] == '' ? '<button type="button" class="btn btn-default btn-mini">Abbina tipo Camera</button>' : '');

            foreach ($rows as $value) {
                $filtro1 = '<li><a href="//' . $_SERVER["HTTP_HOST"] . '/associa_camere_parity/0/' . $rw['Id'] . '/"><small>Non abbinato</small></a></li>';
                $filtro .= '<li><a href="//' . $_SERVER["HTTP_HOST"] . '/associa_camere_parity/' . $value['RoomId'] . '/' . $rw['Id'] . '/"><small>' . $value['RoomDescription'] . '</small></a></li>';
                $butt .= ($rw['RoomParityId'] == $value['RoomId'] ? '<button type="button" class="btn btn-default btn-mini">' . $value['RoomDescription'] . '</button>' : '');
            }

            $code = '
					<div class="btn-group">
						' . $butt . '
						<button type="button" class="btn btn-default btn-mini dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<ul class="dropdown-menu scroll" role="menu" style="height:350px;overflow-y:auto;overflow-x:auto;">
						' . $filtro1 . '' . $filtro . '
						</ul>
					</div>';

        } else {
            $code = '<small style="white-space:nowrap;" class="text-red">Non abbinata!</small>';
        }

        return $code;
    }

    /**
     * flag_soggiorni_pms
     *
     * @param  mixed $Id
     * @param  mixed $idsito
     * @return void
     */
    public function flag_soggiorni_pms($Id, $idsito)
    {
        global $dbMysqli;

        $sele = 'SELECT * FROM hospitality_tipo_soggiorno WHERE Id = ' . $Id;
        $res = $dbMysqli->query($sele);
        $rw = $res[0];

        $select = "SELECT * FROM hospitality_pms_trattamenti WHERE idsito = " . $idsito;
        $rows = $dbMysqli->query($select);
        if (sizeof($rows) > 0) {

            $butt .= ($rw['PlanTypePms'] == '' ? '<button type="button" class="btn btn-default btn-mini">Abbina tipo Soggiorno</button>' : '');

            foreach ($rows as $value) {
                $filtro1 = '<li><a href="//' . $_SERVER["HTTP_HOST"] . '/associa_soggiorno/0/' . $rw['Id'] . '/"><small>Non abbinato</small></a></li>';
                $filtro .= '<li><a href="//' . $_SERVER["HTTP_HOST"] . '/associa_soggiorno/' . $value['RateId'] . '/' . $rw['Id'] . '/"><small>[' . $value['RateId'] . '] ' . $value['Description'] . '</small></a></li>';
                $butt .= ($rw['PlanTypePms'] == $value['RateId'] ? '<button type="button" class="btn btn-default btn-mini">[' . $value['RateId'] . '] ' . $value['Description'] . '</button>' : '');
            }

            $code = '
				<div class="btn-group">
					' . $butt . '
					<button type="button" class="btn btn-default btn-mini dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu scroll" role="menu" style="height:350px;overflow-y:auto;overflow-x:auto;">
					' . $filtro1 . '' . $filtro . '
					</ul>
				</div>';

        } else {
            $code = '<small style="white-space:nowrap;" class="text-red">Non abbinato!</small>';
        }

        return $code;
    }

    /**
     * ContoTestiSoggiorno
     *
     * @param  mixed $soggiorni_id
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiSoggiorno($soggiorni_id, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(id) as numero FROM hospitality_tipo_soggiorno_lingua WHERE soggiorni_id = " . $soggiorni_id . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }
    public function ControlloListinoInseritoSoggiorni($IdSoggiorno, $idsito)
    {
        global $dbMysqli;
        $etichetta = '';
        $select = "SELECT COUNT(Id) as numero FROM hospitality_listino_soggiorni WHERE IdSoggiorno = " . $IdSoggiorno . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if ($rec['numero'] == 0) {
            if ($this->check_simplebooking($idsito) == 1) {
                $etichetta = 'SimpleBooking';
            }
            if ($this->check_ericsoftbooking($idsito) == 1) {
                $etichetta = 'EricSoftBooking';
            }
            if ($this->check_bedzzlebooking($idsito) == 1) {
                $etichetta = 'BedzzleBooking';
            }
            if ($this->check_parity($idsito) == 1) {
                $etichetta = 'Channel ParityRate';
            }
            if ($etichetta != '') {
                $result = '<label class="badge badge-inverse-info f-10">Listino QUOTO non attivo,<br> perchè è attivo ' . $etichetta . '!</label>';
            } else {
                $result = '<label class="badge badge-inverse-danger f-10">Listino non compilato!</label>';
            }
        } else {
            $result = '<label class="badge badge-inverse-success f-10">Listino compilato!</label>';
        }

        return $result;

    }
    /**
     * ControlloTestiInseritiServiziAggiuntivi
     *
     * @param  mixed $servizio_id
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiServiziAggiuntivi($servizio_id, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue,' ') SEPARATOR ' ') AS lingue FROM hospitality_tipo_servizi_lingua WHERE servizio_id = " . $servizio_id . " AND idsito = " . $idsito . " ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }
    public function ContoTestiServiziAggiuntivi($servizio_id, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_tipo_servizi_lingua WHERE servizio_id = " . $servizio_id . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }
    public function get_lista_soggiorni($idsito, $val = null)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_tipo_soggiorno WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = " . $idsito . " ORDER BY TipoSoggiorno ASC";
        $result = $dbMysqli->query($select);
        if (sizeof($result) > 0) {
            $ListaSoggiorno .= '<option value="">scegli</option>';
            foreach ($result as $chiave => $valore) {
                $ListaSoggiorno .= '<option value="' . $valore['Id'] . '" ' . ($val == $valore['Id'] ? 'selected="selected"' : '') . '>' . mini_clean($valore['TipoSoggiorno']) . '</option>';
            }
        }

        return $ListaSoggiorno;
    }

    /**
     * get_lista_camere
     *
     * @param  mixed $idsito
     * @param  mixed $valore
     * @return void
     */
    public function get_lista_camere($idsito, $valore = null)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_tipo_camere WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = " . $idsito . " ORDER BY Ordine ASC";
        $result = $dbMysqli->query($select);
        if (sizeof($result) > 0) {
            $ListaCamere .= '<option value="">scegli</option>';
            foreach ($result as $key => $val) {
                $ListaCamere .= '<option value="' . $val['Id'] . '" ' . ($valore == $val['Id'] ? 'selected="selected"' : '') . '>' . $val['TipoCamere'] . '</option>';
            }
        }

        return $ListaCamere;
    }

    /**
     * etichetta_booking
     *
     * @param  mixed $valore
     * @param  mixed $tipoBooking
     * @return void
     */
    public function etichetta_booking($valore, $tipoBooking)
    {
        if ($valore) {
            return '<small style="white-space:nowrap;">' . $valore . ' &nbsp;<span class="text-red">Sync da ' . $tipoBooking . '</span></small>';
        } else {
            return '<small style="white-space:nowrap;" class="text-green">Impostato da QUOTO!</small>';
        }
    }
    /**
     * flag_pms_bedzzle
     *
     * @param  mixed $Id
     * @param  mixed $idsito
     * @return void
     */
    public function flag_pms_bedzzle($Id, $idsito)
    {
        global $dbMysqli;

        $sel = 'SELECT * FROM hospitality_tipo_camere WHERE Id = ' . $Id;
        $resu = $dbMysqli->query($sel);
        $rw = $resu[0];

        $select = "SELECT * FROM hospitality_pms_camere  WHERE hospitality_pms_camere.idsito = " . $idsito;
        $rows = $dbMysqli->query($select);

        if ($rows) {

            $butt = ($rw['RoomTypePms'] == '' ? '<button type="button" class="btn btn-default btn-mini">Abbina tipo Camera</button>' : '');

            foreach ($rows as $value) {

                $filtro1 = '<li><a href="//' . $_SERVER["HTTP_HOST"] . '/associa_camere/0/' . $rw['Id'] . '/"><small>Non abbinato</small></a></li>';
                $filtro .= '<li><a href="//' . $_SERVER["HTTP_HOST"] . '/associa_camere/' . $value['RoomTypeId'] . '/' . $rw['Id'] . '/"><small>' . $value['RoomTypeDescription'] . '</small></a></li>';
                $butt .= ($rw['RoomTypePms'] == $value['RoomTypeId'] ? '<button type="button" class="btn btn-default btn-mini">' . $value['RoomTypeDescription'] . '</button>' : '');

            }

            $code = '
                <div class="btn-group">
                    ' . $butt . '
                    <button type="button" class="btn btn-default btn-mini dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu scroll" role="menu" style="height:350px;overflow-y:auto;overflow-x:auto;">
                    ' . $filtro1 . '' . $filtro . '
                    </ul>
                </div>';

        } else {
            $code = '<small style="white-space:nowrap;" class="text-red">Non abbinata!</small>';
        }

        return $code;
    }
/**
 * flag_pms_cinqueStelle
 *
 * @param  mixed $Id
 * @param  mixed $idsito
 * @return void
 */
    public function flag_pms_cinqueStelle($Id, $idsito)
    {
        global $dbMysqli;

        $sel = 'SELECT * FROM hospitality_tipo_camere WHERE Id = ' . $Id;
        $resu = $dbMysqli->query($sel);
        $rw = $resu[0];

        $select = "SELECT * FROM hospitality_pms_camere WHERE idsito = " . $idsito;
        $rows = $dbMysqli->query($select);
        if ($rows) {

            $butt .= ($rw['RoomTypePms'] == '' ? '<button type="button" class="btn btn-default btn-mini">Abbina tipo Camera</button>' : '');

            foreach ($rows as $value) {
                $filtro1 = '<li><a href="//' . $_SERVER["HTTP_HOST"] . '/associa_camere/0/' . $rw['Id'] . '/"><small>Non abbinato</small></a></li>';
                $filtro .= '<li><a href="//' . $_SERVER["HTTP_HOST"] . '/associa_camere/' . $value['RoomTypeId'] . '/' . $rw['Id'] . '/"><small>' . $value['RoomTypeDescription'] . '</small></a></li>';
                $butt .= ($rw['RoomTypePms'] == $value['RoomTypeId'] ? '<button type="button" class="btn btn-default btn-mini">' . $value['RoomTypeDescription'] . '</button>' : '');
            }

            $code = '
			<div class="btn-group">
				' . $butt . '
				<button type="button" class="btn btn-default btn-mini dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
					<span class="sr-only">Toggle Dropdown</span>
				</button>
				<ul class="dropdown-menu scroll" role="menu" style="height:350px;overflow-y:auto;overflow-x:auto;">
				' . $filtro1 . '' . $filtro . '
				</ul>
			</div>';

        } else {
            $code = '<small style="white-space:nowrap;" class="text-red">Non abbinata!</small>';
        }

        return $code;
    }
/**
 * check_camere_pms
 *
 * @param  mixed $idsito
 * @return void
 */
    public function check_camere_pms($idsito)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_pms_camere WHERE idsito = " . $idsito;
        $res = $dbMysqli->query($select);
        $check_type = sizeof($res);
        if ($check_type > 0) {
            $check = 1;
        } else {
            $check = 0;
        }
        return $check;
    }
/**
 * ControlloTestiInseritiCamere
 *
 * @param  mixed $camere_id
 * @param  mixed $idsito
 * @return void
 */
    public function ControlloTestiInseritiCamere($camere_id, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(lingue,' ') SEPARATOR ' ') AS lingue FROM hospitality_camere_testo WHERE camere_id = " . $camere_id . " AND idsito = " . $idsito . " ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-10">Compila i testi!</label>';
            }
            return $return_value;
        }
    }
/**
 * ControlloListinoInseritoCamere
 *
 * @param  mixed $IdCamera
 * @param  mixed $idsito
 * @return void
 */
    public function ControlloListinoInseritoCamere($IdCamera, $idsito)
    {
        global $dbMysqli;
        $etichetta = '';
        $select = "SELECT COUNT(hospitality_listino_camere.Id) AS numero 
                    FROM hospitality_listino_camere
                        INNER JOIN
                        hospitality_numero_listini 
                            ON hospitality_numero_listini.Id = hospitality_listino_camere.IdNumeroListino 
                    WHERE hospitality_listino_camere.IdCamera = " . $IdCamera . " 
                    AND hospitality_listino_camere.idsito = " . $idsito . " 
                    AND hospitality_numero_listini.Abilitato = 1";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if ($rec['numero'] == 0) {
            if ($this->check_simplebooking($idsito) == 1) {
                $etichetta = 'SimpleBooking';
            }
            if ($this->check_ericsoftbooking($idsito) == 1) {
                $etichetta = 'EricSoftBooking';
            }
            if ($this->check_bedzzlebooking($idsito) == 1) {
                $etichetta = 'BedzzleBooking';
            }
            if ($this->check_parity($idsito) == 1) {
                $etichetta = 'Channel ParityRate';
            }
            if ($etichetta != '') {
                $result = '<label class="badge badge-inverse-info f-10">Listino QUOTO non attivo,<br> perchè è attivo ' . $etichetta . '!</label>';
            } else {
                $result = '<label class="badge badge-inverse-danger f-10">Listino non compilato!</label>';
            }
        } else {
            $result = '<label class="badge  badge-inverse-success f-10">Listino compilato!</label>';
        }

        return $result;

    }
    public function ControlloGalleryInseritoCamere($IdCamera, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT Foto FROM hospitality_gallery_camera WHERE IdCamera = " . $IdCamera . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (sizeof($record_) == 0) {
            $result = '<label class="badge badge-inverse-danger f-10">Galleria non compilata!</label>';
        } else {
            $result = '<label class="badge badge-inverse-success f-10">La galleria contiene '.sizeof($record_).' foto!</label></label>';
        }

        return $result;

    }
/**
 * get_servizi_camera
 *
 * @param  mixed $idsito
 * @return void
 */
    public function get_servizi_camera($idsito)
    {
        global $dbMysqli;

        $query = "SELECT * FROM hospitality_servizi_camera WHERE Abilitato = 1 AND idsito = " . $idsito . " ORDER BY Servizio ASC";
        $result = $dbMysqli->query($query);
        $n_sc = sizeof($result);
        if ($n_sc > 0) {
            foreach ($result as $chiave => $valore) {

                $lista_servizi .= '<option value="' . $valore['Servizio'] . '">' . $valore['Servizio'] . '</option>';
            }
        }

        return $lista_servizi;

    }
/**
 * ContoTestiCamere
 *
 * @param  mixed $camere_id
 * @param  mixed $idsito
 * @return void
 */
    public function ContoTestiCamere($camere_id, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(id) as numero FROM hospitality_camere_testo WHERE camere_id = " . $camere_id . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

/**
 * listino_attivo
 *
 * @param  mixed $idsito
 * @return void
 */
    public function listino_attivo($idsito)
    {
        global $dbMysqli;

        $select = "SELECT Id,Listino FROM hospitality_numero_listini WHERE idsito = " . $idsito . " AND Abilitato = 1";
        $res = $dbMysqli->query($select);
        $rw = $res[0];

        return $rw;
    }

/**
 * get_nome_listino
 *
 * @param  mixed $IdNumeroListino
 * @param  mixed $idsito
 * @return void
 */
    public function get_nome_listino($IdNumeroListino, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT Listino FROM hospitality_numero_listini WHERE Id = " . $IdNumeroListino . " AND idsito = " . $idsito . "";
        $res = $dbMysqli->query($select);
        $rw = $res[0];

        return $rw['Listino'];
    }
/**
 * get_nome_soggiorno
 *
 * @param  mixed $IdSoggiorno
 * @param  mixed $idsito
 * @return void
 */
    public function get_nome_soggiorno($IdSoggiorno, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT TipoSoggiorno FROM hospitality_tipo_soggiorno WHERE Id = " . $IdSoggiorno . " AND idsito = " . $idsito . "";
        $res = $dbMysqli->query($select);
        $rw = $res[0];

        return $rw['TipoSoggiorno'];
    }

/**
 * get_soggiorni
 *
 * @param  mixed $IdSoggiorno
 * @param  mixed $idsito
 * @return void
 */
    public function get_soggiorni($IdSoggiorno, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_tipo_soggiorno WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = " . $idsito . " ORDER BY TipoSoggiorno ASC";
        $result = $dbMysqli->query($select);
        if (sizeof($result) > 0) {
            foreach ($result as $chiave => $valore) {
                $ListaSoggiorno .= '<option value="' . $valore['Id'] . '" ' . ($IdSoggiorno == $valore['Id'] ? 'selected="selected"' : '') . '>' . mini_clean($valore['TipoSoggiorno']) . '</option>';
            }
        }

        return $ListaSoggiorno;
    }
/**
 * ContoImmaginiGalleria
 *
 * @param  mixed $idsito
 * @return void
 */
    public function ContoImmaginiGalleria($idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(id) as numero FROM hospitality_gallery WHERE idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }

    public function insert_gallery_target($idsito)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = " . $idsito;
        $result = $dbMysqli->query($select);
        if (sizeof($result) == 0) {
            $insert = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('" . $idsito . "','custom1','Family','1')";
            $ins = $dbMysqli->query($insert);
            $IdTipoGalleryFamily = $dbMysqli->getInsertId($ins);
            $insertF = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('" . $idsito . "','" . $IdTipoGalleryFamily . "','family1.jpg','1')";
            $dbMysqli->query($insertF);
            $insertF2 = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('" . $idsito . "','" . $IdTipoGalleryFamily . "','family2.jpg','1')";
            $dbMysqli->query($insertF2);
            $insertF3 = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('" . $idsito . "','" . $IdTipoGalleryFamily . "','family3.jpg','1')";
            $dbMysqli->query($insertF3);

            $insert2 = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('" . $idsito . "','custom2','Bike','1')";
            $ins2 = $dbMysqli->query($insert2);
            $IdTipoGalleryBike = $dbMysqli->getInsertId($ins2);
            $insertB = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('" . $idsito . "','" . $IdTipoGalleryBike . "','bike1.jpg','1')";
            $dbMysqli->query($insertB);
            $insertB2 = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('" . $idsito . "','" . $IdTipoGalleryBike . "','bike2.jpg','1')";
            $dbMysqli->query($insertB2);
            $insertB3 = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('" . $idsito . "','" . $IdTipoGalleryBike . "','bike3.jpg','1')";
            $dbMysqli->query($insertB3);

            $insert3 = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('" . $idsito . "','custom3','Romantico','1')";
            $ins = $dbMysqli->query($insert3);
            $IdTipoGalleryRomantico = $dbMysqli->getInsertId($ins3);
            $insertR = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('" . $idsito . "','" . $IdTipoGalleryRomantico . "','romantico1.jpg','1')";
            $dbMysqli->query($insertR);
            $insertR2 = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('" . $idsito . "','" . $IdTipoGalleryRomantico . "','romantico2.jpg','1')";
            $dbMysqli->query($insertR2);
            $insertR3 = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('" . $idsito . "','" . $IdTipoGalleryRomantico . "','romantico3.jpg','1')";
            $dbMysqli->query($insertR3);
            // COPIA IMMAGINI DEMO
            $srcPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/demo_image/';
            $destPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $idsito . '/';

            $srcDir = opendir($srcPath);
            while ($readFile = readdir($srcDir)) {
                if ($readFile == 'family1.jpg' || $readFile == 'family2.jpg' || $readFile == 'family3.jpg') {

                    if (!file_exists($readFile)) {
                        if (copy($srcPath . $readFile, $destPath . $readFile)) {
                            $copia = "Copy file";
                        } else {
                            $copia = "Canot Copy file";
                        }
                    }
                }
                if ($readFile == 'bike1.jpg' || $readFile == 'bike2.jpg' || $readFile == 'bike3.jpg') {

                    if (!file_exists($readFile)) {
                        if (copy($srcPath . $readFile, $destPath . $readFile)) {
                            $copia = "Copy file";
                        } else {
                            $copia = "Canot Copy file";
                        }
                    }
                }
                if ($readFile == 'romantico1.jpg' || $readFile == 'romantico2.jpg' || $readFile == 'romantico3.jpg') {

                    if (!file_exists($readFile)) {
                        if (copy($srcPath . $readFile, $destPath . $readFile)) {
                            $copia = "Copy file";
                        } else {
                            $copia = "Canot Copy file";
                        }
                    }
                }
            }

            closedir($srcDir);
            // FINE COPIA IMMAGINI
        }
    }
    /**
     * ControlloGalleryTargetInserito
     *
     * @param  mixed $Id
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloGalleryTargetInserito($IdTipoGallery, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(Id) as numero FROM hospitality_tipo_gallery_target WHERE IdTipoGallery = " . $IdTipoGallery . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if ($rec['numero'] == 0) {
            $result = '<label class="badge badge-inverse-danger f-10">Galleria non compilata!</label>';
        } else {
            $result = '<label class="badge badge-inverse-success f-10">La galleria contiene ' . $rec['numero'] . ' foto!</label>';
        }

        return $result;

    }
    /**
     * clean_tolower
     *
     * @param  mixed $stringa
     * @return void
     */
    public function clean_tolower($stringa)
    {

        $clean_title = str_replace("!", "", $stringa);
        $clean_title = str_replace("?", "", $clean_title);
        $clean_title = str_replace(":", "", $clean_title);
        $clean_title = str_replace("+", "", $clean_title);
        $clean_title = str_replace(".", "", $clean_title);
        $clean_title = str_replace(",", "", $clean_title);
        $clean_title = str_replace(";", "", $clean_title);
        $clean_title = str_replace("'", "", $clean_title);
        $clean_title = str_replace("*", "", $clean_title);
        $clean_title = str_replace("/", "", $clean_title);
        $clean_title = str_replace("\"", "", $clean_title);
        $clean_title = str_replace("-", "", $clean_title);
        $clean_title = str_replace("_", "", $clean_title);
        $clean_title = str_replace(" - ", "-", $clean_title);
        $clean_title = str_replace("     ", " ", $clean_title);
        $clean_title = str_replace("    ", " ", $clean_title);
        $clean_title = str_replace("   ", " ", $clean_title);
        $clean_title = str_replace("  ", " ", $clean_title);
        $clean_title = trim($clean_title);
        $clean_title = strtolower($clean_title);

        return ($clean_title);
    }

    /**
     * ControlloTestiInseritiEventi
     *
     * @param  mixed $Id_eventi
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiEventi($Id_eventi, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_eventi_lang WHERE Id_eventi = " . $Id_eventi . " AND idsito = " . $idsito . " ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-10">Compila i testi!</label>';
            }
            return $return_value;
        }
    }
    /**
     * ContoTestiEventi
     *
     * @param  mixed $Id_eventi
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiEventi($Id_eventi, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(id) as numero FROM hospitality_eventi_lang WHERE Id_eventi = " . $Id_eventi . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }
    /**
     * ControlloTestiInseritiPdi
     *
     * @param  mixed $Id_pdi
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiPdi($Id_pdi, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_pdi_lang WHERE Id_pdi = " . $Id_pdi . " AND idsito = " . $idsito . " ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-10">Compila i testi!</label>';
            }
            return $return_value;
        }
    }
    /**
     * ContoTestiPdi
     *
     * @param  mixed $Id_pdi
     * @param  mixed $idsito
     * @return void
     */
    public function ContoTestiPdi($Id_pdi, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT COUNT(id) as numero FROM hospitality_pdi_lang WHERE Id_pdi = " . $Id_pdi . " AND idsito = " . $idsito . " ";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];

        return $rec['numero'];

    }
    /**
     * ControlloTestiInseritiAltroContenutoEmail
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiAltroContenutoEmail($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " AND testo != '' ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }
    /**
     * get_name_template
     *
     * @param  mixed $idsito
     * @param  mixed $type
     * @return void
     */
    public function get_name_template($idsito, $type)
    {
        global $dbMysqli;

        $sql = "SELECT TemplateName FROM hospitality_template_background WHERE idsito = " . $idsito . " AND TemplateType = '" . $type . "'";
        $rs = $dbMysqli->query($sql);
        $rc = $rs[0];
        $NomeTemplate = $rc['TemplateName'];

        return $NomeTemplate;
    }

    /**
     * ControlloTestiInseritiAltroContenutoTemplate
     *
     * @param  mixed $id_dizionario
     * @param  mixed $idsito
     * @return void
     */
    public function ControlloTestiInseritiAltroContenutoTemplate($id_dizionario, $idsito)
    {
        global $dbMysqli;
        $select = "SELECT GROUP_CONCAT(DISTINCT CONCAT(Lingua,' ') SEPARATOR ' ') AS lingue FROM hospitality_dizionario_lingua WHERE id_dizionario = " . $id_dizionario . " AND idsito = " . $idsito . " AND testo != '' ORDER BY Id DESC";
        $record_ = $dbMysqli->query($select);
        $rec = $record_[0];
        if (strlen($rec['lingue']) == 2) {
            return '<img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $rec['lingue'] . '.png">';
        } else { // se il campo contiene più codici di lingua
            $lingue = explode(' ', $rec['lingue']); // i codici di lingua devono essere separati da spazio
            arsort($lingue);
            foreach ($lingue as $val) {
                if (strlen($val) == 2) {
                    $return_value .= ' <img class="image_flag" src="' . BASE_URL_SITO . 'img/flags/' . $val . '.png"> ';
                }
            }
            if (!$return_value) {
                return '<label class="badge badge-default bg-danger f-11">Compila i testi!</label>';
            }
            return $return_value;
        }
    }
    /**
     * check_screenshot
     *
     * @param  mixed $template
     * @return void
     */
    public function check_screenshot($template)
    {

        switch ($template) {
            case 'default':
                $img = '<img src="' . BASE_URL_SITO . 'img/thumb-default.png" style="width:40px">';
                break;
            case 'smart':
                $img = '<img src="' . BASE_URL_SITO . 'img/thumb-smart.png" style="width:40px">';
                break;
            case 'family':
                $img = '<img src="' . BASE_URL_SITO . 'img/thumb-family.png">';
                break;
            case 'bike':
                $img = '<img src="' . BASE_URL_SITO . 'img/thumb-bike.png">';
                break;
            case 'romantico':
                $img = '<img src="' . BASE_URL_SITO . 'img/thumb-romantico.png">';
                break;
            default:
                $img = '';
                break;
        }

        return $img;
    }
    /**
     * color_selector
     *
     * @param  mixed $Id
     * @param  mixed $idsito
     * @return void
     */
    public function color_selector($Id, $idsito,$background=null)
    {
        global $dbMysqli;
        $select = "SELECT * FROM hospitality_template_colori WHERE idsito = " . $idsito . " ";
        $res = $dbMysqli->query($select);
        $input_select = '';

        foreach ($res as $key => $val) {
            $input_select .= '<option value="' . $val['Background'] . '" data-color="' . $val['Background'] . '" ' . ($background == $val['Background'] ? 'selected="selected"' : '') . '>' . $val['Background'] . '</option>' . "\r\n";
        }

        return ' <select name="Background" class="form-control" id="Background' . $Id . '" style="height:auto">'
            . '  ' . $input_select . ' '
            . ' </select>  '
            . ' <script type="text/javascript">'
            . '  $(function() {'
            . '    $(\'#Background' . $Id . '\').colorselector();'
            . '  });'
            . ' </script>';
    }
    public function countRowsProfila($anno = null, $idsito)
    {
        global $dbMysqli;

        if ($anno != '') {
            $and = "AND ( YEAR ( hospitality_guest.DataRichiesta ) = '" . $anno . "' OR YEAR ( hospitality_guest.DataChiuso ) = '" . $anno . "')";
        } else {
            $and = '';
        }

        $sel = "SELECT COUNT(Id) as num FROM hospitality_guest  WHERE idsito = " . $idsito . " " . $and;
        $res = $dbMysqli->query($sel);
        $rwc = $res[0];
        return $rwc['num'];
    }

    /**
     * statisticheOperatore
     *
     * @param  mixed $idsito
     * @return void
     */
    public function statisticheOperatore($data = null, $idsito)
    {
        global $dbMysqli;

        if ($data != '') {
            $data = $data;
            $filter_query = " AND DATE(DataChiuso) = '" . $data . "'";
            $filter_query_invio = " AND DataInvio = '" . $data . "'";
        } else {
            if($_REQUEST['anno'] == ''){
                $data = date('Y');
                $filter_query = " AND YEAR(DataChiuso) = '" . $data . "'";
                $filter_query_invio = " AND YEAR(DataInvio) = '" . $data . "'";
            }else{
                $data = $_REQUEST['anno'];
                $filter_query = " AND YEAR(DataChiuso) = '" . $data . "'";
                $filter_query_invio = " AND YEAR(DataInvio) = '" . $data . "'";
            }

        }


        // Query per filtrare ele operazioni effettuate dagli operatori di QUOTO
        $select = "SELECT * FROM hospitality_operatori WHERE idsito = " . IDSITO . " AND Abilitato = 1";
        $re = $dbMysqli->query($select);

        $op .= ' <table class="table table-striped">
					<tr>
					<th></th>
					<th></th>
					<th class="nowrap"><small>Preventivi Inviati</small> <i class="fa fa-info-circle" data-toggle="tooltip" title="Questa colonna viene filtrata per DATA INVIO"></i></th>
					<th class="nowrap"><small>In trattativa<small> (da inviare)</small></small> <i class="fa fa-info-circle" data-toggle="tooltip" title="Questa colonna viene filtrata per DATA INVIO"></i></th>
					<th class="nowrap"><small>Prenotazioni Chiuse</small> <i class="fa fa-info-circle" data-toggle="tooltip" title="Questa colonna viene filtrata per DATA PRENOTAZIONE"></i></th>
					<th class="nowrap"><small>Preno Disdette</small> <i class="fa fa-info-circle" data-toggle="tooltip" title="Questa colonna viene filtrata per DATA PRENOTAZIONE"></i</th>
					<th class="nowrap"><small>Preno Archiviate</small> <i class="fa fa-info-circle" data-toggle="tooltip" title="Questa colonna viene filtrata per DATA PRENOTAZIONE"></i</th>
				</tr>';

        $sele = '';
        $seleC = '';
        $selex = '';
        $seleCl = '';
        $seleA = '';
        $n_accettate = '';
        $n_inviate = '';
        $n_conf = '';
        $n_prenotazioni = '';
        $operatore = '';
        $email_operatore = '';

        foreach ($re as $c => $vl) {

            $operatore = trim(addslashes($vl['NomeOperatore']));
            $email_operatore = trim($vl['EmailSegretaria']);
            if ($vl['img'] != '') {
                $img = '<img src="' . BASE_URL_SITO . '/uploads/' . IDSITO . '/' . $vl['img'] . '" class="img-circle" data-toogle="tooltip" title="Operatore: ' . $operatore . '" style="width:18px;height:18px">';
            } else {
                $img = '<i class="fa fa-user" data-toogle="tooltip" title="Operatore: ' . $operatore . '"></i>';
            }


            //PREVENTIVI INVIATI
            $selex = "SELECT COUNT(Id) as n_inviate FROM hospitality_guest WHERE TipoRichiesta = 'Preventivo' AND ChiPrenota = '" . $operatore . "'  AND idsito = " . IDSITO . "  AND Inviata = 1 AND DataInvio IS NOT NULL " . $filter_query_invio . "";
            $risx = $dbMysqli->query($selex);
            $recordx = $risx[0];

            $n_inviate = $recordx['n_inviate'];

            //CONFERME IN ATTESA
            $seleC = "SELECT COUNT(Id) as n_conf FROM hospitality_guest WHERE TipoRichiesta = 'Conferma' AND ChiPrenota = '" . $operatore . "'  AND idsito = " . IDSITO . "  AND Chiuso = 0 AND DataInvio IS  NULL " . $filter_query_invio . "";
            $risC = $dbMysqli->query($seleC);
            $recordC = $risC[0];

            $n_conf = $recordC['n_conf'];

            //PRENO CHIUSEA
            $seleCl = "SELECT COUNT(Id) as n_prenotazioni FROM hospitality_guest WHERE TipoRichiesta = 'Conferma' AND ChiPrenota = '" . $operatore . "'  AND idsito = " . IDSITO . "  AND Chiuso = 1 AND DataChiuso IS NOT NULL " . $filter_query . "";
            $risCl = $dbMysqli->query($seleCl);
            $recordCl = $risCl[0];

            $n_prenotazioni = $recordCl['n_prenotazioni'];

            //PRENO DISDETTE
            $seleD = "SELECT COUNT(Id) as n_disdette FROM hospitality_guest WHERE TipoRichiesta = 'Conferma' AND ChiPrenota = '" . $operatore . "'  AND idsito = " . IDSITO . " AND Disdetta = 1  AND Chiuso = 1 AND DataChiuso IS NOT NULL " . $filter_query . "";
            $risD = $dbMysqli->query($seleD);
            $recordD = $risD[0];

            $n_disdette = $recordD['n_disdette'];

            //PRENO ARCHIVIATE
            $seleA = "SELECT COUNT(Id) as tot_preno_archiv FROM hospitality_guest  WHERE TipoRichiesta = 'Conferma' AND ChiPrenota = '" . $operatore . "'  AND idsito = " . IDSITO . "  AND Archivia = 1 AND Chiuso = 1 AND DataChiuso IS NOT NULL " . $filter_query . "";
            $risA = $dbMysqli->query($seleA);
            $recordA = $risA[0];

            $n_archiviate = $recordA['tot_preno_archiv'];

            $op .= '<tr>
						<td class="text-center">' . $img . '</td>
						<td><b style="white-space: nowrap;" class="f-11">' . (strlen($operatore) <= 11 ? $operatore : substr($operatore, 0, 11) . '...') . '</b></td>
						<td class="text-center  f-11" style="white-space: nowrap!important;"><div class="cerchio">' . $n_inviate . '</div>&nbsp;&nbsp;<i class="fa fa-envelope text-green"></i></td>
						<td class="text-center  f-11" style="white-space: nowrap!important;"><div class="cerchio">' . $n_conf . '</div>&nbsp;&nbsp;<i class="fa fa-bed text-yellow"></i></td>
						<td class="text-center  f-11" style="white-space: nowrap!important;"><div class="cerchio">' . $n_prenotazioni . '</div>&nbsp;&nbsp;<i class="fa fa-h-square text-aqua"></i></td>
						<td class="text-center  f-11" style="white-space: nowrap!important;"><div class="cerchio">' . $n_disdette . '</div>&nbsp;&nbsp;<i class="fa fa-minus-circle text-red"></i></td>
						<td class="text-center  f-11" style="white-space: nowrap!important;"><div class="cerchio">' . $n_archiviate . '</div>&nbsp;&nbsp;<i class="fa fa-font text-purple"></i></td>
						</tr>';

        }

        $op .= '</table>';

        return $op;
    }
    /**
     * countRowsArchivio
     *
     * @param  mixed $anno
     * @param  mixed $idsito
     * @return void
     */
    public function countRowsArchivio($anno = null, $idsito)
    {
        global $dbMysqli;

        if ($anno != '') {
            $and = "AND ( YEAR ( hospitality_guest.DataRichiesta ) = '" . $anno . "' OR YEAR ( hospitality_guest.DataChiuso ) = '" . $anno . "')";
        } else {
            $and = '';
        }

        $sel = "SELECT COUNT(Id) as num FROM hospitality_guest  WHERE idsito = " . $idsito . " AND Archivia = 1 " . $and;
        $res = $dbMysqli->query($sel);
        $rwc = $res[0];
        return $rwc['num'];
    }
    /**
     * crea_url
     *
     * @param  mixed $url_base
     * @param  mixed $pagina
     * @return void
     */
    public function crea_url($url_base, $pagina)
    {
        if (strpos($url_base, '?') === false) {
            return $url_base . '&pag=' . $pagina;
        } else {
            return $url_base . '&amp;pag=' . $pagina;
        }
    }

    /**
     * crea_link
     *
     * @param  mixed $url_base
     * @param  mixed $pagina_corrente
     * @param  mixed $numero_pagina
     * @return void
     */
    public function crea_link($url_base, $pagina_corrente, $numero_pagina)
    {
        if ($pagina_corrente == $numero_pagina) {
            return "<li class=\"paginate_button page-item active\"><a class=\"page-link\" href=\"#\">$numero_pagina</a></li>";
        } else {
            return '<li class="paginate_button page-item"><a class="page-link" href="' . $this->crea_url($url_base, $numero_pagina) . '">' . $numero_pagina . '</a></li>';
        }
    }

    // funzione che crea i link alle pagine dei risultati
    /**
     * paginazione
     *
     * @param  mixed $tot_pagine
     * @param  mixed $url_base
     * @param  mixed $pagina_corrente
     * @param  mixed $pagine_vicine
     * @return void
     */
    public function paginazione($tot_pagine, $url_base, $pagina_corrente, $pagine_vicine)
    {
        //$link_paginazione = "Pagine: ";

        // link alla pagina precedente
        if ($pagina_corrente != 1) {
            $link_paginazione .= '<li class="paginate_button page-item"><a class="page-link" href="' . $this->crea_url($url_base, $pagina_corrente - 1) . '">Precedente</a></li> ';
        }

        // mostriamo sempre il link alla prima pagina
        $link_paginazione .= $this->crea_link($url_base, $pagina_corrente, 1);

        // se il prossimo link non è alla seconda pagina aggiungo dei puntini ...
        // oppure la sola pagina mancante
        if ($pagina_corrente - $pagine_vicine > 2) {
            if ($pagina_corrente - $pagine_vicine == 3) {
                $link_paginazione .= " " . $this->crea_link($url_base, $pagina_corrente, 2);
            } else {
                $link_paginazione .= "<li class=\"paginate_button page-item\"><a class=\"page-link\" href=\"#\"> ... </a></li>";
            }
        }

        // creo i link alla pagina corrente ed a quelle ad essa vicine
        for ($i = $pagina_corrente - $pagine_vicine; $i <= $pagina_corrente + $pagine_vicine; $i++) {
            // se tra quelle vicine c'è la prima pagina (già riportata)
            if ($i < 2) {
                continue;
            }

            // se tra quelle vicine c'è l'ultima pagina (che mostrerò con le prossime istruzioni)
            if ($i > $tot_pagine - 1) {
                continue;
            }

            $link_paginazione .= " " . $this->crea_link($url_base, $pagina_corrente, $i);
        }

        // se il precedente link non era alla penultima pagina aggiungo dei puntini ...
        // oppure la sola pagina mancante
        if ($pagina_corrente + $pagine_vicine < $tot_pagine - 1) {
            if ($pagina_corrente + $pagine_vicine == $tot_pagine - 2) {
                $link_paginazione .= " " . $this->crea_link($url_base, $pagina_corrente, $tot_pagine - 1) . " ";
            } else {
                $link_paginazione .= "<li class=\"paginate_button page-item\"><a class=\"page-link\" href=\"#\"> ... </a></li>";
            }
        }

        // mostriamo il link all'ultima pagina se questa non coincide con la prima
        if ($tot_pagine != 1) {
            $link_paginazione .= " " . $this->crea_link($url_base, $pagina_corrente, $tot_pagine);
        }

        // link alla pagina successiva
        if ($pagina_corrente != $tot_pagine) {
            $link_paginazione .= '<li class="paginate_button page-item"> <a class="page-link" href="' . $this->crea_url($url_base, $pagina_corrente + 1) . '">Successivo</a></li>';
        }

        return "<ul class=\"pagination\">$link_paginazione</ul><div class=\"clearfix p-b-30\"></div>";
    }

/**
 * numeroRecord
 *
 * @param  mixed $tabella
 * @param  mixed $idsito
 * @param  mixed $campo
 * @param  mixed $parametro
 * @param  mixed $anno
 * @return void
 */
    public function numeroRecord($tabella, $idsito, $campo = null, $parametro = null, $anno = null)
    {
        global $dbMysqli;

        $select = "  SELECT
                	*
				FROM
					$tabella
				WHERE
					idsito = $idsito ";
        if (($campo) && ($parametro)) {
            $select .= " AND
						$campo  = $parametro ";
        }
        if ($anno) {
            $select .= " AND
						(YEAR(DataRichiesta) = '$anno' OR YEAR(DataChiuso) = '$anno')";
        }

        $result = $dbMysqli->query($select);
        $tot_righe = sizeof($result);

        return $tot_righe;
    }
/**
 * countRowsCestinate
 *
 * @param  mixed $idsito
 * @return void
 */
    public function countRowsCestinate($idsito)
    {
        global $dbMysqli;

        $sel = "SELECT COUNT(Id) as num FROM hospitality_guest  WHERE idsito = " . $idsito . " AND Hidden = 1 ";
        $res = $dbMysqli->query($sel);
        $rwc = $res[0];
        return $rwc['num'];
    }
/**
 * countRowsAnnullate
 *
 * @param  mixed $idsito
 * @return void
 */
    public function countRowsAnnullate($idsito)
    {
        global $dbMysqli;

        $sel = "SELECT COUNT(Id) as num FROM hospitality_guest  WHERE idsito = " . $idsito . " AND NoDisponibilita = 1 AND Hidden = 0 ";
        $res = $dbMysqli->query($sel);
        $rwc = $res[0];
        return $rwc['num'];
    }
/**
 * countRowsDisdette
 *
 * @param  mixed $idsito
 * @return void
 */
    public function countRowsDisdette($idsito)
    {
        global $dbMysqli;

        $sel = "SELECT
				COUNT(Id) as num
			FROM
				hospitality_guest
			WHERE
				idsito = " . $idsito . "
			AND
				Disdetta = 1
			AND
				hospitality_guest.TipoRichiesta = 'Conferma'
			AND
				hospitality_guest.Hidden = 0
			AND
				hospitality_guest.Archivia = 0

			AND
				hospitality_guest.Chiuso = 1 ";
        $res = $dbMysqli->query($sel);
        $rwc = $res[0];
        return $rwc['num'];
    }
/**
 * countRowsPrenotazioni
 *
 * @param  mixed $idsito
 * @return void
 */
    public function countRowsPrenotazioni($idsito)
    {
        global $dbMysqli;

        $anno_precendente_ = mktime(0, 0, 0, '06', '01', (date('Y') - 1));
        $anno_precedente = date('Y-m-d', $anno_precendente_);

        $sel = "SELECT
				COUNT(Id) as num
			FROM
				hospitality_guest
			WHERE
				hospitality_guest.idsito = " . $idsito . "
			AND
				hospitality_guest.TipoRichiesta = 'Conferma'
			AND
				hospitality_guest.Hidden = 0
			AND
				hospitality_guest.Archivia = 0
			AND
				hospitality_guest.Disdetta = 0
			AND
				hospitality_guest.Chiuso = 1
			AND
				(hospitality_guest.IdMotivazione IS NULL OR hospitality_guest.DataRiconferma IS NOT NULL)
			AND
				hospitality_guest.CheckinOnlineClient = 0
			AND
				hospitality_guest.NoDisponibilita = 0 ";
        if ($this->checkNumberRows($idsito) == 1) {
            $sel .= " AND
				(hospitality_guest.DataRichiesta >= '" . $anno_precedente . "' OR hospitality_guest.DataChiuso >= '" . $anno_precedente . "')";
        }

        $res = $dbMysqli->query($sel);
        $rwc = $res[0];
        return $rwc['num'];
    }
/**
 * numeroRecordPrenotazioni
 *
 * @param  mixed $idsito
 * @return void
 */
    public function numeroRecordPrenotazioni($idsito)
    {
        global $dbMysqli;

        $anno_precendente_ = mktime(0, 0, 0, '06', '01', (date('Y') - 1));
        $anno_precedente = date('Y-m-d', $anno_precendente_);

        $select = "  SELECT
						*
					FROM
						hospitality_guest
					WHERE
						hospitality_guest.idsito = " . $idsito . "
					AND
						hospitality_guest.TipoRichiesta = 'Conferma'
					AND
						hospitality_guest.Hidden = 0
					AND
						hospitality_guest.Archivia = 0
					AND
						hospitality_guest.Disdetta = 0
					AND
						hospitality_guest.Chiuso = 1
					AND
						(hospitality_guest.IdMotivazione IS NULL OR hospitality_guest.DataRiconferma IS NOT NULL)
					AND
						hospitality_guest.CheckinOnlineClient = 0
					AND
					hospitality_guest.NoDisponibilita = 0 ";
        if ($this->checkNumberRows($idsito) == 1) {
            $select .= " AND
					(hospitality_guest.DataRichiesta >= '" . $anno_precedente . "' OR hospitality_guest.DataChiuso >= '" . $anno_precedente . "')";
        }
        $result = $dbMysqli->query($select);
        $tot_righe = sizeof($result);

        return $tot_righe;
    }
/**
 * countRowsPreventivi
 *
 * @param  mixed $idsito
 * @return void
 */
    public function countRowsPreventivi($idsito)
    {
        global $dbMysqli;

        $anno_precendente_ = mktime(0, 0, 0, '06', '01', (date('Y') - 1));
        $anno_precedente = date('Y-m-d', $anno_precendente_);

        $sel = "SELECT
				COUNT(Id) as num
			FROM
				hospitality_guest
			WHERE
				hospitality_guest.idsito = " . $idsito . "
				AND
				hospitality_guest.TipoRichiesta = 'Preventivo'
			AND
				hospitality_guest.Hidden = 0
			AND
				hospitality_guest.Archivia = 0
			AND
				hospitality_guest.Chiuso = 0
			AND
				hospitality_guest.Accettato = 0
			AND
				hospitality_guest.NoDisponibilita = 0 ";
        if ($this->checkNumberRows($idsito) == 1) {
            $sel .= " AND
				hospitality_guest.DataRichiesta >= '" . $anno_precedente . "'";
        }

        $res = $dbMysqli->query($sel);
        $rwc = $res[0];
        return $rwc['num'];
    }
/**
 * numeroRecordPreventivi
 *
 * @param  mixed $idsito
 * @return void
 */
    public function numeroRecordPreventivi($idsito)
    {
        global $dbMysqli;

        $anno_precendente_ = mktime(0, 0, 0, '06', '01', (date('Y') - 1));
        $anno_precedente = date('Y-m-d', $anno_precendente_);

        $select = "  SELECT
						*
					FROM
						hospitality_guest
					WHERE
						hospitality_guest.idsito = " . $idsito . "
				AND
					hospitality_guest.TipoRichiesta = 'Preventivo'
				AND
					hospitality_guest.Hidden = 0
				AND
					hospitality_guest.Archivia = 0
				AND
					hospitality_guest.Chiuso = 0
				AND
					hospitality_guest.Accettato = 0
				AND
					hospitality_guest.NoDisponibilita = 0";
        if ($this->checkNumberRows($idsito) == 1) {
            $select .= " AND
						hospitality_guest.DataRichiesta >= '" . $anno_precedente . "'";
        }
        $result = $dbMysqli->query($select);
        $tot_righe = sizeof($result);

        return $tot_righe;
    }
    public function numeroRecordProfila($idsito, $postdata, $anno = null)
    {
        global $dbMysqli;

        $anno_precendente_ = mktime(0, 0, 0, '06', '01', (date('Y') - 1));
        $anno_precedente = date('Y-m-d', $anno_precendente_);

        if ($postdata['action'] == 'search') {

            if ($postdata['TipoRichiesta'] != '') {
                if ($postdata['TipoRichiesta'] == 'Preventivo') {
                    $andSelect .= " AND hospitality_guest.TipoRichiesta =  '" . $postdata['TipoRichiesta'] . "'";
                } elseif ($postdata['TipoRichiesta'] == 'Conferma') {
                    $andSelect .= " AND hospitality_guest.TipoRichiesta =  '" . $postdata['TipoRichiesta'] . "'";
                    $andSelect .= " AND hospitality_guest.Chiuso =  0";
                } elseif ($postdata['TipoRichiesta'] == 'ConfermaC') {
                    $andSelect .= " AND hospitality_guest.TipoRichiesta =  'Conferma'";
                    $andSelect .= " AND hospitality_guest.Chiuso =  1";
                }
            }

            if ($postdata['TipoSoggiorno'] != '' && $postdata['TipoCamere'] == '') {
                $join = " INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id";
                $andSelect .= " AND hospitality_richiesta.TipoSoggiorno =  " . $postdata['TipoSoggiorno'] . "";
            }
            if ($postdata['TipoCamere'] != '' && $postdata['TipoSoggiorno'] == '') {
                $join = " INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id";
                $andSelect .= " AND hospitality_richiesta.TipoCamere = " . $postdata['TipoCamere'] . "";
            }
            if ($postdata['TipoCamere'] != '' && $postdata['TipoSoggiorno'] != '') {
                $join = " INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id";
                $andSelect .= " AND hospitality_richiesta.TipoCamere = " . $postdata['TipoCamere'] . "";
                $andSelect .= " AND hospitality_richiesta.TipoSoggiorno =  " . $postdata['TipoSoggiorno'] . "";
            }
            if ($postdata['NumeroPrenotazione'] != '') {
                $andSelect .= " AND hospitality_guest.NumeroPrenotazione = " . $postdata['NumeroPrenotazione'] . "";
            }
            if ($postdata['Lingua'] != '') {
                $andSelect .= " AND hospitality_guest.Lingua =  '" . $postdata['Lingua'] . "'";
            }
            if ($postdata['FontePrenotazione'] != '') {
                $andSelect .= " AND hospitality_guest.FontePrenotazione = '" . $postdata['FontePrenotazione'] . "'";
            }
            if ($postdata['TipoVacanza'] != '') {
                $andSelect .= " AND hospitality_guest.TipoVacanza LIKE '%" . $postdata['TipoVacanza'] . "%'";
            }
            if ($postdata['Nome'] != '' && $postdata['Cognome'] == '') {
                $andSelect .= " AND hospitality_guest.Nome LIKE '%" . $postdata['Nome'] . "%'";
            }
            if ($postdata['Cognome'] != '' && $postdata['Nome'] == '') {
                $andSelect .= " AND hospitality_guest.Cognome LIKE '%" . $postdata['Cognome'] . "%'";
            }
            if ($postdata['Chiuso'] != '') {
                $andSelect .= " AND hospitality_guest.Chiuso =  " . $postdata['Chiuso'] . "";
            }
            if ($postdata['Disdetta'] != '') {
                $andSelect .= " AND hospitality_guest.Disdetta =  " . $postdata['Disdetta'] . "";
            }
            if ($postdata['CS_inviato'] != '') {
                $andSelect .= " AND hospitality_guest.CS_inviato =  " . $postdata['CS_inviato'] . "";
            }
            if ($postdata['IdMotivazione'] != '') {
                $andSelect .= " AND hospitality_guest.IdMotivazione =  " . $postdata['IdMotivazione'] . "";
            }
            if ($postdata['NoDisponibilita'] != '') {
                $andSelect .= " AND hospitality_guest.NoDisponibilita =  " . $postdata['NoDisponibilita'] . "";
            }
            if ($postdata['CheckConsensoPrivacy'] != '') {
                $andSelect .= " AND hospitality_guest.CheckConsensoPrivacy =  " . $postdata['CheckConsensoPrivacy'] . "";
            }
            if ($postdata['CheckConsensoMarketing'] != '') {
                $andSelect .= " AND hospitality_guest.CheckConsensoMarketing =  " . $postdata['CheckConsensoMarketing'] . "";
            }
            if ($postdata['Archivia'] != '') {
                $andSelect .= " AND hospitality_guest.Archivia =  " . $postdata['Archivia'] . "";
            }
            if ($postdata['Hidden'] != '') {
                $andSelect .= " AND hospitality_guest.Hidden =  " . $postdata['Hidden'] . "";
            }
            if ($postdata['DataScadenza'] != '') {
                $andSelect .= " AND hospitality_guest.DataScadenza >= '" . $postdata['DataScadenza'] . "'";
            }
            if ($postdata['DataArrivo'] != '' && $postdata['DataPartenza'] == '') {
                $andSelect .= " AND hospitality_guest.DataArrivo >= '" . $postdata['DataArrivo'] . "'";
            }
            if ($postdata['DataArrivo'] != '' && $postdata['DataPartenza'] != '') {
                $andSelect .= " AND hospitality_guest.DataArrivo >= '" . $postdata['DataArrivo'] . "' AND hospitality_guest.DataPartenza <= '" . $postdata['DataPartenza'] . "'";
            }
            if ($postdata['DataRichiesta_dal'] != '' && $postdata['DataRichiesta_al'] == '') {
                $andSelect .= " AND hospitality_guest.DataRichiesta >= '" . $postdata['DataRichiesta_dal'] . "'";
            }
            if ($postdata['DataRichiesta_dal'] != '' && $postdata['DataRichiesta_al'] != '') {
                $andSelect .= " AND hospitality_guest.DataRichiesta >= '" . $postdata['DataRichiesta_dal'] . "' AND hospitality_guest.DataRichiesta <= '" . $postdata['DataRichiesta_al'] . "'";
            }
            if ($postdata['Arrivo_dal'] != '' && $postdata['Arrivo_al'] == '') {
                $andSelect .= " AND hospitality_guest.DataArrivo >= '" . $postdata['Arrivo_dal'] . "'";
            }
            if ($postdata['Arrivo_dal'] != '' && $postdata['Arrivo_al'] != '') {
                $andSelect .= " AND hospitality_guest.DataArrivo >= '" . $postdata['Arrivo_dal'] . "' AND hospitality_guest.DataArrivo <= '" . $postdata['Arrivo_al'] . "'";
            }
            if ($postdata['DataPrenotazione_dal'] != '' && $postdata['DataPrenotazione_al'] == '') {
                $andSelect .= " AND hospitality_guest.DataArrivo >= '" . $postdata['DataPrenotazione_dal'] . "'";
            }
            if ($postdata['DataPrenotazione_dal'] != '' && $postdata['DataPrenotazione_al'] != '') {
                $andSelect .= " AND hospitality_guest.DataChiuso >= '" . $postdata['DataPrenotazione_dal'] . "' AND hospitality_guest.DataChiuso <= '" . $postdata['DataPrenotazione_al'] . "'";
            }

        }
        $select = "SELECT
					*
				FROM
					hospitality_guest
				" . $join . "
				WHERE
					hospitality_guest.idsito = " . $idsito . " ";

        $select .= $andSelect . " ";

        if ($this->checkNumberRows($idsito) == 1) {
            $select .= " AND
					(hospitality_guest.DataRichiesta >= '" . $anno_precedente . "' OR hospitality_guest.DataChiuso >= '" . $anno_precedente . "')";
        }
        if ($anno) {
            $select .= " AND
						(YEAR(hospitality_guest.DataRichiesta) = '$anno' OR YEAR(hospitality_guest.DataChiuso) = '$anno')";
        }
        $result = $dbMysqli->query($select);
        $tot_righe = sizeof($result);

        return $tot_righe;
    }
/**
 * validating
 *
 * @param  mixed $phone
 * @return void
 */
    public function validating($phone)
    {
        if (preg_match('/^[0-9]{10}+$/', $phone)) {
            $result = '<div class="alert alert-success text-center f-11 lineHeigth m-t-5">Numero telefonico valido</div>';
        } else {
            $result = '<div class="alert alert-danger text-center f-11 lineHeigth  m-t-5">Numero telefonico NON valido</div>';
        }
        return $result;
    }
/**
 * func_stars
 *
 * @param  mixed $value
 * @return void
 */
    public function func_stars($value)
    {

        switch ($value) {
            case 1:
                $ico = '<div align="center"><img src="' . BASE_URL_SITO . 'img/emoji/bad.png" data-toogle="tooltip" title="Bad [valore = 1]"></div>';
                break;
            case 2:
                $ico = '<div align="center"><img src="' . BASE_URL_SITO . 'img/emoji/semi_bad.png" data-toogle="tooltip" title="Semi Bad [valore = 2]"></div>';
                break;
            case 3:
                $ico = '<div align="center"><img src="' . BASE_URL_SITO . 'img/emoji/medium.png" data-toogle="tooltip" title="Medium [valore = 3]"></div>';
                break;
            case 4:
                $ico = '<div align="center"><img src="' . BASE_URL_SITO . 'img/emoji/semi_good.png" data-toogle="tooltip" title="Semi Good [valore = 4]"></div>';
                break;
            case 5:
                $ico = '<div align="center"><img src="' . BASE_URL_SITO . 'img/emoji/good.png" data-toogle="tooltip" title="Good [valore = 5]"></div>';
                break;
        }

        return $ico;

    }

    /**
     * tipoRecensioneImpostata
     *
     * @param  mixed $idsito
     * @return void
     */
    public function tipoRecensioneImpostata($idsito)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_recensioni_range WHERE idsito = " . $idsito . " AND abilita = 1";
        $res = $dbMysqli->query($select);
        $check = sizeof($res);
        if ($check == 1) {
            $tipo = 'con range a punteggio';
        }
        $select2 = "SELECT * FROM hospitality_giorni_recensioni WHERE idsito = " . $idsito . " AND abilita = 1";
        $res2 = $dbMysqli->query($select2);
        $check2 = sizeof($res2);
        if ($check2 == 1) {
            $tipo = 'con filtro temporale';
        }
        if ($check == 0 && $check2 == 0) {
            $tipo = 'con invio manuale';
        }
        return $tipo;
    }

    /**
     * CheckMotivazioneAnnullate
     *
     * @param  mixed $id
     * @param  mixed $idsito
     * @return void
     */
    public function CheckMotivazioneAnnullate($id, $idsito)
    {
        global $dbMysqli;

        $select = "SELECT
					*
				FROM
					hospitality_motivi_disdetta
				WHERE
					idsito = " . $idsito . "
				AND
					IdRichiesta = " . $id . " ";
        $res = $dbMysqli->query($select);
        $record = $res[0];

        return $record;
    }

    /**
     * CountRichiesteRicevute
     *
     * @param  mixed $idsito
     * @param  mixed $fonte
     * @param  mixed $dal
     * @param  mixed $al
     * @return void
     */
    public function CountRichiesteRicevute($idsito, $fonte, $dal, $al)
    {
        global $dbMysqli;

        if ($dal == '' && $al == '') {
            $dal = date('Y') . '-01-01';
            $al = date('Y') . '-12-31';
        }
        $select = " 	SELECT COUNT(Id) as n
				FROM hospitality_guest as g
				WHERE g.idsito = " . $idsito . "
				AND g.FontePrenotazione = '" . $fonte . "'
                AND g.DataRichiesta >= '" . $dal . "'
				AND g.DataRichiesta <= '" . $al . "'
				AND g.TipoRichiesta = 'Preventivo'";

        $res = $dbMysqli->query($select);
        $record = $res[0]['n'];

        return $record;
    }
    /**
     * CountRichiesteInviate
     *
     * @param  mixed $idsito
     * @param  mixed $fonte
     * @param  mixed $dal
     * @param  mixed $al
     * @return void
     */
    public function CountRichiesteInviate($idsito, $fonte, $dal, $al)
    {
        global $dbMysqli;

        if ($dal == '' && $al == '') {
            $dal = date('Y') . '-01-01';
            $al = date('Y') . '-12-31';
        }
        $select = " 	SELECT COUNT(Id) as n
				FROM hospitality_guest as g
				WHERE g.idsito = " . $idsito . "
				AND g.FontePrenotazione = '" . $fonte . "'
                AND g.DataRichiesta >= '" . $dal . "'
				AND g.DataRichiesta <= '" . $al . "'
				AND g.TipoRichiesta = 'Preventivo'
				AND g.Hidden = 0
				AND g.Inviata = 1
				AND g.NoDisponibilita = 0
				AND g.Disdetta = 0 ";

        $res = $dbMysqli->query($select);
        $record = $res[0]['n'];

        return $record;
    }
    /**
     * CountRichiesteConfermate
     *
     * @param  mixed $idsito
     * @param  mixed $fonte
     * @param  mixed $dal
     * @param  mixed $al
     * @return void
     */
    public function CountRichiesteConfermate($idsito, $fonte, $dal, $al)
    {
        global $dbMysqli;

        if ($dal == '' && $al == '') {
            $dal = date('Y') . '-01-01';
            $al = date('Y') . '-12-31';
        }
        $select = " 	SELECT COUNT(Id) as n
				FROM hospitality_guest as g
				WHERE g.idsito = " . $idsito . "
				AND g.FontePrenotazione = '" . $fonte . "' AND((g.DataRichiesta >= '" . $dal . "'
																AND g.DataRichiesta <= '" . $al . "') OR(g.DataChiuso IS NOT NULL
																											AND DATE(g.DataChiuso) >= '" . $dal . "'
																											AND DATE(g.DataChiuso) <= '" . $al . "'))
				AND g.TipoRichiesta = 'Conferma'
				AND g.Hidden = 0
				AND g.NoDisponibilita = 0
				AND g.Disdetta = 0 ";

        $res = $dbMysqli->query($select);
        $record = $res[0]['n'];

        return $record;
    }

    /**
     * CountRichiesteAnnullate
     *
     * @param  mixed $idsito
     * @param  mixed $fonte
     * @param  mixed $dal
     * @param  mixed $al
     * @return void
     */
    public function CountRichiesteAnnullate($idsito, $fonte, $dal, $al)
    {
        global $dbMysqli;

        if ($dal == '' && $al == '') {
            $dal = date('Y') . '-01-01';
            $al = date('Y') . '-12-31';
        }
        $select = " 	SELECT COUNT(Id) as n
				FROM hospitality_guest as g
				WHERE g.idsito = " . $idsito . "
				AND g.FontePrenotazione = '" . $fonte . "' AND((g.DataRichiesta >= '" . $dal . "'
																AND g.DataRichiesta <= '" . $al . "') OR(
																DATE(g.DataChiuso) >= '" . $dal . "'
																AND DATE(g.DataChiuso) <= '" . $al . "'))
				AND g.TipoRichiesta = 'Conferma'
				AND g.Hidden = 0
				AND g.NoDisponibilita = 1
				AND g.Disdetta = 0 ";

        $res = $dbMysqli->query($select);
        $record = $res[0]['n'];

        return $record;
    }

    /**
     * CountRichiesteRicevuteAds
     *
     * @param  mixed $idsito
     * @param  mixed $s
     * @param  mixed $m
     * @param  mixed $dal
     * @param  mixed $al
     * @return void
     */
    public function CountRichiesteRicevuteAds($idsito, $s, $m, $dal, $al)
    {
        global $dbMysqli;

        if ($s != '') {
            $andSource = "	AND c.source = '" . $s . "'";
        }
        if ($dal == '' && $al == '') {
            $dal = date('Y') . '-01-01';
            $al = date('Y') . '-12-31';
        }
        $select = " 	SELECT (g.Id) as n
				FROM hospitality_guest as g
				INNER JOIN hospitality_client_id ci ON ci.NumeroPrenotazione = g.NumeroPrenotazione
            	INNER JOIN hospitality_custom_dimension_ga4 as c ON  c.clientid = ci.CLIENT_ID AND c.idsito = " . $idsito . "
				WHERE ci.idsito = " . $idsito . "
				 " . $andSource . "
				AND c.medium = '" . $m . "'
				AND g.idsito = " . $idsito . "
				AND g.DataRichiesta >= '" . $dal . "'
				AND g.DataRichiesta <= '" . $al . "'
				AND g.TipoRichiesta = 'Preventivo'
                AND g.FontePrenotazione = 'Sito Web'
                GROUP by c.clientid,
                g.NumeroPrenotazione";

        $res = $dbMysqli->query($select);
        $record = sizeof($res);
        if($record==0){
            $select2 = " 	SELECT (g.Id) as n
                    FROM hospitality_guest as g
                    INNER JOIN hospitality_client_id as ci ON ci.NumeroPrenotazione = g.NumeroPrenotazione
                    INNER JOIN hospitality_custom_dimension_ga4 as c ON  c.NumeroPrenotazione = ci.NumeroPrenotazione AND c.idsito = " . $idsito . "
                    WHERE ci.idsito = " . $idsito . "
                    " . $andSource . "
                    AND c.medium = '" . $m . "'
                    AND g.idsito = " . $idsito . "
                    AND g.DataRichiesta >= '" . $dal . "'
                    AND g.DataRichiesta <= '" . $al . "'
                    AND g.TipoRichiesta = 'Preventivo'
                    AND g.FontePrenotazione = 'Sito Web'
                    GROUP BY g.NumeroPrenotazione
                    ORDER BY c.sessionNumber DESC";

            $res2 = $dbMysqli->query($select2);
            $record2 = sizeof($res2);
        }

        return $record > 0 ? $record : $record2;
    }
    /**
     * CountRichiesteInviateAds
     *
     * @param  mixed $idsito
     * @param  mixed $s
     * @param  mixed $m
     * @param  mixed $dal
     * @param  mixed $al
     * @return void
     */
    public function CountRichiesteInviateAds($idsito, $s, $m, $dal, $al)
    {
        global $dbMysqli;

        if ($s != '') {
            $andSource = "	AND c.source = '" . $s . "'";
        }
        if ($dal == '' && $al == '') {
            $dal = date('Y') . '-01-01';
            $al = date('Y') . '-12-31';
        }
        $select = " 	SELECT (g.Id) as n
				FROM hospitality_guest as g
				INNER JOIN hospitality_client_id as ci ON ci.NumeroPrenotazione = g.NumeroPrenotazione
            	INNER JOIN hospitality_custom_dimension_ga4 as c ON c.clientid = ci.CLIENT_ID AND c.idsito = " . $idsito . "
				WHERE ci.idsito = " . $idsito . "
                " . $andSource . "
				AND c.medium = '" . $m . "'
				AND g.idsito = " . $idsito . "
                AND g.DataRichiesta >= '" . $dal . "'
                AND g.DataRichiesta <= '" . $al . "'
				AND g.TipoRichiesta = 'Preventivo'
                AND g.FontePrenotazione = 'Sito Web'
				AND g.Hidden = 0
				AND g.Inviata = 1
				AND g.NoDisponibilita = 0
				AND g.Disdetta = 0
                GROUP by c.clientid,
                g.NumeroPrenotazione";

        $res = $dbMysqli->query($select);
        $record = sizeof($res);
        if($record==0){
            $select2 = " 	SELECT (c.NumeroPrenotazione) as n
                    FROM hospitality_guest as g
                    INNER JOIN hospitality_client_id as ci ON ci.NumeroPrenotazione = g.NumeroPrenotazione
                    INNER JOIN hospitality_custom_dimension_ga4 as c ON c.NumeroPrenotazione = ci.NumeroPrenotazione AND c.idsito = " . $idsito . "
                    WHERE ci.idsito = " . $idsito . "
                    " . $andSource . "
                    AND c.medium = '" . $m . "'
                    AND g.idsito = " . $idsito . "
                    AND g.DataRichiesta >= '" . $dal . "'
                    AND g.DataRichiesta <= '" . $al . "'
                    AND g.TipoRichiesta = 'Preventivo'
                    AND g.FontePrenotazione = 'Sito Web'
                    AND g.Hidden = 0
                    AND g.Inviata = 1
                    AND g.NoDisponibilita = 0
                    AND g.Disdetta = 0
                    GROUP BY g.NumeroPrenotazione
                    ORDER BY c.sessionNumber DESC";

            $res2 = $dbMysqli->query($select2);
            $record2 = sizeof($res2);
        }

        return  ($record > 0 ? $record : $record2);
    }
    /**
     * CountRichiesteConfermateAds
     *
     * @param  mixed $idsito
     * @param  mixed $s
     * @param  mixed $m
     * @param  mixed $dal
     * @param  mixed $al
     * @return void
     */
    public function CountRichiesteConfermateAds($idsito, $s, $m, $dal, $al)
    {
        global $dbMysqli;

        if ($s != '') {
            $andSource = "	AND c.source = '" . $s . "'";
        }
        if ($dal == '' && $al == '') {
            $dal = date('Y') . '-01-01';
            $al = date('Y') . '-12-31';
        }
        $select = " 	SELECT (c.NumeroPrenotazione) as n
				FROM hospitality_guest as g
				INNER JOIN hospitality_client_id as ci ON ci.NumeroPrenotazione = g.NumeroPrenotazione
            	INNER JOIN hospitality_custom_dimension_ga4 as c
                        ON
                            c.clientid = ci.CLIENT_ID
                        OR
                            c.NumeroPrenotazione = ci.NumeroPrenotazione
				WHERE c.idsito = " . $idsito . "
                AND ci.idsito = " . $idsito . "
				 " . $andSource . "
				AND c.medium = '" . $m . "'
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
                GROUP BY g.NumeroPrenotazione";

        $res = $dbMysqli->query($select);
        $record = sizeof($res);


        return $record;
    }

    /**
     * fatturatoPerSitoweb
     *
     * @param  mixed $idsito
     * @param  mixed $dal
     * @param  mixed $al
     * @return void
     */
    public function fatturatoPerSitoweb($idsito, $dal, $al)
    {
        global $dbMysqli;

        $select2 = "SELECT SUM(hospitality_proposte.PrezzoP) as fatturato
                    FROM hospitality_guest
                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                    WHERE hospitality_guest.FontePrenotazione = 'Sito Web'
                    AND (
                        (hospitality_guest.DataRichiesta >= '$dal' AND hospitality_guest.DataRichiesta <= '$al')
                        OR
                        (hospitality_guest.DataChiuso IS NOT NULL AND hospitality_guest.DataChiuso >= '$dal' AND hospitality_guest.DataChiuso <= '$al')
                        )
                    AND hospitality_guest.idsito = " . IDSITO . "
                    AND hospitality_guest.NoDisponibilita = 0
                    AND hospitality_guest.Disdetta = 0
                    AND hospitality_guest.Hidden = 0
                    AND hospitality_guest.TipoRichiesta = 'Conferma' ";

        $res2 = $dbMysqli->query($select2);
        $rws2 = $res2[0];

        $fatturato = $rws2['fatturato'];

        if ($fatturato == '') $fatturato = 0;

        return $fatturato;
    }
    /**
     * get_propertyId_analyticsGA4
     *
     * @param  mixed $idsito
     * @return void
     */
    public function get_propertyId_analyticsGA4($idsito)
    {
        global $dbMysqli;

        $sql = "SELECT PropertyIdAnalyticsGA4 FROM siti WHERE idsito = " . $idsito;
        $rs = $dbMysqli->query($sql);
        $rc = $rs[0];
        $PropertyIdAnalyticsGA4 = $rc['PropertyIdAnalyticsGA4'];

        return $PropertyIdAnalyticsGA4;
    }


    /**
     * ADR
     *
     * @return void
     */
    public function ADR()
    {
        global $dbMysqli, $prima_data, $seconda_data;

        $select ='SELECT  	SUM(DATEDIFF( hospitality_proposte.Partenza, hospitality_proposte.Arrivo )) AS numero_camere,
                            FORMAT(SUM( hospitality_richiesta.Prezzo  ),2,"it_IT") as fatturato_camere
                    FROM hospitality_guest
                    INNER JOIN hospitality_proposte ON hospitality_proposte.id_richiesta = hospitality_guest.Id
                    INNER JOIN hospitality_richiesta ON hospitality_richiesta.id_richiesta = hospitality_guest.Id
                    WHERE 1=1
                    AND hospitality_guest.idsito = '.IDSITO.'
                    AND hospitality_richiesta.Prezzo != 0
                    AND hospitality_guest.Disdetta = 0
                    AND hospitality_guest.Hidden = 0
                    AND hospitality_guest.NoDisponibilita = 0
                    ' . ($_REQUEST['date'] == '' ?
                        'AND ((DataRichiesta>= "' . date('Y') . '-01-01" AND DataRichiesta <= "' . date('Y') . '-12-31")
                            OR (DATE(DataChiuso) >= "' . date('Y') . '-01-01" AND DATE(DataChiuso) <= "' . date('Y') . '-12-31"))'
                        :
                        'AND ((DataRichiesta >= "' . $prima_data . '" AND DataRichiesta <= "' . $seconda_data . '")
                            OR (DATE(DataChiuso) >= "' . $prima_data . '" AND DATE(DataChiuso) <= "' . $seconda_data . '"))'
                        ) . '
                    AND hospitality_guest.TipoRichiesta = "Conferma" ';
            $res = $dbMysqli->query($select);
            $rwc = $res[0];

             if($rwc['fatturato_camere']>0 && $rwc['numero_camere']>0){
                $ADR = ($rwc['fatturato_camere']/$rwc['numero_camere']);
            }else{
                $ADR = 0;
            }

            return $ADR;

    }

    /**
     * fatturatoBePerFonte
     *
     * @param  mixed $idsito
     * @param  mixed $s
     * @param  mixed $m
     * @param  mixed $dal
     * @param  mixed $al
     * @return void
     */
    public function fatturatoBePerFonte($idsito, $s, $m, $dal, $al)
    {
        global $dbMysqli;

            $sl = "SELECT
                        SUM(CONVERT(hospitality_adCost_transactionRevenue_ga4.fatturato, FLOAT)) as fatturato
                    FROM
                        hospitality_adCost_transactionRevenue_ga4
                    WHERE
                        hospitality_adCost_transactionRevenue_ga4.idsito = " . $idsito . "
                    AND
                        hospitality_adCost_transactionRevenue_ga4.source = '".$s."'
                    AND
                        hospitality_adCost_transactionRevenue_ga4.medium = '".$m."'
                    AND
                        hospitality_adCost_transactionRevenue_ga4.datastart >= '$dal'
                    AND
                        hospitality_adCost_transactionRevenue_ga4.dataend <= '$al'";



        $rec = $dbMysqli->query($sl);
        $output = $rec[0]['fatturato'];
        return $output;

    }
    /**
     * rel_infoBoxTag_template
     *
     * @param  mixed $idsito
     * @param  mixed $idInfoBox
     * @return void
     */
    public function rel_infoBoxTag_template($idsito,$idInfoBox)
    {
        global $dbMysqli;

        $arrayTemplate = array();

        $sel = "SELECT
                    hospitality_rel_infobox_template.id_template
                FROM
                    hospitality_rel_infobox_template
                WHERE
                    hospitality_rel_infobox_template.idsito = ".$idsito."
                AND
                    hospitality_rel_infobox_template.id_infobox = ".$idInfoBox." ";

        $res = $dbMysqli->query($sel);

        if(sizeof($res)>0){

            foreach ($res as $key => $value) {
                $arrayTemplate[] = $value['id_template'];
            }
        }
        return $arrayTemplate;
    }
    /**
     * associa_template
     *
     * @param  mixed $idsito
     * @param  mixed $idInfoBox
     * @param  mixed $disabled
     * @return void
     */
    public function associa_template($idsito,$idInfoBox, $disabled=null)
    {
        global $dbMysqli;

        $arrayTemplate = array();

        $sel = "SELECT
                    hospitality_template_background.Id,
                    hospitality_template_background.TemplateName
                FROM
                    hospitality_template_background
                WHERE
                    hospitality_template_background.idsito = ".$idsito."
                AND
                     hospitality_template_background.Visibile = 1
                ORDER BY
                    CASE
                        WHEN hospitality_template_background.Ordine != '' THEN Ordine
                        ELSE hospitality_template_background.Id
                    END
                      ASC";

        $res = $dbMysqli->query($sel);

        if(sizeof($res)>0){

            $output = '<div class="colonne_template">'."\r\n";

            foreach ($res as $key => $value) {

                    $arrayTemplate = $this->rel_infoBoxTag_template($idsito,$idInfoBox);

                    $output .= '<input type="checkbox" value="'.$value['Id'].'" '.(in_array($value['Id'],$arrayTemplate)?'checked="checked"':'').' name="id_template" id="idTemplate_'.$value['Id'].'_'.$idInfoBox.'" '.($disabled==1?'disabled="disabled"':'').'> <span  class="f-10 p-r-5">'.$value['TemplateName'].'</span>'."\r\n";
                    $output .= '<script>
                                    $(document).ready(function(){
                                        $("#idTemplate_'.$value['Id'].'_'.$idInfoBox.'").on("click",function(){
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/associa_infobox_template.php",
                                                type: "POST",
                                                data: "action=associa&id_template='.$value['Id'].'&idsito='.$idsito.'&id_infobox='.$idInfoBox.'",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#info_box").DataTable().ajax.reload();
                                                }
                                            });
                                            return false;
                                        })
                                    })
                                </script><br>'."\r\n";
            }

            $output .= '</div>'."\r\n";
        }
        return $output;
    }

    /**
     * check_non_archiviate
     *
     * @param  mixed $idsito
     * @param  mixed $anno
     * @return void
     */
    public function check_non_archiviate($idsito,$anno){
        global $dbMysqli;

        $select = " SELECT
                        *
                    FROM
                        hospitality_guest
                    WHERE
                        idsito = $idsito
                    AND
                        DataArrivo >= '".$anno."-01-01'
                    AND
                        DataPartenza <= '".$anno."-12-31'
                    AND
                        Archivia = 0 ";

            $res = $dbMysqli->query($select);
            $check = sizeof($res);

        return $check;


    }

    public function get_data_arrivo_conferma($data, $id)
    {
        global $dbMysqli;

        if($data != '') {


                $arrivo   = '';
                $d_arrivo = '';
                $d_value    = '';

                    $se = "SELECT hospitality_proposte.Arrivo FROM hospitality_proposte  WHERE hospitality_proposte.id_richiesta = ".$id." AND Arrivo IS NOT NULL";
                    $re = $dbMysqli->query($se);
                    $rc = $re[0];

                    $tt = sizeof($re);

                    if($tt>0){

                        if($data != $rc['Arrivo']){
                            if($rc['Arrivo']!= '' && $rc['Arrivo'] != '0000-00-00'){
                                $d_arrivo = date('d-m-Y' , strtotime($rc['Arrivo']));
                                $arrivo   = $d_arrivo;
                                $update = "UPDATE hospitality_guest SET DataArrivo = '".$rc['Arrivo']."' WHERE id = ".$id;
                                $dbMysqli->query($update);
                            }else{
                                $d_value  = date('d-m-Y' , strtotime($data));
                                $arrivo = $d_value;
                            }
                        }else{
                            $d_value  = date('d-m-Y' , strtotime($data));
                            $arrivo = $d_value;
                        }
                    }else{
                        $d_value  = date('d-m-Y' , strtotime($data));
                        $arrivo = $d_value;
                    }


        return $arrivo;
        }
    }

    public function get_data_partenza_conferma($data, $id)
    {
        global $dbMysqli;

        if($data != '') {


                $partenza   = '';
                $d_partenza = '';
                $d_value    = '';

                    $se = "SELECT hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.id_richiesta = ".$id." AND Partenza IS NOT NULL";
                    $re = $dbMysqli->query($se);
                    $rc = $re[0];

                    $tt = sizeof($re);

                    if($tt>0){

                        if($data != $rc['Partenza']){
                            if($rc['Partenza']!= '' && $rc['Partenza'] != '0000-00-00'){
                                $d_partenza = date('d-m-Y' , strtotime($rc['Partenza']));
                                $partenza   = $d_partenza;
                                $update = "UPDATE hospitality_guest SET DataPartenza = '".$rc['Partenza']."' WHERE id = ".$id;
                                $dbMysqli->query($update);
                            }else{
                                $d_value  = date('d-m-Y' , strtotime($data));
                                $partenza = $d_value;
                            }
                        }else{
                            $d_value  = date('d-m-Y' , strtotime($data));
                            $partenza = $d_value;
                        }
                    }else{
                        $d_value  = date('d-m-Y' , strtotime($data));
                        $partenza = $d_value;
                    }


        return $partenza;
        }
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
                            hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                        INNER JOIN
                                hospitality_custom_dimension_ga4 ON (
                                        hospitality_custom_dimension_ga4.clientid = hospitality_client_id.CLIENT_ID
                                    AND
                                        hospitality_client_id.CLIENT_ID != ''
                                    OR
                                        hospitality_custom_dimension_ga4.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione
                                    AND
                                        hospitality_custom_dimension_ga4.NumeroPrenotazione != ''
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
                            hospitality_custom_dimension_ga4.source = '".$source."'
                        AND
                            hospitality_custom_dimension_ga4.medium = '".$medium."'
                        AND
                            hospitality_client_id.idsito = ".$idsito."
                        AND
                            hospitality_custom_dimension_ga4.idsito = ".$idsito."
                        GROUP BY
                        hospitality_custom_dimension_ga4.clientid,
                            hospitality_guest.NumeroPrenotazione";

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
                            hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                        INNER JOIN
                                hospitality_custom_dimension_ga4 ON (
                                        hospitality_custom_dimension_ga4.clientid = hospitality_client_id.CLIENT_ID
                                    AND
                                        hospitality_client_id.CLIENT_ID != ''
                                    OR
                                        hospitality_custom_dimension_ga4.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione
                                    AND
                                        hospitality_custom_dimension_ga4.NumeroPrenotazione != ''
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
                            hospitality_custom_dimension_ga4.source = '".$source."'
                        AND
                            hospitality_custom_dimension_ga4.medium = '".$medium."'
                        AND
                            hospitality_client_id.idsito = ".$idsito."
                        AND
                            hospitality_custom_dimension_ga4.idsito = ".$idsito."
                        GROUP BY
                        hospitality_custom_dimension_ga4.clientid,
                            hospitality_guest.NumeroPrenotazione";

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
                            hospitality_client_id ON hospitality_client_id.NumeroPrenotazione = hospitality_guest.NumeroPrenotazione
                        INNER JOIN
                                hospitality_custom_dimension_ga4 ON (
                                        hospitality_custom_dimension_ga4.clientid = hospitality_client_id.CLIENT_ID
                                    AND
                                        hospitality_client_id.CLIENT_ID != ''
                                    OR
                                        hospitality_custom_dimension_ga4.NumeroPrenotazione = hospitality_client_id.NumeroPrenotazione
                                    AND
                                        hospitality_custom_dimension_ga4.NumeroPrenotazione != ''
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
                            hospitality_custom_dimension_ga4.source = '".$source."'
                        AND
                            hospitality_custom_dimension_ga4.medium = '".$medium."'
                        AND
                            hospitality_client_id.idsito = ".$idsito."
                        AND
                            hospitality_custom_dimension_ga4.idsito = ".$idsito."
                        GROUP BY
                        hospitality_custom_dimension_ga4.clientid,
                            hospitality_guest.NumeroPrenotazione";

        $rw = $dbMysqli->query($sql);
        $rwc = sizeof($rw);

            return $rwc;

    }

    function ReferralAds($idsito,$NumeroPrenotazione){
        global $dbMysqli,$filter_query,$idsito;

        $sql      = "   SELECT
                            hospitality_utm_ads.*
                        FROM
                            hospitality_utm_ads
                        WHERE
                            hospitality_utm_ads.idsito = ".$idsito."
                        AND
                            hospitality_utm_ads.NumeroPrenotazione = ".$NumeroPrenotazione." ";
        $rw = $dbMysqli->query($sql);
        if(sizeof($rw)>0){
            if($rw[0]['utm_source'] && $rw[0]['utm_medium'] && $rw[0]['utm_campaign']){
                $utm = '<div class="clearfix p-b-10"></div>
                        <div class="row f-13">
                            <div class="col-md-12 nowrap">
                                <b>Provenienza richiesta</b> <span style="position:absolute;top:8px"><i class="fa fa-level-down"></i></span>
                            </div>
                        </div>';
            }
            foreach($rw as $key => $val){
                if($val['utm_source']){
                    $utm .= '<div class="clearfix p-b-5"></div>
                                <div class="row f-11">
                                    <div class="col-md-5 nowrap"><b>Sorgente</b></div>
                                    <div class="col-md-7">'.$val['utm_source'].'</div>
                                </div>';
                }
                if($val['utm_medium']){
                    $utm .= '<div class="clearfix p-b-5"></div>
                                <div class="row f-11">
                                    <div class="col-md-5 nowrap"><b>Mezzo</b></div>
                                    <div class="col-md-7">'.$val['utm_medium'].'</div>
                                </div>';
                }
                if($val['utm_campaign']){
                    $utm .= '<div class="clearfix p-b-5"></div>
                                <div class="row f-11">
                                    <div class="col-md-5 nowrap"><b>Campagna</b></div>
                                    <div class="col-md-7">'.$val['utm_campaign'].'</div>
                                </div>';
                }
            }
        }
        return $utm;

    }
    
    function get_pag($idsito){
        global $dbMysqli;

        $select = "SELECT numero FROM hospitality_paginazione WHERE idsito = ".$idsito;
        $result = $dbMysqli->query($select);
        if(sizeof($result)>0){
            return $result[0]['numero'];  
        }else{
            return '';
        }
    }

    function check_listini($idsito)
    {
        global $dbMysqli;

        $select = "SELECT * FROM hospitality_numero_listini WHERE idsito = ".$idsito." AND Abilitato = 1";
        $result = $dbMysqli->query($select);
        if(sizeof($result)>0){
            return 1;  
        }else{
            return 0;
        }
    }


}
