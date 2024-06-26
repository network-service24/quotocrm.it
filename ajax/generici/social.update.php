<?php

/**
 * CRM and CMS
 * @author Marcello Visigalli <a marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$idsito                                                 = $_REQUEST['idsito'];
$BookingOnline                                          = $_REQUEST['BookingOnline'];
$Tripadvisor                                            = $_REQUEST['Tripadvisor'];
$Facebook                                               = $_REQUEST['Facebook'];
$Twitter                                                = $_REQUEST['Twitter'];
$Instagram                                              = $_REQUEST['Instagram'];
$Linkedin                                               = $_REQUEST['Linkedin'];
$Pinterest                                              = $_REQUEST['Pinterest'];

	$update = " UPDATE 
                    hospitality_social 
                SET 
                    BookingOnline = '".$BookingOnline."',
                    Tripadvisor   = '".$Tripadvisor."',
                    Facebook      = '".$Facebook."',
                    Twitter       = '".$Twitter."',
                    Instagram     = '".$Instagram."',
                    Linkedin      = '".$Linkedin."',
                    Pinterest     = '".$Pinterest."'
                WHERE 
                    idsito = ".$idsito;
	$dbMysqli->query($update);


?>