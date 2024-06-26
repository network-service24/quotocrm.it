<?php
/*
## scrivendo dentro il campo EMAIL, si attiva la chiamata che controlla in tempo reale
## il record MX della casella, se il dominio email digitata è ESISTENTE (reale) oppure INVALID (inesistente)
## MARCELLO IL 26/04/2018
## MODIFICA RELEASE DEL 14/07/2020
 */
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

error_reporting(0); 

$EmailCliente = $_REQUEST['EmailCliente'];

$Controllo = verifyEmail($EmailCliente);

echo $Controllo;

?>