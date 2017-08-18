$(document).ready(function() {
	$.cookie('pictureSort', 'default');
	$.cookie('picturePage', 1);
	$.cookie('pictureMore', true);
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
		$.get('/picture/index?sort=' + sort + '&page=1', function(result) {
			var result = $.parseJSON(result);
			if (result.status == 1) {
				$('.contents').empty();
				$.each(result.result, function(index, value) {
					$('.contents').append('<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><a href="product?type=picture&id=' + value.pictureid + '&title='+ value.title +'" class="thumbnail"><img src="' + value.link + '" alt="' + value.title + '"></a></div>');
				});
				$.cookie('pictureSort', sort);
				$.cookie('picturePage', 1);
				$.cookie('pictureMore', true);
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

	$.get('/picture/index?sort=' + sort + '&page=1', function(result) {
		var result = $.parseJSON(result);
		if (result.status == 1) {
			$('.contents').empty();
			$.each(result.result, function(index, value) {
				$('.contents').append('<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><a href="product?type=picture&id=' + value.pictureid + '&title='+ value.title +'" class="thumbnail"><img src="' + value.link + '" alt="' + value.title + '"></a></div>');
			});
			$.cookie('pictureSort', sort);
			$.cookie('picturePage', 1);
			$.cookie('pictureMore', true);
		}
	});

    setTimeout(function(){$(".breadcrumbs li").attr('disabled', false);}, 3000);
});

$(window).scroll(function() 
{
    if ($(document).scrollTop() >= $(document).height() - $(window).height()) 
    {
    	if ($.cookie('pictureMore')) {
    		var page = $.cookie('picturePage');
    		if (page > 0) {
		    	if (page > 10) {
		    		$('.contents').empty();
		    	}
		    	$.get('/picture/index?sort=' + $.cookie('pictureSort') + '&page=' + (parseInt(page) + 1), function(result) {
					var result = $.parseJSON(result);
					if (result.status == 1) {
						$.each(result.result, function(index, value) {
							$('.contents').append('<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2"><a href="product?type=picture&id=' + value.pictureid + '&title='+ value.title +'" class="thumbnail"><img src="' + value.link + '" alt="' + value.title + '"></a></div>');
						});
						$.cookie('picturePage', parseInt(page) + 1);
					} else {
						$.removeCookie('pictureMore');
					}
				});
    		}
    	}
    }
});

