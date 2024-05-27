<style>
    .sidebar-container{
        /* position: relative;
        top: 65px;  */
    }
    .sidebar .nav-item .nav-link {
        color: #198754;
    }
    .sidebar .nav-item{
        border-radius: 10px;
    }
    .sidebar .nav-item.active {
        background-color: rgb(236 234 233);
    }
    .dark .sidebar .nav-item.active {
        background: none;
    }
    .dark .sidebar .nav-item.active .nav-link {
        color: #4bc48b;
    }
    .dark .sidebar .nav-item .nav-link{
        background: none;
        color: #b3b5bd;
    }
</style>
<div class="container-fluid sidebar-container">
    <div class="row">
        <div class="col-sm-auto sideBarNavbar bg-light">
            <div class="">
                <ul class="nav nav-pills nav-flush d-flex flex-lg-column flex-md-row flex-sm-row flex-nowrap mb-auto mx-auto text-center align-items-center sidebar">
                    <li class="nav-item {{request()->getPathInfo()=='/'?'active':''}}">
                        <a href="/" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                            <i class="bi bi-graph-up-arrow fs-2"></i>
                        </a>
                    </li>
                    <li class="nav-item {{request()->getPathInfo()=='/trade/create-form' || strpos(request()->getPathInfo(),'/trade/edit-form')!==false || strpos(request()->getPathInfo(),'/trade/detail')!==false?'active':''}}">
                        <a href="/trade/create-form" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Create Trade">
                            <i class="bi bi-plus-square fs-2"></i> 
                            @if (strpos(request()->getPathInfo(),'/trade/edit-form')!==false)
                                <i class="bi bi-pencil-square" style="position: absolute;"></i>
                            @elseif(strpos(request()->getPathInfo(),'/trade/detail')!==false)
                                <i class="bi bi-eye" style="position: absolute;"></i>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item {{request()->getPathInfo()=='/trade/list'?'active':''}}">
                        <a href="/trade/list" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="List">
                            <i class="bi bi-list-task fs-2"></i>
                        </a>
                    </li>
                    <li class="nav-item {{ strpos(request()->getPathInfo(),'/trade/mistake-notes')!==false?'active':''}}">
                        <a href="/trade/mistake-notes" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="List">
                            <i class="bi bi-journal-richtext fs-2"></i>
                            @if(strpos(request()->getPathInfo(),'/trade/mistake-notes/view-edit')!==false)
                                <i class="bi bi-eye" style="position: absolute;"></i>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item {{request()->getPathInfo()=='/trade/setting'?'active':''}}">
                        <a href="/trade/setting" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Setting">
                            <i class="bi bi-gear fs-2"></i>
                        </a>
                    </li>
            
                </ul>
            </div>
        </div>
        <div class="col-12 col-lg-11 col-md-11 p-3 min-vh-100">
            @yield('sidebar-content')
        </div>
    </div>
</div>