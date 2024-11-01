<?php
/**
 * error code translation
 */
function yTicketErrorCodeTranlation($apiResponseCode){
    if(!is_null($apiResponseCode)):
    
        switch ($apiResponseCode):
            case '200':
                return EC200;
                break;
            case '204':
                return EC204;
                break;
            
            case '400':
                return EC400;
                break;
            
            case '401':
                return EC401;
                break;
            
            case '405':
                return EC405;
                break;
            
            case '500':
                return EC500;
                break;
            
            case '501':
                return EC501;
                break;
            
        endswitch;
    else:
        return EC001;
    endif;
}
?>
