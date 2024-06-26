<?
include(INC_PATH_CLASS."MysqliDb.php");

$dbMysqli  = new MysqliDb (HOST, DB_USER, DB_PASSWORD, DATABASE);

$query = "SELECT  siti.*
                FROM siti
                WHERE siti.hospitality = 1
                AND siti.data_end_hospitality > '".date('Y-m-d')."'
                AND siti.id_status <> 5
                GROUP BY  siti.idsito
                ORDER BY siti.data_start_hospitality DESC";
$res = $dbMysqli->query($query);


$dir_sito = '';
$dir_tmp  = '';
$tot      = '';
$select   = '';

foreach($res as $k => $v){
    /**
         * * NUOVO CODICE DI SETUP PER GLI INFO BOX TAG
         * * 15-12-2022
         */
        $dizI1 = $dbMysqli->query("INSERT INTO hospitality_info_box(idsito,Titolo,Abilitato) VALUES('".$v['idsito']."','Servizi Ad hoc per tutta la famiglia','1')");
        $id_dizI1 = $dbMysqli->getInsertId($dizI1);

        $infoBox_1_it  = 'Bambini e grandi sapranno trovare il loro giusto posto in questo luogo incantevole fatto a misura per tutta la famiglia';
     
        $infoBox_1_en  = 'Children and adults will find their rightful place in this enchanting place made to measure for the whole family';                                  

        $infoBox_1_fr  = 'Petits et grands trouveront leur juste place dans ce lieu enchanteur fait sur mesure pour toute la famille';

        $infoBox_1_de  = 'Kinder und Erwachsene finden ihren rechtmäßigen Platz in diesem bezaubernden Ort, der für die ganze Familie maßgeschneidert ist';                                

        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI1."','".$v['idsito']."','it','Servizi Ad hoc per tutta la famiglia','".addslashes($infoBox_1_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI1."','".$v['idsito']."','en','Ad hoc services for the whole family','".addslashes($infoBox_1_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI1."','".$v['idsito']."','fr','Des services ad hoc pour toute la famille','".addslashes($infoBox_1_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI1."','".$v['idsito']."','de','Ad-hoc-Dienste für die ganze Familie','".addslashes($infoBox_1_de)."')");   
 
        $dizI2 = $dbMysqli->query("INSERT INTO hospitality_info_box(idsito,Titolo,Abilitato) VALUES('".$v['idsito']."','Cucina aperta h24','1')");
        $id_dizI2 = $dbMysqli->getInsertId($dizI2);

        $infoBox_2_it  = 'Per soddisfare qualsiasi appetito a qualsiasi ora, la nostra cucina è a tua completa disposisiozne h24 con un menù dedicato a la carte.';
     
        $infoBox_2_en  = 'To satisfy any appetite at any time, our kitchen is at your complete disposal 24/24 with a dedicated à la carte menu.';                                  

        $infoBox_2_fr  = 'Pour satisfaire tous les appétits à toute heure, notre cuisine est à votre entière disposition 24h/24 avec un menu à la carte dédié.';

        $infoBox_2_de  = 'Um jeden Appetit jederzeit zu stillen, steht Ihnen unsere Küche rund um die Uhr mit einem speziellen À-la-carte-Menü zur Verfügung.';                                

        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI2."','".$v['idsito']."','it','Cucina aperta h24','".addslashes($infoBox_2_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI2."','".$v['idsito']."','en','Kitchen open 24 hours a day','".addslashes($infoBox_2_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI2."','".$v['idsito']."','fr','Cuisine ouverte 24h/24','".addslashes($infoBox_2_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI2."','".$v['idsito']."','de','Küche rund um die Uhr geöffnet','".addslashes($infoBox_2_de)."')");   
 
        $dizI3 = $dbMysqli->query("INSERT INTO hospitality_info_box(idsito,Titolo,Abilitato) VALUES('".$v['idsito']."','Camere per disabili','1')");
        $id_dizI3 = $dbMysqli->getInsertId($dizI3);

        $infoBox_3_it  = 'Ampia disponibilità di camere senza barriere architettoniche adatte a disabili e persone che richiedono un maggiore spazio di manovra.';
     
        $infoBox_3_en  = 'Wide availability of barrier-free rooms suitable for the disabled and people who require more space to manoeuvre.';                                  

        $infoBox_3_fr  = 'Large disponibilité de chambres sans barrières adaptées aux personnes handicapées et aux personnes qui ont besoin de plus d\'espace pour manœuvrer.';

        $infoBox_3_de  = 'Breites Angebot an behindertengerechten barrierefreien Zimmern und Menschen, die mehr Bewegungsfreiheit benötigen.';                                

        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI3."','".$v['idsito']."','it','Camere per disabili','".addslashes($infoBox_3_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI3."','".$v['idsito']."','en','Rooms for the disabled','".addslashes($infoBox_3_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI3."','".$v['idsito']."','fr','Chambres pour handicapés','".addslashes($infoBox_3_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI3."','".$v['idsito']."','de','Zimmer für Behinderte','".addslashes($infoBox_3_de)."')");   
     
        $dizI4 = $dbMysqli->query("INSERT INTO hospitality_info_box(idsito,Titolo,Abilitato) VALUES('".$v['idsito']."','A pochi passi dal mare','1')");
        $id_dizI4 = $dbMysqli->getInsertId($dizI4);

        $infoBox_4_it  = 'Ti basterà percorrere i pochi passi di viale che ci separano da una delle spiagge più belle d’Italia!';
     
        $infoBox_4_en  = 'All you have to do is walk the few steps along the avenue that separate us from one of the most beautiful beaches in Italy!';                                  

        $infoBox_4_fr  = 'Il ne vous reste plus qu\'à parcourir les quelques marches le long de l\'avenue qui nous séparent de l\'une des plus belles plages d\'Italie !';

        $infoBox_4_de  = 'Alles, was Sie tun müssen, ist, die wenigen Schritte entlang der Allee zu gehen, die uns von einem der schönsten Strände Italiens trennt!';                                

        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI4."','".$v['idsito']."','it','A pochi passi dal mare','".addslashes($infoBox_4_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI4."','".$v['idsito']."','en','A few steps from the sea','".addslashes($infoBox_4_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI4."','".$v['idsito']."','fr','A quelques pas de la mer','".addslashes($infoBox_4_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI4."','".$v['idsito']."','de','Ein paar Schritte vom Meer entfernt','".addslashes($infoBox_4_de)."')");   
        
        $dizI5 = $dbMysqli->query("INSERT INTO hospitality_info_box(idsito,Titolo,Abilitato) VALUES('".$v['idsito']."','A pochi passi dagli impiati sciistici','1')");
        $id_dizI5 = $dbMysqli->getInsertId($dizI5);

        $infoBox_5_it  = 'Ti basterà percorrere i pochi passi di viale che ci separano dagli impianti sciistici e le piste più belle d’Italia!';
     
        $infoBox_5_en  = 'All you have to do is walk the few steps along the avenue that separate us from the ski resorts and the most beautiful slopes in Italy!';                                  

        $infoBox_5_fr  = 'Il ne vous reste plus qu\'à parcourir les quelques marches le long de l\'avenue qui nous séparent des stations de ski et des plus belles pistes d\'Italie!';

        $infoBox_5_de  = 'Alles, was Sie tun müssen, ist, die wenigen Schritte entlang der Allee zu gehen, die uns von den Skigebieten und den schönsten Pisten Italiens trennt!';                                

        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI5."','".$v['idsito']."','it','A pochi passi dagli impiati sciistici','".addslashes($infoBox_5_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI5."','".$v['idsito']."','en','A few steps from the ski lifts','".addslashes($infoBox_5_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI5."','".$v['idsito']."','fr','A quelques pas des remontées mécaniques','".addslashes($infoBox_5_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI5."','".$v['idsito']."','de','Ein paar Schritte von den Skiliften entfernt','".addslashes($infoBox_5_de)."')");   
}
?>