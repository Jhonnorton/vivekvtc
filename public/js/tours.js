var Tours = function() {

    var _initListeners = function() {
       
        
        $(document).ready(function(){
          
            var start = $("#dateFrom").val(); 
            var end = $("#dateTo").val() ;
            
            $('#dateFrom').Zebra_DatePicker({
		direction: [start.toString(),end.toString()],
		onSelect: function() {
		   //   _bindNoOfDays();
		}
	  })
		$('#dateTo').Zebra_DatePicker({
		direction: [start.toString(),end.toString()],
		onSelect: function() {
		  //  _bindNoOfDays();
		}
	  })
	  
                     
           // _bindNoOfDays();
          //  _dateValid();
         
        })
        
    };
    
   
    
   
    
    var _dateValid = function (type){
        var start = $("#hid-start").val();
        var end = $("#hid-end").val();
        
        var start_modify = $("#hid-mod-start").val();
        var end_modify_two = $("#hid-mod-end-two").val();
        var end_modify = $("#hid-mod-end").val();
        var oneDay = 24*60*60*1000;
        
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
                
                $('#dateTo').Zebra_DatePicker({
                    format: 'Y-m-d',
                    show_clear_date: false,
                    direction: [date.toString(), end_modify.toString()],
                });
                   _bindNoOfDays();
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
              }
        })
        
  

    }
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
            var from = $('input[name="fromDate"]').val().split("-"); 
            var to = $('input[name="toDate"]').val().split("-");          
            $('input[name="noOfDays"]').val(_getDiffDays(from, to));
             _getTotalItemCost();
             _getTotalExcursionsCost();
    };
    
    return {
        init: function() {
            _initListeners();
        },
    };
}();





