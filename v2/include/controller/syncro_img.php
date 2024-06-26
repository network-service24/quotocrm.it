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

        // COPIA IMMAGINI DEMO
        $srcPath = $_SERVER['DOCUMENT_ROOT'].'/uploads/demo_image/';
        $destPath =  $_SERVER['DOCUMENT_ROOT'].'/uploads/'.IDSITO.'/';


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

        $content = 'salvataggio del template effettuato con successo!!';

?>