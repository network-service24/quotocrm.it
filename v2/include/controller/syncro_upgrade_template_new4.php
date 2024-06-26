<?php

                $query = "SELECT  siti.*
                            FROM siti
                            WHERE siti.hospitality = 1
                            AND siti.data_end_hospitality > '".date('Y-m-d')."'
                            AND siti.id_status <> 5
                            GROUP BY  siti.idsito
                            ORDER BY siti.data_start_hospitality DESC";
        $rec = $db->query($query);
        $res = $db->result($rec);

        $dir_sito = '';
        $dir_tmp  = '';
        $tot      = '';
        $select   = '';

        foreach($res as $k => $v){

               
            $select    = "SELECT * FROM hospitality_template_background WHERE idsito = ".$v['idsito']." AND TemplateType = 'custom4' AND (TemplateName = 'Inverno famiglia' OR TemplateName = 'inverno famiglia')";
            $result    = $db->query($select);
            $check_rec = $db->result($result);
            if(sizeof($check_rec) == 0){
                #background, topimage, bg_image,font e pulsnate per template
                $db->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Video) VALUES('".$v['idsito']."','custom4','inverno famiglia','thumb-inverno-family.png','\'Montserrat\', sans-serif','#FF4000','#003366','top_image_inverno-family.jpg','')");
            }     
            $select2    = "SELECT * FROM hospitality_template_background WHERE idsito = ".$v['idsito']." AND TemplateType = 'custom5' AND (TemplateName = 'Estate famiglia' OR TemplateName = 'estate famiglia')";
            $result2    = $db->query($select2);
            $check_rec2 = $db->result($result2);
            if(sizeof($check_rec2) == 0){               
                    $db->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Video) VALUES('".$v['idsito']."','custom5','estate famiglia','thumb-estate-family.png','\'Montserrat\', sans-serif','#424242','#004C66','top_image_estate-family.jpg','')");
            }      
            
            $select3    = "SELECT * FROM hospitality_template_background WHERE idsito = ".$v['idsito']." AND TemplateType = 'custom6' AND (TemplateName = 'Inverno sport' OR TemplateName = 'inverno sport')";
            $result3    = $db->query($select3);
            $check_rec3 = $db->result($result3);
            if(sizeof($check_rec3) == 0){
                #background, topimage, bg_image,font e pulsnate per template
                $db->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Video) VALUES('".$v['idsito']."','custom6','inverno sport','thumb-inverno-bike.png','\'Montserrat\', sans-serif','#FF4000','#003366','top_image_inverno-bike.jpg','')");
            }     
            $select4    = "SELECT * FROM hospitality_template_background WHERE idsito = ".$v['idsito']." AND TemplateType = 'custom7' AND (TemplateName = 'Estate sport' OR TemplateName = 'estate sport')";
            $result4    = $db->query($select4);
            $check_rec4 = $db->result($result4);
            if(sizeof($check_rec4) == 0){               
                    $db->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Video) VALUES('".$v['idsito']."','custom7','estate sport','thumb-estate-bike.png','\'Montserrat\', sans-serif','#424242','#004C66','top_image_estate-bike.jpg','')");
            }   
            
            
            $select5    = "SELECT * FROM hospitality_template_background WHERE idsito = ".$v['idsito']." AND TemplateType = 'custom8' AND (TemplateName = 'Inverno coppie' OR TemplateName = 'inverno coppie')";
            $result5    = $db->query($select5);
            $check_rec5 = $db->result($result5);
            if(sizeof($check_rec5) == 0){
                #background, topimage, bg_image,font e pulsnate per template
                $db->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Video) VALUES('".$v['idsito']."','custom8','inverno coppie','thumb-inverno-romantico.png','\'Montserrat\', sans-serif','#FF4000','#003366','top_image_inverno-romantico.jpg','')");
            }     
            $select6    = "SELECT * FROM hospitality_template_background WHERE idsito = ".$v['idsito']." AND TemplateType = 'custom9' AND (TemplateName = 'Estate coppie' OR TemplateName = 'estate coppie')";
            $result6    = $db->query($select6);
            $check_rec6 = $db->result($result6);
            if(sizeof($check_rec6) == 0){               
                    $db->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Video) VALUES('".$v['idsito']."','custom9','estate coppie','thumb-estate-romantico.png','\'Montserrat\', sans-serif','#424242','#004C66','top_image_estate-romantico.jpg','')");
            }               

                    // COPIA IMMAGINI DEMO
                     $srcPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/demo_image/';
                    $destPath =  $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/';  

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


                
           
        }

        $content = 'salvataggio del template effettuato con successo!!';

?>