import './bootstrap.js';
import 'jquery-ui/dist/jquery-ui';

// setTimeout(() => {
//     // $('#toast').toast('hide');
//     var toastElList = [].slice.call( 
//         document.querySelectorAll('#toast')) 
//     var toastList = toastElList.map(function (toastEl) { 
//         return new bootstrap.Toast(toastEl) 
//     }) 
//     toastList.forEach(toast => toast.hide()) 
// }, 1500);

window.getSpinner = function getSpinner(){
    return '<div class="spinner-border text-success" role="status" style="width:20px;height:20px;">\
        <span class="visually-hidden">Loading...</span>\
    </div>';
}

window.generalSpinner = function generalSpinner(style=''){
    return '<div class="d-flex justify-content-center" '+style+'>\
    <div class="spinner-border" role="status">\
    <span class="visually-hidden">Loading...</span>\
    </div></div>';
}

// const channel = Echo.private('channel-name.id');
// channel.subscribed(()=>{
//     console.log('subscribed');
// }).listen('.anyname',(e)=>{
//     alert("Ghost is here");
//     console.log(e);
// });
const url = new URL(window.location.href);

// if (url.searchParams.has('signinback')) {
//   console.log('The query parameter is set');
// }

$(window).ready(function(){
    $(".content").fadeIn(1000);  
    $('#preload').fadeOut();
 });
if(url.pathname!='/login' && url.pathname!='/logout'){
    if(localStorage.getItem("data-theme")){
        if(localStorage.getItem("data-theme")!="light"){
            document.getElementById('ballDarkMode').style.transform = 'translateX(24px)';
            $(".navbar, .sideBarNavbar").removeClass("bg-light");
            $(".navbar, .sideBarNavbar").addClass("bg-dark");
            $("body").addClass("dark");
        }else{
            document.getElementById('ballDarkMode').style.transform = 'translateX(0px)';
            $(".navbar, .sideBarNavbar").removeClass("bg-dark");
            $(".navbar, .sideBarNavbar").addClass("bg-light");
            $("body").removeClass("dark");
        }
        document.documentElement.setAttribute('data-bs-theme',localStorage.getItem("data-theme"));
    }else{
        document.documentElement.setAttribute('data-bs-theme','dark');
        localStorage.setItem("data-theme",'dark');
        document.getElementById('ballDarkMode').style.transform = 'translateX(24px)';
        $(".navbar, .sideBarNavbar").removeClass("bg-light");
        $(".navbar, .sideBarNavbar").addClass("bg-dark");
        $("body").addClass("dark");
    }
    document.getElementById('switchCheckBox').addEventListener('click',()=>{
        if (document.documentElement.getAttribute('data-bs-theme') == 'dark') {
            document.documentElement.setAttribute('data-bs-theme','light');
            localStorage.setItem("data-theme",'light');
            document.getElementById('ballDarkMode').style.transform = 'translateX(0px)';
            $(".navbar, .sideBarNavbar").removeClass("bg-dark");
            $(".navbar, .sideBarNavbar").addClass("bg-light");
            $("body").removeClass("dark");
        }
        else {
            document.documentElement.setAttribute('data-bs-theme','dark');
            localStorage.setItem("data-theme",'dark');
            document.getElementById('ballDarkMode').style.transform = 'translateX(24px)';
            $(".navbar, .sideBarNavbar").removeClass("bg-light");
            $(".navbar, .sideBarNavbar").addClass("bg-dark");
            $("body").addClass("dark");
        }
    })
}
