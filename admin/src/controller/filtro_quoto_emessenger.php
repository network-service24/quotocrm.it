<?

    // query per il select della lista anagrafiche
      $sql = "SELECT siti.idsito,siti.web, siti.data_end_hospitality
              FROM siti
              WHERE siti.hospitality = 1
              AND siti.web != ''
              GROUP BY siti.web
              ORDER BY siti.web ASC";
    $risultati = $dbMysqli->query($sql);   
    foreach($risultati as $k => $rw){
      $lista_siti .= '<option value="'.$rw['idsito'].'" '.($rw['idsito']==$_REQUEST['idsito']?'selected="selected"':'').' '.($rw['data_end_hospitality']<=date('Y-m-d')?'style="color:#FF0000!important"':'').'>'.$rw['web'].'</option>';
    }
          

    $lang = array('it','en','fr','de');
    foreach ($lang as $ky => $v) {
        $Lingua .= '<option value="'.$v.'" '.($v==$_REQUEST['Lingua']?'selected="selected"':'').'>'.$v.'</option>';
    }





    if($_REQUEST['idsito'] != ''){



        # query  per lettura dati  
        $query_gen  .= "SELECT mailing_newsletter.* , mailing_newsletter_nome_liste.nome_lista
                        FROM mailing_newsletter 
                        INNER JOIN mailing_newsletter_nome_liste ON mailing_newsletter_nome_liste.id = mailing_newsletter.id_lista 
                        WHERE mailing_newsletter.idsito = ".$_REQUEST['idsito']." ";
        if($_REQUEST['Lingua']!=''){
            $query_gen .=" AND mailing_newsletter.lingua = '".$_REQUEST['Lingua']."' "; 
        }
        if($_REQUEST['CheckConsensoPrivacy']!=''){
            $query_gen .= " AND mailing_newsletter.CheckConsensoPrivacy = '".$_REQUEST['CheckConsensoPrivacy']."' "; 
        } 
        if($_REQUEST['CheckConsensoMarketing']!=''){
            $query_gen .= " AND mailing_newsletter.CheckConsensoMarketing = '".$_REQUEST['CheckConsensoMarketing']."' "; 
        } 
        $query_gen  .= "  ORDER BY mailing_newsletter.id DESC,mailing_newsletter_nome_liste.nome_lista ASC";  

        $arr_r     = $dbMysqli->query($query_gen);


        if(sizeof($arr_r)>0){

            $Data  = '';

            $output .= '<div class="clearfix p-b-30"></div>
                        <h2>LISTA UTENTI E-MESSENGER</h2>
                            <div class="clearfix p-b-30"></div>

                            <table id="TabellaLayout" class="table table-striped table-hover table-bordered table-sm">
                            <thead>
                                <tr class="xcrud-th">
                                    <th class="th-sm">Lista</th>
                                    <th class="th-sm">Nome</th>
                                    <th class="th-sm">Cognome</th>
                                    <th class="th-sm">Email</th>
                                    <th class="th-sm">Lingua</th>
                                    <th class="th-sm">Consensi</th>
                                </tr>
                            </thead>'."\r\n";
            foreach($arr_r as $key => $val){

                $Data_t            = explode('-',$val['data']);			
                $Data              = $Data_t[2].'-'.$Data_t[1].'-'.$Data_t[0];

                $output .= '<tr>			
                                    <td class="nowrap"><b class="text-success">'.ucfirst($val['nome_lista']).'</b></td>
                                    <td class="nowrap"><b>'.stripslashes($val['nome']).'</b></td>
                                    <td class="nowrap"><b>'.stripslashes($val['cognome']).'</b></td>
                                    <td class="nowrap"><b class="text-info">'.$val['email'].'</b></td>
                                    <td class="text-center"><img src="'.BASE_URL_SITO.'img/flags/mini/'.($val['lingua']==''?'it':$val['lingua']).'.png" class="flag_ico"></td>
                                    <td><div id="view_consensi_gdpr'.$val['id'].'" class="pointer"><small>Consensi GDPR <i class="fa fa-chevron-down" style="float:right;padding-top:5px"></i></small></div>
                                    <div id="consensi_gdpr'.$val['id'].'" style="display:none">
                                    <small>';

                        $output .= '<b>Data</b>: '.$Data.'';
                        $output .= ($val['ip']!=''?'<br><b>Fonte IP</b>: '.$val['ip']:'');
                        $output .= ($val['agent']!=''?'<br><b>Agent</b>: '.$val['agent']:'');
                        $output .= '<br><b>Consenso trattamento dati</b>: '.($val['CheckConsensoPrivacy']==1?'<i class="fa fa-check-circle text-green"></i>':'<i class="fa fa-times-circle text-red"></i>');
                        $output .= '<br><b>Consenso invio materiale marketing</b>: '.($val['CheckConsensoMarketing']==1?'<i class="fa fa-check-circle text-green" id="marketing'.$val['id'].'" data-id="0"></i><span id="new_marketing_green'.$val['id'].'"></span>':'<i class="fa fa-times-circle text-red" id="marketing'.$val['id'].'"  data-id="1"></i><span id="new_marketing_red'.$val['id'].'"></span>');    
                        $output .= '<br><b>Consenso profilazione</b>: '.($val['CheckConsensoProfilazione']==1?'<i class="fa fa-check-circle text-green" id="profilazione'.$val['id'].'" data-id="0"></i><span id="new_profilazione_green'.$val['id'].'"></span>':'<i class="fa fa-times-circle text-red" id="profilazione'.$val['id'].'"  data-id="1"></i><span id="new_profilazione_red'.$val['id'].'"></span>');
                        $output .= '<br><b>Note Consensi</b>:<br>'.$val['NoteConsensi'].'';                
                                                                                    
                $output .= '				</small>
                                        </div>
                                        <script>
                                            $(document).ready(function () {
                                                $("#view_consensi_gdpr'.$val['id'].'").on("click",function(){
                                                    $("#consensi_gdpr'.$val['id'].'").toggle();
                                                });
                                            });
                                        </script>';
                $output .= '	    </td>
                            </tr>';

    
            }


            $output .= '</table> 

                            <script>
                            $(document).ready(function () {
                                $(\'#TabellaLayout\').DataTable({
                                    "paging": true,
									"pagingType": "simple_numbers",    
									"language": {
										 "search": "Filtra i risultati:",
										 "info": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
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
										[ 10, 25, 50, -1 ],
										[ \'10 risultati\', \'25 risultati\', \'50 risultati\', \'Tutti\' ]
									],						
									buttons: [ \'pageLength\'
									],
								});
                                $(\'#TabellaLayout\').DataTable().order([0,\'desc\']).draw();

                            });
                        </script>';

        }else{
            $output = 'Nessun iscritto inserito!';
        }

    }