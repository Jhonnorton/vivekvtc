var Reservation = function() {

    var _initListeners = function() {
        $('.load-entity').click(_loadEntity);
        $(document).on('change', '.entity-items', _loadEntityItems);
        $(document).on('change', '.load-item', _loadItem);
        //$(document).on('change', '#dateFrom, #dateTo', _bindNoOfDays);
        $(document).on('change', 'input[name="items[]"]', _getTotalItemCost);
        $(document).on('keyup', 'input[name="roomRequired"]', _getTotalItemCost);
        $(document).on('click', 'button.remove-traveller', _removeTraveller);
        $('input[name="paymentType"]').click(_getPayment);
        $('#addbutton').click(_addTraveller);
        $('#addduebutton').click(_addDuePayment);
        $(document).on('change', 'input[name="excursions[]"]', _getTotalExcursionsCost);
        $(document).on('click', 'button.remove-due', _removeDuePayment);
        $(document).on('keyup', 'input[name="discount"]', _getTotalExcursionsCost);
        $(document).on('keyup', 'input[name="merchantFee"]', _getTotalExcursionsCost);
        $(document).on('keyup', 'input[name="depositAmount"]', _getAmountDues);
        $(document).on('change', 'input[name="transfers[]"]', _getTotalTransfersCost);
        //client email
        $("#ex-client").hide();
        $('.load-client').click(_loadClient);
        $(document).on('blur', 'input[name="customerId"]', _getClientDetails);
        $(document).on('change', '.load-disc', _loadDiscount);
        $('.load-type').click(_loadEntity);
        $('.load-type-category').click(_loadRooms);
        $('input[name="depositMethod"]').click(_changeSubmit);
        $(document).ready(function(){
            var type =  $('input[name="type"]').val();
            _dateValid(type); 
             $("#pay_first:hidden").find($("#dueAmount1")).val("");
        });
        
//        $('.sex').click(_newPriceIfGreaterOccupancy);
        
        $(document).ready(function(){

            var extraType = $('input[name="dataExtraType"]').val();
            var id = $('input[name="dataTypeId"]').val();
            var type = $('input[name="type"]').val();
            var roomId = $('input[name="roomCategory"]').val();
            var pageAction = $('input[name="pageaction"]').val();//pageAction = 1 - new reservation
            $(".btntrv").attr("addTrv",0);
            //$("#hid-avl-div").hide();
            
           
            if(parseInt(pageAction) == 1){
                //_loadEntity();
                _getExtraItems(extraType, id);
                _getExcursions(extraType, id);
                _getTransfers(extraType, id);
               // _getRoomsAvailability(roomId,type);
                _getInventoryData(roomId,type);
                _bindNoOfDays();
                
            var tNop=parseInt($("#inv_data").attr("m"))+parseInt($("#inv_data").attr("f"));
            var  i=0;
            for(i=0;i<(tNop-1);i++){
                $( "#addbutton" ).trigger( "click" );
            }
                //_dateValid(type); 
            }else{
                 _getInventoryData(roomId,type);
                $('#dateTo').Zebra_DatePicker({
                    onSelect: function() {
                        if(Date.parse(this.val()) <= Date.parse($("#dateFrom").val())){
                            alert("End date must be greater than start date !")
                            $(this).val("");
                            return false;
                        }
                        _bindNoOfDays();
                        
 			roomId = $("input[name='roomCategory']").val();
                        if(typeof roomId === "undefined"){
                        var roomId = $("select[name='roomCategory']").attr("chosen");
                        }
                        _getRoomsAvailability(roomId,type);
                        $("#check-date-change").val(1);
                        //_dateValid(type);
                    }
                });
                $('#dateFrom').Zebra_DatePicker({
                    onSelect: function() {
                        if(Date.parse(this.val()) >= Date.parse($("#dateTo").val())){
                            alert("Start date must be smaller than end date !");
                             $(this).val("");
                            return false;
                        }
                        _bindNoOfDays();

			 roomId = $("input[name='roomCategory']").val();

                        if(typeof roomId === "undefined"){
                        var roomId = $("select[name='roomCategory']").attr("chosen");
                        }
                        _getRoomsAvailability(roomId,type);
                        $("#check-date-change").val(1);
                        //_dateValid(type);
                    }
                })
                
                //$("#creat_pay").hide();
                 $("#creat_draft").hide();
            }
            //stop submiting form from enter key
            $(window).keydown(function(event){
              if(event.keyCode == 13) {
              event.preventDefault();
              return false;
               }
            });
            
            //_clearAll();
        })
        
        $( document ).ajaxStart(function() {
               $(".over-lay").show();
            });
            
            $(document).ajaxStop(function() {
                 $(".over-lay").hide();
            });
        
    };
    
    
    
    var _clearAll = function() {
        $('#ajax-what').html(null);
        $('#ajax-items').html(null);
//        $('input[name="roomRate"]').val(0);
        $('input[name="travelTo"]').attr('min', null);
        $('input[name="travelTo"]').attr('max', null);
        $('input[name="travelFrom"]').attr('min', null);
        $('input[name="travelFrom"]').attr('max', null);
    };
    
    var _loadEntity = function() {
            //$('#entity-item-details').hide();
            var resource = $("#data-resource").val();
//            if(resource =='events' || resource =='cruises'){
//                $('#dates').hide();
//            }else{
//                 $('#dates').show();
//            }
            $.get('/admin/orders/ajax/' + resource, function(data) {
                $('#ajax-where').html(data);
                $('.chzn-select').chosen();
                _clearAll();
            });
             //$("#due-date").hide();
            $('.hid-type-Id').remove();
        };
    
    
    var _loadEntityItems = function() {
        $('#entity-item-details').hide();
        
        var id = $(this).val();
        var type = $(this).attr('data-type');
        var resource = $(this).attr('data-resource');
        var extraType = $(this).attr('data-extra-type');
        //if(type == 2 || type == 3){
            if(id){
                $.post('/admin/orders/ajax/' + resource +id,{id:id}, function(data){            
                    $('#ajax-what').html(data);
                    $("#dateFrom").val($("#hid-start").val());
                    $("#dateTo").val($("#hid-end").val());
                    _dateValid(type);
                    $('.chzn-select').chosen();
                });
            } 
            $('#dates').show();
            
//        }else{
//
//            _dateSelect(type,id,resource);
//        }
        _getExtraItems(extraType, id);
        _getExcursions(extraType, id);
        _getTransfers(extraType, id);
        _clearAll();
    };
    
    var _loadRooms = function(){
        $('#entity-item-details').hide();
        var id = $("#data-type-id").val();
        var type =  $('input[name="type"]').val();
        
        if(type == 1){
            var resource = "resort/rooms/";
        }else if(type == 2){
              var resource = "event/rooms/";
        }else{
             var resource = "cruise/cabins/";
        }
        //if(type == 2 || type == 3){
            if(id){
                $.post('/admin/orders/ajax/' + resource +id,{id:id}, function(data){            
                    $('#ajax-what').html(data);
                   // $("#dateFrom").val($("#hid-start").val());
                    //$("#dateTo").val($("#hid-end").val());
                    _dateValid(type);
                    $('.chzn-select').chosen();
                });
            } 
            $('#dates').show();
               //$("#due-date").hide();
            $('.hid-roomCategory').remove();
    }
    
    var _loadItem = function(){
        var id = $(this).val();         
        var type = $(this).attr('data-type');
        var extraType = $(this).attr('data-extra-type');
        $(this).attr("chosen",id);
        if(id){

            //$.post('/admin/orders/ajax/',{id:id, type: type }, function(data){               
                    //_bindItemData(data.result,type);
//                    _getExtraItems(extraType, id);
//                    _getExcursions(extraType, id);
//                    _getTransfers(extraType, id);
                  
           
           // });
           _getInventoryData(id,type);
           _getRoomsAvailability(id,type);
            $('#entity-item-details').show();
            if(type == 2 || type == 3){
                _dateValid(type);
            }
            $('#dates').show();
        }else{         
            _clearAll();        
        }
    };
    
    var _getExtraItems = function(typeCode, id) {

        $.post('/admin/orders/ajax/items', {typeCode: typeCode, id: id}, function(data) {
            $('#ajax-items').html(data);
            _getTotalItemCost();
        });
    }
    
    /* get excursion */
    
    var _getExcursions = function(typeCode, id) {
        $.post('/admin/orders/ajax/excursions', {typeCode: typeCode, id: id}, function(data) {
            $('#ajax-excursion').html(data);
           _getTotalExcursionsCost();
        });
    }
    
    /* get excursion */
    
    var _getTransfers = function(typeCode, id) {
        $.post('/admin/orders/ajax/transfers', {typeCode: typeCode, id: id}, function(data) {
            $('#ajax-transfer').html(data);
           _getTotalExcursionsCost();
        });
    }
    
    var _bindItemData = function(data,type){
            for(var i in data){
//                if(type==2){
//                    $('#' + i).val(data[i]);
//                }
                if(type == 1 || type == 3 || type == 2)
                    {
                        if(i != 'dateFrom' && i != 'dateTo'){
                            $('#' + i).val(data[i]);
                        }
                    }
                if(i == 'dateFrom'){
                   $('#' + i).attr('min', data[i]);
                  
                }
                
//                if(i == 'numberAvailable' || i == 'totalAvailable'){
//                   var totalStock = data[i];
//                }
//                
//                 if(i == 'bookedCount'){
//                   var booked = data[i];  
//                }
                
                if(i == 'dateTo'){
                   $('#dateFrom').attr('max', data[i]);
                   $('#' + i).attr('min', data[i]);
                   $('#' + i).attr('max', data[i]);
                }

            }
           //var   available = totalStock - booked;
          // $("#roomrequired").attr("max",available);

//            if(available == 0 ){
//                available="No Rooms Available";
//                $("#creat").attr("disabled", true);
//            }
//            else{
//                available= available + " Rooms Available";
//                 $("#creat").attr("disabled", false);
//            }
//
//            
//            $("#inventory_room_available").html(available);
            
//            _calcTotalCost();
//            _bindNoOfDays();
            $('#entity-item-details').show();
            if(type == 2 || type == 3){
                _dateValid(type);
            }
            //_getRoomsAvailability(data.id);
           
    };
    
    var  _getDiffDays = function (from, to){
            var oneDay = 24*60*60*1000;
            var firstDate = new Date(parseInt(from[0]),parseInt(from[1])-1,parseInt(from[2]));                
            var secondDate = new Date(parseInt(to[0]),parseInt(to[1])-1,parseInt(to[2]));        
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
        var itemsCostNet = 0;
        $.each($('input[name="items[]"]:checked'), function() {
            itemsCost = itemsCost + parseFloat($(this).attr('grossPrice'));
            itemsCostNet = itemsCostNet + parseFloat($(this).attr('netPrice'));
        });
        $('input[name="itemsCost"]').val(itemsCost);
        $('input[name="itemsCost"]').attr("netCost",itemsCostNet);
        
        _calcFinalCost();
    };
    
    var _calcTotalCost = function() {

        var roomRate = parseFloat($('input[name="roomRate"]').val());
        var noOfDays = parseFloat($('input[name="noOfDays"]').val());
        var roomRequired = parseFloat($('input[name="roomRequired"]').val());
        var roomCost = roomRate * noOfDays * roomRequired;
        var flightTotalCost = parseFloat($('input[name="flightTotalCost"]').val());

        if($('input[name="itemsCost"]').val()){
            var itemsCost = parseFloat($('input[name="itemsCost"]').val());
            var netItemCost = parseFloat($('input[name="itemsCost"]').attr("netCost"));
           // alert(netItemCost);
        }else{
           var itemsCost = 0;
           var netItemCost = 0;
        }
        
        if($('input[name="excursionsCost"]').val()){
            var excursionsCost = parseFloat($('input[name="excursionsCost"]').val());
             var netExcursionsCost = parseFloat($('input[name="excursionsCost"]').attr("netCost"));
              //alert(netExcursionsCost);
        }else{
            var excursionsCost = 0;
            var netExcursionsCost = 0;
        }
        
        if($('input[name="transfersCost"]').val()){
            var transfersCost = parseFloat($('input[name="transfersCost"]').val());
            var netTransfersCost = parseFloat($('input[name="transfersCost"]').attr("netCost"));
            //alert(netTransfersCost);
        }else{
            var transfersCost = 0;
             var netTransfersCost = 0;
        }
        //alert(netItemCost);
       // alert(netExcursionsCost);
        //alert(netTransferCost);
        var totalAddonsNetCost = parseInt(netItemCost) + parseInt(netExcursionsCost) + parseInt(netTransfersCost);
        $("input[name='addonsNetPrice']").val(totalAddonsNetCost);
        
        var totalCost = roomCost + flightTotalCost + itemsCost + excursionsCost + transfersCost;
        $('input[name="totalCost"]').val(totalCost);
        return totalCost;
    };
    
    var _calcFinalCost = function(){
        
        var discountType = parseInt($('input[name="discount"]').attr('data-discount-type'));
        
        var totalCost = _calcTotalCost();
        var discount = parseFloat($('input[name="discount"]').val());
        var merchantFee = parseFloat($('input[name="merchantFee"]').val());
        
         if(isNaN(discount) || isNaN(merchantFee)){
            discount = 0;
            merchantFee = 0;  
        }
        
        var cost = totalCost;
         //var cost = totalCost + merchantFee;
        
        var finalCost = 0;

        if(discountType == 2){
            discount = (cost * discount) / 100;   
        }
       
         //alert(discount);
        finalCost = cost - discount;
       // merchantFee = ((2.5/100)*finalCost).toFixed(2);
        if(parseInt(finalCost) == 0){
            $("#creat_pay").hide();
             $("#creat_draft").hide();
        }
//        else{
//             $("#creat_pay").show();
//             $("#creat_draft").show();
//        }
        
        $('input[name="finalCost"]').val(finalCost.toFixed(2));
        //$('input[name="merchantFee"]').val(merchantFee);
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
        
       
        //alert($('input[name="paymentType"]').val());
        
        if(daysBefore > 120){
             $('#deposit-hide').show();
             _defaultPaymentDueCal(finalCost)//anup
             
             
             if($('input[name="paymentType"]:checked').val() === '0'){
                 
                _before120Days(finalCost);
             }
        } 
        
        if(daysBefore <= 120 && daysBefore > 90){
            $('#deposit-hide').show();
                _defaultPaymentDueCal(finalCost)//anup
            if($('input[name="paymentType"]:checked').val() === '0'){
                _before90Days(finalCost);
             }
        }
        
        if (daysBefore <= 90 && daysBefore > 60) {
            $('#deposit-hide').show();
            _defaultPaymentDueCal(finalCost)//anup
            if ($('input[name="paymentType"]:checked').val() === '0') {
                _before90after60Days(finalCost);
            }
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
        
        //get payment deposit exception
        var extraType = $('input[name="dataExtraType"]').val();
        var id = $('input[name="dataTypeId"]').val();
        var startTrip = $('input[name="travelFrom"]').val();

         //_getDepositException(id,extraType,startTrip,null);
         
          _getDepositException(extraType,id,startTrip,null);//get deposit exception
        
        var depExcAmt = $('input[name="depositAmount"]').attr("depexamt");
        var depType = $('input[name="depositAmount"]').attr("depextyp");
        if(parseInt(depExcAmt)){
                if(parseInt(depType) == 1){
                    var depositAmount = (finalCost * parseInt(depExcAmt)) / 100;
                    var nextPaymentDue = ((finalCost * (100 - parseInt(depExcAmt))) / 100)/2;
                    var finalPaymentDue = nextPaymentDue;
                }else{
                    var depositAmount = parseInt(depExcAmt);
                    var nextPaymentDue = (finalCost - depositAmount)/2;
                    var finalPaymentDue = nextPaymentDue;
                }
        }else{
            var depositAmount = (finalCost * 20) / 100;
            var nextPaymentDue = (finalCost * 40) / 100;
            var finalPaymentDue = nextPaymentDue;
        }
        
        
//        var depositAmount = (finalCost * 20) / 100;
//        var nextPaymentDue = (finalCost * 40) / 100;
//        var finalPaymentDue = nextPaymentDue;

        var maxNextPaymentDue = new Date(parseInt(from[0]),parseInt(from[1])-1,parseInt(from[2]));

        maxNextPaymentDue = new Date(maxNextPaymentDue.getTime() - (90 * oneDay));

        var maxFinalPaymentDue = new Date(parseInt(from[0]),parseInt(from[1])-1,parseInt(from[2]));
        
        maxFinalPaymentDue = new Date(maxFinalPaymentDue.getTime() - (60 * oneDay));

        var pageAction = parseInt($('input[name="pageaction"]').val());//pageAction = 1 - new reservation
         if(parseInt($(".cnt:visible").length)==0){
            $('input[name="depositAmount"]').val(parseFloat(depositAmount).toFixed(2));
         }
        
        var merchantFee = ((2.5/100)*depositAmount).toFixed(2);
        $('input[name="merchantFee"]').val(merchantFee);
        
         if(parseInt($(".cnt:visible").length)==0){
            $('input[name="balansAfterDeposit"]').val(parseFloat(finalCost - depositAmount).toFixed(2));
         }
        
         $('#pay_first').show();
         if(parseInt($(".cnt:visible").length)==0){
            $('input[name="nextPaymentDue[]"]').val(parseFloat(nextPaymentDue).toFixed(2)).parent().parent().show();
            $('input[name="finalPaymentDue[]"]').val(parseFloat(finalPaymentDue).toFixed(2)).parent().parent().show();

            $('#dueDate1').val(maxNextPaymentDue.getFullYear()+'-'+(parseInt(maxNextPaymentDue.getMonth())+1)+'-'+maxNextPaymentDue.getDate());
            $('#dueDate2').val(maxFinalPaymentDue.getFullYear()+'-'+(parseInt(maxFinalPaymentDue.getMonth())+1)+'-'+maxFinalPaymentDue.getDate());

            $('#dueDate1').attr('max', maxNextPaymentDue).attr('required', 'required').parent().parent().show();
            $('#dueDate2').attr('max', maxFinalPaymentDue).attr('required', 'required').parent().parent().show();
         }
    };
    
    var _before90Days = function(finalCost){

        var from = $('input[name="travelFrom"]').val().split("-");
        var oneDay = 24*60*60*1000;
        
        var extraType = $('input[name="dataExtraType"]').val();
        var id = $('input[name="dataTypeId"]').val();
        var startTrip = $('input[name="travelFrom"]').val();

        _getDepositException(extraType,id,startTrip,null);//get deposit exception
        
        var depExcAmt = $('input[name="depositAmount"]').attr("depexamt");
        var depType = $('input[name="depositAmount"]').attr("depextyp");
        if(parseInt(depExcAmt)){
                if(parseInt(depType) == 1){
                    var depositAmount = (finalCost * parseInt(depExcAmt)) / 100;
                    var nextPaymentDue = (finalCost * (100 - parseInt(depExcAmt))) / 200;
                    var finalPaymentDue = nextPaymentDue;
                }else{
                   var depositAmount =  parseInt(depExcAmt);
                    var nextPaymentDue = (finalCost - depositAmount)/2;
                    var finalPaymentDue = nextPaymentDue;
                }
        }else{
            var depositAmount = (finalCost * 40) / 100;
            var nextPaymentDue = (finalCost * 30) / 100;
            var finalPaymentDue = nextPaymentDue;
        }
        
        var maxNextPaymentDue = new Date(parseInt(from[0]), parseInt(from[1])-1, parseInt(from[2]));
        maxNextPaymentDue = new Date(maxNextPaymentDue.getTime() - (80 * oneDay));
        
        var maxFinalPaymentDue = new Date(parseInt(from[0]),parseInt(from[1])-1,parseInt(from[2]));
        
        maxFinalPaymentDue = new Date(maxFinalPaymentDue.getTime() - (60 * oneDay));
         var pageAction = parseInt($('input[name="pageaction"]').val());//pageAction = 1 - new reservation
          if(parseInt($(".cnt:visible").length)==0){
            $('input[name="depositAmount"]').val(parseFloat(depositAmount).toFixed(2)).show();
          }
        var merchantFee = ((2.5/100)*depositAmount).toFixed(2);
        $('input[name="merchantFee"]').val(merchantFee);
        
        if(parseInt($(".cnt:visible").length)==0){
            $('input[name="balansAfterDeposit"]').val(finalCost - depositAmount.toFixed(2)).show();
        }
       // $('input[name="nextPaymentDue[]"]').val(null).parent().parent().hide();
        $('#pay_first').show();
        if(parseInt($(".cnt:visible").length)==0){
            $('#dueAmount2').val(parseFloat(finalPaymentDue).toFixed(2)).show();
            $('input[name="nextPaymentDue[]"]').val(parseFloat(nextPaymentDue).toFixed(2)).parent().parent().show();

            //$('input[name="dueDate1"]').removeAttr('required').val(null).parent().parent().hide();
            //$('input[name="dueDate2"]').attr('max', maxFinalPaymentDue).attr('required', 'required').show();
            $('#dueDate1').val(maxNextPaymentDue.getFullYear()+'-'+(parseInt(maxNextPaymentDue.getMonth())+1)+'-'+maxNextPaymentDue.getDate());
            $('#dueDate1').attr('max', maxNextPaymentDue).attr('required', 'required').parent().parent().show();

            $('#dueDate2').val(maxFinalPaymentDue.getFullYear()+'-'+(parseInt(maxFinalPaymentDue.getMonth())+1)+'-'+maxFinalPaymentDue.getDate());
            $('#dueDate2').attr('max', maxFinalPaymentDue).attr('required', 'required').parent().parent().show();
        }
    };
    
    
    var _before90after60Days = function(finalCost) {
        var from = $('input[name="travelFrom"]').val().split("-");
        var oneDay = 24*60*60*1000;
        
        var extraType = $('input[name="dataExtraType"]').val();
        var id = $('input[name="dataTypeId"]').val();
        var startTrip = $('input[name="travelFrom"]').val();

        _getDepositException(extraType,id,startTrip,null);//get deposit exception
        
        var depExcAmt = $('input[name="depositAmount"]').attr("depexamt");
        var depType = $('input[name="depositAmount"]').attr("depextyp");
        if(parseInt(depExcAmt)){
                if(parseInt(depType) == 1){
                    var depositAmount = (finalCost * parseInt(depExcAmt)) / 100;
                    var finalPaymentDue = (finalCost * (100 - parseInt(depExcAmt))) / 100;
                }else{
                   var depositAmount =  parseInt(depExcAmt);
                    var finalPaymentDue = (finalCost - depositAmount);
                }
        }else{
            var depositAmount = (finalCost * 50) / 100;
            var finalPaymentDue = (finalCost * 50) / 100;
        }
        
        var pageAction = parseInt($('input[name="pageaction"]').val());//pageAction = 1 - new reservation
        var maxFinalPaymentDue = new Date(parseInt(from[0]),parseInt(from[1])-1,parseInt(from[2]));

        maxFinalPaymentDue = new Date(maxFinalPaymentDue.getTime() - (45 * oneDay));
        
        if(parseInt($(".cnt:visible").length)==0){
            $('input[name="depositAmount"]').val(parseFloat(depositAmount).toFixed(2)).show();
        }
        
        var merchantFee = ((2.5/100)*depositAmount).toFixed(2);
        $('input[name="merchantFee"]').val(merchantFee);
          if(parseInt($(".cnt:visible").length)==0){
            $('input[name="balansAfterDeposit"]').val(finalCost - depositAmount.toFixed(2)).show();
          }
       // $('input[name="nextPaymentDue[]"]').val(null).parent().parent().hide();
       
        //if(pageAction == 1){
            $('#pay_first').hide();
        //}
        if(parseInt($(".cnt:visible").length)==0){
        $('#dueAmount2').val(parseFloat(finalPaymentDue).toFixed(2)).show();
        }
       // $('input[name="nextPaymentDue[]"]').val(parseFloat(nextPaymentDue).toFixed(2)).parent().parent().show();
        
        //$('input[name="dueDate1"]').removeAttr('required').val(null).parent().parent().hide();
        //$('input[name="dueDate2"]').attr('max', maxFinalPaymentDue).attr('required', 'required').show();
        //$('#dueDate1').val(maxNextPaymentDue.getFullYear()+'-'+maxNextPaymentDue.getMonth()+'-'+maxNextPaymentDue.getDate());
        //$('#dueDate1').attr('max', maxNextPaymentDue).attr('required', 'required').parent().parent().show();
        if(parseInt($(".cnt:visible").length)==0){
        $('#dueDate2').val(maxFinalPaymentDue.getFullYear()+'-'+(parseInt(maxFinalPaymentDue.getMonth())+1)+'-'+maxFinalPaymentDue.getDate());
        $('#dueDate2').attr('max', maxFinalPaymentDue).attr('required', 'required').parent().parent().show();
        }
    }
    
    var _before60Days = function(finalCost){
        $('input[name="depositAmount"]').val(parseFloat(finalCost).toFixed(2)).show();
        
        var merchantFee = ((2.5/100)*finalCost).toFixed(2);
        $('input[name="merchantFee"]').val(merchantFee);
        
        $('input[name="nextPaymentDue[]"]').val(null);
        $('input[name="finalPaymentDue[]"]').val(null);
        $('input[name="balansAfterDeposit"]').val(0);
        $('input[name="dueDate2"]').removeAttr('required').val(null);
        $('input[name="dueDate2"]').removeAttr('required').val(null);
        
        
    };
    
    var _addTraveller = function(){
        var appendDiv = $('#add-traveller').html();
        var noOfPerson = $('input[name="noOfPersons"]');
        
        var pageAction = $('input[name="pageaction"]').val();//pageAction = 1 - new reservation
        
        if(pageAction == 0){
//             var t = confirm("Adding more travellers may affect your nightly cost");
//             if(t == true){
             var type = $('input[name="type"]').val();
             var roomId = $('input[name="roomCategory"]').val();
            if (typeof roomId === "undefined") {
                var roomId = $("select[name='roomCategory']").attr("chosen");
            }
             if(!roomId){
                var roomId = $('input[name="roomCategory"]').attr("chosen");
             }
            _getRoomsAvailability(roomId,type);  
            _bindNoOfDays();
//             }else{
//               $(".added-traveller").last().remove();
//               return true;
//             }
             //_dateValid(type);
              
        }
        
        var totalTravellerCount = parseInt($("#inv_data").attr("f"))+parseInt($("#inv_data").attr("m"));
        if(totalTravellerCount > parseInt(noOfPerson.val())){
            $('#traveller-info').append(appendDiv);
             noOfPerson.val(parseInt(noOfPerson.val())+ 1);
             
              var nop = parseInt($('input[name="noOfPersons"]').val());
            var searchNop = parseInt($("#inv_data").attr("search_m")) + parseInt($("#inv_data").attr("search_f"))
            var checkSet = $(".remove-traveller").hasClass("isset");
            var pageAction = parseInt($('input[name="pageaction"]').val());//pageAction = 1 - new reservation         

            if (nop > searchNop || checkSet == true || pageAction == 0) {
                var t = confirm("Adding more travellers may affect your nightly cost");
                if (t == false) {
                    $(".added-traveller").last().remove();
                     noOfPerson.val(parseInt(noOfPerson.val())- 1);
                }
            }
             
              if($('input[name="inv_data"]').attr('pPer') == 1){// condition for room rate for per person
                //alert($('input[name="roomRate"]').val()); 
                $('input[name="roomRate"]').val(parseInt(noOfPerson.val()) * parseInt($('input[name="roomRate"]').attr('fixPrice')) );
                  _calcFinalCost();
            }
        }else{
             $(".remove-traveller").addClass("isset");
            alert("Sorry, You cannot add more.");
        }
        
        $("#male_11").attr("id","male_"+noOfPerson.val());
        $("#female_11").attr("id","female_"+noOfPerson.val());
        $("#male_"+noOfPerson.val()).attr("name","tsex_"+noOfPerson.val());
        $("#female_"+noOfPerson.val()).attr("name","tsex_"+noOfPerson.val());
        $("#labm_11").attr("for","male_"+noOfPerson.val());
        $("#labm_11").attr("id","male_"+noOfPerson.val());
        $("#labf_11").attr("for","female_"+noOfPerson.val())
        $("#labf_11").attr("id","female_"+noOfPerson.val())
        
        $("#dob_11").attr("id","dob_"+noOfPerson.val());
        
          $("#dob_"+noOfPerson.val()).Zebra_DatePicker({
                    format: 'Y-m-d',
                });
        
        //noOfPerson.val(parseInt(noOfPerson.val())+ 1);
    };
    
    var _removeTraveller = function(){
        //$(this).parents('.added-traveller').remove();
        $(".added-traveller").last().remove();
        var noOfPerson = $('input[name="noOfPersons"]');
        if(parseInt(noOfPerson.val()) > 1){
         noOfPerson.val(parseInt(noOfPerson.val())- 1);
         //if(parseInt($("#check-date-change").val()) == 1){//condition will be applied when date changes on reservation form
        // if($('input[name="inv_data"]').attr('pPer') == 1){// condition for room rate for per person
          //  $('input[name="roomRate"]').val(parseInt(noOfPerson.val()) * parseInt($('input[name="roomRate"]').attr("fixPrice")) );
             _calcFinalCost();
        //}
          $(".remove-traveller").addClass("isset");
          _newPriceIfGreaterOccupancy();
         //}
        }
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
    
    var _dateValid = function (type){
        var start = $("#hid-start").val();
        var end = $("#hid-end").val();
        
        var start_modify = $("#hid-mod-start").val();
        var end_modify_two = $("#hid-mod-end-two").val();
        var end_modify = $("#hid-mod-end").val();
        var oneDay = 24*60*60*1000;
        var min_stay_days = 5;
        var roomId = $("input[name='roomCategory']").val();

        

//        var start = new Date(parseInt(start[0]),parseInt(start[1]),parseInt(start[2]));
//        start = new Date(start.getTime() - (5 * oneDay));
//        start = start.getFullYear()+"-"+start.getMonth()+"-"+start.getDate();
//        var end = new Date(parseInt(end[0]),parseInt(end[1]),parseInt(end[2]));
//        end = new Date(end.getTime() +  (5 * oneDay));
//        end = end.getFullYear()+"-"+end.getMonth()+"-"+end.getDate();

    if(type == 2){
       $('#dateFrom').Zebra_DatePicker({
              direction: [start_modify.toString(),end_modify_two.toString()],
              zero_pad : true,
              onSelect: function(date, dateFormat, dateObj, ev) {
                var minDays = new Date(start.toString());
                if (minDays.getTime() > dateObj.getTime()) {
                    dateObj = minDays;
                }
                dateObj.setDate(dateObj.getDate() + parseInt(min_stay_days));
                var day = (dateObj.getDate().toString().length) < 2 ? ('0' + dateObj.getDate()) : dateObj.getDate();
                var month = ((dateObj.getMonth() + 1).toString().length) < 2 ? ('0' + (dateObj.getMonth() + 1)) : dateObj.getMonth() + 1;
                var date = dateObj.getFullYear() + '-' + month + '-' + day;
//                
//                $('#dateTo').Zebra_DatePicker({
//                    format: 'Y-m-d',
//                    show_clear_date: false,
//                    direction: [date.toString(), end_modify.toString()],
//                    onSelect : function(){
//                        var roomId = $("input[name='roomCategory']").val();
//                        if(typeof roomId === "undefined"){
//                        var roomId = $("select[name='roomCategory']").attr("chosen");
//                    }
//                        _getRoomsAvailability(roomId,type);
//                        $("#check-date-change").val(1);
//                    }
//                });
                   _bindNoOfDays();
                   var roomId = $("input[name='roomCategory']").val();
                   if(typeof roomId === "undefined"){
                        var roomId = $("select[name='roomCategory']").attr("chosen");
                    }
                   _getRoomsAvailability(roomId,type);
                   $("#check-date-change").val(1);
              },
             onClear: function() {
                $('#dateTo').attr('disabled', 'disabled');
                $('#dateTo').attr('value', '');
            }
        })
              $('#dateTo').Zebra_DatePicker({
              direction: [end.toString(),end_modify.toString()],
              zero_pad : true,
              onSelect: function(date, dateFormat, dateObj, ev) {
                   _bindNoOfDays();
                   var roomId = $("input[name='roomCategory']").val();
                   if(typeof roomId === "undefined"){
                        var roomId = $("select[name='roomCategory']").attr("chosen");
                    }
                   _getRoomsAvailability(roomId,type);
                   $("#check-date-change").val(1);
              }
        })
        
    }else if(type == 3){
         $('#dateFrom').Zebra_DatePicker({
              direction: [start.toString(),end.toString()],
              zero_pad : true,
              onSelect: function(date, dateFormat, dateObj, ev) {
                    var day = (dateObj.getDate().toString().length) < 2 ? ('0' + dateObj.getDate()+1) : dateObj.getDate()+1;

                    var month = ((dateObj.getMonth() + 1).toString().length) < 2 ? ('0' + (dateObj.getMonth() + 1)) : dateObj.getMonth() + 1;
                    var date = dateObj.getFullYear() + '-' + month + '-' + day;
//                    $('#dateTo').Zebra_DatePicker({
//                    format: 'Y-m-d',
//                    show_clear_date: false,
//                    direction: [date.toString(), end.toString()],
//                    onSelect:function (){
//                        var roomId = $("input[name='roomCategory']").val();
//                        if(typeof roomId === "undefined"){
//                        var roomId = $("select[name='roomCategory']").attr("chosen");
//                    }
//                        _getRoomsAvailability(roomId,type);
//                        $("#check-date-change").val(1);
//                    }
//                });
                  _bindNoOfDays();
                  var roomId = $("input[name='roomCategory']").val();
                  if(typeof roomId === "undefined"){
                        var roomId = $("select[name='roomCategory']").attr("chosen");
                    }
                  _getRoomsAvailability(roomId,type);
                  $("#check-date-change").val(1);
              }
         });
         
         $('#dateTo').Zebra_DatePicker({
              direction: [start.toString(),end.toString()],
              zero_pad : true,
              onSelect: function() {
                   _bindNoOfDays();
                   var roomId = $("input[name='roomCategory']").val();
                   if(typeof roomId === "undefined"){
                        var roomId = $("select[name='roomCategory']").attr("chosen");
                    }
                   _getRoomsAvailability(roomId,type);
                   $("#check-date-change").val(1);
              }
        })
    }else{
        $('#dateFrom').Zebra_DatePicker({
              onSelect: function(date, dateFormat, dateObj, ev) {
                   var day = ((dateObj.getDate()).toString().length) < 2 ? ('0' + dateObj.getDate()) : dateObj.getDate()+1;
                    var month = ((dateObj.getMonth() + 1).toString().length) < 2 ? ('0' + (dateObj.getMonth()+1 )) : dateObj.getMonth()+1;
                    var date = dateObj.getFullYear()  + '-' + month + '-' + day;
                    var end =  (dateObj.getFullYear()+1)  + '-' + month + '-' + day;
//                    $('#dateTo').Zebra_DatePicker({
//                    format: 'Y-m-d',
//                    show_clear_date: false,
//                    direction: [date.toString(), end.toString()],
//                    onSelect: function() {
//                    _bindNoOfDays();
//                    var roomId = $("input[name='roomCategory']").val();
//                    if(typeof roomId === "undefined"){
//                        var roomId = $("select[name='roomCategory']").attr("chosen");
//                    }
//                   _getRoomsAvailability(roomId,type);
//                     $("#check-date-change").val(1);
//                    }
//                });
                $('#dateTo').val(date);
                _bindNoOfDays();
                var roomId = $("input[name='roomCategory']").val();
                    if (typeof roomId === "undefined") {
                        var roomId = $("select[name='roomCategory']").attr("chosen");
                    }
                 _getRoomsAvailability(roomId,type);
                 $("#check-date-change").val(1);
              }
        })
        
        $('#dateTo').Zebra_DatePicker({
                    onSelect: function() {
                        var roomId = $("input[name='roomCategory']").val();
                        if (typeof roomId === "undefined") {
                        var roomId = $("select[name='roomCategory']").attr("chosen");
                    }
                    _getRoomsAvailability(roomId,type);
                    $("#check-date-change").val(1);
                    }
                });
    }

    }
    
    
    var _getRoomsAvailability = function (roomId,type){
        var start = $('input[name="travelFrom"]').val();
         var end = $('input[name="travelTo"]').val();
         $.post('/admin/orders/ajax/rooms-available', {roomId : roomId,start:start,end:end , type:type}, function(data) {
              
	       if(parseInt(data.count) <= 0){
                 data.count = 0;
                  $("#creat_pay").hide();
             } else{
                 $("#creat_pay").show();
             }
	      $("#inventory_room_available").html((parseInt(data.count)) + " Rooms Available");
              var priceData = data.data;
              var price = 0;
              var netPrice = 0;
              var finalAvgPrice = 0;
              var finalAvgNetPrice = 0;
              var i = 0;
              $.each(priceData, function(key, value) {
                  price = parseInt(value.grossPrice);
                  finalAvgPrice += price;
                  
                  netPrice = parseInt(value.netPrice);
                  finalAvgNetPrice += netPrice;
                  i++;
            });
            $('input[name="roomRate"]').val(finalAvgPrice/i);
            $('input[name="roomNetPrice"]').val(finalAvgNetPrice/i);
             $('input[name="roomRate"]').attr('fixPrice',finalAvgPrice/i);
            $("#inv_data").attr("dOp",finalAvgPrice/i);
            _checkTavellersSexCount(data);
            _newPriceIfGreaterOccupancy();
             _calcFinalCost();
           });
    }
    
    var _addDuePayment = function(){
        var appendDiv = $('#add-duedate').html();
        $('#due-date').append(appendDiv);
        $('.duedate').Zebra_DatePicker();
        _getAmountDues();
    };
    
    var _removeDuePayment = function(){
        $(this).parents('.added-duedates').remove();
        _getAmountDues();
    };
    
    var _getTotalExcursionsCost = function() {
        var excursionsCost = 0;
        var excursionCostNet = 0;
        $.each($('input[name="excursions[]"]:checked'), function() {
            excursionsCost = excursionsCost + parseFloat($(this).attr('grossPrice'));
            excursionCostNet = excursionCostNet + parseFloat($(this).attr('netPrice'));
        });
        $('input[name="excursionsCost"]').val(excursionsCost);
        $('input[name="excursionsCost"]').attr("netCost",excursionCostNet);
        
        _calcFinalCost();
    };
    
    var _getTotalTransfersCost = function() {
        var transfersCost = 0;
        var transfersCostNet = 0;
        $.each($('input[name="transfers[]"]:checked'), function() {
            transfersCost = transfersCost + parseFloat($(this).attr('grossPrice'));
            transfersCostNet = transfersCostNet + parseFloat($(this).attr('netPrice'));
        });

        $('input[name="transfersCost"]').val(transfersCost);
         $('input[name="transfersCost"]').attr("netCost",transfersCostNet);
        
        _calcFinalCost();
    };
    //resort and cruise functions
    
    var _dateSelect = function(type,id,resource){
        
        $('#dateFrom').Zebra_DatePicker({
              onSelect: function(date, dateFormat, dateObj, ev) {
                   var day = (dateObj.getDate().toString().length) < 2 ? ('0' + dateObj.getDate()+1) : dateObj.getDate()+1;
                    var month = ((dateObj.getMonth() + 1).toString().length) < 2 ? ('0' + (dateObj.getMonth() + 1)) : dateObj.getMonth() + 1;
                    var date = dateObj.getFullYear()  + '-' + month + '-' + day;
                    var end =  (dateObj.getFullYear()+1)  + '-' + month + '-' + day;
                    $('#dateTo').Zebra_DatePicker({
                    format: 'Y-m-d',
                    show_clear_date: false,
                    direction: [date.toString(), end.toString()],
                    onSelect: function() {
                    _loadEntityRooms(type,id,resource);
                    _bindNoOfDays();
                    }
                });
                $('#dateTo').val("");
                _bindNoOfDays();
              }
        })
//              $('#dateTo').Zebra_DatePicker({
//              onSelect: function() {
//                    if($("#dateFrom").val()){
//                        alert("ddd");
//                    _loadEntityRooms(type,id,resource);
//                    }else{
//                        alert("Select From Date First");
//                    }
//              }
//        })
    }
    
//    var _getInventoryData = function(type,id){
//       
//        $.post('/admin/orders/ajax/',{id:id, type: type,dateFrom:$("#dateFrom").val(),dateTo:$("#dateTo").val() }, function(data){
//            if(data.status != 0){
//               _bindItemData(data.result,type);
//            }else{
//                alert(data.result);
//            }
//           });
//    }
    
    var _loadEntityRooms = function(type,id,resource) {
        var dateFrom = $("#dateFrom").val();
        var dateTo = $("#dateTo").val();
        if(id){
            $.post('/admin/orders/ajax/' + resource +id,{id:id,dateFrom:dateFrom,dateTo:dateTo}, function(data){            
                $('#ajax-what').html(data);
                //_bindItemData(data.result,type);
                $('.chzn-select').chosen();
            });
        }

        _clearAll();
    };
    
    var _checkTavellersSexCount =  function (data){
        data = data.data;
        var m=[];
        var f =[];
        var tOcp =[];
        var tOcpF = 0;
        var tOcpM = 0;
        var qOcp = [];
        var qOcpF = 0;
        var qOcpM = 0;
        var sOcp = [];
        var sOcpG = 0;
        var pPer = 0;
        var i =0 ;
        
         $.each(data, function(key, value) {
            if(value.males){
                m.push(value.males); 
            }
             if(value.females){
                 f.push(value.females); 
            }
            if (value.tripleOccupancy) {
                    tOcp.push(value.tripleOccupancy);
                    
                if (value.triplePriceFemaleGross) {
                        //tOcpF.push(value.triplePriceFemaleGross);
                        var price = 0;
                        price = parseInt(value.triplePriceFemaleGross);
                        tOcpF += price;
                }
                
                if (value.triplePriceMaleGross) {
                        //tOcpM.push(value.triplePriceMaleGross);
                        var price = 0;
                        price = parseInt(value.triplePriceMaleGross);
                        tOcpM += price;
                }
            }
                
                
            if(value.quadOccupancy){
             
                    qOcp.push(value.quadOccupancy); 
                if(value.quadPriceFemaleGross){
                    //qOcpF.push(value.quadPriceFemaleGross);
                    var price = 0;
                     price = parseInt(value.quadPriceFemaleGross);
                        qOcpF += price;
           }

                if(value.quadPriceMaleGross){
                     //qOcpM.push(value.quadPriceMaleGross);
                     var price = 0;
                    price = parseInt(value.quadPriceMaleGross);
                        qOcpM += price; 
               }
            }
                  
            if(value.singlePremiumOccupancy){
                sOcp.push(value.singlePremiumOccupancy);
                  if(value.single_price_gross){
                    //sOcpG.push(value.single_price_gross);
                    var price = 0;
                    price = parseInt(value.single_price_gross);
                        sOcpG += price; 
                  }
              }
              
               if(value.pricePer){
                  pPer =  parseInt(value.pricePer);
              }

                    i++;
                    
//                    var finalAvgPrice = (2 * parseInt($("#inv_data").attr("tOcpF")))+(parseInt($("#inv_data").attr("tOcpM")))
//                   $('input[name="roomRate"]').val(finalAvgPrice);
//             _calcFinalCost();
            });
         var pageAction = $('input[name="pageaction"]').val();//pageAction = 1 - new reservation         
         if(parseInt(pageAction) == 0){
                    $("#inv_data").attr("search_m", Math.max(parseInt(m)));
                    $("#inv_data").attr("search_f", Math.max(parseInt(f)));
                    }
                    $("#inv_data").attr("m", Math.max(parseInt(m)));
                    $("#inv_data").attr("f", Math.max(parseInt(f)));
                    
                    $("#inv_data").attr("mc", Math.max(parseInt(m)));
                    $("#inv_data").attr("fc", Math.max(parseInt(f)));
                    
                    $("#inv_data").attr("tOcp", Math.max(parseInt(tOcp)));
                    $("#inv_data").attr("tOcpF", parseInt(tOcpF)/i);
                    $("#inv_data").attr("tOcpM", parseInt(tOcpM)/i);
                    $("#inv_data").attr("qOcp", Math.max(parseInt(qOcp)));
                    $("#inv_data").attr("qOcpF", parseInt(qOcpF)/i);
                    $("#inv_data").attr("qOcpM",parseInt(qOcpM)/i);
                    $("#inv_data").attr("sOcp", Math.max(parseInt(sOcp)));
                    $("#inv_data").attr("sOcpG", parseInt(sOcpG)/i);
                    $("#inv_data").attr("pPer", parseInt(pPer));
    }
    
     max = function() {
                var max = this[0];
                var len = this.length;
                for (var i = 1; i < len; i++)
                    if (this[i] > max)
                        max = this[i];
                return max;
            }
    min = function() {
        var min = this[0];
        var len = this.length;
        for (var i = 1; i < len; i++)
            if (this[i] < min)
                min = this[i];
        return min;
    }
     _newPriceIfGreaterOccupancy = function(){
        var noOfPerson = $('input[name="noOfPersons"]').val();

        var noOfMales = parseInt($('.set').length);
        var noOfFemales = parseInt($('.fset').length);
        
        var tOcp = parseInt($("#inv_data").attr("tocp"));
        var tOcpM = parseInt($("#inv_data").attr("tocpm"));
        var tOcpF = parseInt($("#inv_data").attr("tocpf"));
        var dOcp = parseInt($("#inv_data").attr("dOp"));
        var qOcp = parseInt($("#inv_data").attr("qocp"));
        var qOcpM = parseInt($("#inv_data").attr("qocpm"));
        var qOcpF = parseInt($("#inv_data").attr("qocpf"));
        var pricePer = parseInt($("#inv_data").attr("pper"));
       // alert(noOfFemales);
       if(pricePer == 1){
//            var finalRoomRate = parseInt($("#inv_data").attr("dOp"))* noOfPerson ;
//            $('input[name="roomRate"]').val(finalRoomRate);
//            _calcFinalCost();
             switch (noOfPerson) {
            case '1':
                var pricePer = parseInt($("#inv_data").attr("dOp"));
                var singleOcpAl = parseInt($("#inv_data").attr("socp"));
                if(singleOcpAl){
                    var finalRoomRate = parseInt($("#inv_data").attr("socpg"))* noOfPerson ;
                    $('input[name="roomRate"]').val(finalRoomRate);
                    _calcFinalCost();
                }else{
                    $('input[name="roomRate"]').val(parseInt($("#inv_data").attr("dOp")));
                    _calcFinalCost();
                }
                break;
                
            case '2':
                var pricePer = parseInt($("#inv_data").attr("dOp"));
                    var finalRoomRate = pricePer*2;
                    $('input[name="roomRate"]').val(finalRoomRate);
                    _calcFinalCost();

                break;
            case '3':
                    if (tOcp) {
                        var finalRoomRate = dOcp*2;
                        if (noOfMales > 1) {
                            finalRoomRate += tOcpM;
                        } else {
                            finalRoomRate += tOcpF;
                        }
                         $('input[name="roomRate"]').val(finalRoomRate);
                        _calcFinalCost();
                    } else {
                        finalRoomRate = 0;
                        $('input[name="roomRate"]').val(finalRoomRate);
                        alert("Triple Occupancy not allowed.");
                        _calcFinalCost();
                    }
                break;
            case '4':
                    if (qOcp == 1) {
                        finalRoomRate = dOcp*2;
                        if ((noOfMales == 2 && noOfFemales == 2)) {
                            finalRoomRate = dOcp*2 + qOcpM + qOcpF;
                        } else if (noOfMales > 2) {
                            finalRoomRate = dOcp*2 + (qOcpM * 2);
                        } else if (noOfFemales > 2) {
                            finalRoomRate = dOcp*2 + (qOcpF * 2);
                        }
                    } else {
                        finalRoomRate = 0;
                        alert("Quad Occupancy not allowed")
                    }
                    $('input[name="roomRate"]').val(finalRoomRate);
                    _calcFinalCost();
                break;
        }
       }
       else{
        switch (noOfPerson) {
            case '1':
                var pricePer = parseInt($("#inv_data").attr("dOp"));
                var singleOcpAl = parseInt($("#inv_data").attr("socp"));
                if(singleOcpAl){
                    var finalRoomRate = parseInt($("#inv_data").attr("socpg"))* noOfPerson ;
                    $('input[name="roomRate"]').val(finalRoomRate);
                    _calcFinalCost();
                }else{
                    $('input[name="roomRate"]').val(parseInt($("#inv_data").attr("dOp")));
                    _calcFinalCost();
                }
                break;
                
            case '2':
                var pricePer = parseInt($("#inv_data").attr("dOp"));
                    var finalRoomRate = pricePer;
                    $('input[name="roomRate"]').val(finalRoomRate);
                    _calcFinalCost();

                break;
            case '3':
                    if (tOcp) {
                        var finalRoomRate = dOcp;
                        if (noOfMales > 1) {
                            finalRoomRate += tOcpM;
                        } else {
                            finalRoomRate += tOcpF;
                        }
                         $('input[name="roomRate"]').val(finalRoomRate);
                        _calcFinalCost();
                    } else {
                        finalRoomRate = dOcp * noOfPerson;
                        $('input[name="roomRate"]').val(finalRoomRate);
                        _calcFinalCost();
                    }
                break;
            case '4':
                    if (qOcp == 1) {
                        finalRoomRate = dOcp;
                        if ((noOfMales == 2 && noOfFemales == 2)) {
                            finalRoomRate = dOcp + qOcpM + qOcpF;
                        } else if (noOfMales > 2) {
                            finalRoomRate = dOcp + (qOcpM * 2);
                        } else if (noOfFemales > 2) {
                            finalRoomRate = dOcp + (qOcpF * 2);
                        }
                    } else {
                        finalRoomRate = dOcp * noOfPerson;
                    }
                    $('input[name="roomRate"]').val(finalRoomRate);
                    _calcFinalCost();
                break;
        }
       }
    }
    
    var _getDepositException = function(type,typeId,dateFrom,dateTo){
//          var typeId = 64; //typeId = resortId/EventId/CruiseId
//          var type = 2; //type = resort/cruise/events
//          var dateFrom = '2014-08-08';
//          var dateTo = '2014-08-06';
//          $.post('/admin/orders/ajax/get-deposit-exception',{typeId:typeId,type:type,dateFrom:dateFrom,dateTo:dateTo}, function(data){            
//             
//            });
            
             $.ajax({
                async:false,    
                url: '/admin/orders/ajax/get-deposit-exception',
                type: 'POST',
                data: {typeId:typeId,type:type,dateFrom:dateFrom,dateTo:dateTo},
                success: function(data){

                   if (data.length > 0) {
                    $('input[name="depositAmount"]').attr('depExAmt', data[0].amount);
                    $('input[name="depositAmount"]').attr('depExTyp', data[0].type);
                } else {
                    $('input[name="depositAmount"]').attr('depExAmt', 0);
                    $('input[name="depositAmount"]').attr('depExTyp', 0);
                }
                }
            });
    }
    
    var _loadDiscount = function(){
        $('input[name="discount"]').attr('data-discount-type',$(this).val());
        $("#disc-field").show();
        _calcFinalCost();
    }
    
    var _getInventoryData = function (roomId,type){
        var start = $('input[name="travelFrom"]').val();
         var end = $('input[name="travelTo"]').val();
         $.post('/admin/orders/ajax/rooms-available', {roomId : roomId,start:start,end:end , type:type}, function(data) {
           
              var priceData = data.data;
              var price = 0;
              var finalAvgPrice = 0;
              var netPrice = 0;
              var finalAvgNetPrice = 0;
              var i = 0;
              $.each(priceData, function(key, value) {
                  price = parseInt(value.grossPrice);
                  finalAvgPrice += price;
                  
                  netPrice = parseInt(value.netPrice);
                  finalAvgNetPrice += netPrice;
                  i++;
            });

            $('input[name="roomNetPrice"]').val(finalAvgNetPrice/i);
            $("#inv_data").attr("dOp",finalAvgPrice/i);
            _checkTavellersSexCount(data);
           });
    }
    
    var _getAmountDues = function() {


        var today = $('#today').val().split("-");
        var startTrip = $('input[name="travelFrom"]').val().split("-");
        var daysBefore = _getDiffDays(today, startTrip);
        var finalCost = $('input[name="finalCost"]').val();


        //alert(finalCost);
        var orgdepositAmount = $('input[name="depositAmount"]').val();

        //var from = $('input[name="travelFrom"]').val().split("-");



       // var maxFinalPaymentDue = new Date(parseFloat(from[0]), parseFloat(from[1]), parseFloat(from[2]));

        //if (daysBefore <= 90 && daysBefore > 60) {

//
//            var oneDay = 24 * 60 * 60 * 1000;
//
//            var min = (finalCost * 50) / 100;
//
//            maxFinalPaymentDue = new Date(maxFinalPaymentDue.getTime() - (45 * oneDay));
//
//            var mnth = ("0" + (maxFinalPaymentDue.getMonth())).slice(-2);
//
//            var dayss = ("0" + maxFinalPaymentDue.getDate()).slice(-2);
//
//            var datesour = maxFinalPaymentDue.getFullYear() + '-' + mnth + '-' + dayss;

            //$('input[name="dueDate2"]').val(maxFinalPaymentDue.getFullYear() + '-' + mnth + '-' + dayss);

//            $('#dueDate2').Zebra_DatePicker({
//                direction: [$('#today').val(), datesour]
//
//            })

           // $('input[name="depositAmount"]').attr('min', min.toFixed(2));
            //$('input[name="depositAmount"]').attr('max', finalCost - 1);

           // $('input[name="balansAfterDeposit"]').val((finalCost - depositAmount).toFixed(2)).show();

            //var finalPaymentDue = $('input[name="balansAfterDeposit"]').val();



            //$('input[name="finalPaymentDue"]').val(finalPaymentDue).show();

        //}

//        if (daysBefore > 120) {
//
//            var min = (finalCost * 20) / 100;
//            $('input[name="balansAfterDeposit"]').val((finalCost - depositAmount).toFixed(2));
//            var balance = $('input[name="balansAfterDeposit"]').val();
//            var nextPaymentDue = ((balance * 50) / 100).toFixed(2);
//            var finalPaymentDue = nextPaymentDue;
//
//            $('input[name="depositAmount"]').attr('min', min.toFixed(2));
//            $('input[name="depositAmount"]').attr('max', finalCost - 1);
//
//            $('input[name="nextPaymentDue[]"]').val(nextPaymentDue).parent().parent().show();
//            $('input[name="finalPaymentDue"]').val(finalPaymentDue).parent().parent().show();
//
//           
//        }
//
//        if (daysBefore <= 120 && daysBefore > 90) {
//
//            //alert('here');
//            var min = (finalCost * 40) / 100;
//            $('input[name="balansAfterDeposit"]').val((finalCost - depositAmount).toFixed(2));
//            var balance = $('input[name="balansAfterDeposit"]').val();
//            var nextPaymentDue = ((balance * 50) / 100).toFixed(2);
//            var finalPaymentDue = nextPaymentDue;
//
//            $('input[name="depositAmount"]').attr('min', min.toFixed(2));
//            $('input[name="depositAmount"]').attr('max', finalCost - 1);
//
//            $('input[name="nextPaymentDue[]"]').val(nextPaymentDue).parent().parent().show();
//            $('input[name="finalPaymentDue"]').val(finalPaymentDue).parent().parent().show();
//
//        }

        if(daysBefore > 120){
        var depExcAmt = $('input[name="depositAmount"]').attr("depexamt");
        var depType = $('input[name="depositAmount"]').attr("depextyp");
        if(parseInt(depExcAmt)){
                if(parseInt(depType) == 1){
                    var depositAmount = (finalCost * parseInt(depExcAmt)) / 100;
                }else{
                    var depositAmount = parseInt(depExcAmt);
                }
        }else{
            var depositAmount = (finalCost * 20) / 100;
        }
            
            $('input[name="depositAmount"]').attr('min', depositAmount.toFixed(2));
            $('input[name="depositAmount"]').attr('max', finalCost);
            $('input[name="balansAfterDeposit"]').val((finalCost - orgdepositAmount).toFixed(2)).show();
        }
        
          if(daysBefore <= 120 && daysBefore > 90){
              
            var depExcAmt = $('input[name="depositAmount"]').attr("depexamt");
            var depType = $('input[name="depositAmount"]').attr("depextyp");
            if (parseInt(depExcAmt)) {
                if (parseInt(depType) == 1) {
                    var depositAmount = (finalCost * parseInt(depExcAmt)) / 100;
                } else {
                    var depositAmount = parseInt(depExcAmt);
                }
            } else {
                var depositAmount = (finalCost * 40) / 100;
            }

            $('input[name="depositAmount"]').attr('min', depositAmount.toFixed(2));
            $('input[name="depositAmount"]').attr('max', finalCost);
            $('input[name="balansAfterDeposit"]').val((finalCost - orgdepositAmount).toFixed(2)).show();
              
        }
        
        if (daysBefore <= 90 && daysBefore > 60) {
            
            var depExcAmt = $('input[name="depositAmount"]').attr("depexamt");
            var depType = $('input[name="depositAmount"]').attr("depextyp");
            if (parseInt(depExcAmt)) {
                if (parseInt(depType) == 1) {
                    var depositAmount = (finalCost * parseInt(depExcAmt)) / 100;
                } else {
                    var depositAmount = parseInt(depExcAmt);
                }
            } else {
                var depositAmount = (finalCost * 50) / 100;
            }
            
            $('input[name="depositAmount"]').attr('min', depositAmount.toFixed(2));
            $('input[name="depositAmount"]').attr('max', finalCost);
            $('input[name="balansAfterDeposit"]').val((finalCost - orgdepositAmount).toFixed(2)).show();
        }
        
        
        
        var balansAfterDeposit = parseInt($('input[name="balansAfterDeposit"]').val());
        //alert(balansAfterDeposit);
        var len = parseInt($('.cnt:visible').length);
        var divideDueAmt = balansAfterDeposit / len;
        $('.cnt:visible').val(divideDueAmt.toFixed(2));
    };
    
    var _changeSubmit = function() {
        var depositMethod = parseInt($(this).val());
        var pageAction = parseInt($('input[name="pageaction"]').val());

        if (depositMethod == 1) {
            $("#creat_pay").val("Finish");
            $("#creat_pay").html("Finish");
            $('input[name="merchantFee"]').val(0);
        } else {
            $("#creat_pay").val("");
            if (pageAction == 1) {
                $("#creat_pay").html("Proceed To Billing");
            } else {
                $("#creat_pay").html("Update");
            }
            _calcFinalCost();
        }

    } 
    
    return {
        init: function() {
            _initListeners();
        },
    };
}();


function callPriceCal(check){
    var noOfMales = parseInt($('.set').length);
    var noOfFemales = parseInt($('.fset').length);
    var schMale = parseInt($("#inv_data").attr("m"));
    var schFemale = parseInt($("#inv_data").attr("f"));
    var res = (check.id).split("_"); 

    if(check.value == 1){
    if(noOfMales < schMale){
         var res = (check.id).split("_"); 
        $("#female_"+res[1]).removeClass("fset");
        $(check).addClass("set");
    }else{
         $("#female_"+res[1]).removeClass("fset");
         $(check).attr('checked', false);
        alert("Sorry ,Room Male Occupancy reached");
        
    }
}else{
     if(noOfFemales < schFemale){
        var res = (check.id).split("_");
        $("#male_"+res[1]).removeClass("set");
        $(check).addClass("fset");
    }else{
        $("#male_"+res[1]).removeClass("set");
         $(check).attr('checked', false);
        alert("Sorry ,Room Female Occupancy reached");
        
    }
}
    
//    if(check.value == 1){
//        var res = (check.id).split("_"); 
//        $("#female_"+res[1]).removeClass("fset");
//        $(check).addClass("set");
//    }else{
//        var res = (check.id).split("_");
//        $("#male_"+res[1]).removeClass("set");
//        $(check).addClass("fset");
//    }
//    if(parseInt($("#check-date-change").val()) == 1){
//        _newPriceIfGreaterOccupancy();
//    }

        var nop =  parseInt($('input[name="noOfPersons"]').val());
        var searchNop = parseInt($("#inv_data").attr("search_m"))+parseInt($("#inv_data").attr("search_f"))
         var checkSet = $(".remove-traveller").hasClass("isset");
         var pageAction = parseInt($('input[name="pageaction"]').val());//pageAction = 1 - new reservation         

    if(nop > searchNop || checkSet == true || pageAction == 0){

                _newPriceIfGreaterOccupancy();
        }
}
