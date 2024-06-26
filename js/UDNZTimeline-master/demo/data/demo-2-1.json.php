<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
error_reporting(0); 
 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysql_connect($host, $username, $password) or die ("Errore connesione database suiteweb");
mysql_select_db($dbname);

$idprogetto = $_REQUEST['idprogetto'];

$select = " SELECT  * FROM  pms_progetti  WHERE pms_progetti.id = ".$idprogetto."";

$result = mysql_query($select);
$record = mysql_fetch_assoc($result);

echo'{
    "nodes": [{
            "nodeId": "node_1",
            "title": "Inzio",
            "date": "'.$record['data_inizio'].'",
            "percent": 0,
            "description": "Questo è l\'inizio del progetto ('.$record['data_inizio'].')",
            "nodes": [{
                "nodeId": "node_1_1",
                "title": "Day 1",
                "date": "2001/09/01 00:00:00",
                "offsetY": "up",
                "percent": 15,
                "description": "Brach from the first node."
            }]
        },
        {
            "nodeId": "node_2",
            "title": "<span style=\'color: red;\'>Day 2</span>",
            "date": "2005/07/01 00:00:00",
            "percent": 20,
            "description": "<img src=\'images/coreplex.jpg\' width=\'260\' height=\'146\' vspace=\'5\' border=\'0\' />",
            "nodes": [
                [{
                    "nodeId": "node_2_brach_0",
                    "title": "Someday",
                    "date": "2001/09/01 00:00:00",
                    "percent": 35,
                    "offsetY": -60,
                    "description": "Haha, I am traveling..."
                }],
                [{
                    "nodeId": "node_2_1",
                    "title": "Day 3",
                    "date": "2001/09/01 00:00:00",
                    "percent": 30,
                    "description": "This is another branch..."
                }, {
                    "nodeId": "node_2_2",
                    "title": "Day 4",
                    "date": "2001/09/01 00:00:00",
                    "percent": 35,
                    "description": "And more nodes..."
                }, {
                    "nodeId": "node_2_3",
                    "title": "Day 5",
                    "date": "2001/09/01 00:00:00",
                    "percent": 45,
                    "description": "With more nodes...",
                    "nodes": [{
                        "nodeId": "node_2_3_1",
                        "title": "Day 6",
                        "date": "2001/09/01 00:00:00",
                        "percent": 60,
                        "offsetY": 100,
                        "description": "This is another branch."
                    }, {
                        "nodeId": "node_2_3_2",
                        "title": "Day 7",
                        "date": "2001/09/01 00:00:00",
                        "percent": 70,
                        "description": "With more nodes..."
                    }]
                }, {
                    "nodeId": "node_2_4",
                    "title": "Day 8",
                    "date": "2001/09/01 00:00:00",
                    "percent": 85,
                    "description": "With more nodes..."
                }]
            ],
            "board": {
                "width": 280
            }
        },
        {
            "nodeId": "node_998",
            "title": "Day 10",
            "date": "2012/12/20 00:00:00",
            "percent": 80,
            "description": "...",
            "nodes": [{
                "nodeId": "node_10_1",
                "title": "I am from another universe!",
                "date": "2001/09/01 00:00:00",
                "percent": 65,
                "offsetY": -60,
                "description": "Time machine, LOL!",
                "show": true
            }]
        },
        {
            "nodeId": "node_999",
            "title": "Future",
            "date": "2012/12/20 00:00:00",
            "percent": 95,
            "description": "The last node of the time-line. The detail board will be on the left of mouse.",
            "lines": {
                "type": "dotted",
                "stroke_dasharray": "20, 10"
            }
        }
    ]
}'."\r\n";
?>