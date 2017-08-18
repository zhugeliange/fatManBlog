$(document).ready(function($) {
	$(".register").hide();
});

$(".change").click(function(event) {
	$(".login").toggle(1000);
	$(".register").toggle(1000);

	if (!$(this).hasClass('animation_rotate')) {
		$(this).removeClass('animation_rotates');
		$(this).addClass('animation_rotate');
	} else {
		$(this).removeClass('animation_rotate');
		$(this).addClass('animation_rotates');
	}
});

$(".login [name='username']").keyup(function() {
	$.judgeRegular($(this), /^[\u4E00-\u9FA5A-Za-z0-9\@.]{5,50}$/, 'only the combination of chinese, english and numbers, and the length of 5 to 50 characters!');
});

$(".login [name='password']").keyup(function() {
	$.judgeRegular($(this), /^[A-Za-z0-9]{5,50}$/, 'only the combination of english and numbers, and the length of 5 to 50 characters!');
});

$(".login [type='button']").click(function() {
	if(!$.judgeRegular($(".login [name='username']"), /^[\u4E00-\u9FA5A-Za-z0-9\@.]{5,50}$/, 'only the combination of chinese, english and numbers, and the length of 5 to 50 characters!') || !$.judgeRegular($(".login [name='password']"), /^[A-Za-z0-9]{5,50}$/, 'only the combination of english and numbers, and the length of 5 to 50 characters!')) {
		return false;
	}
	
	$.post('/login/login', $('.login form').serialize(), function(result) {
		$('input').parent().removeClass('has-error has-feedback has-success');
		$('input').nextAll('.alert, span').remove();
		result = $.parseJSON(result);
		if (result.status == 2) {
			$.inputErrorMessage($(".login [name='username']"), "username does not exist!");
		} 
		if (result.status == 3) {
			$.inputErrorMessage($(".login [name='password']"), "password error!");
		}
		if (result.status == 1) {
			window.location.href = $.getUrlParam('refer') ? './'+$.getUrlParam('refer') : './';
		} 
	});
});

$(".register img").click(function() {
	$(".register [name='file']").click();
});

$(".register [name='file']").change(function() {
	if ($.inArray($(this).val().substr($(this).val().indexOf('.')), ['.jpg', '.png', '.bmp']) > -1) {
		$.get('/login/qnUpload', function(result) {
			result = $.parseJSON(result);
		    $(".register [name='token']").val(result);
			$.ajax({
			    url: 'http://up.qiniu.com',
			    type: 'POST',
			    enctype: 'multipart/form-data',
			    cache: false,
			    data: new FormData($("#headForm")[0]),
			    processData: false,
			    contentType: false
			})
			.done(function(results) {
				$(".register img").attr('src', 'http://oj6n9nf7i.bkt.clouddn.com/' + results.key + '-small');
				$(".register [name='headhash']").val(results.hash);
			});
		});
	}
});

$(".register [name='username']").keyup(function() {
	if(!$.judgeRegular($(".register [name='username']"), /^[\u4E00-\u9FA5A-Za-z0-9]{5,50}$/, 'only the combination of chinese, english and numbers, and the length of 5 to 50 characters!') || !$.judgeRegular($(".register [name='username']"), /^[0-9]*$/, 'pure digital is illegal, only the combination of chinese, english and numbers, and the length of 5 to 50 characters!', true) || !$.judgeRegular($(".register [name='username']"), /^(QQ|Wechat|Blog)/, 'illegal character, only the combination of chinese, english and numbers, and the length of 5 to 50 characters!', true)) {
		return false;
	}
});

$(".register [name='password']").keyup(function() {
	$.judgeRegular($(this), /^[A-Za-z0-9]{5,50}$/, 'only the combination of english and numbers, and the length of 5 to 50 characters!');
});

$(".register [name='rePassword']").keyup(function() {
	$(this).parent().removeClass('has-error has-feedback has-success');
	$(this).nextAll('.alert, span').remove();
	if ($(this).val() == $(".register [name='password']").val() && $(this).val()) {
		$.inputSuccessMessage($(this));
	} else {
		$.inputErrorMessage($(this), "please repeat your password!");
	}
});

$(".register [type='button']").click(function() {
	if(!$.judgeRegular($(".register [name='username']"), /^[\u4E00-\u9FA5A-Za-z0-9]{5,50}$/, 'only the combination of chinese, english and numbers, and the length of 5 to 50 characters!') || !$.judgeRegular($(".register [name='password']"), /^[A-Za-z0-9]{5,50}$/, 'only the combination of english and numbers, and the length of 5 to 50 characters!') || !$.judgeRegular($(".register [name='username']"), /^[0-9]*$/, 'pure digital is illegal, only the combination of chinese, english and numbers, and the length of 5 to 50 characters!', true) || !$.judgeRegular($(".register [name='username']"), /^(QQ|Wechat|Blog)/, 'illegal character, only the combination of chinese, english and numbers, and the length of 5 to 50 characters!', true)) {
		return false;
	}

	if ($(".register [name='rePassword']").val() == $(".register [name='password']").val() && $(".register [name='rePassword']").val()) {
		$.inputSuccessMessage($(".register [name='rePassword']"));
	} else {
		$.inputErrorMessage($(".register [name='rePassword']"), "please repeat your password!");
		return false;
	}
	
	$.post('/login/register', $('.register form').serialize() + '&headlink=' + $(".register img").attr('src') + '&headhash=' + $(".register [name='headhash']").val(), function(result) {
		$('input').parent().removeClass('has-error has-feedback has-success');
		$('input').nextAll('.alert, span').remove();
		result = $.parseJSON(result);
		if (result.status == 2) {
			$.inputErrorMessage($(".register [name='username']"), "username has exist!");
		}
		if (result.status == 1) {
			window.location.href = $.getUrlParam('refer') ? './' + $.getUrlParam('refer') : './';
		} 
	});
});
