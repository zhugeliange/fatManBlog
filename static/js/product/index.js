$(document).ready(function() {
	var length = 0;
	var labelIndex = 0;

	$('.product-add-left .label-yige').each(function(index, value) {
		length += $(this).outerWidth(true);
		if ((length + 50) > $('.product-add-left').width()) {
			labelIndex = index;
			return false;
		}
	});

	if (labelIndex > 0) {
		$('.product-add-left .label-yige:gt(' + (labelIndex - 1) + ')').remove();
	}

	$('.comment-adds-center-content').height($(window).height() / 3);
});

// $('.fa-5x').click(function() {
// 	var $$ = $(this);
// 	console.log($$.data('isclick'));
// 	if ($$.data('isclick') === 'false') {
// 		$.get('/product/getProduct?action=' + $(this).data('action') + '&type=' + $.getUrlParam('type') + '&id=' + $.getUrlParam('id'), function(result) {
// 			if (result) {
// 				result = $.parseJSON(result);
// 				if (result.status > 0) {
// 					console.log(result);
// 				} else {
// 					$.message('There is no data!');
// 				}
// 			} else {
// 				$.message('There is no data!');
// 			}
// 		});
// 	}
// });

$(".content-center img[herf!='']").click(function() {
	if ($(this).data('userid')) {
		location.href = '/user?id=' + parseInt($(this).data('userid'));
	}
});

var typeRule = {'articel' : 1, 'picture' : 2, 'music' : 3, 'video' : 4};

$('.action').click(function() {
	var object = $(this);
	var action = $(this).data('action');
	var toid = $.getUrlParam('id');
	var type = typeRule[$.getUrlParam('type')];
	var extend = $(this).data('extend'); 

	if (action == 0) {
		// TODO 
		// comment popoup
		extend = $.trim($('.comment').text());
	} else if (action == 3) {
		// TODO 
		// share popoup
		extend = parseInt($('.share').data('action'));
	} else {
		$.doAction(object, action, toid, type, extend);
	}
	// TODO realt
});
