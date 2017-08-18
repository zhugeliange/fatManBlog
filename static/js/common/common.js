$.extend({
	judgeRegular : function(object, regular, message, opposite, objects){
		if (object instanceof jQuery && regular) {
			var input = object.val();
			var realObject = objects ? objects : object;
			if (input && regular.test(input)) {
				if (opposite) {
					if(!message) {
						message = 'input error!';
					}
					console.log(message);
					$.inputErrorMessage(realObject, message);
					return false;
				}
				$.inputSuccessMessage(realObject);
				return true;
			} else {
				if (opposite) {
					$.inputSuccessMessage(realObject);
					return true;
				}
				if(!message) {
					message = 'input error!';
				}
				console.log(message);
				$.inputErrorMessage(realObject, message);
				return false;
			}
		} else {
			console.log('parameter error!');
			return false;
		}
	},
	inputErrorMessage : function(object, message){
		if (message && object instanceof jQuery) {
	        object.parent().removeClass('has-error has-feedback has-success');
	        object.nextAll('.alert, span').remove();
			object.parent().addClass('has-error has-feedback');
			object.after("<span class='glyphicon glyphicon-exclamation-sign form-control-feedback'></span>");
			object.after("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>"+message+"</strong></div>");
		} else {
			console.log('parameter error!');
			return false;
		}
	},
	inputSuccessMessage : function(object){
		if (object instanceof jQuery) {
	        object.parent().removeClass('has-error has-feedback has-success');
	        object.nextAll('.alert, span').remove();
			object.parent().addClass('has-success has-feedback');
			object.after("<span class='glyphicon glyphicon-ok-sign form-control-feedback'></span>");
		} else {
			console.log('parameter error!');
			return false;
		}
	},
	formClear: function(type, opposite){
		if (opposite) {
			var array = ['#articel', '#picture', '#music', '#video'];
			array.splice($.inArray(type, array), 1);
			type = array;
		} else {
			type = {type};
		}

		$.each(type, function(index, value) {
			$(value + ' .form-control').val('');
	        $(value + ' .form-control').parent().removeClass('has-error has-feedback has-success');
	        $(value + ' .form-control').nextAll('.alert, span:not(.input-group-btn)').remove();
	    	$(value + " .link").removeClass('has-error has-feedback has-success');
	    	$(value + " .link span:not(.input-group-btn),"+ value + " .link .alert").remove();
		});
	},
	getUrl: function(type, url){
		if (!url) {
			url = window.location.href;
		} 

		if (!type) {
			type = 'search';
		}

		var pattern = /^http.*\/([a-zA-Z0-9_.]+)\.(\w+)\?(.*)$/;

		if (typeof(url) == 'string' || pattern.test(url)) {
			var types = ['hash', 'host', 'hostname', 'pathname', 'port', 'protocol', 'search'];
			if ($.inArray(type, types)) {
				return eval('window.location.' + type);
			}
		}
		return url;
	},
	getUrlParam: function(name){
		var regular = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var value = window.location.search.substr(1).match(regular);
        if (value) 
        	return unescape(value[2]); 
        return false;
	},
	message: function(message, type = 1){
		if (message) {
			$('#message .message-body').text(message);
			switch (type) {
				case 1:
					//no header,no footer (default)
					$('#message').removeClass('hidden');
					break;
				case 2:
					//no header
					$('#message hr:last').removeClass('hidden');
					$('#message .message-footer').removeClass('hidden');
					$('#message .message-footer button').removeClass('hidden');
					$('#message').removeClass('hidden');
					break;
				case 3:
					//no footer
					$('#message hr:first').removeClass('hidden');
					$('#message .message-header').removeClass('hidden');
					$('#message').removeClass('hidden');
					break;
				case 4:
					//no header, one button
					$('#message hr:last').removeClass('hidden');
					$('#message .message-footer').removeClass('hidden');
					$('#message .message-footer .btn-yige').removeClass('hidden');
					$('#message').removeClass('hidden');
					break;
				case 5:
					//one button
					$('#message hr').removeClass('hidden');
					$('#message .message-header').removeClass('hidden');
					$('#message .message-footer').removeClass('hidden');
					$('#message .message-footer .btn-yige').removeClass('hidden');
					$('#message').removeClass('hidden');
					break;
				case 6:
					//all
					$('#message hr').removeClass('hidden');
					$('#message .message-header').removeClass('hidden');
					$('#message .message-footer').removeClass('hidden');
					$('#message .message-footer button').removeClass('hidden');
					$('#message').removeClass('hidden');
					break;
				default:
					//no header,no footer (default)
					$('#message').removeClass('hidden');
			}
		}
	},
	doAction: function(object, action, toid, type, extend){
		var action = parseInt(action);
		var toid = parseInt(toid);
		var type = parseInt(type);
		var extend = parseInt(extend);

		if (object instanceof jQuery && action > -1 && action < 6 && type > -1 && type < 5 && toid > 0) {
			var option = object.attr('class').indexOf('-o') > -1 ? 1 : 2;
			$.ajax({
				url: '/action/action',
				type: 'POST',
				data: {option: option, action: action, toid: toid, type: type, extend: extend},
			})
			.done(function(result) {
				result = $.parseJSON(result);
				if (result.status) {
					if (option == 1) {
						$.trim(object.attr('class').replace('-o', ''));
						object.parent('a').next('p').text(parseInt(object.parent('a').next('p').text()) + 1);
					} else {
						$.trim(object.attr('class', object.attr('class') + '-o'));
						object.parent('a').next('p').text(parseInt(object.parent('a').next('p').text()) - 1);
					}
				} else {

				}
			});
		}
	}
});

$(document).ready(function() {
	$('#message i, #message button').click(function(event) {
		$('#message').addClass('hidden');
		$('#message hr').addClass('hidden');
		$('#message .message-header').addClass('hidden');
		$('#message .message-footer').addClass('hidden');
		$('#message .message-footer button').addClass('hidden');
	});

	if(!window.navigator.cookieEnabled){
		$.message('Please enable cookies in the browser.');
		$('#message .fa-close').click(function() {
			if ($('#message').hasClass('hidden')) {
				setTimeout(function(){history.back();}, 500);
			}
		});
	}
});

$("#logo button:first").click(function() {
	window.location.href = '/';
});

$("#logo button:last i:first").click(function() {
	history.back();
});

$("#logo button:last i:last").click(function() {
	window.location.href = 'login';
});

$("#logo").nextAll('.btn-group').children('.btn').click(function() {
	window.location.href = $(this).data('href');
});

// $('.click-forbid').click(function() {
// 	var $$ = $(this);
// 	// // console.log($$.data);
// 	// // $$.attr('data-isclick', false);
// 	// if ($$.data('isclick') === 'true') {
// 	// 	// console.log('haha');
// 	// 	return false;
// 	// }
// 	// $$.data('isclick', 'true');
// 	// // $$.attr('data-isclick', 'true');
// 	// setTimeout(function(){$$.data('isclick', 'false');}, 2000);
// 	clickForbid($$);
// });

// var clickForbid = function($$) {
// 	if (true) {}
// 	console.log($$);
// }