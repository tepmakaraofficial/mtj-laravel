import Chart from 'chart.js/auto';
window.Chart = Chart;

import select2 from 'select2';


var search = location.search;
//Start PNL
$(".pnlContainer").ready(function(){
    $(".pnlContainer .dataContainer").html(generalSpinner());
    $.get("/dashboard/pnl"+search)
    .done(function( data ) {
        $(".pnlContainer").html(data);
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        // location.reload();
    });
});
//End PNL
//Start Account
$(".accountContainer").ready(function(){
    $(".accountContainer .dataContainer").html(generalSpinner());
    $.get("/dashboard/active-accounts"+search)
    .done(function( data ) {
        $(".accountContainer").html(data);
        select2();
        $(".accountContainer select").select2({
            theme: "bootstrap-5",
        });
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        // location.reload();
    });
});
//End Account
//Start Weekly PNL
$(".weeklyPnlContainer").ready(function(){
    $(".weeklyPnlContainer .dataContainer").html(generalSpinner());
    $.get("/dashboard/weekly-pnl"+search)
    .done(function( data ) {
        $(".weeklyPnlContainer").html(data);
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        // location.reload();
    });
});
//End Weekly PNL
//Start Weekly PNL
$(".monthylPnlContainer").ready(function(){
    $(".monthylPnlContainer .dataContainer").html(generalSpinner());
    $.get("/dashboard/monthly-pnl"+search)
    .done(function( data ) {
        $(".monthylPnlContainer").html(data);
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        // location.reload();
    });
});
//End Weekly PNL
//Start Execution
$(".executionContainer").ready(function(){
    $(".executionContainer .dataContainer").html(generalSpinner());
    $.get("/dashboard/execution"+search)
    .done(function( data ) {
        $(".executionContainer").html(data);
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        // location.reload();
    });
});
//End Execution
//Start Top Order
$(".topOrdersContainer").ready(function(){
    $(".topOrdersContainer .dataContainer").html(generalSpinner());
    $.get("/dashboard/top-orders"+search)
    .done(function( data ) {
        $(".topOrdersContainer").html(data);
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        // location.reload();
    });
});
//End Top Order
//Start Open Close
$(".openCloseContainer").ready(function(){
    $(".openCloseContainer .dataContainer").html(generalSpinner());
    $.get("/dashboard/openClose"+search)
    .done(function( data ) {
        $(".openCloseContainer").html(data);
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        // location.reload();
    });
});
//End Open Close
//Start win loss
$(".monthylWinLossContainer").ready(function(){
    $(".monthylWinLossContainer .dataContainer").html(generalSpinner());
    $.get("/dashboard/montlyWinLoss"+search)
    .done(function( data ) {
        $(".monthylWinLossContainer").html(data);
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        // location.reload();
    });
});
//End win loss

window.dashboardAccountChange = function dashboardAccountChange(obj){
    var val = $(obj).val();
    window.location.replace("/?account="+val);
}
