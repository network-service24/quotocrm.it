<?php 
header('Content-type: text/css');
$BackgroundEmail    = '#'.$_REQUEST['BackgroundEmail'];
$BackgroundCellData = '#'.$_REQUEST['BackgroundCellData'];
$BackgroundCellLink = '#'.$_REQUEST['BackgroundCellLink'];
echo'.testo{
        font-family:Georgia, serif;
        font-size: 18px;
        color: #5E5E5E;
    }
    .testo_big{
        font-family:Georgia, serif;
        font-size: 24px;
        color: #5E5E5E;
        font-style: italic!important;
    }                                    
    .testo_footer{
        font-family: Arial;
        font-style:italic;
        font-size: 11px;
        color: #5E5E5E;
    }                                    
    .bgcolor-white{
        background-color: #FFFFFF;
        border:1px solid #D0D0D0;
    }  
    .bgcolor-b{
        background-color:#DBD7D8;
        color:#5E5E5E;
        font-family:Georgia, serif;
        font-size: 18px;
    }  
    .bgcolor_beige{
         background-color: #EBEBEB;
    }                                                      
    .paddingXX{
        padding: 40px;
    } 
    .paddingYY{
        padding: 20px;
    } 
    .paddingXY{
        padding-left: 40px;
        padding-right: 40px;
        padding-top: 20px;
        padding-bottom: 20px;
    } 
    .cell-data{
        width:100%!important;
        height:120px!important;
        background-color:'.$BackgroundCellData.'!important;
        color:#706E6F!important;
        font-size: 24px!important;
        font-style: italic!important;
        
    }  
     .cell-link{
        padding: 20px;
        width:50%;
        background-color:'.$BackgroundCellLink.'!important;
        color:#FFFFFF;
        font-family:Georgia, serif;
        font-size: 20px;
    } 
    .big_white{
        color:#FFFFFF;
        font-family:Georgia, serif;
        font-size: 28px;
        font-weight:bold;
    } 
    .small_white{
        color:#FFFFFF;
        font-family:Georgia, serif;
        font-size: 18px;
        font-weight:normal;
    }                                     
    .red{
        color:#EF4047;
    }
    hr{
        border-top:1px solid #FFFFFF;
        background-color:#FFFFFF;
    }
    .paddingTOP{
        padding: 10px;
    } 
    /*  
    a:link { color: #FFFFFF; text-decoration:none}
    a:visited { color: #FFFFFF; text-decoration:none}
    a:hover {  color: #D0D0D0; text-decoration:none} 
    */

.mini{
        width:100%!important;

}
.misura_tabella{
    width:50%!important;
}

/* 
a:link { color: #FFFFFF; text-decoration:none}
a:visited { color: #FFFFFF; text-decoration:none}
a:hover {  color: #D0D0D0; text-decoration:none} 
*/

@media (max-width: 768px) { 
    .testo{
        font-family:Georgia, serif;
        font-size: 14px;
        color: #5E5E5E;
    }
    .testo_big{
        font-family:Georgia, serif;
        font-size: 18px;
        color: #5E5E5E;
        font-style: italic!important;
    }
    .big_white{
        color:#FFFFFF;
        font-family:Georgia, serif;
        font-size: 20px;
        font-weight:bold;
    }  

     .small_white{
        color:#FFFFFF;
        font-family:Georgia, serif;
        font-size: 14px;
        font-weight:normal;
    }  

    .paddingXX{
        padding: 20px;
    } 
    .paddingYY{
        padding: 10px;
    } 
    .paddingXY{
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 10px;
        padding-bottom: 10px;
    } 
    .cell-data{
        width:100%!important;
        height:auto!important;
        background-color:'.$BackgroundCellData.'!important;
        color:#706E6F!important;
        font-size: 14px!important;
        font-style: italic!important;
        text-align:center!important;
        
    } 
    .text-right{
        text-align:center!important;
    } 
     .cell-link{
        padding: 10px;
        width:50%;
        background-color:'.$BackgroundCellLink.'!important;
        color:#FFFFFF;
        font-family:Georgia, serif;
        font-size: 16px;
    } 

    .fa-3x {
        font-size: 2em!important;
    }
    .fa-4x {
        font-size: 2em!important;
    }

    #data-richiesta{
        display:none!important;
    }
    .alert {
        padding:5px 5px 0px 5px!important;
    }
    .img-responsive {
        max-width: 60%!important;
        height: auto!important;
        margin-bottom:10px!important;
    }
    .mini{
        width:100%!important;

    }
    .misura_tabella{
        width:100%!important;
    }

}                                     

@media (max-width: 992px) {

    .testo{
        font-family:Georgia, serif;
        font-size: 16px;
        color: #5E5E5E;
    }
    .testo_big{
        font-family:Georgia, serif;
        font-size: 20px;
        color: #5E5E5E;
        font-style: italic!important;
    }
    .big_white{
        color:#FFFFFF;
        font-family:Georgia, serif;
        font-size: 22px;
        font-weight:bold;
    }  

     .small_white{
        color:#FFFFFF;
        font-family:Georgia, serif;
        font-size: 16px;
        font-weight:normal;
    }  

    .paddingXX{
        padding: 30px;
    } 
    .paddingYY{
        padding: 15px;
    } 
    .paddingXY{
        padding-left: 30px;
        padding-right: 30px;
        padding-top: 15px;
        padding-bottom: 15px;
    } 
    .cell-data{
        width:100%!important;
        height:auto!important;
        background-color:'.$BackgroundCellData.'!important;
        color:#706E6F!important;
        font-size: 16px!important;
        font-style: italic!important;
        text-align:center!important;
        
    } 
    .text-right{
        text-align:center!important;
    } 
     .cell-link{
        padding: 15px;
        width:50%;
        background-color:'.$BackgroundCellLink.'!important;
        color:#FFFFFF;
        font-family:Georgia, serif;
        font-size: 18px;
    } 

    .fa-3x {
        font-size: 2em!important;
    }
    .fa-4x {
        font-size: 2em!important;
    }
    #data-richiesta{
        display:none!important;
    }
    .alert {
        padding:10px 10px 0px 10px!important;
    }
    .img-responsive {
        max-width: 100%!important;
        margin-bottom:10px!important;
    }
    .right-float{
        position:relative!important;
        max-width:90%!important;
        margin: 0 auto;

    }
    .misura_tabella{
        width:90%!important;
    }

 }'."\r\n"; 
?>