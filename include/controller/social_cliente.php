<?php
$select = "SELECT * FROM hospitality_social WHERE idsito =".$_REQUEST['azione'];
$res = $dbMysqli->query($select);
$rws = $res[0];
$tot = sizeof($res);
if($tot == 0){
    $insert = "INSERT INTO hospitality_social(idsito) VALUES('".$_REQUEST['azione']."')";
    $qy = $dbMysqli->query($insert);
    $_SESSION['idsocial'] = $dbMysqli->getInsertId($qy);
}else{
    $_SESSION['idsocial'] = $rws['idsocial'];
}

$select = "SELECT * FROM hospitality_social WHERE idsito = ".IDSITO;
$result = $dbMysqli->query($select);
$record = $result[0];

$BookingOnline                                          = $record['BookingOnline'];
$Tripadvisor                                            = $record['Tripadvisor'];
$Facebook                                               = $record['Facebook'];
$Twitter                                                = $record['Twitter'];
$Instagram                                              = $record['Instagram'];
$Linkedin                                               = $record['Linkedin'];
$Pinterest                                              = $record['Pinterest'];

$content .= '<form method="POST" name="form_social" id="form_social">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="row">
                        <div class="col-md-1 text-right"><i class="fa fa-calendar fa-2x fa-fw"></i></div>
                        <div class="col-md-2">
                            <label class="f-w-600">Boooking OnLine</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text"  value="'.$BookingOnline.'" name="BookingOnline" />
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-md-1 text-right"><i class="fa fa-tripadvisor fa-2x fa-fw"></i></div>
                        <div class="col-md-2">
                            <label class="f-w-600">TripAdvisor</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text"  value="'.$Tripadvisor.'" name="Tripadvisor"   />
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-md-1 text-right"><i class="fa fa-facebook fa-2x fa-fw"></i></div>
                        <div class="col-md-2">
                            <label class="f-w-600">Facebook</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text"  value="'.$Facebook .'" name="Facebook"   />
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-md-1 text-right"><i class="fa fa-twitter fa-2x fa-fw"></i></div>
                        <div class="col-md-2">
                            <label class="f-w-600">Twitter</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text"  value="'.$Twitter .'" name="Twitter"   />
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-md-1 text-right"><i class="fa fa-instagram fa-2x fa-fw"></i></div>
                        <div class="col-md-2">
                            <label class="f-w-600">Instagram</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text"  value="'.$Instagram.'" name="Instagram"   />
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-md-1 text-right"><i class="fa fa-linkedin fa-2x fa-fw"></i></div>
                        <div class="col-md-2">
                            <label class="f-w-600">Linkedin</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text"  value="'.$Linkedin.'" name="Linkedin"   />
                        </div>
                    </div>
                    <div class="row m-t-10">
                        <div class="col-md-1 text-right"><i class="fa fa-pinterest fa-2x fa-fw"></i></div>
                        <div class="col-md-2">
                            <label class="f-w-600">Pinterest</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text"  value="'.$Pinterest.'" name="Pinterest"   />
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-9">
                            <input type="hidden" name="idsito" id="idsito" value="'.IDSITO.'">
                            <button type="submit" class="btn btn-primary" >Salva</button>
                        </div>
                    </div>
                    <div id="res"></div>
                </div>
                <div class="col-md-2"></div>
            </div> 
        </form>           
        <script>
                $(document).ready(function(){
                    $("#form_social").submit(function(){
                        var dati = $("#form_social").serialize();
                            $.ajax({
                                url: "'.BASE_URL_SITO.'ajax/generici/social.update.php",
                                type: "POST",
                                data: dati,
                                success: function(msg){  
                                    $("#res").html(\'<div class="clearfix p-b-30"></div><div class="alert alert-info"><p>Collegamenti Social salvati con successo!</p></div>\');
                                    setTimeout(function(){ 
                                        $("#res").hide(); 
                                    }, 2000);
                                },
                                error: function(){
                                    alert("Chiamata fallita, si prega di riprovare...");
                                }
                            });
                            return false; // con false senza refresh della pagina
                    });
                });
            </script> 
            <div class="clearfix p-b-30"></div>'."\r\n";
