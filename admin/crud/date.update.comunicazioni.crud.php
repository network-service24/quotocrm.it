<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli < marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$tabella   = $_REQUEST['tabella'];



            $Testo                   = '';      
            $id                      = $_REQUEST['id'];
            $param_where             = $_REQUEST['parametro'];
        
            # QUERY PER COMPILARE IL DATATABLE
            $s  = " SELECT *  FROM ".$tabella." WHERE ".$param_where." = ".$id."";
        
            $rec = $dbMysqli->query($s);
        
            $row = $rec[0];
           
         
            $Id                     = $row['Id'];
            $Abilitato              = $row['Abilitato'];
            $Visibile               = $row['Visibile'];
            $DataInizio             = $row['DataInizio'];
            $DataFine               = $row['DataFine'];
            $Titolo                 = addslashes($row['Titolo']);
            $Testo                  = str_replace(array("\n","\r"), "", addslashes($row['Testo']));
                  // 
            $output = '<script type="text/javascript">
                            $(document).ready(function() {                                                                              
                                $("#id_update").val(\''.$Id.'\');
                                 $("#Abilitato_update").val(\''.$Abilitato.'\');
                                '.($Abilitato==1?'$("#Abilitato_update").attr("checked",true);':'').'
                                 $("#Visibile_update").val(\''.$Visibile.'\');
                                '.($Visibile==1?'$("#Visibile_update").attr("checked",true);':'').'
                                $("#DataInizio_update").val(\''.$DataInizio.'\');
                                $("#DataFine_update").val(\''.$DataFine.'\');
                                $("#Titolo_update").val(\''.$Titolo.'\');
                                $("#Testo_update").val(\''.$Testo.'\');
                            });
                    </script>';	

        echo $output;
?>
