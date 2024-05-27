<style>
    .profileArea{
        float: right;
    }
   
    .dropdownMenuProfileBody{
        padding: 0.5%;  
        align-items: center;
        background-color: #efefef;
    }
    .dark .dropdownMenuProfileBody{
        padding: 0.5%;  
        align-items: center;
        background-color: #212529;
    }
    .bg-light{
        background-color: #fcfcfc !important;
    }
    .navbar-nav .nav-link.active, .navbar-nav .nav-link.show {
        color: #198754;
        font-weight:bolder;
        font-size: 16px;
    }
    .dark .navbar-nav .nav-link.active, .dark .navbar-nav .nav-link.show {
        color: #4bc48b;
        font-weight:bolder;
        font-size: 16px;
    }
    .navbar-nav .nav-link{
        font-weight: bolder;
        font-size: 16px;
        color: #515767;
    }
    .dark .navbar-nav .nav-link{
        font-weight: bolder;
        font-size: 16px;
        color: #b3b5bd;
    }

    .notification {
    position: relative;
    }
    .notification .badge {
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 0;
        right: 0;
        width: 18px;
        height: 18px;
        padding: 0 8px;
        border-radius: 8px;
        background-color: #e60323;
        color: #fff;
        /* font-size: 1rem; */
    }
    .hello {
        color: rgb(118 95 80);
    }
    .dark .hello {
        color: #b3b5bd;
    }
</style>
@php
    $currentPath = request()->getPathInfo();
    $currentLocale = getCurrentLocale();
@endphp

@if(auth()->user() && !traderNothere())
    @php
        $isFixedTop = false;
    @endphp
    <nav class="navbar {{$isFixedTop?'fixed-top':''}} navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="{{url('images/M.T.J logo.png')}}" style="width: 70px;" alt="" srcset=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link {{(strpos($currentPath,'/trade')!==false || $currentPath=='/')?'active':''}}" aria-current="page" href="/"><i class="fa-solid fa-house" style="font-size:130%;"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$currentPath=="/from-menus/news"?'active':''}}" href="/from-menus/news"><i class="fa-regular fa-newspaper"></i> {{translator("NEWS")}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$currentPath=="/from-menus/motivation"?'active':''}}" href="/from-menus/motivation"><i class="fa-regular fa-lightbulb"></i> {{translator("MOTIVATION")}}</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{$currentPath=="/from-menus/learn"?'active':''}}" href="/from-menus/learn"><i class="fa-solid fa-globe"></i> {{translator("LEARN")}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{strpos($currentPath,'/forums')!==false ?'active':''}}" href="/forums"><i class="fa-solid fa-comments-dollar"></i> {{translator("FORUMS")}}</a>
            </li>
            </ul>
            <div class="d-flex switchDarkMode">
                <input type="checkbox" class="switchCheckBox" id="switchCheckBox">
                <label for="switchCheckBox" class="switchCheckBox-label">
                  <i class="fas fa-moon"></i>
                  <i class="fas fa-sun"></i>
                  <span class="ball" id="ballDarkMode"></span>
                </label>
            </div>
            <div class="profileArea">
                    @php
                        $user = auth()->user();
                    @endphp
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="notification" style="margin-right:1%;">
                                <a href="#">
                                    <i class="fa fa-bell" style="font-size:36px; color:#198753;"></i>
                                    <span class="badge">0</span>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="profile dropstart">
                                <div id="dropdownMenuProfile" data-bs-toggle="dropdown" aria-expanded="false" alt="Image Profile">
                                    {{userAvatar($user)}}
                                </div>
                                
                                <ul class=" dropdown-menu dropdownMenuProfileBody" aria-labelledby="dropdownMenuProfile">
                                    <li class="dropdown-item"><span class="hello" >Hello! {{$user->name}}</span></li>
                                    <li><a class="dropdown-item"  href="/myprofile" >{{translator("Profile")}}</a></li>
                                    <li><a class="dropdown-item" href="/trade/setting" >{{translator("Setting")}}</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal" href="#logoutModal" style="color: red;">Logout</a></li>
                                    <li class="dropdown-item"><span class="hello">Timezone : {{$user->time_zone}}</span></li>
                                    {{-- <li class="dropdown-item"><span class="hello">Version : {{translator("1.0")}}</span></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                   
            </div>
        </div>
        </div>
    </nav>
@endif
<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">{{translator("general:_Are you sure to logout?")}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{translator("general:_Close")}}</button>
            <a type="button" href="/logout" class="btn btn-danger">{{translator("general:_Yes")}}</a>
        </div>
      </div>
    </div>
</div>
