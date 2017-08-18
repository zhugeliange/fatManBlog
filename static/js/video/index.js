$(document).ready(function() {
	$.cookie('videoSort', 'default');
	$.cookie('videoPage', 1);
	$.cookie('videoMore', true);
	$(".content-title .btn-yige").nextAll('.btn-default').toggle();
	videoCover();
});

var videoCover = function(from){
	var object = from ? $('video:gt(' + from + ')') : $('video');
	object.each(function() {
		$(this).css({
			'background': 'transparent url(' + $(this).data('style') + ') no-repeat 0 0',
			'background-size': 'cover'
		});
	});
} 

$(".content-title .btn").click(function() {
	$$ = $(this);
	$$.parent('.btn-group-vertical').find(".btn-default").toggle();
	if ($$.hasClass('btn-default')) {
		$$$ = $$.siblings('.btn-yige');
		$$$.html($$.html());
		$$$.data('sort', $$.data('sort'));
		var sort = $$$.data('sort');
		$.get('/video/index?sort=' + sort + '&page=1', function(result) {
			var result = $.parseJSON(result);
			if (result.status == 1) {
				$('.contents').empty();
				$.each(result.result, function(index, value) {
					$('.contents').append('<div class="metros col-xs-12 col-sm-6 col-md-4 col-lg-3"><div class="metro col-xs-12 col-sm-12 col-md-12 col-lg-12"><video src="' + value.link + '" controls="controls" poster="data:image/gif;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQImWNgYGBgAAAABQABh6FO1AAAAABJRU5ErkJggg==" data-style="' + value.coverlink + '"></video><h5>' + value.title + '<i class="fa fa-bullseye" data-herf="' + value.videoid + '"></i></h5></div></div>');
				});
				videoCover();
				$.cookie('videoSort', sort);
				$.cookie('videoPage', 1);
				$.cookie('videoMore', true);
			}
		});
	}
});

$(".breadcrumbs li").click(function() {
    $(".breadcrumbs li").attr('disabled', true);
    $$ = $(this);

	$$.addClass('active');
	if ($$.children('i').hasClass('fa-long-arrow-up')) {
		$$.children('i').attr('class', 'fa fa-long-arrow-down');
		$$.data('sort', $$.data('sort').substr(1));
	} else if ($$.children('i').hasClass('fa-long-arrow-down')) {
		$$.children('i').attr('class', 'fa fa-long-arrow-up');
		$$.data('sort', '!' + $$.data('sort'));
	}
	$$.siblings('li').removeClass('active');
	var sort = $$.data('sort');

	$.get('/video/index?sort=' + sort + '&page=1', function(result) {
		var result = $.parseJSON(result);
		if (result.status == 1) {
			$('.contents').empty();
			$.each(result.result, function(index, value) {
				$('.contents').append('<div class="metros col-xs-12 col-sm-6 col-md-4 col-lg-3"><div class="metro col-xs-12 col-sm-12 col-md-12 col-lg-12"><video src="' + value.link + '" controls="controls" poster="data:image/gif;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQImWNgYGBgAAAABQABh6FO1AAAAABJRU5ErkJggg==" data-style="' + value.coverlink + '"></video><h5>' + value.title + '<i class="fa fa-bullseye" data-herf="' + value.videoid + '"></i></h5></div></div>');
			});
			videoCover();
			$.cookie('videoSort', sort);
			$.cookie('videoPage', 1);
			$.cookie('videoMore', true);
		}
	});

    setTimeout(function(){$(".breadcrumbs li").attr('disabled', false);}, 3000);
});

$(window).scroll(function() 
{
    if ($(document).scrollTop() >= $(document).height() - $(window).height()) 
    {
    	if ($.cookie('videoMore')) {
    		var page = $.cookie('videoPage');
    		if (page > 0) {
		    	if (page > 10) {
		    		$('.contents').empty();
		    	}
		    	$.get('/video/index?sort=' + $.cookie('videoSort') + '&page=' + (parseInt(page) + 1), function(result) {
					var result = $.parseJSON(result);
					if (result.status == 1) {
						$.each(result.result, function(index, value) {
							$('.contents').append('<div class="metros col-xs-12 col-sm-6 col-md-4 col-lg-3"><div class="metro col-xs-12 col-sm-12 col-md-12 col-lg-12"><video src="' + value.link + '" controls="controls" poster="data:image/gif;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQImWNgYGBgAAAABQABh6FO1AAAAABJRU5ErkJggg==" data-style="' + value.coverlink + '"></video><h5>' + value.title + '<i class="fa fa-bullseye" data-herf="' + value.videoid + '"></i></h5></div></div>');
						});
						videoCover($('.contents .metros').length - 2);
						$.cookie('videoPage', parseInt(page) + 1);
					} else {
						$.removeCookie('videoMore');
					}
				});
    		}
    	}
    }
});

$('.contents .fa-bullseye').click(function() {
	window.location.href = 'product?type=video&id=' + $(this).data('herf') + '&title=' + $(this).parent('h5').text();
});