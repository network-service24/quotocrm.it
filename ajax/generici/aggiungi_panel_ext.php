<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_panel_ext'){

			$idsito        = $_REQUEST['idsito'];
			$font_awesome  = $_REQUEST['font_awesome'];
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

            $insert ="INSERT INTO hospitality_pannelli_esterni
                                                        (idsito,
                                                        font_awesome,
                                                        nome_pannello,
                                                        url,
                                                        campo_1,
                                                        valore_1,
                                                        campo_2,
                                                        valore_2,
                                                        campo_3,
                                                        valore_3,
                                                        method,
                                                        target)  
                                                    VALUES (
                                                            '".$idsito."',
                                                            '".$font_awesome."',
                                                            '".$nome_pannello."',
                                                            '".$url."',
                                                            '".$campo_1."',
                                                            '".$valore_1."',
                                                            '".$campo_2."',
                                                            '".$valore_2."',
                                                            '".$campo_3."',
                                                            '".$valore_3."',
                                                            '".$method."',
                                                            '".$target."'
                                                            )";
            $dbMysqli->query($insert);

	}

?>