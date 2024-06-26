<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

error_reporting(0); 

$Phone = $_REQUEST['Phone'];

$valid_number = filter_var($Phone, FILTER_SANITIZE_NUMBER_INT);

$CheckPhone = $fun->validating($valid_number);

echo $CheckPhone;

?>