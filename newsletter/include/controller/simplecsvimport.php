<?php
error_reporting(E_ALL ^ E_NOTICE);

		$databasehost = "";
		$databasename = "";
		$databaseusername ="";
		$databasepassword = "";
		$con = @mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
		@mysql_select_db($databasename) or die(mysql_error());
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" />

<form action="index.php" method="post" enctype="multipart/form-data" name="form1" id="form1" >
  <table border="0" align="center">
    <tr>
      <td nowrap="nowrap" class="testo10">Sorgente file CSV file da importare:</td>
      <td width="10px" rowspan="33" class="testo10">&nbsp;</td>
      <td class="testo10"><input type="file" name="file" id="file" class="modulo"  /></td>
    </tr>
    <tr>
      <td class="testo10">Scegli la lista</td>
      <td class="testo10"><select name="id_lista" id="id_lista" class="modulo" onChange="document.form1.nome_lista.value=this.options[selectedIndex].text;">
        <option>selezione</option>
        <?php
                $qry = mysql_query("SELECT * FROM mailing_liste ORDER BY nome ASC");
                while($row = mysql_fetch_array($qry)){
                    echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
                }
            
            ?>
      </select>
      <input name="nome_lista" type="hidden" value="" />      </td>
    </tr>
    <tr>
      <td class="testo10">Separatore:</td>
      <td class="testo10"><input name="fieldseparator" type="text" class="modulo" id="fieldseparator" value=";" size="3"  maxlength="1"/> 
        default</td>
    </tr>
    <tr>
      <td colspan="3" class="testo10">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="testo10"><label>
      <input name="button" type="submit" class="bottone" id="button" value="Importa" />
      </label>
      <input name="action" type="hidden" id="action" value="insert" />
      <input name="arg" type="hidden" id="arg" value="newsletter/simplecsvimport" /></td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="testo10">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="testo10"><a href="index.php?arg=liste_newsletter">Torna alle liste</a></td>
    </tr>
  </table>
</form>
<?
if($_REQUEST['action'] == 'insert'){
		/********************************************************************************************/
		/* Code at http://legend.ws/blog/tips-tricks/csv-php-mysql-import/
		/* Edit the entries below to reflect the appropriate values
		/********************************************************************************************/
		$databasetable = $_REQUEST['nome_lista'].'_'.$_REQUEST['id_lista'];

		$fieldseparator = $_REQUEST['fieldseparator'];
		$lineseparator = "\n";
			if ($_FILES["file"]["name"]){
				 $extension_file = pathinfo($_FILES["file"]["name"]);
				$_REQUEST['file'] = $_REQUEST['nome_lista'].'_'.$_REQUEST['id_lista'].".".$extension_file["extension"]; 
				copy($_FILES["file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'].'/newsletter/tmp/'.$_REQUEST['file']);
			}
		$csvfile = $_SERVER['DOCUMENT_ROOT'].'/newsletter/tmp/'.$_REQUEST['file'];
		/********************************************************************************************/
		/* Would you like to add an ampty field at the beginning of these records?
		/* This is useful if you have a table with the first field being an auto_increment integer
		/* and the csv file does not have such as empty field before the records.
		/* Set 1 for yes and 0 for no. ATTENTION: don't set to 1 if you are not sure.
		/* This can dump data in the wrong fields if this extra field does not exist in the table
		/********************************************************************************************/
		$addauto = 1;
		/********************************************************************************************/
		/* Would you like to save the mysql queries in a file? If yes set $save to 1.
		/* Permission on the file should be set to 777. Either upload a sample file through ftp and
		/* change the permissions, or execute at the prompt: touch output.sql && chmod 777 output.sql
		/********************************************************************************************/
		$save = 0;
		$outputfile = "output.sql";
		/********************************************************************************************/
		
		
		if(!file_exists($csvfile)) {
			echo "File not found. Make sure you specified the correct path.\n";
			exit;
		}
		
		$file = fopen($csvfile,"r");
		
		if(!$file) {
			echo "Error opening data file.\n";
			exit;
		}
		
		$size = filesize($csvfile);
		
		if(!$size) {
			echo "File is empty.\n";
			exit;
		}
		
		$csvcontent = fread($file,$size);
		
		fclose($file);
		
		$strSQL = "CREATE TABLE IF NOT EXISTS $databasetable
		(id int(30) unsigned NOT NULL auto_increment,id_lista INT(30),email VARCHAR(255),
		PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
		$strSQL = mysql_query($strSQL,$con)or die(mysql_error());
			
			
		$lines = 0;
		$queries = "";
		$linearray = array();
		
		foreach(split($lineseparator,$csvcontent) as $line) {
		
			$lines++;
		
			$line = trim($line," \t");
			
			$line = str_replace("\r","",$line);
			
			/************************************************************************************************************
			This line escapes the special character. remove it if entries are already escaped in the csv file
			************************************************************************************************************/
			$line = str_replace("'","\'",$line);
			/***********************************************************************************************************/
			
			$linearray = explode($fieldseparator,$line);
			
			$linemysql = implode("','",$linearray);

			$con = @mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
			@mysql_select_db($databasename) or die(mysql_error());
		
			if($addauto)
				$query = "insert into $databasetable values('','".$_REQUEST['id_lista']."','".$linemysql."');";
			else
				$query = "insert into $databasetable values('".$_REQUEST['id_lista']."','".$linemysql."');";
			
			$queries .= $query . "\n";
		
			@mysql_query($query);
		}
		
		@mysql_close($con);
		
		if($save) {
			
			if(!is_writable($outputfile)) {
				echo "Il file non ha permessi di scrittura, check permissions.\n";
			}
			
			else {
				$file2 = fopen($outputfile,"w");
				
				if(!$file2) {
					echo "Errore di scrittura del file di output.\n";
				}
				else {
					fwrite($file2,$queries);
					fclose($file2);
				}
			}
			
		}
		
		echo "Trovati un totale of ".$lines." records nel file csv.\n";

}
?>