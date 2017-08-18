$(document).ready(function() 
{	
    $(".simplemde").each(function(){
        var $$ = $(this)[0];
        if (!$(this).hasClass('js-mark-down')) {
            window.simplemde = new SimpleMDE({
                element: $$,
                spellChecker: false,
                forceSync: true,
            });
            $(this).addClass('js-mark-down');
        }
    });

    $('#articel .editor-toolbar a:gt(8), #picture .editor-toolbar a:gt(8), #music .editor-toolbar a:gt(8), #video .editor-toolbar a:gt(8)').hide();
    $('#articel .editor-toolbar i:last, #picture .editor-toolbar i:last, #music .editor-toolbar i:last, #video .editor-toolbar i:last').hide();
});

$("[role='presentation']").click(function() {
    $.formClear($(this).children('a').attr('href'), true);
});

$("#file-picture, #file-music, #file-video").fileinput({
    browseClass: "btn btn-yige",
    allowedFileExtensions : ['jpg', 'png'],
    uploadUrl: "../../image/",
    maxFileCount: 50,
    minFileCount: 1,
    maxFileSize: 1000,
    minFileSize: 1,
    showCaption: true,
    showPreview: true,
    showRemove: false,
    showUpload: false,
    showCancel: true,
    showClose: true,
    showUploadedThumbs: true,
    showBrowse: true,
    browseOnZoneClick: false,
    autoReplace: true,
}).on('filepreupload', function() {
    $('#kv-success-box').html('');
}).on('fileuploaded', function(event, data) {
    $('#kv-success-box').append(data.response.link);
    $('#kv-success-modal').modal('show');
});

$("[name='title']").keyup(function() {
    $.judgeRegular($(this), /^[\u4E00-\u9FA5A-Za-z0-9\,\_\.\-\@\(\)\*]{1,50}$/, 'illegal characters, and the length of 1 to 50 characters!');
});

$("[name='tag']").keyup(function() {
    $.judgeRegular($(this), /^([\u4E00-\u9FA5A-Za-z0-9\*]{1,50}\,){0,4}[\u4E00-\u9FA5A-Za-z0-9\*]{1,50}$/, 'illegal characters, each tag with a comma, the length of 1 to 50 characters and total number of tags not more than 5!');
});

$("[type='reset']").click(function() {
    $.formClear('#' + $(this).data('type'));
});

// -----------------------------articel----------------------------------

$("#articel .submit").click(function() {
    if(!$.judgeRegular($("#articel [name='title']"), /^[\u4E00-\u9FA5A-Za-z0-9\,\_\.\-\@\(\)\*]{1,50}$/, 'illegal characters, and the length of 1 to 50 characters!') 
        || !$.judgeRegular($("#articel [name='tag']"), /^([\u4E00-\u9FA5A-Za-z0-9\*]{1,50}\,){0,4}[\u4E00-\u9FA5A-Za-z0-9\*]{1,50}$/, 'illegal characters, each tag with a comma, the length of 1 to 50 characters and total number of tags not more than 5!')) {
        return false;
    }

    if (!$("#articel [name='content']").val()) {
        $.message('contents is not null!');
        return false;
    }

    $('#articel button').attr('disabled', true);
    $.post('/upload/upload', $('#articel form').serialize(), function(result) {
        $('input').parent().removeClass('has-error has-feedback has-success');
        $('input').nextAll('.alert, span:not(.input-group-btn)').remove();
        result = $.parseJSON(result);
        if (result.status == -1) {
            location.href = '/login?refer='+result.url;
        } else if (result.status == 2) {
            $.inputErrorMessage($("#articel [name='title']"), "illegal characters, and the length of 1 to 50 characters!");
        } else if (result.status == 3) {
            $.inputErrorMessage($("#articel [name='tag']"), "illegal characters, each tag with a comma, the length of 1 to 50 characters and total number of tags not more than 5!");
        } else if (result.status == 4) {
            $.message('illegal contents!');
        } else if (result.status == 5) {
            $.message('insert articel error!');
        } else if (result.status == 6) {
            $.message('insert tag error!');
        } else if (result.status == 1) {
            location.href = '/';
        } else {
            $.message('add articel error!');
        }
    });
    setTimeout(function(){$('#articel button').attr('disabled', false);}, 3000);
});

// -----------------------------picture----------------------------------

$("#picture .submit").click(function() {
    if(!$.judgeRegular($("#picture [name='title']"), /^[\u4E00-\u9FA5A-Za-z0-9\,\_\.\-\@\(\)\*]{1,50}$/, 'illegal characters, and the length of 1 to 50 characters!') 
        || !$.judgeRegular($("#picture [name='tag']"), /^([\u4E00-\u9FA5A-Za-z0-9\*]{1,50}\,){0,4}[\u4E00-\u9FA5A-Za-z0-9\*]{1,50}$/, 'illegal characters, each tag with a comma, the length of 1 to 50 characters and total number of tags not more than 5!')) {
        return false;
    }

    if (!$("#picture [name='file[]']").val()) {
        $.message('please select a picture!');
        return false;
    }

    if (!$("#picture [name='introduce']").val()) {
        $.message('introduce is not null!');
        return false;
    }

    $('#picture button').attr('disabled', true);
    $.ajax({
        url: '/upload/upload',
        type: 'POST',
        enctype: 'multipart/form-data',
        cache: false,
        data: new FormData($("#picture form")[0]),
        processData: false,
        contentType: false
    })
    .done(function(result) {
        $('input').parent().removeClass('has-error has-feedback has-success');
        $('input').nextAll('.alert, span').remove();
        result = $.parseJSON(result);
        if (result.status == -1) {
            location.href = '/login?refer='+result.url;
        } else if (result.status == 2) {
            $.inputErrorMessage($("#picture [name='title']"), "illegal characters, and the length of 1 to 50 characters!");
        } else if (result.status == 3) {
            $.inputErrorMessage($("#picture [name='tag']"), "illegal characters, each tag with a comma, the length of 1 to 50 characters and total number of tags not more than 5!");
        } else if (result.status == 4) {
            $.message('illegal introduce!');
        } else if (result.status == 5) {
            $.message('upload error!');
        } else if (result.status == 6) {
            $.message('insert picture error!');
        } else if (result.status == 7) {
            $.message('insert tag error!');
        } else if (result.status == 8) {
            $.message('illegal picture!');
        } else if (result.status == 1) {
            location.href = '/';
        } else {
            $.message('add picture error!');
        }
    })
    .fail(function() {
        $.message('add picture error!');
    });
    setTimeout(function(){$('#picture button').attr('disabled', false);}, 3000);
});

// -----------------------------music----------------------------------

$("#music [name='author']").keyup(function() {
    $.judgeRegular($(this), /^[\u4E00-\u9FA5A-Za-z0-9\*\s\-]{1,50}$/, 'illegal characters, and the length of 1 to 50 characters!');
});

$("#music [name='onlinetime']").keyup(function() {
    $.judgeRegular($(this), /^((?:19|20)\d\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/, 'illegal time format!');
});

$("#music [name='link']").keyup(function() {
    $.judgeRegular($(this), /^[a-zA-z]+:\/\/[^\s]*/, 'illegal link format!', false, $(this).parent('.input-group'));
});

$("#music .submit").click(function() {
    if(!$.judgeRegular($("#music [name='title']"), /^[\u4E00-\u9FA5A-Za-z0-9\,\_\.\-\@\(\)\*]{1,50}$/, 'illegal characters, and the length of 1 to 50 characters!') 
        || !$.judgeRegular($("#music [name='tag']"), /^([\u4E00-\u9FA5A-Za-z0-9\*]{1,50}\,){0,4}[\u4E00-\u9FA5A-Za-z0-9\*]{1,50}$/, 'illegal characters, each tag with a comma, the length of 1 to 50 characters and total number of tags not more than 5!') 
        || !$.judgeRegular($("#music [name='author']"), /^[\u4E00-\u9FA5A-Za-z0-9\*\s\-]{1,50}$/, 'illegal characters, and the length of 1 to 50 characters!')
        || !$.judgeRegular($("#music [name='onlinetime']"), /^((?:19|20)\d\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/, 'illegal time format!')
        || !$.judgeRegular($("#music [name='link']"), /^[a-zA-z]+:\/\/[^\s]*/, 'illegal link format!', false, $("#music [name='link']").parent('.input-group'))) {
        return false;
    }

    if (!$("#music [name='link']").val()) {
        $.message('music url is not null!');
        return false;
    }

    if (!$("#music [name='file[]']").val()) {
        $.message('please select a cover picture!');
        return false;
    }

    if (!$("#music [name='introduce']").val()) {
        $.message('introduce is not null!');
        return false;
    }

    $('#music button').attr('disabled', true);
    $.ajax({
        url: '/upload/upload',
        type: 'POST',
        enctype: 'multipart/form-data',
        cache: false,
        data: new FormData($("#music form")[0]),
        processData: false,
        contentType: false
    })
    .done(function(result) {
        $('input').parent().removeClass('has-error has-feedback has-success');
        $('input').nextAll('.alert, span:not(.input-group-btn)').remove();
        result = $.parseJSON(result);
        if (result.status == -1) {
            location.href = '/login?refer='+result.url;
        } else if (result.status == 2) {
            $.inputErrorMessage($("#music [name='title']"), "illegal characters, and the length of 1 to 50 characters!");
        } else if (result.status == 3) {
            $.inputErrorMessage($("#music [name='tag']"), "illegal characters, each tag with a comma, the length of 1 to 50 characters and total number of tags not more than 5!");
        } else if (result.status == 4) {
            $.message('illegal introduce!');
        } else if (result.status == 5) {
            $.inputErrorMessage($("#music [name='author']"), "illegal characters, and the length of 1 to 50 characters!");
        } else if (result.status == 6) {
            $.inputErrorMessage($("#music [name='onlinetime']"), "illegal characters, and the length of 1 to 50 characters!");
        } else if (result.status == 7) {
            $.inputErrorMessage($("#music [name='link']").parent('.input-group'), "illegal link format!");
        } else if (result.status == 8) {
            $.inputErrorMessage($("#music [name='link']").parent('.input-group'), "invalid Link!");
        } else if (result.status == 9) {
            $.message('illegal cover picture!');
        } else if (result.status == 10) {
            $.message('upload error!');
        } else if (result.status == 11) {
             $.message('insert music error!');
        } else if (result.status == 12) {
            $.message('insert tag error!');
        } else if (result.status == 13) {
            $.message('upload error!');
        } else if (result.status == 14) {
            $.inputErrorMessage($("#music [name='link']").parent('.input-group'), "illegal url!");
        } else if (result.status == 15) {
            $.inputErrorMessage($("#music [name='link']").parent('.input-group'), "illegal music type url!");
        } else if (result.status == 16) {
            $.inputErrorMessage($("#music [name='link']").parent('.input-group'), "this music file must small than 50M!");
        } else if (result.status == 1) {
            location.href = '/';
        } else {
            $.message('add music error!');
        }
    })
    .fail(function() {
        $.message('add music error!');
    });
    setTimeout(function(){$('#music button').attr('disabled', false);}, 3000);
});

// -----------------------------video----------------------------------

$("#video [name='director']").keyup(function() {
    $.judgeRegular($(this), /^([\u4E00-\u9FA5A-Za-z0-9\*\-]{1,20}\/){0,4}[\u4E00-\u9FA5A-Za-z0-9\*\-]{1,20}$/, 'illegal characters, divided by `/`, the numbers of part is less than 5 and the length of every part is from 1 to 20 characters!');
});

$("#video [name='actor']").keyup(function() {
    $.judgeRegular($(this), /^([\u4E00-\u9FA5A-Za-z0-9\*\-]{1,20}\/){0,9}[\u4E00-\u9FA5A-Za-z0-9\*\-]{1,20}$/, 'illegal characters, divided by `/`, the numbers of part is less than 10 and the length of every part is from 1 to 20 characters!');
});

$("#video [name='language']").change(function() {
    $.judgeRegular($(this), /^[A-Z]{2}$/, 'please select correct language!');
});

$("#video [name='onlinetime']").keyup(function() {
    $.judgeRegular($(this), /^((?:19|20)\d\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/, 'illegal time format!');
});

$("#video [name='types']").change(function() {
    $.judgeRegular($(this), /^[a-z]+$/, 'please select correct type!');
});

$("#video [name='link']").keyup(function() {
    $.judgeRegular($(this), /^[a-zA-z]+:\/\/[^\s]*/, 'illegal link format!', false, $(this).parent('.input-group'));
});

$("#video .submit").click(function() {
    if(!$.judgeRegular($("#video [name='title']"), /^[\u4E00-\u9FA5A-Za-z0-9\,\_\.\-\@\(\)\*]{1,50}$/, 'illegal characters, and the length of 1 to 50 characters!') 
        || !$.judgeRegular($("#video [name='tag']"), /^([\u4E00-\u9FA5A-Za-z0-9\*]{1,50}\,){0,4}[\u4E00-\u9FA5A-Za-z0-9\*]{1,50}$/, 'illegal characters, each tag with a comma, the length of 1 to 50 characters and total number of tags not more than 5!') 
        || !$.judgeRegular($("#video [name='director']"), /^([\u4E00-\u9FA5A-Za-z0-9\*\-]{1,20}\/){0,4}[\u4E00-\u9FA5A-Za-z0-9\*\-]{1,20}$/, 'illegal characters, divided by `/`, the numbers of part is less than 5 and the length of every part is from 1 to 20 characters!')
        || !$.judgeRegular($("#video [name='actor']"), /^([\u4E00-\u9FA5A-Za-z0-9\*\-]{1,20}\/){0,9}[\u4E00-\u9FA5A-Za-z0-9\*\-]{1,20}$/, 'illegal characters, divided by `/`, the numbers of part is less than 10 and the length of every part is from 1 to 20 characters!')
        || !$.judgeRegular($("#video [name='language']"), /^[A-Z]{2}$/, 'please select correct language!')
        || !$.judgeRegular($("#video [name='onlinetime']"), /^((?:19|20)\d\d)-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/, 'illegal time format!')
        || !$.judgeRegular($("#video [name='types']"), /^[a-z]+$/, 'please select correct type!')
        || !$.judgeRegular($("#video [name='link']"), /^[a-zA-z]+:\/\/[^\s]*/, 'illegal link format!', false, $("#video [name='link']").parent('.input-group'))) {
        return false;
    }

    if (!$("#video [name='link']").val()) {
        $.message('video url is not null!');
        return false;
    }

    if (!$("#video [name='file[]']").val()) {
        $.message('please select a cover picture!');
        return false;
    }

    if (!$("#video [name='introduce']").val()) {
        $.message('introduce is not null!');
        return false;
    }

    $('#video button').attr('disabled', true);
    $.ajax({
        url: '/upload/upload',
        type: 'POST',
        enctype: 'multipart/form-data',
        cache: false,
        data: new FormData($("#video form")[0]),
        processData: false,
        contentType: false
    })
    .done(function(result) {
        $('input').parent().removeClass('has-error has-feedback has-success');
        $('input').nextAll('.alert, span:not(.input-group-btn)').remove();
        result = $.parseJSON(result);
        if (result.status == -1) {
            location.href = '/login?refer='+result.url;
        } else if (result.status == 2) {
            $.inputErrorMessage($("#video [name='title']"), "illegal characters, and the length of 1 to 50 characters!");
        } else if (result.status == 3) {
            $.inputErrorMessage($("#video [name='tag']"), "illegal characters, each tag with a comma, the length of 1 to 50 characters and total number of tags not more than 5!");
        } else if (result.status == 4) {
            $.inputErrorMessage($("#video [name='director']"), 'illegal characters, divided by `/`, the numbers of part is less than 5 and the length of every part is from 1 to 20 characters!');
        } else if (result.status == 5) {
            $.inputErrorMessage($("#video [name='actor']"), "illegal characters, divided by `/`, the numbers of part is less than 10 and the length of every part is from 1 to 20 characters!");
        } else if (result.status == 6) {
            $.inputErrorMessage($("#video [name='language']"), "please select correct language!");
        } else if (result.status == 7) {
            $.inputErrorMessage($("#video [name='time']"), "illegal time format!");
        } else if (result.status == 8) {
            $.inputErrorMessage($("#video [name='types']"), "please select correct type!");
        } else if (result.status == 9) {
            $.inputErrorMessage($("#video [name='link']").parent('.input-group'), "illegal link format!");
        } else if (result.status == 10) {
            $.message('illegal introduce!');
        } else if (result.status == 11) {
            $.message('illegal cover picture!');
        } else if (result.status == 12) {
            $.inputErrorMessage($("#video [name='link']").parent('.input-group'), "invalid Link!");
        } else if (result.status == 13) {
            $.inputErrorMessage($("#video [name='link']").parent('.input-group'), "illegal url!");
            $.message('upload error!');
        } else if (result.status == 14) {
            $.inputErrorMessage($("#video [name='link']").parent('.input-group'), "illegal music type url!");
        } else if (result.status == 15) {
            $.inputErrorMessage($("#video [name='link']").parent('.input-group'), "this video file must small than 1G!");
        } else if (result.status == 16) {
            $.message('upload error!');
        } else if (result.status == 17) {
            $.message('insert video error!');
        } else if (result.status == 18) {
            $.message('insert tag error!');
        } else if (result.status == 19) {
            $.message('upload error!');
        } else if (result.status == 1) {
            location.href = '/';
        } else {
            $.message('add video error!');
        }
    })
    .fail(function() {
        $.message('add video error!');
    });
    setTimeout(function(){$('#video button').attr('disabled', false);}, 3000);
});

function checkLink(type) {
    $('#' + type + " .link").removeClass('has-error has-feedback has-success');
    $('#' + type + " .link span:not(.input-group-btn), #" + type + " .link .alert").remove();
    // $.ajax({
    //     type: 'GET', 
    //     async: false, 
    //     url: $("#music [name='link']").val(),
    //     dataType: 'JSONP',
    //     jsonp: "callback",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(一般默认为:callback)  
    //     jsonpCallback: "?",//自定义的jsonp回调函数名称，默认为jQuery自动生成的随机函数名，也可以写"?"，jQuery会自动为你处理数据  
    //     success: function(result){
    //         result = $.parseJSON(result);
    //         if (result.status != 200) {
    //             $.inputErrorMessage($("#music [name='link']").parent('.input-group'), "illegal url!");
    //         }
    //     },
    //     error: function(){
    //         $.inputErrorMessage($("#music [name='link']").parent('.input-group'), "illegal url!");
    //     }
    // });
    
    if (!$('#' + type + " [name='link']").val()) {
        $.inputErrorMessage($('#' + type + " [name='link']").parent('.input-group'), "illegal url!");
        return false;
    }

    if (!$.judgeRegular($('#' + type + " [name='link']"), /^[a-zA-z]+:\/\/[^\s]*/, 'illegal link format!', false, $('#' + type + " [name='link']").parent('.input-group'))) {
        return false;
    }
    
    $('#' + type + ' button').attr('disabled', true);
    $.post('/upload/checkLink', {'link': $('#' + type + " [name='link']").val(), 'type': type}, function(result) {
        result = $.parseJSON(result);
        if (result.status == 1) {
            $.inputSuccessMessage($('#' + type + " [name='link']").parent('.input-group'));
        } else {
            $.inputErrorMessage($('#' + type + " [name='link']").parent('.input-group'), result.message);
        }
    });
    setTimeout(function(){$('#' + type + ' button').attr('disabled', false);}, 3000);
}