var Reservation = function() {

    var _initListeners = function() {
        $(document).on('change', '.entity-items', _loadEntityItems);
        $(document).on('change', '.load-item', _loadItem);
        $(document).on('change', 'input[name="items[]"]', _getTotalItemCost);
        $(document).on('keyup', 'input[name="roomRequired"]', _getTotalItemCost);
        $(document).on('click', 'button.remove-traveller', _removeTraveller);
        $('input[name="paymentType"]').click(_getPayment);
        $('#addbutton').click(_addTraveller);
        //$(document).on('click', 'button#addduebutton', _addDue);
        $("#addduebutton").live("click",function(){
            _addDue();
          });
        
        $(".remove-dues").live("click",function(){
            _removeDues(this);
            //$(this).parents('.added-dues').remove();
          });
        $(document).on('change', 'input[name="excursions[]"]', _getTotalExcursionsCost);
       // $(document).on('click', 'button.remove-due', _removeDuePayment);
        $(document).on('keyup', 'input[name="discount"]', _getTotalExcursionsCost);
        $(document).on('keyup', 'input[name="merchantFee"]', _getTotalExcursionsCost);
        $(document).on('keyup', 'input[name="depositAmount"]', _getAmountDues);
        $(document).on('change', 'input[name="transfers[]"]', _getTotalTransfersCost);
        //client email
        $("#ex-client").hide();
        $('.load-client').click(_loadClient);
        $(document).on('blur', 'input[name="customerId"]', _getClientDetails);
        $(document).on('change', '.load-disc', _loadDiscount);
       $(document).on('click', 'input.sex', genderClick);
        $('.load-type').click(_loadEntity);
        $('.load-type-category').click(_loadRooms);
        //$('input[name="depositMethod"]').click(_changeSubmit);
        
        $('input[name="depositMethod"]').live("click",function(){
            var depositMethod = parseInt($(this).val());
            if (depositMethod == 1) {
                $("#creat_pay").val("Finish");
                $("#creat_pay").html("Finish");
                $('input[name="merchantFee"]').val(0);
            } else {
                $("#creat_pay").val("");
                $("#creat_pay").html("Proceed To Checkout");
            }
         })
         
        $(document).ready(function(){
            var type = $('input[name="type"]').val();
            
            _dateValid(type);
            // $("#pay_first:hidden").find($("#dueAmount1")).val("");

            var today = $('#today').val();
            var start = $('input[name="travelFrom"]').val();
            var daysBefore = _getDiffDays(today.split("-"), start.split("-"));

//            if (daysBefore <= 60) {
//                $("#deposit-hide").hide();
//            } else {
//                $("#deposit-hide").show();
//            }
            
                $("#dob").Zebra_DatePicker({
                    format: 'Y-m-d',
                    show_clear_date: false,
                    direction: -6570
                });
        });
        
//        $('.sex').click(_newPriceIfGreaterOccupancy);
        
        $(document).ready(function(){

            var extraType = $('input[name="dataExtraType"]').val();
            var id = $('input[name="dataTypeId"]').val();
            var type = $('input[name="type"]').val();
            var roomId = $('input[name="roomCategory"]').val();
            
            $(".btntrv").attr("addTrv",0);
                _getExtraItems(extraType, id);
                _getExcursions(extraType, id);
                _getTransfers(extraType, id);
                //_getInventoryData(roomId,type);
                _bindNoOfDays();
                _getRoomsAvailability(roomId,type);
                //genderClick();
                
//            var tNop=parseInt($("#inv_data").attr("m"))+parseInt($("#inv_data").attr("f"));
//            var  i=0;
//            
//            for(i=0;i<(tNop-1);i++){
//                $( "#addbutton" ).trigger( "click" );
//            }
            //stop submiting form from enter key
            $(window).keydown(function(event){
              if(event.keyCode == 13) {
              event.preventDefault();
              return false;
               }
            });
            
            $("#creat_pay").attr("disabled",true);
            $("#creat_draft").attr("disabled",true);
           
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
            var resource = $("#data-resource").val();
            $.get('/admin/orders/ajax/' + resource, function(data) {
                $('#ajax-where').html(data);
                $('.chzn-select').chosen();
                _clearAll();
            });
        };
    
    
    var _loadEntityItems = function() {
        $('#entity-item-details').hide();
        
        var id = $(this).val();
        $('input[name="dataTypeId"]').val(id);
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
                    //showDeposit();
                    $('.chzn-select').chosen();
                });
            } 
            $('#dates').show();
            
            

        _getExtraItems(extraType, id);
        _getExcursions(extraType, id);
        _getTransfers(extraType, id);
        _clearAll();
    };
    
    
    var showDeposit = function(){
            var today = $('#today').val();
            var start = $('input[name="travelFrom"]').val();
            var daysBefore = _getDiffDays(today.split("-"), start.split("-"));

            if (daysBefore <= 60) {
                $("#deposit-hide").hide();
            } else {
                $("#deposit-hide").show();
            }
    }
    
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
            if(id){
                $.post('/admin/orders/ajax/' + resource +id,{id:id}, function(data){            
                    $('#ajax-what').html(data);

                    _dateValid(type);
                    $('.chzn-select').chosen();
                });
            } 
//            $('#dates').show();
//            $("#due-date").hide();
//            $("#full-payment").trigger("click");
//            $('.hid-roomCategory').remove();
    }
    
    var _loadItem = function(){
        var id = $(this).val();
         $('.hid-roomCategory').val(id);
        var type = $(this).attr('data-type');
        var extraType = $(this).attr('data-extra-type');
        var source = 1;//1: request from room change
        $(this).attr("chosen",id);
        if(id){
           //_getInventoryData(id,type);
           _getRoomsAvailability(id,type);
           var noOfPerson = parseInt($('input[name="noOfPersons"]').val());
//            if(noOfPerson == 1){
//                getSigleDialog(1);
//            }
            $('#entity-item-details').show();
            if(type == 2 || type == 3){
                _dateValid(type);
            }
            $('#dates').show();
        }else{         
            _clearAll();        
        }
        
        _bindNoOfDays();
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
        //var flightTotalCost = parseFloat($('input[name="flightTotalCost"]').val());
        var flightTotalCost = 0;

        if($('input[name="itemsCost"]').val()){
            var itemsCost = parseFloat($('input[name="itemsCost"]').val());
            var netItemCost = parseFloat($('input[name="itemsCost"]').attr("netCost"));
        }else{
           var itemsCost = 0;
           var netItemCost = 0;
        }
        
        if($('input[name="excursionsCost"]').val()){
            var excursionsCost = parseFloat($('input[name="excursionsCost"]').val());
             var netExcursionsCost = parseFloat($('input[name="excursionsCost"]').attr("netCost"));
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
        //var merchantFee = parseFloat($('input[name="merchantFee"]').val());
        var merchantFee = '';
         if(isNaN(discount) || isNaN(merchantFee)){
            discount = 0;
           // merchantFee = 0;  
        }
        
        var cost = totalCost;
         //var cost = totalCost + merchantFee;
        
        var finalCost = 0;

        if(discountType == 0){
            discount = (cost * discount) / 100;   
        }
       
         //alert(discount);
        finalCost = cost - discount;
       // merchantFee = ((2.5/100)*finalCost).toFixed(2);
        if(parseInt(finalCost) == 0){
           $("#creat_pay").attr("disabled",true);
            $("#creat_draft").attr("disabled",true);
        }else{
             $("#creat_pay").attr("disabled",false);
            $("#creat_draft").attr("disabled",false);
        }

        
        $('input[name="finalCost"]').val(finalCost.toFixed(2));
        //$('input[name="merchantFee"]').val(merchantFee);
       // _getAmountDue();
       //_getPayment();
       //genderClick();
       
       $('input[name="paymentType"]:checked').removeAttr("checked");
       $("#deposit-div").html('');
       
        return finalCost;
           
    };
    
    var _getPayment = function(){
//        if($(this).val() === '0'){
//         
//           if($(".cnt:visible").length == 0){
//            _getAmountDue();
//           }
//            $("#due-date").show();
//            $('input[name="depositAmount"]').removeAttr("readonly");
//            
//        } else {
//            
//            _before60Days($('input[name="finalCost"]').val());
//            $('input[name="depositAmount"]').attr("readonly",true);
//        }
        var dpType = parseInt($(this).val());
        if(dpType == 1){
            $("#deposit-due").trigger("click");
        }
        var type =  $('input[name="type"]').val();
        var typeId = $('input[name="dataTypeId"]').val();
        var roomId = $('input[name="roomCategory"]').val();
        var start = $('input[name="travelFrom"]').val();
        var end = $('input[name="travelTo"]').val();
        var finalCost = $('input[name="finalCost"]').val();

       var paymentType =  $('input:radio[name=paymentType]:checked').val();
       var today = $('#today').val();

       var daysBefore = _getDiffDays(today.split("-"), start.split("-"));

//        if(daysBefore <= 60){
//            $("#deposit-hide").hide();
//        }else{
//            $("#deposit-hide").show();
//        }

         $.ajax({
                async:false,    
                url: '/admin/orders/add-payment',
                data: {typeId:typeId,type:type,dateFrom:start,exceptionStart:today,roomId:roomId,paymentType:paymentType,finalCost:finalCost},
                type: 'POST',
                
                success: function(data){
                   if (data) {
                    $("#deposit-div").html(data);
                } else {
                   alert("Sorry ,something goes wrong");
                }
                }
            });
        $("#creat_pay").attr("disabled",false);
        $("#creat_draft").attr("disabled",false);
        
    }
    
    var _getAmountDue = function(){
        
        var today = $('#today').val().split("-");
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

        $('input[name="depositAmount"]').val(parseFloat(depositAmount).toFixed(2));
        
        var merchantFee = ((2.5/100)*depositAmount).toFixed(2);
        $('input[name="merchantFee"]').val(merchantFee);
        
        $('input[name="balansAfterDeposit"]').val(parseFloat(finalCost - depositAmount).toFixed(2));
        
         $('#pay_first').show();
        
        $('input[name="nextPaymentDue[]"]').val(parseFloat(nextPaymentDue).toFixed(2)).parent().parent().show();
        $('input[name="finalPaymentDue[]"]').val(parseFloat(finalPaymentDue).toFixed(2)).parent().parent().show();

        $('#dueDate1').val(maxNextPaymentDue.getFullYear()+'-'+(parseInt(maxNextPaymentDue.getMonth())+1)+'-'+maxNextPaymentDue.getDate());
        $('#dueDate2').val(maxFinalPaymentDue.getFullYear()+'-'+(parseInt(maxFinalPaymentDue.getMonth())+1)+'-'+maxFinalPaymentDue.getDate());
        
        $('#dueDate1').attr('max', maxNextPaymentDue).attr('required', 'required').parent().parent().show();
        $('#dueDate2').attr('max', maxFinalPaymentDue).attr('required', 'required').parent().parent().show();
        
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
        
        $('input[name="depositAmount"]').val(parseFloat(depositAmount).toFixed(2)).show();
        
        var merchantFee = ((2.5/100)*depositAmount).toFixed(2);
        $('input[name="merchantFee"]').val(merchantFee);
        
        $('input[name="balansAfterDeposit"]').val(finalCost - depositAmount.toFixed(2)).show();
       // $('input[name="nextPaymentDue[]"]').val(null).parent().parent().hide();
        $('#pay_first').show();
        
        $('#dueAmount2').val(parseFloat(finalPaymentDue).toFixed(2)).show();
        $('input[name="nextPaymentDue[]"]').val(parseFloat(nextPaymentDue).toFixed(2)).parent().parent().show();
        
        //$('input[name="dueDate1"]').removeAttr('required').val(null).parent().parent().hide();
        //$('input[name="dueDate2"]').attr('max', maxFinalPaymentDue).attr('required', 'required').show();
        $('#dueDate1').val(maxNextPaymentDue.getFullYear()+'-'+(parseInt(maxNextPaymentDue.getMonth())+1)+'-'+maxNextPaymentDue.getDate());
        $('#dueDate1').attr('max', maxNextPaymentDue).attr('required', 'required').parent().parent().show();
        
        $('#dueDate2').val(maxFinalPaymentDue.getFullYear()+'-'+(parseInt(maxFinalPaymentDue.getMonth())+1)+'-'+maxFinalPaymentDue.getDate());
        $('#dueDate2').attr('max', maxFinalPaymentDue).attr('required', 'required').parent().parent().show();
        
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
        
        
        var maxFinalPaymentDue = new Date(parseInt(from[0]),parseInt(from[1])-1,parseInt(from[2]));

        maxFinalPaymentDue = new Date(maxFinalPaymentDue.getTime() - (45 * oneDay));

        $('input[name="depositAmount"]').val(parseFloat(depositAmount).toFixed(2)).show();
        
        var merchantFee = ((2.5/100)*depositAmount).toFixed(2);
        $('input[name="merchantFee"]').val(merchantFee);
        
        $('input[name="balansAfterDeposit"]').val(finalCost - depositAmount.toFixed(2)).show();
       // $('input[name="nextPaymentDue[]"]').val(null).parent().parent().hide();
        var pageAction = parseInt($('input[name="pageaction"]').val());//pageAction = 1 - new reservation
        //if(pageAction == 1){
            $('#pay_first').hide();
        //}
        
        $('#dueAmount2').val(parseFloat(finalPaymentDue).toFixed(2)).show();
       // $('input[name="nextPaymentDue[]"]').val(parseFloat(nextPaymentDue).toFixed(2)).parent().parent().show();
        
        //$('input[name="dueDate1"]').removeAttr('required').val(null).parent().parent().hide();
        //$('input[name="dueDate2"]').attr('max', maxFinalPaymentDue).attr('required', 'required').show();
        //$('#dueDate1').val(maxNextPaymentDue.getFullYear()+'-'+maxNextPaymentDue.getMonth()+'-'+maxNextPaymentDue.getDate());
        //$('#dueDate1').attr('max', maxNextPaymentDue).attr('required', 'required').parent().parent().show();
        
        $('#dueDate2').val(maxFinalPaymentDue.getFullYear()+'-'+(parseInt(maxFinalPaymentDue.getMonth())+1)+'-'+maxFinalPaymentDue.getDate());
        $('#dueDate2').attr('max', maxFinalPaymentDue).attr('required', 'required').parent().parent().show();
        
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
//        var appendDiv = $('#add-traveller').html();
//        var noOfPerson = $('input[name="noOfPersons"]');
//        
//        
//        var totalTravellerCount = parseInt($("#inv_data").attr("f"))+parseInt($("#inv_data").attr("m"));
//        if(totalTravellerCount > parseInt(noOfPerson.val())){
//            $('#traveller-info').append(appendDiv);
//             noOfPerson.val(parseInt(noOfPerson.val())+ 1);
//             
//              var nop = parseInt($('input[name="noOfPersons"]').val());
//            var searchNop = parseInt($("#inv_data").attr("search_m")) + parseInt($("#inv_data").attr("search_f"))
//            var checkSet = $(".remove-traveller").hasClass("isset");
//            var pageAction = parseInt($('input[name="pageaction"]').val());//pageAction = 1 - new reservation         
//
//            if (nop > searchNop || checkSet == true || pageAction == 0) {
//                var t = confirm("Adding more travellers may affect your nightly cost");
//                if (t == false) {
//                    $(".added-traveller").last().remove();
//                     noOfPerson.val(parseInt(noOfPerson.val())- 1);
//                }
//            }
//             
//              if($('input[name="inv_data"]').attr('pPer') == 1){// condition for room rate for per person
//                $('input[name="roomRate"]').val(parseInt(noOfPerson.val()) * parseInt($('input[name="roomRate"]').attr('fixPrice')) );
//                  _calcFinalCost();
//            }
//        }else{
//             $(".remove-traveller").addClass("isset");
//            alert("Sorry, You cannot add more.");
//        }
//        
//        $("#male_11").attr("id","male_"+noOfPerson.val());
//        $("#female_11").attr("id","female_"+noOfPerson.val());
//        $("#male_"+noOfPerson.val()).attr("name","tsex_"+noOfPerson.val());
//        $("#female_"+noOfPerson.val()).attr("name","tsex_"+noOfPerson.val());
//        $("#labm_11").attr("for","male_"+noOfPerson.val());
//        $("#labm_11").attr("id","male_"+noOfPerson.val());
//        $("#labf_11").attr("for","female_"+noOfPerson.val())
//        $("#labf_11").attr("id","female_"+noOfPerson.val())
//        
//        $("#dob_11").attr("id","dob_"+noOfPerson.val());
//        
//          $("#dob_"+noOfPerson.val()).Zebra_DatePicker({
//                    format: 'Y-m-d',
//                });
        var totalPerson = parseInt($('input[name="noOfPersons"]').val());
        if(totalPerson < 4){
         $.ajax({
                async:false,    
                url: '/admin/orders/ajax/add-traveller/'+(totalPerson+1),
                type: 'POST',
                success: function(data){
                   if (data) {
                    if(confirm("Adding more guest may change the room price per night.")){
                        var appendDiv = data;
                        //$('#traveller-info').append(appendDiv);
                        $('#traveller-more').append(appendDiv);
                        $('input[name="noOfPersons"]').val(totalPerson+1);
                        _adjustGuestNumber();
                    }
                } else {
                   alert("Sorry ,something goes wrong");
                }
                }
            });
        }else{
            alert("You cannot add more than 4 guest.");
        }
        
//         $.post('/admin/orders/ajax/add-traveller/'+(totalPerson+1), function(data) {
//                if(data){
//                    var appendDiv = data;
//                    $('#traveller-info').append(appendDiv);
//                    $('input[name="noOfPersons"]').val(totalPerson+1);
//                }else{
//                    alert("Sorry ,something goes wrong");
//                }
//           });
        
        //alert(totalPerson);
    };
    
    var _adjustGuestNumber = function(){
        var i =1;
          $('.guest-add').each(function(){       
               $(this).html("Guest #"+i);
               i++;
            });
    }
    
    var _removeTraveller = function(){
        var noOfPerson = parseInt($('input[name="noOfPersons"]').val());
        if(noOfPerson <= 2){
            getSigleDialog(this);
        }else{
            alert("Removing traveller may change the room price per night.");
            $(this).parents('.added-traveller').remove();

            var noOfPerson = $('input[name="noOfPersons"]');
            noOfPerson.val(parseInt(noOfPerson.val()) - 1);
            _adjustGuestNumber();
            genderClick();
            _getRoomPricePerNight();
            _calcFinalCost();
        }
    };
    
    
    var getSigleDialog = function(d) {
        $("#single-share").dialog({
            dialogClass: "no-close",
            buttons: [{
                    text: "Continue",
                    click: function() {
                        $(this).dialog("close");
                        
                        if(d != 1){
                        $(d).parents('.added-traveller').remove();
                            alert("Removing traveller may change the room price per night.");
                            var noOfPerson = $('input[name="noOfPersons"]');
                            noOfPerson.val(parseInt(noOfPerson.val()) - 1);
                        }
                        var male_count_increment = 0;
                        var female_count_increment = 0;
                        var shareChecked = $('input[name=share]:checked').val();
                        $('.sex').each(function() {
                            if ($(this).is(':checked'))
                            {
                                if ($(this).val() == 1)
                                {
                                    male_count_increment++;
                                } else {

                                    female_count_increment++;
                                }
                            }
                        });
                        var type = $('input[name="type"]').val();
                        var typeId = $('input[name="dataTypeId"]').val();
                        var roomId = $('input[name="roomCategory"]').val();
                        var start = $('input[name="travelFrom"]').val();
                        var end = $('input[name="travelTo"]').val();
                        var currency = $('input[name="currencytype"]').val();
                        var count = parseInt($('input[name="noOfPersons"]').val());

                        _adjustGuestNumber();
                        genderClick();
                        $.ajax({
                            url: "/checkRoomAvailabilty",
                            type: 'POST',
                            async: false,
                            data: {share: shareChecked, type: type, typeId: typeId, roomId: roomId, males: male_count_increment, females: female_count_increment, start: start, end: end, currency: currency},
                            success: function(result) {
                                var grossNightPrice = result.price;
                                var netNightPrice = result.netprice;


                                if (result.price == 0) {
                                    if (result.msg != '') {
                                        alert(result.msg);
                                    } else {
                                        if (parseInt(count) == 1) {
                                            alert("Single Traveller not allowed");
                                        }
                                    }
                                    $('input[name="roomRate"]').val(grossNightPrice);
                                    $('input[name="roomNetPrice"]').val(netNightPrice);
                                } else {
                                    $('input[name="roomRate"]').val(grossNightPrice);
                                    $('input[name="roomNetPrice"]').val(netNightPrice);
                                }
                            }});


                        _calcFinalCost();

                    }},
                {
                    text: "Cancel",
                    click: function() {
                        $(this).dialog("close");
                    }
                }],
        });
    }
    
    
    var _addDue = function(){
         $.ajax({
                async:false,    
                url: '/admin/orders/ajax/add-dues/1',
                type: 'POST',
                success: function(data){
                   if (data) {
                        var appendDiv = data;
                        $('#added-due-info').append(appendDiv);
                        _calculateDueAmt();
                } else {
                   alert("Sorry ,something goes wrong");
                }
                }
            });
    }
    
    var _calculateDueAmt = function(){
        var balance = $('input[name="balansAfterDeposit"]').val();
        var count = $('input[name="nextPaymentDue[]"]').length;
        
        var divideAmt = parseFloat(balance)/parseInt(count);
        $('input[name="nextPaymentDue[]"]').val(divideAmt.toFixed(2));
    }
    
     var _removeDues = function(d){
        $(d).parents('.added-dues').remove();
        _calculateDueAmt();
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
        var min_stay_days = $('#minimum-stay-days').val();
        var roomId = $("input[name='roomCategory']").val();
        var hid_mod_start_end = $("input[name='hid-mod-start-end']").val();

    if(type == 2){
       var hid_mod_start_end = $('#hid-mod-start-end').val();
       $('#dateFrom').Zebra_DatePicker({
              direction: [start_modify.toString(),end_modify_two.toString()],
              //direction: [start_modify.toString(),start.toString()],
              zero_pad : true,
              onSelect: function(date, dateFormat, dateObj, ev) {//alert("dateFrom");
                var minDays = new Date(start.toString());
                if (minDays.getTime() > dateObj.getTime()) {
                    dateObj = minDays;
                }
                dateObj.setDate(dateObj.getDate() + parseInt(min_stay_days));
                var day = (dateObj.getDate().toString().length) < 2 ? ('0' + dateObj.getDate()) : dateObj.getDate();
                var month = ((dateObj.getMonth() + 1).toString().length) < 2 ? ('0' + (dateObj.getMonth() + 1)) : dateObj.getMonth() + 1;
                var date = dateObj.getFullYear() + '-' + month + '-' + day;
                $('#dateTo').Zebra_DatePicker({
                    direction: [date.toString(),end_modify.toString()],
                    zero_pad : true,
                    onSelect: function(date, dateFormat, dateObj, ev) {//alert("dateTo");
                   _bindNoOfDays();
                   var roomId = $("input[name='roomCategory']").val();
                   if(typeof roomId === "undefined"){
                        var roomId = $("select[name='roomCategory']").attr("chosen");
                    }
                  // _getRoomsAvailability(roomId,type);
              }
            })
            $('#dateTo').attr('value', date);

                   _bindNoOfDays();
//                   var roomId = $("input[name='roomCategory']").val();
//                   if(typeof roomId === "undefined"){
//                        var roomId = $("select[name='roomCategory']").attr("chosen");
//                    }
                   //_getRoomsAvailability(roomId,type);
              },
             onClear: function() {
                $('#dateTo').attr('value', '');
            }
        })
              $('#dateTo').Zebra_DatePicker({
              direction: [hid_mod_start_end.toString(),end_modify.toString()],
              //direction: [hid_mod_start_end.toString(),end_modify.toString()],
              zero_pad : true,
              onSelect: function(date, dateFormat, dateObj, ev) {//alert("dateTo");
                   _bindNoOfDays();
                   var roomId = $("input[name='roomCategory']").val();
                   if(typeof roomId === "undefined"){
                        var roomId = $("select[name='roomCategory']").attr("chosen");
                    }
                   //_getRoomsAvailability(roomId,type);
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
                  _bindNoOfDays();
                  var roomId = $("input[name='roomCategory']").val();
                  if(typeof roomId === "undefined"){
                        var roomId = $("select[name='roomCategory']").attr("chosen");
                    }
                  //_getRoomsAvailability(roomId,type);
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
                    _bindNoOfDays();
                  // _getRoomsAvailability(roomId,type);
              }
        })
    }else{
        $('#dateFrom').Zebra_DatePicker({
              onSelect: function(date, dateFormat, dateObj, ev) {
                   var day = ((dateObj.getDate()).toString().length) < 2 ? ('0' + dateObj.getDate()) : dateObj.getDate()+1;
                    var month = ((dateObj.getMonth() + 1).toString().length) < 2 ? ('0' + (dateObj.getMonth()+1 )) : dateObj.getMonth()+1;
                    var date = dateObj.getFullYear()  + '-' + month + '-' + day;
                    var end =  (dateObj.getFullYear()+1)  + '-' + month + '-' + day;
                $('#dateTo').val(date);
                _bindNoOfDays();
                var roomId = $("input[name='roomCategory']").val();
                    if (typeof roomId === "undefined") {
                        var roomId = $("select[name='roomCategory']").attr("chosen");
                    }
                // _getRoomsAvailability(roomId,type);
              }
        })
        
        $('#dateTo').Zebra_DatePicker({
                    onSelect: function() {
                        var roomId = $("input[name='roomCategory']").val();
                        if (typeof roomId === "undefined") {
                        var roomId = $("select[name='roomCategory']").attr("chosen");
                    }
                    _bindNoOfDays();
                   // _getRoomsAvailability(roomId,type);
                    $("#check-date-change").val(1);
                    }
                });
    }

    }
    
    
    var _getRoomsAvailability = function (roomId,type){
        if(type == 2){
             var start = $('input[name="eventStart_modified"]').val();
             var end = $('input[name="eventEnd_modified"]').val();
         }else{
             var start = $('input[name="travelFrom"]').val();
            var end = $('input[name="travelTo"]').val();
         }
         $.post('/admin/orders/ajax/rooms-available', {roomId : roomId,start:start,end:end , type:type}, function(data) {
              
	       if(parseInt(data.count) <= 0){
                 data.count = 0;
                   $("#creat_pay").attr("disabled",true);
                   $("#creat_draft").attr("disabled",true);
             } else{
                  $("#creat_pay").attr("disabled",false);
                    $("#creat_draft").attr("disabled",false);
             }
	      $("#inventory_room_available").html((parseInt(data.count)) + " Rooms Available");
              $("#avl").val(data.count);
              
              
//              var priceData = data.data;
//              var price = 0;
//              var netPrice = 0;
//              var finalAvgPrice = 0;
//              var finalAvgNetPrice = 0;
//              var i = 0;
//              $.each(priceData, function(key, value) {
//                  price = parseInt(value.grossPrice);
//                  finalAvgPrice += price;
//                  
//                  netPrice = parseInt(value.netPrice);
//                  finalAvgNetPrice += netPrice;
//                  i++;
//            });
//            $('input[name="roomRate"]').val(finalAvgPrice/i);
//            $('input[name="roomNetPrice"]').val(finalAvgNetPrice/i);
//             $('input[name="roomRate"]').attr('fixPrice',finalAvgPrice/i);
//            $("#inv_data").attr("dOp",finalAvgPrice/i);
            //_checkTavellersSexCount(data);
            //_newPriceIfGreaterOccupancy();
            //_getRoomPricePerNight();
            var today = $('#today').val();
            var start = $('input[name="travelFrom"]').val();
            var daysBefore = _getDiffDays(today.split("-"), start.split("-"));

//            if (daysBefore <= 60) {
//                $("#deposit-hide").hide();
//            } else {
//                $("#deposit-hide").show();
//            }
            
             var noOfPerson = parseInt($('input[name="noOfPersons"]').val());
             //alert(noOfPerson);
             var postNoOfPerson = parseInt($('input[name="number-person-post"]').val());
             if(noOfPerson != 1){
                  genderClick();
                 _calcFinalCost();
            }else{
                if(postNoOfPerson !=1)
                {
                getSigleDialog(1);
            }else{
                 genderClick();
                 _calcFinalCost();
                 $('input[name="number-person-post"]').val(0)
            }
            }
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
    
    var _loadEntityRooms = function(type,id,resource) {
        var dateFrom = $("#dateFrom").val();
        var dateTo = $("#dateTo").val();
        if(id){
            $.post('/admin/orders/ajax/' + resource +id,{id:id,dateFrom:dateFrom,dateTo:dateTo}, function(data){            
                $('#ajax-what').html(data);
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
       if(pricePer == 1){
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

            //$('input[name="roomNetPrice"]').val(finalAvgNetPrice/i);
            //$("#inv_data").attr("dOp",finalAvgPrice/i);
            //_checkTavellersSexCount(data);
           });
    }
    
    var _getAmountDues = function() {


        var today = $('#today').val().split("-");
        var startTrip = $('input[name="travelFrom"]').val().split("-");
        var daysBefore = _getDiffDays(today, startTrip);
        
        var finalCost = $('input[name="finalCost"]').val();
        var orgdepositAmount = $('input[name="depositAmount"]').val()
        
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
        var len = parseInt($('.cnt').length);
        var divideDueAmt = balansAfterDeposit / len;
        $('.cnt').val(divideDueAmt.toFixed(2));
//        alert('len '+len);
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
    
    var _getRoomPricePerNight = function (d){
        var males = $('input[name="male-count"]').val();
        var females =$('input[name="female-count"]').val();
        var type =  $('input[name="type"]').val();
        var typeId = $('input[name="dataTypeId"]').val();
        var roomId = $('input[name="roomCategory"]').val();
        var start = $('input[name="travelFrom"]').val();
        var end = $('input[name="travelTo"]').val();
        var count  = $('input[name="noOfPersons"]').val();
        var share  = $('input[name="share"]:checked').val();
        
         $.ajax({
                async:false,    
                url: '/checkRoomAvailabilty',
                type: 'POST',
                data: {typeId:typeId,type:type,start:start,end:end,males:males,females:females,roomId:roomId,currency:'USD',share:share},
                success: function(result){
                     var grossNightPrice = result.price;
                     var netNightPrice   = result.netprice;
                    
                     
                     if(result.price==0){
                        if(result.msg!=''){
                            alert(result.msg);
                            $(d).attr("checked",false);
                        }
//                        else{
//                            if(parseInt(count) == 1){
//                                alert("Single Traveller not allowed");
//                            }
//                        }
                         $('input[name="roomRate"]').val(grossNightPrice);
                        $('input[name="roomNetPrice"]').val(netNightPrice);
                    }else{
                        $('input[name="roomRate"]').val(grossNightPrice);
                        $('input[name="roomNetPrice"]').val(netNightPrice);
                    }
                      
                    }
            });
    }
    
    var genderClick = function(){

            var male_count_increment = 0;
            var female_count_increment = 0;
            $('.sex').each(function(){       
                if($(this).is(':checked'))
                {
               if($(this).val() == 1)
               {
                  male_count_increment++; 
               }else{

                 female_count_increment++;
              }       
                }  
            });
            $('input[name="male-count"]').val(male_count_increment);
            $('input[name="female-count"]').val(female_count_increment);
            _getRoomPricePerNight(this);
             _calcFinalCost();
    }
    
    return {
        init: function() {
            _initListeners();
        },
    };
}();


//function callPriceCal(check){
//    var noOfMales = parseInt($('.set').length);
//    var noOfFemales = parseInt($('.fset').length);
//    var schMale = parseInt($("#inv_data").attr("m"));
//    var schFemale = parseInt($("#inv_data").attr("f"));
//    var res = (check.id).split("_"); 
//
//    if(check.value == 1){
//    if(noOfMales < schMale){
//         var res = (check.id).split("_"); 
//        $("#female_"+res[1]).removeClass("fset");
//        $(check).addClass("set");
//    }else{
//         $("#female_"+res[1]).removeClass("fset");
//         $(check).attr('checked', false);
//        alert("Sorry ,Room Male Occupancy reached");
//        
//    }
//}else{
//     if(noOfFemales < schFemale){
//        var res = (check.id).split("_");
//        $("#male_"+res[1]).removeClass("set");
//        $(check).addClass("fset");
//    }else{
//        $("#male_"+res[1]).removeClass("set");
//         $(check).attr('checked', false);
//        alert("Sorry ,Room Female Occupancy reached");
//        
//    }
//}
//    
//
//        var nop =  parseInt($('input[name="noOfPersons"]').val());
//        var searchNop = parseInt($("#inv_data").attr("search_m"))+parseInt($("#inv_data").attr("search_f"))
//         var checkSet = $(".remove-traveller").hasClass("isset");
//         var pageAction = parseInt($('input[name="pageaction"]').val());//pageAction = 1 - new reservation         
//
//    if(nop > searchNop || checkSet == true || pageAction == 0){
//
//               // _newPriceIfGreaterOccupancy();
//        }
//}



//function getRoomPricePerNight(){alert("getRoomPricePerNight");
//        var males = $('input[name="male-count"]').val()
//        var females =$('input[name="female-count"]').val()
//        var type =  $('input[name="type"]').val();
//        var typeId = $('input[name="dataTypeId"]').val();
//        var roomId = $('input[name="roomCategory"]').val();
//        var start = $('input[name="travelFrom"]').val();
//        var end = $('input[name="travelTo"]').val();
//         $.ajax({
//                async:false,    
//                url: '/checkRoomAvailabilty',
//                type: 'POST',
//                data: {typeId:typeId,type:type,start:start,end:end,males:males,females:females,roomId:roomId},
//                success: function(data){
//                     var grossNightPrice = data.price;
//                     var netNightPrice   = data.netprice;
//                     
//                     $('input[name="roomRate"]').val(grossNightPrice);
//                     $('input[name="roomNetPrice"]').val(netNightPrice);
//                      
//                    }
//            });
//            
//}
//
//$(document).ready(function(){
//        $(".sex").click(function(){
//            var male_count_increment = 0;
//            var female_count_increment = 0;
//            $('.sex').each(function(){       
//                if($(this).is(':checked'))
//                {
//               if($(this).val() == 1)
//               {
//                  male_count_increment++; 
//               }else{
//
//                 female_count_increment++;
//              }       
//                }  
//            });
//            $('input[name="male-count"]').val(male_count_increment);
//            $('input[name="female-count"]').val(female_count_increment);
//            alert("sex");
//            getRoomPricePerNight();
//           
//        }); 
//    });



$(document).ready(function(){
    
    var flag = true;
    $('.error_msg').remove();
    $('#creat_pay,#creat_draft').click(function(){
        var flag = true;
        $('.error_msg').remove();
        
        if($("div[name='sex']").length > 0){
            $("div[name='sex']").each(function() {
                if($(this).find($(".random")).length > 0){
                    var rand = parseInt($(this).find($(".random")).val());
                    if ($("input[name='tsex_" + rand + "']").is(":checked") == true) {
                        flag = true;
                    } else {
                        $("#sex_" + rand).html("<div class='error_msg'>Field is Required.</div>");
                        $(this).focus();
                        flag = false;
                    }
                }
            });
        }

        
           var email = $("input[name='travellerEmail']").val();
           if (validateEmail(email) == false && $.trim(email).length != 0 ) {
                $('.error_msg').remove();
                var error_msg = "(*)Invalid email address";
                $("input[name='travellerEmail']").parent().append("<div class='error_msg' >" + error_msg + "</div>");
                $("input[name='travellerEmail']").focus(); 
                flag = false;
            }
            var finalCost = parseFloat($("input[name='finalCost']").val());
            var balance = parseFloat($("input[name='balansAfterDeposit']").val());
            var deposit = parseFloat($("input[name='depositAmount']").val());
            var s = 0;
            if($('.cnt:visible').length > 0){
                    $.each($('.cnt:visible'), function( index, value ) {
                         s =  s+parseFloat($(this).val());
                    });

                if((finalCost+1 >= s+deposit) && (finalCost-1 <= s+deposit) ){
                    flag = true;
                }else{
                    alert("The sum of due amounts and deposit must equals to Final cost. ");
                    flag = false;
                }
            }else{
                if(deposit < finalCost){
                alert("Deposit amount must be equal to final cost to pay.")
                flag = false;
            }
            }
            
            if(deposit > finalCost){
                alert("Deposit amount cannot be greater than Final Cost to be paid.")
                flag = false;
            }
            
        
        $('.req').each(function() {
               var value = $(this).val();
               if (value == false || value =="") {
                   var error_msg = "(*)Field is required";
                   $(this).parent().append("<div class='error_msg' >" + error_msg + "</div>");
                   $(this).focus(); 
                   flag = false;
                  
               }
           });
           


           
           
       var isCheckDeposit = $('input[name="paymentType"]').is(':checked');

          if(isCheckDeposit == false){
               var error_msg = "(*)Field is required";
                   $('input[name="paymentType"]').parent().append("<div class='error_msg' >" + error_msg + "</div>");
                   //$(this).focus(); 
                   flag = false;
                   
           }

           var roomRate = parseFloat($('input[name="roomRate"]').val());
           var avail = parseInt($("#avl").val());
            if(avail == 0){
                alert("No rooms available.");
                flag = false;
            }
           if(roomRate > 0 && flag == true){
               flag = true;
           }else{
               flag = false;
           }
           
           if(flag == true){
                $("#creat_pay").attr("disabled",false);
                $("#creat_draft").attr("disabled",false);
           }else{ 
                $("#creat_pay").attr("disabled",true);
                $("#creat_draft").attr("disabled",true);
                $('input[name="paymentType"]:checked').removeAttr("checked");
                $("#deposit-div").html('');
                
           }
           
       
           return flag;
    });
    
     
})

// Function that validates email address through a regular expression.
function validateEmail(email) {
    var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    if (filter.test(email)) {
    return true;
    }
    else {
    return false;
    }
}