import select2 from 'select2';
select2();

$("#tradeForm #selectPair select").select2({
    theme: "bootstrap-5",
});

$("#tradeForm #tradingType select").on('change',function(){
    $.get("/get-pairs/PAIR_"+$(this).val())
    .done(function( data ) {
        // console.log(data,JSON.parse(data));
        $("#tradeForm #selectPair select").select2("destroy").html('');
        $("#tradeForm #selectPair select").select2({
            theme: "bootstrap-5",
            data:JSON.parse(data)
        });
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        location.reload();
    });
});

$("#btnClear").on("click",function(){
    document.getElementById("tradeForm").reset();
});

$(function(){
    $('.number-only').on('keypress',function(e){
        if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
    })
    // $('.number-only').keypress(function(e) {
    //   if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
    // })
    .on("cut copy paste",function(e){
    //   e.preventDefault();
   
    });
});
