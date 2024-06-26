 <?php
  include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
?>

    <form id="cl" name="cl" action="<?=BASE_URL_ADMIN?>login.php" method="post">
            <input type="hidden" name="username" value="<?=$_REQUEST['username']?>" />
            <input type="hidden" name="password" value="<?=$_REQUEST['password']?>"/>                                                       
    </form> 
    <script>
        window.onload = function(){
            document.forms['cl'].submit()
        }
    </script>