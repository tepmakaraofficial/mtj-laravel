<style>
    .pnlwidget .pnlwidgetLabel{
        background-color: rgb(251, 250, 250);
        font-size: 90%;
        color:green;
        text-align: right;
        /* text-align:center; */
    }
    .dark .pnlwidget .pnlwidgetLabel{
        background:none;
        font-size: 90%;
        color:#b3b5bd;
        text-align: right;
        /* text-align:center; */
    }
    .pnlwidget .dataContainer{
        padding: 3%;
        /* border-radius: 10px; */
    }
    .pnlwidget label{
        white-space: nowrap; 
        width: 100%; 
        overflow: hidden;
        text-overflow: ellipsis; 
        color: rgb(96 114 95);
        font-weight: bold;
    }
    .dark .pnlwidget label{
        white-space: nowrap; 
        width: 100%; 
        overflow: hidden;
        text-overflow: ellipsis; 
        color: #9d9ea5;
        font-weight: bold;
    }
    .dark .rounded-pill{
        background-color: #3ca876 !important;
    }
   
</style>
<div class="pnlwidget">
    <div class="card dataContainer">
        <div class="pnlwidgetLabel fw-bold"><i class="bi bi-cash"></i> PNL</div>
        @if (isset($data))
            <div class="row g-1 justify-content-center">
                <div class="col-lg-5 col-md-6 col-sm-12 mb-3">
                    <div class="row row-cols-2 justify-content-center g-1">
                        <div class="col">
                            <label>TODAY <span class="badge rounded-pill" style="background-color: green;">{{$data['today_count']}}</span></label>
                            <div><span style="font-weight: bold;font-size: 130%;color:{{$data['TODAY']>=0?'#3ca876;':'#da2713;'}}">{{$data['TODAY']>=0?'+':''}}{{$data['TODAY']}}{{globalCcySymbol()}}</span></div>
                        </div>
                        <div class="col mb-3">
                            <label>YESTERDAY <span class="badge rounded-pill" style="background-color: green;">{{$data['yesterday_count']}}</span></label>
                            <div><span style="font-weight: bold;font-size: 130%;color:{{$data['YESTERDAY']>=0?'#3ca876;':'#da2713;'}}">{{$data['YESTERDAY']>=0?'+':''}}{{$data['YESTERDAY']}}{{globalCcySymbol()}}</span></div>
                        </div>
                        <div class="col">
                            <label>WEEK <span class="badge rounded-pill" style="background-color: green;">{{$data['week_count']}}</span></label>
                            <div><span style="font-weight: bold;font-size: 100%;color:{{$data['WEEK']>=0?'#3ca876;':'#da2713;'}}">{{$data['WEEK']>=0?'+':''}}{{$data['WEEK']}}{{globalCcySymbol()}}</span></div>
                        </div>
                        <div class="col">
                            <label>MONTH <span class="badge rounded-pill" style="background-color: green;">{{$data['month_count']}}</span></label>
                            <div><span style="font-weight: bold;font-size: 100%;color:{{$data['MONTH']>=0?'#3ca876;':'#da2713;'}}">{{$data['MONTH']>=0?'+':''}}{{$data['MONTH']}}{{globalCcySymbol()}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <div class="row row-cols-2 justify-content-center g-1">
                        <div class="col">
                            <label>LAST WEEK <span class="badge rounded-pill" style="background-color: green;">{{$data['last_week_count']}}</span></label>
                            <div><span style="font-weight: bold;font-size: 130%;color:{{$data['LAST_WEEK']>=0?'#3ca876;':'#da2713;'}}">{{$data['LAST_WEEK']>=0?'+':''}}{{$data['LAST_WEEK']}}{{globalCcySymbol()}}</span></div>
                        </div>
                        <div class="col mb-3">
                            <label>LAST MONTH <span class="badge rounded-pill" style="background-color: green;">{{$data['last_month_count']}}</span></label>
                            <div><span style="font-weight: bold;font-size: 130%;color:{{$data['LAST_MONTH']>=0?'#3ca876;':'#da2713;'}}">{{$data['LAST_MONTH']>=0?'+':''}}{{$data['LAST_MONTH']}}{{globalCcySymbol()}}</span></div>
                        </div>
                        <div class="col">
                            <label>LAST 6 MONTH <span class="badge rounded-pill" style="background-color: green;">{{$data['last_6_month_count']}}</span></label>
                            <div><span style="font-weight: bold;font-size: 100%;color:{{$data['LAST_6_MONTH']>=0?'#3ca876;':'#da2713;'}}">{{$data['LAST_6_MONTH']>=0?'+':''}}{{$data['LAST_6_MONTH']}}{{globalCcySymbol()}}</span></div>
                        </div>
                        <div class="col">
                            <label>LAST YEAR <span class="badge rounded-pill" style="background-color: green;">{{$data['last_year_count']}}</span></label>
                            <div><span style="font-weight: bold;font-size: 100%;color:{{$data['LAST_YEAR']>=0?'#3ca876;':'#da2713;'}}">{{$data['LAST_YEAR']>=0?'+':''}}{{$data['LAST_YEAR']}}{{globalCcySymbol()}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
       
        @endif
    </div>
</div>