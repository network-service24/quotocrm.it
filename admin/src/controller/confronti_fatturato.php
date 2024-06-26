<?
if ($_REQUEST['action'] == 'request_date') {

		$date_tmp         = explode("-",$_REQUEST['date']);
		$data_1_tmp       = trim($date_tmp[0]);
		$data_2_tmp       = trim($date_tmp[1]);
		$prima_data_tmp   = explode("/",$data_1_tmp);
		$seconda_data_tmp = explode("/",$data_2_tmp);
		$start            = $prima_data_tmp[2].'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
		$end              = $seconda_data_tmp[2].'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];
		$start_           = ($prima_data_tmp[2]-1).'-'.$prima_data_tmp[1].'-'.$prima_data_tmp[0];
		$end_             = ($seconda_data_tmp[2]-1).'-'.$seconda_data_tmp[1].'-'.$seconda_data_tmp[0];
		$prima_data_it    = $prima_data_tmp[0].'/'.$prima_data_tmp[1].'/'.($prima_data_tmp[2]-1);
		$seconda_data_it  = $seconda_data_tmp[0].'/'.$seconda_data_tmp[1].'/'.($seconda_data_tmp[2]-1);
 
 
}else{

    $dal = mktime(0,0,0,01,01,date('Y'));
    $al  = mktime(0,0,0,date('m'),date('d'),date('Y'));

    $start = date('Y-m-d',$dal);
    $end = date('Y-m-d',$al);

    $dal_ = mktime(0,0,0,01,01,(date('Y')-1));
    $al_ = mktime(0,0,0,date('m'),date('d'),(date('Y')-1));

    $start_ = date('Y-m-d',$dal_);
    $end_ = date('Y-m-d',$al_);
}

$variabili     = 'start='.$start.'&end='.$end.'&start_='.$start_.'&end_='.$end_;

  # INTERFACCIA CRUD DATATABLE
$content ='   <!-- Table datatable-->
                <table id="confronto_quoto" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='                <th>Cliente</th>
                            <th>Periodo</th>
                            <th>Confronto</th>
                            <th>Andamento</th> 
                            <th>Percentuale</th>
                            <th>Differenza</th>
                        </tr>
                    </thead>

                </table> 
                <style> 
                .ordinamento {
                    display:none; 
                }
                </style>'."\r\n";
// CONFIG DATATABLE
$content .='<script>
            $(document).ready(function() {
                var table = $("#confronto_quoto").DataTable( {
                order: [[1, \'desc\']],  
                responsive: true,
                processing:true,
                oLanguage: {sProcessing: "<div class=\'loader-block\' style=\'z-index:9999999!important\'><div class=\'preloader6\'><hr></div></div><span class=\'text-info f-w-400 f-14 f-s-intial\'>QUOTO! Manager sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
                "paging": true,
                    "pagingType": "simple_numbers",    
                    "language": {
                        "search": "Filtra i risultati:",
                        "info": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
                        "emptyTable": " ",
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
                        [ 100, 200, 500, -1 ],
                        [ \'100 risultati\', \'200 risultati\', \'500 risultati\', \'Tutti\' ]
                    ],	
                    buttons: ['."\r\n";

$content .='      \'pageLength\',
        ],			
        "ajax": "'.BASE_URL_ADMIN.'crud/confronti_fatturato.crud.php?'.trim($variabili).'",
        "deferRender": true,
        "columns": ['."\r\n";



$content .='    { "data": "cliente"},
                { "data": "periodo","class": "text-center"},  
                { "data": "confronto","class": "text-center"},
                { "data": "andamento", "class": "text-center"},            
                { "data": "percentuale", "class": "text-center"},
                { "data": "differenza","class": "text-center"}
            ],';
$content .='    "columnDefs": [
                {"targets": [0,3], "orderable": false},
                { "type": "currency", targets: [1,2,4,5] }

            ]'."\r\n";

$content .=' }); 
                $("#confronto_quoto_processing").removeClass("card");
                $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");
            });
        </script>'."\r\n";