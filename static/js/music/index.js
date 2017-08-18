$(document).ready(function() {
	$.cookie('musicSort', 'default');
	$.cookie('musicPage', 1);
	$.cookie('musicMore', true);
	$(".content-title .btn-yige").nextAll('.btn-default').toggle();
});

$(".content-title .btn").click(function() {
	$$ = $(this);
	$$.parent('.btn-group-vertical').find(".btn-default").toggle();
	if ($$.hasClass('btn-default')) {
		$$$ = $$.siblings('.btn-yige');
		$$$.html($$.html());
		$$$.data('sort', $$.data('sort'));
		var sort = $$$.data('sort');
		$.get('/music/index?sort=' + sort + '&page=1', function(result) {
			var result = $.parseJSON(result);
			if (result.status == 1) {
				$('.contents').empty();
				$.each(result.result, function(index, value) {
					$('.contents').append('<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><div class="thumbnail"><a href="#"><img src="' + value.coverlink + '" alt="' + value.title + '"><i class="fa fa-5x fa-play"></i></a><div class="caption"><h5>' + value.title + '<i class="fa fa-bullseye" data-herf="' + value.musicid + '"></i></h5><p></p></div></div></div>');
				});
				$.cookie('musicSort', sort);
				$.cookie('musicPage', 1);
				$.cookie('musicMore', true);
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

	$.get('/music/index?sort=' + sort + '&page=1', function(result) {
		var result = $.parseJSON(result);
		if (result.status == 1) {
			$('.contents').empty();
			$.each(result.result, function(index, value) {
				$('.contents').append('<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><div class="thumbnail"><a href="#"><img src="' + value.coverlink + '" alt="' + value.title + '"><i class="fa fa-5x fa-play"></i></a><div class="caption"><h5>' + value.title + '<i class="fa fa-bullseye" data-herf="' + value.musicid + '"></i></h5><p></p></div></div></div>');
			});
			$.cookie('musicSort', sort);
			$.cookie('musicPage', 1);
			$.cookie('musicMore', true);
		}
	});

    setTimeout(function(){$(".breadcrumbs li").attr('disabled', false);}, 3000);
});

$(window).scroll(function() 
{
    if ($(document).scrollTop() >= $(document).height() - $(window).height()) 
    {
    	if ($.cookie('musicMore')) {
    		var page = $.cookie('musicPage');
    		if (page > 0) {
		    	if (page > 10) {
		    		$('.contents').empty();
		    	}
		    	$.get('/music/index?sort=' + $.cookie('musicSort') + '&page=' + (parseInt(page) + 1), function(result) {
					var result = $.parseJSON(result);
					if (result.status == 1) {
						$.each(result.result, function(index, value) {
							$('.contents').append('<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><div class="thumbnail"><a href="#"><img src="' + value.coverlink + '" alt="' + value.title + '"><i class="fa fa-5x fa-play"></i></a><div class="caption"><h5>' + value.title + '<i class="fa fa-bullseye" data-herf="' + value.musicid + '"></i></h5><p></p></div></div></div>');
						});
						$.cookie('musicPage', parseInt(page) + 1);
					} else {
						$.removeCookie('musicMore');
					}
				});
    		}
    	}
    }
});

$('.thumbnail .fa-bullseye').click(function() {
	window.location.href = 'product?type=music&id=' + $(this).data('herf') + '&title='+ $(this).parent('h5').text();
});