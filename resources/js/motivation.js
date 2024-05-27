window.viewVideo = function viewVideo(id){
    const generalModal = new bootstrap.Modal('#generalModal',{
                                            keyboard: false,
                                            backdrop: 'static'
                                        });
    const myGeneralModal = document.getElementById('generalModal');
    generalModal.show();
    myGeneralModal.addEventListener('hidden.bs.modal', event => {
        $("#generalModal .modal-body").html("");
        generalModal.dispose();
        // location.reload();
    });
    $("#generalModal .modal-body").html(generalSpinner());
    
    $.get("/motivation/view/"+id)
    .done(function( data ) {
        // console.log(data);
        $("#generalModal .modal-body").html(data);
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        generalModal.dispose();
    });
}

window.loveOrNot = function loveOrNot(obj,id){
    var currentClass = $(obj).attr('class');
    var totalLike = parseInt($("#totalLike"+id).html());
    if(currentClass.indexOf("-fill") >= 0){
        $(obj).attr('class',currentClass.replace("-fill",""));
        totalLike-=1;
    }else{
        $(obj).attr('class',currentClass+'-fill');
        totalLike+=1;
    }
    $("#totalLike"+id).html(totalLike);
    var toPost = {
        "_token": $('meta[name="csrf-token"]').attr('content'),
        "type":1,
        "type_id":id
    };
    $.post("/like/updateOrAdd", toPost)
    .done(function( data ) {
        // console.log(data);
    }).fail(function(error){
        console.log(error.responseJSON);
    });
}