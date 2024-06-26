                      <div id="pulsanti_dimensioni" <?=($_SERVER['REQUEST_URI']=='/v2/conferme/' || $_SERVER['REQUEST_URI']=='/v2/archivio/'?'style="height:40px;width:30%;float:right;"':'')?>></div>                  
                       <script>
                              $(document).ready(function() {

                                    $('<button id="plus" data-toggle="tooltip" title="Aumenta lo spazio di visualizzazione  tra le celle (MAX: 8)"  type="button" class="btn btn-sm bg-maroon pull-right" style="margin:2px"><i class="fa fa-plus"></i></button><button id="minus" data-toggle="tooltip" title="Diminuisci lo spazio di visualizzazione tra le celle (MIN: 3)" type="button" class="btn btn-sm bg-maroon pull-right" style="margin:2px"><i class="fa fa-minus"></i></button>').appendTo('#pulsanti_dimensioni');

                                    $('#plus').click(function(e){
                                       e.preventDefault();
                                       var dimensioneAttuale = $('.table>tbody>tr>td').css("padding");
                                       var dimensioneModificata = parseFloat(dimensioneAttuale)
                                       var nuovaDimensione = dimensioneModificata + 1;
                                       if(dimensioneModificata>=8){return}
                                       $('.table>tbody>tr>td').css({"padding": nuovaDimensione});
                                        $.ajax({
                                          url: "<?=BASE_URL_SITO?>ajax/minus_plus.php",
                                          type: "POST",
                                          data: "idsito=<?=IDSITO?>&nuovaDimensione="+nuovaDimensione,
                                          dataType: "html",
                                          success: function(data) {                                                                                                                     
                                              }
                                        });                                                               
                                        return false; // con false senza refresh della pagina
                                     
                                    })

                                    $('#minus').click(function(e){
                                       e.preventDefault();
                                       var dimensioneAttuale = $('.table>tbody>tr>td').css("padding");
                                       var dimensioneModificata = parseFloat(dimensioneAttuale) 
                                       var nuovaDimensione = dimensioneModificata - 1;
                                       if(dimensioneModificata<=3){return}
                                       $('.table>tbody>tr>td').css({"padding": nuovaDimensione});
                                       $.ajax({
                                          url: "<?=BASE_URL_SITO?>ajax/minus_plus.php",
                                          type: "POST",
                                          data: "idsito=<?=IDSITO?>&nuovaDimensione="+nuovaDimensione,
                                          dataType: "html",
                                          success: function(data) {                                                                                                                     
                                              }
                                        });                                                               
                                        return false; // con false senza refresh della pagina
                                      });                              
                              }); 
                      </script>
                     <? 
                          $select = "SELECT * FROM hospitality_minus_plus WHERE idsito = ".IDSITO;
                          $res    = $db->query($select);
                          $rw     = $db->row($res);
                          $NewDimension = $rw['NewDimension'];
                          if($rw['NewDimension']){
                            echo'<script>
                                $(document).ready(function () {
                                      var dimensioneAttuale = $(\'.table>tbody>tr>td\').css("padding");
                                      var dimensioneModificata = parseFloat(dimensioneAttuale)
                                      var nuovaDimensione_tmp = dimensioneModificata - '.$NewDimension.'; 
                                      var nuovaDimensione = dimensioneModificata - nuovaDimensione_tmp;
                                      $(\'.table>tbody>tr>td\').css({"padding": nuovaDimensione});
                                  });
                             </script>';                                        
                          }
                      ?>