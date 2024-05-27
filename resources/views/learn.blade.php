@extends('layout.master')
@section('top')
    @include('layout.top')
@endsection

@section('title','MTJ - Learn Trading')
@section('body')

    <style>
        .learnContainer{
            width: 90%;
            min-height: 300px;
            margin-top: 10%;
            position: relative;
            text-align: center;
            
        }
        
    </style>
    <div class="learnContainer">
        <div id="bestTradingLesson" hidden>
            <h1 style="color: #4bc48b;">Trade with your own lesson learned.</h1>
            <h5 >There is no special strategy that fit with all traders. In trading war you just fight and learn from your mistake. If you really love it don't give up. <br>Good luck!</h5>
        </div>
        <div id="countdown" style="font-size: 500%;color:#4bc48b;">3</div>
    </div>
    <script type="module">
        
        
        var timeLeft = 3;

        function countdown() {
            timeLeft--;
            document.getElementById("countdown").innerHTML = String( timeLeft );
            if (timeLeft > 0) {
                setTimeout(countdown, 1000);
            }else{
                $("#countdown").hide();
                $("#bestTradingLesson").attr('hidden',false);
            }
        };

        setTimeout(countdown, 1000);
        
    </script>
@endsection