<?php
/**
 * Connessione a yTicket
 * @return string
 */
function yTicketMakeConnection(){
    $connection = 'http://'.preg_replace("/http:\/\//","",get_option('yticket_url')).'/api/?';
    $connection .= 'yws_user='.get_option('yticket_username').'&yws_password='.get_option('yticket_password');
    return $connection;
}


?>
