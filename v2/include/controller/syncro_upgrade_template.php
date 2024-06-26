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

               
                 $dir_tmp  = str_replace("http://","",$v['web']);
                $dir_tmp  = str_replace("www.","",$dir_tmp);
                $dir_sito = str_replace(".it","",$dir_tmp);
                $dir_sito = str_replace(".com","",$dir_sito);
                $dir_sito = str_replace(".net","",$dir_sito);
                $dir_sito = str_replace(".biz","",$dir_sito);
                $dir_sito = str_replace(".eu","",$dir_sito);
                $dir_sito = str_replace(".de","",$dir_sito);
                $dir_sito = str_replace(".es","",$dir_sito);
                $dir_sito = str_replace(".fr","",$dir_sito);

                $select = "SELECT * FROM hospitality_template_landing WHERE idsito = ".$v['idsito']."";
                $sel = $db->query($select);
                $tot = sizeof($db->result($sel));
                if($tot==0){ 
                    #background per email
                    $db->query("INSERT INTO hospitality_template_landing(idsito,Directory,Template,BackgroundCellLink) VALUES('".$v['idsito']."','".$dir_sito."','default','#EF4047')");
                    #background per template
                    $db->query("INSERT INTO hospitality_template_background(idsito,TemplateName,Thumb,Background) VALUES('".$v['idsito']."','default','thumb-default.png','#EF4047')");
                    #background, topimage, bg_image,font e pulsnate per template
                    $db->query("INSERT INTO hospitality_template_background(idsito,TemplateName,Thumb,Font,Background,Pulsante,Immagine,Immagine2) VALUES('".$v['idsito']."','smart','thumb-smart.png','\'Montserrat\', sans-serif','#8A1702','#CA9822','top_image.jpg','bg_image.jpg')");
                    #colori per new template
                     $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#8A1702','#CA9822')");
                    $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#000001','#FFA317')");
                    $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#329FC3','#CFCD32')");
                    $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#000000','#A6875D')");
                    $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#424242','#004C66')");
                    $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#105583','#DC3B60')");
                    $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#643D43','#CF6F55')");
                    $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#003366','#FF4000')");
                    $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#663300','#FFBF00')");
                    $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#400000','#242415')");
                    $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#1D6066','#A8672E')");
                    $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#A8342E','#248230')");
                    $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#FF4000','#003366')");
                    $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#CA9822','#8A1702')");
                    $db->query("INSERT INTO hospitality_template_colori(idsito,Background,Pulsante) VALUES('".$v['idsito']."','#85255D','#789D2B')");   


             

                    // COPIA IMMAGINI DEMO
                     $srcPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/demo_image/';
                    $destPath =  $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$v['idsito'].'/';  

                    $srcDir = opendir($srcPath);
                    while($readFile = readdir($srcDir))
                    {
                        if($readFile == 'top_image.jpg' || $readFile == 'bg_image.jpg')
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