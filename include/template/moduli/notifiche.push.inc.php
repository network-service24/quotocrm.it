<script>
        var ContatorePreventivi = '<?=n_preventivi_send(1)?>';
        var ContatoreConferme   = '<?=n_conferme_send(1)?>';
        var ContatoreCS         = '<?=n_notifiche_cs(1)?>';
        var ContatoreSchedine   = '<?=n_checkin(1)?>';
        var NomeHotel           = '<?=str_replace("'","",NOMEHOTEL)?>';

</script>
<?php
if(check_configurazioni(IDSITO,'check_notifiche_push')==1){
    // ON MOUSEOVER UNA VOLTA SOLA NOTIFICHE PREVENTIVI
    echo (n_preventivi_send(1)>0?'
    <script>
                $( document ).ready(function(){
                    $("#notify_preventivi").one("mouseover",function(){
                        open_notifica("Ciao <b>'.NOMEHOTEL.'</b> ricordati che hai ancora <b class=\"text16\">'.n_preventivi_send(1).'</b> preventivi da inviare"," ","plain","bottom-right","error",5000,"#000000");
                    });
                });
            </script>':'')."\r\n";
    // ON MOUSEOVER UNA VOLTA SOLA NOTIFICHE CONFERME
    echo (n_conferme_send(1)>0?'
        <script>
            $( document ).ready(function() {
                $("#notify_conferme").one("mouseover",function(){
                    open_notifica("Ciao <b>'.NOMEHOTEL.'</b> ricordati che hai ancora <b class=\"text16\">'.n_conferme_send(1).'</b> conferme da inviare"," ","plain","bottom-right","error",5000,"#000000");
                });
            });
        </script>':'')."\r\n";
    // ON MOUSEOVER UNA VOLTA SOLA NOTIFICHE QUESTIONARIO
    echo (n_notifiche_cs(1)>0?'
        <script>
            $( document ).ready(function() {
                $("#notify_cs").one("mouseover",function(){
                    open_notifica("Ciao <b>'.NOMEHOTEL.'</b> oggi sono arrivati <b class=\"text16\">'.n_notifiche_cs(1).'</b> giudizi finali"," ","plain","bottom-right","error",5000,"#000000");
                });
            });
        </script>':'')."\r\n";
    // ON MOUSEOVER UNA VOLTA SOLA NOTIFICHE SCHEDINE CHECKIN
    echo (n_checkin(1)>0?'
        <script>
            $( document ).ready(function() {
                $("#notify_schedine").one("mouseover",function(){
                    open_notifica("Ciao <b>'.NOMEHOTEL.'</b> oggi sono stati compilati <b class=\"text16\">'.n_checkin(1).'</b>  checkin online"," ","plain","bottom-right","error",5000,"#000000");
                });
            });
        </script>':'')."\r\n";

}
?>