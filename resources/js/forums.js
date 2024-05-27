import 'tinymce/tinymce.js';
import 'tinymce/icons/default/icons';
import 'tinymce/themes/silver/theme';
import 'tinymce/models/dom/model';
import 'tinymce/plugins/image';

$(".latestChild").ready(function(){
    
    $(".latestChild").html(generalSpinner());
    $.get("/forums/latest")
    .done(function( data ) {
        // console.log(data);
        $(".latestChild").html(data);
    }).fail(function(error){
        console.log(error.responseJSON);
    });
});

$(".popChild").ready(function(){
    
    $(".popChild").html(generalSpinner());
    $.get("/forums/pop")
    .done(function( data ) {
        // console.log(data);
        $(".popChild").html(data);
    }).fail(function(error){
        console.log(error.responseJSON);
    });
});

window.replyComment = function replyComment(obj,chatId){
    $(".writer_reply").remove();
    $(".replyBtn").show();
    $(obj).hide();
    $(obj).html(generalSpinner());
    $.get("/forums/post-form/"+chatId)
    .done(function( data ) { 
        // console.log(data);
        $(obj).html('');
        $(obj).after(data);
        initEditor('#content_writer_reply');
    }).fail(function(error){
        console.log(error.responseJSON);
    });
}

$('#content_writer').ready(function(){
    initEditor('#content_writer');
})

function initEditor(selector) {
    tinymce.remove(selector);
    tinymce.init({
        selector: selector,
        height:200,
        resize:true,
        plugins: "image",
        content_style: "body{background-color:#212529;color:white;} p { margin: 0; } h1,h2,h3,h4,h5,h6{ margin: 0; }",
        skin: false,
        content_css: false,
    });
}

$(".commentPostBody img").on('click',function(){
    var url = $(this).attr('src');
    // alert(url);
    const generalModal = new bootstrap.Modal('#generalModal',{
        // keyboard: false,
        // backdrop: 'static'
    });
    const myGeneralModal = document.getElementById('generalModal');
    generalModal.show();
    myGeneralModal.addEventListener('hidden.bs.modal', event => {
        $("#generalModal .modal-body").html("");
        generalModal.dispose();
    // location.reload();
    });
    $("#generalModal .modal-body").html("<img width='100%' src='"+url+"' />");
});