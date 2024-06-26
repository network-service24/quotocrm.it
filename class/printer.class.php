<?php
/**
 * @author Marcello Visigalli < marcello.visigalli@gmail.com >
 */

class printer
{

    public function alert($message)
    {
        print "<script language=\"javascript\">alert(\"$message\")</script>";
    }
    public function alertgo($message, $location)
    {
        print "<script language=\"javascript\">alert(\"$message\");document.location=\"$location\"</script>";
    }
    public function alertback($message)
    {
        print "<script language=\"javascript\">alert(\"$message\");history.go(-1)</script>";
    }
    public function alertclose($message)
    {
        print "<script language=\"javascript\">alert(\"$message\");close()</script>";
    }
    public function opento($url)
    {
        print "<script language=\"Javascript\">window.open('" . $url . "');</script>";
    }
    public function _goto($url)
    {
        echo "<script language=\"javascript\">document.location='$url'</script>Se il tuo browser non supporta javascript clicca <a href=\"$url\">qui</a>";
    }

}
