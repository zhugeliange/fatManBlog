$(document).ready(function() {
	$('.background-image').height($( window ).height() / 2);
	$('.user-head').css('margin-top', '-' + $('.user-head').height() / 2 + 'px');
	$('.image-add').css('margin-top', '-' + $('.image-add').height() + 'px');
	$('.image-add .image-add-left').height($('.image-add').height());
	$('.user-heads img').css('margin-top', '-' + $('.user-heads img').height() / 2 + 'px');
	$('.image-adds').css('margin-top', '-' + $('.image-adds').height() + 'px');
	$('.image-adds .image-adds-left').height($('.image-adds').height());
});