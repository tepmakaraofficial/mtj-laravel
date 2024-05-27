<div class="card ">
    <div class="dataContainer">
        @if (isset($data))
            <canvas id="execution"></canvas>
            <script type="module">
                $(document).ready(function(){
                    const data = {
                        labels:{!!json_encode($data['label'])!!},
                        datasets: [
                            {
                                label: 'Execution',
                                data: {!!json_encode($data['data_set'])!!},
                                backgroundColor: {!!json_encode($data['color'])!!}
                            }
                        ]
                    };
            
                    const config = {
                        type: 'pie',
                        data: data,
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Execution',
                                    color: '#199c9e'
                                }
                            },
                            elements:{
                                arc:{
                                    borderColor:'#cfccca'
                                }
                            }
                        },
                    };
            
                    new Chart(
                        document.getElementById('execution'),
                        config
                    );
                });
            </script>
        @endif
    </div>
</div>
