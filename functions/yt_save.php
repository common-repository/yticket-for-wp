<?php
//Setup location of WordPress
$absolute_path = __FILE__;
$path_to_file = explode('wp-content', $absolute_path);
$path_to_wp = $path_to_file[0];

//Access WordPress
require_once( $path_to_wp . '/wp-load.php' );
require __DIR__ . '/yt_error.php';

/**
 * Apertura ticket
 * @return xml
 */
function yTicketSaveNew() {
    if(
            (trim($_POST['customercode']) != '')
            &&
            (trim($_POST['email']) != '')
            &&
            (trim($_POST['subject']) != '')
            &&
            (trim($_POST['description']) != '')
    ):
        $url = yTicketMakeConnection();
        $params = '&yws_service=open';
        $params .= '&departement_id=' . $_POST['dipartimento'];
        $params .= '&customer_code=' . $_POST['customercode'];
        $params .= '&email=' . $_POST['email'];
        $params .= '&subject=' . $_POST['subject'];
        $params .= '&description=' . $_POST['description'];
        $params .= '&contact=' . $_POST['contact'];
        $url = $url.$params;
        return simplexml_load_file(urlencode("$url"));
    else:
        return false;
    endif;
}
$XMLres = yTicketSaveNew();
if($XMLres === false):
    echo EC400;
else:
    if($XMLres->code == 200):
        $res = preg_replace("/%EMAIL%/", $_POST['email'], TTOPENED);
        echo preg_replace("/%TICKETID%/", $XMLres->ticketID, $res);
    endif;
endif;
?>
