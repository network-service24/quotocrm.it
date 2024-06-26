<?php
if(!function_exists('close_session'))
{
    function close_session()
    {
        session_register_shutdown();
        $closed=session_write_close();
        ob_flush();flush();
        $message=sprintf('%2$s - %1$s - CLOSE_SESSION() - session_closed:" (%6$s)"'."\n",date('Y-m-d H:i:s'),$_SERVER['REQUEST_URI'],$closed?'true':'false',$_SERVER['HTTP_USER_AGENT'],$_SERVER['REMOTE_ADDR'],session_status());
        if($_SERVER['REMOTE_ADDR']=='217.61.62.216')
        file_put_contents(__DIR__.'/performize/access.log',$message."\n",FILE_APPEND);
    }
}
require_once __DIR__.'/performize/PerformizeSessionHandler.php';

// Utilizzo del custom session handler
$logFilePath = __DIR__.'/performize/access.log';
//$logFilePath=null;
session_set_save_handler(new PerformizeSessionHandler($logFilePath), true);

$durata_sessione=86400;
/**
 ** PARAMETRI DURATA SESSIONE
 */
ini_set('session.gc_maxlifetime', $durata_sessione+3600);
// Configurare i parametri del cookie di sessione
session_set_cookie_params([
    'lifetime' => $durata_sessione,
    'path' => '/',
    'domain' => '',
    'secure' => false,
    'httponly' => false
]);


// ESEMPI DURATA SESSIONE
/**
60*60 = 3600 (1h)
60*60*10 = 36000 (10h)
60*60*24 = 86400 (24h, 1d)
60*60*24*2 = 172800 (48h, 2d)
60*60*24*7 = 604800 (48h, 7d)
 */

if (session_status() !== PHP_SESSION_ACTIVE) {
    $now=time();
    //la sessione dovrebbe sempre essere chiusa prima di entrare qui.
   // close_session();
    $message=sprintf('%2$s - %1$s - BEFORE START (STO PER APRIRE SESSIONE) - %1$ss - session:"%3$s"',date('Y-m-d H:i:s'),
        $_SERVER['REQUEST_URI'],
        session_status(),
        $_SERVER['HTTP_USER_AGENT'],
        $_SERVER['REMOTE_ADDR']);
    if($_SERVER['REMOTE_ADDR']=='217.61.62.216')
        file_put_contents(__DIR__.'/performize/access.log',$message."\n",FILE_APPEND);
    session_start();

    $_SESSION['last_activity'] = time();// Aggiorna un valore di sessione per estendere la vita della sessione
$elapsed=time()-$now;
    $message=sprintf('%2$s - %1$s - STARTED (SESSIONE APERTA in %6$ss) - session:"%3$s"'."\n",date('Y-m-d H:i:s'),
        $_SERVER['REQUEST_URI'],
        session_id(),$_SERVER['HTTP_USER_AGENT'],$_SERVER['REMOTE_ADDR'],$elapsed);
  //  if($_SERVER['REMOTE_ADDR']=='217.61.62.216')
        file_put_contents(__DIR__.'/performize/access.log',$message."\n",FILE_APPEND);
}
else
{
    $message=sprintf('%2$s - %1$s - WARN - STILL ACTIVE - session:"%3$s"'."\n",date('Y-m-d H:i:s'),
        $_SERVER['REQUEST_URI'],session_id(),$_SERVER['HTTP_USER_AGENT'],$_SERVER['REMOTE_ADDR']);
    if($_SERVER['REMOTE_ADDR']=='217.61.62.216')
           file_put_contents(__DIR__.'/performize/access.log',$message."\n",FILE_APPEND);
    close_session();
    session_start();

}
setcookie(session_name(),session_id(),time()+$durata_sessione,'/');


