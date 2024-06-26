<?
   	$select ='  SELECT 
                    siti.idsito as idsito,
                    siti.web as web,
                    siti.nome as nome
                FROM 
                    siti
                WHERE 
                    1 = 1 
                AND 
                    siti.id_status != 8
                AND 
                    (siti.web LIKE "%'.$_REQUEST['sito'].'%"                                 
                OR     
                    siti.nome LIKE "%'.$_REQUEST['sito'].'%")';

    $res = $dbMysqli->query($select);

    foreach($res as $key => $row){
        if($row['nome']!=''){
            $lista_siti[] ="'".addslashes($row['web'])." # ".addslashes($row['nome'])." # ".$row['idsito']."'";
        }
    }

    $lista_siti = implode(',',$lista_siti);

    $autocomplete_siti ='<script>

                            $(document).ready(function(){
                                var substringMatcher = function(strs) {

                                    return function findMatches(q, cb) {

                                    var matches, substringRegex;

                                    matches = [];

                                    substrRegex = new RegExp(q, \'i\');

                                    $.each(strs, function(i, str) {
                                            if (substrRegex.test(str)) {
                                                matches.push(str);
                                            }
                                        });
                                        cb(matches);
                                    };
                                };

                                var sito = ['.$lista_siti.'];

                                $(\'#the-basics2 .form-control\').typeahead({
                                        hint: true,
                                        highlight: true,
                                        minLength: 1
                                    },
                                {
                                    name: \'sito\',
                                    source: substringMatcher(sito)
                                });
                            });
                    </script>'."\r\n";


    $res_all = $fun->getSiti();
    foreach($res_all as $k => $rec){
        $list .='{ id: '.$rec['idsito'].', text: \''.addslashes($rec['web']).'\'},'."\r\n";
    }              
    $js_custom_select_siti ='  <script>
                                    $(document).ready(function(){
                                        var data = [{ id: 0, text: \'Filtra per sito web\'},'.$list.'];
                                        $(".js-example-data-array").select2({
                                            data: data
                                        });
                                        $("#lista_siti").on("change",function(){
                                            $("#filtro_ricerca_sito").submit();
                                        });
                                        $("#sito").on(\'keyup keydown mouseleave mousemove mousedown\',function(){
                                            if($("#sito").val().length >= 12){
                                                $("#form_ricerca_cliente").submit();
                                             }
                                        })
                                    });
                                </script>'."\r\n";
 
          

?>

