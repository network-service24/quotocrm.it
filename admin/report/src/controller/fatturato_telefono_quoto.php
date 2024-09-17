<?php 

function getCSV($url)
{
    $data = file_get_contents($url);
    $rows = explode("\n", $data);
    $s = array();
    foreach ($rows as $index => $row) {
        if ($index == 0) continue; // salto l'intestazione

        $s[] = str_getcsv($row);
    }

    return $s;
}
function clean_($stringa){

	$clean = str_replace( "+39", "", $stringa);
	$clean = str_replace( "+41", "", $clean);
    $clean = str_replace( "+44", "", $clean);
    $clean = str_replace( "+49", "", $clean);
    $clean = str_replace( "+33", "", $clean);
    $clean = str_replace( "+34", "", $clean);
    $clean = str_replace( "+7", "", $clean);
	$clean = str_replace( " ", "", $clean);
	$clean = trim($clean);

	return($clean);
}
if($_POST['action'] == 'save_csv'){
     if($_FILES['csv']['name']!='' && $_POST['idsito']!=''){
        $file_path = BASE_PATH_ADMIN.'report/document/'.$_POST['idsito'].'/';
        if (!file_exists($file_path)) {
            mkdir($file_path);
            chmod($file_path,0755);
        }
        $name = 'csv_'.date('dmY') .'_'.$_POST['idsito'].'.csv';
        $select = "SELECT * FROM hospitality_guest_csv_phone WHERE idsito = ".$_POST['idsito'];
        $result =  $dbMysqli->query($select);
        if(sizeof($result)>0){
            $rec    = $result[0];
            $update = "UPDATE hospitality_guest_csv_phone SET csv = '".$name."' WHERE Id = ".$rec ['Id'];
            $dbMysqli->query($update);
        }else{
            $insert = "INSERT INTO hospitality_guest_csv_phone(idsito,csv) VALUES('".$_POST['idsito']."','".$name."')";
            $dbMysqli->query($insert);
        }
        move_uploaded_file($_FILES['csv']['tmp_name'], $file_path.$name);

        $csv = getCSV($file_path.$name);


        if (!empty($csv)) {
    
            foreach ($csv as $csvIndex => $csvRow) {

                $idsito         = $_POST['idsito'];
                $ora_inizio     = $csvRow[0];
                $codice_paese   = $csvRow[1];
                $telefono       = clean_($csvRow[2]);
                $campagna       = addslashes($csvRow[3]);
                $gruppo_annunci = addslashes($csvRow[4]);
                if(!empty($csvRow)){
                    if($telefono!='--'){
                        $sqlInsert = "INSERT INTO hospitality_guest_track_phone 
                                            (idsito,ora_inizio,codice_paese,telefono,campagna,gruppo_annunci) 
                                            VALUES
                                            ('".$idsito."','".$ora_inizio."','".$codice_paese."','".$telefono."','".$campagna."','".$gruppo_annunci."')";
                        $dbMysqli->query($sqlInsert);
                    }
                }
            }
        }
    
        echo '  <form  action="'.BASE_URL_ADMIN.'report/fatturato_telefono_quoto/" method="POST" name="form_reload" id="form_reload" >
                    <input type="hidden" name="save_ok" id="save_ok"  value="1"/>
                </form>'."\r\n";

        echo '  <script language="JavaScript">
                    document.form_reload.submit();
                </script>'."\r\n";
    }else{
        $prn->alertback("Devi scegliere il sito ed associare il file csv!");
    }

}


$que = "SELECT 
                siti.web, 
                siti.idsito,
                siti.hospitality,
                siti.data_start_hospitality,
                siti.data_end_hospitality
            FROM
                siti
            WHERE
                1 = 1
            GROUP BY 
                siti.idsito
            ORDER BY
                siti.idsito DESC";
$lista_siti =  $dbMysqli->query($que);            

foreach ($lista_siti as $key => $value) {
    $list .='{ id: '.$value['idsito'].', text: \''.addslashes($value['web']).'\'},'."\r\n";
}

$query = "SELECT * FROM hospitality_guest_csv_phone ORDER BY idsito";
$array =  $dbMysqli->query($query);

/* if($_REQUEST['cl']  ==''){
    $_REQUEST['cl'] = 107;
} */

foreach ($array as $ky => $val) {
    $query  = "SELECT web FROM siti WHERE idsito = ".$val['idsito'];
    $resul  =  $dbMysqli->query($query);
    $record = $resul[0];

    $siti .= '<option value="'.$val['idsito'].'" '.($_REQUEST['cl'] == $val['idsito']?'selected="selected"':'').'>'.$record['web'].'</option>';
}

                $output .=' <style>
                                #relazioni .ordinamento {
                                    display:none; 
                                }
                            </style> 
                        <!-- Table datatable-->
                                <table id="relazioni" class="display dataTable table table-striped table-hover table-bordered table-sm"  style="width:100%">
                                    <thead>
                                        <tr>
                                        <th style="text-align:center;width:1%;"><b>Nr.Preno</b></th>
                                        <th style="text-align:center;width:11%;"><b>Tipo</b></th>
                                        <th style="text-align:center;width:16%;white-space:nowrap"><b>Cliente</b></th>
                                        <th style="text-align:center;width:11%;white-space:nowrap"><b>Tel.Richiesta</b></th>
                                        <th style="text-align:center;width:11%;"><b>Campagna</b></th>
                                        <th style="text-align:center;width:16%;"><b>Fatt.</b></th>
                                        </tr>
                                    </thead> 
                                    <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right">Totale</th>
                                        <th id="fat" class="text-center"></th>
                                     </tr>
                                </tfoot>
                                </table> '."\r\n";

                    if($_REQUEST['cl']  !=''){
                        # CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
                        $output .='<script>

                                    $(document).ready(function() {


                                            // CONFIG DATATABLE
                                            var table = $("#relazioni").DataTable( {

                                                responsive: true,
                                                processing:true,
                                                oLanguage: {sProcessing: "<div class=\'loader-block\' style=\'z-index:9999999!important\'><div class=\'preloader6\'><hr></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>Attendere il caricamento dei dati...!</span>"},
                                                "paging": true,
                                                "pagingType": "simple_numbers",    
                                                "language": {
                                                        "search": "Filtra i risultati:",
                                                        "info": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
                                                        "infoEmpty": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
                                                        "emptyTable": "Nessun record",
                                                        "paginate": {
                                                            "previous": "Precedente",
                                                            "next":"Successivo",
                                                        },
                                                        buttons: {
                                                        pageLength: {
                                                            _: "Mostra %d elementi",
                                                            \'-1\': "Mostra tutto"
                                                        }
                                                    }
                                                },
                                                dom: \'Bfrtip\',
                                                lengthMenu: [
                                                    [ 25, 50, 100, 200, -1 ],
                                                    [ \'25 risultati\', \'50 risultati\', \'100 risultati\', \'200 risultati\', \'Tutti\' ]
                                                ],	
                                                buttons: [ \'pageLength\',
/*                                                 {
                                                    extend: \'collection\',
                                                    className: \'buttonExport\',
                                                    text: \'Esporta\',
                                                    buttons: [  
                                                        { extend: \'copy\', text: \'Copia\' }, 
                                                        { extend: \'excel\', text: \'Excel\' },  
                                                        { extend: \'csv\', text: \'CSV\' },  
                                                        { extend: \'pdf\', text: \'PDF\' },  
                                                        { extend: \'print\', text: \'Stampa\' }
                                                    ]
                                                } */
                                            ],				

                                                "ajax": "'.BASE_URL_ADMIN.'crud/report/fatturato.telefono.quoto.crud.php?1=1'.($_REQUEST['cl']!=''?'&idsito='.$_REQUEST['cl']:'&idsito=660').'",
                                                "columns": [
                                                    { "data": "nr" },
                                                    { "data": "tipo" },
                                                    { "data": "nome" },
                                                    { "data": "cell" },
                                                    { "data": "campagna" },
                                                    { "data": "fatturato" }
                                                ],
                                                footerCallback: function( row, data, start, end, display ) {'."\r\n";

                                            $output .='var totale = $("#fat").load("'.BASE_URL_ADMIN.'crud/report/tot.fatturato.tel.qt.crud.php?1=1'.($_REQUEST['cl']!=''?'&idsito='.$_REQUEST['cl']:'&idsito=660').'", function() {
                                                            console.log(totale);
                                                        });'."\r\n";
                                                  
                            $output .='        }
                                            }); 
                                            // ORDINAMENTO TABELLA
                                            table.order( [ 0, \'ASC\' ],[ 4, \'ASC\' ]).draw();
                                            $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");
                                            $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");           
                                            $("#relazioni_processing").removeClass("card");
                                    }); 

                                </script>
                                <style>
                                #relazioni_processing
                                {
                                    position:absolute;
                                    top:60%!important;
                                }
                            </style>'; 
                    }



?>