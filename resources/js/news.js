window.newsCatChange = function newsCatChange(obj){
    var val = $(obj).val();
    window.location.replace("/from-menus/news?cat="+val);
}

window.viewNew = function viewNew(id){
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

    $.get("/news/view/"+id)
    .done(function( data ) {
    // console.log(data);
    $("#generalModal .modal-body").html(data);
    }).fail(function(error){
    console.log(error.responseJSON);
    alert(error.responseJSON.message);
    generalModal.dispose();
    });
}

// // Replace 'your-websocket-url' with your actual WebSocket URL
// const websocketUrl = 'wss://ws.finnhub.io?token=cl64qgpr01ql8jiqvhe0cl64qgpr01ql8jiqvheg';

// const socket = new WebSocket(websocketUrl);

// // WebSocket event handlers
// socket.onopen = function (event) {
//     console.log('WebSocket connection opened:', event);
     
//     $.each(JSON.parse($('#allPairs').val()), function( index, value ) {
//         // console.log(index);
//         // Send data to the server after the connection is established
//         const dataToSend = {"type":"subscribe","symbol":index};
//         // Convert the data to a JSON string and send it to the server
//         socket.send(JSON.stringify(dataToSend));
//     });
// };

// socket.onmessage = function (event) {
//     const data = JSON.parse(event.data);
//     const newData = data.data[0];
//     // console.log(newData.s,newData.p);

//     // Get the raw price value
//     var rawPrice = parseFloat(newData.p);

//     var formattedPrice = rawPrice.toLocaleString('en-US');

//     $("#"+newData.s.replace(":","")).text(formattedPrice);
// };

// socket.onclose = function (event) {
//     console.log('WebSocket connection closed:', event);
// };

// socket.onerror = function (error) {
//     console.error('WebSocket error:', error);
// };