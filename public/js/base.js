$(function() {
	$('input[required="required"], select[required="required"]').parent().siblings('label').addClass('required');

	$('.additional-menu > li > ul > li.active').parents('.menu-group').addClass('group-active');

	if ($('input[type="date"]').length > 0) {

		if ($('input[type="date"]')[0].type !== 'date') {

			$('input[type="date"]').Zebra_DatePicker();
			//$('input[type="date"]').datepicker({dateFormat:'yy-mm-dd'});

		}
	}
	$('.chzn-select').chosen();

	$('a[data-confirm]').live('click',function(ev) {
	   // alert('del');
		var href = $(this).attr('href');
		if (!$('#dataConfirmModal').length) {
			$('body').append('<div id="dataConfirmModal" class="modal" style="width: 300px; margin: auto;" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="dataConfirmLabel">Please Confirm</h3></div><div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button><a class="btn btn-primary" id="dataConfirmOK">OK</a></div></div>');
		}
		$('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
		$('#dataConfirmOK').attr('href', href);
		$('#dataConfirmModal').modal({
			show : true
		});
		return false;
	});
});
