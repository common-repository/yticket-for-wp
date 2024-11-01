/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function($){

    $('#yTicketFormOpen').validate({
        onKeyup: true,
        eachValidField: function() {

            $(this).closest('dt').removeClass('error').addClass('success');
        },
        eachInvalidField: function() {

            $(this).closest('dt').removeClass('success').addClass('error');
        }
    });

});

jQuery.noConflict();