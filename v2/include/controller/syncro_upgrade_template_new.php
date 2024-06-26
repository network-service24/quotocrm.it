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

               


                    #background, topimage, bg_image,font e pulsnate per template
                    $db->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Immagine2) VALUES('".$v['idsito']."','custom1','family','thumb-family.png','\'Montserrat\', sans-serif','#FF4000','#003366','top_image_family.jpg','bg_image_family.jpg')");
                    $db->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Immagine2) VALUES('".$v['idsito']."','custom2','bike','thumb-bike.png','\'Montserrat\', sans-serif','#424242','#004C66','top_image_bike.jpg','bg_image_bike.jpg')");
                    $db->query("INSERT INTO hospitality_template_background(idsito,TemplateType,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Immagine2) VALUES('".$v['idsito']."','custom3','romantico','thumb-romantico.png','\'Montserrat\', sans-serif','#CA9822','#8A1702','top_image_romantico.jpg','bg_image_romantico.jpg')");
            
                      

                    // COPIA IMMAGINI DEMO
                    $srcPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/demo_image/';
                    $destPath =  $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/';  

                    $srcDir = opendir($srcPath);
                    while($readFile = readdir($srcDir))
                    {
                        if($readFile == 'top_image_family.jpg' || $readFile == 'bg_image_family.jpg')
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
                        if($readFile == 'top_image_bike.jpg' || $readFile == 'bg_image_bike.jpg')
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
                        if($readFile == 'top_image_romantico.jpg' || $readFile == 'bg_image_romantico.jpg')
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



?>