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

function random_file_name( $real_file_name ) {
     $name_parts = explode( ".", $real_file_name );
     $ext = "";
     if ( count( $name_parts ) > 0 ) {
          $ext = $name_parts[count( $name_parts ) - 1];
     }
     
     return substr(md5(uniqid(rand(),1)), -16) . "." . $ext;
}

 if(isset($_FILES['file_img']['name'])){


    $filename = random_file_name($_FILES['file_img']['name']);
 

    $location = BASE_PATH_SITO."uploads/".$_REQUEST['idsito']."/".$filename;
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);
 

    $valid_extensions = array("jpg","png","gif","jpeg");
 
    $response = 0;

    if(in_array(strtolower($imageFileType), $valid_extensions)) {

       if(move_uploaded_file($_FILES['file_img']['tmp_name'],$location)){
          $response = $location;
       }
    }
    echo $filename;

} 


?>