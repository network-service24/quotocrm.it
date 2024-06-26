 <?php
  include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
  include($_SERVER['DOCUMENT_ROOT'].'/include/declaration.inc.php');
  // rimuovo i dati dell'utente dalla sessione
  unset($_SESSION['utente']);
	unset($_SESSION);
    session_destroy();

  if($_REQUEST['provenienza'] == 'change_user'){

    echo '<form  action="'.BASE_URL_SITO.'change_user.php" method="post" name="form_change_user" id="form_change_user"  target="_self">
                  <input type="hidden" name="idsito" id="idsito"  value="'.base64_encode($_REQUEST['idsito']).'"/>
                  <input type="hidden" name="nome_utente" id="nome_utente"  value="'.base64_encode($_REQUEST['nome_utente']).'"/>
                  <input type="hidden" name="icona_utente" id="icona_utente"  value="'.base64_encode($_REQUEST['icona_utente']).'"/>
                </form>'."\r\n";
    echo '<script src="'.BASE_URL_SITO.'js/jquery-3.5.1.js"></script>';
    echo '<script>
            $(document).ready(function(){
                 $("#form_change_user").submit();
            });
    			</script>'."\r\n";

  }else{
    // rimando al login
    $prt->_goto(BASE_URL_SITO.'login.php');
    exit;
    //header("Location: ".BASE_URL_SITO."login.php");
    //die("Stai per essere reindirizzato alla pagina di login");
  }
