<div class="card monthlyWinLossWidget">
    <div class="dataContainer">
        @if (isset($data))
            <canvas id="monthly-win-loss"></canvas>
            <script type="module">
                $(document).ready(function(){
                    const labels = {!!json_encode($data['label'])!!};
            
                    const data = {
                        labels: labels,
                        datasets: [
                            {
                            label: 'WIN',
                            data: {!!json_encode($data['win_data_set'])!!},
                            borderColor: 'green',
                            backgroundColor: '#4bc48b',
                            borderWidth: 1,
                            borderRadius: 3,
                            borderSkipped: false,
                            },
                            {
                            label: 'LOSS',
                            data: {!!json_encode($data['loss_data_set'])!!},
                            borderColor: 'red',
                            backgroundColor: 'rgba(181, 19, 7, 0.5)',
                            borderWidth: 1,
                            borderRadius: 3,
                            borderSkipped: false,
                            }
                        ]
                    };
            
                    const config = {
                        type: 'bar',
                        data: data,
                        options: {
                            responsive: true,
                            plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                        color: '#199c9e'
                                }
                            },
                            title: {
                                display: true,
                                text: 'Monthly WIN&LOSS',
                                color: '#199c9e'
                            }
                            }
                        },
                    };
            
                    new Chart(
                        document.getElementById('monthly-win-loss'),
                        config
                    );
                });
            </script>
        @endif
    </div>
    
</div>
