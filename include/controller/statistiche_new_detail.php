<?php
setlocale(LC_ALL, 'it_IT'); // serve per usare i nomi dei mesi in italiano
$MOMENT_DATE_FORMAT = '%d %b %Y';

// Viene fatto tutto con chiamate AJAX

// preparo i valori di default
$method = !empty($_GET['method']) ? $_GET['method'] : '';
$startDate = !empty($_GET['startDate']) ? $_GET['startDate'] : strftime($MOMENT_DATE_FORMAT, strtotime("-30 days"));
$endDate = !empty($_GET['endDate']) ? $_GET['endDate'] : strftime($MOMENT_DATE_FORMAT, strtotime("-1 days"));
$compare = !empty($_GET['compare']) ? $_GET['compare'] : 'false';
$compareStartDate = !empty($_GET['compareStartDate']) ? $_GET['compareStartDate'] : strftime($MOMENT_DATE_FORMAT);
$compareEndDate = !empty($_GET['compareEndDate']) ? $_GET['compareEndDate'] : strftime($MOMENT_DATE_FORMAT);

// ricompongo il link per tornare indietro
$link_breadcrumb = $_SERVER['REQUEST_URI'];
$link_breadcrumb = str_replace("grafici-statistiche_new_detail","grafici-statistiche_new",$link_breadcrumb);