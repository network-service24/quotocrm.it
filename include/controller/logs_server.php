<?php
$content ='<div class="scroll" style="height:610px;overflow-y:scroll;">';
                        
                            if(file_exists(BASE_PATH_SITO.'tmp/log_'.IDSITO.'.txt')){

                                $contenuto = file_get_contents(BASE_PATH_SITO.'tmp/log_'.IDSITO.'.txt');

                                $content_array = explode("\n",$contenuto);

                                krsort($content_array);

                                $content .= '<table class="display compact dataTable table table-striped table-hover table-bordered table-sm f-12">
                                            <tr>
                                                <th class="text-center"><b>N°</b></th>
                                                <th class="text-left">
                                                    <b>
                                                        <span class="p-r-10">Data</span> &#10230; 
                                                        <span class="p-r-10 p-l-10">Pagina</span> &#10230; 
                                                        <span class="p-r-10 p-l-10">IdSito</span>  &#10230; 
                                                        <span class="p-r-10 p-l-10">Operatore</span>  &#10230; 
                                                        <span class="p-r-10 p-l-10">Ip</span>  &#10230; 
                                                        <span class="p-l-10">Azione</span>   
                                                    </b>
                                                </th>
                                            </tr>';

                                foreach($content_array as $key => $value){

                                    if($value){

                                        $content .= '<tr>
                                                        <td class="text-center"><span class="f-10 p-r-10">['.$key.']</span></td>
                                                        <td class="text-left">'.$value.'</td>
                                                    </tr>';

                                    }

                                }  

                                $content .= '</table>';                             
                            } 
        $content .='    </div>';
?>