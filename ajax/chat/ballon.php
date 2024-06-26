<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
			
			$select      ="SELECT hospitality_chat.* FROM hospitality_chat INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_chat.id_guest WHERE hospitality_guest.NumeroPrenotazione ='".$_REQUEST['NumeroPrenotazione']."' AND hospitality_chat.idsito = '".$_REQUEST['idsito']."' ORDER BY hospitality_chat.data DESC";
			$result      = $dbMysqli->query($select);
			$tot         = sizeof($result);
			if($tot > 0){

				echo'  <style>
					    .ballon{
					      font-size:14px!important;
					      width:100%;
					      height:auto;
					      border-radius: 10px 10px 10px 10px;
					      -moz-border-radius: 10px 10px 10px 10px;
					      -webkit-border-radius: 10px 10px 10px 10px;
					      border: 1px solid #d5d2d2;
							background: rgba(237,237,237,1);
							background: -moz-linear-gradient(top, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
							background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(237,237,237,1)), color-stop(53%, rgba(246,246,246,0.79)), color-stop(100%, rgba(255,255,255,0.6)));
							background: -webkit-linear-gradient(top, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
							background: -o-linear-gradient(top, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
							background: -ms-linear-gradient(top, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
							background: linear-gradient(to bottom, rgba(237,237,237,1) 0%, rgba(246,246,246,0.79) 53%, rgba(255,255,255,0.6) 100%);
							filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#ededed\', endColorstr=\'#ffffff\', GradientType=0 );
					    }					    
					    .clear{
					    	clear:both;
					    	height:10px;
					    }
					    .messaggi{
					    	list-style-type: none;
					    	padding:0px;
					    }
					    .user2{
							float:right;
							text-align:right;
							padding:20px;
					    }
					    .textchat{
					    	float:left;
					    	text-align:left;
					    	padding:20px;
					    	position:relative;
					    }
					    .operatore{
							float:left;
							text-align:left;
							padding:20px 20px 0px 20px;
					    }
					    .textchatoperatore{
					    	clear:both;
					    	float:left;
					    	text-align:left;
					    	padding:20px;
					    	position:relative;
					    }					    
					  </style>
					  <ul class="messaggi">';
            
            	foreach($result as $key => $row){

					$data_tmp = explode(" ",$row['data']);
					$data_d   = explode("-",$data_tmp[0]);
					$data     = $data_d[2].'-'.$data_d[1].'-'.$data_d[0].' '.$data_tmp[1];

            			if($row['operator']==1){
            				$q_img = $dbMysqli->query("SELECT img FROM hospitality_operatori WHERE  idsito = ".$row['idsito']." AND NomeOperatore = '".$row['user']."' AND Abilitato = 1");
							$img = $q_img[0];
							$ImgOperatore = $img['img'];

	            			if($ImgOperatore == ''){
								$ImgOperatore = 'https://'.$_SERVER['HTTP_HOST'].'/img/receptionists.png';
	            			}else{
	            				$ImgOperatore = 'https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$row['idsito'].'/'.$ImgOperatore.'';
	            			}

            			}


						echo'<li>																	        
								<div class="ballon">
									<div '.($row['operator']==0?'class="user2"':'class="operatore"').'>
										<strong>'.$row['user'].'</strong> &nbsp;&nbsp;'.($row['operator']==0?'<img src="https://'.$_SERVER['HTTP_HOST'].'/img/receptionists.png" style="width:32px;height:32px" class="img-circle">':'<img src="'.$ImgOperatore.'" style="width:32px;height:32px" class="img-circle">').' <br>
										<small><small>ha scritto il '.$data.'</small></small>
									</div>
										<div '.($row['operator']==0?'class="textchat f-12"':'class="textchatoperatore f-12"').'>
											'.nl2br($row['chat']).'
										</div>
										<div class="clear"></div>
								</div>														        
													
						</li><br>';
				}

			echo'</ul>';

			}

?>