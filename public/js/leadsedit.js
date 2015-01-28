var LeadsEdit = function() {

    var _initListeners = function() {
        
         $(document).ready(function(){
            var extraType =$('input[name="dataExtraType"]').val();
            var id = $('input[name="dataTypeId"]').val();
            var type = $('input[name="type"]').val();
            //var roomId = $('input[name="roomCategory"]').val();
            
            _getExtraItems(extraType, id);
            _getExcursions(extraType, id);
            _getTransfers(extraType, id);
           
        })
       
    };
    
    var _clearAll = function() {
        $('#ajax-what').html(null);
        $('#ajax-items').html(null);
        $('input[name="roomRate"]').val(0);
        $('input[name="travelTo"]').attr('min', null);
        $('input[name="travelTo"]').attr('max', null);
        $('input[name="travelFrom"]').attr('min', null);
        $('input[name="travelFrom"]').attr('max', null);
    };
    
   
     var _getExtraItems = function(typeCode, id) {

        $.post('/admin/leads/ajax/items', {typeCode: typeCode, id: id}, function(data) {
            $('#ajax-items').html(data);
          //  _getTotalItemCost();
        });
    }
    
    /* get excursion */
    
   var _getExcursions = function(typeCode, id) {
        $.post('/admin/leads/ajax/excursions', {typeCode: typeCode, id: id}, function(data) {
            $('#ajax-excursion').html(data);
//           _getTotalExcursionsCost();
        });
    }
    
    /* get excursion */
    
   var _getTransfers = function(typeCode, id) {
        $.post('/admin/leads/ajax/transfers', {typeCode: typeCode, id: id}, function(data) {
            $('#ajax-transfer').html(data);
//           _getTotalExcursionsCost();
        });
    }
   
   
    
    
    return {
        init: function() {
            _initListeners();
        },
    };
}();


