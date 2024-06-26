<?
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT'].'/include/function.inc.php');

    // output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=export_emessenger_quoto2_'.$_REQUEST['idsito'].'.csv');
    header('Pragma: no-cache');
    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // output the column headings
    fputcsv($output, array('Lista', 'Nome', 'Cognome', 'Email', 'Lingua', 'Consenso trattamento dati', 'Consenso invio materiale marketing', 'Consenso profilazione'),';');


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


    foreach($arr_r as $key => $val) {
    
       fputcsv($output, array($val['nome_lista'],$val['nome'],$val['cognome'],$val['email'],$val['lingua'],($val['CheckConsensoPrivacy']=='1'?'SI':'NO'),($val['CheckConsensoMarketing']=='1'?'SI':'NO'),($val['CheckConsensoProfilazione']=='1'?'SI':'NO')),';');

    }
