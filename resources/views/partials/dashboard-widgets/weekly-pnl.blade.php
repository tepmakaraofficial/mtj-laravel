<div class="card weeklyPnlWidget">
    <div class="dataContainer">
        @if (isset($data))
            <canvas id="weekly-pnl"></canvas>
            <script type="module">
                $(document).ready(function(){
                    const labels = {!!json_encode($data['label'])!!};
            
                    const data = {
                        labels: labels,
                        datasets: [{
                            label: 'This Week PNL',
                            backgroundColor: '#4bc48b',
                            borderColor: '#4bc48b',
                            data: {!!json_encode($data['data_set'])!!},
                        }]
                    };
            
                    const config = {
                        type: 'line',
                        data: data,
                        options: {
                            plugins: {
                                legend: {
                                    display: true,
                                    labels: {
                                        color: '#199c9e'
                                    }
                                }
                            }
                        }
                    };
            
                    new Chart(
                        document.getElementById('weekly-pnl'),
                        config
                    );
                });
            </script>
        @endif
    </div>
</div>
