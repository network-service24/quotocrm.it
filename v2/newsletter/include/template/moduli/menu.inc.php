<div class="col-md-2">
<a href="<?=BASE_URL_SITO?>newsletter/<?=URL_CLIENT_EMAIL?>-crea/" class="btn btn-danger m-b-20 p-10 btn-block waves-effect waves-light"><i class="fa fa-send"></i> &nbsp;&nbsp;Componi e-mail</a><br>
    <ul class="list-group list-group-full">
    <li class="list-group-item <?=$GLOBALS['ActiveMenu']['index']?>">
        <a href="<?=BASE_URL_SITO?>newsletter/<?=URL_CLIENT_EMAIL?>-index/" class="newsletter"><i class="fa fa-users"></i>&nbsp;&nbsp;Lista Utenti</a>
        <label class="badge bg-maroon ml-auto pointer" data-toogle="tooltip" title="Iscritti attivi"><?=count_iscritti(IDSITO)?></label>
    </li>
    <li class="list-group-item <?=$GLOBALS['ActiveMenu']['modello']?>">
        <a href="<?=BASE_URL_SITO?>newsletter/<?=URL_CLIENT_EMAIL?>-modello/" class="newsletter"> <i class="fa fa-star"></i> &nbsp;&nbsp;Crea Modello E-mail</a>
    </li>
    <li class="list-group-item <?=$GLOBALS['ActiveMenu']['visualizza_modelli']?>"> 
        <a href="<?=BASE_URL_SITO?>newsletter/<?=URL_CLIENT_EMAIL?>-visualizza_modelli/" class="newsletter"><i class="fa fa-windows"></i> &nbsp;&nbsp;Visualizza Modello </a>
        <label class="badge bg-green ml-auto pointer" data-toogle="tooltip" title="Nr. template creati"><?=count_template(IDSITO)?></label>
    </li>
    <li class="list-group-item <?=$GLOBALS['ActiveMenu']['stats_newsletter']?>">
        <a href="<?=BASE_URL_SITO?>newsletter/<?=URL_CLIENT_EMAIL?>-stats_newsletter/" class="newsletter"> <i class="fa fa-line-chart"></i> &nbsp;&nbsp;Statistiche <?=NOME_CLIENT_EMAIL?></a>
    </li>
    </ul>
    <h3 class="card-title m-t-40">Liste <small><small>(clicca sul nome per modifcare)</small></small></h3>
    <div class="list-group b-0 mail-list"> 
        <ul class="list-group list-group-full">
        <?
                $query_generale  = "SELECT * FROM mailing_newsletter_nome_liste	WHERE idsito = ".IDSITO." ORDER BY nome_lista DESC";  
                $risultato        = $db->query($query_generale);
                $arr_rec          = $db->result($risultato);

                $color_circle  = ''; 
                if(sizeof($arr_rec)>0){
                
                    
                    foreach($arr_rec as $key => $row){

                            $lista .= '<option value="'.$row['id'].'">'.$row['nome_lista'].'</option>';
             
 

                            switch($key){
                                case '0':
                                    $color_circle = 'text-warning';
                                break;
                                case '1':
                                    $color_circle = 'text-purple';
                                break;
                                case '2':
                                    $color_circle = 'text-danger';
                                break;
                                case '3':
                                    $color_circle = 'text-primary';
                                break;
                                case '4':
                                    $color_circle = 'text-purple';
                                break;
                                default:
                                    $color_circle = 'text-success';
                                break;

                            }
                            echo '<div id="risultato_lista" class="text-green"></div>';
                            echo '<li class="list-group-item"><i class="fa fa-circle '.$color_circle .'"></i>&nbsp;&nbsp;<input type="text" id="nomelista'.$row['id'].'"  name="nome_lista" style="width:105px!important;font-size:11px!important" class="no-border" value="'.ucfirst($row['nome_lista']).'" required />
                                    <label class="badge bg-orange ml-auto pointer" data-toogle="tooltip" title="Iscritti attivi a questa lista">'.count_iscritti(IDSITO,$row['id']).'</label>&nbsp;';
                        if(sizeof($arr_rec)>1){
                            echo '<label class="badge bg-red ml-auto pointer" id="lista'.$row['id'].'" data-toogle="tooltip" title="Elimina lista"><i class="fa fa-remove"></i></label>&nbsp;';
                        }
                            echo '<label class="badge bg-green ml-auto pointer" id="savelista'.$row['id'].'" data-toogle="tooltip" title="Salva lista" style="display:none"><i class="fa fa-save"></i></label>&nbsp;</li>
                                    <script>
                                        $(document).ready(function () {
                                            $(\'#nomelista'.$row['id'].'\').on("focus keyup select", function(){
                                                if($(\'#savelista'.$row['id'].'\').attr("style","display:none")){
                                                    $(\'#savelista'.$row['id'].'\').attr("style","display:block");
                                                }else{
                                                    $(\'#savelista'.$row['id'].'\').attr("style","display:none");
                                                }
                                            });
                                            $(\'#savelista'.$row['id'].'\').on("click", function(){
                                                var idsito    = '.IDSITO.';
                                                var idlista   = '.$row['id'].';
                                                var nomelista = $(\'#nomelista'.$row['id'].'\').val();
                                                    $.ajax({        
                                                        type: "POST",         
                                                        url: "'.BASE_URL_SITO.'ajax/modif_lista_newsletter.php",        
                                                        data: "idsito=" + idsito + "&idlista=" + idlista + "&nomelista=" + nomelista,
                                                        dataType: "html",        
                                                        success: function(data){										
                                                            $("#risultato_lista").html("l nome lista è stato salvato!");
                                                            setTimeout(function(){
                                                                $("#risultato_lista").fadeOut("slow");
                                                                $(\'#savelista'.$row['id'].'\').attr("style","display:none");
                                                              }, 2000);                                                                    
                                                        },
                                                        error: function(){
                                                            alert("Chiamata fallita, si prega di riprovare..."); 
                                                        }
                                                    });
                                            });                                           
                                            $(\'#lista'.$row['id'].'\').on("click", function(){
                                                var idsito  = '.IDSITO.';
                                                var idlista = '.$row['id'].';
                                                if (window.confirm("ATTENZIONE: Sicuro di eliminare?\r\nLa cancellazione di una lista determina l\'eliminazione di tutti i suoi iscritti!!")) {
                                                    $.ajax({        
                                                        type: "POST",         
                                                        url: "'.BASE_URL_SITO.'ajax/delete_lista_newsletter.php",        
                                                        data: "idsito=" + idsito + "&idlista=" + idlista,
                                                        dataType: "html",        
                                                        success: function(data){
                                                            location.reload("'.$_SERVER['REQUEST_URI'].'");												
                                                            console.log(data);
                                                        },
                                                        error: function(){
                                                            alert("Chiamata fallita, si prega di riprovare..."); 
                                                        }
                                                    });
                                                }
                                            });
                                        });
								</script>';
                        }
                }else{
                    echo '<li class="list-group-item"><a href="javascript:;" class="newsletter"><i class="fa fa-circle text-danger"></i>&nbsp;&nbsp; Nessuna lista inserita</a></li>';
                }
        ?>
        </ul>
        <div class="alert alert-profila alert-default-profila alert-dismissable">
                <button class="close" data-widget="remove"><i class="fa fa-times" aria-hidden="true"></i></button>
                <i class="fa fa-warning text-orange" aria-hidden="true"></i>
                  <smalL>  
                  <b>ATTENZIONE:</b><br>
                    In base alla nuova GDPR,<br> 
                    per ongi utente potete modificare il <b>Consenso all'invio di materiale Marketing</b>, cliccando sull'icona
                    <i class="fa fa-times-circle text-red" aria-hidden="true"></i> / <i class="fa fa-check-circle text-green" aria-hidden="true"></i> caricandovi però di ogni responsabilità ad essa collegata, liberando così Network Service s.r.l. da ogni onere ed obbligo!<br>                           
                    <br><br>
                    L'invio dell'email in <?=NOME_CLIENT_EMAIL?>, avverrà solo per l'utente che avrà accettato il <b>"Consenso .... marketing"</b>  <i class="fa fa-check-circle text-green" aria-hidden="true"></i> !!
                </small>
            </div>
    </div>
</div>