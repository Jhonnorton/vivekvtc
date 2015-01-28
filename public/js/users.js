	$(function(){
		$('.grid-content .formRow ul.help-inline').parents('.formRow').addClass('error');
		$('.error input').keyup(function(){
					$(this).parents('.formRow').removeClass('error');
					$(this).next('ul.help-inline').remove();
		});

		$('#pass1, #pass2').keyup(checkPass);
		$('#changePswd').click(changePass);
	});			

	function checkPass(){
		var pass = $('#pass1').val();
		var repass = $('#pass2').val();

		console.log(pass !== repass && pass == '');
		
		if(pass !== repass || pass == '' || repass == ''){
			$('#pass1, #pass2').parents('.formRow').addClass('error');//.append('<ul class="help-inline"><li>Password does not match the confirm password</li></ul>')
			$('#submitbutton').attr('disabled', 'disabled');
		}else{
			$('#pass1, #pass2').parents('.formRow').removeClass('error').addClass('success');
			$('#submitbutton').removeAttr('disabled');
		} 
	};			

	function changePass(){
		$('.password').show();
		$('.password input[type=password]').val('');
		$('#submitbutton').attr('disabled', 'disabled');
	}
				
