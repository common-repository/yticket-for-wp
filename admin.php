<?php
/**
 * Form per aggiornamento opzioni plugin
 */
function yTicketUpdateOptions(){
    ?>
    <div class="wrap">
        <div class="icon32" id=""><img src="<?php echo WP_PLUGIN_URL ?>/yticket-for-wp/img/yTicketicon32.jpg"></div>
        <h2>yTicket for WP <?php echo SETTINGS ?></h2>
         <form action="options.php" method="post">
             <?php settings_fields('yticket_options_group'); ?>
            <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label for="username">Username</label></th>
                    <td><input type="text" name="yticket_username" id="yticket_username" value="<?php echo get_option('yticket_username'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="password">Password</label></th>
                    <td><input type="text" name="yticket_password" id="yticket_password" value="<?php echo get_option('yticket_password'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="url">Url</label></th>
                    <td>http://<input type="text" name="yticket_url" id="yticket_url" value="<?php echo get_option('yticket_url'); ?>" /><p class="description"><?php echo INSERTURL ?> (<?php echo ESEMPIO ?>. xxx.ticketingsystem.it)</p></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="url"><?php echo ADMINCSS ?></label></th>
                    <td><input type="checkbox" name="yticket_css" id="yticket_css" value="1" <?php if(get_option('yticket_css') == 1) echo ' checked="checked"'; ?> /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="url"><?php echo ADMINJS ?></label></th>
                    <td><input type="checkbox" name="yticket_validator" id="yticket_validator" value="1" <?php if(get_option('yticket_validator') == 1) echo ' checked="checked"'; ?> /></td>
                </tr>
            </tbody>
            </table>

            <p class="submit"><input type="submit" name="salva" id="salva" value="<?php echo SAVE ?>" class="button button-primary" /></p>
        </form>
        <hr style="size:1px; color:#eee;" />
        <div style="margin:0 auto;pading:5px 0 5px 0;">
            <iframe src="http://cloudbox.it/products-list.php" frameborder="0" width="100%" height="260px"></iframe>
        </div>
        <hr style="size:1px; color:#eee;" />
        <?php   include_once dirname( __FILE__ ) .   '/help/help-'.getLanguage().'.php'; ?>
    </div>
    <?php
}

/**
 * Attivazione voce di menu
 */
function yTicketMenu(){
    //add_menu_page(TITOLO PAGINA, TITOLO DEL MENU, LIVELLO DI ACCESSO, SLUG, FUNZIONE CHE RICHIAMA LA VOCE, URL ICONA OPZIONALE);
    add_menu_page('yTicket Help Desk Software', 'yTicket', 'administrator', 'yTicket', 'yTicketUpdateOptions', WP_PLUGIN_URL . '/yticket-for-wp/img/yTicketicon.png');
}
add_action('admin_menu', 'yTicketMenu');


function yTicketActivateSetDefaultOptions()
{
    add_option('yticket_url', 'url');
    add_option('yticket_username', 'username');
    add_option('yticket_username', 'password');
    add_option('yticket_css', '0');
    add_option('yticket_validator', '0');
    
}
 
register_activation_hook( __FILE__, 'yTicketActivateSetDefaultOptions');


/**
 * Registrazione opzioni plugin
 */
function yTicketRegisterOptionsGroup()
{
    register_setting('yticket_options_group', 'yticket_url');
    register_setting('yticket_options_group', 'yticket_username');
    register_setting('yticket_options_group', 'yticket_password');
    register_setting('yticket_options_group', 'yticket_css');
    register_setting('yticket_options_group', 'yticket_validator');
}
 
add_action('admin_init', 'yTicketRegisterOptionsGroup');


?>