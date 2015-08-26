/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
        $('#tablaInventario').filterTable({
            callback: function(term, table) {
            table.find('tr').removeClass('striped').filter(':visible:even').addClass('striped');
        }
    }); 
});
