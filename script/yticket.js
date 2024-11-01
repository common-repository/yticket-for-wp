/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery.noConflict();

var $ = jQuery;

function yTicketOpen() {

    var record = $('#yTicketFormOpen').serialize();

    $.ajax({
        type: "POST",
        url: '/wp-content/plugins/yticket-for-wp/functions/yt_save.php',
        data: record + '&salva=salva',
        beforeSend: function() {
            $("button[type=submit]").attr("disabled", "disabled");
            $("#resultMsg").empty();
            img_loading('#resultMsg');
        },
        success: function(html) {
            $("#resultMsg").empty();
            $("#resultMsg").append(html);
            $("button[type=submit]").removeAttr("disabled");
        }
    });

}


function yTicketCheck(){
    
    var record = $('#yTicketFormCheck').serialize();

    $.ajax({
        type: "POST",
        url: '/wp-content/plugins/yticket-for-wp/functions/yt_check.php',
        data: record,
        beforeSend: function() {
            $("button[type=submit]").attr("disabled", "disabled");
            $("#resultMsgCheck").empty();
            img_loading('#resultMsgCheck');
        },
        success: function(html) {
            $("#resultMsgCheck").empty();
            $("#resultMsgCheck").append(html);
            $("button[type=submit]").removeAttr("disabled");
        }
    });
    
}


function img_loading(div){
    $(div).append('<div style="width:100%;margin: 5px auto;text-align:center;"><img src="/wp-content/plugins/yticket-for-wp/img/ajax_loading_green.gif" /></div>');
}