<?php
require 'functions/yt_connection.php';

/**
 * tranlsation
 */
function getLanguage(){
    return get_bloginfo( 'language' );
}

function yTicketTextLn(){
	//$bloginfo = get_bloginfo( 'language' );
	include_once __DIR__ . '/languages/'.getLanguage().'.php';
}

function yTicket_enqueue_styles() {
    wp_enqueue_style( 'yticket-style', WP_PLUGIN_URL . '/yticket-for-wp/css/yticket.css', array(), '2014.01.03', 'screen' );
}

function yTicket_enqueue_js(){
    
    wp_enqueue_script('jquery-1.9.1', 'http://code.jquery.com/jquery-1.9.1.js', array('jquery.js'), '1.9.1');
        if(get_option('yticket_validator') == 1):
            
            wp_enqueue_script('jquery-validate',plugin_dir_url( __FILE__ ) . 'script/jquery-validate.js');
            wp_enqueue_script('yticket-validator-js-init', WP_PLUGIN_URL.'/yticket-for-wp/script/yticket_validator_init.js');
        endif;
        
        wp_enqueue_script('yticket', WP_PLUGIN_URL.'/yticket-for-wp/script/yticket.js', array(), '1.0', true);

}

function yTicketForm(){
    
    if(get_option('yticket_css') == 1):
        $star = '';
    else:
        $star = '*';
    endif;
	
	$ytf = '<form id="yTicketFormOpen" action="javascript:yTicketOpen();">';
        $ytf .= "<dl class='inline'>";
        $ytf .= '<dt><label for="customercode" class="add-on"> *'.$star.CUSTOMERCODE.'</label></dt><dd><input type="text" name="customercode" value="" data-required="true" /></dd>';
        $ytf .= '<dt><label for="email" class="add-on"> *'.$star.'Email</label></dt><dd><input type="text" name="email" value="" data-required="true" /></dd>';
        $ytf .= '<dt><label for="subject" class="add-on"> *'.$star.SUBJECT.'</label></dt><dd><input type="text" name="subject" value="" data-required="true" /></dd>';
        $ytf .= '<dt><label for="text" class="add-on"> *'.$star.TEXT.'</label></dt><dd><textarea name="description" data-required="true"></textarea></dd>';
        $ytf .= '<dt><label for="contact" class="add-on">'.YOURNAME.'</label></dt><dd><input type="text" name="contact" value="" /></dd>';
             
	$doc = yTicketMakeDepartmentsList();
       
        $ytf .= '<dt><label for="text" class="add-on">'.DEPARTMENT.'</label></dt><dd><select name="dipartimento">';
        foreach ($doc->item as $node) {
            $ytf .= '<option value="'.$node->id.'">'.$node->descrizione.'</option>';
        }
        $ytf .= '</select></dd>';
        $ytf .= '<div class="btn-group"><button type="submit" class="btn btn-primary">'.SEND.'</button><button type="reset" class="btn">'.RESET.'</button></div>';
        $ytf .= '</dl></form>';
        $ytf .= '<div id="resultMsg"></div>';
        return $ytf;
}

/**
 * @abstract init form for open new ticket into content
 * 
 * @param type $content
 * @return type
 */
function yTicketFormInit($content){
    $yTicketForm = yTicketForm();
    return preg_replace("/{yticket}/", $yTicketForm, $content);
}
add_filter('the_content', 'yTicketFormInit');


function yTicketFormCheck(){
    
    if(get_option('yticket_css') == 1):
        $star = '';
    else:
        $star = '*';
    endif;
	
	$ytf = '<form id="yTicketFormCheck" action="javascript:yTicketCheck();">';
        $ytf .= "<dl class='inline'>";
        $ytf .= '<dt><label for="customercode" class="add-on"> *'.$star.CUSTOMERCODE.'</label></dt><dd><input type="text" name="customercode" value="" data-required="true" /></dd>';
        $ytf .= '<dt><label for="ticketid" class="add-on"> *'.$star.'Ticket ID</label></dt><dd><input type="text" name="ticketid" value="" data-required="true" /></dd>';
        $ytf .= '<div class="btn-group"><button type="submit" class="btn btn-primary">'.SEND.'</button><button type="reset" class="btn">'.RESET.'</button></div>';
        $ytf .= '</dl></form>';
        $ytf .= '<div id="resultMsgCheck"></div>';
        return $ytf;
}

/**
 * @abstract init form for check ticket history into content
 * 
 * @param type $content
 * @return type
 */
function yTicketFormTicketCheckInit($content){
    $yTicketFormCheck = yTicketFormCheck();
    return preg_replace("/{yticket-check}/", $yTicketFormCheck, $content);
}
add_filter('the_content', 'yTicketFormTicketCheckInit');



/**
 * Elenco dipartimenti
 * @return type
 */
function yTicketMakeDepartmentsList(){
    if(simpleXMLCheck() === true):
        $url = yTicketMakeConnection();
        $params = '&yws_service=departements';
        $url = $url.$params;
        return simplexml_load_file(urlencode("$url"));
    endif;
}


// Create WP Admin Tabs on-the-fly.
function admin_tabs($tabs, $current=NULL){
    if(is_null($current)){
        if(isset($_GET['page'])){
            $current = $_GET['page'];
        }
    }
    $content = '';
    $content .= '<h2 class="nav-tab-wrapper">';
    foreach($tabs as $location => $tabname){
        if($current == $location){
            $class = ' nav-tab-active';
        } else{
            $class = '';    
        }
        $content .= '<a class="nav-tab'.$class.'" href="#'.$tabname.'">'.$tabname.'</a>';
    }
    $content .= '</h2>';
        return $content;
}



function simpleXMLCheck(){
    if (extension_loaded('simplexml')) {
        return true;
    }else{ 
        echo "ERROR: simplexml library not active on server";
    }
}

    


function yTicketJsInit(){}
add_action('wp_footer', 'yTicketJsInit', 999);


?>