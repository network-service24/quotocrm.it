<?php
#############
# PROCEDURA PER AUTOCOMPILARE IL DIZIONARIO E NON SOLO CON ITA,ENG,FRA,DEU
###########################
    if($_REQUEST['action']=='syncro_auto_config'){
    	 // syncro dati di tutte le lingue che il cliente ha abilitate sul prprio sito
        $lingua = '';
        //$lingue = getLingue(IDSITO);
        $lingue = array('1'=>'it','2'=>'en','3'=>'fr','4'=>'de');
        foreach($lingue as $k => $v){
            $lingua = from_id_to_lg($k);
            $dbMysqli->query("INSERT INTO hospitality_lingue(id_lingua,idsito,Lingua,Sigla) VALUES('".$k."','".IDSITO."','".$lingua."','".$v."')");
        }
         //fine
        /**
         * * NUOVO CODICE DI SETUP PER GLI INFO BOX TAG
         * * 15-12-2022
         */
        $dizI1 = $dbMysqli->query("INSERT INTO hospitality_info_box(idsito,Titolo,Abilitato) VALUES('".IDSITO."','Servizi Ad hoc per tutta la famiglia','1')");
        $id_dizI1 = $dbMysqli->getInsertId($dizI1);

        $infoBox_1_it  = 'Bambini e grandi sapranno trovar il loro giusto posto in questo luogo incantevole fatto a misura per tutta la famiglia';
     
        $infoBox_1_en  = 'Children and adults will find their rightful place in this enchanting place made to measure for the whole family';                                  

        $infoBox_1_fr  = 'Petits et grands trouveront leur juste place dans ce lieu enchanteur fait sur mesure pour toute la famille';

        $infoBox_1_de  = 'Kinder und Erwachsene finden ihren rechtmäßigen Platz in diesem bezaubernden Ort, der für die ganze Familie maßgeschneidert ist';                                

        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI1."','".IDSITO."','it','Servizi Ad hoc per tutta la famiglia','".addslashes($infoBox_1_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI1."','".IDSITO."','en','Ad hoc services for the whole family','".addslashes($infoBox_1_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI1."','".IDSITO."','fr','Des services ad hoc pour toute la famille','".addslashes($infoBox_1_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI1."','".IDSITO."','de','Ad-hoc-Dienste für die ganze Familie','".addslashes($infoBox_1_de)."')");   
 
        $dizI2 = $dbMysqli->query("INSERT INTO hospitality_info_box(idsito,Titolo,Abilitato) VALUES('".IDSITO."','Cucina aperta h24','1')");
        $id_dizI2 = $dbMysqli->getInsertId($dizI2);

        $infoBox_2_it  = 'Per soddisfare qualsiasi appetito a qualsiasi ora, la nostra cucina è a tua completa disposisiozne h24 con un menù dedicato a la carte.';
     
        $infoBox_2_en  = 'To satisfy any appetite at any time, our kitchen is at your complete disposal 24/24 with a dedicated à la carte menu.';                                  

        $infoBox_2_fr  = 'Pour satisfaire tous les appétits à toute heure, notre cuisine est à votre entière disposition 24h/24 avec un menu à la carte dédié.';

        $infoBox_2_de  = 'Um jeden Appetit jederzeit zu stillen, steht Ihnen unsere Küche rund um die Uhr mit einem speziellen À-la-carte-Menü zur Verfügung.';                                

        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI2."','".IDSITO."','it','Cucina aperta h24','".addslashes($infoBox_2_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI2."','".IDSITO."','en','Kitchen open 24 hours a day','".addslashes($infoBox_2_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI2."','".IDSITO."','fr','Cuisine ouverte 24h/24','".addslashes($infoBox_2_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI2."','".IDSITO."','de','Küche rund um die Uhr geöffnet','".addslashes($infoBox_2_de)."')");   
 
        $dizI3 = $dbMysqli->query("INSERT INTO hospitality_info_box(idsito,Titolo,Abilitato) VALUES('".IDSITO."','Camere per disabili','1')");
        $id_dizI3 = $dbMysqli->getInsertId($dizI3);

        $infoBox_3_it  = 'Ampia disponibilità di camere senza barriere architettoniche adatte a disabili e persone che richiedono un maggiore spazio di manovra.';
     
        $infoBox_3_en  = 'Wide availability of barrier-free rooms suitable for the disabled and people who require more space to manoeuvre.';                                  

        $infoBox_3_fr  = 'Large disponibilité de chambres sans barrières adaptées aux personnes handicapées et aux personnes qui ont besoin de plus d\'espace pour manœuvrer.';

        $infoBox_3_de  = 'Breites Angebot an behindertengerechten barrierefreien Zimmern und Menschen, die mehr Bewegungsfreiheit benötigen.';                                

        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI3."','".IDSITO."','it','Camere per disabili','".addslashes($infoBox_3_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI3."','".IDSITO."','en','Rooms for the disabled','".addslashes($infoBox_3_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI3."','".IDSITO."','fr','Chambres pour handicapés','".addslashes($infoBox_3_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI3."','".IDSITO."','de','Zimmer für Behinderte','".addslashes($infoBox_3_de)."')");   

        $dizI4 = $dbMysqli->query("INSERT INTO hospitality_info_box(idsito,Titolo,Abilitato) VALUES('".IDSITO."','A pochi passi dal mare','1')");
        $id_dizI4 = $dbMysqli->getInsertId($dizI4);

        $infoBox_4_it  = 'Ti basterà percorrere i pochi passi di viale che ci separano da una delle spiagge più belle d’Italia!';
     
        $infoBox_4_en  = 'All you have to do is walk the few steps along the avenue that separate us from one of the most beautiful beaches in Italy!';                                  

        $infoBox_4_fr  = 'Il ne vous reste plus qu\'à parcourir les quelques marches le long de l\'avenue qui nous séparent de l\'une des plus belles plages d\'Italie !';

        $infoBox_4_de  = 'Alles, was Sie tun müssen, ist, die wenigen Schritte entlang der Allee zu gehen, die uns von einem der schönsten Strände Italiens trennt!';                                

        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI4."','".IDSITO."','it','A pochi passi dal mare','".addslashes($infoBox_4_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI4."','".IDSITO."','en','A few steps from the sea','".addslashes($infoBox_4_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI4."','".IDSITO."','fr','A quelques pas de la mer','".addslashes($infoBox_4_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI4."','".IDSITO."','de','Ein paar Schritte vom Meer entfernt','".addslashes($infoBox_4_de)."')");   
        
        $dizI5 = $dbMysqli->query("INSERT INTO hospitality_info_box(idsito,Titolo,Abilitato) VALUES('".IDSITO."','A pochi passi dagli impiati sciistici','1')");
        $id_dizI5 = $dbMysqli->getInsertId($dizI5);

        $infoBox_5_it  = 'Ti basterà percorrere i pochi passi di viale che ci separano dagli impianti sciistici e le piste più belle d’Italia!';
     
        $infoBox_5_en  = 'All you have to do is walk the few steps along the avenue that separate us from the ski resorts and the most beautiful slopes in Italy!';                                  

        $infoBox_5_fr  = 'Il ne vous reste plus qu\'à parcourir les quelques marches le long de l\'avenue qui nous séparent des stations de ski et des plus belles pistes d\'Italie!';

        $infoBox_5_de  = 'Alles, was Sie tun müssen, ist, die wenigen Schritte entlang der Allee zu gehen, die uns von den Skigebieten und den schönsten Pisten Italiens trennt!';                                

        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI5."','".IDSITO."','it','A pochi passi dagli impiati sciistici','".addslashes($infoBox_5_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI5."','".IDSITO."','en','A few steps from the ski lifts','".addslashes($infoBox_5_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI5."','".IDSITO."','fr','A quelques pas des remontées mécaniques','".addslashes($infoBox_5_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_info_box_lang(id_info_box,idsito,Lingua,Titolo,Descrizione) VALUES('".$id_dizI5."','".IDSITO."','de','Ein paar Schritte von den Skiliften entfernt','".addslashes($infoBox_5_de)."')");   

        /**
         * * NUOVO CODICE DI SETUP PER IL NUOVO TEMPLATE
         * * 18-11-2022
         * ? INSERIMENTO DEL NUOVO TEMPLATE CON LE VARIE ETICHETTE QUINDI PER 6 CONFIGURAZIONI DIVERSE
         */
        $select    = "SELECT * FROM hospitality_template_background WHERE idsito = ".IDSITO." AND TemplateType = 'custom4' AND (TemplateName = 'Inverno famiglia' OR TemplateName = 'inverno famiglia')";
        $result    = $dbMysqli->query($select);
        if(sizeof($result) == 0){
            #background, topimage, bg_image,font e pulsnate per template
            $dbMysqli->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Video) VALUES('".IDSITO."','custom4','inverno famiglia','thumb-inverno-family.png','\'Montserrat\', sans-serif','#FF4000','#003366','top_image_inverno-family.jpg','')");
        }     
        $select2    = "SELECT * FROM hospitality_template_background WHERE idsito = ".IDSITO." AND TemplateType = 'custom5' AND (TemplateName = 'Estate famiglia' OR TemplateName = 'estate famiglia')";
        $result2    = $dbMysqli->query($select2);
        if(sizeof($result2) == 0){               
                $dbMysqli->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Video) VALUES('".IDSITO."','custom5','estate famiglia','thumb-estate-family.png','\'Montserrat\', sans-serif','#424242','#004C66','top_image_estate-family.jpg','')");
        }      
        $select    = "SELECT * FROM hospitality_template_background WHERE idsito = ".IDSITO." AND TemplateType = 'custom6' AND (TemplateName = 'Inverno sport' OR TemplateName = 'inverno sport')";
        $result    = $dbMysqli->query($select);
        if(sizeof($result) == 0){
            #background, topimage, bg_image,font e pulsnate per template
            $dbMysqli->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Video) VALUES('".IDSITO."','custom6','inverno sport','thumb-inverno-bike.png','\'Montserrat\', sans-serif','#FF4000','#003366','top_image_inverno-bike.jpg','')");
        }     
        $select2    = "SELECT * FROM hospitality_template_background WHERE idsito = ".IDSITO." AND TemplateType = 'custom7' AND (TemplateName = 'Estate sport' OR TemplateName = 'estate sport')";
        $result2    = $dbMysqli->query($select2);
        if(sizeof($result2) == 0){               
                $dbMysqli->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Video) VALUES('".IDSITO."','custom7','estate sport','thumb-estate.png','\'Montserrat\', sans-serif','#424242','#004C66','top_image_estate-bike.jpg','')");
        }   
        $select    = "SELECT * FROM hospitality_template_background WHERE idsito = ".IDSITO." AND TemplateType = 'custom8' AND (TemplateName = 'Inverno coppie' OR TemplateName = 'inverno coppie')";
        $result    = $dbMysqli->query($select);
        if(sizeof($result) == 0){
            #background, topimage, bg_image,font e pulsnate per template
            $dbMysqli->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Video) VALUES('".IDSITO."','custom8','inverno coppie','thumb-inverno-romantico.png','\'Montserrat\', sans-serif','#FF4000','#003366','top_image_inverno-romantico.jpg','')");
        }     
        $select2    = "SELECT * FROM hospitality_template_background WHERE idsito = ".IDSITO." AND TemplateType = 'custom9' AND (TemplateName = 'Estate coppie' OR TemplateName = 'estate coppie')";
        $result2    = $dbMysqli->query($select2);
        if(sizeof($result2) == 0){               
                $dbMysqli->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Video) VALUES('".IDSITO."','custom9','estate coppie','thumb-estate-romantico.png','\'Montserrat\', sans-serif','#424242','#004C66','top_image_estate-romantico.jpg','')");
        }               
        // COPIA IMMAGINI DEMO
        $srcPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/demo_image/';
        $destPath =  $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/';  

        $srcDir = opendir($srcPath);
        while($readFile = readdir($srcDir))
        {
            if($readFile == 'top_image_inverno famiglia.jpg')
            {

                if (!file_exists($readFile)) 
                {
                    if(copy($srcPath . $readFile, $destPath . $readFile))
                    {
                        $copia = "Copy file";
                    }
                    else
                    {
                        $copia = "Canot Copy file";
                    }
                }
            }
            if($readFile == 'top_image_estate-family.jpg')
            {

                if (!file_exists($readFile)) 
                {
                    if(copy($srcPath . $readFile, $destPath . $readFile))
                    {
                        $copia = "Copy file";
                    }
                    else
                    {
                        $copia = "Canot Copy file";
                    }
                }
            }

            if($readFile == 'top_image_inverno-bike.jpg')
            {

                if (!file_exists($readFile)) 
                {
                    if(copy($srcPath . $readFile, $destPath . $readFile))
                    {
                        $copia = "Copy file";
                    }
                    else
                    {
                        $copia = "Canot Copy file";
                    }
                }
            }
            if($readFile == 'top_image_estate-bike.jpg')
            {

                if (!file_exists($readFile)) 
                {
                    if(copy($srcPath . $readFile, $destPath . $readFile))
                    {
                        $copia = "Copy file";
                    }
                    else
                    {
                        $copia = "Canot Copy file";
                    }
                }
            }
            if($readFile == 'top_image_inverno-romantico.jpg')
            {

                if (!file_exists($readFile)) 
                {
                    if(copy($srcPath . $readFile, $destPath . $readFile))
                    {
                        $copia = "Copy file";
                    }
                    else
                    {
                        $copia = "Canot Copy file";
                    }
                }
            }
            if($readFile == 'top_image_estate-romantico.jpg')
            {

                if (!file_exists($readFile)) 
                {
                    if(copy($srcPath . $readFile, $destPath . $readFile))
                    {
                        $copia = "Copy file";
                    }
                    else
                    {
                        $copia = "Canot Copy file";
                    }
                }
            }

        }

        closedir($srcDir);
        // FINE COPIA IMMAGINI
        /**
         * ? INSERIMENTO DELLE NUOVE GALLERY ASSOCIATE AI TEMPLATE
         */
        $select    = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = ".IDSITO." AND TargetType = 'custom4' AND (TargetGallery = 'Inverno famiglia' OR TargetGallery = 'inverno famiglia')";
        $result    = $dbMysqli->query($select);
        if(sizeof($result) == 0){
            $insert              = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".IDSITO."','custom4','Inverno famiglia','1')";
            $ins                 = $dbMysqli->query($insert);
            $IdTipoGalleryFInverno = $dbMysqli->getInsertId($ins);
            $insertI             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFInverno."','inverno-family1.jpg','1')";
            $dbMysqli->query($insertI);
            $insertI2             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFInverno."','inverno-family2.jpg','1')";
            $dbMysqli->query($insertI2);
            $insertI3             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFInverno."','inverno-family3.jpg','1')";
            $dbMysqli->query($insertI3);
            $insertI4             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFInverno."','inverno-family4.jpg','1')";
            $dbMysqli->query($insertI4);
            $insertI5             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFInverno."','inverno-family5.jpg','1')";
            $dbMysqli->query($insertI5);
            $insertI6             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFInverno."','inverno-family6.jpg','1')";
            $dbMysqli->query($insertI6);
            $insertI7             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFInverno."','inverno-family7.jpg','1')";
            $dbMysqli->query($insertI7);
            $insertI8             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFInverno."','inverno-family8.jpg','1')";
            $dbMysqli->query($insertI8);
            $insertI9             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFInverno."','inverno-family9.jpg','1')";
            $dbMysqli->query($insertI9);
    
        }

        $select2    = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = ".IDSITO." AND TargetType = 'custom5'  AND (TargetGallery = 'Estate famiglia' OR TargetGallery = 'estate famiglia')";
        $result2    = $dbMysqli->query($select2);
        if(sizeof($result2) == 0){
            $insert2           = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".IDSITO."','custom5','Estate famiglia','1')";
            $ins2              = $dbMysqli->query($insert2);
            $IdTipoGalleryFEstate = $dbMysqli->getInsertId($ins2);
            $insertE           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFEstate."','estate-family1.jpg','1')";
            $dbMysqli->query($insertE);
            $insertE2           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFEstate."','estate-family2.jpg','1')";
            $dbMysqli->query($insertE2);
            $insertE3           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFEstate."','estate-family3.jpg','1')";
            $dbMysqli->query($insertE3);
            $insertE4           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFEstate."','estate-family4.jpg','1')";
            $dbMysqli->query($insertE4);
            $insertE5           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFEstate."','estate-family5.jpg','1')";
            $dbMysqli->query($insertE5);
            $insertE6           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFEstate."','estate-family6.jpg','1')";
            $dbMysqli->query($insertE6);
            $insertE7           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFEstate."','estate-family7.jpg','1')";
            $dbMysqli->query($insertE7);
            $insertE8           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFEstate."','estate-family8.jpg','1')";
            $dbMysqli->query($insertE8);
            $insertE9           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFEstate."','estate-family9.jpg','1')";
            $dbMysqli->query($insertE9);
    
        }

        $select    = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = ".IDSITO." AND TargetType = 'custom6' AND (TargetGallery = 'Inverno sport' OR TargetGallery = 'inverno sport')";
        $result    = $dbMysqli->query($select);
        if(sizeof($result) == 0){
            $insert              = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".IDSITO."','custom6','Inverno sport','1')";
            $ins                 = $dbMysqli->query($insert);
            $IdTipoGalleryBInverno = $dbMysqli->getInsertId($ins);
            $insertI             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBInverno."','inverno-bike1.jpg','1')";
            $dbMysqli->query($insertI);
            $insertI2             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBInverno."','inverno-bike2.jpg','1')";
            $dbMysqli->query($insertI2);
            $insertI3             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBInverno."','inverno-bike3.jpg','1')";
            $dbMysqli->query($insertI3);
            $insertI4             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBInverno."','inverno-bike1.jpg','1')";
            $dbMysqli->query($insertI4);
            $insertI5             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBInverno."','inverno-bike2.jpg','1')";
            $dbMysqli->query($insertI5);
            $insertI6             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBInverno."','inverno-bike3.jpg','1')";
            $dbMysqli->query($insertI6);  
            $insertI7             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBInverno."','inverno-bike1.jpg','1')";
            $dbMysqli->query($insertI7);
            $insertI8             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBInverno."','inverno-bike2.jpg','1')";
            $dbMysqli->query($insertI8);
            $insertI9             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBInverno."','inverno-bike3.jpg','1')";
            $dbMysqli->query($insertI9);             
        }

        $select2    = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = ".IDSITO." AND TargetType = 'custom7'  AND (TargetGallery = 'Estate sport' OR TargetGallery = 'estate sport')";
        $result2    = $dbMysqli->query($select2);
        if(sizeof($result2) == 0){
            $insert2           = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".IDSITO."','custom7','Estate sport','1')";
            $ins2              = $dbMysqli->query($insert2);
            $IdTipoGalleryBEstate = $dbMysqli->getInsertId($ins2);
            $insertE           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBEstate."','estate-bike1.jpg','1')";
            $dbMysqli->query($insertE);
            $insertE2           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBEstate."','estate-bike2.jpg','1')";
            $dbMysqli->query($insertE2);
            $insertE3           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBEstate."','estate-bike3.jpg','1')";
            $dbMysqli->query($insertE3);
            $insertE4           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBEstate."','estate-bike1.jpg','1')";
            $dbMysqli->query($insertE4);
            $insertE5           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBEstate."','estate-bike2.jpg','1')";
            $dbMysqli->query($insertE5);
            $insertE6           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBEstate."','estate-bike3.jpg','1')";
            $dbMysqli->query($insertE6);
            $insertE7           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBEstate."','estate-bike1.jpg','1')";
            $dbMysqli->query($insertE7);
            $insertE8           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBEstate."','estate-bike2.jpg','1')";
            $dbMysqli->query($insertE8);
            $insertE9           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBEstate."','estate-bike3.jpg','1')";
            $dbMysqli->query($insertE9);            
    
        }


        $select    = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = ".IDSITO." AND TargetType = 'custom8' AND (TargetGallery = 'Inverno coppie' OR TargetGallery = 'inverno coppie')";
        $result    = $dbMysqli->query($select);
        if(sizeof($result) == 0){
            $insert              = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".IDSITO."','custom8','Inverno coppie','1')";
            $ins                 = $dbMysqli->query($insert);
            $IdTipoGalleryRInverno = $dbMysqli->getInsertId($ins);
            $insertI             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRInverno."','inverno-romantico1.jpg','1')";
            $dbMysqli->query($insertI);
            $insertI2             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRInverno."','inverno-romantico2.jpg','1')";
            $dbMysqli->query($insertI2);
            $insertI3             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRInverno."','inverno-romantico3.jpg','1')";
            $dbMysqli->query($insertI3);
            $insertI4             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRInverno."','inverno-romantico1.jpg','1')";
            $dbMysqli->query($insertI4);
            $insertI5             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRInverno."','inverno-romantico2.jpg','1')";
            $dbMysqli->query($insertI5);
            $insertI6             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRInverno."','inverno-romantico3.jpg','1')";
            $dbMysqli->query($insertI6); 
            $insertI7             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRInverno."','inverno-romantico1.jpg','1')";
            $dbMysqli->query($insertI7);
            $insertI8             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRInverno."','inverno-romantico2.jpg','1')";
            $dbMysqli->query($insertI8);
            $insertI9             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRInverno."','inverno-romantico3.jpg','1')";
            $dbMysqli->query($insertI9);                       
    
        }

        $select2    = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = ".IDSITO." AND TargetType = 'custom9'  AND (TargetGallery = 'Estate coppie' OR TargetGallery = 'estate coppie')";
        $result2    = $dbMysqli->query($select2);
        if(sizeof($result2) == 0){
            $insert2           = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".IDSITO."','custom9','Estate coppie','1')";
            $ins2              = $dbMysqli->query($insert2);
            $IdTipoGalleryREstate = $dbMysqli->getInsertId($ins2);
            $insertE           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryREstate."','estate-romantico1.jpg','1')";
            $dbMysqli->query($insertE);
            $insertE2           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryREstate."','estate-romantico2.jpg','1')";
            $dbMysqli->query($insertE2);
            $insertE3           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryREstate."','estate-romantico3.jpg','1')";
            $dbMysqli->query($insertE3);
            $insertE4           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryREstate."','estate-romantico1.jpg','1')";
            $dbMysqli->query($insertE4);
            $insertE5           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryREstate."','estate-romantico2.jpg','1')";
            $dbMysqli->query($insertE5);
            $insertE6           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryREstate."','estate-romantico3.jpg','1')";
            $dbMysqli->query($insertE6);
            $insertE7           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryREstate."','estate-romantico1.jpg','1')";
            $dbMysqli->query($insertE7);
            $insertE8           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryREstate."','estate-romantico2.jpg','1')";
            $dbMysqli->query($insertE8);
            $insertE9           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryREstate."','estate-romantico3.jpg','1')";
            $dbMysqli->query($insertE9);                        
    
        }

          // COPIA IMMAGINI DEMO
          $srcPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/demo_image/';
          $destPath =  $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/';  
  
          $srcDir = opendir($srcPath);
          while($readFile = readdir($srcDir))
          {
              if($readFile == 'inverno-family1.jpg' || $readFile == 'inverno-family2.jpg' || $readFile == 'inverno-family3.jpg' || $readFile == 'inverno-family4.jpg' || $readFile == 'inverno-family5.jpg' || $readFile == 'inverno-family6.jpg' || $readFile == 'inverno-family7.jpg' || $readFile == 'inverno-family8.jpg' || $readFile == 'inverno-family9.jpg')
              {
  
                  if (!file_exists($readFile)) 
                  {
                      if(copy($srcPath . $readFile, $destPath . $readFile))
                      {
                          $copia = "Copy file";
                      }
                      else
                      {
                          $copia = "Canot Copy file";
                      }
                  }
              }
              if($readFile == 'estate-family1.jpg' || $readFile == 'estate-family2.jpg' || $readFile == 'estate-family3.jpg' || $readFile == 'estate-family4.jpg' || $readFile == 'estate-family5.jpg' || $readFile == 'estate-family6.jpg' || $readFile == 'estate-family7.jpg' || $readFile == 'estate-family8.jpg' || $readFile == 'estate-family9.jpg')
              {
  
                  if (!file_exists($readFile)) 
                  {
                      if(copy($srcPath . $readFile, $destPath . $readFile))
                      {
                          $copia = "Copy file";
                      }
                      else
                      {
                          $copia = "Canot Copy file";
                      }
                  }
              }

              if($readFile == 'inverno-bike1.jpg' || $readFile == 'inverno-bike2.jpg' || $readFile == 'inverno-bike3.jpg')
              {
  
                  if (!file_exists($readFile)) 
                  {
                      if(copy($srcPath . $readFile, $destPath . $readFile))
                      {
                          $copia = "Copy file";
                      }
                      else
                      {
                          $copia = "Canot Copy file";
                      }
                  }
              }
              if($readFile == 'estate-bike1.jpg' || $readFile == 'estate-bike2.jpg' || $readFile == 'estate-bike3.jpg')
              {
  
                  if (!file_exists($readFile)) 
                  {
                      if(copy($srcPath . $readFile, $destPath . $readFile))
                      {
                          $copia = "Copy file";
                      }
                      else
                      {
                          $copia = "Canot Copy file";
                      }
                  }
              }

              if($readFile == 'inverno-romantico1.jpg' || $readFile == 'inverno-romantico2.jpg' || $readFile == 'inverno-romantico3.jpg')
              {
  
                  if (!file_exists($readFile)) 
                  {
                      if(copy($srcPath . $readFile, $destPath . $readFile))
                      {
                          $copia = "Copy file";
                      }
                      else
                      {
                          $copia = "Canot Copy file";
                      }
                  }
              }
              if($readFile == 'estate-romantico1.jpg' || $readFile == 'estate-romantico2.jpg' || $readFile == 'estate-romantico3.jpg')
              {
  
                  if (!file_exists($readFile)) 
                  {
                      if(copy($srcPath . $readFile, $destPath . $readFile))
                      {
                          $copia = "Copy file";
                      }
                      else
                      {
                          $copia = "Canot Copy file";
                      }
                  }
              }
          }
  
          closedir($srcDir);

        /**
         * ? INSERIMENTO DEI NUOVI TARGET ASSOCIATE AI TEMPLATE
         */
          $select = "SELECT * FROM hospitality_target WHERE idsito = ".IDSITO." AND (Target = 'Inverno famiglia' OR  Target = 'inverno famiglia')";
          $result = $dbMysqli->query($select);
           if(sizeof($result)==0){
               $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,Abilitato,Abilitato_form) VALUES('".IDSITO."','Inverno famiglia','1','1')");

           }
           $select2 = "SELECT * FROM hospitality_target WHERE idsito = ".IDSITO." AND (Target = 'Estate famiglia' OR Target = 'estate famiglia') ";
           $result2 = $dbMysqli->query($select2);
            if(sizeof($result2)==0){
                $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,Abilitato,Abilitato_form) VALUES('".IDSITO."','Estate famiglia','1','1')");

            }          
           $select = "SELECT * FROM hospitality_target WHERE idsito = ".IDSITO." AND (Target = 'Inverno sport' OR  Target = 'inverno sport')";
           $result = $dbMysqli->query($select);
           if(sizeof($result)==0){
               $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,Abilitato,Abilitato_form) VALUES('".IDSITO."','Inverno sport','1','1')");

           }
           $select2 = "SELECT * FROM hospitality_target WHERE idsito = ".IDSITO." AND (Target = 'Estate sport' OR Target = 'estate sport') ";
           $result2 = $dbMysqli->query($select2);
           if(sizeof($result2)==0){
               $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,Abilitato,Abilitato_form) VALUES('".IDSITO."','Estate sport','1','1')");

           }                  
           $select = "SELECT * FROM hospitality_target WHERE idsito = ".IDSITO." AND (Target = 'Inverno coppie' OR  Target = 'inverno coppie')";
           $result = $dbMysqli->query($select);
            if(sizeof($result)==0){
                $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,Abilitato,Abilitato_form) VALUES('".IDSITO."','Inverno coppie','1','1')");

            }
            $select2 = "SELECT * FROM hospitality_target WHERE idsito = ".IDSITO." AND (Target = 'Estate coppie' OR Target = 'estate coppie') ";
            $result2 = $dbMysqli->query($select2);
             if(sizeof($result2)==0){
                 $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,Abilitato,Abilitato_form) VALUES('".IDSITO."','Estate coppie','1','1')");

             }  

        /**
         * ? INSERIMENTO DEI CONTENUTI (NEL DIZIONARIO) ASSOCIATI AI TEMPLATE
         */
        $diz183 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREVENTIVO_CUSTOM4')");
        $id_diz183 = $dbMysqli->getInsertId($diz183);

        $preventivo_i_family_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
                                  Per capire quanto la nostra struttura sia un Family Hotels basti pensare che i nostri ospiti più importanti sono i bambini. La nostra struttura ricettiva è organizzata appositamente per gli sport invernali ed eventi stagionali.';
     
        $preventivo_i_family_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
                                  To understand how much our structure is a Family Hotels just think that our most important guests are children. Our accommodation facility is specially organized for winter sports and seasonal events';                                  

        $preventivo_i_family_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
                                  Pour comprendre à quel point notre structure est un Family Hotels, il suffit de penser que nos clients les plus importants sont des enfants. Notre structure d\'hébergement est spécialement organisée pour les sports d\'hiver et les événements saisonniers';

        $preventivo_i_family_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
                                  Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind. Unsere Unterkunftseinrichtung ist speziell für Wintersport und saisonale Veranstaltungen organisiert';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".IDSITO."','it','".addslashes($preventivo_i_family_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".IDSITO."','en','".addslashes($preventivo_i_family_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".IDSITO."','fr','".addslashes($preventivo_i_family_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".IDSITO."','de','".addslashes($preventivo_i_family_de)."','1')");

        $diz184 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONFERMA_CUSTOM4')");
        $id_diz184 = $dbMysqli->getInsertId($diz184);

        $conferma_i_family_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
                                  Per capire quanto la nostra struttura sia un Family Hotels basti pensare che i nostri ospiti più importanti sono i bambini. La nostra struttura ricettiva è organizzata appositamente per gli sport invernali ed eventi stagionali.';
     
        $conferma_i_family_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
                                  To understand how much our structure is a Family Hotels just think that our most important guests are children.  Our accommodation facility is specially organized for winter sports and seasonal events';                                  

        $conferma_i_family_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
                                  Pour comprendre à quel point notre structure est un Family Hotels, il suffit de penser que nos clients les plus importants sont des enfants. Notre structure d\'hébergement est spécialement organisée pour les sports d\'hiver et les événements saisonniers';

        $conferma_i_family_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
                                  Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind. Unsere Unterkunftseinrichtung ist speziell für Wintersport und saisonale Veranstaltungen organisiert';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".IDSITO."','it','".addslashes($conferma_i_family_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".IDSITO."','en','".addslashes($conferma_i_family_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".IDSITO."','fr','".addslashes($conferma_i_family_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".IDSITO."','de','".addslashes($conferma_i_family_de)."','1')");

        
        $diz183 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREVENTIVO_CUSTOM5')");
        $id_diz183 = $dbMysqli->getInsertId($diz183);

        $preventivo_e_family_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
                                  Per capire quanto la nostra struttura sia un Family Hotels basti pensare che i nostri ospiti più importanti sono i bambini. La nostra struttura ricettiva è organizzata appositamente per gli sport estivi ed eventi stagionali.';
     
        $preventivo_e_family_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
                                  To understand how much our structure is a Family Hotels just think that our most important guests are children. Our accommodation facility is specially organized for summer sports and seasonal events';                                  

        $preventivo_e_family_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
                                  Pour comprendre à quel point notre structure est un Family Hotels, il suffit de penser que nos clients les plus importants sont des enfants. Notre structure d\'hébergement est spécialement organisée pour les sports d\'été et les événements saisonniers';

        $preventivo_e_family_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
                                  Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind. Unsere Unterkunftseinrichtung ist speziell für Sommersport und saisonale Veranstaltungen organisiert';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".IDSITO."','it','".addslashes($preventivo_e_family_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".IDSITO."','en','".addslashes($preventivo_e_family_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".IDSITO."','fr','".addslashes($preventivo_e_family_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".IDSITO."','de','".addslashes($preventivo_e_family_de)."','1')");

        $diz184 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONFERMA_CUSTOM5')");
        $id_diz184 = $dbMysqli->getInsertId($diz184);

        $conferma_e_family_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
                                  Per capire quanto la nostra struttura sia un Family Hotels basti pensare che i nostri ospiti più importanti sono i bambini. La nostra struttura ricettiva è organizzata appositamente per gli sport estivi ed eventi stagionali.';
     
        $conferma_e_family_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
                                  To understand how much our structure is a Family Hotels just think that our most important guests are children.  Our accommodation facility is specially organized for summer sports and seasonal events';                                  

        $conferma_e_family_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
                                  Pour comprendre à quel point notre structure est un Family Hotels, il suffit de penser que nos clients les plus importants sont des enfants. Notre structure d\'hébergement est spécialement organisée pour les sports d\'été  et les événements saisonniers';

        $conferma_e_family_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
                                  Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind. Unsere Unterkunftseinrichtung ist speziell für Sommersport und saisonale Veranstaltungen organisiert';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".IDSITO."','it','".addslashes($conferma_e_family_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".IDSITO."','en','".addslashes($conferma_e_family_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".IDSITO."','fr','".addslashes($conferma_e_family_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".IDSITO."','de','".addslashes($conferma_e_family_de)."','1')");





        $diz185 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREVENTIVO_CUSTOM6')");
        $id_diz185 = $dbMysqli->getInsertId($diz185);

        $preventivo_i_bike_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
                                La nostra struttura ricettiva è organizzata appositamente per i ciclisti e tutti gli sportivi invernali in genere.';
     
        $preventivo_i_bike_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
                                Our accommodation facility is specially organized for cyclists and all winter sportsmen in general.';                                  

        $preventivo_i_bike_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
                                  Notre structure d\'hébergement est spécialement organisée pour les cyclistes et tous les sportifs en général.';

        $preventivo_i_bike_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
                                  Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind.';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".IDSITO."','it','".addslashes($preventivo_i_bike_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".IDSITO."','en','".addslashes($preventivo_i_bike_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".IDSITO."','fr','".addslashes($preventivo_i_bike_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".IDSITO."','de','".addslashes($preventivo_i_bike_de)."','1')");

        $diz186 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONFERMA_CUSTOM6')");
        $id_diz186 = $dbMysqli->getInsertId($diz186);

        $conferma_i_bike_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
                                La nostra struttura ricettiva è organizzata appositamente per i ciclisti e tutti gli sportivi in genere.';
     
        $conferma_i_bike_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
                              Our accommodation facility is specially organized for cyclists and all winter sportsmen in general.';                                  

        $conferma_i_bike_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
                              Notre structure d\'hébergement est spécialement organisée pour les cyclistes et tous les sportifs en général.';

        $conferma_i_bike_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
                              Unsere Unterkunft ist speziell für Radfahrer und alle Sportler im Allgemeinen organisiert.';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".IDSITO."','it','".addslashes($conferma_i_bike_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".IDSITO."','en','".addslashes($conferma_i_bike_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".IDSITO."','fr','".addslashes($conferma_i_bike_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".IDSITO."','de','".addslashes($conferma_i_bike_de)."','1')");


        $diz185 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREVENTIVO_CUSTOM7')");
        $id_diz185 = $dbMysqli->getInsertId($diz185);

        $preventivo_e_bike_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
                                La nostra struttura ricettiva è organizzata appositamente per i ciclisti e tutti gli sportivi estivi in genere.';
     
        $preventivo_e_bike_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
                                Our accommodation facility is specially organized for cyclists and all summer sportsmen in general.';                                  

        $preventivo_e_bike_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
                                  Notre structure d\'hébergement est spécialement organisée pour les cyclistes et tous les sportifs en général.';

        $preventivo_e_bike_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
                                  Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind.';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".IDSITO."','it','".addslashes($preventivo_e_bike_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".IDSITO."','en','".addslashes($preventivo_e_bike_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".IDSITO."','fr','".addslashes($preventivo_e_bike_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".IDSITO."','de','".addslashes($preventivo_e_bike_de)."','1')");

        $diz186 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONFERMA_CUSTOM7')");
        $id_diz186 = $dbMysqli->getInsertId($diz186);

        $conferma_e_bike_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
                                La nostra struttura ricettiva è organizzata appositamente in estate per i ciclisti e tutti gli sportivi in genere.';
     
        $conferma_e_bike_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
                              Our accommodation facility is specially organized for cyclists and all summer sportsmen in general.';                                  

        $conferma_e_bike_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
                              Notre structure d\'hébergement est spécialement organisée pour les cyclistes et tous les sportifs en général.';

        $conferma_e_bike_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
                              Unsere Unterkunft ist speziell für Radfahrer und alle Sportler im Allgemeinen organisiert.';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".IDSITO."','it','".addslashes($conferma_e_bike_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".IDSITO."','en','".addslashes($conferma_e_bike_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".IDSITO."','fr','".addslashes($conferma_e_bike_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".IDSITO."','de','".addslashes($conferma_e_bike_de)."','1')");             




        $diz187 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREVENTIVO_CUSTOM8')");
        $id_diz187 = $dbMysqli->getInsertId($diz187);

        $preventivo_i_romantico_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
                                      Una esperienza di soggiorno invernale pensata esclusivamente per le coppie.';
     
        $preventivo_i_romantico_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
                                        A winter stay experience designed exclusively for couples';                                  

        $preventivo_i_romantico_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
                                        Une expérience de séjour d\'hiver conçue exclusivement pour les couples';

        $preventivo_i_romantico_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
                                        Ein Winteraufenthaltserlebnis exklusiv für Paare';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".IDSITO."','it','".addslashes($preventivo_i_romantico_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".IDSITO."','en','".addslashes($preventivo_i_romantico_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".IDSITO."','fr','".addslashes($preventivo_i_romantico_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".IDSITO."','de','".addslashes($preventivo_i_romantico_de)."','1')");

        $diz188 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONFERMA_CUSTOM8')");
        $id_diz188 = $dbMysqli->getInsertId($diz188);

        $conferma_i_romantico_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
                                     Una esperienza di soggiorno invernale pensata esclusivamente per le coppie.';
     
        $conferma_i_romantico_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
                                    A winter stay experience designed exclusively for couples';                                  

        $conferma_i_romantico_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
                                        Une expérience de séjour d\'hiver conçue exclusivement pour les couples';

        $conferma_i_romantico_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
                                    Ein Winteraufenthaltserlebnis exklusiv für Paare';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".IDSITO."','it','".addslashes($conferma_i_romantico_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".IDSITO."','en','".addslashes($conferma_i_romantico_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".IDSITO."','fr','".addslashes($conferma_i_romantico_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".IDSITO."','de','".addslashes($conferma_i_romantico_de)."','1')");

        $diz187 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREVENTIVO_CUSTOM9')");
        $id_diz187 = $dbMysqli->getInsertId($diz187);

        $preventivo_e_romantico_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
        Una esperienza di soggiorno estiva pensata esclusivamente per le coppie..';
     
        $preventivo_e_romantico_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
        A summer stay experience designed exclusively for couples.';                                  

        $preventivo_e_romantico_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
        Une expérience de séjour estival conçue exclusivement pour les couples.';

        $preventivo_e_romantico_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
        Ein Sommererlebnis exklusiv für Paare.';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".IDSITO."','it','".addslashes($preventivo_e_romantico_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".IDSITO."','en','".addslashes($preventivo_e_romantico_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".IDSITO."','fr','".addslashes($preventivo_e_romantico_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz187."','".IDSITO."','de','".addslashes($preventivo_e_romantico_de)."','1')");

        $diz188 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONFERMA_CUSTOM9')");
        $id_diz188 = $dbMysqli->getInsertId($diz188);

        $conferma_e_romantico_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
        Una esperienza di soggiorno estiva pensata esclusivamente per le coppie.';
     
        $conferma_e_romantico_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
        A summer stay experience designed exclusively for couples.';                                  

        $conferma_e_romantico_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
        Une expérience de séjour estival conçue exclusivement pour les couples.';

        $conferma_e_romantico_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
        Ein Sommererlebnis exklusiv für Paare.';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".IDSITO."','it','".addslashes($conferma_e_romantico_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".IDSITO."','en','".addslashes($conferma_e_romantico_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".IDSITO."','fr','".addslashes($conferma_e_romantico_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".IDSITO."','de','".addslashes($conferma_e_romantico_de)."','1')");             

        /**
         * ? GESTIONE CONFIGURATORE
         */
        $descr_adr .= 'Check per visualizzare nella dashboard calcolo ADR QUOTO'."\r\n";
        $descr_adr .= 'Impostando il valore : '."\r\n";
        $descr_adr .= '0 = info-box non viene visualizzato'."\r\n";
        $descr_adr .= '1 = info-box  viene visualizzato'."\r\n";
        $dbMysqli->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_adr','".$descr_adr."','0')");

        /**
         * * FINE NUOVO CODICE
         */


         //imposto numero di paginazione di default
        $dbMysqli->query("INSERT INTO hospitality_breadcrumb(idsito,numero) VALUES('".IDSITO."','15')");
         // dizionario del software
        $diz1 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SOLUZIONECONFERMATA')");
        $id_diz1 = $dbMysqli->getInsertId($diz1);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".IDSITO."','it','Soluzione Confermata')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".IDSITO."','en','Solution Confirmed')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".IDSITO."','fr','Solution Confirmée')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1."','".IDSITO."','de','Bestätigte Lösung')");
         //
        $diz2 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATISOGGIORNO')");
        $id_diz2 = $dbMysqli->getInsertId($diz2);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2."','".IDSITO."','it','Dati del soggiorno:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2."','".IDSITO."','en','Brief summary reservation:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2."','".IDSITO."','fr','Restez données:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2."','".IDSITO."','de','Bleiben Daten:')");
        //
        $diz3 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TIPOSOGGIORNO')");
        $id_diz3 = $dbMysqli->getInsertId($diz3);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3."','".IDSITO."','it','Tipo soggiorno:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3."','".IDSITO."','en','Type of stay:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3."','".IDSITO."','fr','Type de séjour:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3."','".IDSITO."','de','Aufenthalt Art:')");
        //
        $diz4 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATAARRIVO')");
        $id_diz4 = $dbMysqli->getInsertId($diz4);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4."','".IDSITO."','it','Data arrivo:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4."','".IDSITO."','en','Arrival:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4."','".IDSITO."','fr','Arrivée:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4."','".IDSITO."','de','Ankunft:')");
        //
        $diz5 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATAPARTENZA')");
        $id_diz5 = $dbMysqli->getInsertId($diz5);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','".IDSITO."','it','Data partenza:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','".IDSITO."','en','Departure:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','".IDSITO."','fr','Date de départ:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz5."','".IDSITO."','de','Abreisedatum:')");
        //
        $diz6 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SISTEMAZIONE')");
        $id_diz6 = $dbMysqli->getInsertId($diz6);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6."','".IDSITO."','it','Sistemazione:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6."','".IDSITO."','en','Accommodation:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6."','".IDSITO."','fr','Hébergement:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6."','".IDSITO."','de','Unterkunft:')");
        //
        $diz7 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CAPIENZAADULTI')");
        $id_diz7 = $dbMysqli->getInsertId($diz7);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7."','".IDSITO."','it','<b>Capienza Adulti:</b>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7."','".IDSITO."','en','<b>Capacity Adults:</b>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7."','".IDSITO."','fr','<b>Capacité Adultes:</b>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7."','".IDSITO."','de','<b>Kapazität Erwachsene:</b>')");
        //
        $diz8 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CAPIENZABAMBINI')");
        $id_diz8 = $dbMysqli->getInsertId($diz8);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8."','".IDSITO."','it','<b>Capienza Bambini:</b>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8."','".IDSITO."','en','<b>Children Capacity:</b>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8."','".IDSITO."','fr','<b>La capacité des enfants:</b>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8."','".IDSITO."','de','<b>Kinder Kapazität:</b>')");
        //
        $diz9 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','METRATURA')");
        $id_diz9 = $dbMysqli->getInsertId($diz9);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9."','".IDSITO."','it','<b>Metratura:</b>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9."','".IDSITO."','en','<b>Square footage:</b>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9."','".IDSITO."','fr','<b>Pieds carrés:</b>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9."','".IDSITO."','de','<b>Quadratmeterzahl:</b>')");
        //
        $diz10 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SERVIZICAMERA')");
        $id_diz10 = $dbMysqli->getInsertId($diz10);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10."','".IDSITO."','it','<b>Servizi in camera:</b>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10."','".IDSITO."','en','<b>Room facilities:</b>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10."','".IDSITO."','fr','<b>Équipements en Chambre:</b>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10."','".IDSITO."','de','<b>Zimmerausstattung:</b>')");
        //
        $diz11 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PRENOTAZIONE')");
        $id_diz11 = $dbMysqli->getInsertId($diz11);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11."','".IDSITO."','it','Prenotazione')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11."','".IDSITO."','en','Reservation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11."','".IDSITO."','fr','Réservation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11."','".IDSITO."','de','Buchung')");
        //
        $diz12 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONFERMA')");
        $id_diz12 = $dbMysqli->getInsertId($diz12);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12."','".IDSITO."','it','Conferma')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12."','".IDSITO."','en','Confirm')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12."','".IDSITO."','fr','Confirmation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12."','".IDSITO."','de','Bestätigung')");
        //
        $diz13 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREVENTIVO')");
        $id_diz13 = $dbMysqli->getInsertId($diz13);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz13."','".IDSITO."','it','Preventivo')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz13."','".IDSITO."','en','Quote')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz13."','".IDSITO."','fr','Citation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz13."','".IDSITO."','de','Zitat')");
        //
        $diz14 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','NOTE')");
        $id_diz14 = $dbMysqli->getInsertId($diz14);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz14."','".IDSITO."','it','Note:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz14."','".IDSITO."','en','Notes:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz14."','".IDSITO."','fr','Remarques:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz14."','".IDSITO."','de','Aufzeichnungen:')");
        //
        $diz15 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TXTLINK1')");
        $id_diz15 = $dbMysqli->getInsertId($diz15);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz15."','".IDSITO."','it','Clicca qui per vedere l\'offerta a te dedicata... ')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz15."','".IDSITO."','en','Click here to see the page dedicated to you ...')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz15."','".IDSITO."','fr','Cliquez ici pour voir l\'offre dédiée à vous ...')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz15."','".IDSITO."','de','Klicken Sie hier, um zu sehen, das Angebot zu Ihnen gewidmet ...')");
        //
        $diz16 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TXTLINK2')");
        $id_diz16 = $dbMysqli->getInsertId($diz16);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz16."','".IDSITO."','it','Scopri qual\'è la nostra migliore offerta per il periodo da te richiesto!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz16."','".IDSITO."','en','Find out what our best offer for the required period!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz16."','".IDSITO."','fr','Découvrez ce que notre meilleure offre pour la période requise!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz16."','".IDSITO."','de','Entdecken Sie, was unser bestes Angebot für den gewünschten Zeitraum!')");
        //
        $diz17 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGINARISERVATA')");
        $id_diz17 = $dbMysqli->getInsertId($diz17);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz17."','".IDSITO."','it','Pagina Web riservata a:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz17."','".IDSITO."','en','Web page reserved for:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz17."','".IDSITO."','fr','Page Web réservée aux:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz17."','".IDSITO."','de','Webseite reserviert für:')");
        //
        $diz18 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SALUTI_H')");
        $id_diz18 = $dbMysqli->getInsertId($diz18);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz18."','".IDSITO."','it','I nostri migliori saluti.')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz18."','".IDSITO."','en','Our best regards.')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz18."','".IDSITO."','fr','Nos meilleures salutations.')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz18."','".IDSITO."','de','Unsere freundlichen Grüßen.')");
        //
        $diz19 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OFFERTA_DETTAGLIO')");
        $id_diz19 = $dbMysqli->getInsertId($diz19);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz19."','".IDSITO."','it','Vai al dettaglio dell\'offerta')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz19."','".IDSITO."','en','View detailed offer')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz19."','".IDSITO."','fr','Voir offre détaillée')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz19."','".IDSITO."','de','Detailierten Angebot')");
        //
        $diz20 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGAMENTO')");
        $id_diz20 = $dbMysqli->getInsertId($diz20);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz20."','".IDSITO."','it','Caparra da versare per la conferma della prenotazione:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz20."','".IDSITO."','en','Deposit to be paid for the reservation confirmation:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz20."','".IDSITO."','fr','Dépôt requis pour confirmer la réservation:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz20."','".IDSITO."','de','Kaution erforderlich, um Reservierung zu bestätigen:')");
        //
        $diz85 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ACCONTO')");
        $id_diz85 = $dbMysqli->getInsertId($diz85);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz85."','".IDSITO."','it','Caparra calcolata sul prezzo del soggiorno')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz85."','".IDSITO."','en','Deposit calculated on the price of the stay')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz85."','".IDSITO."','fr','Caution calculée sur le prix du séjour')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz85."','".IDSITO."','de','Kaution berechnet auf den Preis des Aufenthaltes')");
        //
        $diz21 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO')");
        $id_diz21 = $dbMysqli->getInsertId($diz21);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz21."','".IDSITO."','it','Dopo essere stato nostro ospite, le chiediamo una sua opinione sui nostri servizi')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz21."','".IDSITO."','en','After being our guest, we ask you your own opinion about our services')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz21."','".IDSITO."','fr','Après avoir été notre invité, nous demandons son opinion sur nos services')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz21."','".IDSITO."','de','Nachdem unser Gast zu sein, bitten wir seine Meinung über unsere Dienstleistungen')");
        //
        $diz22 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL')");
        $id_diz22 = $dbMysqli->getInsertId($diz22);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz22."','".IDSITO."','it','Gentile [cliente], fiduciosi che il suo soggiorno presso la nostra struttura ricettiva sia stato di suo gradimento, la invitiamo a cliccare sul link che trova in basso nella mail, in pochi minuti potrà dare una sua opinione sui servizi relativi al nostro hotel.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz22."','".IDSITO."','en','Dear [cliente], confident that his stay at our accommodation has been to his liking, please click on the link located at the bottom in the mail in a few minutes will give an opinion on the services related to our hotels.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz22."','".IDSITO."','fr','Cher [cliente], confiant que son séjour dans notre établissement a été à son gré, s\'il vous plaît cliquer sur le lien situé au bas de l\'e-mail en quelques minutes donnera un avis sur les services liés à nos hôtels.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz22."','".IDSITO."','de','Sehr [cliente], zuversichtlich, dass sein Aufenthalt in unserer Unterkunft nach seinem Geschmack gewesen ist, klicken Sie bitte auf den Link am Ende in der E-Mail in wenigen Minuten befindet sich eine Stellungnahme zu den Dienstleistungen für unsere Hotels im Zusammenhang geben.','1')");
        //
        $diz23 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','VAI_AL_QUEST')");
        $id_diz23 = $dbMysqli->getInsertId($diz23);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz23."','".IDSITO."','it','Vai al questionario')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz23."','".IDSITO."','en','Go to the questionnaire')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz23."','".IDSITO."','fr','Accédez au questionnaire')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz23."','".IDSITO."','de','Gehen Sie auf den Fragebogen')");
        //
        //Dizionario CLOUD
        $diz24 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','VISITA_NOSTRO_SITO')");
        $id_diz24 = $dbMysqli->getInsertId($diz24);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz24."','".IDSITO."','it','Visita il nostro sito')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz24."','".IDSITO."','en','Visit our website')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz24."','".IDSITO."','fr','Visitez notre site Web')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz24."','".IDSITO."','de','Besuchen Sie unsere Website')");
        //
        $diz25 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MESSAGGIO_PER_NOI')");
        $id_diz25 = $dbMysqli->getInsertId($diz25);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz25."','".IDSITO."','it','Messaggio per noi')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz25."','".IDSITO."','en','Message for us')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz25."','".IDSITO."','fr','Message pour nous')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz25."','".IDSITO."','de','Nachricht für uns')");
        //
        $diz26 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PROPOSTE')");
        $id_diz26 = $dbMysqli->getInsertId($diz26);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz26."','".IDSITO."','it','Proposte')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz26."','".IDSITO."','en','Proposals')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz26."','".IDSITO."','fr','Propositions')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz26."','".IDSITO."','de','Vorschläge')");
        //
        $diz27 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SOGGIORNI')");
        $id_diz27 = $dbMysqli->getInsertId($diz27);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz27."','".IDSITO."','it','Soggiorni')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz27."','".IDSITO."','en','Stays')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz27."','".IDSITO."','fr','Séjours')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz27."','".IDSITO."','de','Aufenthalte')");
        //
        $diz28 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','EVENTI')");
        $id_diz28 = $dbMysqli->getInsertId($diz28);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz28."','".IDSITO."','it','Eventi')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz28."','".IDSITO."','en','Events')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz28."','".IDSITO."','fr','Evénements')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz28."','".IDSITO."','de','Geschehen')");
        //
        $diz29 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PDI')");
        $id_diz29 = $dbMysqli->getInsertId($diz29);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz29."','".IDSITO."','it','Punti di Interesse')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz29."','".IDSITO."','en','Points of Interest')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz29."','".IDSITO."','fr','Points d\'intérêt')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz29."','".IDSITO."','de','Interesse Punkte')");
        //
        $diz30 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONTATTA_HOTEL')");
        $id_diz30 = $dbMysqli->getInsertId($diz30);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz30."','".IDSITO."','it','Contatta l\'Hotel')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz30."','".IDSITO."','en','Contact the Hotel')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz30."','".IDSITO."','fr','Contactez l\'Hôtel')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz30."','".IDSITO."','de','Kontaktieren Sie das Hotel')");
        //
        $diz31 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MESSAGGIO')");
        $id_diz31 = $dbMysqli->getInsertId($diz31);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz31."','".IDSITO."','it','Messaggio')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz31."','".IDSITO."','en','Message')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz31."','".IDSITO."','fr','Message')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz31."','".IDSITO."','de','Nachricht')");
        //
        $diz32 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','INVIA')");
        $id_diz32 = $dbMysqli->getInsertId($diz32);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz32."','".IDSITO."','it','Invia')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz32."','".IDSITO."','en','Submit')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz32."','".IDSITO."','fr','Soumettre')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz32."','".IDSITO."','de','Einreichen')");
        //
        $diz33 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','IL_SUO')");
        $id_diz33 = $dbMysqli->getInsertId($diz33);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz33."','".IDSITO."','it','Il suo')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz33."','".IDSITO."','en','His')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz33."','".IDSITO."','fr','Son')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz33."','".IDSITO."','de','Seine')");
        //
        $diz34 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DA')");
        $id_diz34 = $dbMysqli->getInsertId($diz34);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz34."','".IDSITO."','it','da')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz34."','".IDSITO."','en','from')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz34."','".IDSITO."','fr','à partir de')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz34."','".IDSITO."','de','von')");
        //
        $diz37 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OFFERTA')");
        $id_diz37 = $dbMysqli->getInsertId($diz37);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz37."','".IDSITO."','it','Offerta')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz37."','".IDSITO."','en','Offers')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz37."','".IDSITO."','fr','Offre')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz37."','".IDSITO."','de','Angebot')");
        //
        $diz38 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DEL')");
        $id_diz38 = $dbMysqli->getInsertId($diz38);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz38."','".IDSITO."','it','del')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz38."','".IDSITO."','en','the')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz38."','".IDSITO."','fr','la')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz38."','".IDSITO."','de','die')");
        //
        $diz39 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATA_ARRIVO')");
        $id_diz39 = $dbMysqli->getInsertId($diz39);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz39."','".IDSITO."','it','Data di Arrivo')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz39."','".IDSITO."','en','Check-in date')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz39."','".IDSITO."','fr','Date d\'arrivée')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz39."','".IDSITO."','de','Ankunft')");
        //
        $diz40 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATA_PARTENZA')");
        $id_diz40 = $dbMysqli->getInsertId($diz40);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz40."','".IDSITO."','it','Data di Partenza')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz40."','".IDSITO."','en','Departure date')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz40."','".IDSITO."','fr','Date de départ')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz40."','".IDSITO."','de','Abfahrtsdatum')");
        //
        $diz41 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PROPOSTE_PER_NR_ADULTI')");
        $id_diz41 = $dbMysqli->getInsertId($diz41);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz41."','".IDSITO."','it','Proposte per N° Adulti:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz41."','".IDSITO."','en','Proposals for N° Adults:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz41."','".IDSITO."','fr','Les propositions de N° Adultes:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz41."','".IDSITO."','de','Vorschläge für N° Erwachsene:')");
        //
        $diz42 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SOGGIORNO_PER_NR_ADULTI')");
        $id_diz42 = $dbMysqli->getInsertId($diz42);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz42."','".IDSITO."','it','Soggiorno per N° Adulti:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz42."','".IDSITO."','en','Stay to N° Adults:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz42."','".IDSITO."','fr','Restez à N° Adultes:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz42."','".IDSITO."','de','Bleiben Sie auf dem N° Erwachsene:')");
        //
        $diz43 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','NR_BAMBINI')");
        $id_diz43 = $dbMysqli->getInsertId($diz43);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz43."','".IDSITO."','it','N° Bambini:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz43."','".IDSITO."','en','N° Children:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz43."','".IDSITO."','fr','N° Enfants:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz43."','".IDSITO."','de','Nr Kinder:')");
        //
        $diz44 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','NOTTI')");
        $id_diz44 = $dbMysqli->getInsertId($diz44);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz44."','".IDSITO."','it','N° Notti')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz44."','".IDSITO."','en','N° Nights')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz44."','".IDSITO."','fr','N° Nuits')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz44."','".IDSITO."','de','N° Nächte')");
        //
        $diz45 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ADULTI')");
        $id_diz45 = $dbMysqli->getInsertId($diz45);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz45."','".IDSITO."','it','Adulti:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz45."','".IDSITO."','en','Adults:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz45."','".IDSITO."','fr','Adultes:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz45."','".IDSITO."','de','Erwachsene:')");
        //
        $diz46 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','BAMBINI')");
        $id_diz46 = $dbMysqli->getInsertId($diz46);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz46."','".IDSITO."','it','Bambini:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz46."','".IDSITO."','en','Children:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz46."','".IDSITO."','fr','Enfants:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz46."','".IDSITO."','de','Kinder:')");
        //
        $diz48 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PROPOSTA')");
        $id_diz48 = $dbMysqli->getInsertId($diz48);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz48."','".IDSITO."','it','Proposta')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz48."','".IDSITO."','en','Proposal')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz48."','".IDSITO."','fr','Proposition')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz48."','".IDSITO."','de','Vorschlag')");
        //
        $diz49 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SOGGIORNO')");
        $id_diz49 = $dbMysqli->getInsertId($diz49);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz49."','".IDSITO."','it','Soggiorno:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz49."','".IDSITO."','en','Stay:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz49."','".IDSITO."','fr','Séjour:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz49."','".IDSITO."','de','Aufenthalt:')");
        //
        $diz50 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TIPOCAMERA')");
        $id_diz50 = $dbMysqli->getInsertId($diz50);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz50."','".IDSITO."','it','Tipologia Camera:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz50."','".IDSITO."','en','Room type:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz50."','".IDSITO."','fr','Type de chambre:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz50."','".IDSITO."','de','Zimmerkategorie:')");
        //
        $diz51 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SERVIZI_CAMERA')");
        $id_diz51 = $dbMysqli->getInsertId($diz51);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz51."','".IDSITO."','it','Servizi Camera:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz51."','".IDSITO."','en','Room services:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz51."','".IDSITO."','fr','Les services de chambre:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz51."','".IDSITO."','de','Zimmerservice:')");
        //
        $diz52 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CAMERA')");
        $id_diz52 = $dbMysqli->getInsertId($diz52);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz52."','".IDSITO."','it','Camera:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz52."','".IDSITO."','en','Room:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz52."','".IDSITO."','fr','Chambre:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz52."','".IDSITO."','de','Zimmer:')");
        //
        $diz53 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREZZO')");
        $id_diz53 = $dbMysqli->getInsertId($diz53);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz53."','".IDSITO."','it','Prezzo')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz53."','".IDSITO."','en','Price')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz53."','".IDSITO."','fr','Prix')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz53."','".IDSITO."','de','Preis')");
        //
        $diz54 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DA_LISTINO')");
        $id_diz54 = $dbMysqli->getInsertId($diz54);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz54."','".IDSITO."','it','da listino')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz54."','".IDSITO."','en','pricelist')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz54."','".IDSITO."','fr','pricelist')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz54."','".IDSITO."','de','preisliste')");
        //
        $diz55 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','E_PROPOSTO')");
        $id_diz55 = $dbMysqli->getInsertId($diz55);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz55."','".IDSITO."','it',' per il soggiorno ')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz55."','".IDSITO."','en',' for the stay ')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz55."','".IDSITO."','fr',' pour le séjour ')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz55."','".IDSITO."','de',' für den Aufenthalt ')");
        //
        $diz56 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ALLA_CO')");
        $id_diz56 = $dbMysqli->getInsertId($diz56);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz56."','".IDSITO."','it','Alla c/a di ')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz56."','".IDSITO."','en','At ')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz56."','".IDSITO."','fr','A ')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz56."','".IDSITO."','de','Bei ')");
        //
        $diz57 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONTENUTO_MSG')");
        $id_diz57 = $dbMysqli->getInsertId($diz57);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz57."','".IDSITO."','it','vorremmo accettare la proposta di soggiorno:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz57."','".IDSITO."','en','we would like to accept the proposal of stay:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz57."','".IDSITO."','fr','nous tenons à accepter la proposition du séjour:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz57."','".IDSITO."','de','möchten wir den Vorschlag des Aufenthalts zu akzeptieren:')");
        //
        $diz58 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CORDIALMENTE')");
        $id_diz58 = $dbMysqli->getInsertId($diz58);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz58."','".IDSITO."','it','Cordialmente')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz58."','".IDSITO."','en','Cordially')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz58."','".IDSITO."','fr','Cordialement')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz58."','".IDSITO."','de','Herzlich')");
        //
        $diz59 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','VISUALIZZA_MAPPA')");
        $id_diz59 = $dbMysqli->getInsertId($diz59);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz59."','".IDSITO."','it','Visualizza sulla Mappa')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz59."','".IDSITO."','en','Show on map')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz59."','".IDSITO."','fr','Voir sur la carte')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz59."','".IDSITO."','de','Auf der Karte anzeigen')");
        //
        $diz60 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DOVE_SIAMO')");
        $id_diz60 = $dbMysqli->getInsertId($diz60);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz60."','".IDSITO."','it','Dove Siamo')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz60."','".IDSITO."','en','Where we are')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz60."','".IDSITO."','fr','Où sommes-nous')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz60."','".IDSITO."','de','Wo wir sind')");
        //
        $diz61 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PROPOSTA_SCELTA')");
        $id_diz61 = $dbMysqli->getInsertId($diz61);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz61."','".IDSITO."','it','Scegli la proposta ')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz61."','".IDSITO."','en','Choosing proposal ')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz61."','".IDSITO."','fr','Choisissez la proposition ')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz61."','".IDSITO."','de','Wählen Sie den Vorschlag ')");
        //
        $diz62 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PLACEHOLDER_PROPOSTA')");
        $id_diz62 = $dbMysqli->getInsertId($diz62);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz62."','".IDSITO."','it','Scegliere una delle proposte soggiorno, selezionando il checkbox relativo!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz62."','".IDSITO."','en','Choose from the proposed hotel offers, by checking the appropriate checkbox!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz62."','".IDSITO."','fr','Choisissez un séjour proposé, en cochant la case appropriée!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz62."','".IDSITO."','de','Wählen Sie eines der vorgeschlagenen Aufenthalt, indem Sie die entsprechende Checkbox!')");
        //
        $diz63 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SALUTI')");
        $id_diz63 = $dbMysqli->getInsertId($diz63);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz63."','".IDSITO."','it','Saluti')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz63."','".IDSITO."','en','Greetings')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz63."','".IDSITO."','fr','Salutations')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz63."','".IDSITO."','de','Gruß')");
        //
        $diz64 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SELEZIONA_PROPOSTA')");
        $id_diz64 = $dbMysqli->getInsertId($diz64);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz64."','".IDSITO."','it','Seleziona la proposta e contatta l\'hotel!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz64."','".IDSITO."','en','Select the proposal and contact the hotel!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz64."','".IDSITO."','fr','Sélectionnez la proposition et de contacter l\'hôtel!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz64."','".IDSITO."','de','Wählen Sie den Vorschlag und kontaktieren Sie das Hotel!')");
        //
        $diz65 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','STAMPA')");
        $id_diz65 = $dbMysqli->getInsertId($diz65);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz65."','".IDSITO."','it','VOUCHER PROMEMORIA')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz65."','".IDSITO."','en','VOUCHER REMINDER')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz65."','".IDSITO."','fr','RAPPEL VOUCHER')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz65."','".IDSITO."','de','VOUCHER ERINNERUNG')");
        //
        $diz66 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ANNI')");
        $id_diz66 = $dbMysqli->getInsertId($diz66);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz66."','".IDSITO."','it','anni')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz66."','".IDSITO."','en','age')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz66."','".IDSITO."','fr','âge')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz66."','".IDSITO."','de','Alter')");
        //
        $diz67 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONDIZIONI_GENERALI')");
        $id_diz67 = $dbMysqli->getInsertId($diz67);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz67."','".IDSITO."','it','Condizioni Generali')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz67."','".IDSITO."','en','General Conditions')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz67."','".IDSITO."','fr','Conditions générales')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz67."','".IDSITO."','de','Allgemeine Bedingungen')");
        //
        $diz68 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CREATA_DA')");
        $id_diz68 = $dbMysqli->getInsertId($diz68);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz68."','".IDSITO."','it','Creato da:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz68."','".IDSITO."','en','Created by:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz68."','".IDSITO."','fr','Créé par:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz68."','".IDSITO."','de','Erstellt von:')");
        //
        $diz69 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','HOTELCHAT')");
        $id_diz69 = $dbMysqli->getInsertId($diz69);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz69."','".IDSITO."','it','Hai delle domande per noi? Questo è lo spazio giusto!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz69."','".IDSITO."','en','You have a question for us? This is the right spot!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz69."','".IDSITO."','fr','Vous avez une question pour nous? Ceci est le bon endroit!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz69."','".IDSITO."','de','Sie haben eine Frage an uns? Dies ist der richtige Ort!')");
        //
        $diz70 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','QUESTIONARIO')");
        $id_diz70 = $dbMysqli->getInsertId($diz70);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz70."','".IDSITO."','it','Questionario soddisfazione del cliente')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz70."','".IDSITO."','en','Customer satisfaction questionnaire')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz70."','".IDSITO."','fr','Questionnaire satisfaction')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz70."','".IDSITO."','de','Kundenzufriedenheit')");
        //
        $diz71 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTO_QUESTIONARIO')");
        $id_diz71 = $dbMysqli->getInsertId($diz71);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz71."','".IDSITO."','it','Gentile [cliente], <br>esprimi il tuo parere sul soggiorno che hai appena trascorso presso la nostra struttura, per ogni domanda puoi dare un valore di soddisfazione ed un commento!<br> Il tuo pensiero sarà per noi fonte indispensabile per migliorare i nostri servizi in Hotel.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz71."','".IDSITO."','en','Dear [cliente], Give your opinion about your stay you just spent at our facility, for each question you can give a satisfaction value and a comment! Your thinking will be for us a source essential to improve our services in the hotel.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz71."','".IDSITO."','fr','Cher [cliente], exprimer votre opinion sur votre séjour, vous venez de passer à notre établissement, pour chaque question, vous pouvez donner une valeur de satisfaction et un commentaire! Votre pensée sera pour nous une source essentielle pour améliorer nos services dans l\'hôtel.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz71."','".IDSITO."','de','Lieber [cliente], äußern Sie Ihre Meinung über Ihren Aufenthalt Sie nur in unserer Einrichtung verbracht, für jede Frage können Sie einen Zufriedenheitswert und einen Kommentar abgeben! Ihr Denken wird für uns eine Quelle wesentlich für unsere Dienstleistungen im Hotel zu verbessern.','1')");
        //
        $diz72 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','NO_QUESTIONARIO')");
        $id_diz72 = $dbMysqli->getInsertId($diz72);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz72."','".IDSITO."','it','Questionario già compilato!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz72."','".IDSITO."','en','Questionnaire already filled!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz72."','".IDSITO."','fr','Questionnaire déjà rempli!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz72."','".IDSITO."','de','Fragebogen bereits ausgefüllt!')");
        //
        $diz73 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','THANKS_QUESTIONARIO')");
        $id_diz73 = $dbMysqli->getInsertId($diz73);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz73."','".IDSITO."','it','Ringraziandovi per aver compilato questo breve questionario, ci auguriamo di rivedervi presto nel nostro hotel!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz73."','".IDSITO."','en','Thank you for filling out this short questionnaire, we hope to see you soon in our hotel!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz73."','".IDSITO."','fr','Je vous remercie de remplir ce court questionnaire, nous espérons vous voir bientôt dans notre hôtel!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz73."','".IDSITO."','de','Ich danke Ihnen für das Füllen dieser kurzen Fragebogen aus, wir hoffen, Sie bald in unserem Hotel zu sehen!')");
        //
        $diz74 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','LASCIA_COMMENTO')");
        $id_diz74 = $dbMysqli->getInsertId($diz74);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz74."','".IDSITO."','it','Lascia un commento')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz74."','".IDSITO."','en','Leave a comment')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz74."','".IDSITO."','fr','Laisser un commentaire')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz74."','".IDSITO."','de','Hinterlassen Sie einen Kommentar')");
        //
        $diz75 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CARTA_CREDITO')");
        $id_diz75 = $dbMysqli->getInsertId($diz75);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz75."','".IDSITO."','it','Garanzia Carta di Credito')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz75."','".IDSITO."','en','Guarantee Credit Card')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz75."','".IDSITO."','fr','Garantie Carte de crédit')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz75."','".IDSITO."','de','Garantie Kreditkarte')");
        //
        $diz76 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTO_CARTA_CREDITO')");
        $id_diz76 = $dbMysqli->getInsertId($diz76);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz76."','".IDSITO."','it','La carta di credito serve solo per garantire la prenotazione!<br> L\'importo del soggiorno non verrà addebitato sulla sua carta di credito, i cui dati rimangono conservati criptati su server sicuro a garanzia della prenotazione fino al giorno del suo arrivo.<br> Il soggiorno verrà pagato direttamente all\'hotel.')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz76."','".IDSITO."','en','A credit card is required to guarantee your reservation!<br> The amount of the booking will not be billed to your credit card, whose data are stored on a secure server to guarantee your reservation until the day of his arrival. The stay will be paid directly to the hotel.')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz76."','".IDSITO."','fr','Une carte de crédit est nécessaire pour garantir votre réservation! Le montant du séjour sera débité de votre carte de crédit, dont les données sont stockées cryptées sur un serveur sécurisé pour garantir votre réservation jusqu\'à ce que le jour de son arrivée. Le séjour sera payé directement à l\'hôtel.')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz76."','".IDSITO."','de','Wird eine Kreditkarte benötigt, um Ihre Reservierung zu garantieren! Die Menge des Aufenthaltes wird von Ihrer Kreditkarte abgebucht werden, deren Daten auf einem sicheren Server verschlüsselt gespeichert Ihre Reservierung bis zu dem Tag seiner Ankunft zu garantieren. Der Aufenthalt wird direkt im Hotel bezahlt.')");
        //
        $diz77 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SALVA_CARTA_CREDITO')");
        $id_diz77 = $dbMysqli->getInsertId($diz77);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz77."','".IDSITO."','it','Salva Carta di Credito')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz77."','".IDSITO."','en','Save Credit Card')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz77."','".IDSITO."','fr','Sauvegarder la carte de crédit')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz77."','".IDSITO."','de','Speichern Kreditkarte')");
        //
        $diz78 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CARTA')");
        $id_diz78 = $dbMysqli->getInsertId($diz78);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz78."','".IDSITO."','it','Carta')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz78."','".IDSITO."','en','Card')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz78."','".IDSITO."','fr','Carte')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz78."','".IDSITO."','de','Karte')");
        //
        $diz79 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','N_CARTA')");
        $id_diz79 = $dbMysqli->getInsertId($diz79);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz79."','".IDSITO."','it','Numero carta')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz79."','".IDSITO."','en','Card number')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz79."','".IDSITO."','fr','numéro de carte')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz79."','".IDSITO."','de','Kartennummer')");
        //
        $diz80 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','INTESTATARIO')");
        $id_diz80 = $dbMysqli->getInsertId($diz80);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz80."','".IDSITO."','it','Intestatario')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz80."','".IDSITO."','en','Accountholder')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz80."','".IDSITO."','fr','Candidat')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz80."','".IDSITO."','de','Kandidat')");
        //
        $diz81 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCADENZA')");
        $id_diz81 = $dbMysqli->getInsertId($diz81);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz81."','".IDSITO."','it','Scadenza')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz81."','".IDSITO."','en','Deadline')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz81."','".IDSITO."','fr','Date limite')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz81."','".IDSITO."','de','Frist')");
        //
        $diz82 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CODICE')");
        $id_diz82 = $dbMysqli->getInsertId($diz82);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz82."','".IDSITO."','it','Codice CVV2')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz82."','".IDSITO."','en','Code CVV2')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz82."','".IDSITO."','fr','Code CVV2')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz82."','".IDSITO."','de','Code CVV2')");
        //
        $diz83 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MSG_CARTA')");
        $id_diz83 = $dbMysqli->getInsertId($diz83);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz83."','".IDSITO."','it','Salvataggio criptato della Carta avvenuto con successo!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz83."','".IDSITO."','en','Save the encrypted happened Charter successfully!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz83."','".IDSITO."','fr','Save the crypté est arrivé Charte avec succès!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz83."','".IDSITO."','de','Speichern Sie die verschlüsselte passiert Charta erfolgreich!')");
        //
        $diz84 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATI_CARTA')");
        $id_diz84 = $dbMysqli->getInsertId($diz84);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz84."','".IDSITO."','it','Dati Carta di Credito già inseriti!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz84."','".IDSITO."','en','Credit Card Data already entered!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz84."','".IDSITO."','fr','Credit Card Data est déjà entré!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz84."','".IDSITO."','de','Kreditkartendaten bereits eingetragen!')");
        //
        $diz86 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ACCONSENTI_PRIVACY_POLICY')");
        $id_diz86 = $dbMysqli->getInsertId($diz86);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz86."','".IDSITO."','it','Ho preso visione dell\'informativa privacy e delle <a href=\"javascript:;\" id=\"sblocca_politiche\">politiche di cancellazione</a>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz86."','".IDSITO."','en','I have read the privacy policy and the <a href=\"javascript:;\" id=\"sblocca_politiche\">cancellation policies</a>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz86."','".IDSITO."','fr','J\'ai lu la politique de confidentialité et les  <a href=\"javascript:;\" id=\"sblocca_politiche\">conditions d\'annulation</a>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz86."','".IDSITO."','de','Ich habe die Datenschutzerklärung und die <a href=\"javascript:;\" id=\"sblocca_politiche\">Stornierungsbedingungen gelesen</a>')");
        //
        $diz87 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ACCONSENTI_PRIVACY_POLICY_SOGGIORNO')");
        $id_diz87 = $dbMysqli->getInsertId($diz87);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz87."','".IDSITO."','it','Ho preso visione dell\'informativa privacy e delle <a href=\"javascript:;\" id=\"sblocca_politiche_soggiorno\">politiche di cancellazione</a>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz87."','".IDSITO."','en','I have read the privacy policy and the <a href=\"javascript:;\" id=\"sblocca_politiche_soggiorno\">cancellation policies</a>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz87."','".IDSITO."','fr','J\'ai lu la politique de confidentialité et les  <a href=\"javascript:;\" id=\"sblocca_politiche_soggiorno\">conditions d\'annulation</a>')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz87."','".IDSITO."','de','Ich habe die Datenschutzerklärung und die <a href=\"javascript:;\" id=\"sblocca_politiche_soggiorno\">Stornierungsbedingungen gelesen</a>')");
        //
        $diz88 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','NO_REPLAY_EMAIL')");
        $id_diz88 = $dbMysqli->getInsertId($diz88);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz88."','".IDSITO."','it','Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz88."','".IDSITO."','en','This email was sent automatically by the software, do not reply to this email!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz88."','".IDSITO."','fr','Ce courriel a été envoyé automatiquement par le logiciel, ne répond pas à cet email!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz88."','".IDSITO."','de','Diese E-Mail wurde von der Software automatisch gesendet wird, antworten Sie nicht auf diese E-Mail!')");
        //
        $diz89 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_VAUCHER')");
        $id_diz89 = $dbMysqli->getInsertId($diz89);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz89."','".IDSITO."','it','Conferma di prenotazione accettata e voucher')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz89."','".IDSITO."','en','Confirming queuing and vouchers')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz89."','".IDSITO."','fr','Confirmant les files d\'attente et des bons')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz89."','".IDSITO."','de','Bestätigen Queuing und Gutscheine')");

        $diz90 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_VAUCHER')");
        $id_diz90 = $dbMysqli->getInsertId($diz90);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz90."','".IDSITO."','it','Gentile [cliente], confermiamo le sua prenotazione come accettata e la invitiamo a stampare il Voucher riepilogativo come promemoria, che troverà nella landing page dedicata, da presentare alla reception al giorno del suo arrivo!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz90."','".IDSITO."','en','Dear [cliente], we confirm your reservation as accepted and please print the summary Voucher as a reminder, you will find in the dedicated landing page, to be presented at the reception on the day of his arrival!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz90."','".IDSITO."','fr','Cher [cliente], nous confirmons votre réservation acceptée et s\'il vous plaît imprimer votre bon de reprise comme un rappel, vous trouverez la page de destination dédiée à être présenté à la réception le jour de son arrivée!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz90."','".IDSITO."','de','Sehr [cliente], bestätigen wir Ihre Reservierung als angenommen und bitte Ihren Lebenslauf Gutschein als Erinnerung zu drucken, erhalten Sie die Zielseite finden gewidmet am Tag seiner Ankunft an der Rezeption vorgelegt werden!','1')");
       //
        $diz91 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RE_CHAT')");
        $id_diz91 = $dbMysqli->getInsertId($diz91);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz91."','".IDSITO."','it','Gentile [cliente], hai avuto un messaggio sulla chat della proposta che hai già visionato. Torna alla landing page a te dedicata per visualizzarlo!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz91."','".IDSITO."','en','Dear [cliente], you had a message on the chat of the proposal you have already viewed. Go back to the landing page dedicated to you to view it!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz91."','".IDSITO."','fr','Cher [cliente], vous avez eu un message sur le chat de la proposition que vous avez déjà consultée. Retournez à la page de destination qui vous est dédiée pour la voir!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz91."','".IDSITO."','de','Sehr geehrte [cliente], Sie hatten im Chat eine Nachricht zu dem Angebot, das Sie bereits angesehen haben. Kehren Sie zur Startseite zurück, um sie anzuzeigen!','1')");
           //
        $diz111 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RE_CHAT')");
        $id_diz111 = $dbMysqli->getInsertId($diz111);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz111."','".IDSITO."','it','Gentile [cliente], hai un messaggio in Chat')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz111."','".IDSITO."','en','Dear [cliente], you have a message in Chat')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz111."','".IDSITO."','fr','Cher [cliente], vous avez un message dans le chat')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz111."','".IDSITO."','de','Sehr geehrter [cliente], Sie haben eine Nachricht im Chat')");

        $diz112 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CARTACREDITOGARANZIA')");
        $id_diz112 = $dbMysqli->getInsertId($diz112);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz112."','".IDSITO."','it','Carta di Credito a Garanzia')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz112."','".IDSITO."','en','Credit Card Guarantee')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz112."','".IDSITO."','fr','Garantie de carte de crédit')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz112."','".IDSITO."','de','Kreditkartengarantie')");

        $diz1_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ALTERNATIVA')");
        $id_diz1_new = $dbMysqli->getInsertId($diz1_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1_new."','".IDSITO."','it','alternativa')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1_new."','".IDSITO."','en','alternative')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1_new."','".IDSITO."','fr','alternative')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz1_new."','".IDSITO."','de','alternative')");

        $diz2_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATEALTERNATIVE')");
        $id_diz2_new = $dbMysqli->getInsertId($diz2_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2_new."','".IDSITO."','it','Date alternative')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2_new."','".IDSITO."','en','Alternative dates')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2_new."','".IDSITO."','fr','Dates alternatives')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz2_new."','".IDSITO."','de','Alternative Termine')");

        $diz3_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ETA')");
        $id_diz3_new = $dbMysqli->getInsertId($diz3_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3_new."','".IDSITO."','it','Età')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3_new."','".IDSITO."','en','Age')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3_new."','".IDSITO."','fr','âge')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz3_new."','".IDSITO."','de','Alter')");

        $diz4_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SERVIZI_AGGIUNTIVI')");
        $id_diz4_new = $dbMysqli->getInsertId($diz4_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4_new."','".IDSITO."','it','Servizi Aggiuntivi')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4_new."','".IDSITO."','en','Additional services')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4_new."','".IDSITO."','fr','Services supplémentaires')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4_new."','".IDSITO."','de','Zusätzliche Dienste')");

        $diz4X = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SERVIZIO')");
        $id_diz4X = $dbMysqli->getInsertId($diz4X);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4X."','".IDSITO."','it','Servizio')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4X."','".IDSITO."','en','Service')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4X."','".IDSITO."','fr','Service')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4X."','".IDSITO."','de','Dienste')");

        $diz4Y = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CALCOLO')");
        $id_diz4Y = $dbMysqli->getInsertId($diz4Y);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4Y."','".IDSITO."','it','Calcolo')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4Y."','".IDSITO."','en','Calculation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4Y."','".IDSITO."','fr','Calcul')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4Y."','".IDSITO."','de','Berechnung')");

        $diz4K = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREZZO_SERVIZIO')");
        $id_diz4K = $dbMysqli->getInsertId($diz4K);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4K."','".IDSITO."','it','Prezzo Servizio')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4K."','".IDSITO."','en','Price Service')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4K."','".IDSITO."','fr','Service de prix')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz4K."','".IDSITO."','de','Preis Service')");

        $diz5_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTO_VOUCHER')");
        $id_diz5_new = $dbMysqli->getInsertId($diz5_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new."','".IDSITO."','it','Gentile [cliente]...','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new."','".IDSITO."','en','Dear [cliente]...','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new."','".IDSITO."','fr','Cher [cliente]...','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new."','".IDSITO."','de','Lieber [cliente]...','1')");

        $descr_it = '<p>Gentile <strong>[cliente]</strong>,</p>

                <p>questo buono voucher è stato emesso in riferimento alla vostra richiesta di variazione date del soggiorno da voi prenotato!</p>

                <p>Per verificare la disponibilità e prenotare il suo prossimo soggiorno, la preghiamo di contattarci e di conservare o stampare questo voucher.</p>

                <p>Questo buono potrà essere utilizzato entro e non oltre la data di scadenza, il <b>[datascadenza]</b></p>';

        $descr_en = '<p>Dear <strong>[cliente]</strong>,</p>

                        <p>this voucher has been issued for your booking cancellation request!</p>
                        
                        <p>To check availability and book your next stay, please contact us and keep or print this voucher.</p>

                        <p>This voucher can be used no later than the expiry date, the <b>[datascadenza]</b></p>';

        $descr_fr = '<p>Cher <strong>[cliente]</strong>,</p>

                    <p>ce bon a été émis pour votre demande d\'annulation de réservation!</p>
                    
                    <p>Pour vérifier la disponibilité et réserver votre prochain séjour, veuillez nous contacter et conserver ou imprimer ce bon.</p>
                    
                    <p>Ce bon peut être utilisé au plus tard à la date d\'expiration, la <b>[datascadenza]</b></p>';

        $descr_de = '<p>Sehr geehrter <strong>[cliente]</strong>,</p>

                    <p>Dieser Gutschein wurde für Ihre Buchungsstornierungsanfrage ausgestellt!</p>
                    
                    <p>Um die Verfügbarkeit zu prüfen und Ihren nächsten Aufenthalt zu buchen, kontaktieren Sie uns bitte und bewahren Sie diesen Gutschein auf oder drucken Sie ihn aus.</p>
                    
                    <p>Dieser Gutschein kann spätestens am Ablaufdatum, dem <b>[datascadenza]</b>, verwendet werden.</p>';

        $diz5_new_bis = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTO_VOUCHER_RECUPERO')");
        $id_diz5_new_bis = $dbMysqli->getInsertId($diz5_new_bis);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_bis."','".IDSITO."','it','".addslashes($descr_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_bis."','".IDSITO."','en','".addslashes($descr_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_bis."','".IDSITO."','fr','".addslashes($descr_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_bis."','".IDSITO."','de','".addslashes($descr_de)."','1')");

        $diz5_new_tris = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FRASE_RECUPERO_CAPARRA')");
        $id_diz5_new_tris = $dbMysqli->getInsertId($diz5_new_tris);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_tris."','".IDSITO."','it','La caparra è già stata pagata tramite [tipopagamento]<br><br>Il pari importo sarà pienamente ri-utilizzabile entro [datavalidita]','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_tris."','".IDSITO."','en','The deposit has already been paid by [tipopagamento]<br><br>The same amount will be fully re-usable by [datavalidita]','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_tris."','".IDSITO."','fr','L\'acompte a déjà été payé par [tipopagamento]<br><br>Le même montant sera entièrement réutilisable d\'ici le [datavalidita]','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz5_new_tris."','".IDSITO."','de','Die Anzahlung wurde bereits von [tipopagamento] bezahlt. <br> <br> Der gleiche Betrag kann bis zum [datavalidita] vollständig wiederverwendet werden.','1')");


        $diz6_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','UNA_TANTUM')");
        $id_diz6_new = $dbMysqli->getInsertId($diz6_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6_new."','".IDSITO."','it','Una tantum')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6_new."','".IDSITO."','en','Lump sum')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6_new."','".IDSITO."','fr','Une fois')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz6_new."','".IDSITO."','de','Einmal')");

        $diz7_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','AL_GIORNO')");
        $id_diz7_new = $dbMysqli->getInsertId($diz7_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_new."','".IDSITO."','it','Al giorno')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_new."','".IDSITO."','en','Per day')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_new."','".IDSITO."','fr','Par jour')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_new."','".IDSITO."','de','Pro Tag')");


        $diz7_bis_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','A_PERSONA')");
        $id_diz7_bis_new = $dbMysqli->getInsertId($diz7_bis_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_bis_new."','".IDSITO."','it','A persona')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_bis_new."','".IDSITO."','en','Per person')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_bis_new."','".IDSITO."','fr','Par personne')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz7_bis_new."','".IDSITO."','de','Pro Person')");


        $diz8_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGA_CARTA_CREDITO')");
        $id_diz8_new = $dbMysqli->getInsertId($diz8_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8_new."','".IDSITO."','it','Paga con Carta di Credito')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8_new."','".IDSITO."','en','Pay by Credit Card')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8_new."','".IDSITO."','fr','Payer par carte de crédit')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz8_new."','".IDSITO."','de','Zahlen Sie mit Kreditkarte')");

        $diz9_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGA_PAYPAL')");
        $id_diz9_new = $dbMysqli->getInsertId($diz9_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9_new."','".IDSITO."','it','Paga con PayPal')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9_new."','".IDSITO."','en','Pay by PayPal')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9_new."','".IDSITO."','fr','Payer par PayPal')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz9_new."','".IDSITO."','de','Zahlen Sie mit PayPal')");

        $diz10_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MSG_PAYPAL')");
        $id_diz10_new = $dbMysqli->getInsertId($diz10_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10_new."','".IDSITO."','it','Pagamento salvato con successo, seguirà nostro voucher di conferma')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10_new."','".IDSITO."','en','Payment successfully saved, follow our confirmation voucher')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10_new."','".IDSITO."','fr','Paiement enregistré avec succès, suivre notre bon de confirmation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz10_new."','".IDSITO."','de','Zahlung erfolgreich gespeichert, beachten Sie bitte folgende Bestätigung Gutschein')");

        $diz11_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGA_STRIPE')");
        $id_diz11_new = $dbMysqli->getInsertId($diz11_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".IDSITO."','it','Paga con STRIPE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".IDSITO."','en','Pay by STRIPE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".IDSITO."','fr','Payer par STRIPE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".IDSITO."','de','Zahlen Sie mit STRIPE')");

        $diz12_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MSG_STRIPE')");
        $id_diz12_new = $dbMysqli->getInsertId($diz12_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".IDSITO."','it','Pagamento salvato con successo, seguirà nostro voucher di conferma')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".IDSITO."','en','Payment successfully saved, follow our confirmation voucher')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".IDSITO."','fr','Paiement enregistré avec succès, suivre notre bon de confirmation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".IDSITO."','de','Zahlung erfolgreich gespeichert, beachten Sie bitte folgende Bestätigung Gutschein')");


       //
        $diz92 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','INFORMATIVA_PRIVACY')");
        $id_diz92 = $dbMysqli->getInsertId($diz92);

        $file_it = BASE_PATH_SITO.'txt_trattamenti/it/trattamento.txt';
        if(file_exists($file_it)){
          $contents_it  = file($file_it);
          $string_it    = implode($contents_it);
          $string_it    = nl2br($string_it);
          $string_it    = addslashes($string_it);
        }
        $file_en = BASE_PATH_SITO.'txt_trattamenti/en/trattamento.txt';
        if(file_exists($file_it)){
          $contents_en  = file($file_en);
          $string_en    = implode($contents_en);
          $string_en    = nl2br($string_en);
          $string_en    = addslashes($string_en);
        }
        $file_fr = BASE_PATH_SITO.'txt_trattamenti/fr/trattamento.txt';
        if(file_exists($file_fr)){
          $contents_fr  = file($file_fr);
          $string_fr    = implode($contents_fr);
          $string_fr    = nl2br($string_fr);
          $string_fr    = addslashes($string_fr);
        }
        $file_de = BASE_PATH_SITO.'txt_trattamenti/de/trattamento.txt';
        if(file_exists($file_de)){
          $contents_de  = file($file_de);
          $string_de    = implode($contents_de);
          $string_de    = nl2br($string_de);
          $string_de    = addslashes($string_de);
        }
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz92."','".IDSITO."','it','".$string_it."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz92."','".IDSITO."','en','".$string_en."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz92."','".IDSITO."','fr','".$string_fr."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz92."','".IDSITO."','de','".$string_de."','1')");
         //
        $diz93 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','NOME')");
        $id_diz93 = $dbMysqli->getInsertId($diz93);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz93."','".IDSITO."','it','Nome')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz93."','".IDSITO."','en','Name')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz93."','".IDSITO."','fr','Nom')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz93."','".IDSITO."','de','Name')");
        //
        $diz94 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','COGNOME')");
        $id_diz94 = $dbMysqli->getInsertId($diz94);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz94."','".IDSITO."','it','Cognome')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz94."','".IDSITO."','en','Surname')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz94."','".IDSITO."','fr','Nom de famille')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz94."','".IDSITO."','de','Nachname')");
        //
        $diz95 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TELEFONO')");
        $id_diz95 = $dbMysqli->getInsertId($diz95);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz95."','".IDSITO."','it','Telefono')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz95."','".IDSITO."','en','Phone')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz95."','".IDSITO."','fr','Téléphone')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz95."','".IDSITO."','de','Telefon')");
      //
        $diz96 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCADENZA_OFFERTA')");
        $id_diz96 = $dbMysqli->getInsertId($diz96);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz96."','".IDSITO."','it','La caparra dovrà essere versata entro questa data di scadenza')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz96."','".IDSITO."','en','The deposit must be paid within this expiration date')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz96."','".IDSITO."','fr','Le dépôt doit être payé à cette date d\'expiration')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz96."','".IDSITO."','de','Die Kaution ist nach diesem Ablaufdatum zu zahlen')");

        $diz97 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ACCONTO_OFFERTA')");
        $id_diz97 = $dbMysqli->getInsertId($diz97);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz97."','".IDSITO."','it','Scegli il metodo di pagamento')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz97."','".IDSITO."','en','Choose payment method')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz97."','".IDSITO."','fr','Choisissez le mode de paiement')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz97."','".IDSITO."','de','Zahlungsart auswählen')");

        $diz98 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREZZO_CAMERA')");
        $id_diz98 = $dbMysqli->getInsertId($diz98);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz98."','".IDSITO."','it','Prezzo Camera')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz98."','".IDSITO."','en','Room Price')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz98."','".IDSITO."','fr','Prix de la chambre')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz98."','".IDSITO."','de','Zimmerpreis')");
      //
        $diz99 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','DATA_RICHIESTA')");
        $id_diz99 = $dbMysqli->getInsertId($diz99);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz99."','".IDSITO."','it','Data della richiesta:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz99."','".IDSITO."','en','Date of request:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz99."','".IDSITO."','fr','Date de la demande:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz99."','".IDSITO."','de','Datum angefordert:')");
       //
        $diz100 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TXTLINK3')");
        $id_diz100 = $dbMysqli->getInsertId($diz100);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz100."','".IDSITO."','it','Clicca e scopri i metodi di pagamento per confermare il tuo soggiorno!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz100."','".IDSITO."','en','Click and find the payment methods to confirm your stay!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz100."','".IDSITO."','fr','Cliquez et trouver les moyens de paiement pour confirmer votre séjour!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz100."','".IDSITO."','de','Klicken Sie auf und die Zahlungsmethoden, um Ihren Aufenthalt zu bestätigen!')");
      //
        $diz101 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RIEPILOGO_OFFERTA')");
        $id_diz101 = $dbMysqli->getInsertId($diz101);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz101."','".IDSITO."','it','Riepilogo Offerta')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz101."','".IDSITO."','en','Summary Offer')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz101."','".IDSITO."','fr','Offre sommaire')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz101."','".IDSITO."','de','Zusammenfassung Angebot')");
      //
        $diz102 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TXTLINK4')");
        $id_diz102 = $dbMysqli->getInsertId($diz102);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz102."','".IDSITO."','it','Raccontaci la tua esperienza in hotel...')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz102."','".IDSITO."','en','Tell us your experience at the hotel ...')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz102."','".IDSITO."','fr','Donnez-nous votre expérience à l\'hôtel ...')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz102."','".IDSITO."','de','Teilen Sie uns Ihre Erfahrung im Hotel ...')");
      //
        $diz103 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGINARISERVATA_VAUCHER')");
        $id_diz103 = $dbMysqli->getInsertId($diz103);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz103."','".IDSITO."','it','Vai alla pagina del voucher')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz103."','".IDSITO."','en','Go to the voucher page')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz103."','".IDSITO."','fr','Aller à la page de coupons')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz103."','".IDSITO."','de','Gehen Sie auf die Seite Gutschein')");
      //
        $diz104 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TXTLINK5')");
        $id_diz104 = $dbMysqli->getInsertId($diz104);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz104."','".IDSITO."','it','Stampa il voucher e ricordati di portarlo con te in hotel...')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz104."','".IDSITO."','en','Print the voucher and remember to take with you at the hotel ...')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz104."','".IDSITO."','fr','Imprimer le coupon et souvenez-vous de l\'apporter avec vous à l\'hôtel ...')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz104."','".IDSITO."','de','Drucken Sie den Gutschein und denken Sie daran, es zu bringen Sie zum Hotel ...')");
      //
        $diz105 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGINARISERVATA_CHAT')");
        $id_diz105 = $dbMysqli->getInsertId($diz105);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz105."','".IDSITO."','it','Leggi la nostra proposta...')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz105."','".IDSITO."','en','Read our proposal ...')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz105."','".IDSITO."','fr','Lire notre proposition ...')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz105."','".IDSITO."','de','Lesen Sie unseren Vorschlag ...')");
     //
        $diz106 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TXTLINK6')");
        $id_diz106 = $dbMysqli->getInsertId($diz106);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz106."','".IDSITO."','it','Clicca qui per vedere il messaggio sulla tua chat!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz106."','".IDSITO."','en','Click here to see the message on your chat!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz106."','".IDSITO."','fr','Cliquez ici pour voir le message sur votre chat!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz106."','".IDSITO."','de','Klicken Sie hier, um die Nachricht in Ihrem Chat zu sehen!')");
     //
        $diz107 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ANCORA_DOMANDE')");
        $id_diz107 = $dbMysqli->getInsertId($diz107);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz107."','".IDSITO."','it','Hai ancora delle domande da farci?')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz107."','".IDSITO."','en','You still have questions for us?')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz107."','".IDSITO."','fr','Vous avez encore des questions pour nous?')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz107."','".IDSITO."','de','Sie haben noch Fragen an uns?')");
     //
        $diz108 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCRIVICI_SE_HAI_BISOGNO')");
        $id_diz108 = $dbMysqli->getInsertId($diz108);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz108."','".IDSITO."','it','Scrivici se hai bisogno')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz108."','".IDSITO."','en','Write to us if you need')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz108."','".IDSITO."','fr','Écrivez-nous si vous avez besoin')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz108."','".IDSITO."','de','Schreiben Sie uns, wenn Sie brauchen')");
     //
        $diz109 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ACCONTO_CARTA')");
        $id_diz109 = $dbMysqli->getInsertId($diz109);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz109."','".IDSITO."','it','Verrà prelevata la caparra in caso di mancanto rispetto delle politiche di cancellazione!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz109."','".IDSITO."','en','The down payment will be charged in case of lack of compliance with the cancellation policies!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz109."','".IDSITO."','fr','Le dépôt sera prise en cas de non-respect des conditions d\'annulation!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz109."','".IDSITO."','de','Die Kaution wird im Falle eines Ausfalls getroffen werden mit Stornierungsbedingungen zu erfüllen!')");
    //
        $diz110 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','INVIA_GIUDIZI')");
        $id_diz110 = $dbMysqli->getInsertId($diz110);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz110."','".IDSITO."','it','Inviaci i tuoi giudizi')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz110."','".IDSITO."','en','Send us your feedback')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz110."','".IDSITO."','fr','Envoyez-nous vos commentaires')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz110."','".IDSITO."','de','Senden Sie uns Ihr Feedback')");
        //
        $diz120 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RESELLING')");
        $id_diz120 = $dbMysqli->getInsertId($diz120);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120."','".IDSITO."','it','Benvenuti')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120."','".IDSITO."','en','Welcome')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120."','".IDSITO."','fr','Bienvenue')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120."','".IDSITO."','de','Willkommen')");
        //
        $diz121 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RESELLING')");
        $id_diz121 = $dbMysqli->getInsertId($diz121);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121."','".IDSITO."','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>La cortesia, la disponibilità e la premura del nostro staff, ci auguriamo siano una meravigliosa scoperta.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121."','".IDSITO."','en','Dear [cliente], welcome at our accommodation.<br>Courtesy, availability and care of our staff, we hope will be a wonderful discovery.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121."','".IDSITO."','fr','Cher [cliente], bienvenue à notre hébergement.<br>La courtoisie, la serviabilité et la gentillesse de notre personnel, nous espérons être une merveilleuse découverte.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121."','".IDSITO."','de','Lieber [cliente], willkommen zu unserer Unterkunft. <br>Höflichkeit, Verfügbarkeit und Betreuung unserer Mitarbeiter, wir hoffen, ein wunderbarer Fund sein.','1')");
        //


        $diz120_bis = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RECENSIONE')");
        $id_diz120_bis = $dbMysqli->getInsertId($diz120_bis);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','".IDSITO."','it','Dopo essere stato nostro ospite, le chiediamo una sua recensione su TripAdvisor sulla nostra struttura ricettiva!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','".IDSITO."','en','After being our guest, we ask for your review on TripAdvisor on our accommodation!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','".IDSITO."','fr','Après avoir été notre invité, nous vous demandons votre avis sur TripAdvisor sur notre hébergement!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz120_bis."','".IDSITO."','de','Nachdem wir unser Gast waren, bitten wir Sie um Ihre Bewertung auf TripAdvisor für unsere Unterkunft!')");
        //
        $diz121_bis = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RECENSIONE')");
        $id_diz121_bis = $dbMysqli->getInsertId($diz121_bis);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".IDSITO."','it','Gentile [cliente], vorremmo invitarti a lasciare una recensione su TripAdvisor, esprimi il tuo parere sul soggiorno che hai appena trascorso presso la nostra struttura! Il tuo pensiero sarà per noi fonte indispensabile per migliorare i nostri servizi in Hotel.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".IDSITO."','en','Dear [cliente], we would like to invite you to leave a review on TripAdvisor, express your opinion on the stay you have just spent at our facility! Your thought will be an indispensable source for us to improve our services in the Hotel.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".IDSITO."','fr','Cher [cliente], nous aimerions vous inviter à laisser un avis sur TripAdvisor, exprimer votre opinion sur le séjour que vous venez de passer dans notre établissement! Votre pensée sera une source indispensable pour nous d\'améliorer nos services dans l\'hôtel.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz121_bis."','".IDSITO."','de','Sehr geehrter [cliente], wir möchten Sie einladen, eine Bewertung auf TripAdvisor abzugeben und Ihre Meinung zu dem Aufenthalt zu äußern, den Sie gerade in unserer Einrichtung verbracht haben! Ihr Gedanke wird für uns eine unverzichtbare Quelle sein, um unsere Dienstleistungen im Hotel zu verbessern.','1')");



        $diz125 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RESEND_CONFERMA')");
        $id_diz125 = $dbMysqli->getInsertId($diz125);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz125."','".IDSITO."','it','Ricorda di confermare la prenotazione')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz125."','".IDSITO."','en','Remember to confirm the reservation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz125."','".IDSITO."','fr','Rappelez-vous de confirmer la réservation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz125."','".IDSITO."','de','Denken Sie daran, die Reservierung zu bestätigen')");
        //
        $diz126 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RESEND_CONFERMA')");
        $id_diz126 = $dbMysqli->getInsertId($diz126);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz126."','".IDSITO."','it','Gentile [cliente], si sta avvicinando la data di scadenza per il versamento della caparra, le ricordiamo che per confermare la sua prenotazione come accettata, deve effettuare il pagamento della caparra o dare il numero di carta di credito a garanzia.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz126."','".IDSITO."','en','Dear [cliente],  is approaching the expiration date for the payment of the deposit, remember to confirm your reservation as accepted, you must pay the deposit or give your credit card number to guarantee.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz126."','".IDSITO."','fr','Cher [cliente],  se rapproche de la date d\'expiration pour le paiement de la caution, rappelez-vous pour confirmer votre réservation comme acceptée, doit effectuer le paiement du dépôt ou de donner votre numéro de carte de crédit pour garantir.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz126."','".IDSITO."','de','Lieber [cliente],  wird das Ablaufdatum für die Zahlung der Kaution nähern, denken Sie daran Ihre Reservierung zu bestätigen, wie angenommen, muss die Zahlung der Kaution zu machen oder Ihre Kreditkartennummer geben zu gewährleisten.','1')");
        //
        $diz127 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RECALL_PREVENTIVI')");
        $id_diz127 = $dbMysqli->getInsertId($diz127);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz127."','".IDSITO."','it','Ciao [cliente], ricorda di visualizzare la nostra proposta di soggiorno')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz127."','".IDSITO."','en','Hi [cliente], remember to see our proposal to stay')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz127."','".IDSITO."','fr','Bonjour [cliente], rappelez-vous de montrer notre séjour proposé')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz127."','".IDSITO."','de','Hallo [cliente], erinnern uns vorgeschlagenen Aufenthalt zu zeigen')");
        //
        $diz128 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RECALL_PREVENTIVI')");
        $id_diz128 = $dbMysqli->getInsertId($diz128);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz128."','".IDSITO."','it','Gentile [cliente], si sta avvicinando la data di scadenza per la proposta di soggiorno, le ricordiamo che rimarrà valida ancora per poco. Non si faccia sfuggire questa grande opportunità!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz128."','".IDSITO."','en','Dear [cliente], you are approaching the expiration date for the proposed stay, remember to remain valid for a short while. Do not face out on this great opportunity!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz128."','".IDSITO."','fr','Cher [cliente], se rapproche de la date d\'expiration pour le séjour proposé, nous vous rappelons qu\'il restera valable pendant une courte période. Ne pas faire face à cette grande opportunité!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz128."','".IDSITO."','de','Lieber [cliente], wird das Ablaufdatum für die geplante Aufenthalt nähern wir Sie daran erinnern, dass es für eine kurze Zeit gültig bleiben. Sie stehen nicht auf diese große Chance heraus!','1')");
        //
        $diz129 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCELGO_VAGLIA')");
        $id_diz129 = $dbMysqli->getInsertId($diz129);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz129."','".IDSITO."','it','Scelgo il pagamento con Vaglia')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz129."','".IDSITO."','en','I choose payment by money order')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz129."','".IDSITO."','fr','Je choisis de payer par mandat')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz129."','".IDSITO."','de','Ich wähle von Geld zu zahlen')");
        //
        $diz130 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MSG_VAGLIA')");
        $id_diz130 = $dbMysqli->getInsertId($diz130);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz130."','".IDSITO."','it','Scelta salvata con successo, rimaniamo in attesa del Fax o della Email con ricevuta di pagamento, seguirà nostro voucher di conferma')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz130."','".IDSITO."','en','Choosing saved successfully, we are waiting for the Fax or Email with proof of payment, follow our confirmation voucher')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz130."','".IDSITO."','fr','Choisir correctement enregistré, nous attendons le fax ou e-mail avec la preuve de paiement, suivre notre bon de confirmation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz130."','".IDSITO."','de','Erfolgreich gespeichert Aussuchen, wir sind für das Fax oder E-Mail mit Zahlungsnachweis warten, beachten Sie bitte folgende Bestätigung Gutschein')");
        //
        $diz131 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCELGO_BONIFICO')");
        $id_diz131 = $dbMysqli->getInsertId($diz131);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz131."','".IDSITO."','it','Scelgo il pagamento con Bonifico')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz131."','".IDSITO."','en','I choose to pay by bank transfer')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz131."','".IDSITO."','fr','Je choisis de payer par virement bancaire')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz131."','".IDSITO."','de','Ich wähle per Banküberweisung zu bezahlen')");
        //
        $diz132 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MSG_BONIFICO')");
        $id_diz132 = $dbMysqli->getInsertId($diz132);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz132."','".IDSITO."','it','Scelta salvata con successo, rimaniamo in attesa del Fax o della Email con numero di CRO o ricevuta di pagamento, seguirà nostro voucher di conferma')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz132."','".IDSITO."','en','Choosing saved successfully, we remain waiting for the Fax or Email with CRO number or proof of payment, follow our confirmation voucher')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz132."','".IDSITO."','fr','Choisir correctement enregistré, nous restons en attente de fax ou e-mail avec le numéro CRO ou une preuve de paiement, suivre notre bon de confirmation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz132."','".IDSITO."','de','Erfolgreich gespeichert Aussuchen, bleiben wir für das Fax oder E-Mail mit CRO Nummer oder Nachweis über die Zahlung warten, beachten Sie bitte folgende Bestätigung Gutschein')");
        //
        $diz133 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RESELLING_FAMILY')");
        $id_diz133 = $dbMysqli->getInsertId($diz133);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz133."','".IDSITO."','it','Benvenuti')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz133."','".IDSITO."','en','Welcome')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz133."','".IDSITO."','fr','Bienvenue')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz133."','".IDSITO."','de','Willkommen')");
        //
        $diz134 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RESELLING_FAMILY')");
        $id_diz134 = $dbMysqli->getInsertId($diz134);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz134."','".IDSITO."','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>Per capire la differenza, basta pensare che i nostri ospiti più importanti sono i bambini.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz134."','".IDSITO."','en','Dear [cliente], welcome at our accommodation.<br>To understand the difference, just think that our most important guests are children.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz134."','".IDSITO."','fr','Cher [cliente], bienvenue à notre hébergement.<br>Pour comprendre la différence, il suffit de penser que nos clients les plus importants sont des enfants.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz134."','".IDSITO."','de','Lieber [cliente], willkommen zu unserer Unterkunft.<br>Um den Unterschied zu verstehen, man denke nur, dass unsere wichtigsten Gäste sind Kinder.','1')");
        //
        $diz135 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RESELLING_BUSINESS')");
        $id_diz135 = $dbMysqli->getInsertId($diz135);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz135."','".IDSITO."','it','Benvenuti')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz135."','".IDSITO."','en','Welcome')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz135."','".IDSITO."','fr','Bienvenue')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz135."','".IDSITO."','de','Willkommen')");
        //
        $diz136 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RESELLING_BUSINESS')");
        $id_diz136 = $dbMysqli->getInsertId($diz136);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz136."','".IDSITO."','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>Scopri come sia facile da noi ritrovare gli stessi comfort del tuo ufficio.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz136."','".IDSITO."','en','Dear [cliente], welcome at our accommodation.<br>Discover how easy we find the same comfort of your office.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz136."','".IDSITO."','fr','Cher [cliente], bienvenue à notre hébergement. <br> Découvrez comment facile nous trouvons le même confort de votre bureau.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz136."','".IDSITO."','de','Lieber [cliente], willkommen in unserer Unterkunft. <br> Entdecken Sie, wie einfach wir den gleichen Komfort von Ihrem Büro finden.','1')");
        //
        $diz137 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RESELLING_BENESSERE')");
        $id_diz137 = $dbMysqli->getInsertId($diz137);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz137."','".IDSITO."','it','Benvenuti')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz137."','".IDSITO."','en','Welcome')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz137."','".IDSITO."','fr','Bienvenue')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz137."','".IDSITO."','de','Willkommen')");
        //
        $diz138 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RESELLING_BENESSERE')");
        $id_diz138 = $dbMysqli->getInsertId($diz138);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz138."','".IDSITO."','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>Una esperienza di soggiorno pensata esclusivamente per la cura e il benessere del tuo corpo.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz138."','".IDSITO."','en','Dear [cliente], welcome at our accommodation.<br>A living experience designed exclusively for the care and well-being of your body.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz138."','".IDSITO."','fr','Cher [cliente], bienvenue à notre hébergement. <br>Avec une expérience de séjour conçu exclusivement pour les soins et le bien-être de votre corps.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz138."','".IDSITO."','de','Lieber [cliente], willkommen zu unserer Unterkunft. <br>Bei einem Aufenthalt Erfahrung ausschließlich für die Pflege und das Wohlbefinden des Körpers.','1')");
        //
        $diz139 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_RESELLING_SPORT')");
        $id_diz139 = $dbMysqli->getInsertId($diz139);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz139."','".IDSITO."','it','Benvenuti')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz139."','".IDSITO."','en','Welcome')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz139."','".IDSITO."','fr','Bienvenue')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz139."','".IDSITO."','de','Willkommen')");
        //
        $diz140 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RESELLING_SPORT')");
        $id_diz140 = $dbMysqli->getInsertId($diz140);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz140."','".IDSITO."','it','Gentile [cliente], benvenuto presso la nostra struttura ricettiva.<br>L\'hotel è organizzato appositamente per i ciclisti e tutti gli sportivi in genere.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz140."','".IDSITO."','en','Dear [cliente], welcome at our accommodation.<br>The hotel is specially organized for bikers and all sports in general.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz140."','".IDSITO."','fr','Cher [cliente], bienvenue à notre hébergement.<br> L\'hôtel est spécialement organisé pour les cyclistes et tous les sports en général.','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz140."','".IDSITO."','de','Lieber  [cliente], willkommen zu unserer Unterkunft.<br> Das Hotel ist speziell für Motorradfahrer organisiert und alle Sportarten im Allgemeinen.','1')");
        //
        $diz141 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_CHECKIN')");
        $id_diz141 = $dbMysqli->getInsertId($diz141);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz141."','".IDSITO."','it','Gentile [cliente], compila il tuo Check-in Online')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz141."','".IDSITO."','en','Dear [cliente], fill out your Online Check-In')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz141."','".IDSITO."','fr','Cher [cliente], remplissez votre enregistrement en ligne')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz141."','".IDSITO."','de','Lieber [cliente], füllen Sie Ihre Online-Check-In')");
        //
        $diz142 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_CHECKIN')");
        $id_diz142 = $dbMysqli->getInsertId($diz142);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz142."','".IDSITO."','it','Gentile [cliente], ansiosi di riceverla presso la nostra struttura ricettiva, la invitiamo a cliccare sul link che trova in basso nella mail, in pochi minuti potrà compilare il modulo di Check-in Online, velocizzando così le procedure d\'ingresso in hotel al momento del suo arrivo!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz142."','".IDSITO."','en','Dear [cliente], anxious to receive it at our accommodation, please click on the link at the bottom in the mail in a few minutes will be able to complete the Online Check-In form, thus speeding up of procedures at the hotel entrance to upon his arrival!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz142."','".IDSITO."','fr','Cher [cliente], désireux de le recevoir à notre hébergement, s\'il vous plaît cliquer sur le lien en bas dans le courrier en quelques minutes sera en mesure de remplir le formulaire enregistrement en ligne, accélérant ainsi des procédures à l\'entrée de l\'hôtel pour à son arrivée!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz142."','".IDSITO."','de','Lieber [cliente], besorgt es bei unserer Unterkunft zu erhalten, klicken Sie bitte auf dem Link unten in der E-Mail in wenigen Minuten in der Lage, das Online-Check-In Formular ausfüllen, damit von Verfahren am Hoteleingang beschleunigt zu bei seiner Ankunft!','1')");
        //
        $diz143 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TXTLINK7')");
        $id_diz143 = $dbMysqli->getInsertId($diz143);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz143."','".IDSITO."','it','Clicca qui per raggiungere il modulo del Check-in Online!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz143."','".IDSITO."','en','Click here to reach the form of Online Check-In!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz143."','".IDSITO."','fr','Cliquez ici pour accéder au formulaire de ligne d\'arrivée!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz143."','".IDSITO."','de','Klicken Sie hier, um die Form des Online-Check-In zu erreichen!')");
        //
        $diz144 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGINARISERVATA_CHECKIN')");
        $id_diz144 = $dbMysqli->getInsertId($diz144);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz144."','".IDSITO."','it','Pagina riservata al tuo Check-in Online')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz144."','".IDSITO."','en','Page reserved to your Online Check-In')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz144."','".IDSITO."','fr','Page réservée à votre enregistrement en ligne')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz144."','".IDSITO."','de','Seite reserviert Ihre Online-Check-In')");

        $diz145 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_DISDETTA')");
        $id_diz145 = $dbMysqli->getInsertId($diz145);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz145."','".IDSITO."','it','Gentile [cliente], la sua prenotazione è stata disdetta')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz145."','".IDSITO."','en','Dear [cliente], your reservation has been canceled')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz145."','".IDSITO."','fr','Cher [cliente], votre réservation a été annulée')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz145."','".IDSITO."','de','Lieber [cliente], um Ihre Reservierung wird storniert')");
        //
        $diz146 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_DISDETTA')");
        $id_diz146 = $dbMysqli->getInsertId($diz146);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz146."','".IDSITO."','it','Gentile [cliente], abbiamo disdetto&nbsp;la sua prenotazione Nr. [NumeroPrenotazione], come da sua richiesta!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz146."','".IDSITO."','en','Dear [cliente], we canceled your reservation Nr. [NumeroPrenotazione], at his request!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz146."','".IDSITO."','fr','Cher [cliente], nous avons annul&eacute; votre r&eacute;servation Nr. [NumeroPrenotazione], &agrave; sa demande!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz146."','".IDSITO."','de','Lieber [cliente], storniert wir Ihre Reservierung Nr. [NumeroPrenotazione], auf seinen Wunsch!','1')");

        $diz147 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_DISPONIBILITA')");
        $id_diz147 = $dbMysqli->getInsertId($diz147);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz147."','".IDSITO."','it','Gentile [cliente], per la sua richiesta di soggiorno non abbiamo disponibilità')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz147."','".IDSITO."','en','Dear [cliente], we do not have availability for your stay request')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz147."','".IDSITO."','fr','Cher [cliente], nous n\'avons pas la disponibilité pour votre demande de séjour')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz147."','".IDSITO."','de','Lieber [cliente], wir haben keine Verfügbarkeit für Ihren Aufenthalt')");
        //
        $diz148 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_DISPONIBILITA')");
        $id_diz148 = $dbMysqli->getInsertId($diz148);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz148."','".IDSITO."','it','Gentile [cliente], per le date scelte purtroppo non abbiamo disponibilità presso la nostra struttura ricettiva. Se volesse riformulare una richiesta di preventivo dal nostro sito:[sito], diversificando le date di soggiorno, saremmo lieti di offrirle la nostra miglior proposta!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz148."','".IDSITO."','en','Dear [cliente], for the dates chosen unfortunately we do not have availability at our accommodation. If you would like to reformulate a quote from our website: [sito], diversifying your stay dates, we would be happy to offer you our best proposal!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz148."','".IDSITO."','fr','Cher [cliente], pour les dates choisies malheureusement nous n\'avons pas la disponibilité dans notre hébergement. Si vous souhaitez reformuler une citation de notre site: [sito], en diversifiant vos dates de séjour, nous serions heureux de vous proposer notre meilleure proposition!','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz148."','".IDSITO."','de','Lieber [cliente], für die gewählten Daten haben wir leider keine Verfügbarkeit in unserer Unterkunft. Wenn Sie ein Angebot von unserer Website umformulieren möchten: [sito], um Ihre Aufenthaltsdaten zu diversifizieren, würden wir uns freuen, Ihnen unseren besten Vorschlag zu unterbreiten!','1')");

        $diz149 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CAPARRA')");
        $id_diz149 = $dbMysqli->getInsertId($diz149);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz149."','".IDSITO."','it','Caparra richiesta')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz149."','".IDSITO."','en','Deposit required')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz149."','".IDSITO."','fr','Dépôt requis')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz149."','".IDSITO."','de','Kaution erforderlich')");

        $diz150 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCELTAPROPOSTA')");
        $id_diz150 = $dbMysqli->getInsertId($diz150);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz150."','".IDSITO."','it','Scelta della proposta di soggiorno, inviata con successo!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz150."','".IDSITO."','en','Choice of stay proposal, sent successfully!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz150."','".IDSITO."','fr','Choix de la proposition de séjour, envoyé avec succès!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz150."','".IDSITO."','de','Wahl des Aufenthaltsvorschlags, erfolgreich gesendet!')");

        $diz151 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCELTAPROPOSTA2')");
        $id_diz151 = $dbMysqli->getInsertId($diz151);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz151."','".IDSITO."','it','Ora puoi chiudere la pagina ed attendere la prossima e-mail dall\'Hotel!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz151."','".IDSITO."','en','Now you can close the page and wait for the next e-mail from the Hotel!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz151."','".IDSITO."','fr','Vous pouvez maintenant fermer la page et attendre le prochain e-mail de l\'hôtel!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz151."','".IDSITO."','de','Jetzt können Sie die Seite schließen und auf die nächste E-Mail vom Hotel warten!')");

        $diz152 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCELTAPROPOSTAFATTA')");
        $id_diz152 = $dbMysqli->getInsertId($diz152);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz152."','".IDSITO."','it','La proposta di soggiorno è già stata precedentemente scelta, non è possibile re-inviarla!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz152."','".IDSITO."','en','The stay proposal has already been previously chosen, it is not possible to re-send it!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz152."','".IDSITO."','fr','La proposition de séjour a déjà été choisie, il n\'est pas possible de la renvoyer!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz152."','".IDSITO."','de','Der Aufenthaltsvorschlag wurde bereits vorher gewählt, es ist nicht möglich ihn erneut zu senden!')");

        $diz153 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SCONTO')");
        $id_diz153 = $dbMysqli->getInsertId($diz153);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz153."','".IDSITO."','it','Sconto')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz153."','".IDSITO."','en','Discount')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz153."','".IDSITO."','fr','Réduction')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz153."','".IDSITO."','de','Rabatt')");

        $diz154 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONDIZIONI_TARIFFA')");
        $id_diz154 = $dbMysqli->getInsertId($diz154);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz154."','".IDSITO."','it','Condizioni tariffa')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz154."','".IDSITO."','en','Tariff conditions')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz154."','".IDSITO."','fr','Conditions tarifaires')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz154."','".IDSITO."','de','Tarifbedingungen')");


        $diz155 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ACCETTO_POLITICHE')");
        $id_diz155 = $dbMysqli->getInsertId($diz155);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz155."','".IDSITO."','it','Accetto le politiche di cancellazione')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz155."','".IDSITO."','en','I accept the cancellation policy')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz155."','".IDSITO."','fr','J\'accepte les conditions d\'annulation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz155."','".IDSITO."','de','Ich akzeptiere die Stornobedingungen')");

        $diz156 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','LEGGI_POLITICHE')");
        $id_diz156 = $dbMysqli->getInsertId($diz156);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz156."','".IDSITO."','it','Leggi le politiche')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz156."','".IDSITO."','en','Read the policies')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz156."','".IDSITO."','fr','Lire les politiques')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz156."','".IDSITO."','de','Lesen Politik')");

        $diz157 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONDIZIONI')");
        $id_diz157 = $dbMysqli->getInsertId($diz157);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz157."','".IDSITO."','it','Condizioni')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz157."','".IDSITO."','en','Conditions')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz157."','".IDSITO."','fr','Conditions')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz157."','".IDSITO."','de','Geschäftsbedingungen')");


        $diz158 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','VISUALIZZA')");
        $id_diz158 = $dbMysqli->getInsertId($diz158);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz158."','".IDSITO."','it','Visualizza')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz158."','".IDSITO."','en','View')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz158."','".IDSITO."','fr','Vue')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz158."','".IDSITO."','de','Ansicht')");

        $diz159 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','NASCONDI')");
        $id_diz159 = $dbMysqli->getInsertId($diz159);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz159."','".IDSITO."','it','Nascondi')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz159."','".IDSITO."','en','Hide')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz159."','".IDSITO."','fr','Cacher')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz159."','".IDSITO."','de','Verstecken')");

        $diz160 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONVERSAZIONE')");
        $id_diz160 = $dbMysqli->getInsertId($diz160);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz160."','".IDSITO."','it','la conversazione')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz160."','".IDSITO."','en','the conversation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz160."','".IDSITO."','fr','la conversation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz160."','".IDSITO."','de','die Konversation')");

        $diz161 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM')");
        $id_diz161 = $dbMysqli->getInsertId($diz161);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz161."','".IDSITO."','it','il Form di Prenotazione')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz161."','".IDSITO."','en','the Booking Form')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz161."','".IDSITO."','fr','le formulaire de réservation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz161."','".IDSITO."','de','das Buchungsformular')");

        $diz162 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PRENOTA_OFFERTA')");
        $id_diz162 = $dbMysqli->getInsertId($diz162);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz162."','".IDSITO."','it','PRENOTA ORA LA TUA OFFERTA PERSONALIZZATA')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz162."','".IDSITO."','en','BOOK YOUR CUSTOM OFFER NOW')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz162."','".IDSITO."','fr','RÉSERVEZ VOTRE OFFRE SPÉCIALE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz162."','".IDSITO."','de','BUCHEN SIE IHR ANGEBOT JETZT')");

        $diz163 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MAPPA')");
        $id_diz163 = $dbMysqli->getInsertId($diz163);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz163."','".IDSITO."','it','Mappa')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz163."','".IDSITO."','en','Map')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz163."','".IDSITO."','fr','Carte')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz163."','".IDSITO."','de','Karte')");

        $diz164 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','ARRIVO')");
        $id_diz164 = $dbMysqli->getInsertId($diz164);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz164."','".IDSITO."','it','ARRIVO')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz164."','".IDSITO."','en','ARRIVAL')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz164."','".IDSITO."','fr','ARRIVÉE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz164."','".IDSITO."','de','ANREISE')");

        $diz165 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PARTENZA')");
        $id_diz165 = $dbMysqli->getInsertId($diz165);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz165."','".IDSITO."','it','PARTENZA')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz165."','".IDSITO."','en','DEPARTURE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz165."','".IDSITO."','fr','DEPARTURE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz165."','".IDSITO."','de','ABFAHRT')");

        $diz166 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PERSONE')");
        $id_diz166 = $dbMysqli->getInsertId($diz166);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz166."','".IDSITO."','it','PERSONE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz166."','".IDSITO."','en','PEOPLE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz166."','".IDSITO."','fr','GENS')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz166."','".IDSITO."','de','MENSCHEN')");

        $diz167 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CAMERE')");
        $id_diz167 = $dbMysqli->getInsertId($diz167);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz167."','".IDSITO."','it','CAMERE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz167."','".IDSITO."','en','ROOMS')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz167."','".IDSITO."','fr','CHAMBRES')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz167."','".IDSITO."','de','ZIMMER')");

        $diz168 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TRATTAMENTO')");
        $id_diz168 = $dbMysqli->getInsertId($diz168);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz168."','".IDSITO."','it','TRATTAMENTO')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz168."','".IDSITO."','en','TREATMENT')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz168."','".IDSITO."','fr','TRAITEMENT')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz168."','".IDSITO."','de','BEHANDLUNG')");

        $diz169 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREZZO_TOTALE')");
        $id_diz169 = $dbMysqli->getInsertId($diz169);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz169."','".IDSITO."','it','PREZZO TOTALE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz169."','".IDSITO."','en','TOTAL PRICE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz169."','".IDSITO."','fr','PRIX TOTAL')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz169."','".IDSITO."','de','GESAMTPREIS')");

        $diz170 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','QUANTITA')");
        $id_diz170 = $dbMysqli->getInsertId($diz170);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz170."','".IDSITO."','it','QUANTITA\'')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz170."','".IDSITO."','en','QUANTITY')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz170."','".IDSITO."','fr','QUANTITÉ')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz170."','".IDSITO."','de','MENGE')");

        $diz171 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREZZO_UNITARIO')");
        $id_diz171 = $dbMysqli->getInsertId($diz171);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz171."','".IDSITO."','it','PREZZO UNITARIO')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz171."','".IDSITO."','en','UNIT PRICE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz171."','".IDSITO."','fr','PRIX UNITAIRE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz171."','".IDSITO."','de','Einheitspreis')");

        $diz172 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','SUBTOTALE')");
        $id_diz172 = $dbMysqli->getInsertId($diz172);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz172."','".IDSITO."','it','SUBTOTALE')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz172."','".IDSITO."','en','SUBTOTAL')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz172."','".IDSITO."','fr','SUBTOTAL')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz172."','".IDSITO."','de','SUBTOTAL')");

        $diz173 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PRENOTA_SUBITO')");
        $id_diz173 = $dbMysqli->getInsertId($diz173);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz173."','".IDSITO."','it','PRENOTA SUBITO QUESTA OFFERTA')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz173."','".IDSITO."','en','BOOK THIS OFFER IMMEDIATELY')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz173."','".IDSITO."','fr','RÉSERVEZ CETTE OFFRE IMMÉDIATEMENT')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz173."','".IDSITO."','de','BUCHEN SIE DIESES ANGEBOT SOFORT')");

        $diz174 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CAPARRA_RICHIESTA')");
        $id_diz174 = $dbMysqli->getInsertId($diz174);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz174."','".IDSITO."','it','Caparra richiesta:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz174."','".IDSITO."','en','Deposit required:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz174."','".IDSITO."','fr','Dépôt requis:')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz174."','".IDSITO."','de','Anzahlung erforderlich:')");

        $diz175 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONSENSOMARKETING')");
        $id_diz175 = $dbMysqli->getInsertId($diz175);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz175."','".IDSITO."','it','Do il consenso per ricevere materiale marketing')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz175."','".IDSITO."','en','I consent to receive marketing material')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz175."','".IDSITO."','fr','Je consens à recevoir du matériel de marketing')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz175."','".IDSITO."','de','Ich bin damit einverstanden, Marketingmaterial zu erhalten')");

        $diz178 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONSENSOPROFILAZIONE')");
        $id_diz178 = $dbMysqli->getInsertId($diz178);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz178."','".IDSITO."','it','Voglio ricevere solo le offerte in linea con le preferenze che ho indicato')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz178."','".IDSITO."','en','I only want to receive offers in line with the preferences I have indicated')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz178."','".IDSITO."','fr','Je veux seulement recevoir des offres conformes aux préférences que j\'ai indiquées')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz178."','".IDSITO."','de','Ich möchte nur Angebote erhalten, die den von mir angegebenen Präferenzen entsprechen')");

        $diz179 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PROPOSTAPAGAMENTOSCELTO')");
        $id_diz179 = $dbMysqli->getInsertId($diz179);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz179."','".IDSITO."','it','La Proposta è già stata confermata con un altro tipo di pagamento!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz179."','".IDSITO."','en','The proposal has already been confirmed with another type of payment!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz179."','".IDSITO."','fr','La proposition a déjà été confirmée avec un autre type de paiement!')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz179."','".IDSITO."','de','Der Vorschlag wurde bereits mit einer anderen Zahlungsart bestätigt!')");

        $diz180 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGAMENTOSCELTO')");
        $id_diz180 = $dbMysqli->getInsertId($diz180);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz180."','".IDSITO."','it','Proposta confermata tramite pagamento con')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz180."','".IDSITO."','en','Proposal confirmed by payment with')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz180."','".IDSITO."','fr','Proposition confirmée par paiement avec')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz180."','".IDSITO."','de','Vorschlag durch Zahlung bestätigt mit')");
    
    $oggetto_it = 'Gentile ospite saremmo lieti se volesse lasciare una recensione in merito al suo soggiorno presso la nostra struttura: [struttura]';
    $testo_email_it ='Gentile <b>[cliente]</b>,<br>
                                    abbiamo notato dalla compilazione del questionario per la <b>Soddisfazione del Cliente</b> in Hotel, che si è trovato bene presso la nostra struttura ricettiva!
                                    <br>
                                    Le saremmo immensamenti grati se volesse scrivere una breve recensione sul portale <b>TripAdvisor</b>
                                    <br><br>
                                    Ringraziandola ancora di aver soggiornato nella nostra struttura e fiduciosi di poterla riavere come nostro Ospite, le inviamo il link per la recensione:
                                    <br>
                                    <a href="[link_tripadvisor]">[link_tripadvisor]</a>
                                    <br><br>
                                    Cordiali saluti.
                                    <br>
                                    <b>[operatore] - [struttura]</b><br>
                                    <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>Questa e-mail è stata inviata automaticamente dal software, non rispondere a questa e-mail!</em></p>';

    $oggetto_en = 'Dear guest, we would be pleased if you would like to leave a review about your stay at our facility: [struttura]';
    $testo_email_en ='Dear <b>[cliente]</b>, <br>
                                    we noticed from the completion of the <b> Customer Satisfaction </b> questionnaire in the Hotel, which found itself well at our accommodation!
                                    <br>
                                    We would be grateful if you would like to write a short review on the <b> TripAdvisor </b> portal
                                    <br>
                                    Thanking you again for having stayed in our structure and trusting to be able to have it back as our Guest, we send you the link for the review:
                                    <br>
                                    <a href="[link_tripadvisor]">[link_tripadvisor]</a>
                                    <br>
                                    Best regards.
                                <br>
                                <b>[operatore] - [struttura]</b><br>
                                <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>This e-mail was sent automatically by the software, do not reply to this e-mail!</em></p>';

    $oggetto_fr = 'Cher client, nous serions heureux si vous souhaitez laisser un commentaire sur votre séjour dans notre établissement: [struttura]';
    $testo_email_fr ='Cher <b>[cliente]</b>, <br>
                                    nous avons remarqué à la fin du questionnaire <b> satisfaction de la clientèle </b> dans l\'hôtel, qui s\'est bien trouvé dans notre logement!
                                    <br>
                                    Nous vous serions reconnaissants de bien vouloir rédiger une brève critique sur le portail <b> TripAdvisor </b>
                                    <br>
                                    En vous remerciant encore d\'être resté dans notre structure et en ayant confiance pour pouvoir le récupérer en tant qu\'invité, nous vous envoyons le lien pour la revue:
                                <br>
                                <a href="[link_tripadvisor]">[link_tripadvisor]</a>
                                <br><br>
                                Cordialement.
                                <br>
                                <b>[operatore] - [struttura]</b><br>
                                <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>Cet e-mail a été envoyé automatiquement par le logiciel, ne répondez pas à cet e-mail!</em></p>';

    $oggetto_de = 'Sehr geehrter Gast, wir würden uns freuen, wenn Sie eine Bewertung über Ihren Aufenthalt in unserer Einrichtung hinterlassen möchten: [struttura]';
    $testo_email_de ='Lieber <b>[cliente]</b>, <br>
                                Wir haben von der Fertigstellung des Fragebogens <b> Kundenzufriedenheit </b> im Hotel erfahren, der sich in unserer Unterkunft wiederfand!
                                <br>
                                Wir wären Ihnen dankbar, wenn Sie eine kurze Kritik auf dem <b> TripAdvisor </b> -Portal schreiben möchten
                                <br>
                                Wir danken Ihnen nochmals, dass Sie in unserer Struktur geblieben sind und darauf vertrauen, dass wir sie als Gast wieder haben können. Wir senden Ihnen den Link für die Bewertung:
                                <br>
                                <a href="[link_tripadvisor]">[link_tripadvisor]</a>
                                <br><br>
                                Mit freundlichen Grüßen.
                                <br>
                                <b>[operatore] - [struttura]</b><br>
                                <p style="margin: 0;font-size: 11px;line-height: 14px;"><em>Diese E-Mail wurde von der Software automatisch verschickt, antworten Sie nicht auf diese E-Mail!</em></p>';

        $diz181 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','OGGETTO_TRIPADVISOR')");
        $id_diz181 = $dbMysqli->getInsertId($diz181);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz181."','".IDSITO."','it','".addslashes($oggetto_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz181."','".IDSITO."','en','".addslashes($oggetto_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz181."','".IDSITO."','fr','".addslashes($oggetto_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz181."','".IDSITO."','de','".addslashes($oggetto_de)."')");

        $diz182 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTO_EMAIL_TRIPADVISOR')");
        $id_diz182 = $dbMysqli->getInsertId($diz182);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz182."','".IDSITO."','it','".addslashes($testo_email_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz182."','".IDSITO."','en','".addslashes($testo_email_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz182."','".IDSITO."','fr','".addslashes($testo_email_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz182."','".IDSITO."','de','".addslashes($testo_email_de)."','1')");


        $diz183 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREVENTIVO_CUSTOM1')");
        $id_diz183 = $dbMysqli->getInsertId($diz183);

        $preventivo_family_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
                                  Per capire quanto la nostra struttura sia un Family Hotels basti pensare che i nostri ospiti più importanti sono i bambini.';
     
        $preventivo_family_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
                                  To understand how much our structure is a Family Hotels just think that our most important guests are children.';                                  

        $preventivo_family_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
                                  Pour comprendre à quel point notre structure est un Family Hotels, il suffit de penser que nos clients les plus importants sont des enfants.';

        $preventivo_family_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
                                  Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind.';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".IDSITO."','it','".addslashes($preventivo_family_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".IDSITO."','en','".addslashes($preventivo_family_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".IDSITO."','fr','".addslashes($preventivo_family_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz183."','".IDSITO."','de','".addslashes($preventivo_family_de)."','1')");

        $diz184 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONFERMA_CUSTOM1')");
        $id_diz184 = $dbMysqli->getInsertId($diz184);

        $conferma_family_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
                                  Per capire quanto la nostra struttura sia un Family Hotels basti pensare che i nostri ospiti più importanti sono i bambini.';
     
        $conferma_family_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
                                  To understand how much our structure is a Family Hotels just think that our most important guests are children.';                                  

        $conferma_family_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
                                  Pour comprendre à quel point notre structure est un Family Hotels, il suffit de penser que nos clients les plus importants sont des enfants.';

        $conferma_family_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
                                  Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind.';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".IDSITO."','it','".addslashes($conferma_family_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".IDSITO."','en','".addslashes($conferma_family_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".IDSITO."','fr','".addslashes($conferma_family_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz184."','".IDSITO."','de','".addslashes($conferma_family_de)."','1')");

        $diz185 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREVENTIVO_CUSTOM2')");
        $id_diz185 = $dbMysqli->getInsertId($diz185);

        $preventivo_bike_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
                                  Per capire quanto la nostra struttura sia un Family Hotels basti pensare che i nostri ospiti più importanti sono i bambini.';
     
        $preventivo_bike_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
                                  To understand how much our structure is a Family Hotels just think that our most important guests are children.';                                  

        $preventivo_bike_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
                                  Pour comprendre à quel point notre structure est un Family Hotels, il suffit de penser que nos clients les plus importants sont des enfants.';

        $preventivo_bike_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
                                  Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind.';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".IDSITO."','it','".addslashes($preventivo_bike_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".IDSITO."','en','".addslashes($preventivo_bike_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".IDSITO."','fr','".addslashes($preventivo_bike_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz185."','".IDSITO."','de','".addslashes($preventivo_bike_de)."','1')");

        $diz186 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONFERMA_CUSTOM2')");
        $id_diz186 = $dbMysqli->getInsertId($diz186);

        $conferma_bike_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
                                La nostra struttura ricettiva è organizzata appositamente per i ciclisti e tutti gli sportivi in genere.';
     
        $conferma_bike_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
                                  To understand how much our structure is a Family Hotels just think that our most important guests are children.';                                  

        $conferma_bike_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
                                  Pour comprendre à quel point notre structure est un Family Hotels, il suffit de penser que nos clients les plus importants sont des enfants.';

        $conferma_bike_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
                                  Um zu verstehen, wie sehr unsere Struktur ein Familienhotel ist, denken Sie einfach, dass unsere wichtigsten Gäste Kinder sind.';                                

        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".IDSITO."','it','".addslashes($conferma_bike_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".IDSITO."','en','".addslashes($conferma_bike_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".IDSITO."','fr','".addslashes($conferma_bike_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz186."','".IDSITO."','de','".addslashes($conferma_bike_de)."','1')");


        $diz188 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PREVENTIVO_CUSTOM3')");
        $id_diz188 = $dbMysqli->getInsertId($diz188);

        $preventivo_romantico_it = 'Gentile [cliente], facendo seguito alla Sua cortese richiesta, abbiamo provveduto ad elaborare la nostra offerta soggiorno per il periodo da Lei indicato. Augurandoci che le nostre proposte di soggiorno siano di Suo gradimento, la ringraziamo rimanendo a Sua completa disposizione. 
        Una esperienza di soggiorno pensata esclusivamente per le coppie.';

        $preventivo_romantico_en = 'Dear [cliente], in response to your kind request, we proceeded to elaborate our holiday offer for the requested period. We hope that our tax proposals are happy with your choice, thank you staying at your disposal. 
                A stay experience designed exclusively for couples';                                  

        $preventivo_romantico_fr = 'Cher [cliente], en réponse à votre demande type, nous avons procédé à élaborer notre offre de vacances pour la période demandée. Nous espérons que nos propositions fiscales sont heureux avec votre choix, merci de rester à votre disposition.
                Une expérience de séjour conçue exclusivement pour les couples';

        $preventivo_romantico_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Art Anfrage, gingen wir unser Urlaubsangebot für den entsprechenden Zeitraum zu erarbeiten. Wir hoffen, dass unsere Steuervorschläge glücklich sind mit Ihrer Wahl, wir danken Ihnen zu Ihrer Verfügung bleiben. 
                Ein Aufenthaltserlebnis, das ausschließlich für Paare gedacht ist';                                


        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".IDSITO."','it','".addslashes($preventivo_romantico_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".IDSITO."','en','".addslashes($preventivo_romantico_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".IDSITO."','fr','".addslashes($preventivo_romantico_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz188."','".IDSITO."','de','".addslashes($preventivo_romantico_de)."','1')");

        $diz189 = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','CONFERMA_CUSTOM3')");
        $id_diz189 = $dbMysqli->getInsertId($diz189);

        $conferma_romantico_it = 'Gentile [cliente], facendo seguito alla Sua cortese risposta di accettazione, le diamo conferma del soggiorno da Lei indicato, ma non ancora accettato come prenotazione definitiva perchè in attesa del pagamento dell\'acconto o del numero di carta di credito a garanzia 
        Una esperienza di soggiorno pensata esclusivamente per le coppie';

        $conferma_romantico_en = 'Dear [cliente], in response to your kind reply of acceptance, we give full confirmation of your stay you indicated. 
                A stay experience designed exclusively for couples';                                  

        $conferma_romantico_fr = 'Cher [cliente], en réponse à votre aimable réponse d\'acceptation, nous vous donnons la confirmation de votre séjour vous avez indiqué, mais pas encore accepté comme une réservation définitive en suspens en raison de l\'acompte ou le numéro de carte de crédit pour la garantie.
                Une expérience de séjour conçue exclusivement pour les couples';

        $conferma_romantico_de = 'Sehr geehrter [cliente], als Antwort auf Ihre Antwort der Annahme, geben wir Ihnen eine Bestätigung Ihres Aufenthalts Sie angegeben, aber noch nicht als endgültige Reservierung wird akzeptiert wegen der Vorauszahlung oder Kreditkartennummer Garantie 
              Ein Aufenthaltserlebnis, das ausschließlich für Paare gedacht ist';                                


        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz189."','".IDSITO."','it','".addslashes($conferma_romantico_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz189."','".IDSITO."','en','".addslashes($conferma_romantico_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz189."','".IDSITO."','fr','".addslashes($conferma_romantico_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz189."','".IDSITO."','de','".addslashes($conferma_romantico_de)."','1')");



        $testo_it = 'Gentile <b>[cliente]</b>,  
                <br><br>
                per la vostra conferma <b>Nr. [NumeroPrenotazione]</b> con proposta soggiorno dal <b>[Arrivo]</b> al <b>[Partenza]</b>, purtroppo non abbiamo disponibilità presso la nostra struttura ricettiva. 
                <br><br>                                      
                Se volesse riformulare una richiesta di preventivo dal nostro sito: [sitoweb], diversificando le date di soggiorno, saremmo lieti di offrirle la nostra miglior proposta! 
                <br><br>
                Cordiali saluti		
                <br><br>
                [struttura]';

        $testo2_it = 'Gentile <b>[cliente]</b>,  
                <br><br>
                ci spiace appurare la vostra rinuncia sulla conferma <b>Nr. [NumeroPrenotazione]</b> per la proposta soggiorno dal <b>[Arrivo]</b> al <b>[Partenza]</b>. 
                <br><br>                                      
                Se volesse riformulare una richiesta di preventivo dal nostro sito: [sitoweb], saremmo lieti di offrirle la nostra miglior proposta! 
                <br><br>
                Cordiali saluti		
                <br><br>
                [struttura]';

        $testo3_it = 'Gentile <b>[cliente]</b>,  
                <br><br>
                per la vostra conferma <b>Nr. [NumeroPrenotazione]</b> con proposta soggiorno dal <b>[Arrivo]</b> al <b>[Partenza]</b>, ......... 
                <br><br>                                      
                Cordiali saluti		
                <br><br>
                [struttura]';

        $testo_en = 'Dear <b>[cliente]</b>,
                <br><br>
                for your confirmation <b> Nr. [NumeroPrenotazione] </b> with proposed stay from <b> [Arrivo] </b> to <b> [Partenza] </b>, unfortunately we do not have availability at our facility receptive.
                <br><br>
                If you would like to reformulate a request for a quote from our website: [sitoweb], diversifying the dates of your stay, we would be happy to offer you our best proposal!
                <br><br>
                Sincerely
                <br><br>
                [struttura]';

        $testo2_en = 'Dear <b>[cliente]</b>,
                <br><br>
                we are sorry to ascertain your waiver on the confirmation <b> Nr. [NumeroPrenotazione] </b> for the proposed stay from <b> [Arrivo] </b> to <b> [Partenza] </b>.
                <br><br>
                If you would like to reformulate a request for a quote from our website: [sitoweb], we would be happy to offer you our best proposal!
                <br><br>
                Sincerely
                <br><br>
                [struttura]';

        $testo3_en = 'Dear <b>[cliente]</b>,
                <br><br>
                for your confirmation <b> Nr. [NumeroPrenotazione] </b> with proposed stay from <b> [Arrivo] </b> to <b> [Partenza] </b>, ........
                <br><br>
                Sincerely
                <br><br>
                [struttura]';

        $testo_fr = 'Cher <b>[cliente]</b>,
                <br><br>
                pour votre confirmation <b> Nr. [NumeroPrenotazione] </b> avec séjour proposé de <b> [Arrivo] </b> à <b> [Partenza] </b>, malheureusement nous n\'avons pas de disponibilité à notre établissement réceptif. 
                <br><br>
                Si vous souhaitez reformuler une demande de devis depuis notre site internet: [sitoweb], en diversifiant les dates de votre séjour, nous serions heureux de vous proposer notre meilleure proposition!
                <br><br>
                Cordialement
                <br><br>
                [struttura]';

        $testo2_fr = 'Cher <b>[cliente]</b>,
                <br><br>
                nous sommes désolés de vérifier votre renonciation sur la confirmation <b> Nr. [NumeroPrenotazione] </b> pour le séjour proposé de <b> [Arrivo] </b> à <b> [Partenza] </b>.
                <br><br>
                Si vous souhaitez reformuler une demande de devis depuis notre site internet: [sitoweb], nous serions heureux de vous proposer notre meilleure proposition!
                <br><br>
                Cordialement
                <br><br>
                [struttura]';

        $testo3_fr = 'Cher <b>[cliente]</b>,
                <br><br>
                pour votre confirmation <b> Nr. [NumeroPrenotazione] </b> avec séjour proposé de <b> [Arrivo] </b> à <b> [Partenza] </b>, ......
                <br><br>
                Cordialement
                <br><br>
                [struttura]';

        $testo_de = 'Sehr geehrter <b>[cliente]</b>,
                <br><br>
                für Ihre Bestätigung <b> Nr. [NumeroPrenotazione] </b> mit vorgeschlagenem Aufenthalt von <b> [Arrivo] </b> bis <b> [Partenza] </b>, leider haben wir keine Verfügbarkeit bei uns Einrichtung empfänglich. 
                <br><br>
                Wenn Sie eine Angebotsanfrage von unserer Website neu formulieren möchten: [sitoweb], um die Daten Ihres Aufenthalts zu diversifizieren, bieten wir Ihnen gerne unseren besten Vorschlag an!
                <br><br>
                Mit freundlichen Grüßen
                <br><br>
                [struttura]';

        $testo2_de = 'Sehr geehrter <b>[cliente]</b>,
                <br><br>
                Es tut uns leid, dass Sie Ihren Verzicht auf der Bestätigung <b> Nr. [NumeroPrenotazione] </b> für den vorgeschlagenen Aufenthalt von <b> [Arrivo] </b> bis <b> [Partenza] </b>.
                <br><br>
                Wenn Sie eine Angebotsanfrage von unserer Website neu formulieren möchten: [sitoweb], bieten wir Ihnen gerne unseren besten Vorschlag an!
                <br><br>
                Mit freundlichen Grüßen
                <br><br>
                [struttura]';

        $testo3_de = 'Sehr geehrter <b>[cliente]</b>,
                <br><br>
                für Ihre Bestätigung <b> Nr. [NumeroPrenotazione] </b> mit vorgeschlagenem Aufenthalt von <b> [Arrivo] </b> bis <b> [Partenza] </b>, ..........
                <br><br>
                Mit freundlichen Grüßen
                <br><br>
                [struttura]';

        $diz1A = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_ANNULLA_CONFERMA_NODISPO')");
        $id_diz1A = $dbMysqli->getInsertId($diz1A);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1A."','".IDSITO."','it','".addslashes($testo_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1A."','".IDSITO."','en','".addslashes($testo_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1A."','".IDSITO."','fr','".addslashes($testo_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1A."','".IDSITO."','de','".addslashes($testo_de)."','1')");

        $diz2A = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_ANNULLA_CONFERMA_RINUNCIA')");
        $id_diz2A = $dbMysqli->getInsertId($diz2A);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz2A."','".IDSITO."','it','".addslashes($testo2_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz2A."','".IDSITO."','en','".addslashes($testo2_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz2A."','".IDSITO."','fr','".addslashes($testo2_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz2A."','".IDSITO."','de','".addslashes($testo2_de)."','1')");

        $di3A = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_ANNULLA_CONFERMA_ALTRO')");
        $id_diz3A = $dbMysqli->getInsertId($diz3A);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz3A."','".IDSITO."','it','".addslashes($testo3_it)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz3A."','".IDSITO."','en','".addslashes($testo3_en)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz3A."','".IDSITO."','fr','".addslashes($testo3_fr)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz3A."','".IDSITO."','de','".addslashes($testo3_de)."','1')");

        $testo_it_p = 'Gentile <b>[cliente]</b>,  
                  <br><br>
                  per le date scelte <b>[Arrivo]</b> al <b>[Partenza]</b>, purtroppo non abbiamo disponibilità presso la nostra struttura ricettiva.
                  <br><br>  
                  Se volesse riformulare una richiesta di preventivo dal nostro sito: [sitoweb], diversificando le date di soggiorno, saremmo lieti di offrirle la nostra miglior proposta!                                    
                  <br><br>
                  Cordiali saluti		
                  <br><br>
                  [struttura]';

        $testo2_it_p = 'Gentile <b>[cliente]</b>,  
                <br><br>
                per le date scelte <b>[Arrivo]</b> al <b>[Partenza]</b>, purtroppo la nostra struttura ricettiva è chiusa.
                <br><br>  
                Se volesse riformulare una richiesta di preventivo dal nostro sito: [sitoweb], diversificando le date di soggiorno, saremmo lieti di offrirle la nostra miglior proposta!                                    
                <br><br>
                Cordiali saluti		
                <br><br>
                [struttura]';

        $testo3_it_p = 'Gentile <b>[cliente]</b>,  
                <br><br>
                per le date scelte <b>[Arrivo]</b> al <b>[Partenza]</b>, purtroppo .....
                <br><br>  
                Se volesse riformulare una richiesta di preventivo dal nostro sito: [sitoweb], diversificando le date di soggiorno, saremmo lieti di offrirle la nostra miglior proposta!                                    
                <br><br>
                Cordiali saluti		
                <br><br>
                [struttura]';                              

        $testo_en_p = 'Dear <b> [cliente] </b>,
                <br> <br>
                for the chosen dates <b> [Arrivo] </b> to <b> [Partenza] </b>, unfortunately we do not have availability at our accommodation.
                <br> <br>
                If you would like to reformulate a request for a quote from our website: [sitoweb], Diversifying the dates of your stay, we would be happy to offer you our best proposal!
                <br> <br>
                Sincerely
                <br> <br>
                [struttura] ';

        $testo2_en_p = 'Dear <b> [cliente] </b>,
                <br> <br>
                for the chosen dates <b> [Arrivo] </b> to <b> [Partenza] </b>, unfortunately our accommodation is closed.
                <br> <br>
                If you would like to reformulate a request for a quote from our site: [sitoweb], Diversifying the dates of your stay, we would be happy to offer you our best proposal!
                <br> <br>
                Sincerely
                <br> <br>
                [struttura] ';

        $testo3_en_p = 'Dear <b> [custclienteomer] </b>,
                <br> <br>
                for your chosen dates <b> [Arrivo] </b> to <b> [Partenza] </b>, unfortunately .....
                <br> <br>
                If you would like to reformulate a request for a quote from our site: [sitoweb], Diversifying the dates of your stay, we would be happy to offer you our best proposal!
                <br> <br>
                Sincerely
                <br> <br>
                [struttura] ';   

        $testo_fr_p = 'Cher <b> [cliente] </b>,
                <br> <br>
                pour les dates choisies <b> [Arrivo] </b> à <b> [Partenza] </b>, malheureusement nous n\'avons pas de disponibilité dans notre logement.
                <br> <br>
                Si vous souhaitez reformuler une demande de devis depuis notre site internet: [sitoweb], En diversifiant les dates de votre séjour, nous serons heureux de vous proposer notre meilleure proposition!
                <br> <br>
                Cordialement
                <br> <br>
                [struttura] ';

        $testo2_fr_p = 'Cher <b> [cliente] </b>,
                <br> <br>
                pour les dates choisies <b> [Arrivo] </b> à <b> [Partenza] </b>, malheureusement notre logement est fermé.
                <br> <br>
                Si vous souhaitez reformuler une demande de devis depuis notre site internet: [sitoweb], En diversifiant les dates de votre séjour, nous serons heureux de vous proposer notre meilleure proposition!
                <br> <br>
                Cordialement
                <br> <br>
                [struttura] ';

        $testo3_fr_p = 'Cher <b> [cliente] </b>,
                <br> <br>
                pour les dates que vous avez choisies <b> [Arrivo] </b> à <b> [Partenza] </b>, malheureusement .....
                <br> <br>
                Si vous souhaitez reformuler une demande de devis depuis notre site internet: [sitoweb], En diversifiant les dates de votre séjour, nous serons heureux de vous proposer notre meilleure proposition!
                <br> <br>
                Cordialement
                <br> <br>
                [struttura] ';   


        $testo_de_p = 'Sehr geehrter <b> [cliente] </b>,
                <br> <br>
                Für die ausgewählten Daten <b> [Arrivo] </b> bis <b> [Partenza] </b> haben wir leider keine Verfügbarkeit in unserer Unterkunft.
                <br> <br>
                Wenn Sie eine Angebotsanfrage von unserer Website neu formulieren möchten: [sitoweb], Diversifizierung der Daten Ihres Aufenthaltes, bieten wir Ihnen gerne unseren besten Vorschlag an!
                <br> <br>
                Mit freundlichen Grüßen
                <br> <br>
                [struttura] ';

        $testo2_de_p = 'Sehr geehrter <b> [cliente] </b>,
                <br> <br>
                Für die ausgewählten Daten <b> [Arrivo] </b> bis <b> [Partenza] </b> ist unsere Unterkunft leider geschlossen.
                <br> <br>
                Wenn Sie eine Angebotsanfrage von unserer Website neu formulieren möchten: [sitoweb], Diversifizierung der Daten Ihres Aufenthaltes, bieten wir Ihnen gerne unseren besten Vorschlag an!
                <br> <br>
                Mit freundlichen Grüßen
                <br> <br>
                [struttura] ';

        $testo3_de_p = 'Sehr geehrter <b> [cliente] </b>,
                <br> <br>
                für die von Ihnen gewählten Daten <b> [Arrivo] </b> bis <b> [Partenza] </b>, leider .....
                <br> <br>
                Wenn Sie eine Angebotsanfrage von unserer Website neu formulieren möchten: [sitoweb], Diversifizierung der Daten Ihres Aufenthaltes, bieten wir Ihnen gerne unseren besten Vorschlag an!
                <br> <br>
                Mit freundlichen Grüßen
                <br> <br>
                [struttura] ';   

        $diz1P = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_ANNULLA_PREVENTIVO_NODISPO')");
        $id_diz1P = $dbMysqli->getInsertId($diz1P);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1P."','".IDSITO."','it','".addslashes($testo_it_p)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1P."','".IDSITO."','en','".addslashes($testo_en_p)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1P."','".IDSITO."','fr','".addslashes($testo_fr_p)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz1P."','".IDSITO."','de','".addslashes($testo_de_p)."','1')");

        $diz2P = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_ANNULLA_PREVENTIVO_STRUTTURA_CHIUSA')");
        $id_diz2P = $dbMysqli->getInsertId($diz2P);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz2P."','".IDSITO."','it','".addslashes($testo2_it_p)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz2P."','".IDSITO."','en','".addslashes($testo2_en_p)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz2P."','".IDSITO."','fr','".addslashes($testo2_fr_p)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz2P."','".IDSITO."','de','".addslashes($testo2_de_p)."','1')");

        $diz3P = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_ANNULLA_PREVENTIVO_ALTRO')");
        $id_diz3P = $dbMysqli->getInsertId($diz3P);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz3P."','".IDSITO."','it','".addslashes($testo3_it_p)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz3P."','".IDSITO."','en','".addslashes($testo3_en_p)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz3P."','".IDSITO."','fr','".addslashes($testo3_fr_p)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_diz3P."','".IDSITO."','de','".addslashes($testo3_de_p)."','1')");

        $testo_it_dispo = 'Gentile <b>[cliente]</b>,  
                <br><br>
                per le date che aveva scelto <b>[Arrivo]</b> al <b>[Partenza]</b>, è tornata la disponibilità presso la nostra struttura ricettiva.
                <br><br>  
                Se fosse ancora interressato al preventivo che le avevamo mandato, saremmo lieti di re-inviarle la nostra miglior proposta!                                    
                <br><br>
                Cordiali saluti		
                <br><br>
                [struttura]';                          

        $testo_en_dispo = 'Dear <b> [cliente] </b>,
                <br> <br>
                for the dates that he had chosen <b> [Arrivo] </b> to <b> [Partenza] </b>, the availability at our accommodation is back.
                <br> <br>
                If you are still interested in the quote we sent you, we would be happy to re-send you our best proposal!
                <br> <br>
                Sincerely
                <br> <br>
                [struttura] ';  

        $testo_fr_dispo = 'Cher <b> [cliente] </b>,
                <br> <br>
                pour les dates qu\'il avait choisies <b> [Arrivo] </b> à <b> [Partenza] </b>, la disponibilité de notre hébergement est de retour.
                <br> <br>
                Si vous êtes toujours intéressé par le devis que nous vous avons envoyé, nous nous ferons un plaisir de vous renvoyer notre meilleure proposition!
                Cordialement
                <br> <br>
                [struttura] ';  


        $testo_de_dispo = 'Sehr geehrter <b> [cliente] </b>,
                <br> <br>
                für die von ihm gewählten Daten <b> [Arrivo] </b> bis <b> [Partenza] </b> ist die Verfügbarkeit in unserer Unterkunft wieder da.
                <br> <br>
                Wenn Sie immer noch an dem Angebot interessiert sind, das wir Ihnen gesendet haben, senden wir Ihnen gerne unser bestes Angebot erneut zu!
                <br> <br>
                Mit freundlichen Grüßen
                <br> <br>
                [struttura] ';
        ### TESTI PER TORNATA DISPONIBILITA
        $dizBDISPO = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','TESTOMAIL_RITORNO_DISPONIBILITA')");
        $id_dizBDISPO = $dbMysqli->getInsertId($dizBDISPO);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_dizBDISPO."','".IDSITO."','it','".addslashes($testo3_it_dispo)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_dizBDISPO."','".IDSITO."','en','".addslashes($testo3_en_dispo)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_dizBDISPO."','".IDSITO."','fr','".addslashes($testo3_fr_dispo)."','1')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo,textarea) VALUES('".$id_dizBDISPO."','".IDSITO."','de','".addslashes($testo3_de_dispo)."','1')");
        

        ### RESPONSEFORM
        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_NOME')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Nome')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Name')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Nom')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Name')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_COGNOME')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Cognome')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Surname')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Prenom')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Nachname')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_EMAIL')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Email')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Email')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Email')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Email')");
        
        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_TELEFONO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Telefono')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Phone')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Telephone')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Telefon')");
        
        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_ARRIVO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Data Arrivo')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Arrival date')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Arrivee')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Ankunft')");
        
        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_PARTENZA')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Data Partenza')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Departure date')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Départure')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Abreisedatum')");
        
        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_ARRIVO_ALTERNATIVO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Arrivo alternativo')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Alternative Arrival')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Alternative Arrivee')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Alternative Ankunft')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_PARTENZA_ALTERNATIVO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Partenza alternativa')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Alternative Departure')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Alternative Départure')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Alternative Abreisedatum')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_TOTALE_ADULTI')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Totale Adulti')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Total Adults')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Total Adultes')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Total Erwachsene')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_TOTALE_BAMBINI')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Totale Bambini')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Total Children')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Total Enfants')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Total Kinder')");
        
        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_ADULTI')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Adulti')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Adults')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Adultes')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Erwachsene')");
        
        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_BAMBINI')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Bambini')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Children')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Enfants')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Kinder')");
        
        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_BAMBINI_ETA')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Età')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Age')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Age')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Jahre')");
        
        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_SISTEMAZIONE')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Tipologia camera')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Rooms')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Chambre')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Zimmer')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_TRATTAMENTO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Trattamento')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Treatment')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Categorie')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Behandlung')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_TARGET')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Tipologia vacanza')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Target vacation')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Vacances ciblées')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Zielurlaub')");
        
        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_MESSAGGIO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Messaggio')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Message')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Message')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Nachricht')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_ANIMALI_AMMESSI')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Viaggiamo con animali domestici')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','We travel with pets')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Nous voyagons avec des animaux domestiques')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Wir reisen mit Haustieren')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_CODICE_SCONTO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Codice Sconto')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Discount code')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Code de réduction')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Rabattcode')");
        
        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_H1')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Grazie per la tua richiesta! <br/>  <br/> Al più presto riceverai la nostra migliore proposta in base ai dati che ci hai comunicato. <br/>  Nel frattempo lasciati ispirare dal nostro sito per iniziare ad immaginare il tuo prossimo soggiorno.  <br/>  <br/>  Di seguito, il riepilogo dei dati inseriti: <br/> <br/>')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Thank you for your request! <br/> <br/> As soon as possible you will receive our best offer based on the data you have communicated to us. <br/> In the meantime, let yourself be inspired by our website to start imagining your next stay. <br/> <br/> Below is a summary of the data entered: <br/> <br/>')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Merci pour votre requête! <br/> <br/> Dès que possible, vous recevrez notre meilleure offre basée sur les données que vous nous avez communiquées. <br/> En attendant, laissez-vous inspirer par notre site internet pour commencer à imaginer votre prochain séjour. <br/> <br/> Voici un résumé des données saisies: <br/> <br/>')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Vielen Dank für die Anfrage! <br/> <br/> Sie erhalten so schnell wie möglich unser bestes Angebot basierend auf den Daten, die Sie uns mitgeteilt haben. <br/> Lassen Sie sich in der Zwischenzeit von unserer Website inspirieren und stellen Sie sich Ihren nächsten Aufenthalt vor. <br/> <br/> Nachfolgend finden Sie eine Zusammenfassung der eingegebenen Daten: <br/> <br/>')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_OGGETTO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Richiesta Informazioni per il sito: [sito] da parte di: [nome]')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Request Information for the site: [sito] by: [nome]')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Demande d\'informations pour le site: [sito] par [nome]')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Fordern Sie Informationen für die Website an: [sito] Von: [nome]')");
        
        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','RESPONSE_FORM_SUCCESSO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Richiesta Inviata con Successo!')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Successfully Received Inquiry!')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Demande reçue avec succès!')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Anfrage erfolgreich gesendet!')");


        ### FORM
        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_TARGET')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Tipologia vacanza')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Target vacation')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Vacances ciblées')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Zielurlaub')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_LEGENDA_VACANZA')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Scegli il tipo o il motivo della tua vacanza')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Choose the type or the reason for your holiday')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Choisissez le type ou la raison de vos vacances')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Wählen Sie die Art oder den Grund für Ihren Urlaub')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_COMUNICAZIONI')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Qualcosa da comunicarci')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Something to tell us')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Quelque chose à nous dire')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Etwas zu erzählen')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_TUO_SOGGIORNO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Dati del soggiorno')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Your stay data')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Vos données de séjour')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Ihre Aufenthaltsdaten')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_DATE_SOGGIORNO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Date del soggiorno')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Dates of stay')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Dates de séjour')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Daten des Aufenthalts')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_DATI_PERSONALI')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Dati personali')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Personal data')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Données personnelles')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Persönliche Daten')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_TEAXT_LOADER')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Qualche istante.... Sta per apparire il MODULO di richiesta informazioni dedicato al <b>CRM QUOTO</b>!')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','A few moments .... The information request form dedicated to <b>CRM QUOTO</b> is about to appear!')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Quelques instants .... Le formulaire de demande d\'informations dédié à <b>CRM QUOTO</b> est sur le point d\'apparaître!')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Ein paar Augenblicke ... Das Informationsanforderungsformular für <b>CRM QUOTO</b> ist in Kürze verfügbar!')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_NOME')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Nome')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Name')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Nom')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Name')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_COGNOME')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Cognome')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Surname')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Prenom')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Nachname')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_EMAIL')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Email')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Email')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Email')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Email')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_TELEFONO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Telefono')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Phone')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Telephone')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Telefon')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_ARRIVO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Data Arrivo')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Arrival date')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Arrivee')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Ankunft')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_PARTENZA')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Data Partenza')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Departure date')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Départure')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Abreisedatum')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_ARRIVO_ALTERNATIVO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Arrivo alternativo')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Alternative Arrival')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Alternative Arrivee')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Alternative Ankunft')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_PARTENZA_ALTERNATIVA')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Partenza alternativa')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Alternative Departure')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Alternative Départure')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Alternative Abreisedatum')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_TOTALE_ADULTI')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Nr.Totale Adulti')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Nr.Total Adults')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Nr.Total Adultes')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Nr.Total Erwachsene')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_TOTALE_BAMBINI')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Nr.Totale Bambini')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Nr.Total Children')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Nr.Total Enfants')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Nr.Total Kinder')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_SISTEMAZIONE')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Tipologia camera')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Type of room')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Type de chambre')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Zimmertyp')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_CAMERE')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Camere')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Rooms')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Chambres')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Zimmer')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_TRATTAMENTO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Trattamento')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Treatment')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Categorie')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Behandlung')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_ADULTI')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Adulti')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Adults')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Adultes')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Erwachsene')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_BAMBINI')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Bambini')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Children')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Enfants')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Kinder')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_BAMBINI_ETA')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Età: 1,3 mesi,<1')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Age: 1,3 months,<1')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Age: 1,3 mois,<1')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Alter: 1,3 Monate,<1')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_LEGENDA')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Scegli e/o aggiungi il trattamento e distribuisci i partecipanti')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Choose and/or add the treatment and distribute the participants')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Choisissez et/ou ajoutez le traitement et répartissez les participants')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Wählen und/oder fügen Sie die Behandlung hinzu und verteilen Sie die Teilnehmer')");
        
        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_ADD_DATE')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','aggiungi date alternative')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','add alternative dates')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','ajouter des dates alternatives')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','alternative Termine hinzufügen')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_REM_DATE')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','elimina date alternative')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','delete alternative dates')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','supprimer des dates alternatives')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','alternative Termine löschen')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_ADD_ROOM')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','aggiungi camera')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','add room')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','ajouter de la place')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','raum hinzufügen')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_REM_ROOM')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','rimuovi camera')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','remove room')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','retirer la pièce')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','zimmer entfernen')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_MESSAGGIO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Messaggio')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Message')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Message')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Nachricht')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_INVIA')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Invia Richiesta')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Send Request')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Envoyer demande')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Anfrage senden')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_CONSENSO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Ho preso visione dell\'informativa privacy - ')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','I have read the privacy policy - ')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','J\'ai lu la politique de confidentialité - ')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Ich habe die Datenschutzerklärung gelesen - ')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_LINK_INFORMATIVA')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Visualizza Informativa')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','View Information')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Voir les informations')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Informationen anzeigen')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_CONSENSO2')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Do il consenso per ricevere materiale marketing')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','I consent to receive marketing material')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','J\'accepte de recevoir du matériel de marketing')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Ich bin damit einverstanden, Marketingmaterial zu erhalten')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_CONSENSO3')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Voglio ricevere le offerte in linea con le preferenze che ho indicato')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','I want to receive offers in line with the preferences I have indicated')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Je veux recevoir des offres conformes aux préférences que j\'ai indiquées')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Ich möchte Angebote erhalten, die den von mir angegebenen Präferenzen entsprechen')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_PRIVACY')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Inserire informativa su SuiteWeb')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Inserire informativa su SuiteWeb')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Inserire informativa su SuiteWeb')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Inserire informativa su SuiteWeb')");

        $diz = $dbMysqli->query("INSERT INTO dizionario_form_quoto(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','FORM_SUCCESSO')");
        $id_diz =  $dbMysqli->getInsertId($diz);
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','it','Richiesta Inviata con Successo!')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','en','Successfully Received Inquiry!')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','fr','Demande reçue avec succès!')");
        $dbMysqli->query("INSERT INTO dizionario_form_quoto_lingue(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz."','".IDSITO."','de','Anfrage erfolgreich gesendet!')");





        // gestione configuratore
        $descr_select_tipo_camere .= 'Nel box select del campo TIPO CAMERE in CREA NUOVA PROPOSTA'."\r\n";
        $descr_select_tipo_camere .= 'Impostando il valore : '."\r\n";
        $descr_select_tipo_camere .= '0 = default'."\r\n";
        $descr_select_tipo_camere .= '1 = select con ricerca integrata'."\r\n";
        $dbMysqli->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','select_tipo_camere','".$descr_select_tipo_camere."','0')");
        #
        $descr_checkemail_verify .= 'Check per avere il controllo email tramite record MX'."\r\n";
        $descr_checkemail_verify .= 'Impostando il valore : '."\r\n";
        $descr_checkemail_verify .= '0 = il controllo non viene fatto'."\r\n";
        $descr_checkemail_verify .= '1 = il controllo è attivo'."\r\n";
        $dbMysqli->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_verify_email','".$descr_checkemail_verify."','1')");

        $descr_pagination .= 'Check per avere il ritorno alla pagina selezionata dopo una modifica'."\r\n";
        $descr_pagination .= 'Impostando il valore : '."\r\n";
        $descr_pagination .= '0 = il controllo non viene fatto'."\r\n";
        $descr_pagination .= '1 = il controllo è attivo'."\r\n";
        $dbMysqli->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_pagination','".$descr_pagination."','1')");

        $descr_paypal .= 'Check per avere la possibilità di pagare tramite PayPal'."\r\n";
        $descr_paypal .= 'Impostando il valore : '."\r\n";
        $descr_paypal .= '0 = il controllo non viene fatto'."\r\n";
        $descr_paypal .= '1 = il controllo è attivo'."\r\n";
        $dbMysqli->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_paypal','".$descr_paypal."','1')");

        $descr_gateway .= 'Check per avere la ppossibilità di pagare tramite Gateway Bancario'."\r\n";
        $descr_gateway .= 'Impostando il valore : '."\r\n";
        $descr_gateway .= '0 = il controllo non viene fatto'."\r\n";
        $descr_gateway .= '1 = il controllo è attivo'."\r\n";
        $dbMysqli->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_gateway_bancario','".$descr_gateway."','0')");

        $descr_virtualpay .= 'Check per avere la possibilità di pagare tramite Virtual Pay'."\r\n";
        $descr_virtualpay .= 'Impostando il valore : '."\r\n";
        $descr_virtualpay .= '0 = il controllo non viene fatto'."\r\n";
        $descr_virtualpay .= '1 = il controllo è attivo'."\r\n";
        $dbMysqli->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_virtualpay','".$descr_virtualpay."','0')");


        $descr_notifiche .= 'Check per abiltare o disabilitare le notifiche in push'."\r\n";
        $descr_notifiche .= 'Impostando il valore : '."\r\n";
        $descr_notifiche .= '0 = notifiche si NON vedono'."\r\n";
        $descr_notifiche .= '1 = notifiche si vedono'."\r\n";
        $dbMysqli->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_notifiche_push','".$descr_notifiche."','1')");

        $descr_box .= 'Impostazioni per box servizi aggiuntivi'."\r\n";
        $descr_box .= 'Impostando il valore : '."\r\n";
        $descr_box .= '0 = il box dei servizi aggiuintivi parte da chiuso'."\r\n";
        $descr_box .= '1 = il box dei servizi aggiuintivi parte da aperto'."\r\n";
        $dbMysqli->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_open_servizi','".$descr_box."','1')");

        $descr_stripe .= 'Check per avere la possibilità di pagare tramite STRIPE'."\r\n";
        $descr_stripe .= 'Impostando il valore : '."\r\n";
        $descr_stripe .= '0 = il controllo non viene fatto'."\r\n";
        $descr_stripe .= '1 = il controllo è attivo'."\r\n";
        $dbMysqli->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_stripe','".$descr_stripe."','1')");

        $descr_nexi .= 'Check per avere la possibilità di pagare tramite NEXI'."\r\n";
        $descr_nexi .= 'Impostando il valore : '."\r\n";
        $descr_nexi .= '0 = il controllo non viene fatto'."\r\n";
        $descr_nexi .= '1 = il controllo è attivo'."\r\n";
        $dbMysqli->query("INSERT INTO hospitality_configurazioni(idsito,parametro,descrizione,valore) VALUES('".IDSITO."','check_nexi','".$descr_nexi."','1')");

        #inserimento di default di una lista_newsletter
        $dbMysqli->query("INSERT INTO hospitality_smtp(idsito,SMTPAuth,SMTPHost,SMTPPort,SMTPSecure,SMTPUsername,SMTPPassword,NumberSend,Abilitato) VALUES('".IDSITO."','true','pro.eu.turbo-smtp.com','587','','info@network-service.it','TesD1300524!','300','1')");


        // inserimento di default di una lista_newsletter
        $dbMysqli->query("INSERT INTO mailing_newsletter_nome_liste(idsito,nome_lista,visibile) VALUES('".IDSITO."','Default List','1')");
        // gestione template
        $dbMysqli->query("INSERT INTO hospitality_template_landing(idsito,Directory,Template,BackgroundCellLink) VALUES('".IDSITO."','".DIRECTORYSITO."','default','#EF4047')");

        $dbMysqli->query("INSERT INTO hospitality_template_background(idsito,TemplateName,Thumb,Background) VALUES('".IDSITO."','default','thumb-default.png','#EF4047')");
        $dbMysqli->query("INSERT INTO hospitality_template_background(idsito,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Immagine2) VALUES('".IDSITO."','smart','thumb-smart.png','\'Montserrat\', sans-serif','#8A1702','#CA9822','top_image.jpg','bg_image.jpg')");
        $dbMysqli->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Immagine2) VALUES('".IDSITO."','custom1','family','thumb-family.png','\'Montserrat\', sans-serif','#FF4000','#003366','top_image_family.jpg','bg_image_family.jpg')");
        $dbMysqli->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Immagine2) VALUES('".IDSITO."','custom2','bike','thumb-bike.png','\'Montserrat\', sans-serif','#424242','#004C66','top_image_bike.jpg','bg_image_bike.jpg')");
        $dbMysqli->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Immagine2) VALUES('".IDSITO."','custom3','romantico','thumb-romantico.png','\'Montserrat\', sans-serif','#CA9822','#8A1702','top_image_romantico.jpg','bg_image_romantico.jpg')");


        #colori per new template
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#8A1702','#CA9822')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#000001','#FFA317')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#329FC3','#CFCD32')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#000000','#A6875D')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#424242','#004C66')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#105583','#DC3B60')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#643D43','#CF6F55')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#003366','#FF4000')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#663300','#FFBF00')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#400000','#242415')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#1D6066','#A8672E')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#A8342E','#248230')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#FF4000','#003366')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#CA9822','#8A1702')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#85255D','#789D2B')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#8A1702','#CA9822')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#000001','#FFA317')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#329FC3','#CFCD32')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#000000','#A6875D')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#424242','#004C66')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#105583','#DC3B60')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#643D43','#CF6F55')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#003366','#FF4000')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#663300','#FFBF00')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#400000','#242415')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#1D6066','#A8672E')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#A8342E','#248230')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#FF4000','#003366')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#CA9822','#8A1702')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#85255D','#789D2B')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#789D2B','#85255D')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#8A1702','#CA9822')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#248230','#A8342E')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#FFBF00','#663300')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#FF4000','#003366')");
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#CF6F55','#643D43')"); 
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#A8672E','#1D6066')");  
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#DC3B60','#105583')"); 
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#A6875D','#000000')"); 
        $dbMysqli->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".IDSITO."','#FFA317','#000001')"); 
        //
        //
        $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,NS) VALUES ('".IDSITO."', 'Family', '1')");
        $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,NS) VALUES ('".IDSITO."', 'Business', '1')");
        $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,NS) VALUES ('".IDSITO."', 'Fiera', '1')");
        $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,NS) VALUES ('".IDSITO."', 'Benessere', '1')");
        $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,NS) VALUES ('".IDSITO."', 'Bike', '1')");
        $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,NS) VALUES ('".IDSITO."', 'Sport', '1')");
        $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,NS) VALUES ('".IDSITO."', 'Divertimento', '1')");
        $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,NS) VALUES ('".IDSITO."', 'Romantico', '1')");
        $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,NS) VALUES ('".IDSITO."', 'Culturale', '1')");
        $dbMysqli->query("INSERT INTO hospitality_target(idsito,Target,NS) VALUES ('".IDSITO."', 'Enogastronomico', '1')");
        //
        //
        $info = $dbMysqli->query("INSERT INTO hospitality_infohotel(idsito,Titolo,Abilitato) VALUES('".IDSITO."','Informazioni Hotel','1')");
        $id_info = $dbMysqli->getInsertId($info);
        $dbMysqli->query("INSERT INTO hospitality_infohotel_lang(Id_infohotel,idsito,Lingua,Titolo) VALUES('".$id_info."','".IDSITO."','it','Informazioni Hotel')");
        $dbMysqli->query("INSERT INTO hospitality_infohotel_lang(Id_infohotel,idsito,Lingua,Titolo) VALUES('".$id_info."','".IDSITO."','en','Hotel information')");
        $dbMysqli->query("INSERT INTO hospitality_infohotel_lang(Id_infohotel,idsito,Lingua,Titolo) VALUES('".$id_info."','".IDSITO."','fr','Information de l\'Hôtel')");
        $dbMysqli->query("INSERT INTO hospitality_infohotel_lang(Id_infohotel,idsito,Lingua,Titolo) VALUES('".$id_info."','".IDSITO."','de','Hotelinformation')");
        //
        // syncro dati delle condizioni genrali
        $condizioni .= '<b>Modalità di prenotazione:</b><br><br>';
        $condizioni .= 'Qualora la nostra proposta fosse di Suo interesse, a titolo di conferma definitiva La preghiamo di inviarci la richiesta di prenotazione che trovate nel top della landing page scegliendo tramite check la tipologia di soggiorno.<br>';
        $condizioni .= 'Per confermare definitivamente la Sua prenotazione, La preghiamo inoltre di inviare sul nostro conto corrente o tramite carta di credito una caparra pari al 20% del prezzo totale dell\'offerta scelta.<br>';
        $condizioni .= 'In caso di nessun riscontro da parte Sua, non verrà effettuata alcuna prenotazione a Suo nome e l\'offerta presente non sarà più valida.<br><br>';
        $condizioni .= '<b>Penalità in caso di cancellazione:</b><br><br>';
        $condizioni .= 'In caso di annullamento del soggiorno, per causa non imputabile all\'Hotel, il Cliente sarà comunque tenuto a corrispondere le seguenti somme:<br>';
        $condizioni .= '<ul>';
        $condizioni .= '<li>Per cancellazioni entro 15 giorni dall\'arrivo nessuna penale, la caparra verrà interamente rimborsata</li>';
        $condizioni .= '<li>Per cancellazioni da 14 a 7 giorni prima dell\'arrivo, 50% del totale del soggiorno</li>';
        $condizioni .= '<li>Per cancellazioni da 7 a 3 giorni prima dell\'arrivo, 75% del totale del soggiorno</li>';
        $condizioni .= '<li>Per cancellazioni da 3 giorni a 0 giorni prima dell\'arrivo, 100% del totale del soggiorno</li>';
        $condizioni .= '</ul>';

        $condizioni_en .= '<b>Reservation Policies:</b><br><br>';
        $condizioni_en .= 'If our proposal would be of interest, as a final confirmation please send a booking request that you find in the top of the landing page by clicking the check stays.<br>';
        $condizioni_en .= 'To definitively confirm your reservation, please also send to our bank account or by credit card a deposit of 20% of the total price tender.<br>';
        $condizioni_en .= 'If no feedback from you, no reservation will fail in His name and this offer is no longer valid.<br><br>';
        $condizioni_en .= '<b>Penalties in case of cancellation:</b><br><br>';
        $condizioni_en .= 'In case of cancellation, for reasons not attributable to the Hotel, the customer will still be required to pay the following sums:<br>';
        $condizioni_en .= '<ul>';
        $condizioni_en .= '<li>For cancellations within 15 days of arrival no penalty, the deposit will be refunded</li>';
        $condizioni_en .= '<li>For cancellations from 14 to 7 days before arrival, 50% of total stay</li>';
        $condizioni_en .= '<li>For cancellations from 7 to 3 days before arrival, 75% of total stay</li>';
        $condizioni_en .= '<li>For cancellations from 3 days to 0 days before arrival, 100% of total stay</li>';
        $condizioni_en .= '</ul>';

        $condizioni_fr .= '<b>Conditions de réservation:</b><br><br>';
        $condizioni_fr .= 'Si notre proposition serait intéressant, comme une confirmation définitive s\'il vous plaît envoyer une demande de réservation que vous trouverez dans le haut de la page de destination en cliquant sur les séjours de contrôle.
                           Pour confirmer définitivement votre réservation, s\'il vous plaît envoyer aussi à notre compte bancaire ou par carte de crédit un acompte de 30% de l\'offre de prix total.
                           Si aucune réaction de votre part, aucune réservation échouera en son nom et cette offre est plus valide.<br>';
        $condizioni_fr .= '<b>Sanctions en cas d\'annulation:</b><br><br>';
        $condizioni_fr .= 'En cas d\'annulation, pour des raisons non imputables à l\'Hôtel, le client sera toujours tenu de payer les sommes suivantes:<br>';
        $condizioni_fr .= '<ul>';
        $condizioni_fr .= '<li>Pour les annulations dans les 15 jours de l\'arrivée sans pénalité, le dépôt sera remboursé</li>';
        $condizioni_fr .= '<li>Pour les annulations de 14 à 7 jours avant l\'arrivée, 50% du total du séjour</li>';
        $condizioni_fr .= '<li>Pour les annulations de 7 à 3 jours avant l\'arrivée, 75% du total du séjour</li>';
        $condizioni_fr .= '<li>Pour les annulations de 3 jours à 0 jours avant l\'arrivée, 100% du total du séjour</li>';
        $condizioni_fr .= '</ul>';

        $condizioni_de .= '<b>Reservierungsbedingungen:</b><br><br>';
        $condizioni_de .= 'Wenn unser Vorschlag von Interesse sein würde, als eine endgültige Bestätigung bitte eine Buchungsanfrage senden, die Sie im oberen Bereich der Zielseite finden, indem Sie die Kontroll Aufenthalte klicken.
                           Um endgültig Ihre Reservierung zu bestätigen, auch auf unser Bankkonto oder Kreditkarte bitte eine Anzahlung von 30% des Gesamtpreises Ausschreibung senden.
                           Wenn kein Feedback von Ihnen, wird keine Reservierung in seinem Namen scheitern und dieses Angebot ist nicht mehr gültig.<br>';
        $condizioni_de .= '<b>Die Strafen im Falle einer Stornierung:</b><br><br>';
        $condizioni_de .= 'Im Falle einer Stornierung aus Gründen nicht auf dem Hotel, sind immer noch der Kunde verpflichtet, die folgenden Beträge zu zahlen:<br>';
        $condizioni_de .= '<ul>';
        $condizioni_de .= '<li>Bei einer Stornierung innerhalb von 15 Tagen nach der Ankunft keine Strafe, wird die Kaution zurückerstattet</li>';
        $condizioni_de .= '<li>Stornierungen von 14 bis 7 Tage vor der Ankunft, 50% des gesamten Aufenthaltes</li>';
        $condizioni_de .= '<li>Bei Stornierungen von 7 auf 3 Tage vor Ankunft, 75% des gesamten Aufenthaltes</li>';
        $condizioni_de .= '<li>Bei einer Stornierung ab 3 Tage bis 0 Tage vor der Ankunft 100% des gesamten Aufenthaltes</li>';
        $condizioni_de .= '</ul>';

        //
        $policy = $dbMysqli->query("INSERT INTO hospitality_politiche(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','Politiche di default')");
        $id_policy = $dbMysqli->getInsertId($policy);
        $dbMysqli->query("INSERT INTO hospitality_politiche_lingua(id_politiche,idsito,Lingua,testo) VALUES('".$id_policy."','".IDSITO."','it','".addslashes($condizioni)."')");
        $dbMysqli->query("INSERT INTO hospitality_politiche_lingua(id_politiche,idsito,Lingua,testo) VALUES('".$id_policy."','".IDSITO."','en','".addslashes($condizioni_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_politiche_lingua(id_politiche,idsito,Lingua,testo) VALUES('".$id_policy."','".IDSITO."','fr','".addslashes($condizioni_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_politiche_lingua(id_politiche,idsito,Lingua,testo) VALUES('".$id_policy."','".IDSITO."','de','".addslashes($condizioni_de)."')");


        $tariffe_it .= 'TARIFFA WEB'."\r\n";
        $tariffe_it .= 'Miglior tariffa internet disponibile Termini di cancellazione La prenotazione che ha completato è in opzione.'."\r\n";
        $tariffe_it .= 'A breve, le invieremo una comunicazione scritta, confermando la sua proposta di prenotazione.'."\r\n";
        $tariffe_it .= ''."\r\n";
        $tariffe_it .= 'L\'ammontare della caparra sarà indicato nella nostra email di conferma.'."\r\n";
        $tariffe_it .= 'Ci teniamo a sottolineare che non effettueremo nessun addebito sulla sua carta di credito senza la sua autorizzazione.'."\r\n";
        $tariffe_it .= ''."\r\n";
        $tariffe_it .= 'In hotel potrete scegliere tra i seguenti metodi di pagamento:'."\r\n";
        $tariffe_it .= '- pagamento in contanti'."\r\n";
        $tariffe_it .= '- pagamento con assegno (depositato almeno 5 gg prima della partenza)'."\r\n";
        $tariffe_it .= '- Addebito sulla carta di credito (Visa, Maestro, Mastercard, Cartasi, Postepay) non accettiamo carte di credito aziendali'."\r\n";
        $tariffe_it .= '- Bancomat'."\r\n";
        $tariffe_it .= ''."\r\n";
        $tariffe_it .= 'Condizioni di cancellazione:'."\r\n";
        $tariffe_it .= 'Cancellazione gratuita entro 30 gg prima della data di arrivo, per cancellazioni inferiori a 30 giorni prima dell\'arrivo, verrà trattenuto l\'intero importo della caparra.'."\r\n";

        $tariffe_en .= 'WEB RATE'."\r\n";
        $tariffe_en .= 'Best internet rate available'."\r\n";
        $tariffe_en .= ''."\r\n";
        $tariffe_en .= 'Cancellation policies'."\r\n";
        $tariffe_en .= 'Your reservation has not yet been confirmed. Soon, we will send you a written communication confirming your reservation.'."\r\n";
        $tariffe_en .= 'The amount of the deposit will be indicated in our confirmation email. We would like to point out that we will not charge any credit on your credit card without your permission.'."\r\n";
        $tariffe_en .= ''."\r\n";
        $tariffe_en .= 'In the hotel you can choose between the following methods of payment:'."\r\n";
        $tariffe_en .= '- Cash'."\r\n";
        $tariffe_en .= '- Credit card (Visa, Maestro, Mastercard, Cartasi)'."\r\n";
        $tariffe_en .= '- Bancomat'."\r\n";
        $tariffe_en .= ''."\r\n";
        $tariffe_en .= 'Free cancellation within 30 days before the arrival, for cancellations less than 30 days before arrival, it will be kept the full amount of the deposit.'."\r\n";

        $tariffe_fr .= 'TAUX WEB'."\r\n";
        $tariffe_fr .= 'Meilleur tarif Internet disponible Politique d\'annulation La réservation effectuée est facultative.'."\r\n";
        $tariffe_fr .= 'Bientôt, nous vous enverrons une communication écrite confirmant votre proposition de réservation.'."\r\n";
        $tariffe_fr .= ''."\r\n";
        $tariffe_fr .= 'Le montant du dépôt sera indiqué dans notre email de confirmation.'."\r\n";
        $tariffe_fr .= 'Nous attirons votre attention sur le fait que nous ne facturerons pas votre carte de crédit sans votre autorisation.'."\r\n";
        $tariffe_fr .= ''."\r\n";
        $tariffe_fr .= 'À l\'hôtel, vous pouvez choisir entre les modes de paiement suivants:'."\r\n";
        $tariffe_fr .= '- Paiement en espèces'."\r\n";
        $tariffe_fr .= '- paiement par chèque (déposé au moins 5 jours avant le départ)'."\r\n";
        $tariffe_fr .= '- Débit de carte de crédit (Visa, Maestro, Mastercard, Cartasi, Postepay) Nous n\'acceptons pas les cartes de crédit professionnelles'."\r\n";
        $tariffe_fr .= '- Bancomat'."\r\n";
        $tariffe_fr .= ''."\r\n";
        $tariffe_fr .= 'Conditions d\'annulation:'."\r\n";
        $tariffe_fr .= 'Annulation gratuite dans les 30 jours avant l\'arrivée, pour les annulations moins de 30 jours avant l\'arrivée, le montant total du dépôt sera conservé.'."\r\n";

        $tariffe_de .= 'WEB-RATE'."\r\n";
        $tariffe_de .= 'Bester verfügbarer Internet-Tarif Stornierungsbedingungen Die Reservierung, die abgeschlossen wurde, ist optional.'."\r\n";
        $tariffe_de .= 'Bald senden wir Ihnen eine schriftliche Mitteilung, die Ihren Buchungsvorschlag bestätigt.'."\r\n";
        $tariffe_de .= ''."\r\n";
        $tariffe_de .= 'Die Höhe der Anzahlung wird in unserer Bestätigungsmail angegeben.'."\r\n";
        $tariffe_de .= 'Wir weisen darauf hin, dass wir Ihre Kreditkarte ohne Ihre Zustimmung nicht belasten.'."\r\n";
        $tariffe_de .= ''."\r\n";
        $tariffe_de .= 'Im Hotel können Sie zwischen den folgenden Zahlungsmethoden wählen:'."\r\n";
        $tariffe_de .= '- Barzahlung'."\r\n";
        $tariffe_de .= '- Zahlung per Scheck (hinterlegt mindestens 5 Tage vor der Abreise)'."\r\n";
        $tariffe_de .= '- Kreditkartenabbuchungen (Visa, Maestro, Mastercard, Cartasi, Postepay) akzeptieren wir keine Geschäftskreditkarten'."\r\n";
        $tariffe_de .= '- Bancomat'."\r\n";
        $tariffe_de .= ''."\r\n";
        $tariffe_de .= 'Stornobedingungen:'."\r\n";
        $tariffe_de .= 'Kostenlose Stornierung innerhalb von 30 Tagen vor der Ankunft, bei Stornierungen weniger als 30 Tage vor Ankunft wird der volle Betrag der Anzahlung einbehalten.'."\r\n";
        //
        $tariffe = $dbMysqli->query("INSERT INTO hospitality_condizioni_tariffe(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','Tariffa Web')");
        $id_tariffe = $dbMysqli->getInsertId($tariffe);
        $dbMysqli->query("INSERT INTO hospitality_condizioni_tariffe_lingua(id_tariffe,idsito,Lingua,tariffa,testo) VALUES('".$id_tariffe."','".IDSITO."','it','Tariffa Web','".addslashes($tariffe_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_condizioni_tariffe_lingua(id_tariffe,idsito,Lingua,tariffa,testo) VALUES('".$id_tariffe."','".IDSITO."','en','Web Rate','".addslashes($tariffe_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_condizioni_tariffe_lingua(id_tariffe,idsito,Lingua,tariffa,testo) VALUES('".$id_tariffe."','".IDSITO."','fr','Taux Web','".addslashes($tariffe_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_condizioni_tariffe_lingua(id_tariffe,idsito,Lingua,tariffa,testo) VALUES('".$id_tariffe."','".IDSITO."','de','Web-Rate','".addslashes($tariffe_de)."')");

        $tariffe2_it .= 'Tariffa prepagata non rimborsabile'."\r\n";
        $tariffe2_it .= 'Promozione valida per soggiorni minimi di ... notti.'."\r\n";
        $tariffe2_it .= ''."\r\n";
        $tariffe2_it .= 'Politiche di cancellazione  valide per il listino "Tariffa prepagata non rimborsabile"'."\r\n";
        $tariffe2_it .= 'Tariffa prepagata, non rimborsabile'."\r\n";
        $tariffe2_it .= 'Al momento della prenotazione verrà addebitato l\'intero importo del soggiorno specificato in conferma'."\r\n";
        $tariffe2_it .= 'In caso di cancellazione non è previsto alcun rimborso.'."\r\n";

        $tariffe2_en .= 'Prepaid rate not refundable'."\r\n";
        $tariffe2_en .= 'Promotion valid for minimum stays of ... nights.'."\r\n";
        $tariffe2_en .= ''."\r\n";
        $tariffe2_en .= 'Cancellation policies valid for the "Non-refundable prepaid rate" price list'."\r\n";
        $tariffe2_en .= 'Prepaid rate, non-refundable'."\r\n";
        $tariffe2_en .= 'At the time of booking the full amount of the stay specified in the confirmation will be charged'."\r\n";
        $tariffe2_en .= 'In case of cancellation there is no refund.'."\r\n";

        $tariffe2_fr .= 'Tarif prépayé non remboursable'."\r\n";
        $tariffe2_fr .= 'Promotion valable pour les séjours minimum de ... nuits..'."\r\n";
        $tariffe2_fr .= ''."\r\n";
        $tariffe2_fr .= 'Politiques d\'annulation valables pour la liste de prix "Tarif prépayé non remboursable"'."\r\n";
        $tariffe2_fr .= 'Tarif prépayé, non remboursable'."\r\n";
        $tariffe2_fr .= 'Au moment de la réservation, le montant total du séjour spécifié dans la confirmation sera facturé'."\r\n";
        $tariffe2_fr .= 'En cas d\'annulation il n\'y a pas de remboursement.'."\r\n";

        $tariffe2_de .= 'Prepaid-Rate nicht zurückerstattet'."\r\n";
        $tariffe2_de .= 'Promotion gültig für Mindestaufenthalte von ... Nächten.'."\r\n";
        $tariffe2_de .= ''."\r\n";
        $tariffe2_de .= 'Stornierungsbedingungen gelten für die Preisliste "Nicht erstattungsfähige Prepaid-Rate"'."\r\n";
        $tariffe2_de .= 'Prepaid-Rate, nicht erstattungsfähig'."\r\n";
        $tariffe2_de .= 'Zum Zeitpunkt der Buchung wird der volle Betrag des Aufenthalts, der in der Bestätigung angegeben ist, in Rechnung gestellt'."\r\n";
        $tariffe2_de .= 'Im Falle einer Stornierung gibt es keine Rückerstattung.'."\r\n";

                //
        $tariffe2 = $dbMysqli->query("INSERT INTO hospitality_condizioni_tariffe(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','Tariffa prepagata non rimborsabile')");
        $id_tariffe2 = $dbMysqli->getInsertId($tariffe2);
        $dbMysqli->query("INSERT INTO hospitality_condizioni_tariffe_lingua(id_tariffe,idsito,Lingua,tariffa,testo) VALUES('".$id_tariffe2."','".IDSITO."','it','Tariffa prepagata non rimborsabile','".addslashes($tariffe2_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_condizioni_tariffe_lingua(id_tariffe,idsito,Lingua,tariffa,testo) VALUES('".$id_tariffe2."','".IDSITO."','en','Prepaid rate not refundable','".addslashes($tariffe2_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_condizioni_tariffe_lingua(id_tariffe,idsito,Lingua,tariffa,testo) VALUES('".$id_tariffe2."','".IDSITO."','fr','Tarif prépayé non remboursable','".addslashes($tariffe2_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_condizioni_tariffe_lingua(id_tariffe,idsito,Lingua,tariffa,testo) VALUES('".$id_tariffe2."','".IDSITO."','de','Prepaid-Rate nicht zurückerstattet','".addslashes($tariffe2_de)."')");


        //
        $precheckin = $dbMysqli->query("INSERT INTO hospitality_precheckin(idsito,Lingua,etichetta,abilitato) VALUES('".IDSITO."','it','Pre-Checkin','1')");
        $id_precheckin = $dbMysqli->getInsertId($precheckin);
        $dbMysqli->query("INSERT INTO hospitality_precheckin_lingua(id_precheckin,idsito,Lingua,oggetto,testo) VALUES('".$id_precheckin."','".IDSITO."','it','Ricordati di ...','Gentile [cliente], ti stiamo aspettando!<br>Ricordati di ...')");
        $dbMysqli->query("INSERT INTO hospitality_precheckin_lingua(id_precheckin,idsito,Lingua,oggetto,testo) VALUES('".$id_precheckin."','".IDSITO."','en','Remember to...','Dear [cliente], we are waiting!<br>Remember to ...')");
        $dbMysqli->query("INSERT INTO hospitality_precheckin_lingua(id_precheckin,idsito,Lingua,oggetto,testo) VALUES('".$id_precheckin."','".IDSITO."','fr','Rappelez-vous ...','Cher [cliente], nous attendons!<br>Rappelez-vous ...')");
        $dbMysqli->query("INSERT INTO hospitality_precheckin_lingua(id_precheckin,idsito,Lingua,oggetto,testo) VALUES('".$id_precheckin."','".IDSITO."','de','Denken Sie daran ...','Lieber [cliente], wir warten!<br>Denken Sie daran ...')");

        //
        // syncro dati di default per fonti di prenotazione
        $dbMysqli->query("INSERT INTO hospitality_fonti_prenotazione(idsito,FontePrenotazione,Abilitato) VALUES('".IDSITO."','Reception','1')");
        $dbMysqli->query("INSERT INTO hospitality_fonti_prenotazione(idsito,FontePrenotazione,Abilitato,NS) VALUES('".IDSITO."','Sito Web','1','1')");
        $dbMysqli->query("INSERT INTO hospitality_fonti_prenotazione(idsito,FontePrenotazione,Abilitato) VALUES('".IDSITO."','Posta Elettronica','1')");
        $dbMysqli->query("INSERT INTO hospitality_fonti_prenotazione(idsito,FontePrenotazione,Abilitato,NS) VALUES('".IDSITO."','Telefono','1','1')");
        $dbMysqli->query("INSERT INTO hospitality_fonti_prenotazione(idsito,FontePrenotazione,Abilitato,NS) VALUES('".IDSITO."','Info Alberghi','1','1')");
        $dbMysqli->query("INSERT INTO hospitality_fonti_prenotazione(idsito,FontePrenotazione,Abilitato,NS) VALUES('".IDSITO."','gabiccemare.com','1','1')");
        $dbMysqli->query("INSERT INTO hospitality_fonti_prenotazione(idsito,FontePrenotazione,Abilitato,NS) VALUES('".IDSITO."','italyfamilyhotels.it','1','1')");
        $dbMysqli->query("INSERT INTO hospitality_fonti_prenotazione(idsito,FontePrenotazione,Abilitato,NS) VALUES('".IDSITO."','Richiesta diretta da Newsletter','1','1')");
        $dbMysqli->query("INSERT INTO hospitality_fonti_prenotazione(idsito,FontePrenotazione,Abilitato,NS) VALUES('".IDSITO."','Altro','1','1')");
        //FINE
        // syncro dati di default per gli operatori che useranno il software
        $dbMysqli->query("INSERT INTO hospitality_operatori(idsito,NomeOperatore,EmailSegretaria,Abilitato) VALUES('".IDSITO."','Operatore1','".EMAILHOTEL."','1')");
        //FINE
        //
        $dbMysqli->query("INSERT INTO hospitality_acconto_pagamenti(idsito,Acconto) VALUES('".IDSITO."','20')");
        // syncro dati di default per le tipologia di soggiorno, sincro dell'etichetta e delle 2 voci in lingua principale IT e EN
        $sync_pay = $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti(idsito,Lingua,TipoPagamento,Abilitato,Ordine) VALUES('".IDSITO."','it','Bonifico Bancario','1','0')");
        $id_sync_pay1 = $dbMysqli->getInsertId($sync_pay);
        $contenuto_bonifico_it .= 'Per poter riservare definitivamente la vostra prenotazione, dovete versare entro e non più tardi di 3 giorni lavorativi, la caparra del totale soggiorno tramite Bonifico:<br>';
        $contenuto_bonifico_it .= 'Solo dopo aver ricevuto conferma di pagamento tramite l\'invio del CRO alla nostra email, oppure tramite fax, copia della ricevuta di versamento, possiamo considerare la prenotazione accettata!<br><br>';
        $contenuto_bonifico_it .= '<b>Banca</b>:<br>';
        $contenuto_bonifico_it .= '<b>Filiale</b>:<br>';
        $contenuto_bonifico_it .= '<b>ABI</b>:<br>';
        $contenuto_bonifico_it .= '<b>CAB</b>: <br>';
        $contenuto_bonifico_it .= '<b>IBAN</b>:<br>';

        $contenuto_bonifico_en .= 'In order to definitively reserve your booking, you need to be paid within and no later than 3 working days, the deposit of the total stay by Bank: Only after receiving confirmation of ';
        $contenuto_bonifico_en .= 'payment by sending the CRO to our email, or by fax, copy of the receipt, we can consider the booking accepted!<br><br>';
        $contenuto_bonifico_en .= '<b>Banca</b>:<br>';
        $contenuto_bonifico_en .= '<b>Filiale</b>:<br>';
        $contenuto_bonifico_en .= '<b>ABI</b>:<br>';
        $contenuto_bonifico_en .= '<b>CAB</b>: <br>';
        $contenuto_bonifico_en .= '<b>IBAN</b>:<br>';

        $contenuto_bonifico_fr .= 'Pour réserver définitivement votre réservation, vous devez être payé à l\'intérieur et au plus tard 3 jours ouvrables, l\'acompte du montant total du séjour par la Banque:
                                   Seulement après avoir reçu la confirmation du paiement par l\'envoi du CRO à notre e-mail ou par fax, copie du reçu, nous pouvons considérer la réservation acceptée!<br><br>';
        $contenuto_bonifico_fr .= '<b>Banca</b>:<br>';
        $contenuto_bonifico_fr .= '<b>Filiale</b>:<br>';
        $contenuto_bonifico_fr .= '<b>ABI</b>:<br>';
        $contenuto_bonifico_fr .= '<b>CAB</b>: <br>';
        $contenuto_bonifico_fr .= '<b>IBAN</b>:<br>';

        $contenuto_bonifico_de .= 'Um Ihre Buchung endgültig zu behalten, müssen Sie innerhalb und spätestens drei Arbeitstage , die Anzahlung des gesamten Aufenthaltes von der Bank zu zahlen:<br>
                                   Erst nachdem durch Senden des CRO an unsere E-Mail-Bestätigung der Zahlung erhalten oder per Fax, Kopie der Quittung, können wir die Buchung akzeptiert betrachten!<br><br>';
        $contenuto_bonifico_de .= '<b>Banca</b>:<br>';
        $contenuto_bonifico_de .= '<b>Filiale</b>:<br>';
        $contenuto_bonifico_de .= '<b>ABI</b>:<br>';
        $contenuto_bonifico_de .= '<b>CAB</b>: <br>';
        $contenuto_bonifico_de .= '<b>IBAN</b>:<br>';

        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay1."','".IDSITO."','it','Bonifico Bancario','".addslashes($contenuto_bonifico_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay1."','".IDSITO."','en','Bank transfer','".addslashes($contenuto_bonifico_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay1."','".IDSITO."','fr','Virement bancaire','".addslashes($contenuto_bonifico_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay1."','".IDSITO."','de','Überweisung','".addslashes($contenuto_bonifico_de)."')");
        #
        $sync_pay2 = $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti(idsito,Lingua,TipoPagamento,mastercard,visa,amex,diners,Abilitato,Ordine) VALUES('".IDSITO."','it','Carta di Credito','1','1','1','1','0','1')");
        $id_sync_pay2 = $dbMysqli->getInsertId($sync_pay2);

        $contenuto_cc_it = 'Per poter riservare definitivamente la vostra prenotazione, dovete inserire nell\'apposita area della landing page di conferma a voi riservata, il numero di Carta di Credito a garanzia.';

        $contenuto_cc_en = 'In order to book definitely your reservation, you must enter into the appropriate area of the landing page to confirm to you reserved, the number of credit card as guarantee.';

        $contenuto_cc_fr = 'Pour réserver définitivement votre réservation, vous devez entrer dans la zone appropriée de la page de destination pour confirmer que vous avez réservé, le numéro de carte de crédit comme garantie.';

        $contenuto_cc_de = 'Um auf jeden Fall eine Reservierung zu buchen müssen Sie in den entsprechenden Bereich der Zielseite eingeben, um zu bestätigen, um die Anzahl der Kreditkarte als Garantie vorbehalten.';

        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay2."','".IDSITO."','it','Carta di Credito','".addslashes($contenuto_cc_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay2."','".IDSITO."','en','Credit card','".addslashes($contenuto_cc_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay2."','".IDSITO."','fr','Carte de crédit','".addslashes($contenuto_cc_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay2."','".IDSITO."','de','Kreditkarte','".addslashes($contenuto_cc_de)."')");
        #
        $sync_pay3 = $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti(idsito,Lingua,TipoPagamento,Abilitato,Ordine) VALUES('".IDSITO."','it','PayPal','0','2')");
        $id_sync_pay3 = $dbMysqli->getInsertId($sync_pay3);

        $contenuto_pp_it = 'Per poter riservare definitivamente la vostra prenotazione, dovete procedere al pagamento tramite PayPal.<br>
                            Una volta indirizzati al gateway di PayPal, terminare il pagamento e tornare alla vostra landing page dedicata per ottenere conferma di avvenuta operazione.';

        $contenuto_pp_en = 'To be able to permanently reserve your reservation, you must proceed with payment via PayPal.<br>
                            Once you are directed to the PayPal gateway, complete the payment and return to your dedicated landing page to obtain confirmation of the operation.';

        $contenuto_pp_fr = 'Pour pouvoir réserver votre réservation en permanence, vous devez procéder au paiement via PayPal.<br>
                            Une fois que vous êtes dirigé vers la passerelle PayPal, effectuez le paiement et revenez à votre page de destination dédiée pour obtenir la confirmation de l\'opération.';

        $contenuto_pp_de = 'Um Ihre Reservierung dauerhaft reservieren zu können, müssen Sie die Zahlung über PayPal vornehmen.<br>
                            Wenn Sie zum PayPal-Gateway weitergeleitet werden, führen Sie die Zahlung durch und kehren Sie zu Ihrer Landing-Page zurück, um eine Bestätigung der Operation zu erhalten.';

        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay3."','".IDSITO."','it','PayPal','".addslashes($contenuto_pp_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay3."','".IDSITO."','en','PayPal','".addslashes($contenuto_pp_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay3."','".IDSITO."','fr','PayPal','".addslashes($contenuto_pp_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay3."','".IDSITO."','de','PayPal','".addslashes($contenuto_pp_de)."')");


        $sync_pay4 = $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti(idsito,Lingua,TipoPagamento,Abilitato,Ordine) VALUES('".IDSITO."','it','Gateway Bancario','0','3')");
        $id_sync_pay4 = $dbMysqli->getInsertId($sync_pay4);

        $contenuto_gb_it = 'Per poter riservare definitivamente la vostra prenotazione, dovete procedere al pagamento tramite Gateway Bancario PayWay.<br>
                            Una volta indirizzati al gateway di PayPal, terminare il pagamento e tornare alla vostra landing page dedicata per ottenere conferma di avvenuta operazione.';

        $contenuto_gb_en = 'To be able to permanently reserve your reservation, you must proceed with payment via PayWay.<br>
                            Once you are directed to the PayPal gateway, complete the payment and return to your dedicated landing page to obtain confirmation of the operation.';

        $contenuto_gb_fr = 'Pour pouvoir réserver votre réservation en permanence, vous devez procéder au paiement via PayWay.<br>
                            Une fois que vous êtes dirigé vers la passerelle PayPal, effectuez le paiement et revenez à votre page de destination dédiée pour obtenir la confirmation de l\'opération.';

        $contenuto_gb_de = 'Um Ihre Reservierung dauerhaft reservieren zu können, müssen Sie die Zahlung über PayWay vornehmen.<br>
                            Wenn Sie zum PayPal-Gateway weitergeleitet werden, führen Sie die Zahlung durch und kehren Sie zu Ihrer Landing-Page zurück, um eine Bestätigung der Operation zu erhalten.';

        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay4."','".IDSITO."','it','Gateway Bancario','".addslashes($contenuto_gb_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay4."','".IDSITO."','en','Gateway Bancario','".addslashes($contenuto_gb_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay4."','".IDSITO."','fr','Gateway Bancario','".addslashes($contenuto_gb_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay4."','".IDSITO."','de','Gateway Bancario','".addslashes($contenuto_gb_de)."')");

        #stripe
        $sync_stripe5 = $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti(idsito,Lingua,TipoPagamento,Abilitato,Ordine) VALUES('".IDSITO."','it','Stripe','0','4')");
        $id_sync_stripe5 = $dbMysqli->getInsertId($sync_stripe5);

        $contenuto_stripe_it = 'Per poter riservare definitivamente la vostra prenotazione, dovete procedere al pagamento tramite STRIPE.<br>
                            Una volta indirizzati al gateway di STRIPE, terminare il pagamento e tornare alla vostra landing page dedicata per ottenere conferma di avvenuta operazione.';

        $contenuto_stripe_en = 'To be able to permanently reserve your reservation, you must proceed with payment via STRIPE.<br>
                            Once you are directed to the STRIPE gateway, complete the payment and return to your dedicated landing page to obtain confirmation of the operation.';

        $contenuto_stripe_fr = 'Pour pouvoir réserver votre réservation en permanence, vous devez procéder au paiement via STRIPE.<br>
                            Une fois que vous êtes dirigé vers la passerelle STRIPE, effectuez le paiement et revenez à votre page de destination dédiée pour obtenir la confirmation de l\'opération.';

        $contenuto_stripe_de = 'Um Ihre Reservierung dauerhaft reservieren zu können, müssen Sie die Zahlung über STRIPE vornehmen.<br>
                            Wenn Sie zum STRIPE-Gateway weitergeleitet werden, führen Sie die Zahlung durch und kehren Sie zu Ihrer Landing-Page zurück, um eine Bestätigung der Operation zu erhalten.';

        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_stripe5."','".IDSITO."','it','Stripe','".addslashes($contenuto_stripe_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_stripe5."','".IDSITO."','en','Stripe','".addslashes($contenuto_stripe_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_stripe5."','".IDSITO."','fr','Stripe','".addslashes($contenuto_stripe_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_stripe5."','".IDSITO."','de','Stripe','".addslashes($contenuto_stripe_de)."')");


        #nexi
        $sync_pay5 = $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti(idsito,Lingua,TipoPagamento,Abilitato,Ordine) VALUES('".IDSITO."','it','Nexi','0','5')");
        $id_sync_pay5 = $dbMysqli->getInsertId($sync_pay5);

        $contenuto_nexi_it = 'Per poter riservare definitivamente la vostra prenotazione, dovete procedere al pagamento tramite Gateway NEXI.<br>
                              Una volta indirizzati al gateway di NEXI, terminare il pagamento e tornare alla vostra landing page dedicata per ottenere conferma di avvenuta operazione.';
        //
        $contenuto_nexi_en = 'To be able to permanently reserve your reservation, you must proceed with payment NEXI.<br>
                              Once you are directed to the NEXI gateway, complete the payment and return to your dedicated landing page to obtain confirmation of the operation.';
        //
        $contenuto_nexi_fr = 'Pour pouvoir réserver votre réservation en permanence, vous devez procéder au paiement NEXI.<br>
                              Une fois que vous êtes dirigé vers la passerelle NEXI, effectuez le paiement et revenez à votre page de destination dédiée pour obtenir la confirmation de l\'opération.';
        //
        $contenuto_nexi_de = 'Um Ihre Reservierung dauerhaft reservieren zu können, müssen Sie die Zahlung über NEXI vornehmen.<br>
                              Wenn Sie zum NEXI-Gateway weitergeleitet werden, führen Sie die Zahlung durch und kehren Sie zu Ihrer Landing-Page zurück, um eine Bestätigung der Operation zu erhalten.';

        //
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay5."','".IDSITO."','it','Nexi','".addslashes($contenuto_nexi_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay5."','".IDSITO."','en','Nexi','".addslashes($contenuto_nexi_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay5."','".IDSITO."','fr','Nexi','".addslashes($contenuto_nexi_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pagamenti_lingua(pagamenti_id,idsito,lingue,Pagamento,Descrizione) VALUES('".$id_sync_pay5."','".IDSITO."','de','Nexi','".addslashes($contenuto_nexi_de)."')");

        $diz11_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','PAGA_NEXI')");
        $id_diz11_new = $dbMysqli->getInsertId($diz11_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".IDSITO."','it','Paga con NEXI')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".IDSITO."','en','Pay by NEXI')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".IDSITO."','fr','Payer par NEXI')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz11_new."','".IDSITO."','de','Zahlen Sie mit NEXI')");

        $diz12_new = $dbMysqli->query("INSERT INTO hospitality_dizionario(idsito,Lingua,etichetta) VALUES('".IDSITO."','it','MSG_NEXI')");
        $id_diz12_new = $dbMysqli->getInsertId($diz12_new);
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".IDSITO."','it','Pagamento salvato con successo, seguirà nostro voucher di conferma')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".IDSITO."','en','Payment successfully saved, follow our confirmation voucher')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".IDSITO."','fr','Paiement enregistré avec succès, suivre notre bon de confirmation')");
        $dbMysqli->query("INSERT INTO hospitality_dizionario_lingua(id_dizionario,idsito,Lingua,testo) VALUES('".$id_diz12_new."','".IDSITO."','de','Zahlung erfolgreich gespeichert, beachten Sie bitte folgende Bestätigung Gutschein')");
        //FINE
        //
        // syncro dati di default per lei pacchetti IT e EN
        $sync_p1 = $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto(idsito,Lingua,TipoPacchetto,Abilitato) VALUES('".IDSITO."','it','Pacchetto Benessere','1')");
        $id_sync_p1 = $dbMysqli->getInsertId($sync_p1);
        $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id,idsito,lingue,Pacchetto,Descrizione) VALUES('".$id_sync_p1."','".IDSITO."','it','Pacchetto Benessere','Con il Pacchetto Benessere, hai un\'esperienza soggiorno pensata esclusivamente per la cura e il benessere del tuo corpo. Non lasciartela sfuggire!')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id,idsito,lingue,Pacchetto,Descrizione) VALUES('".$id_sync_p1."','".IDSITO."','en','Wellness Package','With Spa Package, you have a living experience designed exclusively for the care and well-being of your body. Do not let it escape!')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id,idsito,lingue,Pacchetto,Descrizione) VALUES('".$id_sync_p1."','".IDSITO."','fr','Forfait bien-être','Avec Forfait Spa, vous expérience de vie exclusivement conçu pour le soin et le bien-être de votre corps. Ne le laissez pas échapper!')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id,idsito,lingue,Pacchetto,Descrizione) VALUES('".$id_sync_p1."','".IDSITO."','de','Wellness-Paket','Mit Spa-Package, erleben Sie leben ausschließlich für die Pflege und Wohlbefinden des Körpers. Lassen Sie es nicht zu entkommen!')");
        #
        $sync_p2 = $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto(idsito,Lingua,TipoPacchetto,Abilitato) VALUES('".IDSITO."','it','Pacchetto Relax','1')");
        $id_sync_p2 = $dbMysqli->getInsertId($sync_p2);
        $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id,idsito,lingue,Pacchetto,Descrizione) VALUES('".$id_sync_p2."','".IDSITO."','it','Pacchetto Relax','Il Pacchetto Relax ti consente di scegliere tra i numerosi trattamenti del nostro hotel. Per un momento di relax indimenticabile!')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id,idsito,lingue,Pacchetto,Descrizione) VALUES('".$id_sync_p2."','".IDSITO."','en','Relax Package','The Relaxation Package allows you to choose from the numerous treatments of our hotel. For an unforgettable moment of relaxation!')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id,idsito,lingue,Pacchetto,Descrizione) VALUES('".$id_sync_p2."','".IDSITO."','fr','Relax Package','Le forfait de relaxation vous permet de choisir parmi les nombreux traitements de notre hôtel. Pour un moment de détente inoubliable!')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id,idsito,lingue,Pacchetto,Descrizione) VALUES('".$id_sync_p2."','".IDSITO."','de','Relax-Paket','Das Entspannungspaket ermöglicht es Ihnen, von den zahlreichen Behandlungen unseres Hotels zur Auswahl. Für einen unvergesslichen Moment der Entspannung!')");
       #
        $sync_p3 = $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto(idsito,Lingua,TipoPacchetto,Abilitato) VALUES('".IDSITO."','it','Pacchetto Business','1')");
        $id_sync_p3 = $dbMysqli->getInsertId($sync_p3);
        $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id,idsito,lingue,Pacchetto,Descrizione) VALUES('".$id_sync_p3."','".IDSITO."','it','Pacchetto Business','Con il Pacchetto Business scopri come sia facile da noi ritrovare gli stessi comfort del tuo ufficio e come sia piacevole lavorare nel relax di una camera con dei prodotti aggiuntivi pensati per le tue esigenze.')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id,idsito,lingue,Pacchetto,Descrizione) VALUES('".$id_sync_p3."','".IDSITO."','en','Business Package','With the Business Package discover how easy we find the same comfort of your office and how it is pleasant to work in the relaxation of a room with additional products designed specifically for your needs.')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id,idsito,lingue,Pacchetto,Descrizione) VALUES('".$id_sync_p3."','".IDSITO."','fr','Forfait affaires','Avec le Business Package découvrir comment facile, nous trouvons le même confort de votre bureau et comment il est agréable de travailler dans la détente d\'une chambre avec d\'autres produits conçus pour vos besoins.')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_pacchetto_lingua(pacchetto_id,idsito,lingue,Pacchetto,Descrizione) VALUES('".$id_sync_p3."','".IDSITO."','de','Business-Paket','Mit dem Business Package entdecken, wie einfach wir den gleichen Komfort von Ihrem Büro finden und wie es angenehm ist, mit zusätzlichen Produkten in der Entspannung von einem Raum zu arbeiten für Ihre Bedürfnisse konzipiert.')");

        //
        $Qcheck = "SELECT * FROM hospitality_simplebooking WHERE idsito = ".IDSITO." AND Abilitato = 1 ORDER BY Id DESC LIMIT 1";
        $Tcheck = $dbMysqli->query($Qcheck);
        if(sizeof($Tcheck)>0){

              // SINCRO TIPO SOGGIORNO CON SIMPLE BOOKING
                    $xml='<OTA_HotelRatePlanRQ  xmlns="http://www.opentravel.org/OTA/2003/05"  Target="Production" Version="1.0">
                          <RatePlans>
                            <RatePlan>
                              <HotelRef HotelCode="'.$Tcheck[0]['IdHotel'].'" />
                              <TPA_Extensions>
                                   <provider Name="'.$Tcheck[0]['UserProvider'].'" Pwd="'.$Tcheck[0]['PasswordProvider'].'" />
                                   <XMLHotelAgent Name="'.$Tcheck[0]['UserHotel'].'" Pwd="'.$Tcheck[0]['PasswordHotel'].'" />
                              </TPA_Extensions>
                            </RatePlan>
                          </RatePlans>
                        </OTA_HotelRatePlanRQ>';

                    $dati = urlencode($xml);
                    $fp = fopen(BASE_PATH_SITO.'uploads/'.IDSITO.'/rate.xml','w');
                    $ch = curl_init();
                    $url = 'http://xml.simplebooking.it/xmlservice.asmx/RateListRQ';
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "xml=".$dati);
                    curl_setopt($ch, CURLOPT_FILE, $fp);
                    curl_exec($ch);

                    $soggiorni = simplexml_load_file(BASE_PATH_SITO.'uploads/'.IDSITO.'/rate.xml') or die("Error: Cannot create object");

                    $tipo_soggiorno_it  = '';
                    $tipo_soggiorno_en  = '';
                    $tipo_soggiorno_fr  = '';
                    $tipo_soggiorno_de  = '';
                    $testo_soggiorno_it = '';
                    $testo_soggiorno_en = '';
                    $testo_soggiorno_fr = '';
                    $testo_soggiorno_de = '';
                    $value              = '';
                    $val                = '';
                    $v                  = '';

                    foreach ($soggiorni as $key => $value) {
                      foreach ($value as $ky => $val) {
                        foreach ($val as $k => $v) {
                          switch($v['MealPlanCode'][0]){
                              case"MPT.1":
                                $tipo_soggiorno_it  = 'All Inclusive';
                                $tipo_soggiorno_en  = 'All Inclusive';
                                $tipo_soggiorno_fr  = 'All Inclusive';
                                $tipo_soggiorno_de  = 'All Inclusive';
                                $testo_soggiorno_it = 'La tipologia Tutto Incluso comprende solo l\'uso della camera, il servizio di prima colazione, il pranzo, la cena con tutte le bevande al tavolo comprese e tutte le consumazioni al bar';
                                $testo_soggiorno_en = 'The type All Inclusive includes only the use of the room, the breakfast service, lunch, dinner with all the drinks to the table and including all drinks at the bar';
                                $testo_soggiorno_fr = 'Le type All Inclusive ne comprend que l\'utilisation de la chambre, le service de petit-déjeuner, déjeuner, dîner avec toutes les boissons à la table et y compris toutes les boissons au bar';
                                $testo_soggiorno_de = 'Die Art All Inclusive beinhaltet nur die Nutzung des Raumes, dem Frühstück, Mittagessen, Abendessen mit allen Getränke an den Tisch und inklusive aller Getränke an der Bar';
                             break;
                              case"MPT.3":
                                $tipo_soggiorno_it  = 'Bed & Breakfast';
                                $tipo_soggiorno_en  = 'Bed & Breakfast';
                                $tipo_soggiorno_fr  = 'Bed & Breakfast';
                                $tipo_soggiorno_de  = 'Bed & Breakfast';
                                $testo_soggiorno_it = 'La tipologia Bed & Breakfast comprende solo l\'uso della camera ed il servizio di prima colazione';
                                $testo_soggiorno_en = 'The type Bed & Breakfast includes only the use of the room and the breakfast service';
                                $testo_soggiorno_fr = 'Le type Bed & Breakfast comprend seulement l\'utilisation de la salle et le service du petit-déjeuner';
                                $testo_soggiorno_de = 'Das Bed & Breakfast beinhaltet nur die Nutzung des Raumes und der Frühstücksservice';
                              break;
                              case"MPT.10":
                                $tipo_soggiorno_it  = 'Pensione Completa';
                                $tipo_soggiorno_en  = 'Full Board';
                                $tipo_soggiorno_fr  = 'Pension complète';
                                $tipo_soggiorno_de  = 'Vollpension';
                                $testo_soggiorno_it = 'La tipologia di Pensione Completa comprende solo l\'uso della camera, il servizio di prima colazione, il pranzo e la cena al ristorante dell\'hotel';
                                $testo_soggiorno_en = 'The type Full Board includes only the use of the room, the breakfast service, lunch and dinner at the hotel restaurant';
                                $testo_soggiorno_fr = 'Le type Pension complète ne comprend que l\'utilisation de la chambre, le service de petit-déjeuner, le déjeuner et le dîner au restaurant de l\'hôtel';
                                $testo_soggiorno_de = 'Die Vollpension beinhaltet nur die Nutzung des Raumes, die Frühstück, Mittagessen und Abendessen im Hotelrestaurant';
                              break;
                              case"MPT.12":
                                $tipo_soggiorno_it  = 'Mezza Pensione';
                                $tipo_soggiorno_en  = 'Half Board';
                                $tipo_soggiorno_fr  = 'Demi-pension';
                                $tipo_soggiorno_de  = 'Halbpension';
                                $testo_soggiorno_it = 'La tipologia di Mezza Pensione comprende solo l\'uso della camera, il servizio di prima colazione e la cena in hotel';
                                $testo_soggiorno_en = 'The type of Half Board includes only the use of the room, the breakfast and dinner at the hotel';
                                $testo_soggiorno_fr = 'Le type de demi-pension ne comprend que l\'utilisation de la chambre, le petit déjeuner et le dîner à l\'hôtel';
                                $testo_soggiorno_de = 'Die Art der Halbpension beinhaltet nur die Nutzung des Raumes, das Frühstück und Abendessen im Hotel';
                              break;
                              case"MPT.14":
                                $tipo_soggiorno_it  = 'Solo Pernotto';
                                $tipo_soggiorno_en  = 'Room Only';
                                $tipo_soggiorno_fr  = 'Seulement la nuit';
                                $tipo_soggiorno_de  = 'Nur Übernachtung';
                                $testo_soggiorno_it = 'La tipologia di solo pernotto, comprende solo l\'uso della camera';
                                $testo_soggiorno_en = 'The type of bed only, includes only the use of the room';
                                $testo_soggiorno_fr = 'Le type de lit seulement, ne comprend que l\'utilisation de la salle';
                                $testo_soggiorno_de = 'Die Art des Bettes nur schließt nur die Verwendung des Raums';
                              break;
                              default:
                                $tipo_soggiorno_it  = $v->Description->Text;
                                $tipo_soggiorno_en  = $v->Description->Text;
                                $tipo_soggiorno_fr  = $v->Description->Text;
                                $tipo_soggiorno_de  = $v->Description->Text;
                                $testo_soggiorno_it = '';
                                $testo_soggiorno_en = '';
                                $testo_soggiorno_fr = '';
                                $testo_soggiorno_de = '';
                            break;
                          }

                            if($v['MealPlanCode'][0]!=''){
                                // syncro dati per le tipologia di soggiorno
                                $sync1 = $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno(idsito,Lingua,TipoSoggiorno,PlanCode,Abilitato) VALUES('".IDSITO."','it','".$tipo_soggiorno_it."','".$v['MealPlanCode'][0]."','1')");
                                $id_sync1 = $dbMysqli->getInsertId($sync1);
                                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','it','".$tipo_soggiorno_it."','".addslashes($testo_soggiorno_it)."','".$v['MealPlanCode'][0]."')");
                                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','en','".$tipo_soggiorno_en."','".addslashes($testo_soggiorno_en)."','".$v['MealPlanCode'][0]."')");
                                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','fr','".$tipo_soggiorno_fr."','".addslashes($testo_soggiorno_fr)."','".$v['MealPlanCode'][0]."')");
                                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione,PlanCode) VALUES('".$id_sync1."','".IDSITO."','de','".$tipo_soggiorno_de."','".addslashes($testo_soggiorno_de)."','".$v['MealPlanCode'][0]."')");

                            }

                            $tipo_soggiorno_it  = '';
                            $tipo_soggiorno_en  = '';
                            $tipo_soggiorno_fr  = '';
                            $tipo_soggiorno_de  = '';
                            $testo_soggiorno_it = '';
                            $testo_soggiorno_en = '';
                            $testo_soggiorno_fr = '';
                            $testo_soggiorno_de = '';
                            $value              = '';
                            $val                = '';
                            $v                  = '';

                        }
                      }
                    }
                    curl_close($ch);
        }else{
                // syncro dati di default per le tipologia di soggiorno, sincro dell'etichetta e delle 2 voci in lingua principale IT e EN
                $sync1 = $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno(idsito,Lingua,TipoSoggiorno,Abilitato) VALUES('".IDSITO."','it','Solo Pernotto','1')");
                $id_sync1 = $dbMysqli->getInsertId($sync1);
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync1."','".IDSITO."','it','Solo Pernotto','La tipologia di solo pernotto, comprende solo l\'uso della camera')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync1."','".IDSITO."','en','Only Overnight','The type of bed only, includes only the use of the room')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync1."','".IDSITO."','fr','Seulement la nuit','Le type de lit seulement, ne comprend que l\'utilisation de la salle')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync1."','".IDSITO."','de','Nur Übernachtung','Die Art des Bettes nur schließt nur die Verwendung des Raums')");
                #
                $sync2 =$dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno(idsito,Lingua,TipoSoggiorno,Abilitato) VALUES('".IDSITO."','it','Bed & Breakfast','1')");
                $id_sync2 = $dbMysqli->getInsertId($sync2);
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync2."','".IDSITO."','it','Bed & Breakfast','La tipologia Bed & Breakfast comprende solo l\'uso della camera ed il servizio di prima colazione')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync2."','".IDSITO."','en','Bed & Breakfast','The type Bed & Breakfast includes only the use of the room and the breakfast service')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync2."','".IDSITO."','fr','Bed & Breakfast','Le type Bed & Breakfast comprend seulement l\'utilisation de la salle et le service du petit-déjeuner')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync2."','".IDSITO."','de','Bed & Breakfast','Das Bed & Breakfast beinhaltet nur die Nutzung des Raumes und der Frühstücksservice')");
                #
                $sync3 =$dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno(idsito,Lingua,TipoSoggiorno,Abilitato) VALUES('".IDSITO."','it','Mezza Pensione','1')");
                $id_sync3 = $dbMysqli->getInsertId($sync3);
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync3."','".IDSITO."','it','Mezza Pensione','La tipologia di Mezza Pensione comprende solo l\'uso della camera, il servizio di prima colazione e la cena in hotel')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync3."','".IDSITO."','en','Half Pension','The type of Half Board includes only the use of the room, the breakfast and dinner at the hotel')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync3."','".IDSITO."','fr','Demi-pension','Le type de demi-pension ne comprend que l\'utilisation de la chambre, le petit déjeuner et le dîner à l\'hôtel')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync3."','".IDSITO."','de','Halbpension','Die Art der Halbpension beinhaltet nur die Nutzung des Raumes, das Frühstück und Abendessen im Hotel')");
                #
                $sync4 =$dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno(idsito,Lingua,TipoSoggiorno,Abilitato) VALUES('".IDSITO."','it','Pensione Completa','1')");
                $id_sync4 = $dbMysqli->getInsertId($sync4);
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync4."','".IDSITO."','it','Pensione Completa','La tipologia di Pensione Completa comprende solo l\'uso della camera, il servizio di prima colazione, il pranzo e la cena al ristorante dell\'hotel')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync4."','".IDSITO."','en','Full Board','The type Full Board includes only the use of the room, the breakfast service, lunch and dinner at the hotel restaurant')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync4."','".IDSITO."','fr','Pension complète','Le type Pension complète ne comprend que l\'utilisation de la chambre, le service de petit-déjeuner, le déjeuner et le dîner au restaurant de l\'hôtel')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync4."','".IDSITO."','de','Vollpension','Die Vollpension beinhaltet nur die Nutzung des Raumes, die Frühstück, Mittagessen und Abendessen im Hotelrestaurant')");
                #
                $sync5 =$dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno(idsito,Lingua,TipoSoggiorno,Abilitato) VALUES('".IDSITO."','it','Tutto Incluso','1')");
                $id_sync5 = $dbMysqli->getInsertId($sync5);
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync5."','".IDSITO."','it','Tutto Incluso','La tipologia Tutto Incluso comprende solo l\'uso della camera, il servizio di prima colazione, il pranzo, la cena con tutte le bevande al tavolo comprese e tutte le consumazioni al bar')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync5."','".IDSITO."','en','All Inclusive','The type All Inclusive includes only the use of the room, the breakfast service, lunch, dinner with all the drinks to the table and including all drinks at the bar')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync5."','".IDSITO."','fr','All Inclusive','Le type All Inclusive ne comprend que l\'utilisation de la chambre, le service de petit-déjeuner, déjeuner, dîner avec toutes les boissons à la table et y compris toutes les boissons au bar')");
                $dbMysqli->query("INSERT INTO hospitality_tipo_soggiorno_lingua(soggiorni_id,idsito,lingue,Soggiorno,Descrizione) VALUES('".$id_sync5."','".IDSITO."','de','All Inclusive','Die Art All Inclusive beinhaltet nur die Nutzung des Raumes, dem Frühstück, Mittagessen, Abendessen mit allen Getränke an den Tisch und inklusive aller Getränke an der Bar')");
                #
        }
        //fine
        // inserimento listino di default - attivo
        $dbMysqli->query("INSERT INTO hospitality_numero_listini(idsito,Listino,Abilitato) VALUES('".IDSITO."','Listino default','1')");
        // syncro dati di default per i servizi in camera, sincro dell'etichetta e delle 2 voci in lingua principale IT e EN
        $se1 = $dbMysqli->query("INSERT INTO hospitality_servizi_camera(idsito,Lingua,Servizio,Abilitato) VALUES('".IDSITO."','it','Aria Condizionata','1')");
        $id_se1 = $dbMysqli->getInsertId($se1);
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se1."','".IDSITO."','it','Aria Condizionata')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se1."','".IDSITO."','en','Conditioned air')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se1."','".IDSITO."','fr','Climatisation')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se1."','".IDSITO."','de','Klimaanlage')");
        #
        $se2 = $dbMysqli->query("INSERT INTO hospitality_servizi_camera(idsito,Lingua,Servizio,Abilitato) VALUES('".IDSITO."','it','Cassaforte','1')");
        $id_se2 = $dbMysqli->getInsertId($se2);
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se2."','".IDSITO."','it','Cassaforte')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se2."','".IDSITO."','en','Safe')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se2."','".IDSITO."','fr','Coffre-fort')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se2."','".IDSITO."','de','Safe')");
        #
        $se3 = $dbMysqli->query("INSERT INTO hospitality_servizi_camera(idsito,Lingua,Servizio,Abilitato) VALUES('".IDSITO."','it','Accesso Internet Wi-Fi','1')");
        $id_se3 = $dbMysqli->getInsertId($se3);
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se3."','".IDSITO."','it','Accesso Internet Wi-Fi')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se3."','".IDSITO."','en','Internet Wi-Fi')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se3."','".IDSITO."','fr','Accès Internet Wi-Fi')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se3."','".IDSITO."','de','Internetzugang Wi-Fi')");
        #
        $se4 = $dbMysqli->query("INSERT INTO hospitality_servizi_camera(idsito,Lingua,Servizio,Abilitato) VALUES('".IDSITO."','it','Mini Bar','1')");
        $id_se4 = $dbMysqli->getInsertId($se4);
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se4."','".IDSITO."','it','Mini Bar')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se4."','".IDSITO."','en','Mini Bar')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se4."','".IDSITO."','fr','Mini Bar')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se4."','".IDSITO."','de','Mini Bar')");
        #
        $se5 = $dbMysqli->query("INSERT INTO hospitality_servizi_camera(idsito,Lingua,Servizio,Abilitato) VALUES('".IDSITO."','it','Set Cortesia','1')");
        $id_se5 = $dbMysqli->getInsertId($se5);
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se5."','".IDSITO."','it','Set Cortesia')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se5."','".IDSITO."','en','Courtesy Set')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se5."','".IDSITO."','fr','Courtoisie Set')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se5."','".IDSITO."','de','Courtesy Set')");
        #
        $se6 = $dbMysqli->query("INSERT INTO hospitality_servizi_camera(idsito,Lingua,Servizio,Abilitato) VALUES('".IDSITO."','it','Bagno privato con doccia','1')");
        $id_se6 = $dbMysqli->getInsertId($se6);
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se6."','".IDSITO."','it','Bagno privato con doccia')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se6."','".IDSITO."','en','Private bathroom with shower')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se6."','".IDSITO."','fr','Salle de bain privée avec douche')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se6."','".IDSITO."','de','Privates Badezimmer mit Dusche')");
        #
        $se7 = $dbMysqli->query("INSERT INTO hospitality_servizi_camera(idsito,Lingua,Servizio,Abilitato) VALUES('".IDSITO."','it','Asciugacapelli','1')");
        $id_se7 = $dbMysqli->getInsertId($se7);
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se7."','".IDSITO."','it','Asciugacapelli')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se7."','".IDSITO."','en','Hairdryer')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se7."','".IDSITO."','fr','Sèche-cheveux')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se7."','".IDSITO."','de','Haartrockner')");
        #
        $se8 = $dbMysqli->query("INSERT INTO hospitality_servizi_camera(idsito,Lingua,Servizio,Abilitato) VALUES('".IDSITO."','it','Servizio in Camera','1')");
        $id_se8 = $dbMysqli->getInsertId($se8);
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se8."','".IDSITO."','it','Servizio in Camera')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se8."','".IDSITO."','en','Room service')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se8."','".IDSITO."','fr','Un service d\'étage')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se8."','".IDSITO."','de','Zimmerservice')");
        #
        $se9 = $dbMysqli->query("INSERT INTO hospitality_servizi_camera(idsito,Lingua,Servizio,Abilitato) VALUES('".IDSITO."','it','Tv Satellitare','1')");
        $id_se9 = $dbMysqli->getInsertId($se9);
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se9."','".IDSITO."','it','Tv Satellitare')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se9."','".IDSITO."','en','Satellite TV')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se9."','".IDSITO."','fr','TV par satellite')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se9."','".IDSITO."','de','Satelliten-TV')");
        #
        $se10 = $dbMysqli->query("INSERT INTO hospitality_servizi_camera(idsito,Lingua,Servizio,Abilitato) VALUES('".IDSITO."','it','Telefono','1')");
        $id_se10 = $dbMysqli->getInsertId($se10);
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se10."','".IDSITO."','it','Telefono')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se10."','".IDSITO."','en','Telephone')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se10."','".IDSITO."','fr','Téléphone')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se10."','".IDSITO."','de','Telefon')");
        #
        $se11 = $dbMysqli->query("INSERT INTO hospitality_servizi_camera(idsito,Lingua,Servizio,Abilitato) VALUES('".IDSITO."','it','Balcone','1')");
        $id_se11 = $dbMysqli->getInsertId($se11);
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se11."','".IDSITO."','it','Balcone')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se11."','".IDSITO."','en','Balcony')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se11."','".IDSITO."','fr','Balcon')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se11."','".IDSITO."','de','Balkon')");
        #
        $se12 = $dbMysqli->query("INSERT INTO hospitality_servizi_camera(idsito,Lingua,Servizio,Abilitato) VALUES('".IDSITO."','it','Tv LCD','1')");
        $id_se12 = $dbMysqli->getInsertId($se12);
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se12."','".IDSITO."','it','Tv LCD')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se12."','".IDSITO."','en','LCD TV')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se12."','".IDSITO."','fr','TV LCD')");
        $dbMysqli->query("INSERT INTO hospitality_servizi_camere_lingua(servizi_id,idsito,lingue,Servizio) VALUES('".$id_se12."','".IDSITO."','de','LCD-TV')");
        // FINE

        $oggetto_covid19_it = 'Emesso Buono Voucher per [cliente] in riferimento Nr.Prenotazione [numeropreno]';
        $oggetto_covid19_en = 'Voucher issued for [cliente] reference No. Reservation [numeropreno]';
        $oggetto_covid19_fr = 'Bon émis pour le numéro de référence [cliente] Réservation [numeropreno]';
        $oggetto_covid19_de = 'Gutschein ausgestellt für [cliente] Referenznummer Reservierung [numeropreno]';
        
        $descr_covid19_it = '<p>Gentile <strong>[cliente]</strong>,</p>
        
                                <p>siamo sinceramente dispiaciuti per la cancellazione della sua prenotazione Nr. <strong>[numeropreno]</strong>, in conseguenza dell&rsquo;emergenza dovuta al virus COVID-19.</p>
        
                                <p>In conformit&agrave; a quanto previsto dall&#39;articolo 88 del decreto-legge n. 18 del 2020 e dell&#39;articolo 28 del decreto-legge n. 9 del 2020, le inviamo un voucher del valore di &euro; [caparra], che potr&agrave; utilizzare entro un anno dalla data di emissione.</p>
        
                                <p>Le condizioni applicabili sono le seguenti:&nbsp;</p>
        
                                <ul>
                                        <li>il voucher non &egrave; cedibile, e pu&ograve; essere quindi utilizzato solo dal beneficiario</li>
                                        <li>il voucher &egrave; cedibile e pu&ograve; quindi essere utilizzato da soggetti da lei indicati</li>
                                        <li>l&rsquo;importo non &egrave; frazionabile e deve pertanto essere utilizzato per un unico periodo di soggiorno</li>
                                        <li>l&rsquo;importo &egrave; frazionabile e quindi utilizzabile per pi&ugrave; soggiorni</li>
                                </ul>
        
                                <p>Per verificare la disponibilit&agrave; e prenotare il suo prossimo soggiorno, la preghiamo di contattarci su <strong>[emailhotel]</strong> indicando il numero del voucher e le date in cui desidera soggiornare.</p>
        
                                <p>Non vediamo l&#39;ora di darle il benvenuto</p>
        
                                <p>&nbsp;</p>
        
                                <p style="text-align: center;"><strong>CLICCA SUL LINK PER VISUALIZZARE E&nbsp;STAMPARE IL VOUCHER</strong></p>
        
                                <p style="text-align: center;"><strong>[linkvoucher]</strong></p>
        
                                <p style="text-align: center;">&nbsp;</p>
        
                                <p>Cordiali saluti</p>
        
                                <p><strong>[struttura]</strong></p>';
        
        $descr_covid19_en = '<p>Dear <strong>[cliente]</strong>,</p>
        
                                <p>we are sincerely sorry to hear about your need to cancel your reservation Nr. [<strong>numeropreno]</strong>, due to the COVID-19 emergency.</p>
        
                                <p>In accordance with the provisions of article 88 of law-decree no. 18/2020 and article 28 of law-decree no. 9/2020, we send you a voucher worth &euro; [caparra], which you can use within one year from the date of issue.</p>
        
                                <p>The applicable conditions are as follows:</p>
        
                                <ul>
                                        <li>the voucher is not transferable, and can therefore only be used by the beneficiary</li>
                                        <li>the voucher is transferable and can therefore be used by subjects indicated by you</li>
                                        <li>the amount is not fractionable and must therefore be used for a single period of stay</li>
                                        <li>the amount is fractionable and therefore usable for multiple stays</li>
                                </ul>
        
                                <p>To check availability and book your next stay, please contact us on <strong>[emailhotel]</strong> and indicate the voucher number and the dates of your preferred stay.</p>
        
                                <p>We look forward to welcoming you</p>
        
                                <p>&nbsp;</p>
        
                                <p style="text-align: center;"><strong>CLICK ON THE LINK TO VIEW AND PRINT THE VOUCHER</strong></p>
        
                                <p style="text-align: center;"><strong>[linkvoucher]</strong></p>
        
                                <p>&nbsp;</p>
        
                                <p>Sincerely</p>
        
                                <p><strong>[struttura]</strong></p>';
        
        $descr_covid19_fr = '<p>Cher <strong>[cliente],</strong></p>
        
                                <p>nous sommes sinc&egrave;rement d&eacute;sol&eacute;s pour l&#39;annulation de votre r&eacute;servation Nr.<strong> [numeropreno]</strong>, suite &agrave; l&#39;urgence due au virus COVID-19.</p>
        
                                <p>Conform&eacute;ment aux dispositions de l&#39;article 88 du d&eacute;cret-loi no. 18 de 2020 et l&#39;article 28 du d&eacute;cret-loi no. Le 9 de 2020, nous vous envoyons un bon d&#39;une valeur de [caparra] &euro;, que vous pouvez utiliser dans l&#39;ann&eacute;e suivant la date d&#39;&eacute;mission.</p>
        
                                <p>Les conditions applicables sont les suivantes:</p>
        
                                <p>le bon n&#39;est pas transf&eacute;rable et ne peut donc &ecirc;tre utilis&eacute; que par le b&eacute;n&eacute;ficiaire<br />
                                le bon est transf&eacute;rable et peut donc &ecirc;tre utilis&eacute; par les sujets que vous avez indiqu&eacute;s<br />
                                le montant n&#39;est pas divisible et doit donc &ecirc;tre utilis&eacute; pour une seule p&eacute;riode de s&eacute;jour<br />
                                le montant est divisible et donc utilisable pour plusieurs s&eacute;jours<br />
                                Pour v&eacute;rifier la disponibilit&eacute; et r&eacute;server votre prochain s&eacute;jour, veuillez nous contacter au <strong>[emailhotel]</strong> en indiquant le num&eacute;ro du bon et les dates auxquelles vous souhaitez s&eacute;journer.</p>
        
                                <p>Au plaisir de vous accueillir</p>
        
                                <p>&nbsp;</p>
        
                                <p style="text-align: center;"><strong>CLIQUEZ SUR LE LIEN POUR VISUALISER ET IMPRIMER LE BON</strong></p>
        
                                <p style="text-align: center;"><strong>[linkvoucher]</strong></p>
        
                                <p>&nbsp;</p>
        
                                <p>Cordialement</p>
        
                                <p><strong>[struttura]</strong></p>';
        
        $descr_covid19_de = '<p>Sehr geehrter<strong> [cliente]</strong>,</p>
        
                                <p>Wir entschuldigen uns aufrichtig f&uuml;r die Stornierung Ihrer Reservierung&nbsp;Nr. <strong>[numeropreno]</strong> als Folge des Notfalls aufgrund des COVID-19-Virus.</p>
        
                                <p>In &Uuml;bereinstimmung mit den Bestimmungen von Artikel 88 des Gesetzesdekrets Nr. 18 von 2020 und Artikel 28 des Gesetzesdekrets Nr. 9 von 2020 senden wir Ihnen einen Gutschein im Wert von &euro; [caparra], den Sie innerhalb eines Jahres ab Ausstellungsdatum einl&ouml;sen k&ouml;nnen.</p>
        
                                <p>Die anwendbaren Bedingungen sind wie folgt:</p>
        
                                <p>Der Gutschein ist nicht &uuml;bertragbar und kann daher nur vom Beg&uuml;nstigten verwendet werden<br />
                                Der Gutschein ist &uuml;bertragbar und kann daher von den von Ihnen angegebenen Themen verwendet werden<br />
                                Der Betrag ist nicht teilbar und muss daher f&uuml;r eine einzelne Aufenthaltsdauer verwendet werden<br />
                                Der Betrag ist teilbar und daher f&uuml;r mehrere Aufenthalte verwendbar<br />
                                Um die Verf&uuml;gbarkeit zu pr&uuml;fen und Ihren n&auml;chsten Aufenthalt zu buchen, kontaktieren Sie uns bitte unter <strong>[emailhotel]</strong> und geben Sie die Gutscheinnummer und die Daten an, an denen Sie &uuml;bernachten m&ouml;chten.</p>
        
                                <p>Wir freuen uns, Sie begr&uuml;&szlig;en zu d&uuml;rfen</p>
        
                                <p>&nbsp;</p>
        
                                <p style="text-align: center;"><strong>KLICKEN SIE AUF DEN LINK, UM DEN BIS GULTIG GULTIGEN GUTSCHEIN ANZUZEIGEN</strong></p>
        
                                <p style="text-align: center;"><strong>[linkvoucher]</strong></p>
        
                                <p>&nbsp;</p>
        
                                <p>Mit freundlichen Gr&uuml;&szlig;en</p>
        
                                <p><strong>[struttura]</strong></p>';

        // MOTIVAZIONI VOSUCHER CANCELLAZIONE
        $sync =$dbMysqli->query("INSERT INTO hospitality_tipo_voucher_cancellazione(idsito,Lingua,DataValidita,Motivazione,Abilitato) VALUES('".IDSITO."','it','".(date('Y')+1)."-".date('m-d')."','COVID19','1')");
        $id_sync = $dbMysqli->getInsertId($sync);
        $dbMysqli->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync."','".IDSITO."','it','COVID19','".addslashes($oggetto_covid19_it)."','".addslashes($descr_covid19_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync."','".IDSITO."','en','COVID19','".addslashes($oggetto_covid19_en)."','".addslashes($descr_covid19_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync."','".IDSITO."','fr','COVID19','".addslashes($oggetto_covid19_fr)."','".addslashes($descr_covid19_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync."','".IDSITO."','de','COVID19','".addslashes($oggetto_covid19_de)."','".addslashes($descr_covid19_de)."')");
        #
        $oggetto_malattia_it = 'Emesso Buono Voucher per [cliente] in riferimento alla prenotazione nr.[numeropreno]!';
        $oggetto_malattia_en = 'Voucher issued for [cliente] in reference to Reservation no. [numeropreno]!';
        $oggetto_malattia_fr = 'Bon émis pour le numéro de référence [cliente] Réservation [numeropreno]';
        $oggetto_malattia_de = 'Gutschein ausgestellt für [cliente] Referenznummer Reservierung [numeropreno]';
        
        $descr_malattia_it = '<p>Gentile [cliente],</p>
        
                                <p>se desideri&nbsp;recuperare la caparra gi&agrave; versata in riferimento alla&nbsp;prenotazione nr. [numeropreno];</p>
        
                                <p>Segui...........................</p>
        
                                <p>[linkvoucher]</p>';
        
        $descr_malattia_en = '<p>Dear [cliente],</p>
        
                                <p>if you wish to recover the deposit already paid in reference to the reservation no.[numeropreno];</p>
        
                                <p>Follow...........................</p>
        
                                <p>[linkvoucher]</p>';
        
        $descr_malattia_fr = 'Cher [cliente],
        
                                si vous souhaitez récupérer les arrhes déjà versées en référence à la réservation no. [numeropreno];
        
                                Suivez ...........................
        
                                [linkvoucher]';
        
        $descr_malattia_de = 'Sehr geehrter [cliente],
        
                                Wenn Sie die bereits gezahlte Anzahlung in Bezug auf die Reservierungsnummer zurückerhalten möchten. [numeropreno];
        
                                Folgen Sie ...........................
        
                                [linkvoucher]';

        $sync2 =$dbMysqli->query("INSERT INTO hospitality_tipo_voucher_cancellazione(idsito,Lingua,DataValidita,Motivazione,Abilitato) VALUES('".IDSITO."','it','".date('Y')."-".(date('m')+6)."-".date('d')."','Malattia','1')");
        $id_sync2 = $dbMysqli->getInsertId($sync);
        $dbMysqli->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync2."','".IDSITO."','it','Malattia','".addslashes($oggetto_malattia_it)."','".addslashes($descr_malattia_it)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync2."','".IDSITO."','en','Disease','".addslashes($oggetto_malattia_en)."','".addslashes($descr_malattia_en)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync2."','".IDSITO."','fr','Maladie','".addslashes($oggetto_malattia_fr)."','".addslashes($descr_malattia_fr)."')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_voucher_cancellazione_lingua(motivazione_id,idsito,lingue,Motivazione,Oggetto,Descrizione) VALUES('".$id_sync2."','".IDSITO."','de','Krankheit','".addslashes($oggetto_malattia_de)."','".addslashes($descr_malattia_de)."')");                       
        // FINE

        // SERVIZI AGGIUNTIVI
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_config(idsito,AbilitatoLatoLandingPage) VALUES('".IDSITO."','1')");

        $seT0 = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato,Ordine) VALUES('".IDSITO."','it','assicurazione.png','Assicurazione','','A percentuale','1','60')");
        $id_seT0 = $dbMysqli->getInsertId($seT0);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/assicurazione.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/assicurazione.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT0."','".IDSITO."','it','Assicurazione','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT0."','".IDSITO."','en','Insurance','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT0."','".IDSITO."','fr','Assurance','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT0."','".IDSITO."','de','Versicherung','')");

        $seT = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato,Ordine) VALUES('".IDSITO."','it','culla_baby.png','Culla','','Al giorno','1','60')");
        $id_seT = $dbMysqli->getInsertId($seT);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/culla_baby.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/culla_baby.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','".IDSITO."','it','Culla','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','".IDSITO."','en','Baby cot','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','".IDSITO."','fr','Lit d\'enfant','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT."','".IDSITO."','de','Krippe','')");
        #
        $seT1 = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato,Ordine) VALUES('".IDSITO."','it','parking.png','Parcheggio','','Al giorno','1','60')");
        $id_seT1 = $dbMysqli->getInsertId($seT1);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/parking.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/parking.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','".IDSITO."','it','Parcheggio','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','".IDSITO."','en','Parking','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','".IDSITO."','fr','Parking','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT1."','".IDSITO."','de','Parkplatz','')");
        #
        $seT2 = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato,Ordine) VALUES('".IDSITO."','it','beach.png','Spiaggia','','Al giorno','0','60')");
        $id_seT2 = $dbMysqli->getInsertId($seT2);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/beach.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/beach.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','".IDSITO."','it','Spiaggia','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','".IDSITO."','en','Beach','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','".IDSITO."','fr','Plage','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT2."','".IDSITO."','de','Strand','')");
        #
        $seT3 = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato,Ordine) VALUES('".IDSITO."','it','bus_navetta.png','Bus Navetta','','Una tantum','1','60')");
        $id_seT3 = $dbMysqli->getInsertId($seT3);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/bus_navetta.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/bus_navetta.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','".IDSITO."','it','Bus Navetta','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','".IDSITO."','en','Bus','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','".IDSITO."','fr','Navette','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT3."','".IDSITO."','de','Shuttle-Bus','')");
        #
        $seT4 = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato,Ordine) VALUES('".IDSITO."','it','wellness.png','Centro Wellness','','Una tantum','1','60')");
        $id_seT4 = $dbMysqli->getInsertId($seT4);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/wellness.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/wellness.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','".IDSITO."','it','Centro Wellness','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','".IDSITO."','en','Wellness Center','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','".IDSITO."','fr','Centre de bien-être','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT4."','".IDSITO."','de','Wellness Zentrum','')");
        #
        $seT5 = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato,Ordine) VALUES('".IDSITO."','it','computer.png','Internet Point','','Una tantum','1','60')");
        $id_seT5 = $dbMysqli->getInsertId($seT5);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/computer.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/computer.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".IDSITO."','it','Internet Point','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".IDSITO."','en','Internet Point','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".IDSITO."','fr','Internet Point','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT5."','".IDSITO."','de','Internet Point','')");
        #
        $seT51 = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato,Ordine) VALUES('".IDSITO."','it','nursery.png','Nursery','','Una tantum','1','60')");
        $id_seT51 = $dbMysqli->getInsertId($seT51);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/nursery.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/nursery.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT51."','".IDSITO."','it','Nursery','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT51."','".IDSITO."','en','Nursery','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT51."','".IDSITO."','fr','Pépinière','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT51."','".IDSITO."','de','Kindergarten','')");
        #
        $seT6 = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato,Ordine) VALUES('".IDSITO."','it','giornali.png','Giornali','','Al giorno','1','60')");
        $id_seT6 = $dbMysqli->getInsertId($seT6);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/giornali.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/giornali.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','".IDSITO."','it','Giornali','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','".IDSITO."','en','Newspapers','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','".IDSITO."','fr','Journaux','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT6."','".IDSITO."','de','Zeitungen','')");
        #
        $seT7 = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato,Ordine) VALUES('".IDSITO."','it','joystick_cover.png','Sala Giochi','','Una tantum','1','60')");
        $id_seT7 = $dbMysqli->getInsertId($seT7);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/joystick_cover.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/joystick_cover.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','".IDSITO."','it','Sala Giochi','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','".IDSITO."','en','Game room','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','".IDSITO."','fr','Salle de jeux','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT7."','".IDSITO."','de','Spielzimmer','')");

        #
        $seT8 = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato,Ordine) VALUES('".IDSITO."','it','skipass.png','Skipass','','A persona','0','60')");
        $id_seT8 = $dbMysqli->getInsertId($seT8);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/skipass.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/skipass.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','".IDSITO."','it','Skipass','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','".IDSITO."','en','Skipass','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','".IDSITO."','fr','Skipass','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT8."','".IDSITO."','de','Skipass','')");

        #
        $seT9 = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato,Ordine) VALUES('".IDSITO."','it','massaggio.png','Massaggio','','A persona','1','60')");
        $id_seT9 = $dbMysqli->getInsertId($seT9);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/massaggio.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/massaggio.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','".IDSITO."','it','Massaggio','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','".IDSITO."','en','Massage','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','".IDSITO."','fr','Massage','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT9."','".IDSITO."','de','Massage','')");
        //FINE

        #
        $seT10 = $dbMysqli->query("INSERT INTO hospitality_tipo_servizi(idsito,Lingua,Icona,TipoServizio,PrezzoServizio,CalcoloPrezzo,Abilitato,Ordine) VALUES('".IDSITO."','it','tassa_soggiorno.png','Tassa di Soggiorno','','A persona','1','60')");
        $id_seT10 = $dbMysqli->getInsertId($seT10);

        // COPIA ICONA DEMO
        $srcPathIcona  = $_SERVER['DOCUMENT_ROOT'].'/uploads/icon_service/tassa_soggiorno.png';
        $destPathIcona = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/tassa_soggiorno.png';
        if (!file_exists($destPathIcona)){
            copy($srcPathIcona, $destPathIcona);
        }
        // FINE COPIA ICONA

        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT10."','".IDSITO."','it','Tassa di Soggiorno','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT10."','".IDSITO."','en','City tax','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT10."','".IDSITO."','fr','Taxe de séjour','')");
        $dbMysqli->query("INSERT INTO hospitality_tipo_servizi_lingua(servizio_id,idsito,lingue,Servizio,Descrizione) VALUES('".$id_seT10."','".IDSITO."','de','Stadtsteuer','')");
        //FINE
        // gestione tipologia listino di default "a camera"
        $dbMysqli->query("INSERT INTO hospitality_tipo_listino(idsito,TipoListino) VALUES('".IDSITO."','0')");


        //
        if(sizeof($Tcheck)>0){
                $xml2 = '<OTA_HotelRoomListRQ xmlns="http://www.opentravel.org/OTA/2003/05"  Target="Production" Version="1.0">
                          <HotelRoomLists>
                            <HotelRoomList HotelCode="'.$Tcheck[0]['IdHotel'].'" />
                          </HotelRoomLists>
                          <TPA_Extensions>
                                   <provider Name="'.$Tcheck[0]['UserProvider'].'" Pwd="'.$Tcheck[0]['PasswordProvider'].'" />
                                   <XMLHotelAgent Name="'.$Tcheck[0]['UserHotel'].'" Pwd="'.$Tcheck[0]['PasswordHotel'].'" />
                          </TPA_Extensions>
                        </OTA_HotelRoomListRQ>';

                $dati2 = urlencode($xml2);
                $fp2 = fopen(BASE_PATH_SITO.'uploads/'.IDSITO.'/camere.xml','w');
                $ch2 = curl_init();
                $url2 = "http://xml.simplebooking.it/xmlservice.asmx/RoomListRQ";
                curl_setopt($ch2, CURLOPT_URL, $url2);
                curl_setopt($ch2, CURLOPT_POST, true);
                curl_setopt($ch2, CURLOPT_POSTFIELDS, 'xml='.$dati2);
                curl_setopt($ch2, CURLOPT_FILE, $fp2);
                curl_exec($ch2);

                $camere = simplexml_load_file(BASE_PATH_SITO.'uploads/'.IDSITO.'/camere.xml') or die("Error: Cannot create object");
                $camera = array();
                $RoomCode = '';
                    foreach ($camere as $key => $value) {
                      foreach ($value as $ky => $val) {
                        foreach ($val as $k => $v) {
                          foreach ($v as $chiave => $valore) {
                            foreach ($valore as $c => $va) {
                              foreach ($va as $ch => $vl) {
                                $RoomCode = $vl['RoomTypeCode'][0];
                                foreach ($vl as $kh => $row) {
                                  if($row['Name'][0] != ''){
                                      $camera[] = array('RoomCode' => $RoomCode,'Camera' => $row['Name'][0]);
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                    foreach ($camera as $y => $rec) {

                          // syncro dati camere da simplebooking
                          $cam1 = $dbMysqli->query("INSERT INTO hospitality_tipo_camere(idsito,Lingua,TipoCamere,RoomCode,Abilitato) VALUES('".IDSITO."','it','".$rec['Camera']."','".$rec['RoomCode']."','1')");
                          $id_cam1 = $dbMysqli->getInsertId($cam1);
                          $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','it','".$rec['Camera']."','','".$rec['RoomCode']."')");
                          $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','en','".$rec['Camera']."','','".$rec['RoomCode']."')");
                          $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','fr','".$rec['Camera']."','','".$rec['RoomCode']."')");
                          $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione,RoomCode) VALUES('".$id_cam1."','".IDSITO."','de','".$rec['Camera']."','','".$rec['RoomCode']."')");
                          $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','singola1.jpg')");
                          $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','doppia1.jpg')");
                          $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','tripla1.jpg')");

                    }

                curl_close($ch2);
        }else{
                // syncro dati di default per le camera, sincro dell'etichetta e delle 2 voci in lingua principale IT e EN
                $cam1 = $dbMysqli->query("INSERT INTO hospitality_tipo_camere(idsito,Lingua,TipoCamere,Abilitato) VALUES('".IDSITO."','it','Singola','1')");
                $id_cam1 = $dbMysqli->getInsertId($cam1);
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam1."','".IDSITO."','it','Camera Singola','Accogliente e confortevole la camera dispone di un letto')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam1."','".IDSITO."','en','Single Room','Cozy and comfortable room has a bed')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam1."','".IDSITO."','fr','Chambre simple','Chambre confortable et confortable dispose d\'un lit')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam1."','".IDSITO."','de','Einzelzimmer','Das gemütliche und komfortable Zimmer verfügt über ein Bett')");
                $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','singola1.jpg')");
                $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam1."','".IDSITO."','singola2.jpg')");
                #
                $cam2 = $dbMysqli->query("INSERT INTO hospitality_tipo_camere(idsito,Lingua,TipoCamere,Abilitato) VALUES('".IDSITO."','it','Doppia','1')");
                $id_cam2 = $dbMysqli->getInsertId($cam2);
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam2."','".IDSITO."','it','Camera Doppia', 'Arredata con gusto e dotata di ogni comfort, la camera dispone di due letti')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam2."','".IDSITO."','en','Double Room','Tastefully furnished and equipped with every comfort, the room has two beds')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam2."','".IDSITO."','fr','Chambre double','Joliment meublé et équipé avec tout le confort, la chambre dispose de deux lits')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam2."','".IDSITO."','de','Doppelzimmer','Geschmackvoll eingerichtet und mit allem Komfort ausgestattet, das Zimmer hat zwei Betten')");
                $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam2."','".IDSITO."','doppia1.jpg')");
                $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam2."','".IDSITO."','doppia2.jpg')");
                #
                $cam3 = $dbMysqli->query("INSERT INTO hospitality_tipo_camere(idsito,Lingua,TipoCamere,Abilitato) VALUES('".IDSITO."','it','Tripla','1')");
                $id_cam3 = $dbMysqli->getInsertId($cam3);
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam3."','".IDSITO."','it','Camera Tripla','Arredata in stile classico, la camera tripla è di dimensioni più grandi rispetto alle altre, dispone di tre letti')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam3."','".IDSITO."','en','Triple Room','Furnished in classic style, the triple room is larger than the other, has three beds')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam3."','".IDSITO."','fr','Chambre triple','Décoré dans un style classique, la chambre triple est plus grande que l\'autre, a trois lits')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam3."','".IDSITO."','de','Dreibettzimmer','Eingerichtet im klassischen Stil, ist das Zimmer mit drei Betten größer als die andere, hat drei Betten')");
                $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam3."','".IDSITO."','tripla1.jpg')");
                $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam3."','".IDSITO."','tripla2.jpg')");
                #
                $cam4 = $dbMysqli->query("INSERT INTO hospitality_tipo_camere(idsito,Lingua,TipoCamere,Abilitato) VALUES('".IDSITO."','it','Matrimoniale','1')");
                $id_cam4 = $dbMysqli->getInsertId($cam4);
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam4."','".IDSITO."','it','Camera Matrimoniale', 'Confortevole ed accogliente la camera matrimoniale dispone di un letto matrimoniale')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam4."','".IDSITO."','en','Wedding Room','Comfortable and welcoming the master bedroom has a double bed')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam4."','".IDSITO."','fr','Chambre mariage','Confortable et accueillant la chambre principale a un lit double')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam4."','".IDSITO."','de','Zimmer Ehe','Bequem und das Master-Schlafzimmer begrüßt hat ein Doppelbett')");
                $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam4."','".IDSITO."','matrimoniale1.jpg')");
                $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam4."','".IDSITO."','matrimoniale2.jpg')");
                #
                $cam5 = $dbMysqli->query("INSERT INTO hospitality_tipo_camere(idsito,Lingua,TipoCamere,Abilitato) VALUES('".IDSITO."','it','Suite','1')");
                $id_cam5 = $dbMysqli->getInsertId($cam5);
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam5."','".IDSITO."','it','Camera Suite','Ambiente armonioso e rilassante, dotata di ongi comfort, la camera suite è il fiore all\'occhiello della nostra struttura')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam5."','".IDSITO."','en','Suite Room','Harmonious and relaxing environment, equipped with every comfort, the room suite is the flagship of our structure')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam5."','".IDSITO."','fr','Chambre Suite','Harmonieux et environnement de détente, équipé de tout le confort, la suite de la chambre est le fleuron de notre structure')");
                $dbMysqli->query("INSERT INTO hospitality_camere_testo(camere_id,idsito,lingue,Camera,Descrizione) VALUES('".$id_cam5."','".IDSITO."','de','Zimmer Suite','Harmonische und entspannte Atmosphäre, mit allem Komfort ausgestattet, ist die Zimmer-Suite das Flaggschiff unserer Struktur')");
                $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam5."','".IDSITO."','suite1.jpg')");
                $dbMysqli->query("INSERT INTO hospitality_gallery_camera(IdCamera,idsito,Foto) VALUES('".$id_cam5."','".IDSITO."','suite2.jpg')");
        }
        // FINE
                $insert              = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".IDSITO."','custom1','Family','1')";
                $ins                 = $dbMysqli->query($insert);
                $IdTipoGalleryFamily = $dbMysqli->getInsertId($ins);
                $insertF             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFamily."','family1.jpg','1')";
                $dbMysqli->query($insertF);
                $insertF2             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFamily."','family2.jpg','1')";
                $dbMysqli->query($insertF2);
                $insertF3             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryFamily."','family3.jpg','1')";
                $dbMysqli->query($insertF3);


                $insert2           = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".IDSITO."','custom2','Bike','1')";
                $ins2              = $dbMysqli->query($insert2);
                $IdTipoGalleryBike = $dbMysqli->getInsertId($ins2);
                $insertB           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBike."','bike1.jpg','1')";
                $dbMysqli->query($insertB);
                $insertB2           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBike."','bike2.jpg','1')";
                $dbMysqli->query($insertB2);
                $insertB3           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryBike."','bike3.jpg','1')";
                $dbMysqli->query($insertB3);

                $insert3             = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".IDSITO."','custom3','Romantico','1')";
                $ins                 = $dbMysqli->query($insert3);
                $IdTipoGalleryRomantico = $dbMysqli->getInsertId($ins3);
                $insertR             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRomantico."','romantico1.jpg','1')";
                $dbMysqli->query($insertR);
                $insertR2             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRomantico."','romantico2.jpg','1')";
                $dbMysqli->query($insertR2);
                $insertR3             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".IDSITO."','".$IdTipoGalleryRomantico."','romantico3.jpg','1')";
                $dbMysqli->query($insertR3);
                // COPIA IMMAGINI DEMO
                $srcPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/demo_image/';
                $destPath =  $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/';  

                $srcDir = opendir($srcPath);
                while($readFile = readdir($srcDir))
                {
                    if($readFile == 'family1.jpg' || $readFile == 'family2.jpg' || $readFile == 'family3.jpg')
                    {

                        if (!file_exists($readFile)) 
                        {
                            if(copy($srcPath . $readFile, $destPath . $readFile))
                            {
                                $copia = "Copy file";
                            }
                            else
                            {
                                $copia = "Canot Copy file";
                            }
                        }
                    }
                    if($readFile == 'bike1.jpg' || $readFile == 'bike2.jpg' || $readFile == 'bike3.jpg')
                    {

                        if (!file_exists($readFile)) 
                        {
                            if(copy($srcPath . $readFile, $destPath . $readFile))
                            {
                                $copia = "Copy file";
                            }
                            else
                            {
                                $copia = "Canot Copy file";
                            }
                        }
                    }
                    if($readFile == 'romantico1.jpg' || $readFile == 'romantico2.jpg' || $readFile == 'romantico3.jpg')
                    {

                        if (!file_exists($readFile)) 
                        {
                            if(copy($srcPath . $readFile, $destPath . $readFile))
                            {
                                $copia = "Copy file";
                            }
                            else
                            {
                                $copia = "Canot Copy file";
                            }
                        }
                    }
                }

                closedir($srcDir);
                // FINE COPIA IMMAGINI

        //
        // syncro dati domande standard per customer satisfaction
        $cs = $dbMysqli->query("INSERT INTO hospitality_domande(idsito,Lingua,Domanda,Abilitato) VALUES('".IDSITO."','it','Reception','1')");
        $id_cs = $dbMysqli->getInsertId($cs);
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs."','".IDSITO."','it','Reparto Reception')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs."','".IDSITO."','en','Reception Ward')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs."','".IDSITO."','fr','Département Réception')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs."','".IDSITO."','de','Abteilung Rezeption')");
        #
        $cs2 = $dbMysqli->query("INSERT INTO hospitality_domande(idsito,Lingua,Domanda,Abilitato) VALUES('".IDSITO."','it','Ristorante','1')");
        $id_cs2 = $dbMysqli->getInsertId($cs2);
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs2."','".IDSITO."','it','Servizio Ristorante')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs2."','".IDSITO."','en','Service Restaurant')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs2."','".IDSITO."','fr','Service Restaurant')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs2."','".IDSITO."','de','Service Restaurant')");
        #
        $cs4 = $dbMysqli->query("INSERT INTO hospitality_domande(idsito,Lingua,Domanda,Abilitato) VALUES('".IDSITO."','it','Buffet','1')");
        $id_cs4 = $dbMysqli->getInsertId($cs4);
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs4."','".IDSITO."','it','Buffet Colazioni')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs4."','".IDSITO."','en','Breakfast Buffet')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs4."','".IDSITO."','fr','Petit déjeuner buffet')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs4."','".IDSITO."','de','Buffet-Frühstück')");
        #
        $cs3 = $dbMysqli->query("INSERT INTO hospitality_domande(idsito,Lingua,Domanda,Abilitato) VALUES('".IDSITO."','it','Personale','1')");
        $id_cs3 = $dbMysqli->getInsertId($cs3);
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs3."','".IDSITO."','it','Disponibilità del personale')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs3."','".IDSITO."','en','Helpful staff')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs3."','".IDSITO."','fr','Personnel serviable')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs3."','".IDSITO."','de','Die hilfsbereiten Mitarbeiter')");
        #
        $cs5 = $dbMysqli->query("INSERT INTO hospitality_domande(idsito,Lingua,Domanda,Abilitato) VALUES('".IDSITO."','it','Pulizie','1')");
        $id_cs5 = $dbMysqli->getInsertId($cs5);
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs5."','".IDSITO."','it','Reparto Pulizie')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs5."','".IDSITO."','en','Cleaning department')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs5."','".IDSITO."','fr','Nettoyage département')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs5."','".IDSITO."','de','Reinigungsabteilung')");
        #
        $cs7 = $dbMysqli->query("INSERT INTO hospitality_domande(idsito,Lingua,Domanda,Abilitato) VALUES('".IDSITO."','it','Camere','1')");
        $id_cs7 = $dbMysqli->getInsertId($cs7);
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs7."','".IDSITO."','it','Camere')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs7."','".IDSITO."','en','Rooms')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs7."','".IDSITO."','fr','Chambres')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs7."','".IDSITO."','de','Zimmer')");
        #
        $cs6 = $dbMysqli->query("INSERT INTO hospitality_domande(idsito,Lingua,Domanda,Abilitato) VALUES('".IDSITO."','it','Servizi in Camera','1')");
        $id_cs6 = $dbMysqli->getInsertId($cs6);
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs6."','".IDSITO."','it','Servizi in Camera')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs6."','".IDSITO."','en','Room services')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs6."','".IDSITO."','fr','Les services de chambre')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs6."','".IDSITO."','de','Zimmerservice')");
        #
        $cs8 = $dbMysqli->query("INSERT INTO hospitality_domande(idsito,Lingua,Domanda,Abilitato) VALUES('".IDSITO."','it','Servizi in Hotel','1')");
        $id_cs8 = $dbMysqli->getInsertId($cs8);
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs8."','".IDSITO."','it','Servizi in Hotel')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs8."','".IDSITO."','en','Services in Hotel')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs8."','".IDSITO."','fr','Services Hôtel')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs8."','".IDSITO."','de','Dienstleistungen im Hotel')");
        #
        $cs9 = $dbMysqli->query("INSERT INTO hospitality_domande(idsito,Lingua,Domanda,Abilitato) VALUES('".IDSITO."','it','Giudizio Finale','1')");
        $id_cs9 = $dbMysqli->getInsertId($cs9);
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs9."','".IDSITO."','it','Giudizio Finale')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs9."','".IDSITO."','en','Final Judgement')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs9."','".IDSITO."','fr','Jugement final')");
        $dbMysqli->query("INSERT INTO hospitality_domande_lingua(domanda_id,idsito,lingue,Domanda) VALUES('".$id_cs9."','".IDSITO."','de','Jüngste Gericht')");
        #
        //FINE
        //
    	// syncro dati di default per contenutio della email
        $oggetto_preventivo   = '';
        $messaggio_preventivo = '';
        $oggetto_conferma     = '';
        $messaggio_conferma   = '';

        $lingue = getLingue(IDSITO);
        foreach($lingue as $k => $v){

            $oggetto_preventivo   = syncro_oggetto_preventivo($v);
            $messaggio_preventivo = syncro_messaggio_preventivo($v);
            $dbMysqli->query("INSERT INTO hospitality_contenuti_email(idsito,TipoRichiesta,Lingua,Oggetto,Messaggio,Abilitato) VALUES('".IDSITO."','Preventivo','".$v."','".$oggetto_preventivo."','".$messaggio_preventivo."','1')");
            #
            $oggetto_conferma   = syncro_oggetto_conferma($v);
            $messaggio_conferma = syncro_messaggio_conferma($v);
            $dbMysqli->query("INSERT INTO hospitality_contenuti_email(idsito,TipoRichiesta,Lingua,Oggetto,Messaggio,Abilitato) VALUES('".IDSITO."','Conferma','".$v."','".$oggetto_conferma."','".$messaggio_conferma."','1')");
        }
        //fine
        //
        //MINI GALLERY EMAIL
        $dbMysqli->query("INSERT INTO hospitality_minigallery(idsito,Immagine) VALUES('".IDSITO."','email1.jpg')");
        $dbMysqli->query("INSERT INTO hospitality_minigallery(idsito,Immagine) VALUES('".IDSITO."','email2.jpg')");
        $dbMysqli->query("INSERT INTO hospitality_minigallery(idsito,Immagine) VALUES('".IDSITO."','email3.jpg')");
        //GALLERY GENERALE
        $dbMysqli->query("INSERT INTO hospitality_gallery(idsito,Immagine,Abilitato) VALUES('".IDSITO."','gallery1.jpg','1')");
        $dbMysqli->query("INSERT INTO hospitality_gallery(idsito,Immagine,Abilitato) VALUES('".IDSITO."','gallery2.jpg','1')");
        $dbMysqli->query("INSERT INTO hospitality_gallery(idsito,Immagine,Abilitato) VALUES('".IDSITO."','gallery3.jpg','1')");

        //INSERIMENTO STILE LANDING DI DEFAULT
        $dbMysqli->query("INSERT INTO hospitality_stile_landing(idsito,FoglioStile,BackgroundEmail,BackgroundCellData) VALUES('".IDSITO."','hospitality-item.css','#EBEBEB','#dbd7d8')");

        // syncro dati di default per contenutio della landing page
        $testo_preventivo = '';
        $testo_conferma   = '';

        $lingue = getLingue(IDSITO);
        foreach($lingue as $k => $v){

            $testo_preventivo = syncro_web_preventivo($v);
            $dbMysqli->query("INSERT INTO hospitality_contenuti_web(idsito,Immagine,TipoRichiesta,Lingua,Moduli,Testo,Abilitato) VALUES('".IDSITO."','top_".$v.".jpg','Preventivo','".$v."','Eventi,Punti di Interesse','".$testo_preventivo."','1')");
            #
            $testo_conferma = syncro_web_conferma($v);
            $dbMysqli->query("INSERT INTO hospitality_contenuti_web(idsito,TipoRichiesta,Lingua,Testo,Abilitato) VALUES('".IDSITO."','Conferma','".$v."','".$testo_conferma."','1')");
        }

        // COPIA IMMAGINI DEMO
        $srcPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/demo_image/';
        $destPath =  $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/';

        $srcDir = opendir($srcPath);
        while($readFile = readdir($srcDir))
        {
            if($readFile != '.' && $readFile != '..')
            {

                if (!file_exists($readFile))
                {
                    if(@copy($srcPath . $readFile, $destPath . $readFile))
                    {
                        $copia = "Copy file";
                    }
                    else
                    {
                        $copia = "Canot Copy file";
                    }
                }
            }
        }

        closedir($srcDir);
        // FINE COPIA IMMAGINI
        //
        //inserimento flag setup effettuato!!
        $dbMysqli->query("INSERT INTO hospitality_setup(idsito,data_setup,setup) VALUES('".IDSITO."','".date('Y-m-d H:i:s')."','1')");

        //header('Location:'.BASE_URL_SITO.'syncro/');
        $prt->_goto(BASE_URL_SITO.'syncro/');
    }
