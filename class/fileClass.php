<?php
class exportFile
{


    function exportFileToDatbase($filename,$de,$mode,$tablename,$fieldno,$id_nome_lista,$idsito){
      global $db;
	  
        $fd=fopen($filename,"$mode");
        while(!feof($fd)) {
            $line=fgets($fd,5000);
            $f=explode($de,$line);
                for($i=0;$i<$fieldno;$i++) {
                    $a[]=trim("'$f[$i]'");
                }   
            $value=implode(",",$a);
            unset($a);
			
			$db->query("SELECT MAX(id) as id FROM $tablename");
			$row = $db->row();
			$newid = $row['id'] + 1;		

            $db->query("insert into $tablename values($newid, $id_nome_lista, $idsito, $value)");
           
        }
       
    }
   
}
?>