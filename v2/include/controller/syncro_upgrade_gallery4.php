<?php

                $query = "SELECT  siti.*
                            FROM siti
                            WHERE siti.hospitality = 1
                            AND siti.data_end_hospitality > '".date('Y-m-d')."'
                            AND siti.id_status <> 5
                            GROUP BY  siti.idsito
                            ORDER BY siti.data_start_hospitality DESC";
        $rec = $db_suiteweb->query($query);
        $res = $db_suiteweb->result($rec);

        $dir_sito = '';
        $dir_tmp  = '';
        $tot      = '';
        $select   = '';

        foreach($res as $k => $v){
            $select    = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = ".$v['idsito']." AND TargetType = 'custom4' AND (TargetGallery = 'Inverno famiglia' OR TargetGallery = 'inverno famiglia')";
            $result    = $db->query($select);
            $check_rec = $db->result($result);
            if(sizeof($check_rec) == 0){
                $insert              = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".$v['idsito']."','custom4','Inverno famiglia','1')";
                $ins                 = $db->query($insert);
                $IdTipoGalleryFInverno = $db->insert_id($ins);
                $insertI             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFInverno."','inverno-family1.jpg','1')";
                $db->query($insertI);
                $insertI2             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFInverno."','inverno-family2.jpg','1')";
                $db->query($insertI2);
                $insertI3             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFInverno."','inverno-family3.jpg','1')";
                $db->query($insertI3);
                $insertI4             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFInverno."','inverno-family1.jpg','1')";
                $db->query($insertI4);
                $insertI5             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFInverno."','inverno-family2.jpg','1')";
                $db->query($insertI5);
                $insertI6             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFInverno."','inverno-family3.jpg','1')";
                $db->query($insertI6);
                $insertI7             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFInverno."','inverno-family1.jpg','1')";
                $db->query($insertI7);
                $insertI8             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFInverno."','inverno-family2.jpg','1')";
                $db->query($insertI8);
                $insertI9             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFInverno."','inverno-family3.jpg','1')";
                $db->query($insertI9);
            }

            $select2    = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = ".$v['idsito']." AND TargetType = 'custom5'  AND (TargetGallery = 'Estate famiglia' OR TargetGallery = 'estate famiglia')";
            $result2    = $db->query($select2);
            $check_rec2 = $db->result($result2);
            if(sizeof($check_rec2) == 0){
                $insert2           = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".$v['idsito']."','custom5','Estate famiglia','1')";
                $ins2              = $db->query($insert2);
                $IdTipoGalleryFEstate = $db->insert_id($ins2);
                $insertE           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFEstate."','estate-family1.jpg','1')";
                $db->query($insertE);
                $insertE2           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFEstate."','estate-family2.jpg','1')";
                $db->query($insertE2);
                $insertE3           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFEstate."','estate-family3.jpg','1')";
                $db->query($insertE3);
                $insertE4           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFEstate."','estate-family1.jpg','1')";
                $db->query($insertE4);
                $insertE5           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFEstate."','estate-family2.jpg','1')";
                $db->query($insertE5);
                $insertE6           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFEstate."','estate-family3.jpg','1')";
                $db->query($insertE6); 
                $insertE7           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFEstate."','estate-family1.jpg','1')";
                $db->query($insertE7);
                $insertE8           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFEstate."','estate-family2.jpg','1')";
                $db->query($insertE8);
                $insertE9           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryFEstate."','estate-family3.jpg','1')";
                $db->query($insertE9);    
            }

            $select    = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = ".$v['idsito']." AND TargetType = 'custom6' AND (TargetGallery = 'Inverno sport' OR TargetGallery = 'inverno sport')";
            $result    = $db->query($select);
            $check_rec = $db->result($result);
            if(sizeof($check_rec) == 0){
                $insert              = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".$v['idsito']."','custom6','Inverno sport','1')";
                $ins                 = $db->query($insert);
                $IdTipoGalleryBInverno = $db->insert_id($ins);
                $insertI             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBInverno."','inverno-bike1.jpg','1')";
                $db->query($insertI);
                $insertI2             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBInverno."','inverno-bike2.jpg','1')";
                $db->query($insertI2);
                $insertI3             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBInverno."','inverno-bike3.jpg','1')";
                $db->query($insertI3);
                $insertI4             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBInverno."','inverno-bike1.jpg','1')";
                $db->query($insertI4);
                $insertI5             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBInverno."','inverno-bike2.jpg','1')";
                $db->query($insertI5);
                $insertI6             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBInverno."','inverno-bike3.jpg','1')";
                $db->query($insertI6);
                $insertI7             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBInverno."','inverno-bike1.jpg','1')";
                $db->query($insertI7);
                $insertI8             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBInverno."','inverno-bike2.jpg','1')";
                $db->query($insertI8);
                $insertI9             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBInverno."','inverno-bike3.jpg','1')";
                $db->query($insertI9);        
            }

            $select2    = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = ".$v['idsito']." AND TargetType = 'custom7'  AND (TargetGallery = 'Estate sport' OR TargetGallery = 'estate sport')";
            $result2    = $db->query($select2);
            $check_rec2 = $db->result($result2);
            if(sizeof($check_rec2) == 0){
                $insert2           = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".$v['idsito']."','custom7','Estate sport','1')";
                $ins2              = $db->query($insert2);
                $IdTipoGalleryBEstate = $db->insert_id($ins2);
                $insertE           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBEstate."','estate-bike1.jpg','1')";
                $db->query($insertE);
                $insertE2           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBEstate."','estate-bike2.jpg','1')";
                $db->query($insertE2);
                $insertE3           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBEstate."','estate-bike3.jpg','1')";
                $db->query($insertE3);
                $insertE4           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBEstate."','estate-bike1.jpg','1')";
                $db->query($insertE4);
                $insertE5           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBEstate."','estate-bike2.jpg','1')";
                $db->query($insertE5);
                $insertE6          = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBEstate."','estate-bike3.jpg','1')";
                $db->query($insertE6); 
                $insertE7           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBEstate."','estate-bike1.jpg','1')";
                $db->query($insertE7);
                $insertE8           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBEstate."','estate-bike2.jpg','1')";
                $db->query($insertE8);
                $insertE9           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryBEstate."','estate-bike3.jpg','1')";
                $db->query($insertE9);       
            }


            $select    = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = ".$v['idsito']." AND TargetType = 'custom8' AND (TargetGallery = 'Inverno coppie' OR TargetGallery = 'inverno coppie')";
            $result    = $db->query($select);
            $check_rec = $db->result($result);
            if(sizeof($check_rec) == 0){
                $insert              = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".$v['idsito']."','custom8','Inverno coppie','1')";
                $ins                 = $db->query($insert);
                $IdTipoGalleryRInverno = $db->insert_id($ins);
                $insertI             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryRInverno."','inverno-romantico1.jpg','1')";
                $db->query($insertI);
                $insertI2             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryRInverno."','inverno-romantico2.jpg','1')";
                $db->query($insertI2);
                $insertI3             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryRInverno."','inverno-romantico3.jpg','1')";
                $db->query($insertI3);
                $insertI4             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryRInverno."','inverno-romantico1.jpg','1')";
                $db->query($insertI4);
                $insertI5             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryRInverno."','inverno-romantico2.jpg','1')";
                $db->query($insertI5);
                $insertI6             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryRInverno."','inverno-romantico3.jpg','1')";
                $db->query($insertI6);
                $insertI7             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryRInverno."','inverno-romantico1.jpg','1')";
                $db->query($insertI7);
                $insertI8             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryRInverno."','inverno-romantico2.jpg','1')";
                $db->query($insertI8);
                $insertI9             = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryRInverno."','inverno-romantico3.jpg','1')";
                $db->query($insertI9);       
            }

            $select2    = "SELECT * FROM hospitality_tipo_gallery WHERE idsito = ".$v['idsito']." AND TargetType = 'custom9'  AND (TargetGallery = 'Estate coppie' OR TargetGallery = 'estate coppie')";
            $result2    = $db->query($select2);
            $check_rec2 = $db->result($result2);
            if(sizeof($check_rec2) == 0){
                $insert2           = "INSERT INTO hospitality_tipo_gallery (idsito,TargetType,TargetGallery,Abilitato) VALUES ('".$v['idsito']."','custom9','Estate coppie','1')";
                $ins2              = $db->query($insert2);
                $IdTipoGalleryREstate = $db->insert_id($ins2);
                $insertE           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryREstate."','estate-romantico1.jpg','1')";
                $db->query($insertE);
                $insertE2           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryREstate."','estate-romantico2.jpg','1')";
                $db->query($insertE2);
                $insertE3           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryREstate."','estate-romantico3.jpg','1')";
                $db->query($insertE3);
                $insertE4           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryREstate."','estate-romantico1.jpg','1')";
                $db->query($insertE4);
                $insertE5           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryREstate."','estate-romantico2.jpg','1')";
                $db->query($insertE5);
                $insertE6           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryREstate."','estate-romantico3.jpg','1')";
                $db->query($insertE6);
                $insertE7           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryREstate."','estate-romantico1.jpg','1')";
                $db->query($insertE7);
                $insertE8           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryREstate."','estate-romantico2.jpg','1')";
                $db->query($insertE8);
                $insertE9           = "INSERT INTO hospitality_tipo_gallery_target (idsito,IdTipoGallery,Immagine,Abilitato) VALUES ('".$v['idsito']."','".$IdTipoGalleryREstate."','estate-romantico3.jpg','1')";
                $db->query($insertE9);                       
            }




                // COPIA IMMAGINI DEMO
                $srcPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/demo_image/';
                $destPath =  $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/';  
        
                $srcDir = opendir($srcPath);
                while($readFile = readdir($srcDir))
                {
                    if($readFile == 'inverno-family1.jpg' || $readFile == 'inverno-family2.jpg' || $readFile == 'inverno-family3.jpg')
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
                    if($readFile == 'estate-family1.jpg' || $readFile == 'estate-family2.jpg' || $readFile == 'estate-family3.jpg')
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
                // FINE COPIA IMMAGINI
            

                
           
        }

        $content = 'salvataggio delle gallery per il nuovo template effettuato con successo!!';

?>