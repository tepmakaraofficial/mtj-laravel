var processing = false;
function getSavebtn(key,name){
    return '<i onclick="save'+name+'('+key+')" class="fa fa-check-circle save'+name+'" aria-hidden="true" style="color: #3ca876;font-size:20px;"></i>';
}
function getDeleteBtn(key, name){
    return '<i class="fa fa-trash" onclick="delete'+name+'('+key+')" aria-hidden="true" style="color: red;font-size:15px;"></i>';
}
$('.platformSortable').sortable({ 
    stop: function( event, ui ) {
        var buildSortPlatform = [];
        $('.platformSortable li').each(function(i,item){
            buildSortPlatform.push($(item).attr('sort-position-id'));
        });
        // console.log(buildSortPlatform);
        if(buildSortPlatform.length>0){
            $.post("/sort-setting", {"_token": $('meta[name="csrf-token"]').attr('content'), key: "PLATFORM", value: buildSortPlatform})
            .done(function( data ) {
                console.log(data);
            });
        }
        // console.log(buildSortItem);
    }
});

$('.strategySortable').sortable({ 
    stop: function( event, ui ) {
        var buildSortStrategy = [];
        $('.strategySortable li').each(function(i,item){
            buildSortStrategy.push($(item).attr('sort-position-id'));
        });
        // console.log(buildSortStrategy);
        if(buildSortStrategy.length>0){
            $.post("/sort-setting", {"_token": $('meta[name="csrf-token"]').attr('content'), key: "STRATEGY", value: buildSortStrategy})
            .done(function( data ) {
                console.log(data);
            });
        }
        // console.log(buildSortItem);
    }
});

var allPairType = ["Forex","Crypto","Stock"];
allPairType.forEach(pairType => {
    $('.'+pairType+' .pairSortable').sortable({ 
        stop: function( event, ui ) {
            var buildSortPair = [];
            $('.'+pairType+' .pairSortable li').each(function(i,item){
                buildSortPair.push($(item).attr('sort-position-id'));
            });
            // console.log(buildSortPair);
            if(buildSortPair.length>0){
                $.post("/sort-setting", {"_token": $('meta[name="csrf-token"]').attr('content'), key: "PAIR_"+pairType, value: buildSortPair})
                .done(function( data ) {
                    console.log(data);
                });
            }
            // console.log(buildSortItem);
        }
    });    
});

//Start Platform
window.editPlatformItem = function editPlatformItem(key){
    if($(".savePlatformItem").length<1 && processing===false){
        $(".platformItem"+key+" input").attr('disabled',false);
        $(".platformItem"+key+" input").focus();
        $(".platformItem"+key+" .platformItemSaveContainer").html(getSavebtn(key,"PlatformItem"));
    }else{
        if(processing===false){
            $(".platformItem"+key+" input").attr('disabled',true);
            $(".platformItem"+key+" .platformItemSaveContainer").html(getDeleteBtn(key, "PlatformItem"));
        }
        
    }
    
}

window.savePlatformItem = function savePlatformItem(key){
    var platformItemVal = $(".platformItem"+key+" input").val();
    processing=true;
    var spinner = getSpinner();
    $(".platformItem"+key+" .platformItemSaveContainer").html(spinner);
    $.post("/update-setting/"+key, {"_token": $('meta[name="csrf-token"]').attr('content'), key: "PLATFORM", value: platformItemVal})
    .done(function( data ) {
        console.log(data);
        $(".platformItem"+key+" input").attr('disabled',true);
        $(".platformItem"+key+" .platformItemSaveContainer").html(getDeleteBtn(key, "PlatformItem"));
        processing=false;
        location.reload();
    });
    // $(".platformItem"+key+" input").attr('disabled',true);
    // $(".platformItem"+key+" .platformItemSaveContainer").html("");

    // alert(platformItemVal);
}
window.savePlatformrecord = function savePlatformrecord(objThis){
    var getPlatformFromInput = $("#platform").val();
    $(objThis).html(getSpinner());
  
    $.post("/add-setting", {"_token": $('meta[name="csrf-token"]').attr('content'), key: "PLATFORM", value: getPlatformFromInput})
    .done(function( data ) {
        console.log(data.success);
        // $(objThis).html('<i class="fa fa-plus" aria-hidden="true"></i>');
        location.reload();
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        location.reload();
    })
    ;
}


window.deletePlatformItem = function deletePlatformItem(key){
    var platformItemVal = $(".platformItem"+key+" input").val();
    $("#confirmationModal .modal-body").html('<h4 style="color:red;">Are you sure to delete ('+platformItemVal+')?</h4>');
    $("#confirmationOkModal").attr('href',"/delete-setting/"+key+"?key=PLATFORM");
    const confirmationModal = new bootstrap.Modal('#confirmationModal');
    confirmationModal.show();
    const myModalEl = document.getElementById('confirmationModal');
    myModalEl.addEventListener('hidden.bs.modal', event => {
        $("#confirmationModal .modal-body").html('');
        confirmationModal.dispose();
    });
}
//End Platform

//Start Strategy
window.editStrategyItem = function editStrategyItem(key){
    if($(".saveStrategyItem").length<1 && processing===false){
        $(".strategyItem"+key+" input").attr('disabled',false);
        $(".strategyItem"+key+" input").focus();
        $(".strategyItem"+key+" .strategyItemSaveContainer").html(getSavebtn(key,"StrategyItem"));
    }else{
        if(processing===false){
            $(".strategyItem"+key+" input").attr('disabled',true);
            $(".strategyItem"+key+" .strategyItemSaveContainer").html(getDeleteBtn(key, "StrategyItem"));
        }
        
    }
    
}

window.saveStrategyItem = function saveStrategyItem(key){
    var strategyItemVal = $(".strategyItem"+key+" input").val();
    processing=true;
    var spinner = getSpinner();
    $(".strategyItem"+key+" .strategyItemSaveContainer").html(spinner);
    $.post("/update-setting/"+key, {"_token": $('meta[name="csrf-token"]').attr('content'), key: "STRATEGY", value: strategyItemVal})
    .done(function( data ) {
        console.log(data);
        $(".strategyItem"+key+" input").attr('disabled',true);
        $(".strategyItem"+key+" .strategyItemSaveContainer").html(getDeleteBtn(key, "StrategyItem"));
        processing=false;
        location.reload();
    });
    // $(".platformItem"+key+" input").attr('disabled',true);
    // $(".platformItem"+key+" .platformItemSaveContainer").html("");

    // alert(platformItemVal);
}
window.saveStrategyrecord = function saveStrategyrecord(objThis){
    var getStrategyFromInput = $("#strategy").val();
    $(objThis).html(getSpinner());  
    $.post("/add-setting", {"_token": $('meta[name="csrf-token"]').attr('content'), key: "STRATEGY", value: getStrategyFromInput})
    .done(function( data ) {
        console.log(data.success);
        // $(objThis).html('<i class="fa fa-plus" aria-hidden="true"></i>');
        location.reload();
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        location.reload();
    })
    ;
}


window.deleteStrategyItem = function deleteStrategyItem(key){
    var StrategyItemVal = $(".strategyItem"+key+" input").val();
    $("#confirmationModal .modal-body").html('<h4 style="color:red;">Are you sure to delete ('+StrategyItemVal+')?</h4>');
    $("#confirmationOkModal").attr('href',"/delete-setting/"+key+"?key=STRATEGY");
    const confirmationModal = new bootstrap.Modal('#confirmationModal');
    confirmationModal.show();
    const myModalEl = document.getElementById('confirmationModal');
    myModalEl.addEventListener('hidden.bs.modal', event => {
        $("#confirmationModal .modal-body").html('');
        confirmationModal.dispose();
    });
}
//End Strategy

//Start Pair
window.editPairItem = function editPairItem(key){
    if($(".savePairItem").length<1 && processing===false){
        $(".pairItem"+key+" input").attr('disabled',false);
        $(".pairItem"+key+" input").focus();
        $(".pairItem"+key+" .pairItemSaveContainer").html(getSavebtn(key,"PairItem"));
    }else{
        if(processing===false){
            $(".pairItem"+key+" input").attr('disabled',true);
            $(".pairItem"+key+" .pairItemSaveContainer").html(getDeleteBtn(key, "PairItem"));
        }
        
    }
    
}

window.savePairItem = function savePairItem(key){
    var pairItemVal = $(".pairItem"+key+" input").val();
    processing=true;
    var spinner = getSpinner();
    $(".pairItem"+key+" .pairItemSaveContainer").html(spinner);
    $.post("/update-setting/"+key, {"_token": $('meta[name="csrf-token"]').attr('content'), key: "PAIR", value: pairItemVal})
    .done(function( data ) {
        console.log(data);
        $(".pairItem"+key+" input").attr('disabled',true);
        $(".pairItem"+key+" .pairItemSaveContainer").html(getDeleteBtn(key, "PairItem"));
        processing=false;
        location.reload();
    });
    // $(".platformItem"+key+" input").attr('disabled',true);
    // $(".platformItem"+key+" .platformItemSaveContainer").html("");

    // alert(platformItemVal);
}
window.savePairrecord = function savePairrecord(objThis){
    var getPairFromInput = $("#pair").val();
    var getPairTime = $("#pair-type").val();
    $(objThis).html(getSpinner());  
    $.post("/add-setting", {"_token": $('meta[name="csrf-token"]').attr('content'), key: "PAIR_"+getPairTime, value: getPairFromInput})
    .done(function( data ) {
        console.log(data.success);
        // $(objThis).html('<i class="fa fa-plus" aria-hidden="true"></i>');
        location.reload();
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        location.reload();
    })
    ;
}


window.deletePairItem = function deletePairItem(key){
    var pairItemVal = $(".pairItem"+key+" input").val();
    $("#confirmationModal .modal-body").html('<h4 style="color:red;">Are you sure to delete ('+pairItemVal+')?</h4>');
    $("#confirmationOkModal").attr('href',"/delete-setting/"+key+"?key=PAIR");
    const confirmationModal = new bootstrap.Modal('#confirmationModal');
    confirmationModal.show();
    const myModalEl = document.getElementById('confirmationModal');
    myModalEl.addEventListener('hidden.bs.modal', event => {
        $("#confirmationModal .modal-body").html('');
        confirmationModal.dispose();
    });
}
//End Pair

//Start Account
window.editPairItem = function editPairItem(key){
    if($(".savePairItem").length<1 && processing===false){
        $(".pairItem"+key+" input").attr('disabled',false);
        $(".pairItem"+key+" input").focus();
        $(".pairItem"+key+" .pairItemSaveContainer").html(getSavebtn(key,"PairItem"));
    }else{
        if(processing===false){
            $(".pairItem"+key+" input").attr('disabled',true);
            $(".pairItem"+key+" .pairItemSaveContainer").html(getDeleteBtn(key, "PairItem"));
        }
        
    }
    
}

window.savePairItem = function savePairItem(key){
    var pairItemVal = $(".pairItem"+key+" input").val();
    processing=true;
    var spinner = getSpinner();
    $(".pairItem"+key+" .pairItemSaveContainer").html(spinner);
    $.post("/update-setting/"+key, {"_token": $('meta[name="csrf-token"]').attr('content'), key: "PAIR", value: pairItemVal})
    .done(function( data ) {
        console.log(data);
        $(".pairItem"+key+" input").attr('disabled',true);
        $(".pairItem"+key+" .pairItemSaveContainer").html(getDeleteBtn(key, "PairItem"));
        processing=false;
        location.reload();
    });
    // $(".platformItem"+key+" input").attr('disabled',true);
    // $(".platformItem"+key+" .platformItemSaveContainer").html("");

    // alert(platformItemVal);
}
window.saveAccountrecord = function saveAccountrecord(objThis){
    var getAccountName = $("#acc-name").val();
    var getAccountBalance = $("#acc-balance").val();
    var getAccountRemark = $("#acc-remark").val();
    var getAccountCcy = $("#acc-ccy").val();
    var getAccountType = $("#acc-type").val();
    var getStatus = $("#acc-status").val();
    var getAccId = $("#acc-id").val();
    
    $(objThis).html(getSpinner());  
    $.post("/add-account", {
        "_token": $('meta[name="csrf-token"]').attr('content'), 
        id: getAccId, 
        trading_type:getAccountType, 
        ccy: getAccountCcy,
        name: getAccountName,
        balance:getAccountBalance,
        status:getStatus,
        remark:getAccountRemark
    })
    .done(function( data ) {
        console.log(data.success);
        // $(objThis).html('<i class="fa fa-plus" aria-hidden="true"></i>');
        location.reload();
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        location.reload();
    })
    ;
}
window.editAccountItem = function editAccountItem(accId){
    $.get("/get-account/"+accId)
    .done(function( data ) {
        console.log(data.success);
        $("#acc-name").val(data.name);
        $("#acc-balance").val(data.balance);
        $("#acc-ccy").val(data.ccy);
        $("#acc-remark").val(data.remark);
        $("#acc-status").val(data.status);
        $("#acc-id").val(data.id);
        
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        location.reload();
    })
    ;
}

window.deleteAccountItem = function deleteAccountItem(accId){
    var accItemVal = $(".accountItem"+accId+" #view-acc-name").attr('val');
    $("#confirmationModal .modal-body").html('<h4 style="color:red;">Are you sure to delete ('+accItemVal+')?</h4>');
    $("#confirmationOkModal").attr('href',"/delete-account/"+accId);
    const confirmationModal = new bootstrap.Modal('#confirmationModal');
    confirmationModal.show();
    const myModalEl = document.getElementById('confirmationModal');
    myModalEl.addEventListener('hidden.bs.modal', event => {
        $("#confirmationModal .modal-body").html('');
        confirmationModal.dispose();
    });
}



window.deletePairItem = function deletePairItem(key){
    var pairItemVal = $(".pairItem"+key+" input").val();
    $("#confirmationModal .modal-body").html('<h4 style="color:red;">Are you sure to delete ('+pairItemVal+')?</h4>');
    $("#confirmationOkModal").attr('href',"/delete-setting/"+key+"?key=PAIR");
    const confirmationModal = new bootstrap.Modal('#confirmationModal');
    confirmationModal.show();
    const myModalEl = document.getElementById('confirmationModal');
    myModalEl.addEventListener('hidden.bs.modal', event => {
        $("#confirmationModal .modal-body").html('');
        confirmationModal.dispose();
    });
}
//End Account

//Start Trading Type
window.addSettingTradingType = function addSettingTradingType(value){
    // alert(value);
    $(".tradingTypeContainer").html(getSpinner());
    var toPost = {"_token": $('meta[name="csrf-token"]').attr('content'),'value':value,'key':"TRADING_TYPE"};
    $.post("/add-setting/return-view", toPost)
    .done(function( data ) {
        // console.log(data);
        $(".tradingTypeContainer").html(data);
        location.reload();
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        location.reload();
    });
}
window.removeSettingTradingType = function removeSettingTradingType(value){
    // alert(value);
    $(".tradingTypeContainer").html(getSpinner());
    var toPost = {"_token": $('meta[name="csrf-token"]').attr('content'),'value':value,'key':"TRADING_TYPE"};
    $.post("/remove-setting/return-view", toPost)
    .done(function( data ) {
        // console.log(data);
        $(".tradingTypeContainer").html(data);
        location.reload();
    }).fail(function(error){
        console.log(error.responseJSON);
        alert(error.responseJSON.message);
        location.reload();
    });
}
//End Trading Type