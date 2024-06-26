<?php
$riga_camere_proposta_v1_1 ='
<tr id="nc">                                                                       
    <td style="width:25%">
        <div class="form-group">
        <label for="TipoSoggiorno">Tipo Soggiorno</label>
            <select name="TipoSoggiorno1[]" id="TipoSoggiorno_1" class="form-control" tabindex="20" >
                <option value="" selected="selected">--</option>
                    '.$ListaSoggiorno.'
            </select>
        </div>
    </td>
    <td style="width:25%">
        <div class="form-group">
            <label for="NumeroCamere">Nr Camere</label>
            <select name="NumeroCamere1[]" id="NumeroCamere_1" class="form-control" tabindex="21" >
                <option value="" selected="selected">--</option>
                '.$Numeri.'
            </select>
        </div>   
    </td>
    <td style="width:25%">
        <div class="form-group">
            <label for="TipoCamere">Tipo Camere</label>
            '.$select_tipo_camere1.'
        </div> 
    </td> 
    <td style="width:25%">
        <label for="Prezzo">Prezzo </label> <small>0000.00</small>
        <div class="input-group">                                                    
            <span class="input-group-addon"><i class="fa fa-euro"></i></span>                                                    
            <input type="text" name="Prezzo1[]" id="Prezzo_1"  class="prezzo1 form-control" placeholder="0000.00" tabindex="23" >
        </div> 
    </td>                                            
</tr>
<tr>
    <td colspan="4">
        <table id="add_c" class="table" ></table>
    </td>  
</tr> 
<tr>
    <td colspan="4" style="text-align:right">
        <a href="javascript:;" onclick="scroll_to(\'nc\', 50, 1000)" id="add_cam" class="btn btn-warning btn-xs"><i class="fa fa-plus"></i></a> 
        <a href="javascript:;" onclick="scroll_to(\'nc\', 50, 1000)" id="rem_cam" class="btn btn-warning btn-xs"><i class="fa fa-minus"></i></a>          
    </td>
</tr>'."\r\n";
$riga_camere_proposta_v1_2 ='
<tr id="nc2">
    <td style="width:25%">
        <div class="form-group">
            <label for="TipoSoggiorno">Tipo Soggiorno</label>
            <select name="TipoSoggiorno2[]" id="TipoSoggiorno_2"
                class="form-control" tabindex="28">
                <option value="" selected="selected">--</option>
                '.$ListaSoggiorno.'
            </select>
        </div>
    </td>
    <td style="width:25%">
        <div class="form-group">
            <label for="NumeroCamere">Nr Camere</label>
            <select name="NumeroCamere2[]" id="NumeroCamere_2"
                class="form-control" tabindex="29">
                <option value="" selected="selected">--</option>
                '.$Numeri.'
            </select>
        </div>
    </td>
    <td style="width:25%">
        <div class="form-group">
            <label for="TipoCamere">Tipo Camere</label>
            '.$select_tipo_camere2.'
        </div>
    </td>
    <td style="width:25%">
        <label for="Prezzo">Prezzo </label> <small>0000.00</small>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-euro"></i></span>
            <input type="text" name="Prezzo2[]" id="Prezzo_2"
                class="prezzo2 form-control"
                placeholder="0000.00" tabindex="31">
        </div>
    </td>
    </tr>
    <tr>
    <td colspan="4">
        <table id="add_c2" class="table"></table>
    </td>
    </tr>
    <tr>
    <td colspan="4" style="text-align:right">
        <a href="javascript:;" onclick="scroll_to(\'nc2\', 50, 1000)"
            id="add_cam2" class="btn btn-warning btn-xs"><i
                class="fa fa-plus"></i></a>
        <a href="javascript:;" onclick="scroll_to(\'nc2\', 50, 1000)"
            id="rem_cam2" class="btn btn-warning btn-xs"><i
                class="fa fa-minus"></i></a>
    </td>
</tr>'."\r\n";
$riga_camere_proposta_v1_3 ='
<tr id="nc3">                                                                        
    <td style="width:25%">
            <div class="form-group">
        <label for="TipoSoggiorno">Tipo Soggiorno</label>
            <select name="TipoSoggiorno3[]" id="TipoSoggiorno_3" class="form-control" tabindex="36">
                <option value="" selected="selected">--</option>
                    '.$ListaSoggiorno.'
            </select>
        </div>
    </td>
   <td style="width:25%">
       <div class="form-group">
           <label for="NumeroCamere">Nr Camere</label>
           <select name="NumeroCamere3[]" id="NumeroCamere_3" class="form-control" tabindex="37">
               <option value="" selected="selected">--</option>
             '.$Numeri.'
           </select>
       </div>   
   </td>
   <td style="width:25%">
       <div class="form-group">
           <label for="TipoCamere">Tipo Camere</label>
           '.$select_tipo_camere3.'
       </div> 
   </td> 
   <td style="width:25%">
       <label for="Prezzo">Prezzo </label> <small>0000.00</small>
       <div class="input-group">                                                    
           <span class="input-group-addon"><i class="fa fa-euro"></i></span>                                                    
           <input type="text" name="Prezzo3[]" id="Prezzo_3"  class="prezzo3 form-control" placeholder="0000.00" tabindex="39">
       </div> 
   </td>                                            
</tr>
<tr>
 <td colspan="4">
     <table id="add_c3" class="table" ></table>
 </td>  
</tr> 
<tr>
   <td colspan="4" style="text-align:right">
       <a href="javascript:;" onclick="scroll_to(\'nc3\', 50, 1000)" id="add_cam3" class="btn btn-warning btn-xs"><i class="fa fa-plus"></i></a> 
       <a href="javascript:;" onclick="scroll_to(\'nc3\', 50, 1000)" id="rem_cam3" class="btn btn-warning btn-xs"><i class="fa fa-minus"></i></a>          
   </td>
</tr>'."\r\n";
?>