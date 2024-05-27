<div class="dashboardContainer">
    <div class="row g-1 mb-1">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="pnlContainer">
                @include('partials.dashboard-widgets.pnl')
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="accountContainer">
                @include('partials.dashboard-widgets.accounts')
            </div>
        </div>
    </div>
    <div class="row g-1 mb-1">
        <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
            <div class="row g-1">
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                    <div class="weeklyPnlContainer">
                        @include('partials.dashboard-widgets.weekly-pnl')
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="executionContainer">
                        @include('partials.dashboard-widgets.execution')
                    </div>
                    
                </div>
                
            </div>
        </div>
        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
            <div class="row g-1">
               
                <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                    <div class="openCloseContainer">
                        @include('partials.dashboard-widgets.open-close')
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 mb-2">
                    <div class="topOrdersContainer">
                        @include('partials.dashboard-widgets.top-orders')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-1">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="monthylPnlContainer">
                @include('partials.dashboard-widgets.monthly-pnl')
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="monthylWinLossContainer">
                @include('partials.dashboard-widgets.monthly-win-loss')
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            
        </div>
    </div>

</div>
