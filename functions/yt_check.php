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
function yTicketCheckStatus($ticketid, $customercode) {
    if( ($ticketid!='') && ($customercode!='')):
        $url = yTicketMakeConnection();
        $params = '&yws_service=details';
        $params.= '&ticket_id='.$ticketid.'&customer_code='.$customercode;
        $url = $url.$params;
        return simplexml_load_file(urlencode("$url"));
    else:
        return false;
    endif;
}

//var_dump($_POST);
$XMLres = yTicketCheckStatus($_POST['ticketid'], $_POST['customercode']);
if($XMLres !== false):
echo '<div id="divres">';
echo '<p>';
echo 'Ticket ID: '.$XMLres->item->ticketID  .   '<br />';
echo TTCUSTOMER . ': '.$XMLres->item->customer  .   '<br />';
echo TTEMAILOT  . ': '.$XMLres->item->email_apertura_ticket  .   '<br />';
echo TTSUBJECT  . ': '.$XMLres->item->subject  .   '<br />';
echo TTSTATUS  . ': '.$XMLres->item->status  .   '<br />';
echo TTSTATUSJOB    .   ': '    .   $XMLres->item->job_description  .   '<br />';
echo TTDESCRIPTION  . ': '  .   '<br />';
foreach($XMLres->item->response_messages as $jhm):
    echo '<b>'   .   $jhm->created   .   '</b><br />';
    echo TTDEPARTMENT   .   ': '    .   $jhm->department    .   '<br />';
    echo TTMESSAGE   .   ': '    .   preg_replace("/\r\n/", "<br \/>", utf8_decode($jhm->message))    .   '<br />';  
    echo '<hr style="size:1px;color:#fff;">';
endforeach;
#print_r($XMLres);
echo '</p>';
echo '</div>';
else:
    echo '<p>'
    . EC401
    .'</p>';
endif;
?>
