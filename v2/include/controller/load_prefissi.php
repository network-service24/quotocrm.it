<?php

$file = BASE_PATH_SITO . "prefissi.csv";

$query = "
              LOAD DATA LOCAL INFILE '" . $file . "'
              INTO TABLE prefissi
              FIELDS TERMINATED BY ','
              LINES TERMINATED BY '\n'
              IGNORE 1 LINES
              (nazione,prefisso)";

              $db->query($query);

?>