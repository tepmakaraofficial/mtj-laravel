<style>
    .openCloseWidget .dataContainer{
        padding: 3%;
    }
    .openCloseWidget .fw-bold{
        color: rgb(20 114 131);
    }
</style>
<div class="openCloseWidget">
    <div class="card dataContainer">
        @if (isset($data))
            <span style="font-weight:bold;text-align: center;font-size: 100%;color:green;">{{translator('CLOSING')}}</span>
            <ol class="list-group mt-2">
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Manually</div>
                        </div>
                        <span class="badge bg-success rounded-pill">{{$data['Manually_count']}}</span>
                    </div>
                    <div class="progress mt-2" style="width:100%;background-color:rgb(210, 220, 222);">
                        <div class="progress-bar" role="progressbar" style="width: {{$data['Manually_percent']}}%;" aria-valuenow="{{$data['Manually_percent']}}" aria-valuemin="0" aria-valuemax="100">{{$data['Manually_percent']}}%</div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">TP</div>
                        </div>
                        <span class="badge bg-success rounded-pill">{{$data['TP_count']}}</span>
                    </div>
                    <div class="progress mt-2" style="width:100%;background-color:rgb(210, 220, 222);">
                        <div class="progress-bar" role="progressbar" style="width: {{$data['TP_percent']}}%;" aria-valuenow="{{$data['TP_percent']}}" aria-valuemin="0" aria-valuemax="100">{{$data['TP_percent']}}%</div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">SL</div>
                        </div>
                        <span class="badge bg-success rounded-pill">{{$data['SL_count']}}</span>
                    </div>
                    <div class="progress mt-2" style="width:100%;background-color:rgb(210, 220, 222);">
                        <div class="progress-bar" role="progressbar" style="width: {{$data['SL_percent']}}%;" aria-valuenow="{{$data['SL_percent']}}" aria-valuemin="0" aria-valuemax="100">{{$data['SL_percent']}}%</div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">BREAKEVEN</div>
                        </div>
                        <span class="badge bg-success rounded-pill">{{$data['Breakeven_count']}}</span>
                    </div>
                    <div class="progress mt-2" style="width:100%;background-color:rgb(210, 220, 222);">
                        <div class="progress-bar" role="progressbar" style="width: {{$data['Breakeven_percent']}}%;" aria-valuenow="{{$data['Breakeven_percent']}}" aria-valuemin="0" aria-valuemax="100">{{$data['Breakeven_percent']}}%</div>
                    </div>
                </li>
            </ol>
        @endif
        
    </div>
</div>
