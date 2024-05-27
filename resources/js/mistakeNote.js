import 'tinymce/tinymce.js';
import 'tinymce/icons/default/icons';
import 'tinymce/themes/silver/theme';
import 'tinymce/models/dom/model';
import 'tinymce/plugins/image';



tinymce.init({
    selector: '#desc',
    toolbar: 'undo redo spellcheckdialog formatpainter | blocks fontfamily fontsize | bold italic underline forecolor backcolor | link image | alignleft aligncenter alignright alignjustify lineheight | checklist bullist numlist indent outdent | removeformat',
    content_style: "body{background-color:#212529;color:white;} p { margin: 0; } h1,h2,h3,h4,h5,h6{ margin: 0; }",
    plugins: "image",
    skin: false,
    content_css: false
    
});

window.clickPin=function clickPin(id,obj){
    var color = $(obj).css('color');
    var pin = color != 'rgb(255, 0, 0)';
    if(pin){
        $(obj).css('color','red');
    }else{
        $(obj).css('color','green');
    }
    $.post("/trade/mistake-notes-action/"+id, {"_token": $('meta[name="csrf-token"]').attr('content'), action:pin?1:3})
            .done(function( data ) {
                console.log(data);
            });
}

$(".notePostBody img").on('click',function(){
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