<?php include_module('header.inc.php') ?>
<?php include_module('top.inc.php') ?>
<?php include_module('sidebar.inc.php') ?>
<?php include_module('preloader.inc.php') ?>
<div class="content-wrapper">
  <?php include(BASE_PATH_SITO.'include/template/moduli/breadcrumb.inc.php') ?>
  <section class="content">
    <div class="box radius6">
      <div class="box-body">

        <?
             /*  foreach ($risultati->RoomStays->RoomStay as $key => $value) {
                          switch($value->RatePlans->RatePlan->MealsIncluded['MealPlanCodes']){
                              case"1.MPT":
                                $tipo_soggiorno_it  = 'All Inclusive';
                              break;
                              case"3.MPT":
                                $tipo_soggiorno_it  = 'Bed & Breakfast';
                    
                              break;
                              case"10.MPT":
                                $tipo_soggiorno_it  = 'Pensione Completa';
                    
                              break;
                              case"12.MPT":
                                $tipo_soggiorno_it  = 'Mezza Pensione';
                 
                              break;
                              case"14.MPT":
                                $tipo_soggiorno_it  = 'Solo Pernotto';
                    
                              break;  
                                          
                          }

               echo   $tipo_soggiorno_it.' - ';
               echo   $value->RoomTypes->RoomType['RoomTypeCode'].' - ';
               echo   $value->RoomTypes->RoomType->RoomDescription['Name'].' - ';  
               echo   $value->Total['AmountAfterTax'].'<br>';    

              /*  foreach($value->RatePlans->RatePlan->MealsIncluded as $c => $v){
                  
                   $TipoSogg = $v['MealPlanCodes'];
                }
                foreach($value->Total as $ch => $val){
                    $TotaleCamera = $val['AmountAfterTax'];
                }
                foreach($value->RoomRates->RoomRate->Rates->Rate as $h => $l){
                    $unita = $l['NumberOfUnits'];
                }
                 $riga_camere[$RoomCode.'_'.$TipoSogg] = array('CAMERA' => $RoomName,'SOGG' => $TipoSogg,'TOTALE' => $TotaleCamera,'UNITA'=>$unita); 
                 
              }*/
?>
      </div>
    </div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include_module('footer.inc.php'); ?>