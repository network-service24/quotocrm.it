<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_panel_ext'){

                $idpannello    = $_REQUEST['id'];
                $idsito        = $_REQUEST['idsito'];
                $font_awesome  = $_REQUEST['font_awesome'];
                $ico_image     = $_REQUEST['ico_image'];
                $nome_pannello = $dbMysqli->escape($_REQUEST['nome_pannello']);
                $url           = $_REQUEST['url'];
                $campo_1       = $_REQUEST['campo_1'];
                $valore_1      = $_REQUEST['valore_1'];
                $campo_2       = $_REQUEST['campo_2'];
                $valore_2      = $_REQUEST['valore_2'];
                $campo_3       = $_REQUEST['campo_3'];
                $valore_3      = $_REQUEST['valore_3'];
                $method        = $_REQUEST['method'];
                $target        = $_REQUEST['target'];

				$update ="UPDATE hospitality_pannelli_esterni SET                                                   
														     font_awesome   = '".$font_awesome."',
                                                              ".($_REQUEST['ico_image']!=''?'ico_image ="'.$ico_image.'",':'')."
                                                             nome_pannello = '".$nome_pannello."',
                                                             url           = '".$url."',
                                                             campo_1       = '".$campo_1."',
                                                             valore_1      = '".$valore_1."',
                                                             campo_2       = '".$campo_2."',
                                                             valore_2      = '".$valore_2."',
                                                             campo_3       = '".$campo_3."',
                                                             valore_3      = '".$valore_3."',
                                                             method        = '".$method."',
                                                             target        = '".$target."'
														WHERE
                                                            idpannello =  ".$idpannello."
                                                        AND
                                                            idsito     = ".$idsito;

				$dbMysqli->query($update);



	}

?>