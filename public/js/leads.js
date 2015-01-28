var Leads = function() {

    var _initListeners = function() {
        $('.load1-entity').click(_loadEntity);
        $(document).on('change', '.entity-items', _loadEntityItems);
        $(document).on('change', '.load-item', _loadItem);
        //$(document).on('change', '#dateFrom, #dateTo', _bindNoOfDays);
      //  $(document).on('change', 'input[name="items[]"]', _getTotalItemCost);
        $(document).on('keyup', 'input[name="roomRequired"]', _getTotalItemCost);
        $(document).on('click', 'button.remove-traveller', _removeTraveller);
        $('input[name="paymentType"]').click(_getPayment);
        $('#addbutton').click(_addTraveller);
        $('#addduebutton').click(_addDuePayment);
       // $(document).on('change', 'input[name="excursions[]"]', _getTotalExcursionsCost);
        $(document).on('click', 'button.remove-due', _removeDuePayment);
        $(document).on('keyup', 'input[name="discount"]', _getTotalExcursionsCost);
        $(document).on('keyup', 'input[name="merchantFee"]', _getTotalExcursionsCost);
        $(document).on('keyup', 'input[name="depositAmount"]', _getAmountDue);
      //  $(document).on('change', 'input[name="transfers[]"]', _getTotalTransfersCost);
        //client email
        $("#ex-client").hide();
        $('.load-client').click(_loadClient);
        $(document).on('keyup', 'input[name="customerId"]', _getClientDetails);
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
    
    var _loadEntity = function() {
            $('#entity-item-details').hide();
            $.get('/admin/leads/ajax/' + $(this).attr('data-resource'), function(data) {
                
          //      alert(data);
                $('#ajax-where').html(data);
                $('.chzn-select').chosen();
                _clearAll();
            });
        };
    
    
    var _loadEntityItems = function() {
        $('#entity-item-details').hide();
        var id = $(this).val();
        var resource = $(this).attr('data-resource');
        if(id){
            $.post('/admin/leads/ajax/' + resource +id,{id:id}, function(data){
                
               // alert(data);
                $('#ajax-what').html(data);
                $('.chzn-select').chosen();
            });
        }

        _clearAll();
    };
    
    var _loadItem = function(){
        var id = $(this).val();         
        var type = $(this).attr('data-type');
        var extraType = $(this).attr('data-extra-type');
        
        if(id){
            $.post('/admin/leads/ajax/',{id:id, type: type }, function(data){            
                    
                    _bindItemData(data.result);
              //      _getExtraItems(extraType, id);
              //      _getExcursions(extraType, id);
               //     _getTransfers(extraType, id);
                    
           
            });
            
        }else{         
            _clearAll();        
        }
    };
    
  /*  var _getExtraItems = function(typeCode, id) {

        $.post('/admin/orders/ajax/items', {typeCode: typeCode, id: id}, function(data) {
            $('#ajax-items').html(data);
            _getTotalItemCost();
        });
    }
    
    /* get excursion */
    
 /*   var _getExcursions = function(typeCode, id) {
        $.post('/admin/orders/ajax/excursions', {typeCode: typeCode, id: id}, function(data) {
            $('#ajax-excursion').html(data);
           _getTotalExcursionsCost();
        });
    }
    
    /* get excursion */
    
 /*   var _getTransfers = function(typeCode, id) {
        $.post('/admin/orders/ajax/transfers', {typeCode: typeCode, id: id}, function(data) {
            $('#ajax-transfer').html(data);
           _getTotalExcursionsCost();
        });
    }
 */   
    var _bindItemData = function(data){
        //alert(data);
            for(var i in data){
                $('#' + i).val(data[i]);
                if(i == 'dateFrom'){
                   $('#' + i).attr('min', data[i]);
                  
                }
                
                if(i == 'numberAvailable' || i == 'totalAvailable'){
                   var totalStock = data[i];  
                }
                
                 if(i == 'bookedCount'){
                   var booked = data[i];  
                }
                
                if(i == 'dateTo'){
                   $('#dateFrom').attr('max', data[i]);
                   $('#' + i).attr('min', data[i]);
                   $('#' + i).attr('max', data[i]);
                }
            }
           var   available = totalStock - booked;
           $("#roomrequired").attr("max",available);
            if(available == 0 ){
                available="No Rooms Available";
                $("#creat").attr("disabled", true);
            }
            else{
                available= available + " Rooms Available";
                 $("#creat").attr("disabled", false);
            }
            $("#inventory_room_available").html(available);
            
            
            _bindNoOfDays();
            $('#entity-item-details').show();
            _dateValid();
            //_getRoomsAvailability(data.id);
           
    };
    
    var  _getDiffDays = function (from, to){
            var oneDay = 24*60*60*1000;
            var firstDate = new Date(parseInt(from[0]),parseInt(from[1]),parseInt(from[2]));                
            var secondDate = new Date(parseInt(to[0]),parseInt(to[1]),parseInt(to[2]));        
            var diffDays = 0;
            if(firstDate < secondDate){
                diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
            }
            return diffDays;
    };
    
    var _bindNoOfDays = function(){
            var from = $('input[name="travelFrom"]').val().split("-"); 
            var to = $('input[name="travelTo"]').val().split("-");          
            $('input[name="noOfDays"]').val(_getDiffDays(from, to));
             _getTotalItemCost();
             _getTotalExcursionsCost();
    };
    
    var _getTotalItemCost = function() {
        var itemsCost = 0;
        $.each($('input[name="items[]"]:checked'), function() {
            itemsCost = itemsCost + parseFloat($(this).attr('grossPrice'));
        });
        $('input[name="itemsCost"]').val(itemsCost);
        
        _calcFinalCost();
    };
    
    var _calcTotalCost = function() {

        var roomRate = parseFloat($('input[name="roomRate"]').val());
        var noOfDays = parseFloat($('input[name="noOfDays"]').val());
        var roomRequired = parseFloat($('input[name="roomRequired"]').val());
        var roomCost = roomRate * noOfDays * roomRequired;
        var flightTotalCost = parseFloat($('input[name="flightTotalCost"]').val());
        var itemsCost = parseFloat($('input[name="itemsCost"]').val());
        var excursionsCost = parseFloat($('input[name="excursionsCost"]').val());
        var transfersCost = parseFloat($('input[name="transfersCost"]').val());
        var totalCost = roomCost + flightTotalCost + itemsCost + excursionsCost + transfersCost;
        $('input[name="totalCost"]').val(totalCost);
 
        return totalCost;
    };
    
    var _calcFinalCost = function(){
        
        var discountType = $('input[name="discount"]').attr('data-discount-type');
        
        var totalCost = _calcTotalCost();
        var discount = parseFloat($('input[name="discount"]').val());
        var merchantFee = parseFloat($('input[name="merchantFee"]').val());
        
         if(isNaN(discount) || isNaN(merchantFee)){
            discount = 0;
            merchantFee = 0;  
        }
        
        var cost = totalCost + merchantFee;
        
        var finalCost = 0;

        if(discountType == 0){
            discount = (cost * discount) / 100;   
        }
       
         //alert(discount);
        finalCost = cost - discount;
        
        $('input[name="finalCost"]').val(finalCost);
        _getAmountDue();
        return finalCost;
           
    };
    
    var _getPayment = function(){
        
       
        
        if($(this).val() === '0'){
           
            _getAmountDue();
            $('input[name="depositAmount"]').removeAttr("readonly");
            
        } else {
            
            _before60Days($('input[name="finalCost"]').val());
            $('input[name="depositAmount"]').attr("readonly",true);
        }
        
    }
    
    var _getAmountDue = function(){
        
        var today = $('#today').val().split("-");;
        var startTrip = $('input[name="travelFrom"]').val().split("-");
        var finalCost = $('input[name="finalCost"]').val();
        
        var daysBefore = _getDiffDays(today, startTrip);
        
        //console.log(daysBefore);
        
        //alert($('input[name="paymentType"]').val());
        
        if(daysBefore > 120){
             $('#deposit-hide').show();
             _defaultPaymentDueCal(finalCost)//anup
             
//             
//             if($('input[name="paymentType"]:checked').val() === '0'){
//                 
//                _before120Days(finalCost);
//             }
        } 
        
        if(daysBefore <= 120 && daysBefore > 67){
            $('#deposit-hide').show();
                _defaultPaymentDueCal(finalCost)//anup
//            if($('input[name="paymentType"]:checked').val() === '0'){
//                _before90Days(finalCost);
//             }
        }
        
        if(daysBefore < 60){
            $('#fullPayment').click();
            $('#deposit-hide').hide();
            _before60Days(finalCost);
        }
        
        if($('input[name="paymentType"]:checked').val() === '1'){
             _before60Days(finalCost);
        }
        
        
 
    }
    
    var _defaultPaymentDueCal = function(finalCost){
        
        var depositAmount = $('input[name="depositAmount"]').val();
        $('input[name="balansAfterDeposit"]').val(finalCost - depositAmount);
        
    }
    
    var _before120Days = function(finalCost){
       
        
        
        var from = $('input[name="travelFrom"]').val().split("-");
        var oneDay = 24*60*60*1000;
        
        var depositAmount = (finalCost * 20) / 100;
        var nextPaymentDue = (finalCost * 40) / 100;
        var finalPaymentDue = nextPaymentDue;
        
        var maxNextPaymentDue = new Date(parseInt(from[0]),parseInt(from[1]),parseInt(from[2]));
        
        maxNextPaymentDue = new Date(maxNextPaymentDue.getDate() - (90 * oneDay));
        
        var maxFinalPaymentDue = new Date(parseInt(from[0]),parseInt(from[1]),parseInt(from[2]));
        
        maxFinalPaymentDue = new Date(maxFinalPaymentDue.getDate() - (60 * oneDay));
        
        $('input[name="depositAmount"]').val(depositAmount);
        $('input[name="balansAfterDeposit"]').val(finalCost - depositAmount);
        $('input[name="nextPaymentDue"]').val(nextPaymentDue).parent().parent().show();
        $('input[name="finalPaymentDue"]').val(finalPaymentDue).parent().parent().show();
        
        $('input[name="dueDate1"]').attr('max', maxNextPaymentDue).attr('required', 'required').parent().parent().show();
        $('input[name="dueDate2"]').attr('max', maxFinalPaymentDue).attr('required', 'required').parent().parent().show();
        
    };
    
    var _before90Days = function(finalCost){
        
        
        
        var from = $('input[name="travelFrom"]').val().split("-");
        var oneDay = 24*60*60*1000;
        
        var depositAmount = (finalCost * 40) / 100;
        var finalPaymentDue = (finalCost * 60) / 100;
        
        var maxFinalPaymentDue = new Date(parseInt(from[0]),parseInt(from[1]),parseInt(from[2]));
        
        maxFinalPaymentDue = new Date(maxFinalPaymentDue.getDate() - (60 * oneDay));
        
        $('input[name="depositAmount"]').val(depositAmount).show();
        $('input[name="balansAfterDeposit"]').val(finalCost - depositAmount).show();
        $('input[name="nextPaymentDue"]').val(null).parent().parent().hide();
        $('input[name="finalPaymentDue"]').val(finalPaymentDue).show();
        
        $('input[name="dueDate1"]').removeAttr('required').val(null).parent().parent().hide();
        $('input[name="dueDate2"]').attr('max', maxFinalPaymentDue).attr('required', 'required').show();
        
    };
    
    var _before60Days = function(finalCost){
        
        $('input[name="depositAmount"]').val(finalCost).show();
        $('input[name="nextPaymentDue"]').val(null);
        $('input[name="finalPaymentDue"]').val(null);
        $('input[name="balansAfterDeposit"]').val(0);
        $('input[name="dueDate2"]').removeAttr('required').val(null);
        $('input[name="dueDate2"]').removeAttr('required').val(null);
        
        
    };
    
    var _addTraveller = function(){
        var appendDiv = $('#add-traveller').html();
        var noOfPerson = $('input[name="noOfPersons"]');
        
        $('#traveller-info').append(appendDiv);
        noOfPerson.val(parseInt(noOfPerson.val())+ 1);
    };
    
    var _removeTraveller = function(){
        $(this).parents('.added-traveller').remove();
        var noOfPerson = $('input[name="noOfPersons"]');
         noOfPerson.val(parseInt(noOfPerson.val())- 1);
    };
    
    var  _getClientDetails = function(){
        var cId = $("#cust-id").val();
        if(cId.length == 9){
            $.post('/admin/orders/ajax/client-details', {cId: cId}, function(data) {
                if(data.name != null){
                    $("#not-found").html("");
                    $('input[name="travellerName"]').val(data.name);  
                    $('input[name="travellerEmail"]').val(data.email); 
                    $('input[name="travellerPhone"]').val(data.phone); 
                    $('input[name="travellerDOB"]').val(data.dob.date); 
                    $('input[name="travellerAddress"]').val(data.address1); 
                    $('input[name="travellerCity"]').val(data.city); 
                    $('input[name="travellerState"]').val(data.state);
                    $('[name="travellerCountry"]').val(data.country);
                    $('input[name="travellerZip"]').val(data.zip);
                  
                }else{
                    $("#not-found").html("Not a valid Customer Id.");
                    $("#not-found").css("color","red");
                    _clearFields();
                }
           });
        }
    };
    
    var _loadClient = function(){
        var val = $(this).val();
        if(val == 2){
            $("#ex-client").show();
        }else{
             $("#ex-client").hide();
             _clearFields();
             $("#cust-id").val('');
        }
    }
    
    var _clearFields = function (){
        $('input[name="travellerName"]').val('');  
              $('input[name="travellerEmail"]').val(''); 
              $('input[name="travellerPhone"]').val(''); 
              $('input[name="travellerDOB"]').val(''); 
              $('input[name="travellerAddress"]').val(''); 
              $('input[name="travellerCity"]').val(''); 
              $('input[name="travellerState"]').val('');
              $('[name="travellerCountry"]').val('');
              $('input[name="travellerZip"]').val('');
    }
    
    var _dateValid = function (){
        var start = $("#dateFrom").val();
        var end = $("#dateTo").val();
       $('#dateFrom').Zebra_DatePicker({
              direction: [start.toString(),end.toString()],
              onSelect: function() {
                   _bindNoOfDays();
              }
        })
              $('#dateTo').Zebra_DatePicker({
              direction: [start.toString(),end.toString()],
              onSelect: function() {
                   _bindNoOfDays();
              }
        })

    }
    
    var _getRoomsAvailability = function (roomId){
         $.post('/admin/orders/ajax/rooms-availability', {roomId : roomId}, function(data) {
               
           });
    }
    
    var _addDuePayment = function(){
        var appendDiv = $('#add-duedate').html();
        $('#due-date').append(appendDiv);
        $('.duedate').Zebra_DatePicker();
    };
    
    var _removeDuePayment = function(){
        $(this).parents('.added-duedates').remove();
    };
    
    var _getTotalExcursionsCost = function() {
        var excursionsCost = 0;
        $.each($('input[name="excursions[]"]:checked'), function() {
            excursionsCost = excursionsCost + parseFloat($(this).attr('grossPrice'));
        });
        $('input[name="excursionsCost"]').val(excursionsCost);
        
        _calcFinalCost();
    };
    
    var _getTotalTransfersCost = function() {
        var transfersCost = 0;
        $.each($('input[name="transfers[]"]:checked'), function() {
            transfersCost = transfersCost + parseFloat($(this).attr('grossPrice'));
        });
        $('input[name="transfersCost"]').val(transfersCost);
        
        _calcFinalCost();
    };
    
    return {
        init: function() {
            _initListeners();
        },
    };
}();


