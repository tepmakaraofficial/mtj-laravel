window.tradeDetail = function tradeDetail(tradeId){
    const generalModal = new bootstrap.Modal('#generalModal',{
                                            keyboard: false,
                                            backdrop: 'static'
                                        });
    $("#generalModal .modal-body").html(generalSpinner());
    generalModal.show();
    const myGeneralModal = document.getElementById('generalModal');
    myGeneralModal.addEventListener('hidden.bs.modal', event => {
        generalModal.dispose();
        location.reload();
    });
    $.get("/trade/"+tradeId+'?is_modal=true')
    .done(function( data ) {
        // console.log(data);
        $("#generalModal .modal-body").html(data);
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        generalModal.hide();
    });
}
window.tradeEdit = function tradeEdit(tradeId){
    const generalModal = new bootstrap.Modal('#generalModal',{
                                            keyboard: false,
                                            backdrop: 'static'
                                        });
    const myGeneralModal = document.getElementById('generalModal');
    generalModal.show();
    myGeneralModal.addEventListener('hidden.bs.modal', event => {
        generalModal.dispose();
        location.reload();
    });
    $("#generalModal .modal-body").html(generalSpinner());
    
    $.get("/trade/edit/"+tradeId+'?is_modal=true')
    .done(function( data ) {
        // console.log(data);
        $("#generalModal .modal-body").html(data);
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        generalModal.dispose();
    });
}
window.tradeSave = function tradeSave(btnObj,tradeId){
    var toPost = {"_token": $('meta[name="csrf-token"]').attr('content')};
    $(btnObj).html(generalSpinner());
    $(".tradeEdit form :input").each(function(){
        var input = $(this); 
        // console.log(input.attr('name'));
        var getKey = input.attr('name');
        toPost[getKey] = input.val();
    });
    $.post("/trade/save/"+tradeId, toPost)
    .done(function( data ) {
        // console.log(data);
        tradeDetail(tradeId);
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        $(btnObj).html("Save");
    });
}