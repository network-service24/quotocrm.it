  /* scrivi cookie */
  function scriviCookie(nomeCookie, valoreCookie, durataCookie) {
      var scadenza = new Date();
      var adesso = new Date();
      scadenza.setTime(adesso.getTime() + (parseInt(durataCookie) * 60000));
      document.cookie = nomeCookie + '=' + escape(valoreCookie) + '; expires=' + scadenza.toGMTString() + '; path = /';
  }
  /* leggi cookie */
  function leggiCookie(nomeCookie) {
      if (document.cookie.length > 0) {
          var inizio = document.cookie.indexOf(nomeCookie + "=");
          if (inizio != -1) {
              inizio = inizio + nomeCookie.length + 1;
              var fine = document.cookie.indexOf(";", inizio);
              if (fine == -1) fine = document.cookie.length;
              return unescape(document.cookie.substring(inizio, fine));
          } else {
              return "";
          }
      }
      return "";
  }
  /* cancella cookie */
  function cancellaCookie(nomeCookie) {
      scriviCookie(nomeCookie, '', -1);
  }

  function verificaCookie() {
      document.cookie = 'verifica_cookie';
      var testcookie = (document.cookie.indexOf('verifica_cookie') != -1) ? true : false;
      return testcookie;
  }
  /* alert sulla eliminazione */
  function validator(url) {
      if (window.confirm("ATTENZIONE: Sicuro di eliminare?")) {
          location.href = url;
      } else {

      }
  }
  /* alert sul mettere richieste nel cestino*/
  function validator_cestino(url) {
      if (window.confirm("ATTENZIONE: Sicuro di voler mettere la richiesta nel cestino?")) {
          location.href = url;
      } else {

      }
  }
  /* alert sulla copia */
  function validator_copia(url) {
      if (window.confirm("ATTENZIONE: Sicuro di voler duplicare il preventivo?")) {
          location.href = url;
      } else {

      }
  }
  /* alert sul abilitare uno step */
  function validator_check(url) {
      if (window.confirm("ATTENZIONE: Sicuro di Abilitare lo step?")) {
          location.href = url;
      } else {

      }
  }
  /* alert sulla disponibilita */
  function validator_disponibilita(url) {
      if (window.confirm("ATTENZIONE: Sicuro di inviare email per assenza disponibilità?")) {
          location.href = url;
      } else {

      }
  }
  /* alert sul voucher */
  function validator_vaucher(url) {
      if (window.confirm("ATTENZIONE: Sicuro di voler confermare la prenotazione ed inviare il voucher al cliente?")) {
          location.href = url;
      } else {

      }
  }
  /* alert sul riabilitare una conferma annullato */
  function validator_ri_abilita(url) {
      if (window.confirm("ATTENZIONE: Sicuro di voler ri-abilitare?")) {
          location.href = url;
      } else {

      }
  }
  /* alert sul riabilitare un preventivo annullato */
  function validator_ri_abilita_p(url) {
      if (window.confirm("ATTENZIONE: Sicuro di voler ri-abilitare il preventivo annullato?")) {
          location.href = url;
      } else {

      }
  }
  /* alert sul archivio */
  function validator_archivia(url) {
      if (window.confirm("ATTENZIONE: Sicuro di voler archiviare la richiesta?")) {
          location.href = url;
      } else {

      }
  }
  /* alert sul voucher */
  function val_vaucher(url) {
      $("#dialog").dialog({
          buttons: [{
                  text: "SI",
                  click: function() {
                      $(this).dialog("close");
                      window.location.href = url;
                  }
              },
              {
                  text: "NO",
                  click: function() {
                      $(this).dialog("close");
                      window.location.href = url + "/no/";
                  }
              }
          ],
          autoOpen: false,
          show: { effect: "bounce", duration: 300 },
          hide: { effect: "explode", duration: 300 }
      });

      $("#dialog").dialog("open");
      return false;
  }
  /* alert sulla duplicazione */
  function duplicator(url) {
      if (window.confirm("ATTENZIONE: Sicuro di voler duplicare?")) {
          location.href = url;
      } else {

      }
  }
  /* scroll della pagina */
  function scroll_to(id, scarto, tempo) {
      if (scarto == null) {
          scarto = 0
      };
      if (tempo == null) {
          tempo = 300
      };
      $('html,body').animate({
          scrollTop: $('#' + id).offset().top - scarto
      }, {
          queue: false,
          duration: tempo
      });
  }
  /* alert sulla sincronia del pms */
  function validator_pms(url) {
      if (window.confirm("ATTENZIONE: Sicuro di volere sincronizzare sul PMS questa prenotazione?")) {
          location.href = url;
      } else {

      }
  }
  /* modifiche ai pulsanti di axione, arcihiva, elimina, aggingi alla mailing list, ecc in base alla dimensioni dello schermo */
  function checkScreenDimension() {
      if (window.matchMedia('(max-width: 768px)').matches) {
          $('#pulsanti_dimensioni').hide();
          $('#filtro_arrivi_preno').hide();

          // $('#filtro_inviati').html('<i class="fa fa-filter" aria-hidden="true" data-toogle="tooltip" title="Filtra per non Inviati"></i>');
          // $('#archivia_all').html('<i class="fa fa-inbox" aria-hidden="true" data-toogle="tooltip" title="Archivia i selezionati"></i>');
          // $('#delete_all').html('<i class="fa fa-remove" aria-hidden="true" data-toogle="tooltip" title="Elimina i selezionati"></i>');
          // $('#add_all_newsletter').html('<img src="/img/emessenger.png" class="small_ico_emessenger" data-toogle="tooltip" title="Aggiungi i selezionati ad E-MESSENGER"></i>');
          // $('#assegna_all_op').html('<i class="fa fa-user" aria-hidden="true" data-toogle="tooltip" title="Assegna operatore ai selezionati"></i>');
          // $('#send_upselling').html('<i class="fa fa-send" aria-hidden="true" data-toogle="tooltip" title="Componi email di UpSelling"></i>');
      } else {
          $('#pulsanti_dimensioni').show();
          $('#filtro_arrivi_preno').show();

          // $('#filtro_inviati').html('<i class="fa fa-filter" aria-hidden="true"></i> Filtra per non Inviati');
          // $('#archivia_all').html('<i class="fa fa-inbox" aria-hidden="true"></i> Archivia i selezionati');
          // $('#delete_all').html('<i class="fa fa-remove" aria-hidden="true"></i> Elimina i selezionati');
          // $('#add_all_newsletter').html('<img src="/img/emessenger.png" class="small_ico_emessenger"> Aggiungi i selezionati ad E-MESSENGER');
          // $('#assegna_all_op').html('<i class="fa fa-user" aria-hidden="true"></i>&nbsp; Assegna operatore ai selezionati');
          // $('#send_upselling').html('<i class="fa fa-send" aria-hidden="true"></i> Componi email di UpSelling');
      }
  }
  /* check sukk edimensione della finestra solo per la DASHBOARD (index) */
  function checkScreenDimensionIndex() {
      if ((window.matchMedia('(min-width: 986px)').matches) && (window.matchMedia('(max-width: 1845px)').matches)) {
          $('.info-box-icon').hide();
          $('.info-box-content').attr('style', 'margin-left:0px !important');
          $('.text30').attr('style', 'font-size:20px !important');
          $('.ico_list').hide();
          $('#mobile').hide();
          $('#desktop').hide();
          $('#smart').hide();
          $('#default').hide();
          $('#leadtime').hide();
          $("#infobox1").removeClass('row-eq-height');
          $("#infobox2").removeClass('row-eq-height');
      } else {
          $('.info-box-icon').show();
          $('.info-box-content').attr('style', 'margin-left:90px !important');
          $('.text30').attr('style', 'font-size:30px !important');
          $('.ico_list').show();
          $('#mobile').show();
          $('#desktop').show();
          $('#smart').show();
          $('#default').show();
          $('#leadtime').show();
          $("#infobox1").addClass('row-eq-height');
          $("#infobox2").addClass('row-eq-height');
      }
  }


  function risoluzioneVideo() {
      var risWidth = screen.width;
      var risHeight = screen.height;
      if (risWidth <= 1440 && risHeight <= 900) {
          $(".content").addClass("resize_font");
      }
      console.log('Risoluzione video ' + risWidth + 'x ' + risHeight + ' pixel');
  }

  function dimensioneFinestra() {
      var winWidth = $(window).width();
      var winHeight = $(window).height();
      if (winWidth <= 1440 && winHeight <= 900) {
          $(".content").addClass("resize_font");
      }
      console.log('Dimensione finestra ' + winWidth + 'x ' + winHeight + ' pixel');
  }
  /* controllo se un id di un tag html esiste */
  function id_exists(id, second) {

      if ($("#" + id).length) {
          setTimeout(function() {
              $("#" + id).fadeOut();
          }, second);
      }
  }

  function vai_logout(url) {
      if (url) {
          location.href = url;
      }
  }

  function calcolaPerc(tot, num) {
      return ((num / tot) * 100).toFixed(0);
  }

  function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;

  }

  function resizeIframe(obj) {
      obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
  }