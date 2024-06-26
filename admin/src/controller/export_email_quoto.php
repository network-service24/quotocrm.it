<?
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT'].'/include/function.inc.php');

    function dscadenza_software($idsito){
      global $dbMysqli;

      $select     = "SELECT DATEDIFF(data_end_hospitality,data_start_hospitality) AS DiffDate, data_end_hospitality  FROM siti WHERE idsito = ".$idsito." AND (siti.data_start_hospitality IS NOT NULL OR siti.data_start_hospitality  != '0000-00-00') AND (siti.data_end_hospitality IS NOT NULL OR siti.data_end_hospitality  != '0000-00-00')";
      $res        = $dbMysqli->query($select);
      $row        = $res[0];
      $differenza = ($row['DiffDate']);
      $diff_data  = (100-$differenza);
      $d_e_tmp    = explode("-",$row['data_end_hospitality']);
      $data_end   = $d_e_tmp[2].'-'.$d_e_tmp[1].'-'.$d_e_tmp[0];
      if($differenza < 60){ $TestDemo = ' TEST DEMO';}else{$TestDemo = '';}
      if($differenza <= 31){
        $box ='Tempo di attivazione '.$differenza.' gg.'.$TestDemo;
      }elseif($differenza <= 180){
        $box ='Tempo di attivazione '.$differenza.' gg.'.$TestDemo;
      }else{
        $box = '';
      }

        return $box;      
    }

    // output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=export_email_quoto.csv');
    header('Pragma: no-cache');
    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // output the column headings
    fputcsv($output, array('Sito', 'UserName', 'PassWord', 'Email', 'Tel', 'Cell', 'Dal', 'Al', '', ''),';');

    $rec = $dbMysqli->query('SELECT siti.idsito, siti.web,siti.data_start_hospitality,siti.data_end_hospitality,siti.email,siti.tel,siti.cell,utenti.username,utenti.password 
                        FROM siti 
                        INNER JOIN utenti ON utenti.idsito = siti.idsito 
                        WHERE siti.idsito NOT IN(1740,1987) AND (siti.data_start_hospitality IS NOT NULL OR siti.data_start_hospitality  != "0000-00-00") AND (siti.data_end_hospitality IS NOT NULL OR siti.data_end_hospitality  != "0000-00-00")  ORDER BY siti.data_start_hospitality ASC');

    $scad = '';
    foreach ($rec as $key => $val) {
        if($val['data_end_hospitality'] < date('Y-m-d')){
            $scad = 'Scaduto';
        }else{
            $scad = '';
        }
    
        fputcsv($output, array($val['web'],$val['username'],$val['password'],$val['email'],$val['tel'],$val['cell'],gira_data($val['data_start_hospitality']),gira_data($val['data_end_hospitality']),$scad,dscadenza_software($val['idsito'])),';');

        
    }
