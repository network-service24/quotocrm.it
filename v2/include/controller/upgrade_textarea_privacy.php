<?php



                $select = "SELECT * FROM hospitality_dizionario WHERE etichetta = 'INFORMATIVA_PRIVACY'";
                $sel = $db->query($select);
                $tot = $db->result($sel);
                if(sizeof($tot)>0){
                        foreach($tot as $k => $v){
                            #background per email
                         $up = "UPDATE hospitality_dizionario_lingua SET textarea = 1 WHERE id_dizionario =".$v['id'];
                         $db->query($up);
                            #background per template


                        }
                   
                }



?>