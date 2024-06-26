<?php

                $query = "SELECT utenti.idsito, siti.web 
                            FROM utenti 
                            INNER JOIN siti ON siti.idsito = utenti.idsito 
                            WHERE 1=1
                            AND utenti.blocco_accesso = 0 
                            AND siti.hospitality = 1
                            ".($_REQUEST['idsito']!=""?"AND siti.idsito = ".$_REQUEST['idsito']:"")."
                            AND siti.data_start_hospitality <= '".date('Y-m-d')."' 
                            AND siti.data_end_hospitality > '".date('Y-m-d')."'";
        $rec = $db_suiteweb->query($query);
        $res = $db_suiteweb->result($rec);

        $dir_sito = '';
        $dir_tmp  = '';
        $tot      = '';
        $select   = '';

        foreach($res as $k => $v){
            $select    = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = ".$v['idsito'];
            $result    = $db->query($select);
            $check_rec = $db->result($result);
            if(sizeof($check_rec) == 0){
                $insert              = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".$v['idsito']."','custom1','Family','1')";
                $ins                 = $db->query($insert);
                $IdTipoGalleryFamily = $db->insert_id($ins);
                $insertF             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFamily."','family1.jpg','1')";
                $db->query($insertF);
                $insertF2             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFamily."','family2.jpg','1')";
                $db->query($insertF2);
                $insertF3             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFamily."','family3.jpg','1')";
                $db->query($insertF3);
        
        
                $insert2           = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".$v['idsito']."','custom2','Bike','1')";
                $ins2              = $db->query($insert2);
                $IdTipoGalleryBike = $db->insert_id($ins2);
                $insertB           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBike."','bike1.jpg','1')";
                $db->query($insertB);
                $insertB2           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBike."','bike2.jpg','1')";
                $db->query($insertB2);
                $insertB3           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBike."','bike3.jpg','1')";
                $db->query($insertB3);
        
                $insert3             = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".$v['idsito']."','custom3','Romantico','1')";
                $ins                 = $db->query($insert3);
                $IdTipoGalleryRomantico = $db->insert_id($ins3);
                $insertR             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryRomantico."','romantico1.jpg','1')";
                $db->query($insertR);
                $insertR2             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryRomantico."','romantico2.jpg','1')";
                $db->query($insertR2);
                $insertR3             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryRomantico."','romantico3.jpg','1')";
                $db->query($insertR3);
                // COPIA IMMAGINI DEMO
                $srcPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/demo_image/';
                $destPath =  $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/';  
        
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
            } 

                
           
        }



?>