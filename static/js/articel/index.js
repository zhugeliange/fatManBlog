$(document).ready(function() {
	$.cookie('articelSort', 'default');
	$.cookie('articelPage', 1);
	$.cookie('articelMore', true);
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
		$.get('/articel/index?sort=' + sort + '&page=1', function(result) {
			var result = $.parseJSON(result);
			if (result.status == 1) {
				$('.contents').empty();
				$.each(result.result, function(index, value) {
					if (index == 0) {
						$('.contents').append('<div class="panel panel-default"><div class="panel-heading" role="tab" id="heading'+ value.articelid +'"><h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+ value.articelid +'" aria-expanded="true" aria-controls="collapse'+ value.articelid +'">'+ value.title +'</a></h4><p class="time">'+ value.createtime +'</p></div><div id="collapse'+ value.articelid +'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading'+ value.articelid +'"><div class="panel-body">'+ value.content +'<a href="product?type=articel&id='+ value.articelid +'&title='+ value.title +'"><p class="more">more</p></a></div></div></div>');
					} else {
						$('.contents').append('<div class="panel panel-default"><div class="panel-heading" role="tab" id="heading'+ value.articelid +'"><h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+ value.articelid +'" aria-expanded="false" aria-controls="collapse'+ value.articelid +'">'+ value.title +'</a></h4><p class="time">'+ value.createtime +'</p></div><div id="collapse'+ value.articelid +'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'+ value.articelid +'"><div class="panel-body">'+ value.content +'<a href="product?type=articel&id='+ value.articelid +'&title='+ value.title +'"><p class="more">more</p></a></div></div></div>');
					}
				});
				$.cookie('articelSort', sort);
				$.cookie('articelPage', 1);
				$.cookie('articelMore', true);
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

	$.get('/articel/index?sort=' + sort + '&page=1', function(result) {
		var result = $.parseJSON(result);
		if (result.status == 1) {
			$('.contents').empty();
			$.each(result.result, function(index, value) {
				if (index == 0) {
					$('.contents').append('<div class="panel panel-default"><div class="panel-heading" role="tab" id="heading'+ value.articelid +'"><h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+ value.articelid +'" aria-expanded="true" aria-controls="collapse'+ value.articelid +'">'+ value.title +'</a></h4><p class="time">'+ value.createtime +'</p></div><div id="collapse'+ value.articelid +'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading'+ value.articelid +'"><div class="panel-body">'+ value.content +'<a href="product?type=articel&id='+ value.articelid +'&title='+ value.title +'"><p class="more">more</p></a></div></div></div>');
				} else {
					$('.contents').append('<div class="panel panel-default"><div class="panel-heading" role="tab" id="heading'+ value.articelid +'"><h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+ value.articelid +'" aria-expanded="false" aria-controls="collapse'+ value.articelid +'">'+ value.title +'</a></h4><p class="time">'+ value.createtime +'</p></div><div id="collapse'+ value.articelid +'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'+ value.articelid +'"><div class="panel-body">'+ value.content +'<a href="product?type=articel&id='+ value.articelid +'&title='+ value.title +'"><p class="more">more</p></a></div></div></div>');
				}
			});
			$.cookie('articelSort', sort);
			$.cookie('articelPage', 1);
			$.cookie('articelMore', true);
		}
	});

    setTimeout(function(){$(".breadcrumbs li").attr('disabled', false);}, 3000);
});

$(window).scroll(function() 
{
    if ($(document).scrollTop() >= $(document).height() - $(window).height()) 
    {
    	if ($.cookie('articelMore')) {
    		var page = $.cookie('articelPage');
    		if (page > 0) {
		    	if (page > 10) {
		    		$('.contents').empty();
		    	}
		    	$.get('/articel/index?sort=' + $.cookie('articelSort') + '&page=' + (parseInt(page) + 1), function(result) {
					var result = $.parseJSON(result);
					if (result.status == 1) {
						$.each(result.result, function(index, value) {
							$('.contents').append('<div class="panel panel-default"><div class="panel-heading" role="tab" id="heading'+ value.articelid +'"><h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'+ value.articelid +'" aria-expanded="false" aria-controls="collapse'+ value.articelid +'">'+ value.title +'</a></h4><p class="time">'+ value.createtime +'</p></div><div id="collapse'+ value.articelid +'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'+ value.articelid +'"><div class="panel-body">'+ value.content +'<a href="product?type=articel&id='+ value.articelid +'&title='+ value.title +'"><p class="more">more</p></a></div></div></div>');
						});
						$.cookie('articelPage', parseInt(page) + 1);
					} else {
						$.removeCookie('articelMore');
					}
				});
    		}
    	}
    }
});

