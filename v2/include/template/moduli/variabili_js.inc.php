<script>
        var ContatorePreventivi = '<?=n_preventivi_send(1)?>';
        var ContatoreConferme   = '<?=n_conferme_send(1)?>';
        var ContatoreCS         = '<?=n_notifiche_cs(1)?>';
        var ContatoreSchedine   = '<?=n_checkin(1)?>';
        var ContatoreTicket     = '<?=tot_ticket_risposta(IDSITO,1)?>';
        var NomeHotel           = '<?=str_replace("'","",NOMEHOTEL)?>';


        $(document).ready(function(){
                $('[data-toogle="tooltip"]').tooltip();
                $('[data-tooltip="tooltip"]').tooltip();
        });
</script>
