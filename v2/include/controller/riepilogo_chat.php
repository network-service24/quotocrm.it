<?php
    $sel = $db->query("SELECT hospitality_guest.* 
                            FROM hospitality_guest 
                            WHERE hospitality_guest.idsito = ".IDSITO."  
                            AND hospitality_guest.Id = '".$_REQUEST['id_guest']."'");
    $rw = $db->row($sel);
    
    $select ="SELECT hospitality_chat.* FROM hospitality_chat INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_chat.id_guest WHERE hospitality_guest.NumeroPrenotazione ='".$_REQUEST['NumeroPrenotazione']."' AND hospitality_chat.idsito = '".IDSITO."' ORDER BY hospitality_chat.data DESC";
    $res    = $db->query($select);
    $rec    = $db->result($res);
    $tot    = sizeof($rec);
    if($tot > 0){
    $riepilogo .=' <ul class="messaggi">';
          
      foreach($rec as $key => $row){

            $data_tmp = explode(" ",$row['data']);
            $data_d   = explode("-",$data_tmp[0]);
            $data     = $data_d[2].'-'.$data_d[1].'-'.$data_d[0].' '.$data_tmp[1];
            
            if($row['operator']==1){
              $q_img = $db->query("SELECT img FROM hospitality_operatori WHERE  idsito = ".$row['idsito']." AND NomeOperatore = '".$row['user']."' AND Abilitato = 1");
              $img = $db->row($q_img);
              $ImgOperatore = $img['img'];

              if($ImgOperatore == ''){
                $ImgOperatore = 'https://'.$_SERVER['HTTP_HOST'].'/img/receptionists.png';
              }else{
                $ImgOperatore = 'https://quoto.suiteweb.it/uploads/'.$row['idsito'].'/'.$ImgOperatore.'';
              }             
            }

            $riepilogo .='<li>                                         
              <div class="ballon">
                <div '.($row['operator']==0?'class="user2"':'class="operatore"').'>
                  <strong>'.$row['user'].'</strong> &nbsp;&nbsp;'.($row['operator']==0?'<img src="https://'.$_SERVER['HTTP_HOST'].'/img/receptionists.png" style="width:32px;height:32px" class="img-circle">':'<img src="'.$ImgOperatore.'" style="width:32px;height:32px" class="img-circle">').' <br>
                  <small><small>ha scritto il '.$data.'</small></small>
                </div>
                  <div '.($row['operator']==0?'class="textchat"':'class="textchatoperatore"').'>
                    '.nl2br($row['chat']).'
                  </div>
                  <div class="clear"></div>
              </div>                                    
                        
          </li><br>';
      }

      $riepilogo .='</ul>';

    }
