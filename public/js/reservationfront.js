

var ReservationFront = function() {

    var _initListeners = function() {

        //alert('hello');

        // $(document).on('load',_loadDate);
        jQuery(document).ready(function($) {

	    var type=$('input[name=type]').val();
	    if(type==2){
	      var start = $("#hid-mod-start").val();
	      var end = $("#hid-mod-end").val();
	    }else{
	      var start = $("#dateFroms").val();
	      var end = $("#dateTos").val();
	    }
//
//            $('#dateFrom').Zebra_DatePicker({
//                direction: [start.toString(), end.toString()],
//                onSelect: function() {
//                    _bindNoOfDays();
//                }
//            })
//            $('#dateTo').Zebra_DatePicker({
//                direction: [start.toString(), end.toString()],
//                onSelect: function() {
//                    _bindNoOfDays();
//                }
//            })
//	



            var from = $('input[name="travelFrom"]').val().split("-");
            var to = $('input[name="travelTo"]').val().split("-");
            $('input[name="noOfDays"]').val(_getDiffDays(from, to));

            var available = $('input[name="roomavail"]').val();
            //var   available = totalStock - booked;
            // alert(available);

            //$("#roomrequired").attr("max", available);

            if (available == 0) {
                available = "No Rooms Available";
                $("#creat").attr("disabled", true);
                $("#submitbutton").attr("disabled",true);
            }
            else {
                available = available + " Rooms Available";
                $("#creat").attr("disabled", false);
                 $("#submitbutton").attr("disabled",false);
            }
            $("#inventory_room_available").html(available);


            //  alert(start);   
            $('#testdatefrom').html(start);

            $('#testdateto').html(end);


            _calcFinalCost();

            //var diff=_getDiffDays(end,start);
            //var diff=start-end;

            //alert(diff);
                
        });
        $('.load-entity').click(_loadEntity);
        $(document).on('change', '.entity-items', _loadEntityItems);
        $(document).on('change', '.load-item', _loadItem);
        // $(document).on('click', '#dateFrom, #dateTo', _bindNoOfDays);
        $(document).on('change', 'input[name="items[]"]', _getTotalItemCost);
        $(document).on('keyup', 'input[name="roomRequired"]', _calcFinalCost); //_getTotalItemCost);
        $(document).on('click', 'button.remove-traveller', _removeTraveller);
        $('input[name="paymentType"]').click(_getPayment);
        $('#addbutton').click(_addTraveller);
        $('#addduebutton').click(_addDuePayment);
        $(document).on('change', 'input[name="excursions[]"]', _getTotalExcursionsCost);
        $(document).on('click', 'button.remove-due', _removeDuePayment);
        $(document).on('keyup', 'input[name="discount"]', _getTotalExcursionsCost);
        //$(document).on('keyup', 'input[name="merchantFee"]', _getTotalExcursionsCost);
        //$(document).on('keyup', 'input[name="depositAmount"]', _getAmountDues);
        $(document).on('change', 'input[name="transfers[]"]', _getTotalTransfersCost);
        //client email
        $("#ex-client").hide();
        $('.load-client').click(_loadClient);

        $(document).on('keyup', 'input[name="customerId"]', _getClientDetails);

        $(document).on('change', 'input[name="travellerName"]', _getTravellerName);

        $(document).on('change', 'input[name="tname[]"]', _getOtherTraveller);


        $(document).on('change', 'input[name="travellerPhone"]', _getTravellerPhone);

        $(document).on('change', 'input[name="travellerEmail"]', _getTravellerEmail);

        $(document).on('change', 'input[name="travellerCity"]', _getTravellerCity);
        $(document).on('change', 'input[name="streetname"]', _getTravellerStreet);

        $(document).on('change', 'input[name="travellerState"]', _getTravellerState);


        $(document).on('change', 'input[name="travellerCountry"]', _getTravellerCountry);


        $(document).on('click', 'input[name="travelFrom"]', _getTravellerFrom);


        $(document).on('change', 'input[name="travellerZip"]', _getTravellerZip);

        $(document).on('click', 'input[name="flight"]', _getTravellerflight);


        $(document).ready(function() {
            
            //alert('in docyment ready');
            var extraType = $('input[name="dataExtraType"]').val();
            var id = $('input[name="dataTypeId"]').val();
            var type = $('input[name="type"]').val();
            var roomId = $('input[name="roomCategory"]').val();
            
          //  alert(roomId);
            _bindNoOfDays();
            var tNop=parseFloat($("#inv_data").attr("m"))+parseFloat($("#inv_data").attr("f"));
            i=0;
            for(i=0;i<(tNop-1);i++){
                $( "#addbutton" ).trigger( "click" );
            }
           // _getExtraItems(extraType, id);
           // _getExcursions(extraType, id);
           // _getTransfers(extraType, id);
            //_dateValid(type);
          //  _getRoomsAvailability(roomId);
           // _getRoomsAvailability(roomId,type);
           _getInventoryData(roomId,type);
            _clearAll();
            
            
            //promo code
            $("#promo_click").click(function() {
                var code = $("#promo_code").val();
                var dateFrom = $("#dateFrom").val();
                var dateTo = $("#dateTo").val();
                 $.ajax({
                        type: "POST",
                        url: "/reservation/ajax/apply-discount",
                        data: {code:code,roomId:roomId,extraType:extraType,id:id,type:type,dateFrom:dateFrom,dateTo:dateTo},
                        success: function(data) {
                           if(data){
                              var discType = parseFloat(data.discountType);
                              var discount = parseFloat(data.discount);
                              if(discount == 0){
                                  $("#promo-msg").html("Not a valid promo Code or the date is expired.")
                              }else{
                                  if(discType == 0){
                                     var discName = "$";
                                  }else{
                                      var discName = "%";
                                  }
                                   $("#promo-msg").html("You  got a discount of "+ discount +"  " + discName + " on final amount.");
                              }
                              
                              
                              $('input[name="discount"]').val(discount);
                              $('input[name="discount"]').attr('data-discount-type',discType);
                              _calcFinalCost();
                           }
                            }
                    })
            });
           
        })
        
         $( document ).ajaxStart(function() {
               $(".over-lay").show();
            });
            
            $(document).ajaxStop(function() {
                 $(".over-lay").hide();
            });

       $(document).ready(function() {
//            $('select[name="romname"]').on('change', function(){ 
//                var roomId=$(this).val();
//                var type=$('input[name="type"]').val();
//                $('input[name="roomCategory"]').val(roomId);
//                
//          var male_count_increment = 0;
//	  var female_count_increment = 0;
//	  $('.sex').each(function(){	    
//	      if($(this).is(':checked'))
//	      {
//		 if($(this).val() == 1)
//		 {
//		    male_count_increment++;  
//		 }else{
//		   
//		   female_count_increment++;
//		}		
//	      }	    
//	  });
//          var type=$('input[name="type"]').val();
//          var typeId=$('input[name="dataTypeId"]').val();
//          var roomId=$('input[name="roomCategory"]').val();
//          var start=$('input[name="travelFrom"]').val();
//          var end=$('input[name="travelTo"]').val();
//          var currency=$('input[name="currencytype"]').val();
//         
//         if(parseInt(male_count_increment) + parseInt(female_count_increment) == 1){
//             getSigleDialog();
//         }else{
//         
//         $.ajax({
//                url:"/checkRoomAvailabilty",
//                type:'POST',
//                data:{type:type,typeId:typeId,roomId:roomId,males:male_count_increment,females:female_count_increment,start:start,end:end,currency:currency},
//                success:function(result){
//                    if(result.price==0){
//                        if(result.msg!=''){
//                            alert(result.msg);
//                        }
//                         $('select[name="romname"]').val('');
//                         if(result.price==0){
//                         $('.j-price').html('Not Available');
//                          }else{
//                              $('.j-price').html(result.currency+' '+result.price+'<span id="num_left">per Night</span>');
//                          }
//                        // $('.j-price').html(result.currency+' '+result.price+'<span id="num_left">per Night</span>');
//                        $('input[name="roomRate"]').val(result.price);
//                        $('input[name="roomNetPrice"]').val(result.netprice);
//                        var totalCost=result.price*parseInt($('input[name="noOfDays"]').val());
//                        $('input[name="totalCost"]').val(totalCost.toFixed(2));
//                        $('#total_nights').html($('input[name="noOfDays"]').val());
//                        $('#room_p').html(result.currency+" "+result.price);
//                        $('#finalCost').html(result.currency+' '+$('input[name="totalCost"]').val());
//                        //var merchantFee=parseFloat($('input[name="merchantFee"]').val());
//                        //$('#merchant_fees').html(result.currency+' '+merchantFee.toFixed(2));
//                        //var finalCost=parseFloat($('input[name="merchantFee"]').val())+parseFloat($('input[name="totalCost"]').val());
//                        var finalCost=parseFloat($('input[name="totalCost"]').val());
//                        finalCost=finalCost.toFixed(2);
//                        $('#final_cost').html(result.currency+' '+finalCost);
//                        $("#inventory_room_available").html("Not Available");
//                        _calcFinalCost();
//                         alert("Please select different room");
//                    }else{
//                        if(result.price==0){
//                         $('.j-price').html('Not Available');
//                          }else{
//                              $('.j-price').html(result.currency+' '+result.price+'<span id="num_left">per Night</span>');
//                          }
//                       // $('.j-price').html(result.currency+' '+result.price+'<span id="num_left">per Night</span>');
//                        $('input[name="roomRate"]').val(result.price);
//                        $('input[name="roomNetPrice"]').val(result.netprice);
//                        var totalCost=result.price*parseInt($('input[name="noOfDays"]').val());
//                        $('input[name="totalCost"]').val(totalCost.toFixed(2));
//
//                        $('#total_nights').html($('input[name="noOfDays"]').val());
//                        $('#room_p').html(result.currency+" "+result.price);
//                        $('#finalCost').html(result.currency+' '+$('input[name="totalCost"]').val());
//                        //var merchantFee=parseFloat($('input[name="merchantFee"]').val());
//                        //$('#merchant_fees').html(result.currency+' '+merchantFee.toFixed(2));
//                        //var finalCost=parseFloat($('input[name="merchantFee"]').val())+parseFloat($('input[name="totalCost"]').val());
//                         var finalCost=parseFloat($('input[name="totalCost"]').val());
//                        finalCost=finalCost.toFixed(2);
//                        $('#final_cost').html(result.currency+' '+finalCost);
//                        _calcFinalCost();
//                    }
//              }});
//                _getRoomsAvailability(roomId,type);
//                _getRoomDetails(roomId,type);
//         }
//                
//              
//            });


        });




    };


//    var _getAmountDues = function() {
//
//
//        var today = $('#today').val().split("-");
//        ;
//        var startTrip = $('input[name="travelFrom"]').val().split("-");
//        var daysBefore = _getDiffDays(today, startTrip);
//        var finalCost = $('input[name="finalCost"]').val();
//
//
//        //alert(finalCost);
//        var depositAmount = $('input[name="depositAmount"]').val();
//
//        var from = $('input[name="travelFrom"]').val().split("-");
//
//
//
//        var maxFinalPaymentDue = new Date(parseFloat(from[0]), parseFloat(from[1]), parseFloat(from[2]));
//
//        if (daysBefore <= 90 && daysBefore > 60) {
//
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
//
//            $('input[name="dueDate2"]').val(maxFinalPaymentDue.getFullYear() + '-' + mnth + '-' + dayss);
//
//            $('#dueDate2').Zebra_DatePicker({
//                direction: [$('#today').val(), datesour]
//
//            })
//
//            $('input[name="depositAmount"]').attr('min', min.toFixed(2));
//            $('input[name="depositAmount"]').attr('max', finalCost - 1);
//
//            $('input[name="balansAfterDeposit"]').val((finalCost - depositAmount).toFixed(2)).show();
//
//            var finalPaymentDue = $('input[name="balansAfterDeposit"]').val();
//
//
//
//            $('input[name="finalPaymentDue"]').val(finalPaymentDue).show();
//
//        }
//
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
//            /* var oneDay = 24*60*60*1000;
//             
//             var depositAmount = (finalCost * 20) / 100;
//             var nextPaymentDue = (finalCost * 40) / 100;
//             var finalPaymentDue = nextPaymentDue;
//             
//             var maxNextPaymentDue = new Date(parseFloat(from[0]),parseFloat(from[1]),parseFloat(from[2]));
//             
//             maxNextPaymentDue = new Date(maxNextPaymentDue.getTime() - (90 * oneDay));
//             
//             
//             
//             var mnth=("0" + (maxNextPaymentDue.getMonth())).slice(-2);
//             
//             var dayss=("0" + maxNextPaymentDue.getDate()).slice(-2);
//             
//             var datesour=maxNextPaymentDue.getFullYear()+'-'+mnth+'-'+dayss;
//             
//             
//             
//             
//             var maxFinalPaymentDue = new Date(parseFloat(from[0]),parseFloat(from[1]),parseFloat(from[2]));
//             
//             maxFinalPaymentDue = new Date(maxFinalPaymentDue.getTime() - (60 * oneDay));
//             
//             
//             var mnth1=("0" + (maxFinalPaymentDue.getMonth())).slice(-2);
//             
//             var dayss1=("0" + maxFinalPaymentDue.getDate()).slice(-2);
//             
//             var datesour1=maxFinalPaymentDue.getFullYear()+'-'+mnth1+'-'+dayss1;
//             
//             $('input[name="dueDate2"]').val(maxFinalPaymentDue.getFullYear()+'-'+mnth1+'-'+dayss1);
//             
//             $('#dueDate1').val(maxNextPaymentDue.getFullYear()+'-'+mnth+'-'+dayss);
//             
//             $('#dueDate2').Zebra_DatePicker({
//             direction: [$('#today').val(),datesour1]
//             
//             })
//             
//             $('#dueDate1').Zebra_DatePicker({
//             direction: [$('#today').val(),datesour]
//             
//             })
//             
//             
//             $('input[name="balansAfterDeposit"]').val(finalCost - depositAmount);
//             $('input[name="nextPaymentDue[]"]').val(nextPaymentDue).parent().parent().show();
//             $('input[name="finalPaymentDue"]').val(finalPaymentDue).parent().parent().show();
//             */
//        }
//
//
//        //alert(from);
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
//
//
//
//            /*  var from = $('input[name="travelFrom"]').val().split("-");
//             var oneDay = 24*60*60*1000;
//             
//             
//             var depositAmount = (finalCost * 40) / 100;
//             var nextPaymentDue = (finalCost * 60) / 100;
//             var finalPaymentDue = nextPaymentDue;
//             
//             
//             var maxNextPaymentDue = new Date(parseFloat(from[0]),parseFloat(from[1]),parseFloat(from[2]));
//             
//             maxNextPaymentDue = new Date(maxNextPaymentDue.getTime() - (80 * oneDay));
//             
//             
//             
//             var mnth=("0" + (maxNextPaymentDue.getMonth())).slice(-2);
//             
//             var dayss=("0" + maxNextPaymentDue.getDate()).slice(-2);
//             
//             var datesour=maxNextPaymentDue.getFullYear()+'-'+mnth+'-'+dayss;
//             
//             
//             
//             
//             var maxFinalPaymentDue = new Date(parseFloat(from[0]),parseFloat(from[1]),parseFloat(from[2]));
//             
//             maxFinalPaymentDue = new Date(maxFinalPaymentDue.getTime() - (60 * oneDay));
//             
//             
//             var mnth1=("0" + (maxFinalPaymentDue.getMonth())).slice(-2);
//             
//             var dayss1=("0" + maxFinalPaymentDue.getDate()).slice(-2);
//             
//             var datesour1=maxFinalPaymentDue.getFullYear()+'-'+mnth1+'-'+dayss1;
//             
//             $('input[name="dueDate2"]').val(maxFinalPaymentDue.getFullYear()+'-'+mnth1+'-'+dayss1);
//             
//             $('#dueDate1').val(maxNextPaymentDue.getFullYear()+'-'+mnth+'-'+dayss);
//             
//             $('#dueDate2').Zebra_DatePicker({
//             direction: [$('#today').val(),datesour1]
//             
//             })
//             
//             $('#dueDate1').Zebra_DatePicker({
//             direction: [$('#today').val(),datesour]
//             
//             })
//             
//             
//             $('input[name="depositAmount"]').val(depositAmount);
//             $('input[name="depositAmount"]').attr('min', depositAmount);
//             $('input[name="balansAfterDeposit"]').val(finalCost - depositAmount);
//             $('input[name="nextPaymentDue[]"]').val(nextPaymentDue).parent().parent().show();
//             $('input[name="finalPaymentDue"]').val(finalPaymentDue).parent().parent().show();
//             */
//        }
//
//
//    };

    var getSigleDialog = function() {
        $( "#single-share" ).dialog({
                dialogClass: "no-close",
                buttons: [{
                text: "Continue",
                    click: function() {
                            $( this ).dialog( "close" );
                            var male_count_increment = 0;
                            var female_count_increment = 0;
                            var shareChecked=$('input[name=share]:checked').val();
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
                                var type=$('input[name="type"]').val();
                                var typeId=$('input[name="dataTypeId"]').val();
                                var roomId=$('input[name="roomCategory"]').val();
                                var start=$('input[name="travelFrom"]').val();
                                var end=$('input[name="travelTo"]').val();
                                var currency=$('input[name="currencytype"]').val();
                                var count=parseInt($('input[name="noOfPersons"]').val());

                                $.ajax({
                                       url:"/checkRoomAvailabilty",
                                       type:'POST',
                                       async:false,
                                       data:{share:shareChecked,type:type,typeId:typeId,roomId:roomId,males:male_count_increment,females:female_count_increment,start:start,end:end,currency:currency},
                                       success:function(result){
                                               if(result.price==0){
                                                   if(count==1){
                                                       alert('Single Traveller Not allowed.');
                                                       //$('#addButtonNew').trigger('click');
                                                   }
                                                   $('#click2').hide();
                                                   $('#cbp-ntaccordion #li3').removeClass("cbp-ntopen");
                                                   $('#cbp-ntaccordion #li4').removeClass("cbp-ntopen");
                                                   $('#cbp-ntaccordion #li5').removeClass("cbp-ntopen");
                                               }else{
                                                   $('#click2').show();
                                               }
                                               applyChanges(result);
                                               _getRoomsAvailability(roomId,type);
                                               _getRoomDetails(roomId,type);
                                     }});
                               }},
                 {
                text: "Cancel",
                    click: function() {
                    $( this ).dialog( "close" );
                }
                }],
            });
    }

    var _getTravellerPhone = function() {



        var phone = $('input[name="travellerPhone"]').val();

        $('#testphone').html(phone);

        //var start =$('input[name="travelFrom"]').val();
        //alert(start);

        //  alert( $('input[name="travellerCountry"]').val());  
    };


    var _getTravellerStreet = function() {

        //alert('here in from date');
        var travellerstreet = $('input[name="streetname"]').val();

        $('#testaddress').html(travellerstreet);

    };



    var _getTravellerName = function() {

        //alert('here in from date');
        var traveller1 = $('input[name="travellerName"]').val();

        $('#testtraveller1').html(traveller1);

    };



    var _getTravellerFrom = function() {

        //alert('here in from date');
        var start = $('input[name="travelFrom"]').val();

        $('#testdatefrom').html(start);

    };


    var _getTravellerflight = function() {

        //alert('here');

        //alert($('input[name="flight"]').val());
        var zip = $('input[name="flight"]:checked').val();
        //alert(zip); 
        if (zip) {
            $('input[name="flight"]').val(1);
            $('#testflight').html('Yes');

        } else {
            // $('theControledCheckBoxes').prop('checked', false);
            $('input[name="flight"]').val(0);
            $('#testflight').html('No');
        }

        //alert($('input[name="flight"]').val());
    };


    var _getTravellerZip = function() {

//	alert('here');
        var zip = $('input[name="travellerZip"]').val();
        $('#testzip').html(zip);
    };

    var _getTravellerState = function() {

//	alert('here');
        var state = $('input[name="travellerState"]').val();
        $('#teststate').html(state);
    };


    var _getTravellerCountry = function() {

//        alert('here in coun
//        try');
        var country = $('input[name="travellerCountry"]').val();
        $('#testcountry').html(country);
    };


    var _getTravellerCity = function() {

        //alert('here in city');
        var city = $('input[name="travellerCity"]').val();
        $('#testcity').html(city);
    };


    var _getTravellerEmail = function() {
        var email = $('input[name="travellerEmail"]').val();
        $('#testemail').html(email);
    };




    var _clearAll = function() {
        $('#ajax-what').html(null);
        $('#ajax-items').html(null);
   //     $('input[name="roomRate"]').val(0);
        $('input[name="travelTo"]').attr('min', null);
        $('input[name="travelTo"]').attr('max', null);
        $('input[name="travelFrom"]').attr('min', null);
        $('input[name="travelFrom"]').attr('max', null);
    };

    var _loadEntity = function() {
        $('#entity-item-details').hide();
        var resource = $(this).attr('data-resource');
        if (resource == 'events') {
            $('#dates').hide();
        } else {
            $('#dates').show();
        }
        $.get('/admin/orders/ajax/' + $(this).attr('data-resource'), function(data) {
            $('#ajax-where').html(data);
            $('.chzn-select').chosen();
            _clearAll();
        });
    };


    var _loadEntityItems = function() {
        $('#entity-item-details').hide();
        var id = $(this).val();
        var type = $(this).attr('data-type');
        var resource = $(this).attr('data-resource');
        if (type == 2) {
            if (id) {
                $.post('/admin/orders/ajax/' + resource + id, {id: id}, function(data) {
                    $('#ajax-what').html(data);
                    $('.chzn-select').chosen();
                });
            }
        } else {

            _dateSelect(type, id, resource);
        }

        _clearAll();
    };

    var _loadItem = function() {
        var id = $(this).val();
        var type = $(this).attr('data-type');
        var extraType = $(this).attr('data-extra-type');

        if (id) {

            $.post('/admin/orders/ajax/', {id: id, type: type}, function(data) {
                _bindItemData(data.result, type);
                _getExtraItems(extraType, id);
                _getExcursions(extraType, id);
                _getTransfers(extraType, id);

            });

            $('#dates').show();
        } else {
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
    

    var _bindItemData = function(data, type) {
        for (var i in data) {
            if (type == 2) {
                $('#' + i).val(data[i]);
            }
            if (type == 1 || type == 3)
            {
                if (i != 'dateFrom' && i != 'dateTo') {
                    $('#' + i).val(data[i]);
                }
            }
            if (i == 'dateFrom') {
                $('#' + i).attr('min', data[i]);

            }

            if (i == 'numberAvailable' || i == 'totalAvailable') {
                var totalStock = data[i];
            }

            if (i == 'bookedCount') {
                var booked = data[i];
            }

            if (i == 'dateTo') {
                $('#dateFrom').attr('max', data[i]);
                $('#' + i).attr('min', data[i]);
                $('#' + i).attr('max', data[i]);
            }

        }
        var available = totalStock - booked;
        $("#roomrequired").attr("max", available);
        if (available == 0) {
            available = "No Rooms Available";
            $("#creat").attr("disabled", true);
        }
        else {
            available = available + " Rooms Available";
            $("#creat").attr("disabled", false);
        }
        $("#inventory_room_available").html(available);

        _calcTotalCost();
        _bindNoOfDays();
        $('#entity-item-details').show();
        if (type == 2) {
            _dateValid();
        }
        //_getRoomsAvailability(data.id);

    };

    var _getDiffDays = function(from, to) {
        var oneDay = 24 * 60 * 60 * 1000;
        var firstDate = new Date(parseFloat(from[0]), parseFloat(from[1])-1, parseFloat(from[2]));
        var secondDate = new Date(parseFloat(to[0]), parseFloat(to[1])-1, parseFloat(to[2]));
        var diffDays = 0;
        if (firstDate < secondDate) {
            diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime()) / (oneDay)));
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

       //  alert('here');
        var itemsCost = 0;
        var itemsCostNet = 0;
        $.each($('input[name="items[]"]:checked'), function() {
            itemsCost = itemsCost + parseFloat($(this).attr('grossPrice'));
            itemsCostNet = itemsCostNet + parseFloat($(this).attr('netPrice'));
            
          //  var appendDiv = $('#show-items').html();
            //var iname = parseFloat($(this).attr('grossPrice'));

            //    alert(iname);

            //   var trvelno= i + ' Traveller';
            //$(appendDiv).insertAfter("#insurance");
            //$('#itemrate').html(iname);
        });
       // alert(itemsCostNet);
        $('input[name="itemsCost"]').val(itemsCost);
        $('input[name="itemsCost"]').attr("netCost",itemsCostNet);

        _calcFinalCost();
    };


    /*
     var _calcTotalCost = function() {
     
     
     var roomRate = parseFloat($('input[name="roomRate"]').val());
     var noOfDays = parseFloat($('input[name="noOfDays"]').val());
     var roomRequired = parseFloat($('input[name="roomRequired"]').val());
     var roomCost = roomRate * noOfDays * roomRequired;
     
     //alert(roomRate);
     
     var flightTotalCost = parseFloat($('input[name="flightTotalCost"]').val());
     var itemsCost = parseFloat($('input[name="itemsCost"]').val());
     var excursionsCost = parseFloat($('input[name="excursionsCost"]').val());
     var transfersCost = parseFloat($('input[name="transfersCost"]').val());
     var totalCost = roomCost + flightTotalCost + itemsCost + excursionsCost + transfersCost;
     $('input[name="totalCost"]').val(totalCost);
     //alert(totalCost);
     return totalCost;
     };
     */

    var _calcTotalCost = function() {

        var roomRate = parseFloat($('input[name="roomRate"]').val());
        var noOfDays = parseFloat($('input[name="noOfDays"]').val());
        var roomRequired = parseFloat($('input[name="roomRequired"]').val());
        var roomCost = roomRate * noOfDays * roomRequired;
        //var flightTotalCost = parseFloat($('input[name="flightTotalCost"]').val());
	
        if ($('input[name="itemsCost"]').val()) {
            var itemsCost = parseFloat($('input[name="itemsCost"]').val());
            var netItemCost = parseFloat($('input[name="itemsCost"]').attr("netcost"));
        } else {
            var itemsCost = 0;
            var netItemCost = 0;
        }

        if ($('input[name="excursionsCost"]').val()) {
            var excursionsCost = parseFloat($('input[name="excursionsCost"]').val());
            var netExcursionsCost = parseFloat($('input[name="excursionsCost"]').attr("netcost"));
        } else {
            var excursionsCost = 0;
            var netExcursionsCost = 0;
        }

        if ($('input[name="transfersCost"]').val()) {
            var transfersCost = parseFloat($('input[name="transfersCost"]').val());
            var netTransfersCost = parseFloat($('input[name="transfersCost"]').attr("netcost"));
        } else {
            var transfersCost = 0;
            var netTransfersCost = 0;
        }
       // alert(netItemCost);
       // alert(netExcursionsCost);
        //alert(netTransfersCost);
        var totalAddonsNetCost = parseFloat(netItemCost) + parseFloat(netExcursionsCost) + parseFloat(netTransfersCost);
        $("input[name='addonsNetPrice']").val(totalAddonsNetCost);

        //var totalCost = roomCost + flightTotalCost + itemsCost + excursionsCost + transfersCost;
	var totalCost = roomCost + itemsCost + excursionsCost + transfersCost;
         $("#total_addons").html(itemsCost + excursionsCost + transfersCost);
        
        //$('input[name="finalCost"]').val(Math.round(finalCost));
        //alert(Math.round(totalCost));

        $('input[name="totalCost"]').val(totalCost.toFixed(2));
	
        return totalCost;
    };


    var _calcFinalCost = function() {



        var discountType = $('input[name="discount"]').attr('data-discount-type');

        var totalCost = _calcTotalCost();
        var discount = parseFloat($('input[name="discount"]').val());
        //var merchantFee = parseFloat($('input[name="merchantFee"]').val());
       // var merchantFee = (2.5*totalCost)/100;

        //$('input[name="merchantFee"]').val(merchantFee.toFixed(2));
        var merchantFee = 0;
        
         if ($('input[name="paymentType"]:checked').val() == 1 || $('input[name="paymentType"]:checked').val() == 0) {
                  var checkedVal = $('input[name="paymentType"]:checked').val();
                    if(parseInt(checkedVal) == 0){
                        $("#deposits").trigger("click");
                    }else{
                         $("#full-payments").trigger("click");
                    }
        }
        
        if (isNaN(discount) || isNaN(merchantFee)) {
            discount = 0;
            //merchantFee = 0;
        }

       // var cost = totalCost + merchantFee;
         var cost = totalCost;

        var finalCost = 0;

        if (discountType == 1) {
            discount = (cost * discount) / 100;
        }

        //alert(discount);
        finalCost = cost - discount;
        //alert(finalCost);Math.round(
        $('input[name="finalCost"]').val(finalCost.toFixed(2));
        $("#finalCost").html(finalCost.toFixed(2));
        
       
        
        _getAmountDue();
        return finalCost;

    };

    var _getPayment = function() {

        // alert($(this).val());

        if ($(this).val() === '0') {


            // alert('0');

          //  $('input[name="depositAmount"]').removeAttr("readonly");
            //_getAmountDue();
//

            //   $('input[name="depositAmount"]').removeAttr("readonly");
            //  $('input[name="depositAmount"]').removeAttr("readonly");

        } else {

           // _before60Days($('input[name="finalCost"]').val());
          //  $('input[name="depositAmount"]').attr("readonly", true);
        }

    }

    var _getAmountDue = function() {


        //  alert('on key up');
        var today = $('#today').val().split("-");
        var startTrip = $('input[name="travelFrom"]').val().split("-");
        var finalCost = $('input[name="finalCost"]').val();

        var daysBefore = _getDiffDays(today, startTrip);

        //alert(daysBefore);
        //alert($('input[name="paymentType"]').val());

        if (daysBefore > 120) {

            // alert('here 120 days');

            $('#deposit-hide').show();
            _defaultPaymentDueCal(finalCost)//anup


            if ($('input[name="paymentType"]:checked').val() === '0') {

                _before120Days(finalCost);
            }
        }

        if (daysBefore <= 120 && daysBefore > 90) {

            //  alert('here in less than 90');
            $('#deposit-hide').show();
            _defaultPaymentDueCal(finalCost)//anup

            //alert(finalCost);

            if ($('input[name="paymentType"]:checked').val() === '0') {

                //    alert('here in deposit');

                _before90Days(finalCost);
            }
        }



        if (daysBefore <= 90 && daysBefore > 60) {

            //alert('here');
            $('#deposit-hide').show();
            _defaultPaymentDueCal(finalCost)//anup

            //alert(finalCost);

            if ($('input[name="paymentType"]:checked').val() === '0') {

                //  alert('here in deposit for 86 days');
                //_before90Days(finalCost);
                _before90after60Days(finalCost);
            }
        }



        if (daysBefore < 60) {
            $('#fullPayment').click();
            $('#deposit-hide').hide();
            _before60Days(finalCost);
        }

        if ($('input[name="paymentType"]:checked').val() === '1') {
            _before60Days(finalCost);
        }



    }

    var _defaultPaymentDueCal = function(finalCost) {

        // alert('default cost');
        var depositAmount = $('input[name="depositAmount"]').val();

        //alert(depositAmount);
        $('input[name="balansAfterDeposit"]').val((finalCost - depositAmount).toFixed(2));

    }



    var _before90after60Days = function(finalCost) {

        $("#due-date").hide();

        var from = $('input[name="travelFrom"]').val().split("-");
        var oneDay = 24 * 60 * 60 * 1000;
        
        var extraType = $('input[name="dataExtraType"]').val();
        var id = $('input[name="dataTypeId"]').val();
        var startTrip = $('input[name="travelFrom"]').val();

        _getDepositException(extraType,id,startTrip,null);//get deposit exception
        
        var depExcAmt = $('input[name="depositAmount"]').attr("depexamt");
        var depType = $('input[name="depositAmount"]').attr("depextyp");
        if(parseFloat(depExcAmt)){
                if(parseFloat(depType) == 1){
                    var depositAmount = (finalCost * parseFloat(depExcAmt)) / 100;
                    var finalPaymentDue = (finalCost * (100 - parseFloat(depExcAmt))) / 100;
                }else{
                    var depositAmount =  parseFloat(depExcAmt);
                    var finalPaymentDue = (finalCost - depositAmount);
                }
        }else{
            var depositAmount = (finalCost * 50) / 100;
            var finalPaymentDue = (finalCost * 50) / 100;
        }
        
//
//        var depositAmount = (finalCost * 50) / 100;
//
//        var finalPaymentDue = (finalCost * 50) / 100;

        $('input[name="depositAmount"]').attr('min', depositAmount.toFixed(2));


        var maxFinalPaymentDue = new Date(parseFloat(from[0]), parseFloat(from[1])-1, parseFloat(from[2]));

        maxFinalPaymentDue = new Date(maxFinalPaymentDue.getTime() - (45 * oneDay));

        var mnth = ("0" + (maxFinalPaymentDue.getMonth()+1)).slice(-2);

        var dayss = ("0" + maxFinalPaymentDue.getDate()).slice(-2);

        var datesour = maxFinalPaymentDue.getFullYear() + '-' + mnth + '-' + dayss;

        $('input[name="dueDate2"]').val(maxFinalPaymentDue.getFullYear() + '-' + mnth + '-' + dayss);

        $('#dueDate2').Zebra_DatePicker({
            direction: [$('#today').val(), datesour]

        })



        $('input[name="depositAmount"]').val(depositAmount.toFixed(2)).show();
        
            // var merchantFee = (2.5*depositAmount.toFixed(2))/100;
            // $('input[name="merchantFee"]').val(merchantFee);
        
        //$('input[name="depositAmount"]').val(depositAmount).show();

        $('input[name="balansAfterDeposit"]').val((finalCost - depositAmount).toFixed(2)).show();
        $('input[name="finalPaymentDue"]').val(finalPaymentDue.toFixed(2)).show();





    };

    var _before120Days = function(finalCost) {



        var from = $('input[name="travelFrom"]').val().split("-");
        var oneDay = 24 * 60 * 60 * 1000;
        
        //get payment deposit exception
        var extraType = $('input[name="dataExtraType"]').val();
        var id = $('input[name="dataTypeId"]').val();
        var startTrip = $('input[name="travelFrom"]').val();
         
          _getDepositException(extraType,id,startTrip,null);//get deposit exception
        
        var depExcAmt = $('input[name="depositAmount"]').attr("depexamt");
        var depType = $('input[name="depositAmount"]').attr("depextyp");
        if(parseFloat(depExcAmt)){
                if(parseFloat(depType) == 1){
                    var depositAmount = (finalCost * parseFloat(depExcAmt)) / 100;
                    var nextPaymentDue = ((finalCost * (100 - parseFloat(depExcAmt))) / 100)/2;
                    var finalPaymentDue = nextPaymentDue;
                }else{
                    var depositAmount = parseFloat(depExcAmt);
                    var nextPaymentDue = (finalCost - depositAmount)/2;
                    var finalPaymentDue = nextPaymentDue;
                }
        }else{
            var depositAmount = (finalCost * 20) / 100;
            var nextPaymentDue = (finalCost * 40) / 100;
            var finalPaymentDue = nextPaymentDue;
        }
        
//        var depositAmount = (finalCost * 20) / 100;
//        var nextPaymentDue = ((finalCost * 40) / 100).toFixed(2);
//        var finalPaymentDue = nextPaymentDue;



        //var maxNextPaymentDue = new Date(parseFloat(from[0]),parseFloat(from[1]),parseFloat(from[2]));

        // maxNextPaymentDue = new Date(maxNextPaymentDue.getDate() - (90 * oneDay));

        //   var maxFinalPaymentDue = new Date(parseFloat(from[0]),parseFloat(from[1]),parseFloat(from[2]));

        // maxFinalPaymentDue = new Date(maxFinalPaymentDue.getDate() - (60 * oneDay));



        var maxNextPaymentDue = new Date(parseFloat(from[0]), parseFloat(from[1])-1, parseFloat(from[2]));

        maxNextPaymentDue = new Date(maxNextPaymentDue.getTime() - (90 * oneDay));

        var mnth = ("0" + (maxNextPaymentDue.getMonth()+1)).slice(-2);

        var dayss = ("0" + maxNextPaymentDue.getDate()).slice(-2);

        var datesour = maxNextPaymentDue.getFullYear() + '-' + mnth + '-' + dayss;




        var maxFinalPaymentDue = new Date(parseFloat(from[0]), parseFloat(from[1])-1, parseFloat(from[2]));

        maxFinalPaymentDue = new Date(maxFinalPaymentDue.getTime() - (60 * oneDay));


        var mnth1 = ("0" + (maxFinalPaymentDue.getMonth()+1)).slice(-2);

        var dayss1 = ("0" + maxFinalPaymentDue.getDate()).slice(-2);

        var datesour1 = maxFinalPaymentDue.getFullYear() + '-' + mnth1 + '-' + dayss1;

        $('input[name="dueDate2"]').val(maxFinalPaymentDue.getFullYear() + '-' + mnth1 + '-' + dayss1);

        $('#dueDate1').val(maxNextPaymentDue.getFullYear() + '-' + mnth + '-' + dayss);

        $('#dueDate2').Zebra_DatePicker({
            direction: [$('#today').val(), datesour1]

        })

        $('#dueDate1').Zebra_DatePicker({
            direction: [$('#today').val(), datesour]

        })



        // $('#dueDate1').val(maxNextPaymentDue.getFullYear()+'-'+maxNextPaymentDue.getMonth()+'-'+maxNextPaymentDue.getDate());

        //$('input[name="dueDate2"]').val(maxFinalPaymentDue.getFullYear()+'-'+maxFinalPaymentDue.getMonth()+'-'+maxFinalPaymentDue.getDate());
        /* 
         
         var mnth=("0" + (maxFinalPaymentDue.getMonth())).slice(-2);
         
         var dayss=("0" + maxFinalPaymentDue.getDate()).slice(-2);
         
         var datesour=maxFinalPaymentDue.getFullYear()+'-'+mnth+'-'+dayss;
         
         $('input[name="dueDate2"]').val(maxFinalPaymentDue.getFullYear()+'-'+mnth+'-'+dayss);
         
         $('#dueDate2').Zebra_DatePicker({
         direction: [$('#today').val(),datesour]
         
         })
         
         */




        $('input[name="depositAmount"]').val(depositAmount.toFixed(2));
        
        //var merchantFee = (2.5*depositAmount.toFixed(2))/100;
        //$('input[name="merchantFee"]').val(merchantFee);
        
        $('input[name="balansAfterDeposit"]').val((finalCost - depositAmount).toFixed(2));
        $('input[name="nextPaymentDue[]"]').val(nextPaymentDue).parent().parent().show();
        $('input[name="finalPaymentDue"]').val(finalPaymentDue).parent().parent().show();

        //$('#dueDate1').attr('max', maxNextPaymentDue).attr('required', 'required').parent().parent().show();
        //$('#dueDate2"]').attr('max', maxFinalPaymentDue).attr('required', 'required').parent().parent().show();

    };

    var _before90Days = function(finalCost) {



        var from = $('input[name="travelFrom"]').val().split("-");
        var oneDay = 24 * 60 * 60 * 1000;
        
        var extraType = $('input[name="dataExtraType"]').val();
        var id = $('input[name="dataTypeId"]').val();
        var startTrip = $('input[name="travelFrom"]').val();

        _getDepositException(extraType,id,startTrip,null);//get deposit exception
        
        var depExcAmt = $('input[name="depositAmount"]').attr("depexamt");
        var depType = $('input[name="depositAmount"]').attr("depextyp");
        if(parseFloat(depExcAmt)){
                if(parseFloat(depType) == 1){
                    var depositAmount = (finalCost * parseFloat(depExcAmt)) / 100;
                    var nextPaymentDue = (finalCost * (100 - parseFloat(depExcAmt))) / 200;
                    var finalPaymentDue = nextPaymentDue;
                }else{
                    var depositAmount =  parseFloat(depExcAmt);
                    var nextPaymentDue = (finalCost - depositAmount)/2;
                    var finalPaymentDue = nextPaymentDue;
                }
        }else{
            var depositAmount = (finalCost * 40) / 100;
            var nextPaymentDue = (finalCost * 30) / 100;
            var finalPaymentDue = nextPaymentDue;
        }

//        var depositAmount = (finalCost * 40) / 100;
//        var nextPaymentDue = ((finalCost * 60) / 100).toFixed(2);
//        var finalPaymentDue = nextPaymentDue;


        var maxNextPaymentDue = new Date(parseFloat(from[0]), parseFloat(from[1])-1, parseFloat(from[2]));

        maxNextPaymentDue = new Date(maxNextPaymentDue.getTime() - (80 * oneDay));



        var mnth = ("0" + (maxNextPaymentDue.getMonth()+1)).slice(-2);

        var dayss = ("0" + maxNextPaymentDue.getDate()).slice(-2);

        var datesour = maxNextPaymentDue.getFullYear() + '-' + mnth + '-' + dayss;




        var maxFinalPaymentDue = new Date(parseFloat(from[0]), parseFloat(from[1])-1, parseFloat(from[2]));

        maxFinalPaymentDue = new Date(maxFinalPaymentDue.getTime() - (60 * oneDay));


        var mnth1 = ("0" + (maxFinalPaymentDue.getMonth()+1)).slice(-2);

        var dayss1 = ("0" + maxFinalPaymentDue.getDate()).slice(-2);

        var datesour1 = maxFinalPaymentDue.getFullYear() + '-' + mnth1 + '-' + dayss1;

        $('input[name="dueDate2"]').val(maxFinalPaymentDue.getFullYear() + '-' + mnth1 + '-' + dayss1);

        $('#dueDate1').val(maxNextPaymentDue.getFullYear() + '-' + mnth + '-' + dayss);

        $('#dueDate2').Zebra_DatePicker({
            direction: [$('#today').val(), datesour1]

        })

        $('#dueDate1').Zebra_DatePicker({
            direction: [$('#today').val(), datesour]

        })


        $('input[name="depositAmount"]').val(depositAmount.toFixed(2));
        
        //var merchantFee = (2.5*depositAmount.toFixed(2))/100;
       // $('input[name="merchantFee"]').val(merchantFee);
        
        $('input[name="depositAmount"]').attr('min', depositAmount.toFixed(2));
        $('input[name="balansAfterDeposit"]').val((finalCost - depositAmount).toFixed(2));
        $('input[name="nextPaymentDue[]"]').val(nextPaymentDue).parent().parent().show();
        $('input[name="finalPaymentDue"]').val(finalPaymentDue).parent().parent().show();


    };


    var _before60Days = function(finalCost) {

        $('input[name="depositAmount"]').val(finalCost).show();
        
        //var merchantFee = (2.5*finalCost)/100;
       // $('input[name="merchantFee"]').val(merchantFee);
        
        $('input[name="nextPaymentDue"]').val(null);
        $('input[name="finalPaymentDue"]').val(null);
        $('input[name="balansAfterDeposit"]').val(0);
        $('input[name="dueDate2"]').removeAttr('required').val(null);
        $('input[name="dueDate2"]').removeAttr('required').val(null);


    };


       
    var _addTraveller = function(){
    
	//alert('dsadsa');
        //var n = $('.b02').length + 1;
	//alert(n);
        var addId = $(this).attr("addid");
        //var limit = 0;
        
        if(addId != 1){
            $("#fbox03_1").attr("id", "fbox03_" + addId);
            $("#travlr_add_1").attr("id", "travlr_add_" + addId);
            $("#tname_1").attr("id", "tname_" + addId);
            $("#travlno_1").attr("id", "travlno_" + addId);
            $("#nexttravllr_1").attr("id", "nexttravllr_" + addId);
            $("#rem_1").attr("id", "rem_" + addId);

        }
        
	var appendDiv = $('#add-traveller').html();
        var noOfPerson = $('input[name="noOfPersons"]');
        
        var totalTravellerCount = parseFloat($("#inv_data").attr("f"))+parseFloat($("#inv_data").attr("m"));
        
        if(totalTravellerCount > parseFloat(noOfPerson.val())){
            var lock_g =  $("#inv_data").attr("lock_guest",1);
            $('#traveller-info').append(appendDiv);
             noOfPerson.val(parseFloat(noOfPerson.val())+ 1);
             if($('input[name="inv_data"]').attr('pPer') == 1){// condition for room rate for per person
                 $('input[name="roomRate"]').val(parseFloat(noOfPerson.val()) * parseFloat($('input[name="roomRate"]').attr('fixPrice')) );
                  _calcFinalCost();
            }
        }else{
           //limit  = 1;
            var lock_g =  $("#inv_data").attr("lock_guest",2);
            $(".remove-traveller").addClass("isset")
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
        
       
//	$('.travelinfo').append(appendDiv);
       // noOfPerson.val(parseFloat(noOfPerson.val())+ 1)
        
        var appendDiv1 = $('#show-traveller').html();
        
        if(addId != 1){
          //  addId = addId -1 ;
          var addIdNew = addId -1;
            $("#fbox03_"+addId).attr("addid",parseFloat($("#fbox03_"+addIdNew).attr("addid")) + 1);
            $("#travlr_add"+addId).attr("addid",parseFloat($("#travlr_add"+addIdNew).attr("addid")) + 1);
        }
	var tname=$(this).val();
	
	    
	$(appendDiv1).insertAfter($('.testtravlr').last());
	    //$('#ftraveller').append(appendDiv);
	$('#nexttravllr').html(tname);
        $(this).attr("addid",(parseFloat($(this).attr("addid"))+1));
        
        var nop = parseFloat($('input[name="noOfPersons"]').val());
        var searchNop = parseFloat($("#inv_data").attr("search_m")) + parseFloat($("#inv_data").attr("search_f"))
        var inventoryNop = parseFloat($("#inv_data").attr("m")) + parseFloat($("#inv_data").attr("f"))
        var checkSet = $(".remove-traveller").hasClass("isset");
        var lock_g =  $("#inv_data").attr("lock_guest");
        if ((checkSet == true || nop > searchNop) && inventoryNop >= nop && lock_g == 1) {
            var t = confirm("Adding more travellers may affect your nightly cost");
            if (t == true) {
                $("#more-guest-modal").dialog({
                    buttons: [
                        {
                            text: "Cancel",
                            id: "extra-cancel",
                            class: "extra-dialog-btn",
                            click: function() {
                                $(".fbox03").last().remove();
                                 $('.testtravlr').last().remove();
                                 noOfPerson.val(parseFloat(noOfPerson.val())- 1);
                                 _calcFinalCost();
                                 _newPriceIfGreaterOccupancy();
                                $(this).dialog("close");
                            }
                        },
                        {
                            text: "Proceed",
                            id: "extra-proceed",
                            class: "extra-dialog-btn",
                            click: function() {
//                                var checked = $('input[name="extra_gender"]:checked').val();
//                                if(checked == '2'){
//                                    $("#female_"+noOfPerson.val()).attr('checked', true).trigger("click");
//                                
//                                }
//                                if(checked == '1'){
//                                    $("#male_"+noOfPerson.val()).attr('checked', true).trigger("click");
//                                }
//                                
//                                if(checked == ''){
//                                    $("#fbox0" + noOfPerson.val() + "_1").remove();
//                                    noOfPerson.val(parseFloat(noOfPerson.val())- 1);
//                                }
//                                var check = $(".remove-traveller").hasClass("isset");
//                                if(check == true){
//                                 $('.sex').last().attr("checked", false);
//                                }
                                 $(this).dialog("close");
                            }
                        },
                    ]
                });
                
                $('.ext-gen').prop('checked', false);
//               if(inside == true){
//                _newPriceIfGreaterOccupancy();
//               }
           }else{
                 //$("#fbox0" + noOfPerson.val() + "_1").remove();
                  $(".fbox03").last().remove();
                  $('.testtravlr').last().remove();
                  noOfPerson.val(parseFloat(noOfPerson.val())- 1);
           }
        }
        	   

	$('.tbod').Zebra_DatePicker({
		  direction:-6570,
		 onSelect: function() {
                }
            });
            _countTraveller();
    	};
        
        var _checkGender=function(checked){
            alert("In Process");
        }
        
    
    var _removeTraveller = function(){
        //$(this).parents('.added-traveller').remove();
        var remId = $(this).attr("id").split("_");
        var  id = parseFloat(remId[1]);
        var trv_len = parseFloat($(".testtravlr").length);
        if(trv_len !=  1){
        $(this).attr("id","rem_"+id);
        $('.testtravlr').last().remove();
        }
        
        
        
        
        //$( ".fbox03" ).last().remove();
        
        $(".remove-traveller").addClass("isset");
	
        var noOfPerson = $('input[name="noOfPersons"]');
        
        if(parseFloat(noOfPerson.val()) > 1){
            $(".fbox03").last().remove();
         noOfPerson.val(parseFloat(noOfPerson.val())- 1);
         _calcFinalCost();
//         if($('input[name="inv_data"]').attr('pPer') == 1){// condition for room rate for per person
//           
//            $('input[name="roomRate"]').val(parseFloat(noOfPerson.val()) * parseFloat($('input[name="roomRate"]').attr("fixPrice")) );
//             _calcFinalCost();
//        }
         
          _newPriceIfGreaterOccupancy();
        }
         _countTraveller();
    };
    
      var _countTraveller = function(){
            var t = 2;
            $(".tnum").each(function(index) {
                $(this).html("<strong>Traveller Info "+t+"</strong>");
                t++;
            });
    }
      
     var _getOtherTraveller = function() {
        var appendId = $(this).attr('id').split("_");
        var val = $(this).val();

	if($('input[name="tname[]"]').length >= 1){
            $('#nexttravllr_'+appendId[1]).html(val);
        }
    };
    
    
    var _getClientDetails = function() {
        var cId = $("#cust-id").val();
        if (cId.length == 9) {
            $.post('/admin/orders/ajax/client-details', {cId: cId}, function(data) {
                if (data.name != null) {
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

                } else {
                    $("#not-found").html("Not a valid Customer Id.");
                    $("#not-found").css("color", "red");
                    _clearFields();
                }
            });
        }
    };

    var _loadClient = function() {
        var val = $(this).val();
        if (val == 2) {
            $("#ex-client").show();
        } else {
            $("#ex-client").hide();
            _clearFields();
            $("#cust-id").val('');
        }
    }

    var _clearFields = function() {
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
        // alert("asd");
        var start = $("#hid-start").val();
        var end = $("#hid-end").val();
        
        var start_modify = $("#hid-mod-start").val();
        var end_modify_two = $("#hid-mod-end-two").val();
        var end_modify = $("#hid-mod-end").val();
        var oneDay = 24*60*60*1000;
        var min_stay_days = parseInt($("input[name='minimum-stay-days']").val());
        var roomId = $("#resort-rooms").val();
//        var start = new Date(parseFloat(start[0]),parseFloat(start[1]),parseFloat(start[2]));
//        start = new Date(start.getTime() - (5 * oneDay));
//        start = start.getFullYear()+"-"+start.getMonth()+"-"+start.getDate();
//        var end = new Date(parseFloat(end[0]),parseFloat(end[1]),parseFloat(end[2]));
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
                dateObj.setDate(dateObj.getDate() + parseFloat(min_stay_days));
                var day = (dateObj.getDate().toString().length) < 2 ? ('0' + dateObj.getDate()) : dateObj.getDate();
                var month = ((dateObj.getMonth() + 1).toString().length) < 2 ? ('0' + (dateObj.getMonth() + 1)) : dateObj.getMonth() + 1;
                var date = dateObj.getFullYear() + '-' + month + '-' + day;
                
                $('#dateTo').Zebra_DatePicker({
                    format: 'Y-m-d',
                    show_clear_date: false,
                    direction: [date.toString(), end_modify.toString()],
                     onSelect : function(){
                        _getRoomsAvailability(roomId,type);
                        $("#check-date-change").val(1);
                    }
                });
                   _bindNoOfDays();
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
                    $('#dateTo').Zebra_DatePicker({
                    format: 'Y-m-d',
                    show_clear_date: false,
                    direction: [date.toString(), end.toString()],
                    onSelect:function (){
                        _getRoomsAvailability(roomId,type);
                        $("#check-date-change").val(1);
                    }
                });
                  _bindNoOfDays();
                   _getRoomsAvailability(roomId,type);
                  $("#check-date-change").val(1);
              }
         });
         
         $('#dateTo').Zebra_DatePicker({
              direction: [start.toString(),end.toString()],
              zero_pad : true,
              onSelect: function() {
                   _bindNoOfDays();
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
                    $('#dateTo').Zebra_DatePicker({
                    format: 'Y-m-d',
                    show_clear_date: false,
                    direction: [date.toString(), end.toString()],
                    onSelect: function() {
                    _bindNoOfDays();
                     _getRoomsAvailability(roomId,type);
                      $("#check-date-change").val(1);
                    }
                });
                $('#dateTo').val(date);
                _bindNoOfDays();
                 _getRoomsAvailability(roomId,type);
                  $("#check-date-change").val(1);
              }
        })
        
        $('#dateTo').Zebra_DatePicker({
                    onSelect: function() {
                    _bindNoOfDays();
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
             if(parseInt(data.count)<=0){
                 alert('No rooms available in this Category. Please select another.');
                 $('select[name="romname"]').val('');
                 data.count = 0;
             }
              $("#inventory_room_available").html((parseFloat(data.count)) + " Rooms Available");
              $("#num_left").html("( "+(parseFloat(data.count)) + " Rooms Available )");
              var priceData = data.data;
              var price = 0;
              var finalAvgPrice = 0;
              var netPrice = 0;
              var finalAvgNetPrice = 0;
              var i = 0;
              $.each(priceData, function(key, value) {
                  price = parseFloat(value.grossPrice);
                  finalAvgPrice += price;
                  
                  netPrice = parseFloat(value.netPrice);
                  finalAvgNetPrice += netPrice;
                  i++;
            });
            //$('input[name="roomRate"]').val(finalAvgPrice/i);
            //$('input[name="roomRate"]').attr('fixPrice',finalAvgPrice/i);
            //$('input[name="roomNetPrice"]').val(finalAvgNetPrice/i);
            //$("#inv_data").attr("dOp",finalAvgPrice/i);
            //$("#inv_data").attr("dOpN",finalAvgNetPrice/i);
            //_checkTavellersSexCount(data);
           // _newPriceIfGreaterOccupancy();
            // _calcFinalCost();
           });
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
                  price = parseFloat(value.grossPrice);
                  finalAvgPrice += price;
                  
                  netPrice = parseFloat(value.netPrice);
                  finalAvgNetPrice += netPrice;
                  i++;
            });

            //$('input[name="roomNetPrice"]').val(finalAvgNetPrice/i);
            $("#inv_data").attr("dOp",finalAvgPrice/i);
            $("#inv_data").attr("dOpN",finalAvgNetPrice/i);
            _checkTavellersSexCount(data);
           });
    }
    
    

    var _addDuePayment = function() {
        var appendDiv = $('#add-duedate').html();
        $('#due-date').append(appendDiv);
        $('.duedate').Zebra_DatePicker();
    };

    var _removeDuePayment = function() {
        $(this).parents('.added-duedates').remove();
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
    
    var _getInventoryDataDump = function(type, id) {

        $.post('/admin/orders/ajax/', {id: id, type: type, dateFrom: $("#dateFrom").val(), dateTo: $("#dateTo").val()}, function(data) {
            if (data.status != 0) {
                _bindItemData(data.result, type);
            } else {
//                alert(data.result);
            }
        });
    }

    var _loadEntityRooms = function(type, id, resource) {
        var dateFrom = $("#dateFrom").val();
        var dateTo = $("#dateTo").val();
        if (id) {
            $.post('/admin/orders/ajax/' + resource + id, {id: id, dateFrom: dateFrom, dateTo: dateTo}, function(data) {
                $('#ajax-what').html(data);
                _bindItemData(data.result, type);
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
        var tOcpFN = 0;
        var tOcpMN = 0;
        var qOcp = [];
        var qOcpF = 0;
        var qOcpM = 0;
        var qOcpFN = 0;
        var qOcpMN = 0;
        var sOcp = [];
        var sOcpG = 0;
        var sOcpN = 0;
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
                        var netPrice = 0;
                        price = parseFloat(value.triplePriceFemaleGross);
                        tOcpF += price;
                        netPrice = parseFloat(value.triplePriceFemaleNet);
                        tOcpFN += netPrice;
                }
                
                if (value.triplePriceMaleGross) {
                        //tOcpM.push(value.triplePriceMaleGross);
                        var price = 0;
                        var netPrice = 0;
                        price = parseFloat(value.triplePriceMaleGross);
                        tOcpM += price;
                        netPrice = parseFloat(value.triplePriceMaleNet);
                        tOcpMN += netPrice;
                }
            }
                
                
            if(value.quadOccupancy){
             
                    qOcp.push(value.quadOccupancy); 
                if(value.quadPriceFemaleGross){
                    //qOcpF.push(value.quadPriceFemaleGross);
                    var price = 0;
                    var netPrice = 0;
                     price = parseFloat(value.quadPriceFemaleGross);
                        qOcpF += price;
                    netPrice = parseFloat(value.quadPriceFemaleNet);
                        qOcpFN += netPrice;
           }

                if(value.quadPriceMaleGross){
                     //qOcpM.push(value.quadPriceMaleGross);
                     var price = 0;
                     var netPrice = 0;
                    price = parseFloat(value.quadPriceMaleGross);
                        qOcpM += price;
                    netPrice = parseFloat(value.quadPriceMaleNet);
                        qOcpMN += netPrice;
               }
            }
                  
            if(value.singlePremiumOccupancy){
                sOcp.push(value.singlePremiumOccupancy);
                  if(value.single_price_gross){
                    //sOcpG.push(value.single_price_gross);
                    var price = 0;
                    var netPrice = 0;
                    price = parseFloat(value.single_price_gross);
                        sOcpG += price;
                     netPrice = parseFloat(value.single_price_net);
                        sOcpN += netPrice;
                  }
              }
              
              if(value.pricePer){
                  pPer =  parseFloat(value.pricePer);
              }

                    i++;
                    
//                    var finalAvgPrice = (2 * parseFloat($("#inv_data").attr("tOcpF")))+(parseFloat($("#inv_data").attr("tOcpM")))
//                   $('input[name="roomRate"]').val(finalAvgPrice);
//             _calcFinalCost();
            });

                    $("#inv_data").attr("m", Math.max(parseFloat(m)));
                    $("#inv_data").attr("f", Math.max(parseFloat(f)));
                    $("#inv_data").attr("tOcp", Math.max(parseFloat(tOcp)));
                    $("#inv_data").attr("tOcpF", parseFloat(tOcpF)/i);
                    $("#inv_data").attr("tOcpM", parseFloat(tOcpM)/i);
                    $("#inv_data").attr("tOcpFN", parseFloat(tOcpFN)/i);
                    $("#inv_data").attr("tOcpMN", parseFloat(tOcpMN)/i);
                    $("#inv_data").attr("qOcp", Math.max(parseFloat(qOcp)));
                    $("#inv_data").attr("qOcpF", parseFloat(qOcpF)/i);
                    $("#inv_data").attr("qOcpM",parseFloat(qOcpM)/i);
                    $("#inv_data").attr("qOcpFN", parseFloat(qOcpFN)/i);
                    $("#inv_data").attr("qOcpMN",parseFloat(qOcpMN)/i);
                    $("#inv_data").attr("sOcp", Math.max(parseFloat(sOcp)));
                    $("#inv_data").attr("sOcpG", parseFloat(sOcpG)/i);
                    $("#inv_data").attr("sOcpN", parseFloat(sOcpN)/i);
                    $("#inv_data").attr("pPer", parseFloat(pPer));
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
//     _newPriceIfGreaterOccupancy = function(){
//        var noOfPerson = $('input[name="noOfPersons"]').val();
//
//        var noOfMales = parseFloat($('.set').length);
//        var noOfFemales = parseFloat($('.fset').length);
//        //alert(noOfMales);
//       // alert(noOfFemales);
//        switch(noOfPerson){
//            case '1':
//                var pricePer = parseFloat($("#inv_data").attr("dOp"));
//                if(pricePer == 2){
//                var finalRoomRate = parseFloat($("#inv_data").attr("dOp"));
//                $('input[name="roomRate"]').val(finalRoomRate);
//                _calcFinalCost();
//                }
//                break;
//            case '2':
//                var pricePer = parseFloat($("#inv_data").attr("dOp"));
//                if (pricePer == 2) {
//                    var finalRoomRate = parseFloat($("#inv_data").attr("dOp"));
//                    $('input[name="roomRate"]').val(finalRoomRate);
//                    _calcFinalCost();
//                }
//               break;
//            case '3':
//                alert("Triple Occupancy price will be Applied.")
//                var finalAvgPrice = (noOfFemales * parseFloat($("#inv_data").attr("tOcpF")))+(noOfMales*parseFloat($("#inv_data").attr("tOcpM")))
//                $('input[name="roomRate"]').val(finalAvgPrice);
//                _calcFinalCost();
//                break;
//            case '4':
//                alert('Quad Occupancy price will be Applied.')
//                 var finalAvgPrice = (noOfFemales * parseFloat($("#inv_data").attr("qOcpF")))+(noOfMales*parseFloat($("#inv_data").attr("qOcpM")))
//                $('input[name="roomRate"]').val(finalAvgPrice);
//                _calcFinalCost();
//                break;
//        }
//    }

    _newPriceIfGreaterOccupancy = function(){
        var noOfPerson = $('input[name="noOfPersons"]').val();

        var noOfMales = parseFloat($('.set').length);
        var noOfFemales = parseFloat($('.fset').length);
        
        var totalSelected = noOfMales + noOfFemales;
        
        var currencyExchange = parseFloat($('#currency-exchange').val());
        currencyExchange=currencyExchange.toFixed(2);
        var currencyType = $("#currency-type").val();
        
        var tOcp = parseFloat($("#inv_data").attr("tocp"));
        var tOcpM = parseFloat(currencyExchange*$("#inv_data").attr("tocpm"));
        var tOcpF = parseFloat(currencyExchange*$("#inv_data").attr("tocpf"));
        var tOcpMN = parseFloat(currencyExchange*$("#inv_data").attr("tocpmn"));
        var tOcpFN = parseFloat(currencyExchange*$("#inv_data").attr("tocpfn"));
        var dOcp = parseFloat($("#inv_data").attr("dOp"));
        var dOcpN = parseFloat($("#inv_data").attr("dOpN"));
        var qOcp = parseFloat($("#inv_data").attr("qocp"));
        var qOcpM = parseFloat(currencyExchange*$("#inv_data").attr("qocpm"));
        var qOcpF = parseFloat(currencyExchange*$("#inv_data").attr("qocpf"));
        var qOcpMN = parseFloat(currencyExchange*$("#inv_data").attr("qocpmn"));
        var qOcpFN = parseFloat(currencyExchange*$("#inv_data").attr("qocpfn"));
        var pricePer = parseFloat($("#inv_data").attr("pper"));

       if(pricePer == 1){
//            var finalRoomRate = parseFloat(currencyExchange*$("#inv_data").attr("dOp"))* noOfPerson;
//            $('input[name="roomRate"]').val(finalRoomRate);
//            $("#room_p").html(currencyType + "  "+ finalRoomRate);
//             $(".j-price").html(currencyType +"  "+ finalRoomRate);
//            _calcFinalCost();
            switch (noOfPerson) {
            case '1':
                var pricePer = parseFloat($("#inv_data").attr("dOp"));
                var singleOcpAl = parseFloat($("#inv_data").attr("socp"));
                if(singleOcpAl){
//                    var finalRoomRate = parseFloat($("#inv_data").attr("socpg"))* noOfPerson ;
//                    var finalNetRoomRate = parseFloat($("#inv_data").attr("socpn"))* noOfPerson ;
                    
                    var finalRoomRate = parseFloat(currencyExchange*$("#inv_data").attr("socpg"))* noOfPerson ;
                    var finalNetRoomRate = parseFloat(currencyExchange*$("#inv_data").attr("socpn"))* noOfPerson ;
//                    alert("If "+currencyExchange);
                    $('input[name="roomRate"]').val(finalRoomRate);
                    $('input[name="roomNetPrice"]').val(finalNetRoomRate);
                     $("#room_p").html(currencyType + "  "+ finalRoomRate);
                    $(".j-price").html(currencyType +"  "+ finalRoomRate);
                    _calcFinalCost();
                }else{
//                    finalRoomRate = parseFloat($("#inv_data").attr("dOp"));
//                    var finalNetRoomRate = parseFloat($("#inv_data").attr("dOpn"));
                    
                    var finalRoomRate = parseFloat(currencyExchange*$("#inv_data").attr("dOp"));
                    var finalNetRoomRate = parseFloat(currencyExchange*$("#inv_data").attr("dOpN"));
//                    alert("else "+finalRoomRate);
                    $('input[name="roomRate"]').val(parseFloat($("#inv_data").attr("dOp")));
                    $('input[name="roomNetPrice"]').val(finalNetRoomRate);
                     $("#room_p").html(currencyType + "  "+ finalRoomRate);
                     $(".j-price").html(currencyType +"  "+ finalRoomRate);
                    _calcFinalCost();
                }
                break;
                
            case '2':
                var pricePer = parseFloat($("#inv_data").attr("dOp"));
                 var finalNetRoomRate = currencyExchange*parseFloat($("#inv_data").attr("dOpn"));
                    var finalRoomRate = currencyExchange*pricePer*2;
                    var finalNetRoomRate = finalNetRoomRate*2;
                    $('input[name="roomRate"]').val(finalRoomRate);
                    $('input[name="roomNetPrice"]').val(finalNetRoomRate);
                    $("#room_p").html(currencyType + "  "+ finalRoomRate);
                     $(".j-price").html(currencyType +"  "+ finalRoomRate);
                    
                    _calcFinalCost();

                break;
            case '3':
                    if (tOcp) {
                        var finalRoomRate = currencyExchange*dOcp*2;
                        var finalNetRoomRate = currencyExchange*dOcpN*2;
                        if (noOfMales > 1) {
                            finalRoomRate += tOcpM;
                            finalNetRoomRate += tOcpMN;
                        } else {
                            finalRoomRate += tOcpF;
                            finalNetRoomRate += tOcpFN;
                        }
                         $('input[name="roomRate"]').val(finalRoomRate);
                         $('input[name="roomNetPrice"]').val(finalNetRoomRate);
                         $("#room_p").html(currencyType + "  "+ finalRoomRate);
                         $(".j-price").html(currencyType +"  "+ finalRoomRate);
                        _calcFinalCost();
                    } else {
                        finalRoomRate = 0;
                        finalNetRoomRate =0;
                        $('input[name="roomRate"]').val(finalRoomRate);
                        $('input[name="roomNetPrice"]').val(finalNetRoomRate);
                        $("#room_p").html(currencyType + "  "+ finalRoomRate);
                        $(".j-price").html(currencyType +"  "+ finalRoomRate);
                        alert("Triple Occupancy not allowed.");
                        _calcFinalCost();
                    }
                break;
            case '4':
                    if (qOcp == 1) {
                        finalRoomRate = currencyExchange*dOcp*2;
                        finalNetRoomRate = currencyExchange*dOcpN*2;
                        if ((noOfMales == 2 && noOfFemales == 2)) {
                            finalRoomRate = dOcp*2 + qOcpM + qOcpF;
                            finalNetRoomRate = dOcpN*2 + qOcpMN + qOcpFN;
                        } else if (noOfMales > 2) {
                            finalRoomRate = dOcp*2 + (qOcpM * 2);
                            finalNetRoomRate = dOcpN*2 + (qOcpMN * 2);
                        } else if (noOfFemales > 2) {
                            finalRoomRate = dOcp*2 + (qOcpF * 2);
                            finalNetRoomRate = dOcpN*2 + (qOcpFN * 2);
                        }
                    } else {
                        finalRoomRate = 0;
                        alert("Quad Occupancy not allowed")
                    }
                    $('input[name="roomRate"]').val(finalRoomRate);
                     $('input[name="roomNetPrice"]').val(finalNetRoomRate);
                    $("#room_p").html(currencyType + "  "+ finalRoomRate);
                    $(".j-price").html(currencyType +"  "+ finalRoomRate);
                    _calcFinalCost();
                break;
        }
       }
       else{
        switch (noOfPerson) {
            case '1':
                if(totalSelected == 1){
                var pricePer = parseFloat(currencyExchange*$("#inv_data").attr("dOp"));
                var singleOcpAl = parseFloat($("#inv_data").attr("socp"));
                if(singleOcpAl){
                    var finalRoomRate = parseFloat(currencyExchange*$("#inv_data").attr("socpg"))* noOfPerson ;
                    var finalNetRoomRate = parseFloat(currencyExchange*$("#inv_data").attr("socpn"))* noOfPerson ;
                    $('input[name="roomRate"]').val(finalRoomRate);
                    $('input[name="roomNetPrice"]').val(finalNetRoomRate);
                    $("#room_p").html(currencyType + "  "+ finalRoomRate);
                    $(".j-price").html(currencyType +"  "+ finalRoomRate);
                    _calcFinalCost();
                }else{ 
                    finalRoomRate = parseFloat(currencyExchange*$("#inv_data").attr("dOp"));
                    finalNetRoomRate = parseFloat(currencyExchange*$("#inv_data").attr("dOpN"));
                    $('input[name="roomRate"]').val(finalRoomRate);
                    $('input[name="roomNetPrice"]').val(finalNetRoomRate);
                    $("#room_p").html(currencyType + "  "+ finalRoomRate);
                    $(".j-price").html(currencyType +"  "+ finalRoomRate);
                    _calcFinalCost();
                }
                }else{
                     $("j-price").html("Select gender to get room Price");
                }
                break;
                
            case '2':
                 if(totalSelected == 2){
                var pricePer = parseFloat(currencyExchange*$("#inv_data").attr("dOp"));
                var finalNetRoomRate = parseFloat(currencyExchange*$("#inv_data").attr("dOpN"));
                    var finalRoomRate = pricePer;
                    $('input[name="roomRate"]').val(finalRoomRate);
                    $('input[name="roomNetPrice"]').val(finalNetRoomRate);
                    $("#room_p").html(currencyType + "  "+ finalRoomRate);
                    $(".j-price").html(currencyType +"  "+ finalRoomRate);
                    _calcFinalCost();
                 }else{
                     $("j-price").html("Select gender to get room Price");
                 }

                break;
            case '3':
                if(totalSelected == 3){
                    if (tOcp) {
                        var finalRoomRate = dOcp;
                         var finalNetRoomRate = dOcpN;
                        if (noOfMales > 1) {
                            finalRoomRate += tOcpM;
                             finalNetRoomRate += tOcpMN;
                        } else {
                            finalRoomRate += tOcpF;
                             finalNetRoomRate += tOcpFN;
                        }
                         $('input[name="roomRate"]').val(finalRoomRate);
                         $('input[name="roomNetPrice"]').val(finalNetRoomRate);
                         $("#room_p").html(currencyType + "  "+ finalRoomRate);
                         $(".j-price").html(currencyType +"  "+ finalRoomRate);
                        _calcFinalCost();
                    } else {
                        finalRoomRate = dOcp * noOfPerson;
                        finalNetRoomRate = dOcpN * noOfPerson;
                        $('input[name="roomRate"]').val(finalRoomRate);
                        $('input[name="roomNetPrice"]').val(finalNetRoomRate);
                        $("#room_p").html(currencyType + "  "+ finalRoomRate);
                         $(".j-price").html(currencyType +"  "+ finalRoomRate);
                        _calcFinalCost();
                    }
                }else{
                    $("j-price").html("Select gender to get room Price");
                }
                break;
            case '4':
                if(totalSelected == 4){
                    if (qOcp == 1) {
                        finalRoomRate = dOcp;
                        finalNetRoomRate = dOcpN;
                        if ((noOfMales == 2 && noOfFemales == 2)) {
                            finalRoomRate = dOcp + qOcpM + qOcpF;
                            finalNetRoomRate = dOcpN + qOcpMN + qOcpFN;
                        } else if (noOfMales > 2) {
                            finalRoomRate = dOcp + (qOcpM * 2);
                             finalNetRoomRate = dOcpN + (qOcpMN * 2);
                        } else if (noOfFemales > 2) {
                            finalRoomRate = dOcp + (qOcpF * 2);
                            finalNetRoomRate = dOcpN + (qOcpFN * 2);
                        }
                    } else {
                        finalRoomRate = dOcp * noOfPerson;
                        finalNetRoomRate = dOcpN * noOfPerson;
                    }
                    $('input[name="roomRate"]').val(finalRoomRate);
                     $('input[name="roomNetPrice"]').val(finalNetRoomRate);
                    $("#room_p").html(currencyType + "  "+ finalRoomRate);
                    $(".j-price").html(currencyType +"  "+ finalRoomRate);
                    _calcFinalCost();
                }else{
                    $("j-price").html("Select gender to get room Price");
                }
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
            //alert('type'+type);
             var today = $("#today").val();
             $.ajax({
                async:false,    
                url: '/admin/orders/ajax/get-deposit-exception',
                type: 'POST',
                data: {typeId:typeId,type:type,dateFrom:dateFrom,exceptionStart:today},
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
    
    var _getRoomDetails = function(roomId,type){
            $.ajax({
                url: '/reservation/room-details/'+roomId+'/'+type,
                success: function(data){
                   data = JSON.parse(data);
                    $(".subheading").html(data.title);
                    $(".textsection").html(data.description);
                    if(type == 1){
                        $('.imgleft').attr("src","http://192.155.246.146:9124/user_uploads/resortroom/"+data.image);
                    }else if(type == 2){
                         $('.imgleft').attr("src","http://192.155.246.146:9124/user_uploads/resortroom/"+data.image);
                    }else{
                        $('.imgleft').attr("src","http://192.155.246.146:9124/user_uploads/cruisecabin/"+data.image);
                    }
                }
            });
    }

    return {
        init: function() {
            _initListeners();
        },
    };
}();

function callPriceCal(check){
    var noOfMales = parseFloat($('.set').length);
    var noOfFemales = parseFloat($('.fset').length);
    var schMale = parseFloat($("#inv_data").attr("m"));
    var schFemale = parseFloat($("#inv_data").attr("f"));
    var res = (check.id).split("_"); 
    var noOfPerson = $('input[name="noOfPersons"]');
    
    if(check.value == 1){
    if(noOfMales < schMale){
         var res = (check.id).split("_"); 
        $("#female_"+res[1]).removeClass("fset");
        $(check).addClass("set");
    }else{
         $("#female_"+res[1]).removeClass("fset");
         $("#male_"+res[1]).removeClass("set");
         $(check).attr('checked', false);
         alert("Sorry ,Room Male Occupancy reached");
         $("#extra_gender_f").trigger();
        
    }
}else{
   
     if(noOfFemales < schFemale){
        var res = (check.id).split("_");
        $("#male_"+res[1]).removeClass("set");
        $(check).addClass("fset");
    }else{
        $("#female_"+res[1]).removeClass("fset");
         $("#male_"+res[1]).removeClass("set");
         $(check).attr('checked', false);
        alert("Sorry ,Room Female Occupancy reached");
         $("#extra_gender_m").trigger();
    }
}

var nop =  parseFloat($('input[name="noOfPersons"]').val());
        var searchNop = parseFloat($("#inv_data").attr("search_m"))+parseFloat($("#inv_data").attr("search_f"))
         var checkSet = $(".remove-traveller").hasClass("isset");
    if(nop > searchNop || checkSet == true){
                _newPriceIfGreaterOccupancy();
        }
        
//        if(parseFloat($("#inv_data").attr("search_m")) <= noOfMales){
//            _newPriceIfGreaterOccupancy();
//        }
//        if(parseFloat($("#inv_data").attr("search_f")) <= noOfFemales){
//            _newPriceIfGreaterOccupancy();
//        }
    
//    if(check.value == 1){
//        var res = (check.id).split("_"); 
//        $("#female_"+res[1]).removeClass("fset");
//        $(check).addClass("set");
//    }else{
//        var res = (check.id).split("_");
//        $("#male_"+res[1]).removeClass("set");
//        $(check).addClass("fset");
//    }
   
}

function triggerGenderCal(){
     var noOfPerson = $('input[name="noOfPersons"]');
      var checked = $('input[name="extra_gender"]:checked').val();
    if(checked == '2'){
        $("#female_"+noOfPerson.val()).attr('checked', true).trigger("click");

    }
    if(checked == '1'){
        $("#male_"+noOfPerson.val()).attr('checked', true).trigger("click");
    }

    if(checked == ''){
        $("#fbox0" + noOfPerson.val() + "_1").remove();
        noOfPerson.val(parseFloat(noOfPerson.val())- 1);
    }
}





